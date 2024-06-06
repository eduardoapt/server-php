<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exibição de Dados do Formulário de Cadastro de Venda</title>
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

        .table-font-size {
            font-size: 13px;
        }
    </style>
</head>

<body>
    <nav class="w-auto py-3 px-4 m-3 fw-bold fs-3 bg-success p-2 text-white bg-opacity-75 d-flex flex-row align-items-center gap-5 rounded">
        <a href="index.php"> <i class="bi bi-pencil-square"></i> Novo Cadastro</a>
        <a href="cadastros.php"> <i class="bi bi-card-list"></i> Tabela de Cadastros</a>
    </nav>
    <div class="w-auto py-3 px-4 m-3">
        <h1 class="fw-bold fs-4">Dados Cadastrados no Formulário de Cadastro de Venda</h1>
        <form action="cadastros.php" method="GET" class="mt-3 d-flex flex-row align-items-center justify-content-end">
            <label class="me-1 h-100" for="data_inicio">Data de Início:</label>
            <input class="me-3 h-100 py-1 px-2" type="date" id="data_inicio" name="data_inicio" value="<?php echo isset($_GET['data_inicio']) ? $_GET['data_inicio'] : ''; ?>">
            <label class="me-1 h-100" for="data_fim">Data de Fim:</label>
            <input class="me-3 h-100 py-1 px-2" type="date" id="data_fim" name="data_fim" value="<?php echo isset($_GET['data_fim']) ? $_GET['data_fim'] : ''; ?>">

            <button type="submit" class="btn btn-primary">Filtrar</button>
        </form>
        <table class="mt-4 table table-striped">
            <thead>
                <tr class="fw-bold table-font-size bg-secondary bg-opacity-75">
                    <th>Código do Cliente</th>
                    <th>Nome do Cliente</th>
                    <th>CPF</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th>Código do Contrato</th>
                    <th>Valor do Contrato</th>
                    <th>Data de Assinatura</th>
                    <th>Data de Início</th>
                    <th>Data de Fim</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require 'db.php';

                $dataInicio = '';
                $dataFim = '';

                if (isset($_GET['data_inicio']) && strlen($_GET['data_inicio']) > 0)  $dataInicio = " AND DT_INI >= '" . $_GET['data_inicio'] . "'";
                if (isset($_GET['data_fim'])  && strlen($_GET['data_fim']) > 0) $dataFim = " AND DT_FIM <= '" . $_GET['data_fim'] . "'";

                $sql = "SELECT * FROM ConsultaClienteContrato WHERE 1=1" . $dataInicio . $dataFim;
                $stmt = $pdo->prepare($sql);
                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr class='table-font-size'>";
                    echo "<td style='min-width: 45px;' class='text-center'>{$row['CD_CLI']}</td>";
                    echo "<td style='min-width: 150px;'>{$row['NM_CLI']}</td>";
                    echo "<td style='min-width: 90px;' >{$row['DC_CPF']}</td>";
                    echo "<td style='min-width: 90px;' >{$row['DC_TEL']}</td>";
                    echo "<td style='min-width: 150px;'>{$row['DC_EMAIL']}</td>";
                    echo "<td style='min-width: 45px;' class='text-center'>{$row['CD_CTO']}</td>";
                    echo "<td style='min-width: 90px;'>{$row['VL_CTO']}</td>";
                    echo "<td style='min-width: 90px;'>{$row['DT_ASS']}</td>";
                    echo "<td style='min-width: 90px;'>{$row['DT_INI']}</td>";
                    echo "<td style='min-width: 90px;'>{$row['DT_FIM']}</td>";
                    echo "<td style='min-width: 45px;' class='text-center'>{$row['DC_STATUS']}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src=" https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>

</html>