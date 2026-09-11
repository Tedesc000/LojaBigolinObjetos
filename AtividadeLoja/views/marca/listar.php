<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Produtos</h1>
    <a href="index.php?modulo=marca$acao=criar">Nova Marca</a>
    
    <ul>
        <?php foreach ($marcas as $m): ?>
            <li>
                <?= htmlespecialchars($m['nome']) ?> - <?= ($m['pais']) ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>