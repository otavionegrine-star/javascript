<?php
echo "<table border = '1'><tbody>";

for ($i = 1; $i <= 10; $i++){
    if ($i % 2 == 0) {
        echo "<tr>";
        echo "<td>$i é par <br></td>";
        echo "</tr>";
    }
}

echo "</tbody></table>";
?>