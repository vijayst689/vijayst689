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


// Auth //

Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'dashboard']);
Route::get('test', [App\Http\Controllers\DashboardController::class, 'test']);
Route::get('spamusers', [App\Http\Controllers\DashboardController::class, 'spamusers']);
Route::get('user/login', [CustomAuthController::class, 'index'])->name('login');
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
Route::post('checkpanretailerregister', [CustomAuthController::class, 'checkpanretailerregister'])->name('checkpanretailerregister');
Route::post('checkemailregisterretailer', [CustomAuthController::class, 'checkemailregisterretailer'])->name('checkemailregisterretailer');
Route::post('checkaadharregisterretailer', [CustomAuthController::class, 'checkaadharregisterretailer'])->name('checkaadharregisterretailer');
Route::post('checkphoneregisterretailer', [CustomAuthController::class, 'checkphoneregisterretailer'])->name('checkphoneregisterretailer');
Route::post('checkpanregisterretailer', [CustomAuthController::class, 'checkpanregisterretailer'])->name('checkpanregisterretailer');
Route::post('checkemailregistercustomer', [CustomAuthController::class, 'checkemailregistercustomer'])->name('checkemailregistercustomer');
Route::post('checkaadharregistercustomer', [CustomAuthController::class, 'checkaadharregistercustomer'])->name('checkaadharregistercustomer');
Route::post('checkphoneregistercustomer', [CustomAuthController::class, 'checkphoneregistercustomer'])->name('checkphoneregistercustomer');
Route::post('checkemail', [CustomAuthController::class, 'checkemail'])->name('checkemail');
Route::post('checkaadhar', [CustomAuthController::class, 'checkaadhar'])->name('checkaadhar');
Route::post('checkphone', [CustomAuthController::class, 'checkphone'])->name('checkphone');
Route::post('checkpan', [CustomAuthController::class, 'checkpan'])->name('checkpan');
Route::post('check-duplicate', [CustomAuthController::class, 'checkDuplicateAdmin'])
    ->name('check.duplicate');

Route::get('/home', [App\Http\Controllers\UserController::class, 'index']);

Route::get('/changepassword', [App\Http\Controllers\UserController::class, 'changepassword']);

Route::post('/updatepassword', [App\Http\Controllers\UserController::class, 'updatepassword'])->name('updatepassword');

Route::get('addcustomer', [App\Http\Controllers\UserController::class, 'addcustomer']);

Route::get('customers', [App\Http\Controllers\UserController::class, 'customers']);

Route::post('updatecustomer', [App\Http\Controllers\UserController::class, 'updatecustomer']);

Route::post('savecustomer', [App\Http\Controllers\UserController::class, 'savecustomer']);

Route::get('/editcustomer/{id}', [App\Http\Controllers\UserController::class, 'editcustomer'])->name('editcustomer');

Route::post('updatecustomer', [App\Http\Controllers\UserController::class, 'updatecustomer']);

Route::get('dropcustomer/{id}', [App\Http\Controllers\UserController::class, 'dropcustomer']);

Route::get('documents/{id}', [App\Http\Controllers\UserController::class, 'documents']);

Route::post('adddocument', [App\Http\Controllers\UserController::class, 'adddocument']);

Route::get('profile', [App\Http\Controllers\UserController::class, 'Profile']);

Route::post('updateprofile', [App\Http\Controllers\UserController::class, 'updateprofile']);

Route::get('/gettaluk/{distid}', [App\Http\Controllers\UserController::class, 'gettaluk'])->name('gettaluk');

Route::get('/getpanchayath/{taluk_id}', [App\Http\Controllers\UserController::class, 'getpanchayath'])->name('getpanchayath');

Route::get('addretailer', [App\Http\Controllers\RetailerController::class, 'Addretailer']);
Route::get('testapi', [App\Http\Controllers\RetailerController::class, 'testapi']);

Route::post('saveretailer', [App\Http\Controllers\RetailerController::class, 'saveretailer']);

Route::get('retailers', [App\Http\Controllers\RetailerController::class, 'Retailer']);

Route::get('addretailer', [App\Http\Controllers\RetailerController::class, 'Addretailer']);

Route::get('retailer', [App\Http\Controllers\RetailerController::class, 'Retailer']);

Route::get('dropretailer/{id}', [App\Http\Controllers\RetailerController::class, 'dropretailer']);

Route::post('updateretailer', [App\Http\Controllers\RetailerController::class, 'updateretailer']);

Route::post('updatestatus', [App\Http\Controllers\RetailerController::class, 'updatestatus']);

Route::post('adminstatusupdate', [App\Http\Controllers\RetailerController::class, 'adminstatusupdate']);

Route::post('retailerstatusupdate', [App\Http\Controllers\RetailerController::class, 'retailerstatusupdate']);


Route::get('/admins', [App\Http\Controllers\UserController::class, 'admins'])->name('admins');



Route::get('adddistributor', [App\Http\Controllers\DistributorController::class, 'adddistributor']);

Route::get('distributors', [App\Http\Controllers\DistributorController::class, 'distributors']);

Route::post('savedistributor', [App\Http\Controllers\DistributorController::class, 'savedistributor']);

Route::post('updatedistributor', [App\Http\Controllers\DistributorController::class, 'updatedistributor']);

Route::get('dropdistributor/{id}', [App\Http\Controllers\DistributorController::class, 'dropdistributor']);

Route::post('statusupdate', [App\Http\Controllers\DistributorController::class, 'statusupdate']);
Route::post('distristatusupdate', [App\Http\Controllers\DistributorController::class, 'distristatusupdate']);


Route::get('wallet', [App\Http\Controllers\WalletController::class, 'index']);

Route::get('paymentrequest', [App\Http\Controllers\WalletController::class, 'paymentrequest']);

