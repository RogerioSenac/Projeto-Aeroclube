<?php
include("../conexao.php");
$id = $_GET['id'];

$buscarInstr = $conexao->prepare("SELECT * FROM instrutores WHERE idInstr=?");
$buscarInstr->execute([$id]);
$instr = $buscarInstr->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nome = $_POST['nomeInstr'];
    $idade = $_POST['idadeInstr'];
    $matricula = $_POST['matriculaInstr'];
    $breve = $_POST['breveInstr'];
    $rua = $_POST['endInstr'];
    $bairro = $_POST['bairroInstr'];
    $cidade = $_POST['cityInstr'];
    $cep = $_POST['cepInstr'];
    $fone = $_POST['foneInstr'];
    $status = $_POST['statusInstr'];
    $data = $_POST['dt_adm_inst'];

    $atualizar = $conexao->prepare("UPDATE instrutores SET nomeInstr=?, idadeInstr=?, matriculaInstr=?, breveInstr=?, endInstr=?, bairroInstr=?, cityInstr=?, cepInstr=?, foneInstr=?, statusInstr=?, dt_adm_inst  WHERE idInstr=?");

    $atualizar->execute([$nome, $idade, $matricula, $breve, $rua, $bairro, $cidade, $cep, $fone, $status, $id]);

    header('Location: DashInstrutor.php');
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .input-label-wrapper {
            display: flex;
            align-items: center;
            /* Alinha verticalmente */
            gap: 10px;
            /* Espaçamento entre o input e a label */
        }

        .input-custom-width {
            width: auto;
            /* Define a largura do input como 20 pixels */
        }

        .form-label {
            margin: 0;
            /* Remove margens adicionais se necessário */
        }
    </style>
    <title>ACADEMY MAVERICK - Atualização de Registro</title>
</head>

<body>
    <DIV class="container">
        <h1 class="my-4">Academy Maverick - Atualização de Registro</h1>
        <form method="POST">
            <div class="mb-3 input-label-wrapper">
                <label for="nomeInstr" class="form-label">Instrutor</label>
                <input type="text" class="form-control input-custom-width" id="nomeInstr" name="nomeInstr"
                    value="<?php echo htmlspecialchars($instr['nomeInstr']); ?>" required>
            </div>

            <div class="mb-3 input-label-wrapper">
                <label for="idadeInstr" class="form-label">Idade</label>
                <input type="text" class="form-control input-custom-width" id="idadeInstr" name="idadeInstr"
                    value="<?php echo htmlspecialchars($instr['idadeInstr']); ?>" required>
            </div>
            <div class="mb-3 input-label-wrapper">
                <label for="matriculaInstr" class="form-label">Matricula</label>
                <input type="text" class="form-control input-custom-width" id="matriculaInstr" name="matriculaInstr"
                    value="<?php echo htmlspecialchars($instr['matriculaInstr']); ?>" required>
            </div>
            <div class="mb-3 input-label-wrapper">
                <label for="breveInstr" class="form-label">Breve</label>
                <input type="text" class="form-control input-custom-width" id="breveInstr" name="breveInstr"
                    value="<?php echo htmlspecialchars($instr['breveInstr']); ?>" required>
            </div>
            <div class="mb-3 input-label-wrapper">
                <label for="endInstr" class="form-label">Rua/Av.</label>
                <input type="text" class="form-control input-custom-width" id="endInstr" name="endInstr"
                    value="<?php echo htmlspecialchars($instr['endInstr']); ?>" required>
            </div>
            <div class="mb-3 input-label-wrapper">
                <label for="bairroInstr" class="form-label">Bairro</label>
                <input type="text" class="form-control input-custom-width" id="bairroInstr" name="bairroInstr"
                    value="<?php echo htmlspecialchars($instr['bairroInstr']); ?>" required>
            </div>
            <div class="mb-3 input-label-wrapper">
                <label for="cityInstr" class="form-label">Cidade</label>
                <input type="text" class="form-control input-custom-width" id="cityInstr" name="cityInstr"
                    value="<?php echo htmlspecialchars($instr['cityInstr']); ?>" required>
            </div>
            <div class="mb-3 input-label-wrapper">
                <label for="cepInstr" class="form-label">Cep</label>
                <input type="text" class="form-control input-custom-width" id="cepInstr" name="cepInstr"
                    value="<?php echo htmlspecialchars($instr['cepInstr']); ?>" required>
            </div>
            <div class="mb-3 input-label-wrapper">
                <label for="foneInstr" class="form-label">Fone</label>
                <input type="text" class="form-control input-custom-width" id="foneInstr" name="foneInstr"
                    value="<?php echo htmlspecialchars($instr['foneInstr']); ?>" required>
            </div>
            <div class="mb-3 input-label-wrapper">
                <label for="statusInstr" class="form-label">Status</label>
                <select class="form-control input-custom-width" id="statusInstr" name="statusInstr" required>
                    <option value="Ativo" <?php $instr['statusInstr'] == 'Ativo' ? 'selected' : '' ?>>Ativo</option>
                    <option value="Inativo" <?php $instr['statusInstr'] == 'Inativo' ? 'selected' : '' ?>>Inativo</option>
                </select>
            </div>
            <div class="mb-3 input-label-wrapper">
                <label for="dt_adm_inst" class="form-label">Data Admissão</label>
                <input type="text" class="form-control input-custom-width" id="dt_adm_inst" name="dt_adm_inst"
                    value="<?php echo htmlspecialchars($instr['dt_adm_inst']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Atualizar</button>
            <a href="cadastro.php" class="btn btn-secondary">Voltar</a>
        </form>
    </DIV>
</body>

</html>