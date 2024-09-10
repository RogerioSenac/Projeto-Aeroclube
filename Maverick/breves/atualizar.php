<?php
include("../conexao.php");
$id = $_GET['id'];

$buscarBreve = $conexao->prepare("SELECT * FROm breves_emitidos WHERE idBreve=?");
$buscarBreve->execute([$id]);
$busca = $buscarBreve->fetch(PDO::FETCH_ASSOC);

if($_SERVER['REQUEST_METHOD']== "POST") {
    $breve = $_POST['numBreve'];

    $atualizar = $conexao->prepare("UPDATE breves_emitidos SET numBreve=?");
    $atualizar->execute([$breve]);
    header('Location: DashBreve.php');
    exit();
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
        .input-label-wrapper {
            display: flex;
            align-items: center;
            /* Alinha verticalmente */
            gap: 10px;
            /* Espaçamento entre o input e a label */
        }

        .input-custom-width {
            width: auto;
            /* Define a largura do input como 20 pixels */
        }

        .form-label {
            margin: 0;
            /* Remove margens adicionais se necessário */
        }
    </style>
    <title>Academy Maverick - Atualizacao de Registro de Breve</title>
</head>

<body>
    <div class="container">
        <h1 class="my-4">Academy Maverick - Atualização de Registro de Breve</h1>
        <form method="POST">
            <div class="mb-3 input-label-wrapper">
                <label for="numBreve" class="form-label">Breve</label>
                <input type="text" class="form-control input-custom-width" id="numBreve" name="numBreve"
                    value="<?php echo htmlspecialchars($busca['numBreve']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Atualizar</button>
            <a href="DashBreve.php" class="btn btn-secondary">Voltar</a>
        </form>
    </div>
</body>

</html>