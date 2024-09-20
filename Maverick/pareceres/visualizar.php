<?php
include("../conexao.php");

$id = $_GET['id'];

$buscarRegistro = $conexao->prepare("
    SELECT alunos.nomeAluno, registros_voos.dataSaida, registros_voos.horaSaida, registros_voos.dataRetorno, registros_voos.horaRetorno, registros_voos.tempoVoo, pareceres.parecer
    FROM pareceres
    INNER JOIN registros_voos ON registros_voos.idRegVoo = pareceres.idRegVoo
    INNER JOIN alunos ON alunos.idAluno = registros_voos.idAluno
    WHERE alunos.idAluno = ?
");

$buscarRegistro->execute([$id]);
$registros = $buscarRegistro->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../Assets/CSS/estilo.css">
    <title>Consulta Históricos dos Pareceres de Voo do Aluno</title>
 </head>

<body>
    <div class="navbar_menu">
        <img src="../Assets/images/aeronaves/logo.png" alt="Logo">
    </div>
    <div class="mensagem">
        <h1>Consulta Histórico dos Pareceres de Voo do Aluno</h1>
    </div>
    <div class="container">

        <?php if (count($registros) > 0): ?>
            <p class="nome-aluno">Nome do Aluno: <?php echo htmlspecialchars($registros[0]['nomeAluno']); ?></p>

            <table class="table table-dark table-hover center">
                <thead>
                    <tr>
                        <th>Data e Hora de Saída</th>
                        <th>Data e Hora de Retorno</th>
                        <th>Registro Tempo de Voo</th>
                        <th>Parecer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($registros as $registro): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($registro['dataSaida']) . ' ' . htmlspecialchars($registro['horaSaida']); ?></td>
                            <td><?php echo htmlspecialchars($registro['dataRetorno']) . ' ' . htmlspecialchars($registro['horaRetorno']); ?></td>
                            <td><?php echo htmlspecialchars($registro['tempoVoo']); ?></td>
                            <td><?php echo htmlspecialchars($registro['parecer']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Nenhum registro encontrado para o aluno.</p>
        <?php endif; ?>

        <a href="menuvisualizar.php" class="btn btn-secondary">Voltar</a>
    </div>
</body>

</html>