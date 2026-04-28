<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Informações do cliente:</h1>
    <?php
    $nome = "Jorge";
    $idade = 19;
    $telefone = 199989989;
    $estadoCivil = true;

    echo "<strong>Seu nome é:</strong> $nome</br>
    <strong>Idade:</strong> $idade</br>
    <strong>telefone:</strong> $telefone </br>
    Casado: " . ($estadoCivil ? 'Sim' : 'Não');
    ?>
    
</body>
</html>