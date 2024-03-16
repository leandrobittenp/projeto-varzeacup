<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Time - VarzeaCup</title>
</head>
<body>
    <h1>Editar Time - VarzeaCup</h1>

    <?php
    // Verifica id pelo GET
    if (isset($_GET['id'])) {
        include 'conexao.php';

        $time_id = $_GET['id'];
        $query = "SELECT * FROM times WHERE id = $time_id";
        $resultado = $db->query($query);
        $time = $resultado->fetch(PDO::FETCH_ASSOC);

        if ($time) {
            // Form editar time
            echo "<form action='functions.php' method='post'>";
            echo "<input type='hidden' name='acao' value='editar_time'>";
            echo "<input type='hidden' name='time_id' value='{$time['id']}'>";
            echo "<label for='nome'>Nome:</label>";
            echo "<input type='text' name='nome' value='{$time['nome']}'>";
            echo "<label for='cidade'>Cidade:</label>";
            echo "<input type='text' name='cidade' value='{$time['cidade']}'>";
            echo "<button type='submit'>Salvar</button>";
            echo "</form>";
        } else {
            echo "Time não encontrado.";
        }
    } else {
        echo "ID do time não especificado.";
    }
    ?>

    <a href="times.php">Voltar para Listagem de Times</a>
</body>
</html>
