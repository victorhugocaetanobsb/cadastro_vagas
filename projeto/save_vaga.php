<?php
// informações de conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cadastro_vagas";

// cria uma conexão com o banco de dados
$conn = new mysqli($servername, $username, $password);
$conn->select_db($dbname);
// verifica se houve erro de conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $empresa = $_POST["empresa"];
    $descricao = $_POST["descricao"];
    $salario = $_POST["salario"];

    if (empty($empresa) || empty($descricao) || empty($salario)) {
        echo "Por favor, preencha todos os campos.";
        exit;
    }

    $sql = "INSERT INTO vagas (empresa, descricao, salario) VALUES ('$empresa', '$descricao', $salario)";

    if ($conn->query($sql) === TRUE) {
        echo "Vaga cadastrada com sucesso.";
    } else {
        echo "Erro ao cadastrar vaga: " . $conn->error;
    }
}



$conn->close();
?>
