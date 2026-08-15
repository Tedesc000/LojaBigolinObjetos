<?php
require_once '../classes/setor.php';

if (isset($_GET['id_setor'])) {
    extract($_POST);
    $id_setor = $_GET['id_setor'];

    try {
        $setor = new Setor();
        $setor->setID($id_setor);
        $setor->setNome($nome);
        $setor->setDescricao($descricao);
        $setor->salvar();

        header('Location: ../forms_insert/form_setor.php');
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
