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
        if($this->id_produto){
            $stmt = $this->pdo->prepare("UPDATE produto SET id_marca = :id_marca, id_setor = :id_setor, nome = :nome, preco = :preco, descricao = :descricao, status = :status WHERE id_produto = :id_produto");
            $stmt->bindParam(":id_marca", $this->id_marca);
            $stmt->bindParam(":id_setor", $this->id_setor);
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":preco", $this->preco);
            $stmt->bindParam(":descricao", $this->descricao);
            $stmt->bindParam(":status", $this->status);
            $stmt->bindParam(":id_produto", $this->id_produto);
            $ok = $stmt->execute();
        }else{
            $stmt = $this->pdo->prepare("INSERT INTO produto(id_marca, id_setor, nome, preco, descricao, status) VALUES (:id_marca, :id_setor, :nome, :preco, :descricao, :status)");
            $stmt->bindParam(":id_marca", $this->id_marca);
            $stmt->bindParam(":id_setor", $this->id_setor);
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":preco", $this->preco);
            $stmt->bindParam(":descricao", $this->descricao);
            $stmt->bindParam(":status", $this->status);
            $ok = $stmt->execute();
        }
        if($ok){
            $this->id_produto = $this->pdo->lastInsertId();
        }
        return $ok;
    }

    public function selecionar(){
        $stmt = $this->pdo->prepare("SELECT * FROM produto WHERE id_produto = :id_produto");
        $stmt->execute([':id_produto' => $this->id_produto]);
        return $stmt->fetchAll();
    }

    public function listar(){
        $stmt = $this->pdo->prepare("SELECT * FROM produto");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function excluir(){
        if(!$this->id_produto) return false;
        $stmt = $this->pdo->prepare("DELETE FROM produto WHERE id_produto = :id_produto");
        return $stmt->execute([':id_produto' => $this->id_produto]);
    }
}