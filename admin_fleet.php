<?php
session_start();
require 'db/conexao.php';
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'admin') {
    header("Location: login.php");
    exit();
}
require 'includes/header.php';
?>
<h2>Controle de Frota/Fazendas</h2>
<div class="card">
    <p>Aqui você irá gerenciar equipamentos, implementos, fazendas e unidades, com os respectivos modais de adicionar, editar e excluir.</p>
</div>
<?php require 'includes/footer.php'; ?>