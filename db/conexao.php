<?php
$host = "caboose.proxy.rlwy.net";
$port = 17350;
$dbname = "railway";
$user = "root";
$password = "eVsPkrwxGDqPAXmJwiCPXpuxCSSEgBHY";

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}






?>

