<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = ['date','purchase_id','sale_id','company_id','amount','paid_by','remain',
        'user_id'];

    public function user(){
        return $this -> belongsTo(User::class , 'user_id');
    }
}
