<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountSetting extends Model
{
    use HasFactory;
    protected $fillable = ['warehouse_id','safe_account','sales_account','purchase_account','return_sales_account','return_purchase_account',
        'stock_account','sales_discount_account','sales_tax_account','purchase_discount_account',
        'purchase_tax_account','cost_account','profit_account','reverse_profit_account'];
}
