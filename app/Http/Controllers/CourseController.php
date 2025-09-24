<?php

namespace App\Http\Controllers;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
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


  public function addcourse(){
    return view( 'course.addcourse');
  }

  public function viewcourse(){
    $viewcourse = DB::table( 'courses' )->where('status', 'Active')->orderBy( 'id', 'Asc' )->get();
    return view( 'course.viewcourse' ,compact('viewcourse'));
  }

  public function savecourse( Request $request ) {
    DB::table( 'courses' )->insert( [
      'name'       => $request->name,
      'date'       => date("Y-m-d H:i:s"),
      'status'     => 'Active',
    ] );

    $insertid = DB::getPdo()->lastInsertId();

    $ser_image = '';
    if ( $request->ser_image != null ) {
      $ser_image = $insertid.'.'.$request->file( 'ser_image' )->extension();
      $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'course_image' . DIRECTORY_SEPARATOR );
      move_uploaded_file( $_FILES[ 'ser_image' ][ 'tmp_name' ], $filepath . $ser_image );
    }
    $image = DB::table( 'courses' )->where( 'id', $insertid )->update( [
      'ser_image' => $ser_image,
    ] );
    return redirect('/viewcourse')->with('success', 'AddCourse Service Added Successfully ... !');
  }

  public function updatecourse( Request $request ) {
    DB::table( 'courses' )->where('id', $request->corid)->update( [
      'name'     => $request->name,
    ] );

    if ( $request->ser_image != null ) {
      $ser_image = $request->corid.'.'.$request->file( 'ser_image' )->extension();
      $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'course_image' . DIRECTORY_SEPARATOR );
      move_uploaded_file( $_FILES[ 'ser_image' ][ 'tmp_name' ], $filepath . $ser_image );
      $image = DB::table( 'courses' )->where( 'id', $request->corid )->update( [
        'ser_image' => $ser_image,
      ] );
    }

    return redirect()->back()->with( 'success', 'Course Service Updated Successfully' );
  }

  public function updatestatuspan( Request $request ) {
    DB::table( 'courses' )->where('id', $request->pan_id)->update( [
      'status'     => $request->status,
    ] );

    return redirect()->back()->with( 'success', 'Utility Status Updated Successfully' );
  }

  public function courses(){
    $usertype = Auth::user()->user_type_id;
    $service = DB::table( 'courses' )->where('status' , 'Active')->orderBy( 'id', 'ASC' )->get();
    $service = json_decode( json_encode( $service ), true );
    foreach ( $service as $key => $s ) {

      $serviceid = $s['id'];
      $getservice_payment = DB::table( 'coursepayment' )->where('service_id',$serviceid)->first();
      $payment = 0;

      if($getservice_payment){
        if($usertype == 2){
          $payment = $s['amount'];
        }elseif($usertype == 3){
          $payment = $getservice_payment->distributor_amount;
        }elseif($usertype == 4){
          $payment = $getservice_payment->retailer_amount;
        }elseif($usertype == 5){
          $payment = $getservice_payment->customer_amount;
        }
      }else{
        if($usertype == 2){
          $payment = $s['amount'];
        }
      }

      if($payment == ""){
        $payment = 0;
      }
      $service[ $key ][ 'payment' ] = $payment;
    }
    $service = json_decode( json_encode( $service ));
    return view( 'course.courses',compact('service'));
  }

  public function applycourseservice($serviceid) {
    $getservicename = DB::table( 'courses' )->where('id',$serviceid)->first();
    $servicename = "";
    $amount = 0;
    if($getservicename){
      $servicename = $getservicename->name;
      $amount = $getservicename->amount;
    }
    $getservice_payment = DB::table( 'coursepayment' )->where('service_id',$serviceid)->first();
    $payment = 0;

    if($getservice_payment){
      if(Auth::user()->user_type_id == 2){
        $payment = $amount;
      }elseif(Auth::user()->user_type_id == 3){
        $payment = $getservice_payment->distributor_amount;
      }elseif(Auth::user()->user_type_id == 4){
        $payment = $getservice_payment->retailer_amount;
      }elseif(Auth::user()->user_type_id == 5){
        $payment = $getservice_payment->customer_amount;
      }
    }else{
      if(Auth::user()->user_type_id == 2){
        $payment = $amount;
      }
    }
    if($payment == ""){
      $payment = 0;
    }
    $mainbalance = DB::table( 'users' )->select('rawallet')->where('id',2)->first();
    $districts = DB::table( 'district' )->orderBy('id','Asc')->get();

    if($serviceid == 1 || $serviceid == 2 || $serviceid == 3 || $serviceid == 4 ){
      $tailoring = DB::table( 'tailor' )->where('user_id',Auth::user()->id)->where('service_id',$serviceid)->orderBy( 'id', 'Desc' )->get();
      return view( 'tailoring.tailoring_service',compact('serviceid','servicename','payment','mainbalance','tailoring','amount','districts'));
    }
  }

