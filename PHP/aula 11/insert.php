<?php
require_once "index.php";

$sql = "INSERT INTO alunos(
nome,
sobrenome,
data_nascimento,
turma)
VALUES(
:nome,
:sobrenome,
:data_nascimento,
:turma)";

//stmt = statement
$stmt = $conexao->prepare($sql);
$stmt->bindValue(":nome", "João");
$stmt->bindValue(":sobrenome", "Carlos");
$stmt->bindValue(":data_nascimento", "2026-05-18");
$stmt->bindValue(":turma", "I2D35B");

$stmt->execute();

echo "Aluno inserido com sucesso!";
?>