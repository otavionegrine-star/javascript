<?php
// Inclui o arquivo de funções para acessar sessão e cookies
require_once "funcoes.php";
?>
<?php
// Inclui o cabeçalho da página
include "header.php";
?>

    <!-- Conteúdo da página de perfil -->
    <div style="text-align: center;">
        <h3>Seu Perfil</h3>
        <p><strong>Nome:</strong> <?php echo $nome_display ?? 'Visitante'; ?></p>
        <p><strong>Tema Atual:</strong> <?php echo ucfirst($tema_atual ?? 'light'); ?></p>
        <p>Esta página demonstra que os dados são mantidos entre navegações usando sessão e cookies.</p>

        <!-- Link para voltar à página inicial -->
        <div style="margin-top: 2rem;">
            <a href="index.php" style="color: var(--primary); text-decoration: none;">← Voltar às Configurações</a>
        </div>
    </div>

<?php
// Inclui o rodapé da página
include "footer.php";
?>