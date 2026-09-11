<?php
require_once "models/Setor.php";
class SetorController{
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function listar(){
        $setor = new Setor($this->db);
        $setores = $setor->listar();

        require_once "views/setor/listar.php";
        }
}