<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductsModel;

/**
* @autor: Daniels J Santos
* @copyright : Daniels J Santos <daniel.santos.ap@gmail.com>
* @package : ProductsControlnulller
* @version : 0.1
* Description: Recebe as requisições do grupo de rotas products
*  e trata conforme endpoint
*/
Class ProductsController extends Controller
    {
        /**
         * @param null
         * @return list all active products
         */
        public function list()
            {
                return ProductsModel::all();
            }
        /**
         * @param Json Request
         * return new registered Product
         */
        public function store(Request $request)
            {
                $this->validate($request, [
                    "nome"=>'required|string',
                    "preco"=>'required',
                    "foto"=>'required|string'
                ]);
                return ProductsModel::create($request->all());
            }
        /**
         * @param $productsId
         * @return Refered product
         */
        public static function show(int $id)
            {
                $ObjResponse = ProductsModel::where("id", $id)->get()->toArray();
                if(count($ObjResponse) > 0){
                    return $ObjResponse;
                    } else {
                        return response(
                            json_encode([
                                "message"=>'resource or item not found',
                                'status'=> '404']), 404);
                        }
            }
        /**
         * @param $productId
         * @return status code
         */
        public static function delete(int $id)
            {
                $request = ProductsModel::where("id", $id)->get()->toArray();
                if (count($request) > 0){
                    ProductsModel::where("id", $id)->delete();
                    return response(json_encode([
                        'message'=> 'resorce id: '.$id. " deleted sucessfully!",
                        'status'=> 200]), 200);
                    } else {
                        return response(json_encode([
                            'message'=>'resource or item not found',
                            'status'=> 404]), 404);
                    };
            }
        /**
         * @param $productId
         * @return updated register
         */
        public static function update(int $id)
            {
                (new ProductsController)->validate(app('request'), [
                        "nome"=>'required|string',
                        "preco"=>'required',
                        "foto"=>'required|string'
                    ]);
                $client = ProductsModel::where("id", $id)->get()->toArray();
                if(count($client) > 0){
                        $request = json_decode(file_get_contents('php://input'), true);
                        ProductsModel::where("id", $id)->update($request);
                        return ProductsModel::where("id", $id)->get()->toArray();
                    } else {
                        return response(
                            json_encode(["message"=>'resource or item not found',
                                'status'=> '404']),404 );
                        }
            }
    }
