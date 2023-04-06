<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryDocDetails extends Model
{
    use HasFactory;
    protected $fillable = ['employer_id','hours','hour_value','reward','additional','advance_payment',
        'deductions','salary_doc_id'];
}
