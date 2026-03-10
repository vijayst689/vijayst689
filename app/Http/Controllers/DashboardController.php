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

        $oneMonthAgo = Carbon::now()->subMonth()->toDateString();

        $records = DB::table('request_payment')
            ->whereDate('req_date', '<', $oneMonthAgo)
            ->whereNotNull('req_image')
            ->get();

        foreach ($records as $row) {

            $filePath = public_path('upload/paidimage/' . $row->req_image);

            if (File::exists($filePath)) {
                File::delete($filePath);
            }

            // Optional: set req_image = NULL after delete
            DB::table('request_payment')
                ->where('id', $row->id)
                ->update(['req_image' => null]);
        }
        return $filePath;
    }

    public function dashboard()
    {
        $logid = Auth::user()->id;
        if (Auth::check()) {

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

            $sql   = "select count(*) as customercount from customers where user_type_id = 5";
            $users = DB::select(DB::raw($sql));
            if (count($users) > 0) {
                $customercount = $users[0]->customercount;
            }
            $sql   = "select count(*) as customer from customers where user_type_id = 5 and refferal_id = $logid";
            $users = DB::select(DB::raw($sql));
            if (count($users) > 0) {
                $customer = $users[0]->customer;
            }

            $sql   = "select count(*) as retailer from users where user_type_id = 4";
            $users = DB::select(DB::raw($sql));
            if (count($users) > 0) {
                $retailer = $users[0]->retailer;
            }
            $sql   = "select count(*) as enquirycount from enquiry";
            $users = DB::select(DB::raw($sql));
            if (count($users) > 0) {
                $enquirycount = $users[0]->enquirycount;
            }
            $sql   = "select count(*) as newenquirycount from newenquiry";
            $users = DB::select(DB::raw($sql));
            if (count($users) > 0) {
                $newenquirycount = $users[0]->newenquirycount;
            }

            $sql   = "select count(*) as retailer_count from users where user_type_id = 4 and refferal_id = $logid";
            $users = DB::select(DB::raw($sql));
            if (count($users) > 0) {
                $retailer_count = $users[0]->retailer_count;
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

            $sql   = "select count(*) as service from services";
            $users = DB::select(DB::raw($sql));
            if (count($users) > 0) {
                $service = $users[0]->service;
            }

            $sql   = "select count(*) as allservice from services where status = 'Active' and parent_id = 0 and ser_id = 0";
            $users = DB::select(DB::raw($sql));
            if (count($users) > 0) {
                $allservice = $users[0]->allservice;
            }

            $sql      = "select count(id) as nalcount from nalavariyam_request where status='Pending' and (from_id=$login or to_id = $login)";
            $result   = DB::select(DB::raw($sql));
            $nalcount = 0;
            if (count($result) > 0) {
                $nalcount = $result[0]->nalcount;
            }

            $activation = DB::table('users')->where('id', $logid)->get();
            $notify     = DB::table('notification')->where('status', 'Active')->orderBy('id', 'Asc')->get();

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

                // $pancard = DB::table('pancard')
                // ->where('status','Pending')
                // ->orderBy('id', 'Desc')->count();

                $tailor = DB::table('tailor')
                    ->where('status', 'Pending')
                    ->orderBy('id', 'Desc')->count();

                $pmkissan = DB::table('pmkissan')
                    ->where('status', 'Pending')
                    ->orderBy('id', 'Desc')->count();

                $birth_certificate = DB::table('birth_certificate')
                    ->where('status', 'Pending')
                    ->orderBy('id', 'Desc')->count();

                $medicalscheme = DB::table('medicalscheme')
                    ->where('status', 'Pending')
                    ->orderBy('id', 'Desc')->count();

                $dharsan = DB::table('dharsan')
                    ->where('status', 'Pending')
                    ->orderBy('id', 'Desc')->count();

                $smartcard_otp = DB::table('smartcard_otp')
                    ->where('status', 'Pending')
                    ->orderBy('id', 'Desc')->count();

                $patta = DB::table('patta')
                    ->where('status', 'Pending')
                    ->orderBy('id', 'Desc')->count();

                $voteridpdf_download = DB::table('voteridpdf_download')
                    ->where('status', 'Pending')
                    ->orderBy('id', 'Desc')->count();

                $agri_stack = DB::table('agri_stack')
                    ->where('status', 'Pending')
                    ->orderBy('id', 'Desc')->count();

                $pvc_card = DB::table('pvc_card')
                    ->where('status', 'Pending')
                    ->orderBy('id', 'Desc')->count();

                $smartcard_pdf = DB::table('smartcard_pdf')
                    ->where('status', 'Pending')
                    ->orderBy('id', 'Desc')->count();

                $aadhaarfind = DB::table('aadhaarfind')
                    ->where('status', 'Pending')
                    ->orderBy('id', 'Desc')->count();
    

                $pending = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $tailor + $pmkissan + $birth_certificate + $medicalscheme + $dharsan + $patta + $smartcard_otp + $voteridpdf_download + $agri_stack + $pvc_card + $smartcard_pdf + $aadhaarfind;

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

                // $pancard = DB::table('pancard')
                // ->where('status','Processing')
                // ->orderBy('id', 'Desc')->count();

                $tailor = DB::table('tailor')
                    ->where('status', 'Processing')
                    ->orderBy('id', 'Desc')->count();

                $pmkissan = DB::table('pmkissan')
                    ->where('status', 'Processing')
                    ->orderBy('id', 'Desc')->count();

                $birth_certificate = DB::table('birth_certificate')
                    ->where('status', 'Processing')
                    ->orderBy('id', 'Desc')->count();

                $medicalscheme = DB::table('medicalscheme')
                    ->where('status', 'Processing')
                    ->orderBy('id', 'Desc')->count();

                $dharsan = DB::table('dharsan')
                    ->where('status', 'Processing')
                    ->orderBy('id', 'Desc')->count();

                $smartcard_otp = DB::table('smartcard_otp')
                    ->where('status', 'Processing')
                    ->orderBy('id', 'Desc')->count();

                $patta = DB::table('patta')
                    ->where('status', 'Processing')
                    ->orderBy('id', 'Desc')->count();

                $voteridpdf_download = DB::table('voteridpdf_download')
                    ->where('status', 'Processing')
                    ->orderBy('id', 'Desc')->count();

                $agri_stack = DB::table('agri_stack')
                    ->where('status', 'Processing')
                    ->orderBy('id', 'Desc')->count();

                $pvc_card = DB::table('pvc_card')
                    ->where('status', 'Processing')
                    ->orderBy('id', 'Desc')->count();

                $smartcard_pdf = DB::table('smartcard_pdf')
                    ->where('status', 'Processing')
                    ->orderBy('id', 'Desc')->count();

                $aadhaarfind = DB::table('aadhaarfind')
                    ->where('status', 'Processing')
                    ->orderBy('id', 'Desc')->count();
    

                $inpro = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $tailor + $pmkissan + $birth_certificate + $medicalscheme + $dharsan + $patta + $smartcard_otp + $voteridpdf_download + $agri_stack + $pvc_card + $smartcard_pdf + $aadhaarfind;

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

                // $pancard = DB::table('pancard')
                // ->where('status','Resubmit')
                // ->orderBy('id', 'Desc')->count();

                $tailor = DB::table('tailor')
                    ->where('status', 'Resubmit')
                    ->orderBy('id', 'Desc')->count();

                $pmkissan = DB::table('pmkissan')
                    ->where('status', 'Resubmit')
                    ->orderBy('id', 'Desc')->count();

                $birth_certificate = DB::table('birth_certificate')
                    ->where('status', 'Resubmit')
                    ->orderBy('id', 'Desc')->count();

                $medicalscheme = DB::table('medicalscheme')
                    ->where('status', 'Resubmit')
                    ->orderBy('id', 'Desc')->count();

                $dharsan = DB::table('dharsan')
                    ->where('status', 'Resubmit')
                    ->orderBy('id', 'Desc')->count();

                $smartcard_otp = DB::table('smartcard_otp')
                    ->where('status', 'Resubmit')
                    ->orderBy('id', 'Desc')->count();

                $patta = DB::table('patta')
                    ->where('status', 'Resubmit')
                    ->orderBy('id', 'Desc')->count();

                $voteridpdf_download = DB::table('voteridpdf_download')
                    ->where('status', 'Resubmit')
                    ->orderBy('id', 'Desc')->count();

                $agri_stack = DB::table('agri_stack')
                    ->where('status', 'Resubmit')
                    ->orderBy('id', 'Desc')->count();

                $pvc_card = DB::table('pvc_card')
                    ->where('status', 'Resubmit')
                    ->orderBy('id', 'Desc')->count();

                $smartcard_pdf = DB::table('smartcard_pdf')
                    ->where('status', 'Resubmit')
                    ->orderBy('id', 'Desc')->count();

                $aadhaarfind = DB::table('aadhaarfind')
                    ->where('status', 'Resubmit')
                    ->orderBy('id', 'Desc')->count();
    

                $resub = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $tailor + $pmkissan + $birth_certificate + $medicalscheme + $dharsan + $smartcard_otp + $voteridpdf_download + $agri_stack + $pvc_card + $smartcard_pdf + $aadhaarfind;

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

                // $pancard = DB::table('pancard')
                // ->where('status','Rejected')
                // ->orderBy('id', 'Desc')->count();

                $tailor = DB::table('tailor')
                    ->where('status', 'Rejected')
                    ->orderBy('id', 'Desc')->count();

                $pmkissan = DB::table('pmkissan')
                    ->where('status', 'Rejected')
                    ->orderBy('id', 'Desc')->count();

                $birth_certificate = DB::table('birth_certificate')
                    ->where('status', 'Rejected')
                    ->orderBy('id', 'Desc')->count();

                $medicalscheme = DB::table('medicalscheme')
                    ->where('status', 'Rejected')
                    ->orderBy('id', 'Desc')->count();

                $dharsan = DB::table('dharsan')
                    ->where('status', 'Rejected')
                    ->orderBy('id', 'Desc')->count();

                $smartcard_otp = DB::table('smartcard_otp')
                    ->where('status', 'Rejected')
                    ->orderBy('id', 'Desc')->count();

                $patta = DB::table('patta')
                    ->where('status', 'Rejected')
                    ->orderBy('id', 'Desc')->count();

                $voteridpdf_download = DB::table('voteridpdf_download')
                    ->where('status', 'Rejected')
                    ->orderBy('id', 'Desc')->count();

                $agri_stack = DB::table('agri_stack')
                    ->where('status', 'Rejected')
                    ->orderBy('id', 'Desc')->count();

                $pvc_card = DB::table('pvc_card')
                    ->where('status', 'Rejected')
                    ->orderBy('id', 'Desc')->count();
                
                $smartcard_pdf = DB::table('smartcard_pdf')
                    ->where('status', 'Rejected')
                    ->orderBy('id', 'Desc')->count();

                $aadhaarfind = DB::table('aadhaarfind')
                    ->where('status', 'Rejected')
                    ->orderBy('id', 'Desc')->count();
    
                $rerej = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $tailor + $pmkissan + $birth_certificate + $medicalscheme + $dharsan + $smartcard_otp + $voteridpdf_download + $agri_stack + $pvc_card + $smartcard_pdf + $aadhaarfind;

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

                // $pancard = DB::table('pancard')
                // ->where('status','Approved')
                // ->orderBy('id', 'Desc')->count();

                $tailor = DB::table('tailor')
                    ->where('status', 'Approved')
                    ->orderBy('id', 'Desc')->count();

                $pmkissan = DB::table('pmkissan')
                    ->where('status', 'Approved')
                    ->orderBy('id', 'Desc')->count();

                $birth_certificate = DB::table('birth_certificate')
                    ->where('status', 'Approved')
                    ->orderBy('id', 'Desc')->count();

                $medicalscheme = DB::table('medicalscheme')
                    ->where('status', 'Approved')
                    ->orderBy('id', 'Desc')->count();

                $dharsan = DB::table('dharsan')
                    ->where('status', 'Approved')
                    ->orderBy('id', 'Desc')->count();

                $smartcard_otp = DB::table('smartcard_otp')
                    ->where('status', 'Approved')
                    ->orderBy('id', 'Desc')->count();

                $patta = DB::table('patta')
                    ->where('status', 'Approved')
                    ->orderBy('id', 'Desc')->count();

                $voteridpdf_download = DB::table('voteridpdf_download')
                    ->where('status', 'Approved')
                    ->orderBy('id', 'Desc')->count();

                $agri_stack = DB::table('agri_stack')
                    ->where('status', 'Approved')
                    ->orderBy('id', 'Desc')->count();

                $pvc_card = DB::table('pvc_card')
                    ->where('status', 'Approved')
                    ->orderBy('id', 'Desc')->count();

                $smartcard_pdf = DB::table('smartcard_pdf')
                    ->where('status', 'Approved')
                    ->orderBy('id', 'Desc')->count();

                $aadhaarfind = DB::table('aadhaarfind')
                    ->where('status', 'Approved')
                    ->orderBy('id', 'Desc')->count();
    

                $approve = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $tailor + $pmkissan + $birth_certificate + $medicalscheme + $dharsan + $patta + $smartcard_otp + $voteridpdf_download + $agri_stack + $pvc_card + $smartcard_pdf + $aadhaarfind;

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

                $tailor = DB::table('tailor')
                    ->where('status', 'Pending')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pmkissan = DB::table('pmkissan')
                    ->where('status', 'Pending')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $birth_certificate = DB::table('birth_certificate')
                    ->where('status', 'Pending')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $medicalscheme = DB::table('medicalscheme')
                    ->where('status', 'Pending')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $dharsan = DB::table('dharsan')
                    ->where('status', 'Pending')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard_otp = DB::table('smartcard_otp')
                    ->where('status', 'Pending')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $patta = DB::table('patta')
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

                $pvc_card = DB::table('pvc_card')
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

                $pending = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard + $tailor + $pmkissan + $birth_certificate + $medicalscheme + $dharsan + $patta + $smartcard_otp + $voteridpdf_download + $agri_stack + $pvc_card + $smartcard_pdf + $aadhaarfind;

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

                $tailor = DB::table('tailor')
                    ->where('status', 'Processing')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pmkissan = DB::table('pmkissan')
                    ->where('status', 'Processing')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $birth_certificate = DB::table('birth_certificate')
                    ->where('status', 'Processing')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $medicalscheme = DB::table('medicalscheme')
                    ->where('status', 'Processing')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $dharsan = DB::table('dharsan')
                    ->where('status', 'Processing')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard_otp = DB::table('smartcard_otp')
                    ->where('status', 'Processing')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $patta = DB::table('patta')
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

                $pvc_card = DB::table('pvc_card')
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

                    

                $inpro = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard + $tailor + $pmkissan + $birth_certificate + $medicalscheme + $dharsan + $patta + $smartcard_otp + $voteridpdf_download + $agri_stack + $pvc_card + $smartcard_pdf + $aadhaarfind;

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

                $tailor = DB::table('tailor')
                    ->where('status', 'Resubmit')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pmkissan = DB::table('pmkissan')
                    ->where('status', 'Resubmit')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $birth_certificate = DB::table('birth_certificate')
                    ->where('status', 'Resubmit')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $medicalscheme = DB::table('medicalscheme')
                    ->where('status', 'Resubmit')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $dharsan = DB::table('dharsan')
                    ->where('status', 'Resubmit')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard_otp = DB::table('smartcard_otp')
                    ->where('status', 'Resubmit')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $patta = DB::table('patta')
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

                $pvc_card = DB::table('pvc_card')
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

                $resub = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard + $tailor + $pmkissan + $birth_certificate + $medicalscheme + $dharsan + $patta + $smartcard_otp + $voteridpdf_download + $agri_stack + $pvc_card + $smartcard_pdf + $aadhaarfind;

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

                $tailor = DB::table('tailor')
                    ->where('status', 'Rejected')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pmkissan = DB::table('pmkissan')
                    ->where('status', 'Rejected')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $birth_certificate = DB::table('birth_certificate')
                    ->where('status', 'Rejected')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $medicalscheme = DB::table('medicalscheme')
                    ->where('status', 'Rejected')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $dharsan = DB::table('dharsan')
                    ->where('status', 'Rejected')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard_otp = DB::table('smartcard_otp')
                    ->where('status', 'Rejected')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $patta = DB::table('patta')
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

                $pvc_card = DB::table('pvc_card')
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
                $rerej = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard + $tailor + $pmkissan + $birth_certificate + $medicalscheme + $dharsan + $patta + $smartcard_otp + $voteridpdf_download + $agri_stack + $pvc_card + $smartcard_pdf + $aadhaarfind;

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

                $tailor = DB::table('tailor')
                    ->where('status', 'Approved')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pmkissan = DB::table('pmkissan')
                    ->where('status', 'Approved')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $birth_certificate = DB::table('birth_certificate')
                    ->where('status', 'Approved')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $medicalscheme = DB::table('medicalscheme')
                    ->where('status', 'Approved')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $dharsan = DB::table('dharsan')
                    ->where('status', 'Approved')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard_otp = DB::table('smartcard_otp')
                    ->where('status', 'Approved')
                    ->where('distributor_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $patta = DB::table('patta')
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

                $pvc_card = DB::table('pvc_card')
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

                $approve = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard + $tailor + $pmkissan + $birth_certificate + $medicalscheme + $dharsan + $patta + $smartcard_otp + $voteridpdf_download + $agri_stack + $pvc_card + $smartcard_pdf + $aadhaarfind;

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

                $tailor = DB::table('tailor')
                    ->where('status', 'Pending')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pmkissan = DB::table('pmkissan')
                    ->where('status', 'Pending')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $birth_certificate = DB::table('birth_certificate')
                    ->where('status', 'Pending')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $medicalscheme = DB::table('medicalscheme')
                    ->where('status', 'Pending')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $dharsan = DB::table('dharsan')
                    ->where('status', 'Pending')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                //    $smartcard_otp = DB::table('$smartcard_otp')
                //     ->where('status','Pending')
                //     ->where('retailer_id',Auth::user()->id)
                //     ->orderBy('id', 'Desc')->count();

                $patta = DB::table('patta')
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

                $pvc_card = DB::table('pvc_card')
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

                $pending = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard + $tailor + $pmkissan + $birth_certificate + $medicalscheme + $dharsan + $patta + $voteridpdf_download + $agri_stack + $pvc_card + $smartcard_pdf + $aadhaarfind;

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

                $tailor = DB::table('tailor')
                    ->where('status', 'Processing')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pmkissan = DB::table('pmkissan')
                    ->where('status', 'Processing')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $birth_certificate = DB::table('birth_certificate')
                    ->where('status', 'Processing')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $medicalscheme = DB::table('medicalscheme')
                    ->where('status', 'Processing')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $dharsan = DB::table('dharsan')
                    ->where('status', 'Processing')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard_otp = DB::table('smartcard_otp')
                    ->where('status', 'Processing')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $patta = DB::table('patta')
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

                $pvc_card = DB::table('pvc_card')
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
                $inpro = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard + $tailor + $pmkissan + $birth_certificate + $medicalscheme + $dharsan + $patta + $smartcard_otp + $voteridpdf_download + $agri_stack + $pvc_card + $smartcard_pdf + $aadhaarfind;

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

                $tailor = DB::table('tailor')
                    ->where('status', 'Resubmit')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pmkissan = DB::table('pmkissan')
                    ->where('status', 'Resubmit')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $birth_certificate = DB::table('birth_certificate')
                    ->where('status', 'Resubmit')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $medicalscheme = DB::table('medicalscheme')
                    ->where('status', 'Resubmit')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $dharsan = DB::table('dharsan')
                    ->where('status', 'Resubmit')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard_otp = DB::table('smartcard_otp')
                    ->where('status', 'Resubmit')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $patta = DB::table('patta')
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

                $pvc_card = DB::table('pvc_card')
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

                $resub = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard + $tailor + $pmkissan + $birth_certificate + $medicalscheme + $dharsan + $patta + $smartcard_otp + $voteridpdf_download + $agri_stack + $pvc_card + $smartcard_pdf + $aadhaarfind;

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

                $tailor = DB::table('tailor')
                    ->where('status', 'Rejected')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pmkissan = DB::table('pmkissan')
                    ->where('status', 'Rejected')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $birth_certificate = DB::table('birth_certificate')
                    ->where('status', 'Rejected')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $medicalscheme = DB::table('medicalscheme')
                    ->where('status', 'Rejected')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $dharsan = DB::table('dharsan')
                    ->where('status', 'Rejected')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard_otp = DB::table('smartcard_otp')
                    ->where('status', 'Rejected')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $patta = DB::table('patta')
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

                $pvc_card = DB::table('pvc_card')
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

                $rerej = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard + $tailor + $pmkissan + $birth_certificate + $medicalscheme + $dharsan + $patta + $smartcard_otp + $voteridpdf_download + $agri_stack + $pvc_card + $smartcard_pdf + $aadhaarfind;

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

                $tailor = DB::table('tailor')
                    ->where('status', 'Approved')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pmkissan = DB::table('pmkissan')
                    ->where('status', 'Approved')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $birth_certificate = DB::table('birth_certificate')
                    ->where('status', 'Approved')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $medicalscheme = DB::table('medicalscheme')
                    ->where('status', 'Approved')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $dharsan = DB::table('dharsan')
                    ->where('status', 'Approved')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard_otp = DB::table('smartcard_otp')
                    ->where('status', 'Approved')
                    ->where('retailer_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $patta = DB::table('patta')
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

                $pvc_card = DB::table('pvc_card')
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

                $approve = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard + $tailor + $pmkissan + $birth_certificate + $medicalscheme + $dharsan + $patta + $smartcard_otp + $voteridpdf_download + $agri_stack + $pvc_card + $smartcard_pdf + $aadhaarfind;

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

                $tailor = DB::table('tailor')
                    ->where('status', 'Pending')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pmkissan = DB::table('pmkissan')
                    ->where('status', 'Pending')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $birth_certificate = DB::table('birth_certificate')
                    ->where('status', 'Pending')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $medicalscheme = DB::table('medicalscheme')
                    ->where('status', 'Pending')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $dharsan = DB::table('dharsan')
                    ->where('status', 'Pending')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard_otp = DB::table('smartcard_otp')
                    ->where('status', 'Pending')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $patta = DB::table('patta')
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

                $pvc_card = DB::table('pvc_card')
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

                $pending = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard + $patta + $smartcard_otp + $voteridpdf_download + $agri_stack + $pvc_card + $smartcard_pdf + $aadhaarfind;

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

                $tailor = DB::table('tailor')
                    ->where('status', 'Processing')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pmkissan = DB::table('pmkissan')
                    ->where('status', 'Processing')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $birth_certificate = DB::table('birth_certificate')
                    ->where('status', 'Processing')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $medicalscheme = DB::table('medicalscheme')
                    ->where('status', 'Processing')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $dharsan = DB::table('dharsan')
                    ->where('status', 'Processing')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard_otp = DB::table('smartcard_otp')
                    ->where('status', 'Processing')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $patta = DB::table('patta')
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

                $pvc_card = DB::table('pvc_card')
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

                $inpro = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard + $tailor + $pmkissan + $birth_certificate + $medicalscheme + $dharsan + $patta + $smartcard_otp + $voteridpdf_download + $agri_stack + $pvc_card + $smartcard_pdf + $aadhaarfind;

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

                $tailor = DB::table('tailor')
                    ->where('status', 'Resubmit')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pmkissan = DB::table('pmkissan')
                    ->where('status', 'Resubmit')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $birth_certificate = DB::table('birth_certificate')
                    ->where('status', 'Resubmit')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $medicalscheme = DB::table('medicalscheme')
                    ->where('status', 'Resubmit')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $dharsan = DB::table('dharsan')
                    ->where('status', 'Resubmit')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard_otp = DB::table('smartcard_otp')
                    ->where('status', 'Resubmit')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $patta = DB::table('patta')
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

                $pvc_card = DB::table('pvc_card')
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

                $resub = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard + $tailor + $pmkissan + $birth_certificate + $medicalscheme + $dharsan + $patta + $smartcard_otp + $voteridpdf_download + $agri_stack + $pvc_card + $smartcard_pdf + $aadhaarfind;

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

                $tailor = DB::table('tailor')
                    ->where('status', 'Rejected')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pmkissan = DB::table('pmkissan')
                    ->where('status', 'Rejected')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $birth_certificate = DB::table('birth_certificate')
                    ->where('status', 'Rejected')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $medicalscheme = DB::table('medicalscheme')
                    ->where('status', 'Rejected')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $dharsan = DB::table('dharsan')
                    ->where('status', 'Rejected')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard_otp = DB::table('smartcard_otp')
                    ->where('status', 'Rejected')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $patta = DB::table('patta')
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

                $pvc_card = DB::table('pvc_card')
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

                $rerej = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard + $tailor + $pmkissan + $birth_certificate + $medicalscheme + $dharsan + $patta + $smartcard_otp + $voteridpdf_download + $agri_stack + $pvc_card + $smartcard_pdf + $aadhaarfind;

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

                $tailor = DB::table('tailor')
                    ->where('status', 'Approved')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $pmkissan = DB::table('pmkissan')
                    ->where('status', 'Approved')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $birth_certificate = DB::table('birth_certificate')
                    ->where('status', 'Approved')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $medicalscheme = DB::table('medicalscheme')
                    ->where('status', 'Approved')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $dharsan = DB::table('dharsan')
                    ->where('status', 'Approved')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $smartcard_otp = DB::table('smartcard_otp')
                    ->where('status', 'Approved')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('id', 'Desc')->count();

                $patta = DB::table('patta')
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

                $pvc_card = DB::table('pvc_card')
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

                $approve = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard + $tailor + $pmkissan + $birth_certificate + $medicalscheme + $dharsan + $patta + $smartcard_otp + $voteridpdf_download + $agri_stack + $pvc_card + $smartcard_pdf + $aadhaarfind;
            }

            if (Auth::user()->user_type_id == 1 || Auth::user()->user_type_id == 2) {

                $sql    = "select count(*) as pending from nalavariyam_form a,nalavariyam_district b,users c where a.dist_id=b.id and a.log_id=c.id and a.service_status = 'Pending'";
                $result = DB::select(DB::raw($sql));
                if (count($result) > 0) {
                    $pendingcount = $result[0]->pending;
                }

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

            return view('dashboard', compact('servicecount', 'customercount', 'retailer', 'distributor', 'retailer_count', 'distributor_count', 'customer', 'pending', 'inpro', 'resub', 'rerej', 'approve', 'service', 'RequestAmount', 'activation', 'allservice', 'ramjirequestAmount', 'ourservice', 'notify', 'pendingcount', 'resubmitcount', 'approvedcount', 'memcount', 'enquirycount', 'newenquirycount','nalcount'));
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
