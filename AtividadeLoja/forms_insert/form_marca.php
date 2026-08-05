<?php
require_once '../conexao.php';
$pdo = getConexao();

if (isset($_GET['id_marca'])){
    extract($_GET);
    $acao = "../update/update_marca.php?id_marca=$id_marca";
    $titulo = "Digite os dados que deseja atualizar";
    try {
        $sql = "SELECT * FROM marcas 
                WHERE id_marca = :id_marca";
        $stmt = $pdo->prepare($sql);

        $stmt->execute(
            [':id_marca' => $id_marca]
        );

        $resultado = $stmt->fetchAll();
        $marca = $resultado[0]; 
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}else{
    $acao = '../insert/insert_marca.php';
    $titulo = "Digite os dados";
    $marca = [ 'nome' => '', 'pais' => '' ];
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
        <h1>Digite os dados da Marca</h1>
        <form action="<?= $acao ?>" method="post" enctype="multipart/form-data">
            <label> Nome <input type="text" name="nome" value="<?= $marca['nome'] ?>"> </label>
            <label> País <input type="text" name="pais" value="<?= $marca['pais'] ?>"> </label>
            <button type="submit">Salvar</button>
        </form>

        <table border>
        <tr>
            <td>id_marca</td>
            <td>nome</td>
            <td>pais</td>
        </tr>
    <?php 
        $sql = "SELECT * FROM marcas ORDER BY id_marca DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $marcas = $stmt->fetchAll();
        foreach($marcas as $m):
        ?>
        <tr>
            <td>
                <?= $m['id_marca'] ?>
            </td>
            <td>
                <?= $m['nome'] ?>
            </td>
            <td>
                <?= $m['pais'] ?>
            </td>
            <td>
                <a href="../delete/deletar.php?nome_tabela=marcas&id=<?= $m['id_marca'] ?>">[X]</a>
                <a href="form_marca.php?id_marca=<?= $m['id_marca'] ?>">Editar</a>   
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    </main>
</body>
</html>