<?php
session_start();
require_once __DIR__ . '/config/database.php';

// Bloqueia se não for cliente
if (!isset($_SESSION['papel']) || $_SESSION['papel'] !== 'cliente') {
    header("Location: login.php");
    exit;
}

$cliente_id = $_SESSION['user_id'];

// Busca apenas as reservas do cliente logado
$stmt = $pdo->prepare("
    SELECT 
        a.id,
        a.data_festa,
        a.horario_inicio,
        a.horario_termino,
        a.status,
        a.cidade,
        a.bairro,
        a.rua,
        a.numero,
        p.nome as personagem_nome,
        p.categoria
    FROM alugar_personagem a
    JOIN personagem p ON a.personagem_id = p.id
    WHERE a.cliente_id = :cliente_id
    ORDER BY a.data_festa DESC
");
$stmt->execute(['cliente_id' => $cliente_id]);
$reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Minhas Reservas - Enchanted</title>
    <link rel="shortcut icon" href="uploads/Captura_de_tela_2026-06-11_160453-removebg-preview.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .reservas-table { width: 100%; border-collapse: collapse; margin-top: 30px; }
        .reservas-table th, .reservas-table td { padding: 15px; text-align: left; border-bottom: 1px solid #E5E7EB; }
        .reservas-table th { background: var(--purple-royal); color: white; font-weight: 600; }
        .reservas-table tr:hover { background: #F9FAFB; }
        .status-badge { padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .status-ativo { background: #D1FAE5; color: #065F46; }
        .status-cancelado { background: #FEE2E2; color: #991B1B; }
        .reservas-container { max-width: 1200px; margin: 0 auto; padding: 40px 20px; }
    </style>
</head>
<body>
    <header class="navbar">
        <a href="vitrine.php" class="brand">Enchanted</a>
        <nav class="nav-menu">
            <a href="vitrine.php">Characters</a>
            <a href="minhas_reservas.php" class="active">Minhas Reservas</a>
            <span style="color: #666; font-size: 14px;">👤 <?php echo htmlspecialchars($_SESSION['nome']); ?></span>
            <a href="logout.php">Sair</a>
        </nav>
    </header>

    <div class="reservas-container">
        <h1 style="color: var(--purple-royal); margin-bottom: 30px;">🔮 Minhas Reservas Mágicas</h1>
        
        <?php if (empty($reservas)): ?>
            <div style="text-align: center; padding: 40px; color: #9CA3AF;">
                <p style="font-size: 18px;">Você ainda não realizou nenhuma reserva.</p>
                <a href="vitrine.php" class="btn-action" style="display:inline-block; text-decoration:none; margin-top:15px;">Encontrar um Herói</a>
            </div>
        <?php else: ?>
            <table class="reservas-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Personagem</th>
                        <th>Local do Evento</th>
                        <th>Data</th>
                        <th>Horário</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reservas as $r): ?>
                        <tr>
                            <td><strong>#<?php echo htmlspecialchars($r['id']); ?></strong></td>
                            <td>
                                <strong><?php echo htmlspecialchars($r['personagem_nome']); ?></strong><br>
                                <small style="color: #9CA3AF;"><?php echo htmlspecialchars($r['categoria']); ?></small>
                            </td>
                            <td>
                                <small>
                                    <?php echo htmlspecialchars($r['rua']); ?>, <?php echo htmlspecialchars($r['numero']); ?><br>
                                    <?php echo htmlspecialchars($r['bairro']); ?> - <?php echo htmlspecialchars($r['cidade']); ?>
                                </small>
                            </td>
                            <td><?php echo date('d/m/Y', strtotime($r['data_festa'])); ?></td>
                            <td><?php echo htmlspecialchars($r['horario_inicio']); ?> - <?php echo htmlspecialchars($r['horario_termino']); ?></td>
                            <td>
                                <span class="status-badge <?php echo ($r['status'] === 'Cancelado') ? 'status-cancelado' : 'status-ativo'; ?>">
                                    <?php echo htmlspecialchars($r['status']); ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>