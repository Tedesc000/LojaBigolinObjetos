<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Setores - Loja</title>
</head>
<body>
    <?php require_once __DIR__ . '/../layout/header.php'; ?>
    <main>
        <h1>Setores</h1>
        <div style="margin: 20px 0; width: 90%; display: flex; justify-content: flex-end;">
            <a href="index.php?modulo=setor&acao=criar" style="padding: 10px 20px; background-color: lightblue; color: black; text-decoration: none; font-weight: bold; border-radius: 8px;">+ Novo Setor</a>
        </div>
        
        <?php if (!empty($setores)): ?>
            <table border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($setores as $s): ?>
                        <tr>
                            <td><?= htmlspecialchars($s['id_setor'] ?? '') ?></td>
                            <td><?= htmlspecialchars($s['nome'] ?? '') ?></td>
                            <td><?= htmlspecialchars($s['descricao'] ?? '') ?></td>
                            <td>
                                <a href="index.php?modulo=setor&acao=editar&id=<?= $s['id_setor'] ?>" style="color: blue; text-decoration: none; font-weight: bold; margin-right: 10px;">Editar</a>
                                <a href="index.php?modulo=setor&acao=excluir&id=<?= $s['id_setor'] ?>" onclick="return confirm('Deseja realmente excluir este setor?');" style="color: red; text-decoration: none; font-weight: bold;">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p style="padding: 20px; font-size: 1.2em;">Nenhum setor cadastrado ainda.</p>
        <?php endif; ?>
    </main>
</body>
</html>