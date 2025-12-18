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
    return view('welcome');
});
// Frontend
// Route::get('/home', [App\Http\Controllers\Frontend\HomeController::class, 'dashboard']);

// Auth //

Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'dashboard']);
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::get('admin', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('register', [CustomAuthController::class, 'register'])->name('register');
Route::post('saveregister', [CustomAuthController::class, 'saveregister'])->name('saveregister');
Route::post('savedistributorregister', [CustomAuthController::class, 'savedistributorregister'])->name('savedistributorregister');
Route::post('saveretailerregister', [CustomAuthController::class, 'saveretailerregister'])->name('saveretailerregister');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
Route::post('checkemailregister', [CustomAuthController::class, 'checkemailregister'])->name('checkemailregister');
Route::post('checkaadharregister', [CustomAuthController::class, 'checkaadharregister'])->name('checkaadharregister');
Route::post('checkphoneregister', [CustomAuthController::class, 'checkphoneregister'])->name('checkphoneregister');
Route::post('checkpanregister', [CustomAuthController::class, 'checkpanregister'])->name('checkpanregister');
Route::post('checkemailregisterretailer', [CustomAuthController::class, 'checkemailregisterretailer'])->name('checkemailregisterretailer');
Route::post('checkaadharregisterretailer', [CustomAuthController::class, 'checkaadharregisterretailer'])->name('checkaadharregisterretailer');
Route::post('checkphoneregisterretailer', [CustomAuthController::class, 'checkaadharregisterretailer'])->name('checkphoneregisterretailer');
Route::post('checkpanregisterretailer', [CustomAuthController::class, 'checkpanregisterretailer'])->name('checkpanregisterretailer');
Route::post('checkemailregistercustomer', [CustomAuthController::class, 'checkemailregistercustomer'])->name('checkemailregistercustomer');
Route::post('checkaadharregistercustomer', [CustomAuthController::class, 'checkaadharregistercustomer'])->name('checkaadharregistercustomer');
Route::post('checkphoneregistercustomer', [CustomAuthController::class, 'checkphoneregistercustomer'])->name('checkphoneregistercustomer');
Route::post('checkemail', [CustomAuthController::class, 'checkemail'])->name('checkemail');
Route::post('checkaadhar', [CustomAuthController::class, 'checkaadhar'])->name('checkaadhar');
Route::post('checkphone', [CustomAuthController::class, 'checkphone'])->name('checkphone');
Route::post('checkpan', [CustomAuthController::class, 'checkpan'])->name('checkpan');
Route::get('addenquiry/{id}', [CustomAuthController::class, 'addenquiry'])->name('addenquiry');
Route::post('saveenquiry', [CustomAuthController::class, 'saveenquiry'])->name('saveenquiry');
Route::post('savequery', [CustomAuthController::class, 'savequery'])->name('savequery');
Route::get('welcomenquirys', [CustomAuthController::class, 'welcomenquirys'])->name('welcomenquirys');
Route::get('register/get_taluk_register/{distid}', [App\Http\Controllers\CustomAuthController::class, 'get_taluk_register'])->name('gettalukregister');
Route::get('register/get_panchayath_register/{taluk_id}', [App\Http\Controllers\CustomAuthController::class, 'get_panchayath_register'])->name('getpanchayathregister');
Route::post('/check-phonelogin', [CustomAuthController::class, 'checkPhonelogin'])->name('check.phonelogin');
Route::post('/send-otp', [CustomAuthController::class, 'sendOtp'])->name('send.otp');


Route::get('home', [App\Http\Controllers\Frontend\HomeController::class, 'Index']);

Route::get('/changepassword', [App\Http\Controllers\UserController::class, 'changepassword']);

Route::post('/updatepassword', [App\Http\Controllers\UserController::class, 'updatepassword'])->name('updatepassword');

Route::get('addcustomer', [App\Http\Controllers\UserController::class, 'addcustomer']);

Route::get('customers', [App\Http\Controllers\UserController::class, 'customers']);

Route::post('updatecustomer', [App\Http\Controllers\UserController::class, 'updatecustomer']);

Route::post('savecustomer', [App\Http\Controllers\UserController::class, 'savecustomer']);

Route::post('updatecustomer', [App\Http\Controllers\UserController::class, 'updatecustomer']);

Route::get('dropcustomer/{id}', [App\Http\Controllers\UserController::class, 'dropcustomer']);

Route::get('documents/{id}', [App\Http\Controllers\UserController::class, 'documents']);

Route::post('adddocument', [App\Http\Controllers\UserController::class, 'adddocument']);

Route::get('profile', [App\Http\Controllers\UserController::class, 'Profile']);

Route::post('updateprofile', [App\Http\Controllers\UserController::class, 'updateprofile']);

Route::get('/editcustomer/{id}', [App\Http\Controllers\UserController::class, 'editcustomer'])->name('editcustomer');

Route::get('/admins', [App\Http\Controllers\UserController::class, 'admins'])->name('admins');



Route::get('addretailer', [App\Http\Controllers\RetailerController::class, 'Addretailer']);

Route::post('saveretailer', [App\Http\Controllers\RetailerController::class, 'saveretailer']);

Route::get('retailers', [App\Http\Controllers\RetailerController::class, 'Retailer']);

Route::get('addretailer', [App\Http\Controllers\RetailerController::class, 'Addretailer']);

Route::get('retailer', [App\Http\Controllers\RetailerController::class, 'Retailer']);

Route::post('updateretailer', [App\Http\Controllers\RetailerController::class, 'updateretailer']);

Route::post('retailerstatusupdate', [App\Http\Controllers\RetailerController::class, 'retailerstatusupdate']);

Route::post('updatestatus', [App\Http\Controllers\RetailerController::class, 'updatestatus']);

Route::get('dropretailer/{id}', [App\Http\Controllers\RetailerController::class, 'dropretailer']);



Route::get('adddistributor', [App\Http\Controllers\DistributorController::class, 'adddistributor']);

Route::get('distributors', [App\Http\Controllers\DistributorController::class, 'distributors']);

Route::post('savedistributor', [App\Http\Controllers\DistributorController::class, 'savedistributor']);

Route::post('updatedistributor', [App\Http\Controllers\DistributorController::class, 'updatedistributor']);

Route::get('dropdistributor/{id}', [App\Http\Controllers\DistributorController::class, 'dropdistributor']);

Route::post('statusupdate', [App\Http\Controllers\DistributorController::class, 'statusupdate']);


Route::get('retailer', [App\Http\Controllers\walletController::class, 'Retailer']);

Route::get('wallet', [App\Http\Controllers\WalletController::class, 'index']);

Route::get('paymentrequest', [App\Http\Controllers\WalletController::class, 'paymentrequest']);

Route::get('requestpayment', [App\Http\Controllers\WalletController::class, 'requestpayment']);

Route::post('saverequest', [App\Http\Controllers\WalletController::class, 'saverequest']);

Route::post('ramjisaverequest', [App\Http\Controllers\WalletController::class, 'ramjisaverequest']);

Route::post('/adminaddwallet', [App\Http\Controllers\WalletController::class, 'adminaddwallet'])->name('adminaddwallet');

Route::get('rawallet', [App\Http\Controllers\WalletController::class, 'rawallet']);

Route::get('rapaymentrequest', [App\Http\Controllers\WalletController::class, 'rapaymentrequest']);

Route::post('/superadminaddwallet', [App\Http\Controllers\WalletController::class, 'superadminaddwallet'])->name('superadminaddwallet');


Route::get('/declinerequest_payment/{id}', [App\Http\Controllers\PaymentsController::class, 'declinerequest_payment'])->name('declinerequest_payment');
Route::post('/approvepayment', [App\Http\Controllers\PaymentsController::class, 'approvepayment'])->name('approvepayment');
Route::post('/approveramjipayment', [App\Http\Controllers\PaymentsController::class, 'approveramjipayment'])->name('approveramjipayment');


Route::get('service', [App\Http\Controllers\ServiceController::class, 'service']);

Route::get('ourservice', [App\Http\Controllers\ServiceController::class, 'ourservice']);

Route::get('viewcourseservice', [App\Http\Controllers\ServiceController::class, 'viewcourseservice']);

Route::get('/viewsoftware', [App\Http\Controllers\ServiceController::class, 'viewsoftware'])->name('viewsoftware');

Route::get('allservice/{customerid}', [App\Http\Controllers\ServiceController::class, 'allservice']);

Route::get('allservices', [App\Http\Controllers\ServiceController::class, 'allservices']);

Route::get('servicesone/{serviceid}', [App\Http\Controllers\ServiceController::class, 'servicesone']);

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

Route::get('applyservices/{serviceid}', [App\Http\Controllers\ServiceController::class, 'applyservices']);

Route::get('service/get_taluk/{distid}', [App\Http\Controllers\ServiceController::class, 'get_taluk'])->name('gettaluk');

Route::get('service/get_panchayath/{taluk_id}', [App\Http\Controllers\ServiceController::class, 'get_panchayath'])->name('getpanchayath');
Route::get('nalavariyam/variyamget_taluk/{districtid}', [App\Http\Controllers\ServiceController::class, 'variyamget_taluk'])->name('variyamget_taluk');

Route::get('services/{serviceid}/{customerid}', [App\Http\Controllers\ServiceController::class, 'services']);
Route::post('submit_applyservice', [App\Http\Controllers\ServiceController::class, 'submit_applyservice']);
Route::get('get_subservice/{parentid}', [App\Http\Controllers\ServiceController::class, 'get_subservice']);
Route::get('application', [App\Http\Controllers\ServiceController::class, 'application']);
Route::get('viewapplication/{serviceid}', [App\Http\Controllers\ServiceController::class, 'viewapplication']);
Route::post('updatesubstatus', [App\Http\Controllers\ServiceController::class, 'updatesubstatus']);

// ApplyService
Route::post('/submitapply_tnegaservices1', [App\Http\Controllers\ServiceController::class, 'submitapply_tnegaservices1'])->name('submitapply_tnegaservices1');
Route::post('/submitapply_tnegaservices2', [App\Http\Controllers\ServiceController::class, 'submitapply_tnegaservices2'])->name('submitapply_tnegaservices2');
Route::post('/submitapply_tnegaservices3', [App\Http\Controllers\ServiceController::class, 'submitapply_tnegaservices3'])->name('submitapply_tnegaservices3');
Route::post('/submitapply_tnegaservices4', [App\Http\Controllers\ServiceController::class, 'submitapply_tnegaservices4'])->name('submitapply_tnegaservices4');
Route::post('/submitapply_tnegaservices5', [App\Http\Controllers\ServiceController::class, 'submitapply_tnegaservices5'])->name('submitapply_tnegaservices5');
Route::post('/submitapply_tnegaservices6', [App\Http\Controllers\ServiceController::class, 'submitapply_tnegaservices6'])->name('submitapply_tnegaservices6');
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
Route::post('/submitapply_passport', [App\Http\Controllers\ServiceController::class, 'submitapply_passport'])->name('submitapply_passport');
Route::post('/submitapply_pancard', [App\Http\Controllers\ServiceController::class, 'submitapply_pancard'])->name('submitapply_pancard');
Route::post('/submitapply_patta', [App\Http\Controllers\ServiceController::class, 'submitapply_patta'])->name('submitapply_patta');
Route::post('/submitapply_smartcardotp', [App\Http\Controllers\ServiceController::class, 'submitapply_smartcardotp'])->name('submitapply_smartcardotp');
Route::post('/submitapply_smart_member', [App\Http\Controllers\ServiceController::class, 'submitapply_smart_member'])->name('submitapply_smart_member');
Route::post('/submitapply_smart_nametransfer', [App\Http\Controllers\ServiceController::class, 'submitapply_smart_nametransfer'])->name('submitapply_smart_nametransfer');
Route::post('/submitapply_tailorshop', [App\Http\Controllers\ServiceController::class, 'submitapply_tailorshop'])->name('submitapply_tailorshop');
Route::post('/submitapply_voteridpdfdownload', [App\Http\Controllers\ServiceController::class, 'submitapply_voteridpdfdownload'])->name('submitapply_voteridpdfdownload');

Route::post('/submitutislnew', [App\Http\Controllers\ServiceController::class, 'submitutislnew'])->name('submitutislnew');

Route::get('/panfind', [App\Http\Controllers\ServiceController::class, 'panfind'])->name('panfind');

Route::get('/dlfind', [App\Http\Controllers\ServiceController::class, 'dlfind'])->name('dlfind');


Route::get('/panadvance', [App\Http\Controllers\ServiceController::class, 'panadvance'])->name('panadvance');

Route::get('/rcfind', [App\Http\Controllers\ServiceController::class, 'rcfind'])->name('rcfind');

Route::get('/rationcardverify', [App\Http\Controllers\ServiceController::class, 'rationcardverify'])->name('rationcardverify');

Route::get('/utislpanservices', [App\Http\Controllers\ServiceController::class, 'utislpanservices'])->name('utislpanservices');

Route::post('/submitutisl_corection', [App\Http\Controllers\ServiceController::class, 'submitutisl_corection'])->name('submitutisl_corection');

Route::get('viewcanservice', [App\Http\Controllers\ServiceController::class, 'viewcanservice']);

Route::get('viewpattaservice', [App\Http\Controllers\ServiceController::class, 'viewpattaservice']);



Route::get('/appliedservice/{status}', [App\Http\Controllers\ServicestatusController::class, 'appliedservice'])->name('appliedservice');
Route::get('/servicestatus/{status}/{id}/{serviceid}', [App\Http\Controllers\ServicestatusController::class, 'servicestatus'])->name('servicestatus');
Route::get('/utislservicestatus/{status}/{id}/{serviceid}', [App\Http\Controllers\ServicestatusController::class, 'utislservicestatus'])->name('utislservicestatus');
Route::post('/submit_statusupdate', [App\Http\Controllers\ServicestatusController::class, 'submit_statusupdate'])->name('submit_statusupdate');
Route::post('/submit_statusupdate_tnegaservices1', [App\Http\Controllers\ServicestatusController::class, 'submit_statusupdate_tnegaservices1'])->name('submit_statusupdate_tnegaservices1');
Route::post('/submit_statusupdate_tnegaservices2', [App\Http\Controllers\ServicestatusController::class, 'submit_statusupdate_tnegaservices2'])->name('submit_statusupdate_tnegaservices2');
Route::post('/submit_statusupdate_tnegaservices3', [App\Http\Controllers\ServicestatusController::class, 'submit_statusupdate_tnegaservices3'])->name('submit_statusupdate_tnegaservices3');
Route::post('/submit_statusupdate_tnegaservices4', [App\Http\Controllers\ServicestatusController::class, 'submit_statusupdate_tnegaservices4'])->name('submit_statusupdate_tnegaservices4');
Route::post('/submit_statusupdate_tnegaservices5', [App\Http\Controllers\ServicestatusController::class, 'submit_statusupdate_tnegaservices5'])->name('submit_statusupdate_tnegaservices5');
Route::post('/submit_statusupdate_tnegaservices6', [App\Http\Controllers\ServicestatusController::class, 'submit_statusupdate_tnegaservices6'])->name('submit_statusupdate_tnegaservices6');
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
Route::post('/nalavariyam_update', [App\Http\Controllers\ServicestatusController::class, 'nalavariyam_update'])->name('nalavariyam_update');
Route::post('/pancard_update', [App\Http\Controllers\ServicestatusController::class, 'pancard_update'])->name('pancard_update');
Route::post('/patta_update', [App\Http\Controllers\ServicestatusController::class, 'patta_update'])->name('patta_update');
Route::post('/submit_statusupdate_incomecertificate', [App\Http\Controllers\ServicestatusController::class, 'submit_statusupdate_incomecertificate'])->name('submit_statusupdate_incomecertificate');
Route::post('/submit_statusupdate_smallagriservice', [App\Http\Controllers\ServicestatusController::class, 'submit_statusupdate_smallagriservice'])->name('submit_statusupdate_smallagriservice');
Route::post('/smartcardotp_update', [App\Http\Controllers\ServicestatusController::class, 'smartcardotp_update'])->name('smartcardotp_update');
Route::post('/smartcard_member_update', [App\Http\Controllers\ServicestatusController::class, 'smartcard_member_update'])->name('smartcard_member_update');
Route::post('/smartcard_nametransfer_update', [App\Http\Controllers\ServicestatusController::class, 'smartcard_nametransfer_update'])->name('smartcard_nametransfer_update');
Route::post('/tailorshop_update', [App\Http\Controllers\ServicestatusController::class, 'tailorshop_update'])->name('tailorshop_update');
Route::post('/cancertificate_find_update', [App\Http\Controllers\ServicestatusController::class, 'cancertificate_find_update'])->name('cancertificate_find_update');
Route::post('/utislupdate', [App\Http\Controllers\ServicestatusController::class, 'utislupdate'])->name('utislupdate');
Route::post('/utislcorection_update', [App\Http\Controllers\ServicestatusController::class, 'utislcorection_update'])->name('utislcorection_update');
Route::post('/voteridpdf_statusupdate', [App\Http\Controllers\ServicestatusController::class, 'voteridpdf_statusupdate'])->name('voteridpdf_statusupdate');


Route::get('/servicepayment/{serviceid}', [App\Http\Controllers\ServicePaymentController::class, 'servicepayment'])->name('servicepayment');

Route::post('/addservice_payment', [App\Http\Controllers\ServicePaymentController::class, 'addservice_payment'])->name('addservice_payment');

Route::get('/smartcardpayment/{serviceid}', [App\Http\Controllers\ServicePaymentController::class, 'smartcardpayment'])->name('smartcardpayment');

Route::get('/get_smartcard_payment/{talukid}/{serviceid}', [App\Http\Controllers\ServicePaymentController::class, 'get_smartcard_payment'])->name('get_smartcard_payment');

Route::post('/savesmart_payment', [App\Http\Controllers\ServicePaymentController::class, 'savesmart_payment'])->name('savesmart_payment');

Route::get('/findpayment', [App\Http\Controllers\ServicePaymentController::class, 'findpayment'])->name('findpayment');

Route::post('addfind_payment', [App\Http\Controllers\ServicePaymentController::class, 'addfind_payment'])->name('addfind_payment');

Route::get('/rechargepayment/{serviceid}', [App\Http\Controllers\ServicePaymentController::class, 'rechargepayment'])->name('rechargepayment');

Route::post('addrecharge_payment', [App\Http\Controllers\ServicePaymentController::class, 'addrecharge_payment'])->name('addrecharge_payment');

Route::get('/panservicepayment', [App\Http\Controllers\ServicePaymentController::class, 'panservicepayment'])->name('panservicepayment');

Route::post('addpan_payment', [App\Http\Controllers\ServicePaymentController::class, 'addpan_payment'])->name('addpan_payment');

Route::get('/coursepayment', [App\Http\Controllers\ServicePaymentController::class, 'coursepayment'])->name('coursepayment');

Route::post('addcourse_payment', [App\Http\Controllers\ServicePaymentController::class, 'addcourse_payment'])->name('addcourse_payment');

Route::get('/canpayment', [App\Http\Controllers\ServicePaymentController::class, 'canpayment'])->name('canpayment');

Route::post('/addcan_payment', [App\Http\Controllers\ServicePaymentController::class, 'addcan_payment'])->name('addcan_payment');

Route::get('/utislpanpayment', [App\Http\Controllers\ServicePaymentController::class, 'utislpanpayment'])->name('utislpanpayment');

Route::post('/addutisl_payment', [App\Http\Controllers\ServicePaymentController::class, 'addutisl_payment'])->name('addutisl_payment');
Route::get('/useractivation/{activation_id}', [App\Http\Controllers\ServicePaymentController::class, 'useractivation'])->name('useractivation');
Route::post('addcourse_payment', [App\Http\Controllers\ServicePaymentController::class, 'addcourse_payment'])->name('addcourse_payment');
Route::post('adduser_activation', [App\Http\Controllers\ServicePaymentController::class, 'adduser_activation'])->name('adduser_activation');

//PDFServiceController

Route::get('/applypdfservice/{serviceid}', [App\Http\Controllers\PDFServiceController::class, 'applypdfservice'])->name('applypdfservice');

Route::get('/addfindservice', [App\Http\Controllers\PDFServiceController::class, 'addfindservice'])->name('addfindservice');
Route::post('/savefind', [App\Http\Controllers\PDFServiceController::class, 'savefind'])->name('savefind');
Route::post('/updatefind', [App\Http\Controllers\PDFServiceController::class, 'updatefind'])->name('updatefind');
Route::get('/viewfind', [App\Http\Controllers\PDFServiceController::class, 'viewfind'])->name('viewfind');
Route::post('/updatestatusfind', [App\Http\Controllers\PDFServiceController::class, 'updatestatusfind'])->name('updatestatusfind');
Route::post('/statusfind', [App\Http\Controllers\PDFServiceController::class, 'statusfind'])->name('statusfind');

Route::get('/pdfservices', [App\Http\Controllers\PDFServiceController::class, 'pdfservices'])->name('pdfservices');

Route::post('/submitpanfind', [App\Http\Controllers\PDFServiceController::class, 'submitpanfind'])->name('submitpanfind');
Route::post('/submitdlfind', [App\Http\Controllers\PDFServiceController::class, 'submitdlfind'])->name('submitdlfind');
Route::post('/submitrcfind', [App\Http\Controllers\PDFServiceController::class, 'submitrcfind'])->name('submitrcfind');
Route::post('/submitrationfind', [App\Http\Controllers\PDFServiceController::class, 'submitrationfind'])->name('submitrationfind');
Route::post('/submitpanadvance', [App\Http\Controllers\PDFServiceController::class, 'submitpanadvance'])->name('submitpanadvance');
Route::post('/submitvoterfind', [App\Http\Controllers\PDFServiceController::class, 'submitvoterfind'])->name('submitvoterfind');

Route::post('/savevoter', [App\Http\Controllers\PDFServiceController::class, 'savevoter'])->name('savevoter');

Route::get('/getepic/{epic_no}', [App\Http\Controllers\PDFServiceController::class, 'getepic'])->name('getepic');

Route::get('/getotp/{otp}', [App\Http\Controllers\PDFServiceController::class, 'getotp'])->name('getotp');

Route::get('/getpdfotp/{epic_no}', [App\Http\Controllers\PDFServiceController::class, 'getpdfotp'])->name('getpdfotp');

Route::post('/submitvoterpdf', [App\Http\Controllers\PDFServiceController::class, 'submitvoterpdf'])->name('submitvoterpdf');

Route::post('/submitaadhaar_verify', [App\Http\Controllers\PDFServiceController::class, 'submitaadhaar_verify'])->name('submitaadhaar_verify');

Route::post('/submitgstfind', [App\Http\Controllers\PDFServiceController::class, 'submitgstfind'])->name('submitgstfind');

Route::get('/getcaptcha', [App\Http\Controllers\PDFServiceController::class, 'getcaptcha'])->name('getcaptcha');

//PermissionController

Route::get('/userpermission/{userid}', [App\Http\Controllers\PermissionController::class, 'userpermission'])->name('userpermission');
Route::post('/savepermission', [App\Http\Controllers\PermissionController::class, 'savepermission'])->name('savepermission');
Route::get('/nalavariyam_permission/{userid}', [App\Http\Controllers\PermissionController::class, 'nalavariyam_permission'])->name('nalavariyam_permission');
Route::get('activation/get_activationamount/{userid}/{activation_userid}/{service_id}', [App\Http\Controllers\PermissionController::class, 'get_activationamount'])->name('get_activationamount');


Route::get('/utility', [App\Http\Controllers\RechargeController::class, 'utility'])->name('utility');
Route::get('/utilityservice/{serviceid}', [App\Http\Controllers\RechargeController::class, 'utilityservice'])->name('utilityservice');
Route::post('proceedrecharge', [App\Http\Controllers\RechargeController::class, 'proceedrecharge']);
Route::get('rechargehook', [App\Http\Controllers\RechargeController::class, 'rechargehook']);
Route::get('panstatus', [App\Http\Controllers\ServiceController::class, 'panstatus']);


//OperatorController

Route::get('/operator/{id}', [App\Http\Controllers\OperatorController::class, 'operator'])->name('operator');
Route::get('/viewoperators', [App\Http\Controllers\OperatorController::class, 'viewoperators'])->name('viewoperators');
Route::post('/addoperator', [App\Http\Controllers\OperatorController::class, 'addoperator'])->name('addoperator');
Route::post('/updateoperator', [App\Http\Controllers\OperatorController::class, 'updateoperator'])->name('updateoperator');
Route::get('/deleteoperator/{id}', [App\Http\Controllers\OperatorController::class, 'deleteoperator'])->name('deleteoperator');

//UtilityController

Route::get('/addutilityservice', [App\Http\Controllers\UtilityController::class, 'addutilityservice'])->name('addutilityservice');
Route::post('/saveutility', [App\Http\Controllers\UtilityController::class, 'saveutility'])->name('saveutility');
Route::post('/updateutility', [App\Http\Controllers\UtilityController::class, 'updateutility'])->name('updateutility');
Route::get('/viewutility', [App\Http\Controllers\UtilityController::class, 'viewutility'])->name('viewutility');

Route::post('/updatestatusuti', [App\Http\Controllers\UtilityController::class, 'updatestatusuti'])->name('updatestatusuti');

//PanController

Route::get('/addpan', [App\Http\Controllers\PanController::class, 'addpan'])->name('addpan');

Route::get('/viewpan', [App\Http\Controllers\PanController::class, 'viewpan'])->name('viewpan');

Route::post('/savepan', [App\Http\Controllers\PanController::class, 'savepan'])->name('savepan');

Route::post('/updatepan', [App\Http\Controllers\PanController::class, 'updatepan'])->name('updatepan');

Route::post('/updatestatuspan', [App\Http\Controllers\PanController::class, 'updatestatuspan'])->name('updatestatuspan');

Route::get('/panservices', [App\Http\Controllers\PanController::class, 'panservices'])->name('panservices');

Route::get('/applypanservice/{serviceid}', [App\Http\Controllers\PanController::class, 'applypanservice'])->name('applypanservice');

Route::post('/submitnewpancard', [App\Http\Controllers\PanController::class, 'submitnewpancard'])->name('submitnewpancard');
Route::post('/submitpancorrection', [App\Http\Controllers\PanController::class, 'submitpancorrection'])->name('submitpancorrection');
Route::get('pancard_reapply/{txid}/{serviceid}', [App\Http\Controllers\PanController::class, 'pancard_reapply']);

//UTISLPanController

Route::get('/addutislpan', [App\Http\Controllers\UtislPanController::class, 'addutislpan'])->name('addutislpan');

Route::get('/viewutislpan', [App\Http\Controllers\UtislPanController::class, 'viewutislpan'])->name('viewutislpan');

Route::post('/saveutislpan', [App\Http\Controllers\UtislPanController::class, 'saveutislpan'])->name('saveutislpan');

Route::post('/updateutislpan', [App\Http\Controllers\UtislPanController::class, 'updateutislpan'])->name('updateutislpan');

Route::get('/applyutislpanservice/{serviceid}', [App\Http\Controllers\UtislPanController::class, 'applyutislpanservice'])->name('applyutislpanservice');

// Route::post('/submitnewpancard', [App\Http\Controllers\UtislPanController::class, 'submitnewpancard'])->name('submitnewpancard');
// Route::post('/submitpancorrection', [App\Http\Controllers\UtislPanController::class, 'submitpancorrection'])->name('submitpancorrection');
Route::get('pancard_reapply/{txid}/{serviceid}', [App\Http\Controllers\UtislPanController::class, 'pancard_reapply']);


//Nalavariyam
Route::get('/nalavariyam_services', [App\Http\Controllers\NalavariyamServiceController::class, 'nalavariyam_services'])->name('nalavariyam_services');
Route::post('/addnalavariyam_service', [App\Http\Controllers\NalavariyamServiceController::class, 'addnalavariyam_service'])->name('addnalavariyam_service');
Route::post('/addnalavariyam_customer', [App\Http\Controllers\NalavariyamServiceController::class, 'addnalavariyam_customer'])->name('addnalavariyam_customer');
Route::get('/editnalavariyam_service/{id}', [App\Http\Controllers\NalavariyamServiceController::class, 'editnalavariyam_service'])->name('editnalavariyam_service');
Route::POST('/updatenalavariyam_service', [App\Http\Controllers\NalavariyamServiceController::class, 'updatenalavariyam_service'])->name('updatenalavariyam_service');
Route::get('/online_services/{id}', [App\Http\Controllers\NalavariyamServiceController::class, 'online_services'])->name('online_services');

Route::get('/member', [App\Http\Controllers\NalavariyamServiceController::class, 'member'])->name('member');
Route::get('/nalavariyam_customer', [App\Http\Controllers\NalavariyamServiceController::class, 'nalavariyam_customer'])->name('nalavariyam_customer');
Route::post('/addnalavariyam_member', [App\Http\Controllers\NalavariyamServiceController::class, 'addnalavariyam_member'])->name('addnalavariyam_member');

Route::get('/nalavariyampayment', [App\Http\Controllers\NalavariyamServiceController::class, 'nalavariyampayment'])->name('nalavariyampayment');
Route::post('/savenalavariyam_payment', [App\Http\Controllers\NalavariyamServiceController::class, 'savenalavariyam_payment'])->name('savenalavariyam_payment');

Route::get('/nalavariyamactivation_payment', [App\Http\Controllers\NalavariyamServiceController::class, 'nalavariyamactivation_payment'])->name('nalavariyamactivation_payment');

Route::get('/activationmember', [App\Http\Controllers\NalavariyamServiceController::class, 'activationmember'])->name('activationmember');

Route::get('/getaadhaar_otpf/{aadhaar}', [App\Http\Controllers\NalavariyamServiceController::class, 'getaadhaar_otpf'])->name('getaadhaar_otpf');

Route::get('/getaadhaar_dataf/{otp}/{refid}/{aadhaar}/{userid}', [App\Http\Controllers\NalavariyamServiceController::class, 'getaadhaar_dataf'])->name('getaadhaar_dataf');

Route::post('/updatenalavariyam_activation', [App\Http\Controllers\NalavariyamServiceController::class, 'updatenalavariyam_activation'])->name('updatenalavariyam_activation');

Route::post('/nalavariyam_checkaadhar', [App\Http\Controllers\NalavariyamServiceController::class, 'nalavariyam_checkaadhar'])->name('nalavariyam_checkaadhar');
Route::post('/nalavariyam_checkphone', [App\Http\Controllers\NalavariyamServiceController::class, 'nalavariyam_checkphone'])->name('nalavariyam_checkphone');
Route::post('/nalavariyam_servicepayment', [App\Http\Controllers\NalavariyamServiceController::class, 'nalavariyam_servicepayment'])->name('nalavariyam_servicepayment');
Route::post('/nalavariyam_createapplication', [App\Http\Controllers\NalavariyamServiceController::class, 'nalavariyam_createapplication'])->name('nalavariyam_createapplication');
Route::get('/nalavariyam/form/pending', [App\Http\Controllers\NalavariyamServiceController::class, 'pending'])->name('pending');
Route::get('/nalavariyam/form/resubmit', [App\Http\Controllers\NalavariyamServiceController::class, 'Resubmit'])->name('resubmit');
Route::get('/nalavariyam/form/approved', [App\Http\Controllers\NalavariyamServiceController::class, 'Approved'])->name('approved');
Route::post('/nalavariyam_formstatus', [App\Http\Controllers\NalavariyamServiceController::class, 'nalavariyam_formstatus'])->name('nalavariyam_formstatus');
Route::post('/updatecompleteddetails', [App\Http\Controllers\NalavariyamServiceController::class, 'updatecompleteddetails'])->name('updatecompleteddetails');
Route::get('/createbill/{id}', [App\Http\Controllers\NalavariyamServiceController::class, 'createbill'])->name('createbill');
Route::get('/receipt/{id}/{custid}', [App\Http\Controllers\NalavariyamServiceController::class, 'receipt'])->name('receipt');
Route::get('application_status', [App\Http\Controllers\NalavariyamServiceController::class, 'application_status'])->name('application_status');
Route::get('nalavariyam/get_activationamount/{usertype}', [App\Http\Controllers\NalavariyamServiceController::class, 'get_activationamount'])->name('get_activationamount');
Route::get('getnalavariyam_data/{distid}', [App\Http\Controllers\NalavariyamServiceController::class, 'getnalavariyam_data'])->name('getnalavariyam_data');
Route::get('nalauseractivationpayment', [App\Http\Controllers\NalavariyamServiceController::class, 'nalauseractivationpayment'])->name('nalauseractivationpayment');
Route::post('savenalavariyamactivation', [App\Http\Controllers\NalavariyamServiceController::class, 'savenalavariyamactivation'])->name('savenalavariyamactivation');
Route::post('savebulkbuy', [App\Http\Controllers\NalavariyamServiceController::class, 'savebulkbuy'])->name('savebulkbuy');
Route::get('bulkorder', [App\Http\Controllers\NalavariyamServiceController::class, 'bulkorder'])->name('bulkorder');
Route::get('viewbulkorder/{id}', [App\Http\Controllers\NalavariyamServiceController::class, 'viewbulkorder'])->name('viewbulkorder');
Route::get('bulkorders', [App\Http\Controllers\NalavariyamServiceController::class, 'bulkorders'])->name('bulkorders');
Route::post('updatebulkstatus', [App\Http\Controllers\NalavariyamServiceController::class, 'updatebulkstatus'])->name('updatebulkstatus');
Route::get('bulkorderstatus', [App\Http\Controllers\NalavariyamServiceController::class, 'bulkorderstatus'])->name('bulkorderstatus');
Route::post('upload_offline_form', [App\Http\Controllers\NalavariyamServiceController::class, 'upload_offline_form'])->name('upload_offline_form');
Route::post('updateaddress', [App\Http\Controllers\NalavariyamServiceController::class, 'updateaddress'])->name('updateaddress');

Route::get('/special_member', [App\Http\Controllers\NalavariyamServiceController::class, 'special_member'])->name('special_member');
Route::post('/savespecial_member', [App\Http\Controllers\NalavariyamServiceController::class, 'savespecial_member'])->name('savespecial_member');
Route::post('/update_spl_member', [App\Http\Controllers\NalavariyamServiceController::class, 'update_spl_member'])->name('update_spl_member');
Route::get('splmemberactivationpayment', [App\Http\Controllers\NalavariyamServiceController::class, 'splmemberactivationpayment'])->name('splmemberactivationpayment');
Route::post('savesplmemberactivation', [App\Http\Controllers\NalavariyamServiceController::class, 'savesplmemberactivation'])->name('savesplmemberactivation');
Route::post('updatesplmember_status', [App\Http\Controllers\NalavariyamServiceController::class, 'updatesplmember_status'])->name('updatesplmember_status');

Route::get('/appointment', [App\Http\Controllers\NalavariyamServiceController::class, 'appointment'])->name('appointment');
Route::post('/update_appointment', [App\Http\Controllers\NalavariyamServiceController::class, 'update_appointment'])->name('update_appointment');
Route::post('/add_appointment', [App\Http\Controllers\NalavariyamServiceController::class, 'add_appointment'])->name('add_appointment');
Route::get('/view_appointment', [App\Http\Controllers\NalavariyamServiceController::class, 'view_appointment'])->name('view_appointment');

//CourseController

Route::get('/addcourse', [App\Http\Controllers\CourseController::class, 'addcourse'])->name('addcourse');

Route::get('/viewcourse', [App\Http\Controllers\CourseController::class, 'viewcourse'])->name('viewcourse');

Route::post('/savecourse', [App\Http\Controllers\CourseController::class, 'savecourse'])->name('savecourse');

Route::post('/updatecourse', [App\Http\Controllers\CourseController::class, 'updatecourse'])->name('updatecourse');

Route::get('/courses', [App\Http\Controllers\CourseController::class, 'courses'])->name('courses');

Route::get('/applycourseservice/{serviceid}', [App\Http\Controllers\CourseController::class, 'applycourseservice'])->name('applycourseservice');

//Route::post('/submitapply_tailorshop', [App\Http\Controllers\CourseController::class, 'submitapply_tailorshop'])->name('submitapply_tailorshop');

//CoursestatusController

Route::get('/tailorappliedservice/{status}', [App\Http\Controllers\CoursestatusController::class, 'tailorappliedservice'])->name('tailorappliedservice');

Route::get('/tailoringservicestatus/{status}/{id}/{serviceid}', [App\Http\Controllers\CoursestatusController::class, 'tailoringservicestatus'])->name('tailoringservicestatus');

//Route::post('/tailorshop_update', [App\Http\Controllers\CoursestatusController::class, 'tailorshop_update'])->name('tailorshop_update');

// Canservice

Route::get('addcan', [App\Http\Controllers\CanController::class, 'addcan']);
Route::get('viewcan', [App\Http\Controllers\CanController::class, 'viewcan']);
Route::post('savecan', [App\Http\Controllers\CanController::class, 'savecan']);
Route::post('updatecan', [App\Http\Controllers\CanController::class, 'updatecan']);
Route::post('canupdatestatus', [App\Http\Controllers\CanController::class, 'canupdatestatus']);
Route::get('/applycanservice/{serviceid}', [App\Http\Controllers\CanController::class, 'applycanservice'])->name('applycanservice');

// Software

Route::get('softwareservices/{serviceid}', [App\Http\Controllers\RechargeController::class, 'softwareservices']);
Route::post('/submitapply_software', [App\Http\Controllers\RechargeController::class, 'submitapply_software'])->name('submitapply_software');
Route::post('/software_update', [App\Http\Controllers\ServicestatusController::class, 'software_update'])->name('software_update');

//serverpayment

Route::get('serverpayment', [App\Http\Controllers\ServerPaymentController::class, 'serverpayment']);
Route::post('saveserver_payment', [App\Http\Controllers\ServerPaymentController::class, 'saveserver_payment']);

// Notification

Route::get('addnotification', [App\Http\Controllers\NotificationController::class, 'addnotification']);

Route::get('viewnotification', [App\Http\Controllers\NotificationController::class, 'viewnotification']);

Route::post('savenotification', [App\Http\Controllers\NotificationController::class, 'savenotification']);

Route::post('updatenotification', [App\Http\Controllers\NotificationController::class, 'updatenotification']);

Route::post('notificationstatusupdate', [App\Http\Controllers\NotificationController::class, 'notificationstatusupdate']);

Route::get('/dropnotification/{id}', [App\Http\Controllers\OperatorController::class, 'dropnotification'])->name('dropnotification');

//Enquiry

// Route::get('addenquiry', [App\Http\Controllers\NotificationController::class, 'addenquiry']);

// Route::post('saveenquiry', [App\Http\Controllers\NotificationController::class, 'saveenquiry']);

Route::get('viewenquiry', [App\Http\Controllers\NotificationController::class, 'viewenquiry']);

Route::get('requirement', [App\Http\Controllers\NotificationController::class, 'requirement']);

Route::post('saverequirement', [App\Http\Controllers\NotificationController::class, 'saverequirement']);

Route::post('updaterequirement', [App\Http\Controllers\NotificationController::class, 'updaterequirement']);

Route::get('viewrequirement', [App\Http\Controllers\NotificationController::class, 'viewrequirement']);

//site serverpayment

Route::get('serverpayment', [App\Http\Controllers\ServerPaymentController::class, 'serverpayment']);
Route::get('websitepayment', [App\Http\Controllers\ServerPaymentController::class, 'websitepayment']);
Route::post('saveserver_payment', [App\Http\Controllers\ServerPaymentController::class, 'saveserver_payment']);

Route::get('sitepayment', [App\Http\Controllers\ServicePaymentController::class, 'sitepayment'])->name('sitepayment');
Route::post('save_sitepayment', [App\Http\Controllers\ServicePaymentController::class, 'save_sitepayment'])->name('save_sitepayment');
