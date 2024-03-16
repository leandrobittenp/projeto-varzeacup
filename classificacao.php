<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>VarzeaCup Classificação - </title>
</head>
<body>
    <h1>Tabela de Classificação</h1>
    <table border="1">
        <tr>
            <th>Posição</th>
            <th>Time</th>
            <th>Partidas Jogadas</th>
            <th>Vitórias</th>
            <th>Empates</th>
            <th>Derrotas</th>
            <th>Pontuação</th>
        </tr>
        <?php
        include 'conexao.php';
        
        //SQL para preencher tabela
        $query = "SELECT id, nome, partidas_jogadas, vitorias, empates, derrotas FROM times ORDER BY pontuacao DESC, vitorias DESC, empates DESC, derrotas ASC";
        $resultado = $db->query($query);
        $posicao = 1;
        while ($linha = $resultado->fetch(PDO::FETCH_ASSOC)) {
            // Calcular pontuação
            $pontuacao = ($linha['vitorias'] * 3) + ($linha['empates'] * 1);
            
            // Exibir dados na tabela
            echo "<tr>";
            echo "<td>{$posicao}</td>";
            echo "<td>{$linha['nome']}</td>";
            echo "<td>{$linha['partidas_jogadas']}</td>";
            echo "<td>{$linha['vitorias']}</td>";
            echo "<td>{$linha['empates']}</td>";
            echo "<td>{$linha['derrotas']}</td>";
            echo "<td>{$pontuacao}</td>";
            echo "</tr>";
            $posicao++;
        }
        ?>
    </table>
</body>
</html>
