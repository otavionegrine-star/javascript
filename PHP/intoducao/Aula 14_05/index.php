<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $valor = $_POST["valor"] ?? 0;
    $dolar = $_POST["dolar"] ?? 0;
    $result = $valor / $dolar;
    echo "<h2>Resultado da conversão: </h2>";

    echo "<p>Valor em Reais (R$) " . number_format($valor, 2, ",", ".") . "</p>";
    echo "<p><strong>Valor em Doletas (US$): " . number_format($dolar, 2, ",", ".") . "</p>";
}
?>