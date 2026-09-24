<?php
// Autoload geral para carregar classes automaticamente de models e controllers
require_once __DIR__ . '/conexao.php';

spl_autoload_register(function ($classe) {
    // Diretórios onde as classes podem estar
    $diretorios = [
        __DIR__ . '/models/',
        __DIR__ . '/controllers/',
    ];

    // Variações possíveis de nomes de arquivo (ex.: Cliente.php, cliente.php)
    $variacoes = [
        $classe . '.php',
        strtolower($classe) . '.php',
        ucfirst($classe) . '.php',
    ];

    foreach ($diretorios as $dir) {
        foreach ($variacoes as $arquivo) {
            $caminho = $dir . $arquivo;
            if (file_exists($caminho)) {
                require_once $caminho;
                return;
            }
        }
    }
});