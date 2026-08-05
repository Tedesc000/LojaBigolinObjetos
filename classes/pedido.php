<?php
require "../conexao.php";
class Produto{
    private $id_pedido;
    private $id_produto;
    private $id_cliente;
    private $data;
    private $quantidade;
    private $preco;
    private $status;
    private $pdo;

    public function __construct(){
        $this->pdo = getConexao();
    }

    //getters e setters
    public function getID(){ return $this->id_pedido;}
    public function getIdCliente(){ return $this->id_cliente;}
    public function getIdSetor(){ return $this->id_setor;}
    public function getData(){ return $this->data;}
    public function getQuantidade(){ return $this->quantidade;}
    public function getPreco(){ return $this->preco;}
    public function getStatus(){ return $this->status;}

    public function setID($id_produto){ $this->id_produto = $id_produto;}
    public function setIdMarca($id_marca){ $this->id_marca = $id_marca;}
    public function setIdSetor($id_setor){ $this->id_setor = $id_setor;}
    public function setNome($data){ $this->data = $data;}
    public function setQuantidade($quantidade){ $this->quantidade = $quantidade;}
    public function setPreco($preco){ $this->preco = $preco;}
    public function setStatus($status){ $this->status = $status;}
}