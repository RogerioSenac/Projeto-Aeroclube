<?php
include("../conexao.php");

// Buscando os registros de alunos
$buscaAluno = $conexao->query("SELECT * FROM alunos ORDER BY nomeAluno ASC");
// Exibir os Registro de Alunos
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
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
          crossorigin="anonymous">
    <link rel="stylesheet" href="../Assets/CSS/estiloAluno.css">
    <title>Academy Maverick - Novo Registro de Alunos</title>
</head>

<body>

    <div class="container my-4">

        <div class="navbar_menu mb-4">
            <img src="../Assets/images/aeronaves/logo.png" alt="Logo">
        </div>

        <h1 class="mb-4 text-center">Lista de Registro de Alunos</h1>

        <!-- Tabela de dados -->
        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Foto</th>
                    <th>Aluno</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($exibirAlunos as $aluno): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($aluno['idAluno']) ?></td>
                        <td>
                            <?php if (!empty($aluno['fotoAluno']) && file_exists('../Assets/images/' . basename($aluno['fotoAluno']))): ?>
                                <img src="../Assets/images/<?= htmlspecialchars(basename($aluno['fotoAluno'])); ?>"
                                     alt="Foto do Aluno" class="foto-aluno">
                            <?php else: ?>
                                <span>N/A</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($aluno['nomeAluno']) ?></td>
                        <td><?php echo htmlspecialchars($aluno['statusAluno']) ?></td>
                        <td>
                            <a href="apagar.php?id=<?php echo $aluno['idAluno']; ?>" class="btn btn-danger btn-sm"
                                onclick="return confirm('Tem certeza que deseja deletar este registro?')">Excluir</a>
                            
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="DashAluno.php" class="btn btn-secondary">Voltar</a>
    </div>
</body>
</html>
