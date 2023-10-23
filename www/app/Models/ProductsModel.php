<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


Class ProductsModel extends Model {
    use SoftDeletes;
    public $table = 'products';
    public $fillable = [
        'nome',
        'preco',
        'foto'
    ];
    protected $hidden = [
        'updated_at',
        'created_at',
        'deleted_at'
    ];
    protected $dates = ['deleted_at'];
    public function products()
        {
            return $this->belongsToMany(RequestsItemsModel::class, 'request_item.products');
        }
}
