<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    public $table = 'products';

    // public function category(){
    //     return $this->hasOne(Category::class, 'id', 'category_id');
    // }
    public function products_images(){
        return $this->hasMany(ProductsImages::class, 'product_id', 'id');
    }
    public function products_attributes(){
        return $this->hasMany(ProductsAttributes::class, 'product_id', 'id');
    }
    public function categories(){
        return $this->hasMany(ProductsCategories::class, 'product_id', 'id');
    }
}
