<?php
include("../conexao.php");

$id = $_GET['id'];

$excluir=$conexao->prepare("DELETE FROM formacoes_adicionais WHERE idFormAdd=?");
$excluir->execute([$id]);

header('Location: DashFormacao.php')
?>