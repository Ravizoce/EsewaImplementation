<?php

use App\Http\Controllers\PaymentController;
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

Route::get('/', function () {
    return view('layoute');
});

Route::get("/paymnt" , [PaymentController::class , 'index'])->name("payment.esewa");
// Route::post("/paymnt/send" , [PaymentController::class , 'index'])->name("payment.esewa.send");
Route::get("/sucess" , [PaymentController::class , 'esewaSuccess'])->name("payment.esewa.secess");
Route::get("/failure" , [PaymentController::class , 'esewaFailure'])->name("payment.esewa.failure ");