<?php

/** @var \Laravel\Lumen\Routing\Router $router */
use App\Models\ProductsModel;
use Illuminate\Support\Facades\Mail;

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
    'nome'=>'pastel de carne',
    'preco'=>'5.50',
    'foto'=>'img001.jpg'
];
    return ProductsModel::create($dados);
});
$router->get('pastel', 'ClientsController@tables');
// Clients routes
$router->group(['prefix'=>'clients'], function() use ($router){
    // List all
    $router->get('list', 'ClientsController@list');
    // Create new
    $router->post('create', 'ClientsController@store');
    // Show by id
    $router->get('id/{id}',
            fn($id) => App\Http\Controllers\ClientsController::show($id));
    $router->delete(
        'delete/{id}',
        fn($id) => App\Http\Controllers\ClientsController::delete($id));
    $router->put(
            'update/{id}',
            fn($id) => App\Http\Controllers\ClientsController::update($id));
});
// products routes
$router->group(['prefix'=>'products'], function() use ($router){
    $router->post('create', 'ProductsController@store');
    $router->get('list', 'ProductsController@list');
    $router->get(
        'id/{id}',
        fn($id) => App\Http\Controllers\ProductsController::show($id));
    $router->delete(
        'delete/{id}',
        fn($id) => App\Http\Controllers\ProductsController::delete($id));
    $router->put(
        'update/{id}',
        fn($id) => App\Http\Controllers\ProductsController::update($id));

});

$router->get('mail', function(){
    $mail = Mail::raw('Hello, welcome to Laravel!', function ($message) {
        $message
          ->to('daniel.santos.ap@gmail.com')
          ->subject('teste envio pastelaria');
      });
      if ($mail == true){
        return 'mail sended';
      }
});
