<?php
require_once __DIR__ . '/../Autoload.php';
$estoque = new Estoque();
$estoque->setIdProduto($_POST['id_produto']);
$estoque->setQuantidade($_POST['quantidade']);
$estoque->setPavilhao($_POST['pavilhao']);

$estoque->salvar();

header("Location: ../index.php");