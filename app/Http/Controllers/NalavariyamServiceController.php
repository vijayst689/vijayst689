<?php

namespace App\Http\Controllers;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class NalavariyamServiceController extends Controller
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

public function nalavariyam_services()
{
    $nalavariyam_service = DB::table( 'nalavariyam_service' )->orderBy( 'id', 'Asc' )->get();
    $district = DB::table( 'district' )->where( 'status', 'Active' )->orderBy( 'id', 'Asc' )->get();

    return view( 'nalavariyam/nalavariyam_service', compact( 'nalavariyam_service','district') );
}

public function addnalavariyam_service( Request $request ) {

    $from_date = "";
        $to_date = "";
        if ($request->has('from_date')) {
            $from_date = $request->from_date;
        }
        if ($request->has('to_date')) {
            $to_date = $request->to_date;
        }
        $adduser = DB::table('nalavariyam_service')->insert([
            'service_name' => $request->service_name,
            'service_payment' => $request->service_payment,
            'status' => 'Active',
            'from_date' => $from_date,
            'to_date' => $to_date,
            'servicetype' => $request->servicetype,

        ]);

        $last_insert_id = DB::getPdo()->lastInsertId();
        $fromimage = '';
        if ($request->from_image != null) {
            $fromimage = $last_insert_id . '.' . $request->file('from_image')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'fromimg' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['from_image']['tmp_name'], $filepath . $fromimage);
        }
        $addimg = DB::table('nalavariyam_service')->where('id', $last_insert_id)->update([
            'from_image' => $fromimage,

        ]);

        if ($request->has('dist_id')) {
            foreach ($request->input('dist_id') as $key => $type) {
                $name = 'check_' . $type;
                $pre = $request[$name];
                $pre = $pre == '2' ? 2 : 1;
                DB::table('service_details')->insert([
                    'service_id'       =>   $last_insert_id,
                    'district_id'       =>   $type,
                    'service_type'      =>   $pre
                ]);
            }
        }
        return redirect()->back()->with('success', 'Service Added Successfully ... !');
    }

public function editnalavariyam_service($id) {

    $nalavariyam_services = DB::table( 'nalavariyam_service' )->where( 'id', $id )->orderBy( 'id', 'Asc' )->get();
    $nalavariyam_services = json_decode( json_encode( $nalavariyam_services ), true );
    foreach ( $nalavariyam_services as $key => $service ) {
        $nalavariyam_services[ $key ][ 'nalavariyam_district' ] = array();
        $service_id = $service[ 'id' ];
        $sql = "select a.service_type,a.district_id,b.district_name from service_details a,nalavariyam_district b where a.district_id = b.id and a.service_id=$service_id order by a.id Asc";
        $result = DB::select( $sql );

        $nalavariyam_services[ $key ][ 'type' ] = $result;
    }
    $nalavariyam_services = json_decode( json_encode( $nalavariyam_services ));
//dd($viewservices);
    $district = DB::table( 'nalavariyam_district' )->where( 'status', 'Active' )->orderBy( 'id', 'Asc' )->get();

    return view( 'nalavariyam/editnalavariyam_service', compact( 'nalavariyam_services','district' ) );
}

public function updatenalavariyam_service( Request $request ) {
    $from_date = "";
    $to_date = "";
    if($request->has('from_date')){
        $from_date = $request->from_date;
    }
    if($request->has('to_date')){
        $to_date = $request->to_date;
    }
    $adduser = DB::table( 'nalavariyam_service' )->where( 'id', $request->service_id )->update( [
        'service_name' => $request->service_name,
        'service_payment' => $request->service_payment,
        'status' => $request->status,
        'from_date' => $from_date,
        'to_date' => $to_date,
        'servicetype' => $request->servicetype,
    ] );

    if ( $request->has( 'dist_id' ) ) {
        DB::table( 'service_details' )->where( 'service_id', $request->service_id )->delete();
        foreach ( $request->input( 'dist_id' ) as $key => $type ) {
            $name = 'check_'.$type;
            $pre = $request[ $name ];
            $pre = $pre == '2' ? 2 : 1;
            DB::table( 'service_details' )->insert( [
                'service_id'       =>   $request->service_id,
                'district_id'      =>   $type,
                'service_type'     =>   $pre
            ] );
        }
    }


    $service_id = $request->service_id;
    if ( $request->from_image != null ) {
        $fromimage = $service_id . '.' . $request->file( 'from_image' )->extension();
        $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'fromimg' . DIRECTORY_SEPARATOR );
        move_uploaded_file( $_FILES[ 'from_image' ][ 'tmp_name' ], $filepath . $fromimage );
    }
    if ( $request->from_image == '' ) {
        return redirect()->back()->with( 'success', 'Service Updated Successfully ... !' );
    } else {
        $addimg = DB::table( 'nalavariyam_service' )->where( 'id', $service_id )->update( [
            'from_image' => $fromimage,
        ] );
    }

    return redirect()->back()->with( 'success', 'Service Updated Successfully ... !' );
}

public function online_services($id)
{
    $dist_id = Auth::user()->nalavariyam_dist_id;
    $today = date( 'Y-m-d' );
    $user_type = Auth::user()->user_type_id;
    $balance =  Auth::user()->wallet;
     $login_id = Auth::user()->id;
    $customers = DB::table( 'nalavariyam_customer' )->where( 'id', $id )->first();
    if($customers){
        $cus_usertype_id = $customers->customer_user_type_id;
    }
    $sql = "select a.*,c.district_name from nalavariyam_service a,service_details b,nalavariyam_district c where b.service_id=a.id and b.district_id=c.id and b.service_type = '1' and a.status='Active' and c.id='$dist_id' and (('$today' >= from_date and '$today' <= to_date) or from_date is NULL)";
    $services = DB::select( DB::raw( $sql ) );
    $services = json_decode( json_encode( $services ), true );
    foreach ( $services as $key1 => $service ) {
        $service_id = $service["id"];
        $getusertype = DB::table( 'users' )->where( 'id', Auth::user()->id )->first();
        $nal_usertype = 0;
        if($getusertype){
            $nal_usertype = $getusertype->nalavariyam_usertype;
        }
        $form_payment = DB::table( 'nalavariyam_payment' )->where( 'service_id', $service_id )->first();
        if($form_payment){
            //$adminamount = $form_payment->admin_amount;
            if($nal_usertype == 3){
                $pay_amount =  $form_payment->distributor_amount;
            }elseif($nal_usertype == 4){
                $pay_amount =  $form_payment->retailer_amount;
            }elseif($user_type == 2){
                 $pay_amount =  $form_payment->admin_amount;
            }
        }
        $percentage = 50;
         $adminamount = ($pay_amount * $percentage) / 100;
         if(Auth::user()->user_type_id == 2){
            $services[ $key1 ][ 'admin_amount' ] = $pay_amount;
        }else{
            $services[ $key1 ][ 'admin_amount' ] = $adminamount;
        }


        if($cus_usertype_id == 2){
            $services[ $key1 ][ 'pay_amount' ] = 0;
        }else{
            $services[ $key1 ][ 'pay_amount' ] = $pay_amount;
        }

        $sql = "select * from nalavariyam_form where service_id = '$service_id' and customer_id='$id'";
        if($user_type != 1){
            $sql = $sql . " and log_id = $login_id";
        }
        $sql = $sql . " order by id desc limit 1";
        $result = DB::select( DB::raw( $sql ) );
        $service_status = '';
        $action = '';
        $output_image = '';
        if ( count( $result ) > 0 ) {
            $service_status = $result[ 0 ]->service_status;
            if ( $service_status == 'Paid' ) {
                $sql = "Select * from nalavariyam_form where service_id = '$service_id' and customer_id='$id' order by id desc limit 1 ";
                $result = DB::select( DB::raw( $sql ) );
                if ( count( $result ) > 0 ) {
                    if ( $result[ 0 ]->service_id == $service_id ) {
                        $action = 'Upload Form';
                    }
                } else {
                    $action = 'Pending';
                }

            } else if ( $service_status == 'Pending' ) {
                $sql = "Select * from nalavariyam_form where service_id = '$service_id' and customer_id='$id' order by id desc limit 1 ";
                $result = DB::select( DB::raw( $sql ) );
                if ( count( $result ) > 0 ) {
                    if ( $result[ 0 ]->service_id == $service_id ) {
                        $action = 'Waiting';
                    } else {
                        $action = 'Pay Now';
                    }
                } else {
                    $action = 'Pay Now';
                }
            } else if ( $service_status == 'Resubmit' ) {
                $sql = "Select * from nalavariyam_form where service_id = '$service_id' and customer_id='$id' order by id desc limit 1 ";
                $result = DB::select( DB::raw( $sql ) );
                if ( count( $result ) > 0 ) {
                    if ( $result[ 0 ]->service_id == $service_id ) {
                        $action = 'Resubmit Form';
                    } else {
                        $action = 'Pay Now';
                    }
                } else {
                    $action = 'Pay Now';
                }
            } else if ( $service_status == 'Completed' ) {
                $sql = "Select * from nalavariyam_form where service_id = '$service_id' and customer_id='$id' order by id desc limit 1 ";
                $result = DB::select( DB::raw( $sql ) );
                if ( count( $result ) > 0 ) {
                    if ( $result[ 0 ]->service_id == $service_id ) {
                        $output_image = $result[ 0 ]->from_image;
                        $action = 'Completed';
                    } else {
                        $action = 'Pay Now';
                    }
                } else {
                    $action = 'Pay Now';
                }

            }
        } else {
            $action = 'Pay Now';
        }
        $services[ $key1 ][ 'service_status' ] = $service_status;
        $services[ $key1 ][ 'action' ] = $action;
        $services[ $key1 ][ 'output_image' ] = $output_image;
    }
    $services = json_decode( json_encode( $services ) );
       //dd($services);
     $sql = "select a.*,c.district_name from nalavariyam_service a,service_details b,nalavariyam_district c where b.service_id=a.id and b.district_id=c.id and c.id= '$dist_id' and b.service_type = '2'";
        $bulkservice = DB::select(DB::raw($sql));

        $bulkservice = json_decode(json_encode($bulkservice), true);
        foreach ($bulkservice as $key => $service) {
            $used = 1;
            $service_id = $service["id"];
            $sql = "select * from bulk_service_usage where total > used and service_id=$service_id and user_id=$login_id";
            $unused = DB::select($sql);
            if (count($unused) > 0) {
                $used = 0;
            }

            $service_id = $service["id"];
            $getusertype = DB::table('users')->where('id', Auth::user()->id)->first();
            $nal_usertype = 0;
            if ($getusertype) {
                $nal_usertype = $getusertype->nalavariyam_usertype;
            }
            $form_payment = DB::table('nalavariyam_payment')->where('service_id', $service_id)->first();
            if ($form_payment) {
                //$adminamount = $form_payment->admin_amount;
                if ($nal_usertype == 3) {
                    $pay_amount =  $form_payment->distributor_amount;
                } elseif ($nal_usertype == 4) {
                    $pay_amount =  $form_payment->retailer_amount;
                } elseif ($user_type == 2) {
                    $pay_amount =  $form_payment->admin_amount;
                }
            }
            $percentage = 50;
            $adminamount = ($pay_amount * $percentage) / 100;
            if (Auth::user()->user_type_id == 2) {
                $bulkservice[$key]['admin_amount'] = $pay_amount;
            } else {
                $bulkservice[$key]['admin_amount'] = $adminamount;
            }


            if ($cus_usertype_id == 2) {
                $bulkservice[$key]['pay_amount'] = 0;
            } else {
                $bulkservice[$key]['pay_amount'] = $pay_amount;
            }


            $bulkservice[$key]["pay_amount"] = $pay_amount;
            $bulkservice[$key]["used"] = $used;
        }
        $bulkservice = json_decode(json_encode($bulkservice));
        // dd($bulkservice);
        $rabalance = DB::table('users')->select('nalavariyamwallet')->where('id', 2)->first();
        $nalavariyamcustomer = DB::table('nalavariyam_customer')->where('refferal', Auth::user()->id)->get();
        return view('nalavariyam/online_services', compact('services', 'balance', 'customers', 'rabalance', 'bulkservice', 'nalavariyamcustomer'));
    }

