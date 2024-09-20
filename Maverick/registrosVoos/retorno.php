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

// Verificar se o parâmetro 'id' está presente na URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Sanitize e validar o ID do aluno (assumindo que seja um número)
    $idAluno = filter_var($_GET['id'], FILTER_VALIDATE_INT);

    // Verificar se o ID é válido
    if ($idAluno !== false) {
        // Preparar e executar a consulta para obter os registros dos voos
        $buscaRsaidas = $conexao->prepare("SELECT registros_voos.idRegVoo, alunos.nomeAluno, alunos.fotoAluno, registros_voos.dataSaida, registros_voos.horaSaida FROM registros_voos
INNER JOIN alunos ON registros_voos.idAluno = alunos.idAluno
WHERE registros_voos.idAluno=?");
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
    <link rel="stylesheet" href="../Assets/CSS/estiloAluno.css">
    <title>Lista de Voos Abertos</title>
</head>

<body>
    <div class="navbar_menu">
        <img src="../Assets/images/aeronaves/logo.png" alt="Logo">
    </div>
    <div class="container my-4">
        <h1 class="my-4">Lista de voos em abertos do aluno</h1>
        <div class="card text-bg-secondary mb-3">
            <div class="card-body">
                <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                            <th>ID Voo</th>
                            <th>Foto</th>
                            <th>Nome</th>
                            <th>Data Saída</th>
                            <th>Hora Saída</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($exibirRsaidas as $saidas): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($saidas['idRegVoo']) ?></td>
                            <td>
                                <?php if (!empty($saidas['fotoAluno']) && file_exists('../Assets/images/' . basename($saidas['fotoAluno']))): ?>
                                <img src="../Assets/images/<?= htmlspecialchars(basename($saidas['fotoAluno'])); ?>"
                                     alt="Foto do Aluno" class="foto-aluno">
                                <?php else: ?>
                                <span>N/A</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo htmlspecialchars($saidas['nomeAluno']); ?></td>
                            <td><?php echo htmlspecialchars($saidas['dataSaida']) ?></td>
                            <td><?php echo htmlspecialchars($saidas['horaSaida']) ?></td>
                            <td>
                                <a href="finalizavoo.php?id=<?php echo $saidas['idRegVoo']; ?>"
                                   class="btn btn-warning btn-sm">Finalizar</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <a href="lista_voo_abertos.php" class="btn btn-secondary">Voltar</a>
            </div>
        </div>
    </div>
</body>

</html>
