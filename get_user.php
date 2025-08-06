<?php
require 'db/conexao.php';
header('Content-Type: application/json');

$user_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$user_id) {
    echo json_encode(['error' => 'ID de usuário inválido']);
    exit();
}

try {
    // Obter dados do usuário
    $stmt_user = $pdo->prepare("SELECT id, nome, email, tipo, ativo FROM usuarios WHERE id = :id");
    $stmt_user->execute([':id' => $user_id]);
    $user = $stmt_user->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo json_encode(['error' => 'Usuário não encontrado']);
        exit();
    }

    // Obter permissões de unidades
    $stmt_unidades = $pdo->prepare("SELECT unidade_id FROM usuario_unidade WHERE usuario_id = :id");
    $stmt_unidades->execute([':id' => $user_id]);
    $unidades = $stmt_unidades->fetchAll(PDO::FETCH_COLUMN, 0);

    // Obter permissões de operações
    $stmt_operacoes = $pdo->prepare("SELECT operacao_id FROM usuario_operacao WHERE usuario_id = :id");
    $stmt_operacoes->execute([':id' => $user_id]);
    $operacoes = $stmt_operacoes->fetchAll(PDO::FETCH_COLUMN, 0);

    echo json_encode([
        'user' => $user,
        'unidades' => $unidades,
        'operacoes' => $operacoes
    ]);

} catch (PDOException $e) {
    echo json_encode(['error' => 'Erro no banco de dados: ' . $e->getMessage()]);
}
?>