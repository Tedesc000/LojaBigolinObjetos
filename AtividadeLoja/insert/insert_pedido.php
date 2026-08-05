<?php
    require "../conexao.php";
    require "../select/select_opcoes.php";
        $pdo = getConexao();
        $precoProduto = getPrecoProduto($pdo, $_POST[':id_produto']);
        $sql = "INSERT INTO pedido(id_produto, id_cliente, data, preco, quantidade, status) VALUES (:id_produto, :id_cliente, :data, :preco, :quantidade, :status)";
        $stmt = $pdo->prepare($sql);

        $id_produto = $_POST[":id_produto"];
        $id_cliente = $_POST[":id_cliente"];
        $data = $_POST[":data"];
        $quantidade = $_POST[":quantidade"];
        $preco = $quantidade * $precoProduto;
        $status = $_POST[":status"];
        
        

        $stmt->execute([
            ':id_produto' => $id_produto,
            ':id_cliente'=> $id_cliente,
            ':data'=> $data,
            ':preco'=> $preco,
            ':quantidade'=> $quantidade,
            ':status'=> $status
        ]);

    header("Location: ../index.php");