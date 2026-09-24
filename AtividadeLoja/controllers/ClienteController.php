<?php
class ClienteController {
    private $db;

    public function __construct($db = null){
        $this->db = $db;
    }

    public function listar(){
        $cliente = new Cliente($this->db);
        $clientes = $cliente->listar();
        require_once __DIR__ . "/../views/cliente/listar.php";
    }

    //Função para listar os dados em json para que o JS possa usar
    public function listarJson(){
        header('Content-Type: application/json; charset=utf-8');
        $cliente = new Cliente($this->db);
        $clientes = $cliente->listar();
        echo json_encode($clientes);
        exit;
    }

    public function criar(){
        $cliente = new Cliente($this->db);
        require_once __DIR__ . "/../views/cliente/form.php";
    }

    public function editar(){
        $id = $_GET['id'] ?? null;
        $cliente = new Cliente($this->db);
        if ($id) {
            $cliente->selecionar($id);
        }
        require_once __DIR__ . "/../views/cliente/form.php";
    }

    public function salvar(){
        $cliente = new Cliente($this->db);
        if (!empty($_POST['id_cliente'])) {
            $cliente->setID($_POST['id_cliente']);
        }
        $cliente->setNome($_POST['nome'] ?? '');
        $cliente->setCpf($_POST['cpf'] ?? '');
        $cliente->setTelefone($_POST['telefone'] ?? '');
        $cliente->setEmail($_POST['email'] ?? '');
        try {
            $cliente->salvar();
            header("Location: index.php?modulo=cliente&acao=listar");
            exit;
        } catch (PDOException $e) {
            throw new Exception("Erro ao salvar no banco de dados: " . $e->getMessage());
        }
    }

    public function excluir(){
        $id = $_GET['id'] ?? null;
        if ($id) {
            $cliente = new Cliente($this->db);
            $cliente->setID($id);
            $cliente->excluir();
        }
        header("Location: index.php?modulo=cliente&acao=listar");
        exit;
    }
}