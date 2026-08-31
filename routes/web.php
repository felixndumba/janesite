<?php
use App\Http\Controllers\BudgetPurchaseController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\BudgetTrackerController;
use App\Http\Controllers\MasterclassController;
use App\Http\Controllers\ProductInquiryController;

Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews');

Route::post('/reviews', [ReviewController::class, 'store']);

Route::get('/', function () {
    $reviews = \App\Models\Review::latest()->get();
    return view('main', compact('reviews'));
});

Route::post('/', function(Request $request) {
    $data = $request->all();
    return response()->json([
        'message' => 'POST received at homepage',
        'data' => $data
    ]);
});


Route::get('/financial-services', function () {
    return view('services'); 
})->name('services');


Route::get('/explore-more', function () {
    return view('contact');
})->name('explore');




Route::get('/master-class', function () {
    return view('master-class');
})->name('master');


Route::get('/service-individual-free', function () {
    return view('partials.financialservices');
})->name('financialservices');


Route::get('/contact', function () {
    return view('contact');
})->name('contact');


Route::get('/financial-products', function () {
    return view('products-1');
})->name('financial-products');


Route::get('/chief-financial-advisor', function () {
    return view('meetjane');
})->name('chief-financial-advisor');

Route::get('/sitemap.xml', function () {
    return response()->view('sitemap')->header('Content-Type', 'text/xml');
});

Route::post('/contact/send', [ContactController::class, 'send'])
    ->name('contact.send');



Route::post('/product.inquiry', [ProductInquiryController::class, 'send'])
    ->name('product.inquiry');

Route::post('/masterclass/save-email', [
    MasterclassController::class,
    'saveLinkRequest'
])->name('masterclass.save-email');

Route::get('/budget-tracker', [
    BudgetTrackerController::class,
    'index'
])->name('budget-tracker');

Route::get('/budget-tracker/preview/{product}', [
    BudgetTrackerController::class,
    'preview'
])->name('budget.preview');

Route::get('/budget-tracker/download/{purchase}', [
    BudgetTrackerController::class,
    'download'
])->name('budget.download');

Route::post('/budget-tracker/purchase', [
    BudgetPurchaseController::class,
    'purchase'
])->name('budget.purchase');