public function nalavariyam_servicepayment( Request $request ) {
    $service_id = $request->service_id;
    $customer_id = $request->customer_id;
    $customer_user_type_id = $request->customer_user_type_id;
    $amount = $request->pay_amount;
    $admin_amount = $request->admin_amount;
    $log_id = Auth::user()->id;
    $dist_id  = Auth::user()->nalavariyam_dist_id ;
    $taluk_id = Auth::user()->nalavariyam_taluk_id ?? 0;
    $user_type_id = Auth::user()->nalavariyam_usertype ?? 0;
    $paydate = date( 'Y-m-d' );
    $service_status = 'Paid';
    $time = date( 'H:i:s' );
    $sql = "insert into nalavariyam_form (amount,customer_id,service_id,service_status,log_id,dist_id,taluk_id,user_type_id,date,time) values ('$amount','$customer_id','$service_id','$service_status','$log_id','$dist_id','$taluk_id','$user_type_id','$paydate','$time')";
    DB::insert( DB::raw( $sql ) );

    $getservicename = DB::table( 'nalavariyam_service' )->select('service_name')->where('id',$service_id)->first();
    $servicename = "";
    if($getservicename){
      $servicename = $getservicename->service_name;
  }
  if(Auth::user()->user_type_id != 2){
  $date = date( 'Y-m-d' );
  $time = date( 'H:i:s' );
  $service_status = 'Out Payment';
  $ad_info = 'Service Payment'. ' '. $servicename;

  $getwallet = DB::table( 'users' )->select('wallet')->where('id',2)->first();
  $balance = 0;
  if($getwallet){
      $balance = $getwallet->wallet;
  }
  $newbalance = $balance + $amount;
  $newbalance1 = Auth::user()->wallet - $amount;

  $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$log_id','$log_id','2','$amount','$ad_info', '$service_status','$time','$date','$log_id','$newbalance1')";
  DB::insert( DB::raw( $sql ) );
  $sql = "update users set wallet = wallet + $amount where id = 2";
  DB::update( DB::raw( $sql ) );
  $service_status = 'IN Payment';
  $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$log_id','2','$log_id','$amount','$ad_info', '$service_status','$time','$date','$log_id','$newbalance')";
  DB::insert( DB::raw( $sql ) );
  $sql = "update users set wallet = wallet - $amount where id = $log_id";
  DB::update( DB::raw( $sql ) );
}
if( $user_type_id == 3){
   $percentage = 50;
}else{
    $percentage = 50;
}
if(Auth::user()->user_type_id == 2){
     $admin_amount = $amount;
}else{
     $admin_amount = ($amount * $percentage) / 100;
}

 $date = date( 'Y-m-d' );
       $time = date( 'H:i:s' );
       $service_status = 'Out Payment';
       $ad_info = 'Service Payment'. ' '. $servicename;
$getrawallet = DB::table( 'users' )->select('nalavariyamwallet')->where('id',1)->first();
          $rawallet = 0;
          if($getrawallet){
            $balance1 = $getrawallet->nalavariyamwallet;
          }

          $getrawallet1 = DB::table( 'users' )->select('nalavariyamwallet')->where('id',2)->first();
          $rawallet1 = 0;
          if($getrawallet1){
            $balance2 = $getrawallet1->nalavariyamwallet;
          }
          $newbalance2 = $balance1 + $admin_amount;
          $newbalance3 = $balance2 - $admin_amount;
       $sql = "insert into nalavariyampayment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_amount','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
       DB::insert( DB::raw( $sql ) );
       $sql = "update users set nalavariyamwallet = nalavariyamwallet + $admin_amount where id = 1";
       DB::update( DB::raw( $sql ) );
       $service_status = 'IN Payment';
       $ad_info = 'Service Payment'. ' '. $servicename;


       $sql = "insert into nalavariyampayment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_amount','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
       DB::insert( DB::raw( $sql ) );
       $sql = "update users set nalavariyamwallet = nalavariyamwallet - $admin_amount where id = 2";
       DB::update( DB::raw( $sql ) );
  return redirect( "online_services/$customer_id" );
}

 public function savebulkbuy(Request $request)
    {
        $customer_id = $request->bulk_customer_id;
        $added_date = date("Y-m-d H:i:s");
        $login_id = Auth::user()->id;
        $dist_id  = Auth::user()->nalavariyam_dist_id;
        $taluk_id = Auth::user()->nalavariyam_taluk_id;
        $user_type_id = Auth::user()->nalavariyam_usertype ?? 0;


        $insertedIds = [];

        // Insert orders
        foreach ($request->all() as $key => $quantity) {
            if (str_contains($key, 'services_')) {
                $temp = explode("_", $key);
                $service_id = $temp[1];
                $amount = $temp[2];

                if ($quantity != "") {
                    $id = DB::table('bulk_service_orders')->insertGetId([
                        'service_id'     => $service_id,
                        'quantity'       => $quantity,
                        'amount'         => $amount,
                        'added_datetime' => now(),
                        'login_id'       => $login_id,
                        'district_id'       => $dist_id,
                        'user_type_id'       => $user_type_id,
                        'status'         => 'Pending',
                    ]);
                    $insertedIds[] = $id;
                    $usage = DB::table('bulk_service_usage')
                        ->where('service_id', $service_id)
                        ->where('user_id', $login_id)
                        ->first();

                    if ($usage) {
                        DB::table('bulk_service_usage')
                            ->where('service_id', $service_id)
                            ->where('user_id', $login_id)
                            ->increment('total', $quantity);
                    } else {
                        DB::table('bulk_service_usage')->insert([
                            'user_id'    => $login_id,
                            'service_id' => $service_id,
                            'total'      => $quantity,
                        ]);
                    }
                }
            }
        }

        // Mark only these as Paid
        DB::table('bulk_service_orders')
            ->whereIn('id', $insertedIds)
            ->update(['status' => 'Paid']);

        // Sum only the last inserted orders
        $amount = DB::table('bulk_service_orders')
            ->whereIn('id', $insertedIds)
            ->sum(DB::raw('amount * quantity'));


        $getservicename = DB::table('nalavariyam_service')->select('service_name')->where('id', $service_id)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        if (Auth::user()->user_type_id != 2) {
            $date = date('Y-m-d');
            $time = date('H:i:s');
            $service_status = 'Out Payment';
            $ad_info = 'Bulk Service Payment';


            $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
            $balance = 0;
            if ($getwallet) {
                $balance = $getwallet->wallet;
            }
            $newbalance = $balance + $amount;
            $newbalance1 = Auth::user()->wallet - $amount;

            $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$login_id','$login_id','2','$amount','$ad_info', '$service_status','$time','$date','$login_id','$newbalance1')";
            DB::insert(DB::raw($sql));
            $sql = "update users set wallet = wallet + $amount where id = 2";
            DB::update(DB::raw($sql));
            $service_status = 'IN Payment';
            $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$login_id','2','$login_id','$amount','$ad_info', '$service_status','$time','$date','$login_id','$newbalance')";
            DB::insert(DB::raw($sql));
            $sql = "update users set wallet = wallet - $amount where id = $login_id";
            DB::update(DB::raw($sql));
        }
        if ($user_type_id == 3) {
            $percentage = 50;
        } else {
            $percentage = 50;
        }
        if (Auth::user()->user_type_id == 2) {
            $admin_amount = $amount;
        } else {
            $admin_amount = ($amount * $percentage) / 100;
        }

        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Bulk Service Payment';
        $getrawallet = DB::table('users')->select('rawallet')->where('id', 1)->first();
        $rawallet = 0;
        if ($getrawallet) {
            $balance1 = $getrawallet->rawallet;
        }

        $getrawallet1 = DB::table('users')->select('rawallet')->where('id', 2)->first();
        $rawallet1 = 0;
        if ($getrawallet1) {
            $balance2 = $getrawallet1->rawallet;
        }
        $newbalance2 = $balance1 + $admin_amount;
        $newbalance3 = $balance2 - $admin_amount;
        $sql = "insert into nalavariyampayment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_amount','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
        DB::insert(DB::raw($sql));
        $sql = "update users set rawallet = rawallet + $admin_amount where id = 1";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $ad_info = 'Bulk Service Payment';


        $sql = "insert into nalavariyampayment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_amount','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
        DB::insert(DB::raw($sql));
        $sql = "update users set rawallet = rawallet - $admin_amount where id = 2";
        DB::update(DB::raw($sql));

        $user_type = Auth::user()->user_type_id;
        $amount = (float) $request->delivery_amount;
        if ($user_type != 2 && !empty($amount) && $amount > 0) {
            $date = date('Y-m-d');
            $time = date('H:i:s');
            $service_status = 'Out Payment';
            $ad_info = 'Offline FOrm Delivery Charge';

            $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
            $balance = 0;
            if ($getwallet) {
                $balance = $getwallet->wallet;
            }

            $getwallet1 = DB::table('users')->select('wallet')->where('id', $login_id)->first();
            $balance1 = 0;
            if ($getwallet1) {
                $balance1 = $getwallet1->wallet;
            }
            $newbalance = $balance + $amount;
            $newbalance1 = $balance1 - $amount;
            $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$login_id','$login_id','2','$amount','$ad_info', '$service_status','$time','$date','$login_id','$newbalance1')";
            DB::insert(DB::raw($sql));
            $sql = "update users set wallet = wallet + $amount where id = 2";
            DB::update(DB::raw($sql));
            $service_status = 'IN Payment';
            $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$login_id','2','$login_id','$amount','$ad_info', '$service_status','$time','$date','$login_id','$newbalance')";
            DB::insert(DB::raw($sql));
            $sql = "update users set wallet = wallet - $amount where id = $login_id";
            DB::update(DB::raw($sql));
        }
        // API FOR NON DISTRICT USERS
        $getadmindistid = DB::table('users')->select('nalavariyam_dist_id')->where('id', 2)->first();
        $admin_nal_distid = 0;
        if ($getadmindistid) {
            $admin_nal_distid = $getadmindistid->nalavariyam_dist_id;
        }
        if (Auth::user()->nalavariyam_dist_id != $admin_nal_distid) {
            $getdata = DB::table('bulk_service_orders as b')
                ->join('users as u', 'u.id', '=', 'b.login_id')
                ->whereIn('b.id', $insertedIds)
                ->select(
                    'b.*',
                    'u.name as user_name',
                    'u.phone as user_phone',
                    'u.address as user_address'
                )
                ->get();

            $getdata = $getdata->map(function ($item) {
                $item->ref_id = time();  // or Str::uuid() if you prefer unique for each
                return $item;
            });
            if ($getdata) {


                $API_KEY = env('API_KEY', '');
                $RAMJIPAY_URL = env('RAMJIPAY_URL', '');
                $WEBSITE_INDEX = env('WEBSITE_INDEX', '');
                $post_data['data'] = $getdata;
                $post_data['key'] = $API_KEY;
                $post_data['index'] = $WEBSITE_INDEX;
                $ch = curl_init();
                //echo "<pre>";print_r($post_data);echo"</pre>";die;
                //dd(json_encode($post_data));
                //dd($post_data);
                $url1 = $RAMJIPAY_URL . '/api/bulk_order_api';
                //echo $url1;die;
                curl_setopt($ch, CURLOPT_URL, $url1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $server_output = curl_exec($ch);
                curl_close($ch);
                $resdata = json_decode($server_output, true);
                //dd($resdata);
                if (isset($resdata['status']) && $resdata['status'] == 'Success') {
                    $delivery_amount = (float) $request->delivery_amount;
                    $date = date('Y-m-d');
                    $time = date('H:i:s');
                    $service_status = 'Out Payment';
                    $ad_info = 'Other District Bulk Service Delivery Charge';
                    $getrawallet = DB::table('users')->select('rawallet')->where('id', 1)->first();
                    $rawallet = 0;
                    if ($getrawallet) {
                        $balance1 = $getrawallet->rawallet;
                    }

                    $getrawallet1 = DB::table('users')->select('rawallet')->where('id', 2)->first();
                    $rawallet1 = 0;
                    if ($getrawallet1) {
                        $balance2 = $getrawallet1->rawallet;
                    }
                    $newbalance2 = $balance1 + $delivery_amount;
                    $newbalance3 = $balance2 - $delivery_amount;
                    $sql = "insert into nalavariyampayment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$delivery_amount','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
                    DB::insert(DB::raw($sql));
                    $sql = "update users set rawallet = rawallet + $delivery_amount where id = 1";
                    DB::update(DB::raw($sql));
                    $service_status = 'IN Payment';
                    $ad_info = 'Other District Bulk Service Delivery Charge';


                    $sql = "insert into nalavariyampayment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$delivery_amount','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
                    DB::insert(DB::raw($sql));
                    $sql = "update users set rawallet = rawallet - $delivery_amount where id = 2";
                    DB::update(DB::raw($sql));
                }
            }
        }
        if (Auth::user()->user_type_id == 2) {
            return redirect('/bulkorderstatus')->with('success', 'Bulk Service Purchased Successfully');
        } else {
            return redirect('/bulkorders')->with('success', 'Bulk Service Purchased Successfully');
        }
    }

    public function bulkorder()
    {
        $login_id = Auth::user()->id;
        $user_type_id = Auth::user()->user_type_id;
        $dist_id = Auth::user()->nalavariyam_dist_id;

        $sql = "select a.*,c.district_name from nalavariyam_service a,service_details b,nalavariyam_district c where b.service_id=a.id and b.district_id=c.id and c.id= '$dist_id' and b.service_type = '2'";
        $bulkservice = DB::select(DB::raw($sql));

        $bulkservice = json_decode(json_encode($bulkservice), true);
        foreach ($bulkservice as $key => $service) {
            $used = 1;
            $service_id = $service["id"];
            $sql = "select * from bulk_service_usage where total > used and service_id=$service_id and user_id=$login_id";
            $unused = DB::select($sql);
            if (count($unused) > 0) {
                $used = 0;
            }

            $service_id = $service["id"];
            $getusertype = DB::table('users')->where('id', Auth::user()->id)->first();
            $nal_usertype = 0;
            if ($getusertype) {
                $nal_usertype = $getusertype->nalavariyam_usertype;
            }
            $form_payment = DB::table('nalavariyam_payment')->where('service_id', $service_id)->first();
            if ($form_payment) {
                //$adminamount = $form_payment->admin_amount;
                if ($nal_usertype == 3) {
                    $pay_amount =  $form_payment->distributor_amount;
                } elseif ($nal_usertype == 4) {
                    $pay_amount =  $form_payment->retailer_amount;
                } elseif ($user_type_id == 2) {
                    $pay_amount =  $form_payment->admin_amount;
                }
            }
            $percentage = 50;
            $adminamount = ($pay_amount * $percentage) / 100;
            if (Auth::user()->user_type_id == 2) {
                $bulkservice[$key]['admin_amount'] = $pay_amount;
            } else {
                $bulkservice[$key]['admin_amount'] = $adminamount;
            }





            $bulkservice[$key]["pay_amount"] = $pay_amount;
            $bulkservice[$key]["used"] = $used;
        }
        $bulkservice = json_decode(json_encode($bulkservice));
        $rabalance = DB::table('users')->select('rawallet')->where('id', 2)->first();
        $district = DB::table('nalavariyam_district')->where('id', '=', $dist_id)->get();
        $nalavariyamcustomer = DB::table('nalavariyam_customer')->where('refferal', Auth::user()->id)->get();





        return view('nalavariyam/bulkorder', compact('bulkservice', 'rabalance', 'nalavariyamcustomer', 'district'));
    }

    public function updateaddress(Request $request)
    {
       
       $request->validate([
        'address' => 'nullable|string|max:255',
    ]);

    $user = Auth::user();
    $user->address = $request->address;
    $user->save();

    return response()->json(['success' => true]);
    }

    public function upload_offline_form(Request $request)
    {
        $service_id = $request->form_service_id;
        $customer_id = $request->customer_id;
        $application_no = $request->application_no;
        $log_id = Auth::user()->id;
        $dist_id  = Auth::user()->nalavariyam_dist_id;
        $taluk_id = Auth::user()->nalavariyam_taluk_id ?? 0;

        $user_type_id = Auth::user()->nalavariyam_usertype ?? 0;
        $paydate = date('Y-m-d');
        $service_status = 'Completed';
        $time = date('H:i:s');
        $fileName = "";
        $targetDir = 'upload/output/';
        if (!empty($_FILES['photo']['name'])) {
            $fileType = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
            $fileName = 'outputimage_' . floor(microtime(true) * 1000) . '.' . $fileType;
            $targetFilePath1 = $targetDir . $fileName;
            move_uploaded_file($_FILES['photo']['tmp_name'], $targetFilePath1);
        }
        $sql = "insert into nalavariyam_form (customer_id,service_id,service_status,log_id,dist_id,taluk_id,user_type_id,date,time,from_image,application_no) values ('$customer_id','$service_id','$service_status','$log_id','$dist_id','$taluk_id','$user_type_id','$paydate','$time','$fileName','$application_no')";
        DB::insert(DB::raw($sql));
        $sql = "update bulk_service_usage set used=used+1 where user_id=$log_id and service_id=$service_id";
        DB::update($sql);
        return back()->with('success', 'Offline Form Uploaded Successfully');
    }

   public function bulkorderstatus()
    {
$sql = "
SELECT 
    a.id AS user_id, 
    a.name, 
    a.phone, 
    a.email,
    b.district_name, 
    o.login_id, 
    o.added_datetime, 
    o.status,

    SUM(o.quantity) AS total_quantity, 
    SUM(o.amount) AS total_amount,
    COUNT(o.service_id) AS total_services,

    MAX(o.id) AS last_order_id
FROM users a
JOIN nalavariyam_district b ON a.nalavariyam_dist_id = b.id
JOIN bulk_service_orders o ON o.login_id = a.id
WHERE o.status IN ('Paid', 'Delivered')
GROUP BY 
    o.login_id, 
    o.added_datetime, 
    o.status, 
    a.id, 
    a.name,
    a.phone, 
    b.district_name,
    a.email
ORDER BY last_order_id DESC";


        $bulkorders = DB::select(DB::raw($sql));
        //dd($bulkorders);
        return view('nalavariyam/bulkorderstatus', compact('bulkorders'));
    }


    public function viewbulkorder($user_id)
    {
        $sql = "select a.*,b.service_name from bulk_service_orders a,nalavariyam_service b where a.service_id=b.id and a.status='Paid' and a.login_id = $user_id";
        $bulkorders = DB::select(DB::raw($sql));
        $sql = "select a.*,b.district_name from users a,nalavariyam_district b where a.nalavariyam_dist_id=b.id and a.id=$user_id";
        $user = DB::select(DB::raw($sql))[0];
        return view('nalavariyam/viewbulkorder', compact('bulkorders', 'user'));
    }

    public function bulkorders()
    {
        $dist_id = Auth::user()->nalavariyam_dist_id;
        $user_id = Auth::user()->id;

        $sql = "select a.*,b.service_name,c.district_name from bulk_service_orders a,nalavariyam_service b,nalavariyam_district c where a.service_id=b.id and a.district_id=c.id and a.district_id=$dist_id and a.login_id=$user_id";

        $pending = DB::select(DB::raw($sql));
        return view('nalavariyam/bulkorderstatus', compact('pending'));
    }

    public function updatebulkstatus(Request $request)
    {
        $user_id = $request->user_id;
        $status = $request->status;
        $sql = "update bulk_service_orders set status='$status' where login_id=$user_id and status in ('Paid')";
        DB::update(DB::raw($sql));
        return redirect('/bulkorder')->with('success', 'Bulk Service Order Status Updated Successfully');
    }
    
public function nalavariyam_createapplication( Request $request ) {
    //dd($request->all());
    define ( 'SITE_ROOT', realpath( dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) ) );
    $service_id = $request->imservice_id;
    $customer_id = $request->imcustomer_id;
    $customer_user_type_id = $request->imcustomer_user_type_id;
    $user_id = Auth::user()->id;
    $dist_id = Auth::user()->nalavariyam_dist_id;
    $sql = "select * from nalavariyam_service where id = $service_id";

    $result = DB::select( DB::raw( $sql ) );
    $marge_right = $result[ 0 ]->marge_right;

    $marge_bottom = $result[ 0 ]->marge_bottom;

    $targetDir = 'upload/output/';
    $API_KEY = env( 'API_KEY', '' );
    $ch = curl_init();
    $post_data = "key=$API_KEY&dist_id=$dist_id";
    //dd($post_data);
    $website_url = "https://erp.nalavariyam.org";
    $url = $website_url.'/api/getsignature';
    curl_setopt( $ch, CURLOPT_URL, $url );
    curl_setopt( $ch, CURLOPT_POST, 1 );
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_data );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    $server_output = curl_exec( $ch );
    curl_close( $ch );
    $resdata = json_decode($server_output, true);
    //dd($resdata);
    $watermarkImagePath = "";
    if($resdata){
     if($resdata['message'] == "Success"){
       $watermarkImagePath = $resdata['signature_path'];
    }else{
        return redirect( "online_services/$customer_id" )->with('error','Something Went Wrong.Please Try Again.....');
    }
    $url = url('/');
}
    //$watermarkImagePath = $url.'/upload/1.png';

