<?php
class ProdutoController {
    private $db;

    public function __construct($db = null){
        $this->db = $db;
    }

    public function listar(){
        $produto = new Produto($this->db);
        $produtos = $produto->listar();
        require_once __DIR__ . "/../views/produto/listar.php";
    }

    public function criar(){
        $produto = new Produto($this->db);
        $marcas = (new Marca($this->db))->listar();
        $setores = (new Setor($this->db))->listar();
        require_once __DIR__ . "/../views/produto/form.php";
    }

    public function editar(){
        $id = $_GET['id'] ?? null;
        $produto = new Produto($this->db);
        if ($id) {
            $produto->selecionar($id);
        }
        $marcas = (new Marca($this->db))->listar();
        $setores = (new Setor($this->db))->listar();
        require_once __DIR__ . "/../views/produto/form.php";
    }

    public function salvar(){
        $produto = new Produto($this->db);
        if (!empty($_POST['id_produto'])) {
            $produto->setID($_POST['id_produto']);
        }
        $produto->setIdMarca(!empty($_POST['id_marca']) ? $_POST['id_marca'] : null);
        $produto->setIdSetor(!empty($_POST['id_setor']) ? $_POST['id_setor'] : null);
        $produto->setNome($_POST['nome'] ?? '');
        $produto->setPreco($_POST['preco'] ?? 0);
        $produto->setDescricao($_POST['descricao'] ?? '');
        $produto->setStatus($_POST['status'] ?? 'ativo');
        $produto->salvar();

        header("Location: index.php?modulo=produto&acao=listar");
        exit;
    }

    public function excluir(){
        $id = $_GET['id'] ?? null;
        if ($id) {
            $produto = new Produto($this->db);
            $produto->setID($id);
            $produto->excluir();
        }
        header("Location: index.php?modulo=produto&acao=listar");
        exit;
    }
}