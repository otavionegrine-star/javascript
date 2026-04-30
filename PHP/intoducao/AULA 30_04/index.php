<?php
// FUNÇÃO 1: Calcula o valor do bônus (Com parâmetros e COM retorno)
function calcularBonus($salario, $taxa) {
    return $salario * $taxa; 
}

// FUNÇÃO 2: Mostra os dados na tela (Com parâmetros e SEM retorno - apenas exibe)
function mostrarFuncionario($nome, $valorFinal) {
    echo "Funcionário: $nome | Total: R$ $valorFinal <br>";
}

//USO DO SISTEMA

$salarioBase = 2000;

// Reutilizando a função de cálculo para dois funcionários
$bonusAna = calcularBonus($salarioBase, 0.1); // 10% de bônus
$bonusJose = calcularBonus($salarioBase, 0.2); // 20% de bônus

// Reutilizando a função de exibição
mostrarFuncionario("Ana Silva", $salarioBase + $bonusAna);
mostrarFuncionario("Jose Santos", $salarioBase + $bonusJose);
?>