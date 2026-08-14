<?php
require "../conexao.php";
class Pedido{
    private $id_pedido;
    private $id_produto;
    private $id_cliente;
    private $data;
    private $quantidade;
    private $preco;
    private $status;
    private $pdo;

    public function __construct(){
        $this->pdo = getConexao();
    }

    //getters e setters
    public function getID(){ return $this->id_pedido;}
    public function getIdCliente(){ return $this->id_cliente;}
    public function getIdProduto(){ return $this->id_produto;}
    public function getData(){ return $this->data;}
    public function getQuantidade(){ return $this->quantidade;}
    public function getPreco(){ return $this->preco;}
    public function getStatus(){ return $this->status;}

    public function setID($id_pedido){ $this->id_pedido = $id_pedido;}
    public function setIdProduto($id_produto){ $this->id_produto = $id_produto;}
    public function setIdCliente($id_cliente){ $this->id_cliente = $id_cliente;}
    public function setData($data){ $this->data = $data;}
    public function setQuantidade($quantidade){ $this->quantidade = $quantidade;}
    public function setPreco($preco){ $this->preco = $preco;}
    public function setStatus($status){ $this->status = $status;}

    public function salvar(){
        if($this->id_pedido){
            $stmt = $this->pdo->prepare("UPDATE pedido SET id_produto = :id_produto, id_cliente = :id_cliente, data = :data, preco = :preco, quantidade = :quantidade, status = :status WHERE id_pedido = :id_pedido");
            $stmt->bindParam(":id_produto", $this->id_produto);
            $stmt->bindParam(":id_cliente", $this->id_cliente);
            $stmt->bindParam(":data", $this->data);
            $stmt->bindParam(":preco", $this->preco);
            $stmt->bindParam(":quantidade", $this->quantidade);
            $stmt->bindParam(":status", $this->status);
            $stmt->bindParam(":id_pedido", $this->id_pedido);
            $ok = $stmt->execute();
        }else{
            $stmt = $this->pdo->prepare("INSERT INTO pedido(id_produto, id_cliente, data, preco, quantidade, status) VALUES (:id_produto, :id_cliente, :data, :preco, :quantidade, :status)");
            $stmt->bindParam(":id_produto", $this->id_produto);
            $stmt->bindParam(":id_cliente", $this->id_cliente);
            $stmt->bindParam(":data", $this->data);
            $stmt->bindParam(":preco", $this->preco);
            $stmt->bindParam(":quantidade", $this->quantidade);
            $stmt->bindParam(":status", $this->status);
            $ok = $stmt->execute();
        }
        if($ok){
            $this->id_pedido = $this->pdo->lastInsertId();
        }
        return $stmt->execute();
    }

    public function selecionar(){
        $stmt = $this->pdo->prepare("SELECT * FROM pedido WHERE id_pedido = :id_pedido");
        $stmt->execute([':id_pedido' => $this->id_pedido]);
        return $stmt->fetchAll();
    }

    public function listar(){
        $stmt = $this->pdo->prepare("SELECT * FROM pedido");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function excluir(){
        if(!$this->id_pedido) return false;
        $stmt = $this->pdo->prepare("DELETE FROM pedido WHERE id_pedido = :id_pedido");
        return $stmt->execute([':id_pedido' => $this->id_pedido]);
    }
}