<?php
include("../conexao.php");

$id = $_GET['id'];

$buscarAluno = $conexao->prepare("SELECT * FROM alunos WHERE idAluno=?");
$buscarAluno->execute([$id]);
$aluno = $buscarAluno->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $aluno = $_POST['nomeAluno'];
    $dtNasc = $_POST['dataNasc'];
    $rua = $_POST['ruaAluno'];
    $bairro = $_POST['bairroAluno'];
    $cidade = $_POST['cityAluno'];
    $estado = $_POST['estadoAluno'];
    $cep = $_POST['cepAluno'];
    $fone = $_POST['foneAluno'];
    $email = $_POST['emailAluno'];
    $status = $_POST['statusAluno'];

    $atualizar = $conexao->prepare("UPDATE alunos SET nomeAluno=?, dataNasc=?, ruaAluno=?, bairroAluno=?, cityAluno=?, estadoAluno=?, cepAluno=?, foneAluno=?, emailAluno=?, statusAluno=? WHERE idAluno=?");
    $atualizar->execute([$aluno, $dtNasc, $rua, $bairro, $cidade, $estado, $cep, $fone, $email, $status, $id]);

    header('Location: DashAluno.php');
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
    <link rel="stylesheet" href="../Assets/css/estiloAtualizar.css">
    <title>Academy Maverick - Atualização de Registro</title>
    <!-- <style>
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px; /* Espaço entre as linhas */
        }
        .info-col {
            flex: 1; /* Cada coluna ocupa espaço igual */
            margin-right: 2px; /* Espaçamento entre os campos */
        }
        .info-col:last-child {
            margin-right: 0; /* Remove margem do último campo na linha */
        }
    </style> -->
</head>

<body>
    <div class="navbar_menu">
        <img src="..\Assets\images\aeronaves\logo.png" alt="Logo ">
    </div>
    <div class="container my-4">
        <h1 class="mb-4">Atualização de Registro do Aluno</h1>
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
                            value="<?php echo htmlspecialchars($aluno['nomeAluno']); ?>" required>
                    </div>
                    <div class="col col-lg-2">
                        <label for="dataNasc" class="form-label">Dt Nascimento</label>
                        <input type="text" class="form-control" id="dataNasc" name="dataNasc"
                            value="<?php echo htmlspecialchars($aluno['dataNasc']); ?>" required>
                    </div>
                    <div class="col col-lg-6">
                        <label for="ruaAluno" class="form-label">Endereço</label>
                        <input type="text" class="form-control" id="ruaAluno" name="ruaAluno"
                            value="<?php echo htmlspecialchars($aluno['ruaAluno']); ?>" required>
                    </div>
                    <div class="col col-lg-6">
                        <label for="bairroAluno" class="form-label">Bairro</label>
                        <input type="text" class="form-control" id="bairroAluno" name="bairroAluno"
                            value="<?php echo htmlspecialchars($aluno['bairroAluno']); ?>" required>
                    </div>
                    <div class="col col-lg-4">
                        <label for="cityAluno" class="form-label">Cidade</label>
                        <input type="text" class="form-control" id="cityAluno" name="cityAluno"
                            value="<?php echo htmlspecialchars($aluno['cityAluno']); ?>" required>
                    </div>
                    <div class="col col-lg-4">
                        <label for="estadoAluno" class="form-label">Estado</label>
                        <input type="text" class="form-control" id="estadoAluno" name="estadoAluno"
                            value="<?php echo htmlspecialchars($aluno['estadoAluno']); ?>" required>
                    </div>
                    <div class="col col-lg-4">
                        <label for="cepAluno" class="form-label">CEP</label>
                        <input type="text" class="form-control" id="cepAluno" name="cepAluno"
                            value="<?php echo htmlspecialchars($aluno['cepAluno']); ?>" required>
                    </div>

                    <div class="col col-lg-2">
                        <label for="foneAluno" class="form-label">Telefone</label>
                        <input type="text" class="form-control" id="foneAluno" name="foneAluno"
                        value="<?php echo htmlspecialchars($aluno['foneAluno']); ?>" required>
                    </div>
                    <div class="col col-lg-8">
                        <label for="emailAluno" class="form-label">Email</label>
                        <input type="text" class="form-control" id="emailAluno" name="emailAluno"
                        value="<?php echo htmlspecialchars($aluno['emailAluno']); ?>" required>
                    </div>
                    <div class="col col-lg-2">
                        <label for="statusAluno" class="form-label">Status</label>
                        <select class="form-select" id="statusAluno" name="statusAluno" required>
                            <option value="Cursando" <?php echo $aluno['statusAluno'] == 'Cursando' ? 'selected' :  ''; ?>>
                            Cursando
                            </option>
                            <option value="Concluido" <?php echo $aluno['statusAluno'] == 'Concluido' ? 'selected' : ''; ?>>
                            Concluído
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </form>
        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="DashAluno.php" class="btn btn-secondary">Voltar</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-..."
        crossorigin="anonymous"></script>
</body>

</html>