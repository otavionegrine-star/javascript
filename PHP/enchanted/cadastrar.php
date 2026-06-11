<?php
session_start();
require_once __DIR__ . '/config/database.php';

// Segurança: Bloqueia acesso de clientes comuns
if (!isset($_SESSION['papel']) || $_SESSION['papel'] !== 'funcionario') {
    header("Location: registro.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $categoria = $_POST['categoria'];
    $descricao = $_POST['descricao'];
    $imagem_url = 'uploads/default.png';

    // Gerenciamento e upload físico da foto do personagem
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        // Criar pasta uploads se não existir
        $upload_dir = __DIR__ . '/uploads';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        
        $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $novo_nome = uniqid('magic_') . '.' . $ext;
        $destino = $upload_dir . '/' . $novo_nome;

        if (move_uploaded_file($_FILES['foto']['tmp_name'], $destino)) {
            $imagem_url = 'uploads/' . $novo_nome;
        }
    }

    $stmt = $pdo->prepare("INSERT INTO personagem (nome, categoria, descricao, imagem_url, cadastrado_por_id) 
                           VALUES (:nome, :categoria, :descricao, :img, :func)");
    $stmt->execute([
        'nome' => $nome,
        'categoria' => $categoria,
        'descricao' => $descricao,
        'img' => $imagem_url,
        'func' => $_SESSION['user_id']
    ]);

    header("Location: vitrine.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Novo Personagem</title>
    <link rel="shortcut icon" href="uploads/Captura_de_tela_2026-06-11_160453-removebg-preview.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="navbar" style="margin-bottom: 20px;">
        <a href="vitrine.php" class="brand">Enchanted</a>
        <nav class="nav-menu">
            <a href="vitrine.php">Characters</a>
            <a href="cadastrar.php" class="active">Cadastrar Novo</a>
            <a href="reservas.php">Reservas</a>
            <span style="color: #666; font-size: 14px;">👤 <?php echo htmlspecialchars($_SESSION['nome'] ?? 'Funcionário'); ?></span>
            <a href="logout.php">Sair</a>
        </nav>
    </header>
    <div class="container-center">
        <div class="magic-card enchanted-carriage">
            <h2>Cadastrar Novo Personagem</h2>
            <p>Adicione um novo membro ao nosso reino mágico.</p>

            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Nome do Personagem</label>
                    <input type="text" name="nome" class="form-control" placeholder="Ex: Cinderela ou Cavaleiro Real" required>
                </div>

                <div class="form-group">
                    <label>Categoria Mágica</label>
                    <select name="categoria" class="form-control" required>
                        <option value="Personagens de Desenho">Personagens de Desenho</option>
                        <option value="Heróis">Heróis</option>
                        <option value="Outros">Outros</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Descrição das Atividades</label>
                    <textarea name="descricao" class="form-control" rows="3" placeholder="Insira o resumo da atuação..." required></textarea>
                </div>

                <div class="form-group">
                    <label>Foto do Personagem</label>
                    <div class="upload-container">
                        <input type="file" name="foto" accept="image/*" required>
                        <p style="margin:0; font-size:13px; color:#555;">Selecione uma imagem mágica<br><small>JPEG, PNG ou WEBP</small></p>
                    </div>
                </div>

                <button type="submit" class="btn-action">✨ Cadastrar Personagem</button>
            </form>
        </div>
    </div>
</body>
</html>