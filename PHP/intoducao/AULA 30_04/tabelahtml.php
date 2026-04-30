<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel Administrativo - Lista de Funcionários</title>
    <style>
        table { width: 100%; border-collapse: collapse; font-family: Arial, sans-serif; }
        th, td { border: 1px solid #dddddd; text-align: left; padding: 8px; }
        th { background-color: #f2f2f2; }
        tr:nth-child(even) { background-color: #fafafa; }
    </style>
</head>
<body>

    <h1>Gestão de Colaboradores</h1>

    <?php
    /**
     * REQUISITO: Uso de Array Associativo Multidimensional
     * Organizamos cada funcionário como um array interno com chaves descritivas.
     */
    $funcionarios = [
        ["nome" => "Ana Silva", "cargo" => "Analista de Dados", "salario" => 4500.00],
        ["nome" => "Carlos Souza", "cargo" => "Desenvolvedor Backend", "salario" => 6000.00],
        ["nome" => "Mariana Costa", "cargo" => "Gerente de Projetos", "salario" => 8500.00],
        ["nome" => "João Pedro", "cargo" => "Designer UX", "salario" => 4200.00]
    ];
    ?>

    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Cargo</th>
                <th>Salário (R$)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            /**
             * REQUISITO: Uso de foreach para percorrer o array
             * O laço percorre a lista e cria uma linha (tr) para cada funcionário.
             */
            foreach ($funcionarios as $f) {
                echo "<tr>";
                echo "<td>" . $f["nome"] . "</td>";
                echo "<td>" . $f["cargo"] . "</td>";
                // Formatando o salário para o padrão brasileiro
                echo "<td>" . number_format($f["salario"], 2, ',', '.') . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>