<?php
include("../conexao.php");

// Definindo a quantidade de registros por página
$quantidadePorPagina = 10;
$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($paginaAtual - 1) * $quantidadePorPagina;

// Contar total de alunos com registros de voos
$totalRegistrosQuery = $conexao->prepare("
    SELECT COUNT(DISTINCT alunos.idAluno) FROM alunos
    INNER JOIN registros_voos ON alunos.idAluno = registros_voos.idAluno
    WHERE registros_voos.dataRetorno IS NOT NULL AND registros_voos.horaRetorno IS NOT NULL
");
$totalRegistrosQuery->execute();
$totalRegistros = $totalRegistrosQuery->fetchColumn();
$totalPaginas = ceil($totalRegistros / $quantidadePorPagina);

// Buscar alunos com registros de voos
$buscarAlunos = $conexao->prepare("
    SELECT DISTINCT alunos.idAluno, alunos.nomeAluno 
    FROM alunos
    INNER JOIN registros_voos ON alunos.idAluno = registros_voos.idAluno
    WHERE registros_voos.dataRetorno IS NOT NULL AND registros_voos.horaRetorno IS NOT NULL
    ORDER BY alunos.nomeAluno ASC
    LIMIT :limit OFFSET :offset
");

// Bind dos parâmetros, garantindo que são inteiros
$buscarAlunos->bindValue(':limit', (int)$quantidadePorPagina, PDO::PARAM_INT);
$buscarAlunos->bindValue(':offset', (int)$offset, PDO::PARAM_INT);

// Executando a consulta
$buscarAlunos->execute();

$exibirAlunos = $buscarAlunos->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../Assets/CSS/estilo.css">
    <title>Academy Maverick - Controle de Registros de Voos</title>
    <style>
        h1 {
            text-align: center;
            margin-bottom: 2rem;
            font-size: 2.5rem;
            font-weight: bold;
            color: #343a40;
        }
    </style>
</head>

<body>
    <div class="navbar_menu">
        <img src="../Assets/images/aeronaves/logo.png" alt="Logo">
    </div>
    <div class="mensagem">
        <h1>Registro de Históricos de Pareceres de Voos dos Alunos</h1>
    </div>
    <div class="container">
        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Aluno</th>
                    <th>Acessos</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($exibirAlunos as $aluno): ?>
                    <tr>
                        <td>
                            <?php if (!empty($instr['fotoInstr']) && file_exists('../Assets/images/' . basename($aluno['fotoAluno']))): ?>
                                <img src="../Assets/images/instrutores<?= htmlspecialchars(basename($aluno['fotoInstr'])); ?>"
                                    alt="Foto do Instrutor" class="foto-aluno">
                            <?php else: ?>
                                <span>N/A</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($aluno['nomeAluno']); ?></td>
                        <td>
                            <a href="visualizar.php?id=<?php echo $aluno['idAluno']; ?>" class="btn btn-primary btn-sm">Visualizar</a>
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
            </ul>
            <div class="botao">
                <a href="Dashparecer.php" class="btn btn-secondary">Voltar</a>
            </div>
        </nav>

    </div>
</body>

</html>