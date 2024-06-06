<?php
require 'db.php';

$sql = 'SELECT NM_CLI FROM CLIENTE LIMIT 1';
$stmt = $pdo->query($sql);

if ($stmt->rowCount() > 0) {
    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
    $nomeCliente = $cliente['NM_CLI'];
    echo "<h1>$nomeCliente</h1>";
} else {
    echo "Sem cliente cadastrado";
}
