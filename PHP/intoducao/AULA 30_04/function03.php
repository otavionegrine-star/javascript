<?php
function calcularTempoEmpresa($anoFundacao, $anoAtual) {
	return $anoAtual - $anoFundacao;
}

$tempo = calcularTempoEmpresa(2010, 2026);

echo "Tempo de empresa: $tempo anos";
?>
