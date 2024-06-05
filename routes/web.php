<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ElectricityController;

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
    return view('welcome');
});
Route::get('/dashboard', [ElectricityController::class, 'dashboard']);

Route::get('/customers', [ElectricityController::class, 'index']);
Route::get('/create-customers', [ElectricityController::class, 'create_customers'])->name('create_customers');
Route::post('/store-customers', [ElectricityController::class, 'store_customers'])->name('customers.store');
Route::get('/edit-customers/{id}', [ElectricityController::class, 'edit_customers']);
Route::post('/update-customers/{id}', [ElectricityController::class, 'update_customers'])->name('customers.update');
Route::get('/delete-customers/{id}', [ElectricityController::class, 'delete_customers']);

Route::get('/generate-bill', [ElectricityController::class, 'generate_bill'])->name('generate.bill');
Route::post('/store-bill', [ElectricityController::class, 'store_bill'])->name('store.bill');
Route::get('/user_bills', [ElectricityController::class, 'user_bills']);


