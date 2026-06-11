<?php
session_start();
require_once __DIR__ . '/config/database.php';

$erro = '';
$sucesso = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $confirma_senha = $_POST['confirma_senha'] ?? '';
    $papel = $_POST['papel'] ?? 'cliente';

    // Validação
    if (empty($nome) || empty($email) || empty($senha) || empty($confirma_senha)) {
        $erro = 'Todos os campos são obrigatórios!';
    } elseif (strlen($senha) < 6) {
        $erro = 'A senha deve ter no mínimo 6 caracteres!';
    } elseif ($senha !== $confirma_senha) {
        $erro = 'As senhas não coincidem!';
    } else {
        $table = ($papel === 'funcionario') ? 'funcionario' : 'cliente';
        
        // Hash da senha
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        
        try {
            // Tenta inserir ou atualizar
            $stmt = $pdo->prepare("INSERT INTO $table (nome, email, senha) VALUES (:nome, :email, :senha) 
                                   ON CONFLICT (email) DO UPDATE SET nome = :nome, senha = :senha RETURNING id");
            $stmt->execute(['nome' => $nome, 'email' => $email, 'senha' => $senha_hash]);
            $user = $stmt->fetch();

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nome'] = $nome;
            $_SESSION['papel'] = $papel;

            header("Location: vitrine.php");
            exit;
        } catch (PDOException $e) {
            $erro = '❌ Este email já está cadastrado! Faça login para continuar.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Enchanted - Crie sua Conta</title>
    <link rel="shortcut icon" href="uploads/Captura_de_tela_2026-06-11_160453-removebg-preview.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container-center">
        <!-- Mantém a classe 'enchanted-carriage' para a borda dourada igual ao index -->
        <div class="magic-card enchanted-carriage">
            <!-- A tag <h1> com o título "Enchanted" foi removida daqui -->
            <h2> Crie sua Conta</h2>
            <p>Junte-se ao nosso reino mágico e comece a viver experiências incríveis.</p>
            
            <?php if (!empty($erro)): ?>
                <div style="background: #FEE2E2; color: #991B1B; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-size: 13px;">
                    <?php echo htmlspecialchars($erro); ?>
                </div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="form-group">
                    <label>Como devemos te chamar?</label>
                    <input type="text" name="nome" class="form-control" placeholder="Seu nome completo" required>
                </div>

                <div class="form-group">
                    <label>Seu pergaminho digital (E-mail)</label>
                    <input type="email" name="email" class="form-control" placeholder="exemplo@magia.com" required>
                </div>

                <div class="form-group">
                    <label>Sua Senha Mágica</label>
                    <input type="password" name="senha" class="form-control" placeholder="••••••••" minlength="6" required>
                    <small style="color: #9CA3AF; font-size: 11px; display: block; margin-top: 4px;">Mínimo 6 caracteres</small>
                </div>

                <div class="form-group">
                    <label>Confirme sua Senha</label>
                    <input type="password" name="confirma_senha" class="form-control" placeholder="••••••••" minlength="6" required>
                </div>

                <button type="submit" class="btn-action">Criar Conta 🎉</button>
            </form>

            <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #E5E7EB; text-align: center;">
                <p style="margin: 0; font-size: 13px; color: #666;">Já tem conta?</p>
                <a href="login.php" style="color: var(--purple-royal); text-decoration: none; font-weight: 600;">Faça login aqui 🔐</a>
            </div>
        </div>
    </div>
</body>
</html>