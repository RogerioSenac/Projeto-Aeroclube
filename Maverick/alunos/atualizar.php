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
    $atualizar->execute([$aluno, $dtnasc, $rua, $bairro, $cidade, $estado, $cep, $fone, $email, $status, $id]);

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
    <!-- <style>
        .form-label {
            font-weight: bold;
            color: #343a40;
            /* Cor de destaque para a label */
        }

        .form-control,
        .form-select {
            border: none;
            box-shadow: none;
            border-bottom: 1px solid #ced4da;
            /* Apenas uma linha na parte inferior */
            border-radius: 0;
            padding: 0.375rem 0.75rem;
        }

        .form-control:focus,
        .form-select:focus {
            box-shadow: none;
            border-color: #80bdff;
            /* Cor de destaque ao focar */
            outline: 0;
        }

        .card {
            border: 1px solid #ced4da;
        }

        h5 {
            text-align: center;
            margin-bottom: 2rem;
            font-size: 2.5rem;
            font-weight: bold;
            color: #343a40;
            /* Cor escura para contraste */
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

        .btn-primary {
            margin-left: 1430px;
            margin-right: 0;
        }

        .btn-secondary {
            margin-left: 10px;
        }
    </style> -->
    <title>Academy Maverick - Atualização de Registro</title>
</head>

<body>
    <div class="navbar_menu">
        <img src="..\Assets\images\aeronaves\logo.png" alt="Logo ">
    </div>
    <div class="container my-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Atualização de Registro do Aluno</h5>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nomeAluno" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nomeAluno" name="nomeAluno"
                                value="<?php echo htmlspecialchars($aluno['nomeAluno']); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="dataNasc" class="form-label">Dt Nascimento</label>
                            <input type="text" class="form-control" id="dataNasc" name="dataNasc"
                                value="<?php echo htmlspecialchars($aluno['dataNasc']); ?>" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="ruaAluno" class="form-label">Endereço</label>
                            <input type="text" class="form-control" id="ruaAluno" name="ruaAluno"
                                value="<?php echo htmlspecialchars($aluno['ruaAluno']); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="bairroAluno" class="form-label">Bairro</label>
                            <input type="text" class="form-control" id="bairroAluno" name="bairroAluno"
                                value="<?php echo htmlspecialchars($aluno['bairroAluno']); ?>" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="cityAluno" class="form-label">Cidade</label>
                            <input type="text" class="form-control" id="cityAluno" name="cityAluno"
                                value="<?php echo htmlspecialchars($aluno['cityAluno']); ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label for="estadoAluno" class="form-label">Estado</label>
                            <input type="text" class="form-control" id="estadoAluno" name="estadoAluno"
                                value="<?php echo htmlspecialchars($aluno['estadoAluno']); ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label for="cepAluno" class="form-label">CEP</label>
                            <input type="text" class="form-control" id="cepAluno" name="cepAluno"
                                value="<?php echo htmlspecialchars($aluno['cepAluno']); ?>" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="foneAluno" class="form-label">Telefone</label>
                            <input type="text" class="form-control" id="foneAluno" name="foneAluno"
                                value="<?php echo htmlspecialchars($aluno['foneAluno']); ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label for="emailAluno" class="form-label">Email</label>
                            <input type="text" class="form-control" id="emailAluno" name="emailAluno"
                                value="<?php echo htmlspecialchars($aluno['emailAluno']); ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label for="statusAluno" class="form-label">Status</label>
                            <select class="form-select" id="statusAluno" name="statusAluno" required>
                                <option value="Cursando" <?php echo $aluno['statusAluno'] == 'Cursando' ? 'selected' : ''; ?>>Cursando</option>
                                <option value="Concluido" <?php echo $aluno['statusAluno'] == 'Concluido' ? 'selected' : ''; ?>>Concluído</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Atualizar</button>
    <a href="DashAluno.php" class="btn btn-secondary">Voltar</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-..."
        crossorigin="anonymous"></script>
</body>

</html>