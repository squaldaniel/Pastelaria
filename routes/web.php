<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', function () use ($router) {
    //return $router->app->version();
    return view('swagger.index');
});
$router->get('teste', function (){
$dados = [
    'nome'=>'daniel',
    'email'=>'daniel2@mail.com',
    'telefone'=>'11953610254',
    'nascimento'=>'1981-01-05',
    'endereco'=>'Rua da fortuna, 413',
    'complemento'=>'Sobrado',
    'bairro'=>'Macedo',
    'cep' => '07197100'
];
    return \ClientsModel::create($dados);
});
$router->get('pastel', 'ClientsController@tables');
$router->group(['prefix'=>'clients'], function() use ($router){
    /**
     * finalizadas
     */
    $router->get('list', 'ClientsController@list');
    $router->post('create', 'ClientsController@store');
    $router->get(
        'id/{id}',
        fn($id) => App\Http\Controllers\ClientsController::show($id));
    /**
     * trabalhando
     */
    $router->get(
        'clients/delete/',
        fn($id) => App\Http\Controllers\ClientsController::show($id));

});
