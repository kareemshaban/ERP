<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpdateQuntity extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'identifier',
        'bill_date',
        'bill_number',
        'warehouse_id',
        'user_id',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class , 'warehouse_id');
    }
    public function details()
    {
        return $this->hasMany(UpdateQuntityDetails::class , 'identifier');
    }
}
