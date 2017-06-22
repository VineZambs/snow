<?php
$listagemCpds = $usuario->empresa->cpds()->get();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>SNOW SYSTEM</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/css/darkly-bootstrap.min.css">
        <link rel="stylesheet" href="/css/painel.css">

    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <span class="navbar-brand" href="#">
                        Snow
                    </span>
                </div>
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            CPD's <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="/painel/cadastro">Cadastrar CPD</a></li>
                            <?php $i = 1 ?>
                            <?php foreach ($listagemCpds as $listagemCpd): ?>
                                <li>
                                    <a href="/painel/cpd/<?= $listagemCpd->id ?>">CPD <?=$i?> - <?= $listagemCpd->numero_serial ?></a>
                                </li>
                                <?php $i++ ?>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li>
                        <a href="/painel/perfil">
                            Meus Dados
                        </a>
                    </li>
                </ul>
                <div class="nav navbar-nav navbar-right">
                    <li>
                        <a>Olá, <?= $usuario->nome ?></a>
                    </li>
                    <li>
                        <a href="/painel/logout">Sair</a>
                    </li>
                </div>
            </div>
        </nav>

        <div class="container">
            <?php include("painel/$view.php") ?>
        </div>

        <script src="/js/jquery.js"></script>
        <script src="/js/jquery.mask.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>

    </body>
</html>
