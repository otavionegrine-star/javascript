<?php require_once "funcoes.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Antecessor e Sucessor</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        h1 {
            color: #333;
        }
        form {
            margin-bottom: 20px;
        }
        input[type="number"] {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 200px;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .resultado {
            margin-top: 20px;
        }
        .resultado p {
            font-size: 18px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Calculadora de Antecessor e Sucessor</h1>
        <form method="GET" action="index.php">
            <label>Digite um número:</label>
            <input type="number" name="num" required value="<?= $numero ?>">
            <br><br>
            <button type="submit">Calcular</button>
        </form>

        <?php if ($numero !== null): ?>
            <div class="resultado">
                <p>Antecessor: <strong><?= $ant ?></strong></p>
                <p>Número: <strong><?= $numero ?></strong></p>
                <p>Sucessor: <strong><?= $post ?></strong></p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>