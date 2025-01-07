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
      $this->middleware('auth');
    }

    public function index()
  {
    $userid = Auth::user()->id;

    if(Auth::user()->user_type_id == 2){
        $viewamount = DB::table( 'payment' )->where( 'from_id', $userid )->orderBy( 'id', 'Asc' )->get();
    }else{
        $viewamount = DB::table( 'payment' )->where( 'from_id', $userid )->orderBy( 'id', 'Asc' )->get();
    }
    return view('wallet.index',compact('viewamount'));
  }

    public function paymentrequest()
  {
    $userid = Auth::user()->id;

    if(Auth::user()->user_type_id == 2){
        $requestamount = DB::table( 'request_payment' )->where( 'to_id', $userid)->orderBy( 'id', 'Asc' )->get();
    }else{
        $requestamount = DB::table( 'request_payment' )->where( 'from_id', $userid )->orderBy( 'id', 'Asc' )->get();
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
      $rarequestamount = DB::table( 'request_payment' )->where( 'to_id', $userid )->orderBy( 'id', 'desc' )->get();
  }else{
      $rarequestamount = DB::table( 'request_payment' )->where( 'from_id', $userid )->orderBy( 'id', 'desc' )->get();
  }

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
    $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('$login_id','$from_id','$login_id','$amount','$ad_info', '$service_status','$time','$date','$from_id')";
    DB::insert( DB::raw( $sql ) );

    return redirect()->back()->with( 'success', 'Ramji wallet Updated Successfully' );
}

public function ramjisaverequest(Request $request){

    $from_id = Auth::user()->id;

      $confirm = DB::table('request_payment')->insert([
          'from_id'   => $from_id,
          'to_id'     => 1,
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

return redirect( "/rapaymentrequest" );
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
    $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('$login_id','$login_id','$from_id','$amount','$ad_info', '$service_status','$time','$date','$from_id')";
    DB::insert( DB::raw( $sql ) );

    return redirect()->back()->with( 'success', 'wallet Updated Successfully' );
}

}
