<?php
require_once '../conexao.php';
$pdo = getConexao();

if (isset($_GET['id_pedido'])) {
    extract($_POST);
    $id_pedido = $_GET['id_pedido'];

    try {
        $sql = "UPDATE pedido 
                SET id_cliente = :id_cliente, id_produto = :id_produto, data = :data, preco = :preco, quantidade = :quantidade, status = :status 
                WHERE id_pedido = :id_pedido";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':id_cliente' => $id_cliente,
            ':id_produto' => $id_produto,
            ':data' => $data,
            ':preco' => $preco,
            ':quantidade' => $quantidade,
            ':status' => $status,
            ':id_pedido' => $id_pedido
        ]);

        header('Location: ../forms_insert/form_pedido.php');
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
