<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

class PaymentsController extends Controller {

    public function __construct()
  {
    $this->middleware(function ($request, $next) {
            $this->restrictIfNotActivated();
            return $next($request);
        });
    $this->middleware('auth');
  }
  
    public function declinerequest_payment($toid) {

        $sql = "update request_payment set status = 'Declined' where id = $toid";
        DB::update( DB::raw( $sql ) );

        return redirect( "/paymentrequest" )->with('success', 'Request Amount Declined  Successfully');
    }

    public function approvepayment(Request $request) {

        $amount = $request->amount;
        $from_id = $request->from_id;
        $request_id = $request->request_id;
        $login_id = Auth::user()->id;
        $date = date( 'Y-m-d' );
        $time = date( 'H:i:s' );
        $status = 'Approved';
        $newbalance = Auth::user()->wallet - $amount;
        $sql = "update request_payment set status = '$status' where id = $request_id";
        DB::update( DB::raw( $sql ) );
        $service_status = 'Out Payment';
        $ad_info = 'Fund Transfer';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$login_id','$login_id','$from_id','$amount','$ad_info', '$service_status','$time','$date','$from_id','$newbalance')";
        DB::insert( DB::raw( $sql ) );

        $getwallet = DB::table( 'users' )->select('wallet')->where('id',$from_id)->first();
        $balance = 0;
        if($getwallet){
            $balance = $getwallet->wallet;
        }
        $newbalance1 = $balance + $amount;

        $sql = "update users set wallet = wallet + $amount where id = $from_id";
        DB::update( DB::raw( $sql ) );
        $service_status = 'IN Payment';
        $ad_info = 'Fund Transfer';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$login_id','$from_id','$login_id','$amount','$ad_info', '$service_status','$time','$date','$from_id','$newbalance1')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet - $amount where id = $login_id";
        DB::update( DB::raw( $sql ) );

     return redirect( "/paymentrequest" )->with( 'success', 'Request Amount Approved Successfully' );
    }


    public function approveramjipayment(Request $request) {

        $amount = $request->amount;
        $from_id = $request->from_id;
        $request_id = $request->request_id;
        $login_id = Auth::user()->id;
        $date = date( 'Y-m-d' );
        $time = date( 'H:i:s' );
        $status = 'Approved';
        $newbalance = Auth::user()->rawallet - $amount;
        $sql = "update request_payment set status = '$status' where id = $request_id";
        DB::update( DB::raw( $sql ) );
        $service_status = 'Out Payment';
        $ad_info = 'Fund Transfer';
        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$login_id','$from_id','$login_id','$amount','$ad_info', '$service_status','$time','$date','$from_id','$newbalance')";
        DB::insert( DB::raw( $sql ) );
        $getwallet = DB::table( 'users' )->select('rawallet')->where('id',$from_id)->first();
        $balance = 0;
        if($getwallet){
            $balance = $getwallet->rawallet;
        }
        $newbalance1 = $balance + $amount;
        $sql = "update users set rawallet = rawallet + $amount where id = $from_id";
        DB::update( DB::raw( $sql ) );
        $service_status = 'IN Payment';
        $ad_info = 'Fund Transfer';
        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$login_id','$login_id','$from_id','$amount','$ad_info', '$service_status','$time','$date','$from_id','$newbalance1')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set rawallet = rawallet - $amount where id = $login_id";
        DB::update( DB::raw( $sql ) );

     return redirect( "/rapaymentrequest" )->with( 'success', 'Request Amount Approved Successfully' );
    }























































    public function totalwallethistory ($from,$to) {
     $username=Auth::user()->username;
     $usertype=Auth::user()->user_type_id;
     $balance = 0;
     $NALAVARIYAM_URL = env( 'NALAVARIYAM_URL', '' );
     $API_KEY = env( 'API_KEY', '' );
     $url = $NALAVARIYAM_URL ."/api/totalwallet_history/$username/$usertype/$from/$to/".$API_KEY;
     $crl = curl_init();
     curl_setopt( $crl, CURLOPT_URL, $url );
     curl_setopt( $crl, CURLOPT_FRESH_CONNECT, true );
     curl_setopt( $crl, CURLOPT_RETURNTRANSFER, true );
     $response = curl_exec( $crl );
     $msg = '';
     $wallet = array();
     if ( $response ) {
         $response = json_decode( $response, true );
         $msg = $response[ 'message' ];
         $wallet = $response[ 'wallet' ];
         $wallet = json_decode( json_encode( $wallet ) );
         //dd($wallet);
     } else {
         $msg = 'Error calling wallet';
     }
     curl_close( $crl );
     if ( $msg == 'success' ) {
       $balance=$response['balance'];
     }

        if($usertype == 1){
        return view( 'admin/totalwallethistory', compact( 'wallet','balance','from','to' ) );
        }else{
        return view( 'recharge/wallethistory', compact( 'wallet','balance','from','to' ) );

        }
    }


