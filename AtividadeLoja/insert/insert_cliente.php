<?php
require "../conexao.php";
$pdo = getConexao();
$sql = "INSERT INTO cliente(nome, cpf, telefone, email) VALUES (:nome, :cpf, :telefone, :email)";
$stmt = $pdo->prepare($sql);

$nome = $_POST[":nome"];
$cpf = $_POST[":cpf"];
$telefone = $_POST[":telefone"];
$email = $_POST[":email"];



$stmt->execute([
    ':nome' => $nome,
    ':cpf' => $cpf,
    ':telefone' => $telefone,
    ':email' => $email
]);

header("Location: ../index.php");