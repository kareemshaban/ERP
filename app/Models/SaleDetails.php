<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetails extends Model
{
    use HasFactory;

    protected $fillable = ['sale_id','product_code','product_id','quantity','price_without_tax',
        'price_with_tax','warehouse_id','unit_id','tax','total','profit','lista'];
}
