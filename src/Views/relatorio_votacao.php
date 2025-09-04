<?php include_once __DIR__ . '/templates/header.php'; ?>

<h2>Relatório da Votação</h2>

<?php if ($total_votos == 0): ?>
    <p>Ainda não há votos registrados.</p>
<?php else: ?>
    <p><strong>Total de votos contabilizados: <?= $total_votos ?></strong></p>
    <table>
        <thead>
            <tr>
                <th>Chapa</th>
                <th>Código</th>
                <th>Quantidade de Votos</th>
                <th>Percentual de Representatividade</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($relatorio as $item): ?>
            <tr>
                <td><?= htmlspecialchars($item['nome_chapa']) ?></td>
                <td><?= htmlspecialchars($item['codigo_chapa']) ?></td>
                <td><?= $item['qtd_votos'] ?></td>
                <td>
                    <?php 
                        $percentual = ($item['qtd_votos'] / $total_votos) * 100;
                        echo number_format($percentual, 2, ',', '.') . ' %';
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php include_once __DIR__ . '/templates/footer.php'; ?>