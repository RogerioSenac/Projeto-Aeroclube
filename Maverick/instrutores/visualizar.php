<?php
include("../conexao.php");

$id = $_GET['id'];

$buscarInstr = $conexao->prepare("SELECT * FROM instrutores WHERE idInstr=?");
$buscarInstr->execute([$id]);
$instr = $buscarInstr->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nome = $_POST['nomeInstr'];
    $nasc = $_POST['dataNascInstr'];
    $matricula = $_POST['matriculaInstr'];
    $breve = $_POST['breveInstr'];
    $rua = $_POST['endInstr'];
    $bairro = $_POST['bairroInstr'];
    $cidade = $_POST['cityInstr'];
    $estado = $_POST['estadoInstr'];
    $cep = $_POST['cepInstr'];
    $fone = $_POST['foneInstr'];
    $email = $_POST['emailInstr'];
    $status = $_POST['statusInstr'];


    $atualizar = $conexao->prepare("UPDATE instrutores SET nomeInstr=?, dataNascInstr=?, matriculaInstr=?, breveInstr=?, endInstr=?, bairroInstr=?, cityInstr=?, estadoInstr=?, cepInstr=?, foneInstr=?, emailInstr=?, statusInstr=? WHERE idInstr=?");

    $atualizar->execute([$nome, $nasc, $matricula, $breve, $rua, $bairro, $cidade, $estado, $cep, $fone, $email, $status, $id]);

    header('Location: DashInstrutor.php');
    exit(); // Adiciona exit para garantir que o script pare aqui
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../Assets/css/estilo.css">
    <title>Academy Maverick - Atualização de Registro</title>
</head>

<body>
    <div class="navbar_menu">
        <img src="../Assets/images/aeronaves/logo.png" alt="Logo ">
    </div>
    <div class="etiqueta">
        <h1>Atualização de Cadastro de Instrutor</h1>
    </div>
    <div class="container my-4">
        <div class="card-profile">
            <?php if (!empty($instr['fotoInstr']) && file_exists('../Assets/images/instrutores' . basename($instr['fotoInstr']))): ?>
                <img class="imgPerfil" src="../Assets/images/instrutores<?= htmlspecialchars(basename($instr['fotoInstr'])); ?>"
                    alt="Foto do Instrutor">
            <?php else: ?>
                <img src="../Assets/images/default-avatar.png" alt="Foto do Instrutor">
            <?php endif; ?>
        </div>
        <form method="POST" enctype="multipart/form-data">
            <div class="container text-center">
                <div class="row justify-content-md-center">
                    <div class="col col-lg-10">
                        <label for="nomeInstr" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nomeInstr" name="nomeInstr"
                            value="<?php echo htmlspecialchars($instr['nomeInstr']); ?>" readonly>
                    </div>
                    <div class="col col-lg-2">
                        <label for="dataNascInstr" class="form-label">Dt Nascimento</label>
                        <input type="date" class="form-control" id="dataNascInstr" name="dataNascInstr"
                            value="<?php echo htmlspecialchars($instr['dataNascInstr']); ?>" readonly>
                    </div>
                    <div class="col col-lg-4">
                        <label for="matriculaInstr" class="form-label">Matricula</label>
                        <input type="text" class="form-control" id="matriculaInstr" name="matriculaInstr"
                            value="<?php echo htmlspecialchars($instr['matriculaInstr']); ?>" readonly>
                    </div>
                    <div class="col col-lg-4">
                        <label for="breveInstr" class="form-label">Breve</label>
                        <input type="text" class="form-control" id="breveInstr" name="breveInstr"
                            value="<?php echo htmlspecialchars($instr['breveInstr']); ?>" readonly>
                    </div>
                    <div class="col col-lg-4">
                        <label for="statusInstr" class="form-label">Situação</label>
                        <select class="form-control" id="statusInstr" name="statusInstr" readonly>
                            <option value="Ativo" <?php echo $instr['statusInstr'] == 'Ativo' ? 'selected' : '' ?>>Ativo</option>
                            <option value="Inativo" <?php echo $instr['statusInstr'] == 'Inativo' ? 'selected' : '' ?>>Inativo</option>
                        </select>
                    </div>
                    <div class="col col-lg-6">
                        <label for="endInstr" class="form-label">Rua/Av.</label>
                        <input type="text" class="form-control" id="endInstr" name="endInstr"
                            value="<?php echo htmlspecialchars($instr['endInstr']); ?>" readonly>
                    </div>
                    <div class="col col-lg-6">
                        <label for="bairroInstr" class="form-label">Bairro</label>
                        <input type="text" class="form-control" id="bairroInstr" name="bairroInstr"
                            value="<?php echo htmlspecialchars($instr['bairroInstr']); ?>" readonly>
                    </div>
                    <div class="col col-lg-4">
                        <label for="cityInstr" class="form-label">Cidade</label>
                        <input type="text" class="form-control" id="cityInstr" name="cityInstr"
                            value="<?php echo htmlspecialchars($instr['cityInstr']); ?>" readonly>
                    </div>
                    <div class="col col-lg-4">
                        <label for="estadoInstr" class="form-label">Estado</label>
                        <input type="text" class="form-control" id="estadoInstr" name="estadoInstr"
                            value="<?php echo htmlspecialchars($instr['estadoInstr']); ?>" readonly>
                    </div>
                    <div class="col col-lg-4">
                        <label for="cepInstr" class="form-label">CEP</label>
                        <input type="text" class="form-control" id="cepInstr" name="cepInstr"
                            value="<?php echo htmlspecialchars($instr['cepInstr']); ?>" readonly>
                    </div>

                    <div class="col col-lg-4">
                        <label for="foneInstr" class="form-label">Telefone</label>
                        <input type="text" class="form-control" id="foneInstr" name="foneInstr"
                            value="<?php echo htmlspecialchars($instr['foneInstr']); ?>" readonly>
                    </div>
                    <div class="col col-lg-8">
                        <label for="emailInstr" class="form-label">Email</label>
                        <input type="email" class="form-control" id="emailInstr" name="emailInstr"
                            value="<?php echo htmlspecialchars($instr['emailInstr']); ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="text-center my-4">
                <a href="DashInstrutor.php" class="btn btn-secondary">Voltar</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-..."
        crossorigin="anonymous"></script>

</body>

</html>