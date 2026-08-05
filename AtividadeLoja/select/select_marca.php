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
    <h1>Marca</h1>
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
        foreach($marcas as $marca):
        ?>
        <tr>
            <td>
                <?= $marca['id_marca'] ?>
            </td>
            <td>
                <?= $marca['nome'] ?>
            </td>
            <td>
                <?= $marca['pais'] ?>
            </td>
            <td>
                <a href="../delete/deletar.php?nome_tabela=marcas&id=<?= $marca['id_marca'] ?>">[X]</a>
                <a href="../forms_insert/form_marca.php?id_marca=<?= $marca['id_marca'] ?>">Editar</a>   
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</main>
</body>
</html>