<h2>CPD <?= $cpd->numero_serial ?></h2>

<!-- Nav tabs -->
<ul class="nav nav-tabs">
    <li><a href="/admin/cpd/<?= $cpd->id ?>">Monitoração</a></li>
    <li class="active"><a href="/admin/cpd/<?= $cpd->id ?>/relatorio">Relatório</a></li>
</ul>

<?php if (count($cpd->leituras) > 0): ?>

    <table class="table">
        <tr>
            <th>Data/Horário</th>
            <th>Temperatura</th>
            <th>Humidade</th>
        </tr>
        <?php foreach ($cpd->leituras as $leitura): ?>
            <tr>
                <td><?= date('d/m/Y h:i:s', $leitura->data) ?></td>
                <td><?= $leitura->temperatura ?> C</td>
                <td><?= $leitura->humidade ?> </td>
            </tr>
        <?php endforeach ?>
    </table>

<?php else: ?>
    <h4>Não há leituras para esse CPD!</h4>

<?php endif; ?>
