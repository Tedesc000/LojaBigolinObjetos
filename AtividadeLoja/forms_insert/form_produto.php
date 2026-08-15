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
            $produto = new Produto();
            $produto->setID($id_produto);
            $produto->selecionar();
            if (!empty($resultado)) {
                $produto->setNome($resultado[0]['nome']);
                $produto->setIdMarca($resultado[0]['id_marca']);
                $produto->setIdSetor($resultado[0]['id_setor']);
                $produto->setPreco($resultado[0]['preco']);
                $produto->setDescricao($resultado[0]['descricao']);
                $produto->setStatus($resultado[0]['status']);
            }
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
        $produtos = $produto->listar();
        foreach($produtos as $p):
        ?>
        <tr>
            <td>
                <?= $p->getID() ?>
            </td>
            <td>
                <?= $p->getIdMarca() ?>
            </td>
            <td>
                <?= $p->getIdSetor() ?>
            </td>
            <td>
                <?= $p->getNome() ?>
            </td>
            <td>
                <?= $p->getPreco() ?>
            </td>
            <td>
                <?= $p->getDescricao() ?>
            </td>
            <td>
                <a href="../delete/deletar.php?nome_tabela=produto&id=<?= $p->getID() ?>">[X]</a>
                <a href="form_produto.php?id_produto=<?= $p->getID() ?>">Editar</a>   
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    </main>
</body>
</html>