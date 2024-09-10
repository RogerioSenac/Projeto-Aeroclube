<?php
include("../conexao.php");
//Buscando os registros de alunos
$buscaAluno = $conexao->query("SELECT * FROM alunos ORDER BY nomeAluno ASC");
//Exibir os Registro de Alunos
$exibirAlunos = $buscaAluno->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $aluno = $_POST["nomeAluno"];

    $novoAluno = $conexao->prepare("INSERT INTO alunos (nomeAluno) VALUE (?)");

    $novoAluno->execute([$aluno]);

    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Academy Maverick - Novo Registro de Aluno</title>
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
    <div class="container my-4">
        <h1 class="mb-4">Controle de registro de alunos</h1>
        <!--Botão de inclusão -->
        <a href="inserirAluno.php" class="btn btn-success mb-3">Novo Registro de Aluno</a>

        <!--Tabela de dados-->
        <table class="table table-sucess table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Aluno</th>
                    <th>Status</th>
                </tr>
            </thead>
            <?php foreach ($exibirAlunos as $aluno): ?>
                <tr>
                    <td><?php echo htmlspecialchars($aluno['idAluno']) ?></td>
                    <td><?php echo htmlspecialchars($aluno['nomeAluno']) ?></td>
                    <td><?php echo htmlspecialchars($aluno['statusAluno']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <a href="../index.php" class="btn btn-secondary">Voltar</a>
    </div>
</body>

</html>