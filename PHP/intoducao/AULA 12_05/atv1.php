<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Favoritos</title>
    <style>
        /* Estilo Geral - Paleta Rosa */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #ffe4e1; /* Rosa bem claro (MistyRose) */
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px;
            color: #5d4037;
        }

        /* Cartão do Formulário */
        form {
            background: #ffffff;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(255, 182, 193, 0.5);
            width: 100%;
            max-width: 380px;
            border: 2px solid #ffb6c1;
        }

        h2 {
            margin-top: 0;
            color: #ff69b4; /* Rosa Choque */
            text-align: center;
            font-size: 24px;
        }

        label {
            font-weight: 600;
            display: block;
            margin-bottom: 8px;
            color: #ff1493;
        }

        /* Campos de Entrada */
        input[type="text"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 2px solid #ffd1dc;
            border-radius: 10px;
            box-sizing: border-box;
            transition: all 0.3s;
            background-color: #fff9fa;
        }

        input[type="text"]:focus {
            border-color: #ff69b4;
            outline: none;
            box-shadow: 0 0 8px rgba(255, 105, 180, 0.3);
        }

        /* Botão Rosa */
        input[type="submit"] {
            width: 100%;
            background-color: #ff69b4;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #ff1493;
            transform: scale(1.02);
        }

        /* Resultado Estilizado */
        .resultado {
            margin-top: 25px;
            background: #ffffff;
            padding: 20px;
            border-radius: 15px;
            width: 100%;
            max-width: 380px;
            border: 2px dashed #ff69b4;
            text-align: center;
        }
    </style>
</head>
<body>

    <form method="POST">
        <h2>Seus Favoritos♥️♥️</h2>
        
        <label>Nome:</label>
        <input type="text" name="nome" placeholder="Seu nome" required>

        <label>Cor Favorita:</label>
        <input type="text" name="cor" placeholder="Ex: Rosa, Azul..." required>

        <label>Animal Favorito:</label>
        <input type="text" name="animal" placeholder="Ex: Cachorro, Gato..." required>

        <input type="submit" value="Salvar Preferências">
    </form>

    <?php
    if ($_POST) {
        // Recebendo os novos campos
        $nome = htmlspecialchars($_POST['nome']);
        $cor = htmlspecialchars($_POST['cor']);
        $animal = htmlspecialchars($_POST['animal']);

        echo "<div class='resultado'>";
        echo "<h3 style='color: #ff1493;'>Perfil Criado!</h3>";
        echo "<b>Nome:</b> $nome <br>";
        echo "<b>Cor Favorita:</b> $cor <br>";
        echo "<b>Animal Favorito:</b> $animal";
        echo "</div>";
    }
    ?>

</body>
</html>