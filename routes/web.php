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
use \App\Session;
use \Illuminate\Http\Request;

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
    
    return view('site', ['view' => 'cadastro']);
});

$app->get('/login', function () use ($app) {
    return view('site', ['view' => 'login']);
});

$app->post('/login', function (Request $request) use ($app) {
    $usuario = Usuario::where('email', '=', $request->input('email'))->first();
    
    if($usuario && $usuario->senha == $request->input('senha')){
        Session::logarUsuario($usuario);
        return redirect('admin/dashboard');
    }
    
    return view('site', ['view' => 'login']);
});

$app->get('/admin/dashboard', function () use ($app) {
    return view('admin', ['view' => 'dashboard', 'usuario' => Session::obterUsuario()]);
});
