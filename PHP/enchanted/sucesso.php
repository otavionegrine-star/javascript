<?php
session_start();

// Verificar se os dados de reserva existem
if (!isset($_SESSION['reserva_id'])) {
    header("Location: vitrine.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Desejo Concedido!</title>
    <link rel="shortcut icon" href="uploads/Captura_de_tela_2026-06-11_160453-removebg-preview.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container-center">
        <!-- Adicionada a classe 'enchanted-carriage' para a estilização mágica idêntica -->
        <div class="magic-card enchanted-carriage">
            <div style="font-size: 45px; margin-bottom: 15px;">🪄</div>
            <h2>Seu desejo foi concedido</h2>
            <p>★ Sua reserva real foi confirmada com sucesso! ★</p>

            <div class="booking-details">
                <div class="detail-row">
                    <span class="detail-label">ID da Reserva</span>
                    <span class="detail-value">#<?php echo htmlspecialchars($_SESSION['reserva_id']); ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Personagem</span>
                    <span class="detail-value"><?php echo htmlspecialchars($_SESSION['personagem_nome']); ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Categoria</span>
                    <span class="detail-value"><?php echo htmlspecialchars($_SESSION['personagem_categoria']); ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Local da Festa</span>
                    <span class="detail-value">
                        <?php echo htmlspecialchars($_SESSION['rua']); ?>, <?php echo htmlspecialchars($_SESSION['numero']); ?><br>
                        <small><?php echo htmlspecialchars($_SESSION['bairro']); ?> - <?php echo htmlspecialchars($_SESSION['cidade']); ?></small>
                    </span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Data</span>
                    <span class="detail-value"><?php echo date('d/m/Y', strtotime($_SESSION['data_festa'])); ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Horário</span>
                    <span class="detail-value"><?php echo htmlspecialchars($_SESSION['horario_inicio']); ?> - <?php echo htmlspecialchars($_SESSION['horario_termino']); ?></span>
                </div>
            </div>

            <div style="background: #F9FAFB; border: 1px solid #F3F4F6; border-radius: 12px; padding: 20px; display: flex; justify-content: space-around; margin-bottom: 25px;">
                <div style="text-align: left;">
                    <small style="color:#9CA3AF; font-size:10px; font-weight:700; text-transform:uppercase;">Status</small>
                    <div style="color: #10B981; font-weight: 700; font-size: 14px;">● Ativo</div>
                </div>
                <div style="text-align: left;">
                    <small style="color:#9CA3AF; font-size:10px; font-weight:700; text-transform:uppercase;">Experiência</small>
                    <div style="color: var(--purple-royal); font-weight: 700; font-size: 14px;">Conto de Fadas</div>
                </div>
            </div>

            <p style="color: #6B7280; font-size: 13px; line-height: 1.6; margin-bottom: 30px;">
                Um corvo mensageiro foi enviado para o seu e-mail com todos os detalhes da celebração. Prepare o coração para a magia!
            </p>

            <a href="vitrine.php" class="btn-action" style="display:block; text-decoration:none;">Voltar para o Início 🏰</a>
        </div>
    </div>
    
<!-- Inclui a biblioteca de Confetes via CDN -->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    
    <script>
        function lancarConfetes() {
            var duracao = 3 * 1000; // 3 segundos de confetes
            var fim = Date.now() + duracao;

            // Definindo as cores mágicas (Roxo Royal, Ouro Mágico, Roxo Claro e Ouro Escuro)
            var coresEnchanted = ['#7700ff', '#ffe600', '#6C429C', '#D49626'];

            (function frame() {
                // Lançamento da esquerda
                confetti({
                    particleCount: 3,
                    angle: 60,
                    spread: 55,
                    origin: { x: 0, y: 0.8 },
                    colors: coresEnchanted 
                });
                
                // Lançamento da direita
                confetti({
                    particleCount: 3,
                    angle: 120,
                    spread: 55,
                    origin: { x: 1, y: 0.8 },
                    colors: coresEnchanted 
                });

                if (Date.now() < fim) {
                    requestAnimationFrame(frame);
                }
            }());
        }

        // Executa a animação assim que a página carrega
        window.onload = function() {
            lancarConfetes();
        };
    </script>
</body>
</html>