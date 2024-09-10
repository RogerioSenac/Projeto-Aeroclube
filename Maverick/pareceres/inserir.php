<?php
include("../conexao.php");

//buscar Registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $parecer = $_POST["parecer"];
    $registro = $_POST["idRegVoo"];

    $novoParecer = $conexao->prepare("INSERT INTO pareceres (parecer, idRegVoo) VALUE (?,?)");
    $novoParecer->execute([$parecer, $registro]);

    header('Location: cadastro.php');
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>ACADEMY MAVERICK - Registro de Parecer</title>

</head>

<body>
    <div class="container">
        <h1 class="my-4">Novo Registro de Parecer</h1cla>
        <form method="POST">
            <div class="mb-3">
                <label form="parecer" class="form-label"></label>

            </div>

        </form>

    </div>

</body>

</html>