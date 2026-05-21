<?php
require_once 'connect_postgres.php';

$sql = "UPDATE alunos
SET sobrenome = 'Costa'
WHERE id = 1";

$conexao->exec($sql);

echo "Aluno atualizando com sucesso!";

?>