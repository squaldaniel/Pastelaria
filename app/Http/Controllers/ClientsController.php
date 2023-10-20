<?php
/**
 * @autor: Daniels J Santos
 * @copyright : Daniels J Santos <daniel.santos.ap@gmail.com>
 * @package : ClientsController
 * @version : 0.1
 * Description: Recebe as requisições do grupo de rotas client
 *  e trata conforme endpoint
 */
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\ClientsModel;

    Class ClientsController extends Controller
    {
        /**
         * @param Json Request
         * return new registered Client
         */
        public function store(Request $request)
            {

                return ClientsModel::create($request->all());
            }
        /**
         * @param null
         * return all registers
         */
        public function list()
            {
                return ClientsModel::where('deleted_at','=', null)
                        ->get()->toArray();
            }
        public static function show(int $id)
            {
                $ObjResponse = ClientsModel::where("id", $id)
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
                $request = ClientsModel::where("id", $id)
                    ->where('deleted_at', null)->get()->toArray();
                if (count($request) > 0){
                    ClientsModel::where("id", $id)->update([
                        "deleted_at" => date("Y-m-d H:i:s")
                    ]);
                    return response(json_encode([
                        'message'=> 'resorce id: '.$id. " deleted sucessfully!",
                        'status'=> 200]), 200);
                } else {
                    return response(json_encode([
                        'message'=>'resource or item not found',
                        'status'=> 404]), 404);
                };
            }
        public static function update(int $id)
            {
                $request = json_decode(file_get_contents('php://input'));
                $ObjResponse = ClientsModel::where("id", $id)
                    ->where('deleted_at', null)->get()->toArray();
                if(count($ObjResponse) > 0){
                    $request = json_decode(file_get_contents('php://input'), true);
                    ClientsModel::where("id", $id)
                        ->where('deleted_at', null)
                        ->update($request);
                    return ClientsModel::where("id", $id)
                        ->where('deleted_at', null)->get()->toArray();
                } else {
                    return response(
                    json_encode(
                        ["message"=>'resource or item not found',
                        'status'=> '404']),404 );
            }
        }
    }
