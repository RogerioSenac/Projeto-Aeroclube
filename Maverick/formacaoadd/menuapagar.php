<?php
include("../conexao.php");
//busca os registros de formações
$buscarFormacao = $conexao->query("SELECT * FROM formacoes_adicionais ORDER BY nomeFormacao ASC");
//Exibir os Registros das formações
$exibirFormacao = $buscarFormacao->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formacao = $_POST["nomeFormacao"];

    $novaFormacao = $conexao->prepare("INSERT INTO formacoes_adicionais (nomeFormacao) VALUE (?)");

    $novaFormacao->execute([$formacao]);

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
    <title>Academy Maverick - Tipos de Formações</title>
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
        <h1 class="my-4">Cancelamento de Formação Adicional</h1>
        <!--Tabela de dados-->
        <table class="table table-sucess table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Formação</th>
                </tr>
            </thead>
            <?php foreach ($exibirFormacao as $formacao): ?>
                <tr>
                    <td><?php echo htmlspecialchars($formacao['idFormAdd']) ?></td>
                    <td><?php echo htmlspecialchars($formacao['nomeFormacao']) ?></td>
                    <td>
                        <a href="apagar.php?id=<?php echo $formacao['idFormAdd']; ?>" class="btn btn-danger btn-sm"
                            onclick="return confirm('Tem certeza que deseja deletar este registro ?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <a href="DashFormacao.php" class="btn btn-secondary">Voltar</a>
    </div>
</body>

</html>