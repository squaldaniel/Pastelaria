<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use illuminate\Database\Eloquent\SoftDeletes;

Class ProductsModel extends Model {
  //  use SoftDeletes;
    public $table = 'products';
    public $fillable = [
        'nome',
        'preco',
        'foto'
    ];
}
