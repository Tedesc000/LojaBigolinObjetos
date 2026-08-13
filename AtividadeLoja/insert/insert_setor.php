<?php
require_once '../classes/setor.php';
    $setor = new Setor();
    $setor->setNome($_POST['nome']);
    $setor->setDescricao($_POST['descricao']);

    $setor->salvar();
    header("Location: ../index.php");