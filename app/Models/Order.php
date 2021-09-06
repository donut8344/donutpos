<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\EnterpriseEnterprise;
use App\Models\Emp;
use App\Models\PaymentType;

class Order extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'id'
        ,'invoice_no'
        ,'enterprise_id'
        ,'employee_id'
        ,'total_price'
        ,'tax'
        ,'vat'
        ,'consumers_id'
        ,'payment_type_id'
        ,'promotion_id'
    ];
    
    protected function payment_type(){
        return $this->hasOne(PaymentType::class,'id','payment_type_id');
    }

    protected function emp(){
        return $this->hasOne(Emp::class,'id','employee_id');
    }

    protected function enterprise(){
        return $this->hasOne(Enterprise::class,'id','enterprise_id');
    }
    
}
