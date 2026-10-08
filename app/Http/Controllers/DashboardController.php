<?php
namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
// ✅ ADD THIS

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->restrictIfNotActivated();
            return $next($request);
        });
        $this->middleware(function ($request, $next) {
            $this->restrictIfSitePaymentDueFromSession();
            return $next($request);
        });
        $this->middleware('auth');
    }

    public function test()
    {
    //     $payload = [
    //         'timestamp' => round(microtime(true) * 1000), // milliseconds
    //         'partnerId' => 'PS001873', // replace with actual partnerId
    //         'reqid'     => rand(100000, 999999), // unique integer per request
    //     ];
    //     $token = JwtService::generateToken($payload);
    //     $authorisedKey = 'MDZjYTlkMzQ1MjJkOTA0MjVkNmVmMmNjMWUwY2Q0MTA='; // get from UAT portal

    //     /* $url = 'https://sit.paysprint.in/service-api/api/v1/service/balance/balance/mainbalance'; // Replace 'xyz.xyz' with 'sit.paysprint'

    // $response = Http::withHeaders([
    //     'Authorisedkey' => $authorisedKey,
    //     'Content-Type' => 'application/json',
    //     'Token' => $token, // your actual JWT token
    //     'Accept' => 'application/json',
    // ])->post($url);

    // if ($response->successful()) {
    //     return $response->body(); // or return $response->body(); for raw
    // } else {
    //     return  $response->status();
    // }*/

    //     /* $url = 'https://sit.paysprint.in/service-api/api/v1/service/bill-payment/bill/getoperator';

    // $payload = [
    //     'mode' => 'online/offline', // or 'online' or 'offline'
    // ];


    // $response = Http::withHeaders([
    //     'Authorisedkey' => $authorisedKey,
    //     'Token' => $token,
    //     'Accept' => 'application/json',
    //     'Content-Type' => 'application/json',
    // ])->post($url, $payload);

    // if ($response->successful()) {
    //      echo "<pre>";print_r($response->object());echo "</pre>"; // Parsed JSON array/object
    // }*/

    //     /*$url = 'https://sit.paysprint.in/service-api/api/v1/service/bill-payment/bill/fetchbill';

    // $payload = [
    //     'operator' => '373',
    //     'canumber' => '0717100797',
    //     'mode' => 'online',

    //     // 'ad1' => 'value according to operator', // Optional field, pass if required
    // ];
    // //$payload = json_encode($payload);
    // $response = Http::withHeaders([
    //     'Authorisedkey' => $authorisedKey,
    //     'Token' => $token,
    //     'Accept' => 'application/json',
    //     'Content-Type' => 'application/json',
    // ])->post($url, $payload);

    // if ($response->successful()) {
    //     return $response->object(); // ✅ Returns as object (stdClass)
    // }

    // return response()->json([
    //     'error' => 'Request failed',
    //     'status' => $response->status(),
    //     'message' => $response->body()
    // ], $response->status());*/

    //     $url = 'https://sit.paysprint.in/service-api/api/v1/service/bus/ticket/source';

    //     $payload = [
    //         'mode' => 'online/offline', // or 'online' or 'offline'
    //     ];


    //     $response = Http::withHeaders([
    //         'Authorisedkey' => $authorisedKey,
    //         'Token' => $token,
    //         'Accept' => 'application/json',
    //     ])->post($url);
    //     //dd($response);
    //     if ($response->successful()) {
    //         echo "<pre>";
    //         print_r($response->object());
    //         echo "</pre>"; // Parsed JSON array/object
    //     }
        //dd($response);
$records = DB::table('voteridpdf_download')
    ->where('status', 'Approved')
    ->where('certificate', '!=', '')
    ->where('created_at', '>=', now()->subWeek())
    ->get();

$deletedFiles = [];
$notFoundFiles = [];

foreach ($records as $row) {

    $filePath = public_path('upload/services/apiapproved/' . $row->certificate);

    if (file_exists($filePath)) {

        unlink($filePath);
        $deletedFiles[] = $row->certificate;

    } else {

        $notFoundFiles[] = $row->certificate;

    }
}

return response()->json([
    'deleted_count' => count($deletedFiles),
    'deleted_files' => $deletedFiles,
    'not_found_count' => count($notFoundFiles),
    'not_found_files' => $notFoundFiles,
]);

// Clear DB column

// Display results
echo "<h3>Deleted Files:</h3>";
echo "<pre>";
print_r($deletedFiles);
echo "</pre>";

echo "<h3>Files Not Found:</h3>";
echo "<pre>";
print_r($notFoundFiles);
echo "</pre>";

    }

    public function dashboard()
    {
        $logid = Auth::user()->id;
        if (Auth::check()) {

            $activation = DB::table('users')->where('id', $logid)->get();

            $sql   = "select count(*) as servicecount from services";
            $users = DB::select(DB::raw($sql));
            if (count($users) > 0) {
                $servicecount = $users[0]->servicecount;
            }

            $sql   = "select count(*) as distributor from users where user_type_id = 3";
            $users = DB::select(DB::raw($sql));
            if (count($users) > 0) {
                $distributor = $users[0]->distributor;
            }

            $sql   = "select count(*) as distributor_count from users where user_type_id = 3 and refferal_id = $logid";
            $users = DB::select(DB::raw($sql));
            if (count($users) > 0) {
                $distributor_count = $users[0]->distributor_count;
            }

            $sql   = "select count(*) as customercount from users where user_type_id = 5";
            $users = DB::select(DB::raw($sql));
            if (count($users) > 0) {
                $customercount = $users[0]->customercount;
            }
            $sql   = "select count(*) as customer from users where user_type_id = 5 and refferal_id = $logid";
            $users = DB::select(DB::raw($sql));
            if (count($users) > 0) {
                $customer = $users[0]->customer;
            }

            $sql   = "select count(*) as retailer from users where user_type_id = 4";
            $users = DB::select(DB::raw($sql));
            if (count($users) > 0) {
                $retailer = $users[0]->retailer;
            }

            $sql   = "select count(*) as retailer_count from users where user_type_id = 4 and refferal_id = $logid";
            $users = DB::select(DB::raw($sql));
            if (count($users) > 0) {
                $retailer_count = $users[0]->retailer_count;
            }

            $login         = Auth::user()->id;
            $sql      = "select count(id) as nalcount from nalavariyam_request where status='Pending' and (from_id=$login or to_id = $login)";
            $result   = DB::select(DB::raw($sql));
            $nalcount = 0;
            if (count($result) > 0) {
                $nalcount = $result[0]->nalcount;
            }

            $login         = Auth::user()->id;
            $sql           = "select count(id) as RequestAmount from request_payment where status='Pending' and (from_id=$login or to_id = $login ) and from_id != 2";
            $result        = DB::select(DB::raw($sql));
            $RequestAmount = 0;
            if (count($result) > 0) {
                $RequestAmount = $result[0]->RequestAmount;
            }

            $sql                = "select count(id) as ramjirequestAmount from request_payment where status='Pending' and (from_id=2 or to_id = 1) ";
            $result             = DB::select(DB::raw($sql));
            $ramjirequestAmount = 0;
            if (count($result) > 0) {
                $ramjirequestAmount = $result[0]->ramjirequestAmount;
            }

            $sql             = "select count(id) as othersite_count from wallet_topup_api where status='Pending' ";
            $result          = DB::select(DB::raw($sql));
            $othersite_count = 0;
            if (count($result) > 0) {
                $othersite_count = $result[0]->othersite_count;
            }

            $sql   = "select count(*) as service from services";
            $users = DB::select(DB::raw($sql));
            if (count($users) > 0) {
                $service = $users[0]->service;
            }

            $today = Carbon::today();

            $meeting = DB::table('meetinglist')
                ->where('status', 'Active')
                ->whereDate('meetingdate', '>=', $today)
                ->orderBy('meetingdate', 'asc')
                ->first();

            $notify = DB::table('notification')->where('status', 'Active')->orderBy('id', 'Asc')->get();

            $ourservice = DB::table('services')->where('status', '=', 'Active')->where('api_id', 2)->orderBy('id', 'Asc')->get();

            if (Auth::user()->user_type_id == 2 || Auth::user()->user_type_id == 1) {

                $service = DB::table('msme')
                    ->where('status', 'Pending')
                    ->orderBy('id', 'Desc')->count();

                $itr = DB::table('itr')
                    ->where('status', 'Pending')
                    ->orderBy('id', 'Desc')->count();

                $gst = DB::table('gst')
                    ->where('status', 'Pending')
                    ->orderBy('id', 'Desc')->count();

                $tec_exam = DB::table('tec_exam')
                    ->where('status', 'Pending')
                    ->orderBy('id', 'Desc')->count();

                $tnegaservices = DB::table('tnega_services')
                    ->where('status', 'Pending')
                    ->orderBy('id', 'Desc')->count();

                $smartcard = DB::table('smartcard')
                    ->where('status', 'Pending')
                    ->orderBy('id', 'Desc')->count();

                $aadhaarcard = DB::table('aadhaarcard')
                    ->where('status', 'Pending')
                    ->orderBy('id', 'Desc')->count();

                $can_edit = DB::table('can_edit')
                    ->where('status', 'Pending')
                    ->orderBy('id', 'Desc')->count();

                $bond = DB::table('bond')
                    ->where('status', 'Pending')
                    ->orderBy('id', 'Desc')->count();

                $voterid = DB::table('voterid')
                    ->where('status', 'Pending')
                    ->orderBy('id', 'Desc')->count();

                $fssai = DB::table('fssai')
                    ->where('status', 'Pending')
                    ->orderBy('id', 'Desc')->count();

                $covid = DB::table('covid')
                    ->where('status', 'Pending')
                    ->orderBy('id', 'Desc')->count();

                $nalavariyam = DB::table('nalavariyam')
                    ->where('status', 'Pending')
                    ->orderBy('id', 'Desc')->count();

                $license = DB::table('license')
                    ->where('status', 'Pending')
                    ->orderBy('id', 'Desc')->count();

                $pancard = DB::table('pancard')
                    ->where('status', 'Pending')
                    ->orderBy('id', 'Desc')->count();

                $dharsan = DB::table('dharsan')
                    ->where('status', 'Pending')
                    ->orderBy('id', 'Desc')->count();

                $patta = DB::table('patta')
                    ->where('status', 'Pending')
                    ->orderBy('id', 'Desc')->count();

                $software = DB::table('software')
                    ->where('status', 'Pending')
                    ->orderBy('id', 'Desc')->count();

                $smartcard_otp = DB::table('smartcard_otp')
                    ->where('status', 'Pending')
                    ->orderBy('id', 'Desc')->count();

                $pstm = DB::table('pstm')
                    ->where('status', 'Pending')
                    ->orderBy('id', 'Desc')->count();

                $utislpan = DB::table('utislpan')
                    ->where('status', 'Pending')
                    ->orderBy('id', 'Desc')->count();

                $employment = DB::table('employment')
                    ->where('status', 'Pending')
                    ->orderBy('id', 'Desc')->count();

                $police_verification = DB::table('police_verification')
                    ->where('status', 'Pending')
                    ->orderBy('id', 'Desc')->count();

                $voteridpdf_download = DB::table('voteridpdf_download')
                    ->where('status', 'Pending')
                    ->orderBy('id', 'Desc')->count();

                $agri_stack = DB::table('agri_stack')
                    ->where('status', 'Pending')
                    ->orderBy('id', 'Desc')->count();

                $smartcard_pdf = DB::table('smartcard_pdf')
                    ->where('status', 'Pending')
                    ->orderBy('id', 'Desc')->count();

                $aadhaarfind = DB::table('aadhaarfind')
                    ->where('status', 'Pending')
                    ->orderBy('id', 'Desc')->count();

                $manual_pdf = DB::table('manual_pdf')
                    ->where('status', 'Pending')
                    ->orderBy('id', 'Desc')->count();

                $nativity = DB::table('nativity')
                    ->where('status', 'Pending')
                    ->orderBy('id', 'Desc')->count();

                $income = DB::table('income')
                    ->where('status', 'Pending')
                    ->orderBy('id', 'Desc')->count();

                $tnega_obc = DB::table('tnega_obc')
                    ->where('status', 'Pending')
                    ->orderBy('id', 'Desc')->count();

                $tnega_residence = DB::table('tnega_residence')
                    ->where('status', 'Pending')
                    ->orderBy('id', 'Desc')->count();

                $tnega_unemployed = DB::table('tnega_unemployed')
                    ->where('status', 'Pending')
                    ->orderBy('id', 'Desc')->count();

                $pending = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard + $dharsan + $software + $smartcard_otp + $pstm + $patta + $utislpan + $employment + $police_verification + $voteridpdf_download + $agri_stack + $smartcard_pdf + $aadhaarfind + $manual_pdf + $nativity + $income + $tnega_obc + $tnega_residence + $tnega_unemployed;

                $service = DB::table('msme')
                    ->where('status', 'Processing')
                    ->orderBy('id', 'Desc')->count();

                $itr = DB::table('itr')
                    ->where('status', 'Processing')
                    ->orderBy('id', 'Desc')->count();

                $gst = DB::table('gst')
                    ->where('status', 'Processing')
                    ->orderBy('id', 'Desc')->count();

                $tec_exam = DB::table('tec_exam')
                    ->where('status', 'Processing')
                    ->orderBy('id', 'Desc')->count();

                $tnegaservices = DB::table('tnega_services')
                    ->where('status', 'Processing')
                    ->orderBy('id', 'Desc')->count();

                $smartcard = DB::table('smartcard')
                    ->where('status', 'Processing')
                    ->orderBy('id', 'Desc')->count();

                $aadhaarcard = DB::table('aadhaarcard')
                    ->where('status', 'Processing')
                    ->orderBy('id', 'Desc')->count();

                $can_edit = DB::table('can_edit')
                    ->where('status', 'Processing')
                    ->orderBy('id', 'Desc')->count();

                $bond = DB::table('bond')
                    ->where('status', 'Processing')
                    ->orderBy('id', 'Desc')->count();

                $voterid = DB::table('voterid')
                    ->where('status', 'Processing')
                    ->orderBy('id', 'Desc')->count();

                $fssai = DB::table('fssai')
                    ->where('status', 'Processing')
                    ->orderBy('id', 'Desc')->count();

                $covid = DB::table('covid')
                    ->where('status', 'Processing')
                    ->orderBy('id', 'Desc')->count();

                $nalavariyam = DB::table('nalavariyam')
                    ->where('status', 'Processing')
                    ->orderBy('id', 'Desc')->count();

                $license = DB::table('license')
                    ->where('status', 'Processing')
                    ->orderBy('id', 'Desc')->count();

                $pancard = DB::table('pancard')
                    ->where('status', 'Processing')
                    ->orderBy('id', 'Desc')->count();

                $dharsan = DB::table('dharsan')
                    ->where('status', 'Processing')
                    ->orderBy('id', 'Desc')->count();

                $patta = DB::table('patta')
                    ->where('status', 'Processing')
                    ->orderBy('id', 'Desc')->count();

                $software = DB::table('software')
                    ->where('status', 'Processing')
                    ->orderBy('id', 'Desc')->count();

                $smartcard_otp = DB::table('smartcard_otp')
                    ->where('status', 'Processing')
                    ->orderBy('id', 'Desc')->count();

                $pstm = DB::table('pstm')
                    ->where('status', 'Processing')
                    ->orderBy('id', 'Desc')->count();

                $utislpan = DB::table('utislpan')
                    ->where('status', 'Processing')
                    ->orderBy('id', 'Desc')->count();

                $employment = DB::table('employment')
                    ->where('status', 'Processing')
                    ->orderBy('id', 'Desc')->count();

                $police_verification = DB::table('police_verification')
                    ->where('status', 'Processing')
                    ->orderBy('id', 'Desc')->count();

                $voteridpdf_download = DB::table('voteridpdf_download')
                    ->where('status', 'Processing')
                    ->orderBy('id', 'Desc')->count();

                $agri_stack = DB::table('agri_stack')
                    ->where('status', 'Processing')
                    ->orderBy('id', 'Desc')->count();

                $smartcard_pdf = DB::table('smartcard_pdf')
                    ->where('status', 'Processing')
                    ->orderBy('id', 'Desc')->count();

                $aadhaarfind = DB::table('aadhaarfind')
                    ->where('status', 'Processing')
                    ->orderBy('id', 'Desc')->count();

                $manual_pdf = DB::table('manual_pdf')
                    ->where('status', 'Processing')
                    ->orderBy('id', 'Desc')->count();

                $nativity = DB::table('nativity')
                    ->where('status', 'Processing')
                    ->orderBy('id', 'Desc')->count();

                $income = DB::table('income')
                    ->where('status', 'Processing')
                    ->orderBy('id', 'Desc')->count();

                $tnega_obc = DB::table('tnega_obc')
                    ->where('status', 'Processing')
                    ->orderBy('id', 'Desc')->count();

                $tnega_residence = DB::table('tnega_residence')
                    ->where('status', 'Processing')
                    ->orderBy('id', 'Desc')->count();

                $tnega_unemployed = DB::table('tnega_unemployed')
                    ->where('status', 'Processing')
                    ->orderBy('id', 'Desc')->count();

                $inpro = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard + $dharsan + $software + $smartcard_otp + $pstm + $patta + $utislpan + $employment + $police_verification + $voteridpdf_download + $agri_stack + $smartcard_pdf + $aadhaarfind + $manual_pdf + $tnega_unemployed + $tnega_residence + $tnega_obc + $income + $nativity;

                $service = DB::table('msme')
                    ->where('status', 'Resubmit')
                    ->orderBy('id', 'Desc')->count();

                $itr = DB::table('itr')
                    ->where('status', 'Resubmit')
                    ->orderBy('id', 'Desc')->count();

                $gst = DB::table('gst')
                    ->where('status', 'Resubmit')
                    ->orderBy('id', 'Desc')->count();

                $tec_exam = DB::table('tec_exam')
                    ->where('status', 'Resubmit')
                    ->orderBy('id', 'Desc')->count();

                $tnegaservices = DB::table('tnega_services')
                    ->where('status', 'Resubmit')
                    ->orderBy('id', 'Desc')->count();

                $smartcard = DB::table('smartcard')
                    ->where('status', 'Resubmit')
                    ->orderBy('id', 'Desc')->count();

                $aadhaarcard = DB::table('aadhaarcard')
                    ->where('status', 'Resubmit')
                    ->orderBy('id', 'Desc')->count();

                $can_edit = DB::table('can_edit')
                    ->where('status', 'Resubmit')
                    ->orderBy('id', 'Desc')->count();

                $bond = DB::table('bond')
                    ->where('status', 'Resubmit')
                    ->orderBy('id', 'Desc')->count();

                $voterid = DB::table('voterid')
                    ->where('status', 'Resubmit')
                    ->orderBy('id', 'Desc')->count();

                $fssai = DB::table('fssai')
                    ->where('status', 'Resubmit')
                    ->orderBy('id', 'Desc')->count();

                $covid = DB::table('covid')
                    ->where('status', 'Resubmit')
                    ->orderBy('id', 'Desc')->count();

                $nalavariyam = DB::table('nalavariyam')
                    ->where('status', 'Resubmit')
                    ->orderBy('id', 'Desc')->count();

                $license = DB::table('license')
                    ->where('status', 'Resubmit')
                    ->orderBy('id', 'Desc')->count();

                $pancard = DB::table('pancard')
                    ->where('status', 'Resubmit')
                    ->orderBy('id', 'Desc')->count();

                $dharsan = DB::table('dharsan')
                    ->where('status', 'Resubmit')
                    ->orderBy('id', 'Desc')->count();

                $patta = DB::table('patta')
                    ->where('status', 'Resubmit')
                    ->orderBy('id', 'Desc')->count();

                $software = DB::table('software')
                    ->where('status', 'Resubmit')
                    ->orderBy('id', 'Desc')->count();

                $smartcard_otp = DB::table('smartcard_otp')
                    ->where('status', 'Resubmit')
                    ->orderBy('id', 'Desc')->count();

                $pstm = DB::table('pstm')
                    ->where('status', 'Resubmit')
                    ->orderBy('id', 'Desc')->count();

                $utislpan = DB::table('utislpan')
                    ->where('status', 'Resubmit')
                    ->orderBy('id', 'Desc')->count();

                $employment = DB::table('employment')
                    ->where('status', 'Resubmit')
                    ->orderBy('id', 'Desc')->count();

                $police_verification = DB::table('police_verification')
                    ->where('status', 'Resubmit')
                    ->orderBy('id', 'Desc')->count();

                $voteridpdf_download = DB::table('voteridpdf_download')
                    ->where('status', 'Resubmit')
                    ->orderBy('id', 'Desc')->count();

                $agri_stack = DB::table('agri_stack')
                    ->where('status', 'Resubmit')
                    ->orderBy('id', 'Desc')->count();

                $smartcard_pdf = DB::table('smartcard_pdf')
                    ->where('status', 'Resubmit')
                    ->orderBy('id', 'Desc')->count();

                $aadhaarfind = DB::table('aadhaarfind')
                    ->where('status', 'Resubmit')
                    ->orderBy('id', 'Desc')->count();

                $manual_pdf = DB::table('manual_pdf')
                    ->where('status', 'Resubmit')
                    ->orderBy('id', 'Desc')->count();

                $nativity = DB::table('nativity')
                    ->where('status', 'Resubmit')
                    ->orderBy('id', 'Desc')->count();

                $income = DB::table('income')
                    ->where('status', 'Resubmit')
                    ->orderBy('id', 'Desc')->count();

                $tnega_obc = DB::table('tnega_obc')
                    ->where('status', 'Resubmit')
                    ->orderBy('id', 'Desc')->count();

                $tnega_residence = DB::table('tnega_residence')
                    ->where('status', 'Resubmit')
                    ->orderBy('id', 'Desc')->count();

                $tnega_unemployed = DB::table('tnega_unemployed')
                    ->where('status', 'Resubmit')
                    ->orderBy('id', 'Desc')->count();

                $resub = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard + $dharsan + $software + $smartcard_otp + $pstm + $patta + $utislpan + $employment + $police_verification + $voteridpdf_download + $agri_stack + $smartcard_pdf + $aadhaarfind + $manual_pdf + $nativity + $income + $tnega_obc + $tnega_residence + $tnega_unemployed;

                $service = DB::table('msme')
                    ->where('status', 'Rejected')
                    ->orderBy('id', 'Desc')->count();

                $itr = DB::table('itr')
                    ->where('status', 'Rejected')
                    ->orderBy('id', 'Desc')->count();

                $gst = DB::table('gst')
                    ->where('status', 'Rejected')
                    ->orderBy('id', 'Desc')->count();

                $tec_exam = DB::table('tec_exam')
                    ->where('status', 'Rejected')
                    ->orderBy('id', 'Desc')->count();

                $tnegaservices = DB::table('tnega_services')
                    ->where('status', 'Rejected')
                    ->orderBy('id', 'Desc')->count();

                $smartcard = DB::table('smartcard')
                    ->where('status', 'Rejected')
                    ->orderBy('id', 'Desc')->count();

                $aadhaarcard = DB::table('aadhaarcard')
                    ->where('status', 'Rejected')
                    ->orderBy('id', 'Desc')->count();

                $can_edit = DB::table('can_edit')
                    ->where('status', 'Rejected')
                    ->orderBy('id', 'Desc')->count();

                $bond = DB::table('bond')
                    ->where('status', 'Rejected')
                    ->orderBy('id', 'Desc')->count();

                $voterid = DB::table('voterid')
                    ->where('status', 'Rejected')
                    ->orderBy('id', 'Desc')->count();

                $fssai = DB::table('fssai')
                    ->where('status', 'Rejected')
                    ->orderBy('id', 'Desc')->count();

                $covid = DB::table('covid')
                    ->where('status', 'Rejected')
                    ->orderBy('id', 'Desc')->count();

                $nalavariyam = DB::table('nalavariyam')
                    ->where('status', 'Rejected')
                    ->orderBy('id', 'Desc')->count();

                $license = DB::table('license')
                    ->where('status', 'Rejected')
                    ->orderBy('id', 'Desc')->count();

                $pancard = DB::table('pancard')
                    ->where('status', 'Rejected')
                    ->orderBy('id', 'Desc')->count();

                $dharsan = DB::table('dharsan')
                    ->where('status', 'Rejected')
                    ->orderBy('id', 'Desc')->count();

                $patta = DB::table('patta')
                    ->where('status', 'Rejected')
                    ->orderBy('id', 'Desc')->count();

                $software = DB::table('software')
                    ->where('status', 'Rejected')
                    ->orderBy('id', 'Desc')->count();

                $smartcard_otp = DB::table('smartcard_otp')
                    ->where('status', 'Rejected')
                    ->orderBy('id', 'Desc')->count();

                $pstm = DB::table('pstm')
                    ->where('status', 'Rejected')
                    ->orderBy('id', 'Desc')->count();

                $utislpan = DB::table('utislpan')
                    ->where('status', 'Rejected')
                    ->orderBy('id', 'Desc')->count();

                $employment = DB::table('employment')
                    ->where('status', 'Rejected')
                    ->orderBy('id', 'Desc')->count();

                $police_verification = DB::table('police_verification')
                    ->where('status', 'Rejected')
                    ->orderBy('id', 'Desc')->count();

                $voteridpdf_download = DB::table('voteridpdf_download')
                    ->where('status', 'Rejected')
                    ->orderBy('id', 'Desc')->count();

                $agri_stack = DB::table('agri_stack')
                    ->where('status', 'Rejected')
                    ->orderBy('id', 'Desc')->count();

                $smartcard_pdf = DB::table('smartcard_pdf')
                    ->where('status', 'Rejected')
                    ->orderBy('id', 'Desc')->count();

                $aadhaarfind = DB::table('aadhaarfind')
                    ->where('status', 'Rejected')
                    ->orderBy('id', 'Desc')->count();

                $manual_pdf = DB::table('manual_pdf')
                    ->where('status', 'Rejected')
                    ->orderBy('id', 'Desc')->count();

                $nativity = DB::table('nativity')
                    ->where('status', 'Rejected')
                    ->orderBy('id', 'Desc')->count();

                $income = DB::table('income')
                    ->where('status', 'Rejected')
                    ->orderBy('id', 'Desc')->count();

                $tnega_obc = DB::table('tnega_obc')
                    ->where('status', 'Rejected')
                    ->orderBy('id', 'Desc')->count();

                $tnega_residence = DB::table('tnega_residence')
                    ->where('status', 'Rejected')
                    ->orderBy('id', 'Desc')->count();

                $tnega_unemployed = DB::table('tnega_unemployed')
                    ->where('status', 'Rejected')
                    ->orderBy('id', 'Desc')->count();

                $rerej = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard + $dharsan + $software + $smartcard_otp + $pstm + $patta + $utislpan + $employment + $police_verification + $voteridpdf_download + $agri_stack + $smartcard_pdf + $aadhaarfind + $manual_pdf + $nativity + $income + $tnega_obc + $tnega_residence + $tnega_unemployed;

                $service = DB::table('msme')
                    ->where('status', 'Approved')
                    ->orderBy('id', 'Desc')->count();

                $itr = DB::table('itr')
                    ->where('status', 'Approved')
                    ->orderBy('id', 'Desc')->count();

                $gst = DB::table('gst')
                    ->where('status', 'Approved')
                    ->orderBy('id', 'Desc')->count();

                $tec_exam = DB::table('tec_exam')
                    ->where('status', 'Approved')
                    ->orderBy('id', 'Desc')->count();

                $tnegaservices = DB::table('tnega_services')
                    ->where('status', 'Approved')
                    ->orderBy('id', 'Desc')->count();

                $smartcard = DB::table('smartcard')
                    ->where('status', 'Approved')
                    ->orderBy('id', 'Desc')->count();

                $aadhaarcard = DB::table('aadhaarcard')
                    ->where('status', 'Approved')
                    ->orderBy('id', 'Desc')->count();

                $can_edit = DB::table('can_edit')
                    ->where('status', 'Approved')
                    ->orderBy('id', 'Desc')->count();

                $bond = DB::table('bond')
                    ->where('status', 'Approved')
                    ->orderBy('id', 'Desc')->count();

                $voterid = DB::table('voterid')
                    ->where('status', 'Approved')
                    ->orderBy('id', 'Desc')->count();

                $fssai = DB::table('fssai')
                    ->where('status', 'Approved')
                    ->orderBy('id', 'Desc')->count();

                $covid = DB::table('covid')
                    ->where('status', 'Approved')
                    ->orderBy('id', 'Desc')->count();

                $nalavariyam = DB::table('nalavariyam')
                    ->where('status', 'Approved')
                    ->orderBy('id', 'Desc')->count();

                $license = DB::table('license')
                    ->where('status', 'Approved')
                    ->orderBy('id', 'Desc')->count();

                $pancard = DB::table('pancard')
                    ->where('status', 'Approved')
                    ->orderBy('id', 'Desc')->count();

                $dharsan = DB::table('dharsan')
                    ->where('status', 'Approved')
                    ->orderBy('id', 'Desc')->count();

                $patta = DB::table('patta')
                    ->where('status', 'Approved')
                    ->orderBy('id', 'Desc')->count();

                $software = DB::table('software')
                    ->where('status', 'Approved')
                    ->orderBy('id', 'Desc')->count();

                $smartcard_otp = DB::table('smartcard_otp')
                    ->where('status', 'Approved')
                    ->orderBy('id', 'Desc')->count();

                $pstm = DB::table('pstm')
                    ->where('status', 'Approved')
                    ->orderBy('id', 'Desc')->count();

                $utislpan = DB::table('utislpan')
                    ->where('status', 'Approved')
                    ->orderBy('id', 'Desc')->count();

                $employment = DB::table('employment')
                    ->where('status', 'Approved')
                    ->orderBy('id', 'Desc')->count();

                $police_verification = DB::table('police_verification')
                    ->where('status', 'Approved')
                    ->orderBy('id', 'Desc')->count();

                $voteridpdf_download = DB::table('voteridpdf_download')
                    ->where('status', 'Approved')
                    ->orderBy('id', 'Desc')->count();

                $agri_stack = DB::table('agri_stack')
                    ->where('status', 'Approved')
                    ->orderBy('id', 'Desc')->count();

                $smartcard_pdf = DB::table('smartcard_pdf')
                    ->where('status', 'Approved')
                    ->orderBy('id', 'Desc')->count();

                $aadhaarfind = DB::table('aadhaarfind')
                    ->where('status', 'Approved')
                    ->orderBy('id', 'Desc')->count();

                $manual_pdf = DB::table('manual_pdf')
                    ->where('status', 'Approved')
                    ->orderBy('id', 'Desc')->count();
                    
                $nativity = DB::table('nativity')
                    ->where('status', 'Approved')
                    ->orderBy('id', 'Desc')->count();

                $income = DB::table('income')
                    ->where('status', 'Approved')
                    ->orderBy('id', 'Desc')->count();

                $tnega_obc = DB::table('tnega_obc')
                    ->where('status', 'Approved')
                    ->orderBy('id', 'Desc')->count();

                $tnega_residence = DB::table('tnega_residence')
                    ->where('status', 'Approved')
                    ->orderBy('id', 'Desc')->count();

                $tnega_unemployed = DB::table('tnega_unemployed')
                    ->where('status', 'Approved')
                    ->orderBy('id', 'Desc')->count();

                $approve = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard + $dharsan + $software + $smartcard_otp + $pstm + $patta + $utislpan + $employment + $police_verification + $voteridpdf_download + $agri_stack + $smartcard_pdf + $aadhaarfind + $manual_pdf + $nativity + $income + $tnega_obc + $tnega_residence + $tnega_unemployed;

            } elseif (Auth::user()->user_type_id == 3) {

                $service = DB::table('msme')
                    ->where('status', 'Pending')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $itr = DB::table('itr')
                    ->where('status', 'Pending')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $gst = DB::table('gst')
                    ->where('status', 'Pending')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tec_exam = DB::table('tec_exam')
                    ->where('status', 'Pending')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnegaservices = DB::table('tnega_services')
                    ->where('status', 'Pending')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard = DB::table('smartcard')
                    ->where('status', 'Pending')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $aadhaarcard = DB::table('aadhaarcard')
                    ->where('status', 'Pending')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $can_edit = DB::table('can_edit')
                    ->where('status', 'Pending')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $bond = DB::table('bond')
                    ->where('status', 'Pending')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $voterid = DB::table('voterid')
                    ->where('status', 'Pending')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $fssai = DB::table('fssai')
                    ->where('status', 'Pending')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $covid = DB::table('covid')
                    ->where('status', 'Pending')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $nalavariyam = DB::table('nalavariyam')
                    ->where('status', 'Pending')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $license = DB::table('license')
                    ->where('status', 'Pending')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pancard = DB::table('pancard')
                    ->where('status', 'Pending')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $dharsan = DB::table('dharsan')
                    ->where('status', 'Pending')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $patta = DB::table('patta')
                    ->where('status', 'Pending')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $software = DB::table('software')
                    ->where('status', 'Pending')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard_otp = DB::table('smartcard_otp')
                    ->where('status', 'Pending')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pstm = DB::table('pstm')
                    ->where('status', 'Pending')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $utislpan = DB::table('utislpan')
                    ->where('status', 'Pending')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $employment = DB::table('employment')
                    ->where('status', 'Pending')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $police_verification = DB::table('police_verification')
                    ->where('status', 'Pending')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $voteridpdf_download = DB::table('voteridpdf_download')
                    ->where('status', 'Pending')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $agri_stack = DB::table('agri_stack')
                    ->where('status', 'Pending')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard_pdf = DB::table('smartcard_pdf')
                    ->where('status', 'Pending')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $aadhaarfind = DB::table('aadhaarfind')
                    ->where('status', 'Pending')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $manual_pdf = DB::table('manual_pdf')
                    ->where('status', 'Pending')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $nativity = DB::table('nativity')
                    ->where('status', 'Pending')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $income = DB::table('income')
                    ->where('status', 'Pending')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnega_obc = DB::table('tnega_obc')
                    ->where('status', 'Pending')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnega_residence = DB::table('tnega_residence')
                    ->where('status', 'Pending')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnega_unemployed = DB::table('tnega_unemployed')
                    ->where('status', 'Pending')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pending = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard + $dharsan + $software + $smartcard_otp + $pstm + $patta + $utislpan + $employment + $police_verification + $voteridpdf_download + $agri_stack + $smartcard_pdf + $aadhaarfind + $manual_pdf + $nativity + $income + $tnega_obc + $tnega_residence + $tnega_unemployed;

                $service = DB::table('msme')
                    ->where('status', 'Processing')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $itr = DB::table('itr')
                    ->where('status', 'Processing')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $gst = DB::table('gst')
                    ->where('status', 'Processing')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tec_exam = DB::table('tec_exam')
                    ->where('status', 'Processing')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnegaservices = DB::table('tnega_services')
                    ->where('status', 'Processing')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard = DB::table('smartcard')
                    ->where('status', 'Processing')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $aadhaarcard = DB::table('aadhaarcard')
                    ->where('status', 'Processing')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $can_edit = DB::table('can_edit')
                    ->where('status', 'Processing')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $bond = DB::table('bond')
                    ->where('status', 'Processing')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $voterid = DB::table('voterid')
                    ->where('status', 'Processing')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $fssai = DB::table('fssai')
                    ->where('status', 'Processing')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $covid = DB::table('covid')
                    ->where('status', 'Processing')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $nalavariyam = DB::table('nalavariyam')
                    ->where('status', 'Processing')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $license = DB::table('license')
                    ->where('status', 'Processing')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pancard = DB::table('pancard')
                    ->where('status', 'Processing')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $dharsan = DB::table('dharsan')
                    ->where('status', 'Processing')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $patta = DB::table('patta')
                    ->where('status', 'Processing')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $software = DB::table('software')
                    ->where('status', 'Processing')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard_otp = DB::table('smartcard_otp')
                    ->where('status', 'Processing')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pstm = DB::table('pstm')
                    ->where('status', 'Processing')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $utislpan = DB::table('utislpan')
                    ->where('status', 'Processing')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $employment = DB::table('employment')
                    ->where('status', 'Processing')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $police_verification = DB::table('police_verification')
                    ->where('status', 'Processing')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $voteridpdf_download = DB::table('voteridpdf_download')
                    ->where('status', 'Processing')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $agri_stack = DB::table('agri_stack')
                    ->where('status', 'Processing')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard_pdf = DB::table('smartcard_pdf')
                    ->where('status', 'Processing')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $aadhaarfind = DB::table('aadhaarfind')
                    ->where('status', 'Processing')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $manual_pdf = DB::table('manual_pdf')
                    ->where('status', 'Processing')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $nativity = DB::table('nativity')
                    ->where('status', 'Processing')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $income = DB::table('income')
                    ->where('status', 'Processing')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnega_obc = DB::table('tnega_obc')
                    ->where('status', 'Processing')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnega_residence = DB::table('tnega_residence')
                    ->where('status', 'Processing')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnega_unemployed = DB::table('tnega_unemployed')
                    ->where('status', 'Processing')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $inpro = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard + $dharsan + $software + $smartcard_otp + $pstm + $patta + $utislpan + $employment + $police_verification + $voteridpdf_download + $agri_stack + $smartcard_pdf + $aadhaarfind + $manual_pdf + $nativity + $income + $tnega_obc + $tnega_residence + $tnega_unemployed;

                $service = DB::table('msme')
                    ->where('status', 'Resubmit')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $itr = DB::table('itr')
                    ->where('status', 'Resubmit')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $gst = DB::table('gst')
                    ->where('status', 'Resubmit')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tec_exam = DB::table('tec_exam')
                    ->where('status', 'Resubmit')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnegaservices = DB::table('tnega_services')
                    ->where('status', 'Resubmit')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard = DB::table('smartcard')
                    ->where('status', 'Resubmit')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $aadhaarcard = DB::table('aadhaarcard')
                    ->where('status', 'Resubmit')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $can_edit = DB::table('can_edit')
                    ->where('status', 'Resubmit')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $bond = DB::table('bond')
                    ->where('status', 'Resubmit')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $voterid = DB::table('voterid')
                    ->where('status', 'Resubmit')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $fssai = DB::table('fssai')
                    ->where('status', 'Resubmit')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $covid = DB::table('covid')
                    ->where('status', 'Resubmit')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $nalavariyam = DB::table('nalavariyam')
                    ->where('status', 'Resubmit')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $license = DB::table('license')
                    ->where('status', 'Resubmit')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pancard = DB::table('pancard')
                    ->where('status', 'Resubmit')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $dharsan = DB::table('dharsan')
                    ->where('status', 'Resubmit')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $patta = DB::table('patta')
                    ->where('status', 'Resubmit')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $software = DB::table('software')
                    ->where('status', 'Resubmit')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard_otp = DB::table('smartcard_otp')
                    ->where('status', 'Resubmit')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pstm = DB::table('pstm')
                    ->where('status', 'Resubmit')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $utislpan = DB::table('utislpan')
                    ->where('status', 'Resubmit')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $employment = DB::table('employment')
                    ->where('status', 'Resubmit')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $police_verification = DB::table('police_verification')
                    ->where('status', 'Resubmit')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $voteridpdf_download = DB::table('voteridpdf_download')
                    ->where('status', 'Resubmit')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $agri_stack = DB::table('agri_stack')
                    ->where('status', 'Resubmit')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard_pdf = DB::table('smartcard_pdf')
                    ->where('status', 'Resubmit')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $aadhaarfind = DB::table('aadhaarfind')
                    ->where('status', 'Resubmit')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $manual_pdf = DB::table('manual_pdf')
                    ->where('status', 'Resubmit')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $nativity = DB::table('nativity')
                    ->where('status', 'Resubmit')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $income = DB::table('income')
                    ->where('status', 'Resubmit')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnega_obc = DB::table('tnega_obc')
                    ->where('status', 'Resubmit')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnega_residence = DB::table('tnega_residence')
                    ->where('status', 'Resubmit')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnega_unemployed = DB::table('tnega_unemployed')
                    ->where('status', 'Resubmit')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $resub = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard + $dharsan + $software + $smartcard_otp + $pstm + $patta + $utislpan + $employment + $police_verification + $voteridpdf_download + $agri_stack + $smartcard_pdf + $aadhaarfind + $manual_pdf + $nativity + $income + $tnega_obc + $tnega_residence + $tnega_unemployed;

                $service = DB::table('msme')
                    ->where('status', 'Rejected')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $itr = DB::table('itr')
                    ->where('status', 'Rejected')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $gst = DB::table('gst')
                    ->where('status', 'Rejected')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tec_exam = DB::table('tec_exam')
                    ->where('status', 'Rejected')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnegaservices = DB::table('tnega_services')
                    ->where('status', 'Rejected')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard = DB::table('smartcard')
                    ->where('status', 'Rejected')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $aadhaarcard = DB::table('aadhaarcard')
                    ->where('status', 'Rejected')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $can_edit = DB::table('can_edit')
                    ->where('status', 'Rejected')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $bond = DB::table('bond')
                    ->where('status', 'Rejected')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $voterid = DB::table('voterid')
                    ->where('status', 'Rejected')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $fssai = DB::table('fssai')
                    ->where('status', 'Rejected')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $covid = DB::table('covid')
                    ->where('status', 'Rejected')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $nalavariyam = DB::table('nalavariyam')
                    ->where('status', 'Rejected')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $license = DB::table('license')
                    ->where('status', 'Rejected')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pancard = DB::table('pancard')
                    ->where('status', 'Rejected')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $dharsan = DB::table('dharsan')
                    ->where('status', 'Rejected')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $patta = DB::table('patta')
                    ->where('status', 'Rejected')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $software = DB::table('software')
                    ->where('status', 'Rejected')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard_otp = DB::table('smartcard_otp')
                    ->where('status', 'Rejected')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pstm = DB::table('pstm')
                    ->where('status', 'Rejected')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $utislpan = DB::table('utislpan')
                    ->where('status', 'Rejected')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $employment = DB::table('employment')
                    ->where('status', 'Rejected')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $police_verification = DB::table('police_verification')
                    ->where('status', 'Rejected')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $voteridpdf_download = DB::table('voteridpdf_download')
                    ->where('status', 'Rejected')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $agri_stack = DB::table('agri_stack')
                    ->where('status', 'Rejected')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard_pdf = DB::table('smartcard_pdf')
                    ->where('status', 'Rejected')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $aadhaarfind = DB::table('aadhaarfind')
                    ->where('status', 'Rejected')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $manual_pdf = DB::table('manual_pdf')
                    ->where('status', 'Rejected')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $nativity = DB::table('nativity')
                    ->where('status', 'Rejected')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $income = DB::table('income')
                    ->where('status', 'Rejected')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnega_obc = DB::table('tnega_obc')
                    ->where('status', 'Rejected')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnega_residence = DB::table('tnega_residence')
                    ->where('status', 'Rejected')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnega_unemployed = DB::table('tnega_unemployed')
                    ->where('status', 'Rejected')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $rerej = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard + $dharsan + $software + $smartcard_otp + $pstm + $patta + $utislpan + $employment + $police_verification + $voteridpdf_download + $agri_stack + $smartcard_pdf + $aadhaarfind + $manual_pdf + $nativity + $income + $tnega_obc + $tnega_residence + $tnega_unemployed;

                $service = DB::table('msme')
                    ->where('status', 'Approved')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $itr = DB::table('itr')
                    ->where('status', 'Approved')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $gst = DB::table('gst')
                    ->where('status', 'Approved')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tec_exam = DB::table('tec_exam')
                    ->where('status', 'Approved')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnegaservices = DB::table('tnega_services')
                    ->where('status', 'Approved')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard = DB::table('smartcard')
                    ->where('status', 'Approved')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $aadhaarcard = DB::table('aadhaarcard')
                    ->where('status', 'Approved')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $can_edit = DB::table('can_edit')
                    ->where('status', 'Approved')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $bond = DB::table('bond')
                    ->where('status', 'Approved')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $voterid = DB::table('voterid')
                    ->where('status', 'Approved')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $fssai = DB::table('fssai')
                    ->where('status', 'Approved')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $covid = DB::table('covid')
                    ->where('status', 'Approved')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $nalavariyam = DB::table('nalavariyam')
                    ->where('status', 'Approved')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $license = DB::table('license')
                    ->where('status', 'Approved')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pancard = DB::table('pancard')
                    ->where('status', 'Approved')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $dharsan = DB::table('dharsan')
                    ->where('status', 'Approved')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $patta = DB::table('patta')
                    ->where('status', 'Approved')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $software = DB::table('software')
                    ->where('status', 'Approved')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard_otp = DB::table('smartcard_otp')
                    ->where('status', 'Approved')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pstm = DB::table('pstm')
                    ->where('status', 'Approved')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $utislpan = DB::table('utislpan')
                    ->where('status', 'Approved')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $employment = DB::table('employment')
                    ->where('status', 'Approved')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $police_verification = DB::table('police_verification')
                    ->where('status', 'Approved')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $voteridpdf_download = DB::table('voteridpdf_download')
                    ->where('status', 'Approved')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $agri_stack = DB::table('agri_stack')
                    ->where('status', 'Approved')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard_pdf = DB::table('smartcard_pdf')
                    ->where('status', 'Approved')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $aadhaarfind = DB::table('aadhaarfind')
                    ->where('status', 'Approved')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $manual_pdf = DB::table('manual_pdf')
                    ->where('status', 'Approved')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $nativity = DB::table('nativity')
                    ->where('status', 'Approved')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $income = DB::table('income')
                    ->where('status', 'Approved')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnega_obc = DB::table('tnega_obc')
                    ->where('status', 'Approved')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnega_residence = DB::table('tnega_residence')
                    ->where('status', 'Approved')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnega_unemployed = DB::table('tnega_unemployed')
                    ->where('status', 'Approved')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $approve = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard + $dharsan + $software + $smartcard_otp + $pstm + $patta + $utislpan + $employment + $police_verification + $voteridpdf_download + $agri_stack + $smartcard_pdf + $aadhaarfind + $manual_pdf + $nativity + $income + $tnega_obc + $tnega_residence + $tnega_unemployed;

            } elseif (Auth::user()->user_type_id == 4) {

                $service = DB::table('msme')
                    ->where('status', 'Pending')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $itr = DB::table('itr')
                    ->where('status', 'Pending')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $gst = DB::table('gst')
                    ->where('status', 'Pending')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tec_exam = DB::table('tec_exam')
                    ->where('status', 'Pending')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnegaservices = DB::table('tnega_services')
                    ->where('status', 'Pending')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard = DB::table('smartcard')
                    ->where('status', 'Pending')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $aadhaarcard = DB::table('aadhaarcard')
                    ->where('status', 'Pending')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $can_edit = DB::table('can_edit')
                    ->where('status', 'Pending')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $bond = DB::table('bond')
                    ->where('status', 'Pending')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $voterid = DB::table('voterid')
                    ->where('status', 'Pending')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $fssai = DB::table('fssai')
                    ->where('status', 'Pending')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $covid = DB::table('covid')
                    ->where('status', 'Pending')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $nalavariyam = DB::table('nalavariyam')
                    ->where('status', 'Pending')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $license = DB::table('license')
                    ->where('status', 'Pending')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pancard = DB::table('pancard')
                    ->where('status', 'Pending')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $dharsan = DB::table('dharsan')
                    ->where('status', 'Pending')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $patta = DB::table('patta')
                    ->where('status', 'Pending')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $software = DB::table('software')
                    ->where('status', 'Pending')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard_otp = DB::table('smartcard_otp')
                    ->where('status', 'Pending')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pstm = DB::table('pstm')
                    ->where('status', 'Pending')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $utislpan = DB::table('utislpan')
                    ->where('status', 'Pending')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $employment = DB::table('employment')
                    ->where('status', 'Pending')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $police_verification = DB::table('police_verification')
                    ->where('status', 'Pending')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $voteridpdf_download = DB::table('voteridpdf_download')
                    ->where('status', 'Pending')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $agri_stack = DB::table('agri_stack')
                    ->where('status', 'Pending')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard_pdf = DB::table('smartcard_pdf')
                    ->where('status', 'Pending')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $aadhaarfind = DB::table('aadhaarfind')
                    ->where('status', 'Pending')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $manual_pdf = DB::table('manual_pdf')
                    ->where('status', 'Pending')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $nativity = DB::table('nativity')
                    ->where('status', 'Pending')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $income = DB::table('income')
                    ->where('status', 'Pending')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnega_obc = DB::table('tnega_obc')
                    ->where('status', 'Pending')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnega_residence = DB::table('tnega_residence')
                    ->where('status', 'Pending')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnega_unemployed = DB::table('tnega_unemployed')
                    ->where('status', 'Pending')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();
                    
                $pending = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard + $dharsan + $software + $smartcard_otp + $pstm + $patta + $utislpan + $employment + $police_verification + $voteridpdf_download + $agri_stack + $smartcard_pdf + $aadhaarfind + $manual_pdf + $nativity + $income + $tnega_obc + $tnega_residence + $tnega_unemployed;

                $service = DB::table('msme')
                    ->where('status', 'Processing')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $itr = DB::table('itr')
                    ->where('status', 'Processing')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $gst = DB::table('gst')
                    ->where('status', 'Processing')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tec_exam = DB::table('tec_exam')
                    ->where('status', 'Processing')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnegaservices = DB::table('tnega_services')
                    ->where('status', 'Processing')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard = DB::table('smartcard')
                    ->where('status', 'Processing')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $aadhaarcard = DB::table('aadhaarcard')
                    ->where('status', 'Processing')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $can_edit = DB::table('can_edit')
                    ->where('status', 'Processing')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $bond = DB::table('bond')
                    ->where('status', 'Processing')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $voterid = DB::table('voterid')
                    ->where('status', 'Processing')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $fssai = DB::table('fssai')
                    ->where('status', 'Processing')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $covid = DB::table('covid')
                    ->where('status', 'Processing')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $nalavariyam = DB::table('nalavariyam')
                    ->where('status', 'Processing')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $license = DB::table('license')
                    ->where('status', 'Processing')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pancard = DB::table('pancard')
                    ->where('status', 'Processing')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $dharsan = DB::table('dharsan')
                    ->where('status', 'Processing')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $patta = DB::table('patta')
                    ->where('status', 'Processing')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $software = DB::table('software')
                    ->where('status', 'Processing')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard_otp = DB::table('smartcard_otp')
                    ->where('status', 'Processing')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pstm = DB::table('pstm')
                    ->where('status', 'Processing')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $utislpan = DB::table('utislpan')
                    ->where('status', 'Processing')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $employment = DB::table('employment')
                    ->where('status', 'Processing')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $police_verification = DB::table('police_verification')
                    ->where('status', 'Processing')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $voteridpdf_download = DB::table('voteridpdf_download')
                    ->where('status', 'Processing')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $agri_stack = DB::table('agri_stack')
                    ->where('status', 'Processing')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard_pdf = DB::table('smartcard_pdf')
                    ->where('status', 'Processing')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $aadhaarfind = DB::table('aadhaarfind')
                    ->where('status', 'Processing')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $manual_pdf = DB::table('manual_pdf')
                    ->where('status', 'Processing')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $nativity = DB::table('nativity')
                    ->where('status', 'Processing')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $income = DB::table('income')
                    ->where('status', 'Processing')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnega_obc = DB::table('tnega_obc')
                    ->where('status', 'Processing')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnega_residence = DB::table('tnega_residence')
                    ->where('status', 'Processing')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnega_unemployed = DB::table('tnega_unemployed')
                    ->where('status', 'Processing')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $inpro = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard + $dharsan + $software + $smartcard_otp + $pstm + $patta + $utislpan + $employment + $police_verification + $voteridpdf_download + $agri_stack + $smartcard_pdf + $aadhaarfind + $manual_pdf + $nativity + $income + $tnega_obc + $tnega_residence + $tnega_unemployed;

                $service = DB::table('msme')
                    ->where('status', 'Resubmit')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $itr = DB::table('itr')
                    ->where('status', 'Resubmit')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $gst = DB::table('gst')
                    ->where('status', 'Resubmit')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tec_exam = DB::table('tec_exam')
                    ->where('status', 'Resubmit')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnegaservices = DB::table('tnega_services')
                    ->where('status', 'Resubmit')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard = DB::table('smartcard')
                    ->where('status', 'Resubmit')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $aadhaarcard = DB::table('aadhaarcard')
                    ->where('status', 'Resubmit')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $can_edit = DB::table('can_edit')
                    ->where('status', 'Resubmit')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $bond = DB::table('bond')
                    ->where('status', 'Resubmit')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $voterid = DB::table('voterid')
                    ->where('status', 'Resubmit')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $fssai = DB::table('fssai')
                    ->where('status', 'Resubmit')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $covid = DB::table('covid')
                    ->where('status', 'Resubmit')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $nalavariyam = DB::table('nalavariyam')
                    ->where('status', 'Resubmit')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $license = DB::table('license')
                    ->where('status', 'Resubmit')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pancard = DB::table('pancard')
                    ->where('status', 'Resubmit')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $dharsan = DB::table('dharsan')
                    ->where('status', 'Resubmit')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $patta = DB::table('patta')
                    ->where('status', 'Resubmit')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $software = DB::table('software')
                    ->where('status', 'Resubmit')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard_otp = DB::table('smartcard_otp')
                    ->where('status', 'Resubmit')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pstm = DB::table('pstm')
                    ->where('status', 'Resubmit')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $utislpan = DB::table('utislpan')
                    ->where('status', 'Resubmit')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $employment = DB::table('employment')
                    ->where('status', 'Resubmit')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $police_verification = DB::table('police_verification')
                    ->where('status', 'Resubmit')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $voteridpdf_download = DB::table('voteridpdf_download')
                    ->where('status', 'Resubmit')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $agri_stack = DB::table('agri_stack')
                    ->where('status', 'Resubmit')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard_pdf = DB::table('smartcard_pdf')
                    ->where('status', 'Resubmit')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $aadhaarfind = DB::table('aadhaarfind')
                    ->where('status', 'Resubmit')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $manual_pdf = DB::table('manual_pdf')
                    ->where('status', 'Resubmit')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $nativity = DB::table('nativity')
                    ->where('status', 'Resubmit')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $income = DB::table('income')
                    ->where('status', 'Resubmit')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnega_obc = DB::table('tnega_obc')
                    ->where('status', 'Resubmit')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnega_residence = DB::table('tnega_residence')
                    ->where('status', 'Resubmit')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnega_unemployed = DB::table('tnega_unemployed')
                    ->where('status', 'Resubmit')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $resub = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard + $dharsan + $software + $smartcard_otp + $pstm + $patta + $utislpan + $employment + $police_verification + $voteridpdf_download + $agri_stack + $smartcard_pdf + $aadhaarfind + $manual_pdf + $nativity + $income + $tnega_obc + $tnega_residence + $tnega_unemployed;

                $service = DB::table('msme')
                    ->where('status', 'Rejected')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $itr = DB::table('itr')
                    ->where('status', 'Rejected')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $gst = DB::table('gst')
                    ->where('status', 'Rejected')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tec_exam = DB::table('tec_exam')
                    ->where('status', 'Rejected')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnegaservices = DB::table('tnega_services')
                    ->where('status', 'Rejected')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard = DB::table('smartcard')
                    ->where('status', 'Rejected')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $aadhaarcard = DB::table('aadhaarcard')
                    ->where('status', 'Rejected')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $can_edit = DB::table('can_edit')
                    ->where('status', 'Rejected')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $bond = DB::table('bond')
                    ->where('status', 'Rejected')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $voterid = DB::table('voterid')
                    ->where('status', 'Rejected')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $fssai = DB::table('fssai')
                    ->where('status', 'Rejected')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $covid = DB::table('covid')
                    ->where('status', 'Rejected')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $nalavariyam = DB::table('nalavariyam')
                    ->where('status', 'Rejected')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $license = DB::table('license')
                    ->where('status', 'Rejected')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pancard = DB::table('pancard')
                    ->where('status', 'Rejected')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $dharsan = DB::table('dharsan')
                    ->where('status', 'Rejected')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $patta = DB::table('patta')
                    ->where('status', 'Rejected')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $software = DB::table('software')
                    ->where('status', 'Rejected')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard_otp = DB::table('smartcard_otp')
                    ->where('status', 'Rejected')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pstm = DB::table('pstm')
                    ->where('status', 'Rejected')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $utislpan = DB::table('utislpan')
                    ->where('status', 'Rejected')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $employment = DB::table('employment')
                    ->where('status', 'Rejected')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $police_verification = DB::table('police_verification')
                    ->where('status', 'Rejected')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $voteridpdf_download = DB::table('voteridpdf_download')
                    ->where('status', 'Rejected')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $agri_stack = DB::table('agri_stack')
                    ->where('status', 'Rejected')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard_pdf = DB::table('smartcard_pdf')
                    ->where('status', 'Rejected')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $aadhaarfind = DB::table('aadhaarfind')
                    ->where('status', 'Rejected')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $manual_pdf = DB::table('manual_pdf')
                    ->where('status', 'Rejected')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $nativity = DB::table('nativity')
                    ->where('status', 'Rejected')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $income = DB::table('income')
                    ->where('status', 'Rejected')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnega_obc = DB::table('tnega_obc')
                    ->where('status', 'Rejected')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnega_residence = DB::table('tnega_residence')
                    ->where('status', 'Rejected')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnega_unemployed = DB::table('tnega_unemployed')
                    ->where('status', 'Rejected')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $rerej = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard + $dharsan + $software + $smartcard_otp + $pstm + $patta + $utislpan + $employment + $police_verification + $voteridpdf_download + $agri_stack + $smartcard_pdf + $aadhaarfind + $manual_pdf + $nativity + $income + $tnega_obc + $tnega_residence + $tnega_unemployed;

                $service = DB::table('msme')
                    ->where('status', 'Approved')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $itr = DB::table('itr')
                    ->where('status', 'Approved')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $gst = DB::table('gst')
                    ->where('status', 'Approved')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tec_exam = DB::table('tec_exam')
                    ->where('status', 'Approved')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnegaservices = DB::table('tnega_services')
                    ->where('status', 'Approved')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard = DB::table('smartcard')
                    ->where('status', 'Approved')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $aadhaarcard = DB::table('aadhaarcard')
                    ->where('status', 'Approved')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $can_edit = DB::table('can_edit')
                    ->where('status', 'Approved')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $bond = DB::table('bond')
                    ->where('status', 'Approved')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $voterid = DB::table('voterid')
                    ->where('status', 'Approved')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $fssai = DB::table('fssai')
                    ->where('status', 'Approved')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $covid = DB::table('covid')
                    ->where('status', 'Approved')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $nalavariyam = DB::table('nalavariyam')
                    ->where('status', 'Approved')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $license = DB::table('license')
                    ->where('status', 'Approved')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pancard = DB::table('pancard')
                    ->where('status', 'Approved')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $dharsan = DB::table('dharsan')
                    ->where('status', 'Approved')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $patta = DB::table('patta')
                    ->where('status', 'Approved')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $software = DB::table('software')
                    ->where('status', 'Approved')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard_otp = DB::table('smartcard_otp')
                    ->where('status', 'Approved')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pstm = DB::table('pstm')
                    ->where('status', 'Approved')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $utislpan = DB::table('utislpan')
                    ->where('status', 'Approved')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $employment = DB::table('employment')
                    ->where('status', 'Approved')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $police_verification = DB::table('police_verification')
                    ->where('status', 'Approved')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $voteridpdf_download = DB::table('voteridpdf_download')
                    ->where('status', 'Approved')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $agri_stack = DB::table('agri_stack')
                    ->where('status', 'Approved')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard_pdf = DB::table('smartcard_pdf')
                    ->where('status', 'Approved')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $aadhaarfind = DB::table('aadhaarfind')
                    ->where('status', 'Approved')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $manual_pdf = DB::table('manual_pdf')
                    ->where('status', 'Approved')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $nativity = DB::table('nativity')
                    ->where('status', 'Approved')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $income = DB::table('income')
                    ->where('status', 'Approved')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnega_obc = DB::table('tnega_obc')
                    ->where('status', 'Approved')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnega_residence = DB::table('tnega_residence')
                    ->where('status', 'Approved')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnega_unemployed = DB::table('tnega_unemployed')
                    ->where('status', 'Approved')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $approve = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard + $dharsan + $software + $smartcard_otp + $pstm + $patta + $utislpan + $employment + $police_verification + $voteridpdf_download + $agri_stack + $smartcard_pdf + $aadhaarfind + $manual_pdf + $nativity + $income + $tnega_obc + $tnega_residence + $tnega_unemployed;

            } elseif (Auth::user()->user_type_id == 5) {

                $service = DB::table('msme')
                    ->where('status', 'Pending')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $itr = DB::table('itr')
                    ->where('status', 'Pending')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $gst = DB::table('gst')
                    ->where('status', 'Pending')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tec_exam = DB::table('tec_exam')
                    ->where('status', 'Pending')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnegaservices = DB::table('tnega_services')
                    ->where('status', 'Pending')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard = DB::table('smartcard')
                    ->where('status', 'Pending')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $aadhaarcard = DB::table('aadhaarcard')
                    ->where('status', 'Pending')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $can_edit = DB::table('can_edit')
                    ->where('status', 'Pending')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $bond = DB::table('bond')
                    ->where('status', 'Pending')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $voterid = DB::table('voterid')
                    ->where('status', 'Pending')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $fssai = DB::table('fssai')
                    ->where('status', 'Pending')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $covid = DB::table('covid')
                    ->where('status', 'Pending')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $nalavariyam = DB::table('nalavariyam')
                    ->where('status', 'Pending')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $license = DB::table('license')
                    ->where('status', 'Pending')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pancard = DB::table('pancard')
                    ->where('status', 'Pending')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $dharsan = DB::table('dharsan')
                    ->where('status', 'Pending')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $patta = DB::table('patta')
                    ->where('status', 'Pending')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $software = DB::table('software')
                    ->where('status', 'Pending')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard_otp = DB::table('smartcard_otp')
                    ->where('status', 'Pending')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pstm = DB::table('pstm')
                    ->where('status', 'Pending')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $utislpan = DB::table('utislpan')
                    ->where('status', 'Pending')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $employment = DB::table('employment')
                    ->where('status', 'Pending')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $police_verification = DB::table('police_verification')
                    ->where('status', 'Pending')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $voteridpdf_download = DB::table('voteridpdf_download')
                    ->where('status', 'Pending')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $agri_stack = DB::table('agri_stack')
                    ->where('status', 'Pending')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard_pdf = DB::table('smartcard_pdf')
                    ->where('status', 'Pending')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $aadhaarfind = DB::table('aadhaarfind')
                    ->where('status', 'Pending')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $manual_pdf = DB::table('manual_pdf')
                    ->where('status', 'Pending')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $nativity = DB::table('nativity')
                    ->where('status', 'Pending')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $income = DB::table('income')
                    ->where('status', 'Pending')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnega_obc = DB::table('tnega_obc')
                    ->where('status', 'Pending')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnega_residence = DB::table('tnega_residence')
                    ->where('status', 'Pending')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnega_unemployed = DB::table('tnega_unemployed')
                    ->where('status', 'Pending')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pending = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard + $dharsan + $software + $smartcard_otp + $pstm + $patta + $utislpan + $employment + $police_verification + $voteridpdf_download + $agri_stack + $smartcard_pdf + $aadhaarfind + $manual_pdf + $nativity + $income + $tnega_obc + $tnega_residence + $tnega_unemployed;

                $service = DB::table('msme')
                    ->where('status', 'Processing')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $itr = DB::table('itr')
                    ->where('status', 'Processing')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $gst = DB::table('gst')
                    ->where('status', 'Processing')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tec_exam = DB::table('tec_exam')
                    ->where('status', 'Processing')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnegaservices = DB::table('tnega_services')
                    ->where('status', 'Processing')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard = DB::table('smartcard')
                    ->where('status', 'Processing')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $aadhaarcard = DB::table('aadhaarcard')
                    ->where('status', 'Processing')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $can_edit = DB::table('can_edit')
                    ->where('status', 'Processing')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $bond = DB::table('bond')
                    ->where('status', 'Processing')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $voterid = DB::table('voterid')
                    ->where('status', 'Processing')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $fssai = DB::table('fssai')
                    ->where('status', 'Processing')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $covid = DB::table('covid')
                    ->where('status', 'Processing')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $nalavariyam = DB::table('nalavariyam')
                    ->where('status', 'Processing')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $license = DB::table('license')
                    ->where('status', 'Processing')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pancard = DB::table('pancard')
                    ->where('status', 'Processing')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $dharsan = DB::table('dharsan')
                    ->where('status', 'Processing')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $patta = DB::table('patta')
                    ->where('status', 'Processing')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $software = DB::table('software')
                    ->where('status', 'Processing')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard_otp = DB::table('smartcard_otp')
                    ->where('status', 'Processing')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pstm = DB::table('pstm')
                    ->where('status', 'Processing')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $utislpan = DB::table('utislpan')
                    ->where('status', 'Processing')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $employment = DB::table('employment')
                    ->where('status', 'Processing')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $police_verification = DB::table('police_verification')
                    ->where('status', 'Processing')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $voteridpdf_download = DB::table('voteridpdf_download')
                    ->where('status', 'Processing')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $agri_stack = DB::table('agri_stack')
                    ->where('status', 'Processing')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard_pdf = DB::table('smartcard_pdf')
                    ->where('status', 'Processing')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $aadhaarfind = DB::table('aadhaarfind')
                    ->where('status', 'Processing')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $manual_pdf = DB::table('manual_pdf')
                    ->where('status', 'Processing')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnega_obc = DB::table('tnega_obc')
                    ->where('status', 'Processing')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $nativity = DB::table('nativity')
                    ->where('status', 'Processing')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $income = DB::table('income')
                    ->where('status', 'Processing')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnega_residence = DB::table('tnega_residence')
                    ->where('status', 'Processing')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnega_unemployed = DB::table('tnega_unemployed')
                    ->where('status', 'Processing')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $inpro = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard + $dharsan + $software + $smartcard_otp + $pstm + $patta + $utislpan + $employment + $police_verification + $voteridpdf_download + $agri_stack + $smartcard_pdf + $aadhaarfind + $manual_pdf + $nativity + $income + $tnega_obc + $tnega_residence + $tnega_unemployed;

                $service = DB::table('msme')
                    ->where('status', 'Resubmit')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $itr = DB::table('itr')
                    ->where('status', 'Resubmit')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $gst = DB::table('gst')
                    ->where('status', 'Resubmit')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tec_exam = DB::table('tec_exam')
                    ->where('status', 'Resubmit')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnegaservices = DB::table('tnega_services')
                    ->where('status', 'Resubmit')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard = DB::table('smartcard')
                    ->where('status', 'Resubmit')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $aadhaarcard = DB::table('aadhaarcard')
                    ->where('status', 'Resubmit')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $can_edit = DB::table('can_edit')
                    ->where('status', 'Resubmit')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $bond = DB::table('bond')
                    ->where('status', 'Resubmit')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $voterid = DB::table('voterid')
                    ->where('status', 'Resubmit')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $fssai = DB::table('fssai')
                    ->where('status', 'Resubmit')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $covid = DB::table('covid')
                    ->where('status', 'Resubmit')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $nalavariyam = DB::table('nalavariyam')
                    ->where('status', 'Resubmit')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $license = DB::table('license')
                    ->where('status', 'Resubmit')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pancard = DB::table('pancard')
                    ->where('status', 'Resubmit')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $dharsan = DB::table('dharsan')
                    ->where('status', 'Resubmit')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $patta = DB::table('patta')
                    ->where('status', 'Resubmit')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $software = DB::table('software')
                    ->where('status', 'Resubmit')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard_otp = DB::table('smartcard_otp')
                    ->where('status', 'Resubmit')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pstm = DB::table('pstm')
                    ->where('status', 'Resubmit')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $utislpan = DB::table('utislpan')
                    ->where('status', 'Resubmit')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $employment = DB::table('employment')
                    ->where('status', 'Resubmit')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $police_verification = DB::table('police_verification')
                    ->where('status', 'Resubmit')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $voteridpdf_download = DB::table('voteridpdf_download')
                    ->where('status', 'Resubmit')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $agri_stack = DB::table('agri_stack')
                    ->where('status', 'Resubmit')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard_pdf = DB::table('smartcard_pdf')
                    ->where('status', 'Resubmit')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $aadhaarfind = DB::table('aadhaarfind')
                    ->where('status', 'Resubmit')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $manual_pdf = DB::table('manual_pdf')
                    ->where('status', 'Resubmit')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $nativity = DB::table('nativity')
                    ->where('status', 'Resubmit')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $income = DB::table('income')
                    ->where('status', 'Resubmit')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnega_obc = DB::table('tnega_obc')
                    ->where('status', 'Resubmit')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnega_residence = DB::table('tnega_residence')
                    ->where('status', 'Resubmit')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnega_unemployed = DB::table('tnega_unemployed')
                    ->where('status', 'Resubmit')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $resub = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard + $dharsan + $software + $smartcard_otp + $pstm + $patta + $utislpan + $employment + $police_verification + $voteridpdf_download + $agri_stack + $smartcard_pdf + $aadhaarfind + $manual_pdf + $nativity + $income + $tnega_obc + $tnega_residence + $tnega_unemployed;

                $service = DB::table('msme')
                    ->where('status', 'Rejected')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $itr = DB::table('itr')
                    ->where('status', 'Rejected')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $gst = DB::table('gst')
                    ->where('status', 'Rejected')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tec_exam = DB::table('tec_exam')
                    ->where('status', 'Rejected')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnegaservices = DB::table('tnega_services')
                    ->where('status', 'Rejected')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard = DB::table('smartcard')
                    ->where('status', 'Rejected')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $aadhaarcard = DB::table('aadhaarcard')
                    ->where('status', 'Rejected')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $can_edit = DB::table('can_edit')
                    ->where('status', 'Rejected')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $bond = DB::table('bond')
                    ->where('status', 'Rejected')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $voterid = DB::table('voterid')
                    ->where('status', 'Rejected')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $fssai = DB::table('fssai')
                    ->where('status', 'Rejected')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $covid = DB::table('covid')
                    ->where('status', 'Rejected')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $nalavariyam = DB::table('nalavariyam')
                    ->where('status', 'Rejected')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $license = DB::table('license')
                    ->where('status', 'Rejected')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pancard = DB::table('pancard')
                    ->where('status', 'Rejected')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $dharsan = DB::table('dharsan')
                    ->where('status', 'Rejected')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $patta = DB::table('patta')
                    ->where('status', 'Rejected')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $software = DB::table('software')
                    ->where('status', 'Rejected')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard_otp = DB::table('smartcard_otp')
                    ->where('status', 'Rejected')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pstm = DB::table('pstm')
                    ->where('status', 'Rejected')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $utislpan = DB::table('utislpan')
                    ->where('status', 'Rejected')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $employment = DB::table('employment')
                    ->where('status', 'Rejected')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $police_verification = DB::table('police_verification')
                    ->where('status', 'Rejected')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $voteridpdf_download = DB::table('voteridpdf_download')
                    ->where('status', 'Rejected')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $agri_stack = DB::table('agri_stack')
                    ->where('status', 'Rejected')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard_pdf = DB::table('smartcard_pdf')
                    ->where('status', 'Rejected')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $aadhaarfind = DB::table('aadhaarfind')
                    ->where('status', 'Rejected')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $manual_pdf = DB::table('manual_pdf')
                    ->where('status', 'Rejected')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnega_residence = DB::table('tnega_residence')
                    ->where('status', 'Rejected')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $income = DB::table('income')
                    ->where('status', 'Rejected')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $nativity = DB::table('nativity')
                    ->where('status', 'Rejected')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnega_obc = DB::table('tnega_obc')
                    ->where('status', 'Rejected')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnega_unemployed = DB::table('tnega_unemployed')
                    ->where('status', 'Rejected')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $rerej = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard + $dharsan + $software + $smartcard_otp + $pstm + $patta + $utislpan + $employment + $police_verification + $voteridpdf_download + $agri_stack + $smartcard_pdf + $aadhaarfind + $manual_pdf + $nativity + $income + $tnega_obc + $tnega_residence + $tnega_unemployed;

                $service = DB::table('msme')
                    ->where('status', 'Approved')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $itr = DB::table('itr')
                    ->where('status', 'Approved')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $gst = DB::table('gst')
                    ->where('status', 'Approved')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tec_exam = DB::table('tec_exam')
                    ->where('status', 'Approved')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnegaservices = DB::table('tnega_services')
                    ->where('status', 'Approved')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard = DB::table('smartcard')
                    ->where('status', 'Approved')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $aadhaarcard = DB::table('aadhaarcard')
                    ->where('status', 'Approved')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $can_edit = DB::table('can_edit')
                    ->where('status', 'Approved')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $bond = DB::table('bond')
                    ->where('status', 'Approved')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $voterid = DB::table('voterid')
                    ->where('status', 'Approved')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $fssai = DB::table('fssai')
                    ->where('status', 'Approved')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $covid = DB::table('covid')
                    ->where('status', 'Approved')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $nalavariyam = DB::table('nalavariyam')
                    ->where('status', 'Approved')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $license = DB::table('license')
                    ->where('status', 'Approved')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pancard = DB::table('pancard')
                    ->where('status', 'Approved')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $dharsan = DB::table('dharsan')
                    ->where('status', 'Approved')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $patta = DB::table('patta')
                    ->where('status', 'Approved')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $software = DB::table('software')
                    ->where('status', 'Approved')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard_otp = DB::table('smartcard_otp')
                    ->where('status', 'Approved')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pstm = DB::table('pstm')
                    ->where('status', 'Approved')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $utislpan = DB::table('utislpan')
                    ->where('status', 'Approved')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $employment = DB::table('employment')
                    ->where('status', 'Approved')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $police_verification = DB::table('police_verification')
                    ->where('status', 'Approved')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $voteridpdf_download = DB::table('voteridpdf_download')
                    ->where('status', 'Approved')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $agri_stack = DB::table('agri_stack')
                    ->where('status', 'Approved')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard_pdf = DB::table('smartcard_pdf')
                    ->where('status', 'Approved')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $aadhaarfind = DB::table('aadhaarfind')
                    ->where('status', 'Approved')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $manual_pdf = DB::table('manual_pdf')
                    ->where('status', 'Approved')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $nativity = DB::table('nativity')
                    ->where('status', 'Approved')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $income = DB::table('income')
                    ->where('status', 'Approved')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnega_obc = DB::table('tnega_obc')
                    ->where('status', 'Approved')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnega_residence = DB::table('tnega_residence')
                    ->where('status', 'Approved')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $tnega_unemployed = DB::table('tnega_unemployed')
                    ->where('status', 'Approved')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $approve = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard + $dharsan + $software + $smartcard_otp + $pstm + $patta + $utislpan + $employment + $police_verification + $voteridpdf_download + $agri_stack + $smartcard_pdf + $aadhaarfind + $manual_pdf + $nativity + $income + $tnega_obc + $tnega_residence + $tnega_unemployed;

            }

            if (Auth::user()->user_type_id == 1 || Auth::user()->user_type_id == 2) {

                $pendingcount = DB::table('nalavariyam_form as a')
                    ->leftJoin('nalavariyam_district as b', 'a.dist_id', '=', 'b.id')
                    ->leftJoin('users as c', 'a.log_id', '=', 'c.id')
                    ->where('a.service_status', 'Pending')
                    ->whereNotNull('a.log_id') // log_id can be 0 or any value, but not NULL
                    ->count();

            } else {
                $log_id = Auth::user()->id;
                $sql    = "select count(*) as pending from nalavariyam_form a,nalavariyam_district b,nalavariyam_customer c where a.dist_id=b.id and a.customer_id=c.id and a.service_status = 'Pending' and a.log_id = $log_id";
                $result = DB::select(DB::raw($sql));
                if (count($result) > 0) {
                    $pendingcount = $result[0]->pending;
                }
            }

            if (Auth::user()->user_type_id == 1 || Auth::user()->user_type_id == 2) {

                $sql    = "select count(*) as resubmit from nalavariyam_form a,nalavariyam_district b,users c where a.dist_id=b.id and a.log_id=c.id and a.service_status = 'Resubmit'";
                $result = DB::select(DB::raw($sql));
                if (count($result) > 0) {
                    $resubmitcount = $result[0]->resubmit;
                }

            } else {
                $log_id = Auth::user()->id;
                $sql    = "select count(*) as resubmit from nalavariyam_form a,nalavariyam_district b,nalavariyam_customer c where a.dist_id=b.id and a.customer_id=c.id and a.service_status = 'Resubmit' and a.log_id = $log_id";
                $result = DB::select(DB::raw($sql));
                if (count($result) > 0) {
                    $resubmitcount = $result[0]->resubmit;
                }
            }

            if (Auth::user()->user_type_id == 1 || Auth::user()->user_type_id == 2) {

                $sql    = "select count(*) as approved from nalavariyam_form a,nalavariyam_district b,users c where a.dist_id=b.id and a.log_id=c.id and a.service_status = 'Completed'";
                $result = DB::select(DB::raw($sql));
                if (count($result) > 0) {
                    $approvedcount = $result[0]->approved;
                }

            } else {
                $log_id = Auth::user()->id;
                $sql    = "select count(*) as approved from nalavariyam_form a,nalavariyam_district b,nalavariyam_customer c where a.dist_id=b.id and a.customer_id=c.id and a.service_status = 'Completed' and a.log_id = $log_id";
                $result = DB::select(DB::raw($sql));
                if (count($result) > 0) {
                    $approvedcount = $result[0]->approved;
                }
            }
            $log_id = Auth::user()->id;
            $sql    = "select count(*) as memcount from nalavariyam_customer where refferal = $log_id";
            $users  = DB::select(DB::raw($sql));
            if (count($users) > 0) {
                $memcount = $users[0]->memcount;
            }

            return view('dashboard', compact('servicecount', 'customercount', 'retailer', 'distributor', 'retailer_count', 'distributor_count', 'customer', 'pending', 'inpro', 'resub', 'rerej', 'approve', 'service', 'RequestAmount', 'activation', 'ramjirequestAmount', 'notify', 'ourservice', 'pendingcount', 'resubmitcount', 'approvedcount', 'memcount', 'othersite_count', 'meeting','nalcount'));
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function spamusers()
    {
        $spamUsers = DB::table('users as u')
            ->leftJoin('request_payment as rp', 'rp.from_id', '=', 'u.id')
            ->whereNull('rp.id')                          // No payment request
            ->where('u.wallet', '>', 0)                   // Wallet > 0
            ->whereIn('u.status', ['Inactive', 'Active']) // Already marked inactive
            ->whereNotIn('u.id', [1, 2])                  // Exclude admin/system
            ->select('u.id', 'u.name', 'u.email', 'u.wallet', 'u.status')
            ->orderBy('u.wallet', 'desc')
            ->get();
        return view('errors.spamusers', compact('spamUsers'));
    }
}