//echo $watermarkImagePath;die;
    $statusMsg = '';
    if ( !empty( $_FILES[ 'photo' ][ 'name' ] ) ) {

        $fileType = pathinfo( $_FILES[ 'photo' ][ 'name' ], PATHINFO_EXTENSION );

        $fileName = 'outputimage_' . floor( microtime( true ) * 1000 ).'.'.$fileType;

        $targetFilePath1 = $targetDir . $fileName;

        $allowTypes = array( 'jpg', 'png', 'jpeg' );

        if ( in_array( $fileType, $allowTypes ) ) {

            if ( move_uploaded_file( $_FILES[ 'photo' ][ 'tmp_name' ], $targetFilePath1 ) ) {

                $watermarkImg = imagecreatefrompng( $watermarkImagePath );

                switch( $fileType ) {

                    case 'jpg':
                    $im = imagecreatefromjpeg( $targetFilePath1 );

                    break;

                    case 'jpeg':
                    $im = imagecreatefromjpeg( $targetFilePath1 );

                    break;

                    case 'png':
                    $im = imagecreatefrompng( $targetFilePath1 );

                    break;

                    default:
                    $im = imagecreatefromjpeg( $targetFilePath1 );

                }

                $sx = imagesx( $watermarkImg );

                $sy = imagesy( $watermarkImg );

                imagecopy( $im, $watermarkImg, imagesx( $im ) - $sx - $marge_right, imagesy( $im ) - $sy - $marge_bottom, 0, 0, imagesx( $watermarkImg ), imagesy( $watermarkImg ) );

                imagejpeg( $im, $targetFilePath1 );

                imagedestroy( $im );
                if ( file_exists( $targetFilePath1 ) ) {
                    $sql = "select * from nalavariyam_form where customer_id = $customer_id  and service_status in ('Paid','Resubmit') order by id limit 1 ";
    //echo $sql; die;
                    $result = DB::select(DB::raw($sql));
                        $payments_id = $result[0]->id;
                        $time = date('H:i:s');
                        $servicestatus = 'Pending';
                        $application_no = NULL;
                        if (Auth::user()->user_type_id == 2) {
                            $servicestatus = 'Completed';
                            if (isset($request->application_no) && !empty($request->application_no)) {
                                $application_no = $request->application_no;
                            }
                        }
                        $sql = "update nalavariyam_form set from_image='$fileName',service_id='$service_id',customer_id='$customer_id',customer_user_type_id='$customer_user_type_id',log_id='$user_id',service_status='$servicestatus',dist_id='$dist_id',time='$time',application_no='$application_no' where id=$payments_id";
                        DB::update(DB::raw($sql));

                }

            }
        }
    }
    return redirect( "online_services/$customer_id" );

}

