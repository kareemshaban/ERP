<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpensesCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'account_id'
    ];

    public function account(){
        return $this -> belongsTo(AccountsTree::class , 'account_id');
    }
}
