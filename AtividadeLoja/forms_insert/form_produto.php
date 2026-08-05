<?php
    require_once "../conexao.php";
    $pdo = getConexao();
    require_once "../select/select_opcoes.php";
    $marcas = getMarcas($pdo);
    $setores = getSetores($pdo);

    if (isset($_GET['id_produto'])){
        extract($_GET);
        $acao = "../update/update_produto.php?id_produto=$id_produto";
        $titulo = "Digite os dados que deseja atualizar";
        try {
            $sql = "SELECT * FROM produto 
                    WHERE id_produto = :id_produto";
            $stmt = $pdo->prepare($sql);

            $stmt->execute(
                [':id_produto' => $id_produto]
            );

            $resultado = $stmt->fetchAll();
            $produto = $resultado[0]; 
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }else{
        $acao = '../insert/insert_produto.php';
        $titulo = "Digite os dados";
        $produto = [ 'nome' => '', 'id_marca' => '', 'id_setor' => '', 'preco' => '', 'descricao' => '', 'status' => '' ];
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
        <h1>Digite os dados do produto</h1>
        <form action="<?= $acao ?>" method="post" enctype="multipart/form-data">
            <label> Nome <input type="text" name="nome" value="<?= $produto['nome'] ?>"> </label>
            <label> Marca 
                <select name="id_marca" required>
                    <option value="">Selecione a marca</option>
                    <?php foreach ($marcas as $marca): ?>
                        <option value="<?= htmlspecialchars($marca['id_marca']) ?>" <?= $produto['id_marca'] == $marca['id_marca'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($marca['nome']) ?>
                        </option>
                    <?php endforeach; ?>
                </select> 
            </label>
            <label> Setor 
                <select name="id_setor" required>
                    <option value="">Selecione o setor</option>
                    <?php foreach ($setores as $setor): ?>
                        <option value="<?= htmlspecialchars($setor['id_setor']) ?>" <?= $produto['id_setor'] == $setor['id_setor'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($setor['nome']) ?>
                        </option>
                    <?php endforeach; ?>
                </select> 
            </label>
            <label> Preço <input type="text" name="preco" value="<?= $produto['preco'] ?>"> </label>
            <label> Descrição <input type="text" name="descricao" value="<?= $produto['descricao'] ?>"> </label>
            <label> Status <input type="text" name="status" value="<?= isset($produto['status']) ? $produto['status'] : '' ?>"> </label>
            <button type="submit">Salvar</button>
        </form>

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
        foreach($produtos as $p):
        ?>
        <tr>
            <td>
                <?= $p['id_produto'] ?>
            </td>
            <td>
                <?= $p['id_marca'] ?>
            </td>
            <td>
                <?= $p['id_setor'] ?>
            </td>
            <td>
                <?= $p['nome'] ?>
            </td>
            <td>
                <?= $p['preco'] ?>
            </td>
            <td>
                <?= $p['descricao'] ?>
            </td>
            <td>
                <a href="../delete/deletar.php?nome_tabela=produto&id=<?= $p['id_produto'] ?>">[X]</a>
                <a href="form_produto.php?id_produto=<?= $p['id_produto'] ?>">Editar</a>   
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    </main>
</body>
</html>