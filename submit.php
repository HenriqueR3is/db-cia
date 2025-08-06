<?php
session_start();
require 'db/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $report_time = $_POST['report_time'];
    $status = $_POST['status'];
    $farm = $_POST['farm'];
    $equipment = $_POST['equipment'];
    $hectares = $_POST['hectares'] ?? 0;
    $reason = $_POST['reason'] ?? null;

    // Busca os IDs corretos
    $unidade_id = $pdo->query("SELECT id FROM unidades WHERE nome = '$farm'")->fetch_assoc()['id'];
    $frente_id = $pdo->query("SELECT id FROM frentes WHERE unidade_id = $unidade_id LIMIT 1")->fetch_assoc()['id'];
    $equipamento_id = $pdo->query("SELECT id FROM equipamentos WHERE nome = '$equipment'")->fetch_assoc()['id'];
    $implemento_id = 1; // Você pode adicionar um campo no form para escolher implemento

    $stmt = $pdo->prepare("INSERT INTO producoes (desc_operacao, unidade_id, frente_id, equipamento_id, implemento_id, producao, data_hora) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $operacao = ($status === 'parado') ? 'vinhaca_localizada' : 'plantio'; // ajuste conforme necessário
    $data_hora = date('Y-m-d') . ' ' . $report_time;
    $stmt->bind_param("siiiids", $operacao, $unidade_id, $frente_id, $equipamento_id, $implemento_id, $hectares, $data_hora);
    $stmt->execute();

    header("Location: dashboard.php");
    exit();
}
