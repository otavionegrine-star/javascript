<?php
require_once 'connect_postgres.php';

$id = 1;

$sql = "SELECT *
FROM alunos
WHERE id = :id";

$stmt = $conexao->prepare($sql);
$stmt->bindParam(":id", $id);
$stmt->execute();

$aluno = $stmt->fetch(PDO::FETCH_ASSOC);
echo "ID: {$aluno['id']}<br>";
echo "Nome: {$aluno['nome']} {$aluno['sobrenome']}<br>";
echo "Data Nascimento: {$aluno['data_nascimento']}<br>";
echo "Turma: {$aluno['turma']}<br>";
echo "Ativo: " . ($aluno['ativo'] ? "Ativo" : "Inativo") . "<hr><br>";

?>