<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\RequestsItemsModel;

Class RequestsModel extends Model {
    public $table = 'requests';
    public $fillable = [
        'cod_client',
        'cod_product',
        'total',
        'dt_request'
    ];
    public function clients()
        {
            return $this->hasOne(ClientsModel::class, 'id')->where('clients.deleted_at', null);
        }
    public function products()
        {
            return $this->hasMany(RequestsItemsModel::class, 'products')
            //->with('products')
            ;
        }
}
