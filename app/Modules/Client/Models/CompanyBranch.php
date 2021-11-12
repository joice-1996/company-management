<?php

namespace App\Modules\Client\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Client\Models\Client as Client;
class CompanyBranch extends Model
{
    protected $table='company_branches';
    protected $fillable = [
        'id', 'client_id','branches','created_at','updated_at',
    ];
    public function client()
    {
        return $this->belongsTo('App\Modules\Client\Models\Client','client_id');
    }
}
