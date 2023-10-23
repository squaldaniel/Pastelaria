<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

Class RequestsModel extends Model {
    use SoftDeletes;
    public $table = 'requests';
    public $fillable = [
        'cod_client',
        'cod_product',
        'total',
        'dt_request'
    ];
    protected $hidden = [
        'updated_at',
        'created_at',
        'deleted_at'
    ];
    protected $dates = ['deleted_at'];
    public function clients()
        {
            return $this->hasOne(ClientsModel::class, 'id')
                ->where('clients.deleted_at', null);
        }
    public function products()
        {
            return $this->hasMany(RequestsItemsModel::class, 'request_id')
                    ->with('products')
                    ->where('request_items.deleted_at', null);
        }
}
