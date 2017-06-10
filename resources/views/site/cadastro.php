<section class="container has-header">
    <form method="post">
        <div class="row">

            <h2 class="col-md-12">Dados do Contratante</h2>

            <div class="form-group col-md-10">
                <label>Nome</label>
                <input type="text" class="form-control" name="usuario[nome]" required>
            </div>


            <div class="form-group col-md-2">
                <label>CPF</label>
                <input type="text" class="form-control" name="usuario[cpf]" required>
            </div>

            <div class="form-group col-md-2">
                <label>RG</label>
                <input type="text" class="form-control" name="usuario[rg]" required>
            </div>

            <div class="form-group col-md-4">
                <label>CEP</label>
                <input type="text" class="form-control" name="usuario_endereco[cep]" required>
            </div>

            <div class="form-group col-md-6">
                <label>Endereço</label>
                <input type="text" class="form-control" name="usuario_endereco[logradouro]" required>
            </div>

            <div class="form-group col-md-2">
                <label>Numero</label>
                <input type="text" class="form-control" name="usuario_endereco[numero]" required>
            </div>
            <div class="form-group col-md-2">
                <label>Bairro</label>
                <input type="text" class="form-control" name="usuario_endereco[bairro]" required>
            </div>

            <div class="form-group col-md-4">
                <label>Estado</label>
                <input type="text" class="form-control" name="usuario_endereco[estado]" required>
            </div>

            <div class="form-group col-md-4">
                <label>Cidade</label>
                <input type="text" class="form-control" name="usuario_endereco[cidade]" required>
            </div>

        </div>

        <div class="row">

            <h2 class="col-md-12">Dados da Empresa</h2>
            <div class="form-group col-md-12">
                <label>Razao Social</label>
                <input type="text" class="form-control" name="empresa[razao_social]" required>
            </div>

            <div class="form-group col-md-4">
                <label>CNPJ</label>
                <input type="text" class="form-control"  name="empresa[cnpj]" required>
            </div>

            <div class="form-group col-md-4">
                <label>CEP</label>
                <input type="text" class="form-control" name="empresa_endereco[cep]" required>
            </div>

            <div class="form-group col-md-6">
                <label>Endereço</label>
                <input type="text" class="form-control" name="empresa_endereco[logradouro]" required>
            </div>

            <div class="form-group col-md-2">
                <label>Numero</label>
                <input type="text" class="form-control" name="empresa_endereco[numero]" required>
            </div>

            <div class="form-group col-md-4">
                <label>Bairro</label>
                <input type="text" class="form-control" name="empresa_endereco[bairro]" required>
            </div>

            <div class="form-group col-md-4">
                <label>Estado</label>
                <input type="text" class="form-control" name="empresa_endereco[estado]" required>
            </div>

            <div class="form-group col-md-4">
                <label>Cidade</label>
                <input type="text" class="form-control" name="empresa_endereco[cidade]" required>
            </div>
        </div>

        <div class="row">
            <h2 class="col-md-12">Dados de Login</h2>
            <div class="form-group col-md-2">
                <label>E-mail</label>
                <input type="email" class="form-control" name="usuario[email]" required>
            </div>

            <div class="form-group col-md-2">
                <label>Senha</label>
                <input type="password" class="form-control"  name="usuario[senha]" required>
            </div>

            <div class="form-group col-md-2">
                <label>Confirme a Senha</label>
                <input type="password" class="form-control" name="confirmar_senha" required>
            </div>
        </div>

        <button type="submit" name="button" class="btn btn-primary">Cadastrar</button>
    </form>

</section>

<script>
    document.body.onload = function(){
        $('[name="usuario[cpf]"]').mask('000.000.000');   
        $('[name="empresa[cnpj]"]').mask('00.000.000/0000-00');   
        $('[name="usuario[telefone]"]').mask('(00)0000-0000');   
        $('[name="usuario_endereco[cep]"]').mask('00000-000');   
        $('[name="empresa_endereco[cep]"]').mask('00000-000');   
    };
</script>