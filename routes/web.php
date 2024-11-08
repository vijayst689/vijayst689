<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;

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
    return view('Frontend.home');
});


// Auth //

Route::get('dashboard', [CustomAuthController::class, 'dashboard']);
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::get('admin', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('register', [CustomAuthController::class, 'register'])->name('register');
Route::post('saveregister', [CustomAuthController::class, 'saveregister'])->name('saveregister');
Route::post('savedistributorregister', [CustomAuthController::class, 'savedistributorregister'])->name('savedistributorregister');
Route::post('saveretailerregister', [CustomAuthController::class, 'saveretailerregister'])->name('saveretailerregister');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');



Route::get('home', [App\Http\Controllers\Frontend\HomeController::class, 'Index']);

Route::get('addcustomer', [App\Http\Controllers\userController::class, 'addcustomer']);

Route::get('customers', [App\Http\Controllers\userController::class, 'customers']);

Route::post('updatecustomer', [App\Http\Controllers\userController::class, 'updatecustomer']);

Route::post('savecustomer', [App\Http\Controllers\userController::class, 'savecustomer']);

Route::post('updatecustomer', [App\Http\Controllers\userController::class, 'updatecustomer']);

Route::get('dropcustomer/{id}', [App\Http\Controllers\userController::class, 'dropcustomer']);

Route::get('documents/{id}', [App\Http\Controllers\userController::class, 'documents']);

Route::post('adddocument', [App\Http\Controllers\userController::class, 'adddocument']);

Route::get('profile', [App\Http\Controllers\userController::class, 'Profile']);

Route::post('updateprofile', [App\Http\Controllers\userController::class, 'updateprofile']);

Route::post('/checkemail', [App\Http\Controllers\userController::class, 'checkemail']);

Route::post('/checkaadhar', [App\Http\Controllers\userController::class, 'checkaadhar']);

Route::post('/checkphone', [App\Http\Controllers\userController::class, 'checkphone']);

Route::post('/checkpan', [App\Http\Controllers\userController::class, 'checkpan']);

Route::get('/editcustomer/{id}', [App\Http\Controllers\UserController::class, 'editcustomer'])->name('editcustomer');



Route::get('addretailer', [App\Http\Controllers\retailerController::class, 'Addretailer']);

Route::post('saveretailer', [App\Http\Controllers\retailerController::class, 'saveretailer']);

Route::get('retailers', [App\Http\Controllers\retailerController::class, 'Retailer']);

Route::get('addretailer', [App\Http\Controllers\retailerController::class, 'Addretailer']);

Route::get('retailer', [App\Http\Controllers\retailerController::class, 'Retailer']);

Route::post('updateretailer', [App\Http\Controllers\retailerController::class, 'updateretailer']);

Route::get('dropretailer/{id}', [App\Http\Controllers\retailerController::class, 'dropretailer']);



Route::get('adddistributor', [App\Http\Controllers\DistributorController::class, 'adddistributor']);

Route::get('distributors', [App\Http\Controllers\DistributorController::class, 'distributors']);

Route::post('savedistributor', [App\Http\Controllers\DistributorController::class, 'savedistributor']);

Route::post('updatedistributor', [App\Http\Controllers\DistributorController::class, 'updatedistributor']);

Route::get('dropdistributor/{id}', [App\Http\Controllers\DistributorController::class, 'dropdistributor']);


Route::get('retailer', [App\Http\Controllers\walletController::class, 'Retailer']);

Route::get('wallet', [App\Http\Controllers\WalletController::class, 'index']);

Route::get('paymentrequest', [App\Http\Controllers\WalletController::class, 'paymentrequest']);

Route::get('requestpayment', [App\Http\Controllers\WalletController::class, 'requestpayment']);

Route::post('saverequest', [App\Http\Controllers\WalletController::class, 'saverequest']);

Route::post('/adminaddwallet', [App\Http\Controllers\WalletController::class, 'adminaddwallet'])->name('adminaddwallet');


Route::get('/declinerequest_payment/{id}', [App\Http\Controllers\PaymentsController::class, 'declinerequest_payment'])->name('declinerequest_payment');
Route::post('/approvepayment', [App\Http\Controllers\PaymentsController::class, 'approvepayment'])->name('approvepayment');


Route::get('service', [App\Http\Controllers\ServiceController::class, 'service']);

Route::get('allservices/{customerid}', [App\Http\Controllers\ServiceController::class, 'allservices']);

Route::get('subservice/{id}', [App\Http\Controllers\ServiceController::class, 'subservice']);

Route::post('addsubservice', [App\Http\Controllers\ServiceController::class, 'addsubservice']);

Route::post('updatesubservice', [App\Http\Controllers\ServiceController::class, 'updatesubservice']);

Route::get('viewservice', [App\Http\Controllers\ServiceController::class, 'viewservice']);

Route::post('addservice', [App\Http\Controllers\ServiceController::class, 'addservice']);

Route::post('updateservice', [App\Http\Controllers\ServiceController::class, 'updateservice']);

Route::get('dropservice/{id}', [App\Http\Controllers\ServiceController::class, 'dropservice']);

Route::get('dropsubservice/{id}', [App\Http\Controllers\ServiceController::class, 'dropsubservice']);

Route::get('services/{serviceid}/{customerid}', [App\Http\Controllers\ServiceController::class, 'services']);

Route::get('applyservice/{serviceid}/{customerid}', [App\Http\Controllers\ServiceController::class, 'applyservice']);
Route::get('service/get_taluk/{distid}', [App\Http\Controllers\ServiceController::class, 'get_taluk'])->name('gettaluk');
Route::get('service/get_panchayath/{taluk_id}', [App\Http\Controllers\ServiceController::class, 'get_panchayath'])->name('getpanchayath');

Route::get('services/{serviceid}/{customerid}', [App\Http\Controllers\ServiceController::class, 'services']);
Route::post('submit_applyservice', [App\Http\Controllers\ServiceController::class, 'submit_applyservice']);
Route::get('get_subservice/{parentid}', [App\Http\Controllers\ServiceController::class, 'get_subservice']);
Route::get('application', [App\Http\Controllers\ServiceController::class, 'application']);
Route::get('viewapplication/{serviceid}', [App\Http\Controllers\ServiceController::class, 'viewapplication']);

// ApplyService
Route::post('/submitapply_tnegaservices1', [App\Http\Controllers\ServiceController::class, 'submitapply_tnegaservices1'])->name('submitapply_tnegaservices1');
Route::post('/submitapply_tnegaservices2', [App\Http\Controllers\ServiceController::class, 'submitapply_tnegaservices2'])->name('submitapply_tnegaservices2');
Route::post('/submitapply_tnegaservices3', [App\Http\Controllers\ServiceController::class, 'submitapply_tnegaservices3'])->name('submitapply_tnegaservices3');
Route::post('/submitapply_msme', [App\Http\Controllers\ServiceController::class, 'submitapply_msme'])->name('submitapply_msme');
Route::post('/submitapply_itr', [App\Http\Controllers\ServiceController::class, 'submitapply_itr'])->name('submitapply_itr');
Route::post('/submitapply_gst', [App\Http\Controllers\ServiceController::class, 'submitapply_gst'])->name('submitapply_gst');
Route::post('/submitapply_tecexam', [App\Http\Controllers\ServiceController::class, 'submitapply_tecexam'])->name('submitapply_tecexam');
Route::post('/submitapply_teccorrection', [App\Http\Controllers\ServiceController::class, 'submitapply_teccorrection'])->name('submitapply_teccorrection');
Route::post('/submittecexam_register', [App\Http\Controllers\ServiceController::class, 'submittecexam_register'])->name('submittecexam_register');
Route::post('/submitsmartcard_register', [App\Http\Controllers\ServiceController::class, 'submitsmartcard_register'])->name('submitsmartcard_register');
Route::post('/submitaadhaar', [App\Http\Controllers\ServiceController::class, 'submitaadhaar'])->name('submitaadhaar');
Route::post('/submit_pan', [App\Http\Controllers\ServiceController::class, 'submit_pan'])->name('submit_pan');
Route::post('/submitfindaadhaar_number', [App\Http\Controllers\ServiceController::class, 'submitfindaadhaar_number'])->name('submitfindaadhaar_number');
Route::post('/submitapply_canedit', [App\Http\Controllers\ServiceController::class, 'submitapply_canedit'])->name('submitapply_canedit');
Route::post('/submitsmartcardapply1', [App\Http\Controllers\ServiceController::class, 'submitsmartcardapply1'])->name('submitsmartcardapply1');
Route::post('/bondsubmit', [App\Http\Controllers\ServiceController::class, 'bondsubmit'])->name('bondsubmit');
Route::post('/submitvoterid', [App\Http\Controllers\ServiceController::class, 'submitvoterid'])->name('submitvoterid');
Route::post('/submit_fssaiservice', [App\Http\Controllers\ServiceController::class, 'submit_fssaiservice'])->name('submit_fssaiservice');
Route::post('/submitapply_covid', [App\Http\Controllers\ServiceController::class, 'submitapply_covid'])->name('submitapply_covid');
Route::post('/submitapply_nalavariyam', [App\Http\Controllers\ServiceController::class, 'submitapply_nalavariyam'])->name('submitapply_nalavariyam');



Route::get('/appliedservice/{status}', [App\Http\Controllers\ServicestatusController::class, 'appliedservice'])->name('appliedservice');
Route::get('/servicestatus/{status}/{id}/{serviceid}', [App\Http\Controllers\ServicestatusController::class, 'servicestatus'])->name('servicestatus');
Route::post('/submit_statusupdate', [App\Http\Controllers\ServicestatusController::class, 'submit_statusupdate'])->name('submit_statusupdate');
Route::post('/submit_statusupdate_tnegaservices1', [App\Http\Controllers\ServicestatusController::class, 'submit_statusupdate_tnegaservices1'])->name('submit_statusupdate_tnegaservices1');
Route::post('/submit_statusupdate_tnegaservices2', [App\Http\Controllers\ServicestatusController::class, 'submit_statusupdate_tnegaservices2'])->name('submit_statusupdate_tnegaservices2');
Route::post('/submit_statusupdate_tnegaservices3', [App\Http\Controllers\ServicestatusController::class, 'submit_statusupdate_tnegaservices3'])->name('submit_statusupdate_tnegaservices3');
Route::post('/submit_statusupdate_msme', [App\Http\Controllers\ServicestatusController::class, 'submit_statusupdate_msme'])->name('submit_statusupdate_msme');
Route::post('/submit_statusupdate_itr', [App\Http\Controllers\ServicestatusController::class, 'submit_statusupdate_itr'])->name('submit_statusupdate_itr');
Route::post('/submit_statusupdate_gst', [App\Http\Controllers\ServicestatusController::class, 'submit_statusupdate_gst'])->name('submit_statusupdate_gst');
Route::post('/submit_statusupdate_tecexam', [App\Http\Controllers\ServicestatusController::class, 'submit_statusupdate_tecexam'])->name('submit_statusupdate_tecexam');
Route::post('/submit_statusupdate_tecexamregister', [App\Http\Controllers\ServicestatusController::class, 'submit_statusupdate_tecexamregister'])->name('submit_statusupdate_tecexamregister');
Route::post('/submitsmartcard_register_update', [App\Http\Controllers\ServicestatusController::class, 'submitsmartcard_register_update'])->name('submitsmartcard_register_update');
Route::post('/submit_statusupdate_teccorrection', [App\Http\Controllers\ServicestatusController::class, 'submit_statusupdate_teccorrection'])->name('submit_statusupdate_teccorrection');
Route::post('/aadhaarcardupdate', [App\Http\Controllers\ServicestatusController::class, 'aadhaarcardupdate'])->name('aadhaarcardupdate');
Route::post('/findaadhaar_numberupdate', [App\Http\Controllers\ServicestatusController::class, 'findaadhaar_numberupdate'])->name('findaadhaar_numberupdate');
Route::post('/caneditupdate', [App\Http\Controllers\ServicestatusController::class, 'caneditupdate'])->name('caneditupdate');
Route::post('/smartcard_update1', [App\Http\Controllers\ServicestatusController::class, 'smartcard_update1'])->name('smartcard_update1');
Route::post('/bond_update', [App\Http\Controllers\ServicestatusController::class, 'bond_update'])->name('bond_update');
Route::post('/voterid_update', [App\Http\Controllers\ServicestatusController::class, 'voterid_update'])->name('voterid_update');
Route::post('/fssaiservice_update', [App\Http\Controllers\ServicestatusController::class, 'fssaiservice_update'])->name('fssaiservice_update');
Route::post('/submit_panupdate', [App\Http\Controllers\ServicestatusController::class, 'submit_panupdate'])->name('submit_panupdate');
Route::post('/covid_update', [App\Http\Controllers\ServicestatusController::class, 'covid_update'])->name('covid_update');


Route::get('/servicepayment/{serviceid}', [App\Http\Controllers\ServicePaymentController::class, 'servicepayment'])->name('servicepayment');
Route::post('/addservice_payment', [App\Http\Controllers\ServicePaymentController::class, 'addservice_payment'])->name('addservice_payment');
