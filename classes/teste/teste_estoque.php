<?php
require_once '../estoque.php';

$estoque = new Estoque();
$estoque->setIdProduto(1);
$estoque->setQuantidade(23);
$estoque->setPavilhao('abcd');
$estoque->salvar();

$estoque->selecionar();