<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\RequestsModel;
    use App\Models\RequestsItemsModel;
    use App\Models\ProductsModel;
    use App\Models\ClientsModel;
    use Illuminate\Support\Facades\Mail;

    /**
     * @autor: Daniels J Santos
     * @copyright : Daniels J Santos <daniel.santos.ap@gmail.com>
     * @package : RequestController
     * @version : 0.1
     * Description: Recebe as requisições do grupo de rotas orders
     *  e trata conforme endpoint
     */
    Class RequestsController extends Controller
        {
            /**
             * @param josn request
             * @return new Order registered
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
                    $this->createOrder($order->id, $items_order);
                    // adding item values
                    $order->total = $this->sumTotal($items_order);
                    // save order
                    $order->save();
                    // sending order
                    $this->sendMail($client_id, $items_order);
                    return $order;
                }
            /**
             * @param $orderID
             * @return refered Order
             */
            public static function show(int $id)
                {
                    $order = RequestsModel::where("id", $id)
                            ->with('clients')->with('products')
                            ->get()->toArray();
                    if(count($order) > 0){
                        return $order;
                        } else {
                            return response(
                                json_encode([
                                    "message"=>'resource or item not found',
                                    'status'=> '404']), 404);
                        }
                }
            /**
             * @param $orderID
             * @return status code
             */
            public static function delete(int $id)
                {
                    $request = RequestsModel::where("id", $id)->get()->toArray();
                    if (count($request) > 0){
                        RequestsModel::where("id", $id)->delete();
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
             * @param $orderID
             * @return staus code or Order updated
             */
            public static function update($id)
                {
                    (new Controller)->validate(app('request'), [
                        "cod_order" => 'required',
                        "cod_client" => 'required',
                        "products" => 'required|array'
                    ]);
                    $order = RequestsModel::where("id", $id)->get()->toArray();
                    if (count($order) > 0){
                            $request = json_decode(file_get_contents('php://input'));
                            // deleteting old products
                            RequestsItemsModel::where('request_id', $request->cod_order)
                                        ->delete();
                            // add new pproducts
                            foreach ($request->products as $key => $product){
                                RequestsItemsModel::create([
                                    'request_id' => $request->cod_order,
                                    'products_id' => $product
                                    ]);
                                }
                            $updatedOrder = RequestsModel::find($id);
                            // recalculate order
                            $updatedOrder->total = (new RequestsController)->sumTotal($request->products);
                            // update value
                            $updatedOrder->save();
                            return $updatedOrder;
                        } else {
                            return response(json_encode(
                                    ["message"=>'resource or item not found',
                                    'status'=> '404']),404);
                            }
                }
            /**
             * @param null
             * return all registers active
             */
            public function list()
                {
                    return RequestsModel::where('requests.deleted_at', null)
                            ->with('clients')->with('products')
                            ->get()->toJson();
                }
            /**
             * @param array $tems : array with ids of products
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
            /**
             * @param orderId number of order
             * @param array with products id
             * @return void
             */
            public function createOrder($orderId, array $itemsIds)
                {
                    foreach($itemsIds as $key=>$item){
                        RequestsItemsModel::create([
                            'products_id'=> $item,
                            'request_id' => $orderId
                            ]);
                    }
                }
            /**
             * @param ClientId id of client
             * @param requestId number of request
             */
            public function sendMail($clientID, $orderIds)
                {
                    $client = ClientsModel::find($clientID);
                    //getting client email
                    $clientMail = $client->email;
                    $products = [];
                    $text  =" - - PEDIDO - - \n";
                    foreach ($orderIds as $key=>$id)
                        {
                            $item = ProductsModel::where('id', $id)
                            ->select('nome', 'preco')->get();
                            $text .= ' '.$item[0]->nome .' - R$ '.$item[0]->preco. "\n";
                            array_push($products, $item);
                        }
                    $text .= "\nNo total de R$ ".$this->sumTotal($orderIds);
                    Mail::raw("Segue os items do seu pedido\n\n ".$text, function ($message) use ($clientMail){
                        $message->to($clientMail)
                        ->subject('Seu pedido foi recebido - Pastelaria Dona Massa');
                    });
                }
        }
