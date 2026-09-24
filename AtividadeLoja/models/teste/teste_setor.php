<?php
require_once __DIR__ . '/../../Autoload.php';

$setor = new Setor();
$setor->setNome('Ferramentas');
$setor->setDescricao('Setor de ferramentas e equipamentos');
$setor->salvar();

$setor->selecionar();