Route::get('rawallet', [App\Http\Controllers\WalletController::class, 'rawallet']);

Route::get('rapaymentrequest', [App\Http\Controllers\WalletController::class, 'rapaymentrequest']);
Route::get('othersite_request', [App\Http\Controllers\WalletController::class, 'othersite_request']);

Route::get('requestpayment', [App\Http\Controllers\WalletController::class, 'requestpayment']);

Route::post('saverequest', [App\Http\Controllers\WalletController::class, 'saverequest']);

Route::post('ramjisaverequest', [App\Http\Controllers\WalletController::class, 'ramjisaverequest']);

Route::post('/adminaddwallet', [App\Http\Controllers\WalletController::class, 'adminaddwallet'])->name('adminaddwallet');

Route::post('/superadminaddwallet', [App\Http\Controllers\WalletController::class, 'superadminaddwallet'])->name('superadminaddwallet');

Route::get('/decline_other_payment/{id}', [App\Http\Controllers\WalletController::class, 'decline_other_payment'])->name('decline_other_payment');
Route::post('/approve_other_payment', [App\Http\Controllers\WalletController::class, 'approve_other_payment'])->name('approve_other_payment');


Route::get('/declinerequest_payment/{id}', [App\Http\Controllers\PaymentsController::class, 'declinerequest_payment'])->name('declinerequest_payment');
Route::post('/approvepayment', [App\Http\Controllers\PaymentsController::class, 'approvepayment'])->name('approvepayment');
Route::post('/approveramjipayment', [App\Http\Controllers\PaymentsController::class, 'approveramjipayment'])->name('approveramjipayment');



Route::get('service', [App\Http\Controllers\ServiceController::class, 'service']);

Route::get('ourservice', [App\Http\Controllers\ServiceController::class, 'ourservice']);

Route::get('viewcanservice', [App\Http\Controllers\ServiceController::class, 'viewcanservice']);

Route::get('viewpattaservice', [App\Http\Controllers\ServiceController::class, 'viewpattaservice']);

Route::get('viewvoter', [App\Http\Controllers\ServiceController::class, 'viewvoter']);

Route::get('/utislpanservices', [App\Http\Controllers\ServiceController::class, 'utislpanservices'])->name('utislpanservices');

Route::get('/viewsoftware', [App\Http\Controllers\ServiceController::class, 'viewsoftware'])->name('viewsoftware');

Route::get('viewcourseservice', [App\Http\Controllers\ServiceController::class, 'viewcourseservice']);

Route::get('viewrationcardservice', [App\Http\Controllers\ServiceController::class, 'viewrationcardservice']);

Route::get('allservice/{customerid}', [App\Http\Controllers\ServiceController::class, 'allservice']);

Route::get('allservices', [App\Http\Controllers\ServiceController::class, 'allservices']);

Route::get('subservice/{id}', [App\Http\Controllers\ServiceController::class, 'subservice']);

Route::post('addsubservice', [App\Http\Controllers\ServiceController::class, 'addsubservice']);

Route::post('updatesubservice', [App\Http\Controllers\ServiceController::class, 'updatesubservice']);

Route::get('viewservice', [App\Http\Controllers\ServiceController::class, 'viewservice']);

Route::post('addservice', [App\Http\Controllers\ServiceController::class, 'addservice']);

Route::post('updateservice', [App\Http\Controllers\ServiceController::class, 'updateservice']);

Route::get('dropservice/{id}', [App\Http\Controllers\ServiceController::class, 'dropservice']);

Route::get('dropsubservice/{id}', [App\Http\Controllers\ServiceController::class, 'dropsubservice']);

Route::get('services/{serviceid}/{customerid}', [App\Http\Controllers\ServiceController::class, 'services']);

Route::get('servicesone/{serviceid}', [App\Http\Controllers\ServiceController::class, 'servicesone']);

Route::post('submit_applyservice', [App\Http\Controllers\ServiceController::class, 'submit_applyservice']);

Route::get('get_subservice/{parentid}', [App\Http\Controllers\ServiceController::class, 'get_subservice']);

Route::get('application', [App\Http\Controllers\ServiceController::class, 'application']);

Route::get('viewapplication/{serviceid}', [App\Http\Controllers\ServiceController::class, 'viewapplication']);


Route::get('/appliedservice/{status}', [App\Http\Controllers\ServicestatusController::class, 'appliedservice'])->name('appliedservice');
Route::get('/servicestatus/{status}/{id}/{serviceid}', [App\Http\Controllers\ServicestatusController::class, 'servicestatus'])->name('servicestatus');

Route::get('applyservice/{serviceid}/{customerid}', [App\Http\Controllers\ServiceController::class, 'applyservice']);

Route::get('applyservices/{serviceid}', [App\Http\Controllers\ServiceController::class, 'applyservices']);

