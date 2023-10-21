<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


Class ProductsModel extends Model {
    public $table = 'products';
    public $fillable = [
        'nome',
        'preco',
        'foto'
    ];
}
