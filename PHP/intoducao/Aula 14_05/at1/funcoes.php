<?php
// Lógica da Calculadora
$numero = null; $ant = null; $post = null;
if (isset($_GET['num']) && $_GET['num'] !== "") {
    $numero = (int)$_GET['num'];
    $ant = $numero - 1;
    $post = $numero + 1;
}
?>