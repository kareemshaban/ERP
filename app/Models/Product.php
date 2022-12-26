<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
      'code',
      'name',
      'unit',
        'cost',
        'price',
        'lista',
        'alert_quantity',
        'category_id',
        'subcategory_id',
        'quantity',
        'tax_rate',
        'track_quantity',
        'tax_method',
        'type',
        'brand',
        'slug',
        'featured',
        'active',
        'city_tax',
        'max_order',
        'warehouse_id'
    ];
}
