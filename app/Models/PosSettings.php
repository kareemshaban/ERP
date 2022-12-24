<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosSettings extends Model
{
    use HasFactory;

    protected $fillable = [
        'show_items', //
        'default_category', //
        'cashier_id', //
        'client_id',//
        'show_time',//
        'item_search',//
        'add_new_item',//
        'insert_client',//
        'add_client',//
        'category_toggle',//
        'subCategory_toggle',//
        'brand_toggle',//
        'cancel_sell',//
        'pend_sell',//
        'printed_material',//
        'finish_bill',//
        'daily_sales',//
        'opening_pending_sales',//
        'close_shift',//
        'qr_print',//
        'header_print',//
        'header_img',//
        'seller_buyer'
        ];
}
