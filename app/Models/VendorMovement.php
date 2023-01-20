<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorMovement extends Model
{
    use HasFactory;

    protected $fillable = ['vendor_id','paid','credit','debit','date','invoice_type','invoice_id',
        'invoice_no','paid_by'];
}
