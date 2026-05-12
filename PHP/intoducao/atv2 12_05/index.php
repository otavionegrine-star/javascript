<?php
// Inclui o arquivo de funções que gerencia sessão e cookies
require_once "funcoes.php";
?>
<?php
// Inclui o cabeçalho da página com HTML inicial e estilos
include "header.php";
?>

    <!-- Formulário para configuração do usuário -->
    <form method="POST">
        <!-- Campo para nome do usuário -->
        <div class="form-group">
            <label>Seu Nome</label>
            <input type="text" name="usuario" placeholder="Como quer ser chamado?" required
                   value="<?php echo (($nome_display ?? 'Visitante') !== 'Visitante') ? $nome_display : ''; ?>">
        </div>

        <!-- Campo para preferência de tema -->
        <div class="form-group">
            <label>Preferência de Tema</label>
            <select name="tema">
                <option value="light" <?php echo (($tema_atual ?? 'light') === 'light') ? 'selected' : ''; ?>>☀️ Modo Claro</option>
                <option value="dark" <?php echo (($tema_atual ?? 'light') === 'dark') ? 'selected' : ''; ?>>🌙 Modo Escuro</option>
            </select>
        </div>

        <!-- Botão para salvar configurações -->
        <button type="submit" name="salvar">Salvar Configurações</button>
    </form>

    <!-- Link para navegação para outra página -->
    <div style="text-align: center; margin-top: 1rem;">
        <a href="perfil.php" style="color: var(--primary); text-decoration: none;">Ver Perfil →</a>
    </div>

<?php
// Inclui o rodapé da página com fechamento do HTML
include "footer.php";
?>