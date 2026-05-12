<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Moderno</title>
    <style>
        /* Estilo Geral */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px;
            color: #333;
        }

        /* Estilo do Cartão do Formulário */
        form {
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            margin-top: 0;
            color: #1a73e8;
            text-align: center;
        }

        label {
            font-weight: 600;
            display: block;
            margin-bottom: 8px;
        }

        /* Estilo dos Campos de Entrada */
        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-sizing: border-box; /* Garante que o padding não aumente a largura */
            transition: border-color 0.3s;
        }

        input:focus {
            border-color: #1a73e8;
            outline: none;
        }

        /* Estilo do Botão */
        input[type="submit"] {
            width: 100%;
            background-color: #1a73e8;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #1557b0;
        }

        /* Estilo da Resposta */
        .resultado {
            margin-top: 25px;
            background: #e7f3ff;
            padding: 20px;
            border-radius: 8px;
            width: 100%;
            max-width: 400px;
            border-left: 5px solid #1a73e8;
        }
    </style>
</head>
<body>

    <form method="POST">
        <h2>Cadastro</h2>
        
        <label>Nome:</label>
        <input type="text" name="nome" placeholder="Digite seu nome" required>

        <label>E-mail:</label>
        <input type="email" name="email" placeholder="seu@email.com" required>

        <label>Mensagem:</label>
        <input type="text" name="mensagem" placeholder="Como podemos ajudar?" required>

        <input type="submit" value="Enviar Dados">
    </form>

    <?php
    if ($_POST) {
        $nome = htmlspecialchars($_POST['nome']);
        $email = htmlspecialchars($_POST['email']);
        $msg = htmlspecialchars($_POST['mensagem']);

        echo "<div class='resultado'>";
        echo "<h3>Dados Recebidos:</h3>";
        echo "<b>Nome:</b> $nome <br>";
        echo "<b>E-mail:</b> $email <br>";
        echo "<b>Mensagem:</b> $msg";
        echo "</div>";
    }
    ?>

</body>
</html>