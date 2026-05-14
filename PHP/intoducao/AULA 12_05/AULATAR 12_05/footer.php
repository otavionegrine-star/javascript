<hr>
<footer>© 2026 Empresa XYZ</footer>


HEADER


<h1>Sistema da Empresa</h1>
<hr>
Arquivo index.php:
<?php
include "header.php";
echo "Página inicial";
?>


INDEX


<?php
require "header.php"; // Se header.php não for encontrado, o script será interrompido
echo "Página inicial";
require "footer.php"; // Necessário para rodapé
?>


INCLUDE


<?php 
include "header.php";
echo "pagina inicial";
include "footer"
?>