public function pending()
    {
        $status = 'Pending';

        if (Auth::user()->user_type_id == 2 || Auth::user()->user_type_id == 1) {

            $servicestatus = DB::table( 'nalavariyam_form' )->select( 'nalavariyam_form.*', 'nalavariyam_district.district_name', 'users.phone', 'nalavariyam_service.service_name', 'nalavariyam_form.id as userID' )
            ->Join( 'nalavariyam_district', 'nalavariyam_district.id', '=', 'nalavariyam_form.dist_id' )
            ->Join( 'users', 'users.id', '=', 'nalavariyam_form.log_id' )
            ->Join( 'nalavariyam_service', 'nalavariyam_service.id', '=', 'nalavariyam_form.service_id' )
            ->where( 'nalavariyam_form.service_status', $status )->orderBy( 'nalavariyam_form.id', 'desc' )->get();
        } else {

            $log_id = Auth::user()->id;
            $servicestatus = DB::table( 'nalavariyam_form' )->select( 'nalavariyam_form.*', 'nalavariyam_district.district_name', 'nalavariyam_customer.phone', 'nalavariyam_customer.name', 'nalavariyam_service.service_name', 'nalavariyam_form.id as userID' )
            ->Join( 'nalavariyam_district', 'nalavariyam_district.id', '=', 'nalavariyam_form.dist_id' )
            ->Join( 'nalavariyam_customer', 'nalavariyam_customer.id', '=', 'nalavariyam_form.customer_id' )
            ->Join( 'nalavariyam_service', 'nalavariyam_service.id', '=', 'nalavariyam_form.service_id' )
            ->where( 'nalavariyam_form.service_status', $status )->where( 'nalavariyam_form.log_id', $log_id )->orderBy( 'nalavariyam_form.id', 'desc' )->get();

        }
         $remarks = DB::table( 'nalavariyam_remarks' )->orderBy( 'id', 'ASC' )->get();
        return view( 'nalavariyam/pending', compact( 'servicestatus', 'status','remarks' ) );
    }


    public function Resubmit()
    {
        $status = 'Resubmit';

        if (Auth::user()->user_type_id == 2 || Auth::user()->user_type_id == 1 ) {

            $servicestatus = DB::table( 'nalavariyam_form' )->select( 'nalavariyam_form.*', 'nalavariyam_district.district_name', 'users.phone', 'nalavariyam_service.service_name', 'nalavariyam_form.id as userID' )
            ->Join( 'nalavariyam_district', 'nalavariyam_district.id', '=', 'nalavariyam_form.dist_id' )
            ->Join( 'users', 'users.id', '=', 'nalavariyam_form.log_id' )
            ->Join( 'nalavariyam_service', 'nalavariyam_service.id', '=', 'nalavariyam_form.service_id' )
            ->where( 'nalavariyam_form.service_status', $status )->orderBy( 'nalavariyam_form.id', 'desc' )->get();
        } else {

            $log_id = Auth::user()->id;
            $servicestatus = DB::table( 'nalavariyam_form' )->select( 'nalavariyam_form.*', 'nalavariyam_district.district_name', 'nalavariyam_customer.phone', 'nalavariyam_customer.name', 'nalavariyam_service.service_name', 'nalavariyam_form.id as userID' )
            ->Join( 'nalavariyam_district', 'nalavariyam_district.id', '=', 'nalavariyam_form.dist_id' )
            ->Join( 'nalavariyam_customer', 'nalavariyam_customer.id', '=', 'nalavariyam_form.customer_id' )
            ->Join( 'nalavariyam_service', 'nalavariyam_service.id', '=', 'nalavariyam_form.service_id' )
            ->where( 'nalavariyam_form.service_status', $status )->where( 'nalavariyam_form.log_id', $log_id )->orderBy( 'nalavariyam_form.id', 'desc' )->get();

        }

        return view( 'nalavariyam/pending', compact( 'servicestatus', 'status' ) );
    }

     public function Approved()
    {
        $status = 'Completed';
        if (Auth::user()->user_type_id == 2 || Auth::user()->user_type_id == 1 ) {

            $completed = DB::table( 'nalavariyam_form' )->select( 'nalavariyam_form.*', 'nalavariyam_district.*', 'users.phone', 'nalavariyam_service.service_name', 'nalavariyam_service.service_payment', 'nalavariyam_customer.phone', 'nalavariyam_customer.name', 'nalavariyam_customer.id as customersID', 'nalavariyam_form.id as form_id' )
            ->Join( 'nalavariyam_district', 'nalavariyam_district.id', '=', 'nalavariyam_form.dist_id' )
            ->Join( 'users', 'users.id', '=', 'nalavariyam_form.log_id' )
            ->Join( 'nalavariyam_service', 'nalavariyam_service.id', '=', 'nalavariyam_form.service_id' )
            ->Join( 'nalavariyam_customer', 'nalavariyam_customer.id', '=', 'nalavariyam_form.customer_id' )
            ->where( 'nalavariyam_form.service_status', $status )
           ->orderBy( 'nalavariyam_form.id', 'Asc' )->get();

        } else {
            $log_id = Auth::user()->id;
            $completed = DB::table( 'nalavariyam_form' )->select( 'nalavariyam_form.*', 'nalavariyam_district.*', 'nalavariyam_customer.phone', 'nalavariyam_customer.name', 'nalavariyam_customer.id as customersID', 'nalavariyam_service.service_name', 'nalavariyam_service.service_payment', 'nalavariyam_form.id as form_id' )
            ->Join( 'nalavariyam_district', 'nalavariyam_district.id', '=', 'nalavariyam_form.dist_id' )
            ->Join( 'nalavariyam_customer', 'nalavariyam_customer.id', '=', 'nalavariyam_form.customer_id' )
            ->Join( 'nalavariyam_service', 'nalavariyam_service.id', '=', 'nalavariyam_form.service_id' )
            ->where( 'nalavariyam_form.service_status', $status )
            ->where( 'nalavariyam_form.log_id', $log_id )->orderBy( 'nalavariyam_form.id', 'Asc' )->get();
        }


        return view( 'nalavariyam/completed', compact( 'completed','status') );
    }

        public function updatecompleteddetails( Request $request ) {
//dd($request->all());
        DB::table( 'nalavariyam_form' )->where( 'id', $request->payments_id )->update( [
            'application_no' => $request->application_no,
        ] );

        return redirect()->back();
    }

         public function createbill( $id) {
        DB::table( 'nalavariyam_form' )->where( 'id', $id )->update( [
            'bill' => 1
        ] );

        return redirect()->back();
    }


        public function receipt( $id, $cust_id ) {
        $loginid = Auth::user()->id;

        $users = DB::table( 'users' )->where('id',$loginid)->first();
        $customers = DB::table( 'nalavariyam_customer' )->where('id',$cust_id)->first();
        $formdata = DB::table( 'nalavariyam_form' )->where('id',$id)->first();
        $customer_service_id = 0;
        if($formdata){
            $customer_service_id = $formdata->service_id;
        }
        $services = DB::table( 'nalavariyam_service' )->where('id',$customer_service_id)->first();


        $total = 120;
        $number = round( $total );
        $no = floor( $number );
        $point = round( $number - $no, 2 ) * 100;
        $hundred = null;
        $digits_1 = strlen( $no );
        $i = 0;
        $str = array();
        $words = array( '0' => '', '1' => 'one', '2' => 'two',
            '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
            '7' => 'seven', '8' => 'eight', '9' => 'nine',
            '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
            '13' => 'thirteen', '14' => 'fourteen',
            '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
            '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
            '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
            '60' => 'sixty', '70' => 'seventy',
            '80' => 'eighty', '90' => 'ninety' );
        $digits = array( '', 'hundred', 'thousand', 'lakh', 'crore' );
        while ( $i < $digits_1 ) {
            $divider = ( $i == 2 ) ? 10 : 100;
            $number = floor( $no % $divider );
            $no = floor( $no / $divider );
            $i += ( $divider == 10 ) ? 1 : 2;
            if ( $number ) {
                $plural = ( ( $counter = count( $str ) ) && $number > 9 ) ? 's' : null;
                $hundred = ( $counter == 1 && $str[ 0 ] ) ? ' and ' : null;
                $str [] = ( $number < 21 ) ? $words[ $number ] .
                ' ' . $digits[ $counter ] . $plural . ' ' . $hundred
                :
                $words[ floor( $number / 10 ) * 10 ]
                . ' ' . $words[ $number % 10 ] . ' '
                . $digits[ $counter ] . $plural . ' ' . $hundred;
            } else $str[] = null;
        }
        $str = array_reverse( $str );
        $getamount = implode( '', $str );
        $points = ( $point ) ?
        '.' . $words[ $point / 10 ] . ' ' .
        $words[ $point = $point % 10 ] : '';
        $getamount . 'Rupees';

        return view( 'nalavariyam/receipt', compact( 'users', 'customers', 'formdata', 'services', 'getamount' ) );
    }


     public function nalavariyam_formstatus( Request $request ) {
        $service_status = $request->service_status;

        $updatestatus = DB::table( 'nalavariyam_form' )->where( 'id', $request->service_id )->update( [
            'service_status' => $service_status,
            'reason' => $request->reason,
        ] );
        if($service_status == "Approved"){
            DB::table( 'nalavariyam_form' )->where( 'id', $request->service_id )->update( [
                'online_status' => 'Completed',
            ] );
        }
            return redirect( 'nalavariyam/form/pending' );
        }


