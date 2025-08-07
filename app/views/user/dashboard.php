
<?php
session_start();
require_once __DIR__ . '/../../../config/db/conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$equipamentos = $pdo->query("SELECT nome FROM equipamentos")->fetchAll(PDO::FETCH_ASSOC);
$unidades = $pdo->query("SELECT nome FROM unidades")->fetchAll(PDO::FETCH_ASSOC);

$report_hours = ['06:00', '12:00', '18:00'];
$farm_list = array_column($unidades, 'nome');
$equipment_list = array_column($equipamentos, 'nome');

$username = $_SESSION['usuario_nome'];
$user_role = $_SESSION['usuario_tipo'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - <?php echo $user_role; ?></title>
    <link rel="stylesheet" href="/public/static/css/styleLogin.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<body class="dashboard-body">
    <header class="main-header">
        <div class="header-content">
            <div class="logo">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M17.59 13.41a6 6 0 0 0-8.49-8.49L3 11v8h8l6.59-6.59zM19 12l-7-7l-2 2l7 7l2-2z"/></svg>
                <span>Agro-Dash</span>
            </div>
            <div class="user-info">
                <span>Olá, <strong><?php echo $username; ?></strong>! (<?php echo $user_role; ?>)</span>
                <a href="/app/views/login.php" class="logout-btn">Sair</a>
            </div>
        </div>
    </header>

    <main class="container">
        <section class="grid-container">
            <div class="card metric-card">
                <h3>Progresso Diário</h3>
                <div class="progress-chart">
                    <canvas id="dailyProgressChart"></canvas>
                    <div class="progress-text" id="dailyProgressText">0%</div>
                </div>
                <p><span id="dailyHectares">0</span> ha de <span id="dailyGoal">0</span> ha</p>
                <p><strong>Apontamentos hoje:</strong> <span id="dailyEntries">0</span></p>
            </div>
            <div class="card metric-card">
                <h3>Progresso Mensal</h3>
                <div class="progress-bar-container">
                    <div class="progress-bar" id="monthlyProgressBar"></div>
                </div>
                <p class="progress-bar-label"><span id="monthlyHectares">0</span> ha de <span id="monthlyGoal">0</span> ha (<span id="monthlyProgress">0</span>%)</p>
                <p><strong>Apontamentos no mês:</strong> <span id="monthlyEntries">0</span></p>
            </div>
        </section>

        <section class="grid-container">
            <div class="card form-card">
                <h3>Novo Apontamento</h3>
                <form action="submit.php" method="POST" id="entryForm">
                    <div class="form-row">
                        <div class="input-group">
                            <label for="report_time">Horário</label>
                            <select id="report_time" name="report_time" required>
                                <?php foreach ($report_hours as $hour) echo "<option value='$hour'>$hour</option>"; ?>
                            </select>
                        </div>
                        <div class="input-group">
                            <label for="status">Status</label>
                            <select id="status" name="status" required>
                                <option value="ativo">Ativo</option>
                                <option value="parado">Parado</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="input-group" style="width: 100%;">
                            <label for="farm">Fazenda</label>
                            <select id="farm" name="farm" class="select-search" required>
                                <?php foreach ($farm_list as $farm) echo "<option value='$farm'>$farm</option>"; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="input-group">
                            <label for="equipment">Equipamento</label>
                            <select id="equipment" name="equipment" class="select-search" required>
                                <?php foreach ($equipment_list as $eq) echo "<option value='$eq'>$eq</option>"; ?>
                            </select>
                        </div>
                        <div class="input-group">
                            <label for="hectares">Hectares</label>
                            <input type="number" step="0.01" id="hectares" name="hectares" placeholder="Ex: 15.5">
                        </div>
                    </div>
                    <div id="reason-group" class="input-group" style="display: none;">
                        <label for="reason">Motivo da Parada</label>
                        <textarea id="reason" name="reason" rows="3" placeholder="Descreva o motivo da parada..."></textarea>
                    </div>
                    <button type="submit" class="btn-submit">Salvar Apontamento</button>
                </form>
            </div>

            <div class="card list-card">
                <h3>Últimos Lançamentos</h3>
                <ul id="recent-entries-list"></ul>
            </div>
        </section>
    </main>

    <script>
        $(document).ready(function() {
            $('.select-search').select2({
                placeholder: "Clique ou digite para pesquisar...",
                allowClear: true,
                width: '100%'
            });

            $('#status').on('change', function() {
                if ($(this).val() === 'parado') {
                    $('#reason-group').show();
                } else {
                    $('#reason-group').hide();
                }
            });
        });
    </script>
</body>
</html>
