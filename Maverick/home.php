<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academy Maverick - Home</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Academia Maverick</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contato</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary text-white ms-3" href="./login/logar.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Banner Principal -->
    <div class="container-fluid bg-primary text-white text-center py-5">
        <h1>Bem-vindo ao Aero Clube</h1>
        <p class="lead">Venha explorar os céus conosco! Oferecemos aulas de pilotagem, eventos e muito mais.</p>
        <a href="#" class="btn btn-light btn-lg">Saiba Mais</a>
    </div>

    <!-- Seção de Destaques -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <img src="https://plus.unsplash.com/premium_photo-1661964062531-dcbd3b63d1bd?q=80&w=2076&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="card-img-top" alt="Aulas de Pilotagem">
                    <div class="card-body">
                        <h5 class="card-title">Aulas de Pilotagem</h5>
                        <p class="card-text">Aprenda a voar com os melhores instrutores do país. Cursos para iniciantes e avançados.</p>
                        <a href="#" class="btn btn-primary">Ver Mais</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://images.unsplash.com/photo-1589042445387-f9099ff05f8e?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="card-img-top" alt="Eventos">
                    <div class="card-body">
                        <h5 class="card-title">Eventos</h5>
                        <p class="card-text">Participe dos nossos eventos exclusivos para membros e visitantes, com voos panorâmicos e mais.</p>
                        <a href="#" class="btn btn-primary">Ver Mais</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://images.unsplash.com/photo-1563540340459-16201ef69a8d?q=80&w=2071&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="card-img-top" alt="Associe-se">
                    <div class="card-body">
                        <h5 class="card-title">Associe-se</h5>
                        <p class="card-text">Torne-se um membro do nosso aeroclube e aproveite benefícios exclusivos e descontos.</p>
                        <a href="#" class="btn btn-primary">Ver Mais</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Rodapé -->
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; 2024 Aero Clube. Todos os direitos reservados.</p>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
