<form method="post">

    <div class="row">
        <?php if (isset($erro)): ?>
            <div class="row">
                <div class="alert alert-danger"><?= $erro ?></div>
            </div>
        <?php endif ?>

        <h2 class="col-md-12">Cadastro de CPD</h2>

        <div class="form-group col-md-4">
            <label>Numero de Serial</label>
            <input type="text" class="form-control" name="cpd[numero_serial]">
        </div>

        <div class="form-group col-md-2">
            <label>Data da Instalação</label>
            <input type="text" class="form-control" name="cpd[data_instalacao]">
        </div>

        <div class="form-group col-md-3">
            <label>Temperatura Máxima: <span id="temperatura_max">30</span> °C</label>
            <input type="range" class="form-control" name="cpd[temperatura_max]" min="20" max="60" value="30">
        </div>

        <div class="form-group col-md-3">
            <label>Umidade Máxima: <span id="umidade_max">60</span>%</label>
            <input type="range" class="form-control" name="cpd[umidade_max]" min="40" max="90" value="60">
        </div>
    </div>

    <button type="submit" name="button" class="btn btn-primary">Cadastrar</button>
</form>

<script>
    document.body.onload = function () {
        $('[name="cpd[umidade_max]"]').change(function(){
            $('#umidade_max').html(this.value)
        });

        $('[name="cpd[temperatura_max]"]').change(function(){
            $('#temperatura_max').html(this.value)
        });

        $('[name="cpd[data_instalacao]"]').mask('00/00/0000');
    };
</script>
