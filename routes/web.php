<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use Illuminate\Database\Eloquent\Collection;
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
// Route::get('/test', function(){

//     Collection::macro('toUpper', function () {
//     return $this->map(function (string $value) {
//         return Str::upper($value);
//     });
// });
//     $collections = collect([
//         ['Abdultawab', 'Abdullah', 'Abdulrahman'],
//         ['Abdulaziz', 'Abdulhadi', 'Abdulmajeed'],
//         ['Abdulwahab']
// ]);
//     $upper = $collections->collapse();
//     dd($upper);
// });



Route::get('/', function () {
    return view('auth.login',);
    // return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('products', ProductController::class);
    Route::post('/products/{product}/add-quantity', [ProductController::class, 'storeQuantity'])->name('products.store_quantity');
    Route::resource('stores', StoreController::class);
    Route::resource('users', UserController::class)->except(['show']); // CRUD routes
    Route::patch('/users/{user}/deactivate', [UserController::class, 'deactivate'])->name('users.deactivate'); // Deactivate user
    Route::patch('/users/{user}/activate', [UserController::class, 'activate'])->name('users.activate'); // Activate user
});
    Route::middleware('auth')->group(function () {
    Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');
    Route::get('/invoices/create', [InvoiceController::class, 'create'])->name('invoices.create');
    Route::post('/invoices', [InvoiceController::class, 'store'])->name('invoices.store');
    Route::get('/invoices/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show');
    Route::put('/invoices/{invoice}/status', [InvoiceController::class, 'updateStatus'])->name('invoices.updateStatus');
    });

require __DIR__.'/auth.php';
