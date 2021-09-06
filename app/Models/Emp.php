<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\EmpType;
use App\Models\Enterprise;
use App\Models\User;


class Emp extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'employee';
    protected $fillable = [
        'id'
        ,'fname'
        ,'lname'
        ,'address'
        ,'phone'
        ,'employee_type_id'
        ,'enterprise_id'
        ,'user_id'
    ];
    
    protected function emp_type(){
        return $this->hasOne(EmpType::class,'id','employee_type_id');
    }
    
    protected function enterprise(){
        return $this->hasOne(Enterprise::class,'id','enterprise_id');
    }

    protected function user(){
        return $this->hasOne(User::class,'id','user_id');
    }


}
