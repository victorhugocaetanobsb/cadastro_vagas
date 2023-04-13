<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cadastro_vagas";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Recebe as informações do formulário de adição de vaga
$empresa = $_POST['empresa'];
$descricao = $_POST['descricao'];
$salario = $_POST['salario'];

// Insere as informações no banco de dados
$sql = "INSERT INTO vagas (empresa, descricao, salario) VALUES ('$empresa', '$descricao', '$salario')";

if ($conn->query($sql) === TRUE) {
    header('Location: success.php');
} else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>