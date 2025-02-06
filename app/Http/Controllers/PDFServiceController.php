<?php

namespace App\Http\Controllers;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PDFServiceController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function addfindservice(){
    return view( 'panservice.addfindservice');
  }

  public function viewfind(){
    $find = DB::table( 'find_services' )->orderBy( 'id', 'Asc' )->get();
    return view( 'panservice.viewfind' ,compact('find'));
  }

  public function savefind( Request $request ) {
    DB::table( 'find_services' )->insert( [
      'name'        => $request->name,
      'amount'      => $request->amount,
      'date'        => date("Y-m-d H:i:s"),
      'status'      => 'Active',
    ] );

    $insertid = DB::getPdo()->lastInsertId();

    $ser_image = '';
    if ( $request->ser_image != null ) {
      $ser_image = $insertid.'.'.$request->file( 'ser_image' )->extension();
      $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'find_service' . DIRECTORY_SEPARATOR );
      move_uploaded_file( $_FILES[ 'ser_image' ][ 'tmp_name' ], $filepath . $ser_image );
    }
    $image = DB::table( 'find_services' )->where( 'id', $insertid )->update( [
      'ser_image' => $ser_image,
    ] );
    return redirect('/viewfind')->with('success', 'Find Service Added Successfully ... !');
  }

  public function updatefind( Request $request ) {
    DB::table( 'find_services' )->where('id', $request->findid)->update( [
      'name'     => $request->name,
      'amount'   => $request->amount,
    ] );

    if ( $request->ser_image != null ) {
      $ser_image = $request->findid.'.'.$request->file( 'ser_image' )->extension();
      $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'find_service' . DIRECTORY_SEPARATOR );
      move_uploaded_file( $_FILES[ 'ser_image' ][ 'tmp_name' ], $filepath . $ser_image );
      $image = DB::table( 'find_services' )->where( 'id', $request->findid )->update( [
        'ser_image' => $ser_image,
      ] );
    }

    return redirect()->back()->with( 'success', 'Find Service Updated Successfully' );
  }

  public function updatestatus( Request $request ) {
    DB::table( 'find_services' )->where('id', $request->statusid)->update( [
      'status'     => $request->status,
    ] );

    return redirect()->back()->with( 'success', 'Status Updated Successfully' );
  }

  public function pdfservices(){
    $usertype = Auth::user()->user_type_id;
    $checkpermission = DB::table( 'user_permission' )->where('user_id' , Auth::user()->id)->where('parent_id' , 1)->get();
    if(Auth::user()->user_type_id == 1 || Auth::user()->user_type_id == 5){
      $service = DB::table( 'find_services' )->where('status' , 'Active')->orderBy( 'id', 'ASC' )->get();
    }else{
      $service = DB::table( 'find_services' )->where('status' , 'Active')->whereIn('id',$checkpermission->pluck('service_id'))->orderBy( 'id', 'ASC' )->get();
    }

    $service = json_decode( json_encode( $service ), true );
    foreach ( $service as $key => $s ) {

      $serviceid = $s['id'];
      $getservice_payment = DB::table( 'find_payment' )->where('service_id',$serviceid)->first();
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
    return view( 'panservice.pdfservices',compact('service'));
  }

  public function applypdfservice($serviceid) {
    $getservicename = DB::table( 'find_services' )->where('id',$serviceid)->first();
    $servicename = "";
    $amount = 0;
    if($getservicename){
      $servicename = $getservicename->name;
      $amount = $getservicename->amount;
    }
    $getservice_payment = DB::table( 'find_payment' )->where('service_id',$serviceid)->first();
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
    if($serviceid == 1){
      $pandetails = DB::table( 'pancard_find' )->where('user_id',Auth::user()->id)->where('service_id',$serviceid)->orderBy( 'id', 'Desc' )->get();
      return view( 'panservice.panfind',compact('serviceid','servicename','payment','mainbalance','pandetails','amount'));
    }elseif($serviceid == 2){
      $pandetails = DB::table( 'pancard_find' )->where('user_id',Auth::user()->id)->where('service_id',$serviceid)->orderBy( 'id', 'Desc' )->get();
      return view( 'panservice.panadvance',compact('serviceid','servicename','payment','mainbalance','pandetails','amount'));
    }elseif( $serviceid == 3 ){
      $dldetails = DB::table( 'dl' )->where('user_id',Auth::user()->id)->orderBy( 'id', 'Desc' )->get();
      return view( 'pdfservice.dlservice',compact('serviceid','servicename','payment','mainbalance','dldetails','amount'));
    }elseif( $serviceid == 4 ){
      $rcdetails = DB::table( 'rc' )->where('user_id',Auth::user()->id)->orderBy( 'id', 'Desc' )->get();
      return view( 'pdfservice.rcservice',compact('serviceid','servicename','payment','mainbalance','rcdetails','amount'));
    }elseif( $serviceid == 5 ){
      $rationdetails = DB::table( 'ration' )->where('user_id',Auth::user()->id)->orderBy( 'id', 'Desc' )->get();
      return view( 'pdfservice.rationcardverify',compact('serviceid','servicename','payment','mainbalance','rationdetails','amount'));
    }elseif( $serviceid == 6 ){
      $voterdetails = DB::table( 'voter_find' )->where('user_id',Auth::user()->id)->where('service_id',$serviceid)->orderBy( 'id', 'Desc' )->get();
      return view( 'pdfservice.voterservice',compact('serviceid','servicename','payment','mainbalance','voterdetails','amount'));
  }elseif( $serviceid == 7 ){
      $voterdetails = DB::table( 'voter_find' )->where('user_id',Auth::user()->id)->where('service_id',$serviceid)->orderBy( 'id', 'Desc' )->get();
      return view( 'pdfservice.voteridpdf',compact('serviceid','servicename','payment','mainbalance','voterdetails','amount'));
  }
  }

  public function submitpanfind(Request $request){
    $user_id = Auth::user()->id;
    $aadhaar = $request->aadhaar_no;
    $amount = $request->amount;
    $servicepayment = $request->servicepayment;
    $serviceid = $request->serviceid;
    $apikey = '3e2a83212d3e5e4755390b84612f110d45d393c8c75946786de9ea4f283dcaa9'; // Base 64 api Key Here
    $application_no = rand(00000000,99999999); // Application Number

    $url = "https://goodapi.in/serviceApi/V1/panFind?apiKey=$apikey&order_id=$application_no&uidNumber=$aadhaar";

    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $resdata = json_decode($response,true);
    // dd($resdata);
    if($resdata){
      if($resdata['Status'] == "Success"){
        $pan=$resdata['pan_no'];
        $message=$resdata['message'];
         $name=$resdata['name'];
        $dob=$resdata['dob'];
        DB::table('pancard_find')->insert([
          'user_id' => Auth::user()->id,
          'aadhaar_no' => $request->aadhaar_no,
          'pan_no' => $pan,
          'service_id' => $serviceid,
          'amount' => $servicepayment,
          'message' => $message,
          'name' => $name,
          'dob' => $dob,
          'status'    => 'Approved',
          'date'    => date("Y-m-d "),
        ]);
        $date = date( 'Y-m-d' );
        $time = date( 'H:i:s' );
        $service_status = 'Out Payment';
        $ad_info = 'Ramji Wallet Debit(PanCard)';
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
          $newbalance2 = $balance1 + $amount;
          $newbalance3 = $balance2 - $amount;
        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$amount','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set rawallet = rawallet + $amount where id = 1";
        DB::update( DB::raw( $sql ) );
        $service_status = 'IN Payment';
        $ad_info = 'Ramji Wallet Credit(PanCard)';

        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$amount','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set rawallet = rawallet - $amount where id = 2";
        DB::update( DB::raw( $sql ) );

        if(Auth::user()->user_type_id != 2){
          $getservicename = DB::table( 'find_services' )->select('name')->where('id',$serviceid)->first();
          $servicename = "";
          if($getservicename){
            $servicename = $getservicename->name;
          }
          $date = date( 'Y-m-d' );
          $time = date( 'H:i:s' );
          $service_status = 'Out Payment';
          $ad_info = 'Service Payment'. ' '. $servicename;

          $getwallet = DB::table( 'users' )->select('wallet')->where('id',2)->first();
          $balance = 0;
          if($getwallet){
            $balance = $getwallet->wallet;
          }
          $newbalance = $balance + $servicepayment;
          $newbalance1 = Auth::user()->wallet - $servicepayment;

          $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
          DB::insert( DB::raw( $sql ) );
          $sql = "update users set wallet = wallet + $servicepayment where id = 2";
          DB::update( DB::raw( $sql ) );
          $service_status = 'IN Payment';
          $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
          DB::insert( DB::raw( $sql ) );
          $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
          DB::update( DB::raw( $sql ) );
        }
        return redirect('/applypdfservice/'.$serviceid)->with('success','Pan No Find Successfully');
      }else{
        $error=$resdata['message'];
        return redirect('/applypdfservice/'.$serviceid)->with('error',$error);
      }

    }else{
      return redirect('/applypdfservice/'.$serviceid)->with('error','Something Went Wrong..Please Check Aadhaar Number...');
    }

  }

  public function submitdlfind(Request $request){
    $user_id = Auth::user()->id;
    $dl_no = $request->dl_no;
    $dob = $request->dob;
    $apikey = '3e2a83212d3e5e4755390b84612f110d45d393c8c75946786de9ea4f283dcaa9';
    $amount = $request->amount;
    $servicepayment = $request->servicepayment;
    $serviceid = $request->serviceid;

    $url = "https://goodapi.in/serviceApi/V1/driving_licence_hd.php";

    $data = array(
      'apiKey' => $apikey,
      'dlNo' => $dl_no,
      'dob' => $dob
    );

    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => $data,
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    $resdata = json_decode($response, true);

    if($resdata['StatusCode'] == "100"){
      $pdf = $resdata['pdf'];
      $pdf_parts = explode(";base64", $pdf);
      $pdf_types = explode("pdf/", $pdf_parts[0]);
      $pdf_type = base64_decode($pdf_parts[1]);
      $filename = uniqid().'.pdf';
      file_put_contents('upload/dl/'.$filename,$pdf_type );
      $message = $resdata['message'];

      DB::table('dl')->insert([
        'user_id' => Auth::user()->id,
        'dlnumber' => $request->dl_no,
        'dob' => $dob,
        'pdf' => $filename,
        'service_id' => $serviceid,
        'amount' => $servicepayment,
        'status'    => 'Approved',
        'date'    => date("Y-m-d H:i:s"),
      ]);
      $date = date( 'Y-m-d' );
      $time = date( 'H:i:s' );
      $service_status = 'Out Payment';
      $ad_info = 'Ramji Wallet Debit(DL PDF)';
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
          $newbalance2 = $balance1 + $amount;
          $newbalance3 = $balance2 - $amount;
      $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$amount','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
      DB::insert( DB::raw( $sql ) );
      $sql = "update users set rawallet = rawallet + $amount where id = 1";
      DB::update( DB::raw( $sql ) );
      $service_status = 'IN Payment';
      $ad_info = 'Ramji Wallet Credit(DL PDF)';
      $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$amount','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
      DB::insert( DB::raw( $sql ) );
      $sql = "update users set rawallet = rawallet - $amount where id = 2";
      DB::update( DB::raw( $sql ) );

      if(Auth::user()->user_type_id != 2){
        $getservicename = DB::table( 'find_services' )->select('name')->where('id',$serviceid)->first();
        $servicename = "";
        if($getservicename){
          $servicename = $getservicename->name;
        }
        $date = date( 'Y-m-d' );
        $time = date( 'H:i:s' );
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment'. ' '. $servicename;

        $getwallet = DB::table( 'users' )->select('wallet')->where('id',2)->first();
        $balance = 0;
        if($getwallet){
          $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update( DB::raw( $sql ) );
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update( DB::raw( $sql ) );
      }

      return redirect('/applypdfservice/'.$serviceid)->with('success',$message);
    }else{
      $error=$resdata['error'];
      return redirect('/applypdfservice/'.$serviceid)->with('error',$error);
    }
  }

  public function submitrcfind(Request $request){
    $user_id = Auth::user()->id;
    $rc_no = $request->rc_no;
    $apikey = '3e2a83212d3e5e4755390b84612f110d45d393c8c75946786de9ea4f283dcaa9';
    $amount = $request->amount;
    $servicepayment = $request->servicepayment;
    $serviceid = $request->serviceid;
    $url = "https://goodapi.in/serviceApi/V1/Rc-Verification.php?apiKey=$apikey&rcno=$rc_no";
    $crl = curl_init();
    curl_setopt( $crl, CURLOPT_URL, $url );
    curl_setopt( $crl, CURLOPT_FRESH_CONNECT, true );
    curl_setopt( $crl, CURLOPT_RETURNTRANSFER, true );
    $result = curl_exec($crl);
    $result = json_decode($result,true);
    curl_close($crl);
    if($result){
      if($result['Status'] == "Success"){
       $name = $result['name'];
       $message = $result['message'];
       $pdf = $result['pdf'];
       $pdf_parts = explode(";base64", $pdf);
       $pdf_types = explode("pdf/", $pdf_parts[0]);
       $pdf_type = base64_decode($pdf_parts[1]);
       $filename = uniqid().'.pdf';
       file_put_contents('upload/rc/'.$filename,$pdf_type );

       DB::table('rc')->insert([
        'user_id' => Auth::user()->id,
        'rc_no' => $request->rc_no,
        'name' => $name,
        'pdf' => $filename,
        'service_id' => $serviceid,
        'amount' => $servicepayment,
        'status'    => 'Approved',
        'date'    => date("Y-m-d H:i:s"),
      ]);
       $date = date( 'Y-m-d' );
       $time = date( 'H:i:s' );
       $service_status = 'Out Payment';
       $ad_info = 'Ramji Wallet Debit(RC PDF)';
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
          $newbalance2 = $balance1 + $amount;
          $newbalance3 = $balance2 - $amount;
       $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$amount','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
       DB::insert( DB::raw( $sql ) );
       $sql = "update users set rawallet = rawallet + $amount where id = 1";
       DB::update( DB::raw( $sql ) );
       $service_status = 'IN Payment';
       $ad_info = 'Ramji Wallet Credit(RC PDF)';


       $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$amount','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
       DB::insert( DB::raw( $sql ) );
       $sql = "update users set rawallet = rawallet - $amount where id = 2";
       DB::update( DB::raw( $sql ) );

       if(Auth::user()->user_type_id != 2){
        $getservicename = DB::table( 'find_services' )->select('name')->where('id',$serviceid)->first();
        $servicename = "";
        if($getservicename){
          $servicename = $getservicename->name;
        }
        $date = date( 'Y-m-d' );
        $time = date( 'H:i:s' );
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment'. ' '. $servicename;

        $getwallet = DB::table( 'users' )->select('wallet')->where('id',2)->first();
        $balance = 0;
        if($getwallet){
          $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update( DB::raw( $sql ) );
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update( DB::raw( $sql ) );
      }

      return redirect('/applypdfservice/'.$serviceid)->with('success',$message);
    }else{
        $error=$result['error'];
      return redirect('/applypdfservice/'.$serviceid)->with('error',$error);
    }
  }else{
    return redirect('/applypdfservice/'.$serviceid)->with('error','Something Went Wrong.....');
  }

}


public function submitrationfind(Request $request){
  $user_id = Auth::user()->id;
  $aadhaar_no = $request->aadhaar_no;
  $apikey = '3e2a83212d3e5e4755390b84612f110d45d393c8c75946786de9ea4f283dcaa9';
  $amount = $request->amount;
  $servicepayment = $request->servicepayment;
  $serviceid = $request->serviceid;

  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL =>  "https://goodapi.in/serviceApi/V1/RashanVerificationBy_UID.php?apiKey=$apikey&uidNo=$aadhaar_no",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 25,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_SSL_VERIFYHOST => false,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "cache-control: no-cache",
    ),
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);
  $resdata = json_decode($response, true);
  $message=$resdata['message'];


  if($resdata['StatusCode'] == "100"){
    $pdf=$resdata['pdf'];
    $pdf_parts = explode(";base64", $pdf);
    $pdf_types = explode("pdf/", $pdf_parts[0]);
    $pdf_type = base64_decode($pdf_parts[1]);
    $filename = uniqid().'.pdf';
    file_put_contents('upload/smartpdf/'.$filename,$pdf_type );
    $name = $resdata['name'];

    DB::table('ration')->insert([
      'user_id'    => Auth::user()->id,
      'aadhaar_no' => $request->aadhaar_no,
      'name'       => $name,
      'pdf'        => $filename,
      'service_id' => $serviceid,
      'amount'     => $servicepayment,
      'status'     => 'Approved',
      'date'       => date("Y-m-d H:i:s"),
    ]);
    $date = date( 'Y-m-d' );
    $time = date( 'H:i:s' );
    $service_status = 'Out Payment';
    $ad_info = 'Ramji Wallet Debit(RATION PDF)';
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
          $newbalance2 = $balance1 + $amount;
          $newbalance3 = $balance2 - $amount;
 $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$amount','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
    DB::insert( DB::raw( $sql ) );
    $sql = "update users set rawallet = rawallet + $amount where id = 1";
    DB::update( DB::raw( $sql ) );
    $service_status = 'IN Payment';
    $ad_info = 'Ramji Wallet Credit(RATION PDF)';


    $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$amount','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
    DB::insert( DB::raw( $sql ) );
    $sql = "update users set rawallet = rawallet - $amount where id = 2";
    DB::update( DB::raw( $sql ) );

    if(Auth::user()->user_type_id != 2){
        $getservicename = DB::table( 'find_services' )->select('name')->where('id',$serviceid)->first();
        $servicename = "";
        if($getservicename){
          $servicename = $getservicename->name;
        }
        $date = date( 'Y-m-d' );
        $time = date( 'H:i:s' );
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment'. ' '. $servicename;

        $getwallet = DB::table( 'users' )->select('wallet')->where('id',2)->first();
        $balance = 0;
        if($getwallet){
          $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update( DB::raw( $sql ) );
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update( DB::raw( $sql ) );
      }

    return redirect('/applypdfservice/'.$serviceid)->with('success',$message);


  }else{
    $message=$resdata['message'];

    return redirect('/applypdfservice/'.$serviceid)->with('error',$message);
  }

}

public function submitpanadvance(Request $request){
  $user_id = Auth::user()->id;
  $pan_no = $request->pan_no;
  $apikey = '3e2a83212d3e5e4755390b84612f110d45d393c8c75946786de9ea4f283dcaa9';
  $amount = $request->amount;
  $servicepayment = $request->servicepayment;
  $serviceid = $request->serviceid;

  $curl = curl_init();
  curl_setopt_array($curl, array(
  CURLOPT_URL =>  "https://goodapi.in/serviceApi/V1/panVerification.php?apiKey=$apikey&panNumber=$pan_no",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_SSL_VERIFYPEER => false,
  CURLOPT_SSL_VERIFYHOST => false,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
  "cache-control: no-cache",
  ),
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);
  $resdata = json_decode($response, true);

  $message=$resdata['message'];

  if($resdata['StatusCode'] == "100"){
      $dob = $resdata['dob'];
      $name = $resdata['name'];
      $gender = $resdata['gender'];
      DB::table('pancard_find')->insert([
          'user_id' => Auth::user()->id,
          'pan_no' => $request->pan_no,
          'name' => $name,
          'dob' => $dob,
          'gender' => $gender,
          'service_id' => $serviceid,
          'amount' => $servicepayment,
          'message' => $message,
          'status'    => 'Approved',
          'date'    => date("Y-m-d H:i:s"),
      ]);
      $date = date( 'Y-m-d' );
      $time = date( 'H:i:s' );
      $service_status = 'Out Payment';
      $ad_info = 'Ramji Wallet Debit(PANADVANCE VERIFY)';
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
        $newbalance2 = $balance1 + $amount;
        $newbalance3 = $balance2 - $amount;
      $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$amount','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
      DB::insert( DB::raw( $sql ) );
      $sql = "update users set rawallet = rawallet + $amount where id = 1";
      DB::update( DB::raw( $sql ) );
      $service_status = 'IN Payment';
      $ad_info = 'Ramji Wallet Credit(PANADVANCE VERIFY)';

      $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$amount','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
      DB::insert( DB::raw( $sql ) );
      $sql = "update users set rawallet = rawallet - $amount where id = 2";
      DB::update( DB::raw( $sql ) );

      if(Auth::user()->user_type_id != 2){
      $getservicename = DB::table( 'find_services' )->select('name')->where('id',$serviceid)->first();
      $servicename = "";
      if($getservicename){
        $servicename = $getservicename->name;
      }
      $date = date( 'Y-m-d' );
      $time = date( 'H:i:s' );
      $service_status = 'Out Payment';
      $ad_info = 'Service Payment'. ' '. $servicename;

      $getwallet = DB::table( 'users' )->select('wallet')->where('id',2)->first();
      $balance = 0;
      if($getwallet){
        $balance = $getwallet->wallet;
      }
      $newbalance = $balance + $servicepayment;
      $newbalance1 = Auth::user()->wallet - $servicepayment;

      $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
      DB::insert( DB::raw( $sql ) );
      $sql = "update users set wallet = wallet + $servicepayment where id = 2";
      DB::update( DB::raw( $sql ) );
      $service_status = 'IN Payment';
      $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
      DB::insert( DB::raw( $sql ) );
      $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
      DB::update( DB::raw( $sql ) );
    }

      return redirect('/applypdfservice/'.$serviceid)->with('success',$message);
  }else{
      $error=$resdata['error'];
      return redirect('/applypdfservice/'.$serviceid)->with('error',$error);
  }
}

public function getepic($epic_no) {
  $apikey = "3e2a83212d3e5e4755390b84612f110d45d393c8c75946786de9ea4f283dcaa9";
  $url = "https://goodapi.in/serviceApi/V1/VCM/Vcm-Search.php?epic=$epic_no&apiKey=$apikey";
  $crl = curl_init();
  curl_setopt( $crl, CURLOPT_URL, $url );
  curl_setopt( $crl, CURLOPT_FRESH_CONNECT, true );
  curl_setopt( $crl, CURLOPT_RETURNTRANSFER, true );
  $result = curl_exec($crl);
  $result = json_decode($result);
  curl_close($crl);
  return response()->json( $result );
}


public function getotp($mobile) {
  $apikey = "3e2a83212d3e5e4755390b84612f110d45d393c8c75946786de9ea4f283dcaa9";
  $url = "https://goodapi.in/serviceApi/V1/VCM/Vcm-Sent-Tp.php?mobile_no=$mobile";
  $crl = curl_init();
  curl_setopt( $crl, CURLOPT_URL, $url );
  curl_setopt( $crl, CURLOPT_FRESH_CONNECT, true );
  curl_setopt( $crl, CURLOPT_RETURNTRANSFER, true );
  $result = curl_exec($crl);
  $result = json_decode($result);
  curl_close($crl);
  return response()->json( $result );
}


public function submitvoterfind(Request $request){
  $user_id = Auth::user()->id;
  $epic_no = $request->epic_no;
  $name = $request->name;
  $state = $request->state;
  $phone = $request->mobile;
  $otp = $request->otp;
  $apikey = '3e2a83212d3e5e4755390b84612f110d45d393c8c75946786de9ea4f283dcaa9';
  $amount = $request->amount;
  $servicepayment = $request->servicepayment;
  $serviceid = $request->serviceid;

      $url = "https://goodapi.in/serviceApi/V1/VCM/Vcm-link.php?apiKey=$apikey&epic=$epic_no&otp=$otp&mobile_no=$phone";
      $crl = curl_init();
      curl_setopt( $crl, CURLOPT_URL, $url );
      curl_setopt( $crl, CURLOPT_FRESH_CONNECT, true );
      curl_setopt( $crl, CURLOPT_RETURNTRANSFER, true );
      $result = curl_exec($crl);
      $resdata = json_decode($result);
      curl_close($crl);
  $message=$resdata->message;

  if($resdata->StatusCode == "100"){
      DB::table('voter_find')->insert([
          'user_id' => Auth::user()->id,
          'service_id' => $serviceid,
          'epic_no' => $request->epic_no,
          'name' => $name,
          'mobile' => $phone,
          'state_name' => $state,
          'message' => $message,
          'amount' => $servicepayment,
          'status'    => 'Approved',
          'date'    => date("Y-m-d H:i:s"),
      ]);
      $date = date( 'Y-m-d' );
      $time = date( 'H:i:s' );
      $service_status = 'Out Payment';
      $ad_info = 'Ramji Wallet Debit(Voter Mobile Link)';
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
        $newbalance2 = $balance1 + $amount;
        $newbalance3 = $balance2 - $amount;
      $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$amount','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
      DB::insert( DB::raw( $sql ) );
      $sql = "update users set rawallet = rawallet + $amount where id = 1";
      DB::update( DB::raw( $sql ) );
      $service_status = 'IN Payment';
      $ad_info = 'Ramji Wallet Credit(Voter Mobile Link)';

      $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$amount','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
      DB::insert( DB::raw( $sql ) );
      $sql = "update users set rawallet = rawallet - $amount where id = 2";
      DB::update( DB::raw( $sql ) );

      if(Auth::user()->user_type_id != 2){
      $getservicename = DB::table( 'find_services' )->select('name')->where('id',$serviceid)->first();
      $servicename = "";
      if($getservicename){
        $servicename = $getservicename->name;
      }
      $date = date( 'Y-m-d' );
      $time = date( 'H:i:s' );
      $service_status = 'Out Payment';
      $ad_info = 'Service Payment'. ' '. $servicename;

      $getwallet = DB::table( 'users' )->select('wallet')->where('id',2)->first();
      $balance = 0;
      if($getwallet){
        $balance = $getwallet->wallet;
      }
      $newbalance = $balance + $servicepayment;
      $newbalance1 = Auth::user()->wallet - $servicepayment;

      $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
      DB::insert( DB::raw( $sql ) );
      $sql = "update users set wallet = wallet + $servicepayment where id = 2";
      DB::update( DB::raw( $sql ) );
      $service_status = 'IN Payment';
      $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
      DB::insert( DB::raw( $sql ) );
      $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
      DB::update( DB::raw( $sql ) );
    }

      return redirect('/applypdfservice/'.$serviceid)->with('success',$message);
  }else{
      $error=$resdata->error;
      return redirect('/applypdfservice/'.$serviceid)->with('error',$error);
  }
}

public function getpdfotp($epic_no) {

  $apikey = "3e2a83212d3e5e4755390b84612f110d45d393c8c75946786de9ea4f283dcaa9";
  $url = "https://goodapi.in/serviceApi/V1/VCPFD/Vc_Send_Tp.php?apiKey=$apikey&epic=$epic_no";
  $crl = curl_init();
  curl_setopt( $crl, CURLOPT_URL, $url );
  curl_setopt( $crl, CURLOPT_FRESH_CONNECT, true );
  curl_setopt( $crl, CURLOPT_RETURNTRANSFER, true );
  $result = curl_exec($crl);
  $result = json_decode($result);
  curl_close($crl);
  return response()->json( $result );
}

public function submitvoterpdf(Request $request){
  // dd($request->all());
  $user_id = Auth::user()->id;
  $epic_no = $request->epic_no;
  $name = $request->name;
  $otp = $request->otp;
  $stateCd = $request->stateCd;
  $apikey = '3e2a83212d3e5e4755390b84612f110d45d393c8c75946786de9ea4f283dcaa9';
  $amount = $request->amount;
  $servicepayment = $request->servicepayment;
  $serviceid = $request->serviceid;

      $url = "https://goodapi.in/serviceApi/V1/VCPFD/Vc_Verification_Tp.php?apiKey=$apikey&stateCd=$stateCd&otp=$otp&epic=$epic_no";
      $crl = curl_init();
      curl_setopt( $crl, CURLOPT_URL, $url );
      curl_setopt( $crl, CURLOPT_FRESH_CONNECT, true );
      curl_setopt( $crl, CURLOPT_RETURNTRANSFER, true );
      $result = curl_exec($crl);
      $resdata = json_decode($result);
      curl_close($crl);

  if($resdata->StatusCode == "100"){
      $message=$resdata->message;
      $pdf=$resdata->pdf;
      $pdf_parts = explode(";base64", $pdf);
      $pdf_types = explode("pdf/", $pdf_parts[0]);
      $pdf_type = base64_decode($pdf_parts[1]);
      $filename = uniqid().'.pdf';
      file_put_contents('upload/voterpdf/'.$filename,$pdf_type );

          DB::table('voter_find')->insert([
          'user_id'    => Auth::user()->id,
          'service_id' => $serviceid,
          'epic_no'    => $request->epic_no,
          'scode'      => $request->stateCd,
          'name'       => $name,
          'pdf'        => $filename,
          'message'    => $message,
          'amount'     => $servicepayment,
          'status'     => 'Approved',
          'date'       => date("Y-m-d H:i:s"),
      ]);
      $date = date( 'Y-m-d' );
      $time = date( 'H:i:s' );
      $service_status = 'Out Payment';
      $ad_info = 'Ramji Wallet Debit(Voter Mobile Link)';
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
        $newbalance2 = $balance1 + $amount;
        $newbalance3 = $balance2 - $amount;
      $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$amount','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
      DB::insert( DB::raw( $sql ) );
      $sql = "update users set rawallet = rawallet + $amount where id = 1";
      DB::update( DB::raw( $sql ) );
      $service_status = 'IN Payment';
      $ad_info = 'Ramji Wallet Credit(Voter Mobile Link)';

      $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$amount','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
      DB::insert( DB::raw( $sql ) );
      $sql = "update users set rawallet = rawallet - $amount where id = 2";
      DB::update( DB::raw( $sql ) );

      if(Auth::user()->user_type_id != 2){
      $getservicename = DB::table( 'find_services' )->select('name')->where('id',$serviceid)->first();
      $servicename = "";
      if($getservicename){
        $servicename = $getservicename->name;
      }
      $date = date( 'Y-m-d' );
      $time = date( 'H:i:s' );
      $service_status = 'Out Payment';
      $ad_info = 'Service Payment'. ' '. $servicename;

      $getwallet = DB::table( 'users' )->select('wallet')->where('id',2)->first();
      $balance = 0;
      if($getwallet){
        $balance = $getwallet->wallet;
      }
      $newbalance = $balance + $servicepayment;
      $newbalance1 = Auth::user()->wallet - $servicepayment;

      $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
      DB::insert( DB::raw( $sql ) );
      $sql = "update users set wallet = wallet + $servicepayment where id = 2";
      DB::update( DB::raw( $sql ) );
      $service_status = 'IN Payment';
      $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
      DB::insert( DB::raw( $sql ) );
      $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
      DB::update( DB::raw( $sql ) );
    }

      return redirect('/applypdfservice/'.$serviceid)->with('success',$message);
  }else{
      $error=$resdata->error;
      return redirect('/applypdfservice/'.$serviceid)->with('error',$error);
  }
}


}
