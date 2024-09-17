<?php 
include('conexao.php');
session_start(); // Inicia a sessão para usar variáveis de sessão

// Verifica se o usuário está logado
if (isset($_SESSION['usuario'])) {
    header('Location: ../senha/DashAcesso.php'); // Redireciona para a página de login se não estiver logado
    exit();
}

$usuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./Assets/CSS/estilo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Escola Aviação Maverick</title>
</head>

<body>
    <div class="navbar_menu">
        <img src="Assets/images/aeronaves/logo.png" alt="Logo">
    </div>
    <div class="container my-4">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center">
                    <span>Bem-vindo, <?php echo htmlspecialchars($usuario); ?>!</span>
                    <a href="logout.php" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Card 1 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img class="card-img-top" src="Assets/images/aeronaves/aviao1.jpg">
                    <div class="card-body">
                        <h1 class="card-text">Controle de Alunos da Academia.</h1>
                        <a href="alunos/DashAluno.php" class="btn btn-primary">Acessar</a>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img class="card-img-top" src="Assets/images/aeronaves/aviao1.jpg">
                    <div class="card-body">
                        <h1 class="card-text">Controle de Instrutores da academia.</h1>
                        <a href="instrutores/DashInstrutor.php" class="btn btn-primary">Acessar</a>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img class="card-img-top" src="Assets/images/aeronaves/aviao1.jpg">
                    <div class="card-body">
                        <h1 class="card-text">Controle dos Registros de Voos.</h1>
                        <a href="registrosVoos/DashRegistro.php" class="btn btn-primary">Acessar</a>
                    </div>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img class="card-img-top" src="Assets/images/aeronaves/aviao1.jpg">
                    <div class="card-body">
                        <h1 class="card-text">Controle dos Pareceres de Voos.</h1>
                        <a href="pareceres/DashParecer.php" class="btn btn-primary">Acessar</a>
                    </div>
                </div>
            </div>

            <!-- Card 5 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img class="card-img-top" src="Assets/images/aeronaves/aviao1.jpg">
                    <div class="card-body">
                        <h1 class="card-text">Adicione novas formações.</h1>
                        <a href="formacaoadd/DashFormacao.php" class="btn btn-primary">Acessar</a>
                    </div>
                </div>
            </div>

            <!-- Card 6 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img class="card-img-top" src="Assets/images/aeronaves/aviao1.jpg">
                    <div class="card-body">
                        <h1 class="card-text">Gerencie os novos breves.</h1>
                        <a href="breves/DashBreve.php" class="btn btn-primary">Acessar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-..." crossorigin="anonymous"></script>
</body>

</html>
