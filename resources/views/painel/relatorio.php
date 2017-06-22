<h2>CPD <?= $cpd->numero_serial ?></h2>

<!-- Nav tabs -->
<ul class="nav nav-tabs">
    <li><a href="/painel/cpd/<?= $cpd->id ?>">Monitoração</a></li>
    <li class="active"><a href="/painel/cpd/<?= $cpd->id ?>/relatorio">Relatório</a></li>
    <a href="/painel/cpd/<?= $cpd->id ?>/exportar" class="btn btn-success nav-button">Exportar CSV</a>
</ul>

<div id="chartContainer"></div>

<?php if (count($cpd->leituras) > 0): ?>

    <table class="table table-striped">
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
    var pontosTemperatura = <?= $cpd->jsonTemperatura() ?>;
    var pontosUmidade = <?= $cpd->jsonUmidade() ?>;

    for(i in pontosTemperatura){
        pontosTemperatura[i].x = new Date(pontosTemperatura[i].x);
    }

    for(i in pontosUmidade){
        pontosUmidade[i].x = new Date(pontosUmidade[i].x);
    }

    window.onload = function () {
        var chart = new CanvasJS.Chart("chartContainer",
                {
                    theme: "theme2",
                    animationEnabled: true,
                    axisY: {
                        includeZero: false
                    },
                    legend:{
                        fontSize: 24
                    },
                    data: [
                        {
                            name: "Temperatura (C)",
                            showInLegend: true,
                            type: "line",
                            color: "red",
                            dataPoints: pontosTemperatura
                        },
                        {
                            name: "Umidade (%)",
                            showInLegend: true,
                            type: "line",
                            color: "blue",
                            dataPoints: pontosUmidade
                        },
                    ]
                });

        chart.render();
    }
</script>
