<?php
require_once __DIR__ . '/../Autoload.php';

$cliente = new Cliente();
$cliente->setNome($_POST['nome']);
$cliente->setCpf($_POST['cpf']);
$cliente->setTelefone($_POST['telefone']);
$cliente->setEmail($_POST['email']);

$cliente->salvar();

header("Location: ../index.php");