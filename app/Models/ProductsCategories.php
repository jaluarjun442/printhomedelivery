<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductsCategories extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    public $table = 'products_categories';

    public function products(){
        return $this->hasOne(Products::class, 'id', 'product_id');
    }
    public function category(){
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
  
}
