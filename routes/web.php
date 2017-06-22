<?php

use \App\Usuario;
use \App\Empresa;
use \App\Cpd;
use \App\Session;
use \Illuminate\Http\Request;

/** Site * */
$app->get('/', function () use ($app) {
    return view('site', ['view' => 'home']);
});

$app->get('/cadastro', function () use ($app) {
    return view('site', ['view' => 'cadastro']);
});

$app->post('/cadastro', function (Request $request) use ($app) {
    $cpfExistente = Usuario::where('cpf', '=', $request->input('usuario')['cpf'])->count();
    $emailExistente = Usuario::where('email', '=', $request->input('usuario')['email'])->count();
    $cnpjExistente = Empresa::where('cnpj', '=', $request->input('empresa')['cnpj'])->count();

    if ($cpfExistente) {
        return view('site', ['view' => 'cadastro', 'erro' => 'CPF já cadastrado no sistema.']);
    }

    if ($emailExistente) {
        return view('site', ['view' => 'cadastro', 'erro' => 'E-mail já cadastrado no sistema.']);
    }

    if ($cnpjExistente) {
        return view('site', ['view' => 'cadastro', 'erro' => 'CNPJ já cadastrado no sistema.']);
    }

    $usuario = Usuario::create($request->input('usuario'));
    $usuario->endereco()->create($request->input('usuario_endereco'));
    $usuario->save();

    $empresa = Empresa::create($request->input('empresa'));
    $empresa->endereco()->create($request->input('empresa_endereco'));
    $empresa->save();

    $usuario->empresa()->save($empresa);

    return view('site', ['view' => 'cadastro-sucesso']);
});

$app->get('/login', function () use ($app) {
    return view('site', ['view' => 'login']);
});

$app->post('/login', function (Request $request) use ($app) {
    $usuario = Usuario::where('email', '=', $request->input('email'))->first();

    if ($usuario && $usuario->senha == $request->input('senha')) {
        Session::login($usuario);

        if ($usuario->tipo == Usuario::ADMIN) {
            return redirect('/admin/home');
        } else {
            return redirect('/painel/dashboard');
        }
    }

    return view('site', ['view' => 'login', 'erro' => 'E-mail ou senha inválidos.']);
});

$app->get('/teste', function () use ($app) {
    return view('teste');
});

/** Painel * */
$app->get('/painel/dashboard', function () use ($app) {
    return view('painel', ['view' => 'dashboard', 'usuario' => Session::user()]);
});

$app->get('/painel/logout', function () use ($app) {
    Session::logout();

    return redirect('/');
});

$app->get('/painel/cadastro', function () use ($app) {
    return view('painel', ['view' => 'cadastro', 'usuario' => Session::user()]);
});

$app->post('/painel/cadastro', function (Request $request) use ($app) {
    $cpd = Cpd::where('numero_serial', '=', $request->input('cpd')['numero_serial'])->first();

    if (!$cpd) {
        return view('painel', ['view' => 'cadastro', 'usuario' => Session::user(), 'erro' => 'Número serial não disponível no sistema.']);
    }

    $cpd->fill($request->input('cpd'));
    $cpd->save();

    $usuario = Session::user();
    $usuario->empresa->cpds()->save($cpd);

    return view('painel', ['view' => 'cadastro-sucesso', 'cpd' => $cpd, 'usuario' => Session::user()]);
});

$app->get('/painel/cpd/{id}', function ($id) use ($app) {
    $cpd = Cpd::find($id);

    return view('painel', ['view' => 'monitoracao', 'usuario' => Session::user(), 'cpd' => $cpd]);
});

$app->get('/painel/cpd/{id}/editar', function ($id) use ($app) {
    $cpd = Cpd::find($id);

    return view('painel', ['view' => 'editar', 'usuario' => Session::user(), 'cpd' => $cpd]);
});

$app->post('/painel/cpd/{id}/editar', function ($id, Request $request) use ($app) {
    $cpd = Cpd::find($id);

    $cpd->fill($request->input('cpd'));
    $cpd->save();

    return view('painel', ['view' => 'monitoracao', 'usuario' => Session::user(), 'cpd' => $cpd, 'sucesso' => 'Os parâmetros foram atualizados.']);
});

