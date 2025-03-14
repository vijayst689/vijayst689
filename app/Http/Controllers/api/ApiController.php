<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ApiController extends Controller
{

    public function get_panstatus(Request $request){
        $API_KEY = env('API_KEY','');
        $WEBSITE_INDEX = env('WEBSITE_INDEX','');
        $key = $request->key;
        $index = $request->index;
        $response = array();
        $message = "";
        if($key == $API_KEY && $index == $WEBSITE_INDEX){
            $txid = $request->api_txn;
            $status = $request->api_status;
            $opid = $request->opid;
            DB::table('pancard')->where('api_txid', $txid)->update([
                'api_status' => $status,
                'status' => $status,
                'opid' => $opid
            ]);
            if($status == "Failure"){
                $getpandetails = DB::table('pancard')->where('api_txid', $txid)->first();
                $userid = 0;
                $serviceid = 0;
                $mobile = 0;
                if($getpandetails){
                    $userid = $getpandetails->user_id;
                    $serviceid = $getpandetails->service_id;
                    $mobile = $getpandetails->mobile;
                    $getusers = DB::table( 'users' )->where('id',$userid)->first();
                    $usertype = 0;
                    if($getusers){
                        $usertype = $getusers->user_type_id;
                    }

                    $get_payment = DB::table( 'panservice' )->where('id',$serviceid)->first();
                    $payment = 0;
                    $admin_payment = 0;
                    if($get_payment){
                        $admin_payment = $get_payment->amount;
                        if($usertype == 2){

                            $payment = $get_payment->amount;
                        }else{
                            $admin_payment = $get_payment->amount;
                        }
                    }

                    $getservice_payment = DB::table( 'panpayment' )->where('service_id',$serviceid)->first();
                    if($getservice_payment){
                        if($usertype == 3){
                            $payment = $getservice_payment->distributor_amount;
                        }elseif($usertype == 4){
                            $payment = $getservice_payment->retailer_amount;
                        }elseif($usertype == 5){
                            $payment = $getservice_payment->customer_amount;
                        }
                    }

                    if($userid != 2){

                        $getservicename = DB::table( 'panservice' )->select('name')->where('id',$serviceid)->first();
                        $servicename = "";
                        if($getservicename){
                            $servicename = $getservicename->name;
                        }
                        $date = date( 'Y-m-d' );
                        $time = date( 'H:i:s' );
                        $service_status = 'Out Payment';
                        $ad_info = "Service Refund For". ' ' .$servicename.'  '. "Mobile Number".' '.$mobile;

                        $getwallet = DB::table( 'users' )->select('wallet')->where('id',2)->first();
                        $balance = 0;
                        if($getwallet){
                            $balance = $getwallet->wallet;
                        }
                        $getuserswallet = DB::table( 'users' )->select('wallet')->where('id',$userid)->first();
                        $balance1 = 0;
                        if($getuserswallet){
                            $balance1 = $getuserswallet->wallet;
                        }
                        $newbalance = $balance - $payment;
                        $newbalance1 = $balance1 + $payment;

                        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$userid','2','$userid','$payment','$ad_info', '$service_status','$time','$date','$userid','$newbalance')";
                        DB::insert( DB::raw( $sql ) );
                        $sql = "update users set wallet = wallet - $payment where id = 2";
                        DB::update( DB::raw( $sql ) );
                        $service_status = 'IN Payment';
                        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$userid','$userid','2','$payment','$ad_info', '$service_status','$time','$date','$userid','$newbalance1')";
                        DB::insert( DB::raw( $sql ) );
                        $sql = "update users set wallet = wallet + $payment where id = $userid";
                        DB::update( DB::raw( $sql ) );  



                    }

                    $date = date( 'Y-m-d' );
                    $time = date( 'H:i:s' );
                    $service_status = 'Out Payment';
                    $ad_info = "Ramji Wallet Refund(PanCard)" .' '."Mobile Number".' '.$mobile;
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
                    $newbalance2 = $balance1 - $admin_payment;
                    $newbalance3 = $balance2 + $admin_payment;
                    $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('1','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','$userid','$newbalance2')";
                    DB::insert( DB::raw( $sql ) );
                    $sql = "update users set rawallet = rawallet - $admin_payment where id = 1";
                    DB::update( DB::raw( $sql ) );
                    $service_status = 'IN Payment';
                    $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('1','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','$userid','$newbalance3')";
                    DB::insert( DB::raw( $sql ) );
                    $sql = "update users set rawallet = rawallet + $admin_payment where id = 2";
                    DB::update( DB::raw( $sql ) );

                     $message = "success";
                }


            }
           

        }else{
            $message = "Access Denied";
        }
        $response["message"] = $message;
        $response["index"] = $index;
        return response()->json($response);
    }


}
