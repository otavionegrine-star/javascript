<?php require_once "funcoes.php"; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sorteador Mega-Sena</title>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; display: flex; justify-content: center; padding: 50px 10px; background-color: #e8f5e9; }
        .sorteio-container { text-align: center; background: white; padding: 30px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); max-width: 500px; width: 100%; }
        
        h1 { color: #1840ad; margin-bottom: 25px; }

        .ball-list { display: flex; justify-content: center; gap: 8px; margin: 20px 0; flex-wrap: wrap; }
        .ball {
            width: 55px; height: 55px;
            background: radial-gradient(circle at 30% 30%, #127bc0, #0c4fcc);
            color: #fff; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-weight: bold; font-size: 1.4rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            animation: popIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) backwards;
        }

        /* Animação das bolinhas aparecendo uma por uma */
        <?php for($i=1; $i<=6; $i++): ?>
            .ball:nth-child(<?php echo $i; ?>) { animation-delay: <?php echo $i * 0.1; ?>s; }
        <?php endfor; ?>

        @keyframes popIn {
            0% { transform: scale(0); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }

        .btn-sortear {
            padding: 15px 30px; background-color: #1840ad; color: white;
            border: none; border-radius: 50px; cursor: pointer; font-size: 1.1rem; font-weight: bold;
            transition: transform 0.2s, background 0.3s;
            box-shadow: 0 4px 10px rgba(24, 64, 173, 0.4);
        }
        .btn-sortear:hover { background-color: #0e41ce; transform: translateY(-2px); }
        .btn-sortear:active { transform: translateY(0); }

        .resultado-texto { margin: 20px 0; font-size: 1.2rem; color: #444; background: #b5d1f7; padding: 10px; border-radius: 10px; border: 1px dashed #171ac4; }

        /* Estilo e Animação da Imagem */
        .banner-inferior {
            margin-top: 30px;
            width: 100%;
            max-width: 350px;
            border-radius: 15px;
            /* Animação flutuante */
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(2deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }
    </style>
</head>
<body>

<div class="sorteio-container">
    <h1>Mega-Sorteador</h1>
    
    <form method="POST">
        <button type="submit" name="btn_sortear_mega" class="btn-sortear">
            SORTEAR AGORA!
        </button>
    </form>

    <?php if ($resultado_mega): ?>
        <div class="ball-list">
            <?php 
            $dezenas = explode('-', $resultado_mega);
            foreach ($dezenas as $n): 
            ?>
                <div class="ball"><?php echo $n; ?></div>
            <?php endforeach; ?>
        </div>
        
        <div class="resultado-texto">
            <strong>Números:</strong> <?php echo $resultado_mega; ?>
        </div>

        <script>
            var duration = 3 * 1000;
            var end = Date.now() + duration;

            (function frame() {
              confetti({
                particleCount: 3,
                angle: 60,
                spread: 55,
                origin: { x: 0 },
                colors: ['#1478d6', '#ffffff', '#ffd700']
              });
              confetti({
                particleCount: 3,
                angle: 120,
                spread: 55,
                origin: { x: 1 },
                colors: ['#1478d6', '#ffffff', '#ffd700']
              });

              if (Date.now() < end) {
                requestAnimationFrame(frame);
              }
            }());
        </script>
    <?php endif; ?>

    <img src="https://i.pinimg.com/736x/f3/07/6d/f3076ddcbb4f847eb68292ab3e2496eb.jpg" 
         alt="Banner Animado" 
         class="banner-inferior">
</div>

</body>
</html>