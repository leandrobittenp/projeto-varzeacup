<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Criar Time - VarzeaCup</title>
</head>
<body>
    <h1>Criar Time - VarzeaCup</h1>
    <form action="functions.php" method="post">
        <label for="nome">Nome do Time:</label>
        <input type="text" id="nome" name="nome" required>
        <br><br>
        <label for="cidade">Cidade:</label>
        <input type="text" id="cidade" name="cidade">
        <br><br>
        <input type="hidden" name="acao" value="criar_time">
        <input type="submit" value="Criar Time">
    </form>
</body>
</html>
