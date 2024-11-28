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
        $viewamount = DB::table( 'payment' )->orderBy( 'id', 'Asc' )->get();
    }else{
        $viewamount = DB::table( 'payment' )->where( 'from_id', $userid )->orderBy( 'id', 'Asc' )->get();
    }
    return view('wallet.index',compact('viewamount'));
  }

    public function paymentrequest()
  {
    $userid = Auth::user()->id;

    if(Auth::user()->user_type_id == 2){
        $requestamount = DB::table( 'request_payment' )->orderBy( 'id', 'Asc' )->get();
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

      $raviewamount = DB::table( 'payment' )->where( 'to_id', $userid )->orderBy( 'id', 'desc' )->get();
  }elseif (Auth::user()->user_type_id == 2) {

      $raviewamount = DB::table( 'payment' )->where( 'to_id', 1 )->orderBy( 'id', 'desc' )->get();
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
    $amount = $request->wallet;
    $login_id = Auth::user()->id;
    $sql = "update users set rawallet = rawallet + $amount where id = $login_id";
    DB::update( DB::raw( $sql ) );

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
    $login_id = Auth::user()->id;
    $sql = "update users set wallet = wallet + $amount where id = $login_id";
    DB::update( DB::raw( $sql ) );

    return redirect()->back()->with( 'success', 'wallet Updated Successfully' );
}

}
