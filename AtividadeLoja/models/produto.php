<?php
class Produto implements ArrayAccess {
    private $id_produto;
    private $id_marca;
    private $id_setor;
    private $nome;
    private $preco;
    private $descricao;
    private $status;
    private $pdo;

    public function __construct(?PDO $pdo = null){
        $this->pdo = $pdo ?? getConexao();
    }

    // Getters e Setters
    public function getID(){ return $this->id_produto; }
    public function getIdProduto(){ return $this->id_produto; }
    public function getIdMarca(){ return $this->id_marca; }
    public function getIdSetor(){ return $this->id_setor; }
    public function getNome(){ return $this->nome; }
    public function getPreco(){ return $this->preco; }
    public function getDescricao(){ return $this->descricao; }
    public function getStatus(){ return $this->status; }

    public function setID($id_produto){ $this->id_produto = $id_produto; }
    public function setIdProduto($id_produto){ $this->id_produto = $id_produto; }
    public function setIdMarca($id_marca){ $this->id_marca = $id_marca; }
    public function setIdSetor($id_setor){ $this->id_setor = $id_setor; }
    public function setNome($nome){ $this->nome = $nome; }
    public function setPreco($preco){ $this->preco = $preco; }
    public function setDescricao($descricao){ $this->descricao = $descricao; }
    public function setStatus($status){ $this->status = $status; }

    // Salvar (Insert ou Update)
    public function salvar(){
        if ($this->id_produto) {
            $stmt = $this->pdo->prepare("UPDATE produto SET id_marca = :id_marca, id_setor = :id_setor, nome = :nome, preco = :preco, descricao = :descricao, status = :status WHERE id_produto = :id_produto");
            $stmt->bindParam(":id_marca", $this->id_marca);
            $stmt->bindParam(":id_setor", $this->id_setor);
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":preco", $this->preco);
            $stmt->bindParam(":descricao", $this->descricao);
            $stmt->bindParam(":status", $this->status);
            $stmt->bindParam(":id_produto", $this->id_produto);
            return $stmt->execute();
        } else {
            $stmt = $this->pdo->prepare("INSERT INTO produto (id_marca, id_setor, nome, preco, descricao, status) VALUES (:id_marca, :id_setor, :nome, :preco, :descricao, :status)");
            $stmt->bindParam(":id_marca", $this->id_marca);
            $stmt->bindParam(":id_setor", $this->id_setor);
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":preco", $this->preco);
            $stmt->bindParam(":descricao", $this->descricao);
            $stmt->bindParam(":status", $this->status);
            $ok = $stmt->execute();
            if ($ok) {
                $this->id_produto = (int)$this->pdo->lastInsertId();
            }
            return $ok;
        }
    }

    // Popula os dados na classe e retorna o registro encontrado
    public function selecionar($id = null){
        if ($id !== null) {
            $this->setID($id);
        }
        if (!$this->id_produto) {
            return false;
        }
        $stmt = $this->pdo->prepare("SELECT * FROM produto WHERE id_produto = :id_produto");
        $stmt->execute([':id_produto' => $this->id_produto]);
        $dados = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($dados) {
            $this->setIdMarca($dados['id_marca'] ?? null);
            $this->setIdSetor($dados['id_setor'] ?? null);
            $this->setNome($dados['nome'] ?? '');
            $this->setPreco($dados['preco'] ?? 0);
            $this->setDescricao($dados['descricao'] ?? '');
            $this->setStatus($dados['status'] ?? '');
            return $dados;
        }
        return false;
    }

    // Listar todos os produtos (pode incluir nome de marca e setor se desejar)
    public function listar(){
        $stmt = $this->pdo->prepare("SELECT p.*, m.nome as marca_nome, s.nome as setor_nome 
                                     FROM produto p 
                                     LEFT JOIN marca m ON p.id_marca = m.id_marca 
                                     LEFT JOIN setor s ON p.id_setor = s.id_setor 
                                     ORDER BY p.id_produto ASC");
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Caso as tabelas relacionadas ainda não estejam criadas com esses nomes exatos
            $stmt = $this->pdo->prepare("SELECT * FROM produto ORDER BY id_produto ASC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    // Excluir produto atual
    public function excluir(){
        if (!$this->id_produto) return false;
        $stmt = $this->pdo->prepare("DELETE FROM produto WHERE id_produto = :id_produto");
        return $stmt->execute([':id_produto' => $this->id_produto]);
    }

    // ArrayAccess
    public function offsetExists($offset): bool {
        return property_exists($this, $offset) || $offset === 'id';
    }

    public function offsetGet($offset): mixed {
        if ($offset === 'id' || $offset === 'id_produto') return $this->getID();
        if ($offset === 'id_marca') return $this->getIdMarca();
        if ($offset === 'id_setor') return $this->getIdSetor();
        if ($offset === 'nome') return $this->getNome();
        if ($offset === 'preco') return $this->getPreco();
        if ($offset === 'descricao') return $this->getDescricao();
        if ($offset === 'status') return $this->getStatus();
        return null;
    }

    public function offsetSet($offset, $value): void {
        if ($offset === 'id' || $offset === 'id_produto') $this->setID($value);
        if ($offset === 'id_marca') $this->setIdMarca($value);
        if ($offset === 'id_setor') $this->setIdSetor($value);
        if ($offset === 'nome') $this->setNome($value);
        if ($offset === 'preco') $this->setPreco($value);
        if ($offset === 'descricao') $this->setDescricao($value);
        if ($offset === 'status') $this->setStatus($value);
    }

    public function offsetUnset($offset): void {
        $this->offsetSet($offset, null);
    }
}