<?php
require "../conexao.php";
class Marca{
    private $id_marca;
    private $nome;
    private $pais;
    private $pdo;

    public function __construct(){
        $this->pdo = getConexao();
    }

    //getters e setters
    public function getID(){ return $this->id_marca;}
    public function getNome(){ return $this->nome;}
    public function getPais(){ return $this->pais;}

    public function setID($id_marca){ $this->id_marca = $id_marca;}
    public function setNome($nome){ $this->nome = $nome;}
    public function setPais($pais){ $this->pais = $pais;}

    public function salvar(){
        if($this->id_marca){
            $stmt = $this->pdo->prepare("UPDATE marcas SET nome = :nome, pais = :pais WHERE id_marca = :id_marca");
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":pais", $this->pais);
            $stmt->bindParam(":id_marca", $this->id_marca);
            $ok = $stmt->execute();
        }else{
            $stmt = $this->pdo->prepare("INSERT INTO marcas(nome, pais) VALUES (:nome, :pais)");
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":pais", $this->pais);
            $ok = $stmt->execute();
        }
        if($ok){
            $this->id_marca = $this->pdo->lastInsertId();
        }
        return $ok;
    }

    public function selecionar(){
        $stmt = $this->pdo->prepare("SELECT * FROM marcas WHERE id_marca = :id_marca");
        $stmt->execute([':id_marca' => $this->id_marca]);
        return $stmt->fetchAll();
    }

    public function listar(){
        $stmt = $this->pdo->prepare("SELECT * FROM marcas");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function excluir(){
        if(!$this->id_marca) return false;
        $stmt = $this->pdo->prepare("DELETE FROM marcas WHERE id_marca = :id_marca");
        return $stmt->execute([':id_marca' => $this->id_marca]);
    }
}