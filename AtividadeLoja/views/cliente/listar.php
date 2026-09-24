<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Clientes - Loja</title>
</head>
<body>
    <?php require_once __DIR__ . '/../layout/header.php'; ?>
    <main>
        <h1>Clientes</h1>
        <div style="margin: 20px 0; width: 90%; display: flex; justify-content: flex-end;">
            <a href="index.php?modulo=cliente&acao=criar" style="padding: 10px 20px; background-color: lightblue; color: black; text-decoration: none; font-weight: bold; border-radius: 8px;">+ Novo Cliente</a>
        </div>

        <table border="1" style="width: 90%;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="tabelaClientes">
                <tr>
                    <td colspan="6" style="padding: 20px; text-align: center;">Carregando...</td>
                </tr>
            </tbody>
        </table>
    </main>

    <script src="js/cliente.js"></script>
    <script>
        fetch('index.php?modulo=cliente&acao=listarJson')
            .then(response => {
                if (!response.ok) {
                    throw new Error("Erro ao buscar dados");
                }
                return response.json();
            })
            .then(dados => {
                const tbody = document.getElementById('tabelaClientes');
                tbody.innerHTML = '';

                if (dados.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="6" style="padding: 20px; text-align: center;">Nenhum cliente cadastrado ainda.</td></tr>';
                    return;
                }

                dados.forEach(item => {
                    const c = new cliente(item.id_cliente, item.nome, item.cpf, item.telefone, item.email);

                    tbody.innerHTML += `
                        <tr>
                            <td>${c.getId()}</td>
                            <td>${c.getNome()}</td>
                            <td>${c.getCpf()}</td>
                            <td>${c.getTelefone()}</td>
                            <td>${c.getEmail()}</td>
                            <td>
                                <a href="index.php?modulo=cliente&acao=editar&id=${c.getId()}" style="color: blue; text-decoration: none; font-weight: bold; margin-right: 10px;">Editar</a>
                                <a href="index.php?modulo=cliente&acao=excluir&id=${c.getId()}" onclick="return confirm('Deseja realmente excluir este cliente?');" style="color: red; text-decoration: none; font-weight: bold;">Excluir</a>
                            </td>
                        </tr>
                    `;
                });
            })
            .catch(erro => {
                console.error("Erro:", erro);
                document.getElementById('erro').style.display = 'block';
                document.getElementById('erro').innerHTML = erro;
            });
    </script>
</body>
</html>