<?php include_once __DIR__ . '/templates/header.php'; ?>

<h2>Cadastro de Chapa</h2>

<?php
// Exibe mensagens de sucesso ou erro, se houver
if (isset($mensagem)) {
    echo "<p class='mensagem " . ($status ?? 'sucesso') . "'>" . htmlspecialchars($mensagem) . "</p>";
}
?>

<form action="index.php?action=cadastrar_chapa" method="POST">
    <div class="form-group">
        <label for="nome_chapa">Nome da Chapa:</label>
        <input type="text" id="nome_chapa" name="nome_chapa" required>
    </div>
    <div class="form-group">
        <label for="codigo_chapa">Código da Chapa (Ex: 01, 02):</label>
        <input type="text" id="codigo_chapa" name="codigo_chapa" required>
    </div>
    <hr>
    <h4>Dados do Líder</h4>
    <div class="form-group">
        <label for="nome_lider">Nome do Líder:</label>
        <input type="text" id="nome_lider" name="nome_lider" required>
    </div>
    <div class="form-group">
        <label for="matricula_lider">Matrícula do Líder:</label>
        <input type="text" id="matricula_lider" name="matricula_lider" required>
    </div>
    <hr>
    <h4>Dados do Vice-Líder</h4>
    <div class="form-group">
        <label for="nome_vice">Nome do Vice-Líder:</label>
        <input type="text" id="nome_vice" name="nome_vice" required>
    </div>
    <div class="form-group">
        <label for="matricula_vice">Matrícula do Vice-Líder:</label>
        <input type="text" id="matricula_vice" name="matricula_vice" required>
    </div>
    <button type="submit" class="btn">Cadastrar Chapa</button>
</form>

<?php include_once __DIR__ . '/templates/footer.php'; ?>