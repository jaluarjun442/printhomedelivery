<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PrintDocument extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    public $table = 'print_documents';

}