Route::get('service/get_taluk/{distid}', [App\Http\Controllers\ServiceController::class, 'get_taluk'])->name('gettaluk');
Route::get('service/get_panchayath/{taluk_id}', [App\Http\Controllers\ServiceController::class, 'get_panchayath'])->name('getpanchayath');
Route::get('nalavariyam/variyamget_taluk/{districtid}', [App\Http\Controllers\ServiceController::class, 'variyamget_taluk'])->name('variyamget_taluk');

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
Route::post('/submitapply_aadhaarfind', [App\Http\Controllers\ServiceController::class, 'submitapply_aadhaarfind'])->name('submitapply_aadhaarfind');
Route::post('/submitapply_canedit', [App\Http\Controllers\ServiceController::class, 'submitapply_canedit'])->name('submitapply_canedit');
Route::post('/submitsmartcardapply1', [App\Http\Controllers\ServiceController::class, 'submitsmartcardapply1'])->name('submitsmartcardapply1');
Route::post('/bondsubmit', [App\Http\Controllers\ServiceController::class, 'bondsubmit'])->name('bondsubmit');
Route::post('/submitvoterid', [App\Http\Controllers\ServiceController::class, 'submitvoterid'])->name('submitvoterid');
Route::post('/submit_fssaiservice', [App\Http\Controllers\ServiceController::class, 'submit_fssaiservice'])->name('submit_fssaiservice');
Route::post('/submitapply_covid', [App\Http\Controllers\ServiceController::class, 'submitapply_covid'])->name('submitapply_covid');
Route::post('/submitapply_nalavariyam', [App\Http\Controllers\ServiceController::class, 'submitapply_nalavariyam'])->name('submitapply_nalavariyam');
Route::post('/submitapply_driving_license', [App\Http\Controllers\ServiceController::class, 'submitapply_driving_license'])->name('submitapply_driving_license');
Route::post('/submitapply_pancard', [App\Http\Controllers\ServiceController::class, 'submitapply_pancard'])->name('submitapply_pancard');
Route::post('/submitapply_tailorshop', [App\Http\Controllers\ServiceController::class, 'submitapply_tailorshop'])->name('submitapply_tailorshop');
Route::post('/submitapply_birthcertificate', [App\Http\Controllers\ServiceController::class, 'submitapply_birthcertificate'])->name('submitapply_birthcertificate');
Route::post('/savepmkissan', [App\Http\Controllers\ServiceController::class, 'savepmkissan'])->name('savepmkissan');
Route::post('/submitapply_csc_tec', [App\Http\Controllers\ServiceController::class, 'submitapply_csc_tec'])->name('submitapply_csc_tec');
Route::post('/submitapply_insexam', [App\Http\Controllers\ServiceController::class, 'submitapply_insexam'])->name('submitapply_insexam');
Route::post('/submitapply_iibf_exam_register', [App\Http\Controllers\ServiceController::class, 'submitapply_iibf_exam_register'])->name('submitapply_iibf_exam_register');
Route::post('/submitapply_rapexam', [App\Http\Controllers\ServiceController::class, 'submitapply_rapexam'])->name('submitapply_rapexam');
Route::post('/submitapply_vle_insurance', [App\Http\Controllers\ServiceController::class, 'submitapply_vle_insurance'])->name('submitapply_vle_insurance');
Route::post('/submitapply_medicalscheme', [App\Http\Controllers\ServiceController::class, 'submitapply_medicalscheme'])->name('submitapply_medicalscheme');
Route::post('/submitapply_dharsan', [App\Http\Controllers\ServiceController::class, 'submitapply_dharsan'])->name('submitapply_dharsan');
Route::post('/submitutislnew', [App\Http\Controllers\ServiceController::class, 'submitutislnew'])->name('submitutislnew');
Route::post('/submitutisl_corection', [App\Http\Controllers\ServiceController::class, 'submitutisl_corection'])->name('submitutisl_corection');
Route::post('/submitapply_patta', [App\Http\Controllers\ServiceController::class, 'submitapply_patta'])->name('submitapply_patta');
Route::post('/newsmartcard_register', [App\Http\Controllers\ServiceController::class, 'newsmartcard_register'])->name('newsmartcard_register');
Route::post('/submitapply_smart_member', [App\Http\Controllers\ServiceController::class, 'submitapply_smart_member'])->name('submitapply_smart_member');
Route::post('/submitapply_smartcardotp', [App\Http\Controllers\ServiceController::class, 'submitapply_smartcardotp'])->name('submitapply_smartcardotp');
Route::post('/submitapply_pstm', [App\Http\Controllers\ServiceController::class, 'submitapply_pstm'])->name('submitapply_pstm');
Route::post('/submitapply_smart_nametransfer', [App\Http\Controllers\ServiceController::class, 'submitapply_smart_nametransfer'])->name('submitapply_smart_nametransfer');
Route::post('/smartcard_update', [App\Http\Controllers\ServicestatusController::class, 'smartcard_update'])->name('smartcard_update');
Route::post('/submitapply_smartcard', [App\Http\Controllers\ServiceController::class, 'submitapply_smartcard'])->name('submitapply_smartcard');
Route::post('/submitapply_employement', [App\Http\Controllers\ServiceController::class, 'submitapply_employement'])->name('submitapply_employement');
Route::post('/submitapply_police', [App\Http\Controllers\ServiceController::class, 'submitapply_police'])->name('submitapply_police');
Route::post('/submitapply_voteridpdfdownload', [App\Http\Controllers\ServiceController::class, 'submitapply_voteridpdfdownload'])->name('submitapply_voteridpdfdownload');
Route::post('/submitapply_agri_stack', [App\Http\Controllers\ServiceController::class, 'submitapply_agri_stack'])->name('submitapply_agri_stack');
Route::post('/submitapply_smartcard_pdf', [App\Http\Controllers\ServiceController::class, 'submitapply_smartcard_pdf'])->name('submitapply_smartcard_pdf');
Route::post('/submitapply_manualpdf', [App\Http\Controllers\ServiceController::class, 'submitapply_manualpdf'])->name('submitapply_manualpdf');
Route::post('/submitapply_smartcard_correction', [App\Http\Controllers\ServiceController::class, 'submitapply_smartcard_correction'])->name('submitapply_smartcard_correction');
Route::post('/submittnegacommunity', [App\Http\Controllers\ServiceController::class, 'submittnegacommunity'])->name('submittnegacommunity');
Route::post('/submittnegaincome', [App\Http\Controllers\ServiceController::class, 'submittnegaincome'])->name('submittnegaincome');
Route::post('/submittneganativity', [App\Http\Controllers\ServiceController::class, 'submittneganativity'])->name('submittneganativity');
Route::post('/submittnegaresidence', [App\Http\Controllers\ServiceController::class, 'submittnegaresidence'])->name('submittnegaresidence');
Route::post('/submittnegaunemployed', [App\Http\Controllers\ServiceController::class, 'submittnegaunemployed'])->name('submittnegaunemployed');
Route::post('/submittnegaobc', [App\Http\Controllers\ServiceController::class, 'submittnegaobc'])->name('submittnegaobc');
Route::post('/submittnegaunmarried', [App\Http\Controllers\ServiceController::class, 'submittnegaunmarried'])->name('submittnegaunmarried');
Route::post('/submittnegahandicap', [App\Http\Controllers\ServiceController::class, 'submittnegahandicap'])->name('submittnegahandicap');
Route::post('/submittnegawidow', [App\Http\Controllers\ServiceController::class, 'submittnegawidow'])->name('submittnegawidow');
Route::post('/submittnegagraduate', [App\Http\Controllers\ServiceController::class, 'submittnegagraduate'])->name('submittnegagraduate');


