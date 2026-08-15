<?php
require_once 'conexao.php';
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
        $cliente->setID($_GET[$id_cliente]);
        $cliente->selecionar();
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

            <label> Nome <input type="text" name="nome" value="<?= $cliente->getNome() ?>"> </label>
            <label> CPF <input type="text" name="cpf" value="<?= $cliente->getCpf() ?>"> </label>
            <label> Telefone <input type="text" name="telefone" value="<?= $cliente->getTelefone() ?>"> </label>
            <label> Email <input type="email" name="email" value="<?= $cliente->getEmail() ?>"> </label>

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
        $cliente->listar();
        foreach($clientes as $cliente):
        ?>
        <tr>
            <td>
                <?= $cliente->getID() ?>
            </td>
            <td>
                <?= $cliente->getNome() ?>
            </td>
            <td>
                <?= $cliente->getCpf() ?>
            </td>
            <td>
                <?= $cliente->getTelefone() ?>
            </td>
            <td>
                <?= $cliente->getEmail() ?>
            </td>
            <td>
                <a href="../delete/deletar.php?nome_tabela=cliente&id=<?= $cliente->getID() ?>">[X]</a>
                <a href="form_cliente.php?id_cliente=<?= $cliente->getID() ?>">Editar</a>   
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    </main>
</body>

</html>