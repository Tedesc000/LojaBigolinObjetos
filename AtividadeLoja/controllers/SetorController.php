<?php
class SetorController {
    private $db;

    public function __construct($db = null){
        $this->db = $db;
    }

    public function listar(){
        $setor = new Setor($this->db);
        $setores = $setor->listar();
        require_once __DIR__ . "/../views/setor/listar.php";
    }

    public function criar(){
        $setor = new Setor($this->db);
        require_once __DIR__ . "/../views/setor/form.php";
    }

    public function editar(){
        $id = $_GET['id'] ?? null;
        $setor = new Setor($this->db);
        if ($id) {
            $setor->selecionar($id);
        }
        require_once __DIR__ . "/../views/setor/form.php";
    }

    public function salvar(){
        $setor = new Setor($this->db);
        if (!empty($_POST['id_setor'])) {
            $setor->setID($_POST['id_setor']);
        }
        $setor->setNome($_POST['nome'] ?? '');
        $setor->setDescricao($_POST['descricao'] ?? '');
        $setor->salvar();

        header("Location: index.php?modulo=setor&acao=listar");
        exit;
    }

    public function excluir(){
        $id = $_GET['id'] ?? null;
        if ($id) {
            $setor = new Setor($this->db);
            $setor->setID($id);
            $setor->excluir();
        }
        header("Location: index.php?modulo=setor&acao=listar");
        exit;
    }
}