<?php
function getConexao(){
    $dsn = "mysql:host=localhost;dbname=Loja;charset=utf8";
    $usuario = "root";
    $senha = "";

try{
    $pdo = new PDO($dsn, $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
    } catch(PDOException $e){
        echo "Erro: " . $e->getMessage();
    }
}