<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Digite os dados da Marca</h1>
    <form action="../insert/insert_marcas.php" method="post" enctype="multipart/form-data">

        <label> Nome <input type="text" name=":nome"> </label>

        <label> País <input type="text" name=":pais"> </label>

        <button type="submit">Salvar</button>
    </form>
</body>
</html>