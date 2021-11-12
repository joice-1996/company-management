<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table='products';
    protected $fillable = [
        'id', 'product','description','status','created_at','updated_at',
    ];
}
