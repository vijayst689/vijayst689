<?php

namespace App\Http\Controllers;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function dashboard()
    {
        $logid = Auth::user()->id;
        if(Auth::check()){

            $sql = "select count(*) as servicecount from services";
            $users = DB::select(DB::raw($sql));
            if (count($users) > 0) {
                $servicecount = $users[0]->servicecount;
            }

            $sql = "select count(*) as enquiry_count from users where user_type_id = 2";
            $users = DB::select(DB::raw($sql));
            if (count($users) > 0) {
                $enquiry_count = $users[0]->enquiry_count;
            }

            $sql = "select count(*) as distributor from users where user_type_id = 3";
            $users = DB::select(DB::raw($sql));
            if (count($users) > 0) {
                $distributor = $users[0]->distributor;
            }

            $sql = "select count(*) as distributor_count from users where user_type_id = 3 and refferal_id = $logid";
            $users = DB::select(DB::raw($sql));
            if (count($users) > 0) {
                $distributor_count = $users[0]->distributor_count;
            }

            $sql = "select count(*) as customercount from users where user_type_id = 5";
            $users = DB::select(DB::raw($sql));
            if (count($users) > 0) {
                $customercount = $users[0]->customercount;
            }
            $sql = "select count(*) as customer from users where user_type_id = 5 and refferal_id = $logid";
            $users = DB::select(DB::raw($sql));
            if (count($users) > 0) {
                $customer = $users[0]->customer;
            }

            $sql = "select count(*) as retailer from users where user_type_id = 4";
            $users = DB::select(DB::raw($sql));
            if (count($users) > 0) {
                $retailer = $users[0]->retailer;
            }

            $sql = "select count(*) as retailer_count from users where user_type_id = 4 and refferal_id = $logid";
            $users = DB::select(DB::raw($sql));
            if (count($users) > 0) {
                $retailer_count = $users[0]->retailer_count;
            }

            $login = Auth::user()->id;
            $sql = "select count(id) as RequestAmount from request_payment where status='Pending' and (from_id=$login or to_id = $login )";
            $result = DB::select( DB::raw( $sql ) );
            $RequestAmount = 0;
            if ( count( $result ) > 0 ) {
            $RequestAmount = $result[ 0 ]->RequestAmount;
            }

            $sql = "select count(id) as ramjirequestAmount from request_payment where status='Pending' and (to_id = $login )";
            $result = DB::select( DB::raw( $sql ) );
            $ramjirequestAmount = 0;
            if ( count( $result ) > 0 ) {
                $ramjirequestAmount = $result[ 0 ]->ramjirequestAmount;
            }

            $sql = "select count(*) as service from services";
            $users = DB::select(DB::raw($sql));
            if (count($users) > 0) {
                $service = $users[0]->service;
            }

            $sql = "select count(*) as allservice from services where status = 'Active' and parent_id = 0 and ser_id = 0";
            $users = DB::select(DB::raw($sql));
            if (count($users) > 0) {
                $allservice = $users[0]->allservice;
            }

            $activation = DB::table( 'users' )->where('id',$logid)->get();

            if(Auth::user()->user_type_id == 2 || Auth::user()->user_type_id == 1){

            $service = DB::table('msme')
            ->where('status','Pending')
            ->orderBy('id', 'Desc')->count();

            $itr = DB::table('itr')
            ->where('status','Pending')
            ->orderBy('id', 'Desc')->count();

            $gst = DB::table('gst')
            ->where('status','Pending')
            ->orderBy('id', 'Desc')->count();

            $tec_exam = DB::table('tec_exam')
            ->where('status','Pending')
            ->orderBy('id', 'Desc')->count();

            $tnegaservices = DB::table('tnega_services')
            ->where('status','Pending')
            ->orderBy('id', 'Desc')->count();

            $smartcard = DB::table('smartcard')
            ->where('status','Pending')
            ->orderBy('id', 'Desc')->count();

            $aadhaarcard = DB::table('aadhaarcard')
            ->where('status','Pending')
            ->orderBy('id', 'Desc')->count();

            $can_edit = DB::table('can_edit')
            ->where('status','Pending')
            ->orderBy('id', 'Desc')->count();

            $bond = DB::table('bond')
            ->where('status','Pending')
            ->orderBy('id', 'Desc')->count();

            $voterid = DB::table('voterid')
            ->where('status','Pending')
            ->orderBy('id', 'Desc')->count();

            $fssai = DB::table('fssai')
            ->where('status','Pending')
            ->orderBy('id', 'Desc')->count();

            $covid = DB::table('covid')
            ->where('status','Pending')
            ->orderBy('id', 'Desc')->count();

            $nalavariyam = DB::table('nalavariyam')
            ->where('status','Pending')
            ->orderBy('id', 'Desc')->count();

            $license = DB::table('license')
            ->where('status','Pending')
            ->orderBy('id', 'Desc')->count();

            $pancard = DB::table('pancard')
            ->where('status','Pending')
            ->orderBy('id', 'Desc')->count();

            $tailor = DB::table('tailor')
            ->where('status','Pending')
            ->orderBy('id', 'Desc')->count();

            $pmkissan = DB::table('pmkissan')
            ->where('status','Pending')
            ->orderBy('id', 'Desc')->count();

            $birth_certificate = DB::table('birth_certificate')
            ->where('status','Pending')
            ->orderBy('id', 'Desc')->count();

            $medicalscheme = DB::table('medicalscheme')
            ->where('status','Pending')
            ->orderBy('id', 'Desc')->count();

            $dharsan = DB::table('dharsan')
            ->where('status','Pending')
            ->orderBy('id', 'Desc')->count();

            $pending = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard + $tailor + $pmkissan + $birth_certificate + $medicalscheme + $dharsan;

            $service = DB::table('msme')
            ->where('status','Processing')
            ->orderBy('id', 'Desc')->count();

            $itr = DB::table('itr')
            ->where('status','Processing')
            ->orderBy('id', 'Desc')->count();

            $gst = DB::table('gst')
            ->where('status','Processing')
            ->orderBy('id', 'Desc')->count();

            $tec_exam = DB::table('tec_exam')
            ->where('status','Processing')
            ->orderBy('id', 'Desc')->count();

            $tnegaservices = DB::table('tnega_services')
            ->where('status','Processing')
            ->orderBy('id', 'Desc')->count();

            $smartcard = DB::table('smartcard')
            ->where('status','Processing')
            ->orderBy('id', 'Desc')->count();

            $aadhaarcard = DB::table('aadhaarcard')
            ->where('status','Processing')
            ->orderBy('id', 'Desc')->count();

            $can_edit = DB::table('can_edit')
            ->where('status','Processing')
            ->orderBy('id', 'Desc')->count();

            $bond = DB::table('bond')
            ->where('status','Processing')
            ->orderBy('id', 'Desc')->count();

            $voterid = DB::table('voterid')
            ->where('status','Processing')
            ->orderBy('id', 'Desc')->count();

            $fssai = DB::table('fssai')
            ->where('status','Processing')
            ->orderBy('id', 'Desc')->count();

            $covid = DB::table('covid')
            ->where('status','Processing')
            ->orderBy('id', 'Desc')->count();

            $nalavariyam = DB::table('nalavariyam')
            ->where('status','Processing')
            ->orderBy('id', 'Desc')->count();

            $license = DB::table('license')
            ->where('status','Processing')
            ->orderBy('id', 'Desc')->count();

            $pancard = DB::table('pancard')
            ->where('status','Processing')
            ->orderBy('id', 'Desc')->count();

            $tailor = DB::table('tailor')
            ->where('status','Processing')
            ->orderBy('id', 'Desc')->count();

            $pmkissan = DB::table('pmkissan')
            ->where('status','Processing')
            ->orderBy('id', 'Desc')->count();

            $birth_certificate = DB::table('birth_certificate')
            ->where('status','Processing')
            ->orderBy('id', 'Desc')->count();

            $medicalscheme = DB::table('medicalscheme')
            ->where('status','Processing')
            ->orderBy('id', 'Desc')->count();

            $dharsan = DB::table('dharsan')
            ->where('status','Processing')
            ->orderBy('id', 'Desc')->count();

            $inpro = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard + $tailor + $pmkissan + $birth_certificate + $medicalscheme + $dharsan;

            $service = DB::table('msme')
            ->where('status','Resubmit')
            ->orderBy('id', 'Desc')->count();

            $itr = DB::table('itr')
            ->where('status','Resubmit')
            ->orderBy('id', 'Desc')->count();

            $gst = DB::table('gst')
            ->where('status','Resubmit')
            ->orderBy('id', 'Desc')->count();

            $tec_exam = DB::table('tec_exam')
            ->where('status','Resubmit')
            ->orderBy('id', 'Desc')->count();

            $tnegaservices = DB::table('tnega_services')
            ->where('status','Resubmit')
            ->orderBy('id', 'Desc')->count();

            $smartcard = DB::table('smartcard')
            ->where('status','Resubmit')
            ->orderBy('id', 'Desc')->count();

            $aadhaarcard = DB::table('aadhaarcard')
            ->where('status','Resubmit')
            ->orderBy('id', 'Desc')->count();

            $can_edit = DB::table('can_edit')
            ->where('status','Resubmit')
            ->orderBy('id', 'Desc')->count();

            $bond = DB::table('bond')
            ->where('status','Resubmit')
            ->orderBy('id', 'Desc')->count();

            $voterid = DB::table('voterid')
            ->where('status','Resubmit')
            ->orderBy('id', 'Desc')->count();

            $fssai = DB::table('fssai')
            ->where('status','Resubmit')
            ->orderBy('id', 'Desc')->count();

            $covid = DB::table('covid')
            ->where('status','Resubmit')
            ->orderBy('id', 'Desc')->count();

            $nalavariyam = DB::table('nalavariyam')
            ->where('status','Resubmit')
            ->orderBy('id', 'Desc')->count();

            $license = DB::table('license')
            ->where('status','Resubmit')
            ->orderBy('id', 'Desc')->count();

            $pancard = DB::table('pancard')
            ->where('status','Resubmit')
            ->orderBy('id', 'Desc')->count();

            $tailor = DB::table('tailor')
            ->where('status','Resubmit')
            ->orderBy('id', 'Desc')->count();

            $pmkissan = DB::table('pmkissan')
            ->where('status','Resubmit')
            ->orderBy('id', 'Desc')->count();

            $birth_certificate = DB::table('birth_certificate')
            ->where('status','Resubmit')
            ->orderBy('id', 'Desc')->count();

            $medicalscheme = DB::table('medicalscheme')
            ->where('status','Resubmit')
            ->orderBy('id', 'Desc')->count();

            $dharsan = DB::table('dharsan')
            ->where('status','Resubmit')
            ->orderBy('id', 'Desc')->count();

            $resub = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard + $tailor + $pmkissan + $birth_certificate + $medicalscheme + $dharsan;

            $service = DB::table('msme')
            ->where('status','Approved')
            ->orderBy('id', 'Desc')->count();

            $itr = DB::table('itr')
            ->where('status','Approved')
            ->orderBy('id', 'Desc')->count();

            $gst = DB::table('gst')
            ->where('status','Approved')
            ->orderBy('id', 'Desc')->count();

            $tec_exam = DB::table('tec_exam')
            ->where('status','Approved')
            ->orderBy('id', 'Desc')->count();

            $tnegaservices = DB::table('tnega_services')
            ->where('status','Approved')
            ->orderBy('id', 'Desc')->count();

            $smartcard = DB::table('smartcard')
            ->where('status','Approved')
            ->orderBy('id', 'Desc')->count();

            $aadhaarcard = DB::table('aadhaarcard')
            ->where('status','Approved')
            ->orderBy('id', 'Desc')->count();

            $can_edit = DB::table('can_edit')
            ->where('status','Approved')
            ->orderBy('id', 'Desc')->count();

            $bond = DB::table('bond')
            ->where('status','Approved')
            ->orderBy('id', 'Desc')->count();

            $voterid = DB::table('voterid')
            ->where('status','Approved')
            ->orderBy('id', 'Desc')->count();

            $fssai = DB::table('fssai')
            ->where('status','Approved')
            ->orderBy('id', 'Desc')->count();

            $covid = DB::table('covid')
            ->where('status','Approved')
            ->orderBy('id', 'Desc')->count();

            $nalavariyam = DB::table('nalavariyam')
            ->where('status','Approved')
            ->orderBy('id', 'Desc')->count();

            $license = DB::table('license')
            ->where('status','Approved')
            ->orderBy('id', 'Desc')->count();

            $pancard = DB::table('pancard')
            ->where('status','Approved')
            ->orderBy('id', 'Desc')->count();

            $tailor = DB::table('tailor')
            ->where('status','Approved')
            ->orderBy('id', 'Desc')->count();

            $pmkissan = DB::table('pmkissan')
            ->where('status','Approved')
            ->orderBy('id', 'Desc')->count();

            $birth_certificate = DB::table('birth_certificate')
            ->where('status','Approved')
            ->orderBy('id', 'Desc')->count();

            $medicalscheme = DB::table('medicalscheme')
            ->where('status','Approved')
            ->orderBy('id', 'Desc')->count();

            $dharsan = DB::table('dharsan')
            ->where('status','Approved')
            ->orderBy('id', 'Desc')->count();

            $approve = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard + $tailor + $pmkissan + $birth_certificate + $medicalscheme + $dharsan;

        }elseif(Auth::user()->user_type_id == 3){

          $service = DB::table('msme')
            ->where('status','Pending')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $itr = DB::table('itr')
            ->where('status','Pending')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $gst = DB::table('gst')
            ->where('status','Pending')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $tec_exam = DB::table('tec_exam')
            ->where('status','Pending')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $tnegaservices = DB::table('tnega_services')
            ->where('status','Pending')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $smartcard = DB::table('smartcard')
            ->where('status','Pending')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $aadhaarcard = DB::table('aadhaarcard')
            ->where('status','Pending')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $can_edit = DB::table('can_edit')
            ->where('status','Pending')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $bond = DB::table('bond')
            ->where('status','Pending')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $voterid = DB::table('voterid')
            ->where('status','Pending')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $fssai = DB::table('fssai')
            ->where('status','Pending')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $covid = DB::table('covid')
            ->where('status','Pending')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $nalavariyam = DB::table('nalavariyam')
            ->where('status','Pending')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $license = DB::table('license')
            ->where('status','Pending')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $pancard = DB::table('pancard')
            ->where('status','Pending')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $tailor = DB::table('tailor')
            ->where('status','Pending')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $pmkissan = DB::table('pmkissan')
            ->where('status','Pending')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $birth_certificate = DB::table('birth_certificate')
            ->where('status','Pending')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $medicalscheme = DB::table('medicalscheme')
            ->where('status','Pending')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $dharsan = DB::table('dharsan')
            ->where('status','Pending')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $pending = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard + $tailor + $pmkissan + $birth_certificate + $medicalscheme + $dharsan;

            $service = DB::table('msme')
            ->where('status','Processing')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $itr = DB::table('itr')
            ->where('status','Processing')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $gst = DB::table('gst')
            ->where('status','Processing')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $tec_exam = DB::table('tec_exam')
            ->where('status','Processing')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $tnegaservices = DB::table('tnega_services')
            ->where('status','Processing')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $smartcard = DB::table('smartcard')
            ->where('status','Processing')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $aadhaarcard = DB::table('aadhaarcard')
            ->where('status','Processing')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $can_edit = DB::table('can_edit')
            ->where('status','Processing')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $bond = DB::table('bond')
            ->where('status','Processing')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $voterid = DB::table('voterid')
            ->where('status','Processing')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $fssai = DB::table('fssai')
            ->where('status','Processing')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $covid = DB::table('covid')
            ->where('status','Processing')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $nalavariyam = DB::table('nalavariyam')
            ->where('status','Processing')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $license = DB::table('license')
            ->where('status','Processing')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $pancard = DB::table('pancard')
            ->where('status','Processing')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $tailor = DB::table('tailor')
            ->where('status','Processing')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $pmkissan = DB::table('pmkissan')
            ->where('status','Processing')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $birth_certificate = DB::table('birth_certificate')
            ->where('status','Processing')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $medicalscheme = DB::table('medicalscheme')
            ->where('status','Processing')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $dharsan = DB::table('dharsan')
            ->where('status','Processing')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $inpro = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard + $tailor + $pmkissan + $birth_certificate + $medicalscheme + $dharsan;

            $service = DB::table('msme')
            ->where('status','Resubmit')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $itr = DB::table('itr')
            ->where('status','Resubmit')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $gst = DB::table('gst')
            ->where('status','Resubmit')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $tec_exam = DB::table('tec_exam')
            ->where('status','Resubmit')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $tnegaservices = DB::table('tnega_services')
            ->where('status','Resubmit')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $smartcard = DB::table('smartcard')
            ->where('status','Resubmit')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $aadhaarcard = DB::table('aadhaarcard')
            ->where('status','Resubmit')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $can_edit = DB::table('can_edit')
            ->where('status','Resubmit')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $bond = DB::table('bond')
            ->where('status','Resubmit')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $voterid = DB::table('voterid')
            ->where('status','Resubmit')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $fssai = DB::table('fssai')
            ->where('status','Resubmit')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $covid = DB::table('covid')
            ->where('status','Resubmit')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $nalavariyam = DB::table('nalavariyam')
            ->where('status','Resubmit')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $license = DB::table('license')
            ->where('status','Resubmit')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $pancard = DB::table('pancard')
            ->where('status','Resubmit')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $tailor = DB::table('tailor')
            ->where('status','Resubmit')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $pmkissan = DB::table('pmkissan')
            ->where('status','Resubmit')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $birth_certificate = DB::table('birth_certificate')
            ->where('status','Resubmit')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $medicalscheme = DB::table('medicalscheme')
            ->where('status','Resubmit')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $dharsan = DB::table('dharsan')
            ->where('status','Resubmit')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $resub = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard + $tailor + $pmkissan + $birth_certificate + $medicalscheme + $dharsan;

            $service = DB::table('msme')
            ->where('status','Approved')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $itr = DB::table('itr')
            ->where('status','Approved')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $gst = DB::table('gst')
            ->where('status','Approved')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $tec_exam = DB::table('tec_exam')
            ->where('status','Approved')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $tnegaservices = DB::table('tnega_services')
            ->where('status','Approved')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $smartcard = DB::table('smartcard')
            ->where('status','Approved')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $aadhaarcard = DB::table('aadhaarcard')
            ->where('status','Approved')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $can_edit = DB::table('can_edit')
            ->where('status','Approved')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $bond = DB::table('bond')
            ->where('status','Approved')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $voterid = DB::table('voterid')
            ->where('status','Approved')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $fssai = DB::table('fssai')
            ->where('status','Approved')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $covid = DB::table('covid')
            ->where('status','Approved')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $nalavariyam = DB::table('nalavariyam')
            ->where('status','Approved')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $license = DB::table('license')
            ->where('status','Approved')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $pancard = DB::table('pancard')
            ->where('status','Approved')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $tailor = DB::table('tailor')
            ->where('status','Approved')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $pmkissan = DB::table('pmkissan')
            ->where('status','Approved')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $birth_certificate = DB::table('birth_certificate')
            ->where('status','Approved')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $medicalscheme = DB::table('medicalscheme')
            ->where('status','Approved')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $dharsan = DB::table('dharsan')
            ->where('status','Approved')
            ->where('distributor_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $approve = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard + $tailor + $pmkissan + $birth_certificate + $medicalscheme + $dharsan;



        }elseif(Auth::user()->user_type_id == 4){

                      $service = DB::table('msme')
            ->where('status','Pending')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $itr = DB::table('itr')
            ->where('status','Pending')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $gst = DB::table('gst')
            ->where('status','Pending')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $tec_exam = DB::table('tec_exam')
            ->where('status','Pending')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $tnegaservices = DB::table('tnega_services')
            ->where('status','Pending')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $smartcard = DB::table('smartcard')
            ->where('status','Pending')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $aadhaarcard = DB::table('aadhaarcard')
            ->where('status','Pending')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $can_edit = DB::table('can_edit')
            ->where('status','Pending')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $bond = DB::table('bond')
            ->where('status','Pending')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $voterid = DB::table('voterid')
            ->where('status','Pending')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $fssai = DB::table('fssai')
            ->where('status','Pending')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $covid = DB::table('covid')
            ->where('status','Pending')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $nalavariyam = DB::table('nalavariyam')
            ->where('status','Pending')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $license = DB::table('license')
            ->where('status','Pending')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $pancard = DB::table('pancard')
            ->where('status','Pending')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $tailor = DB::table('tailor')
            ->where('status','Pending')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $pmkissan = DB::table('pmkissan')
            ->where('status','Pending')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $birth_certificate = DB::table('birth_certificate')
            ->where('status','Pending')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $medicalscheme = DB::table('medicalscheme')
            ->where('status','Pending')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $dharsan = DB::table('dharsan')
            ->where('status','Pending')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $pending = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard  + $tailor + $pmkissan + $birth_certificate + $medicalscheme + $dharsan;

            $service = DB::table('msme')
            ->where('status','Processing')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $itr = DB::table('itr')
            ->where('status','Processing')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $gst = DB::table('gst')
            ->where('status','Processing')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $tec_exam = DB::table('tec_exam')
            ->where('status','Processing')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $tnegaservices = DB::table('tnega_services')
            ->where('status','Processing')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $smartcard = DB::table('smartcard')
            ->where('status','Processing')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $aadhaarcard = DB::table('aadhaarcard')
            ->where('status','Processing')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $can_edit = DB::table('can_edit')
            ->where('status','Processing')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $bond = DB::table('bond')
            ->where('status','Processing')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $voterid = DB::table('voterid')
            ->where('status','Processing')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $fssai = DB::table('fssai')
            ->where('status','Processing')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $covid = DB::table('covid')
            ->where('status','Processing')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $nalavariyam = DB::table('nalavariyam')
            ->where('status','Processing')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $license = DB::table('license')
            ->where('status','Processing')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $pancard = DB::table('pancard')
            ->where('status','Processing')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $tailor = DB::table('tailor')
            ->where('status','Processing')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $pmkissan = DB::table('pmkissan')
            ->where('status','Processing')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $birth_certificate = DB::table('birth_certificate')
            ->where('status','Processing')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $medicalscheme = DB::table('medicalscheme')
            ->where('status','Processing')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $dharsan = DB::table('dharsan')
            ->where('status','Processing')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $inpro = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard  + $tailor + $pmkissan + $birth_certificate + $medicalscheme + $dharsan;

            $service = DB::table('msme')
            ->where('status','Resubmit')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $itr = DB::table('itr')
            ->where('status','Resubmit')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $gst = DB::table('gst')
            ->where('status','Resubmit')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $tec_exam = DB::table('tec_exam')
            ->where('status','Resubmit')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $tnegaservices = DB::table('tnega_services')
            ->where('status','Resubmit')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $smartcard = DB::table('smartcard')
            ->where('status','Resubmit')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $aadhaarcard = DB::table('aadhaarcard')
            ->where('status','Resubmit')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $can_edit = DB::table('can_edit')
            ->where('status','Resubmit')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $bond = DB::table('bond')
            ->where('status','Resubmit')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $voterid = DB::table('voterid')
            ->where('status','Resubmit')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $fssai = DB::table('fssai')
            ->where('status','Resubmit')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $covid = DB::table('covid')
            ->where('status','Resubmit')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $nalavariyam = DB::table('nalavariyam')
            ->where('status','Resubmit')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $license = DB::table('license')
            ->where('status','Resubmit')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $pancard = DB::table('pancard')
            ->where('status','Resubmit')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $tailor = DB::table('tailor')
            ->where('status','Resubmit')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $pmkissan = DB::table('pmkissan')
            ->where('status','Resubmit')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $birth_certificate = DB::table('birth_certificate')
            ->where('status','Resubmit')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $medicalscheme = DB::table('medicalscheme')
            ->where('status','Resubmit')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $dharsan = DB::table('dharsan')
            ->where('status','Resubmit')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $resub = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard  + $tailor + $pmkissan + $birth_certificate + $medicalscheme + $dharsan;

            $service = DB::table('msme')
            ->where('status','Approved')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $itr = DB::table('itr')
            ->where('status','Approved')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $gst = DB::table('gst')
            ->where('status','Approved')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $tec_exam = DB::table('tec_exam')
            ->where('status','Approved')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $tnegaservices = DB::table('tnega_services')
            ->where('status','Approved')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $smartcard = DB::table('smartcard')
            ->where('status','Approved')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $aadhaarcard = DB::table('aadhaarcard')
            ->where('status','Approved')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $can_edit = DB::table('can_edit')
            ->where('status','Approved')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $bond = DB::table('bond')
            ->where('status','Approved')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $voterid = DB::table('voterid')
            ->where('status','Approved')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $fssai = DB::table('fssai')
            ->where('status','Approved')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $covid = DB::table('covid')
            ->where('status','Approved')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $nalavariyam = DB::table('nalavariyam')
            ->where('status','Approved')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $license = DB::table('license')
            ->where('status','Approved')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $pancard = DB::table('pancard')
            ->where('status','Approved')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $tailor = DB::table('tailor')
            ->where('status','Approved')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $pmkissan = DB::table('pmkissan')
            ->where('status','Approved')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $birth_certificate = DB::table('birth_certificate')
            ->where('status','Approved')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $medicalscheme = DB::table('medicalscheme')
            ->where('status','Approved')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $dharsan = DB::table('dharsan')
            ->where('status','Approved')
            ->where('retailer_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $approve = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard + $tailor + $pmkissan + $birth_certificate + $medicalscheme + $dharsan;



        }elseif(Auth::user()->user_type_id == 5){

                     $service = DB::table('msme')
            ->where('status','Pending')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $itr = DB::table('itr')
            ->where('status','Pending')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $gst = DB::table('gst')
            ->where('status','Pending')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $tec_exam = DB::table('tec_exam')
            ->where('status','Pending')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $tnegaservices = DB::table('tnega_services')
            ->where('status','Pending')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $smartcard = DB::table('smartcard')
            ->where('status','Pending')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $aadhaarcard = DB::table('aadhaarcard')
            ->where('status','Pending')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $can_edit = DB::table('can_edit')
            ->where('status','Pending')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $bond = DB::table('bond')
            ->where('status','Pending')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $voterid = DB::table('voterid')
            ->where('status','Pending')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $fssai = DB::table('fssai')
            ->where('status','Pending')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $covid = DB::table('covid')
            ->where('status','Pending')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $nalavariyam = DB::table('nalavariyam')
            ->where('status','Pending')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $license = DB::table('license')
            ->where('status','Pending')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $pancard = DB::table('pancard')
            ->where('status','Pending')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $tailor = DB::table('tailor')
            ->where('status','Pending')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $pmkissan = DB::table('pmkissan')
            ->where('status','Pending')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $birth_certificate = DB::table('birth_certificate')
            ->where('status','Pending')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $medicalscheme = DB::table('medicalscheme')
            ->where('status','Pending')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $dharsan = DB::table('dharsan')
            ->where('status','Pending')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $pending = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard;

            $service = DB::table('msme')
            ->where('status','Processing')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $itr = DB::table('itr')
            ->where('status','Processing')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $gst = DB::table('gst')
            ->where('status','Processing')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $tec_exam = DB::table('tec_exam')
            ->where('status','Processing')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $tnegaservices = DB::table('tnega_services')
            ->where('status','Processing')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $smartcard = DB::table('smartcard')
            ->where('status','Processing')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $aadhaarcard = DB::table('aadhaarcard')
            ->where('status','Processing')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $can_edit = DB::table('can_edit')
            ->where('status','Processing')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $bond = DB::table('bond')
            ->where('status','Processing')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $voterid = DB::table('voterid')
            ->where('status','Processing')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $fssai = DB::table('fssai')
            ->where('status','Processing')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $covid = DB::table('covid')
            ->where('status','Processing')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $nalavariyam = DB::table('nalavariyam')
            ->where('status','Processing')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $license = DB::table('license')
            ->where('status','Processing')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $pancard = DB::table('pancard')
            ->where('status','Processing')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $tailor = DB::table('tailor')
            ->where('status','Processing')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $pmkissan = DB::table('pmkissan')
            ->where('status','Processing')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $birth_certificate = DB::table('birth_certificate')
            ->where('status','Processing')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $medicalscheme = DB::table('medicalscheme')
            ->where('status','Processing')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $dharsan = DB::table('dharsan')
            ->where('status','Processing')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $inpro = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard + $tailor + $pmkissan + $birth_certificate + $medicalscheme + $dharsan;

            $service = DB::table('msme')
            ->where('status','Resubmit')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $itr = DB::table('itr')
            ->where('status','Resubmit')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $gst = DB::table('gst')
            ->where('status','Resubmit')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $tec_exam = DB::table('tec_exam')
            ->where('status','Resubmit')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $tnegaservices = DB::table('tnega_services')
            ->where('status','Resubmit')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $smartcard = DB::table('smartcard')
            ->where('status','Resubmit')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $aadhaarcard = DB::table('aadhaarcard')
            ->where('status','Resubmit')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $can_edit = DB::table('can_edit')
            ->where('status','Resubmit')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $bond = DB::table('bond')
            ->where('status','Resubmit')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $voterid = DB::table('voterid')
            ->where('status','Resubmit')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $fssai = DB::table('fssai')
            ->where('status','Resubmit')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $covid = DB::table('covid')
            ->where('status','Resubmit')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $nalavariyam = DB::table('nalavariyam')
            ->where('status','Resubmit')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $license = DB::table('license')
            ->where('status','Resubmit')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $pancard = DB::table('pancard')
            ->where('status','Resubmit')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $tailor = DB::table('tailor')
            ->where('status','Resubmit')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $pmkissan = DB::table('pmkissan')
            ->where('status','Resubmit')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $birth_certificate = DB::table('birth_certificate')
            ->where('status','Resubmit')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $medicalscheme = DB::table('medicalscheme')
            ->where('status','Resubmit')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $dharsan = DB::table('dharsan')
            ->where('status','Resubmit')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $resub = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard + $tailor + $pmkissan + $birth_certificate + $medicalscheme + $dharsan;

            $service = DB::table('msme')
            ->where('status','Approved')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $itr = DB::table('itr')
            ->where('status','Approved')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $gst = DB::table('gst')
            ->where('status','Approved')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $tec_exam = DB::table('tec_exam')
            ->where('status','Approved')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $tnegaservices = DB::table('tnega_services')
            ->where('status','Approved')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $smartcard = DB::table('smartcard')
            ->where('status','Approved')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $aadhaarcard = DB::table('aadhaarcard')
            ->where('status','Approved')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $can_edit = DB::table('can_edit')
            ->where('status','Approved')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $bond = DB::table('bond')
            ->where('status','Approved')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $voterid = DB::table('voterid')
            ->where('status','Approved')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $fssai = DB::table('fssai')
            ->where('status','Approved')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $covid = DB::table('covid')
            ->where('status','Approved')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $nalavariyam = DB::table('nalavariyam')
            ->where('status','Approved')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $license = DB::table('license')
            ->where('status','Approved')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $pancard = DB::table('pancard')
            ->where('status','Approved')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $tailor = DB::table('tailor')
            ->where('status','Approved')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $pmkissan = DB::table('pmkissan')
            ->where('status','Approved')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $birth_certificate = DB::table('birth_certificate')
            ->where('status','Approved')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $medicalscheme = DB::table('medicalscheme')
            ->where('status','Approved')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $dharsan = DB::table('dharsan')
            ->where('status','Approved')
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'Desc')->count();

            $approve = $service + $itr + $gst + $tec_exam + $tnegaservices + $smartcard + $aadhaarcard + $can_edit + $bond + $voterid + $fssai + $covid + $nalavariyam + $license + $pancard  + $tailor + $pmkissan + $birth_certificate + $medicalscheme + $dharsan;


        }

            return view('dashboard',compact('servicecount','customercount','enquiry_count','retailer','distributor','retailer_count','distributor_count','customer','pending','inpro','resub','approve','service','RequestAmount','activation','allservice','ramjirequestAmount'));
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }
}
