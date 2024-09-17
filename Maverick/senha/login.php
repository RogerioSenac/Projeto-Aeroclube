<?php
// login.php
include '../conexao.php';
session_start(); // Inicia a sessão

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['usuario'];
    $senhaUsuario = $_POST['senhaUsuario'];
    
    // Chama a função loginUsuario
    $user = loginUsuario($username, $senhaUsuario);
    
    if (!$user) {
        // Login bem-sucedido: cria a sessão do usuário
        $_SESSION['usuario'] = $user['usuario']; // Armazena o nome do usuário na sessão
        
        // Redireciona para o painel ou outra página
        header("Location: ../menu.php"); // Supondo que você tenha um index.php ou painel
        exit;
    } else {
        // Falha no login: redireciona de volta para a página de login com uma mensagem de erro
        header("Location: DashAcesso.php?error=invalid_credentials");
        exit;
    }
}

function loginUsuario($username, $password)
{
    global $conexao;

    // Prepara a consulta para buscar o usuário pelo nome de usuário
    $stmt = $conexao->prepare("SELECT usuario, senhaUsuario FROM acesso WHERE usuario = :usuario");
    $stmt->bindParam(':usuario', $username);
    $stmt->execute();

    // Busca o resultado
    $user = $stmt->fetch(PDO::FETCH_ASSOC);   

    // Verifica se o usuário foi encontrado e se a senha está correta
    if ($user && password_verify($password, $user['senhaUsuario'])) {
        // Login bem-sucedido
        return $user;
    } else {
        // Falha no login
        return false;
    }
}
?>
