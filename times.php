<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Listagem de Times - VarzeaCup</title>
</head>
<body>
    <h1>Listagem de Times - VarzeaCup</h1>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Cidade</th>
            <th>Ações</th>
        </tr>
        <?php
        // Conexão com o banco de dados
        include 'conexao.php';
        include 'functions.php';

        // Consulta SQL para obter todos os times
        $query = "SELECT id, nome, cidade FROM times";
        $resultado = $db->query($query);

        // Loop através dos resultados da consulta e exibir cada time na tabela
        foreach ($resultado as $linha) {
            echo "<tr>";
            echo "<td>{$linha['id']}</td>";
            echo "<td>{$linha['nome']}</td>";
            echo "<td>{$linha['cidade']}</td>";
            echo "<td>";
            echo "<a href='editarTime.php?id={$linha['id']}'>Editar</a> | ";
            echo "<form action='functions.php' method='post' style='display: inline;'>";
            echo "<input type='hidden' name='acao' value='excluir_time'>";
            echo "<input type='hidden' name='time_id' value='{$linha['id']}'>";
            echo "<button type='submit' onclick=\"return confirm('Tem certeza que deseja excluir este time?');\">Excluir</button>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
