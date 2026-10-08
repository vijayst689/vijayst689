<?php

namespace App\Http\Controllers;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class BannerController extends Controller
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
 
public function bannerservices($serviceid) {
    $districts = DB::table( 'district' )->get();
    $getservicename = DB::table( 'services' )->where('id',$serviceid)->first();
    $servicename = "";
    $amount = 0;
    $banner = 0;
    if($getservicename){
     $servicename = $getservicename->service_name;
     $amount = $getservicename->amount;
     $banner = $getservicename->banner;
 }
 $getservice_payment = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
 $payment = 0;

 if($getservice_payment){
     if(Auth::user()->user_type_id == 3){
         $payment = $getservice_payment->distributor_amount;
     }elseif(Auth::user()->user_type_id == 4){
         $payment = $getservice_payment->retailer_amount;
     }elseif(Auth::user()->user_type_id == 5){
         $payment = $getservice_payment->customer_amount;
     }
 }
 if($payment == ""){
     $payment = 0;
 }
 $customers = DB::table( 'users' )->orderBy('id', 'Asc')->first();
 $mainbalance = DB::table( 'users' )->select('rawallet')->where('id',2)->first();

  if($serviceid == 32 || $serviceid == 204 || $serviceid == 205 ){    
    return view( 'banner.bannerservice',compact('serviceid','districts','servicename','amount','payment','customers','banner'));
}

}

public function submitapply_banner(Request $request){

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
    
    DB::table( 'banner' )->insert( [
        //dd($banner);
       'user_id'      => $user_id,
       'retailer_id'  => $retailer_id,
       'distributor_id'  => $distributor_id,
       'service_id'   => $request ->serviceid,
       'amount'       => $request->amount,
       'organization_name'         => $request->organization_name,
       'mobile'       => $request->mobile,
       'content'       => $request->content,
       'status'       => 'Pending',
       'applied_date' => date("Y-m-d"),
       'created_at'   => date("Y-m-d"),
   ] );

   $insertid = DB::getPdo()->lastInsertId();

       $model_image = "";
       if ($request->model_image != null) {
           $model_image = uniqid().'.'.$request->file('model_image')->extension();
           $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'banner' . DIRECTORY_SEPARATOR. 'model_image' . DIRECTORY_SEPARATOR);
           move_uploaded_file($_FILES['model_image']['tmp_name'], $filepath . $model_image);
       }
  
    $servicepayment = $request->service_amount;
    if(Auth::user()->user_type_id == 3){
        $user_id = $distributor_id;
    }elseif(Auth::user()->user_type_id == 4){
        $user_id = $retailer_id;
    }elseif(Auth::user()->user_type_id == 5){
        $user_id = $user_id;
    }
    $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
    $servicename = "";
    if($getservicename){
        $servicename = $getservicename->service_name;
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

    return redirect("appliedservice/Pending")->With("success","Application submitted Succesfully");

}

}
