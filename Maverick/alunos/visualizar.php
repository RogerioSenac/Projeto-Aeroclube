<?php
include("../conexao.php");

$id = $_GET['id'];

$buscarAluno = $conexao->prepare("SELECT * FROM alunos WHERE idAluno=?");
$buscarAluno->execute([$id]);
$aluno = $buscarAluno->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../Assets/css/estiloAtualizar.css">
    <title>ACADEMY MAVERICK - Consulta de dados do Registro de Alunos</title>
    <!-- <style>
        .card-profile {
            text-align: center;
            /* Centraliza o conteúdo dentro do card */
            padding: 2rem;
        }

        .card-profile img {
            max-width: 150px;
            /* Limita a largura máxima da imagem */
            max-height: 150px;
            /* Limita a altura máxima da imagem */
            border-radius: 50%;
            /* Cria um efeito circular para a imagem */
            object-fit: cover;
            /* Mantém a proporção da imagem e preenche o card */
            box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.7);
            /* Sombra leve para a imagem */
        }

        .imgPerfil {
            height: 150px;
            width: 150px;
        }

        .card {
            width: 850px;
            /* Define a largura do card */
            box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.7);
            /* Adiciona sombra ao card */
        }

        .card-body {
            padding-top: 0;
            /* Remove o padding superior padrão do card */
        }

        .card-info {
            margin-top: 1rem;
            /* Adiciona espaçamento entre a imagem e as informações */
        }

        .info-row {
            display: flex;
            flex-wrap: wrap;
            /* Permite que os itens se movam para a linha seguinte se não houver espaço */
            justify-content: space-between;
            /* Distribui o espaço entre os itens igualmente */
        }

        .info-col {
            flex: 1;
            /* Permite que as colunas ocupem o mesmo espaço */
            min-width: 0px;
            /* Define uma largura mínima para as colunas */
            margin: 0.5rem 0;
            /* Adiciona margem vertical entre as colunas */
        }

        .info-col p {
            margin: 0;
            /* Remove a margem dos parágrafos */
        }

        .info-col h4 {
            margin: 0;
            /* Remove a margem dos parágrafos */
        }

        .btn-secondary {
            margin-left: 1000px;
        }

        .my-4 {
            text-align: center;
            text-shadow: 3px 2px 2px rgba(0, 0, 0, 0.5);
        }

        .info-col-id {
            width: 50px;
            height: 30px;
        }

        .info-col-nome {
            position: absolute;
            margin-left: 60px;
            height: 30px;

        }

        .info-col-idade {
            position: absolute;
            margin-left: 395px;
            height: 30px;

        }
    </style> -->
</head>

<body>
    <div class="navbar_menu">
        <img src="..\Assets\images\aeronaves\logo.png" alt="Logo ">
    </div>
    <div class="container my-4">
        <h1 class="mb-4">Consulta de dados do Registro de Alunos</h1>
        <div class="card-profile">
            <?php if (!empty($aluno['fotoAluno']) && file_exists('../Assets/images/' . basename($aluno['fotoAluno']))): ?>
            <img class="imgPerfil" src="../Assets/images/<?= htmlspecialchars(basename($aluno['fotoAluno'])); ?>"
                alt="Foto do Aluno">
            <?php else: ?>
            <img src="../Assets/images/default-avatar.png" alt="Foto do Aluno">
            <?php endif; ?>
        </div>
        <form method="POST" enctype="multipart/form-data">
            <div class="container text-center">
                <div class="row justify-content-md-center">
                    <div class="col col-lg-10">
                        <label for="nomeAluno" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nomeAluno" name="nomeAluno"
                            value="<?php echo htmlspecialchars($aluno['nomeAluno']); ?>" readonly>
                    </div>
                    <div class="col col-lg-2">
                        <label for="dataNasc" class="form-label">Dt Nascimento</label>
                        <input type="text" class="form-control" id="dataNasc" name="dataNasc"
                            value="<?php echo htmlspecialchars($aluno['dataNasc']); ?>" readonly>
                    </div>
                    <div class="col col-lg-6">
                        <label for="ruaAluno" class="form-label">Endereço</label>
                        <input type="text" class="form-control" id="ruaAluno" name="ruaAluno"
                            value="<?php echo htmlspecialchars($aluno['ruaAluno']); ?>" readonly>
                    </div>
                    <div class="col col-lg-6">
                        <label for="bairroAluno" class="form-label">Bairro</label>
                        <input type="text" class="form-control" id="bairroAluno" name="bairroAluno"
                            value="<?php echo htmlspecialchars($aluno['bairroAluno']); ?>" readonly>
                    </div>
                    <div class="col col-lg-4">
                        <label for="cityAluno" class="form-label">Cidade</label>
                        <input type="text" class="form-control" id="cityAluno" name="cityAluno"
                            value="<?php echo htmlspecialchars($aluno['cityAluno']); ?>" readonly>
                    </div>
                    <div class="col col-lg-4">
                        <label for="estadoAluno" class="form-label">Estado</label>
                        <input type="text" class="form-control" id="estadoAluno" name="estadoAluno"
                            value="<?php echo htmlspecialchars($aluno['estadoAluno']); ?>" readonly>
                    </div>
                    <div class="col col-lg-4">
                        <label for="cepAluno" class="form-label">CEP</label>
                        <input type="text" class="form-control" id="cepAluno" name="cepAluno"
                            value="<?php echo htmlspecialchars($aluno['cepAluno']); ?>" readonly>
                    </div>

                    <div class="col col-lg-2">
                        <label for="foneAluno" class="form-label">Telefone</label>
                        <input type="text" class="form-control" id="foneAluno" name="foneAluno"
                            value="<?php echo htmlspecialchars($aluno['foneAluno']); ?>" readonly>
                    </div>
                    <div class="col col-lg-8">
                        <label for="emailAluno" class="form-label">Email</label>
                        <input type="text" class="form-control" id="emailAluno" name="emailAluno"
                            value="<?php echo htmlspecialchars($aluno['emailAluno']); ?>" readonly>
                    </div>
                    <div class="col col-lg-2">
                        <label for="statusAluno" class="form-label">Status</label>
                        <select class="form-select" id="statusAluno" name="statusAluno" readonly>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <a href="DashAluno.php" class="btn btn-secondary">Voltar</a>
</body>

</html>