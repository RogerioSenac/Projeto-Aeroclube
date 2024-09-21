<?php
include("../conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../Assets/CSS/estilo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Escola Aviação Maverick</title>
  
</head>

<body>
    <div class="navbar_menu">
        <img src="../Assets/images/aeronaves/logo.png" alt="Logo">
    </div>
    <div class="etiqueta">
        <h1>Registro de Novas Formações</h1>
    </div>
    <div class="container">
        <form method="POST">
            <div class="mb-3">
                <label form="nomeFormacao" class="form-label">Nova Formação</label>
                <input type="text" class="form-control" id="nomeFormacao" name="nomeFormacao" required>
            </div>
            <div class="mb-4">
                <button type="submit" class="btn btn-success">Gravar</button>
                <a href="DashFormacao.php" class="btn btn-secondary">Voltar</a>
            </div>
        </form>
    </div>
</body>

</html>