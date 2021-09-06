<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Product;

class OrderDetail extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'orders_detail';
    protected $fillable = [
        'id'
        ,'order_id'
        ,'products_id'
        ,'qty'
    ];
    
    protected function product(){
        return $this->hasOne(Product::class,'id','products_id');
    }
}
