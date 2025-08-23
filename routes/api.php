<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// PAN STATUS
Route::post('/get_panstatus', [App\Http\Controllers\api\ApiController::class, 'get_panstatus'])->name('get_panstatus');

// CAN NUMBER
Route::post('/get_cannumberstatus', [App\Http\Controllers\api\ApiController::class, 'get_cannumberstatus'])->name('get_cannumberstatus');

// TAILOR
Route::post('/get_tailorstatus', [App\Http\Controllers\api\ApiController::class, 'get_tailorstatus'])->name('get_tailorstatus');

// SMART CARD OTP
Route::post('/get_smartcardotpstatus', [App\Http\Controllers\api\ApiController::class, 'get_smartcardotpstatus'])->name('get_smartcardotpstatus');

// SMART CARD
Route::post('/get_smartcardstatus', [App\Http\Controllers\api\ApiController::class, 'get_smartcardstatus'])->name('get_smartcardstatus');

// FSSAI SERVICE
Route::post('/get_fssaistatus', [App\Http\Controllers\api\ApiController::class, 'get_fssaistatus'])->name('get_fssaistatus');

// SERVER PAYMENT DATE

Route::post('/get_website_activation', [App\Http\Controllers\api\ApiController::class, 'get_website_activation'])->name('get_website_activation');
Route::post('/update_serverpayment_status', [App\Http\Controllers\api\ApiController::class, 'update_serverpayment_status'])->name('update_serverpayment_status');

// AADHAAR CARD SERVICE
Route::post('/get_aadhaarcardstatus', [App\Http\Controllers\api\ApiController::class, 'get_aadhaarcardstatus'])->name('get_aadhaarcardstatus');

// TNEGA SERVICE
Route::post('/get_tnegaservicesstatus', [App\Http\Controllers\api\ApiController::class, 'get_tnegaservicesstatus'])->name('get_tnegaservicesstatus');
