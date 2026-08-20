<?php
require_once '../classes/setor.php';

if (isset($_GET['id_setor'])){
    extract($_GET);
    $acao = "../update/update_setor.php?id_setor=$id_setor";
    $titulo = "Digite os dados que deseja atualizar";
    try {
        $setor = new Setor();
        $setor->setID($id_setor);
        $resultado = $setor->selecionar();
        if (!empty($resultado)) {
            $setor->setNome($resultado[0]['nome']);
            $setor->setDescricao($resultado[0]['descricao']);
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}else{
    $acao = '../insert/insert_setor.php';
    $titulo = "Digite os dados";
    $setor = new Setor();
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
        <h1>Digite os dados do Setor</h1>
        <form action="<?= $acao ?>" method="post" enctype="multipart/form-data">
            <label> Nome <input type="text" name="nome" value="<?= $setor->getNome() ?>"> </label>
            <label> Descrição <input type="text" name="descricao" value="<?= $setor->getDescricao() ?>"> </label>
            <button type="submit">Salvar</button>
        </form>

        <table border>
        <tr>
            <td>id_setor</td>
            <td>nome</td>
            <td>descricao</td>
        </tr>
    <?php 
        $setores = $setor->listar();
        foreach($setores as $s):
        ?>
        <tr>
            <td>
                <?= $s['id_setor'] ?>
            </td>
            <td>
                <?= $s['nome'] ?>
            </td>
            <td>
                <?= $s['descricao'] ?>
            </td>
            <td>
                <a href="../delete/deletar.php?nome_tabela=setor&id=<?= $s['id_setor'] ?>">[X]</a>
                <a href="form_setor.php?id_setor=<?= $s['id_setor'] ?>">Editar</a>   
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    </main>
</body>
</html>