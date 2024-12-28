<?php

namespace App\Http\Controllers;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServicePaymentController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
  }

  public function servicepayment($serviceid){
    $services = DB::table('services')->where('parent_id',$serviceid )->orderBy( 'id' , 'Asc' )->get();
    $services = json_decode( json_encode( $services ), true );
    foreach ( $services as $key => $service ) {
      $services[ $key ][ 'payment' ] = array();
      $service_id = $service[ 'id' ];
      $payment = DB::table('service_payment')->where('service_id',$service_id)->get();
      if(count($payment) > 0){
        $services[ $key ][ 'payment' ] = $payment;
      }
    }
    $services = json_decode( json_encode( $services ));
    return view('servicepayment.servicepayment',compact('services','serviceid'));
  }

  public function addservice_payment(Request $request){
    $parent_id = $request->parent_id;
    DB::table('service_payment')->where('parent_id',$parent_id )->delete();
    if($request->has('parent_id')){
      foreach ( $request->parent_id as $key => $payment ) {
        $service_id = $request->service_id[ $key ];
        $distributor_amount = $request->distributor_amount[ $key ];
        $retailer_amount = $request->retailer_amount[ $key ];
        $customer_amount = $request->customer_amount[ $key ];

          DB::table( 'service_payment' )->insert( [
            'parent_id'  => $payment,
            'service_id'  => $service_id,
            'distributor_amount'        => $distributor_amount,
            'retailer_amount'        => $retailer_amount,
            'customer_amount'        => $customer_amount,
          ] );
      }
    }
    return redirect('servicepayment/'.$payment)->with('success' ,"Service Payment Update Succesfully !");
  }

  public function smartcardpayment($serviceid){
    $services = DB::table('services')->where('parent_id', $serviceid )->orderBy( 'id' , 'Asc' )->get();
    $taluk = DB::table('taluk')->orderBy( 'id' , 'Asc' )->get();
    return view('servicepayment.smartcardpayment',compact('services','serviceid','taluk'));
  }

  public function savesmart_payment(Request $request){
    // dd($request->all());
    $parent_id = $request->parent_id;
    $serviceid = $request->serviceid;
    $taluk_id = $request->taluk_id;
     DB::table('smartcard_payment')->where('parent_id',$parent_id )->where('service_id',$serviceid )->where('taluk_id',$taluk_id )->delete();

          DB::table( 'smartcard_payment' )->insert( [
            'parent_id'            => $parent_id,
            'service_id'           => $serviceid,
            'taluk_id'             => $taluk_id,
            'distributor_amount'   => $request->distributor_amount,
            'retailer_amount'      => $request->retailer_amount,
            'customer_amount'      => $request->customer_amount,
            'admin_amount'         => $request->admin_amount,
          ] );
    return redirect('smartcardpayment/'.$parent_id);
  }

   public function get_smartcard_payment($talukid,$serviceid){
    $response = DB::table('smartcard_payment')->where('service_id', $serviceid )->where('taluk_id', $talukid )->first();

    return response()->json( $response );
  }

  public function findpayment(){
    $services = DB::table('find_services')->orderBy( 'id' , 'Asc' )->get();
    $services = json_decode( json_encode( $services ), true );
    foreach ( $services as $key => $service ) {
      $services[ $key ][ 'payment' ] = array();
      $service_id = $service[ 'id' ];

    //   print_r( $service_id );die();

      $payment = DB::table('find_payment')->where('service_id',$service_id)->get();
      if(count($payment) > 0){
        $services[ $key ][ 'payment' ] = $payment;
      }
    }
    $services = json_decode( json_encode( $services ));
    return view('servicepayment.findpayment',compact('services'));
  }

  public function addfind_payment(Request $request){
    $parent_id = $request->parent_id;
    DB::table('find_payment')->where('parent_id',$parent_id )->delete();
    if($request->has('parent_id')){
      foreach ( $request->parent_id as $key => $payment ) {
        $service_id = $request->service_id[ $key ];
        $distributor_amount = $request->distributor_amount[ $key ];
        $retailer_amount = $request->retailer_amount[ $key ];
        $customer_amount = $request->customer_amount[ $key ];

          DB::table( 'find_payment' )->insert( [
            'parent_id'            => $payment,
            'service_id'           => $service_id,
            'distributor_amount'   => $distributor_amount,
            'retailer_amount'      => $retailer_amount,
            'customer_amount'      => $customer_amount,
          ] );
      }
    }
    return redirect('findpayment')->with('success' ,"Sevice Payment Updated Succesfully !");
  }

  public function rechargepayment($serviceid){
    $services = DB::table('operator')->where('id',$serviceid)->orderBy( 'id' , 'Asc' )->get();
    $services = json_decode( json_encode( $services ), true );
    foreach ( $services as $key => $service ) {
      $services[ $key ][ 'payment' ] = array();
      $service_id = $service[ 'id' ];

    //   print_r( $service_id );die();

      $payment = DB::table('recharge_payment')->where('service_id',$service_id)->get();
      if(count($payment) > 0){
        $services[ $key ][ 'payment' ] = $payment;
      }
    }
    $services = json_decode( json_encode( $services ));
    return view('servicepayment.rechargepayment',compact('services','serviceid'));
  }

  public function addrecharge_payment(Request $request){
    $parent_id = $request->parent_id;
    DB::table('recharge_payment')->where('parent_id',$parent_id )->delete();
    if($request->has('parent_id')){
      foreach ( $request->parent_id as $key => $payment ) {
        $service_id = $request->service_id[ $key ];
        $distributor_amount = $request->distributor_amount[ $key ];
        $retailer_amount = $request->retailer_amount[ $key ];
        $customer_amount = $request->customer_amount[ $key ];

          DB::table( 'recharge_payment' )->insert( [
            'parent_id'            => $payment,
            'service_id'           => $service_id,
            'distributor_amount'   => $distributor_amount,
            'retailer_amount'      => $retailer_amount,
            'customer_amount'      => $customer_amount,
          ] );
      }
    }
    return redirect('rechargepayment/'.$payment)->with('success' ,"Recharge Payment Updated Succesfully !");
  }

  public function panservicepayment(){
    $services = DB::table('panservice')->orderBy( 'id' , 'Asc' )->get();
    $services = json_decode( json_encode( $services ), true );
    foreach ( $services as $key => $service ) {
      $services[ $key ][ 'payment' ] = array();
      $service_id = $service[ 'id' ];

    //   print_r( $service_id );die();

      $payment = DB::table('panpayment')->where('service_id',$service_id)->get();
      if(count($payment) > 0){
        $services[ $key ][ 'payment' ] = $payment;
      }
    }
    $services = json_decode( json_encode( $services ));
    return view('servicepayment.panservicepayment',compact('services'));
  }

  public function addpan_payment(Request $request){
    $parent_id = $request->parent_id;
    DB::table('panpayment')->where('parent_id',$parent_id )->delete();
    if($request->has('parent_id')){
      foreach ( $request->parent_id as $key => $payment ) {
        $service_id = $request->service_id[ $key ];
        $distributor_amount = $request->distributor_amount[ $key ];
        $retailer_amount = $request->retailer_amount[ $key ];
        $customer_amount = $request->customer_amount[ $key ];

          DB::table( 'panpayment' )->insert( [
            'parent_id'            => $payment,
            'service_id'           => $service_id,
            'distributor_amount'   => $distributor_amount,
            'retailer_amount'      => $retailer_amount,
            'customer_amount'      => $customer_amount,
          ] );
      }
    }
    return redirect('panservicepayment')->with('success' ,"PanSevice Payment Updated Succesfully !");
  }

  public function coursepayment(){
    $services = DB::table('courses')->orderBy( 'id' , 'Asc' )->get();
    $services = json_decode( json_encode( $services ), true );
    foreach ( $services as $key => $service ) {
      $services[ $key ][ 'payment' ] = array();
      $service_id = $service[ 'id' ];

    //   print_r( $service_id );die();

      $payment = DB::table('coursepayment')->where('service_id',$service_id)->get();
      if(count($payment) > 0){
        $services[ $key ][ 'payment' ] = $payment;
      }
    }
    $services = json_decode( json_encode( $services ));
    return view('servicepayment.coursepayment',compact('services'));
  }

  public function addcourse_payment(Request $request){
    $parent_id = $request->parent_id;
    DB::table('coursepayment')->where('parent_id',$parent_id )->delete();
    if($request->has('parent_id')){
      foreach ( $request->parent_id as $key => $payment ) {
        $service_id = $request->service_id[ $key ];
        $distributor_amount = $request->distributor_amount[ $key ];
        $retailer_amount = $request->retailer_amount[ $key ];
        $customer_amount = $request->customer_amount[ $key ];

          DB::table( 'coursepayment' )->insert( [
            'parent_id'            => $payment,
            'service_id'           => $service_id,
            'distributor_amount'   => $distributor_amount,
            'retailer_amount'      => $retailer_amount,
            'customer_amount'      => $customer_amount,
          ] );
      }
    }
    return redirect('coursepayment')->with('success' ,"Course Payment Updated Succesfully !");
  }

}
