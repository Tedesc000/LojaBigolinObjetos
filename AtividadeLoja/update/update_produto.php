<?php
require_once '../classes/produto.php';

if (isset($_GET['id_produto'])) {
    extract($_POST);
    $id_produto = $_GET['id_produto'];

    try {
        $produto = new Produto();
        $produto->setID($id_produto);
        $produto->setNome($nome);
        $produto->setIdMarca($id_marca);
        $produto->setIdSetor($id_setor);
        $produto->setPreco($preco);
        $produto->setDescricao($descricao);
        $produto->setStatus($status);
        $produto->salvar();
        
        header('Location: ../forms_insert/form_produto.php');
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
