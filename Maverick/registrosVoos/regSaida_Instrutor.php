<?php
include("../conexao.php");
date_default_timezone_set('America/Sao_Paulo');

// Buscar registro

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dsaida = date('Y-m-d');
    $hsaida = date('H:i:s');
    $aluno = $_GET["id"];
    $instr = $_POST["idInstr"];

    $novoRegistro = $conexao->prepare("INSERT INTO registros_voos (idAluno, idInstr, dataSaida, horaSaida) VALUES (?, ?, ?, ?)");
    $novoRegistro->execute([$aluno, $instr, $dsaida, $hsaida]);

    header('Location: regSaida_Aluno.php');
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../Assets/CSS/estiloAluno.css">
    <title>ACADEMY MAVERICK - Controle de Registro de Planos de Voo</title>
</head>

<body>
    <div class="navbar_menu">
        <img src="../Assets/images/aeronaves/logo.png" alt="Logo">
    </div>

    <div class="container my-4">
        <h1 class="mb-4">Controle de Novo Registro de Voo</h1>
        <form method="POST">
            <div class="form-label mb-3">
                <p><strong>ID Aluno: </strong><?php echo htmlspecialchars($_GET['id']); ?></p>
            </div>
            <div class="reg-inst mb-3">
                <label for="idInstr" class="form-label">Selecionar Instrutor</label>
                <select class="form-select" id="idInstr" name="idInstr" required>
                    <option value="">Escolha um instrutor</option>
                    <?php
                    // Buscar instrutores do banco de dados
                    $buscarInstrutores = $conexao->query("SELECT idInstr, nomeInstr FROM instrutores");
                    while ($instrutor = $buscarInstrutores->fetch(PDO::FETCH_ASSOC)): ?>
                        <option value="<?= htmlspecialchars($instrutor['idInstr']); ?>">
                            <?= htmlspecialchars($instrutor['nomeInstr']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Gravar</button>
                <a href="regSaida_Aluno.php" class="btn btn-secondary">Voltar</a>
            </div>
        </form>
    </div>

</body>

</html>
