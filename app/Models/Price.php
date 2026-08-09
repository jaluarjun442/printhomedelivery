<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Price extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    public $table = 'price';
    public function parentPrice()
    {
        return $this->belongsTo(Price::class, 'parent_price_id');
    }

    public function childPrice()
    {
        return $this->hasMany(Price::class, 'parent_price_id');
    }
}
