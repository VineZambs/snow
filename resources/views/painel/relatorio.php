<?php
    if($filtrarFalhas){
        $leituras = $cpd->leituras()
                ->where('temperatura', '>', $cpd->temperatura_max)
                ->orWhere('temperatura', '<', $cpd->temperatura_min)
                ->orWhere('umidade', '>', $cpd->umidade_max)
                ->orWhere('umidade', '<', $cpd->umidade_min)
                ->orderBy('horario', 'desc')
                ->get();
    }else{
        $leituras = $cpd->leituras()->orderBy('horario', 'desc')->get();
    }

    
?>

<h2>CPD <?= $cpd->numero_serial ?></h2>

<!-- Nav tabs -->
<ul class="nav nav-tabs">
    <li><a href="/painel/cpd/<?= $cpd->id ?>">Monitoração</a></li>
    <li class="active"><a href="/painel/cpd/<?= $cpd->id ?>/relatorio">Relatório</a></li>
    <a href="/painel/cpd/<?= $cpd->id ?>/exportar" class="btn btn-success nav-button">Exportar CSV</a>
    
    <?php if(!$filtrarFalhas): ?>
        <a href="/painel/cpd/<?= $cpd->id ?>/relatorio/falhas" class="btn btn-primary nav-button">Filtrar Falhas</a>
    <?php else: ?>
        <a href="/painel/cpd/<?= $cpd->id ?>/relatorio" class="btn btn-primary nav-button">Relatório Completo</a>
    <?php endif ?>
</ul>

<div id="chartContainer"></div>

<?php if (count($cpd->leituras) > 0): ?>

    <table class="table table-striped">
        <tr>
            <th>Data/Horário</th>
            <th>Temperatura</th>
            <th>Umidade</th>
        </tr>
        <?php foreach ($leituras as $leitura): ?>
            <tr <?php if($leitura->inadequada()) echo 'class="danger"'?>>
                <td><?= date('d/m/Y h:i:s', strtotime($leitura->horario)) ?></td>
                <td ><?= $leitura->temperatura ?> °C</td>
                <td><?= $leitura->umidade ?>% </td>
            </tr>
        <?php endforeach ?>
    </table>

<?php else: ?>
    <h4>Não há leituras para esse CPD!</h4>

<?php endif; ?>

<script src="/js/canvasjs.min.js"></script>
<script type="text/javascript">
    var pontosTemperatura = <?= \App\GeradorJson::temperatura($leituras) ?>;
    var pontosUmidade = <?=\App\GeradorJson::umidade($leituras) ?>;

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
