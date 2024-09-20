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
    <link rel="stylesheet" href="../Assets/CSS/estiloAluno.css">
    <title>Escola Aviação Maverick</title>
</head>

<body>
    <div class="navbar_menu">
        <img src="..\Assets\images\aeronaves\logo.png" alt="Logo ">
    </div>
    <div class="container my-4">
        <h1>Controle de Registro de Planos de Voo</h1>
        <div class="row">
            <!-- Card 1 -->
            <div class="col-md-4 mb-4">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fa-xl fa-solid fa-solid fa-plane-departure"></i>
                        <h5 class="card-title">Saída</h5>
                        <p class="card-text">Registre as saídas dos voos.</p>
                        <a href="regSaida_Aluno.php" class="btn btn-primary">Acessar</a>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-md-4 mb-4">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fa-xl fa-solid fa-plane-arrival"></i>
                        <h5 class="card-title">Retorno</h5>
                        <p class="card-text">Registre os retornos dos voos.</p>
                        <a href="lista_voo_abertos.php" class="btn btn-primary">Acessar</a>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-md-4 mb-4">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fa-xl fa-solid fa-plane-slash"></i>
                        <h5 class="card-title">Cancelamentos</h5>
                        <p class="card-text">Cancelamento de registros de voos.</p>
                        <a href="cancelamento.php" class="btn btn-danger">Acessar</a>
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