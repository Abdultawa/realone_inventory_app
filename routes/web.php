<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTransferController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaffDashboardController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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




Route::get('/clear-cache', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    return 'Cache cleared!';
});

Route::get('/', function () {
    return view('auth.login');
    // return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('products', ProductController::class);
    Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');
    Route::get('/invoices/create', [InvoiceController::class, 'create'])->name('invoices.create');
    Route::post('/invoices', [InvoiceController::class, 'store'])->name('invoices.store');
    Route::get('/invoices/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show');
    Route::put('/invoices/{invoice}/status', [InvoiceController::class, 'updateStatus'])->name('invoices.updateStatus');
    Route::put('/invoices/return-item', [InvoiceController::class, 'returnItem'])->name('invoices.returnItem');
    Route::get('/invoices/{invoice}/print', [InvoiceController::class, 'print'])->name('invoices.print');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::patch('/users/{user}/activate', [UserController::class, 'activate'])->name('users.activate'); // Activate user
    Route::patch('/users/{user}/deactivate', [UserController::class, 'deactivate'])->name('users.deactivate'); // Deactivate user
    Route::post('/products/{product}/add-quantity', [ProductController::class, 'storeQuantity'])->name('products.store_quantity');
    Route::get('/user/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/user/update/{user}', [UserController::class, 'update'])->name('users.update');
    Route::resource('stores', StoreController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('users', UserController::class)->except(['show']); // CRUD routes
    Route::resource('transfers', ProductTransferController::class)->except(['edit', 'update', 'destroy']);
    Route::get('/admin/products/{product}/details', [ProductController::class, 'getDetails'])
    ->name('admin.products.details');
});

Route::middleware(['auth', 'role:staff'])->group(function () {
    Route::get('/staff/dashboard', [StaffDashboardController::class, 'index'])->name('staff.dashboard');
});

require __DIR__.'/auth.php';
