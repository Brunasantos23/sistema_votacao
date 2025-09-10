<?php include_once __DIR__ . '/templates/header.php'; ?>

<h2>Chapas Cadastradas</h2>

<?php

if (isset($_SESSION['mensagem'])) {
    echo "<p class='mensagem sucesso'>" . htmlspecialchars($_SESSION['mensagem']) . "</p>";
    unset($_SESSION['mensagem']); 
}
?>


<?php if (empty($chapas)): ?>
    <p>Nenhuma chapa cadastrada até o momento.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Código da Chapa</th>
                <th>Nome da Chapa</th>
                <th>Nome do Líder</th>
                <th>Matrícula do Líder</th>
                <th>Nome do Vice-Líder</th>
                <th>Matrícula do Vice-Líder</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($chapas as $chapa): ?>
            <tr>
                <td><?= htmlspecialchars($chapa['codigo_chapa']) ?></td>
                <td><?= htmlspecialchars($chapa['nome_chapa']) ?></td>
                <td><?= htmlspecialchars($chapa['nome_lider']) ?></td>
                <td><?= htmlspecialchars($chapa['matricula_lider']) ?></td>
                <td><?= htmlspecialchars($chapa['nome_vice']) ?></td>
                <td><?= htmlspecialchars($chapa['matricula_vice']) ?></td>
                <td>
                    <a href="index.php?page=editar_chapa&id=<?= $chapa['id'] ?>">Editar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php include_once __DIR__ . '/templates/footer.php'; ?>