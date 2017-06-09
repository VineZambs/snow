<section class="container has-header">
    <form method="post">
        <div class="row">

            <h2 class="col-md-12">Dados do Contratante</h2>

            <div class="form-group col-md-10">
                <label>Nome</label>
                <input type="text" class="form-control" name="usuario[nome]">
            </div>


            <div class="form-group col-md-2">
                <label>CPF</label>
                <input type="text" class="form-control" name="usuario[cpf]">
            </div>

            <div class="form-group col-md-2">
                <label>RG</label>
                <input type="text" class="form-control" name="usuario[rg]">
            </div>

            <div class="form-group col-md-4">
                <label>CEP</label>
                <input type="text" class="form-control" name="usuario_endereco[cep]">
            </div>

            <div class="form-group col-md-6">
                <label>Endereço</label>
                <input type="text" class="form-control" name="usuario_endereco[logradouro]">
            </div>

            <div class="form-group col-md-2">
                <label>Numero</label>
                <input type="text" class="form-control" name="usuario_endereco[numero]">
            </div>
            <div class="form-group col-md-2">
                <label>Bairro</label>
                <input type="text" class="form-control" name="usuario_endereco[bairro]">
            </div>

            <div class="form-group col-md-4">
                <label>Estado</label>
                <input type="text" class="form-control" name="usuario_endereco[estado]">
            </div>

            <div class="form-group col-md-4">
                <label>Cidade</label>
                <input type="text" class="form-control" name="usuario_endereco[cidade]">
            </div>

        </div>

        <div class="row">

            <h2 class="col-md-12">Dados da Empresa</h2>
            <div class="form-group col-md-12">
                <label>Razao Social</label>
                <input type="text" class="form-control" name="empresa[razao_social]">
            </div>

            <div class="form-group col-md-4">
                <label>CNPJ</label>
                <input type="text" class="form-control"  name="empresa[cnpj]">
            </div>

            <div class="form-group col-md-4">
                <label>CEP</label>
                <input type="text" class="form-control" name="empresa_endereco[cep]">
            </div>

            <div class="form-group col-md-6">
                <label>Endereço</label>
                <input type="text" class="form-control" name="empresa_endereco[logradouro]">
            </div>

            <div class="form-group col-md-2">
                <label>Numero</label>
                <input type="text" class="form-control" name="empresa_endereco[numero]">
            </div>

            <div class="form-group col-md-4">
                <label>Bairro</label>
                <input type="text" class="form-control" name="empresa_endereco[bairro]">
            </div>

            <div class="form-group col-md-4">
                <label>Estado</label>
                <input type="text" class="form-control" name="empresa_endereco[estado]">
            </div>

            <div class="form-group col-md-4">
                <label>Cidade</label>
                <input type="text" class="form-control" name="empresa_endereco[cidade]">
            </div>
        </div>

        <div class="row">
            <h2 class="col-md-12">Dados de Login</h2>
            <div class="form-group col-md-2">
                <label>E-mail</label>
                <input type="text" class="form-control" name="usuario[email]">
            </div>

            <div class="form-group col-md-2">
                <label>Senha</label>
                <input type="text" class="form-control"  name="usuario[senha]">
            </div>

            <div class="form-group col-md-2">
                <label>Confirme a Senha</label>
                <input type="text" class="form-control" name="confirmar_senha">
            </div>
        </div>

        <button type="submit" name="button" class="btn btn-primary">Cadastrar</button>
    </form>



</section>