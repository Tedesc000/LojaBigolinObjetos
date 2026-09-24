<?php
class PedidoController {
    private $db;

    public function __construct($db = null){
        $this->db = $db;
    }

    public function listar(){
        $pedido = new Pedido($this->db);
        $pedidos = $pedido->listar();
        require_once __DIR__ . "/../views/pedido/listar.php";
    }

    public function criar(){
        $pedido = new Pedido($this->db);
        $clientes = (new Cliente($this->db))->listar();
        $produtos = (new Produto($this->db))->listar();
        require_once __DIR__ . "/../views/pedido/form.php";
    }

    public function editar(){
        $id = $_GET['id'] ?? null;
        $pedido = new Pedido($this->db);
        if ($id) {
            $pedido->selecionar($id);
        }
        $clientes = (new Cliente($this->db))->listar();
        $produtos = (new Produto($this->db))->listar();
        require_once __DIR__ . "/../views/pedido/form.php";
    }

    public function salvar(){
        $pedido = new Pedido($this->db);
        if (!empty($_POST['id_pedido'])) {
            $pedido->setID($_POST['id_pedido']);
        }
        $pedido->setIdProduto(!empty($_POST['id_produto']) ? $_POST['id_produto'] : null);
        $pedido->setIdCliente(!empty($_POST['id_cliente']) ? $_POST['id_cliente'] : null);
        $pedido->setData(!empty($_POST['data']) ? $_POST['data'] : date('Y-m-d'));
        $pedido->setPreco($_POST['preco'] ?? 0);
        $pedido->setQuantidade($_POST['quantidade'] ?? 1);
        $pedido->setStatus($_POST['status'] ?? 'pendente');
        $pedido->salvar();

        header("Location: index.php?modulo=pedido&acao=listar");
        exit;
    }

    public function excluir(){
        $id = $_GET['id'] ?? null;
        if ($id) {
            $pedido = new Pedido($this->db);
            $pedido->setID($id);
            $pedido->excluir();
        }
        header("Location: index.php?modulo=pedido&acao=listar");
        exit;
    }
}