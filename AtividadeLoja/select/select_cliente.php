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
    require_once '../classes/cliente.php';

    $cliente = new Cliente();
    $clientes = $cliente->listar();

    ?>
    <main>
    <h1>Cliente</h1>
    <table border>
        <tr>
            <td>id_cliente</td>
            <td>nome</td>
            <td>cpf</td>
            <td>telefone</td>
            <td>email</td>
        </tr>
    <?php 
        
        foreach($clientes as $cliente):
        ?>
        <tr>
            <td>
                <?= $cliente['id_cliente'] ?>
            </td>
            <td>
                <?= $cliente['nome'] ?>
            </td>
            <td>
                <?= $cliente['cpf'] ?>
            </td>
            <td>
                <?= $cliente['telefone'] ?>
            </td>
            <td>
                <?= $cliente['email'] ?>
            </td>
            <td>
                <a href="../delete/deletar.php?nome_tabela=cliente&id=<?= $cliente['id_cliente'] ?>">[X]</a>
                <a href="../forms_insert/form_cliente.php?id_cliente=<?= $cliente['id_cliente'] ?>">Editar</a>   
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</main>
</body>
</html>