<?php
require_once '../../classes/cliente.php';
if (isset($_GET['id_cliente'])){
    extract($_GET);
    $acao = "../update/update_cliente.php?id_cliente=$id_cliente";
    $titulo = "Digite os dados que deseja atualizar";
    try {
        // $sql = "SELECT * FROM cliente 
        //         WHERE id_cliente = :id_cliente";
        // $stmt = $pdo->prepare($sql);

        // $stmt->execute(
        //     [':id_cliente' => $id_cliente]
        // );

        // //Linha mágica
        // $resultado = $stmt->fetchAll();
        // $cliente = $resultado[0]; 
        $cliente = new Cliente();
        $cliente->setID($id_cliente);
        $resultado = $cliente->selecionar();
        if (!empty($resultado)) {
            $cliente = $resultado[0];
        }
    } catch (PDOException $e) {
        // Caso dê algum erro na conexão ou na query
        echo "Erro: " . $e->getMessage();
    }
}else{
    //inserir
    $acao = '../insert/insert_cliente.php';
    $titulo = "Digite os dados";
    $cliente = [ 'nome' => '', 'cpf' => '', 'telefone' => '', 'email' => '' ];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <title><?= $titulo?></title>
</head>

<body>
    <?php require "../pages/header.php"; ?>
    <main>
        <h1>Digite os dados do cliente</h1>
        <form action="<?= $acao ?>" method="post" enctype="multipart/form-data">

            <label> Nome <input type="text" name="nome" value="<?= $cliente['nome'] ?>"> </label>
            <label> CPF <input type="text" name="cpf" value="<?= $cliente['cpf'] ?>"> </label>
            <label> Telefone <input type="text" name="telefone" value="<?= $cliente['telefone'] ?>"> </label>
            <label> Email <input type="email" name="email" value="<?= $cliente['email'] ?>"> </label>

            <button type="submit">Salvar</button>
        </form>

        <table border>
        <tr>
            <td>id_cliente</td>
            <td>nome</td>
            <td>cpf</td>
            <td>telefone</td>
            <td>email</td>
        </tr>
    <?php 
        $objCliente = new Cliente();
        $clientes = $objCliente->listar();
        foreach($clientes as $c):
        ?>
        <tr>
            <td>
                <?= $c['id_cliente'] ?>
            </td>
            <td>
                <?= $c['nome'] ?>
            </td>
            <td>
                <?= $c['cpf'] ?>
            </td>
            <td>
                <?= $c['telefone'] ?>
            </td>
            <td>
                <?= $c['email'] ?>
            </td>
            <td>
                <a href="../delete/deletar.php?nome_tabela=cliente&id=<?= $c['id_cliente'] ?>">[X]</a>
                <a href="form_cliente.php?id_cliente=<?= $c['id_cliente'] ?>">Editar</a>   
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    </main>
</body>

</html>