// Update Status
Route::post('/submit_statusupdate_smallagriservice', [App\Http\Controllers\ServicestatusController::class, 'submit_statusupdate_smallagriservice'])->name('submit_statusupdate_smallagriservice');
Route::post('/submit_statusupdate_incomecertificate', [App\Http\Controllers\ServicestatusController::class, 'submit_statusupdate_incomecertificate'])->name('submit_statusupdate_incomecertificate');
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
Route::post('/submit_statusupdate_teccorrection', [App\Http\Controllers\ServicestatusController::class, 'submit_statusupdate_teccorrection'])->name('submit_statusupdate_teccorrection');
Route::post('/submit_statusupdate_tecexamregister', [App\Http\Controllers\ServicestatusController::class, 'submit_statusupdate_tecexamregister'])->name('submit_statusupdate_tecexamregister');
Route::post('/submitsmartcard_register_update', [App\Http\Controllers\ServicestatusController::class, 'submitsmartcard_register_update'])->name('submitsmartcard_register_update');
Route::post('/aadhaarcardupdate', [App\Http\Controllers\ServicestatusController::class, 'aadhaarcardupdate'])->name('aadhaarcardupdate');
Route::post('/aadhaarfind_update', [App\Http\Controllers\ServicestatusController::class, 'aadhaarfind_update'])->name('aadhaarfind_update');
Route::post('/caneditupdate', [App\Http\Controllers\ServicestatusController::class, 'caneditupdate'])->name('caneditupdate');
Route::post('/smartcard_update1', [App\Http\Controllers\ServicestatusController::class, 'smartcard_update1'])->name('smartcard_update1');
Route::post('/bond_update', [App\Http\Controllers\ServicestatusController::class, 'bond_update'])->name('bond_update');
Route::post('/voterid_update', [App\Http\Controllers\ServicestatusController::class, 'voterid_update'])->name('voterid_update');
Route::post('/fssaiservice_update', [App\Http\Controllers\ServicestatusController::class, 'fssaiservice_update'])->name('fssaiservice_update');
Route::post('/covid_update', [App\Http\Controllers\ServicestatusController::class, 'covid_update'])->name('covid_update');
Route::post('/nalavariyam_update', [App\Http\Controllers\ServicestatusController::class, 'nalavariyam_update'])->name('nalavariyam_update');
Route::post('/driving_license_update', [App\Http\Controllers\ServicestatusController::class, 'driving_license_update'])->name('driving_license_update');
Route::post('/pancard_update', [App\Http\Controllers\ServicestatusController::class, 'pancard_update'])->name('pancard_update');
Route::post('/tailorshop_update', [App\Http\Controllers\ServicestatusController::class, 'tailorshop_update'])->name('tailorshop_update');
Route::post('/update_pmkissan', [App\Http\Controllers\ServicestatusController::class, 'update_pmkissan'])->name('update_pmkissan');
Route::post('/birthcertificate_update', [App\Http\Controllers\ServicestatusController::class, 'birthcertificate_update'])->name('birthcertificate_update');
Route::post('/tec_csc_update', [App\Http\Controllers\ServicestatusController::class, 'tec_csc_update'])->name('tec_csc_update');
Route::post('/insexam_update', [App\Http\Controllers\ServicestatusController::class, 'insexam_update'])->name('insexam_update');
Route::post('/iibfexam_update', [App\Http\Controllers\ServicestatusController::class, 'iibfexam_update'])->name('iibfexam_update');
Route::post('/rapexam_update', [App\Http\Controllers\ServicestatusController::class, 'rapexam_update'])->name('rapexam_update');
Route::post('/vleinsurance_update', [App\Http\Controllers\ServicestatusController::class, 'vleinsurance_update'])->name('vleinsurance_update');
Route::post('/medicalscheme_update', [App\Http\Controllers\ServicestatusController::class, 'medicalscheme_update'])->name('medicalscheme_update');
Route::post('/dharsan_update', [App\Http\Controllers\ServicestatusController::class, 'dharsan_update'])->name('dharsan_update');
Route::post('/utislupdate', [App\Http\Controllers\ServicestatusController::class, 'utislupdate'])->name('utislupdate');
Route::post('/utislcorection_update', [App\Http\Controllers\ServicestatusController::class, 'utislcorection_update'])->name('utislcorection_update');
Route::post('/patta_update', [App\Http\Controllers\ServicestatusController::class, 'patta_update'])->name('patta_update');
Route::post('/cancertificate_find_update', [App\Http\Controllers\ServicestatusController::class, 'cancertificate_find_update'])->name('cancertificate_find_update');
Route::post('/newsmartcardupdate', [App\Http\Controllers\ServicestatusController::class, 'newsmartcardupdate'])->name('newsmartcardupdate');
Route::post('/smartcardotp_update', [App\Http\Controllers\ServicestatusController::class, 'smartcardotp_update'])->name('smartcardotp_update');
Route::post('/smartcard_member_update', [App\Http\Controllers\ServicestatusController::class, 'smartcard_member_update'])->name('smartcard_member_update');
Route::post('/smartcard_nametransfer_update', [App\Http\Controllers\ServicestatusController::class, 'smartcard_nametransfer_update'])->name('smartcard_nametransfer_update');
Route::post('/pstm_update', [App\Http\Controllers\ServicestatusController::class, 'pstm_update'])->name('pstm_update');
Route::post('/employment_update', [App\Http\Controllers\ServicestatusController::class, 'employment_update'])->name('employment_update');
Route::post('/police_update', [App\Http\Controllers\ServicestatusController::class, 'police_update'])->name('police_update');
Route::post('/voteridpdf_statusupdate', [App\Http\Controllers\ServicestatusController::class, 'voteridpdf_statusupdate'])->name('voteridpdf_statusupdate');
Route::post('/agristack_update', [App\Http\Controllers\ServicestatusController::class, 'agristack_update'])->name('agristack_update');
Route::post('/smartcard_pdf_statusupdate', [App\Http\Controllers\ServicestatusController::class, 'smartcard_pdf_statusupdate'])->name('smartcard_pdf_statusupdate');
Route::post('/manualpdf_update', [App\Http\Controllers\ServicestatusController::class, 'manualpdf_update'])->name('manualpdf_update');
Route::post('/smartcard_correction_update', [App\Http\Controllers\ServicestatusController::class, 'smartcard_correction_update'])->name('smartcard_correction_update');
Route::post('/submittnegacommunityupdate', [App\Http\Controllers\ServicestatusController::class, 'submittnegacommunityupdate'])->name('submittnegacommunityupdate');
Route::post('/submittneganativityupdate', [App\Http\Controllers\ServicestatusController::class, 'submittneganativityupdate'])->name('submittneganativityupdate');
Route::post('/submittnegaresidenceupdate', [App\Http\Controllers\ServicestatusController::class, 'submittnegaresidenceupdate'])->name('submittnegaresidenceupdate');
Route::post('/submittnegaunemployedupdate', [App\Http\Controllers\ServicestatusController::class, 'submittnegaunemployedupdate'])->name('submittnegaunemployedupdate');
Route::post('/submittnegaincomeupdate', [App\Http\Controllers\ServicestatusController::class, 'submittnegaincomeupdate'])->name('submittnegaincomeupdate');
Route::post('/submittnegaobcdupdate', [App\Http\Controllers\ServicestatusController::class, 'submittnegaobcdupdate'])->name('submittnegaobcdupdate');
Route::post('/submittnegaunmarriedupdate', [App\Http\Controllers\ServicestatusController::class, 'submittnegaunmarriedupdate'])->name('submittnegaunmarriedupdate');
Route::post('/submittnegahandicapupdate', [App\Http\Controllers\ServicestatusController::class, 'submittnegahandicapupdate'])->name('submittnegahandicapupdate');
Route::post('/submittnegawidowupdate', [App\Http\Controllers\ServicestatusController::class, 'submittnegawidowupdate'])->name('submittnegawidowupdate');
Route::post('/submittnegagraduateupdate', [App\Http\Controllers\ServicestatusController::class, 'submittnegagraduateupdate'])->name('submittnegagraduateupdate');


