<?php
$modulosMenu = [
    'cliente' => 'Clientes',
    'produto' => 'Produtos',
    'pedido'  => 'Pedidos',
    'estoque' => 'Estoque',
    'marca'   => 'Marcas',
    'setor'   => 'Setores'
];
$moduloAtual = $_GET['modulo'] ?? '';
?>
<header>
    <ul>
        <li>
            <a href="index.php" style="<?= empty($moduloAtual) ? 'background-color: rgb(112, 164, 182); color: white;' : '' ?>">
                Início
            </a>
        </li>
        <?php foreach ($modulosMenu as $key => $rotulo): ?>
            <li>
                <a href="index.php?modulo=<?= $key ?>&acao=listar" style="<?= $moduloAtual === $key ? 'background-color: rgb(112, 164, 182); color: white;' : '' ?>">
                    <?= $rotulo ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</header>
