<?php
// Array Indexado contendo Arrays Associativos (Estrutura de dados lógica)
$funcionarios = [
    [
        "nome" => "Ana Silva",
        "cargo" => "Desenvolvedora Senior",
        "setor" => "Tecnologia",
        "email" => "ana.silva@empresa.com"
    ],
    [
        "nome" => "Bruno Costa",
        "cargo" => "Designer de UX",
        "setor" => "Marketing",
        "email" => "bruno.c@empresa.com"
    ],
    [
        "nome" => "Carla Souza",
        "cargo" => "Gerente de Projetos",
        "setor" => "Operações",
        "email" => "carla.souza@empresa.com"
    ],
];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Quadro de Funcionários</title>
    <style>
       
    </style>
</head>
<body>

<div class="container">
    <h1>Equipe Corporativa</h1>
    
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Cargo</th>
                <th>Setor</th>
                <th>E-mail</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            // Uso do foreach para percorrer a lista de funcionários
            foreach ($funcionarios as $funcionario) : 
            ?>
                <tr>
                    <td><strong><?php echo $funcionario['nome']; ?></strong></td>
                    <td><?php echo $funcionario['cargo']; ?></td>
                    <td><?php echo $funcionario['setor']; ?></td>
                    <td><?php echo $funcionario['email']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>