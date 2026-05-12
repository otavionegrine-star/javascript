<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Formulário Simples</title>
</head>
<body>

    <h2>Cadastro de Cliente</h2>
    
    <form method="POST">
        <label>Nome:</label><br>
        <input type="text" name="nome" required><br><br>

        <label>E-mail:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Mensagem:</label><br>
        <input type="text" name="mensagem" required><br><br>

        <input type="submit" value="Enviar Dados">
    </form>

    <hr>

    <?php
    // Verifica se os dados foram enviados
    if ($_POST) {
        // Recebe os dados dos campos 'name'
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $msg = $_POST['mensagem'];

        // Exibe os dados na tela
        echo "<h3>Dados Recebidos:</h3>";
        echo "Nome: " . $nome . "<br>";
        echo "E-mail: " . $email . "<br>";
        echo "Mensagem: " . $msg;
    }
    ?>

</body>
</html>