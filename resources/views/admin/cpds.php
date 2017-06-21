<div class="row">
    <div class="col-md-10">
        <h2>CPDs</h2>
    </div>

    <div class="col-md-2">
        <a class="btn btn-primary header-button" href="/admin/cpds/novo">Novo CPD</a>
    </div>
</div>

<?php if (isset($sucesso)): ?>
    <div class="alert alert-success"><?= $sucesso ?></div>
<?php endif ?>

<?php if (count($cpds) > 0): ?>
    <table class="table">
        <tr>
            <th>Número Serial</th>
            <th>Cliente</th>
            <th>Data de Instalação</th>
        </tr>
        <?php foreach ($cpds as $cpd): ?>
            <tr>
                <td><?= $cpd->numero_serial ?></td>

                <?php if($cpd->empresa): ?>
                    <td><?=$cpd->empresa->razao_social?></td>
                    <td><?=$cpd->data_instalacao?></td>
                <?php else: ?>
                    <td>Não cadastrado</td>
                    <td>Não cadastrado</td>
                <?php endif ?>
            </tr>
        <?php endforeach ?>
    </table>

<?php else: ?>
    <h4>Não há CPDs cadastrados!</h4>
<?php endif; ?>
