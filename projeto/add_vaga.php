<?php
// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Coleta os dados do formulário
    $empresa = $_POST['empresa'];
    $descricao = $_POST['descricao'];
    $salario = $_POST['salario'];

    // Conecta ao banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cadastro_vagas";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica se a conexão foi bem sucedida
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Insere os dados da vaga de emprego no banco de dados
    $sql = "INSERT INTO vagas (empresa, descricao, salario) VALUES ('$empresa', '$descricao', '$salario')";
    if ($conn->query($sql) === TRUE) {
        // Redireciona o usuário para a página inicial
        header("Location: index.php");
        exit;
    } else {
        echo "Erro ao adicionar vaga de emprego: " . $conn->error;
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Vagas de Emprego - Adicionar Vaga</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <h2>Cadastro de Vagas de Emprego - Adicionar Vaga</h2>
        <form method="post">
            <div class="form-group">
                <label for="empresa">Nome da Empresa:</label>
                <input type="text" class="form-control" id="empresa" name="empresa">
            </div>
            <div class="form-group">
                <label for="descricao">Descrição da Vaga:</label>
                <textarea class="form-control" id="descricao" name="descricao"></textarea>
            </div>
            <div class="form-group">
                <label for="salario">Salário:</label>
                <input type="text" class="form-control" id="salario" name="salario">
            </div>
            <button type="submit" class="btn btn-primary">Adicionar</button>
            <a href="index.php" class="btn btn-default">Cancelar</a>
        </form>
    </div>
