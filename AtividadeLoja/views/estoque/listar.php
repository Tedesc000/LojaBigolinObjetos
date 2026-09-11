<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Produtos</h1>
    <a href="index.php?modulo=estoque$acao=criar">Novo Estoque</a>
    
    <ul>
        <?php foreach ($estoques as $e): ?>
            <li>
                <?= htmlespecialchars($e['quantidade']) ?> - <?= ($c['pavilhao']) ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>