public function submitapply_tailorshop(Request $request){

    $user_id = 0;
    $retailer_id = 0;
    $distributor_id = 0;
    if(Auth::user()->user_type_id == 3){
        $user_id = $request ->user_id;
        $distributor_id = Auth::user()->id;
    }elseif(Auth::user()->user_type_id == 4){
        $user_id = $request ->user_id;
        $retailer_id = Auth::user()->id;
    } elseif(Auth::user()->user_type_id == 5){
        $user_id = Auth::user()->id;
    }
    $serviceid = $request ->serviceid;
    if($serviceid == 1 || $serviceid == 2 || $serviceid == 3 || $serviceid == 4 ){
        DB::table( 'tailor' )->insert( [
           'user_id'             => $user_id,
           'retailer_id'         => $retailer_id,
           'distributor_id'      => $distributor_id,
           'service_id'          => $request ->serviceid,
           'amount'              => $request->amount,
           'dist_id'             => $request->dist_id,
           'taluk_id'            => $request->taluk_id,
           'panchayath_id'       => $request->panchayath_id,
           'name'                => $request->name,
           'aadhaar_no'          => $request->aadhaar_no,
           'door_no'             => $request->door_no,
           'significant'         => $request->significant,
           'street_name'         => $request->street_name,
           'course_name'         => $request->course_name,
           'father_or_hus_name'  => $request->father_or_hus_name,
           'pincode'             => $request->pincode,
           'status'              => 'Pending',
           'applied_date'        => date("Y-m-d"),
           'created_at'          => date("Y-m-d"),
       ] );

        $insertid = DB::getPdo()->lastInsertId();
        $pan_card = "";
        $photo = "";
        $aadhaar_card = "";
        $signature = "";


        if ($request->photo != null) {
            $photo = uniqid().'.'.$request->file('photo')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);

        }
        DB::table('tailor')->where('id', $insertid)->update([
            'photo' => $photo,
        ]);

    }
    $getdetails = DB::table( 'tailor' )->where('id',$insertid)->first();
    if($getdetails){
        $full_name = $getdetails->name;
        $dist_id = $getdetails->dist_id;
        $taluk_id = $getdetails->taluk_id;
        $panchayath_id = $getdetails->panchayath_id;
        $aadhaar_no = $getdetails->aadhaar_no;
        $door_no = $getdetails->door_no;
        $significant = $getdetails->significant;
        $street_name = $getdetails->street_name;
        $course_name = $getdetails->course_name;
        $father_or_hus_name = $getdetails->father_or_hus_name;
        $pincode = $getdetails->pincode;
        $serviceid = $serviceid;
        $status = "Pending";
        $entity = "Tndigital";
        $url = url('/');
        $photo = $url.'/upload/services/photo/'.$getdetails->photo;

        $API_KEY = env( 'API_KEY', '' );
        $RAMJIPAY_URL = env('RAMJIPAY_URL', '');
        $ch = curl_init();
        $post_data = "key=$API_KEY&full_name=$full_name&dist_id=$dist_id&taluk_id=$taluk_id&panchayath_id=$panchayath_id&aadhaar_no=$aadhaar_no&door_no=$door_no&significant=$significant&street_name=$street_name&course_name=$course_name&father_or_hus_name=$father_or_hus_name&pincode=$pincode&status=$status&photo=$photo&entity=$entity&serviceid=$serviceid";
        $url = $RAMJIPAY_URL.'/api/applytailoring_certificate';

        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_POST, 1 );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_data );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $server_output = curl_exec( $ch );
        curl_close( $ch );
    }
    $servicepayment = $request->service_amount;
    if(Auth::user()->user_type_id == 3){
        $user_id = $distributor_id;
    }elseif(Auth::user()->user_type_id == 4){
        $user_id = $retailer_id;
    }elseif(Auth::user()->user_type_id == 5){
        $user_id = $user_id;
    }
    $getservicename = DB::table( 'courses' )->select('name')->where('id',$serviceid)->first();
    $servicename = "";
    if($getservicename){
        $servicename = $getservicename->name;
    }
    $date = date( 'Y-m-d' );
    $time = date( 'H:i:s' );
    $service_status = 'Out Payment';
    $ad_info = 'Service Payment'. ' '. $servicename;
    $getwallet = DB::table( 'users' )->select('wallet')->where('id',1)->first();
    $balance = 0;
    if($getwallet){
        $balance = $getwallet->wallet;
    }
    $newbalance = $balance + $servicepayment;
    $newbalance1 = Auth::user()->wallet - $servicepayment;

    $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
    DB::insert( DB::raw( $sql ) );
    $sql = "update users set wallet = wallet + $servicepayment where id = 2";
    DB::update( DB::raw( $sql ) );
    $service_status = 'IN Payment';
    $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
    DB::insert( DB::raw( $sql ) );
    $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
    DB::update( DB::raw( $sql ) );

    return redirect("tailorappliedservice/Pending")->With("success","Application submitted Succesfully");

}

}
