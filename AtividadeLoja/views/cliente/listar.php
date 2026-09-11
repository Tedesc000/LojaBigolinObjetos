<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Clientes</h1>
    <a href="index.php?modulo=cliente$acao=criar">Novo Produto</a>
    
    <ul>
        <?php foreach ($clientes as $c): ?>
            <li>
                <?= htmlespecialchars($c['nome']) ?> - CPF: <?= ($c['cpf']) ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>