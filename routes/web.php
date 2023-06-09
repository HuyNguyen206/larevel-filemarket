<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::post('webhook/stripe', \App\Http\Controllers\StripeWebhookController::class);
Route::domain('{user:subdomain}'.config('app.subdomain'))->name('subdomain.')->group(function () {
    Route::prefix('products')->name('products.')->group(function (){
        Route::get('', [\App\Http\Controllers\Subdomain\SubdomainHomeController::class, 'index'])->name('index');
        Route::get('{product:slug}', [\App\Http\Controllers\Subdomain\SubdomainHomeController::class, 'show'])->name('show');
//       ->withoutScopedBindings();
        Route::post('{product:slug}/checkout', [\App\Http\Controllers\Subdomain\SubdomainHomeController::class, 'checkout'])->name('checkout');
        Route::get("/{product:slug}/checkout/success", [\App\Http\Controllers\Subdomain\SubdomainHomeController::class, 'checkoutSuccess'])->name('checkout.success');
    });
});

Route::get('material/{sale}', [\App\Http\Controllers\Subdomain\SubdomainHomeController::class, 'showMaterial'])->name('material');
Route::get('material/download/{file:id}', [\App\Http\Controllers\Subdomain\SubdomainHomeController::class, 'downloadMaterial'])->name('material.download');

Route::get('', \App\Http\Controllers\HomeController::class)->middleware('auth');
Route::get('onboard', [\App\Http\Controllers\OnboardingStripeController::class, 'index'])
    ->middleware('auth', \App\Http\Middleware\RedirectIfStripeAccountEnableAlready::class)->name('onboard');
Route::get('onboard/redirect', [\App\Http\Controllers\OnboardingStripeController::class, 'redirect'])->middleware('auth')->name('onboard.redirect');
Route::get('onboard/verify', [\App\Http\Controllers\OnboardingStripeController::class, 'verify'])->middleware('auth')->name('onboard.verify');





Route::middleware('auth')->group(function () {
    Route::middleware(\App\Http\Middleware\RedirectIfNotEnableStripe::class)->group(function (){
        Route::get('/dashboard', \App\Http\Controllers\DashboardController::class)->middleware(['verified'])->name('dashboard');
        Route::get('products', [\App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
        Route::get('products/create', [\App\Http\Controllers\ProductController::class, 'create'])->name('products.create');
        Route::get('products/{product:slug}/edit', [\App\Http\Controllers\ProductController::class, 'edit'])->name('products.edit');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