public function nalavariyam_customer()
{
    $nalavariyam_customer = DB::table('nalavariyam_customer')->select('district.district_name','nalavariyam_customer.*')
    ->Join('district', 'district.id', '=', 'nalavariyam_customer.district')
    ->orderBy('nalavariyam_customer.id', 'Desc')->get();
    $authdistrict_id = Auth::user()->dist_id;
    $district = DB::table( 'nalavariyam_district' )->where( 'id', '=', $authdistrict_id )->get();
        // $district = DB::table('district')->where('status','Active')->orderBy('id','Asc')->get();
    return view('nalavariyam/nalavariyam_customer', compact('nalavariyam_customer','district'));
}

public function addnalavariyam_customer( Request $request ) {

    $customer_id = DB::table( 'nalavariyam_customer' )->insertGetId( [
        'name'       => $request->name,
        'district'   => $request->dist_id,
        'taluk'      => $request->taluk_id,
        'phone'      => $request->phone,
        'refferal'   => Auth::user()->id,
        'status'     => 'Active',

    ] );

    $response = Http::post(
    'https://erp.nalavariyam.org/api/generate-member-id',
    [
        'year'        => 2025,
        'customer_id' => $customer_id
    ]
);

$data = $response->json();
DB::table('nalavariyam_customer')
    ->where('id', $customer_id)
    ->update([
        'member_id' => $data['member_id']
    ]);


    return redirect()->back()->with( 'success', 'Customer Added Successfully ... !' );
}

