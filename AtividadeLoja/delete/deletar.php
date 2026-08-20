<?php 
require_once '../classes/cliente.php';
require_once '../classes/marca.php';
require_once '../classes/estoque.php';
require_once '../classes/pedido.php';
require_once '../classes/produto.php';
require_once '../classes/setor.php';

if (isset($_GET['nome_tabela']) && isset($_GET['id'])) {
    $nome_tabela = $_GET['nome_tabela'];
    $id = $_GET['id'];
    $coluna_id = 'id_' . $nome_tabela;

    try {
        switch ($nome_tabela) {
            case 'cliente':
                $cliente = new Cliente();
                $cliente->setID($id);
                $cliente->excluir();
                break;
            case 'marca':
                $marca = new Marca();
                $marca->setID($id);
                $marca->excluir();
                break;
            case 'estoque':
                $estoque = new Estoque();
                $estoque->setID($id);
                $estoque->excluir();
                break;
            case 'pedido':
                $pedido = new Pedido();
                $pedido->setID($id);
                $pedido->excluir();
                break;
            case 'produto':
                $produto = new Produto();
                $produto->setID($id);
                $produto->excluir();
                break;
            case 'setor':
                $setor = new Setor();
                $setor->setID($id);
                $setor->excluir();
                break;
            default:
                echo "Tabela não encontrada";
                break;
        }

        header('Location: ../forms_insert/form_' . $nome_tabela . '.php');
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}