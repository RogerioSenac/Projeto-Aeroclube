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
    $foto = $_POST['fotoInstr']; // Use $_FILES para o upload de arquivos

    // Diretório onde a imagem será salva
    $diretorioImagem = '../Assets/images/instrutor';
    $nomeImagem = basename($foto['name']);
    $caminhoImagem = $diretorioImagem . $nomeImagem;

    // Verifica se o upload foi bem-sucedido
    if (move_uploaded_file($foto['tmp_name'], $caminhoImagem)) {
        // Preparar e executar a consulta SQL para inserir os dados
        $stmt = $conexao->prepare("
        INSERT INTO alunos (nomeInstr, dataNascInstr, matriculaInstr, breveInstr, endInstr, bairroInstr, cityInstr, estadoInstr, cepInstr, foneInstr, emaiInstr, fotoInstr) 
        VALUES (:nomeAluno,:dataNasc,:matriculaInstr,:breveInstr,:ruaAluno,:bairroAluno,:cityAluno,:estadoAluno,:cepAluno,:foneAluno,:emailAluno,:fotoAluno)");

        // Certifique-se de definir as variáveis $dtNasc e $estadoAluno
        $stmt->execute([
            ':nomeInstr' => $nome,
            ':dataNascInstr' => $dtNasc,
            ':matriculaInstr' => $matricula,
            ':breveInstr' => $breve,
            ':endInstr' => $rua,
            ':bairroInstr' => $bairro,
            ':cityInstr' => $cidade,
            ':estadoInstr' => $estado,
            ':cepINstr' => $cep,
            ':foneInstr' => $fone,
            ':emailInstr' => $email,
            ':fotoAluno' => $caminhoImagem
        ]);

        // Redireciona para a página de cadastro com uma mensagem de sucesso
        $idAluno = $conexao->lastInsertId();
        header("Location: DashInstrutor.php?id=$idInstr&message=Instrutor cadastrado com sucesso!");
        exit();
    } else {
        // Redireciona para a página de cadastro com uma mensagem de erro
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
    <title>Academy Maverick - Novo Resgistro de Instrutor</title>
    <style>
        h1 {
            text-align: center;
            margin-bottom: 2rem;
            font-size: 2.5rem;
            font-weight: bold;
            color: #343a40;
            /* Cor escura para contraste */
        }

        .info-row {
            display: flex;
            flex-wrap: wrap;
            /* Permite que os itens se movam para a linha seguinte se não houver espaço */
            justify-content: space-between;
            /* Distribui o espaço entre os itens igualmente */
        }

        .info-col {
            flex: 1;
            /* Permite que as colunas ocupem o mesmo espaço */
            min-width: 0px;
            /* Define uma largura mínima para as colunas */
            margin: 0.5rem 0;
            /* Adiciona margem vertical entre as colunas */
            /* border: solid; */
            margin: 3px;
        }

        .mb-4 {
            margin-top: 180px;
         
        }
    </style>

</head>

<body>
    <div class="container">
        <h1 class="mb-4">Novo Registro de Instrutor</h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="info-row">
                <div class="info-col">
                    <label form="nomeInstr" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nomeInstr" name="nomeInstr" required>
                </div>
                <div class="info-col">
                    <label form="dataNascInstr" class="form-label">Data Nascimento</label>
                    <input type="text" class="form-control" id="dataNascInstr" name="dataNascInstr" required>
                </div>
            </div>
            <div class="info-row">
                <div class="info-col">
                    <label form="matriculaInstr" class="form-label">Matricula</label>
                    <input type="text" class="form-control" id="matriculaInstr" name="matriculaInstr" required>
                </div>
                <div class="info-col">
                    <label form="breveInstr" class="form-label">Breve</label>
                    <input type="text" class="form-control" id="breveInstr" name="breveInstr" required>
                </div>
            </div>
            <div class="info-row">
                <div class="info-col">
                    <label form="endInstr" class="form-label">Rua/Av.</label>
                    <input type="text" class="form-control" id="endInstr" name="endInstr" required>
                </div>
                <div class="info-col">
                    <label form="bairroInstr" class="form-label">Bairro</label>
                    <input type="text" class="form-control" id="bairroInstr" name="bairroInstr" required>
                </div>
            </div>
            <div class="info-row">
                <div class="info-col">
                    <label form="cityInstr" class="form-label">Cidade</label>
                    <input type="text" class="form-control" id="cityInstr" name="cityInstr" required>
                </div>
                <div class="info-col">
                    <label form="estadoInstr" class="form-label">Estado</label>
                    <input type="text" class="form-control" id="estadoInstr" name="estadoInstr" required>
                </div>
                <div class="info-col">
                    <label form="cepInstr" class="form-label">Cep</label>
                    <input type="text" class="form-control" id="cepInstr" name="cepInstr" required>
                </div>
            </div>
            <div class="info-row">
                <div class="info-col">
                    <label form="foneInstr" class="form-label">Fone</label>
                    <input type="text" class="form-control" id="foneInstr" name="foneInstr" required>
                </div>
                <div class="info-col">
                    <label form="emailInstr" class="form-label">Fone</label>
                    <input type="text" class="form-control" id="emailInstr" name="emailInstr" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="fotoInstr" class="form-label">Foto do Instrutor</label>
                <input type="file" class="form-control" id="fotoInstr" name="fotoInstr" accept="image/*">
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-success">Gravar</button>
                <a href="DashInstrutor.php" class="btn btn-secondary">Voltar</a>
            </div>
        </form>
    </div>
</body>

</html>