<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Produtos</h1>
    <a href="index.php?modulo=produto$acao=criar">Novo Setor</a>
    
    <ul>
        <?php foreach ($setores as $s): ?>
            <li>
                <?= htmlespecialchars($s['nome']) ?> - <?= ($s['descricao']) ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>