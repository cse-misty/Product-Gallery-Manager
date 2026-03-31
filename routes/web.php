<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('backend.layouts.mainbody');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::prefix('admin')->group(function () {

        Route::resource('products', ProductController::class);

        Route::delete('products/image/{id}', [ProductController::class, 'imageDelete'])
            ->name('products.image.delete');
    });
});

require __DIR__ . '/auth.php';
