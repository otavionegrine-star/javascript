<?php
// funcoes.php

function analisarSalario($salarioDigitado) {
    $minimo = 1621.00; // Valor atualizado conforme sua solicitação
    
    // Calcula quantos salários inteiros cabem
    $quantidadeInteira = floor($salarioDigitado / $minimo);
    
    // Calcula o resto exato (a sobra)
    $resto = $salarioDigitado - ($quantidadeInteira * $minimo);
    
    return [
        'quantidade' => $quantidadeInteira,
        'resto' => $resto,
        'minimo_referencia' => $minimo
    ];
}

$analise = null;
if (isset($_POST['btn_analisar'])) {
    // Sanitiza e converte a entrada para float
    $salario = (float)str_replace(',', '.', $_POST['salario']) ?? 0;
    $analise = analisarSalario($salario);
}
?>