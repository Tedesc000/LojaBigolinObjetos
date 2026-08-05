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
    <h1>Produto</h1>
    <table border>
        <tr>
            <td>id_produto</td>
            <td>id_marca</td>
            <td>id_setor</td>
            <td>nome</td>
            <td>preco</td>
            <td>descricao</td>
        </tr>
    <?php 
        $sql = "SELECT * FROM produto ORDER BY id_produto DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $produtos = $stmt->fetchAll();
        foreach($produtos as $produto):
        ?>
        <tr>
            <td>
                <?= $produto['id_produto'] ?>
            </td>
            <td>
                <?= $produto['id_marca'] ?>
            </td>
            <td>
                <?= $produto['id_setor'] ?>
            </td>
            <td>
                <?=  $produto['nome'] ?>
            </td>
            <td>
                <?= $produto['preco'] ?>
            </td>
            <td>
                <?= $produto['descricao'] ?>
            </td>
            <td>
                <a href="../delete/deletar.php?nome_tabela=produto&id=<?= $produto['id_produto'] ?>">[X]</a>
                <a href="../forms_insert/form_produto.php?id_produto=<?= $produto['id_produto'] ?>">Editar</a>   
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</main>
</body>
</html>