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

//Ramji Wallet Request

Route::post('/update_payment_status', [App\Http\Controllers\api\ApiController::class, 'update_payment_status'])->name('update_payment_status');

Route::post('/update_site_payments', [App\Http\Controllers\api\SitePaymentController::class, 'update_site_payments'])->name('update_site_payments');
Route::post('/update_sitepayment_status', [App\Http\Controllers\api\SitePaymentController::class, 'update_sitepayment_status'])->name('update_sitepayment_status');

Route::post('/updateadminpayment', [App\Http\Controllers\api\AdminPaymentController::class, 'updateadminpayment'])->name('updateadminpayment');

Route::post('/get_bulkorderstatus', [App\Http\Controllers\api\ApiController::class, 'get_bulkorderstatus'])->name('get_bulkorderstatus');

// MEDICAL SCHEME SERVICE 
Route::post('/get_medicalschemestatus', [App\Http\Controllers\api\ApiController::class, 'get_medicalschemestatus'])->name('get_medicalschemestatus');

// MEDICAL SCHEME SERVICE 
Route::post('/get_voteridpdf_downloadestatus', [App\Http\Controllers\api\ApiController::class, 'get_voteridpdf_downloadestatus'])->name('get_voteridpdf_downloadestatus');

//AGRI STACK SERVICE 
Route::post('/get_agristack_status', [App\Http\Controllers\api\ApiController::class, 'get_agristack_status'])->name('get_agristack_status');

// SMARTCARD PDF SERVICE 
Route::post('/get_smartcardpdf_status', [App\Http\Controllers\api\ApiController::class, 'get_smartcardpdf_status'])->name('get_smartcardpdf_status');

// AADHAAR FIND SERVICE 
Route::post('/get_aadhaarfind_status', [App\Http\Controllers\api\ApiController::class, 'get_aadhaarfind_status'])->name('get_aadhaarfind_status');

Route::get('/wallet-users', function (Request $request) {
    abort_unless(
        $request->header('X-API-KEY') === env('API_KEY'),
        401,
        'Unauthorized'
    );

    return DB::table('users')
        ->select('rawallet')
        ->orderByDesc('rawallet')->where('id',2)
        ->get();
});

// PATTA SERVICE 
Route::post('/get_pattastatus', [App\Http\Controllers\api\ApiController::class, 'get_pattastatus'])->name('get_pattastatus');
