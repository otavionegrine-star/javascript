<?php
session_start();
require_once __DIR__ . '/config/database.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $papel = $_POST['papel'] ?? 'cliente';

    if (empty($email) || empty($senha)) {
        $erro = 'Email e senha são obrigatórios!';
    } else {
        $table = ($papel === 'funcionario') ? 'funcionario' : 'cliente';
        
        $stmt = $pdo->prepare("SELECT id, nome, email, senha FROM $table WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user && password_verify($senha, $user['senha'])) {
            // Login bem-sucedido
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nome'] = $user['nome'];
            $_SESSION['papel'] = $papel;
            
            header("Location: vitrine.php");
            exit;
        } else {
            $erro = '❌ Email ou senha incorretos!';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Enchanted - Entrar na Magia</title>
    <link rel="shortcut icon" href="uploads/Captura_de_tela_2026-06-11_160453-removebg-preview.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container-center">
        <div class="magic-card enchanted-carriage">
            <h1 class="enchanted-title"> Enchanted </h1>
            <h2> Entrar na Magia</h2>
            <p>Acesse seu portal de experiências mágicas.</p>
            
            <?php if (!empty($erro)): ?>
                <div style="background: #FEE2E2; color: #991B1B; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-size: 13px;">
                    <?php echo htmlspecialchars($erro); ?>
                </div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="form-group">
                    <label>Seu pergaminho digital (E-mail)</label>
                    <input type="email" name="email" class="form-control" placeholder="exemplo@magia.com" required>
                </div>

                <div class="form-group">
                    <label>Sua Senha Mágica</label>
                    <input type="password" name="senha" class="form-control" placeholder="••••••••" required>
                </div>

                <div class="form-group">
                    <label>Qual o seu papel no reino?</label>
                    <div class="role-selection">
                        <div class="role-box">
                            <input type="radio" name="papel" value="cliente" checked>
                            <div class="role-label">Cliente</div>
                        </div>
                        <div class="role-box">
                            <input type="radio" name="papel" value="funcionario">
                            <div class="role-label">Funcionário</div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-action">Entrar 🪄</button>
            </form>

            <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #E5E7EB; text-align: center;">
                <p style="margin: 0; font-size: 13px; color: #666;">Não tem conta?</p>
                <a href="registro.php" style="color: var(--purple-royal); text-decoration: none; font-weight: 600;">Crie sua conta agora ✨</a>
            </div>
        </div>
    </div>
</body>
</html>
