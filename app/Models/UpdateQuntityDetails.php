<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpdateQuntityDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'identifier',
        'update_qnt_id',
        'item_id',
        'type',
            'qnt',
        'notes',
    ];
}
