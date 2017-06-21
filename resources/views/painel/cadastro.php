<form method="post">

    <div class="row">
        <?php if (isset($erro)): ?>
            <div class="row">
                <div class="alert alert-danger"><?= $erro ?></div>
            </div>
        <?php endif ?>

        <h2 class="col-md-12">Cadastro de CPD</h2>

        <div class="row">
            <div class="form-group col-md-4">
                <label>Numero de Serial</label>
                <input type="text" class="form-control" name="cpd[numero_serial]">
            </div>

            <div class="form-group col-md-2">
                <label>Data da Instalação</label>
                <input type="text" class="form-control" name="cpd[data_instalacao]">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-3">
                <label>Temperatura Mínima: <span id="temperatura_min">20</span> °C</label>
                <input type="range" class="form-control" name="cpd[temperatura_min]" min="0" max="30" value="20">
            </div>

            <div class="form-group col-md-3">
                <label>Temperatura Máxima: <span id="temperatura_max">40</span> °C</label>
                <input type="range" class="form-control" name="cpd[temperatura_max]" min="30" max="100" value="40">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-3">
                <label>Umidade Mínima: <span id="umidade_min">40</span>%</label>
                <input type="range" class="form-control" name="cpd[umidade_min]" min="30" max="60" value="40">
            </div>

            <div class="form-group col-md-3">
                <label>Umidade Máxima: <span id="umidade_max">80</span>%</label>
                <input type="range" class="form-control" name="cpd[umidade_max]" min="60" max="100" value="80">
            </div>
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

        $('[name="cpd[umidade_min]"]').change(function(){
            $('#umidade_min').html(this.value)
        });

        $('[name="cpd[temperatura_min]"]').change(function(){
            $('#temperatura_min').html(this.value)
        });

        $('[name="cpd[data_instalacao]"]').mask('00/00/0000');
    };
</script>