public function special_member()
    {if (Auth::user()->user_type_id == 1) {
        $special_member = DB::table('spl_member')->orderBy('id', 'DESC')->get();

    } else {
        $special_member = DB::table('spl_member')->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();

    }
        $payment          = DB::table('splmemberactivationpayment')->first();
        $activationamount = 0;
        if ($payment) {
            if (Auth::user()->nalavariyam_usertype == 3) {
                $activationamount = $payment->distributor_amount;
            } elseif (Auth::user()->nalavariyam_usertype == 4) {
                $activationamount = $payment->retailer_amount;
            }
        }
        $districts = DB::table('nalavariyam_district')->get();

        return view('nalavariyam/special_member', compact('special_member', 'activationamount', 'districts'));}

         public function savespecial_member(Request $request)
    {

        $savespecial_member = DB::table('spl_member')->insert([
            'name'                  => $request->name,
            'district'              => $request->district,
            'taluk'                 => $request->taluk_id,
            'dob'                   => $request->dob,
            'mobile'                => $request->mobile,
            'aadhaar_no'            => $request->aadhaar_no,
            'door_no'               => $request->door_no,
            'post_office_name'      => $request->post_office_name,
            'father_hus_name'       => $request->father_hus_name,
            'relation'              => $request->relation,
            'profession'            => $request->profession,
            'registration_no'       => $request->registration_no,
            'street_name'           => $request->street_name,
            'pincode'               => $request->pincode,
            'user_id'               => Auth::user()->id,
            'status'                => 'Inactive',
            'customer_user_type_id' => 2,
            'cardstatus'            => 'Pending',
        ]);

        $insertid = DB::getPdo()->lastInsertId();
        $photo    = "";

        if ($request->hasFile('photo')) {
            $photo    = uniqid() . '.' . $request->file('photo')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'nalavariyam_document' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
            $request->file('photo')->move($filepath, $photo);
        }

        DB::table('spl_member')->where('id', $insertid)->update([
            'photo' => $photo,
        ]);
        // $photo = null;
        // if ($request->hasFile('photo')) {
        //     $photo = uniqid() . '.' . $request->file('photo')->extension();
        //     $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'nalavariyam_document' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
        //     $request->file('photo')->move($filepath, $photo);
        // }
        // ] );

        return redirect()->back()->with('success', 'Special Member Added Successfully ... !');
    }

    //  public function view_spl_member()
    //         {
    //             $special_member = DB::table('spl_member')->orderBy( 'id' , 'DESC' )->get();
    //             return view('nalavariyam/view_splmember',compact('special_member'));
    //         }

    public function update_spl_member(Request $request)
    {
        DB::table('spl_member')->where('id', $request->id)->update([
            'name'             => $request->editname,
            'district'         => $request->editdistrict,
            'taluk'            => $request->edittaluk,
            'dob'              => $request->editdob,
            'mobile'           => $request->editmobile,
            'aadhaar_no'       => $request->editaadhaar_no,
            'door_no'          => $request->editdoor_no,
            'post_office_name' => $request->editpost_office_name,
            'father_hus_name'  => $request->editfather_hus_name,
            'profession'       => $request->editprofession,
            'relation'         => $request->editrelation,
            'registration_no'  => $request->editregistration_no,
            'street_name'      => $request->editstreet_name,
            'pincode'          => $request->editpincode,
        ]);

        if ($request->hasFile('photo')) {
            $photo    = uniqid() . '.' . $request->file('photo')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'nalavariyam_document' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
            $request->file('photo')->move($filepath, $photo);
            DB::table('spl_member')->where('id', $request->id)->update([
                'photo' => $photo,
            ]);
        }

        return redirect()->back()->with('success', 'Special Member Updated Successfully ... !');
    }

     public function splmemberactivationpayment()
    {
        $payment = DB::table('splmemberactivationpayment')->orderBy('id', 'Asc')->get();

        return view('servicepayment.splmemberactivationpayment', compact('payment'));
    }

    public function savesplmemberactivation(Request $request)
    {

        DB::table('splmemberactivationpayment')->updateOrInsert(
            ['id' => 1],
            [
                'distributor_amount' => $request->distributor_amount,
                'retailer_amount'    => $request->retailer_amount,
            ]
        );

        return redirect('splmemberactivationpayment');
    }

    public function updatesplmember_status(Request $request)
    {

        $activationamount = $request->activation_amount;
        $userid           = Auth::user()->id;

        $date           = date('Y-m-d');
        $time           = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info        = 'Special Member Activation Payment';
        $getwallet      = DB::table('users')->select('wallet')->where('id', 1)->first();
        $balance        = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance  = $balance + $activationamount;
        $newbalance1 = Auth::user()->wallet - $activationamount;
        if ($activationamount != 0) {
            $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('1','$userid','1','$activationamount','$ad_info', '$service_status','$time','$date','$userid','$newbalance1')";
            DB::insert(DB::raw($sql));
            $sql = "update users set wallet = wallet + $activationamount where id = 1";
            DB::update(DB::raw($sql));
            $service_status = 'IN Payment';
            $ad_info        = 'Activation Payment';
            $sql            = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$userid','1','$userid','$activationamount','$ad_info', '$service_status','$time','$date','$userid','$newbalance')";
            DB::insert(DB::raw($sql));
            $sql = "update users set wallet = wallet - $activationamount where id = $userid";
            DB::update(DB::raw($sql));

            DB::table('spl_member')->where('id', $request->memberid)->update([
                'status'       => 'Active',
                'is_completed' => '1',
            ]);
            return redirect()->back()->with('success', 'Special Member Activated Successfully ... !');
        } else {
            return redirect()->back()->with('error', 'Activation Amount is Zero ... !');
        }
    }

    public function update_splmember_idcard(Request $request)
    {
        $status  = $request->view_status_update;
        $remarks = $request->view_remarks;
        DB::table('spl_member')->where('id', $request->id)->update(
            [
                'cardstatus' => $status,
                'remarks'    => $remarks,
            ]
        );
        $photo = "";
        if ($request->hasFile('view_upload_file')) {
            $photo    = uniqid() . '.' . $request->file('view_upload_file')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'nalavariyam_document' . DIRECTORY_SEPARATOR . 'specialmember_idcard' . DIRECTORY_SEPARATOR);
            $request->file('view_upload_file')->move($filepath, $photo);

        }

        DB::table('spl_member')->where('id', $request->id)->update([
            'certificate' => $photo,
        ]);

        return redirect()->back()->with('success', 'Special Member Updated Successfully ... !');
    }

