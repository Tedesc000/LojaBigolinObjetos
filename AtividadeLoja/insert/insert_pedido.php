<?php
require_once __DIR__ . '/../../classes/pedido.php';

$pedido = new Pedido();
$pedido->setIdProduto($_POST['id_produto']);
$pedido->setIdCliente($_POST['id_cliente']);
$pedido->setData($_POST['data']);
$pedido->setPreco($_POST['preco']);
$pedido->setQuantidade($_POST['quantidade']);
$pedido->setStatus($_POST['status']);

$pedido->salvar();

header("Location: ../index.php");