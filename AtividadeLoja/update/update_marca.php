<?php
require_once '../conexao.php';
$pdo = getConexao();

if (isset($_GET['id_marca'])) {
    extract($_POST);
    $id_marca = $_GET['id_marca'];

    try {
        $sql = "UPDATE marcas 
                SET nome = :nome, pais = :pais 
                WHERE id_marca = :id_marca";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':nome' => $nome,
            ':pais' => $pais,
            ':id_marca' => $id_marca
        ]);

        header('Location: ../forms_insert/form_marca.php');
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
