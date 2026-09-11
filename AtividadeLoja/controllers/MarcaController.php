<?php
require_once "models/Marca.php";
class MarcaController{
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function listar(){
        $marca = new Marca($this->db);
        $marcas = $marca->listar();

        require_once "views/marca/listar.php";
        }
}