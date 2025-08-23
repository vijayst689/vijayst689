<?php

namespace App\Http\Controllers;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
 public function __construct()
  {
    $this->middleware(function ($request, $next) {
            $this->restrictIfNotActivated();
            return $next($request);
        });
    $this->middleware('auth');
  }
  
    public function userpermission($userid){
  $userId = Auth::user()->id;

 
  if (Auth::user()->user_type_id == 1 || Auth::user()->user_type_id == 2) {
    $services = DB::table( 'services' )->where('parent_id',0)->where('id','!=',6)->where('status','Active')->orderBy( 'id', 'Asc' )->get();
  }else{
  $userPermissionServices = DB::table('user_permission')
  ->where('user_id', $userId)
  ->where('parent_id', 3)
  ->pluck('service_id');

  $adminPermissionServices = DB::table('user_permission')
  ->where('user_id', 2)
  ->where('parent_id', 3)
  ->pluck('service_id');

  $finalServiceIds = $userPermissionServices
  ->merge($adminPermissionServices)
  ->unique();

    $services = DB::table( 'services' )->where('parent_id',0)->where('id','!=',6)->whereIn('id', $finalServiceIds)->where('status','Active')->orderBy( 'id', 'Asc' )->get();
  }

  $services = json_decode( json_encode( $services ), true );
  foreach ( $services as $key => $service ) {
    $service_id = $service['id'];
    $payment = DB::table('useractivation')->where('service_id',$service_id)->where('parent_id',3)->first();
    $amount = 0;
    if($payment){
      if(Auth::user()->user_type_id == 2){
        $amount = $payment->admin_amount;
      }elseif(Auth::user()->user_type_id == 3){
        $amount = $payment->distributor_amount;
      }elseif(Auth::user()->user_type_id == 4){
        $amount = $payment->retailer_amount;
      }
    }
    $services[ $key ][ 'amount' ] = $amount;
  }
  $services = json_decode( json_encode( $services ) );

   if (Auth::user()->user_type_id == 1 || Auth::user()->user_type_id == 2) {
    $findservices = DB::table( 'find_services' )->where('status','Active')->orderBy( 'id', 'Asc' )->get();
  }else{
  $userPermissionServices = DB::table('user_permission')
  ->where('user_id', $userId)
  ->where('parent_id', 1)
  ->pluck('service_id');

  $adminPermissionServices = DB::table('user_permission')
  ->where('user_id', 2)
  ->where('parent_id', 1)
  ->pluck('service_id');

  $finalServiceIds = $userPermissionServices
  ->merge($adminPermissionServices)
  ->unique();

    $findservices = DB::table( 'find_services' )->whereIn('id', $finalServiceIds)->where('status','Active')->orderBy( 'id', 'Asc' )->get();
  }

  $findservices = json_decode( json_encode( $findservices ), true );
  foreach ( $findservices as $key => $service ) {
    $service_id = $service['id'];
    $payment = DB::table('useractivation')->where('service_id',$service_id)->where('parent_id',1)->first();
    $amount = 0;
    if($payment){
      if(Auth::user()->user_type_id == 2){
        $amount = $payment->admin_amount;
      }elseif(Auth::user()->user_type_id == 3){
        $amount = $payment->distributor_amount;
      }elseif(Auth::user()->user_type_id == 4){
        $amount = $payment->retailer_amount;
      }
    }
    $findservices[ $key ][ 'amount' ] = $amount;
  }
  $findservices = json_decode( json_encode( $findservices ) );

  if (Auth::user()->user_type_id == 1 || Auth::user()->user_type_id == 2) {
    $utilityservices = DB::table( 'utility_services' )->where('status','Active')->orderBy( 'id', 'Asc' )->get();
  }else{
  $userPermissionServices = DB::table('user_permission')
  ->where('user_id', $userId)
  ->where('parent_id', 2)
  ->pluck('service_id');

  $adminPermissionServices = DB::table('user_permission')
  ->where('user_id', 2)
  ->where('parent_id', 2)
  ->pluck('service_id');

  $finalServiceIds = $userPermissionServices
  ->merge($adminPermissionServices)
  ->unique();
    $utilityservices = DB::table( 'utility_services' )->whereIn('id', $finalServiceIds)->where('status','Active')->orderBy( 'id', 'Asc' )->get();
  }
  
  $utilityservices = json_decode( json_encode( $utilityservices ), true );
  foreach ( $utilityservices as $key => $service ) {
    $service_id = $service['id'];
    $payment = DB::table('useractivation')->where('service_id',$service_id)->where('parent_id',2)->first();
    $amount = 0;
    if($payment){
      if(Auth::user()->user_type_id == 2){
        $amount = $payment->admin_amount;
      }elseif(Auth::user()->user_type_id == 3){
        $amount = $payment->distributor_amount;
      }elseif(Auth::user()->user_type_id == 4){
        $amount = $payment->retailer_amount;
      }
    }
    $utilityservices[ $key ][ 'amount' ] = $amount;
  }
  $utilityservices = json_decode( json_encode( $utilityservices ) );

  if (Auth::user()->user_type_id == 1 || Auth::user()->user_type_id == 2) {
    $panservices = DB::table( 'panservice' )->where('status','Active')->orderBy( 'id', 'Asc' )->get();
  }else{
  $userPermissionServices = DB::table('user_permission')
  ->where('user_id', $userId)
  ->where('parent_id', 2)
  ->pluck('service_id');

  $adminPermissionServices = DB::table('user_permission')
  ->where('user_id', 2)
  ->where('parent_id', 4)
  ->pluck('service_id');

  $finalServiceIds = $userPermissionServices
  ->merge($adminPermissionServices)
  ->unique();
    $panservices = DB::table( 'panservice' )->whereIn('id', $finalServiceIds)->where('status','Active')->orderBy( 'id', 'Asc' )->get();
  }
  
  
  $panservices = json_decode( json_encode( $panservices ), true );
  foreach ( $panservices as $key => $service ) {
    $service_id = $service['id'];
    $payment = DB::table('useractivation')->where('service_id',$service_id)->where('parent_id',4)->first();
    $amount = 0;
    if($payment){
      if(Auth::user()->user_type_id == 2){
        $amount = $payment->admin_amount;
      }elseif(Auth::user()->user_type_id == 3){
        $amount = $payment->distributor_amount;
      }elseif(Auth::user()->user_type_id == 4){
        $amount = $payment->retailer_amount;
      }
    }
    $panservices[ $key ][ 'amount' ] = $amount;
  }
  $panservices = json_decode( json_encode( $panservices ) );

  $checkpermission1 = DB::table( 'user_permission' )->where('user_id',$userid)->where('parent_id',1)->get();
  $checkpermission2 = DB::table( 'user_permission' )->where('user_id',$userid)->where('parent_id',2)->get();
  $checkpermission3 = DB::table( 'user_permission' )->where('user_id',$userid)->where('parent_id',3)->get();
  $checkpermission4 = DB::table( 'user_permission' )->where('user_id',$userid)->where('parent_id',4)->get();
  return view( 'permission.userpermission',compact('userid','services','findservices','utilityservices','checkpermission1','checkpermission2','checkpermission3','checkpermission4','panservices'));
}
    //1 - Utility
    //2 - PDF
    //3 - Services
