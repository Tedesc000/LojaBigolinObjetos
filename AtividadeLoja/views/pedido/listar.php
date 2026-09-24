<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Pedidos - Loja</title>
</head>
<body>
    <?php require_once __DIR__ . '/../layout/header.php'; ?>
    <main>
        <h1>Pedidos</h1>
        <div style="margin: 20px 0; width: 90%; display: flex; justify-content: flex-end;">
            <a href="index.php?modulo=pedido&acao=criar" style="padding: 10px 20px; background-color: lightblue; color: black; text-decoration: none; font-weight: bold; border-radius: 8px;">+ Novo Pedido</a>
        </div>
        
        <?php if (!empty($pedidos)): ?>
            <table border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Produto</th>
                        <th>Data</th>
                        <th>Preço (R$)</th>
                        <th>Quantidade</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pedidos as $p): ?>
                        <tr>
                            <td><?= htmlspecialchars($p['id_pedido'] ?? '') ?></td>
                            <td><?= htmlspecialchars($p['cliente_nome'] ?? $p['id_cliente'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($p['produto_nome'] ?? $p['id_produto'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($p['data'] ?? '') ?></td>
                            <td><?= number_format((float)($p['preco'] ?? 0), 2, ',', '.') ?></td>
                            <td><?= htmlspecialchars($p['quantidade'] ?? '1') ?></td>
                            <td><?= htmlspecialchars($p['status'] ?? '') ?></td>
                            <td>
                                <a href="index.php?modulo=pedido&acao=editar&id=<?= $p['id_pedido'] ?>" style="color: blue; text-decoration: none; font-weight: bold; margin-right: 10px;">Editar</a>
                                <a href="index.php?modulo=pedido&acao=excluir&id=<?= $p['id_pedido'] ?>" onclick="return confirm('Deseja realmente excluir este pedido?');" style="color: red; text-decoration: none; font-weight: bold;">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p style="padding: 20px; font-size: 1.2em;">Nenhum pedido cadastrado ainda.</p>
        <?php endif; ?>
    </main>
</body>
</html>