<?php
$filtrarFalhas = array_search('falhas', $filtros) !== false;
$filtrarTemperatura = array_search('temperatura', $filtros) !== false;
$filtrarUmidade = array_search('umidade', $filtros) !== false;

if ($filtrarFalhas) {
    $leituras = $cpd->leituras()
            ->where('temperatura', '>', $cpd->temperatura_max)
            ->orWhere('temperatura', '<', $cpd->temperatura_min)
            ->orWhere('umidade', '>', $cpd->umidade_max)
            ->orWhere('umidade', '<', $cpd->umidade_min)
            ->orderBy('horario', 'desc')
            ->get();
} else {
    $leituras = $cpd->leituras()->orderBy('horario', 'desc')->get();
}
?>

<h2>CPD <?= $cpd->numero_serial ?></h2>

<!-- Nav tabs -->
<ul class="nav nav-tabs">
    <li><a href="/painel/cpd/<?= $cpd->id ?>">Monitoração</a></li>
    <li class="active"><a href="/painel/cpd/<?= $cpd->id ?>/relatorio?filtros=temperatura,umidade">Relatório</a></li>
    <a href="/painel/cpd/<?= $cpd->id ?>/exportar" class="btn btn-success nav-button">Exportar CSV</a>
</ul>

<div class="form-inline">
    <div class="checkbox">
        <label>
            <input type="checkbox" <?php if($filtrarTemperatura) echo 'checked'?> value="temperatura"> Temperatura
        </label>
    </div>
    <div class="checkbox">
        <label>
            <input type="checkbox" <?php if($filtrarUmidade) echo 'checked'?>  value="umidade"> Umidade
        </label>
    </div>
    <div class="checkbox">
        <label>
            <input type="checkbox" <?php if($filtrarFalhas) echo 'checked'?>  value="falhas"> Apenas Falhas
        </label>
    </div>
</div>

<div id="chartContainer"></div>

<?php if (count($cpd->leituras) > 0): ?>

    <table class="table table-striped">
        <tr>
            <th>Data/Horário</th>
            <?php if($filtrarTemperatura): ?>
                <th>Temperatura</th>
            <?php endif ?>
            <?php if($filtrarUmidade): ?>
                <th>Umidade</th>
            <?php endif ?>
        </tr>
    <?php foreach ($leituras as $leitura): ?>
            <tr <?php if ($leitura->inadequada()) echo 'class="danger"' ?>>
                <td><?= date('d/m/Y h:i:s', strtotime($leitura->horario)) ?></td>
                <?php if($filtrarTemperatura): ?>
                    <td ><?= $leitura->temperatura ?> °C</td>
                <?php endif ?>
                <?php if($filtrarUmidade): ?>
                    <td><?= $leitura->umidade ?>% </td>
                <?php endif ?>
            </tr>
    <?php endforeach ?>
    </table>

<?php else: ?>
    <h4>Não há leituras para esse CPD!</h4>

<?php endif; ?>

<script src="/js/canvasjs.min.js"></script>
<script type="text/javascript">
    var pontosTemperatura = <?= \App\GeradorJson::temperatura($leituras) ?>;
    var pontosUmidade = <?= \App\GeradorJson::umidade($leituras) ?>;

    for (i in pontosTemperatura) {
        pontosTemperatura[i].x = new Date(pontosTemperatura[i].x);
    }

    for (i in pontosUmidade) {
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
                    legend: {
                        fontSize: 24
                    },
                    data: [
                        <?php if($filtrarTemperatura): ?>
                            {
                                name: "Temperatura (C)",
                                showInLegend: true,
                                type: "line",
                                color: "red",
                                dataPoints: pontosTemperatura
                            },
                        <?php endif ?>
                        <?php if($filtrarUmidade): ?>
                            {
                                name: "Umidade (%)",
                                showInLegend: true,
                                type: "line",
                                color: "blue",
                                dataPoints: pontosUmidade
                            }
                        <?php endif ?>
                    ]
                });

        chart.render();
        
        $('[type=checkbox]').click(filtrar);
    }
    
    
    
    function filtrar(){
        var checkboxes = document.querySelectorAll('[type=checkbox]');
        var filtros = [];
        
        for(i in checkboxes){
            var checkbox = checkboxes[i];
            
            console.log(checkbox)
            if(checkbox.checked){
                filtros.push(checkbox.value)
            }
        }
        
        window.location = '/painel/cpd/1/relatorio?filtros=' + filtros.join(',');
    }
</script>
