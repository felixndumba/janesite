<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetPurchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'budget_product_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'amount',
        'checkout_request_id',
        'merchant_request_id',
        'mpesa_receipt',
        'status',
        'paid_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'paid_at' => 'datetime',
    ];

    public function product()
    {
        return $this->belongsTo(
            BudgetProduct::class,
            'budget_product_id'
        );
    }
}