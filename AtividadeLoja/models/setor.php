<?php
class Setor implements ArrayAccess {
    private $id_setor;
    private $nome;
    private $descricao;
    private $pdo;

    public function __construct(?PDO $pdo = null){
        $this->pdo = $pdo ?? getConexao();
    }

    // Getters e Setters
    public function getID(){ return $this->id_setor; }
    public function getIdSetor(){ return $this->id_setor; }
    public function getNome(){ return $this->nome; }
    public function getDescricao(){ return $this->descricao; }

    public function setID($id_setor){ $this->id_setor = $id_setor; }
    public function setIdSetor($id_setor){ $this->id_setor = $id_setor; }
    public function setNome($nome){ $this->nome = $nome; }
    public function setDescricao($descricao){ $this->descricao = $descricao; }

    // Salvar (Insert ou Update)
    public function salvar(){
        if ($this->id_setor) {
            $stmt = $this->pdo->prepare("UPDATE setor SET nome = :nome, descricao = :descricao WHERE id_setor = :id_setor");
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":descricao", $this->descricao);
            $stmt->bindParam(":id_setor", $this->id_setor);
            return $stmt->execute();
        } else {
            $stmt = $this->pdo->prepare("INSERT INTO setor (nome, descricao) VALUES (:nome, :descricao)");
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":descricao", $this->descricao);
            $ok = $stmt->execute();
            if ($ok) {
                $this->id_setor = (int)$this->pdo->lastInsertId();
            }
            return $ok;
        }
    }

    // Popula os dados na classe e retorna o registro encontrado
    public function selecionar($id = null){
        if ($id !== null) {
            $this->setID($id);
        }
        if (!$this->id_setor) {
            return false;
        }
        $stmt = $this->pdo->prepare("SELECT * FROM setor WHERE id_setor = :id_setor");
        $stmt->execute([':id_setor' => $this->id_setor]);
        $dados = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($dados) {
            $this->setNome($dados['nome'] ?? '');
            $this->setDescricao($dados['descricao'] ?? '');
            return $dados;
        }
        return false;
    }

    // Listar todos os setores
    public function listar(){
        $stmt = $this->pdo->prepare("SELECT * FROM setor ORDER BY id_setor ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Excluir setor atual
    public function excluir(){
        if (!$this->id_setor) return false;
        $stmt = $this->pdo->prepare("DELETE FROM setor WHERE id_setor = :id_setor");
        return $stmt->execute([':id_setor' => $this->id_setor]);
    }

    // ArrayAccess
    public function offsetExists($offset): bool {
        return property_exists($this, $offset) || $offset === 'id';
    }

    public function offsetGet($offset): mixed {
        if ($offset === 'id' || $offset === 'id_setor') return $this->getID();
        if ($offset === 'nome') return $this->getNome();
        if ($offset === 'descricao') return $this->getDescricao();
        return null;
    }

    public function offsetSet($offset, $value): void {
        if ($offset === 'id' || $offset === 'id_setor') $this->setID($value);
        if ($offset === 'nome') $this->setNome($value);
        if ($offset === 'descricao') $this->setDescricao($value);
    }

    public function offsetUnset($offset): void {
        $this->offsetSet($offset, null);
    }
}