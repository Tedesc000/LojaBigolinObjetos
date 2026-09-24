<?php
class Cliente implements ArrayAccess {
    private $id_cliente;
    private $nome;
    private $cpf;
    private $telefone;
    private $email;
    private $pdo;

    public function __construct(?PDO $pdo = null){
        $this->pdo = $pdo ?? getConexao();
    }

    // Getters e Setters
    public function getID(){ return $this->id_cliente; }
    public function getIdCliente(){ return $this->id_cliente; }
    public function getNome(){ return $this->nome; }
    public function getCpf(){ return $this->cpf; }
    public function getTelefone(){ return $this->telefone; }
    public function getEmail(){ return $this->email; }

    public function setID($id_cliente){ $this->id_cliente = $id_cliente; }
    public function setIdCliente($id_cliente){ $this->id_cliente = $id_cliente; }
    public function setNome($nome){ $this->nome = $nome; }
    public function setCpf($cpf){ $this->cpf = $cpf; }
    public function setTelefone($telefone){ $this->telefone = $telefone; }
    public function setEmail($email){ $this->email = $email; }

    // Salvar (Insert ou Update)
    public function salvar(){
        if ($this->id_cliente) {
            $stmt = $this->pdo->prepare("UPDATE cliente SET nome = :nome, cpf = :cpf, telefone = :telefone, email = :email WHERE id_cliente = :id_cliente");
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":cpf", $this->cpf);
            $stmt->bindParam(":telefone", $this->telefone);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":id_cliente", $this->id_cliente);
            return $stmt->execute();
        } else {
            $stmt = $this->pdo->prepare("INSERT INTO cliente (nome, cpf, telefone, email) VALUES (:nome, :cpf, :telefone, :email)");
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":cpf", $this->cpf);
            $stmt->bindParam(":telefone", $this->telefone);
            $stmt->bindParam(":email", $this->email);
            $ok = $stmt->execute();
            if ($ok) {
                $this->id_cliente = (int)$this->pdo->lastInsertId();
            }
            return $ok;
        }
    }

    // Popula os dados na classe e retorna o registro encontrado
    public function selecionar($id = null){
        if ($id !== null) {
            $this->setID($id);
        }
        if (!$this->id_cliente) {
            return false;
        }
        $stmt = $this->pdo->prepare("SELECT * FROM cliente WHERE id_cliente = :id_cliente");
        $stmt->execute([':id_cliente' => $this->id_cliente]);
        $dados = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($dados) {
            $this->setNome($dados['nome'] ?? '');
            $this->setCpf($dados['cpf'] ?? '');
            $this->setTelefone($dados['telefone'] ?? '');
            $this->setEmail($dados['email'] ?? '');
            return $dados;
        }
        return false;
    }

    // Listar todos os clientes
    public function listar(){
        $stmt = $this->pdo->prepare("SELECT * FROM cliente ORDER BY id_cliente ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Excluir cliente atual
    public function excluir(){
        if (!$this->id_cliente) return false;
        $stmt = $this->pdo->prepare("DELETE FROM cliente WHERE id_cliente = :id_cliente");
        return $stmt->execute([':id_cliente' => $this->id_cliente]);
    }

    // Métodos para compatibilidade com ArrayAccess ($cliente['campo'])
    public function offsetExists($offset): bool {
        return property_exists($this, $offset) || $offset === 'id';
    }

    public function offsetGet($offset): mixed {
        if ($offset === 'id' || $offset === 'id_cliente') return $this->getID();
        if ($offset === 'nome') return $this->getNome();
        if ($offset === 'cpf') return $this->getCpf();
        if ($offset === 'telefone') return $this->getTelefone();
        if ($offset === 'email') return $this->getEmail();
        return null;
    }

    public function offsetSet($offset, $value): void {
        if ($offset === 'id' || $offset === 'id_cliente') $this->setID($value);
        if ($offset === 'nome') $this->setNome($value);
        if ($offset === 'cpf') $this->setCpf($value);
        if ($offset === 'telefone') $this->setTelefone($value);
        if ($offset === 'email') $this->setEmail($value);
    }

    public function offsetUnset($offset): void {
        $this->offsetSet($offset, null);
    }
}