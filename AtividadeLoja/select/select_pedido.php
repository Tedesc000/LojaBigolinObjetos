<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <title>Exibir Dados</title>
</head>
<body>
    <?php 
    require "../pages/header.php";
    require "../conexao.php";
    $pdo = getConexao();

    ?>
    <main>
    <h1>Pedido</h1>
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
        $sql = "SELECT * FROM pedido ORDER BY id_pedido DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $pedidos = $stmt->fetchAll();
        foreach($pedidos as $pedido):
        ?>
        <tr>
            <td>
                <?= $pedido['id_pedido'] ?>
            </td>
            <td>
                <?= $pedido['id_cliente'] ?>
            </td>
            <td>
                <?= $pedido['id_produto'] ?>
            </td>
            <td>
                <?= $pedido['quantidade'] ?>
            </td>
            <td>
                <?= $pedido['preco'] ?>
            </td>
            <td>
                <?= $pedido['data'] ?>
            </td>
            <td>
                <?= $pedido['status'] ?>
            </td>
            <td>
                <a href="../delete/deletar.php?nome_tabela=pedido&id=<?= $pedido['id_pedido'] ?>">[X]</a>
                <a href="../forms_insert/form_pedido.php?id_pedido=<?= $pedido['id_pedido'] ?>">Editar</a>   
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</main>
</body>
</html>