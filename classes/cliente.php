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

    public function salvar(){
        $stmt = $this->pdo->prepare("INSERT INTO cliente(nome, cpf, telefone, email) VALUES (:nome, :cpf, :telefone, :email)");
        $stmt->bindParam(":nome", this->nome);
        $stmt->bindParam(":cpf", this->cpf);
        $stmt->bindParam(":telefone", this->telefone);
        $stmt->bindParam(":email", this->email);
        return $stmt->execute();
    }
}