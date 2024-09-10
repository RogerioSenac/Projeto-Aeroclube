<?php
include("../conexao.php");

$id = $_GET['id'];

$buscarBreve = $conexao->query("SELECT breves_emitidos.idBreve, alunos.nomeAluno, breves_emitidos.numBreve from breves_emitidos inner join alunos ON breves_emitidos.idAluno=alunos.idAluno");

$buscarBreve->execute([$id]);

$breve = $buscarBreve->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>ACADEMY MAVERICK - Consulta de dados do Registro de Breves</title>
</head>

<body>
    <div class="container">
        <h1 class="my-4">Consulta de dados do Registro de Alunos</h1>
        <p><strong>Nome: </strong><?php echo htmlspecialchars($breve['nomeAluno']) ?></p>
        <p><strong>Breve: </strong><?php echo htmlspecialchars($breve['numBreve']) ?></p>
        
        <a href="cadastro.php"class="btn btn-secondary">Voltar</a>
    </div>
</body>

</html>