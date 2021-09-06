<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\EnterpriseEnterprise;

class Promotions extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'id'
        ,'enterprise_id'
        ,'code'
        ,'desc'
        ,'status'
    ];
    
    protected function enterprise(){
        return $this->hasOne(Enterprise::class,'id','enterprise_id');
    }
}
