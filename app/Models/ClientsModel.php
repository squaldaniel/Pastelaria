<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

Class ClientsModel extends Model {
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
