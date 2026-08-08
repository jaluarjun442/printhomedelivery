<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductsImages extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    public $table = 'products_images';

    public function products(){
        return $this->hasOne(Products::class, 'id', 'product_id');
    }
  
}
