<?php
include("../conexao.php");

if($_SERVER ["REQUEST_METHOD"] == "POST"){
    $formacao = $_POST['nomeFormacao'];

    $novaFormacao = $conexao->prepare("INSERT INTO formacoes_adicionais (nomeFormacao) VALUES (?)");
    $novaFormacao->execute([$formacao]);

    header('Location: DashFormacao.php');
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Academy Maverick - Novo Registro de Formação</title>
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
        <h1 class="my-4">Novo Registro de Formação</h1>
        <form method="POST">
            <div class="mb-3">
                <label form="nomeFormacao" class="form-label">Nova Formação</label>
                <input type="text" class="form-control" id="nomeFormacao" name="nomeFormacao" required>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Gravar</button>
                <a href="DashFormacao.php" class="btn btn-secondary">Voltar</a>
            </div>
        </form>
    </div>
</body>
</html>