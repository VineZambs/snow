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
                    <li>
                        <a href="/admin/clientes">
                            Clientes
                        </a>
                    </li>
                    <li>
                        <a href="/admin/cpds">
                            CPDs
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
            <?php include("admin/$view.php") ?>
        </div>

        <script src="/js/jquery.js"></script>
        <script src="/js/jquery.mask.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>

    </body>
</html>
