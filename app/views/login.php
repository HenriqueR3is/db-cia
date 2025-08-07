<?php
session_start();
require_once __DIR__ . '/../../config/db/conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $senha = $_POST['password'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE nome = ? AND ativo = 1");
        $stmt->execute([$username]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica a senha com password_verify
        if ($usuario && password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['usuario_tipo'] = $usuario['tipo'];

            if ($usuario['tipo'] === 'admin') {
                header("Location: /app/views/admin/admin_dashboard.php");
            } else {
                header("Location: /app/views/user/dashboard.php");
            }
            exit;
        } else {
            $erro = "Usuário ou senha inválidos.";
        }
    } catch (PDOException $e) {
        $erro = "Erro ao processar login: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Acompanhamento Agrícola</title>
    <link rel="stylesheet" href="/public/static/css/styleLogin.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body class="login-body">
    <div class="login-container">
        <div class="login-header">
            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-leaf"><path d="M20.24 12.24a6 6 0 0 0-8.49-8.49L5 10.5V19h8.5z"></path><line x1="16" y1="8" x2="2" y2="22"></line><line x1="17.5" y1="15" x2="9" y2="15"></line></svg>
            <h1>Agro-Acess</h1>
            <p>Acompanhamento de Operações</p>
        </div>
        <form method="POST">
            <div class="input-group">
                <label for="username">Usuário</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" required>
            </div>
            <?php if (isset($erro)): ?>
                <p class='error-message'><?php echo htmlspecialchars($erro); ?></p>
            <?php endif; ?>
            <button type="submit" class="btn-login">Entrar</button>
        </form>
    </div>
</body>
</html>