<?php
include("../conexao.php");

//busca de registro
$buscarBreve = $conexao->query("SELECT breves_emitidos.idBreve, alunos.nomeAluno, breves_emitidos.numBreve from breves_emitidos inner join alunos ON breves_emitidos.idAluno=alunos.idAluno");

//exibir os registros
$exibirBreve = $buscarBreve->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $breve = $_POST["numBreve"];
    $novoBreve = $conexao->prepare("INSERT INTO brevees_emitidos (numBreve) VALUE (?)");
    $novoBreve->execute(["$breve"]);
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
    <title>Academy Maverick - Novo Registro de Breve</title>
</head>
</head>

<body>
    <div class="container">
        <h1 class="my-4">Lista de Alunos com Breves Credenciados</h1>
        <!--Tabela de dados-->
        <table class="table table-sucess table striped">
            <theader>
                <tr>
                    <th>ID</th>
                    <th>Aluno</th>
                    <th>Breve</th>
                </tr>
            </theader>
            <?php foreach ($exibirBreve as $breve): ?>
                <tr>
                    <td><?php echo htmlspecialchars($breve['idBreve']) ?></td>
                    <td><?php echo htmlspecialchars($breve['nomeAluno']) ?></td>
                    <td><?php echo htmlspecialchars($breve['numBreve']) ?></td>
                    <td>
                        <!-- <a href="visualizar.php?id=<?php echo $breve['idBreve']; ?>" class="btn btn-info btn-sm">Visualizar</a> -->
                        <!-- <a href="atualizar.php?id=<?php echo $breve['idBreve']; ?>" class="btn btn-warning btn-sm">Atualizar</a> -->
                        <!-- <a href="apagar.php?id=<?php echo $breve['idBreve']; ?>" class="btn btn-danger btn-sm"
                            onclick="return confirm('Tem certeza que deseja deletar este registro?')">Excluir</a> -->
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <a href="DashBreve.php" class="btn btn-secondary">Voltar</a>
    </div>
</body>

</html>