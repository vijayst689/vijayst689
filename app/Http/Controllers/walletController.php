<?php

namespace App\Http\Controllers;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
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

    public function index()
  {
    $userid = Auth::user()->id;

    if(Auth::user()->user_type_id == 2){
        $viewamount = DB::table( 'payment' )->where( 'from_id', $userid )->orderBy( 'id', 'Desc' )->get();
    }else{
        $viewamount = DB::table( 'payment' )->where( 'from_id', $userid )->orderBy( 'id', 'Desc' )->get();
    }
    $qrlabel = DB::table( 'users' )->where( 'id', 2 )->orderBy( 'id' , 'Asc' )->first();
    return view('wallet.index',compact('viewamount','qrlabel'));
  }

    public function paymentrequest()
  {
    $userid = Auth::user()->id;

    if(Auth::user()->user_type_id == 2){
        $requestamount = DB::table( 'request_payment' )->where( 'to_id', $userid)->orderBy( 'id', 'Desc' )->get();
    }else{
        $requestamount = DB::table( 'request_payment' )->where( 'from_id', $userid )->orderBy( 'id', 'Desc' )->get();
    }
    return view('wallet.paymentrequest',compact('requestamount'));
  }

    public function requestpayment()
  {
    return view('wallet.requestpayment');
  }

  public function saverequest(Request $request){

    $from_id = Auth::user()->id;

      $confirm = DB::table('request_payment')->insert([
          'from_id'   => $from_id,
          'to_id'     => 2,
          'amount'    => $request->amount,
          'status'    => 'Pending',
          'req_date'  => date("Y-m-d"),
          'req_time'  => date("H:i:s"),
      ]);
      $insertid = DB::getPdo()->lastInsertId();

      $req_image = "";
      if ($request->req_image != null) {
          $req_image = $insertid.'.'.$request->file('req_image')->extension();
          $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'paidimage' . DIRECTORY_SEPARATOR);
          move_uploaded_file($_FILES['req_image']['tmp_name'], $filepath . $req_image);
      }
      $image = DB::table('request_payment')->where('id', $insertid)->update([
          'req_image' => $req_image,
      ]);

return redirect( "/paymentrequest" );
}

public function rawallet()
{
  $userid = Auth::user()->id;

  if(Auth::user()->user_type_id == 1){

      $raviewamount = DB::table( 'ramji_payment' )->where( 'to_id', $userid )->orderBy( 'id', 'desc' )->get();
  }elseif (Auth::user()->user_type_id == 2) {

      $raviewamount = DB::table( 'ramji_payment' )->where( 'to_id', 2 )->orderBy( 'id', 'desc' )->get();
  }
  return view('wallet.rawallet',compact('raviewamount'));
}

 public function rapaymentrequest()
  {
    $userid = Auth::user()->id;

    if(Auth::user()->user_type_id == 1){
         $requestamount = DB::table('request_payment')
    ->select(
        'id',
        'from_id',
        'to_id',
        'amount',
        DB::raw("CONCAT(req_date, ' ', req_time) as datetime"),
        'status',
        'req_image as proof',
        DB::raw("'request' as source") // to know from which table
    )->where( 'to_id', $userid )->orderBy('datetime', 'desc');

$wallettopup = DB::table('wallet_topup')
    ->select(
        'id',
        'user_id as from_id',
        DB::raw("NULL as to_id"),
        'payment as amount',
        'date as datetime',
        'status',
        'payment_proof as proof',
        DB::raw("'topup' as source")
    );
    }else{
        //$rarequestamount = DB::table( 'request_payment' )->where( 'from_id', $userid )->orderBy( 'id', 'desc' )->get();
        $requestamount = DB::table('request_payment')
    ->select(
        'id',
        'from_id',
        'to_id',
        'amount',
        DB::raw("CONCAT(req_date, ' ', req_time) as datetime"),
        'status',
        'req_image as proof',
        DB::raw("'request' as source") // to know from which table
    )->where( 'from_id', $userid )->orderBy('datetime', 'desc');

$wallettopup = DB::table('wallet_topup')
    ->select(
        'id',
        'user_id as from_id',
        DB::raw("NULL as to_id"),
        'payment as amount',
        'date as datetime',
        'status',
        'payment_proof as proof',
        DB::raw("'topup' as source")
    );


    }
    $rarequestamount = $requestamount
    ->unionAll($wallettopup)
    ->orderBy('datetime','desc')
    ->get();
//dd($rarequestamount);
    return view('wallet.rapaymentrequest',compact('rarequestamount'));
  }

