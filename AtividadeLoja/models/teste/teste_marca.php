<?php
require_once '../marca.php';

$marca = new Marca();
$marca->setPais('Brasil');
$marca->setNome('Dove');
$marca->salvar();

$marca->selecionar();