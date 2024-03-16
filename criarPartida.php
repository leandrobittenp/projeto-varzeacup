<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Criar Partida - VarzeaCup</title>
</head>
<body>
    <h1>Criar Partida - VarzeaCup</h1>
    <form action="functions.php" method="post">
        <label for="time_casa">Time da Casa:</label>
    
        <select id="time_casa" name="time_casa" required>
            <?php
            include 'conexao.php';
            $query = "SELECT * FROM times";
            $resultado = $db->query($query);
            while ($linha = $resultado->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='{$linha['id']}'>{$linha['nome']}</option>";
            }
            ?>
        </select>
        <br><br>
        <label for="time_visitante">Time Visitante:</label>
        <select id="time_visitante" name="time_visitante" required>
            <?php
            $resultado->execute();
            while ($linha = $resultado->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='{$linha['id']}'>{$linha['nome']}</option>";
            }
            ?>
        </select>
        <br><br>
        <label for="gols_time_casa">Gols do Time da Casa:</label>
        <input type="number" id="gols_time_casa" name="gols_time_casa" required>
        <br><br>
        <label for="gols_time_visitante">Gols do Time Visitante:</label>
        <input type="number" id="gols_time_visitante" name="gols_time_visitante" required>
        <br><br>
        <input type="hidden" name="acao" value="criar_partida">
        <input type="submit" value="Criar Partida">
    </form>
</body>
</html>