public function superadminaddwallet( Request $request )
{

    $amount = $request->rawallet;
    $from_id = Auth::user()->id;
    $request_id = Auth::user()->id;
    $login_id = Auth::user()->id;
    $date = date( 'Y-m-d' );
    $time = date( 'H:i:s' );
    $status = 'Approved';
    $newbalance = Auth::user()->rawallet - $amount;
    $sql = "update request_payment set status = '$status' where id = $request_id";
    DB::update( DB::raw( $sql ) );
    $getwallet = DB::table( 'users' )->select('rawallet')->where('id',$from_id)->first();
    $balance = 0;
    if($getwallet){
        $balance = $getwallet->rawallet;
    }
    $newbalance1 = $balance + $amount;

    $sql = "update users set rawallet = rawallet + $amount where id = $from_id";
    DB::update( DB::raw( $sql ) );
    $service_status = 'IN Payment';
    $ad_info = 'ADD MONEY';
    $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$login_id','$from_id','$login_id','$amount','$ad_info', '$service_status','$time','$date','$from_id','$newbalance1')";
    DB::insert( DB::raw( $sql ) );

    return redirect()->back()->with( 'success', 'Ramji Wallet Updated Successfully' );
}

 public function ramjisaverequest(Request $request)
    {
        DB::table( 'wallet_topup' )->insert( [
          'user_id'        => Auth::user()->id,
          'website_index'  => env( 'WEBSITE_INDEX', '' ),
          'payment'        => $request->amount,
          'date'            => date("Y-m-d H:i:s"),
          'status'          => 'Pending',
    ] );

    $insertid = DB::getPdo()->lastInsertId();

    $payment_proof = '';
    if ( $request->req_image != null ) {
      $payment_proof = uniqid().'.'.$request->file( 'req_image' )->extension();
      $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'paidimage' . DIRECTORY_SEPARATOR );
      move_uploaded_file( $_FILES[ 'req_image' ][ 'tmp_name' ], $filepath . $payment_proof );
    }
    $image = DB::table( 'wallet_topup' )->where( 'id', $insertid )->update( [
      'payment_proof' => $payment_proof,
    ] );

    $getdata = DB::table( 'wallet_topup' )->where('id',$insertid)->first();
    if($getdata){
     $payment = $getdata->payment;
     $status = $getdata->status;
     $url = url('/');
     $payment_proof = $url.'/upload/paidimage/'.$payment_proof;
     $API_KEY = env( 'API_KEY', '' );
     $RAMJIPAY_URL = env( 'RAMJIPAY_URL', '' );
     $WEBSITE_INDEX = env( 'WEBSITE_INDEX', '' );
     $ch = curl_init();

     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&payment_proof=$payment_proof&payment=$payment&rowid=$insertid&status=$status";

    //dd($post_data);
     $url1 = $RAMJIPAY_URL.'/api/approve_payment';
  //echo $url1;die;
     curl_setopt( $ch, CURLOPT_URL, $url1 );
     curl_setopt( $ch, CURLOPT_POST, 1 );
     curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_data );
     curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
     $server_output = curl_exec( $ch );
     curl_close( $ch );
     $resdata = json_decode($server_output, true);
       }
      return redirect()->back()->with('success', 'Payment Date Updated Successfully ... !');
  }

public function adminaddwallet( Request $request )
{
    $amount = $request->wallet;
    $from_id = Auth::user()->id;
    $request_id = Auth::user()->id;
    $login_id = Auth::user()->id;
    $date = date( 'Y-m-d' );
    $time = date( 'H:i:s' );
    $status = 'Approved';
    $newbalance = Auth::user()->wallet - $amount;
    $sql = "update request_payment set status = '$status' where id = $request_id";
    DB::update( DB::raw( $sql ) );
    $getwallet = DB::table( 'users' )->select('wallet')->where('id',$from_id)->first();
    $balance = 0;
    if($getwallet){
        $balance = $getwallet->wallet;
    }
    $newbalance1 = $balance + $amount;

    $sql = "update users set wallet = wallet + $amount where id = $from_id";
    DB::update( DB::raw( $sql ) );
    $service_status = 'IN Payment';
    $ad_info = 'ADD MONEY';
    $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$login_id','$login_id','$from_id','$amount','$ad_info', '$service_status','$time','$date','$from_id','$newbalance1')";
    DB::insert( DB::raw( $sql ) );

    return redirect()->back()->with( 'success', 'Admin Wallet Updated Successfully' );
}

}
