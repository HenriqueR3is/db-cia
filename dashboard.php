<?php
session_start();
require 'db/conexao.php';

header('Content-Type: application/json');

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['error' => 'Não autorizado']);
    exit();
}

try {
    // Meta diária (pode ser ajustada conforme necessidade)
    $daily_goal = 100;
    
    // Produção diária
    $stmt = $pdo->prepare("SELECT SUM(producao) as total FROM producoes WHERE DATE(data_hora) = CURDATE()");
    $stmt->execute();
    $daily = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $daily_hectares = $daily['total'] ?? 0;
    $daily_percentage = $daily_hectares > 0 ? round(($daily_hectares / $daily_goal) * 100, 2) : 0;
    
    // Últimos apontamentos
    $stmt = $pdo->query("SELECT 
                         p.desc_operacao as operacao, 
                         u.nome as unidade, 
                         p.producao, 
                         TIME(p.data_hora) as hora, 
                         e.nome as equipamento
                         FROM producoes p
                         JOIN unidades u ON p.unidade_id = u.id
                         JOIN equipamentos e ON p.equipamento_id = e.id
                         ORDER BY p.data_hora DESC LIMIT 5");
    $entries = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'daily' => [
            'hectares' => $daily_hectares,
            'percentage' => $daily_percentage,
            'goal' => $daily_goal
        ],
        'entries' => $entries
    ]);
    
} catch (PDOException $e) {
    echo json_encode(['error' => 'Erro no banco de dados: ' . $e->getMessage()]);
}