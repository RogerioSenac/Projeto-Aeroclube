<?php
include("../conexao.php");
//Buscar os registros 
$buscarAluno = $conexao->query("SELECT * FROM alunos ORDER BY nomeAluno ASC");
//Exibir os Registros
$exibirAlunos = $buscarAluno->fetchAll(PDO::FETCH_ASSOC);

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $aluno = $_POST["nomeAluno"];

//     $novoAluno = $conexao->prepare("INSERT INTO alunos (nomeAluno) VALUE (?)");

//     $novoAluno->execute([$aluno]);

//     header('Location: index.php');
// }

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Academy Maverick - Controle de Registros de Voos</title>
    <style>
        h1 {
            text-align: center;
            margin-bottom: 2rem;
            font-size: 2.5rem;
            font-weight: bold;
            color: #343a40;
            /* Cor escura para contraste */
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="my-4">Registro de Históricos de Pareceres de Voos dos Alunos</h1>

        <table class="table table-sucess table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Aluno</th>
                    <th>Acessos</th>
                </tr>
            </thead>
            <?php foreach ($exibirAlunos as $aluno): ?>
                <tr>
                    <td><?php echo htmlspecialchars($aluno['idAluno']) ?></td>
                    <td><?php echo htmlspecialchars($aluno['nomeAluno']) ?></td>
                    <td>
                        <!-- <a href="atualizar.php?id=<?php echo $aluno['idAluno']; ?>"
                            class="btn btn-warning btn-sm">Editar</a> -->
                        <a href="visualizar.php?id=<?php echo $aluno['idAluno']; ?>"
                            class="btn btn-secondary btn-sm">Visualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <a href="../menu.php" class="btn btn-secondary">Voltar</a>
    </div>
</body>

</html>