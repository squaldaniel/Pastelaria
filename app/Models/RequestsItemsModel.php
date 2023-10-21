<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

Class RequestsItemsModel extends Model {
    public $table = 'request_items';
    public $fillable = [
        'products_id',
        'request_id'
    ];
    public function products()
        {
            return $this->hasOneThrough(ProductsModel::class, 'id')
            //->withPivot('request_items')
            ;
        }
}
