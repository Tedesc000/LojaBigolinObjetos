<?php
require_once __DIR__ . '/config.php';

$modulo = isset($_GET['modulo']) ? strtolower(trim($_GET['modulo'])) : null;
$acao = isset($_GET['acao']) ? strtolower(trim($_GET['acao'])) : 'listar';

// Mapa de controladores disponíveis
$rotas = [
    'cliente' => 'ClienteController',
    'produto' => 'ProdutoController',
    'marca'   => 'MarcaController',
    'estoque' => 'EstoqueController',
    'pedido'  => 'PedidoController',
    'setor'   => 'SetorController',
];

// Se um módulo foi especificado e existe no mapa
if ($modulo && isset($rotas[$modulo])) {
    $controllerName = $rotas[$modulo];
    $controller = new $controllerName($pdo);

    if (method_exists($controller, $acao)) {
        $controller->$acao();
    } else {
        $controller->listar();
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Loja Bigolin - Início</title>
</head>
<body>
    <?php require_once __DIR__ . '/views/layout/header.php'; ?>
    <main>
        <h1>Bem-vindo à Loja Bigolin</h1>
        <p style="margin-top: 20px; font-size: 1.2em; color: #555;">Selecione um módulo abaixo para gerenciar os dados:</p>

        <ul style="width: 80%; display: flex; flex-direction: column; gap: 15px; align-items: center; padding: 0; margin: 25px 0;">
            <li><a href="index.php?modulo=cliente&acao=listar" style="width: 250px;">Gerenciar Clientes</a></li>
            <li><a href="index.php?modulo=produto&acao=listar" style="width: 250px;">Gerenciar Produtos</a></li>
            <li><a href="index.php?modulo=pedido&acao=listar" style="width: 250px;">Gerenciar Pedidos</a></li>
            <li><a href="index.php?modulo=estoque&acao=listar" style="width: 250px;">Gerenciar Estoque</a></li>
            <li><a href="index.php?modulo=marca&acao=listar" style="width: 250px;">Gerenciar Marcas</a></li>
            <li><a href="index.php?modulo=setor&acao=listar" style="width: 250px;">Gerenciar Setores</a></li>
        </ul>
    </main>
</body>
</html>