<?php
include("../conexao.php");

//busca de registro


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["idAluno"];
    $breve = $_POST["numBreve"];

    $novoBreve = $conexao->prepare("INSERT INTO breves_emitidos (idAluno, numBreve) VALUE (?,?)");
    $novoBreve->execute([$nome, $breve]);

    header('Location: cadastro.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>ACADEMY MAVERICK - Novo Registro de Aluno</title>
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
        <h1 class="my-4">Novo Registro de Breve</h1>
        <form method="POST">
            <div class="mb-3">
                <label form="idAluno" class="form-label">ID Aluno</label>
                <input type="text" class="form-control" id="idAluno" name="idAluno" required>
            </div>
            <div class="mb-3">
                <label form="numBreve" class="form-label">Breve</label>
                <input type="text" class="form-control" id="numBreve" name="numBreve" required>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Gravar</button>
                <a href="DashBreve.php" class="btn btn-secondary">Voltar</a>
            </div>
        </form>
    </div>
</body>

</html>