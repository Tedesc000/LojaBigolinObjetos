<?php
require "../conexao.php";
class Cliente{
    private $id_cliente;
    private $nome;
    private $cpf;
    private $telefone;
    private $email;

    private $pdo;

    public function __construct(){
        $this->pdo = getConexao();
    }

    //getters e setters
    public function getID(){ return $this->id_cliente;}
    public function getNome(){ return $this->nome;}
    public function getCpf(){ return $this->cpf;}
    public function getTelefone(){ return $this->telefone;}
    public function getEmail(){ return $this->email;}

    public function setID($id_cliente){ $this->id_cliente = $id_cliente;}
    public function setNome($nome){ $this->nome = $nome;}
    public function setCpf($cpf){ $this->cpf = $cpf;}
    public function setTelefone($telefone){ $this->telefone = $telefone;}
    public function setEmail($email){ $this->email = $email;}
}