public function activationmember()
{

    $member = DB::table( 'users' )->select( 'users.name','users.nalavariyam_usertype','users.address', 'nalavariyam_district.district_name','users.id' )
    ->Join( 'nalavariyam_district', 'nalavariyam_district.districtid', '=', 'users.nalavariyam_dist_id' )
        // ->Join( 'service_details', 'service_details.district_id', '=', 'users.nalavariyam_dist_id' )
    ->where('users.verified',1)
    ->orderBy( 'users.id', 'Asc' )->get();

            // echo "<pre>"; print_r($member); echo "</pre>";die;

    return view('permission/activationmember', compact('member'));
}

public function member()
{

    $nalavariyam_service = DB::table( 'nalavariyam_service' )->orderBy( 'id', 'Asc' )->get();

    $member = DB::table('nalavariyam_customer')->select('nalavariyam_district.district_name','nalavariyam_customer.*')
    ->Join('nalavariyam_district', 'nalavariyam_district.id', '=', 'nalavariyam_customer.district')
    ->where('refferal' , Auth::user()->id)
    ->orderBy('nalavariyam_customer.id', 'Desc')->get();

    $district = DB::table( 'nalavariyam_district' )->where('id',Auth::user()->nalavariyam_dist_id)->where( 'status', 'Active' )->orderBy( 'id', 'Asc' )->get();

    return view( 'nalavariyam/member', compact( 'nalavariyam_service','district','member' ) );
}

public function addnalavariyam_member( Request $request ) {

    $addcustomer = DB::table( 'nalavariyam_customer' )->insert( [
        'name'                   => $request->name,
        'district'               => $request->dist_id,
        'taluk'                  => $request->taluk_id,
        'phone'                  => $request->phone,
        'aadhaar_no'             => $request->aadhaar_no,
        'customer_user_type_id'  => '1',
        'date'                   => date("Y-m-d"),
        'refferal'               => Auth::user()->id,
        'status'                 => 'Active',
    ] );

    return redirect()->back()->with( 'success', 'Member Added Successfully ... !' );
}

public function nalavariyampayment(){
    $services = DB::table('nalavariyam_service')->where('status','Active' )->orderBy( 'id' , 'Asc' )->get();
    $services = json_decode( json_encode( $services ), true );
    foreach ( $services as $key => $service ) {
      $services[ $key ][ 'payment' ] = array();
      $service_id = $service[ 'id' ];
      $payment = DB::table('nalavariyam_payment')->where('service_id',$service_id)->get();
      if(count($payment) > 0){
        $services[ $key ][ 'payment' ] = $payment;
    }
}
$services = json_decode( json_encode( $services ));
return view('servicepayment.nalavariyampayment',compact('services','service_id'));
}

public function savenalavariyam_payment(Request $request){
    $parent_id = $request->parent_id;
    DB::table('nalavariyam_payment')->where('parent_id',$parent_id )->delete();
    if($request->has('parent_id')){
      foreach ( $request->parent_id as $key => $payment ) {
        $service_id = $request->service_id[ $key ];
        $distributor_amount = $request->distributor_amount[ $key ];
        $admin_amount = $request->admin_amount[ $key ];
        $retailer_amount = $request->retailer_amount[ $key ];

        DB::table( 'nalavariyam_payment' )->insert( [
            'parent_id'           => $payment,
            'service_id'          => $service_id,
            'distributor_amount'  => $distributor_amount,
            'admin_amount'  => $admin_amount,
            'retailer_amount'     => $retailer_amount,
        ] );
    }
}
return redirect('nalavariyampayment/');
}

public function nalavariyamactivation_payment(){
    $services = DB::table('nalavariyam_service')->where('status','Active' )->orderBy( 'id' , 'Asc' )->get();
    $services = json_decode( json_encode( $services ), true );
    foreach ( $services as $key => $service ) {
      $services[ $key ][ 'payment' ] = array();
      $service_id = $service[ 'id' ];
      $payment = DB::table('nalavariyam_payment')->where('service_id',$service_id)->get();
      if(count($payment) > 0){
        $services[ $key ][ 'payment' ] = $payment;
    }
}
$services = json_decode( json_encode( $services ));
return view('servicepayment.nalavariyamactivation_payment',compact('services','service_id'));
}

public function nalauseractivationpayment(){
    $services = DB::table('services')->where('status','Active' )->where('id','=',6)->orderBy( 'id' , 'Asc' )->get();
    foreach ( $services as $key => $service ) {
          $service->activation_id = 3;
        }
    $services = json_decode( json_encode( $services ), true );
    foreach ( $services as $key => $service ) {
    $services[ $key ][ 'payment' ] = array();
    $serviceid = $service[ 'id' ];
    $payment = DB::table('useractivation')->where('service_id',$serviceid)->where('parent_id',3)->get();
    if(count($payment) > 0){
        $services[ $key ][ 'payment' ] = $payment;
    }
    }
    $services = json_decode( json_encode( $services ));
    //dd($services);
    return view('servicepayment.nalauseractivationpayment',compact('services','serviceid'));
}

public function savenalavariyamactivation(Request $request){
    // dd($request->all());
    $parent_id = $request->parent_id;
    DB::table('useractivation')->where('parent_id',$parent_id )->where('service_id',6 )->delete();
    if($request->has('parent_id')){
      foreach ( $request->parent_id as $key => $payment ) {
        $service_id = $request->service_id[ $key ];
        $distributor_amount = $request->distributor_amount[ $key ];
        $retailer_amount = $request->retailer_amount[ $key ];

        DB::table( 'useractivation' )->insert( [
            'parent_id'           => $payment,
            'service_id'          => $service_id,
            'distributor_amount'  => $distributor_amount,
            'retailer_amount'     => $retailer_amount,
        ] );
    }
}
return redirect('nalauseractivationpayment/');
}

public function getaadhaar_otpf($aadhaar) {

    $url = "https://server.webtechly.co.in/send-otp?no=$aadhaar";
    $crl = curl_init();
    curl_setopt( $crl, CURLOPT_URL, $url );
    curl_setopt( $crl, CURLOPT_FRESH_CONNECT, true );
    curl_setopt( $crl, CURLOPT_RETURNTRANSFER, true );
    $result = curl_exec($crl);
    $result = json_decode($result);
    curl_close($crl);
    return response()->json( $result );
}

public function getaadhaar_dataf($otp,$refid,$aadhaar,$userid) {
    $url = "https://server.webtechly.co.in/fetch-info?api_key=3d77fb-c95462-6d17f3-a92b88-9b8b9c&otp=$otp&client_id=$refid";
    $crl = curl_init();
    curl_setopt( $crl, CURLOPT_URL, $url );
    curl_setopt( $crl, CURLOPT_FRESH_CONNECT, true );
    curl_setopt( $crl, CURLOPT_RETURNTRANSFER, true );
    $data = curl_exec($crl);
        // $result["data"] = $data;
    

    curl_close($crl);
    $data = json_decode($data,true);
    
   if ($data && isset($data['status']) && $data['status'] === true) {
    DB::table('users')
        ->where('id', $userid)
        ->update([
            'name'       => $data['data']['name'],
            'aadhaar_no' => $aadhaar,
        ]);
}   
    if (!empty($data['data']['name'])) {
    return response()->json($data['data']);
    }else{
        $status = false;
        $message = "Invalid OTP or something went wrong";
        $response = array('status' => $status, 'message' => $message);
        return response()->json( $response );
    }
   
    
        //echo "<pre>"; print_r($result); echo "</pre>";die;
}

