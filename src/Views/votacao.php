<?php include_once __DIR__ . '/templates/header.php'; ?>

<h2>Votação</h2>

<?php
if (isset($mensagem)) {
    echo "<p class='mensagem " . ($status ?? 'sucesso') . "'>" . htmlspecialchars($mensagem) . "</p>";
}
?>

<?php if (!isset($_POST['matricula_aluno']) || isset($erro_matricula)): ?>
    <p>Para votar, por favor, informe sua matrícula abaixo.</p>
    <form action="index.php?page=votacao" method="POST">
        <div class="form-group">
            <label for="matricula_aluno">Sua Matrícula:</label>
            <input type="text" id="matricula_aluno" name="matricula_aluno" required>
        </div>
        <button type="submit" class="btn">Prosseguir para Votação</button>
    </form>
<?php endif; ?>


<?php if (isset($chapas) && !empty($chapas)): ?>
    <h3>Olá, aluno de matrícula <?= htmlspecialchars($_POST['matricula_aluno']) ?>!</h3>
    <p>Selecione a chapa em que deseja votar:</p>
    <form action="index.php?action=votar" method="POST">
        <input type="hidden" name="matricula_aluno" value="<?= htmlspecialchars($_POST['matricula_aluno']) ?>">
        
        <?php foreach ($chapas as $chapa): ?>
            <div class="form-group">
                <input type="radio" id="chapa_<?= $chapa['id'] ?>" name="chapa_id" value="<?= $chapa['id'] ?>" required>
                <label for="chapa_<?= $chapa['id'] ?>">
                    <strong>Chapa <?= htmlspecialchars($chapa['codigo_chapa']) ?> - <?= htmlspecialchars($chapa['nome_chapa']) ?></strong><br>
                    <small>Líder: <?= htmlspecialchars($chapa['nome_lider']) ?> | Vice-Líder: <?= htmlspecialchars($chapa['nome_vice']) ?></small>
                </label>
            </div>
        <?php endforeach; ?>
        
        <button type="submit" class="btn">Confirmar Voto</button>
    </form>
<?php endif; ?>

<?php include_once __DIR__ . '/templates/footer.php'; ?>