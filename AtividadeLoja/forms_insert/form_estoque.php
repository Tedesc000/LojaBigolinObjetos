<?php
    require_once "../conexao.php";
    require_once "../select/select_opcoes.php";
    $pdo = getConexao();

    $produtos = getProdutos($pdo);

    if (isset($_GET['id_estoque'])){
        extract($_GET);
        $acao = "../update/update_estoque.php?id_estoque=$id_estoque";
        $titulo = "Digite os dados que deseja atualizar";
        try {
            $sql = "SELECT * FROM estoque 
                    WHERE id_estoque = :id_estoque";
            $stmt = $pdo->prepare($sql);

            $stmt->execute(
                [':id_estoque' => $id_estoque]
            );

            $resultado = $stmt->fetchAll();
            $estoque = $resultado[0]; 
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }else{
        $acao = '../insert/insert_estoque.php';
        $titulo = "Digite os dados";
        $estoque = [ 'id_produto' => '', 'quantidade' => '', 'pavilhao' => '' ];
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
        <h1>Digite os dados do Estoque</h1>
        <form action="<?= $acao ?>" method="post" enctype="multipart/form-data">
            <label> Produto 
                <select name="id_produto" required>
                    <option value="">Selecione o produto</option>
                    <?php foreach ($produtos as $prod): ?>
                        <option value="<?= htmlspecialchars($prod['id_produto']) ?>" <?= $estoque['id_produto'] == $prod['id_produto'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($prod['id_produto']) ?> - <?= htmlspecialchars($prod['nome']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </label>
            <label> Quantidade <input type="number" name="quantidade" value="<?= $estoque['quantidade'] ?>"> </label>
            <label> Pavilhão <input type="text" name="pavilhao" value="<?= $estoque['pavilhao'] ?>"> </label>
            <button type="submit">Salvar</button>
        </form>

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
        foreach($estoques as $e):
        ?>
        <tr>
            <td>
                <?= $e['id_estoque'] ?>
            </td>
            <td>
                <?= $e['id_produto'] ?>
            </td>
            <td>
                <?= $e['quantidade'] ?>
            </td>
            <td>
                <?= $e['pavilhao'] ?>
            </td>
            <td>
                <a href="../delete/deletar.php?nome_tabela=estoque&id=<?= $e['id_estoque'] ?>">[X]</a>
                <a href="form_estoque.php?id_estoque=<?= $e['id_estoque'] ?>">Editar</a>   
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    </main>
</body>
</html>