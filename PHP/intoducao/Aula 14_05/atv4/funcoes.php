<?php
// logic/processamento.php

function calcularReajuste($valor, $porcentagem) {
    $valor = (float)$valor;
    $porcentagem = (float)$porcentagem;
    
    $aumento = ($valor * $porcentagem) / 100;
    return $valor + $aumento;
}