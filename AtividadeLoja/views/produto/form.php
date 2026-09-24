<?php
$isEdicao = !empty($produto->getID());
$titulo = $isEdicao ? "Editar Produto" : "Novo Produto";
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
        <form action="index.php?modulo=produto&acao=salvar" method="POST">
            <?php if ($isEdicao): ?>
                <input type="hidden" name="id_produto" value="<?= htmlspecialchars($produto->getID() ?? '') ?>">
            <?php endif; ?>

            <label>
                Nome do Produto
                <input type="text" name="nome" value="<?= htmlspecialchars($produto->getNome() ?? '') ?>" required>
            </label>

            <label>
                Preço
                <input type="number" step="0.01" name="preco" value="<?= htmlspecialchars($produto->getPreco() ?? '') ?>" required>
            </label>

            <label>
                Marca
                <select name="id_marca">
                    <option value="">Selecione uma Marca</option>
                    <?php if (!empty($marcas)): ?>
                        <?php foreach ($marcas as $m): ?>
                            <option value="<?= $m['id_marca'] ?>" <?= ($produto->getIdMarca() == $m['id_marca']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($m['nome']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </label>

            <label>
                Setor
                <select name="id_setor">
                    <option value="">Selecione um Setor</option>
                    <?php if (!empty($setores)): ?>
                        <?php foreach ($setores as $s): ?>
                            <option value="<?= $s['id_setor'] ?>" <?= ($produto->getIdSetor() == $s['id_setor']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($s['nome']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </label>

            <label>
                Descrição
                <input type="text" name="descricao" value="<?= htmlspecialchars($produto->getDescricao() ?? '') ?>">
            </label>

            <label>
                Status
                <select name="status">
                    <option value="ativo" <?= ($produto->getStatus() === 'ativo') ? 'selected' : '' ?>>Ativo</option>
                    <option value="inativo" <?= ($produto->getStatus() === 'inativo') ? 'selected' : '' ?>>Inativo</option>
                </select>
            </label>

            <div style="display: flex; gap: 15px; margin-top: 15px;">
                <button type="submit" style="flex: 1;">Salvar</button>
                <a href="index.php?modulo=produto&acao=listar" style="display: flex; align-items: center; justify-content: center; padding: 15px; background-color: #ddd; color: black; text-decoration: none; font-weight: bold; border-radius: 8px; flex: 1;">Cancelar</a>
            </div>
        </form>
    </main>
</body>
</html>
