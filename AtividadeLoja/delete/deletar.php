<?php 
require "../conexao.php";
$pdo = getConexao();

if (isset($_GET['nome_tabela']) && isset($_GET['id'])) {
    $nome_tabela = $_GET['nome_tabela'];
    $id = $_GET['id'];
    $coluna_id = ($nome_tabela === 'marcas') ? 'id_marca' : 'id_' . $nome_tabela;

    try {
        $sql = "DELETE FROM $nome_tabela WHERE $coluna_id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);

        header('Location: ../forms_insert/form_' . ($nome_tabela === 'marcas' ? 'marca' : $nome_tabela) . '.php');
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}