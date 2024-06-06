<?php
require 'db.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Cadastro de Venda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        a {
            text-decoration: none;
            color: inherit;
            cursor: pointer;
            background-color: transparent;
        }

        a:hover,
        a:active,
        a:focus,
        a:visited {
            text-decoration: none;
            color: inherit;
            cursor: pointer;
            background-color: transparent;

        }

        .form-new-contract {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            flex-wrap: wrap;
            max-height: 320px;
        }

        .form-columns-width label {
            width: 190px;
        }

        .form-columns-width select,
        .form-columns-width input {
            width: 260px;
        }
    </style>
    <script>
        function mostrarCamposNovoCliente() {
            let clienteSelecionado = document.getElementById("cliente").value;
            let camposNovoCliente = document.getElementById("campos_novo_cliente");

            if (clienteSelecionado === "") {
                camposNovoCliente.style.display = "block";
            } else {
                camposNovoCliente.style.display = "none";
            }
        }
    </script>
</head>

<body>
    <nav class="w-auto py-3 px-4 m-3 fw-bold fs-3 bg-success p-2 text-white bg-opacity-75 d-flex flex-row align-items-center gap-5 rounded">
        <a href="index.php"> <i class="bi bi-pencil-square"></i> Novo Cadastro</a>
        <a href="cadastros.php"> <i class="bi bi-card-list"></i> Tabela de Cadastros</a>
    </nav>
    <div class="w-auto py-3 px-4 m-3">
        <h1 class="fw-bold fs-4">Formulário de Cadastro de Venda</h1>
        <form action="processar_venda.php" method="POST" class="mt-4 form-new-contract">
            <div class="form-columns-width">
                <label for="cliente" class="mb-3">Cliente:</label>
                <select name="cliente" id="cliente" onchange="mostrarCamposNovoCliente()" class="p-1 mb-3">
                    <option value="">Novo cliente</option>
                    <?php
                    $sql_clientes = "SELECT CD_CLI, NM_CLI FROM CLIENTE";
                    $stmt_clientes = $pdo->query($sql_clientes);

                    while ($row = $stmt_clientes->fetch(PDO::FETCH_ASSOC)) {
                        $cliente_id = $row['CD_CLI'];
                        $nome_cliente = $row['NM_CLI'];
                        echo "<option value='$cliente_id'>$nome_cliente</option>";
                    }
                    ?>
                </select>
            </div>
            <div id="campos_novo_cliente" style="display: block;" class="w-50 form-new-contract">
                <div class="form-columns-width">
                    <label for="novo_cliente" class="mb-4">Nome do Novo Cliente:</label>
                    <input type="text" name="novo_cliente" id="novo_cliente" class="mb-4">
                </div>
                <div class="form-columns-width">
                    <label for="cpf" class="mb-4">CPF:</label>
                    <input type="text" name="cpf" id="cpf" class="mb-4">
                </div>
                <div class="form-columns-width">
                    <label for="telefone" class="mb-4">Telefone:</label>
                    <input type="text" name="telefone" id="telefone" class="mb-4">
                </div>
                <div class="form-columns-width">
                    <label class="mb-4" for="email">Email:</label>
                    <input class="mb-4" type="email" name="email" id="email">
                </div>
                <div class="form-columns-width">
                    <label class="mb-4" for="cidade">Cidade:</label>
                    <select class="p-1" name="cidade" id="cidade">
                        <option value="">Selecione a cidade</option>
                        <?php
                        $cidades = [
                            ['id' => 1, 'nome' => 'Juiz de Fora'],
                            ['id' => 2, 'nome' => 'Rio de Janeiro'],
                            ['id' => 3, 'nome' => 'São Paulo']
                        ];

                        foreach ($cidades as $cidade) {
                            echo "<option value='{$cidade['id']}'>{$cidade['nome']}</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-columns-width">
                <label class="mb-3" for="valor">Valor do Contrato:</label>
                <input class="mb-3" type="number" name="valor" id="valor" required>
            </div>
            <div class="form-columns-width">
                <label class="mb-3" for="data_assinatura">Data da Assinatura:</label>
                <input class="mb-3 p-1" type="date" name="data_assinatura" id="data_assinatura" required>
            </div>
            <div class="form-columns-width">
                <label class="mb-3" for="data_inicio">Data de Início:</label>
                <input class="mb-3 p-1" type="date" name="data_inicio" id="data_inicio" required>
            </div>
            <div class="form-columns-width">
                <label class="mb-3" for="data_fim">Data de Fim:</label>
                <input class="mb-3 p-1" type="date" name="data_fim" id="data_fim" required>
            </div>
            <div class="form-columns-width">
                <label class="mb-3" for="status">Status:</label>
                <select class="mb-3 p-1" name="status" id="status" required>
                    <option value="A">Ativo</option>
                    <option value="D">Distratado</option>
                </select>
            </div>
        </form>
        <button type="submit" class="btn btn-primary mt-3">Cadastrar Venda</button>
    </div>

    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog mt-5">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-light" id="successModalLabel">Sucesso</h5>
            </div>
            <div class="modal-body rounded-bottom bg-white">
                Venda cadastrada com sucesso!
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <?php if (isset($_GET['success']) && $_GET['success'] == 1) : ?>
        <script>
            $(document).ready(function() {
                $('#successModal').modal('show');
                setTimeout(function() {
                    $('#successModal').modal('hide');
                    let url = new URL(window.location);
                    url.searchParams.delete('success');
                    window.history.replaceState({}, document.title, url.pathname);
                }, 2000);
            });
        </script>
    <?php endif;
    header("Location: index.php");
    exit();
    ?>
</body>

</html>