     public function totalhistory ($from,$to) {
       $sql="select * from payment where paydate >= '$from' and paydate <= '$to' order by id desc";
        $wallet = DB::select($sql);

     $username=Auth::user()->username;
     $balance = 0;
     $NALAVARIYAM_URL = env( 'NALAVARIYAM_URL', '' );
     $API_KEY = env( 'API_KEY', '' );
     $url = $NALAVARIYAM_URL ."/api/wallet_commission/$username/".$API_KEY;
     $crl = curl_init();
     curl_setopt( $crl, CURLOPT_URL, $url );
     curl_setopt( $crl, CURLOPT_FRESH_CONNECT, true );
     curl_setopt( $crl, CURLOPT_RETURNTRANSFER, true );
     $response = curl_exec( $crl );
     $msg = '';
     if ( $response ) {
         $response = json_decode( $response, true );
         $msg = $response[ 'message' ];
     } else {
         $msg = 'Error calling wallet';
     }
     curl_close( $crl );
     if ( $msg == 'success' ) {
       $balance=$response['balance'];
     }


        return view( 'admin/totalhistory', compact( 'wallet','balance','from','to' ) );
    }


    public function history () {
        $user_id=Auth::user()->id;
        $sql="select a.*,b.full_name from recharge a,users b where a.user_id=b.id ";
        if(Auth::user()->user_type_id==2){
            $sql .= " and (b.id=$user_id OR b.referral_id=$user_id) ";
        }
        $sql=$sql." order by id desc";
        $viewhistory=DB::select($sql);
        return view( 'admin/history', compact( 'viewhistory' ) );
    }

    public function commission(){
        $user_id=Auth::user()->id;
        $sql="select a.*,b.name from recharge a,operator b where a.operator=b.code order by a.id desc";
        $viewhistory = DB::select($sql);
        $viewhistory = json_decode( json_encode( $viewhistory ), true );
        foreach($viewhistory as $key => $history){
            $viewhistory[$key]["commission"] = array();
            $recharge_id=$history["id"];
            $sql="select commission from recharge_commision where recharge_id=$recharge_id order by id desc";
            $result=DB::select($sql);
            $viewhistory[$key]["commission"] = $result;
        }
        $viewhistory = json_decode( json_encode( $viewhistory ) );
        return view( 'admin/commission', compact( 'viewhistory' ) );
    }

    public function paymentshistory () {
        $userid = Auth::user()->id;
        $viewhistory = DB::table( 'recharge' )->where( 'user_id', $userid )->orderby( 'id', 'Asc' )->get();
        return view( 'payments_history', compact( 'viewhistory' ) );
    }



    public function cyrus(){
        $balance = 0;
        $apikey = "503025";
        $pin = "r3trjgyq";
        $url = "https://business.a1topup.com/recharge/balance?username=$apikey&pwd=$pin&format=json";
        $crl = curl_init();
        curl_setopt( $crl, CURLOPT_URL, $url );
        curl_setopt( $crl, CURLOPT_FRESH_CONNECT, true );
        curl_setopt( $crl, CURLOPT_RETURNTRANSFER, true );
        $result = curl_exec($crl);
        $result = json_decode($result);
//print_r($result);die;
        $balance = $result;
        curl_close($crl);
        return view( 'admin/cyrus', compact( 'balance' ) );
    }

    public function dispute(){
        $sql="select * from dispute";
        $dispute=DB::select($sql);
        return view( 'admin/dispute',compact('dispute'));

    }

    public function updatedispute(Request $request){
        DB::table('dispute')->where('id',$request->id)->update([
            'status' => $request->status,
            'message' => $request->message
        ]);
        return redirect("admin/dispute")->with( 'success', 'Dispute Closed successfully');
    }

}
