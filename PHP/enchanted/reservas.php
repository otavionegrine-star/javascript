<?php
session_start();
require_once __DIR__ . '/config/database.php';

// Apenas funcionários podem acessar
if (!isset($_SESSION['papel']) || $_SESSION['papel'] !== 'funcionario') {
    header("Location: registro.php");
    exit;
}

// Cancelar reserva
if (isset($_POST['cancelar_reserva'])) {
    $reserva_id = $_POST['cancelar_reserva'];
    
    $stmt = $pdo->prepare("UPDATE alugar_personagem SET status = :status WHERE id = :id");
    $stmt->execute(['status' => 'Cancelado', 'id' => $reserva_id]);
    
    header("Location: reservas.php");
    exit;
}

// Busca todas as reservas com informações do personagem e cliente
$stmt = $pdo->query("
    SELECT 
        a.id,
        a.cliente_id,
        a.personagem_id,
        a.data_festa,
        a.horario_inicio,
        a.horario_termino,
        a.status,
        a.experiencia,
        a.cidade,
        a.bairro,
        a.rua,
        a.numero,
        p.nome as personagem_nome,
        p.categoria,
        c.nome as cliente_nome,
        c.email as cliente_email
    FROM alugar_personagem a
    JOIN personagem p ON a.personagem_id = p.id
    JOIN cliente c ON a.cliente_id = c.id
    ORDER BY a.data_festa DESC
");
$reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Reservas - Enchanted</title>
    <link rel="shortcut icon" href="uploads/Captura_de_tela_2026-06-11_160453-removebg-preview.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .reservas-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }
        .reservas-table th,
        .reservas-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #E5E7EB;
        }
        .reservas-table th {
            background: var(--purple-royal);
            color: white;
            font-weight: 600;
        }
        .reservas-table tr:hover {
            background: #F9FAFB;
        }
        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        .status-ativo {
            background: #D1FAE5;
            color: #065F46;
        }
        .status-cancelado {
            background: #FEE2E2;
            color: #991B1B;
        }
        .btn-cancelar {
            background: #FEE2E2;
            color: #991B1B;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
        }
        .btn-cancelar:hover {
            background: #FCA5A5;
        }
        .reservas-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px 20px;
        }
    </style>
</head>
<body>
    <header class="navbar">
        <a href="vitrine.php" class="brand">Enchanted</a>
        <nav class="nav-menu">
            <a href="vitrine.php">Characters</a>
            <a href="cadastrar.php">Cadastrar Novo</a>
            <a href="reservas.php" class="active">Reservas</a>
            <span style="color: #666; font-size: 14px;">👤 <?php echo htmlspecialchars($_SESSION['nome'] ?? 'Funcionário'); ?></span>
            <a href="logout.php">Sair</a>
        </nav>
    </header>

    <div class="reservas-container">
        <h1 style="color: var(--purple-royal); margin-bottom: 30px;">📋 Gerenciamento de Reservas</h1>
        
        <?php if (empty($reservas)): ?>
            <div style="text-align: center; padding: 40px; color: #9CA3AF;">
                <p style="font-size: 18px;">Nenhuma reserva encontrada</p>
            </div>
        <?php else: ?>
            <table class="reservas-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Personagem</th>
                        <th>Cliente</th>
                        <th>E-mail</th>
                        <th>Local</th>
                        <th>Data</th>
                        <th>Horário</th>
                        <th>Status</th>
                        <th>Ação</th>
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
                            <td><?php echo htmlspecialchars($r['cliente_nome']); ?></td>
                            <td><?php echo htmlspecialchars($r['cliente_email']); ?></td>
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
                            <td>
                                <?php if ($r['status'] !== 'Cancelado'): ?>
                                    <form method="POST" style="display: inline;" onsubmit="return confirm('Tem certeza que deseja cancelar esta reserva?');">
                                        <input type="hidden" name="cancelar_reserva" value="<?php echo $r['id']; ?>">
                                        <button type="submit" class="btn-cancelar">Cancelar</button>
                                    </form>
                                <?php else: ?>
                                    <span style="color: #9CA3AF; font-size: 12px;">Cancelada</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
