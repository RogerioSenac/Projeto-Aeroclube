<?php
// login.php
include '../conexao.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['usuario'];
    $password = $_POST['senhaUsuario'];

    // Chama a função loginUser
    $user = loginUser($username, $password);

    if ($user) {
        // Login bem-sucedido: redirecionar para o painel ou outra página
        header("Location: index.php"); // Supondo que você tenha um dashboard.php
        exit;
    } else {
        // Falha no login: redirecionar de volta para a página de login com uma mensagem de erro
        header("Location: DashAcesso.php?error=invalid_credentials");
        exit;
    }
}
function loginUser($username, $password)
{
    global $conexao;

    // Prepara a consulta para buscar o usuário pelo nome de usuário
    $stmt = $conexao->prepare("SELECT * FROM password WHERE nomeUsuario = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    // Busca o resultado
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    

    // Verifica se o usuário foi encontrado e se a senha está correta
    if ($user && password_verify($password, $user['password'])) {
        // Login bem-sucedido
        return $user;
    } else {
        // Falha no login
        return false;
    }
}
?>