<section class="intro">
    <form class="container has-header" method="post">
        <?php if (isset($erro)): ?>
            <div class="row">
                <div class="alert alert-danger"><?= $erro ?></div>
            </div>
        <?php endif ?>

        <h2 class="col-md-12">Dados de Login</h2>
        <div class="row">
            <div class="form-group col-md-4">
                <label>E-mail</label>
                <input type="email" class="form-control" name="usuario[email]" required>
            </div>

            <div class="form-group col-md-4">
                <label>Senha</label>
                <input type="password" class="form-control"  name="usuario[senha]" required>
            </div>

            <div class="form-group col-md-4">
                <label>Confirme a Senha</label>
                <input type="password" class="form-control" name="confirmar_senha" required>
            </div>
        </div>
        
        <br>
        
        <div class="row">
            <h2 class="col-md-12">Dados do Contratante</h2>

            <div class="form-group col-md-4">
                <label>Nome</label>
                <input type="text" class="form-control" name="usuario[nome]" required>
            </div>


            <div class="form-group col-md-3">
                <label>CPF</label>
                <input type="text" class="form-control" name="usuario[cpf]" required>
            </div>

            <div class="form-group col-md-3">
                <label>RG</label>
                <input type="text" class="form-control" name="usuario[rg]" required>
            </div>

            <div class="form-group col-md-2">
                <label>CEP</label>
                <input type="text" class="form-control" name="usuario_endereco[cep]" required>
            </div>

            <div class="form-group col-md-5">
                <label>Endereço</label>
                <input type="text" class="form-control" name="usuario_endereco[logradouro]" required>
            </div>

            <div class="form-group col-md-1">
                <label>Numero</label>
                <input type="text" class="form-control" name="usuario_endereco[numero]" required>
            </div>

            <div class="form-group col-md-2">
                <label>Bairro</label>
                <input type="text" class="form-control" name="usuario_endereco[bairro]" required>
            </div>

            <div class="form-group col-md-2">
                <label>Estado</label>
                <input type="text" class="form-control" name="usuario_endereco[estado]" required>
            </div>

            <div class="form-group col-md-2">
                <label>Cidade</label>
                <input type="text" class="form-control" name="usuario_endereco[cidade]" required>
            </div>
        </div>

        <br>
        
        <div class="row">
            <h2 class="col-md-12">Dados da Empresa</h2>
            <div class="form-group col-md-6">
                <label>Razao Social</label>
                <input type="text" class="form-control" name="empresa[razao_social]" required>
            </div>

            <div class="form-group col-md-4">
                <label>CNPJ</label>
                <input type="text" class="form-control"  name="empresa[cnpj]" required>
            </div>

            <div class="form-group col-md-2">
                <label>CEP</label>
                <input type="text" class="form-control" name="empresa_endereco[cep]" required>
            </div>

            <div class="form-group col-md-5">
                <label>Endereço</label>
                <input type="text" class="form-control" name="empresa_endereco[logradouro]" required>
            </div>

            <div class="form-group col-md-1">
                <label>Numero</label>
                <input type="text" class="form-control" name="empresa_endereco[numero]" required>
            </div>

            <div class="form-group col-md-2">
                <label>Bairro</label>
                <input type="text" class="form-control" name="empresa_endereco[bairro]" required>
            </div>

            <div class="form-group col-md-2">
                <label>Estado</label>
                <input type="text" class="form-control" name="empresa_endereco[estado]" required>
            </div>

            <div class="form-group col-md-2">
                <label>Cidade</label>
                <input type="text" class="form-control" name="empresa_endereco[cidade]" required>
            </div>
        </div>

        <button type="submit" name="button" class="btn btn-primary">Cadastrar</button>
    </form>

</section>

<script>
    document.body.onload = function () {
        $('[name="usuario[cpf]"]').mask('000.000.000-00');
        $('[name="usuario[rg]"]').mask('00.000.000-0');
        $('[name="empresa[cnpj]"]').mask('00.000.000/0000-00');
        $('[name="usuario[telefone]"]').mask('(00)0000-0000');
        $('[name="usuario_endereco[cep]"]').mask('00000-000');
        $('[name="empresa_endereco[cep]"]').mask('00000-000');
    };
</script>