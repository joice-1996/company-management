<?php

namespace App\Modules\Client\Models;
use App\Modules\Client\Models\Client as Client;
use Illuminate\Database\Eloquent\Model;

class CompanyContact extends Model
{
    protected $table='company_contacts';
    protected $fillable = [
        'id', 'client_id','contact_number','created_at','updated_at',
    ];
    public function clients()
    {
        return $this->belongsTo('App\Modules\Client\Models\Client','client_id');
    }
}
