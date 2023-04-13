<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">

    <title>Cadastro de Vagas de Emprego</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
     <style>
        /* CSS personalizado */
        body {
            background-color: #f0f0f0;
        }

        h2 {
            text-align: center;
            margin-top: 50px;
        }

        table {
            margin-top: 50px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    
    <div class="container">
        <h2>Cadastro de Vagas de Emprego</h2>
        <a href="add_vaga.php" class="btn btn-primary">Adicionar Vaga</a>
        <table class="table">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome da Empresa</th>
                    <th>Descrição da Vaga</th>
                    <th>Salário</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                </div>
                <?php

                
                // Conexão com o banco de dados
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "cadastro_vagas";

                $conn = new mysqli($servername, $username, $password);


                $conn->select_db($dbname);

                if ($conn->connect_error) {
                    die("Conexão falhou: " . $conn->connect_error);
                }

                // Criando Banco de dados
                $sql = "CREATE DATABASE IF NOT EXISTS cadastro_vagas";
                if ($conn->query($sql) === TRUE) {
                    echo "";
                } else {
                    echo "Erro ao criar o banco de dados: " . $conn->error;
                }

                $conn->select_db($dbname);
                // Verificar se a tabela vagas já existe
if ($conn->query("DESCRIBE vagas")) {
    echo "";
} else {
    // Criar tabela vagas
    $sql = "CREATE TABLE vagas (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        empresa VARCHAR(30) NOT NULL,
        descricao VARCHAR(100) NOT NULL,
        salario DECIMAL(10,2) NOT NULL
    )";
    if ($conn->query($sql) === TRUE) {
        echo "Tabela vagas criada com sucesso!";
    } else {
        echo "Erro ao criar a tabela vagas: " . $conn->error;
    }
}
// Verificar se a tabela vagas já existe
if ($conn->query("DESCRIBE vagas")) {
    echo "";
} else {
    // Criar tabela vagas
    $sql = "CREATE TABLE vagas (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        empresa VARCHAR(30) NOT NULL,
        descricao VARCHAR(100) NOT NULL,
        salario DECIMAL(10,2) NOT NULL
    )";
    if ($conn->query($sql) === TRUE) {
        echo "Tabela vagas criada com sucesso!";
    } else {
        echo "Erro ao criar a tabela vagas: " . $conn->error;
    }
}

                // Selecionar todas as vagas de emprego do banco de dados
                $sql = "SELECT * FROM vagas";
                $resultado = $conn->query($sql);

                if ($resultado->num_rows > 0) {
                    // Exibir todas as vagas de emprego em uma tabela
                    while($linha = $resultado->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $linha["id"] . "</td>";
                        echo "<td>" . $linha["empresa"] . "</td>";
                        echo "<td>" . $linha["descricao"] . "</td>";
                        echo "<td>" . $linha["salario"] . "</td>";
                        echo "<td>";
                        echo "<a href='edit_vaga.php?id=" . $linha["id"] . "' class='btn btn-warning'>Editar</a> ";
                        echo "<a href='delete_vaga.php?id=" . $linha["id"] . "' class='btn btn-danger'>Excluir</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Nenhuma vaga de emprego cadastrada.</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
