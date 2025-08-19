<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'merchant_request_id','checkout_request_id','result_code','result_desc',
        'amount','mpesa_receipt_number','phone','transaction_date','raw_payload'
    ];

    protected $casts = [
        'raw_payload' => 'array',
    ];
}
