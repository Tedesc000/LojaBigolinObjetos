<?php
$isEdicao = !empty($estoque->getID());
$titulo = $isEdicao ? "Editar Estoque" : "Novo Registro de Estoque";
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
        <form action="index.php?modulo=estoque&acao=salvar" method="POST">
            <?php if ($isEdicao): ?>
                <input type="hidden" name="id_estoque" value="<?= htmlspecialchars($estoque->getID() ?? '') ?>">
            <?php endif; ?>

            <label>
                Produto
                <select name="id_produto" required>
                    <option value="">Selecione um Produto</option>
                    <?php if (!empty($produtos)): ?>
                        <?php foreach ($produtos as $p): ?>
                            <option value="<?= $p['id_produto'] ?>" <?= ($estoque->getIdProduto() == $p['id_produto']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($p['nome']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </label>

            <label>
                Quantidade
                <input type="number" name="quantidade" value="<?= htmlspecialchars($estoque->getQuantidade() ?? '') ?>" required>
            </label>

            <label>
                Pavilhão
                <input type="text" name="pavilhao" value="<?= htmlspecialchars($estoque->getPavilhao() ?? '') ?>" required>
            </label>

            <div style="display: flex; gap: 15px; margin-top: 15px;">
                <button type="submit" style="flex: 1;">Salvar</button>
                <a href="index.php?modulo=estoque&acao=listar" style="display: flex; align-items: center; justify-content: center; padding: 15px; background-color: #ddd; color: black; text-decoration: none; font-weight: bold; border-radius: 8px; flex: 1;">Cancelar</a>
            </div>
        </form>
    </main>
</body>
</html>
