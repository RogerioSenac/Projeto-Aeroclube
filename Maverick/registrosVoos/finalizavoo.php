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
        $horaRetorno = date('H:i:s');
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
    <link rel="stylesheet" href="../Assets/CSS/estilo.css">
    <title>Atualização de Voo</title>

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
                document.getElementById('tempoVoo').value =
                    `${String(horas).padStart(2, '0')}:${String(minutos).padStart(2, '0')}:${String(segundos).padStart(2, '0')}`;
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
    <div class="navbar_menu">
        <img src="../Assets/images/aeronaves/logo.png" alt="Logo">
    </div>

    <div class="etiqueta">
        <h1>Fechamento de Registro de Voo</h1>
    </div>

    <div class="container">
        <!-- Exibir informações do voo em uma tabela -->
        <table class="table table-dark table-hover">
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
                        <td><?php echo htmlspecialchars($saidas['idRegVoo']); ?>
                        <td>

                            <?php echo htmlspecialchars($saidas['dataSaida']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($saidas['horaSaida']); ?>
                        </td>
                    </tr>


                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- Formulário para atualizar o registro -->
        <form method="POST">

            <div class="mb-4">
                <label for="usarHoraComputador" class="form-label">Escolha a hora de retorno</label>
                <div class="input-radio">
                    <input type="radio" id="usarHoraComputadorSim" name="usarHoraComputador" value="sim"
                        onclick="definirHoraAtual()">
                    <label for="usarHoraComputadorSim">Usar hora atual do computador</label>
                </div>
                <div class="input-radio">
                    <input type="radio" id="usarHoraComputadorNao" name="usarHoraComputador" value="nao" checked>
                    <label for="usarHoraComputadorNao">Inserir manualmente</label>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col col-lg-4">
                    <label for="dataRetorno" class="form-label">Data de Retorno</label>
                    <input type="date" class="form-control" id="dataRetorno" name="dataRetorno" required>
                </div>
                <div class="col col-lg-4">
                    <label for="horaRetorno" class="form-label">Hora de Retorno</label>
                    <input type="time" class="form-control" id="horaRetorno" name="horaRetorno"
                        oninput="calcularTempoVoo()" required>
                </div>
                <div class="col col-lg-4">
                    <label for="tempoVoo" class="form-label">Tempo de Voo</label>
                    <input type="text" class="form-control" id="tempoVoo" name="tempoVoo" readonly>
                </div>
            </div>

            <div class="col col lg-12">
                <label for="parecer" class="form-label">Parecer</label>
                <input type="text" class="form-control" id="parecer" name="parecer" required>
            </div>
            <div class="mb-4">
                <button type="submit" class="btn btn-primary">Atualizar</button>
                <a href="lista_voo_abertos.php" class="btn btn-secondary">Voltar</a>
            </div>
        </form>
        <br>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-...">
    </script>
</body>

</html>