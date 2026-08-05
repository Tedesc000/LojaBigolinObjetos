<?php
    require "../conexao.php";
        $pdo = getConexao();
        $sql = "INSERT INTO marcas(nome, pais) VALUES (:nome, :pais)";
        $stmt = $pdo->prepare($sql);

        $nome = $_POST[":nome"];
        $pais = $_POST[":pais"];

        

        $stmt->execute([
            ':nome' => $nome,
            ':pais' => $pais
        ]);

    echo "Marca inserida com sucesso";