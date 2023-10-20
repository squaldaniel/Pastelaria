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
     * @param null
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
        return ProductsModel::find($id);
    }
    public static function delete(int $id)
    {
        return ProductsModel::where("id", $id)->update([
            "deleted_at" => date("Y-m-d H:i:s")
        ]);
    }
    public static function update(int $id)
    {
        $request = json_decode(file_get_contents('php://input'));
        $ObjResponse = ProductsModel::where("id", $id)
        ->where('deleted_at', null)->get()->toArray();
        if(count($ObjResponse) > 0){
            $request = json_decode(file_get_contents('php://input'), true);
            ProductsModel::where("id", $id)
                    ->where('deleted_at', null)
                    ->update($request);
            return ProductsModel::where("id", $id)
                    ->where('deleted_at', null)->get()->toArray();
        } else {
            return response(
                json_encode(["message"=>'resource or item not found']),
                 404
                );
        }
    }
}
