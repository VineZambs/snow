<form method="post">

    <div class="row">
        <?php if (isset($erro)): ?>
            <div class="row">
                <div class="alert alert-danger"><?= $erro ?></div>
            </div>
        <?php endif ?>

        <h2 class="col-md-12">Edição de parâmetros do CPD <?=$cpd->numero_serial?></h2>

        <div class="row">
            <div class="form-group col-md-3">
                <label>Temperatura Mínima: <span id="temperatura_min"><?=$cpd->temperatura_min?></span> °C</label>
                <input type="range" class="form-control" name="cpd[temperatura_min]" min="0" max="30" value="<?=$cpd->temperatura_min?>">
            </div>

            <div class="form-group col-md-3">
                <label>Temperatura Máxima: <span id="temperatura_max"><?=$cpd->temperatura_max?></span> °C</label>
                <input type="range" class="form-control" name="cpd[temperatura_max]" min="30" max="100" value="<?=$cpd->temperatura_max?>">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-3">
                <label>Umidade Mínima: <span id="umidade_min"><?=$cpd->umidade_min?></span>%</label>
                <input type="range" class="form-control" name="cpd[umidade_min]" min="30" max="60" value="<?=$cpd->umidade_min?>">
            </div>

            <div class="form-group col-md-3">
                <label>Umidade Máxima: <span id="umidade_max"><?=$cpd->umidade_max?></span>%</label>
                <input type="range" class="form-control" name="cpd[umidade_max]" min="60" max="100" value="<?=$cpd->umidade_max?>">
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
    };
</script>
