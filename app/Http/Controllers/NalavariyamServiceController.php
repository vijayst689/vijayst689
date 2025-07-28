<?php

namespace App\Http\Controllers;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NalavariyamServiceController extends Controller
{

  public function __construct()
  {
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
    if($request->has('from_date')){
        $from_date = $request->from_date;
    }
    if($request->has('to_date')){
        $to_date = $request->to_date;
    }
    $adduser = DB::table( 'nalavariyam_service' )->insert( [
        'service_name' => $request->service_name,
        'service_payment' => $request->service_payment,
        'status' => 'Active',
        'from_date' => $from_date,
        'to_date' => $to_date,
        'servicetype' => $request->servicetype,

    ] );

    $last_insert_id = DB::getPdo()->lastInsertId();
    $fromimage = '';
    if ( $request->from_image != null ) {
        $fromimage = $last_insert_id . '.' . $request->file( 'from_image' )->extension();
        $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'fromimg' . DIRECTORY_SEPARATOR );
        move_uploaded_file( $_FILES[ 'from_image' ][ 'tmp_name' ], $filepath . $fromimage );
    }
    $addimg = DB::table( 'nalavariyam_service' )->where( 'id', $last_insert_id )->update( [
        'from_image' => $fromimage,

    ] );

    if ( $request->has( 'dist_id' ) ) {
        foreach ( $request->input( 'dist_id' ) as $key => $type ) {
            $name = 'check_'.$type;
            $pre = $request[ $name ];
            $pre = $pre == '2' ? 2 : 1;
            DB::table( 'service_details' )->insert( [
                'service_id'       =>   $last_insert_id,
                'district_id'       =>   $type,
                'service_type'      =>   $pre
            ] );
        }
    }
    return redirect()->back()->with( 'success', 'Service Added Successfully ... !' );
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
    $rabalance = DB::table( 'users' )->select('rawallet')->where('id',2)->first();
    return view( 'nalavariyam/online_services', compact( 'services','balance','customers','rabalance') );
}

public function nalavariyam_servicepayment( Request $request ) {
    $service_id = $request->service_id;
    $customer_id = $request->customer_id;
    $customer_user_type_id = $request->customer_user_type_id;
    $amount = $request->pay_amount;
    $admin_amount = $request->admin_amount;
    $log_id = Auth::user()->id;
    $dist_id  = Auth::user()->nalavariyam_dist_id ;
    $taluk_id = Auth::user()->nalavariyam_taluk_id;
    $user_type_id = Auth::user()->nalavariyam_usertype;
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

  $getwallet = DB::table( 'users' )->select('wallet')->where('id',1)->first();
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
          $newbalance2 = $balance1 + $admin_amount;
          $newbalance3 = $balance2 - $admin_amount;
       $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_amount','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
       DB::insert( DB::raw( $sql ) );
       $sql = "update users set rawallet = rawallet + $admin_amount where id = 1";
       DB::update( DB::raw( $sql ) );
       $service_status = 'IN Payment';
       $ad_info = 'Service Payment'. ' '. $servicename;


       $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_amount','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
       DB::insert( DB::raw( $sql ) );
       $sql = "update users set rawallet = rawallet - $admin_amount where id = 2";
       DB::update( DB::raw( $sql ) );
  return redirect( "online_services/$customer_id" );
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
                    $result = DB::select( DB::raw( $sql ) );
                    $payments_id = $result[ 0 ]->id;
                    $time = date( 'H:i:s' );
                    $sql = "update nalavariyam_form set from_image='$fileName',service_id='$service_id',customer_id='$customer_id',customer_user_type_id='$customer_user_type_id',log_id='$user_id',service_status='Pending',dist_id='$dist_id',time='$time' where id=$payments_id";
                    DB::update( DB::raw( $sql ) );

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

    $addcustomer = DB::table( 'nalavariyam_customer' )->insert( [
        'name'       => $request->name,
        'district'   => $request->dist_id,
        'taluk'      => $request->taluk_id,
        'phone'      => $request->phone,
        'refferal'   => Auth::user()->id,
        'status'     => 'Active',

    ] );

    return redirect()->back()->with( 'success', 'Customer Added Successfully ... !' );
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
    $orderid = rand(000000,999999);
    $username = "7598984380";
    $token = "4d02b95e1731557716c68948638c1199";
    $url = "https://connect.ekychub.in/v3/verification/get_aadhaar_otp?username=$username&token=$token&aadhaar_number=$aadhaar&orderid=$orderid";
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
    $orderid = rand(000000,999999);
    $username = "7598984380";
    $token = "4d02b95e1731557716c68948638c1199";
    $url = "https://connect.ekychub.in/v3/verification/aadhaar_verify?username=$username&token=$token&aadhaar_number=$aadhaar&ref_id=$refid&otp=$otp&orderid=$orderid";
    $crl = curl_init();
    curl_setopt( $crl, CURLOPT_URL, $url );
    curl_setopt( $crl, CURLOPT_FRESH_CONNECT, true );
    curl_setopt( $crl, CURLOPT_RETURNTRANSFER, true );
    $data = curl_exec($crl);
        // $result["data"] = $data;

    curl_close($crl);
    $data = json_decode($data);
    if($data){
        if($data->status == "Success"){
            DB::table( 'users' )->where('id', $userid)->update([
                'name'                 => $data->name,
                'aadhaar_no'           => $aadhaar,
                'address'              => $data->address,
            ] );
        }
    }

    $result = $data;
        //echo "<pre>"; print_r($result); echo "</pre>";die;
    return response()->json($result);
}

public function updatenalavariyam_activation(Request $request)
{
    $verify = '1';
        //  dd($request->all());
    $activationamount = $request->activation_amount_hidden;
    $admin_amount = $request->admin_amount;
    $userid = $request->userid;

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

        $service_status = 'Out Payment';
       $ad_info = 'Activation Payment';
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
          $newbalance2 = $balance1 + $admin_amount;
          $newbalance3 = $balance2 - $admin_amount;
       $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_amount','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
       DB::insert( DB::raw( $sql ) );
       $sql = "update users set rawallet = rawallet + $admin_amount where id = 1";
       DB::update( DB::raw( $sql ) );
       $service_status = 'IN Payment';
       $ad_info = 'Activation Payment';


       $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_amount','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
       DB::insert( DB::raw( $sql ) );
       $sql = "update users set rawallet = rawallet - $admin_amount where id = 2";
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

}
