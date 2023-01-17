<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'purchase_id',
        'product_code',
        'product_id',
        'quantity',
        'cost_without_tax',
        'cost_with_tax',
        'warehouse_id',
        'unit_id',
        'tax',
        'total',
        'net',
        'returned_qnt'
    ];
}
