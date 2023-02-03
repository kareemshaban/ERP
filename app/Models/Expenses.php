<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'date',
        'bill_number',
        'expenses_category',
        'warehouse_id',
        'amount',
        'payment_type',
        'notes',
        'user_created'
    ];

}
