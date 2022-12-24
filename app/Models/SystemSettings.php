<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemSettings extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_name', //
        'currency_id', //
        'email', //
        'client_group_id',//
        'nom_of_days_to_edit_bill',//
        'branch_id',//
        'cashier_id',//
        'item_tax',//
        'item_expired',//
        'img_width',//
        'img_height',//
        'small_img_width',//
        'small_img_height',//
        'barcode_break',//
        'sell_without_stock',//
        'customize_refNumber',//
        'item_serial',//
        'adding_item_method',//
        'payment_method',//
        'sales_prefix',//
        'sales_return_prefix',//
        'payment_prefix',//
        'purchase_payment_prefix',//
        'deliver_prefix',//
        'purchase_prefix',//
        'purchase_return_prefix',//
        'transaction_prefix',//
        'expenses_prefix',//
        'store_prefix',//
        'quotation_prefix',//
        'update_qnt_prefix',//
        'fraction_number',//
        'qnt_decimal_point',//
        'decimal_type',//
        'thousand_type',//
        'show_currency',//
        'currency_label',//
        'a4_decimal_point',//
        'barcode_type',//
        'barcode_length',//
        'flag_character',//
        'barcode_start',//
        'code_length',//
        'weight_start',//
        'weight_length',//
        'weight_divider',//
        'email_protocol',//
        'email_host',//
        'email_user',//
        'email_password',//
        'email_port',//
        'email_encrypt',//
        'email_path',//
        'client_value',
        'client_points',
        'employee_value',
        'employee_points',
        'is_tobacco',
        'tobacco_tax',


    ];
}
