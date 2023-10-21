<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

Class RequestsModel extends Model {
    public $table = 'requests';
    public $fillable = [
        'cod_client',
        'cod_product',
        'total',
        'dt_request'
    ];
}
