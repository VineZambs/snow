<?php

use \App\Usuario;
use \App\Empresa;
use \App\Cpd;
use \App\Session;
use \Illuminate\Http\Request;

/** Site **/
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

    if($cpfExistente){
        return view('site', ['view' => 'cadastro', 'erro' => 'CPF já cadastrado no sistema.']);
    }

    if($emailExistente){
        return view('site', ['view' => 'cadastro', 'erro' => 'E-mail já cadastrado no sistema.']);
    }

    if($cnpjExistente){
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

    if($usuario && $usuario->senha == $request->input('senha')){
        Session::login($usuario);
        return redirect('/admin/dashboard');
    }

    return view('site', ['view' => 'login', 'erro' => 'E-mail ou senha inválidos.']);
});

$app->get('/teste', function () use ($app) {
    return view('teste');
});

/** Admin **/
$app->get('/admin/dashboard', function () use ($app) {
    return view('admin', ['view' => 'dashboard', 'usuario' => Session::user()]);
});

$app->get('/admin/logout', function () use ($app) {
    Session::logout();

    return redirect('/');
});

$app->get('/admin/cadastro', function () use ($app) {
    return view('admin', ['view' => 'cadastro', 'usuario' => Session::user()]);
});

$app->post('/admin/cadastro', function (Request $request) use ($app) {
    $serialExistente = Cpd::where('numero_serial', '=', $request->input('cpd')['numero_serial'])->count();

    if($serialExistente){
        return view('admin', ['view' => 'cadastro', 'usuario' => Session::user(), 'erro' => 'Número serial já cadastrado no sistema.']);
    }

    $usuario = Session::user();
    $usuario->empresa->cpds()->create($request->input('cpd'));

    $cpd = $usuario->empresa->cpds()->where('numero_serial', '=', $request->input('cpd')['numero_serial'])->first();

    return view('admin', ['view' => 'cadastro-sucesso', 'cpd' => $cpd, 'usuario' => Session::user()]);
});

$app->get('/admin/cpd/{id}', function ($id) use ($app) {
    $cpd = Cpd::find($id);

    return view('admin', ['view' => 'monitoracao', 'usuario' => Session::user(), 'cpd' => $cpd]);
});

$app->get('/admin/cpd/{id}/relatorio', function ($id) use ($app) {
    $cpd = Cpd::find($id);

    return view('admin', ['view' => 'relatorio', 'usuario' => Session::user(), 'cpd' => $cpd]);
});

$app->get('/admin/cpd/{id}/exportar', function ($id) use ($app) {
    $cpd = Cpd::find($id);
    $csv = "data;temperatura;umidade\n";

    foreach($cpd->leituras as $leitura){
        $horario = date('d/m/Y h:i:s', strtotime($leitura->horario));
        $csv .= "$horario;$leitura->temperatura;$leitura->umidade\n";
    }

    file_put_contents('storage/relatorio.csv', $csv);

    return response()->download('storage/relatorio.csv');
});

$app->get('/admin/perfil', function () use ($app) {
    return view('admin', ['view' => 'perfil', 'usuario' => Session::user()]);
});

$app->post('/admin/perfil', function (Request $request) use ($app) {
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

    return view('admin', ['view' => 'perfil', 'usuario' => $usuario, 'sucesso' => 'Os dados foram atualizados!']);
});

/** Api **/
$app->post('/api/leitura', function (Request $request) use ($app) {
    $cpd = Cpd::where('numero_serial', '=', $request->input('serial'))->first();

    if(!$cpd){
        return (new Illuminate\Http\Response(null, 404));
    }

    $cpd->leituras()->create([
        'temperatura' => $request->input('temperatura'),
        'umidade' => $request->input('umidade'),
        'horario' => date('Y-m-d h:i:s')
    ]);

    return (new Illuminate\Http\Response(null, 201));
});
