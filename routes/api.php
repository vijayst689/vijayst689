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

// TNEGA SERVICE
Route::post('/get_tnegaservicesstatus', [App\Http\Controllers\api\ApiController::class, 'get_tnegaservicesstatus'])->name('get_tnegaservicesstatus');

// SERVER PAYMENT DATE

Route::post('/get_website_activation', [App\Http\Controllers\api\ApiController::class, 'get_website_activation'])->name('get_website_activation');
Route::post('/update_serverpayment_status', [App\Http\Controllers\api\ApiController::class, 'update_serverpayment_status'])->name('update_serverpayment_status');


Route::post('/get_wallet_request', [App\Http\Controllers\api\ApiController::class, 'get_wallet_request'])->name('get_wallet_request');

// AADHAAR CARD SERVICE 
Route::post('/get_aadhaarcardstatus', [App\Http\Controllers\api\ApiController::class, 'get_aadhaarcardstatus'])->name('get_aadhaarcardstatus');

// PATTA SERVICE 
Route::post('/get_pattastatus', [App\Http\Controllers\api\ApiController::class, 'get_pattastatus'])->name('get_pattastatus');

// VOTERID SERVICE 
Route::post('/get_voteridstatus', [App\Http\Controllers\api\ApiController::class, 'get_voteridstatus'])->name('get_voteridstatus');


//OTHER SITE WALLET
Route::post('/approve_payment', [App\Http\Controllers\api\WalletApiController::class, 'approve_payment'])->name('approve_payment');
Route::post('/getadmin_wallet', [App\Http\Controllers\api\WalletApiController::class, 'getadmin_wallet'])->name('getadmin_wallet');
Route::post('/update_ramji_wallet', [App\Http\Controllers\api\WalletApiController::class, 'update_ramji_wallet'])->name('update_ramji_wallet');
Route::post('/update_nalavariyamform_payment', [App\Http\Controllers\api\WalletApiController::class, 'update_nalavariyamform_payment'])->name('update_nalavariyamform_payment');
Route::post('/update_activation_payment', [App\Http\Controllers\api\WalletApiController::class, 'update_activation_payment'])->name('update_activation_payment');
Route::post('/update_service_payment', [App\Http\Controllers\api\WalletApiController::class, 'update_service_payment'])->name('update_service_payment');
Route::post('/refund_service_payment', [App\Http\Controllers\api\WalletApiController::class, 'refund_service_payment'])->name('refund_service_payment');
Route::post('/update_district_payment', [App\Http\Controllers\api\WalletApiController::class, 'update_district_payment'])->name('update_district_payment');

//site payment
Route::post('/update_payment_status', [App\Http\Controllers\api\ApiController::class, 'update_payment_status'])->name('update_payment_status');
Route::post('/update_comison_payment', [App\Http\Controllers\api\ApiController::class, 'update_comison_payment'])->name('update_comison_payment');

Route::post('/update_site_payments', [App\Http\Controllers\api\SitePaymentController::class, 'update_site_payments'])->name('update_site_payments');
Route::post('/update_sitepayment_status', [App\Http\Controllers\api\SitePaymentController::class, 'update_sitepayment_status'])->name('update_sitepayment_status');

// Nalavariyam Request Payemnt Update

Route::post('/update_payment_status_nalavariyam', [App\Http\Controllers\api\ApiController::class, 'update_payment_status_nalavariyam'])->name('update_payment_status_nalavariyam');

Route::post('/updateadminpayment', [App\Http\Controllers\api\AdminPaymentController::class, 'updateadminpayment'])->name('updateadminpayment');

Route::post('/get_bulkorderstatus', [App\Http\Controllers\api\ApiController::class, 'get_bulkorderstatus'])->name('get_bulkorderstatus');

//NAlavariyam Form 
Route::post('/store_nalavariyamform_application',[App\Http\Controllers\api\NalavariyamFormController::class, 'store_nalavariyamform_application'])->name('store_nalavariyamform_application');

// MEDICAL SCHEME SERVICE 
Route::post('/get_medicalschemestatus', [App\Http\Controllers\api\ApiController::class, 'get_medicalschemestatus'])->name('get_medicalschemestatus');

// VOTERID PDF DOWNLOAD SERVICE 
Route::post('/get_voteridpdf_downloadestatus', [App\Http\Controllers\api\ApiController::class, 'get_voteridpdf_downloadestatus'])->name('get_voteridpdf_downloadestatus');

//AGRI STACK SERVICE 
Route::post('/get_agristack_status', [App\Http\Controllers\api\ApiController::class, 'get_agristack_status'])->name('get_agristack_status');

