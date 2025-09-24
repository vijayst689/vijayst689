<?php

namespace App\Http\Controllers;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CanController extends Controller
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


  public function addcan(){
    return view( 'canservice.addcan');
  }

  public function viewcan(){
    $viewcan = DB::table( 'canservice' )->orderBy( 'id', 'Asc' )->get();
    return view( 'canservice.viewcan' ,compact('viewcan'));
  }

  public function savecan( Request $request ) {
    DB::table( 'canservice' )->insert( [
      'name'       => $request->name,
      'amount'     => $request->amount,
      'date'       => date("Y-m-d H:i:s"),
      'status'     => 'Active',
    ] );

    $insertid = DB::getPdo()->lastInsertId();

    $ser_image = '';
    if ( $request->ser_image != null ) {
      $ser_image = $insertid.'.'.$request->file( 'ser_image' )->extension();
      $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'canservice' . DIRECTORY_SEPARATOR );
      move_uploaded_file( $_FILES[ 'ser_image' ][ 'tmp_name' ], $filepath . $ser_image );
    }
    $image = DB::table( 'canservice' )->where( 'id', $insertid )->update( [
      'ser_image' => $ser_image,
    ] );
    return redirect('/viewcan')->with('success', 'AddCan Service Added Successfully ... !');
  }

  public function updatecan( Request $request ) {
  
    DB::table( 'canservice' )->where('id', $request->canid)->update( [
      'name'     => $request->name,
      'amount'   => $request->amount,
    ] );

    if ( $request->ser_image != null ) {
      $ser_image = $request->canid.'.'.$request->file( 'ser_image' )->extension();
      $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'canservice' . DIRECTORY_SEPARATOR );
      move_uploaded_file( $_FILES[ 'ser_image' ][ 'tmp_name' ], $filepath . $ser_image );
      $image = DB::table( 'canservice' )->where( 'id', $request->canid )->update( [
        'ser_image' => $ser_image,
      ] );
    }

    return redirect()->back()->with( 'success', 'Can Service Updated Successfully' );
  }

  public function canupdatestatus( Request $request ) {
    DB::table( 'canservice' )->where('id', $request->statusid)->update( [
      'status'     => $request->status,
    ] );

    return redirect()->back()->with( 'success', 'Canservice Status Updated Successfully' );
  }

  public function applycanservice($serviceid) {
    $districts = DB::table( 'district' )->get();
    $getservicename = DB::table( 'canservice' )->where('id',$serviceid)->first();
    $servicename = "";
    $amount = 0;
    if($getservicename){
      $servicename = $getservicename->name;
      $amount = $getservicename->amount;
    }
    $getservice_payment = DB::table( 'can_payment' )->where('service_id',$serviceid)->first();
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
    $mainbalance = DB::table( 'users' )->select('wallet')->where('id',2)->first();
    if($serviceid == 1){
      $pandetails = DB::table( 'canservice' )->where('user_id',Auth::user()->id)->where('service_id',$serviceid)->orderBy( 'id', 'Desc' )->get();
      return view( 'can.newcanregister',compact('serviceid','servicename','payment','mainbalance','pandetails','amount','districts'));
    }elseif($serviceid == 2){
      $pandetails = DB::table( 'canservice' )->where('user_id',Auth::user()->id)->where('service_id',$serviceid)->orderBy( 'id', 'Desc' )->get();
      return view( 'can.namecorection',compact('serviceid','servicename','payment','mainbalance','pandetails','amount','districts'));
    }elseif($serviceid == 3){
      $pandetails = DB::table( 'canservice' )->where('user_id',Auth::user()->id)->where('service_id',$serviceid)->orderBy( 'id', 'Desc' )->get();
      return view( 'can.canmobilecorection',compact('serviceid','servicename','payment','mainbalance','pandetails','amount','districts'));
    }elseif($serviceid == 4){
      $pandetails = DB::table( 'canservice' )->where('user_id',Auth::user()->id)->where('service_id',$serviceid)->orderBy( 'id', 'Desc' )->get();
      return view( 'can.candobcorection',compact('serviceid','servicename','payment','mainbalance','pandetails','amount','districts'));
    }elseif($serviceid == 5){
      $pandetails = DB::table( 'canservice' )->where('user_id',Auth::user()->id)->where('service_id',$serviceid)->orderBy( 'id', 'Desc' )->get();
      return view( 'can.canaddresscorection',compact('serviceid','servicename','payment','mainbalance','pandetails','amount','districts'));
    }elseif($serviceid == 6){
      $pandetails = DB::table( 'canservice' )->where('user_id',Auth::user()->id)->where('service_id',$serviceid)->orderBy( 'id', 'Desc' )->get();
      return view( 'can.cannumberfind',compact('serviceid','servicename','payment','mainbalance','pandetails','amount','districts'));
    }elseif($serviceid == 7){
      $pandetails = DB::table( 'canservice' )->where('user_id',Auth::user()->id)->where('service_id',$serviceid)->orderBy( 'id', 'Desc' )->get();
      return view( 'can.certificatefind',compact('serviceid','servicename','payment','mainbalance','pandetails','amount','districts'));
    }elseif($serviceid == 8){
      $pandetails = DB::table( 'canservice' )->where('user_id',Auth::user()->id)->where('service_id',$serviceid)->orderBy( 'id', 'Desc' )->get();
      return view( 'can.candelete',compact('serviceid','servicename','payment','mainbalance','pandetails','amount','districts'));
    }
  }

}
