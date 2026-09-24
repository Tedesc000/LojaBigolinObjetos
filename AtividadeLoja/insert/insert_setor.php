<?php
require_once __DIR__ . '/../Autoload.php';
    $setor = new Setor();
    $setor->setNome($_POST['nome']);
    $setor->setDescricao($_POST['descricao']);

    $setor->salvar();
    header("Location: ../index.php");