<?php
//String
$nome = "Padaria do João";

//String
$endereco = "Rua das Flores, 123";

//Integer
$vendasDia = 500;

//Float
$precoPao = 0.50;

//Boolea
$estaAberto = true;

echo "<h1>Ficha da Empresa</h1>";
echo "<b>Nome:</b> " . $nome . "<br>";
echo "<b>Endereço:</b> " . $endereco . "<br>";
echo "<b>Vendas hoje:</b> " . $vendasDia . " pães<br>";
echo "<b>Preço unitário:</b> R$ " . $precoPao . "<br>";

echo "<b>Status:</b> " . ($estaAberto ? "Estamos abertos!" : "Fechado");
?>