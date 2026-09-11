<?php
require_once "models/cliente.php";
class ClienteController{
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function listar(){
        $cliente = new Cliente($this->db);
        $clientes = $cliente->listar();

        require_once "views/cliente/listar.php";
        }
}