<?php
include("../conexa.php");
$id = $_GET['id'];

$buscarRegistro = $conexao->prepare("SELECT alunos.nomeAluno, breves_emitidos.numBreve, pareceres.parecer FROM breves_emitidos inner join registros_voos on breves_emitidos.idAluno=registros_voos.idAluno inner join alunos on breves_emitidos.idAluno=alunos.idAluno inner join pareceres on registros_voos.idRegVoo=pareceres.idRegVoo where alunos.idAluno=?");

$buscarRegistro->execute([$id]);

$registro = $buscarRegistro->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academy Maverick - Históricos dos Pareceres de Voo dos alunos</title>
</head>
<body>
    
</body>
</html>