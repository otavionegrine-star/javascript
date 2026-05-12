<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="GET">
        <label neme="nome">Nome:</label>
        <input type="text" neme="nome" placeholder="Digite seu nome aqui">
        <input type="submit" value="Enviar">
    </form>   
    <?php
    $nome = $_GET["nome"];

    echo "<br> Nome informado: $nome <br>";
    var_dump($_GET);

    ?>
</body>
</html>