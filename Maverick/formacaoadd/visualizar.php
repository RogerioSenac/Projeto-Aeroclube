<?php
include("../conexao.php");

$id=$_GET['id'];

$buscarFormacao = $conexao->prepare("SELECT * FROM formacoes_adicionais WHERE idFormAdd=?");
$buscarFormacao->execute([$id]);
$formacao = $buscarFormacao->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Academy Marverick - Consulta de Registro de Formações</title>
</head>
<body>
    <div class="container">
        <h1 class="my-4">Consulta de Registro de Formações</h1>
        <p><strong>Formação: </strong><?php echo htmlspecialchars($formacao['nomeFormacao']) ?></p>
        <a href="cadastro.php"class="btn btn-secondary">Voltar</a>
    </div>
</body>
</html>