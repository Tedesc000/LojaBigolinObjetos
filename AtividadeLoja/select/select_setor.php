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
    <h1>Setor</h1>
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
        foreach($setores as $setor):
        ?>
        <tr>
            <td>
                <?= $setor['id_setor'] ?>
            </td>
            <td>
                <?= $setor['nome'] ?>
            </td>
            <td>
                <?= $setor['descricao'] ?>
            </td>
            <td>
                <a href="../delete/deletar.php?nome_tabela=setor&id=<?= $setor['id_setor'] ?>">[X]</a>
                <a href="../forms_insert/form_setor.php?id_setor=<?= $setor['id_setor'] ?>">Editar</a>   
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</main>
</body>
</html>