<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use illuminate\Database\Eloquent\SoftDeletes;

Class ClientsModel extends Model {
  //  use SoftDeletes;
    public $table = 'clients';
    public $fillable = [
        'nome',
        'email',
        'telefone',
        'nascimento',
        'endereco',
        'complemento',
        'bairro',
        'cep'
    ];
}
