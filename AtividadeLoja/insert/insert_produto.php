<?php
    require "../conexao.php";
        $pdo = getConexao();
        $sql = "INSERT INTO produto(nome, preco, descricao, id_marca, id_setor, status) VALUES (:nome, :preco, :descricao, :id_marca, :id_setor, :status)";
        $stmt = $pdo->prepare($sql);

        $id_marca = $_POST[":id_marca"];
        $id_setor = $_POST[":id_setor"];
        $nome = $_POST[":nome"];
        $preco = $_POST[":preco"];
        $descricao = $_POST[":descricao"];
        $status = $_POST[":status"];

        $preco = str_replace(",",".", $preco);
        if(!is_numeric($preco)){
            echo "<script>alert('Por favor, insira um preço válido');</script>";
            header("location: ../pages/inserir.php");
        }

        $stmt->execute([
            ':nome' => $nome,
            ':id_marca'=> $id_marca,
            ':id_setor'=> $id_setor,
            ':preco'=> $preco,
            ':descricao'=> $descricao,
            ':status'=> $status
        ]);

    header("Location: ../index.php");