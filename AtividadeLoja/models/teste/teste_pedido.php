<?php
require_once __DIR__ . '/../../Autoload.php';

$pedido = new Pedido();
$pedido->setIdProduto(1);
$pedido->setIdCliente(1);
$pedido->setData('2026-02-19');
$pedido->setQuantidade(12);
$pedido->setPreco(35.4);
$pedido->salvar();

$pedido->selecionar();