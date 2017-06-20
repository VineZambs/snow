<h2>Clientes</h2>

<?php if (count($clientes) > 0): ?>
    <table class="table">
        <tr>
            <th>Nome</th>
            <th>CPF</th>
            <th>Empresa</th>
        </tr>
        <?php foreach ($clientes as $cliente): ?>
            <tr>
                <td><?= $cliente->nome ?></td>
                <td><?= $cliente->cpf ?></td>
                <td><?= $cliente->empresa->razao_social ?></td>
            </tr>
        <?php endforeach ?>
    </table>

<?php else: ?>
    <h4>Não há clientes cadastrados!</h4>
<?php endif; ?>
