<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Emp;
use App\Models\Product;

class PromotionControl extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'id'
        ,'employee_id'
        ,'promotion_id'
        ,'qty'
    ];

    protected function emp(){
        return $this->hasOne(Emp::class,'id','employee_id');
    }

    protected function product(){
        return $this->hasOne(Product::class,'id','promotion_id');
    }
}
