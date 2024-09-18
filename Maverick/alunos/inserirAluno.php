<?php

include("../conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nomeAluno'];
    $dtNasc = $_POST['dataNasc'];
    $rua = $_POST['ruaAluno'];
    $bairro = $_POST['bairroAluno'];
    $cidade = $_POST['cityAluno'];
    $estado = $_POST['estadoAluno'];
    $cep = $_POST['cepAluno'];
    $fone = $_POST['foneAluno'];
    $email = $_POST['emailAluno'];
    $foto = $_FILES['fotoAluno']; // Use $_FILES para o upload de arquivos

    // Diretório onde a imagem será salva
    $diretorioImagem = '../Assets/images/alunos';
    $nomeImagem = basename($foto['name']);
    $caminhoImagem = $diretorioImagem . $nomeImagem;

    // Verifica se o upload foi bem-sucedido
    if (move_uploaded_file($foto['tmp_name'], $caminhoImagem)) {
        // Preparar e executar a consulta SQL para inserir os dados
        $stmt = $conexao->prepare("
            INSERT INTO alunos (nomeAluno, dataNasc, ruaAluno, bairroAluno, cityAluno, estadoAluno, cepAluno,  foneAluno, emailAluno, fotoAluno) 
            VALUES (:nomeAluno,:dataNasc,:ruaAluno,:bairroAluno,:cityAluno,:estadoAluno,:cepAluno,:foneAluno,:emailAluno,:fotoAluno)");

        // Certifique-se de definir as variáveis $dtNasc e $estadoAluno
        $stmt->execute([
            ':nomeAluno' => $nome,
            ':dataNasc' => $dtNasc,
            ':ruaAluno' => $rua,
            ':bairroAluno' => $bairro,
            ':cityAluno' => $cidade,
            ':estadoAluno' => $estado,
            ':cepAluno' => $cep,
            ':foneAluno' => $fone,
            ':emailAluno' => $email,
            // ':statusAluno' => $status,
            // ':data_matricula' => $data_matricula,
            ':fotoAluno' => $caminhoImagem
        ]);

        // Redireciona para a página de cadastro com uma mensagem de sucesso
        $idAluno = $conexao->lastInsertId();
        header("Location: DashAluno.php?id=$idAluno&message=Aluno cadastrado com sucesso!");
        exit();
    } else {
        // Redireciona para a página de cadastro com uma mensagem de erro
        header("Location: DashAluno.php?message=Erro ao fazer upload da imagem.");
        exit();
    }
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
    <title>ACADEMY MAVERICK - Novo Registro de Aluno</title>
</head>

<body>
    <div class="navbar_menu">
        <img src="..\Assets\images\aeronaves\logo.png" alt="Logo ">
    </div>
    <div class="container my-4">
        <h1 class="mb-4">Novo Registro de Aluno</h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="info-row">
                <div class="info-col">
                    <label form="nomeAluno" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nomeAluno" name="nomeAluno" required>
                </div>
                <div class="info-col">
                    <label form="dataNasc" class="form-label">Data Nascimento</label>
                    <input type="text" class="form-control" id="dataNasc" name="dataNasc" required>
                </div>
            </div>

            <div class="info-row">
                <div class="info-col">
                    <label form="ruaAluno" class="form-label">Endereço</label>
                    <input type="text" class="form-control" id="ruaAluno" name="ruaAluno" required>
                </div>
                <div class="info-col">
                    <label form="bairroAluno" class="form-label">Bairro</label>
                    <input type="text" class="form-control" id="bairroAluno" name="bairroAluno" required>
                </div>
            </div>

            <div class="info-row">
                <div class="info-col">
                    <label form="cityAluno" class="form-label">Cidade</label>
                    <input type="text" class="form-control" id="cityAluno" name="cityAluno" required>
                </div>
                <div class="info-col">
                    <label form="estadoAluno" class="form-label">Estado</label>
                    <input type="text" class="form-control" id="estadoAluno" name="estadoAluno" required>
                </div>
                <div class="info-col">
                    <label form="cepAluno" class="form-label">CEP</label>
                    <input type="text" class="form-control" id="cepAluno" name="cepAluno" required>
                </div>
            </div>

            <div class="info-row">
                <div class="info-col">
                    <label form="foneAluno" class="form-label">Fone</label>
                    <input type="text" class="form-control" id="foneAluno" name="foneAluno" required>
                </div>
                <div class="info-col">
                    <label form="emailAluno" class="form-label">Email</label>
                    <input type="text" class="form-control" id="emailAluno" name="emailAluno" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="fotoAluno" class="form-label">Foto do Aluno:</label>
                <input type="file" class="form-control" id="fotoAluno" name="fotoAluno" accept="image/*">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Gravar Registro</button>
                <a href="DashAluno.php" class="btn btn-secondary">Voltar</a>
            </div>
        </form>
    </div>
</body>

</html>