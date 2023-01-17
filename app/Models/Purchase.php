<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'invoice_no',
        'customer_id',
        'biller_id',
        'warehouse_id',
        'note',
        'total',
        'discount',
        'tax',
        'net',
        'paid',
        'purchase_status',
         'payment_status',
         'created_by',
        'returned_bill_id'
    ];
}
