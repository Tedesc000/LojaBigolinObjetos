<?php
require_once '../classes/pedido.php';

if (isset($_GET['id_pedido'])) {
    extract($_POST);
    $id_pedido = $_GET['id_pedido'];

    try {
        $pedido = new Pedido();
        $pedido->setID($id_pedido);
        $pedido->setIdCliente($id_cliente);
        $pedido->setIdProduto($id_produto);
        $pedido->setData($data);
        $pedido->setPreco($preco);
        $pedido->setQuantidade($quantidade);
        $pedido->setStatus($status);
        $pedido->salvar();

        header('Location: ../forms_insert/form_pedido.php');
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
