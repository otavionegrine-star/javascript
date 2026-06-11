<?php
session_start();
require_once __DIR__ . '/config/database.php';

// Apenas funcionários podem excluir personagens
if (isset($_POST['excluir_personagem']) && isset($_SESSION['papel']) && $_SESSION['papel'] === 'funcionario') {
    $personagem_id = $_POST['excluir_personagem'];
    
    $stmt = $pdo->prepare("DELETE FROM personagem WHERE id = :id");
    $stmt->execute(['id' => $personagem_id]);
    
    header("Location: vitrine.php");
    exit;
}

// Busca dinâmica de dados
$stmt = $pdo->query("SELECT * FROM personagem ORDER BY id DESC");
$personagens = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Enchanted - Encontre seu Herói</title>
    <link rel="shortcut icon" href="uploads/Captura_de_tela_2026-06-11_160453-removebg-preview.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="navbar">
        <a href="vitrine.php" class="brand">Enchanted</a>
        <nav class="nav-menu">
            <a href="vitrine.php" class="active">Characters</a>
            <?php if (isset($_SESSION['papel']) && $_SESSION['papel'] === 'funcionario'): ?>
                <a href="cadastrar.php">Cadastrar Novo</a>
                <a href="reservas.php">Reservas</a>
            <?php endif; ?>
            <?php if (isset($_SESSION['user_id'])): ?>
                <span style="color: #666; font-size: 14px;">👤 <?php echo htmlspecialchars($_SESSION['nome']); ?></span>
                <a href="logout.php">Sair</a>
            <?php else: ?>
                <a href="login.php">Entrar</a>
                <a href="registro.php">Cadastro</a>
            <?php endif; ?>
        </nav>
    </header>

    <main class="showcase-container">
        <div class="showcase-header">
            <span>★ SUA JORNADA COMEÇA AQUI ★</span>
            <h1>Encontre seu Herói ou Princesa</h1>
            
            <div class="search-wrapper">
                <input type="text" id="searchInput" class="search-input" placeholder="Pesquise por nome, conto ou categoria..." onkeyup="filtrarCards()">
            </div>

            <div class="category-filters">
                <button class="filter-btn active" onclick="filtrarCategoria('Todas as Categorias', this)">Todas as Categorias</button>
                <button class="filter-btn" onclick="filtrarCategoria('Personagens de Desenho', this)">Personagens de Desenho</button>
                <button class="filter-btn" onclick="filtrarCategoria('Heróis', this)">Heróis</button>
                <button class="filter-btn" onclick="filtrarCategoria('Outros', this)">Outros</button>
            </div>
        </div>

        <div class="grid-cards" id="charactersGrid">
            <?php foreach ($personagens as $p): ?>
                <div class="character-card" data-category="<?php echo htmlspecialchars($p['categoria']); ?>">
                    <img src="<?php echo htmlspecialchars($p['imagem_url']); ?>" alt="">
                    <div class="character-body">
                        <span class="card-badge"><?php echo htmlspecialchars($p['categoria']); ?></span>
                        <h3><?php echo htmlspecialchars($p['nome']); ?></h3>
                        <p><?php echo htmlspecialchars($p['descricao']); ?></p>
                        
                        <?php if (isset($_SESSION['papel']) && $_SESSION['papel'] === 'funcionario'): ?>
                            <form method="POST" style="display: inline;" onsubmit="return confirm('Tem certeza que deseja excluir este personagem?');">
                                <input type="hidden" name="excluir_personagem" value="<?php echo $p['id']; ?>">
                                <button type="submit" class="btn-action" style="background: #EF4444; margin-top: 10px;">🗑️ Excluir Personagem</button>
                            </form>
                        <?php else: ?>
                            <a href="reservar.php?id=<?php echo $p['id']; ?>" class="btn-action choose-character-btn">Escolher Este Personagem</a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <script>
        let categoriaAtual = 'Todas as Categorias';

        function filtrarCategoria(cat, el) {
            categoriaAtual = cat;
            document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
            if (el) el.classList.add('active');
            filtrarCards();
        }

        function filtrarCards() {
            let busca = document.getElementById('searchInput').value.toLowerCase();
            document.querySelectorAll('.character-card').forEach(card => {
                let nome = card.querySelector('h3').innerText.toLowerCase();
                let cat = card.getAttribute('data-category');
                
                let matchBusca = nome.includes(busca);
                let matchCat = categoriaAtual === 'Todas as Categorias' || cat === categoriaAtual;

                if(matchBusca && matchCat) {
                    card.style.display = "block";
                } else {
                    card.style.display = "none";
                }
            });
        }
    </script>
</body>
</html>