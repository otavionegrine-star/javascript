<?php
session_start();
require_once __DIR__ . '/config/database.php';

// Bloqueia acesso de funcionários - apenas clientes podem reservar
if (!isset($_SESSION['papel']) || $_SESSION['papel'] !== 'cliente') {
    header("Location: vitrine.php");
    exit;
}

$personagem_id = $_GET['id'] ?? null;
if (!$personagem_id) {
    header("Location: vitrine.php");
    exit;
}

// Resgata os dados da entidade selecionada
$stmt = $pdo->prepare("SELECT * FROM personagem WHERE id = :id");
$stmt->execute(['id' => $personagem_id]);
$p = $stmt->fetch(PDO::FETCH_ASSOC);

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cliente_id = $_SESSION['user_id'];
    
    $cidade = $_POST['cidade'];
    $bairro = $_POST['bairro'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $data = $_POST['data_festa'];
    $inicio = $_POST['horario_inicio'];
    $termino = $_POST['horario_termino'];

    // --- VALIDAÇÃO DE SEGURANÇA: Limite de 4 dígitos para o número da casa ---
    if (strlen($numero) > 4) {
        $erro = '❌ O número da residência não pode ter mais do que 4 dígitos!';
    }

    if (empty($erro)) {
        // Validar conflito de horário - verificar se existe reserva no mesmo dia/horário para este personagem
        $stmt = $pdo->prepare("
            SELECT COUNT(*) as conflitos FROM alugar_personagem 
            WHERE personagem_id = :personagem_id 
            AND data_festa = :data 
            AND status = 'Ativo'
            AND (
                (horario_inicio <= :inicio AND horario_termino > :inicio) OR
                (horario_inicio < :termino AND horario_termino >= :termino) OR
                (horario_inicio >= :inicio AND horario_termino <= :termino)
            )
        ");
        
        $stmt->execute([
            'personagem_id' => $personagem_id,
            'data' => $data,
            'inicio' => $inicio,
            'termino' => $termino
        ]);
        
        $resultado = $stmt->fetch();
        
        if ($resultado['conflitos'] > 0) {
            $erro = '❌ Este personagem já está reservado neste horário! Escolha outra data ou horário.';
        } else {
            $stmt = $pdo->prepare("INSERT INTO alugar_personagem (cliente_id, personagem_id, cidade, bairro, rua, numero, data_festa, horario_inicio, horario_termino) 
                                   VALUES (:c_id, :p_id, :cidade, :bairro, :rua, :numero, :data, :ini, :term) RETURNING id");
            $stmt->execute([
                'c_id' => $cliente_id,
                'p_id' => $personagem_id,
                'cidade' => $cidade,
                'bairro' => $bairro,
                'rua' => $rua,
                'numero' => $numero,
                'data' => $data,
                'ini' => $inicio,
                'term' => $termino
            ]);
            $reserva = $stmt->fetch();

            // Armazenar dados em sessão para exibir em sucesso.php
            $_SESSION['reserva_id'] = $reserva['id'];
            $_SESSION['personagem_nome'] = $p['nome'];
            $_SESSION['personagem_categoria'] = $p['categoria'];
            $_SESSION['cidade'] = $cidade;
            $_SESSION['bairro'] = $bairro;
            $_SESSION['rua'] = $rua;
            $_SESSION['numero'] = $numero;
            $_SESSION['data_festa'] = $data;
            $_SESSION['horario_inicio'] = $inicio;
            $_SESSION['horario_termino'] = $termino;

            header("Location: sucesso.php");
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Reserve Sua Experiência</title>
    <link rel="shortcut icon" href="uploads/Captura_de_tela_2026-06-11_160453-removebg-preview.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container-center">
        <div class="booking-container">
            <div class="booking-sidebar">
                <img src="<?php echo htmlspecialchars($p['imagem_url']); ?>" alt="">
                <div class="sidebar-overlay">
                    <span class="card-badge" style="width:fit-content;"><?php echo htmlspecialchars($p['categoria']); ?></span>
                    <h2 style="color:white; margin:10px 0 0 0;"><?php echo htmlspecialchars($p['nome']); ?></h2>
                </div>
            </div>

            <div class="booking-form-area">
                <h3 style="color:var(--purple-royal); margin-top:0;">Reserve Sua Experiência</h3>
                <p style="color:#666; font-size:13px; margin-bottom:30px;">Preencha os detalhes para garantir a presença real em seu evento.</p>

                <?php if (!empty($erro)): ?>
                    <div style="background: #FEE2E2; color: #991B1B; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-size: 13px;">
                        <?php echo htmlspecialchars($erro); ?>
                    </div>
                <?php endif; ?>

                <form method="POST">
                    <div class="form-group">
                        <label>Cidade</label>
                        <input type="text" name="cidade" class="form-control" placeholder="Ex: São Paulo" required>
                    </div>

                    <div class="form-group">
                        <label>Bairro</label>
                        <input type="text" name="bairro" class="form-control" placeholder="Ex: Zona Sul, Centro" required>
                    </div>

                    <div class="form-group">
                        <label>Rua</label>
                        <input type="text" name="rua" class="form-control" placeholder="Ex: Rua das Flores" required>
                    </div>

                    <!-- Campo de número com a limitação inserida mantendo o estilo original -->
                    <div class="form-group">
                        <label>Número</label>
                        <input type="text" name="numero" class="form-control" placeholder="Ex: 123" maxlength="4" pattern="\d*" title="O número deve ter no máximo 4 dígitos" required>
                    </div>

                    <div class="time-row">
                        <div class="form-group">
                            <label>Dia da Festa</label>
                            <input type="date" name="data_festa" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Horário de Início</label>
                            <input type="time" name="horario_inicio" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Horário de Término</label>
                        <input type="time" name="horario_termino" class="form-control" required>
                    </div>

                    <button type="submit" class="btn-action">💫 Contratar Magia</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>