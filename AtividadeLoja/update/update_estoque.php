<?php
require_once '../conexao.php';
$pdo = getConexao();

if (isset($_GET['id_estoque'])) {
    extract($_POST);
    $id_estoque = $_GET['id_estoque'];

    try {
        $sql = "UPDATE estoque 
                SET id_produto = :id_produto, quantidade = :quantidade, pavilhao = :pavilhao 
                WHERE id_estoque = :id_estoque";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':id_produto' => $id_produto,
            ':quantidade' => $quantidade,
            ':pavilhao' => $pavilhao,
            ':id_estoque' => $id_estoque
        ]);

        header('Location: ../forms_insert/form_estoque.php');
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
