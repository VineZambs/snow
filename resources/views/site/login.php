<section class="intro">
    <div class="container has-header">

        <form method="post" class="col-md-6 col-md-offset-3">
            <h2>Login</h2>
            
            <?php if (isset($erro)): ?>
                <div class="alert alert-danger"><?= $erro ?></div>
            <?php endif ?>

            <div class="form-group">
                <label>E-mail</label>
                <input type="text" class="form-control" name="email" required>
            </div>

            <div class="form-group">
                <label>Senha</label>
                <input type="password" class="form-control" name="senha" required>
            </div>

            <button type="submit" name="button" class="btn btn-primary">Login</button>
        </form>
    </div>
</section>
