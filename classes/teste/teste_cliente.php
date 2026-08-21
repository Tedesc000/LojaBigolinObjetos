<?php
require_once '../cliente.php';

$cliente = new Cliente();
$cliente->setCpf('123456789');
$cliente->setEmail('email@gmail.com');
$cliente->setTelefone('5199999765');
$cliente->setNome('Eduardo');
$cliente->salvar();

$cliente->selecionar();