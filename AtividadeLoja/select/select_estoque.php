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
    <h1>Estoque</h1>
    <table border>
        <tr>
            <td>id_estoque</td>
            <td>id_produto</td>
            <td>quantidade</td>
            <td>pavilhao</td>
        </tr>
    <?php 
        $sql = "SELECT * FROM estoque ORDER BY id_estoque DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $estoques = $stmt->fetchAll();
        foreach($estoques as $estoque):
        ?>
        <tr>
            <td>
                <?= $estoque['id_estoque'] ?>
            </td>
            <td>
                <?= $estoque['id_produto'] ?>
            </td>
            <td>
                <?= $estoque['quantidade'] ?>
            </td>
            <td>
                <?= $estoque['pavilhao'] ?>
            </td>
            <td>
                <a href="../delete/deletar.php?nome_tabela=estoque&id=<?= $estoque['id_estoque'] ?>">[X]</a>
                <a href="../forms_insert/form_estoque.php?id_estoque=<?= $estoque['id_estoque'] ?>">Editar</a>   
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</main>
</body>
</html>