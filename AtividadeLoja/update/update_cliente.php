<?php
require_once '../classes/cliente.php';


if (isset($_GET['id_cliente'])) {
    extract($_POST);
    $id_cliente = $_GET['id_cliente'];

    try {
        $cliente = new Cliente();
        $cliente->setID($id_cliente);
        $cliente->setNome($nome);
        $cliente->setCpf($cpf);
        $cliente->setTelefone($telefone);
        $cliente->setEmail($email);
        $cliente->salvar();

        header('Location: ../forms_insert/form_cliente.php');
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
