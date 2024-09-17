<?php
include("../conexao.php");

//Buscando os registros de instrutores
$buscaInstr = $conexao->query("SELECT * FROM instrutores WHERE statusInstr = '1' ORDER BY nomeInstr ASC");

//Exibir os Registro de Alunos
$exibirInstr = $buscaInstr->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $instrutor = $_POST["nomeInstr"];

    $novoInstr = $conexao->prepare("INSERT INTO instrutores (nomeInstr) VALUE (?)");

    $novoInstr->execute([$instrutor]);

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
    <title>Academy Maverick - Registro de Instrutores</title>
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
        <h1 class="my-4">Consulta aos registros de instrutores</h1>
        
        <!--Tabela de dados-->
        <table class="table table-sucess table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Instrutor</th>
                </tr>
            </thead>
            <?php foreach ($exibirInstr as $instrutor): ?>
                <tr>
                    <td><?php echo htmlspecialchars($instrutor['idInstr']) ?></td>
                    <td><?php echo htmlspecialchars($instrutor['nomeInstr']) ?></td>
                    <td>
                        <a href="visualizar.php?id=<?php echo $instrutor['idInstr']; ?>"
                            class="btn btn-info btn-sm">Visualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <a href="DashInstrutor.php" class="btn btn-secondary">Voltar</a>
    </div>
</body>

</html>