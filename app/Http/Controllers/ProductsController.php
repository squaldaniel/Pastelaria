<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductsModel;

/**
 * @autor: Daniels J Santos
 * @copyright : Daniels J Santos <daniel.santos.ap@gmail.com>
 * @package : ProductsController
 * @version : 0.1
 * Description: Recebe as requisições do grupo de rotas products
 *  e trata conforme endpoint
 */
Class ProductsController extends Controller
{
    /**
     * finalizadas
     */
    public function store(Request $request)
    {
        return ProductsModel::create($request->all());
    }
    /**
     * @param null
     * return all registers
     */
    public function list()
    {
        return ProductsModel::where('deleted_at', null)->get();
    }
    public static function show(int $id)
    {
        //return ::find($id);
    }


    public static function delete(int $id)
    {
        return ProductsModel::where("id", $id)->update([
            "deleted_at" => date("Y-m-d H:i:s")
        ]);
        //return print_r(get_class_methods(ClientsModel::class));
    }
    public function update(int $id, array $collumns)
    {

    }
}
