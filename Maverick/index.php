<h1?php include('conexao.php'); ?>

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
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Aero Clube Senac</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../index.php">Início</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Sobre</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contato</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="navbar_menu">
            <!-- <img class="d-block w-100" src="Assets\images\aeronaves\fundo aviao 1.jpg" alt="Logo "> -->
            <img src="Assets\images\aeronaves\logo.png" alt="Logo ">
        </div>
        <div class="container my-4">
            <!-- <h1 class="academy">Academy Maverick - TOP GUN</h1> -->
            <div class="row">
                <!-- Card 1 -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img class="card-img-top" src="Assets\images\aeronaves\aviao1.jpg">
                        <div class="card-body">
                            <!-- <i class="fa-xs fa-xs fas fa-user-graduate card-icon"></i>
                        <h5 class="card-title">Alunos</h5> -->
                            <h1 class="card-text">Controle de Alunos da Academia.</h1>
                            <a href="alunos/DashAluno.php" class="btn btn-primary">Acessar</a>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img class="card-img-top" src="Assets\images\aeronaves\aviao1.jpg">
                        <div class="card-body">
                            <!-- <i class="fa-xs fas fa-user-graduate card-icon"></i>
                        <h5 class="card-title">Instrutores</h5> -->
                            <h1 class="card-text">Controle de Instrutores da academia.</h1>
                            <a href="alunos/DashAluno.php" class="btn btn-primary">Acessar</a>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img class="card-img-top" src="Assets\images\aeronaves\aviao1.jpg">
                        <div class="card-body">
                            <!-- <i class="fa-xs fas fa-user-graduate card-icon"></i>
                        <h5 class="card-title">Registros de Voos</h5> -->
                            <h1 class="card-text">Controle dos Registros de Voos.</h1>
                            <a href="alunos/DashAluno.php" class="btn btn-primary">Acessar</a>
                        </div>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img class="card-img-top" src="Assets\images\aeronaves\aviao1.jpg">
                        <div class="card-body">
                            <!-- <i class="fa-xs fas fa-user-graduate card-icon"></i>
                        <h5 class="card-title">Pareceres de Voos</h5> -->
                            <h1 class="card-text">Controle dos Pareceres de Voos.</h1>
                            <a href="alunos/DashAluno.php" class="btn btn-primary">Acessar</a>
                        </div>
                    </div>
                </div>

                <!-- Card 5 -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img class="card-img-top" src="Assets\images\aeronaves\aviao1.jpg">
                        <div class="card-body">
                            <!-- <i class="fa-xs fas fa-user-graduate card-icon"></i>
                        <h5 class="card-title">Novas Formações</h5> -->
                            <h1 class="card-text">Adicione novas formações.</h1>
                            <a href="alunos/DashAluno.php" class="btn btn-primary">Acessar</a>
                        </div>
                    </div>
                </div>

                <!-- Card 6 -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img class="card-img-top" src="Assets\images\aeronaves\aviao1.jpg">
                        <div class="card-body">
                            <!-- <i class="fa-xs fas fa-user-graduate card-icon"></i>
                        <h5 class="card-title">Novos Breves</h5> -->
                            <h1 class="card-text">Gerencie os novos breves.</h1>
                            <a href="alunos/DashAluno.php" class="btn btn-primary">Acessar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-..." crossorigin="anonymous"></script>
    </body>

    </html>