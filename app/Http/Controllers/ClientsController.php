<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientsModel;

Class ClientsController extends Controller
{
    public function tables()
    {
        //return ClientsModel::tables();
        return ClientsModel::all();
    }
    public function store(Request $request)
    {
        return ClientsModel::create($request->all());
    }
}
