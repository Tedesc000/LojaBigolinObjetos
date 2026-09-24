<?php
class Marca implements ArrayAccess {
    private $id_marca;
    private $nome;
    private $pais;
    private $pdo;

    public function __construct(?PDO $pdo = null){
        $this->pdo = $pdo ?? getConexao();
    }

    // Detecta se a tabela foi nomeada 'marca' ou 'marcas' no banco
    private function getTabela(){
        try {
            $this->pdo->query("SELECT 1 FROM marca LIMIT 1");
            return "marca";
        } catch (PDOException $e) {
            return "marcas";
        }
    }

    // Getters e Setters
    public function getID(){ return $this->id_marca; }
    public function getIdMarca(){ return $this->id_marca; }
    public function getNome(){ return $this->nome; }
    public function getPais(){ return $this->pais; }

    public function setID($id_marca){ $this->id_marca = $id_marca; }
    public function setIdMarca($id_marca){ $this->id_marca = $id_marca; }
    public function setNome($nome){ $this->nome = $nome; }
    public function setPais($pais){ $this->pais = $pais; }

    // Salvar (Insert ou Update)
    public function salvar(){
        $tabela = $this->getTabela();
        if ($this->id_marca) {
            $stmt = $this->pdo->prepare("UPDATE {$tabela} SET nome = :nome, pais = :pais WHERE id_marca = :id_marca");
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":pais", $this->pais);
            $stmt->bindParam(":id_marca", $this->id_marca);
            return $stmt->execute();
        } else {
            $stmt = $this->pdo->prepare("INSERT INTO {$tabela} (nome, pais) VALUES (:nome, :pais)");
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":pais", $this->pais);
            $ok = $stmt->execute();
            if ($ok) {
                $this->id_marca = (int)$this->pdo->lastInsertId();
            }
            return $ok;
        }
    }

    // Popula os dados na classe e retorna o registro encontrado
    public function selecionar($id = null){
        if ($id !== null) {
            $this->setID($id);
        }
        if (!$this->id_marca) {
            return false;
        }
        $tabela = $this->getTabela();
        $stmt = $this->pdo->prepare("SELECT * FROM {$tabela} WHERE id_marca = :id_marca");
        $stmt->execute([':id_marca' => $this->id_marca]);
        $dados = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($dados) {
            $this->setNome($dados['nome'] ?? '');
            $this->setPais($dados['pais'] ?? '');
            return $dados;
        }
        return false;
    }

    // Listar todas as marcas
    public function listar(){
        $tabela = $this->getTabela();
        $stmt = $this->pdo->prepare("SELECT * FROM {$tabela} ORDER BY id_marca ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Excluir marca atual
    public function excluir(){
        if (!$this->id_marca) return false;
        $tabela = $this->getTabela();
        $stmt = $this->pdo->prepare("DELETE FROM {$tabela} WHERE id_marca = :id_marca");
        return $stmt->execute([':id_marca' => $this->id_marca]);
    }

    // ArrayAccess
    public function offsetExists($offset): bool {
        return property_exists($this, $offset) || $offset === 'id';
    }

    public function offsetGet($offset): mixed {
        if ($offset === 'id' || $offset === 'id_marca') return $this->getID();
        if ($offset === 'nome') return $this->getNome();
        if ($offset === 'pais') return $this->getPais();
        return null;
    }

    public function offsetSet($offset, $value): void {
        if ($offset === 'id' || $offset === 'id_marca') $this->setID($value);
        if ($offset === 'nome') $this->setNome($value);
        if ($offset === 'pais') $this->setPais($value);
    }

    public function offsetUnset($offset): void {
        $this->offsetSet($offset, null);
    }
}