<?php
// Conex�o com o banco de dados
$conn = new mysqli("localhost", "root", "", "cadastro_vagas");

// Verificar se o ID da vaga foi passado por par�metro na URL
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Excluir a vaga de emprego do banco de dados
    $sql = "DELETE FROM vagas WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "Vaga de emprego exclu�da com sucesso.";
    } else {
        echo "Erro ao excluir vaga de emprego: " . $conn->error;
    }
} else {
    echo "ID da vaga n�o foi informado.";
}

$conn->close();
header("Location: index.php");
exit;

?>
