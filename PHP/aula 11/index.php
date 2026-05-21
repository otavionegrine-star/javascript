<?php

$host = "localhost";
$dbname = "escola";
$user = "postgres";
$pass = "postgres";

try {
    $conexao = new PDO(
        "pgsql:host=$host;dbname=$dbname",
        $user,
        $pass
    );
    echo "Conexão com o Postgres realizada!<br>";
} catch (PDOException $e) {
    // Corrigido de => para ->
    echo "Erro: " . $e->getMessage(); 
}
?>