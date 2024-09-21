<?php
include("../conexao.php");

// Número de registros por página
$regPorPagina = 10;

// Obtenha o número da página atual a partir da URL (ou defina como 1 se não estiver definido)
$paginaAtual = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;

// Calcule o offset
$offset = ($paginaAtual - 1) * $regPorPagina;

// Contar o total de registros
$totalRegistrosQuery = $conexao->query("SELECT COUNT(*) as total FROM instrutores");
$totalRegistros = $totalRegistrosQuery->fetch(PDO::FETCH_ASSOC)['total'];
$totalPaginas = ceil($totalRegistros / $regPorPagina);

// Buscar os registros de instrutores com limite e offset
$buscaInstr = $conexao->prepare("SELECT * FROM instrutores ORDER BY nomeInstr ASC LIMIT :limit OFFSET :offset");
$buscaInstr->bindValue(':limit', $regPorPagina, PDO::PARAM_INT);
$buscaInstr->bindValue(':offset', $offset, PDO::PARAM_INT);
$buscaInstr->execute();

// Exibir os registros de instrutores
$exibirInstr = $buscaInstr->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $instr = $_POST["nomeInstr"];

    $novoInstr = $conexao->prepare("INSERT INTO instrutores (nomeInstr) VALUE (?)");
    $novoInstr->execute([$instr]);

    header('Location: menu.php');
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
    <title>Academy Maverick - Novo Registro de Instrutores</title>
</head>

<body>

    <div class="container my-4">

        <div class="navbar_menu">
            <img src="../Assets/images/aeronaves/logo.png" alt="Logo">
        </div>

        <h1 class="mb-4 text-center">Lista de Registro de Instrutores</h1>

        <!-- Tabela de dados -->
        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Foto</th>
                    <th>Instrutor</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($exibirInstr as $instr): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($instr['idInstr']) ?></td>
                        <td>
                            <?php if (!empty($instr['fotoInstr']) && file_exists('../Assets/images/' . basename($aluno['fotoAluno']))): ?>
                                <img src="../Assets/images/instrutores<?= htmlspecialchars(basename($aluno['fotoInstr'])); ?>"
                                    alt="Foto do Instrutor" class="foto-aluno">
                            <?php else: ?>
                                <span>N/A</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($instr['nomeInstr']) ?></td>
                        <td><?php echo htmlspecialchars($instr['statusInstr']) ?></td>
                        <td>
                            <a href="atualizar.php?id=<?php echo $instr['idInstr']; ?>"
                                class="btn btn-info btn-sm">Atualização</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Controles de Navegação -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item">

                </li>
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
                <a href="DashInstrutor.php" class="btn btn-secondary">Voltar</a>
            </ul>
        </nav>
    </div>
</body>

</html>