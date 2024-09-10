<?php
include("../conexao.php");

$id = $_GET['id'];

$excluir=$conexao->prepare("DELETE FROM breves_emitidos WHERE idBreve=?");
$excluir->execute([$id]);

header('Location: DashBreve.php')
?>