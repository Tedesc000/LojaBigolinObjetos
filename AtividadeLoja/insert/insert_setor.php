<?php
    require "../conexao.php";
        $pdo = getConexao();
        $sql = "INSERT INTO setor(nome, descricao) VALUES (:nome, :descricao)";
        $stmt = $pdo->prepare($sql);

        $nome = $_POST[":nome"];
        $descricao = $_POST[":descricao"];

        

        $stmt->execute([
            ':nome' => $nome,
            ':descricao' => $descricao
        ]);

    header("Location: ../index.php");