Route::get('/panfind', [App\Http\Controllers\ServiceController::class, 'panfind'])->name('panfind');

Route::get('/dlfind', [App\Http\Controllers\ServiceController::class, 'dlfind'])->name('dlfind');

Route::get('/panadvance', [App\Http\Controllers\ServiceController::class, 'panadvance'])->name('panadvance');

Route::get('/rcfind', [App\Http\Controllers\ServiceController::class, 'rcfind'])->name('rcfind');

Route::get('/rationcardverify', [App\Http\Controllers\ServiceController::class, 'rationcardverify'])->name('rationcardverify');

// Service Payment

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

Route::get('/useractivation/{activation_id}', [App\Http\Controllers\ServicePaymentController::class, 'useractivation'])->name('useractivation');

Route::post('adduser_activation', [App\Http\Controllers\ServicePaymentController::class, 'adduser_activation'])->name('adduser_activation');

Route::post('adduser_activationpdf', [App\Http\Controllers\ServicePaymentController::class, 'adduser_activationpdf'])->name('adduser_activationpdf');

// Recharge Controller

Route::get('utilityservices/{serviceid}', [App\Http\Controllers\RechargeController::class, 'utilityservices']);
Route::post('proceedrecharge', [App\Http\Controllers\RechargeController::class, 'proceedrecharge']);
Route::get('rechargehook', [App\Http\Controllers\RechargeController::class, 'rechargehook']);

Route::get('/utility', [App\Http\Controllers\RechargeController::class, 'utility'])->name('utility');
Route::get('/utilityservice/{serviceid}', [App\Http\Controllers\RechargeController::class, 'utilityservice'])->name('utilityservice');
Route::post('proceedrecharge', [App\Http\Controllers\RechargeController::class, 'proceedrecharge']);
Route::get('rechargehook', [App\Http\Controllers\RechargeController::class, 'rechargehook']);
Route::get('panstatus', [App\Http\Controllers\ServiceController::class, 'panstatus']);
Route::get('pancard_reapply/{txid}', [App\Http\Controllers\ServiceController::class, 'pancard_reapply']);



// PDF Controller
Route::get('/getcaptcha', [App\Http\Controllers\PDFServiceController::class, 'getcaptcha'])->name('getcaptcha');
Route::post('/submitaadhaar_verify', [App\Http\Controllers\PDFServiceController::class, 'submitaadhaar_verify'])->name('submitaadhaar_verify');

