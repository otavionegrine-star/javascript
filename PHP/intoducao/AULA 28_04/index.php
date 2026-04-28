<?php
//DADOS
$nome = "Loja de Celulares";
$vendas = 15000;
$custos = 8000;
$meta = 12000;

//CÁLCULOS ARITMÉTICOS 
$lucro = $vendas - $custos; // Subtração
$projeçãoProximoMes = $vendas * 1.10; // Multiplicação (Aumento de 10%)

//COMPARAÇÃO
$bateuMeta = $vendas >= $meta; // Verifica se vendas é maior ou igual à meta

//XIBIÇÃO (Com concatenação)
echo "<h1>Relatório da " . $nome . "</h1>";

echo "Vendas: R$ " . $vendas . "<br>";
echo "Custos: R$ " . $custos . "<br>";
echo "<b>Lucro Real: R$ " . $lucro . "</b><br>";

echo "<hr>";

echo "Meta do mês: R$ " . $meta . "<br>";

//Mostra se bateu a meta usando a comparação
if ($bateuMeta) {
    echo "Status: <span style='color:green'>Meta Atingida!</span>";
} else {
    echo "Status: <span style='color:red'>Abaixo da Meta.</span>";
}

echo "<br>Projeção para o mês que vem: R$ " . $projeçãoProximoMes;
?>