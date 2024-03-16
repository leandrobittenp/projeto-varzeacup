<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Partida - VarzeaCup</title>
</head>
<body>
    <h1>Editar Partida - VarzeaCup</h1>

    <?php
    // Verifica id pelo get
    if (isset($_GET['id'])) {
        include 'conexao.php';

        $partida_id = $_GET['id'];
        $query = "SELECT * FROM partidas WHERE id = $partida_id";
        $resultado = $db->query($query);
        $partida = $resultado->fetch(PDO::FETCH_ASSOC);

        if ($partida) {
            echo "<form action='functions.php' method='post'>";
            echo "<input type='hidden' name='acao' value='editar_partida'>";
            echo "<input type='hidden' name='partida_id' value='{$partida['id']}'>";
            echo "<label for='gols_time_casa'>Gols do Time Casa:</label>";
            echo "<input type='number' name='gols_time_casa' value='{$partida['gols_time_casa']}'>";
            echo "<label for='gols_time_visitante'>Gols do Time Visitante:</label>";
            echo "<input type='number' name='gols_time_visitante' value='{$partida['gols_time_visitante']}'>";
            echo "<button type='submit'>Salvar</button>";
            echo "</form>";
        } else {
            echo "Partida não encontrada.";
        }
    } else {
        echo "ID da partida não especificado.";
    }
    ?>

    <a href="partidas.php">Voltar para Listagem de Partidas</a>
</body>
</html>
