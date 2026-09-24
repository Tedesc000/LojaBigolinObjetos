<?php
class Pedido implements ArrayAccess {
    private $id_pedido;
    private $id_produto;
    private $id_cliente;
    private $data;
    private $preco;
    private $quantidade;
    private $status;
    private $pdo;

    public function __construct(?PDO $pdo = null){
        $this->pdo = $pdo ?? getConexao();
    }

    // Getters e Setters
    public function getID(){ return $this->id_pedido; }
    public function getIdPedido(){ return $this->id_pedido; }
    public function getIdProduto(){ return $this->id_produto; }
    public function getIdCliente(){ return $this->id_cliente; }
    public function getData(){ return $this->data; }
    public function getPreco(){ return $this->preco; }
    public function getQuantidade(){ return $this->quantidade; }
    public function getStatus(){ return $this->status; }

    public function setID($id_pedido){ $this->id_pedido = $id_pedido; }
    public function setIdPedido($id_pedido){ $this->id_pedido = $id_pedido; }
    public function setIdProduto($id_produto){ $this->id_produto = $id_produto; }
    public function setIdCliente($id_cliente){ $this->id_cliente = $id_cliente; }
    public function setData($data){ $this->data = $data; }
    public function setPreco($preco){ $this->preco = $preco; }
    public function setQuantidade($quantidade){ $this->quantidade = $quantidade; }
    public function setStatus($status){ $this->status = $status; }

    // Salvar (Insert ou Update)
    public function salvar(){
        if ($this->id_pedido) {
            $stmt = $this->pdo->prepare("UPDATE pedido SET id_produto = :id_produto, id_cliente = :id_cliente, data = :data, preco = :preco, quantidade = :quantidade, status = :status WHERE id_pedido = :id_pedido");
            $stmt->bindParam(":id_produto", $this->id_produto);
            $stmt->bindParam(":id_cliente", $this->id_cliente);
            $stmt->bindParam(":data", $this->data);
            $stmt->bindParam(":preco", $this->preco);
            $stmt->bindParam(":quantidade", $this->quantidade);
            $stmt->bindParam(":status", $this->status);
            $stmt->bindParam(":id_pedido", $this->id_pedido);
            return $stmt->execute();
        } else {
            $stmt = $this->pdo->prepare("INSERT INTO pedido (id_produto, id_cliente, data, preco, quantidade, status) VALUES (:id_produto, :id_cliente, :data, :preco, :quantidade, :status)");
            $stmt->bindParam(":id_produto", $this->id_produto);
            $stmt->bindParam(":id_cliente", $this->id_cliente);
            $stmt->bindParam(":data", $this->data);
            $stmt->bindParam(":preco", $this->preco);
            $stmt->bindParam(":quantidade", $this->quantidade);
            $stmt->bindParam(":status", $this->status);
            $ok = $stmt->execute();
            if ($ok) {
                $this->id_pedido = (int)$this->pdo->lastInsertId();
            }
            return $ok;
        }
    }

    // Popula os dados na classe e retorna o registro encontrado
    public function selecionar($id = null){
        if ($id !== null) {
            $this->setID($id);
        }
        if (!$this->id_pedido) {
            return false;
        }
        $stmt = $this->pdo->prepare("SELECT * FROM pedido WHERE id_pedido = :id_pedido");
        $stmt->execute([':id_pedido' => $this->id_pedido]);
        $dados = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($dados) {
            $this->setIdProduto($dados['id_produto'] ?? null);
            $this->setIdCliente($dados['id_cliente'] ?? null);
            $this->setData($dados['data'] ?? '');
            $this->setPreco($dados['preco'] ?? 0);
            $this->setQuantidade($dados['quantidade'] ?? 0);
            $this->setStatus($dados['status'] ?? '');
            return $dados;
        }
        return false;
    }

    // Listar todos os pedidos
    public function listar(){
        $stmt = $this->pdo->prepare("SELECT ped.*, c.nome as cliente_nome, prod.nome as produto_nome 
                                     FROM pedido ped 
                                     LEFT JOIN cliente c ON ped.id_cliente = c.id_cliente 
                                     LEFT JOIN produto prod ON ped.id_produto = prod.id_produto 
                                     ORDER BY ped.id_pedido ASC");
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $stmt = $this->pdo->prepare("SELECT * FROM pedido ORDER BY id_pedido ASC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    // Excluir pedido atual
    public function excluir(){
        if (!$this->id_pedido) return false;
        $stmt = $this->pdo->prepare("DELETE FROM pedido WHERE id_pedido = :id_pedido");
        return $stmt->execute([':id_pedido' => $this->id_pedido]);
    }

    // ArrayAccess
    public function offsetExists($offset): bool {
        return property_exists($this, $offset) || $offset === 'id';
    }

    public function offsetGet($offset): mixed {
        if ($offset === 'id' || $offset === 'id_pedido') return $this->getID();
        if ($offset === 'id_produto') return $this->getIdProduto();
        if ($offset === 'id_cliente') return $this->getIdCliente();
        if ($offset === 'data') return $this->getData();
        if ($offset === 'preco') return $this->getPreco();
        if ($offset === 'quantidade') return $this->getQuantidade();
        if ($offset === 'status') return $this->getStatus();
        return null;
    }

    public function offsetSet($offset, $value): void {
        if ($offset === 'id' || $offset === 'id_pedido') $this->setID($value);
        if ($offset === 'id_produto') $this->setIdProduto($value);
        if ($offset === 'id_cliente') $this->setIdCliente($value);
        if ($offset === 'data') $this->setData($value);
        if ($offset === 'preco') $this->setPreco($value);
        if ($offset === 'quantidade') $this->setQuantidade($value);
        if ($offset === 'status') $this->setStatus($value);
    }

    public function offsetUnset($offset): void {
        $this->offsetSet($offset, null);
    }
}