public function updatenalavariyam_activation(Request $request)
{
    $verify = '1';
        //  dd($request->all());
    $activationamount = $request->activation_amount_hidden;
    $admin_amount = $request->admin_amount;
    $userid = $request->userid;

            $response = Http::post(
    'https://erp.nalavariyam.org/api/generate-member-id',
    [
        'year'    => 2025,
        'user_id' => $userid
    ]
);

$data = $response->json();

DB::table('users')
    ->where('id', $userid)
    ->update([
        'member_id' => $data['member_id']
    ]);

        $date = date( 'Y-m-d' );
        $time = date( 'H:i:s' );
        $service_status = 'Out Payment';
        $ad_info = 'Activation Payment';
        $getwallet = DB::table( 'users' )->select('wallet')->where('id',2)->first();
        $balance = 0;
        if($getwallet){
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $activationamount;
        $newbalance1 = Auth::user()->wallet - $activationamount;
        if($activationamount != 0){
            if(Auth::user()->id != 2){
           $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','$userid','2','$activationamount','$ad_info', '$service_status','$time','$date','$userid','$newbalance1')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet + $activationamount where id = 2";
        DB::update( DB::raw( $sql ) );
        $service_status = 'IN Payment';
        $ad_info = 'Activation Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$userid','2','$userid','$activationamount','$ad_info', '$service_status','$time','$date','$userid','$newbalance')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet - $activationamount where id = $userid";
        DB::update( DB::raw( $sql ) );
            }

        $service_status = 'Out Payment';
       $ad_info = 'Activation Payment';
       $getrawallet = DB::table( 'users' )->select('nalavariyamwallet')->where('id',1)->first();
          $rawallet = 0;
          if($getrawallet){
            $balance1 = $getrawallet->nalavariyamwallet;
          }

          $getrawallet1 = DB::table( 'users' )->select('nalavariyamwallet')->where('id',2)->first();
          $rawallet1 = 0;
          if($getrawallet1){
            $balance2 = $getrawallet1->nalavariyamwallet;
          }
          $newbalance2 = $balance1 + $admin_amount;
          $newbalance3 = $balance2 - $admin_amount;
       $sql = "insert into nalavariyampayment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_amount','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
       DB::insert( DB::raw( $sql ) );
       $sql = "update users set nalavariyamwallet = nalavariyamwallet + $admin_amount where id = 1";
       DB::update( DB::raw( $sql ) );
       $service_status = 'IN Payment';
       $ad_info = 'Activation Payment';


       $sql = "insert into nalavariyampayment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_amount','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
       DB::insert( DB::raw( $sql ) );
       $sql = "update users set nalavariyamwallet = nalavariyamwallet - $admin_amount where id = 2";
       DB::update( DB::raw( $sql ) );
        }
    $updatenalavariyam_activation = DB::table('users')->where('id', $request->userid)->update([
        'aadhaar_no'              => $request->aadhaar_no,
        'address'                 => $request->address,
        'nalavariyam_taluk_id'    => $request->nalavariyam_taluk_id,
        'nalavariyam_dist_id'     => $request->nalavariyam_dist_id,
        'nalavariyam_usertype'    => $request->nalavariyam_usertype,
        'verified'                => $verify,
    ]);

    return redirect()->back()->with('success', 'User activation Updated Successfully ... !');
}
public function get_activationamount($usertype)
{
     $payment = DB::table('useractivation')->where('service_id',6)->where('parent_id',3)->first();
     $amount = 0;
      if($payment){
         if($usertype == 3){
          $amount = $payment->distributor_amount;
        }else{
            $amount = $payment->retailer_amount;
        }

     }
      $response['amount'] = $amount;
      return response()->json($response);
}

public function nalavariyam_checkaadhar( Request $request )
{
    $aadhaar_no = trim( $request->aadhaar_no );
    $id = trim( $request->id );
    if ( $id == 0 ) {
        $sql = "SELECT * FROM nalavariyam_customer where aadhaar_no='$aadhaar_no'";
    } else {
        $sql = "SELECT * FROM nalavariyam_customer where aadhaar_no='$aadhaar_no' and id <> $id";
    }
    $users = DB::select( DB::raw( $sql ) );
    if ( count( $users ) > 0 ) {
        return response()->json( array( 'exists' => true ) );
    } else {
        return response()->json( array( 'exists' => false ) );
    }
}

public function nalavariyam_checkphone( Request $request )
{
    $phone = trim( $request->phone );
    $id = trim( $request->id );
    if ( $id == 0 ) {
        $sql = "SELECT * FROM nalavariyam_customer where phone='$phone'";
    } else {
        $sql = "SELECT * FROM nalavariyam_customer where phone='$phone' and id <> $id";
    }
    $users = DB::select( DB::raw( $sql ) );
    if ( count( $users ) > 0 ) {
        return response()->json( array( 'exists' => true ) );
    } else {
        return response()->json( array( 'exists' => false ) );
    }
}

public function getnalavariyam_data($distid)
{
    $API_KEY = env( 'API_KEY', '' );
    $ch = curl_init();
    $post_data = "key=$API_KEY&dist_id=$distid";
    //dd($post_data);
    $website_url = "https://erp.nalavariyam.org";
    $url = $website_url.'/api/getdata';
    curl_setopt( $ch, CURLOPT_URL, $url );
    curl_setopt( $ch, CURLOPT_POST, 1 );
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_data );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    $server_output = curl_exec( $ch );
    curl_close( $ch );
    $resdata = json_decode($server_output, true);
    return response()->json($resdata);
}

public function appointment()
    {
        $appointment = DB::table('appointment_reg')->orderBy('id', 'Asc')->get();
        return view('nalavariyam/appointment', compact('appointment'));
    }

    public function add_appointment(Request $request)
    {
        // Determine user type
        if (Auth::user()->nalavariyam_usertype == '3') {
            $type = 'Distributor';
        } elseif (Auth::user()->nalavariyam_usertype == '4') {
            $type = 'Retailer';
        } else {
            $type = 'Unknown';
        }

        // Handle file upload (optional)
        $photo = null;
        if ($request->hasFile('photo')) {
            $photo    = uniqid() . '.' . $request->file('photo')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'nalavariyam_document' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
            $request->file('photo')->move($filepath, $photo);
        }

        // Check if this is an update (Resubmit)
        if (! empty($request->id)) {
            // ✅ UPDATE existing record
            $updateData = [
                'name'         => $request->name,
                'district'     => $request->district,
                'taluk'        => $request->taluk,
                'village'      => $request->village,
                'mobile'       => $request->mobile,
                'station_name' => $request->station_name,
                'date'         => date("Y-m-d"),
                'status'       => 'Pending',
            ];

            // Update photo only if a new one is uploaded
            if ($photo) {
                $updateData['photo'] = $photo;
            }

            DB::table('appointment_reg')->where('id', $request->id)->update($updateData);

            $message = 'Updated Successfully (Resubmitted) ... !';
        } else {
            $insertid = DB::table('appointment_reg')->insertGetId([
                'name'         => $request->name,
                'email'     => Auth::user()->email,
                'user_id'      => Auth::user()->id,
                'usertype'     => $type,
                'district'     => $request->district,
                'taluk'        => $request->taluk,
                'village'      => $request->village,
                'mobile'       => $request->mobile,
                'station_name' => $request->station_name,
                'is_completed' => '1',
                'date'         => date("Y-m-d"),
                'status'       => 'Pending',
                'photo'        => $photo,
            ]);

            $message = 'Register Successfully ... !';
        }

        // ✅ Update user completion flag
        DB::table('users')->where('id', Auth::user()->id)->update([
            'is_completed' => 1,
        ]);

        return redirect()->back()->with('success', $message);
    }

    public function update_appointment(Request $request)
    {

        $photo = null;
        if ($request->hasFile('certificate')) {
            $photo    = uniqid() . '.' . $request->file('certificate')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'nalavariyam_document' . DIRECTORY_SEPARATOR . 'certificate' . DIRECTORY_SEPARATOR);
            $request->file('certificate')->move($filepath, $photo);
        }
        DB::table('appointment_reg')->where('id', $request->id)->update([
            'status'  => $request->status,
            'remarks' => $request->remarks,
        ]);

        if ($photo) {
            DB::table('appointment_reg')->where('id', $request->id)->update(['certificate' => $photo]);
        }

        return redirect()->back()->with('success', 'Appointment Status Updated Successfully ... !');
    }
    
     public function view_appointment()
        {
            
            if(Auth::user()->user_type_id != 1){
                return redirect("/dashboard");
            }
            $appointment = DB::table('appointment_reg')->orderBy( 'id' , 'DESC' )->get();
            return view('view_appointment',compact('appointment'));
        }

}
