<?php

include("../conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nomeInstr'];
    $dtNasc = $_POST['dataNascInstr'];
    $matricula = $_POST['matriculaInstr'];
    $breve = $_POST['breveInstr'];
    $rua = $_POST['endInstr'];
    $bairro = $_POST['bairroInstr'];
    $cidade = $_POST['cityInstr'];
    $estado = $_POST['estadoInstr'];
    $cep = $_POST['cepInstr'];
    $fone = $_POST['foneInstr'];
    $email = $_POST['emailInstr'];
    $foto = $_FILES['fotoInstr'];

    // Diretório onde a imagem será salva
    $diretorioImagem = '../Assets/images/instrutores/';
    $nomeImagem = basename($foto['name']);
    $caminhoImagem = $diretorioImagem . $nomeImagem;

    // Verifica se o arquivo enviado é uma imagem válida
    $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];
    $extensaoArquivo = strtolower(pathinfo($nomeImagem, PATHINFO_EXTENSION));

    if (!in_array($extensaoArquivo, $extensoesPermitidas)) {
        header("Location: DashInstrutor.php?message=Formato de imagem inválido.");
        exit();
    }

    // Verifica se o upload foi bem-sucedido
    if (move_uploaded_file($foto['tmp_name'], $caminhoImagem)) {
        // Preparar e executar a consulta SQL para inserir os dados
        $stmt = $conexao->prepare("
        INSERT INTO instrutores (nomeInstr, dataNascInstr, matriculaInstr, breveInstr, endInstr, bairroInstr, cityInstr, estadoInstr, cepInstr, foneInstr, emailInstr, fotoInstr) 
        VALUES (:nomeInstr, :dataNascInstr, :matriculaInstr, :breveInstr, :endInstr, :bairroInstr, :cityInstr, :estadoInstr, :cepInstr, :foneInstr, :emailInstr, :fotoInstr)");

        // Executar a consulta
        $stmt->execute([
            ':nomeInstr' => $nome,
            ':dataNascInstr' => $dtNasc,
            ':matriculaInstr' => $matricula,
            ':breveInstr' => $breve,
            ':endInstr' => $rua,
            ':bairroInstr' => $bairro,
            ':cityInstr' => $cidade,
            ':estadoInstr' => $estado,
            ':cepInstr' => $cep,
            ':foneInstr' => $fone,
            ':emailInstr' => $email,
            ':fotoInstr' => $caminhoImagem
        ]);

        // Redireciona para a página de sucesso
        $idInstr = $conexao->lastInsertId();
        header("Location: DashInstrutor.php?id=$idInstr&message=Instrutor cadastrado com sucesso!");
        exit();
    } else {
        // Redireciona para a página de erro
        header("Location: DashInstrutor.php?message=Erro ao fazer upload da imagem.");
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
    <link rel="stylesheet" href="../Assets/CSS/estilo.css">
    <title>Academy Maverick - Novo Resgistro de Instrutor</title>
</head>

<body>
    <div class="navbar_menu">
        <img src="..\Assets\images\aeronaves\logo.png" alt="Logo ">
    </div>
    <div class="container my-4">
        <h1 class="mb-4">Novo Registro de Instrutor</h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="row justify-content-md-center">
                <div class="col col-lg-12">
                    <label form="nomeInstr" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nomeInstr" name="nomeInstr" required>
                </div>
                <div class="col col-lg-4">
                    <label form="dataNascInstr" class="form-label">Data Nascimento</label>
                    <input type="text" class="form-control" id="dataNascInstr" name="dataNascInstr" required>
                </div>
                <div class="col col-lg-4">
                    <label form="matriculaInstr" class="form-label">Matricula</label>
                    <input type="text" class="form-control" id="matriculaInstr" name="matriculaInstr" required>
                </div>
                <div class="col col-lg-4">
                    <label form="breveInstr" class="form-label">Breve</label>
                    <input type="text" class="form-control" id="breveInstr" name="breveInstr" required>
                </div>
                <div class="col col-lg-6">
                    <label form="endInstr" class="form-label">Rua/Av.</label>
                    <input type="text" class="form-control" id="endInstr" name="endInstr" required>
                </div>
                <div class="col col-lg-6">
                    <label form="bairroInstr" class="form-label">Bairro</label>
                    <input type="text" class="form-control" id="bairroInstr" name="bairroInstr" required>
                </div>
                <div class="col col-lg-4">
                    <label form="cityInstr" class="form-label">Cidade</label>
                    <input type="text" class="form-control" id="cityInstr" name="cityInstr" required>
                </div>
                <div class="col col-lg-4">
                    <label form="estadoInstr" class="form-label">Estado</label>
                    <input type="text" class="form-control" id="estadoInstr" name="estadoInstr" required>
                </div>
                <div class="col col-lg-4">
                    <label form="cepInstr" class="form-label">Cep</label>
                    <input type="text" class="form-control" id="cepInstr" name="cepInstr" required>
                </div>
                <div class="col col-lg-6">
                    <label form="foneInstr" class="form-label">Fone</label>
                    <input type="text" class="form-control" id="foneInstr" name="foneInstr" required>
                </div>
                <div class="col col-lg-6">
                    <label form="emailInstr" class="form-label">Email</label>
                    <input type="text" class="form-control" id="emailInstr" name="emailInstr" required>
                </div>
                <div class="col col-lg-12">
                    <label for="fotoInstr" class="form-label">Foto do Instrutor</label>
                    <input type="file" class="form-control" id="fotoInstr" name="fotoInstr" accept="image/*">
                </div>
                <div class="mb-4">
                    <button type="submit" class="btn btn-success">Gravar</button>
                    <a href="DashInstrutor.php" class="btn btn-secondary">Voltar</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>