public function savepermission(Request $request){
  $data = $request->only([
    'service_id',
    'user_id',
    'parent_id',
    'activation_amount',
  ]);

  $user = Auth::user();
  $userId = $user->id;
    $userType = $user->user_type_id; // 2 = Admin, 3 = Distributor, 4 = Retailer


    // Insert service permission record
    DB::table('user_permission')->insert([
      'user_id'           => $data['user_id'],
      'service_id'        => $data['service_id'],
      'parent_id'         => $data['parent_id'] ?? null,
      'date'        => date("y-m-d H:i:s"),
    ]);
    $service_id = $data['service_id'];
    $parent_id = $data['parent_id'];
    switch ($parent_id) {
      case 1:
      $services = DB::table('find_services')->where('id', $service_id)->first();
      break;
      case 2:
      $services = DB::table('utility_services')->where('id', $service_id)->first();
      break;
      case 3:
      $services = DB::table('services')->where('id', $service_id)->first();
      break;
      case 4:
      $services = DB::table('panservice')->where('id', $service_id)->first();
      default:
        $services = collect(); // empty collection
        break;
      }
      $servicename = $services->name ?? $services->service_name;
      $Activationuserid = $data['user_id'];
      if ($userType == 2) {
        $activationpayment = $data['activation_amount'];
        $date = date( 'Y-m-d' );
        $time = date( 'H:i:s' );
        $service_status = 'Out Payment';
        $ad_info = 'Activation Payment (' . $servicename . ' - ' . $Activationuserid . ')';
        $getrawallet = DB::table( 'users' )->select('rawallet')->where('id',1)->first();
        $rawallet = 0;
        if($getrawallet){
          $balance1 = $getrawallet->rawallet;
        }

        $getrawallet1 = DB::table( 'users' )->select('rawallet')->where('id',2)->first();
        $rawallet1 = 0;
        if($getrawallet1){
          $balance2 = $getrawallet1->rawallet;
        }
        $newbalance2 = $balance1 + $activationpayment;
        $newbalance3 = $balance2 - $activationpayment;
        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$activationpayment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set rawallet = rawallet + $activationpayment where id = 1";
        DB::update( DB::raw( $sql ) );
        $service_status = 'IN Payment';
        $ad_info = 'Activation Payment (' . $servicename . ' - ' . $Activationuserid . ')';
        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$activationpayment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set rawallet = rawallet - $activationpayment where id = 2";
        DB::update( DB::raw( $sql ) );
      } elseif ($userType == 3 || $userType == 4) {

        $activationpayment = $data['activation_amount'];
        $date = date( 'Y-m-d' );
        $time = date( 'H:i:s' );
        $service_status = 'Out Payment';
        $ad_info = 'Activation Payment (' . $servicename . ' - ' . $Activationuserid . ')';
        $newbalance1 = Auth::user()->wallet - $activationpayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('1','$userId','1','$activationpayment','$ad_info', '$service_status','$time','$date','$userId','$newbalance1')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet - $activationpayment where id = $userId";
        DB::update( DB::raw( $sql ) );

        
        $getwallet = DB::table( 'users' )->select('wallet')->where('id',1)->first();
        $balance = 0;
        if($getwallet){
          $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $activationpayment;

        $sql = "update users set wallet = wallet + $activationpayment where id = 2";
        DB::update( DB::raw( $sql ) );
        $service_status = 'IN Payment';
        $ad_info = 'Activation Payment (' . $servicename . ' - ' . $Activationuserid . ')';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$userId','2','$userId','$activationpayment','$ad_info', '$service_status','$time','$date','$userId','$newbalance')";
        DB::insert( DB::raw( $sql ) );


      }
      return response()->json(['success' => true, 'message' => 'Service activated and payment logged.']);
    }

    public function nalavariyam_permission($userid){
        $districts = DB::table( 'nalavariyam_district' )->orderBy('id','Asc')->get();
        return view( 'permission.nalavariyam_permission',compact('districts','userid'));
    }
}
