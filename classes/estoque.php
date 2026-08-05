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

    public function salvar(){
        $stmt = $this->pdo->prepare("INSERT INTO estoque(id_produto, quantidade, pavilhão) VALUES (:id_produto, :quantidade, :pavilhao)");
        $stmt->bindParam(":id_produto", this->id_produto);
        $stmt->bindParam(":quantidade", this->quantidade);
        $stmt->bindParam(":pavilhao", this->pavilhao);
        return $stmt->execute();
    }
}