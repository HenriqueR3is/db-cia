<?php
session_start();
require_once __DIR__ . '/../../../config/db/conexao.php';

if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'admin') {
    header("Location: /app/views/login.php");
    exit();
}

require_once __DIR__ . '/../../../app/includes/header.php';

try {
    $stmt = $pdo->query("SELECT id, nome, localizacao FROM fazendas ORDER BY id DESC");
    $fazendas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao buscar fazendas: " . $e->getMessage());
}
?>

<link rel="stylesheet" href="/public/static/css/style.css">

<div class="container">
    <div class="flex-between">
        <h2>Controle de Fazendas / Unidades</h2>
        <div>
            <button class="btn btn-primary" onclick="abrirModal('modalAdicionar')">+ Adicionar Fazenda</button>
            <button class="btn btn-success" onclick="abrirModal('modalImportar')">📂 Importar TXT</button>
        </div>
    </div>

    <div class="card">
        <div class="card-body table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Localização</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($fazendas) > 0): ?>
                        <?php foreach ($fazendas as $f): ?>
                            <tr>
                                <td><?= htmlspecialchars($f['id']) ?></td>
                                <td><?= htmlspecialchars($f['nome']) ?></td>
                                <td><?= htmlspecialchars($f['localizacao']) ?></td>
                                <td>
                                    <button class="btn btn-success btn-sm" onclick="editarFazenda(<?= $f['id'] ?>)">Editar</button>
                                    <button class="btn btn-danger btn-sm" onclick="confirmarExclusao(<?= $f['id'] ?>)">Excluir</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="4">Nenhuma fazenda cadastrada.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Adicionar -->
<div class="modal" id="modalAdicionar">
    <div class="modal-content">
        <div class="modal-header">Adicionar Fazenda</div>
        <form action="salvar_fazenda.php" method="POST">
            <label>Nome:</label>
            <input type="text" name="nome" required class="form-input">

            <label>Localização:</label>
            <input type="text" name="localizacao" required class="form-input">

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="fecharModal('modalAdicionar')">Cancelar</button>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Importar TXT -->
<div class="modal" id="modalImportar">
    <div class="modal-content">
        <div class="modal-header">Importar Fazendas via TXT</div>
        <form action="importar_fazendas.php" method="POST" enctype="multipart/form-data">
            <label>Selecione o arquivo (.txt):</label>
            <input type="file" name="arquivo" accept=".txt" required class="form-input">

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="fecharModal('modalImportar')">Cancelar</button>
                <button type="submit" class="btn btn-success">Importar</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Confirma Exclusão -->
<div class="modal" id="modalExcluir">
    <div class="modal-content">
        <div class="modal-header">Confirmar Exclusão</div>
        <p>Tem certeza que deseja excluir esta fazenda?</p>
        <form action="excluir_fazenda.php" method="POST">
            <input type="hidden" name="id" id="excluirId">
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="fecharModal('modalExcluir')">Cancelar</button>
                <button type="submit" class="btn btn-danger">Excluir</button>
            </div>
        </form>
    </div>
</div>

<script>
function abrirModal(id) {
    document.getElementById(id).classList.add('active');
}
function fecharModal(id) {
    document.getElementById(id).classList.remove('active');
}
function confirmarExclusao(id) {
    document.getElementById('excluirId').value = id;
    abrirModal('modalExcluir');
}
function editarFazenda(id) {
    window.location.href = "editar_fazenda.php?id=" + id;
}
</script>

<?php require_once __DIR__ . '/../../../app/includes/footer.php'; ?>
