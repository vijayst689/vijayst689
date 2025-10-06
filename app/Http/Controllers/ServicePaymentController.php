<?php

namespace App\Http\Controllers;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServicePaymentController extends Controller
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
  
  public function servicepayment($serviceid){
    $services = DB::table('services')->where('status', 'Active')->where('parent_id',$serviceid )->orderBy( 'id' , 'Asc' )->get();
    $services = json_decode( json_encode( $services ), true );
    foreach ( $services as $key => $service ) {
      $services[ $key ][ 'payment' ] = array();
      $service_id = $service[ 'id' ];
      $payment = DB::table('service_payment')->where('service_id',$service_id)->get();
      if(count($payment) > 0){
        $services[ $key ][ 'payment' ] = $payment;
      }
       $admin_amount = 0;
       $payment1 = DB::table('service_payment')->where('service_id',$service_id)->get();
        $services[ $key ][ 'admin_amount' ] = 0;
       if(count($payment1) > 0){
        $services[ $key ][ 'admin_amount' ] = $payment1[0]->admin_amount;
      }
    }
    $services = json_decode( json_encode( $services ));
    return view('servicepayment.servicepayment',compact('services','serviceid'));
  }

  public function addservice_payment(Request $request){
     if ($request->has('service_id')) {
    foreach ($request->service_id as $key => $payment) {
        $name = 'check_' . $payment;
        $pre = $request[$name] ?? 0;

        $coordinator_permission = $pre == '1' ? 1 : 0;
        $parent_id = $request->parent_id[$key];
        $ramjiservice_id = $request->ramjiservice_id[$key];
        $distributor_amount = $request->distributor_amount[$key];
        $retailer_amount = $request->retailer_amount[$key];
        $customer_amount = $request->customer_amount[$key];
        $admin_amount = $request->admin_amount[$key];

        DB::table('service_payment')->updateOrInsert(
            [
                'parent_id'  => $parent_id,
                'service_id' => $payment, // condition to find existing
            ],
            [
                'ramjiservice_id'       => $ramjiservice_id,
                'admin_amount'          => $admin_amount,
                'distributor_amount'    => $distributor_amount,
                'retailer_amount'       => $retailer_amount,
                'customer_amount'       => $customer_amount,
                'coordinator_permission'=> $coordinator_permission,
            ]
        );
    }
    }
    return redirect('servicepayment/'.$parent_id);
  }

  public function smartcardpayment($serviceid){
    $services = DB::table('services')->where('status', 'Active')->where('parent_id', $serviceid )->orderBy( 'id' , 'Asc' )->get();
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
    $services = DB::table('find_services')->where('status', 'Active')->orderBy( 'id' , 'Asc' )->get();
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
     if ($request->has('parent_id')) {
    foreach ($request->parent_id as $key => $payment) {
        $service_id         = $request->service_id[$key];
        $ramjiservice_id         = $request->ramjiservice_id[$key];
        $distributor_amount = $request->distributor_amount[$key];
        $retailer_amount    = $request->retailer_amount[$key];
        $customer_amount    = $request->customer_amount[$key];

        DB::table('find_payment')->updateOrInsert(
            [
                'parent_id'  => $payment,
                'service_id' => $service_id,
            ],
            [   
                'ramjiservice_id'       => $ramjiservice_id,
                'distributor_amount' => $distributor_amount,
                'retailer_amount'    => $retailer_amount,
                'customer_amount'    => $customer_amount,
            ]
        );
    }
    }
    return redirect('findpayment')->with('success' ,"Sevice Payment Updated Succesfully !");
  }

  public function rechargepayment($serviceid){
    $services = DB::table('operator')->where('status', 'Active')->where('service_type',$serviceid)->orderBy( 'id' , 'Asc' )->get();
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
    $services = DB::table('panservice')->where('status', 'Active')->orderBy( 'id' , 'Asc' )->get();
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
  if ($request->has('parent_id')) {
    foreach ($request->parent_id as $key => $payment) {
        $service_id         = $request->service_id[$key];
        $ramjiservice_id         = $request->ramjiservice_id[$key];
        $distributor_amount = $request->distributor_amount[$key];
        $retailer_amount    = $request->retailer_amount[$key];
        $customer_amount    = $request->customer_amount[$key];

        DB::table('panpayment')->updateOrInsert(
            [
                'parent_id'  => $payment,
                'service_id' => $service_id,
            ],
            [
                'ramjiservice_id'       => $ramjiservice_id,
                'distributor_amount' => $distributor_amount,
                'retailer_amount'    => $retailer_amount,
                'customer_amount'    => $customer_amount,
            ]
        );
    }
    }
    return redirect('panservicepayment')->with('success' ,"PanSevice Payment Updated Succesfully !");
  }

  public function coursepayment(){
    $services = DB::table('courses')->where('status', 'Active')->orderBy( 'id' , 'Asc' )->get();
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
        $admin_amount = $request->admin_amount[ $key ];
        $retailer_amount = $request->retailer_amount[ $key ];
        $customer_amount = $request->customer_amount[ $key ];

          DB::table( 'coursepayment' )->insert( [
            'parent_id'            => $payment,
            'service_id'           => $service_id,
            'admin_amount'         => $admin_amount,
            'distributor_amount'   => $distributor_amount,
            'retailer_amount'      => $retailer_amount,
            'customer_amount'      => $customer_amount,
          ] );
      }
    }
    return redirect('coursepayment')->with('success' ,"Course Payment Updated Succesfully !");
  }

  public function canpayment(){
    $services = DB::table('canservice')->where('status' , 'Active')->orderBy( 'id' , 'Asc' )->get();
    $services = json_decode( json_encode( $services ), true );
    foreach ( $services as $key => $service ) {
      $services[ $key ][ 'payment' ] = array();
      $service_id = $service[ 'id' ];

    //   print_r( $service_id );die();

      $payment = DB::table('can_payment')->where('service_id',$service_id)->get();
      if(count($payment) > 0){
        $services[ $key ][ 'payment' ] = $payment;
      }
    }
    $services = json_decode( json_encode( $services ));
    return view('servicepayment.canpayment',compact('services'));
  }

  public function addcan_payment(Request $request){
    $parent_id = $request->parent_id;
    DB::table('can_payment')->where('parent_id',$parent_id )->delete();
    if($request->has('parent_id')){
      foreach ( $request->parent_id as $key => $payment ) {
        $service_id = $request->service_id[ $key ];
        $distributor_amount = $request->distributor_amount[ $key ];
        $retailer_amount = $request->retailer_amount[ $key ];
        $customer_amount = $request->customer_amount[ $key ];

          DB::table( 'can_payment' )->insert( [
            'parent_id'            => $payment,
            'service_id'           => $service_id,
            'distributor_amount'   => $distributor_amount,
            'retailer_amount'      => $retailer_amount,
            'customer_amount'      => $customer_amount,
          ] );
      }
    }
    return redirect('canpayment')->with('success' ,"Can Payment Updated Succesfully !");
  }

  public function utislpanpayment(){
    $services = DB::table('utislpanservice')->where('status' , 'Active')->orderBy( 'id' , 'Asc' )->get();
    $services = json_decode( json_encode( $services ), true );
    foreach ( $services as $key => $service ) {
      $services[ $key ][ 'payment' ] = array();
      $service_id = $service[ 'id' ];

    //   print_r( $service_id );die();

      $payment = DB::table('utislpanpayment')->where('service_id',$service_id)->get();
      if(count($payment) > 0){
        $services[ $key ][ 'payment' ] = $payment;
      }
    }
    $services = json_decode( json_encode( $services ));
    return view('servicepayment.utislpanpayment',compact('services'));
  }

  public function addutisl_payment(Request $request){
    $parent_id = $request->parent_id;
    DB::table('utislpanpayment')->where('parent_id',$parent_id )->delete();
    if($request->has('parent_id')){
      foreach ( $request->parent_id as $key => $payment ) {
        $service_id = $request->service_id[ $key ];
        $distributor_amount = $request->distributor_amount[ $key ];
        $retailer_amount = $request->retailer_amount[ $key ];
        $customer_amount = $request->customer_amount[ $key ];

          DB::table( 'utislpanpayment' )->insert( [
            'parent_id'            => $payment,
            'service_id'           => $service_id,
            'distributor_amount'   => $distributor_amount,
            'retailer_amount'      => $retailer_amount,
            'customer_amount'      => $customer_amount,
          ] );
      }
    }
    return redirect('utislpanpayment')->with('success' ,"UTISL Payment Updated Succesfully !");
  }

  public function useractivation($activation_id){

      //$payment = DB::table('useractivation')->get();
       if( $activation_id == 3 ){
        $services = DB::table('services')->select('services.*','services.service_name as name')->where('parent_id',0)->where('status','Active')->where('id','!=',6)->orderBy( 'id' , 'Asc' )->get();
        foreach ( $services as $key => $service ) {
          $service->activation_id = 3;
        }
        }elseif( $activation_id == 2 ){
        $services = DB::table('utility_services')->where('status','Active')->orderBy( 'id' , 'Asc' )->get();
        foreach ( $services as $key => $service ) {
            $service->activation_id = 2;
        }
        }elseif( $activation_id == 1 ){
        $services = DB::table('find_services')->where('status','Active')->orderBy( 'id' , 'Asc' )->get();
        foreach ( $services as $key => $service ) {
            $service->activation_id = 1;
        }
        }elseif( $activation_id == 4 ){
        $services = DB::table('panservice')->where('status','Active')->orderBy( 'id' , 'Asc' )->get();
        foreach ( $services as $key => $service ) {
            $service->activation_id = 4;
        }
        }

        $services = json_decode( json_encode( $services ), true );
    //dd($services);
    foreach ( $services as $key => $service ) {
      $service_id = $service[ 'id' ];
      $activation_id = $service[ 'activation_id' ];
      $services[ $key ][ 'payment' ] = array();

      $payment = DB::table('useractivation')->where('service_id',$service_id)->where('parent_id',$activation_id)->get();
      if(count($payment) > 0){
        $services[ $key ][ 'payment' ] = $payment;
      }
    }
    $services = json_decode( json_encode( $services ));

         //dd($services);
       return view( 'servicepayment.useractivation',compact('activation_id','services'));
}

 public function adduser_activation(Request $request){
    //dd($request->all());
    $parent_id = $request->parent_id;
    if (count(array_unique($parent_id)) === 1 && $parent_id[0] == 3) {
     DB::table('useractivation')->where('parent_id',$parent_id )->where('service_id','!=',6)->delete();
    }else{
      DB::table('useractivation')->where('parent_id',$parent_id )->delete();
    }
    if($request->has('parent_id')){
      foreach ( $request->parent_id as $key => $payment ) {
        $user_id = $request->user_id[ $key ];
        $service_id = $request->service_id[ $key ];
        $distributor_amount = $request->distributor_amount[ $key ];
        $retailer_amount = $request->retailer_amount[ $key ];
        $admin_amount = $request->admin_amount[ $key ];

          DB::table( 'useractivation' )->insert( [
            'parent_id'            => $payment,
            'user_id'              => $user_id,
            'service_id'              => $service_id,
            'distributor_amount'   => $distributor_amount,
            'retailer_amount'      => $retailer_amount,
            'admin_amount'         => $admin_amount,

          ] );
      }
    }
    return redirect('useractivation/'.$payment)->with('success' ,"Payment Updated Succesfully !");
  }

   public function sitepayment(){
    $data = DB::table('sitepayment')->orderBy( 'payment_status' , 'Asc' )->get();
   
    return view('servicepayment.sitepayment',compact('data'));
  }

   public function save_sitepayment( Request $request ) {
    $status = 'Waiting';
    DB::table( 'sitepayment' )->where( 'id', $request->row_id )->update( [
      'paid_status'      =>  $status,
    ] );

    $insertid = $request->row_id;
    $payment_proof = '';
    if ( $request->payment_proof != null ) {
      $payment_proof = $insertid.'.'.$request->file( 'payment_proof' )->extension();
      $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'sitepayment_image' . DIRECTORY_SEPARATOR );
      move_uploaded_file( $_FILES[ 'payment_proof' ][ 'tmp_name' ], $filepath . $payment_proof );
    }
     DB::table( 'sitepayment' )->where( 'id', $insertid )->update( [
      'paid_image' => $payment_proof,
    ] );

    $getdata = DB::table( 'sitepayment' )->where('id',$insertid)->first();
    if($getdata){
     $site_paymentid = $getdata->site_paymentid;
     $website_id = $getdata->website_id;
     $url = url('/');
     $payment_proof = $url.'/upload/sitepayment_image/'.$payment_proof;
     $API_KEY = env( 'API_KEY', '' );
     $RAMJIPAY_URL = env( 'RAMJIPAY_URL', '' );
     $WEBSITE_INDEX = env( 'WEBSITE_INDEX', '' );
     $ch = curl_init();
    
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&payment_proof=$payment_proof&site_paymentid=$site_paymentid&website_id=$website_id&status=$status";
    
    //dd($post_data);
     $url1 = $RAMJIPAY_URL.'/api/sitepayment_approve';
  //echo $url1;die;
     curl_setopt( $ch, CURLOPT_URL, $url1 );
     curl_setopt( $ch, CURLOPT_POST, 1 );
     curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_data );
     curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
     $server_output = curl_exec( $ch );
     curl_close( $ch );
     $resdata = json_decode($server_output, true);
       }
    return redirect()->back()->with('success', 'Payments saved successfully!');

}
}
