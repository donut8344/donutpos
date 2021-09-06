<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleWarehouse extends Model
{
    use HasFactory;
    protected $table = 'sales_warehouse';
    protected $fillable = [
        'id'
        ,'enterprise_id'
        ,'product_id'
        ,'qty'
        ,'year'
    ];
}
