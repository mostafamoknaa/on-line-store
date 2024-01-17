<?php

use App\Http\Controllers\CartsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SectionsController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Mail\store;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return  view('welcome');
});

Route::get('/sections', function () {
    return view('home.dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::resource('/sections',SectionsController::class);
Route::resource('/products',ProductsController::class);
Route::resource('/carts',CartsController::class);
Route::resource('/orders',OrdersController::class);

Route::get('/send', function () {
    Mail::to('marwanmokn3@gmail.com')->send(new store());
    return response("sendding");
});
