<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

Class ClientsModel extends Model {
    use SoftDeletes;
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
    protected $hidden = [
        'updated_at',
        'created_at',
        'deleted_at'
    ];
    protected $dates = ['deleted_at'];
}
