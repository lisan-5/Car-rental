<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
use App\Models\Rental;

Route::get('/', function () {
    return view('home');
})->name('home');


Route::get('/contact', function () {
    return view('contact');
})->name('contact');

use App\Http\Controllers\CartController;
Route::get('/dashboard', function () {
    $user = Auth::user();
    $cars = $user->cars;
    $requests = Rental::whereIn('car_id', $cars->pluck('id'))
        ->with('car')
        ->get();
    return view('dashboard', compact('cars', 'requests'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Car resource
    Route::resource('cars', CarController::class);
    // Toggle rented status
    Route::patch('/cars/{car}/toggle-rent', [CarController::class, 'toggleRent'])
        ->name('cars.toggleRent');
    // Cart actions
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');
    // My Cart page
    Route::get('/my-cart', [CartController::class, 'index'])->name('mycart');
    // Rental request
    Route::get('/cars/{car}/rent', [\App\Http\Controllers\RentalController::class, 'create'])
        ->name('cars.rent.create');
    Route::post('/cars/{car}/rent', [\App\Http\Controllers\RentalController::class, 'store'])
        ->name('cars.rent');
    // Accept or reject rental requests
    Route::patch('/rentals/{rental}/accept', [\App\Http\Controllers\RentalController::class, 'accept'])
        ->name('rentals.accept');
    // Reject rental request
    Route::delete('/rentals/{rental}', [\App\Http\Controllers\RentalController::class, 'reject'])
        ->name('rentals.reject');
});

require __DIR__.'/auth.php';

?>