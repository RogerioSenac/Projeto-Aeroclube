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

// Buscar os registros de alunos com limite e offset
$buscaAluno = $conexao->prepare("SELECT alunos.idAluno, alunos.nomeAluno, alunos.fotoAluno, alunos.statusAluno FROM registros_voos
INNER JOIN alunos ON registros_voos.idAluno = alunos.idAluno
WHERE registros_voos.horaRetorno IS NULL
ORDER BY alunos.nomeAluno ASC LIMIT :limit OFFSET :offset");
$buscaAluno->bindValue(':limit', $regPorPagina, PDO::PARAM_INT);
$buscaAluno->bindValue(':offset', $offset, PDO::PARAM_INT);
$buscaAluno->execute();

// Exibir registros de alunos
$exibirAlunos = $buscaAluno->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $aluno = $_POST["nomeAluno"];

    // Aqui você pode sanitizar $aluno conforme necessário
    $novoAluno = $conexao->prepare("INSERT INTO alunos (nomeAluno) VALUES (?)");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Assets/CSS/estilo.css">
    <title>Academy Maverick - Controle de Registros de Voo</title>
</head>

<body>
    <div class="navbar_menu">
        <img src="../Assets/images/aeronaves/logo.png" alt="Logo">
    </div>

    <div class="etiqueta">
        <h1>Controle de registro de retorno e pareceres de voo</h1>
    </div>

    <div class="container my-4">

        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Foto</th>
                    <th>Nome</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($exibirAlunos as $aluno): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($aluno['idAluno']); ?></td>
                        <td>
                            <?php if (!empty($aluno['fotoAluno']) && file_exists('../Assets/images/' . basename($aluno['fotoAluno']))): ?>
                                <img src="../Assets/images/<?= htmlspecialchars(basename($aluno['fotoAluno'])); ?>"
                                    alt="Foto do Aluno" class="foto-aluno">
                            <?php else: ?>
                                <span>N/A</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($aluno['nomeAluno']); ?></td>
                        <td><?php echo htmlspecialchars($aluno['statusAluno']); ?></td>
                        <td>
                            <a href="retorno.php?id=<?php echo $aluno['idAluno']; ?>" class="btn btn-warning btn-sm">Retorno</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Controles de Navegação -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item <?= $paginaAtual <= 1 ? 'disabled' : '' ?>">
                    <a class="page-link" href="?pagina=<?= $paginaAtual - 1 ?>" aria-label="Previous">
                        <span aria-hidden="true">Anterior</span>
                    </a>
                </li>
                <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                    <li class="page-item <?= $i == $paginaAtual ? 'active' : '' ?>">
                        <a class="page-link" href="?pagina=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?= $paginaAtual >= $totalPaginas ? 'disabled' : '' ?>">
                    <a class="page-link" href="?pagina=<?= $paginaAtual + 1 ?>" aria-label="Next">
                        <span aria-hidden="true">Próximo</span>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="mb-4">
            <a href="DashRegistro.php" class="btn btn-secondary">Voltar</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>