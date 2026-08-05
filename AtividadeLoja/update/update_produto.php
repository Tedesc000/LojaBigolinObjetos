<?php
require_once '../conexao.php';
$pdo = getConexao();

if (isset($_GET['id_produto'])) {
    extract($_POST);
    $id_produto = $_GET['id_produto'];

    try {
        $sql = "UPDATE produto 
                SET nome = :nome, id_marca = :id_marca, id_setor = :id_setor, preco = :preco, descricao = :descricao, status = :status 
                WHERE id_produto = :id_produto";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':nome' => $nome,
            ':id_marca' => $id_marca,
            ':id_setor' => $id_setor,
            ':preco' => $preco,
            ':descricao' => $descricao,
            ':status' => $status,
            ':id_produto' => $id_produto
        ]);

        header('Location: ../forms_insert/form_produto.php');
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
