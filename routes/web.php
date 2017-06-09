<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

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
    $usuario = Usuario::create($request->input('usuario'));
    $usuario->endereco()->create($request->input('usuario_endereco'));
    $usuario->save();
    
    $empresa = Empresa::create($request->input('empresa'));
    $empresa->endereco()->create($request->input('empresa_endereco'));
    $empresa->save();
    
    $usuario->empresa()->save($empresa);
    
    return redirect('site/login');
});

$app->get('/login', function () use ($app) {
    return view('site', ['view' => 'login']);
});

$app->post('/login', function (Request $request) use ($app) {
    $usuario = Usuario::where('email', '=', $request->input('email'))->first();
    
    if($usuario && $usuario->senha == $request->input('senha')){
        Session::login($usuario);
        return redirect('admin/dashboard');
    }
    
    return view('site', ['view' => 'login']);
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
    $usuario = Session::obterUsuario();
    $usuario->empresa->cpds()->create($request->input('cpd'));
    
    return redirect('admin/dashboard');
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
    $csv = "data;temperatura;humidade\n";
    
    foreach($cpd->leituras as $leitura){
        $horario = date('d/m/Y h:i:s');
        $csv .= "$horario;$leitura->temperatura;$leitura->humidade\n";
    }
    
    file_put_contents('relatorio.csv', $csv);
    
    return response()->download('relatorio.csv');
});

/** Api **/
$app->post('/api/leitura', function (Request $request) use ($app) {    
    $cpd = Cpd::where('numero_serial', '=', $request->input('serial'))->first();

    if(!$cpd){
        return (new Illuminate\Http\Response(null, 404));
    }

    $cpd->leituras()->create([
        'temperatura' => $request->input('temperatura'), 
        'humidade' => $request->input('humidade'), 
        'horario' => date('Y-m-d h:i:s'), 
    ]);

    return (new Illuminate\Http\Response(null, 201));
});