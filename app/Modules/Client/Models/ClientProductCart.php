<?php

namespace App\Modules\Client\Models;
use App\Modules\Client\Models\Client as Client;
use Illuminate\Database\Eloquent\Model;

class ClientProductCart extends Model
{
    protected $table='client_product_carts';
    protected $fillable = [
        'id', 'client_id','product_id','start_date','expiry_date',
        'no_of_license','customization_description',
        'customization_amount','license_amount','platform_charge',
        'status','created_at','updated_at',
    ];

    // public function clients()
    // {
    //     return $this->belongsTo('App\Modules\Client\Models\Client','client_id');
    // }

    
    public function products()
    {
        return $this->belongsTo('App\Modules\Admin\Models\Product','product_id','id');
    }



    
}
