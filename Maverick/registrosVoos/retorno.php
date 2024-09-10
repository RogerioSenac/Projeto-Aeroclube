<?php
include("../conexao.php");

// Verificar se o parâmetro 'id' está presente na URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Sanitize e validar o ID do aluno (assumindo que seja um número)
    $idAluno = filter_var($_GET['id'], FILTER_VALIDATE_INT);

    // Verificar se o ID é válido
    if ($idAluno !== false) {
        // Preparar e executar a consulta para obter os registros dos voos
        $buscaRsaidas = $conexao->prepare("SELECT * FROM registros_voos WHERE idAluno = ? AND horaRetorno IS NULL");
        $buscaRsaidas->execute([$idAluno]);

        // Obter os resultados da consulta
        $exibirRsaidas = $buscaRsaidas->fetchAll(PDO::FETCH_ASSOC);
    } else {
        // ID inválido
        $exibirRsaidas = [];
        echo "ID de aluno inválido.";
    }
} else {
    // ID não fornecido
    $exibirRsaidas = [];
    echo "ID de aluno não fornecido.";
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
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

</head>

<body>
    <div class="container">
        <h1 class="my-4">Lista de voos em abertos do aluno</h1>
        <!--Tabela de Registro de alunos-->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Voos do Aluno</h5>
            </div>
        </div>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID Voo</th>
                    <th>Data Saída</th>
                    <th>Hora Saída</th>
                </tr>
            </thead>
            <?php foreach ($exibirRsaidas as $saidas): ?>
                <tr>
                    <td><?php echo htmlspecialchars($saidas['idRegVoo']) ?></td>
                    <td><?php echo htmlspecialchars($saidas['dataSaida']) ?></td>
                    <td><?php echo htmlspecialchars($saidas['horaSaida']) ?></td>

                    <td>
                        <a href="finalizavoo.php?id=<?php echo $saidas['idRegVoo']; ?>"
                            class="btn btn-warning btn-sm">Finalizar</a>

                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <a href="lista_voo_abertos.php" class="btn btn-secondary">Voltar</a>
    </div>
</body>

</html>