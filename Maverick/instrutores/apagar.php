<?php
include("../conexao.php");

$id = $_GET['id'];

$excluir=$conexao->prepare("UPDATE instrutores SET statusInstr='0' WHERE idInstr=?");
$excluir->execute([$id]);

header('Location: DashInstrutor.php')
?>