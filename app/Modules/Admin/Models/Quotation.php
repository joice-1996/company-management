<?php

namespace App\Modules\Admin\Models;
use App\Modules\Admin\Models\Product as Product;
use App\Modules\Client\Models\Client as Client;
use App\Modules\Admin\Models\ClientproductCart as ClientproductCart;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
  

    protected $table='quotations';
    protected $fillable = [
        'id', 'client_id','product_id','quotation_amount','quotation_no','user_id','status','created_at','updated_at',
    ];



    public function clients()
    {
        return $this->belongsTo('App\Modules\Client\Models\Client','client_id');
    }

    public function products()
    {
        return $this->belongsTo('App\Modules\Admin\Models\Product','product_id','id');
    }


    public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }







}











