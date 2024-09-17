<?php
include("../conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Escola Aviação Maverick</title>
    <style>
        .card {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .card-icon {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

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
    <div class="container my-4">
        <h1>Controle de Registro de Instrutores</h1>
        <div class="row">
            <!-- Card 1 -->
            <div class="col-md-3 mb-3">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fa-xl fa-solid fa-pen"></i>
                        <h5 class="card-title">Inclusão</h5>
                        <p class="card-text">Incluir registro.</p>
                        <a href="inserir.php" class="btn btn-primary">Acessar</a>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-md-3 mb-3">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fa-xl fa-solid fa-person-booth"></i>
                        <h5 class="card-title">Atualização</h5>
                        <p class="card-text">Atualizar registro.</p>
                        <a href="menuatualizar.php" class="btn btn-primary">Acessar</a>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-md-3 mb-3">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fa-xl fa-solid fa-street-view"></i>
                        <h5 class="card-title">Consulta</h5>
                        <p class="card-text">Consulta registros.</p>
                        <a href="menuvisualizar.php" class="btn btn-primary">Acessar</a>
                    </div>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="col-md-3 mb-3">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fa-xl fa-sharp fa-solid fa-user-slash"></i>
                        <h5 class="card-title">Cancelamentos</h5>
                        <p class="card-text">Cancelar registro.</p>
                        <a href="menuapagar.php" class="btn btn-danger">Acessar</a>
                    </div>
                </div>
            </div>
        </div>
        <a href="../menu.php" class="btn btn-secondary">Voltar</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-..."
        crossorigin="anonymous"></script>
</body>

</html>