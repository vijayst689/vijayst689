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

  public function utility(){
   $checkpermission = DB::table( 'user_permission' )->where('user_id' , Auth::user()->id)->where('parent_id' , 2)->get();
   if(Auth::user()->user_type_id == 1 || Auth::user()->user_type_id == 5){
    $utlityser = DB::table( 'utility_services' )->where('status' , 'Active')->orderBy( 'id', 'Asc' )->get();
}else{
    $utlityser = DB::table( 'utility_services' )->where('status' , 'Active')->whereIn('id',$checkpermission->pluck('service_id'))->orderBy( 'id', 'Asc' )->get();
}


return view('utility.utility',compact('utlityser'));
}

public function utilityservice($serviceid) {
    $getservicename = DB::table( 'utility_services' )->where('status' , 'Active')->where('id',$serviceid)->first();
    // echo $serviceid;die;
    $servicename = "";
    if($getservicename){
      $servicename = $getservicename->name;
  }

  if($serviceid == 1 || $serviceid == 2){
    if($serviceid == 1){
        $sql="select * from operator where service_type = '1' order by name";
    }elseif($serviceid == 2){
        $sql="select * from operator where service_type = '2' order by name";
    }
    $operator=DB::select($sql);
    $recha = DB::table( 'recharge' )->where('user_id',Auth::user()->id)->orderBy( 'id', 'Desc' )->get();
    $mainbalance = DB::table( 'users' )->select('rawallet')->where('id',2)->first();
    return view( 'utility.utilityservice',compact('serviceid','servicename','operator','recha','mainbalance'));
}
}


public function proceedrecharge(Request $request){

    $user_id = Auth::user()->id;
    $user_type_id = Auth::user()->user_type_id;
    $mobile = $request->mobile;
    $circle = $request->circle;
    $operator = $request->operator;
    $amount = $request->amount;
    $serviceid = $request->serviceid;
    $admin_commission=0;
    $operator_id=0;
    $sql="select * from operator where code='$operator'";
    $result=DB::select($sql);
    if(count($result)>0){
        $admin_commission=$result[0]->admin_commission;
        $operator_id=$result[0]->id;
    }
    //
    $getrecharge_payment = DB::table( 'recharge_payment' )->where('service_id',$operator_id)->first();
    $com = 0;
    if($getrecharge_payment){

      if($user_type_id == 2){
          $com = $admin_commission;
      }elseif($user_type_id == 3){
          $com = $getrecharge_payment->distributor_amount;
      }elseif($user_type_id == 4){
          $com = $getrecharge_payment->retailer_amount;
      }elseif($user_type_id == 5){
          $com = $getrecharge_payment->customer_amount;
      }
    }
    $commission_amount=$amount*$com/100;

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
    $admin_commission_amount=$amount*$admin_commission/100;
    $admin_amount = $amount - $admin_commission_amount;
        $getservicename = DB::table( 'utility_services' )->select('name')->where('id',$serviceid)->first();
          $servicename = "";
          if($getservicename){
            $servicename = $getservicename->name;
          }
        $date = date( 'Y-m-d' );
        $time = date( 'H:i:s' );
        $service_status = 'Out Payment';
        $ad_info = 'Ramji Wallet Debit('.$servicename.')';
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
          $newbalance2 = $balance1 + $admin_amount;
          $newbalance3 = $balance2 - $admin_amount;
        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_amount','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set rawallet = rawallet + $admin_amount where id = 1";
        DB::update( DB::raw( $sql ) );
        $service_status = 'IN Payment';
        $ad_info = 'Ramji Wallet Credit('.$servicename.')';

        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_amount','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set rawallet = rawallet - $admin_amount where id = 2";
        DB::update( DB::raw( $sql ) );

if(Auth::user()->user_type_id != 2){
    $date = date( 'Y-m-d' );
    $time = date( 'H:i:s' );
    $service_status = 'Out Payment';
    $ad_info = $servicename. ' '. 'Out Payment';
    $getwallet = DB::table( 'users' )->select('wallet')->where('id',2)->first();
          $balance = 0;
          if($getwallet){
            $balance = $getwallet->wallet;
          }
          $newbalance = $balance + $newamount;
          $newbalance1 = Auth::user()->wallet - $newamount;

          $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$newamount','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";


    DB::insert( DB::raw( $sql ) );
    $sql = "update users set wallet = wallet + $newamount where id = 2";
    DB::update( DB::raw( $sql ) );
    $service_status = 'IN Payment';
     $ad_info = $servicename. ' '. 'In Payment';



$sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$newamount','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
    DB::insert( DB::raw( $sql ) );
    $sql = "update users set wallet = wallet - $newamount where id = $user_id";
    DB::update( DB::raw( $sql ) );
    }

    $sql = "update recharge set status='$status',message='$message' where id=$insert_id";
    DB::update($sql);

//print_r($data);die;
    if(strtoupper($status) == "SUCCESS"){
        return redirect("/utilityservice/".$serviceid)->with('success',ucwords($message));
    }else{
        return redirect("/utilityservice/".$serviceid)->with('success',ucwords('Recharge is Pending.Please Wait..'));
    }
}else{
    return redirect("/utilityservice/".$serviceid)->with('error',ucwords($message));
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
