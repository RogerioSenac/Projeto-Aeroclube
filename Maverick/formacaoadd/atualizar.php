<?php
include("../conexao.php");
$id = $_GET['id'];

$buscarFormacao = $conexao->prepare("SELECT * FROM formacoes_adicionais WHERE idFormAdd=?");
$buscarFormacao->execute([$id]);
$formacao = $buscarFormacao->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nome = $_POST['nomeFormacao'];

    $atualizar = $conexao->prepare("UPDATE formacoes_adicionais SET nomeFormacao=? WHERE idFormAdd=?");

    $atualizar->execute([$nome, $id]);

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
  
    <title>Academy Maverick - Atualizacao de Registro de Formacão</title>
</head>

<body>
    <div class="navbar_menu">
        <img src="../Assets/images/aeronaves/logo.png" alt="Logo">
    </div>
    <div class="etiqueta">
        <h1>Controle de Formações de Voos</h1>
    </div>
    <div class="container">
        
        <form method="POST">
            <div class="mb-3 input-label-wrapper">
                <label for="nomeFormacao" class="form-label">Formação</label>
                <input type="text" class="form-control input-custom-width" id="nomeFormacao" name="nomeFormacao" value="<?php echo htmlspecialchars($formacao['nomeFormacao']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Atualizar</button>
            <a href="DashFormacao.php" class="btn btn-secondary">Voltar</a>
        </form>
    </div>
</body>

</html>