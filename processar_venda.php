<?php
require 'db.php';

$cliente_id = $_POST['cliente'];
$novo_cliente = $_POST['novo_cliente'];
$cpf = $_POST['cpf'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$cidade = $_POST['cidade'];
$valor = $_POST['valor'];
$data_assinatura = $_POST['data_assinatura'];
$data_inicio = $_POST['data_inicio'];
$data_fim = $_POST['data_fim'];
$dc_status = $_POST['status'];

if (empty($cliente_id)) {
    $sql_cliente = "INSERT INTO CLIENTE (NM_CLI, DC_CPF, DC_TEL, DC_EMAIL, CD_MUNI, DT_RGST) 
                    VALUES (:nome, :cpf, :telefone, :email, :cidade, NOW())";
    $stmt_cliente = $pdo->prepare($sql_cliente);
    $stmt_cliente->bindParam(':nome', $novo_cliente);
    $stmt_cliente->bindParam(':cpf', $cpf);
    $stmt_cliente->bindParam(':telefone', $telefone);
    $stmt_cliente->bindParam(':email', $email);
    $stmt_cliente->bindParam(':cidade', $cidade);
    $stmt_cliente->execute();

    $cliente_id = $pdo->lastInsertId();
}

$sql_contrato = "INSERT INTO CONTRATO (VL_CTO, DT_ASS, DT_INI, DT_FIM, DC_STATUS, DT_RGST) 
                     VALUES (:valor, :data_assinatura, :data_inicio, :data_fim, :dc_status, NOW())";
$stmt_contrato = $pdo->prepare($sql_contrato);
$stmt_contrato->bindParam(':valor', $valor);
$stmt_contrato->bindParam(':data_assinatura', $data_assinatura);
$stmt_contrato->bindParam(':data_inicio', $data_inicio);
$stmt_contrato->bindParam(':data_fim', $data_fim);
$stmt_contrato->bindParam(':dc_status', $dc_status);
$stmt_contrato->execute();

$contrato_id = $pdo->lastInsertId();

$sql_assc_contrato_cliente = "INSERT INTO ASSC_CONTRATO_CLIENTE (CD_CTO, CD_CLI, DT_RGST) 
                                   VALUES (:contrato_id, :cliente_id, NOW())";
$stmt_assc_contrato_cliente = $pdo->prepare($sql_assc_contrato_cliente);
$stmt_assc_contrato_cliente->bindParam(':contrato_id', $contrato_id);
$stmt_assc_contrato_cliente->bindParam(':cliente_id', $cliente_id);
$stmt_assc_contrato_cliente->execute();

header("Location: index.php?success=1");
exit();
