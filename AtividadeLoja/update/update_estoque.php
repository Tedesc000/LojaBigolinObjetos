<?php
require_once '../classes/estoque.php';

if (isset($_GET['id_estoque'])) {
    extract($_POST);
    $id_estoque = $_GET['id_estoque'];

    try {
        $estoque = new Estoque();
        $estoque->setID($id_estoque);
        $estoque->setIdProduto($id_produto);
        $estoque->setQuantidade($quantidade);
        $estoque->setPavilhao($pavilhao);
        $estoque->salvar();

        header('Location: ../forms_insert/form_estoque.php');
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
