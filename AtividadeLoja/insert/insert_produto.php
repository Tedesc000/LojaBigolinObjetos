<?php
require_once '../classes/produto.php';
$produto = new Produto();
$produto->setNome($_POST['nome']);
$produto->setPreco($_POST['preco']);
$produto->setDescricao($_POST['descricao']);
$produto->setIdMarca($_POST['id_marca']);
$produto->setIdSetor($_POST['id_setor']);
$produto->setStatus($_POST['status']);

$produto->salvar();

header("Location: ../index.php");