$app->get('/painel/cpd/{id}/relatorio', function ($id, Request $request) use ($app) {
    $cpd = Cpd::find($id);

    if ($request->input('filtros')) {
        $filtros = explode(',', $request->input('filtros'));
    } else {
        $filtros = [];
    }

    return view('painel', ['view' => 'relatorio', 'usuario' => Session::user(), 'cpd' => $cpd, 'filtros' => $filtros]);
});

$app->get('/painel/cpd/{id}/exportar', function ($id) use ($app) {
    $cpd = Cpd::find($id);
    $csv = "data;temperatura;umidade\n";

    foreach ($cpd->leituras as $leitura) {
        $horario = date('d/m/Y h:i:s', strtotime($leitura->horario));
        $csv .= "$horario;$leitura->temperatura;$leitura->umidade\n";
    }

    file_put_contents('storage/relatorio.csv', $csv);

    return response()->download('storage/relatorio.csv');
});

$app->get('/painel/perfil', function () use ($app) {
    return view('painel', ['view' => 'perfil', 'usuario' => Session::user()]);
});

$app->post('/painel/perfil', function (Request $request) use ($app) {
    $usuario = Session::user();

    $usuario->fill($request->input('usuario'));
    $usuario->save();

    $usuario->endereco->fill($request->input('usuario_endereco'));
    $usuario->endereco->save();

    $usuario->empresa->fill($request->input('empresa'));
    $usuario->empresa->save();

    $usuario->empresa->endereco->fill($request->input('empresa_endereco'));
    $usuario->empresa->endereco->save();

    Session::login($usuario);

    return view('painel', ['view' => 'perfil', 'usuario' => $usuario, 'sucesso' => 'Os dados foram atualizados!']);
});

/** Admin * */
$app->get('/admin/home', function () use ($app) {
    return view('admin', ['view' => 'home', 'usuario' => Session::user()]);
});

$app->get('/admin/clientes', function () use ($app) {
    $clientes = Usuario::where('tipo', '=', Usuario::CLIENTE)->get();

    return view('admin', ['view' => 'clientes', 'usuario' => Session::user(), 'clientes' => $clientes]);
});

$app->get('/admin/cpds', function () use ($app) {
    $cpds = Cpd::orderBy('id', 'desc')->get();

    return view('admin', ['view' => 'cpds', 'usuario' => Session::user(), 'cpds' => $cpds]);
});

$app->get('/admin/cpds/novo', function () use ($app) {
    return view('admin', ['view' => 'novo-cpd', 'usuario' => Session::user()]);
});

$app->post('/admin/cpds/novo', function (Request $request) use ($app) {
    $serialExistente = Cpd::where('numero_serial', '=', $request->input('cpd')['numero_serial'])->count();

    if ($serialExistente) {
        return view('admin', ['view' => 'novo-cpd', 'usuario' => Session::user(), 'erro' => 'Serial já cadastrado no sistema.']);
    }

    $cpd = Cpd::create($request->input('cpd'));

    $cpds = Cpd::orderBy('id', 'desc')->get();

    return view('admin', ['view' => 'cpds', 'usuario' => Session::user(), 'cpds' => $cpds, 'sucesso' => 'O CPD foi cadastrado com sucesso.']);
});

/** Api * */
$app->post('/api/leitura', function (Request $request) use ($app) {
    $cpd = Cpd::where('numero_serial', '=', $request->input('serial'))->first();

    if (!$cpd) {
        return (new Illuminate\Http\Response(null, 404));
    }

    $cpd->leituras()->create([
        'temperatura' => $request->input('temperatura'),
        'umidade' => $request->input('umidade'),
        'horario' => date('Y-m-d h:i:s')
    ]);

    $leitura = $cpd->leituras()->orderBy('horario', 'desc')->first();
    
    if ($leitura && $leitura->inadequada()) {
        $mailer = new App\Mailer();
        
        try{
            $mailer->send($cpd, $leitura);
        }catch(\Swift_TransportException $e){
            
        }
    }

    return (new Illuminate\Http\Response(null, 201));
});

$app->get('/teste-email/{serial}', function ($serial) use ($app) {
    $cpd = Cpd::where('numero_serial', '=', $serial)->first();

    if (!$cpd) {
        return (new Illuminate\Http\Response(null, 404));
    }

    $leitura = $cpd->leituras()->orderBy('horario', 'desc')->first();
    
    if ($leitura) {
        $mailer = new App\Mailer();
        $mailer->send($cpd, $leitura);
        
        echo 'email enviado';
    }

    return (new Illuminate\Http\Response(null, 201));
});
