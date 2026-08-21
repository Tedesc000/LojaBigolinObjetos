<?php
require_once '../pedido.php';

$pedido = new Pedido();
$pedido->setIdProduto(1);
$pedido->setIdCliente(1);
$pedido->setData('19-02-2009');
$pedido->setQuantidade(12);
$pedido->setPreco(35.4);
$pedido->salvar();

$cliente->selecionar();