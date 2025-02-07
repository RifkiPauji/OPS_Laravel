<?php

use App\Http\Controllers\ProductController\ProductController;
use App\Http\Controllers\DashboardController\DashboardController;
use App\Http\Controllers\AuthController\LoginController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ProfileController\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;

// Rute tanpa middleware auth
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('loginauth');

// Rute yang memerlukan middleware auth
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect('/dashboard');
    });
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/profiles', [ProfileController::class, 'index'])->name('profile');
    Route::post('/change-profile', [ProfileController::class, 'changeProfile'])->name('change-profile');

    Route::get('/product', [ProductController::class, 'index'])->name('product');
    Route::get('/product_create', [ProductController::class, 'create'])->name('product_create');
    Route::post('/product_store', [ProductController::class, 'store'])->name('product_store');
    Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product_edit');
    Route::put('/product/{id}', [ProductController::class, 'update'])->name('product_update');
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product_destroy');
    Route::get('/export/products', function () {
        return Excel::download(new ProductsExport, 'data_produk.xlsx');
    })->name('product_export');
    Route::get('/product/filter', [ProductController::class, 'filter'])->name('product_filter');


});

Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

Route::get('/test', function () {
    $data = DB::connection('postgres')->table('user')->get();
    return $data;
});
