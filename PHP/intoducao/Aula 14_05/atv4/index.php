<?php 
    require_once __DIR__ . '/funcoes.php';

    $preco = $_GET['preco'] ?? 0;
    $percentual = $_GET['reajuste'] ?? 50;
    $resultado = 0;

    if ($preco > 0) {
        $resultado = calcularReajuste($preco, $percentual);
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Reajustador Lilás</title>
    <style>
        :root {
            --lilás-fundo: #f3f0ff;
            --lilás-primario: #9370DB; /* Medium Purple */
            --lilás-escuro: #6A5ACD;   /* Slate Blue */
            --lilás-claro: #E6E6FA;    /* Lavender */
            --texto: #4B0082;          /* Indigo */
        }

        body { 
            background-color: var(--lilás-primario); 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex; 
            flex-direction: column; 
            align-items: center; 
            padding: 50px;
            color: var(--texto);
        }

        .card { 
            background: white; 
            padding: 30px; 
            border-radius: 20px; 
            width: 450px; 
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        h1 { text-align: center; font-size: 1.8rem; margin-bottom: 20px; }

        .form-section { 
            background: var(--lilás-fundo); 
            padding: 25px; 
            border-radius: 15px; 
        }

        .badge { 
            background: var(--lilás-claro); 
            padding: 5px 12px; 
            border-radius: 8px; 
            font-weight: bold;
            display: inline-block;
            margin-bottom: 8px;
        }

        input[type="number"] { 
            width: 100%; 
            padding: 12px; 
            margin-bottom: 20px; 
            border: 2px solid var(--lilás-claro); 
            border-radius: 8px; 
            outline: none;
        }

        input[type="number"]:focus { border-color: var(--lilás-primario); }

        input[type="range"] { 
            width: 100%; 
            margin: 15px 0; 
            accent-color: var(--lilás-escuro);
        }

        button { 
            width: 100%; 
            padding: 15px; 
            background: var(--lilás-escuro); 
            color: white; 
            border: none; 
            border-radius: 10px; 
            cursor: pointer; 
            font-size: 1rem; 
            font-weight: bold;
            transition: transform 0.2s, background 0.3s;
        }

        button:hover { 
            background: var(--texto);
            transform: translateY(-2px);
        }

        .result-card { 
            background: white; 
            width: 450px; 
            margin-top: 25px; 
            padding: 25px; 
            border-radius: 20px;
            border-left: 8px solid var(--lilás-escuro);
        }
    </style>
</head>
<body>

    <div class="card">
        <h1>Reajustador de Preços</h1>
        <div class="form-section">
            <form action="index.php" method="get">
                <span class="badge">Preço do Produto (R$):</span>
                <input type="number" name="preco" step="0.01" value="<?= $preco ?>" required>

                <span class="badge">Reajuste: <span id="display-perc"><?= $percentual ?></span>%</span>
                <input type="range" name="reajuste" min="0" max="100" value="<?= $percentual ?>" 
                       oninput="document.getElementById('display-perc').innerText = this.value">

                <button type="submit">Atualizar Valor</button>
            </form>
        </div>
    </div>

    <?php if ($preco > 0): ?>
    <div class="result-card">
        <h2 style="margin-top:0">Resultado</h2>
        <p>Um produto de <strong>R$ <?= number_format($preco, 2, ',', '.') ?></strong> 
        com <strong><?= $percentual ?>%</strong> de aumento, passará a custar 
        <span style="color: var(--lilás-escuro); font-size: 1.2em; display: block; margin-top: 10px;">
            <strong>R$ <?= number_format($resultado, 2, ',', '.') ?></strong>
        </span>
        </p>
    </div>
    <?php endif; ?>

</body>
</html>