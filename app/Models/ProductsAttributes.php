<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductsAttributes extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    public $table = 'products_attributes';

    public function products(){
        return $this->hasOne(Products::class, 'id', 'product_id');
    }
  
}
