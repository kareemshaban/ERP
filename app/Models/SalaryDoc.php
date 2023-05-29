<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryDoc extends Model
{
    use HasFactory;
    protected $fillable = ['notes','date'];
}