Route::get('/applypdfservice/{serviceid}', [App\Http\Controllers\PDFServiceController::class, 'applypdfservice'])->name('applypdfservice');
Route::get('/addfindservice', [App\Http\Controllers\PDFServiceController::class, 'addfindservice'])->name('addfindservice');
Route::post('/savefind', [App\Http\Controllers\PDFServiceController::class, 'savefind'])->name('savefind');
Route::post('/updatefind', [App\Http\Controllers\PDFServiceController::class, 'updatefind'])->name('updatefind');
Route::get('/viewfind', [App\Http\Controllers\PDFServiceController::class, 'viewfind'])->name('viewfind');

Route::post('/updatestatus', [App\Http\Controllers\PDFServiceController::class, 'updatestatus'])->name('updatestatus');

Route::get('/pdfservices', [App\Http\Controllers\PDFServiceController::class, 'pdfservices'])->name('pdfservices');

Route::post('/submitpanfind', [App\Http\Controllers\PDFServiceController::class, 'submitpanfind'])->name('submitpanfind');
Route::post('/submitdlfind', [App\Http\Controllers\PDFServiceController::class, 'submitdlfind'])->name('submitdlfind');
Route::post('/submitrcfind', [App\Http\Controllers\PDFServiceController::class, 'submitrcfind'])->name('submitrcfind');
Route::post('/submitrationfind', [App\Http\Controllers\PDFServiceController::class, 'submitrationfind'])->name('submitrationfind');
Route::post('/submitpanadvance', [App\Http\Controllers\PDFServiceController::class, 'submitpanadvance'])->name('submitpanadvance');

Route::post('/submitvoterfind', [App\Http\Controllers\PDFServiceController::class, 'submitvoterfind'])->name('submitvoterfind');

Route::post('/submitgstfind', [App\Http\Controllers\PDFServiceController::class, 'submitgstfind'])->name('submitgstfind');

Route::post('/savevoter', [App\Http\Controllers\PDFServiceController::class, 'savevoter'])->name('savevoter');

Route::get('/getepic/{epic_no}', [App\Http\Controllers\PDFServiceController::class, 'getepic'])->name('getepic');

Route::get('/getotp/{otp}', [App\Http\Controllers\PDFServiceController::class, 'getotp'])->name('getotp');

Route::get('/getpdfotp/{epic_no}', [App\Http\Controllers\PDFServiceController::class, 'getpdfotp'])->name('getpdfotp');

Route::post('/submitvoterpdf', [App\Http\Controllers\PDFServiceController::class, 'submitvoterpdf'])->name('submitvoterpdf');

Route::get('/getpdf', [App\Http\Controllers\PDFServiceController::class, 'getpdf'])->name('getpdf');
Route::post('/submitsharmcard', [App\Http\Controllers\PDFServiceController::class, 'submitsharmcard'])->name('submitsharmcard');
Route::post('/submitvehicle_mobilefind', [App\Http\Controllers\PDFServiceController::class, 'submitvehicle_mobilefind'])->name('submitvehicle_mobilefind');
Route::post('/submitagristackcard', [App\Http\Controllers\PDFServiceController::class, 'submitagristackcard'])->name('submitagristackcard');

//PermissionController

Route::get('/userpermission/{userid}', [App\Http\Controllers\PermissionController::class, 'userpermission'])->name('userpermission');
Route::post('/savepermission', [App\Http\Controllers\PermissionController::class, 'savepermission'])->name('savepermission');
Route::get('/nalavariyam_permission/{userid}', [App\Http\Controllers\PermissionController::class, 'nalavariyam_permission'])->name('nalavariyam_permission');
Route::get('activation/get_activationamount/{userid}/{activation_userid}/{service_id}', [App\Http\Controllers\PermissionController::class, 'get_activationamount'])->name('get_activationamount');
Route::get('syncSubServicePermissions', [App\Http\Controllers\PermissionController::class, 'syncSubServicePermissions'])->name('syncSubServicePermissions');
//RechargeController

Route::get('/utility', [App\Http\Controllers\RechargeController::class, 'utility'])->name('utility');
Route::get('/utilityservice/{serviceid}', [App\Http\Controllers\RechargeController::class, 'utilityservice'])->name('utilityservice');
Route::post('proceedrecharge', [App\Http\Controllers\RechargeController::class, 'proceedrecharge']);
Route::get('rechargehook', [App\Http\Controllers\RechargeController::class, 'rechargehook']);
Route::get('panstatus', [App\Http\Controllers\ServiceController::class, 'panstatus']);
Route::get('pancard_reapply/{txid}', [App\Http\Controllers\ServiceController::class, 'pancard_reapply']);

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

Route::get('/special_member', [App\Http\Controllers\NalavariyamServiceController::class, 'special_member'])->name('special_member');
Route::post('/savespecial_member', [App\Http\Controllers\NalavariyamServiceController::class, 'savespecial_member'])->name('savespecial_member');
Route::post('/update_spl_member', [App\Http\Controllers\NalavariyamServiceController::class, 'update_spl_member'])->name('update_spl_member');
Route::get('splmemberactivationpayment', [App\Http\Controllers\NalavariyamServiceController::class, 'splmemberactivationpayment'])->name('splmemberactivationpayment');
Route::post('savesplmemberactivation', [App\Http\Controllers\NalavariyamServiceController::class, 'savesplmemberactivation'])->name('savesplmemberactivation');
Route::post('updatesplmember_status', [App\Http\Controllers\NalavariyamServiceController::class, 'updatesplmember_status'])->name('updatesplmember_status');

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

//PanController

