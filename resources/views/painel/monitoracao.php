<?php $leitura_atual = $cpd->leituras()->orderBy('horario', 'desc')->first() ?>

<h2>CPD <?= $cpd->numero_serial ?></h2>
<?php if ($leitura_atual): ?>
    <?php if ($leitura_atual->temperatura < $cpd->temperatura_min || $leitura_atual->temperatura > $cpd->temperatura_max): ?>
        <div class="alert alert-danger">Atenção. A temperatura do CPD está fora dos valores definidos!</div>
    <?php endif ?>

    <?php if ($leitura_atual->umidade < $cpd->umidade_min || $leitura_atual->umidade > $cpd->umidade_max): ?>
        <div class="alert alert-danger">Atenção. A umidade do CPD está fora dos valores definidos!</div>
    <?php endif ?>
        
        <?php if (isset($sucesso)): ?>
        <div class="alert alert-success"><?=$sucesso?></div>
    <?php endif ?>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs">
        <li class="active"><a href="/painel/cpd/<?= $cpd->id ?>">Monitoração</a></li>
        <li><a href="/painel/cpd/<?= $cpd->id ?>/relatorio?filtros=temperatura,umidade">Relatório</a></li>
        <a href="/painel/cpd/<?= $cpd->id ?>/editar" class="btn btn-success nav-button">Editar Parâmetros</a>
    </ul>

    <div class="well row-spaced">
        <div class="row">

            <div class="col-md-6">
                <canvas id="gauge-temperatura"></canvas>
                <p class="gauge-title">Temperatura: <?= $leitura_atual->temperatura ?> °C</p>
            </div>

            <div class="col-md-6">
                <canvas id="gauge-umidade"></canvas>
                <p class="gauge-title">Umidade: <?= number_format($leitura_atual->umidade, 2, ',', '') ?>%</p>
            </div>

        </div>
    </div>
    
    <div>
        <p>Temperatura aceitável: De <?= $cpd->temperatura_min ?> °C à <?= $cpd->temperatura_max ?> °C</p>
        <p>Umidade aceitável: De <?= $cpd->umidade_min ?>% à <?= $cpd->umidade_max ?>%</p>
        <p>Última leitura: <?= date('d/m/Y h:i:s', strtotime($leitura_atual->horario)) ?></p>
    </div>

    <script src="/js/gauge.min.js"></script>
    <script>
        function fabricarGauge(elemento, valorMinimo, valorMaximo, valorAtual) {
            var opts = {
                angle: 0.001,
                lineWidth: 0.2,
                radiusScale: 1,
                pointer: {
                    length: 0.6,
                    strokeWidth: 0.035,
                    color: '#000000'
                },
                limitMax: false,
                limitMin: false,
                strokeColor: '#E0E0E0',
                generateGradient: true,
                highDpiSupport: true,
                staticZones: []
            }

            var rangeAceitavel = valorMaximo - valorMinimo;

            var zonaAtencaoMinimo = valorMinimo + rangeAceitavel * 0.2;
            var zonaAtencaoMaximo = valorMaximo - rangeAceitavel * 0.2;

            opts.staticZones.push({strokeStyle: "red", min: 0, max: valorMinimo});
            opts.staticZones.push({strokeStyle: "yellow", min: valorMinimo, max: zonaAtencaoMinimo});
            opts.staticZones.push({strokeStyle: "green", min: zonaAtencaoMinimo, max: zonaAtencaoMaximo});
            opts.staticZones.push({strokeStyle: "yellow", min: zonaAtencaoMaximo, max: valorMaximo});
            opts.staticZones.push({strokeStyle: "red", min: valorMaximo, max: 100});

            var gauge = new Gauge(elemento).setOptions(opts);

            gauge.maxValue = 100;
            gauge.setMinValue(0);
            gauge.set(valorAtual);

            return gauge;
        }

        var gaugeTemperatura = fabricarGauge(document.getElementById('gauge-temperatura'), <?= $cpd->temperatura_min ?>, <?= $cpd->temperatura_max ?>, <?= $leitura_atual->temperatura ?>)
        var gaugeUmidade = fabricarGauge(document.getElementById('gauge-umidade'), <?= $cpd->umidade_min ?>, <?= $cpd->umidade_max ?>, <?= $leitura_atual->umidade ?>)
    </script>

<?php else: ?>
    <h4>Não há leituras para esse CPD!</h4>
<?php endif; ?>
