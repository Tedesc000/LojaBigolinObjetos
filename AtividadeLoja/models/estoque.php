<?php
class Estoque implements ArrayAccess {
    private $id_estoque;
    private $id_produto;
    private $quantidade;
    private $pavilhao;
    private $pdo;

    public function __construct(?PDO $pdo = null){
        $this->pdo = $pdo ?? getConexao();
    }

    // Getters e Setters
    public function getID(){ return $this->id_estoque; }
    public function getIdEstoque(){ return $this->id_estoque; }
    public function getIdProduto(){ return $this->id_produto; }
    public function getQuantidade(){ return $this->quantidade; }
    public function getPavilhao(){ return $this->pavilhao; }

    public function setID($id_estoque){ $this->id_estoque = $id_estoque; }
    public function setIdEstoque($id_estoque){ $this->id_estoque = $id_estoque; }
    public function setIdProduto($id_produto){ $this->id_produto = $id_produto; }
    public function setQuantidade($quantidade){ $this->quantidade = $quantidade; }
    public function setPavilhao($pavilhao){ $this->pavilhao = $pavilhao; }

    // Salvar (Insert ou Update)
    public function salvar(){
        if ($this->id_estoque) {
            $stmt = $this->pdo->prepare("UPDATE estoque SET id_produto = :id_produto, quantidade = :quantidade, pavilhao = :pavilhao WHERE id_estoque = :id_estoque");
            $stmt->bindParam(":id_produto", $this->id_produto);
            $stmt->bindParam(":quantidade", $this->quantidade);
            $stmt->bindParam(":pavilhao", $this->pavilhao);
            $stmt->bindParam(":id_estoque", $this->id_estoque);
            return $stmt->execute();
        } else {
            $stmt = $this->pdo->prepare("INSERT INTO estoque (id_produto, quantidade, pavilhao) VALUES (:id_produto, :quantidade, :pavilhao)");
            $stmt->bindParam(":id_produto", $this->id_produto);
            $stmt->bindParam(":quantidade", $this->quantidade);
            $stmt->bindParam(":pavilhao", $this->pavilhao);
            $ok = $stmt->execute();
            if ($ok) {
                $this->id_estoque = (int)$this->pdo->lastInsertId();
            }
            return $ok;
        }
    }

    // Popula os dados na classe e retorna o registro encontrado
    public function selecionar($id = null){
        if ($id !== null) {
            $this->setID($id);
        }
        if (!$this->id_estoque) {
            return false;
        }
        $stmt = $this->pdo->prepare("SELECT * FROM estoque WHERE id_estoque = :id_estoque");
        $stmt->execute([':id_estoque' => $this->id_estoque]);
        $dados = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($dados) {
            $this->setIdProduto($dados['id_produto'] ?? null);
            $this->setQuantidade($dados['quantidade'] ?? 0);
            $this->setPavilhao($dados['pavilhao'] ?? '');
            return $dados;
        }
        return false;
    }

    // Listar todos os estoques
    public function listar(){
        $stmt = $this->pdo->prepare("SELECT e.*, p.nome as produto_nome 
                                     FROM estoque e 
                                     LEFT JOIN produto p ON e.id_produto = p.id_produto 
                                     ORDER BY e.id_estoque ASC");
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $stmt = $this->pdo->prepare("SELECT * FROM estoque ORDER BY id_estoque ASC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    // Excluir estoque atual
    public function excluir(){
        if (!$this->id_estoque) return false;
        $stmt = $this->pdo->prepare("DELETE FROM estoque WHERE id_estoque = :id_estoque");
        return $stmt->execute([':id_estoque' => $this->id_estoque]);
    }

    // ArrayAccess
    public function offsetExists($offset): bool {
        return property_exists($this, $offset) || $offset === 'id';
    }

    public function offsetGet($offset): mixed {
        if ($offset === 'id' || $offset === 'id_estoque') return $this->getID();
        if ($offset === 'id_produto') return $this->getIdProduto();
        if ($offset === 'quantidade') return $this->getQuantidade();
        if ($offset === 'pavilhao') return $this->getPavilhao();
        return null;
    }

    public function offsetSet($offset, $value): void {
        if ($offset === 'id' || $offset === 'id_estoque') $this->setID($value);
        if ($offset === 'id_produto') $this->setIdProduto($value);
        if ($offset === 'quantidade') $this->setQuantidade($value);
        if ($offset === 'pavilhao') $this->setPavilhao($value);
    }

    public function offsetUnset($offset): void {
        $this->offsetSet($offset, null);
    }
}