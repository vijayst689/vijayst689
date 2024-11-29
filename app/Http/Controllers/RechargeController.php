<?php

namespace App\Http\Controllers;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class RechargeController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

     public function utilityservices($serviceid)
  {
    if($serviceid == 187){
        $sql="select * from operator where service_type = 'Mobile Prepaid' order by name";
    }elseif($serviceid == 188){
        $sql="select * from operator where service_type = 'DTH' order by name";
    }
    $operator=DB::select($sql);
    $getservicename = DB::table( 'services' )->where('id',$serviceid)->first();
   $servicename = "";
   if($getservicename){
    $servicename = $getservicename->service_name;
}
    return view('recharge.rechargeservice',compact('serviceid','operator','servicename'));
  }

public function proceedrecharge(Request $request){

    $user_id = Auth::user()->id;
    $user_type_id = Auth::user()->user_type_id;
    $mobile = $request->mobile;
    $circle = $request->circle;
    $operator = $request->operator;
    $amount = $request->amount;
    $serviceid = $request->serviceid;
    $commission=0;
    $sql="select * from operator where code='$operator'";
    $result=DB::select($sql);
    if(count($result)>0){
        $commission=$result[0]->commission;
    }
    $commission_amount=$amount*$commission/100;

    $usertx = uniqid();
    $recharge_date = date("Y-m-d");
    $recharge_time = date("H:i");
    $plan_id = 0;
    $status="SUCCESS";
    $message="Success";
    $data=array();
    $url="https://business.a1topup.com/recharge/api?username=503025&pwd=231173&circlecode=$circle&operatorcode=$operator&number=$mobile&amount=$amount&orderid=$usertx&format=json";
    $crl = curl_init();
    curl_setopt( $crl, CURLOPT_URL, $url );
    curl_setopt( $crl, CURLOPT_FRESH_CONNECT, true );
    curl_setopt( $crl, CURLOPT_RETURNTRANSFER, true );
    $result = curl_exec($crl);
    $result = json_decode($result);
    $status = $result->status;
    $message = $result->opid;
    if(strtoupper($status) != "FAILURE"){
        $message="Recharge done successfully";
        $sql = "insert into recharge (mobile,circle,operator,amount,usertx,recharge_date,recharge_time,user_id,plan_id,commission_amount) values ('$mobile','$circle','$operator','$amount','$usertx','$recharge_date','$recharge_time','$user_id','$plan_id','$commission_amount')";
        DB::insert($sql);
        $insert_id = DB::getPdo()->lastInsertId();
       $newamount = $amount - $commission_amount;

    $date = date( 'Y-m-d' );
    $time = date( 'H:i:s' );
    $service_status = 'Out Payment';
    $ad_info = 'Recharge Out Payment';
    $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('$user_id','$user_id','1','$newamount','$ad_info', '$service_status','$time','$date','$user_id')";
    DB::insert( DB::raw( $sql ) );
    $sql = "update users set wallet = wallet + $newamount where id = 1";
    DB::update( DB::raw( $sql ) );
    $service_status = 'IN Payment';
    $ad_info = 'Recharge In Payment';
    $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('$user_id','1','$user_id','$newamount','$ad_info', '$service_status','$time','$date','$user_id')";
    DB::insert( DB::raw( $sql ) );
    $sql = "update users set wallet = wallet - $newamount where id = $user_id";
    DB::update( DB::raw( $sql ) );
       
        
        $sql = "update recharge set status='$status',message='$message' where id=$insert_id";
        DB::update($sql);

//print_r($data);die;
        if(strtoupper($status) == "SUCCESS"){
            return redirect("/utilityservices/".$serviceid)->with('success',ucwords($message));
        }else{
            return redirect("/utilityservices/".$serviceid)->with('success',ucwords('Recharge is Pending.Please Wait..'));
        }
    }else{
        return redirect("/utilityservices/".$serviceid)->with('error',ucwords($message));
    }

}

public function rechargehook(Request $request){
    $Status = $request->get('status');
    $Operator = $request->get('opid');
    $TransID = $request->get('txid');

    DB::table('callback')->insert([
        'operator' => $Operator,
        'usertx' => $TransID,
        'status' => $Status,
        'message' => 'OK',
        'callback_date' => date("Y-m-d"),
        'callback_time' => date("H:i:s"),
    ]);
    DB::table('recharge')->where('usertx', $TransID)->update([
        'status' => $Status
    ]);
    $sql = "SELECT * FROM recharge where usertx='$TransID'";
    $result = DB::select($sql);
    $user_id = 0;
    $amount = 0;
    $commission_amount = 0;
    if(count($result) > 0){
        $user_id = $result[0]->user_id;
        $amount = $result[0]->amount;
        $commission_amount = $result[0]->commission_amount;
    }
   
    $totalamount = $amount - $commission_amount;
    if(strtoupper($Status) == "FAILURE"){
        $date = date( 'Y-m-d' );
        $time = date( 'H:i:s' );
        $service_status = 'Out Payment';
        $ad_info = 'Recharge Failure Refund';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('$user_id','1','$user_id','$totalamount','$ad_info', '$service_status','$time','$date','$user_id')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet - $totalamount where id = 1";
        DB::update( DB::raw( $sql ) );
        $service_status = 'IN Payment';
        $ad_info = 'Recharge Failure Refund';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('$user_id','$user_id','1','$totalamount','$ad_info', '$service_status','$time','$date','$user_id')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet + $totalamount where id = $user_id";
        DB::update( DB::raw( $sql ) );
    }
}

}
