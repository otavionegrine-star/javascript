<?php
// 1. Configurações de conexão com o banco de dados (PostgreSQL)
$host = 'localhost';
$port = '5432'; // Porta padrão do PostgreSQL
$dbname = 'empresa_pet';
$user = 'postgres'; // Seu usuário do Postgres
$password = 'postgres'; // Coloque sua senha aqui (se não houver, deixe vazio '')

try {
    // Criando a conexão via PDO
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    // Configura para disparar erros caso algo dê errado
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<div style='color: green; font-weight: bold;'>Conexão com o PostgreSQL realizada com sucesso!</div><hr>";

    // [OPCIONAL] Criar a tabela caso ela não exista (Garante que o código não quebre)
    $sqlCreateTable = "CREATE TABLE IF NOT EXISTS cachorros (
        id SERIAL PRIMARY KEY,
        nome VARCHAR(50) NOT NULL,
        raca VARCHAR(50),
        idade INT
    );";
    $pdo->exec($sqlCreateTable);

    // 2. Verificando se a tabela está vazia antes de inserir (Evita duplicar dados toda vez que der F5)
    $stmtCheck = $pdo->query("SELECT COUNT(*) FROM cachorros");
    $totalRegistros = $stmtCheck->fetchColumn();

    if ($totalRegistros == 0) {
        // 3. Inserindo os registros iniciais (Requisito Mínimo)
        $sqlInsert = "INSERT INTO cachorros (nome, raca, idade) VALUES 
                      ('Rex', 'Labrador', 3),
                      ('Mel', 'Poodle', 5),
                      ('Thor', 'Vira-lata', 2);";
        $pdo->exec($sqlInsert);
        echo "<p style='color: blue;'>Registros iniciais inseridos!</p>";
    }

    // 5. Executando o UPDATE de forma segura (Requisito Mínimo)
    // Atualizando a idade do Rex (ID 1) para 4 anos
    $sqlUpdate = "UPDATE cachorros SET idade = 4 WHERE id = 1;";
    $pdo->exec($sqlUpdate);
    echo "<p style='color: orange;'>UPDATE executado: Idade do Rex atualizada para 4 anos.</p>";

    // 4 e 6. Realizando o SELECT para buscar os dados atualizados (Requisito Mínimo)
    $stmtSelect = $pdo->query("SELECT * FROM cachorros ORDER BY id ASC");
    $cachorros = $stmtSelect->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // Caso haja erro na conexão ou no código SQL
    die("<div style='color: red; font-weight: bold;'>Erro na conexão ou na query: " . $e->getMessage() . "</div>");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Mini Desafio - Empresa Pet</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f4f4f9; }
        table { width: 50%; border-collapse: collapse; background-color: white; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #4CAF50; color: white; }
        tr:hover { background-color: #f5f5f5; }
        h2 { color: #333; }
    </style>
</head>
<body>

    <h2>Lista de Cachorros Cadastrados (Dados do Banco)</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Raça</th>
                <th>Idade</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($cachorros) > 0): ?>
                <?php foreach ($cachorros as $cachorro): ?>
                    <tr>
                        <td><?php echo $cachorro['id']; ?></td>
                        <td><?php echo $cachorro['nome']; ?></td>
                        <td><?php echo $cachorro['raca']; ?></td>
                        <td><?php echo $cachorro['idade']; ?> anos</td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Nenhum cachorro encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>