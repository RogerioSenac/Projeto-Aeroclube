<?php
include("../conexao.php");

$id = $_GET['id'];

// Preparar e executar a consulta para obter os registros do voo
$busca = $conexao->prepare("SELECT * FROM registros_voos WHERE idRegVoo = ?");
$busca->execute([$id]);
$exibir = $busca->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $horaRetorno = $_POST['horaRetorno'];
    $dataRetorno = $_POST['dataRetorno'];
    $tempoVoo = $_POST['tempoVoo'];
    $parecer = $_POST['parecer'];
    $usarHoraComputador = isset($_POST['usarHoraComputador']) ? $_POST['usarHoraComputador'] : 'nao';
    $usarDataComputador = isset($_POST['usarDataComputador']) ? $_POST['usarDataComputador'] : 'nao';
    
    if ($usarHoraComputador === 'sim') {
        $dataRetorno = date('Y-m-d');
        $horaRetorno = date('H:i');
    }

    $dataHoraRetorno = $dataRetorno . ' ' . $horaRetorno;

    // Calcular o tempo de voo
    $dataHoraSaida = $exibir[0]['dataSaida'] . ' ' . $exibir[0]['horaSaida'];
    $dataHoraSaida = new DateTime($dataHoraSaida);
    $dataHoraRetorno = new DateTime($dataHoraRetorno);
    $intervalo = $dataHoraSaida->diff($dataHoraRetorno);

    $tempoVoo = $intervalo->format('%H:%I:%S');

    // Preparar e executar a atualização dos registros do voo
    $atualizar = $conexao->prepare("UPDATE registros_voos SET dataRetorno = ?, horaRetorno = ?, tempoVoo = ? WHERE idRegVoo = ?");
    $atualizar->execute([$dataRetorno, $dataHoraRetorno->format('Y-m-d H:i:s'), $tempoVoo, $id]);

    $inserir = $conexao->prepare("INSERT INTO pareceres (parecer, idRegVoo) VALUES (?,?)");
    $inserir->execute([$parecer, $id]);


    // Redirecionar após a atualização
    header('Location: lista_voo_abertos.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Atualização de Voo</title>
    <style>
        h1 {
            text-align: center;
            margin-bottom: 2rem;
            font-size: 2.5rem;
            font-weight: bold;
            color: #343a40;
            /* Cor escura para contraste */
        }
    </style>
    <script>
        function calcularTempoVoo() {
            const dataSaida = document.getElementById('dataSaida').value;
            const horaSaida = document.getElementById('horaSaida').value;
            const dataRetorno = document.getElementById('dataRetorno').value;
            const horaRetorno = document.getElementById('horaRetorno').value;

            if (dataSaida && horaSaida && dataRetorno && horaRetorno) {
                // Converter as datas e horas para Date objects
                const dataHoraSaida = new Date(`${dataSaida}T${horaSaida}`);
                const dataHoraRetorno = new Date(`${dataRetorno}T${horaRetorno}`);

                // Calcular a diferença em milissegundos
                let diferencaMillis = dataHoraRetorno - dataHoraSaida;

                // Verificar se a diferença é negativa (indica retorno no dia seguinte)
                if (diferencaMillis < 0) {
                    dataHoraRetorno.setDate(dataHoraRetorno.getDate() + 1);
                    diferencaMillis = dataHoraRetorno - dataHoraSaida;
                }

                // Converter a diferença para horas, minutos e segundos
                const horas = Math.floor(diferencaMillis / (1000 * 60 * 60));
                const minutos = Math.floor((diferencaMillis % (1000 * 60 * 60)) / (1000 * 60));
                const segundos = Math.floor((diferencaMillis % (1000 * 60)) / 1000);

                // Exibir o tempo de voo no campo correspondente no formato 'HH:mm:ss'
                document.getElementById('tempoVoo').value = `${String(horas).padStart(2, '0')}:${String(minutos).padStart(2, '0')}:${String(segundos).padStart(2, '0')}`;
            }
        }

        function definirHoraAtual() {
            const dataAtual = new Date();
            const dataFormatada = dataAtual.toISOString().split('T')[0];
            const horaFormatada = dataAtual.toTimeString().substring(0, 5);

            document.getElementById('dataRetorno').value = dataFormatada;
            document.getElementById('horaRetorno').value = horaFormatada;

            // Atualizar o tempo de voo se os campos já estiverem preenchidos
            calcularTempoVoo();
        }
    </script>
</head>

<body>
    <div class="container">
        <h1 class="mb-4">Atualização de Voo</h1>

        <!-- Exibir informações do voo em uma tabela -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Registro da saída do voo</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID Voo</th>
                            <th>Data Saída</th>
                            <th>Hora Saída</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($exibir as $saidas): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($saidas['idRegVoo']); ?></td>
                                <td>
                                    <input type="date" id="dataSaida" class="form-control-plaintext"
                                        value="<?php echo htmlspecialchars($saidas['dataSaida']); ?>" readonly>
                                </td>
                                <td>
                                    <input type="time" id="horaSaida" class="form-control-plaintext"
                                        value="<?php echo htmlspecialchars($saidas['horaSaida']); ?>" readonly>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Formulário para atualizar o registro -->
        <form method="POST">
            <div class="card-header">
                <h5 class="card-title">Registro do plano de voo</h5>
            </div>
            <div class="mb-3">
                <label for="usarHoraComputador" class="form-label">Escolha a hora de retorno</label>
                <div>
                    <input type="radio" id="usarHoraComputadorSim" name="usarHoraComputador" value="sim" onclick="definirHoraAtual()">
                    <label for="usarHoraComputadorSim">Usar hora atual do computador</label>
                </div>
                <div>
                    <input type="radio" id="usarHoraComputadorNao" name="usarHoraComputador" value="nao" checked>
                    <label for="usarHoraComputadorNao">Inserir manualmente</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="dataRetorno" class="form-label">Data de Retorno</label>
                <input type="date" class="form-control" id="dataRetorno" name="dataRetorno" required>
            </div>
            <div class="mb-3">
                <label for="horaRetorno" class="form-label">Hora de Retorno</label>
                <input type="time" class="form-control" id="horaRetorno" name="horaRetorno" oninput="calcularTempoVoo()"
                    required>
            </div>
            <div class="mb-3">
                <label for="tempoVoo" class="form-label">Tempo de Voo</label>
                <input type="text" class="form-control" id="tempoVoo" name="tempoVoo" readonly>
            </div>

            <div class="mb-3">
                <label for="parecer" class="form-label">Parecer</label>
                <input type="text" class="form-control" id="parecer" name="parecer" required>
            </div>
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>
        <br>
        <a href="lista_voo_abertos.php" class="btn btn-secondary">Voltar</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-..."></script>
</body>

</html>
