<?php
require_once __DIR__ . '/../../Autoload.php';

$produto = new Produto();
$produto->setNome('Furadeira');
$produto->setPreco(299.90);
$produto->setDescricao('Furadeira de impacto 500W');
$produto->setStatus('ativo');
$produto->salvar();

$produto->selecionar();
