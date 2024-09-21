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
    $diretorioImagem = '../Assets/images/alunos/';
    $nomeImagem = uniqid() . '-' . basename($foto['name']); // Gera um nome único para a imagem
    $caminhoImagem = $diretorioImagem . $nomeImagem;

    // Verifica se o upload foi bem-sucedido
    if (move_uploaded_file($foto['tmp_name'], $caminhoImagem)) {
        // Preparar e executar a consulta SQL para inserir os dados
        $stmt = $conexao->prepare("
            INSERT INTO alunos (nomeAluno, dataNasc, ruaAluno, bairroAluno, cityAluno, estadoAluno, cepAluno, foneAluno, emailAluno, fotoAluno) 
            VALUES (:nomeAluno, :dataNasc, :ruaAluno, :bairroAluno, :cityAluno, :estadoAluno, :cepAluno, :foneAluno, :emailAluno, :fotoAluno)");

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
            ':fotoAluno' => $nomeImagem // Armazena apenas o nome da imagem
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
    <link rel="stylesheet" href="../Assets/CSS/estilo.css">
    <title>ACADEMY MAVERICK - Novo Registro de Aluno</title>
</head>

<body>
    <div class="navbar_menu">
        <img src="../Assets/images/aeronaves/logo.png" alt="Logo">
    </div>
    <div class="etiqueta">
        <h1>Novo Registro de Aluno</h1>
    </div>
    <div class="container my-4">
        <form method="POST" enctype="multipart/form-data">
            <div class="row justify-content-md-center">
                <div class="col col-lg-10">
                    <label for="nomeAluno" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nomeAluno" name="nomeAluno" required>
                </div>
                <div class="col col-lg-2">
                    <label for="dataNasc" class="form-label">Data Nascimento</label>
                    <input type="date" class="form-control" id="dataNasc" name="dataNasc" required>
                </div>
                <div class="col col-lg-6">
                    <label for="ruaAluno" class="form-label">Endereço</label>
                    <input type="text" class="form-control" id="ruaAluno" name="ruaAluno" required>
                </div>
                <div class="col col-lg-6">
                    <label for="bairroAluno" class="form-label">Bairro</label>
                    <input type="text" class="form-control" id="bairroAluno" name="bairroAluno" required>
                </div>
                <div class="col col-lg-4">
                    <label for="cityAluno" class="form-label">Cidade</label>
                    <input type="text" class="form-control" id="cityAluno" name="cityAluno" required>
                </div>
                <div class="col col-lg-4">
                    <label for="estadoAluno" class="form-label">Estado</label>
                    <input type="text" class="form-control" id="estadoAluno" name="estadoAluno" required>
                </div>
                <div class="col col-lg-4">
                    <label for="cepAluno" class="form-label">CEP</label>
                    <input type="text" class="form-control" id="cepAluno" name="cepAluno" required>
                </div>
                <div class="col col-lg-6">
                    <label for="foneAluno" class="form-label">Fone</label>
                    <input type="text" class="form-control" id="foneAluno" name="foneAluno" required>
                </div>
                <div class="col col-lg-6">
                    <label for="emailAluno" class="form-label">Email</label>
                    <input type="email" class="form-control" id="emailAluno" name="emailAluno" required>
                </div>
                <div class="col col-lg-12">
                    <label for="fotoAluno" class="form-label">Foto do Aluno:</label>
                    <input type="file" class="form-control" id="fotoAluno" name="fotoAluno" accept="image/*" required>
                </div>
                <div class="mb-4">
                    <button type="submit" class="btn btn-success">Gravar Registro</button>
                    <a href="DashAluno.php" class="btn btn-secondary">Voltar</a>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('foneAluno').addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 10) {
                value = value.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
            } else {
                value = value.replace(/(\d{2})(\d{4})(\d+)/, '($1) $2-$3');
            }
            e.target.value = value;
        });
    </script>
</body>

</html>
