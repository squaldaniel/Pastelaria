<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\RequestsModel;
    use App\Models\RequestsItemsModel;
    use App\Models\ProductsModel;

    /**
     * @autor: Daniels J Santos
     * @copyright : Daniels J Santos <daniel.santos.ap@gmail.com>
     * @package : ProductsController
     * @version : 0.1
     * Description: Recebe as requisições do grupo de rotas products
     *  e trata conforme endpoint
     */
    Class RequestsController extends Controller
        {
            /**
             * @param null
             */
            public function store(Request $request)
                {
                    //validate fields
                    $this->validate($request, [
                        'products'=> 'required|array',
                        'cod_client'=>'required|integer'
                    ]);
                    $client_id = $request->post('cod_client');
                    $items_order = $request->post('products');
                    $order = RequestsModel::create([
                        'cod_client'=>$client_id
                        ]);
                    foreach($items_order as $key=>$item){
                        RequestsItemsModel::create([
                            'products_id'=> $item,
                            'request_id' => $order->id
                            ]);
                    }
                    $order->total = $this->sumTotal($items_order);
                    $order->save();
                    return $order;
                }
            public static function show(int $id)
                {
                    $ObjResponse = ProductsModel::where("id", $id)
                    ->where('deleted_at', null)->get()->toArray();
                    if(count($ObjResponse) > 0){
                        return $ObjResponse;
                        } else {
                            return response(
                                json_encode([
                                    "message"=>'resource or item not found',
                                    'status'=> '404']), 404);
                        }
                }
            public static function delete(int $id)
                {
                    $request = ProductsModel::where("id", $id)
                            ->where('deleted_at', null)->get()->toArray();
                    if (count($request) > 0){
                        return  'XX';
                    }

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
                            json_encode(
                                ["message"=>'resource or item not found',
                                'status'=> '404']),
                            404
                            );
                    }
                }
            /**
             * @param null
             * return all registers
             */
            public function list()
                {
                    return RequestsModel::where('requests.deleted_at', null)
                            ->with('clients')->with('products')
                            ->get()->toJson();
                }
            /**
             * @param array $tems : array com ids dos products
             * @return decimal number
             */
            public function sumTotal(Array $items)
                {
                    $total = 0;
                    foreach($items as $key=>$item){
                        $price = json_decode(ProductsModel::select('preco')
                                ->where('id', $item)->pluck('preco'), true);
                        $total += $price[0];
                        }
                    return $total;
                }
        }
