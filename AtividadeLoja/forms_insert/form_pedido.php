<?php
    require_once "../conexao.php";
    require_once "../select/select_opcoes.php";
    $pdo = getConexao();

    $produtos = getProdutos($pdo);
    $clientes = getClientes($pdo);

    if (isset($_GET['id_pedido'])){
        extract($_GET);
        $acao = "../update/update_pedido.php?id_pedido=$id_pedido";
        $titulo = "Digite os dados que deseja atualizar";
        try {
            $pedido = new Pedido();
            $pedido->setID($id_pedido);
            $pedido->selecionar();
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }else{
        $acao = '../insert/insert_pedido.php';
        $titulo = "Digite os dados";
        $pedido = [ 'id_produto' => '', 'id_cliente' => '', 'data' => '', 'quantidade' => '', 'status' => '', 'preco' => '' ];
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <title><?= $titulo?></title>
</head>
<body>
    <?php require "../pages/header.php"; ?>
    <main>
        <h1>Digite os dados do Pedido</h1>
        <form action="<?= $acao ?>" method="post" enctype="multipart/form-data">
            <label> Produto 
                <select name="id_produto" required>
                    <option value="">Selecione o produto</option>
                    <?php foreach ($produtos as $prod): ?>
                        <option value="<?= htmlspecialchars($prod['id_produto']) ?>" <?= $pedido['id_produto'] == $prod['id_produto'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($prod['id_produto']) ?> - <?= htmlspecialchars($prod['nome']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </label>
            <label> Cliente 
                <select name="id_cliente" required>
                    <option value="">Selecione o cliente</option>
                    <?php foreach ($clientes as $cli): ?>
                        <option value="<?= htmlspecialchars($cli['id_cliente']) ?>" <?= $pedido['id_cliente'] == $cli['id_cliente'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($cli['id_cliente']) ?> - <?= htmlspecialchars($cli['nome']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </label>
            <label> Data <input type="date" name="data" value="<?= $pedido['data'] ?>"> </label>
            <label> Quantidade <input type="number" name="quantidade" value="<?= $pedido['quantidade'] ?>"> </label>
            <label> Status <input type="text" name="status" value="<?= $pedido['status'] ?>"> </label>
            <button type="submit">Salvar</button>
        </form>

        <table border>
        <tr>
            <td>id_pedido</td>
            <td>id_cliente</td>
            <td>id_produto</td>
            <td>quantidade</td>
            <td>preco</td>
            <td>data</td>
            <td>status</td>
        </tr>
    <?php 
        $pedidos = $pedido->listar();
        foreach($pedidos as $p):
        ?>
        <tr>
            <td>
                <?= $p->getID() ?>
            </td>
            <td>
                <?= $p->getIdCliente() ?>
            </td>
            <td>
                <?= $p->getIdProduto() ?>
            </td>
            <td>
                <?= $p->getQuantidade() ?>
            </td>
            <td>
                <?= $p->getPreco() ?>
            </td>
            <td>
                <?= $p->getData() ?>
            </td>
            <td>
                <?= $p->getStatus() ?>
            </td>
            <td>
                <a href="../delete/deletar.php?nome_tabela=pedido&id=<?= $p->getID() ?>">[X]</a>
                <a href="form_pedido.php?id_pedido=<?= $p->getID() ?>">Editar</a>   
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    </main>
</body>
</html>