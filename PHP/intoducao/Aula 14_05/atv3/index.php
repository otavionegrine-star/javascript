<?php require_once "funcoes.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analisador Salarial</title>
    <style>
        :root {
            --laranja-escuro: #e65100;
            --laranja-principal: #ff9800;
            --laranja-claro: #fff3e0;
            --texto: #333;
        }

        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background-color: var(--laranja-claro); 
            display: flex; 
            justify-content: center; 
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .container { 
            background: white; 
            padding: 30px; 
            border-radius: 12px; 
            box-shadow: 0 10px 25px rgba(0,0,0,0.1); 
            max-width: 400px; 
            width: 90%; 
            text-align: center;
            border-top: 10px solid var(--laranja-escuro);
        }
        
        h1 { color: var(--laranja-escuro); margin-bottom: 25px; }
        
        label { display: block; margin-bottom: 10px; font-weight: bold; color: var(--texto); }

        input[type="number"] {
            width: 100%; 
            padding: 12px; 
            margin-bottom: 20px;
            border: 2px solid #ddd; 
            border-radius: 6px; 
            font-size: 1.1rem;
            box-sizing: border-box;
            outline-color: var(--laranja-principal);
        }

        .btn-acao {
            background-color: var(--laranja-principal); 
            color: white; 
            border: none;
            padding: 15px; 
            border-radius: 6px; 
            cursor: pointer;
            font-weight: bold; 
            font-size: 1rem; 
            width: 100%;
            transition: background 0.3s;
        }

        .btn-acao:hover { background-color: var(--laranja-escuro); }

        .resultado-box {
            background: #fff8f0; 
            border-left: 5px solid var(--laranja-principal);
            margin-top: 25px; 
            padding: 15px; 
            text-align: left;
            border-radius: 4px;
        }

        .destaque { color: var(--laranja-escuro); font-weight: bold; }
    </style>
</head>
<body>

<div class="container">
    <h1>Analisador Salarial</h1>
    
    <form method="POST">
        <label for="salario">Informe o seu salário (R$):</label>
        <input type="number" name="salario" id="salario" step="0.01" placeholder="Ex: 3500.00" required>
        <p style="font-size: 0.9rem; color: #666;">
            Considerando o salário mínimo de <strong>R$ 1.621,00</strong>
        </p>
        <button type="submit" name="btn_analisar" class="btn-acao">CALCULAR</button>
    </form>

    <?php if ($analise): ?>
        <div class="resultado-box">
            <p>Quem recebe um salário de <strong>R$ <?php echo number_format($_POST['salario'], 2, ',', '.'); ?></strong>:</p>
            <p>🔸 Ganha <span class="destaque"><?php echo $analise['quantidade']; ?></span> salários mínimos.</p>
            <p>🔸 Sobra um extra de <span class="destaque">R$ <?php echo number_format($analise['resto'], 2, ',', '.'); ?></span>.</p>
        </div>
    <?php endif; ?>
</div>

</body>
</html>