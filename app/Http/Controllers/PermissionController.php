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
    $this->middleware('auth');
  }

    public function userpermission($userid){
          $services = DB::table( 'services' )->where('parent_id',0)->where('status','Active')->where('id','!=',6)->orderBy( 'id', 'Asc' )->get();
          $findservices = DB::table( 'find_services' )->where('status','Active')->orderBy( 'id', 'Asc' )->get();
          $utilityservices = DB::table( 'utility_services' )->where('status','Active')->orderBy( 'id', 'Asc' )->get();
          $panservices = DB::table( 'panservice' )->where('status','Active')->orderBy( 'id', 'Asc' )->get();

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
      $userid = $request->user_id;
      $services = DB::table( 'user_permission' )->where('user_id',$userid)->delete();
      foreach(request()->service_id as $serviceid) {
        $val = explode('_',$serviceid);
        $service_id = $val[0];
        $parent_id = $val[1];

        DB::table('user_permission')->insert([
          'user_id'          => $request->user_id,
          'parent_id'    => $parent_id,
          'service_id'      => $service_id,
          'date'        => date("y-m-d H:i:s")
        ]);
      }

  if(Auth::user()->user_type_id == 3 ||  Auth::user()->user_type_id == 4){
    $auth_userid = Auth::user()->id;
    $activationpayment = $request->activation_charge;
    $date = date( 'Y-m-d' );
        $time = date( 'H:i:s' );
        $service_status = 'Out Payment';
        $ad_info = 'Activation Payment';
        $getwallet = DB::table( 'users' )->select('wallet')->where('id',2)->first();
        $balance = 0;
        if($getwallet){
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $activationpayment;
        $newbalance1 = Auth::user()->wallet - $activationpayment;

           $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$auth_userid','$auth_userid','2','$activationpayment','$ad_info', '$service_status','$time','$date','$userid','$newbalance1')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet + $activationpayment where id = 2";
        DB::update( DB::raw( $sql ) );
        $service_status = 'IN Payment';
        $ad_info = 'Activation Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$auth_userid','2','$auth_userid','$activationpayment','$ad_info', '$service_status','$time','$date','$userid','$newbalance')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet - $activationpayment where id = $auth_userid";
        DB::update( DB::raw( $sql ) );
        }
      return redirect('/userpermission/'.$userid)->with('success','Permission Updated Successfully');
    }

public function get_activationamount($userid,$activation_userid,$serviceid){
    $response = array();
    $val = explode('_',$serviceid);
    $service_id = $val[0];
    $parent_id = $val[1];

     $checkuser = DB::table('users')->where('id',$userid)->first();
     $usertype = 0;
     if($checkuser){
       $usertype = $checkuser->user_type_id;
       $user_refferal_id = $checkuser->refferal_id;
     }

    $checkactivation_user = DB::table('users')->where('id',$activation_userid)->first();
     $activation_usertype = 0;
     if($checkactivation_user){
       $activation_usertype = $checkactivation_user->user_type_id;
       $activationuser_refferal_id = $checkactivation_user->refferal_id;
     }
     $activation_amount = 0;
     $referral_amount = 0;
     $superadmin_amount = 0;
     if($usertype == 2){

      $payment = DB::table('useractivation')->where('service_id',$service_id)->where('parent_id',$parent_id)->first();
      if($payment){
        if($activation_usertype == 3){
          $tot_amount = $payment->distributor_amount;
          if($service_id == 6 && $parent_id == 3){
            $tot_amount = 1;
          }
          $activation_amount = $tot_amount;
        }elseif($activation_usertype == 4){
          $tot_amount = $payment->retailer_amount;
          if($service_id == 6 && $parent_id == 3){
            $tot_amount = 1;
          }
          $activation_amount = $tot_amount;
        }


      }

     }elseif($usertype == 3){

      $payment = DB::table('useractivation')->where('service_id',$service_id)->where('parent_id',$parent_id)->first();
      if($payment){
        if($activation_usertype == 3){
          $tot_amount = $payment->distributor_amount;
          if($service_id == 6 && $parent_id == 3){
            $tot_amount = 1;
          }
          $activation_amount = $tot_amount;
        }elseif($activation_usertype == 4){
          $tot_amount = $payment->retailer_amount;
          if($service_id == 6 && $parent_id == 3){
            $tot_amount = 1;
          }
          $activation_amount = $tot_amount / 2;

        }


      }

     }elseif($usertype == 4){

      $payment = DB::table('useractivation')->where('service_id',$service_id)->where('parent_id',$parent_id)->first();
      if($payment){
         if($activation_usertype == 4){
          $tot_amount = $payment->retailer_amount;
          if($service_id == 6 && $parent_id == 3){
            $tot_amount = 1;
          }
          $activation_amount = $tot_amount;

        }
     }

   }

     $response['activation_amount'] = $activation_amount;

     return response()->json($response);
}

    public function nalavariyam_permission($userid){
        $districts = DB::table( 'nalavariyam_district' )->orderBy('id','Asc')->get();
        return view( 'permission.nalavariyam_permission',compact('districts','userid'));
    }
}
