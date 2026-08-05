<?php
function getMarcas($pdo) {
    $stmt = $pdo->query("SELECT * FROM marcas");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getSetores($pdo) {
    $stmt = $pdo->query("SELECT * FROM setor");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getProdutos($pdo) {
    $stmt = $pdo->query("SELECT * FROM produto");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getClientes($pdo) {
    $stmt = $pdo->query("SELECT * FROM cliente");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getPrecoProduto($pdo, $id_produto) {
    $stmt = $pdo->query("SELECT preco FROM produto WHERE id_produto = $id_produto");
    return $stmt->fetchColumn();
}