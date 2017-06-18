<?php
$cpds = $usuario->empresa->cpds()->get();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>SNOW SYSTEM</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/css/cerulean-bootstrap.min.css">
        <link rel="stylesheet" href="/css/admin.css">

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
                            <li><a href="/admin/cadastro">Cadastrar CPD</a></li>
                            <?php foreach ($cpds as $cpd): ?>
                                <li>
                                    <a href="/admin/cpd/<?= $cpd->id ?>">CPD <?= $cpd->numero_serial ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li>
                        <a href="/admin/perfil">
                            Meus Dados
                        </a>
                    </li>
                </ul>
                <div class="nav navbar-nav navbar-right">
                    <li>
                        <a>Olá, <?= $usuario->nome ?></a>
                    </li>
                    <li>
                        <a href="/admin/logout">Sair</a>
                    </li>
                </div>
            </div>
        </nav>

        <div class="container">
            <?php include("admin/$view.php") ?>
        </div>

        <script src="/js/jquery.js"></script>
        <script src="/js/jquery.mask.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>

    </body>
</html>
