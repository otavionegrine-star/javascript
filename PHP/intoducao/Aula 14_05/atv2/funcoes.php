<?php
// funcoes.php
function gerarSorteioMegaSena() {
    $numeros = [];
    while (count($numeros) < 6) {
        $n = mt_rand(1, 60);
        if (!in_array($n, $numeros)) {
            $numeros[] = $n;
        }
    }
    sort($numeros); 
    return implode('-', array_map(function($n) {
        return str_pad($n, 2, "0", STR_PAD_LEFT);
    }, $numeros));
}

$resultado_mega = null;
if (isset($_POST['btn_sortear_mega'])) {
    $resultado_mega = gerarSorteioMegaSena();
}
?>