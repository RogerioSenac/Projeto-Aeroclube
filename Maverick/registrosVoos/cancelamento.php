<?php
include("../conexao.php");

// Número de registros por página
$regPorPagina = 10;

// Obtenha o número da página atual a partir da URL (ou defina como 1 se não estiver definido)
$paginaAtual = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;

// Calcule o offset
$offset = ($paginaAtual - 1) * $regPorPagina;

// Contar o total de registros
$totalRegistrosQuery = $conexao->query("SELECT COUNT(*) as total FROM alunos");
$totalRegistros = $totalRegistrosQuery->fetch(PDO::FETCH_ASSOC)['total'];
$totalPaginas = ceil($totalRegistros / $regPorPagina);

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

    header('Location: DashRegistro.php');
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
    <link rel="stylesheet" href="../Assets/CSS/estiloAluno.css">
    <title>Academy Maverick - Controle de Registros de Voo</title>
</head>

<body>
    <div class="navbar_menu">
        <img src="../Assets/images/aeronaves/logo.png" alt="Logo">
    </div>
    <div class="container my-4">
        <h1 class="mb-4">Registro de Alunos</h1>

        <!-- Tabela de registros de alunos -->
        <div>
            <table class="table table-dark table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Foto</th>
                        <th>Aluno</th>
                        <th>Ação</th>
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
                            <td>
                                <a href="apagar.php?id=<?php echo $aluno['idAluno']; ?>" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Tem certeza que deseja deletar este registro?')">Excluir</a>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="text-center my-4">
            <a href="DashRegistro.php" class="btn btn-secondary">Voltar</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-..."></script>
</body>

</html>