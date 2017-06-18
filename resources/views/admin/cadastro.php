<form method="post">

    <div class="row">
        <?php if (isset($erro)): ?>
            <div class="row">
                <div class="alert alert-danger"><?= $erro ?></div>
            </div>
        <?php endif ?>
        
        <h2 class="col-md-12">Cadastro de CPD</h2>

        <div class="form-group col-md-6">
            <label>Numero de Serial</label>
            <input type="text" class="form-control" name="cpd[numero_serial]">
        </div>

        <div class="form-group col-md-2">
            <label>Data da Instalação</label>
            <input type="text" class="form-control" name="cpd[data_instalacao]">
        </div>
    </div>

    <button type="submit" name="button" class="btn btn-primary">Cadastrar</button>
</form>


