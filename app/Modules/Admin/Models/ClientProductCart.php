<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Admin\Models\Product as Product;
class ClientProductCart extends Model
{
    protected $table='client_product_carts';
    protected $fillable = [
        'id', 'client_id','product_id','start_date','expiry_date',
        'no_of_license','customization_description',
        'customization_amount','license_amount','platform_charge',
        'status','created_at','updated_at',
    ];

    public function products()
    {
        return $this->belongsTo('App\Modules\Admin\Models\Product','product_id');
    }

    public function clients()
    {
        return $this->belongsTo('App\Modules\Client\Models\Client','client_id');
    }

    
}
