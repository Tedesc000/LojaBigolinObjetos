<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Produtos - Loja</title>
</head>
<body>
    <?php require_once __DIR__ . '/../layout/header.php'; ?>
    <main>
        <h1>Produtos</h1>
        <div style="margin: 20px 0; width: 90%; display: flex; justify-content: flex-end;">
            <a href="index.php?modulo=produto&acao=criar" style="padding: 10px 20px; background-color: lightblue; color: black; text-decoration: none; font-weight: bold; border-radius: 8px;">+ Novo Produto</a>
        </div>
        
        <?php if (!empty($produtos)): ?>
            <table border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Marca</th>
                        <th>Setor</th>
                        <th>Preço (R$)</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produtos as $p): ?>
                        <tr>
                            <td><?= htmlspecialchars($p['id_produto'] ?? '') ?></td>
                            <td><?= htmlspecialchars($p['nome'] ?? '') ?></td>
                            <td><?= htmlspecialchars($p['marca_nome'] ?? $p['id_marca'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($p['setor_nome'] ?? $p['id_setor'] ?? '-') ?></td>
                            <td><?= number_format((float)($p['preco'] ?? 0), 2, ',', '.') ?></td>
                            <td><?= htmlspecialchars($p['status'] ?? '') ?></td>
                            <td>
                                <a href="index.php?modulo=produto&acao=editar&id=<?= $p['id_produto'] ?>" style="color: blue; text-decoration: none; font-weight: bold; margin-right: 10px;">Editar</a>
                                <a href="index.php?modulo=produto&acao=excluir&id=<?= $p['id_produto'] ?>" onclick="return confirm('Deseja realmente excluir este produto?');" style="color: red; text-decoration: none; font-weight: bold;">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p style="padding: 20px; font-size: 1.2em;">Nenhum produto cadastrado ainda.</p>
        <?php endif; ?>
    </main>
</body>
</html>