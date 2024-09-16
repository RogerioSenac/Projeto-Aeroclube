<?php
include("../conexao.php");

$email = $_POST['email'];
$senha = $_POST['senha'];
$nome = $_POST['nomeCompleto'];
$usuario = $_POST['usuario'];

$cadUser = $conexao->prepare ("INSERT INTo acesso (emailUsuario, senhaUsuario, nomeUsuario,usuario) VALUES (?,?,?,?)");
$cadUser->execute([$email, $senha, $nome, $usuario]);
header("Location: DashAcesso.php");


?>