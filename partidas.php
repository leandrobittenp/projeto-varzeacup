<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Listagem de Partidas - VarzeaCup</title>
</head>
<body>
    <h1>Lista de Partidas </h1>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Time Casa</th>
            <th>Time Visitante</th>
            <th>Gols Time Casa</th>
            <th>Gols Time Visitante</th>
            <th>Ações</th>
        </tr>
        <?php
        include 'conexao.php';

        // SQL buscando todas partidas
        $query = "SELECT p.id, t1.nome AS time_casa, t2.nome AS time_visitante, p.gols_time_casa, p.gols_time_visitante FROM partidas p INNER JOIN times t1 ON p.time_casa_id = t1.id INNER JOIN times t2 ON p.time_visitante_id = t2.id";
        $resultado = $db->query($query);

        // Listar cada partida a partir do resultado
        foreach ($resultado as $linha) {
            echo "<tr>";
            echo "<td>{$linha['id']}</td>";
            echo "<td>{$linha['time_casa']}</td>";
            echo "<td>{$linha['time_visitante']}</td>";
            echo "<td>{$linha['gols_time_casa']}</td>";
            echo "<td>{$linha['gols_time_visitante']}</td>";
            echo "<td>";
            echo "<a href='editarPartida.php?id={$linha['id']}'>Editar</a> | ";
            echo "<form action='functions.php' method='post' style='display: inline;'>";
            echo "<input type='hidden' name='acao' value='excluir_partida'>";
            echo "<input type='hidden' name='partida_id' value='{$linha['id']}'>";
            echo "<button type='submit' onclick=\"return confirm('Tem certeza que deseja excluir esta partida?');\">Excluir</button>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
