<?php
// Conex�o com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cadastro_vagas";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conex�o
if ($conn->connect_error) {
    die("Conex�o falhou: " . $conn->connect_error);
}

// Recebe as informa��es do formul�rio de adi��o de vaga
$empresa = $_POST['empresa'];
$descricao = $_POST['descricao'];
$salario = $_POST['salario'];

// Insere as informa��es no banco de dados
$sql = "INSERT INTO vagas (empresa, descricao, salario) VALUES ('$empresa', '$descricao', '$salario')";

if ($conn->query($sql) === TRUE) {
    header('Location: success.php');
} else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>