<?php
require "../conexao.php";
class Setor{
    private $id_setor;
    private $nome;
    private $descricao;
    private $pdo;

    public function __construct(){
        $this->pdo = getConexao();
    }

    //getters e setters
    public function getID(){ return $this->id_setor;}
    public function getNome(){ return $this->nome;}
    public function getDescricao(){ return $this->descricao;}

    public function setID($id_setor){ $this->id_setor = $id_setor;}
    public function setNome($nome){ $this->nome = $nome;}
    public function setDescricao($descricao){ $this->descricao = $descricao;}

    public function salvar(){
        if($this->id_setor){
            $stmt = $this->pdo->prepare("UPDATE setor SET nome = :nome, descricao = :descricao WHERE id_setor = :id_setor");
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":descricao", $this->descricao);
            $stmt->bindParam(":id_setor", $this->id_setor);
            $ok = $stmt->execute();
        }else{
            $stmt = $this->pdo->prepare("INSERT INTO setor(nome, descricao) VALUES (:nome, :descricao)");
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":descricao", $this->descricao);
            $ok = $stmt->execute();
        }
        if($ok){
            $this->id_setor = $this->pdo->lastInsertId();
        }
        return $ok;
    }

    public function selecionar(){
        $stmt = $this->pdo->prepare("SELECT * FROM setor WHERE id_setor = :id_setor");
        $stmt->execute([':id_setor' => $this->id_setor]);
        return $stmt->fetchAll();
    }

    public function listar(){
        $stmt = $this->pdo->prepare("SELECT * FROM setor");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function excluir(){
        if(!$this->id_setor) return false;
        $stmt = $this->pdo->prepare("DELETE FROM setor WHERE id_setor = :id_setor");
        return $stmt->execute([':id_setor' => $this->id_setor]);
    }
}