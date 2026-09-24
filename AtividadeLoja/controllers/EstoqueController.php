<?php
class EstoqueController {
    private $db;

    public function __construct($db = null){
        $this->db = $db;
    }

    public function listar(){
        $estoque = new Estoque($this->db);
        $estoques = $estoque->listar();
        require_once __DIR__ . "/../views/estoque/listar.php";
    }

    public function criar(){
        $estoque = new Estoque($this->db);
        $produtos = (new Produto($this->db))->listar();
        require_once __DIR__ . "/../views/estoque/form.php";
    }

    public function editar(){
        $id = $_GET['id'] ?? null;
        $estoque = new Estoque($this->db);
        if ($id) {
            $estoque->selecionar($id);
        }
        $produtos = (new Produto($this->db))->listar();
        require_once __DIR__ . "/../views/estoque/form.php";
    }

    public function salvar(){
        $estoque = new Estoque($this->db);
        if (!empty($_POST['id_estoque'])) {
            $estoque->setID($_POST['id_estoque']);
        }
        $estoque->setIdProduto(!empty($_POST['id_produto']) ? $_POST['id_produto'] : null);
        $estoque->setQuantidade($_POST['quantidade'] ?? 0);
        $estoque->setPavilhao($_POST['pavilhao'] ?? '');
        $estoque->salvar();

        header("Location: index.php?modulo=estoque&acao=listar");
        exit;
    }

    public function excluir(){
        $id = $_GET['id'] ?? null;
        if ($id) {
            $estoque = new Estoque($this->db);
            $estoque->setID($id);
            $estoque->excluir();
        }
        header("Location: index.php?modulo=estoque&acao=listar");
        exit;
    }
}