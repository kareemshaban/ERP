<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;

    //salary => hours count
    //additional_salary => hour amount
    protected $fillable=['name','phone','address','employer_category_id','salary','additional_salary'];

    public function Category(){
        return $this->belongsTo(EmployerCategory::class,'employer_category_id','id');
    }
}
