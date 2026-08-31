<?php

namespace App\Http\Controllers;

use App\Models\BudgetProduct;
use App\Models\BudgetPurchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BudgetTrackerController extends Controller
{
    /**
     * Display all available budget products.
     */
    public function index()
    {
        $products = BudgetProduct::where('active', true)
            ->orderBy('id')
            ->get();

        return view('budget-tracker.index', compact('products'));
    }

    /**
     * Display the PDF preview.
     */
    public function preview(BudgetProduct $product)
    {
        abort_unless($product->active, 404);

        $path = $product->preview_file;

        if (!Storage::disk('public')->exists($path)) {
            abort(404, 'Preview not found.');
        }

        return response()->file(
            Storage::disk('public')->path($path)
        );
    }

    /**
     * Download the purchased Excel file.
     */
    public function download(BudgetPurchase $purchase)
    {
        if ($purchase->status !== 'paid') {
            abort(403, 'Payment required before downloading this file.');
        }

        $file = $purchase->product->excel_file;

        if (!Storage::disk('local')->exists($file)) {
            abort(404, 'Excel file not found.');
        }

        return Storage::disk('local')->download(
            $file,
            $purchase->product->name . '.xlsx'
        );
    }
}