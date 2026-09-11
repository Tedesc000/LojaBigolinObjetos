<?php
require_once "models/Produto.php";
class ProdutoController{
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function listar(){
        $produto = new Produto($this->db);
        $produtos = $produto->listar();

        require_once "views/produto/listar.php";
        }
}