<h2>CPD <?= $cpd->numero_serial ?></h2>

<!-- Nav tabs -->
<ul class="nav nav-tabs">
    <li><a href="/painel/cpd/<?= $cpd->id ?>">Monitoração</a></li>
    <li class="active"><a href="/painel/cpd/<?= $cpd->id ?>/relatorio">Relatório</a></li>
    <a href="/painel/cpd/<?= $cpd->id ?>/exportar" class="btn btn-primary" style="float:right">Exportar CSV</a>
</ul>

<div id="chartContainer"></div>

<?php if (count($cpd->leituras) > 0): ?>

    <table class="table">
        <tr>
            <th>Data/Horário</th>
            <th>Temperatura</th>
            <th>Umidade</th>
        </tr>
        <?php foreach ($cpd->leituras()->orderBy('horario', 'desc')->get() as $leitura): ?>
            <tr>
                <td><?= date('d/m/Y h:i:s', strtotime($leitura->horario)) ?></td>
                <td><?= $leitura->temperatura ?> C</td>
                <td><?= $leitura->umidade ?> </td>
            </tr>
        <?php endforeach ?>
    </table>

<?php else: ?>
    <h4>Não há leituras para esse CPD!</h4>

<?php endif; ?>

<script src="/js/canvasjs.min.js"></script>
<script type="text/javascript">
    var dataPoints = <?= $cpd->jsonLeituras() ?>;

    for(i in dataPoints){
        dataPoints[i].x = new Date(dataPoints[i].x);
    }

    window.onload = function () {
        var chart = new CanvasJS.Chart("chartContainer",
                {
                    theme: "theme2",
                    animationEnabled: true,
                    axisY: {
                        includeZero: false
                    },
                    data: [
                        {
                            type: "line",
                            //lineThickness: 3,
                            dataPoints: dataPoints
                        }
                    ]
                });

        chart.render();
    }
</script>
