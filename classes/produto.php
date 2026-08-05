<?php
require "../conexao.php";
class Produto{
    private $id_produto;
    private $id_marca;
    private $id_setor;
    private $nome;
    private $preco;
    private $descricao;
    private $status;
    private $pdo;

    public function __construct(){
        $this->pdo = getConexao();
    }

    //getters e setters
    public function getID(){ return $this->id_produto;}
    public function getIdMarca(){ return $this->id_marca;}
    public function getIdSetor(){ return $this->id_setor;}
    public function getNome(){ return $this->nome;}
    public function getPreco(){ return $this->preco;}
    public function getDescricao(){ return $this->descricao;}
    public function getStatus(){ return $this->status;}

    public function setID($id_produto){ $this->id_produto = $id_produto;}
    public function setIdMarca($id_marca){ $this->id_marca = $id_marca;}
    public function setIdSetor($id_setor){ $this->id_setor = $id_setor;}
    public function setNome($nome){ $this->nome = $nome;}
    public function setPreco($preco){ $this->preco = $preco;}
    public function setDescricao($descricao){ $this->descricao = $descricao;}
    public function setStatus($status){ $this->status = $status;}

    public function salvar(){
        $stmt = $this->pdo->prepare("INSERT INTO pedido(id_produto, id_cliente, data, preco, quantidade, status) VALUES (:id_produto, :id_cliente, :data, :preco, :quantidade, :status)");
        $stmt->bindParam(":id_produto", this->id_produto);
        $stmt->bindParam(":id_cliente", this->id_cliente);
        $stmt->bindParam(":data", this->data);
        $stmt->bindParam(":preco", this->preco);
        $stmt->bindParam(":quantidade", this->quantidade);
        $stmt->bindParam(":status", this->status);
        return $stmt->execute();
    }
}