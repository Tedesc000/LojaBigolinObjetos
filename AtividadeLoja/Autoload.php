<?php
function carregar($file, $classe){
    require_once(__DIR__ . "/src/" . $file . $classe . ".php");
}

spl_autoload_register('carregar');
?>