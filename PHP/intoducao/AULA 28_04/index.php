<?php
// Dados da Empresa
$nome = "Padaria do João";
$funcionarios = 12;
$setor = "Comércio";

echo "<h1>Relatório: $nome</h1>";

//Uso de IF / ELSE
if ($funcionarios < 10) {
    echo "<p>Porte: Microempresa</p>";
} else {
    echo "<p>Porte: Pequena Empresa</p>";
}

//Uso de SWITCH (Decisão de Imposto por Setor)
switch ($setor) {
    case "Indústria":
        echo "Imposto: 12%";
        break;
    case "Comércio":
        echo "Imposto: 7%";
        break;
    case "Serviços":
        echo "Imposto: 10%";
        break;
    default:
        echo "Imposto: A consultar";
        break;
}
?>