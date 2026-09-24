<?php
$isEdicao = !empty($marca->getID());
$titulo = $isEdicao ? "Editar Marca" : "Nova Marca";
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
        <form action="index.php?modulo=marca&acao=salvar" method="POST">
            <?php if ($isEdicao): ?>
                <input type="hidden" name="id_marca" value="<?= htmlspecialchars($marca->getID() ?? '') ?>">
            <?php endif; ?>

            <label>
                Nome da Marca
                <input type="text" name="nome" value="<?= htmlspecialchars($marca->getNome() ?? '') ?>" required>
            </label>

            <label>
                País de Origem
                <input type="text" name="pais" value="<?= htmlspecialchars($marca->getPais() ?? '') ?>" required>
            </label>

            <div style="display: flex; gap: 15px; margin-top: 15px;">
                <button type="submit" style="flex: 1;">Salvar</button>
                <a href="index.php?modulo=marca&acao=listar" style="display: flex; align-items: center; justify-content: center; padding: 15px; background-color: #ddd; color: black; text-decoration: none; font-weight: bold; border-radius: 8px; flex: 1;">Cancelar</a>
            </div>
        </form>
    </main>
</body>
</html>
