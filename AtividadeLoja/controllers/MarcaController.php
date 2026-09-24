<?php
class MarcaController {
    private $db;

    public function __construct($db = null){
        $this->db = $db;
    }

    public function listar(){
        $marca = new Marca($this->db);
        $marcas = $marca->listar();
        require_once __DIR__ . "/../views/marca/listar.php";
    }

    public function criar(){
        $marca = new Marca($this->db);
        require_once __DIR__ . "/../views/marca/form.php";
    }

    public function editar(){
        $id = $_GET['id'] ?? null;
        $marca = new Marca($this->db);
        if ($id) {
            $marca->selecionar($id);
        }
        require_once __DIR__ . "/../views/marca/form.php";
    }

    public function salvar(){
        $marca = new Marca($this->db);
        if (!empty($_POST['id_marca'])) {
            $marca->setID($_POST['id_marca']);
        }
        $marca->setNome($_POST['nome'] ?? '');
        $marca->setPais($_POST['pais'] ?? '');
        $marca->salvar();

        header("Location: index.php?modulo=marca&acao=listar");
        exit;
    }

    public function excluir(){
        $id = $_GET['id'] ?? null;
        if ($id) {
            $marca = new Marca($this->db);
            $marca->setID($id);
            $marca->excluir();
        }
        header("Location: index.php?modulo=marca&acao=listar");
        exit;
    }
}