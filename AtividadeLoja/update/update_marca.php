<?php
require_once '../classes/marca.php';

if (isset($_GET['id_marca'])) {
    extract($_POST);
    $id_marca = $_GET['id_marca'];

    try {
        $marca = new Marca();
        $marca->setID($id_marca);
        $marca->setNome($nome);
        $marca->setPais($pais);
        $marca->salvar();
        
        header('Location: ../forms_insert/form_marca.php');
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
