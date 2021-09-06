<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Enterprise;

class ProductGroup extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    // protected $table = 'employee';
    protected $fillable = [
        'id'
        ,'enterprise_id'
        ,'name'
    ];

    protected function enterprise(){
        return $this->hasOne(Enterprise::class,'id','enterprise_id');
    }
}
