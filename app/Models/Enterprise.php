<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Enterprise extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'enterprise';
    protected $fillable = [
        'id'
        ,'name'
        ,'address'
        ,'phone'
        ,'product_code_length'
        ,'enterprise_code'
        ,'create_by_user'
    ];
}
