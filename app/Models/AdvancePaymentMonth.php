<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvancePaymentMonth extends Model
{
    use HasFactory;
    protected $fillable = ['advance_payment_id','amount','state','month'];

    public function Payment(){
        return $this->belongsTo(AdvancePayment::class);
    }
}
