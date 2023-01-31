<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountsTree extends Model
{
    use HasFactory;
    protected $fillable = ['code','name','type','parent_id','parent_code','level','list','department','side'];
}
