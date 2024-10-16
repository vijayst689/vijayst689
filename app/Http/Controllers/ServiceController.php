<?php

namespace App\Http\Controllers;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
  }

  public function service()
  {
    return view('services.service');
}

public function subservice( $id )
{
    $service = DB::table('services')->where('parent_id',$id)->orderBy('id', 'Asc')->get();
    $getservicename = DB::table('services')->where('id',$id)->first();
    $servicename = "";
    if($getservicename){
        $servicename = $getservicename->service_name;
    }
    return view('services.subservice',compact( 'servicename','id','service' ));
}

public function viewservice()
{
    $allservice = DB::table('services')->where('parent_id',0)->orderBy( 'id' , 'Asc' )->get();
    return view('services.viewservice',compact('allservice'));
}

public function addservice(Request $request)
{

    $saveservice = DB::table('services')->insert([
      'service_name'  => $request->service_name,
      'status'        => 'Active'
  ]);

    return redirect( "/viewservice" )->with('success', 'Service Add Successfully ... !');
}

public function updateservice( Request $request ) {
    DB::table( 'services' )->where('id', $request->service_id)->update( [
        'service_name'  => $request->service_name,
        'status'        => $request->status,
    ] );

    return redirect()->back()->with( 'success', 'Service Updated Successfully' );
}

public function dropservice( $id ){

    $dropservice = DB::table('services')->where( 'id', $id )->delete();
    return redirect()->back()->with('success', 'Service Deleted Successfully ... !');
}

public function dropsubservice( $id ){

    $dropsubservice = DB::table('services')->where( 'id', $id )->delete();
    return redirect()->back()->with('success', 'SubService Deleted Successfully ... !');
}

public function addsubservice( Request $request ) {
    DB::table( 'services' )->insert( [
        'parent_id'  => $request->service_id,
        'service_name'  => $request->service_name,
        'amount'        => $request->amount,
        'status' => 'Active',
    ] );

    return redirect()->back()->with( 'success', 'SubService Added Successfully' );
}

public function updatesubservice( Request $request ) {
    DB::table( 'services' )->where('id', $request->service_id)->update( [
        'service_name'  => $request->service_name,
        'amount'        => $request->amount,
        'status'        => $request->status,
    ] );

    return redirect()->back()->with( 'success', 'SubService Updated Successfully' );
}

public function applyservice($customerid) {
   $services = DB::table('services')->where('parent_id',0)->orderBy( 'id' , 'Asc' )->get();
   $customers = DB::table('users')->where('id',$customerid)->get();
   $customers = json_decode( json_encode( $customers ), true );
    foreach ( $customers as $key => $customer ) {
        $customers[ $key ][ 'document' ] = array();
         $customerid = $customer[ 'id' ];
         $customer_document = DB::table('cus_document')->where('customer_id',$customerid)->get();
         if(count($customer_document) > 0){
            $customers[ $key ][ 'document' ] = $customer_document;
         }
    }
    $customers = json_decode( json_encode( $customers ));

   return view('services.applyservice',compact( 'services','customers','customerid'));
}

public function get_subservice($parentid)
{
    $get_subservice = DB::table('services')->where('parent_id', $parentid)->orderBy('id', 'Asc')->get();
    return response()->json($get_subservice);
}


public function submit_applyservice( Request $request ) {
    $retailer_id = 0;
    $distributor_id = 0;
    $customer_id = 0;
    if(Auth::user()->user_type_id == 3){
        $user_id = Auth::user()->id;
    }elseif(Auth::user()->user_type_id == 4){
        $user_id = Auth::user()->id;
    }elseif(Auth::user()->user_type_id == 5){
        $user_id = $request->customerid;
    }
    $amount = explode('~' ,$request->serviceid);
    DB::table( 'applied_service' )->insert( [
        'service_id'        => $amount[0],
        'amount'            => $amount[1],
        'customer_id'       => $request->customerid,
        'retailer_id'       => $user_id,
        'distributor_id'    => $user_id,
    ] );

        $date = date( 'Y-m-d' );
        $time = date( 'H:i:s' );
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('$user_id','$user_id','2','$amount[1]','$ad_info', '$service_status','$time','$date','$user_id')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet + $amount[1] where id = 2";
        DB::update( DB::raw( $sql ) );
        $service_status = 'IN Payment';
        $ad_info = 'Service Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('$user_id','2','$user_id','$amount[1]','$ad_info', '$service_status','$time','$date','$user_id')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet - $amount[1] where id = $user_id";
        DB::update( DB::raw( $sql ) );

    return redirect()->back()->with( 'success', 'Service Applied Successfully' );
}

public function application() {
    $userid = Auth::user()->id;
    if(Auth::user()->user_type_id == 2){
        $viewservice = DB::table('applied_service')->select('applied_service.*', 'services.service_name')
      ->Join('services', 'services.id', '=', 'applied_service.service_id')
      ->orderBy('applied_service.id', 'Desc')->get();
    }else{
        $viewservice = DB::table('applied_service')->select('applied_service.*', 'services.service_name')
      ->Join('services', 'services.id', '=', 'applied_service.service_id')->where(function ($query) use ($userid) {
                $query->where('applied_service.retailer_id', '=' , $userid)
                ->orWhere('applied_service.distributor_id', '=', $userid)
                ->orWhere('applied_service.customer_id', '=', $userid);
            })
      ->orderBy('applied_service.id', 'Desc')->get();
    }
    

    return view('services.application',compact( 'viewservice'));
}

public function viewapplication($serviceid) {
    $viewservice = DB::table('applied_service')->select('applied_service.*', 'services.service_name','users.name','users.phone','users.aadhaar_no')
      ->Join('services', 'services.id', '=', 'applied_service.service_id')
      ->Join('users', 'users.id', '=', 'applied_service.customer_id')
      ->where('applied_service.id',$serviceid)
      ->orderBy('applied_service.id', 'Desc')->get();
       $servicename = "";
      if(count($viewservice) > 0){
        $servicename = $viewservice[0]->service_name;
      }
      $viewservice = json_decode( json_encode( $viewservice ), true );
     
    foreach ( $viewservice as $key => $service ) {
        $viewservice[ $key ][ 'document' ] = array();
         $customerid = $service[ 'customer_id' ];
         $customer_document = DB::table('cus_document')->where('customer_id',$customerid)->get(); 
         if(count($customer_document) > 0){
            $viewservice[ $key ][ 'document' ] = $customer_document;
         }
    }
    $viewservice = json_decode( json_encode( $viewservice ));

    return view('services.viewapplication',compact( 'viewservice','servicename'));
}

}
