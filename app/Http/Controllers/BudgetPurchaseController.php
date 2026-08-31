<?php

namespace App\Http\Controllers;

use App\Models\BudgetProduct;
use App\Models\BudgetPurchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BudgetPurchaseController extends Controller
{
    /**
     * Create a pending purchase and initiate M-Pesa payment.
     */
    public function purchase(Request $request)
    {
        $validated = $request->validate([
            'product_id' => [
                'required',
                'integer',
                'exists:budget_products,id',
            ],

            'customer_name' => [
                'required',
                'string',
                'max:255',
            ],

            'customer_email' => [
                'required',
                'email',
                'max:255',
            ],

            'customer_phone' => [
                'required',
                'string',
                'max:20',
            ],
        ]);

        $product = BudgetProduct::where('id', $validated['product_id'])
            ->where('active', true)
            ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | Create pending purchase
        |--------------------------------------------------------------------------
        */

        $purchase = BudgetPurchase::create([
            'budget_product_id' => $product->id,
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_phone' => $validated['customer_phone'],
            'amount' => $product->price,
            'status' => 'pending',
        ]);

        /*
        |--------------------------------------------------------------------------
        | M-Pesa
        |--------------------------------------------------------------------------
        |
        | We will connect this section to your existing MpesaController.
        |
        */

        return response()->json([
            'success' => true,
            'message' => 'Purchase created successfully.',
            'purchase_id' => $purchase->id,
        ]);
    }
}