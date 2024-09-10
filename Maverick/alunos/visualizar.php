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
    <title>ACADEMY MAVERICK - Consulta de dados do Registro de Alunos</title>
    <style>
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
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="my-4">Consulta de dados do Registro de Alunos</h1>
            </div>
            <div class="card mb-4">
                <div class="card-profile">
                    <?php if (!empty($aluno['fotoAluno']) && file_exists('../Assets/images/' . basename($aluno['fotoAluno']))): ?>
                        <img class="imgPerfil"
                            src="../Assets/images/<?= htmlspecialchars(basename($aluno['fotoAluno'])); ?>"
                            alt="Foto do Aluno">
                    <?php else: ?>
                        <img src="../Assets/images/default-avatar.png" alt="Foto do Aluno">
                    <?php endif; ?>
                </div>
                <div class="card-body card-info">
                    <div class="info-row">
                        <div class="info-col-id">
                            <p><strong>ID:</strong> <?= htmlspecialchars($aluno['idAluno']); ?>
                            </p>
                        </div>
                        <div class="info-col-nome">
                            <p><strong><?= htmlspecialchars($aluno['nomeAluno']); ?></strong></p>
                        </div>
                        <div class="info-col-idade">
                            <p><strong>Data Nascimento:</strong><?= htmlspecialchars($aluno['dataNasc']); ?>
                            </p>
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="info-col">
                            <p><strong>Endereço: </strong><?= htmlspecialchars($aluno['ruaAluno']) ?></p>
                        </div>
                        <div class="info-col">
                            <p><strong>Bairro: </strong><?= htmlspecialchars($aluno['bairroAluno']) ?></p>
                        </div>

                    </div>
                    <div class="info-row">
                        <div class="info-col">
                            <p><strong>Cidade: </strong><?= htmlspecialchars($aluno['cityAluno']) ?></p>
                        </div>
                        <div class="info-col">
                            <p><strong>Estado: </strong><?= htmlspecialchars($aluno['estadoAluno']) ?></p>
                        </div>
                        <div class="info-col">
                            <p><strong>CEP: </strong><?= htmlspecialchars($aluno['cepAluno']) ?></p>
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="info-col">
                            <p><strong>Fone: </strong><?= htmlspecialchars($aluno['foneAluno']) ?></p>
                        </div>
                        <div class="info-col">
                            <p><strong>Email :</strong><?= htmlspecialchars($aluno['emailAluno']) ?></p>
                        </div>

                    </div>

                    <div class="info-row">
                        <div class="info-col">
                            <p><strong>Status:</strong> <?= htmlspecialchars($aluno['statusAluno']) ?></p>
                        </div>
                        <div class="info-col">
                            <p><strong>Data Matricula:</strong> <?= htmlspecialchars($aluno['data_matricula']) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="DashAluno.php" class="btn btn-secondary">Voltar</a>
    </div>
</body>

</html>