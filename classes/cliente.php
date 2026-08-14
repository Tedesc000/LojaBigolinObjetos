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
        if($this->id_cliente){
            $stmt = $this->pdo->prepare("UPDATE cliente SET nome = :nome, cpf = :cpf, telefone = :telefone, email = :email WHERE id_cliente = :id_cliente");
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":cpf", $this->cpf);
            $stmt->bindParam(":telefone", $this->telefone);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":id_cliente", $this->id_cliente);
            $ok =  $stmt->execute();
        }else{
            $stmt = $this->pdo->prepare("INSERT INTO cliente(nome, cpf, telefone, email) VALUES (:nome, :cpf, :telefone, :email)");
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":cpf", $this->cpf);
            $stmt->bindParam(":telefone", $this->telefone);
            $stmt->bindParam(":email", $this->email);
            $ok = $stmt->execute();
        }
        if($ok){
            $this->id_cliente = $this->pdo->lastInsertId();
        }
        return $ok;
    }

    public function selecionar(){
        $stmt = $this->pdo->prepare("SELECT * FROM cliente WHERE id_cliente = :id_cliente");
        $stmt->execute([':id_cliente' => $this->id_cliente]);
        return $stmt->fetchAll();
    }

    public function listar(){
        $stmt = $this->pdo->prepare("SELECT * FROM cliente");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function excluir(){
        if(!$this->id_cliente) return false;
        $stmt = $this->pdo->prepare("DELETE FROM cliente WHERE id_cliente = :id_cliente");
        return $stmt->execute(['id_cliente' => $this->id_cliente]);
    }
}