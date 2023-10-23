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
         * @param null
         * @return list all active clients
         */
        public function list()
            {
                return ClientsModel::all();
            }
        /**
         * @param Json Request
         * return new registered Client
         */
        public function store(Request $request)
            {
                $this->validate($request, [
                        "nome" => 'required|string',
                        "email" => 'required|email',
                        "telefone" => 'required|numeric',
                        "nascimento" => 'required|date',
                        "endereco" => 'required|string',
                        "complemento" => 'required|string',
                        "bairro" => 'required|string',
                        "cep" => 'required'
                    ]);
                return ClientsModel::create($request->all());
            }
        /**
         * @param $clientId
         * @return Refered client
         */
        public static function show(int $id)
            {
                $ObjResponse = ClientsModel::where("id", $id)->get()->toArray();
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
         * @param $clientId
         * @return status code
         */
        public static function delete(int $id)
            {
                $request = ClientsModel::where("id", $id)->get()->toArray();
                if (count($request) > 0){
                    ClientsModel::where("id", $id)->delete();
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
         * @param $clientId
         * @return updated register
         */
        public static function update(int $id)
            {
                (new ClientsController)->validate(app('request'), [
                        "nome" =>'required',
                        "email" =>'required',
                        "telefone" =>'required',
                        "nascimento" =>'required',
                        "endereco" =>'required',
                        "complemento" =>'required',
                        "bairro" =>'required',
                        "cep" =>'required'
                    ]);
                $client = ClientsModel::where("id", $id)->get()->toArray();
                if(count($client) > 0){
                    $request = json_decode(file_get_contents('php://input'), true);
                    ClientsModel::where("id", $id)->update($request);
                    return ClientsModel::where("id", $id)->get()->toArray();
                } else {
                    return response(
                    json_encode(
                        ["message"=>'resource or item not found',
                        'status'=> '404']),404 );
            }
        }
    }
