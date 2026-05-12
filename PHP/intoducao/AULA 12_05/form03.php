<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
    content="width=device-width, initial-scale=1.0">
    <title>Cadastro Cliente</title>
</head>
<body>
    <form method="POST">
        <label>Nome: </label>
        <input type="text" name="nome" id="nome">
        <label>E-mail: </label>
        <input type="email" name="email" id="email">
        <label>Mensagem: </label>
        <input type="text" name="msg" id="msg">
        <input type="reset" value="Limpar">
        <input type="submit" value="Enviar">
    </form>
    <h2> Dados recebidos:</h2>
    <hr>
<?php
$nome = $_POST["nome"];
$email = $_POST["email"];
$msg = $_POST["msg"];
echo "<p><strong>Nome:</strong> $nome</p>";
echo "<p><strong>E-mail:</strong> $email</p>";
echo "<p><strong>Mensagem:</strong> $msg</p>";
?>
</body>
</html>