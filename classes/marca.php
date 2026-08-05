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
        $stmt = $this->pdo->prepare("INSERT INTO marcas(nome, pais) VALUES (:nome, :pais)");
        $stmt->bindParam(":nome", this->nome);
        $stmt->bindParam(":pais", this->pais);
        return $stmt->execute();
    }
}