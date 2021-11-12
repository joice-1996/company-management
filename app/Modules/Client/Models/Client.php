<?php

namespace App\Modules\Client\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table='clients';
    protected $fillable = [
        'id', 'company_name','contact_person','email','address','company_logo','user_id','created_at','updated_at',
    ];

    public function users()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function company_branches()
    {
        return $this->hasMany('App\Modules\Client\Models\CompanyBranch','client_id','id');
    }
    public function company_contacts()
    {
        return $this->hasMany('App\Modules\Client\Models\CompanyContact','client_id','id');
    }
    public function carts()
    {
        return $this->hasMany('App\Modules\Client\Models\ClientProductCart','client_id','id');
    }
    public function quotations()
    {
        return $this->hasMany('App\Modules\Admin\Models\Quotation','client_id','id');
    }
    public function company_phones()
    {
        return $this->hasMany("App\Modules\Client\Models\CompanyContact",'client_id','id');
    }
    public function company_cart_products()
    {
        return $this->hasMany("App\Modules\Client\Models\ClientProductCart",'client_id','id');
    }
    public function consultant()
    {
        return $this->belongsTo("App\User",'user_id','id');
    }
    
}
