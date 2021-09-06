<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Enterprise;
use App\Models\ProductGroup;

class Product extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    // protected $table = 'employee';
    protected $fillable = [
        'id'
        ,'enterprise_id'
        ,'product_group_id'
        ,'code'
        ,'name'
        ,'description'
        ,'size'
        ,'price'
    ];

    protected function enterprise(){
        return $this->hasOne(Enterprise::class,'id','enterprise_id');
    }

    protected function product_group(){
        return $this->hasOne(ProductGroup::class,'id','product_group_id');
    }
}
