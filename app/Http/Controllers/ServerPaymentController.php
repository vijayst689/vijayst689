<?php

namespace App\Http\Controllers;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServerPaymentController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }


  public function serverpayment(){
    $paymentdetails = DB::table( 'serverpayment' )->orderBy('id','desc')->limit(1)->first();
    $paymentHistory = DB::table('serverpayment') // Replace with your actual table
    ->orderBy('activation_date', 'desc')->limit(5)
    ->get();
    return view( 'payment.serverpayment',compact('paymentdetails','paymentHistory'));
  }

  public function saveserver_payment( Request $request ) {
    DB::table( 'serverpayment' )->insert( [
      'user_id'        => Auth::user()->id,
      'website_index'        => env( 'WEBSITE_INDEX', '' ),
      'payment'      => Auth::user()->server_amount,
      'activation_date'      => Auth::user()->payment_date,
      'date'      => date("Y-m-d H:i:s"),
      'status'      => 'Pending',
    ] );

    $insertid = DB::getPdo()->lastInsertId();

    $payment_proof = '';
    if ( $request->payment_proof != null ) {
      $payment_proof = $insertid.'.'.$request->file( 'payment_proof' )->extension();
      $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'serverpayment_image' . DIRECTORY_SEPARATOR );
      move_uploaded_file( $_FILES[ 'payment_proof' ][ 'tmp_name' ], $filepath . $payment_proof );
    }
    $image = DB::table( 'serverpayment' )->where( 'id', $insertid )->update( [
      'payment_proof' => $payment_proof,
    ] );

    $getdata = DB::table( 'serverpayment' )->where('id',$insertid)->first();
    if($getdata){
     $payment = $getdata->payment;
     $activation_date = $getdata->activation_date;
     $status = $getdata->status;
     $url = url('/');
     $payment_proof = $url.'/upload/serverpayment_image/'.$payment_proof;
     $API_KEY = env( 'API_KEY', '' );
     $RAMJIPAY_URL = env( 'RAMJIPAY_URL', '' );
     $WEBSITE_INDEX = env( 'WEBSITE_INDEX', '' );
     $ch = curl_init();
    
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&payment_proof=$payment_proof&payment=$payment&rowid=$insertid&status=$status&activation_date=$activation_date";
    
    //dd($post_data);
     $url1 = $RAMJIPAY_URL.'/api/serverpayment_approve';
  //echo $url1;die;
     curl_setopt( $ch, CURLOPT_URL, $url1 );
     curl_setopt( $ch, CURLOPT_POST, 1 );
     curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_data );
     curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
     $server_output = curl_exec( $ch );
     curl_close( $ch );
     $resdata = json_decode($server_output, true);
       }
    return redirect('/serverpayment')->with('success', 'Please wait for appproval ... !');

}


}
