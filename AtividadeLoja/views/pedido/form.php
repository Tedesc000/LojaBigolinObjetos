<?php
$isEdicao = !empty($pedido->getID());
$titulo = $isEdicao ? "Editar Pedido" : "Novo Pedido";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title><?= $titulo ?> - Loja</title>
</head>
<body>
    <?php require_once __DIR__ . '/../layout/header.php'; ?>
    <main>
        <h1><?= $titulo ?></h1>
        <form action="index.php?modulo=pedido&acao=salvar" method="POST">
            <?php if ($isEdicao): ?>
                <input type="hidden" name="id_pedido" value="<?= htmlspecialchars($pedido->getID() ?? '') ?>">
            <?php endif; ?>

            <label>
                Cliente
                <select name="id_cliente" required>
                    <option value="">Selecione um Cliente</option>
                    <?php if (!empty($clientes)): ?>
                        <?php foreach ($clientes as $c): ?>
                            <option value="<?= $c['id_cliente'] ?>" <?= ($pedido->getIdCliente() == $c['id_cliente']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($c['nome']) ?> (CPF: <?= htmlspecialchars($c['cpf']) ?>)
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </label>

            <label>
                Produto
                <select name="id_produto" required>
                    <option value="">Selecione um Produto</option>
                    <?php if (!empty($produtos)): ?>
                        <?php foreach ($produtos as $p): ?>
                            <option value="<?= $p['id_produto'] ?>" <?= ($pedido->getIdProduto() == $p['id_produto']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($p['nome']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </label>

            <label>
                Data
                <input type="date" name="data" value="<?= htmlspecialchars($pedido->getData() ? date('Y-m-d', strtotime($pedido->getData())) : date('Y-m-d')) ?>" required>
            </label>

            <label>
                Preço Total
                <input type="number" step="0.01" name="preco" value="<?= htmlspecialchars($pedido->getPreco() ?? '') ?>" required>
            </label>

            <label>
                Quantidade
                <input type="number" name="quantidade" value="<?= htmlspecialchars($pedido->getQuantidade() ?? '1') ?>" required>
            </label>

            <label>
                Status
                <select name="status">
                    <option value="pendente" <?= ($pedido->getStatus() === 'pendente') ? 'selected' : '' ?>>Pendente</option>
                    <option value="pago" <?= ($pedido->getStatus() === 'pago') ? 'selected' : '' ?>>Pago</option>
                    <option value="entregue" <?= ($pedido->getStatus() === 'entregue') ? 'selected' : '' ?>>Entregue</option>
                    <option value="cancelado" <?= ($pedido->getStatus() === 'cancelado') ? 'selected' : '' ?>>Cancelado</option>
                </select>
            </label>

            <div style="display: flex; gap: 15px; margin-top: 15px;">
                <button type="submit" style="flex: 1;">Salvar</button>
                <a href="index.php?modulo=pedido&acao=listar" style="display: flex; align-items: center; justify-content: center; padding: 15px; background-color: #ddd; color: black; text-decoration: none; font-weight: bold; border-radius: 8px; flex: 1;">Cancelar</a>
            </div>
        </form>
    </main>
</body>
</html>
