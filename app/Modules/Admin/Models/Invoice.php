<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table='invoices';
    protected $fillable = [
        'id', 'product_id','client_id','quotation_amount','quotation_no','payment','created'
    ];

    public function clients()
    {
        return $this->belongsTo('App\Modules\Client\Models\Client','client_id');
    }

    public function products()
    {
        return $this->belongsTo('App\Modules\Admin\Models\Product','product_id','id');
    }
}
