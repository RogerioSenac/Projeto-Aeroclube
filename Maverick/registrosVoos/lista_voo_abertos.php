<?php
include("../conexao.php");

// Buscar registros de alunos
$buscaAlunos = $conexao->query("SELECT alunos.idAluno, alunos.nomeAluno FROM registros_voos
INNER JOIN alunos ON registros_voos.idAluno = alunos.idAluno
WHERE registros_voos.horaRetorno IS NULL ORDER BY alunos.nomeAluno ASC");

// Exibir registros de alunos
$exibirAlunos = $buscaAlunos->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $aluno = $_POST["nomeAluno"];

    $novoAluno = $conexao->prepare("INSERT INTO alunos (nomeAluno) VALUE (?)");
    $novoAluno->execute([$aluno]);

    header('Location: menu.php');
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
    <title>Academy Maverick - Controle de Registros de Voo</title>
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
        <h1 class="mb-4">Controle de registro de retorno e pareceres de voo</h1>

        <!-- Tabela de registros de alunos -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Registros de Alunos</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($exibirAlunos as $aluno): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($aluno['idAluno']); ?></td>
                                <td><?php echo htmlspecialchars($aluno['nomeAluno']); ?></td>
                                <td>
                                    <!-- <a href="rsaida.php?id=<?php echo $aluno['idAluno']; ?>" class="btn btn-info btn-sm">Saída</a> -->
                                    <a href="retorno.php?id=<?php echo $aluno['idAluno']; ?>"
                                        class="btn btn-warning btn-sm">Retorno</a>
                                    <!-- <a href="apagar.php?id=<?php echo $aluno['idAluno']; ?>" class="btn btn-danger btn-sm"
                                       onclick="return confirm('Tem certeza que deseja deletar este registro?')">Excluir</a> -->
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <a href="DashRegistro.php" class="btn btn-secondary">Voltar</a>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-..."></script>
</body>

</html>