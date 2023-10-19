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
    public function tables()
    {
        return ClientsModel::all();
    }
    public function store(Request $request)
    {
        return ClientsModel::create($request->all());
    }
    public function delete(Request $request)
    {

    }
    public function update(Request $request)
    {

    }
    public static function show(int $id)
    {
        return ClientsModel::find($id);
    }
    /**
     * @param null
     * return all registers
     */
    public function list()
    {
        return ClientsModel::all();
    }
}
