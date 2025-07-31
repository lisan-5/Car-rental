<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;

use Illuminate\Support\Facades\Auth;
use App\Models\Rental;

Route::get('/', function () {
    return view('home');
})->name('home');


Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Include Breeze auth routes
require __DIR__.'/auth.php';

// Admin: list all users
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    // List users
    Route::get('users', [\App\Http\Controllers\Admin\UserController::class, 'index'])
        ->name('users.index');
    // Edit user
    Route::get('users/{user}/edit', [\App\Http\Controllers\Admin\UserController::class, 'edit'])
        ->name('users.edit');
    // Update user
    Route::put('users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'update'])
        ->name('users.update');
    // Delete user
    Route::delete('users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])
        ->name('users.destroy');

    // Admin: cars management
    Route::get('cars', [\App\Http\Controllers\Admin\CarController::class, 'index'])
        ->name('cars.index');
    Route::get('cars/{car}/edit', [\App\Http\Controllers\Admin\CarController::class, 'edit'])
        ->name('cars.edit');
    Route::put('cars/{car}', [\App\Http\Controllers\Admin\CarController::class, 'update'])
        ->name('cars.update');
    Route::delete('cars/{car}', [\App\Http\Controllers\Admin\CarController::class, 'destroy'])
        ->name('cars.destroy');
    
    // Admin: rentals management
    Route::get('rentals', [\App\Http\Controllers\Admin\RentalController::class, 'index'])
        ->name('rentals.index');
    Route::get('rentals/{rental}/edit', [\App\Http\Controllers\Admin\RentalController::class, 'edit'])
        ->name('rentals.edit');
    Route::put('rentals/{rental}', [\App\Http\Controllers\Admin\RentalController::class, 'update'])
        ->name('rentals.update');
    Route::delete('rentals/{rental}', [\App\Http\Controllers\Admin\RentalController::class, 'destroy'])
        ->name('rentals.destroy');
});

use App\Http\Controllers\CartController;
Route::get('/dashboard', function () {
    $user = Auth::user();
    $cars = $user->cars; // Fetch cars owned by the user
    $requests = Rental::whereIn('car_id', $cars->pluck('id')) // Fetch rental requests for the user's cars
        ->with('car')
        ->get();
    return view('dashboard', compact('cars', 'requests')); // Display user's cars and rental requests
})->middleware(['auth', 'verified'])->name('dashboard');

// All API endpoints are Sanctum-protected
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
    // Users: view own rental requests
    Route::get('/rentals', [\App\Http\Controllers\RentalController::class, 'userRequests'])
        ->name('rentals.index');
    // Accept or reject rental requests
    Route::patch('/rentals/{rental}/accept', [\App\Http\Controllers\RentalController::class, 'accept'])
        ->name('rentals.accept');
    // Reject rental request
    Route::delete('/rentals/{rental}', [\App\Http\Controllers\RentalController::class, 'reject'])
        ->name('rentals.reject');
});

// Authentication Laravel Breeze
require __DIR__.'/auth.php';

?>
