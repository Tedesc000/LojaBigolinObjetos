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
}