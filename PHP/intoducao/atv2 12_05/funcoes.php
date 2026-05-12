<?php
// Inicia a sessão para gerenciar dados do usuário entre páginas
session_start();

/**
 * Processamento de dados do formulário
 * Salva o nome do usuário na sessão e a preferência de tema em cookie
 */
if (isset($_POST['salvar'])) {
    // Sanitiza e salva o nome do usuário na sessão
    $_SESSION['usuario'] = htmlspecialchars($_POST['usuario']);
    
    // Salva a preferência de tema em cookie por 30 dias
    $tema = $_POST['tema'];
    setcookie("pref_tema", $tema, time() + (30 * 24 * 60 * 60), "/");
    
    // Redireciona para evitar reenvio de formulário ao atualizar a página
    header("Location: index.php");
    exit;
}

/**
 * Configurações atuais do usuário
 * Define o nome para exibição e o tema atual
 */
$nome_display = $_SESSION['usuario'] ?? "Visitante"; // Nome do usuário da sessão ou padrão
$tema_atual = $_POST['tema'] ?? $_COOKIE['pref_tema'] ?? "light"; // Tema: prioriza POST, depois cookie, padrão light
?>