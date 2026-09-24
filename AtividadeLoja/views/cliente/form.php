<?php
$isEdicao = !empty($cliente->getID());
$titulo = $isEdicao ? "Editar Cliente" : "Novo Cliente";
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

        <div id="erro" style="display: none; background-color: #f8d7da; color: #721c24; padding: 12px; margin: 15px auto; width: 60%; border-radius: 6px; border: 1px solid #f5c6cb; text-align: center; font-weight: bold;"></div>

        <form id="formCliente" action="index.php?modulo=cliente&acao=salvar" method="POST">
            <?php if ($isEdicao): ?>
                <input type="hidden" name="id_cliente" value="<?= htmlspecialchars($cliente->getID() ?? '') ?>">
            <?php endif; ?>

            <label>
                Nome
                <input type="text" name="nome" value="<?= htmlspecialchars($cliente->getNome() ?? '') ?>" required>
            </label>

            <label>
                CPF
                <input type="text" name="cpf" value="<?= htmlspecialchars($cliente->getCpf() ?? '') ?>" required>
            </label>

            <label>
                Telefone
                <input type="text" name="telefone" value="<?= htmlspecialchars($cliente->getTelefone() ?? '') ?>">
            </label>

            <label>
                Email
                <input type="text" name="email" value="<?= htmlspecialchars($cliente->getEmail() ?? '') ?>">
            </label>

            <div style="display: flex; gap: 15px; margin-top: 15px;">
                <button type="submit" style="flex: 1;">Salvar</button>
                <a href="index.php?modulo=cliente&acao=listar" style="display: flex; align-items: center; justify-content: center; padding: 15px; background-color: #ddd; color: black; text-decoration: none; font-weight: bold; border-radius: 8px; flex: 1;">Cancelar</a>
            </div>
        </form>
    </main>

    <script src="js/cliente.js"></script>
    <script>
        document.getElementById('formCliente').addEventListener('submit', function(e) {
            e.preventDefault(); // Impede o envio direto para o PHP antes de validar no JS

            const divErro = document.getElementById('erro');
            divErro.style.display = 'none';

            try {
                const id = document.querySelector('input[name="id_cliente"]')?.value || null;
                const nome = document.querySelector('input[name="nome"]').value;
                const cpf = document.querySelector('input[name="cpf"]').value;
                const telefone = document.querySelector('input[name="telefone"]').value;
                const email = document.querySelector('input[name="email"]').value;

                // Aqui o cliente.js é executado
                // Se o CPF ou Email forem inválidos, a classe cliente lança o throw Error
                const c = new cliente(id, nome, cpf, telefone, email);

                // Se passou pelas validações sem erro, envia para o PHP
                this.submit();
            } catch (erro) {
                // Captura a exception lançada pelo cliente.js e mostra na tela
                divErro.style.display = 'block';
                divErro.textContent = erro.message;
            }
        });
    </script>
</body>
</html>