Route::get('/addpan', [App\Http\Controllers\PanController::class, 'addpan'])->name('addpan');

Route::get('/viewpan', [App\Http\Controllers\PanController::class, 'viewpan'])->name('viewpan');

Route::post('/savepan', [App\Http\Controllers\PanController::class, 'savepan'])->name('savepan');

Route::post('/updatepan', [App\Http\Controllers\PanController::class, 'updatepan'])->name('updatepan');

Route::get('/panservices', [App\Http\Controllers\PanController::class, 'panservices'])->name('panservices');

Route::get('/applypanservice/{serviceid}', [App\Http\Controllers\PanController::class, 'applypanservice'])->name('applypanservice');

Route::post('/submitnewpancard', [App\Http\Controllers\PanController::class, 'submitnewpancard'])->name('submitnewpancard');
Route::post('/submitpancorrection', [App\Http\Controllers\PanController::class, 'submitpancorrection'])->name('submitpancorrection');
Route::get('pancard_reapply/{txid}/{serviceid}', [App\Http\Controllers\PanController::class, 'pancard_reapply']);


//CourseController

Route::get('/addcourse', [App\Http\Controllers\CourseController::class, 'addcourse'])->name('addcourse');

Route::get('/viewcourse', [App\Http\Controllers\CourseController::class, 'viewcourse'])->name('viewcourse');

Route::post('/savecourse', [App\Http\Controllers\CourseController::class, 'savecourse'])->name('savecourse');

Route::post('/updatecourse', [App\Http\Controllers\CourseController::class, 'updatecourse'])->name('updatecourse');

Route::get('/courses', [App\Http\Controllers\CourseController::class, 'courses'])->name('courses');

Route::get('/applycourseservice/{serviceid}', [App\Http\Controllers\CourseController::class, 'applycourseservice'])->name('applycourseservice');

//Route::post('/submitapply_tailorshop', [App\Http\Controllers\CourseController::class, 'submitapply_tailorshop'])->name('submitapply_tailorshop');

//CoursestatusController

//Route::get('/tailorappliedservice/{status}', [App\Http\Controllers\CoursestatusController::class, 'tailorappliedservice'])->name('tailorappliedservice');

//Route::get('/tailoringservicestatus/{status}/{id}/{serviceid}', [App\Http\Controllers\CoursestatusController::class, 'tailoringservicestatus'])->name('tailoringservicestatus');

//Route::post('/tailorshop_update', [App\Http\Controllers\CoursestatusController::class, 'tailorshop_update'])->name('tailorshop_update');

// Software

Route::get('softwareservices/{serviceid}', [App\Http\Controllers\RechargeController::class, 'softwareservices']);
Route::post('/submitapply_software', [App\Http\Controllers\RechargeController::class, 'submitapply_software'])->name('submitapply_software');
Route::post('/software_update', [App\Http\Controllers\ServicestatusController::class, 'software_update'])->name('software_update');

// Banner

Route::get('bannerservices/{serviceid}', [App\Http\Controllers\BannerController::class, 'bannerservices']);
Route::post('/submitapply_banner', [App\Http\Controllers\BannerController::class, 'submitapply_banner'])->name('submitapply_banner');
Route::post('/banner_update', [App\Http\Controllers\ServicestatusController::class, 'banner_update'])->name('banner_update');

// Notification

Route::get('addnotification', [App\Http\Controllers\NotificationController::class, 'addnotification']);

Route::get('viewnotification', [App\Http\Controllers\NotificationController::class, 'viewnotification']);

Route::post('savenotification', [App\Http\Controllers\NotificationController::class, 'savenotification']);

Route::post('updatenotification', [App\Http\Controllers\NotificationController::class, 'updatenotification']);

Route::post('notificationstatusupdate', [App\Http\Controllers\NotificationController::class, 'notificationstatusupdate']);

Route::get('/dropnotification/{id}', [App\Http\Controllers\OperatorController::class, 'dropnotification'])->name('dropnotification');

//serverpayment

Route::get('serverpayment', [App\Http\Controllers\ServerPaymentController::class, 'serverpayment']);
Route::post('saveserver_payment', [App\Http\Controllers\ServerPaymentController::class, 'saveserver_payment']);

//Website

Route::get('website', [App\Http\Controllers\WebsiteController::class, 'website']);
Route::post('savewebsite', [App\Http\Controllers\WebsiteController::class, 'savewebsite']);
Route::post('updatewebsite', [App\Http\Controllers\WebsiteController::class, 'updatewebsite']);

//site payment
Route::get('websitepayment', [App\Http\Controllers\ServerPaymentController::class, 'websitepayment']);
Route::post('saveserver_payment', [App\Http\Controllers\ServerPaymentController::class, 'saveserver_payment']);

Route::get('sitepayment', [App\Http\Controllers\ServicePaymentController::class, 'sitepayment'])->name('sitepayment');
Route::post('save_sitepayment', [App\Http\Controllers\ServicePaymentController::class, 'save_sitepayment'])->name('save_sitepayment');

//Nalavariyam

Route::get('nalavariyam/wallet', [App\Http\Controllers\NalavariyamWalletController::class, 'index'])->name('nalavariyamwallet');
Route::get('nalavariyam/request', [App\Http\Controllers\NalavariyamWalletController::class, 'nalavariyam_request'])->name('nalavariyam_request');
Route::post('nalavariyam/wallet/add', [App\Http\Controllers\NalavariyamWalletController::class, 'addMoney'])->name('addMoney');
Route::post('nalavariyam/payment/approve', [App\Http\Controllers\NalavariyamWalletController::class, 'approve'])->name('addMoney');
Route::get('nalavariyam/payment/decline/{id}', [App\Http\Controllers\NalavariyamWalletController::class, 'decline'])->name('addMoney');

//admin payment

