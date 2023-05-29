<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    use HasFactory;
    protected $fillable = ['employer_id','date','amount','reason','user_id'];

    public function Employer(){
        return $this->belongsTo(Employer::class);
    }

    public function User(){
        return $this->belongsTo(User::class);
    }
}
