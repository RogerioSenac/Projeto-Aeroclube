<?php
include("../conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nomeUsuario'];
    $email = $_POST['emailUsuario'];
    $usuario = $_POST['usuario'];
    $senha = $_POST['senhaUsuario'];

    //Executar a consulta SQL para inserir os dados
    $novoRegistro = $conexao->prepare(query:'INSERT INTO password (nomeUsuario, emailUsuario, usuario, senhaUsuario) VALUES (:nome,:email,:usuario,:senha)');
    $novoRegistro->execute(params:[
        ':nome'=> $nome,
        'email'=> $email,
        'usuario'=> $usuario,
        'senha'=> $senha
    ]);
    
}
?>





<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aero Clube - Acesso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Assets/CSS/estiloSenha.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Aero Clube</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Início</a>
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

    <div class="container mt-5">
        <div class="text-center mb-5">
            <h1>Bem-vindo ao Aero Clube</h1>
            <p class="lead"><span class="alerta">A Vida </span>é feita de escolhas e nós....</p>
            <p class="lead">bem, nós escolhemos <span class="alerta">VOAR!</span></p>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- Verifica se há uma mensagem de erro -->
                <?php if (isset($_GET['error']) && $_GET['error'] == 'invalid_credentials'): ?>
                    <div class="alert alert-danger text-center" role="alert">
                        Usuário ou senha incorretos. Por favor, tente novamente.
                    </div>
                <?php endif; ?>

                <!-- Login Form -->
                <div id="loginForm">
                    <h2 class="text-center">Login</h2>
                    <form action="login.php" method="post">
                        <div class="mb-3">
                            <label for="Usuario" class="form-label">Usuário:</label>
                            <input type="text" id="usuario" name="usuario" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="senhaUsuario" class="form-label">Senha:</label>
                            <input type="password" id="senhaUsuario" name="senhaUsuario" class="form-control" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Logar</button>
                        </div>
                    </form>
                    <div class="text-center mt-3">
                        <a href="#" onclick="toggleForms()">Não tem uma conta? Cadastre-se</a>
                    </div>
                </div>

                <!-- Registration Form -->
                <div id="registrationForm" style="display:none;">
                    <h2 class="text-center">Cadastro</h2>
                    <form method="post">
                        <div class="mb-3">
                            <label for="nomeUsuario" class="form-label">Nome Completo:</label>
                            <input type="text" id="nomeUsuario" name="nomeUsuario" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="emailUsuario" class="form-label">Email:</label>
                            <input type="email" id="emailUsuario" name="emailUsuario" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="usuario" class="form-label">Usuário:</label>
                            <input type="text" id="usuario" name="usuario" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="senhaUsuario" class="form-label">Senha:</label>
                            <input type="password" id="senhaUsuario" name="senhaUsuario" class="form-control" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">Cadastrar</button>
                        </div>
                    </form>
                    <div class="text-center mt-3">
                        <a href="#" onclick="toggleForms()">Já tem uma conta? Logar</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleForms() {
            var loginForm = document.getElementById("loginForm");
            var registrationForm = document.getElementById("registrationForm");

            if (loginForm.style.display === "none") {
                loginForm.style.display = "block";
                registrationForm.style.display = "none";
            } else {
                loginForm.style.display = "none";
                registrationForm.style.display = "block";
            }
        }
    </script>
</body>
</html>

</body>
</html>