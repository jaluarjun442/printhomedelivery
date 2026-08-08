<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Insta10kFollow extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    public $table = 'insta_10k_follow';
}
