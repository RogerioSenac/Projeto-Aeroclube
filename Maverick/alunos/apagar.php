<?php
include("../conexao.php");

$id=$_GET['id'];


$excluir= $conexao->prepare("DELETE FROM alunos WHERE idAluno=?");
$excluir->execute([$id]);

header('Location: dashAluno.php')

?>