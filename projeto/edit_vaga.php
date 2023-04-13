<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Editar Vaga de Emprego</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <h2>Editar Vaga de Emprego</h2>
        <?php
        // Conexão com o banco de dados
        $conn = new mysqli("localhost", "root", "", "cadastro_vagas");

        // Verificar se o formulário foi enviado
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Proteger contra SQL injection
            $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
            $empresa = filter_input(INPUT_POST, "empresa", FILTER_SANITIZE_STRING);
            $descricao = filter_input(INPUT_POST, "descricao", FILTER_SANITIZE_STRING);
            $salario = filter_input(INPUT_POST, "salario", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

            // Atualizar a vaga de emprego no banco de dados
            $sql = "UPDATE vagas SET empresa=?, descricao=?, salario=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssdi", $empresa, $descricao, $salario, $id);
            $resultado = $stmt->execute();

            if ($resultado) {
                echo "<div class='alert alert-success'>Vaga de emprego atualizada com sucesso.</div>";
            } else {
                echo "<div class='alert alert-danger'>Erro ao atualizar vaga de emprego: " . $conn->error . "</div>";
            }
        }

        // Selecionar a vaga de emprego a ser editada
        if (isset($_GET["id"])) {
            // Proteger contra SQL injection
            $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

            $sql = "SELECT * FROM vagas WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if ($resultado->num_rows == 1) {
                // Exibir o formulário de edição da vaga de emprego
                $linha = $resultado->fetch_assoc();
                ?>
                <form method="post">
    <input type="hidden" name="id" value="<?= $linha['id'] ?>" />
    <div class="form-group">
        <label for="empresa">Nome da Empresa:</label>
        <input type="text" class="form-control" id="empresa" name="empresa" value="<?= $linha['empresa'] ?>" />
    </div>
    <div class="form-group">
        <label for="descricao">Descrição da Vaga:</label>
        <textarea class="form-control" id="descricao" name="descricao"><?= $linha['descricao'] ?></textarea>
    </div>
    <div class="form-group">
        <label for="salario">Salário:</label>
        <input type="number" class="form-control" id="salario" name="salario" value="<?= $linha['salario'] ?>" step="0.01" />
    </div>
    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
</form>
