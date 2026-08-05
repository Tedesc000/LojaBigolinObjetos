<?php
require_once '../conexao.php';
$pdo = getConexao();

if (isset($_GET['id_cliente'])) {
    extract($_POST);
    $id_cliente = $_GET['id_cliente'];

    try {
        $sql = "UPDATE cliente 
                SET nome = :nome, cpf = :cpf, telefone = :telefone, email = :email 
                WHERE id_cliente = :id_cliente";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':nome' => $nome,
            ':cpf' => $cpf,
            ':telefone' => $telefone,
            ':email' => $email,
            ':id_cliente' => $id_cliente
        ]);

        header('Location: ../forms_insert/form_cliente.php');
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
