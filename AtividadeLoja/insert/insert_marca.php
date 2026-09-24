<?php
require_once __DIR__ . '/../Autoload.php';
    $marca = new Marca();
    $marca->setNome($_POST['nome']);
    $marca->setPais($_POST['pais']);

    $marca->salvar();

    header("Location: ../index.php");