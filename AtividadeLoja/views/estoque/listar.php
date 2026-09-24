<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Estoque - Loja</title>
</head>
<body>
    <?php require_once __DIR__ . '/../layout/header.php'; ?>
    <main>
        <h1>Estoque</h1>
        <div style="margin: 20px 0; width: 90%; display: flex; justify-content: flex-end;">
            <a href="index.php?modulo=estoque&acao=criar" style="padding: 10px 20px; background-color: lightblue; color: black; text-decoration: none; font-weight: bold; border-radius: 8px;">+ Novo Estoque</a>
        </div>
        
        <?php if (!empty($estoques)): ?>
            <table border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Pavilhão</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($estoques as $e): ?>
                        <tr>
                            <td><?= htmlspecialchars($e['id_estoque'] ?? '') ?></td>
                            <td><?= htmlspecialchars($e['produto_nome'] ?? $e['id_produto'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($e['quantidade'] ?? '0') ?></td>
                            <td><?= htmlspecialchars($e['pavilhao'] ?? '') ?></td>
                            <td>
                                <a href="index.php?modulo=estoque&acao=editar&id=<?= $e['id_estoque'] ?>" style="color: blue; text-decoration: none; font-weight: bold; margin-right: 10px;">Editar</a>
                                <a href="index.php?modulo=estoque&acao=excluir&id=<?= $e['id_estoque'] ?>" onclick="return confirm('Deseja realmente excluir este registro de estoque?');" style="color: red; text-decoration: none; font-weight: bold;">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p style="padding: 20px; font-size: 1.2em;">Nenhum registro de estoque cadastrado ainda.</p>
        <?php endif; ?>
    </main>
</body>
</html>