Route::get('/payment/logs', [App\Http\Controllers\ServicePaymentController::class, 'fetchLogs']);
Route::get('/payment/summary', [App\Http\Controllers\ServicePaymentController::class, 'showSummary']);

Route::get('/appointment', [App\Http\Controllers\NalavariyamServiceController::class, 'appointment'])->name('appointment');
Route::post('/update_appointment', [App\Http\Controllers\NalavariyamServiceController::class, 'update_appointment'])->name('update_appointment');
Route::post('/add_appointment', [App\Http\Controllers\NalavariyamServiceController::class, 'add_appointment'])->name('add_appointment');
Route::get('/view_appointment', [App\Http\Controllers\NalavariyamServiceController::class, 'view_appointment'])->name('view_appointment');


Route::get('/approved-list', [App\Http\Controllers\ServicestatusController::class, 'approvedList'])
    ->name('approved.list');

//MEETING
Route::get('/meetinglist', [App\Http\Controllers\MeetingController::class, 'meetinglist'])->name('meeting.list');
Route::post('/savemeeting', [App\Http\Controllers\MeetingController::class, 'savemeeting'])->name('meeting.save');
Route::post('/updatemeeting', [App\Http\Controllers\MeetingController::class, 'updatemeeting'])->name('meeting.update');
Route::post('/deletemeeting/{id}', [App\Http\Controllers\MeetingController::class, 'deletemeeting'])->name('meeting.delete');
Route::get('/meeting/register/{id}', [App\Http\Controllers\MeetingController::class, 'meetingregister'])->name('meeting.register');
Route::post('/paymeeting', [App\Http\Controllers\MeetingController::class, 'create'])->name('meeting.pay');
Route::get('/meeting/return/{order_id}', [App\Http\Controllers\MeetingController::class, 'return'])->name('meeting.return');
Route::get('/meeting/success/{order_id}', [App\Http\Controllers\MeetingController::class, 'success'])->name('meeting.success');
Route::get('/meeting/failed/{order_id}', [App\Http\Controllers\MeetingController::class, 'failed'])->name('meeting.failed');
//Route::get('/meeting/pass/download/{id}', [App\Http\Controllers\MeetingController::class, 'downloadPass'])
Route::get('/meeting-pass/{id}',[App\Http\Controllers\MeetingController::class,'viewPass'])->name('meeting.pass.download');
Route::get('/meeting/{id}/users', [App\Http\Controllers\MeetingController::class, 'meetingUsers']);
Route::post('/meeting/update-details', [App\Http\Controllers\MeetingController::class, 'updateDetails'])->name('meeting.update.details');
Route::post('/attendance/update', [App\Http\Controllers\MeetingController::class,'updateAttendance']);
Route::get('/viewmeetinglist', [App\Http\Controllers\MeetingController::class,'viewmeetinglist']);


// Nalavariyam AutoMatic Payment

    Route::post('/create', 
        [App\Http\Controllers\NalavariyamOnlinePaymentController::class, 'create']
    )->name('nalavariyamonline.create');

    Route::get('/return/{order_id}', 
        [App\Http\Controllers\NalavariyamOnlinePaymentController::class, 'return']
    )->name('nalavariyamonline.return');

    Route::get('/success/{order_id}', 
        [App\Http\Controllers\NalavariyamOnlinePaymentController::class, 'success']
    )->name('nalavariyamonline.success');

    Route::get('/failed/{order_id}', 
        [App\Http\Controllers\NalavariyamOnlinePaymentController::class, 'failed']
    )->name('nalavariyamonline.failed');
    
Route::get(
    '/fetch-farmer-data',
    [App\Http\Controllers\PDFServiceController::class,'fetchFarmerData']
);

Route::post(
    '/save-farmer-pdf',
    [App\Http\Controllers\PDFServiceController::class,'saveFarmerPdf']
)->name('save.farmer.pdf');


Route::get('/dl-pdf/fetch', [App\Http\Controllers\PDFServiceController::class,'fetchApiData'])->name('dlpdf.fetch');
Route::post('/dl-pdf/save', [App\Http\Controllers\PDFServiceController::class,'saveDlPdf'])->name('save.dl.pdf');

        Route::get('/check-wallet-balance/{userid}/{amount}', function ($userid, $amount) {
    $wallet = DB::table('users')
        ->where('id', $userid)
        ->sum('wallet');

    return response()->json([
        'status' => 'success',
        'wallet_balance' => number_format($wallet, 2, '.', ''),
        'has_balance' => $wallet >= $amount,
        'message' => $wallet >= $amount
            ? 'Sufficient wallet balance.'
            : 'Insufficient wallet balance.'
    ]);
});

Route::get(
    '/idcard-pdf/{id}',
    [App\Http\Controllers\NalavariyamServiceController::class,'idcardPdf']
);
Route::Post(
    '/updatenalavariyam_member',
    [App\Http\Controllers\NalavariyamServiceController::class,'updatenalavariyam_member']
)->name('updatenalavariyam_member');
Route::get('additionaldistrict', [App\Http\Controllers\NalavariyamServiceController::class, 'additionaldistrict'])->name('additionaldistrict');
Route::post('saveadditionaldistrict', [App\Http\Controllers\NalavariyamServiceController::class, 'saveadditionaldistrict'])->name('saveadditionaldistrict');


Route::post('/search-customer-aadhaar', [App\Http\Controllers\ServiceController::class, 'searchCustomerAadhaar']);
Route::get('/service/check-customer-otp', [App\Http\Controllers\ServicestatusController::class, 'checkCustomerOtp'])->name('service.check-customer-otp');
Route::post('/service/verify-customer-otp', [App\Http\Controllers\ServicestatusController::class, 'verifyCustomerOtp'])->name('service.verify-customer-otp');
