<?php
require_once __DIR__ . '/config/database.php';

try {
    echo "<h2>🔧 Executando Migração...</h2>";
    
    // Adiciona colunas de endereço 
    $stmt = $pdo->query("
        SELECT column_name FROM information_schema.columns 
        WHERE table_name = 'alugar_personagem' AND column_name = 'cidade'
    ");
    $exists = $stmt->fetch();
    
    if (!$exists) {
        echo "<p>Adicionando colunas de endereço...</p>";
        
        try {
            $pdo->exec("ALTER TABLE alugar_personagem DROP COLUMN local_festa");
            echo "<p>✓ Removida coluna 'local_festa'</p>";
        } catch (Exception $e) {}
        
        $pdo->exec("ALTER TABLE alugar_personagem ADD COLUMN cidade VARCHAR(255)");
        echo "<p>✓ Adicionada coluna 'cidade'</p>";
        
        $pdo->exec("ALTER TABLE alugar_personagem ADD COLUMN bairro VARCHAR(255)");
        echo "<p>✓ Adicionada coluna 'bairro'</p>";
        
        $pdo->exec("ALTER TABLE alugar_personagem ADD COLUMN rua VARCHAR(255)");
        echo "<p>✓ Adicionada coluna 'rua'</p>";
        
        $pdo->exec("ALTER TABLE alugar_personagem ADD COLUMN numero VARCHAR(4)");
        echo "<p>✓ Adicionada coluna 'numero'</p>";
    } else {
        echo "<p>✓ Colunas de endereço já existem</p>";
    }
    
    // Adiciona coluna de senha
    $stmt = $pdo->query("
        SELECT column_name FROM information_schema.columns 
        WHERE table_name = 'cliente' AND column_name = 'senha'
    ");
    $exists = $stmt->fetch();
    
    if (!$exists) {
        echo "<p>Adicionando coluna de senha...</p>";
        
        $pdo->exec("ALTER TABLE cliente ADD COLUMN senha VARCHAR(255)");
        echo "<p>✓ Adicionada coluna 'senha' em cliente</p>";
        
        $pdo->exec("ALTER TABLE funcionario ADD COLUMN senha VARCHAR(255)");
        echo "<p>✓ Adicionada coluna 'senha' em funcionario</p>";
    } else {
        echo "<p>✓ Coluna de senha já existe</p>";
    }
    
    echo "<h2 style='color: green;'>✅ Migração concluída com sucesso!</h2>";
    echo "<p><a href='vitrine.php'>← Voltar para a Vitrine</a></p>";
    
} catch (PDOException $e) {
    echo "<h2 style='color: red;'>❌ Erro na Migração</h2>";
    echo "<pre>" . htmlspecialchars($e->getMessage()) . "</pre>";
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Setup - Enchanted</title>
    <link rel="shortcut icon" href="uploads/Captura_de_tela_2026-06-11_160453-removebg-preview.png" type="image/x-icon">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: #f5f3fc;
        }
        h2 { color: #4A2574; }
        p { line-height: 1.6; }
        pre {
            background: #f0f0f0;
            padding: 10px;
            border-radius: 5px;
            overflow-x: auto;
        }
    </style>
</head>
<body>
</body>
</html>
