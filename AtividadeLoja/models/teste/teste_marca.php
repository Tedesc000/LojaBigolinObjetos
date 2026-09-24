<?php
require_once __DIR__ . '/../../Autoload.php';

$marca = new Marca();
$marca->setPais('Brasil');
$marca->setNome('Dove');
$marca->salvar();

$marca->selecionar();