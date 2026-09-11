<?php
require_once "models/Pedido.php";
class PedidoController{
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function listar(){
        $pedido = new Pedido($this->db);
        $pedidos = $pedido->listar();

        require_once "views/pedido/listar.php";
        }
}