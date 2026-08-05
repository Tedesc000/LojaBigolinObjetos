<?php
require_once '../conexao.php';
$pdo = getConexao();

if (isset($_GET['id_setor'])) {
    extract($_POST);
    $id_setor = $_GET['id_setor'];

    try {
        $sql = "UPDATE setor 
                SET nome = :nome, descricao = :descricao 
                WHERE id_setor = :id_setor";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':nome' => $nome,
            ':descricao' => $descricao,
            ':id_setor' => $id_setor
        ]);

        header('Location: ../forms_insert/form_setor.php');
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
