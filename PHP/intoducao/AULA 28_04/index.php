<?php

echo "<h1>Relatório de Verificação de Estoque</h1>";
echo "<table border='1' style='width: 300px; text-align: center;'>";
echo "<thead><tr><th>Item ID</th><th>Status</th></tr></thead>";
echo "<tbody>";

//Uso de FOR para repetir a verificação de 10 itens
for ($item = 1; $item <= 10; $item++) {
    
    echo "<tr>";
    echo "<td>Produto #$item</td>";

    //Lógica integrada (IF) para decidir o status do item
    //Aqui, simulamos que itens ímpares estão com estoque baixo
    if ($item % 2 != 0) {
        echo "<td style='color: red;'><strong>REPOR ESTOQUE</strong></td>";
    } else {
        echo "<td style='color: green;'>Disponível</td>";
    }

    echo "</tr>";
}

echo "</tbody></table>";

echo "<p><em>Relatório gerado automaticamente pelo sistema.</em></p>";
?>