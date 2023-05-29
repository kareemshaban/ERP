<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;
class Representative extends Model
{
    use HasFactory;
    protected $fillable = [
      'code',
      'name',
      'user_name',
      'password',
      'notes',
      'active'
    ];

    public function clients(){
       return $this -> hasMany(Company::class , 'representative_id_');
    }
}