// SMARTCARD PDF SERVICE 
Route::post('/get_smartcardpdf_status', [App\Http\Controllers\api\ApiController::class, 'get_smartcardpdf_status'])->name('get_smartcardpdf_status');

//BOND SERVICE
Route::post('/get_bondstatus', [App\Http\Controllers\api\ApiController::class, 'get_bondstatus'])->name('get_bondstatus');

// AADHAAR FIND SERVICE 
Route::post('/get_aadhaarfind_status', [App\Http\Controllers\api\ApiController::class, 'get_aadhaarfind_status'])->name('get_aadhaarfind_status');

// MANUAL PDF SERVICE 
Route::post('/get_manualpdf_status', [App\Http\Controllers\api\ApiController::class, 'get_manualpdf_status'])->name('get_manualpdf_status');

//  EMPLOYMENT SERVICE 
Route::post('/get_employment_status', [App\Http\Controllers\api\ApiController::class, 'get_employment_status'])->name('get_employment_status');


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

Route::get('/district-counts', function () {

    return DB::table('nalavariyam_district as d')
        ->select(
            'd.id',
            'd.district_name',

            DB::raw("(SELECT COUNT(*)
                FROM nalavariyam_form p
                WHERE p.dist_id IN (
                    CASE WHEN d.id = 5 THEN 5 ELSE d.id END,
                    CASE WHEN d.id = 5 THEN 42 ELSE 0 END
                )
                AND p.service_status = 'Completed'
            ) as application_count"),

            DB::raw("(SELECT COUNT(*)
                FROM users u
                WHERE u.nalavariyam_dist_id IN (
                    CASE WHEN d.id = 5 THEN 5 ELSE d.id END,
                    CASE WHEN d.id = 5 THEN 42 ELSE 0 END
                )
            ) as user_count"),

            DB::raw("(SELECT COUNT(*)
                FROM nalavariyam_customer c
                WHERE c.district IN (
                    CASE WHEN d.id = 5 THEN 5 ELSE d.id END,
                    CASE WHEN d.id = 5 THEN 42 ELSE 0 END
                )
            ) as customer_count")
        )
        ->where('d.status', 'Active')
        ->where('d.id', '!=', 42)
        ->orderBy('d.district_name')
        ->get();
});

//ESEVAI SERVICE 
Route::post('/get_esevai_servicesstatus', [App\Http\Controllers\api\ApiController::class, 'get_esevai_servicesstatus'])->name('get_esevai_servicesstatus');

//NATIVITY SERVICE 
Route::post('/get_nativity_servicesstatus', [App\Http\Controllers\api\ApiController::class, 'get_nativity_servicesstatus'])->name('get_nativity_servicesstatus');

//RESIDENCE SERVICE 
Route::post('/get_residence_servicesstatus', [App\Http\Controllers\api\ApiController::class, 'get_residence_servicesstatus'])->name('get_residence_servicesstatus');

//UNEMPLOYED SERVICE 
Route::post('/get_unemployed_servicesstatus', [App\Http\Controllers\api\ApiController::class, 'get_unemployed_servicesstatus'])->name('get_unemployed_servicesstatus');

//INCOME SERVICE 
Route::post('/get_income_servicesstatus', [App\Http\Controllers\api\ApiController::class, 'get_income_servicesstatus'])->name('get_income_servicesstatus');

//OBC SERVICE 
Route::post('/get_obc_servicesstatus', [App\Http\Controllers\api\ApiController::class, 'get_obc_servicesstatus'])->name('get_obc_servicesstatus');

//UNMARRIED SERVICE 
Route::post('/get_unmarried_servicesstatus', [App\Http\Controllers\api\ApiController::class, 'get_unmarried_servicesstatus'])->name('get_unmarried_servicesstatus');

//HANDICAP SERVICE 
Route::post('/get_handicap_servicesstatus', [App\Http\Controllers\api\ApiController::class, 'get_handicap_servicesstatus'])->name('get_handicap_servicesstatus');

//WIDOW SERVICE 
Route::post('/get_widow_servicesstatus', [App\Http\Controllers\api\ApiController::class, 'get_widow_servicesstatus'])->name('get_widow_servicesstatus');

//GRADUATE SERVICE 
Route::post('/get_graduate_servicesstatus', [App\Http\Controllers\api\ApiController::class, 'get_graduate_servicesstatus'])->name('get_graduate_servicesstatus');

Route::post('/get_otpfrom_otherwebsite', [App\Http\Controllers\api\ApiController::class, 'getOtpFromOtherWebsite']);

Route::post('/get_smartcardcorrectionstatus', [App\Http\Controllers\api\ApiController::class, 'get_smartcardcorrectionstatus'])->name('get_smartcardcorrectionstatus');