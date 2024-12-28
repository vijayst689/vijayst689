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
    $this->middleware('auth');
  }


  public function addpan(){
    return view( 'pancard.addpan');
  }

  public function viewpan(){
    $viewpan = DB::table( 'panservice' )->where('status', 'Active')->orderBy( 'id', 'Asc' )->get();
    return view( 'pancard.viewpan' ,compact('viewpan'));
  }

  public function savepan( Request $request ) {
    DB::table( 'panservice' )->insert( [
      'name'       => $request->name,
      'amount'     => $request->amount,
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
    $service = DB::table( 'panservice' )->where('status' , 'Active')->orderBy( 'id', 'ASC' )->get();
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
    // if($serviceid == 1){
    //   $pandetails = DB::table( 'pancard_find' )->where('user_id',Auth::user()->id)->where('service_id',$serviceid)->orderBy( 'id', 'Desc' )->get();
    //   return view( 'panservice.panfind',compact('serviceid','servicename','payment','mainbalance','pandetails','amount'));
    // }elseif($serviceid == 2){
    //   $pandetails = DB::table( 'pancard_find' )->where('user_id',Auth::user()->id)->where('service_id',$serviceid)->orderBy( 'id', 'Desc' )->get();
    //   return view( 'panservice.panadvance',compact('serviceid','servicename','payment','mainbalance','pandetails','amount'));
    // }elseif( $serviceid == 3 ){
    //   $dldetails = DB::table( 'dl' )->where('user_id',Auth::user()->id)->orderBy( 'id', 'Desc' )->get();
    //   return view( 'pdfservice.dlservice',compact('serviceid','servicename','payment','mainbalance','dldetails','amount'));
    // }elseif( $serviceid == 4 ){
    //   $rcdetails = DB::table( 'rc' )->where('user_id',Auth::user()->id)->orderBy( 'id', 'Desc' )->get();
    //   return view( 'pdfservice.rcservice',compact('serviceid','servicename','payment','mainbalance','rcdetails','amount'));
    // }elseif( $serviceid == 5 ){
    //   $rationdetails = DB::table( 'ration' )->where('user_id',Auth::user()->id)->orderBy( 'id', 'Desc' )->get();
    //   return view( 'pdfservice.rationcardverify',compact('serviceid','servicename','payment','mainbalance','rationdetails','amount'));
    // }
  }

}
