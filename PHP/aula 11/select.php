<?php
require_once "index.php";

$sql = "
SELECT * FROM alunos";

//stmt = statement refere-se a um objeto PDOStatement no contexto do PDO
$stmt = $conexao->prepare($sql);
$stmt->execute();

$alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($alunos as $aluno){
    echo "ID: {$aluno['id']}<br>";
    echo "Nome: {$aluno['nome']} {$aluno['sobrenome']}<br>";
    echo "Data Nascimento: {$aluno['data_nascimento']}<br>";
    echo "turma: {$aluno['turma']}<br>";
    echo "Ativo:" . ($aluno['ativo'] ? "Ativo":"Inativo") . "<hr><br>";
}

?>