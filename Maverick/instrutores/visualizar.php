<?php
include("../conexao.php");

$id=$_GET['id'];

$buscarInstr=$conexao->prepare("SELECT * FROM instrutores WHERE idInstr=?");
$buscarInstr->execute([$id]);
$instr = $buscarInstr->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Academy Marverick - Consulta de dados de Registro de Instrutores</title>
</head>
<body>
    <div class="container">
        <h1 class="my-4">Consulta de dados do Registro de Instrutores</h1>
        <p><strong>Nome: </strong><?php echo htmlspecialchars($instr['nomeInstr']) ?></p>
        <p><strong>Idade: </strong><?php echo htmlspecialchars($instr['idadeInstr']) ?></p>
        <p><strong>Matricula: </strong><?php echo htmlspecialchars($instr['matriculaInstr']) ?></p>
        <p><strong>Breve: </strong><?php echo htmlspecialchars($instr['breveInstr']) ?></p>
        <p><strong>Rua/Av.: </strong><?php echo htmlspecialchars($instr['endInstr']) ?></p>
        <p><strong>Bairro: </strong><?php echo htmlspecialchars($instr['bairroInstr']) ?></p>
        <p><strong>Cidade: </strong><?php echo htmlspecialchars($instr['cityInstr']) ?></p>
        <p><strong>Cep: </strong><?php echo htmlspecialchars($instr['cepInstr']) ?></p>
        <p><strong>Fone: </strong><?php echo htmlspecialchars($instr['foneInstr']) ?></p>
        <p><strong>Status: </strong><?php echo htmlspecialchars($instr['statusInstr']) ?></p>
        <p><strong>Data Registro: </strong><?php echo htmlspecialchars($instr['dt_adm_inst']) ?></p>

        <a href="menuvisualizar.php"class="btn btn-secondary">Voltar</a>

    </div>
</body>
</html>