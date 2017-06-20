<h2>CPD <?= $cpd->numero_serial ?></h2>

<?php if (count($cpd->leituras) > 0): ?>

    <?php $leitura_atual = $cpd->leituras[0] ?>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs">
        <li class="active"><a href="/painel/cpd/<?= $cpd->id ?>">Monitoração</a></li>
        <li><a href="/painel/cpd/<?= $cpd->id ?>/relatorio">Relatório</a></li>
        <a href="/painel/cpd/<?= $cpd->id ?>/exportar" class="btn btn-primary" style="float:right">Exportar CSV</a>
    </ul>

    <div class="col-md-6">
        <canvas id="gauge-temperatura"></canvas>
        <p class="gauge-title">Temperatura: <?= $leitura_atual->temperatura ?> °C</p>
    </div>

    <div class="col-md-6">
        <canvas id="gauge-umidade"></canvas>
        <p class="gauge-title">Umidade: <?= number_format($leitura_atual->umidade, 2, ',', '') ?>%</p>
    </div>

    <p style="float: right">Última leitura: <?=date('d/m/Y h:i:s', strtotime($leitura_atual->horario))?>

    <script src="/js/gauge.min.js"></script>
    <script>
        /* Gauge Temperatura */
        var opts = {
            angle: 0.15, // The span of the gauge arc
            lineWidth: 0.2, // The line thickness
            radiusScale: 1, // Relative radius
            pointer: {
                length: 0.6, // // Relative to gauge radius
                strokeWidth: 0.035, // The thickness
                color: '#000000' // Fill color
            },
            limitMax: false, // If false, the max value of the gauge will be updated if value surpass max
            limitMin: false, // If true, the min value of the gauge will be fixed unless you set it manually
            colorStart: '#0FADCF', // Colors
            colorStop: '#8FC0DA', // just experiment with them
            strokeColor: '#E0E0E0', // to see which ones work best for you
            generateGradient: true,
            highDpiSupport: true     // High resolution support
        };

        var gaugeTemperatura = new Gauge(document.getElementById('gauge-temperatura')).setOptions(opts); // create sexy gauge!
        gaugeTemperatura.maxValue = 60; // set max gauge value
        gaugeTemperatura.setMinValue(0);  // Prefer setter over gauge.minValue = 0
        gaugeTemperatura.animationSpeed = 32; // set animation speed (32 is default value)
        gaugeTemperatura.set(<?= $leitura_atual->temperatura ?>); // set actual value

        /* Gauge Umidade */
        opts.colorStart = '#920';
        opts.colorStop = '#920';

        var gaugeUmidade = new Gauge(document.getElementById('gauge-umidade')).setOptions(opts); // create sexy gauge!
        gaugeUmidade.maxValue = 100; // set max gauge value
        gaugeUmidade.setMinValue(0);  // Prefer setter over gauge.minValue = 0
        gaugeUmidade.animationSpeed = 10; // set animation speed (32 is default value)
        gaugeUmidade.set(<?= $leitura_atual->umidade ?>); // set actual value
    </script>

<?php else: ?>
    <h4>Não há leituras para esse CPD!</h4>

<?php endif; ?>
