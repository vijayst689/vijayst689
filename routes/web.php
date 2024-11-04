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



Route::get('addretailer', [App\Http\Controllers\retailerController::class, 'Addretailer']);

Route::post('saveretailer', [App\Http\Controllers\retailerController::class, 'saveretailer']);

Route::get('retailers', [App\Http\Controllers\retailerController::class, 'Retailer']);

Route::get('addretailer', [App\Http\Controllers\retailerController::class, 'Addretailer']);

Route::get('retailer', [App\Http\Controllers\retailerController::class, 'Retailer']);

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
