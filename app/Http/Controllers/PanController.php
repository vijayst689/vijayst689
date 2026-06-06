<?php

namespace App\Http\Controllers;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PanController extends Controller
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


  public function addpan(){
    return view( 'pancard.addpan');
  }

  public function viewpan(){
    $viewpan = DB::table( 'panservice' )->orderBy( 'id', 'Asc' )->get();
    return view( 'pancard.viewpan' ,compact('viewpan'));
  }

  public function savepan( Request $request ) {
    DB::table( 'panservice' )->insert( [
      'name'       => $request->name,
      'amount'     => $request->amount,
      'ramjiservice_id'     => $request->ramjiservice_id,
      'date'       => date("Y-m-d H:i:s"),
      'status'     => 'Active',
    ] );

    $insertid = DB::getPdo()->lastInsertId();

    $ser_image = '';
    if ( $request->ser_image != null ) {
      $ser_image = $insertid.'.'.$request->file( 'ser_image' )->extension();
      $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'panservice' . DIRECTORY_SEPARATOR );
      move_uploaded_file( $_FILES[ 'ser_image' ][ 'tmp_name' ], $filepath . $ser_image );
    }
    $image = DB::table( 'panservice' )->where( 'id', $insertid )->update( [
      'ser_image' => $ser_image,
    ] );
    return redirect('/viewpan')->with('success', 'AddPan Service Added Successfully ... !');
  }

  public function updatepan( Request $request ) {
    DB::table( 'panservice' )->where('id', $request->panid)->update( [
      'name'     => $request->name,
      'amount'   => $request->amount,
      'ramjiservice_id'   => $request->ramjiservice_id,
    ] );

    if ( $request->ser_image != null ) {
      $ser_image = $request->panid.'.'.$request->file( 'ser_image' )->extension();
      $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'panservice' . DIRECTORY_SEPARATOR );
      move_uploaded_file( $_FILES[ 'ser_image' ][ 'tmp_name' ], $filepath . $ser_image );
      $image = DB::table( 'panservice' )->where( 'id', $request->panid )->update( [
        'ser_image' => $ser_image,
      ] );
    }

    return redirect()->back()->with( 'success', 'Pan Service Updated Successfully' );
  }

  public function updatestatuspan( Request $request ) {
    DB::table( 'panservice' )->where('id', $request->pan_id)->update( [
      'status'     => $request->status,
    ] );

    return redirect()->back()->with( 'success', 'Utility Status Updated Successfully' );
  }

  public function panservices(){
  $usertype = Auth::user()->user_type_id;
 $userPermission = DB::table('user_permission')
    ->where('user_id', Auth::user()->id)
    ->where('parent_id', 4)
    ->pluck('service_id');

$adminPermission = DB::table('user_permission')
    ->where('user_id', 2) 
    ->where('parent_id', 4)
    ->pluck('service_id');

$finalServiceIds = $userPermission->intersect($adminPermission);
   if(Auth::user()->user_type_id == 1 || Auth::user()->user_type_id == 5){
      $service = DB::table( 'panservice' )->where('status' , 'Active')->orderBy( 'id', 'ASC' )->get();
    }else{
      $service = DB::table( 'panservice' )->where('status' , 'Active')->whereIn('id',$finalServiceIds)->orderBy( 'id', 'ASC' )->get();
    }
    
    $service = json_decode( json_encode( $service ), true );
    foreach ( $service as $key => $s ) {

      $serviceid = $s['id'];
      $getservice_payment = DB::table( 'panpayment' )->where('service_id',$serviceid)->first();
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
    return view( 'pancard.panservices',compact('service'));
  }

  public function applypanservice($serviceid) {
    $userPermission = DB::table('user_permission')
    ->where('user_id', Auth::user()->id)
    ->where('parent_id', 4)
    ->pluck('service_id');

$adminPermission = DB::table('user_permission')
    ->where('user_id', 2) 
    ->where('parent_id', 4)
    ->pluck('service_id');

$finalServiceIds = $userPermission->intersect($adminPermission);
 if (!$finalServiceIds->contains($serviceid)) {
        return view('errors.no_permission'); 
    }
    $getservicename = DB::table( 'panservice' )->where('id',$serviceid)->first();
    $servicename = "";
    $amount = 0;
    if($getservicename){
      $servicename = $getservicename->name;
      $amount = $getservicename->amount;
    }
    $getservice_payment = DB::table( 'panpayment' )->where('service_id',$serviceid)->first();
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
    if($serviceid == 1){
      $pandetails = DB::table( 'pancard' )->where('user_id',Auth::user()->id)->where('service_id',$serviceid)->orderBy( 'id', 'Desc' )->get();
      return view( 'panservice.newpancard',compact('serviceid','servicename','payment','mainbalance','pandetails','amount'));
    }elseif($serviceid == 2){
      $pandetails = DB::table( 'pancard' )->where('user_id',Auth::user()->id)->where('service_id',$serviceid)->orderBy( 'id', 'Desc' )->get();
      return view( 'panservice.pancorrection',compact('serviceid','servicename','payment','mainbalance','pandetails','amount'));
    }
  }

  public function submitnewpancard( Request $request ) {
    // dd($request->all());
        $user_id = Auth::user()->id;
         $serviceid = $request->serviceid;
         $servicepayment = 0;
        $getservicepayment = DB::table('panpayment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {
            
            if (Auth::user()->user_type_id == 2) {
               $payment = $amount;
            } elseif (Auth::user()->user_type_id == 3) {
                $servicepayment = $getservicepayment->distributor_amount;
            } elseif (Auth::user()->user_type_id == 4) {
                $servicepayment = $getservicepayment->retailer_amount;
            } elseif (Auth::user()->user_type_id == 5) {
                $servicepayment = $getservicepayment->service_amount;
            }
        }
        if(Auth::user()->wallet < $servicepayment){
            return redirect()->back()->with('error', 'Insufficient wallet balance. Please recharge your wallet to proceed.');
        }
        $mobile = $request->mobile;
        $mode = $request->mode;
        $orderid = rand(000000000,999999999);
       $panurl =  "https://connect.inspay.in/v4/nsdl/new_pan?username=IP7598984380&token=836a596851ed939b19a4b71157c47e1d&number=$mobile&mode=$mode&orderid=$orderid";
    //echo $panurl;die;
    $crl = curl_init();
    curl_setopt( $crl, CURLOPT_URL, $panurl );
    curl_setopt( $crl, CURLOPT_FRESH_CONNECT, true );
    curl_setopt( $crl, CURLOPT_RETURNTRANSFER, true );
    $result = curl_exec($crl);
    $result = json_decode($result);
    //echo "<pre>"; print_r($result);echo "</pre>";die;
    $status = $result->status;
    $url = "";
    $message = "";
if ($status == "Success") {

    $url      = $result->url ?? '';
    $orderid  = $result->orderid ?? '';
    $message  = $result->message ?? '';

} else {

    $orderid  = $result->orderid ?? '';
    $message  = $result->message ?? '';

}
    curl_close($crl);

    DB::table( 'pancard' )->insert( [

       'user_id'      => $user_id,
       'service_id'   => $request->serviceid,
       'amount'       => $request->servicepayment,
       'name'         => $request->name,
       'mode'         => $request->mode,
       'aadhaar_no'   => $request->aadhaar_no,
       'mobile'       => $request->mobile,
       'status'       => 'Pending',
       'applied_date' => date("Y-m-d"),
       'created_at'   => date("Y-m-d"),
   ] );

         $insertid = DB::getPdo()->lastInsertId();


        if($status == "Success"){

      DB::table('pancard')->where('id', $insertid)->update([
        'api_url' => $url,
        'api_status' => $status,
        'api_txid' => $orderid,
        'message' => $message,
        'status' => 'Processing'
      ]);

          $amount = $request->amount;
          $servicepayment = $request->servicepayment;
          $date = date( 'Y-m-d' );
        $time = date( 'H:i:s' );
        $service_status = 'Out Payment';
        $ad_info = 'Ramji Wallet Debit(PanCard)';
        $getrawallet = DB::table( 'users' )->select('rawallet')->where('id',1)->first();
          $rawallet = 0;
          if($getrawallet){
            $balance1 = $getrawallet->rawallet;
          }

          $getrawallet1 = DB::table( 'users' )->select('rawallet')->where('id',2)->first();
          $rawallet1 = 0;
          if($getrawallet1){
            $balance2 = $getrawallet1->rawallet;
          }
          $newbalance2 = $balance1 + $amount;
          $newbalance3 = $balance2 - $amount;
        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$amount','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set rawallet = rawallet + $amount where id = 1";
        DB::update( DB::raw( $sql ) );
        $service_status = 'IN Payment';
        $ad_info = 'Ramji Wallet Credit(PanCard)';

        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$amount','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set rawallet = rawallet - $amount where id = 2";
        DB::update( DB::raw( $sql ) );

        if(Auth::user()->user_type_id != 2){
          $getservicename = DB::table( 'panservice' )->select('name')->where('id',$serviceid)->first();
          $servicename = "";
          if($getservicename){
            $servicename = $getservicename->name;
          }
          $date = date( 'Y-m-d' );
          $time = date( 'H:i:s' );
          $service_status = 'Out Payment';
          $ad_info = 'Pan Card Payment'. ' '. $servicename;

          $getwallet = DB::table( 'users' )->select('wallet')->where('id',2)->first();
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

         }

         // API CALL
         $API_KEY = env( 'API_KEY', '' );
         $RAMJIPAY_URL = env( 'RAMJIPAY_URL', '' );
         $WEBSITE_INDEX = env( 'WEBSITE_INDEX', '' );
         $ch = curl_init();
         $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&api_url=$url&api_txn=$orderid&api_status=$status&message=$message";
         $url1 = $RAMJIPAY_URL.'/api/get_pandata';

         curl_setopt( $ch, CURLOPT_URL, $url1 );
         curl_setopt( $ch, CURLOPT_POST, 1 );
         curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_data );
         curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
         $server_output = curl_exec( $ch );
         curl_close( $ch );
         $resdata = json_decode($server_output, true);

         return redirect($url)->With("success",$message);

        }else{
            
           DB::table('pancard')->where('id', $insertid)->update([
            'message' => $message,
            'status' => 'Failure',
            'amount' => 0,
            'api_txid' => $orderid,
          ]);
          $API_KEY = env( 'API_KEY', '' );
          $RAMJIPAY_URL = env( 'RAMJIPAY_URL', '' );
          $WEBSITE_INDEX = env( 'WEBSITE_INDEX', '' );
          $ch = curl_init();
          $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&api_url=$url&api_txn=$orderid&api_status=$status&message=$message";
          $url1 = $RAMJIPAY_URL.'/api/get_pandata';
 
          curl_setopt( $ch, CURLOPT_URL, $url1 );
          curl_setopt( $ch, CURLOPT_POST, 1 );
          curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_data );
          curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
          $server_output = curl_exec( $ch );
          curl_close( $ch );
          $resdata = json_decode($server_output, true);

           return redirect('applypanservice/'.$serviceid)->With("error",$message);
        }

  }

    public function submitpancorrection( Request $request ) {
        $user_id = Auth::user()->id;
         $serviceid = $request->serviceid;
         $servicepayment = 0;
        $getservicepayment = DB::table('panpayment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {
            
            if (Auth::user()->user_type_id == 2) {
               $payment = $amount;
            } elseif (Auth::user()->user_type_id == 3) {
                $servicepayment = $getservicepayment->distributor_amount;
            } elseif (Auth::user()->user_type_id == 4) {
                $servicepayment = $getservicepayment->retailer_amount;
            } elseif (Auth::user()->user_type_id == 5) {
                $servicepayment = $getservicepayment->service_amount;
            }
        }
        if(Auth::user()->wallet < $servicepayment){
            return redirect()->back()->with('error', 'Insufficient wallet balance. Please recharge your wallet to proceed.');
        }
        $mobile = $request->mobile;
        $mode = $request->mode;
        $orderid = rand(000000000,999999999);
        $panurl =  "https://connect.inspay.in/v4/nsdl/correction?username=IP7598984380&token=836a596851ed939b19a4b71157c47e1d&number=$mobile&mode=$mode&orderid=$orderid";
        $crl = curl_init();
        curl_setopt( $crl, CURLOPT_URL, $panurl );
        curl_setopt( $crl, CURLOPT_FRESH_CONNECT, true );
        curl_setopt( $crl, CURLOPT_RETURNTRANSFER, true );
        $result = curl_exec($crl);
        $result = json_decode($result);
        //echo "<pre>"; print_r($result);echo "</pre>";die;
        $status = $result->status;
        $url = "";
        $message = "";
        if ($status == "Success") {

    $url      = $result->url ?? '';
    $orderid  = $result->orderid ?? '';
    $message  = $result->message ?? '';

} else {

    $orderid  = $result->orderid ?? '';
    $message  = $result->message ?? '';

}
        // if($status == "Success"){
        //     $url = $result->url;
        //     $orderid = $result->orderid;
        //     $message = $result->message;
        // }else{
        //     $orderid = $result->orderid;
        //     $message = $result->message;
        // }
        curl_close($crl);

        DB::table( 'pancard' )->insert( [

           'user_id'      => $user_id,
           'service_id'   => $request->serviceid,
           'amount'       => $request->servicepayment,
           'name'         => $request->name,
           'mode'         => $request->mode,
           'aadhaar_no'   => $request->aadhaar_no,
           'mobile'       => $request->mobile,
           'status'       => 'Pending',
           'applied_date' => date("Y-m-d"),
           'created_at'   => date("Y-m-d"),
       ] );

         $insertid = DB::getPdo()->lastInsertId();


        if($status == "Success"){

          DB::table('pancard')->where('id', $insertid)->update([
            'api_url' => $url,
            'api_status' => $status,
            'api_txid' => $orderid,
            'message' => $message,
            'status' => 'Processing'
          ]);
          $amount = $request->amount;
          $servicepayment = $request->servicepayment;
          $date = date( 'Y-m-d' );
        $time = date( 'H:i:s' );
        $service_status = 'Out Payment';
        $ad_info = 'Ramji Wallet Debit(PanCard)';
        $getrawallet = DB::table( 'users' )->select('rawallet')->where('id',1)->first();
          $rawallet = 0;
          if($getrawallet){
            $balance1 = $getrawallet->rawallet;
          }

          $getrawallet1 = DB::table( 'users' )->select('rawallet')->where('id',2)->first();
          $rawallet1 = 0;
          if($getrawallet1){
            $balance2 = $getrawallet1->rawallet;
          }
          $newbalance2 = $balance1 + $amount;
          $newbalance3 = $balance2 - $amount;
        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$amount','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set rawallet = rawallet + $amount where id = 1";
        DB::update( DB::raw( $sql ) );
        $service_status = 'IN Payment';
        $ad_info = 'Ramji Wallet Credit(PanCard)';

        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$amount','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set rawallet = rawallet - $amount where id = 2";
        DB::update( DB::raw( $sql ) );

        if(Auth::user()->user_type_id != 2){
          $getservicename = DB::table( 'panservice' )->select('name')->where('id',$serviceid)->first();
          $servicename = "";
          if($getservicename){
            $servicename = $getservicename->name;
          }
          $date = date( 'Y-m-d' );
          $time = date( 'H:i:s' );
          $service_status = 'Out Payment';
          $ad_info = 'Pan Card Payment'. ' '. $servicename;

          $getwallet = DB::table( 'users' )->select('wallet')->where('id',2)->first();
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

         }

         // API CALL
         $API_KEY = env( 'API_KEY', '' );
         $RAMJIPAY_URL = env( 'RAMJIPAY_URL', '' );
         $WEBSITE_INDEX = env( 'WEBSITE_INDEX', '' );
         $ch = curl_init();
         $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&api_url=$url&api_txn=$orderid&api_status=$status&message=$message";
         $url1 = $RAMJIPAY_URL.'/api/get_pandata';

         curl_setopt( $ch, CURLOPT_URL, $url1 );
         curl_setopt( $ch, CURLOPT_POST, 1 );
         curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_data );
         curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
         $server_output = curl_exec( $ch );
         curl_close( $ch );
         $resdata = json_decode($server_output, true);


           return redirect($url)->With("success",$message);
        }else{
           DB::table('pancard')->where('id', $insertid)->update([
            'message' => $message,
            'status' => 'Failure',
            'amount' => 0,
            'api_txid' => $orderid,
          ]);
           return redirect('applypanservice/'.$serviceid)->With("error",$message);
        }

  }

  public function pancard_reapply($txid,$serviceid){

    $panurl =  "https://connect.inspay.in/v4/nsdl/incomplete?username=IP7598984380&token=836a596851ed939b19a4b71157c47e1d&orderid=$txid";
    $crl = curl_init();
    curl_setopt( $crl, CURLOPT_URL, $panurl );
    curl_setopt( $crl, CURLOPT_FRESH_CONNECT, true );
    curl_setopt( $crl, CURLOPT_RETURNTRANSFER, true );
    $result = curl_exec($crl);
    $result = json_decode($result);
        //echo "<pre>"; print_r($result);echo "</pre>";die;
    $status = $result->status;
    $url = "";
    $message = "";
    if($status == "Success"){
        $url = $result->url;
        $orderid = $result->txid;
        $message = $result->message;
    }else{
        $orderid = $result->orderid;
        $message = $result->message;
    }
    curl_close($crl);
    if($status == "Success"){
           return redirect($url)->With("success",$message);
    }else{
     return redirect('applypanservice/'.$serviceid)->With("error",$message);
}
}


}
