<?php
require_once '../conexao.php';
$pdo = getConexao();

if (isset($_GET['id_setor'])){
    extract($_GET);
    $acao = "../update/update_setor.php?id_setor=$id_setor";
    $titulo = "Digite os dados que deseja atualizar";
    try {
        $sql = "SELECT * FROM setor 
                WHERE id_setor = :id_setor";
        $stmt = $pdo->prepare($sql);

        $stmt->execute(
            [':id_setor' => $id_setor]
        );

        $resultado = $stmt->fetchAll();
        $setor = $resultado[0]; 
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}else{
    $acao = '../insert/insert_setor.php';
    $titulo = "Digite os dados";
    $setor = [ 'nome' => '', 'descricao' => '' ];
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
            <label> Nome <input type="text" name="nome" value="<?= $setor['nome'] ?>"> </label>
            <label> Descrição <input type="text" name="descricao" value="<?= $setor['descricao'] ?>"> </label>
            <button type="submit">Salvar</button>
        </form>

        <table border>
        <tr>
            <td>id_setor</td>
            <td>nome</td>
            <td>descricao</td>
        </tr>
    <?php 
        $sql = "SELECT * FROM setor ORDER BY id_setor DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $setores = $stmt->fetchAll();
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