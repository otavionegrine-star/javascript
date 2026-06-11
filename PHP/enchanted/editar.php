<?php
session_start();
require_once __DIR__ . '/config/database.php';

// Segurança: Apenas funcionários podem acessar
if (!isset($_SESSION['papel']) || $_SESSION['papel'] !== 'funcionario') {
    header("Location: registro.php");
    exit;
}

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: vitrine.php");
    exit;
}

// CORREÇÃO: Alterado de 'personaje' para 'personagem'
$stmt = $pdo->prepare("SELECT * FROM personagem WHERE id = :id");
$stmt->execute(['id' => $id]);
$p = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$p) {
    header("Location: vitrine.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $categoria = $_POST['categoria'];
    $descricao = $_POST['descricao'];
    $imagem_url = $p['imagem_url']; // Mantém a foto antiga por padrão

    // Se uma nova foto foi enviada
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
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

    // Atualiza no banco de dados respeitando a tabela 'personagem'
    $stmt = $pdo->prepare("UPDATE personagem SET nome = :nome, categoria = :categoria, descricao = :descricao, imagem_url = :img WHERE id = :id");
    $stmt->execute([
        'nome' => $nome,
        'categoria' => $categoria,
        'descricao' => $descricao,
        'img' => $imagem_url,
        'id' => $id
    ]);

    header("Location: vitrine.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Personagem - Enchanted</title>
    <link rel="shortcut icon" href="uploads/Captura_de_tela_2026-06-11_160453-removebg-preview.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="navbar" style="margin-bottom: 20px;">
        <a href="vitrine.php" class="brand">Enchanted</a>
        <nav class="nav-menu">
            <a href="vitrine.php">Characters</a>
            <a href="cadastrar.php">Cadastrar Novo</a>
            <a href="reservas.php">Reservas</a>
            <span style="color: #666; font-size: 14px;">👤 <?php echo htmlspecialchars($_SESSION['nome'] ?? 'Funcionário'); ?></span>
            <a href="logout.php">Sair</a>
        </nav>
    </header>

    <div class="container-center">
        <div class="magic-card enchanted-carriage">
            <h2>Editar Personagem</h2>
            <p>Modifique as propriedades deste membro do reino.</p>

            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Nome do Personagem</label>
                    <input type="text" name="nome" class="form-control" value="<?php echo htmlspecialchars($p['nome']); ?>" required>
                </div>

                <div class="form-group">
                    <label>Categoria Mágica</label>
                    <select name="categoria" class="form-control" required>
                        <option value="Personagens de Desenho" <?php echo $p['categoria'] === 'Personagens de Desenho' ? 'selected' : ''; ?>>Personagens de Desenho</option>
                        <option value="Heróis" <?php echo $p['categoria'] === 'Heróis' ? 'selected' : ''; ?>>Heróis</option>
                        <option value="Outros" <?php echo $p['categoria'] === 'Outros' ? 'selected' : ''; ?>>Outros</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Descrição das Atividades</label>
                    <textarea name="descricao" class="form-control" rows="3" required><?php echo htmlspecialchars($p['descricao']); ?></textarea>
                </div>

                <div class="form-group">
                    <label>Foto do Personagem (Deixe em branco para manter a atual)</label>
                    <div style="margin-bottom: 10px;">
                        <img src="<?php echo htmlspecialchars($p['imagem_url']); ?>" width="80" style="border-radius:8px; border: 1px solid #ddd;">
                    </div>
                    <div class="upload-container">
                        <input type="file" name="foto" accept="image/*">
                        <p style="margin:0; font-size:13px; color:#555;">Selecione uma nova imagem mágica se desejar alterar<br><small>JPEG, PNG ou WEBP</small></p>
                    </div>
                </div>

                <button type="submit" class="btn-action">✨ Salvar Alterações</button>
                <a href="vitrine.php" style="display: block; text-align: center; margin-top: 15px; color: #666; text-decoration: none; font-size: 14px;">Cancelar</a>
            </form>
        </div>
    </div>
</body>
</html>