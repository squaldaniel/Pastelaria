<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Models\ProductsModel;

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
        return view('swagger.index');
        });
    // Clients routes
    $router->group(['prefix'=>'clients'], function() use ($router){
        // List all
        $router->get('list', 'ClientsController@list');
        // Create new
        $router->post('create', 'ClientsController@store');
        // Show by id
        $router->get('id/{id}',
                fn($id) => App\Http\Controllers\ClientsController::show($id));
        //delete by id
        $router->delete(
            'delete/{id}',
                fn($id) => App\Http\Controllers\ClientsController::delete($id));
        //update by id
        $router->put(
                'update/{id}',
                fn($id) => App\Http\Controllers\ClientsController::update($id));
        });
    // Products routes
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
    // Order routes
    $router->group(['prefix' => 'orders'], function () use ($router){
        // List All Orders
        $router->get('list', 'RequestsController@list');
        // create a new Order
        $router->post('create', 'RequestsController@store');
        // show order by id
        $router->get(
            'id/{id}',
            fn($id) => App\Http\Controllers\RequestsController::show($id));
        // Delete by id
        $router->delete(
            'delete/{id}',
            fn($id) => App\Http\Controllers\RequestsController::delete($id));
        // Update order by id
        $router->put(
            'update/{id}',
            fn($id) => App\Http\Controllers\RequestsController::update($id));
        });
    // Testes
    $router->get('testedados', function(){
        $requestitem = App\Models\RequestsItemsModel::find(1);
        return $requestitem->with('products')->get();
    });
