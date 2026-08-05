<?php
require "../conexao.php";
class Estoque{
    private $id_estoque;
    private $id_produto;
    private $quantidade;
    private $pavilhao;
    private $pdo;

    public function __construct(){
        $this->pdo = getConexao();
    }

    //getters e setters
    public function getID(){ return $this->id_estoque;}
    public function getIdProduto(){ return $this->id_produto;}
    public function getQuantidade(){ return $this->quantidade;}
    public function getPavilhao(){ return $this->pavilhao;}

    public function setID($id_estoque){ $this->id_estoque = $id_estoque;}
    public function setIdProduto($id_produto){ $this->id_produto = $id_produto;}
    public function setQuantidade($quantidade){ $this->quantidade = $quantidade;}
    public function setPavilhao($pavilhao){ $this->pavilhao = $pavilhao;}
}