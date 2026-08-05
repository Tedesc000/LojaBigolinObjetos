<?php
    require "../conexao.php";
        $pdo = getConexao();
        $sql = "INSERT INTO estoque(id_produto, quantidade, pavilhão) VALUES (:id_produto, :quantidade, :pavilhao)";
        $stmt = $pdo->prepare($sql);

        $id_produto = $_POST[":id_produto"];
        $quantidade = $_POST[":quantidade"];
        $pavilhao = $_POST[":pavilhao"];

        

        $stmt->execute([
            ':id_produto' => $id_produto,
            ':quantidade' => $quantidade,
            ':pavilhao'=> $pavilhao
        ]);

    header("Location: ../index.php");