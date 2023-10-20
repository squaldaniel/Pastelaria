<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientsModel;
/**
 * @autor: Daniels J Santos
 * @copyright : Daniels J Santos <daniel.santos.ap@gmail.com>
 * @package : ClientsController
 * @version : 0.1
 * Description: Recebe as requisições do grupo de rotas client
 *  e trata conforme endpoint
 */
Class ClientsController extends Controller
{
    /**
     * finalizadas
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
        return ClientsModel::all();
    }
    public static function show(int $id)
    {
        return ClientsModel::find($id);
    }


    public static function delete(int $id)
    {
        return ClientsModel::find($id)->softDeletes();
        //return print_r(get_class_methods(ClientsModel::class));
    }
    public function update(int $id, array $collumns)
    {

    }
}
