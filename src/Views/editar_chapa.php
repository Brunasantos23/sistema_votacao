<?php include_once __DIR__ . '/templates/header.php'; ?>

<h2>Editar Chapa</h2>

<?php
// Exibe mensagens de erro, se houver
if (isset($mensagem)) {
    echo "<p class='mensagem erro'>" . htmlspecialchars($mensagem) . "</p>";
}
?>

<?php if (isset($chapa)): ?>
<form action="index.php?action=atualizar_chapa" method="POST">
    <input type="hidden" name="id" value="<?= htmlspecialchars($chapa['id']) ?>">

    <div class="form-group">
        <label for="nome_chapa">Nome da Chapa:</label>
        <input type="text" id="nome_chapa" name="nome_chapa" value="<?= htmlspecialchars($chapa['nome_chapa']) ?>" required>
    </div>
    <div class="form-group">
        <label for="codigo_chapa">Código da Chapa (Ex: 01, 02):</label>
        <input type="text" id="codigo_chapa" name="codigo_chapa" value="<?= htmlspecialchars($chapa['codigo_chapa']) ?>" required>
    </div>
    <hr>
    <h4>Dados do Líder</h4>
    <div class="form-group">
        <label for="nome_lider">Nome do Líder:</label>
        <input type="text" id="nome_lider" name="nome_lider" value="<?= htmlspecialchars($chapa['nome_lider']) ?>" required>
    </div>
    <div class="form-group">
        <label for="matricula_lider">Matrícula do Líder:</label>
        <input type="text" id="matricula_lider" name="matricula_lider" value="<?= htmlspecialchars($chapa['matricula_lider']) ?>" required>
    </div>
    <hr>
    <h4>Dados do Vice-Líder</h4>
    <div class="form-group">
        <label for="nome_vice">Nome do Vice-Líder:</label>
        <input type="text" id="nome_vice" name="nome_vice" value="<?= htmlspecialchars($chapa['nome_vice']) ?>" required>
    </div>
    <div class="form-group">
        <label for="matricula_vice">Matrícula do Vice-Líder:</label>
        <input type="text" id="matricula_vice" name="matricula_vice" value="<?= htmlspecialchars($chapa['matricula_vice']) ?>" required>
    </div>
    <button type="submit" class="btn">Salvar Alterações</button>
</form>
<?php else: ?>
    <p class="mensagem erro">Chapa não encontrada.</p>
<?php endif; ?>

<?php include_once __DIR__ . '/templates/footer.php'; ?>