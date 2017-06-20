<h2>Novo CPDs</h2>

<?php if (isset($erro)): ?>
    <div class="alert alert-danger"><?= $erro ?></div>
<?php endif ?>

<form method="post">
    <div class="form-group">
        <label>Número Serial</label>
        <input type="text" class="form-control" name="cpd[numero_serial]">
    </div>

    <input type="submit" value="Cadastrar" class="btn btn-primary">
</form>
