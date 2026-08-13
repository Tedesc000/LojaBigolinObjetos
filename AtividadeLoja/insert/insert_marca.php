<?php
require_once '../classes/marca.php';
    $marca = new Marca();
    $marca->setNome($_POST['nome']);
    $marca->setPais($_POST['pais']);

    $marca->salvar();

    header("Location: ../index.php");