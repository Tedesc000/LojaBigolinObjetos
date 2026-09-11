<?php
require_once "models/Estoque.php";
class EstoqueController{
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function listar(){
        $estoque = new Estoque($this->db);
        $estoques = $estoque->listar();

        require_once "views/estoque/listar.php";
        }
}