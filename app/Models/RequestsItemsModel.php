<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

Class RequestsItemsModel extends Model {
    use SoftDeletes;
    public $table = 'request_items';
    public $fillable = [
        'products_id',
        'request_id'
    ];
    protected $hidden = [
        'updated_at',
        'created_at',
        'deleted_at'
    ];
    protected $dates = ['deleted_at'];
    public function products()
        {
            return $this->belongsTo(ProductsModel::class);
        }
}
