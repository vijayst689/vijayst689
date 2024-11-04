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

  public function allservices($customerid)
  {
      $ourservice = DB::table('services')->where('status','=' , 'Active')->where('parent_id',0 )->orderBy( 'id' , 'Asc' )->get();
      return view('services.allservices',compact('ourservice','customerid'));
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

    $insertid = DB::getPdo()->lastInsertId();

    $service_image = "";
    if ($request->service_image != null) {
        $service_image = $insertid.'.'.$request->file('service_image')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'service' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['service_image']['tmp_name'], $filepath . $service_image);
    }
    $image = DB::table( 'services' )->where( 'id', $insertid )->update( [
        'service_image'    => $service_image,
    ] );

    return redirect( "/viewservice" )->with('success', 'Service Add Successfully ... !');
  }

  public function updateservice( Request $request ) {
    DB::table( 'services' )->where('id', $request->service_id)->update( [
        'service_name'  => $request->service_name,
        'status'        => $request->status,
    ] );

    $service_image = "";
    if ($request->service_image != null) {
      $service_image = $request->service_id.'.'.$request->file('service_image')->extension();
      $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'service' . DIRECTORY_SEPARATOR);
      move_uploaded_file($_FILES['service_image']['tmp_name'], $filepath . $service_image);
      $sql = "update services set service_image='$service_image' where id = $request->service_id";
      DB::update(DB::raw($sql));
  }

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
        'status'        => $request->status,
    ] );

    return redirect()->back()->with( 'success', 'SubService Updated Successfully' );
}

public function services($serviceid,$customerid) {
    $services = DB::table('services')->where('status', '=' , 'Active')->where('parent_id',$serviceid)->orderBy( 'id' , 'Asc' )->get();
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

   return view('services.services',compact( 'services','customers','customerid','serviceid'));
   }

   public function applyservice($serviceid,$customerid) {
    $districts = DB::table( 'district' )->get();
    $getservicename = DB::table( 'services' )->where('id',$serviceid)->first();
    $servicename = "";
    $amount = 0;
    if($getservicename){
       $servicename = $getservicename->service_name;
       $amount = $getservicename->amount;
   }
   $getservice_payment = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
   $payment = 0;
   if($getservice_payment){
       if(Auth::user()->user_type_id == 3){
           $payment = $getservice_payment->distributor_amount;
       }elseif(Auth::user()->user_type_id == 4){
           $payment = $getservice_payment->retailer_amount;
       }elseif(Auth::user()->user_type_id == 5){
           $payment = $getservice_payment->customer_amount;
       }
   }
   $customers = DB::table( 'users' )->where('id',$customerid)->first();
           //dd($customers);
   if($serviceid == 2){
       return view( 'applyservice.tnegaservice1',compact('serviceid','districts','servicename','amount','customers','payment'));
   } elseif ($serviceid == 3){

       return view( 'applyservice.tnegaservice1',compact('serviceid','districts','servicename','amount','customers','payment'));

   } elseif ($serviceid == 4){
       return view( 'applyservice.tnegaservice1',compact('serviceid','districts','servicename','amount','customers','payment'));

   } elseif ($serviceid == 11){
       return view( 'applyservice.tnegaservice1',compact('serviceid','districts','servicename','amount','customers','payment'));

   } elseif ($serviceid == 14 || $serviceid == 15){
       return view( 'applyservice.tnegaservice1',compact('serviceid','districts','servicename','amount','customers','payment'));

   } elseif ($serviceid == 20){
       return view( 'applyservice.tnegaservice1',compact('serviceid','districts','servicename','amount','customers','payment'));

   } elseif ($serviceid == 22 || $serviceid == 23 || $serviceid == 24 || $serviceid == 25 || $serviceid == 26){
    return view( 'applyservice.tnegaservice2',compact('serviceid','districts','servicename','amount','customers','payment'));

   } elseif ($serviceid == 17){
       return view( 'backend.services.applyservice1',compact('serviceid','districts','servicename','amount','customers','payment'));

   } elseif ($serviceid == 32){
       return view( 'backend.services.applyservice2',compact('serviceid','districts','servicename','amount','customers','payment'));

   } elseif ($serviceid == 27 || $serviceid == 28 || $serviceid == 129){
    return view( 'applyservice.tnegaservice3',compact('serviceid','districts','servicename','amount','customers','payment'));

   } elseif ($serviceid == 34){
       return view( 'applyservice.msmeservice',compact('serviceid','districts','servicename','amount','customers','payment'));

   } elseif ($serviceid == 36 || $serviceid == 37 || $serviceid == 38 || $serviceid == 39 || $serviceid == 41 || $serviceid == 42 || $serviceid == 43 ){
       $districts = DB::table( 'district' )->where('id','!=',3)->get();
       return view( 'applyservice.smartcardapply',compact('serviceid','districts','servicename','amount','customers','payment'));

   } elseif ($serviceid == 39){
       return view( 'backend.services.applyservice6',compact('serviceid','districts','servicename','amount','customers','payment'));

   } elseif ($serviceid == 41){
       return view( 'backend.services.applyservice6',compact('serviceid','districts','servicename','amount','customers','payment'));

   } elseif ($serviceid == 42){
       return view( 'backend.services.applyservice6',compact('serviceid','districts','servicename','amount','customers','payment'));

   }  elseif ($serviceid == 43){
       return view( 'backend.services.applyservice6',compact('serviceid','districts','servicename','amount','customers','payment'));

   }  elseif ($serviceid == 51){
       return view( 'applyservice.itrservice',compact('serviceid','districts','servicename','amount','customers','payment'));

   }  elseif ($serviceid == 52){
       return view( 'applyservice.gstservice',compact('serviceid','districts','servicename','amount','customers','payment'));

   }  elseif ($serviceid == 54){
       return view( 'applyservice.techexamservice',compact('serviceid','districts','servicename','amount','customers','payment'));

   }  elseif ($serviceid == 55){
       return view( 'applyservice.techexamregister',compact('serviceid','districts','servicename','amount','customers','payment'));

   }elseif ($serviceid == 124){
    return view( 'applyservice.techcorrectionservice',compact('serviceid','districts','servicename','amount','customers','payment'));

    } elseif ($serviceid == 60 || $serviceid == 62 || $serviceid == 63 || $serviceid == 64 || $serviceid == 65 || $serviceid == 66 || $serviceid == 67 || $serviceid == 121){
           return view( 'applyservice.caneditservice',compact('serviceid','districts','servicename','amount','customers','payment'));

   } elseif ($serviceid == 56 || $serviceid == 58){
       return view( 'applyservice.aadhaarcard_apply',compact('serviceid','districts','servicename','amount','customers','payment'));

   }elseif ($serviceid == 71){
           return view( 'applyservice.panservice',compact('serviceid','districts','servicename','amount','customers','payment'));

   } elseif ($serviceid == 113 || $serviceid == 120){
       return view( 'applyservice.voteridservice',compact('serviceid','districts','servicename','amount','customers','payment'));

   }  elseif ($serviceid == 72){
       return view( 'applyservice.find_aadhaarcard_number',compact('serviceid','districts','servicename','amount','customers','payment'));

   }  elseif ($serviceid == 95 || $serviceid == 96 || $serviceid == 97 || $serviceid == 98){
       return view( 'applyservice.nalavariyamservice',compact('serviceid','districts','servicename','amount','customers','payment'));

   }elseif ( $serviceid == 77 || $serviceid == 78 ||  $serviceid == 79 || $serviceid == 80 || $serviceid == 81 || $serviceid == 82 || $serviceid == 83 || $serviceid == 84){
        return view( 'applyservice.smartcardapply1',compact('serviceid','districts','servicename','amount','customers','payment'));

   }elseif ( $serviceid == 100 ){
        return view( 'applyservice.bondapply',compact('serviceid','districts','servicename','amount','customers','payment'));
   } elseif ( $serviceid == 122 ){
       return view( 'applyservice.fssaiservice_apply',compact('serviceid','districts','servicename','amount','customers','payment'));
   } elseif ( $serviceid == 125 ){
    return view( 'applyservice.covidservice',compact('serviceid','districts','servicename','amount','customers','payment'));
}
   }

   public function submitaadhaar(Request $request){

    $user_id = 0;
    $retailer_id = 0;
    $distributor_id = 0;
    if(Auth::user()->user_type_id == 3){
        $user_id = $request ->user_id;
        $distributor_id = Auth::user()->id;
    }elseif(Auth::user()->user_type_id == 4){
        $user_id = $request ->user_id;
        $retailer_id = Auth::user()->id;
    } elseif(Auth::user()->user_type_id == 5){
        $user_id = Auth::user()->id;
    }
    $serviceid = $request ->serviceid;
    if($serviceid == 56){
        DB::table( 'aadhaarcard' )->insert( [
         'user_id'           => $user_id,
         'retailer_id'       => $retailer_id,
         'distributor_id'    => $distributor_id,
         'service_id'        => $request ->serviceid,
         'amount'            => $request->amount,
         'name'              => $request->name,
         'mobile'            => $request->mobile,
         'name_tamil'        => $request->name_tamil,
         'name_english'      => $request->name_english,
         'address_tamil'     => $request->address_tamil,
         'address_english'   => $request->address_english,
         'relationship'      => $request->relationship,
         'status'            => 'Pending',
         'applied_date'      => date("Y-m-d"),
         'created_at'        => date("Y-m-d"),
     ] );

        $insertid = DB::getPdo()->lastInsertId();
        $aadhaarimg = "";
        $photo = "";
        $signature = "";

        if ($request->aadhaar_card != null) {
          $aadhaarimg = uniqid().'.'.$request->file('aadhaar_card')->extension();
          $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
          move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);

      }
      DB::table('aadhaarcard')->where('id', $insertid)->update([
        'aadhaar_card' => $aadhaarimg,
    ]);
      if ($request->photo != null) {
          $photo = uniqid().'.'.$request->file('photo')->extension();
          $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
          move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);

      }
      DB::table('aadhaarcard')->where('id', $insertid)->update([
        'photo' => $photo,
    ]);

      if ($request->signature != null) {
          $signature = uniqid().'.'.$request->file('signature')->extension();
          $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'signature' . DIRECTORY_SEPARATOR);
          move_uploaded_file($_FILES['signature']['tmp_name'], $filepath . $signature);

      }
      DB::table('aadhaarcard')->where('id', $insertid)->update([
        'signature' => $signature,
    ]);
  } elseif($serviceid == 58){
    DB::table( 'aadhaarcard' )->insert( [
        'user_id'           => $user_id,
        'retailer_id'       => $retailer_id,
        'distributor_id'    => $distributor_id,
        'service_id'        => $request ->serviceid,
        'amount'            => $request->amount,
        'name'              => $request->name,
        'mobile'            => $request->mobile,
        'name_tamil'        => $request->name_tamil,
        'name_english'      => $request->name_english,
        'address_tamil'     => $request->address_tamil,
        'address_english'   => $request->address_english,
        'address_proof'     => $request->address_proof,
        'relationship'      => $request->relationship,
        'status'            => 'Pending',
        'applied_date'      => date("Y-m-d"),
        'created_at'        => date("Y-m-d"),
    ] );

    $insertid = DB::getPdo()->lastInsertId();
    $aadhaarimg = "";
    $photo = "";
    $signature = "";


    if ($request->aadhaar_card != null) {
     $aadhaarimg = uniqid().'.'.$request->file('aadhaar_card')->extension();
     $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
     move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);

 }
 DB::table('aadhaarcard')->where('id', $insertid)->update([
   'aadhaar_card' => $aadhaarimg,
]);
 if ($request->photo != null) {
     $photo = uniqid().'.'.$request->file('photo')->extension();
     $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
     move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);

 }
 DB::table('aadhaarcard')->where('id', $insertid)->update([
   'photo' => $photo,
]);

 if ($request->signature != null) {
     $signature = uniqid().'.'.$request->file('signature')->extension();
     $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'signature' . DIRECTORY_SEPARATOR);
     move_uploaded_file($_FILES['signature']['tmp_name'], $filepath . $signature);

 }
 DB::table('aadhaarcard')->where('id', $insertid)->update([
   'signature' => $signature,
]);

 if ($request->proof != null) {
     $proof = uniqid().'.'.$request->file('proof')->extension();
     $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'proof' . DIRECTORY_SEPARATOR);
     move_uploaded_file($_FILES['proof']['tmp_name'], $filepath . $proof);

 }
 DB::table('aadhaarcard')->where('id', $insertid)->update([
   'proof' => $proof,
]);
}
$servicepayment = $request->service_amount;
if(Auth::user()->user_type_id == 3){
  $user_id = $distributor_id;
}elseif(Auth::user()->user_type_id == 4){
  $user_id = $retailer_id;
}elseif(Auth::user()->user_type_id == 5){
  $user_id = $user_id;
}
$date = date( 'Y-m-d' );
$time = date( 'H:i:s' );
$service_status = 'Out Payment';
$ad_info = 'Service Payment';
$sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id')";
DB::insert( DB::raw( $sql ) );
$sql = "update users set wallet = wallet + $servicepayment where id = 2";
DB::update( DB::raw( $sql ) );
$service_status = 'IN Payment';
$ad_info = 'Service Payment';
$sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id')";
DB::insert( DB::raw( $sql ) );
$sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
DB::update( DB::raw( $sql ) );

return redirect("appliedservice/Pending")->With("success","Application submitted Succesfully");

}
public function submitfindaadhaar_number(Request $request){

    $user_id = 0;
    $retailer_id = 0;
    $distributor_id = 0;
    if(Auth::user()->user_type_id == 3){
        $user_id = $request ->user_id;
        $distributor_id = Auth::user()->id;
    }elseif(Auth::user()->user_type_id == 4){
        $user_id = $request ->user_id;
        $retailer_id = Auth::user()->id;
    } elseif(Auth::user()->user_type_id == 5){
        $user_id = Auth::user()->id;
    }
    $serviceid = $request ->serviceid;
    DB::table( 'aadhaarcard' )->insert( [
     'user_id'           => $user_id,
     'retailer_id'       => $retailer_id,
     'distributor_id'    => $distributor_id,
     'service_id'        => $request ->serviceid,
     'amount'            => $request->amount,
     'name'              => $request->name,
     'documents'         => $request->documents,
     'pan_card_no'       => $request->pan_card_no,
     'smart_link_no'     => $request->smart_link_no,
     'status'            => 'Pending',
     'applied_date'      => date("Y-m-d"),
     'created_at'        => date("Y-m-d"),
 ] );

    $insertid = DB::getPdo()->lastInsertId();
    $aadhaar_entrolment_slip = "";

    if ($request->aadhaar_entrolment_slip != null) {
      $aadhaar_entrolment_slip = uniqid().'.'.$request->file('aadhaar_entrolment_slip')->extension();
      $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_entrolment_slip' . DIRECTORY_SEPARATOR);
      move_uploaded_file($_FILES['aadhaar_entrolment_slip']['tmp_name'], $filepath . $aadhaar_entrolment_slip);

  }
  DB::table('aadhaarcard')->where('id', $insertid)->update([
    'aadhaar_entrolment_slip' => $aadhaar_entrolment_slip,
]);




  $servicepayment = $request->service_amount;
  if(Auth::user()->user_type_id == 3){
      $user_id = $distributor_id;
  }elseif(Auth::user()->user_type_id == 4){
      $user_id = $retailer_id;
  }elseif(Auth::user()->user_type_id == 5){
      $user_id = $user_id;
  }
  $date = date( 'Y-m-d' );
  $time = date( 'H:i:s' );
  $service_status = 'Out Payment';
  $ad_info = 'Service Payment';
  $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id')";
  DB::insert( DB::raw( $sql ) );
  $sql = "update users set wallet = wallet + $servicepayment where id = 2";
  DB::update( DB::raw( $sql ) );
  $service_status = 'IN Payment';
  $ad_info = 'Service Payment';
  $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id')";
  DB::insert( DB::raw( $sql ) );
  $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
  DB::update( DB::raw( $sql ) );

  return redirect("appliedservice/Pending")->With("success","Application submitted Succesfully");

}

   public function submitapply_tnegaservices1(Request $request){

    $user_id = 0;
    $retailer_id = 0;
    $distributor_id = 0;
    if(Auth::user()->user_type_id == 3){
        $user_id = $request ->user_id;
        $distributor_id = Auth::user()->id;
    }elseif(Auth::user()->user_type_id == 4){
        $user_id = $request ->user_id;
        $retailer_id = Auth::user()->id;
    } elseif(Auth::user()->user_type_id == 5){
        $user_id = Auth::user()->id;
    }
    $serviceid = $request ->serviceid;
    DB::table( 'tnega_services' )->insert( [
        'user_id'  =>   $user_id,
        'retailer_id'  =>   $retailer_id,
        'distributor_id'  =>   $distributor_id,
        'service_id'    => $request ->serviceid,
        'amount'        => $request->amount,
        'status'        => 'Pending',
        'applied_date'  => date("Y-m-d"),
        'created_at'    => date("Y-m-d"),
    ] );

    $insertid = DB::getPdo()->lastInsertId();
    if($serviceid == 2){
        $salaryslip = "";
        $pancard = "";
        if ($request->salary_slip != null) {
            $salaryslip = uniqid().'.'.$request->file('salary_slip')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'salary_slip' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['salary_slip']['tmp_name'], $filepath . $salaryslip);
        }

        if ($request->pancard != null) {
            $pancard = uniqid().'.'.$request->file('pancard')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'pancard' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['pancard']['tmp_name'], $filepath . $pancard);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'job_type'            => $request->job_type,
            'salary_slip'         => $salaryslip,
            'pancard'             => $pancard,
            'income_yearly'       => $request->income_yearly,
            'income_monthly'      => $request->income_monthly,
        ]);

    }elseif($serviceid == 3){
            $tc_community_certificate = "";
            if ($request->tc_community_certificate != null) {
                $tc_community_certificate = uniqid().'.'.$request->file('tc_community_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'tc_community_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['tc_community_certificate']['tmp_name'], $filepath . $tc_community_certificate);
            }
             DB::table('tnega_services')->where('id', $insertid)->update([
                'relationship'                     => $request->relationship,
                'tc_community_certificate'         => $tc_community_certificate,
            ]);
        }
        elseif($serviceid == 4){
            $income_certificate = "";
            if ($request->income_certificate != null) {
                $income_certificate = uniqid().'.'.$request->file('income_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'income_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['income_certificate']['tmp_name'], $filepath . $income_certificate);
            }
            $community_certificate = "";
            if ($request->community_certificate != null) {
                $community_certificate = uniqid().'.'.$request->file('community_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'community_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['community_certificate']['tmp_name'], $filepath . $community_certificate);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'income_certificate'         => $income_certificate,
                'community_certificate'         => $community_certificate,
            ]);
        }elseif($serviceid == 11){
            $birth_certificate = "";
            if ($request->birth_certificate != null) {
                $birth_certificate = uniqid().'.'.$request->file('birth_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'birth_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['birth_certificate']['tmp_name'], $filepath . $birth_certificate);
            }
             DB::table('tnega_services')->where('id', $insertid)->update([
                'birth_certificate'         => $birth_certificate,
            ]);
        } elseif($serviceid == 14){
            $smartcard_online = "";
            if ($request->smartcard_online != null) {
                $smartcard_online = uniqid().'.'.$request->file('smartcard_online')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'smartcard_online' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['smartcard_online']['tmp_name'], $filepath . $smartcard_online);
            }

            DB::table('tnega_services')->where('id', $insertid)->update([
                'smartcard_no'             => $request->smartcard_no,
                'smartcard_online'         => $smartcard_online,
            ]);
        }
        elseif($serviceid == 20){
            DB::table( 'tnega_services' )->insert( [
                'user_id'       =>   $user_id,
                'retailer_id'   =>   $retailer_id,
                'distributor_id'=>   $distributor_id,
                'service_id'    => $request ->serviceid,
                'amount'        => $request->amount,
                'age_proof'     => $request->age_proof,
                'status'        => 'Pending',
                'applied_date'  => date("Y-m-d"),
                'created_at'    => date("Y-m-d"),
            ] );
            $birth_certificate = "";
            if ($request->birth_certificate != null) {
                $birth_certificate = uniqid().'.'.$request->file('birth_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'birth_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['birth_certificate']['tmp_name'], $filepath . $birth_certificate);
            }
             DB::table('tnega_services')->where('id', $insertid)->update([
                'birth_certificate'         => $birth_certificate,
            ]);
            $voterid = "";
            if ($request->voterid != null) {
                $voterid = uniqid().'.'.$request->file('voterid')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'voterid' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['voterid']['tmp_name'], $filepath . $voterid);
            }
             DB::table('tnega_services')->where('id', $insertid)->update([
                'voterid'         => $voterid,
            ]);
            $driving_license = "";
            if ($request->driving_license != null) {
                $driving_license = uniqid().'.'.$request->file('driving_license')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'driving_license' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['driving_license']['tmp_name'], $filepath . $driving_license);
            }
             DB::table('tnega_services')->where('id', $insertid)->update([
                'driving_license'         => $driving_license,
            ]);
            $marksheet = "";
            if ($request->marksheet != null) {
                $marksheet = uniqid().'.'.$request->file('marksheet')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'marksheet' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['marksheet']['tmp_name'], $filepath . $marksheet);
            }
             DB::table('tnega_services')->where('id', $insertid)->update([
                'marksheet'         => $marksheet,
            ]);
            $tc_community_certificate = "";
            if ($request->tc_community_certificate != null) {
                $tc_community_certificate = uniqid().'.'.$request->file('tc_community_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'tc_community_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['tc_community_certificate']['tmp_name'], $filepath . $tc_community_certificate);
            }
             DB::table('tnega_services')->where('id', $insertid)->update([
                'tc_community_certificate'         => $tc_community_certificate,
            ]);
            $mrg_invitation = "";
            if ($request->mrg_invitation != null) {
                $mrg_invitation = uniqid().'.'.$request->file('mrg_invitation')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'mrg_invitation' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['mrg_invitation']['tmp_name'], $filepath . $mrg_invitation);
            }
             DB::table('tnega_services')->where('id', $insertid)->update([
                'mrg_invitation'         => $mrg_invitation,
            ]);

        }


    $servicepayment = $request->service_amount;
    if(Auth::user()->user_type_id == 3){
        $user_id = $distributor_id;
    }elseif(Auth::user()->user_type_id == 4){
        $user_id = $retailer_id;
    }elseif(Auth::user()->user_type_id == 5){
        $user_id = $user_id;
    }
    $date = date( 'Y-m-d' );
    $time = date( 'H:i:s' );
    $service_status = 'Out Payment';
    $ad_info = 'Service Payment';
    $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id')";
    DB::insert( DB::raw( $sql ) );
    $sql = "update users set wallet = wallet + $servicepayment where id = 2";
    DB::update( DB::raw( $sql ) );
    $service_status = 'IN Payment';
    $ad_info = 'Service Payment';
    $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id')";
    DB::insert( DB::raw( $sql ) );
    $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
    DB::update( DB::raw( $sql ) );

    return redirect("appliedservice/Pending")->With("success","Application submitted Succesfully");

}

public function submitapply_tnegaservices2(Request $request){

    $user_id = 0;
    $retailer_id = 0;
    $distributor_id = 0;
    if(Auth::user()->user_type_id == 3){
        $user_id = $request ->user_id;
        $distributor_id = Auth::user()->id;
    }elseif(Auth::user()->user_type_id == 4){
        $user_id = $request ->user_id;
        $retailer_id = Auth::user()->id;
    } elseif(Auth::user()->user_type_id == 5){
        $user_id = Auth::user()->id;
    }
    $serviceid = $request ->serviceid;
    DB::table( 'tnega_services' )->insert( [
        'user_id'  =>   $user_id,
        'retailer_id'  =>   $retailer_id,
        'distributor_id'  =>   $distributor_id,
        'service_id'    => $request ->serviceid,
        'amount'        => $request->amount,
        'can_details'        => $request->can_details,
        'can_number'        => $request->can_number,
        'status'        => 'Pending',
        'applied_date'  => date("Y-m-d"),
        'created_at'    => date("Y-m-d"),
    ] );

    $insertid = DB::getPdo()->lastInsertId();
    if($serviceid == 22){
        $hus_wife_photo = "";
        if ($request->hus_wife_photo != null) {
            $hus_wife_photo = uniqid().'.'.$request->file('hus_wife_photo')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'hus_wife_photo' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['hus_wife_photo']['tmp_name'], $filepath . $hus_wife_photo);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'hus_wife_photo'         => $hus_wife_photo,
        ]);
        $permanent_social_certificate_groom = "";
        if ($request->permanent_social_certificate_groom != null) {
            $permanent_social_certificate_groom = uniqid().'.'.$request->file('permanent_social_certificate_groom')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'permanent_social_certificate_groom' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['permanent_social_certificate_groom']['tmp_name'], $filepath . $permanent_social_certificate_groom);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'permanent_social_certificate_groom'         => $permanent_social_certificate_groom,
        ]);
        $bride_permanent_social_certificate = "";
        if ($request->bride_permanent_social_certificate != null) {
            $bride_permanent_social_certificate = uniqid().'.'.$request->file('bride_permanent_social_certificate')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'bride_permanent_social_certificate' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['bride_permanent_social_certificate']['tmp_name'], $filepath . $bride_permanent_social_certificate);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'bride_permanent_social_certificate'         => $bride_permanent_social_certificate,
        ]);
        $mrg_registration_certificate = "";
        if ($request->mrg_registration_certificate != null) {
            $mrg_registration_certificate = uniqid().'.'.$request->file('mrg_registration_certificate')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'mrg_registration_certificate' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['mrg_registration_certificate']['tmp_name'], $filepath . $mrg_registration_certificate);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'mrg_registration_certificate'         => $mrg_registration_certificate,
        ]);
        $anyothers_certificate = "";
        if ($request->anyothers_certificate != null) {
            $anyothers_certificate = uniqid().'.'.$request->file('anyothers_certificate')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'anyothers_certificate' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['anyothers_certificate']['tmp_name'], $filepath . $anyothers_certificate);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'anyothers_certificate'         => $anyothers_certificate,
        ]);
    }elseif ($serviceid == 23) {
        $chitta = "";
        if ($request->chitta != null) {
            $chitta = uniqid().'.'.$request->file('chitta')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'chitta' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['chitta']['tmp_name'], $filepath . $chitta);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'chitta'         => $chitta,
        ]);
        $aggregation = "";
        if ($request->aggregation != null) {
            $aggregation = uniqid().'.'.$request->file('aggregation')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aggregation' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['aggregation']['tmp_name'], $filepath . $aggregation);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'aggregation'         => $aggregation,
        ]);
        $ec_certificate = "";
        if ($request->ec_certificate != null) {
            $ec_certificate = uniqid().'.'.$request->file('ec_certificate')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'ec_certificate' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['ec_certificate']['tmp_name'], $filepath . $ec_certificate);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'ec_certificate'         => $ec_certificate,
        ]);
        $villankam = "";
        if ($request->villankam != null) {
            $villankam = uniqid().'.'.$request->file('villankam')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'villankam' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['villankam']['tmp_name'], $filepath . $villankam);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'villankam'         => $villankam,
        ]);
        $vao_certificate = "";
        if ($request->vao_certificate != null) {
            $vao_certificate = uniqid().'.'.$request->file('vao_certificate')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'vao_certificate' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['vao_certificate']['tmp_name'], $filepath . $vao_certificate);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'vao_certificate'         => $vao_certificate,
        ]);
        $self_declaration_certificate = "";
        if ($request->self_declaration_certificate != null) {
            $self_declaration_certificate = uniqid().'.'.$request->file('self_declaration_certificate')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'self_declaration_certificate' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['self_declaration_certificate']['tmp_name'], $filepath . $self_declaration_certificate);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'self_declaration_certificate'         => $self_declaration_certificate,
        ]);
        $other_certificate = "";
        if ($request->other_certificate != null) {
            $other_certificate = uniqid().'.'.$request->file('other_certificate')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'other_certificate' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['other_certificate']['tmp_name'], $filepath . $other_certificate);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'other_certificate'         => $other_certificate,
        ]);
    }
    elseif ($serviceid == 24) {
        $bank_pass_book = "";
        if ($request->bank_pass_book != null) {
            $bank_pass_book = uniqid().'.'.$request->file('bank_pass_book')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'bank_pass_book' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['bank_pass_book']['tmp_name'], $filepath . $bank_pass_book);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'bank_pass_book'         => $bank_pass_book,
            'any_proof'         => $request->any_proof,
        ]);
        $passport = "";
        if ($request->passport != null) {
            $passport = uniqid().'.'.$request->file('passport')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'passport' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['passport']['tmp_name'], $filepath . $passport);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'passport'         => $passport,
        ]);
        $pancard = "";
        if ($request->pancard != null) {
            $pancard = uniqid().'.'.$request->file('pancard')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'pancard' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['pancard']['tmp_name'], $filepath . $pancard);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'pancard'         => $pancard,
        ]);
        $voterid = "";
        if ($request->voterid != null) {
            $voterid = uniqid().'.'.$request->file('voterid')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'voterid' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['voterid']['tmp_name'], $filepath . $voterid);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'voterid'         => $voterid,
        ]);
        $driving_license = "";
        if ($request->driving_license != null) {
            $driving_license = uniqid().'.'.$request->file('driving_license')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'driving_license' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['driving_license']['tmp_name'], $filepath . $driving_license);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'driving_license'         => $driving_license,
        ]);
    }   elseif ($serviceid == 25) {
        $placement_registration = "";
        if ($request->placement_registration != null) {
            $placement_registration = uniqid().'.'.$request->file('placement_registration')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'placement_registration' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['placement_registration']['tmp_name'], $filepath . $placement_registration);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'placement_registration'         => $placement_registration,
        ]);
        $school_transfer_certificate = "";
        if ($request->school_transfer_certificate != null) {
            $school_transfer_certificate = uniqid().'.'.$request->file('school_transfer_certificate')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'school_transfer_certificate' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['school_transfer_certificate']['tmp_name'], $filepath . $school_transfer_certificate);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'school_transfer_certificate'         => $school_transfer_certificate,
        ]);
        $study_proof = "";
        if ($request->study_proof != null) {
            $study_proof = uniqid().'.'.$request->file('study_proof')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'study_proof' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['study_proof']['tmp_name'], $filepath . $study_proof);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'study_proof'         => $study_proof,
        ]);
        $family_income_certificate = "";
        if ($request->family_income_certificate != null) {
            $family_income_certificate = uniqid().'.'.$request->file('family_income_certificate')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'family_income_certificate' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['family_income_certificate']['tmp_name'], $filepath . $family_income_certificate);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'family_income_certificate'         => $family_income_certificate,
        ]);
    }
    elseif ($serviceid == 26) {
        $husband_death_certificate = "";
        if ($request->husband_death_certificate != null) {
            $husband_death_certificate = uniqid().'.'.$request->file('husband_death_certificate')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'husband_death_certificate' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['husband_death_certificate']['tmp_name'], $filepath . $husband_death_certificate);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'husband_death_certificate'         => $husband_death_certificate,
        ]);
        $legal_heir_certificate = "";
        if ($request->legal_heir_certificate != null) {
            $legal_heir_certificate = uniqid().'.'.$request->file('legal_heir_certificate')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'legal_heir_certificate' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['legal_heir_certificate']['tmp_name'], $filepath . $legal_heir_certificate);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'legal_heir_certificate'         => $legal_heir_certificate,
        ]);
        $income_certificate = "";
        if ($request->income_certificate != null) {
            $income_certificate = uniqid().'.'.$request->file('income_certificate')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'income_certificate' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['income_certificate']['tmp_name'], $filepath . $income_certificate);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'income_certificate'         => $income_certificate,
        ]);
        $anyothers_certificate = "";
        if ($request->anyothers_certificate != null) {
            $anyothers_certificate = uniqid().'.'.$request->file('anyothers_certificate')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'anyothers_certificate' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['anyothers_certificate']['tmp_name'], $filepath . $anyothers_certificate);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'anyothers_certificate'         => $anyothers_certificate,
        ]);
    }


    $servicepayment = $request->service_amount;
    if(Auth::user()->user_type_id == 3){
        $user_id = $distributor_id;
    }elseif(Auth::user()->user_type_id == 4){
        $user_id = $retailer_id;
    }elseif(Auth::user()->user_type_id == 5){
        $user_id = $user_id;
    }
    $date = date( 'Y-m-d' );
    $time = date( 'H:i:s' );
    $service_status = 'Out Payment';
    $ad_info = 'Service Payment';
    $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id')";
    DB::insert( DB::raw( $sql ) );
    $sql = "update users set wallet = wallet + $servicepayment where id = 2";
    DB::update( DB::raw( $sql ) );
    $service_status = 'IN Payment';
    $ad_info = 'Service Payment';
    $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id')";
    DB::insert( DB::raw( $sql ) );
    $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
    DB::update( DB::raw( $sql ) );

    return redirect("appliedservice/Pending")->With("success","Application submitted Succesfully");

}

public function submitapply_tnegaservices3(Request $request){

    $user_id = 0;
    $retailer_id = 0;
    $distributor_id = 0;
    if(Auth::user()->user_type_id == 3){
        $user_id = $request ->user_id;
        $distributor_id = Auth::user()->id;
    }elseif(Auth::user()->user_type_id == 4){
        $user_id = $request ->user_id;
        $retailer_id = Auth::user()->id;
    } elseif(Auth::user()->user_type_id == 5){
        $user_id = Auth::user()->id;
    }
    $serviceid = $request ->serviceid;
    DB::table( 'tnega_services' )->insert( [
        'user_id'  =>   $user_id,
        'retailer_id'  =>   $retailer_id,
        'distributor_id'  =>   $distributor_id,
        'service_id'    => $request ->serviceid,
        'amount'        => $request->amount,
        'can_details'        => $request->can_details,
        'can_number'        => $request->can_number,
        'status'        => 'Pending',
        'applied_date'  => date("Y-m-d"),
        'created_at'    => date("Y-m-d"),
    ] );

    $insertid = DB::getPdo()->lastInsertId();
    if($serviceid == 27){
        DB::table('tnega_services')->where('id', $insertid)->update([
            'any_proof'         => $request->id_proof,
        ]);
        $husband_death_certificate = "";
        if ($request->husband_death_certificate != null) {
            $husband_death_certificate = uniqid().'.'.$request->file('husband_death_certificate')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'husband_death_certificate' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['husband_death_certificate']['tmp_name'], $filepath . $husband_death_certificate);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'husband_death_certificate'         => $husband_death_certificate,
        ]);
        $widow_certificate = "";
        if ($request->widow_certificate != null) {
            $widow_certificate = uniqid().'.'.$request->file('widow_certificate')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'widow_certificate' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['widow_certificate']['tmp_name'], $filepath . $widow_certificate);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'widow_certificate'         => $widow_certificate,
        ]);
        $bank_pass_book = "";
        if ($request->bank_pass_book != null) {
            $bank_pass_book = uniqid().'.'.$request->file('bank_pass_book')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'bank_pass_book' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['bank_pass_book']['tmp_name'], $filepath . $bank_pass_book);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'bank_pass_book'         => $bank_pass_book,
        ]);
        $passport = "";
        if ($request->passport != null) {
            $passport = uniqid().'.'.$request->file('passport')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'passport' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['passport']['tmp_name'], $filepath . $passport);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'passport'         => $passport,
        ]);
        $pancard = "";
        if ($request->pancard != null) {
            $pancard = uniqid().'.'.$request->file('pancard')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'pancard' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['pancard']['tmp_name'], $filepath . $pancard);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'pancard'         => $pancard,
        ]);
        $voterid = "";
        if ($request->voterid != null) {
            $voterid = uniqid().'.'.$request->file('voterid')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'voterid' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['voterid']['tmp_name'], $filepath . $voterid);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'voterid'         => $voterid,
        ]);
        $driving_license = "";
        if ($request->driving_license != null) {
            $driving_license = uniqid().'.'.$request->file('driving_license')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'driving_license' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['driving_license']['tmp_name'], $filepath . $driving_license);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'driving_license'         => $driving_license,
        ]);
    } elseif ($serviceid == 28) {
        DB::table('tnega_services')->where('id', $insertid)->update([
            'mrg_docdetails'         => $request->mrg_docdetails,
        ]);
        $husband_death_certificate = "";
        if ($request->husband_death_certificate != null) {
            $husband_death_certificate = uniqid().'.'.$request->file('husband_death_certificate')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'husband_death_certificate' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['husband_death_certificate']['tmp_name'], $filepath . $husband_death_certificate);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'husband_death_certificate'         => $husband_death_certificate,
        ]);
        $mrg_invitation = "";
        if ($request->mrg_invitation != null) {
            $mrg_invitation = uniqid().'.'.$request->file('mrg_invitation')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'mrg_invitation' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['mrg_invitation']['tmp_name'], $filepath . $mrg_invitation);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'mrg_invitation'         => $mrg_invitation,
        ]);
        $mrg_registration_certificate = "";
        if ($request->mrg_registration_certificate != null) {
            $mrg_registration_certificate = uniqid().'.'.$request->file('mrg_registration_certificate')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'mrg_registration_certificate' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['mrg_registration_certificate']['tmp_name'], $filepath . $mrg_registration_certificate);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'mrg_registration_certificate'         => $mrg_registration_certificate,
        ]);
        $mrg_documents = "";
        if ($request->mrg_documents != null) {
            $mrg_documents = uniqid().'.'.$request->file('mrg_documents')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'mrg_documents' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['mrg_documents']['tmp_name'], $filepath . $mrg_documents);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'mrg_documents'         => $mrg_documents,
        ]);
    }elseif ($serviceid == 129) {
        $tc_community_certificate = "";
        if ($request->tc_community_certificate != null) {
            $tc_community_certificate = uniqid().'.'.$request->file('tc_community_certificate')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'tc_community_certificate' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['tc_community_certificate']['tmp_name'], $filepath . $tc_community_certificate);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'tc_community_certificate'         => $tc_community_certificate,
        ]);
    }
    $servicepayment = $request->service_amount;
    if(Auth::user()->user_type_id == 3){
        $user_id = $distributor_id;
    }elseif(Auth::user()->user_type_id == 4){
        $user_id = $retailer_id;
    }elseif(Auth::user()->user_type_id == 5){
        $user_id = $user_id;
    }
    $date = date( 'Y-m-d' );
    $time = date( 'H:i:s' );
    $service_status = 'Out Payment';
    $ad_info = 'Service Payment';
    $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id')";
    DB::insert( DB::raw( $sql ) );
    $sql = "update users set wallet = wallet + $servicepayment where id = 2";
    DB::update( DB::raw( $sql ) );
    $service_status = 'IN Payment';
    $ad_info = 'Service Payment';
    $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id')";
    DB::insert( DB::raw( $sql ) );
    $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
    DB::update( DB::raw( $sql ) );

    return redirect("appliedservice/Pending")->With("success","Application submitted Succesfully");

}


public function submitapply_msme(Request $request){

    $user_id = 0;
    $retailer_id = 0;
    $distributor_id = 0;
    if(Auth::user()->user_type_id == 3){
        $user_id = $request ->user_id;
        $distributor_id = Auth::user()->id;
    }elseif(Auth::user()->user_type_id == 4){
        $user_id = $request ->user_id;
        $retailer_id = Auth::user()->id;
    } elseif(Auth::user()->user_type_id == 5){
        $user_id = Auth::user()->id;
    }
    $serviceid = $request ->serviceid;
    DB::table( 'msme' )->insert( [
        'user_id'  =>   $user_id,
        'distributor_id'  =>   $distributor_id,
        'retailer_id'  =>   $retailer_id,
        'service_id'    => $request ->serviceid,
        'amount'        => $request->amount,
        'name'        => $request->name,
        'mobile'        => $request->mobile,
        'dist_id'        => $request->dist_id,
        'taluk_id'        => $request->taluk_id,
        'panchayath_id'        => $request->panchayath_id,
        'cmp_name'        => $request->cmp_name,
        'community'        => $request->community,
        'building_name'        => $request->building_name,
        'ward_no'        => $request->ward_no,
        'pin_code'        => $request->pin_code,
        'account_no'        => $request->account_no,
        'confirm_account_no'=> $request->confirm_account_no,
        'ifsc_code'         => $request->ifsc_code,
        'micr_no'         => $request->micr_no,
        'male_count'        => $request->male_count,
        'female_count'      => $request->female_count,
        'amount_in_lakhs'   => $request->amount_in_lakhs,
        'gst'               => $request->gst,
        'gst_number'        => $request->gst_number,
        'itr'               => $request->itr,
        'organization'      => $request->organization,
        'category_of_work'  => $request->category_of_work,
        'status'        => 'Pending',
        'applied_date'  => date("Y-m-d"),
        'created_at'    => date("Y-m-d"),
    ] );
    $insertid = DB::getPdo()->lastInsertId();
    $aadhaarimg = "";
    $pancardimg = "";

    if ($request->aadhaar_card != null) {
        $aadhaarimg = uniqid().'.'.$request->file('aadhaar_card')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);

    }

    if ($request->pan_card != null) {
        $pancardimg = uniqid().'.'.$request->file('pan_card')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'pan_card' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['pan_card']['tmp_name'], $filepath . $pancardimg);

    }

    DB::table('msme')->where('id', $insertid)->update([
        'aadhaar_card' => $aadhaarimg,
        'pan_card'     => $pancardimg,
    ]);

    if($serviceid == 34){
        $itr_form = "";
        if ($request->itr_form != null) {
            $itr_form = uniqid().'.'.$request->file('itr_form')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'itr_form' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['itr_form']['tmp_name'], $filepath . $itr_form);
        }
        DB::table('msme')->where('id', $insertid)->update([
            'itr_form'         => $itr_form,
        ]);
    }
    $servicepayment = $request->service_amount;
    if(Auth::user()->user_type_id == 3){
        $user_id = $distributor_id;
    }elseif(Auth::user()->user_type_id == 4){
        $user_id = $retailer_id;
    }elseif(Auth::user()->user_type_id == 5){
        $user_id = $user_id;
    }
    $date = date( 'Y-m-d' );
    $time = date( 'H:i:s' );
    $service_status = 'Out Payment';
    $ad_info = 'Service Payment';
    $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id')";
    DB::insert( DB::raw( $sql ) );
    $sql = "update users set wallet = wallet + $servicepayment where id = 2";
    DB::update( DB::raw( $sql ) );
    $service_status = 'IN Payment';
    $ad_info = 'Service Payment';
    $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id')";
    DB::insert( DB::raw( $sql ) );
    $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
    DB::update( DB::raw( $sql ) );

    return redirect("appliedservice/Pending")->With("success","Application submitted Succesfully");

}


public function submitsmartcard_register(Request $request){

    $user_id = 0;
    $retailer_id = 0;
    $distributor_id = 0;
    if(Auth::user()->user_type_id == 3){
        $user_id = $request ->user_id;
        $distributor_id = Auth::user()->id;
    }elseif(Auth::user()->user_type_id == 4){
        $user_id = $request ->user_id;
        $retailer_id = Auth::user()->id;
    } elseif(Auth::user()->user_type_id == 5){
        $user_id = Auth::user()->id;
    }
    $serviceid = $request ->serviceid;
    if($serviceid == 36){
        DB::table( 'smartcard' )->insert( [
       'user_id'                   => $user_id,
       'retailer_id'               => $retailer_id,
       'distributor_id'            => $distributor_id,
       'service_id'                => $request ->serviceid,
       'amount'                    => $request->amount,
       'family_head_name'          => $request->family_head_name,
       'father_or_husband_tamil'   => $request->father_or_husband_tamil,
       'father_or_husband_english' => $request->father_or_husband_english,
       'name_tamil'                => $request->name_tamil,
       'name_english'              => $request->name_english,
       'name'                      => $request->name,
       'mobile'                    => $request->mobile,
       'pin_code'                  => $request->pin_code,
       'address_tamil_1'           => $request->address_tamil_1,
       'address_tamil_2'           => $request->address_tamil_2,
       'address_tamil_3'           => $request->address_tamil_3,
       'address_english_1'         => $request->address_english_1,
       'address_english_2'         => $request->address_english_2,
       'address_english_3'         => $request->address_english_3,
       'monthly_income'            => $request->monthly_income,
       'gas_connection_no'         => $request->gas_connection_no,
       'card_selection'            => $request->card_selection,
       'residence_proof'           => $request->residence_proof,
       'email_id'                  => $request->email_id,
       'dist_id'                   => $request->dist_id,
       'status'                    => 'Pending',
       'applied_date'              => date("Y-m-d"),
       'created_at'                => date("Y-m-d"),
      ] );
      if($request->has('relationship')){
        foreach ( $request->relationship as $key => $relation ) {
          $relation_name = $request->relation_name[ $key ];
          $relation_dob = $request->relation_dob[ $key ];
          $maritial_status = $request->maritial_status[ $key ];

          $sql = "insert into smartcard_family_member (user_id,relation,relation_name,maritial_status,relation_dob) values ($user_id,'$relation','$relation_name','$maritial_status','$relation_dob')";
          DB::insert( $sql );
          $relation_id = DB::getPdo()->lastInsertId();
            if ($request->doc[$key] != null) {
              $aadhaarcard = uniqid().'.'.$request->file('doc')[$key]->extension();
              $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'users' . DIRECTORY_SEPARATOR . 'relationaadhaar_card' . DIRECTORY_SEPARATOR);
              move_uploaded_file($_FILES['doc']['tmp_name'][$key], $filepath . $aadhaarcard);
              DB::table( 'smartcard_family_member' )->where( 'id', $relation_id )->update( [
                'relationaadhaar_card'       => $aadhaarcard,
              ] );
            }
          }
        }
      $insertid = DB::getPdo()->lastInsertId();
      $aadhaarimg = "";
      $electricity_bill_receipt = "";
      $family_head_photo = "";
      $commodity_card = "";
      $smart_card = "";

      if ($request->aadhaar_card != null) {
          $aadhaarimg = uniqid().'.'.$request->file('aadhaar_card')->extension();
          $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
          move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);
      }
         DB::table('smartcard')->where('id', $insertid)->update([
            'aadhaar_card' => $aadhaarimg,
      ]);

      if ($request->family_head_photo != null) {
          $family_head_photo = uniqid().'.'.$request->file('family_head_photo')->extension();
          $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'family_head_photo' . DIRECTORY_SEPARATOR);
          move_uploaded_file($_FILES['family_head_photo']['tmp_name'], $filepath . $family_head_photo);
      }
         DB::table('smartcard')->where('id', $insertid)->update([
            'family_head_photo' => $family_head_photo,
      ]);

      if ($request->commodity_card != null) {
        $commodity_card = uniqid().'.'.$request->file('commodity_card')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'commodity_card' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['commodity_card']['tmp_name'], $filepath . $commodity_card);
    }
       DB::table('smartcard')->where('id', $insertid)->update([
          'commodity_card' => $commodity_card,
    ]);

    if ($request->smart_card != null) {
        $smart_card = uniqid().'.'.$request->file('smart_card')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smart_card);
    }
       DB::table('smartcard')->where('id', $insertid)->update([
          'smart_card' => $smart_card,
    ]);

    if ($request->electricity_bill_receipt != null) {
        $electricity_bill_receipt = uniqid().'.'.$request->file('electricity_bill_receipt')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'electricity_bill' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['electricity_bill_receipt']['tmp_name'], $filepath . $electricity_bill_receipt);
    }
       DB::table('smartcard')->where('id', $insertid)->update([
          'electricity_bill_receipt' => $electricity_bill_receipt,
    ]);
    $telephone_charges = "";
    if ($request->telephone_charges != null) {
        $telephone_charges = uniqid().'.'.$request->file('telephone_charges')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'telephonebill' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['telephone_charges']['tmp_name'], $filepath . $telephone_charges);
    }
    DB::table('smartcard')->where('id', $insertid)->update([
        'telephone_charges'         => $telephone_charges,
    ]);

    $voter_id = "";
    if ($request->voter_id != null) {
        $voter_id = uniqid().'.'.$request->file('voter_id')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'voterid' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['voter_id']['tmp_name'], $filepath . $voter_id);
    }
    DB::table('smartcard')->where('id', $insertid)->update([
        'voter_id'         => $voter_id,
    ]);

    $passport = "";
    if ($request->passport != null) {
        $passport = uniqid().'.'.$request->file('passport')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'passport' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['passport']['tmp_name'], $filepath . $passport);
    }
    DB::table('smartcard')->where('id', $insertid)->update([
        'passport'         => $passport,
    ]);

    $gas_cylinder_receipt = "";
    if ($request->gas_cylinder_receipt != null) {
        $gas_cylinder_receipt = uniqid().'.'.$request->file('gas_cylinder_receipt')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'gas_cylinder' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['gas_cylinder_receipt']['tmp_name'], $filepath . $gas_cylinder_receipt);
    }
    DB::table('smartcard')->where('id', $insertid)->update([
        'gas_cylinder_receipt'         => $gas_cylinder_receipt,
    ]);

    $property_tax_applicant_owns_house = "";
    if ($request->property_tax_applicant_owns_house != null) {
        $property_tax_applicant_owns_house = uniqid().'.'.$request->file('property_tax_applicant_owns_house')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'property_tax' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['property_tax_applicant_owns_house']['tmp_name'], $filepath . $property_tax_applicant_owns_house);
    }
    DB::table('smartcard')->where('id', $insertid)->update([
        'property_tax_applicant_owns_house'         => $property_tax_applicant_owns_house,
    ]);

    $lease_deed = "";
    if ($request->lease_deed != null) {
        $lease_deed = uniqid().'.'.$request->file('lease_deed')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'lease_deed' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['lease_deed']['tmp_name'], $filepath . $lease_deed);
    }
    DB::table('smartcard')->where('id', $insertid)->update([
        'lease_deed'         => $lease_deed,
    ]);

    $allotment_rder_of_slum_replacement_board = "";
    if ($request->allotment_rder_of_slum_replacement_board != null) {
        $allotment_rder_of_slum_replacement_board = uniqid().'.'.$request->file('allotment_rder_of_slum_replacement_board')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'allotment' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['allotment_rder_of_slum_replacement_board']['tmp_name'], $filepath . $lease_deed);
    }
    DB::table('smartcard')->where('id', $insertid)->update([
        'allotment_rder_of_slum_replacement_board' => $allotment_rder_of_slum_replacement_board,
    ]);

    $first_page_of_bank_account_book = "";
    if ($request->first_page_of_bank_account_book != null) {
        $bond_leave_proof = uniqid().'.'.$request->file('first_page_of_bank_account_book')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'first_page_of_bank' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['first_page_of_bank_account_book']['tmp_name'], $filepath . $lease_deed);
    }
    DB::table('smartcard')->where('id', $insertid)->update([
        'first_page_of_bank_account_book'   => $first_page_of_bank_account_book,
    ]);

    $bond_leave_proof = "";
    if ($request->bond_leave_proof != null) {
        $bond_leave_proof = uniqid().'.'.$request->file('bond_leave_proof')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'bond_leave' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['bond_leave_proof']['tmp_name'], $filepath . $lease_deed);
    }
    DB::table('smartcard')->where('id', $insertid)->update([
        'bond_leave_proof'         => $bond_leave_proof,
    ]);
    $rice_card = "";
    if ($request->rice_card != null) {
        $rice_card = uniqid().'.'.$request->file('rice_card')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'ricecard' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['rice_card']['tmp_name'], $filepath . $lease_deed);
    }
    DB::table('smartcard')->where('id', $insertid)->update([
        'rice_card'         => $rice_card,
    ]);
    $sugar_card = "";
    if ($request->sugar_card != null) {
        $sugar_card = uniqid().'.'.$request->file('sugar_card')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'sugarcard' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['sugar_card']['tmp_name'], $filepath . $lease_deed);
    }
    DB::table('smartcard')->where('id', $insertid)->update([
        'sugar_card'         => $sugar_card,
    ]);
    $others = "";
    if ($request->others != null) {
        $others = uniqid().'.'.$request->file('others')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'others' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['others']['tmp_name'], $filepath . $lease_deed);
    }
    DB::table('smartcard')->where('id', $insertid)->update([
        'others'         => $others,
    ]);

    }elseif( $serviceid == 37 ){
    DB::table( 'smartcard' )->insert( [
   'user_id'                   => $user_id,
   'retailer_id'               => $retailer_id,
   'distributor_id'            => $distributor_id,
   'service_id'                => $request ->serviceid,
   'amount'                    => $request->amount,
   'name'                      => $request->name,
   'mobile'                    => $request->mobile,
   'dist_id'                   => $request->dist_id,
   'status'                    => 'Pending',
   'applied_date'              => date("Y-m-d"),
   'created_at'                => date("Y-m-d"),
  ] );

  $insertid = DB::getPdo()->lastInsertId();
  $aadhaarimg = "";
  $photo = "";
  $smart_card = "";

  if ($request->aadhaar_card != null) {
      $aadhaarimg = uniqid().'.'.$request->file('aadhaar_card')->extension();
      $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
      move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);

  }
     DB::table('smartcard')->where('id', $insertid)->update([
        'aadhaar_card' => $aadhaarimg,
  ]);
  if ($request->smart_card != null) {
      $smart_card = uniqid().'.'.$request->file('smart_card')->extension();
      $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
      move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smart_card);

  }
     DB::table('smartcard')->where('id', $insertid)->update([
        'smart_card' => $smart_card,
  ]);
  if ($request->photo != null) {
    $photo = uniqid().'.'.$request->file('photo')->extension();
    $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
    move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);

}
   DB::table('smartcard')->where('id', $insertid)->update([
      'photo' => $photo,
]);
}elseif( $serviceid == 38 ){
        DB::table( 'smartcard' )->insert( [
       'user_id'                   => $user_id,
       'retailer_id'               => $retailer_id,
       'distributor_id'            => $distributor_id,
       'service_id'                => $request ->serviceid,
       'amount'                    => $request->amount,
       'name'                      => $request->name,
       'mobile'                    => $request->mobile,
       'any_proof'                 => $request->any_proof,
       'status'                    => 'Pending',
       'applied_date'              => date("Y-m-d"),
       'created_at'                => date("Y-m-d"),
      ] );

      $insertid = DB::getPdo()->lastInsertId();
      $aadhaarimg = "";
      $smart_card = "";
      $death_certificate = "";
      $mrg_certificate = "";
      $mrg_invitation = "";

      if ($request->aadhaar_card != null) {
          $aadhaarimg = uniqid().'.'.$request->file('aadhaar_card')->extension();
          $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
          move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);
      }
         DB::table('smartcard')->where('id', $insertid)->update([
            'aadhaar_card' => $aadhaarimg,
      ]);
      if ($request->smart_card != null) {
          $smart_card = uniqid().'.'.$request->file('smart_card')->extension();
          $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
          move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smart_card);
      }
         DB::table('smartcard')->where('id', $insertid)->update([
            'smart_card' => $smart_card,
      ]);
      if ($request->death_certificate != null) {
        $death_certificate = uniqid().'.'.$request->file('death_certificate')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'deathcertificate' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['death_certificate']['tmp_name'], $filepath . $death_certificate);
    }
       DB::table('smartcard')->where('id', $insertid)->update([
          'death_certificate' => $death_certificate,
    ]);
    if ($request->mrg_certificate != null) {
        $mrg_certificate = uniqid().'.'.$request->file('mrg_certificate')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'mrgcertificate' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['mrg_certificate']['tmp_name'], $filepath . $mrg_certificate);
    }
       DB::table('smartcard')->where('id', $insertid)->update([
          'mrg_certificate' => $mrg_certificate,
    ]);
    if ($request->mrg_invitation != null) {
        $mrg_invitation = uniqid().'.'.$request->file('mrg_invitation')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'mrginvitation' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['mrg_invitation']['tmp_name'], $filepath . $mrg_invitation);
    }
       DB::table('smartcard')->where('id', $insertid)->update([
          'mrg_invitation' => $mrg_invitation,
    ]);
}elseif( $serviceid == 39 ){
    DB::table( 'smartcard' )->insert( [
        'user_id'                   => $user_id,
        'retailer_id'               => $retailer_id,
        'distributor_id'            => $distributor_id,
        'service_id'                => $request ->serviceid,
        'amount'                    => $request->amount,
        'name'                      => $request->name,
        'mobile'                    => $request->mobile,
        'status'                    => 'Pending',
        'applied_date'              => date("Y-m-d"),
        'created_at'                => date("Y-m-d"),
       ] );

       $insertid = DB::getPdo()->lastInsertId();
       $aadhaarimg = "";
       $smart_card = "";

       if ($request->aadhaar_card != null) {
           $aadhaarimg = uniqid().'.'.$request->file('aadhaar_card')->extension();
           $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
           move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);
       }
          DB::table('smartcard')->where('id', $insertid)->update([
             'aadhaar_card' => $aadhaarimg,
       ]);
       if ($request->smart_card != null) {
           $smart_card = uniqid().'.'.$request->file('smart_card')->extension();
           $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
           move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smart_card);
       }
          DB::table('smartcard')->where('id', $insertid)->update([
             'smart_card' => $smart_card,
       ]);
}elseif( $serviceid == 41 ) {
    DB::table( 'smartcard' )->insert( [
        'user_id'                   => $user_id,
        'retailer_id'               => $retailer_id,
        'distributor_id'            => $distributor_id,
        'service_id'                => $request ->serviceid,
        'amount'                    => $request->amount,
        'name'                      => $request->name,
        'mobile'                    => $request->mobile,
        'new_proof'                 => $request->new_proof,
        'status'                    => 'Pending',
        'applied_date'              => date("Y-m-d"),
        'created_at'                => date("Y-m-d"),
       ] );

       $insertid = DB::getPdo()->lastInsertId();
       $aadhaarimg = "";
       $smart_card = "";
       $birth_certificate = "";

       if ($request->aadhaar_card != null) {
           $aadhaarimg = uniqid().'.'.$request->file('aadhaar_card')->extension();
           $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
           move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);
       }
          DB::table('smartcard')->where('id', $insertid)->update([
             'aadhaar_card' => $aadhaarimg,
       ]);
       if ($request->smart_card != null) {
           $smart_card = uniqid().'.'.$request->file('smart_card')->extension();
           $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
           move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smart_card);

       }
          DB::table('smartcard')->where('id', $insertid)->update([
             'smart_card' => $smart_card,
       ]);
        if ($request->birth_certificate != null) {
            $birth_certificate = uniqid().'.'.$request->file('birth_certificate')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'birth_certificate' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['birth_certificate']['tmp_name'], $filepath . $birth_certificate);
        }
        DB::table('smartcard')->where('id', $insertid)->update([
            'birth_certificate'         => $birth_certificate,
        ]);
          $voter_id = "";
          if ($request->voter_id != null) {
              $voter_id = uniqid().'.'.$request->file('voter_id')->extension();
              $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'voterid' . DIRECTORY_SEPARATOR);
              move_uploaded_file($_FILES['voter_id']['tmp_name'], $filepath . $voter_id);
          }
          DB::table('smartcard')->where('id', $insertid)->update([
              'voter_id'         => $voter_id,
          ]);
}elseif( $serviceid == 42 ){
    DB::table( 'smartcard' )->insert( [
        'user_id'                   => $user_id,
        'retailer_id'               => $retailer_id,
        'distributor_id'            => $distributor_id,
        'service_id'                => $request ->serviceid,
        'amount'                    => $request->amount,
        'name'                      => $request->name,
        'mobile'                    => $request->mobile,
        'any_document'              => $request->any_document,
        'status'                    => 'Pending',
        'applied_date'              => date("Y-m-d"),
        'created_at'                => date("Y-m-d"),
       ] );

       $insertid = DB::getPdo()->lastInsertId();
       $aadhaarimg = "";
       $pancardimg = "";
       $smart_card = "";

       if ($request->aadhaar_card != null) {
           $aadhaarimg = uniqid().'.'.$request->file('aadhaar_card')->extension();
           $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
           move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);

       }
          DB::table('smartcard')->where('id', $insertid)->update([
             'aadhaar_card' => $aadhaarimg,
       ]);
       if ($request->smart_card != null) {
           $smart_card = uniqid().'.'.$request->file('smart_card')->extension();
           $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
           move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smart_card);

       }
          DB::table('smartcard')->where('id', $insertid)->update([
             'smart_card' => $smart_card,
       ]);
       $passport = "";
          if ($request->passport != null) {
              $passport = uniqid().'.'.$request->file('passport')->extension();
              $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'passport' . DIRECTORY_SEPARATOR);
              move_uploaded_file($_FILES['passport']['tmp_name'], $filepath . $passport);
          }
          DB::table('smartcard')->where('id', $insertid)->update([
              'passport'         => $passport,
          ]);
          $voter_id = "";
          if ($request->voter_id != null) {
              $voter_id = uniqid().'.'.$request->file('voter_id')->extension();
              $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'voter_id' . DIRECTORY_SEPARATOR);
              move_uploaded_file($_FILES['voter_id']['tmp_name'], $filepath . $voter_id);
          }
          DB::table('smartcard')->where('id', $insertid)->update([
              'voter_id'         => $voter_id,
          ]);
          $electricity_bill_receipt = "";
          if ($request->electricity_bill_receipt != null) {
              $electricity_bill_receipt = uniqid().'.'.$request->file('electricity_bill_receipt')->extension();
              $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'electricity_bill' . DIRECTORY_SEPARATOR);
              move_uploaded_file($_FILES['electricity_bill_receipt']['tmp_name'], $filepath . $electricity_bill_receipt);
          }
          DB::table('smartcard')->where('id', $insertid)->update([
              'electricity_bill_receipt'         => $electricity_bill_receipt,
          ]);
          $telephone_charges = "";
          if ($request->telephone_charges != null) {
              $telephone_charges = uniqid().'.'.$request->file('telephone_charges')->extension();
              $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'telephonebill' . DIRECTORY_SEPARATOR);
              move_uploaded_file($_FILES['telephone_charges']['tmp_name'], $filepath . $telephone_charges);
          }
          DB::table('smartcard')->where('id', $insertid)->update([
              'telephone_charges'         => $telephone_charges,
          ]);
          $gas_cylinder_receipt = "";
          if ($request->gas_cylinder_receipt != null) {
              $gas_cylinder_receipt = uniqid().'.'.$request->file('gas_cylinder_receipt')->extension();
              $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'gas_cylinder' . DIRECTORY_SEPARATOR);
              move_uploaded_file($_FILES['gas_cylinder_receipt']['tmp_name'], $filepath . $gas_cylinder_receipt);
          }
          DB::table('smartcard')->where('id', $insertid)->update([
              'gas_cylinder_receipt'         => $gas_cylinder_receipt,
          ]);
          $property_tax_applicant_owns_house = "";
          if ($request->property_tax_applicant_owns_house != null) {
              $property_tax_applicant_owns_house = uniqid().'.'.$request->file('property_tax_applicant_owns_house')->extension();
              $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'property_tax' . DIRECTORY_SEPARATOR);
              move_uploaded_file($_FILES['property_tax_applicant_owns_house']['tmp_name'], $filepath . $property_tax_applicant_owns_house);
          }
          DB::table('smartcard')->where('id', $insertid)->update([
              'property_tax_applicant_owns_house'         => $property_tax_applicant_owns_house,
          ]);
          $lease_deed = "";
          if ($request->lease_deed != null) {
              $lease_deed = uniqid().'.'.$request->file('lease_deed')->extension();
              $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'lease_deed' . DIRECTORY_SEPARATOR);
              move_uploaded_file($_FILES['lease_deed']['tmp_name'], $filepath . $lease_deed);
          }
          DB::table('smartcard')->where('id', $insertid)->update([
              'lease_deed'         => $lease_deed,
          ]);
          $allotment_rder_of_slum_replacement_board = "";
          if ($request->allotment_rder_of_slum_replacement_board != null) {
              $allotment_rder_of_slum_replacement_board = uniqid().'.'.$request->file('allotment_rder_of_slum_replacement_board')->extension();
              $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'allotment' . DIRECTORY_SEPARATOR);
              move_uploaded_file($_FILES['allotment_rder_of_slum_replacement_board']['tmp_name'], $filepath . $allotment_rder_of_slum_replacement_board);
          }
          DB::table('smartcard')->where('id', $insertid)->update([
              'allotment_rder_of_slum_replacement_board' => $allotment_rder_of_slum_replacement_board,
          ]);
          $bond_leave_proof = "";
          if ($request->bond_leave_proof != null) {
              $bond_leave_proof = uniqid().'.'.$request->file('bond_leave_proof')->extension();
              $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'bond_leave' . DIRECTORY_SEPARATOR);
              move_uploaded_file($_FILES['bond_leave_proof']['tmp_name'], $filepath . $bond_leave_proof);
          }
          DB::table('smartcard')->where('id', $insertid)->update([
              'bond_leave_proof'         => $bond_leave_proof,
          ]);
          $first_page_of_bank_account_book = "";
          if ($request->first_page_of_bank_account_book != null) {
              $bond_leave_proof = uniqid().'.'.$request->file('first_page_of_bank_account_book')->extension();
              $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'first_page_of_bank' . DIRECTORY_SEPARATOR);
              move_uploaded_file($_FILES['first_page_of_bank_account_book']['tmp_name'], $filepath . $first_page_of_bank_account_book);
          }
          DB::table('smartcard')->where('id', $insertid)->update([
              'first_page_of_bank_account_book'   => $first_page_of_bank_account_book,
          ]);
}elseif( $serviceid == 43 ){
    DB::table( 'smartcard' )->insert( [
        'user_id'                   => $user_id,
        'retailer_id'               => $retailer_id,
        'distributor_id'            => $distributor_id,
        'service_id'                => $request ->serviceid,
        'amount'                    => $request->amount,
        'name'                      => $request->name,
        'mobile'                    => $request->mobile,
        'status'                    => 'Pending',
        'applied_date'              => date("Y-m-d"),
        'created_at'                => date("Y-m-d"),
       ] );

       $insertid = DB::getPdo()->lastInsertId();
       $aadhaarimg = "";
       $photo = "";
       $smart_card = "";

       if ($request->aadhaar_card != null) {
           $aadhaarimg = uniqid().'.'.$request->file('aadhaar_card')->extension();
           $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
           move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);

       }
          DB::table('smartcard')->where('id', $insertid)->update([
             'aadhaar_card' => $aadhaarimg,
       ]);
       if ($request->smart_card != null) {
           $smart_card = uniqid().'.'.$request->file('smart_card')->extension();
           $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
           move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smart_card);

       }
          DB::table('smartcard')->where('id', $insertid)->update([
             'smart_card' => $smart_card,
       ]);
       if ($request->photo != null) {
           $photo = uniqid().'.'.$request->file('photo')->extension();
           $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
           move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);

       }
          DB::table('smartcard')->where('id', $insertid)->update([
             'photo' => $photo,
       ]);
}

          $servicepayment = $request->service_amount;
            if(Auth::user()->user_type_id == 3){
                $user_id = $distributor_id;
            }elseif(Auth::user()->user_type_id == 4){
                $user_id = $retailer_id;
            }elseif(Auth::user()->user_type_id == 5){
                $user_id = $user_id;
            }
            $date = date( 'Y-m-d' );
            $time = date( 'H:i:s' );
            $service_status = 'Out Payment';
            $ad_info = 'Service Payment';
            $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id')";
            DB::insert( DB::raw( $sql ) );
            $sql = "update users set wallet = wallet + $servicepayment where id = 2";
            DB::update( DB::raw( $sql ) );
            $service_status = 'IN Payment';
            $ad_info = 'Service Payment';
            $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id')";
            DB::insert( DB::raw( $sql ) );
            $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
            DB::update( DB::raw( $sql ) );

  return redirect("appliedservice/Pending")->With("success","Application submitted Succesfully");

}

public function submitsmartcardapply1(Request $request){

    $user_id = 0;
    $retailer_id = 0;
    $distributor_id = 0;
    if(Auth::user()->user_type_id == 3){
        $user_id = $request ->user_id;
        $distributor_id = Auth::user()->id;
    }elseif(Auth::user()->user_type_id == 4){
        $user_id = $request ->user_id;
        $retailer_id = Auth::user()->id;
    } elseif(Auth::user()->user_type_id == 5){
        $user_id = Auth::user()->id;
    }
    $serviceid = $request ->serviceid;
    if($serviceid == 77){
        DB::table( 'smartcard' )->insert( [
       'user_id'                   => $user_id,
       'retailer_id'               => $retailer_id,
       'distributor_id'            => $distributor_id,
       'service_id'                => $request ->serviceid,
       'amount'                    => $request->amount,
       'name'                      => $request->name,
       'status'                    => 'Pending',
       'applied_date'              => date("Y-m-d"),
       'created_at'                => date("Y-m-d"),
      ] );

      $insertid = DB::getPdo()->lastInsertId();

      $aadhaarimg = "";

      if ($request->aadhaar_card != null) {
          $aadhaarimg = uniqid().'.'.$request->file('aadhaar_card')->extension();
          $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
          move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);
      }
         DB::table('smartcard')->where('id', $insertid)->update([
            'aadhaar_card' => $aadhaarimg,
      ]);

    }elseif( $serviceid == 78 ){
    DB::table( 'smartcard' )->insert( [
   'user_id'                   => $user_id,
   'retailer_id'               => $retailer_id,
   'distributor_id'            => $distributor_id,
   'service_id'                => $request ->serviceid,
   'amount'                    => $request->amount,
   'status'                    => 'Pending',
   'applied_date'              => date("Y-m-d"),
   'created_at'                => date("Y-m-d"),
  ] );

  $insertid = DB::getPdo()->lastInsertId();
  $aadhaarimg = "";
  $smart_card = "";

  if ($request->aadhaar_card != null) {
      $aadhaarimg = uniqid().'.'.$request->file('aadhaar_card')->extension();
      $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
      move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);

  }
     DB::table('smartcard')->where('id', $insertid)->update([
        'aadhaar_card' => $aadhaarimg,
  ]);
  if ($request->smart_card != null) {
      $smart_card = uniqid().'.'.$request->file('smart_card')->extension();
      $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
      move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smart_card);

  }
     DB::table('smartcard')->where('id', $insertid)->update([
        'smart_card' => $smart_card,
  ]);

}elseif( $serviceid == 79 ){
        DB::table( 'smartcard' )->insert( [
       'user_id'                   => $user_id,
       'retailer_id'               => $retailer_id,
       'distributor_id'            => $distributor_id,
       'service_id'                => $request ->serviceid,
       'amount'                    => $request->amount,
       'name'                      => $request->name,
       'mobile'                    => $request->mobile,
       'status'                    => 'Pending',
       'applied_date'              => date("Y-m-d"),
       'created_at'                => date("Y-m-d"),
      ] );

      $insertid = DB::getPdo()->lastInsertId();
      $aadhaarimg = "";
      $applicant_reciept = "";
      $photo = "";

      if ($request->aadhaar_card != null) {
          $aadhaarimg = uniqid().'.'.$request->file('aadhaar_card')->extension();
          $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
          move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);
      }
         DB::table('smartcard')->where('id', $insertid)->update([
            'aadhaar_card' => $aadhaarimg,
      ]);
      if ($request->applicant_reciept != null) {
          $applicant_reciept = uniqid().'.'.$request->file('applicant_reciept')->extension();
          $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'applicantreciept' . DIRECTORY_SEPARATOR);
          move_uploaded_file($_FILES['applicant_reciept']['tmp_name'], $filepath . $aadhaarimg);
      }
         DB::table('smartcard')->where('id', $insertid)->update([
            'applicant_reciept' => $applicant_reciept,
      ]);
      if ($request->photo != null) {
          $photo = uniqid().'.'.$request->file('photo')->extension();
          $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
          move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $aadhaarimg);
      }
         DB::table('smartcard')->where('id', $insertid)->update([
            'photo' => $photo,
      ]);

}elseif( $serviceid == 80 ){
    DB::table( 'smartcard' )->insert( [
        'user_id'                   => $user_id,
        'retailer_id'               => $retailer_id,
        'distributor_id'            => $distributor_id,
        'service_id'                => $request ->serviceid,
        'amount'                    => $request->amount,
        'smart_mobile'              => $request->smart_mobile,
        'mobile'                    => $request->mobile,
        'status'                    => 'Pending',
        'applied_date'              => date("Y-m-d"),
        'created_at'                => date("Y-m-d"),
       ] );

}elseif( $serviceid == 81 ) {
    DB::table( 'smartcard' )->insert( [
        'user_id'                   => $user_id,
        'retailer_id'               => $retailer_id,
        'distributor_id'            => $distributor_id,
        'service_id'                => $request ->serviceid,
        'amount'                    => $request->amount,
        'name'                      => $request->name,
        'change_cardtype'           => $request->change_cardtype,
        'status'                    => 'Pending',
        'applied_date'              => date("Y-m-d"),
        'created_at'                => date("Y-m-d"),
       ] );

       $insertid = DB::getPdo()->lastInsertId();
       $photo = "";
       $smartcard_online = "";

       if ($request->photo != null) {
           $photo = uniqid().'.'.$request->file('photo')->extension();
           $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
           move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);
       }
          DB::table('smartcard')->where('id', $insertid)->update([
             'photo' => $photo,
       ]);
       if ($request->smartcard_online != null) {
           $smartcard_online = uniqid().'.'.$request->file('smartcard_online')->extension();
           $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'onlineprint' . DIRECTORY_SEPARATOR);
           move_uploaded_file($_FILES['smartcard_online']['tmp_name'], $filepath . $smartcard_online);

       }
          DB::table('smartcard')->where('id', $insertid)->update([
             'smartcard_online' => $smartcard_online,
       ]);
}elseif( $serviceid == 82 ){
    DB::table( 'smartcard' )->insert( [
        'user_id'                   => $user_id,
        'retailer_id'               => $retailer_id,
        'distributor_id'            => $distributor_id,
        'service_id'                => $request ->serviceid,
        'amount'                    => $request->amount,
        'name'                      => $request->name,
        'mobile'                    => $request->mobile,
        'status'                    => 'Pending',
        'applied_date'              => date("Y-m-d"),
        'created_at'                => date("Y-m-d"),
       ] );

       $insertid = DB::getPdo()->lastInsertId();
       $aadhaarimg = "";
       $smart_card = "";

       if ($request->aadhaar_card != null) {
           $aadhaarimg = uniqid().'.'.$request->file('aadhaar_card')->extension();
           $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
           move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);
       }
          DB::table('smartcard')->where('id', $insertid)->update([
             'aadhaar_card' => $aadhaarimg,
       ]);
       if ($request->smart_card != null) {
           $smart_card = uniqid().'.'.$request->file('smart_card')->extension();
           $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
           move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smart_card);
       }
          DB::table('smartcard')->where('id', $insertid)->update([
             'smart_card' => $smart_card,
       ]);
}elseif( $serviceid == 83 ){
    DB::table( 'smartcard' )->insert( [
        'user_id'                   => $user_id,
        'retailer_id'               => $retailer_id,
        'distributor_id'            => $distributor_id,
        'service_id'                => $request ->serviceid,
        'amount'                    => $request->amount,
        'name'                      => $request->name,
        'mobile'                    => $request->mobile,
        'status'                    => 'Pending',
        'applied_date'              => date("Y-m-d"),
        'created_at'                => date("Y-m-d"),
       ] );

       $insertid = DB::getPdo()->lastInsertId();
       $aadhaarimg = "";

       if ($request->aadhaar_card != null) {
           $aadhaarimg = uniqid().'.'.$request->file('aadhaar_card')->extension();
           $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
           move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);
       }
          DB::table('smartcard')->where('id', $insertid)->update([
             'aadhaar_card' => $aadhaarimg,
       ]);
}elseif( $serviceid == 84 ){
    DB::table( 'smartcard' )->insert( [
        'user_id'                   => $user_id,
        'retailer_id'               => $retailer_id,
        'distributor_id'            => $distributor_id,
        'service_id'                => $request ->serviceid,
        'amount'                    => $request->amount,
        'name'                      => $request->name,
        'mobile'                    => $request->mobile,
        'status'                    => 'Pending',
        'applied_date'              => date("Y-m-d"),
        'created_at'                => date("Y-m-d"),
       ] );

       $insertid = DB::getPdo()->lastInsertId();
       $smart_card = "";
       $smartcard_online = "";

       if ($request->smart_card != null) {
           $smart_card = uniqid().'.'.$request->file('smart_card')->extension();
           $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
           move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smart_card);
       }
          DB::table('smartcard')->where('id', $insertid)->update([
             'smart_card' => $smart_card,
       ]);
       if ($request->smartcard_online != null) {
           $smartcard_online = uniqid().'.'.$request->file('smartcard_online')->extension();
           $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'onlineprint' . DIRECTORY_SEPARATOR);
           move_uploaded_file($_FILES['smartcard_online']['tmp_name'], $filepath . $smartcard_online);
       }
          DB::table('smartcard')->where('id', $insertid)->update([
             'smartcard_online' => $smartcard_online,
       ]);
    }

          $servicepayment = $request->service_amount;
            if(Auth::user()->user_type_id == 3){
                $user_id = $distributor_id;
            }elseif(Auth::user()->user_type_id == 4){
                $user_id = $retailer_id;
            }elseif(Auth::user()->user_type_id == 5){
                $user_id = $user_id;
            }
            $date = date( 'Y-m-d' );
            $time = date( 'H:i:s' );
            $service_status = 'Out Payment';
            $ad_info = 'Service Payment';
            $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id')";
            DB::insert( DB::raw( $sql ) );
            $sql = "update users set wallet = wallet + $servicepayment where id = 2";
            DB::update( DB::raw( $sql ) );
            $service_status = 'IN Payment';
            $ad_info = 'Service Payment';
            $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id')";
            DB::insert( DB::raw( $sql ) );
            $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
            DB::update( DB::raw( $sql ) );

  return redirect("appliedservice/Pending")->With("success","Application submitted Succesfully");

}
public function submitapply_itr(Request $request){

    $user_id = 0;
    $retailer_id = 0;
    $distributor_id = 0;
    if(Auth::user()->user_type_id == 3){
        $user_id = $request ->user_id;
        $distributor_id = Auth::user()->id;
    }elseif(Auth::user()->user_type_id == 4){
        $user_id = $request ->user_id;
        $retailer_id = Auth::user()->id;
    } elseif(Auth::user()->user_type_id == 5){
        $user_id = Auth::user()->id;
    }
    $serviceid = $request ->serviceid;
    DB::table( 'itr' )->insert( [
     'user_id'      => $user_id,
     'retailer_id'  => $retailer_id,
     'distributor_id'  => $distributor_id,
     'service_id'   => $request ->serviceid,
     'amount'       => $request->amount,
     'name'         => $request->name,
     'mobile'       => $request->mobile,
     'email'       => $request->email,
     'aadhaar_no'   => $request->aadhaar_no,
     'status'       => 'Pending',
     'applied_date' => date("Y-m-d"),
     'created_at'   => date("Y-m-d"),
 ] );

    $insertid = DB::getPdo()->lastInsertId();
    $pancardimg = "";
    $bank_passbook = "";
    $aadhaar_card = "";

    if ($request->pan_card != null) {
        $pancardimg = uniqid().'.'.$request->file('pan_card')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'pan_card' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['pan_card']['tmp_name'], $filepath . $pancardimg);

    }
    DB::table('itr')->where('id', $insertid)->update([
      'pan_card' => $pancardimg,
  ]);

    if ($request->aadhaar_card != null) {
        $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);

    }
    DB::table('itr')->where('id', $insertid)->update([
      'aadhaar_card' => $aadhaar_card,
  ]);

    if ($request->bank_passbook != null) {
      $bank_passbook = uniqid().'.'.$request->file('bank_passbook')->extension();
      $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'bank_passbook' . DIRECTORY_SEPARATOR);
      move_uploaded_file($_FILES['bank_passbook']['tmp_name'], $filepath . $bank_passbook);

  }
  DB::table('itr')->where('id', $insertid)->update([
    'bank_passbook' => $bank_passbook,
]);


  $servicepayment = $request->service_amount;
  if(Auth::user()->user_type_id == 3){
    $user_id = $distributor_id;
}elseif(Auth::user()->user_type_id == 4){
    $user_id = $retailer_id;
}elseif(Auth::user()->user_type_id == 5){
    $user_id = $user_id;
}
$date = date( 'Y-m-d' );
$time = date( 'H:i:s' );
$service_status = 'Out Payment';
$ad_info = 'Service Payment';
$sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id')";
DB::insert( DB::raw( $sql ) );
$sql = "update users set wallet = wallet + $servicepayment where id = 2";
DB::update( DB::raw( $sql ) );
$service_status = 'IN Payment';
$ad_info = 'Service Payment';
$sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id')";
DB::insert( DB::raw( $sql ) );
$sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
DB::update( DB::raw( $sql ) );

return redirect("appliedservice/Pending")->With("success","Application submitted Succesfully");

}

public function submit_pan(Request $request){

    $user_id = 0;
    $retailer_id = 0;
    $distributor_id = 0;
    if(Auth::user()->user_type_id == 3){
        $user_id = $request ->user_id;
        $distributor_id = Auth::user()->id;
    }elseif(Auth::user()->user_type_id == 4){
        $user_id = $request ->user_id;
        $retailer_id = Auth::user()->id;
    } elseif(Auth::user()->user_type_id == 5){
        $user_id = Auth::user()->id;
    }
    $serviceid = $request ->serviceid;
    DB::table( 'pancard' )->insert( [
     'user_id'      => $user_id,
     'retailer_id'  => $retailer_id,
     'distributor_id'  => $distributor_id,
     'service_id'   => $request ->serviceid,
     'amount'       => $request->amount,
     'name'         => $request->name,
     'aadhaar_no'   => $request->aadhaar_no,
     'status'       => 'Pending',
     'applied_date' => date("Y-m-d"),
     'created_at'   => date("Y-m-d"),
 ] );

    $insertid = DB::getPdo()->lastInsertId();
    $smartcardimg = "";

    if ($request->smart_card != null) {
        $smartcardimg = uniqid().'.'.$request->file('smart_card')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smartcardimg);

    }
    DB::table('pancard')->where('id', $insertid)->update([
      'smart_card' => $smartcardimg,
  ]);


  $servicepayment = $request->service_amount;
  if(Auth::user()->user_type_id == 3){
    $user_id = $distributor_id;
}elseif(Auth::user()->user_type_id == 4){
    $user_id = $retailer_id;
}elseif(Auth::user()->user_type_id == 5){
    $user_id = $user_id;
}
$date = date( 'Y-m-d' );
$time = date( 'H:i:s' );
$service_status = 'Out Payment';
$ad_info = 'Service Payment';
$sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id')";
DB::insert( DB::raw( $sql ) );
$sql = "update users set wallet = wallet + $servicepayment where id = 2";
DB::update( DB::raw( $sql ) );
$service_status = 'IN Payment';
$ad_info = 'Service Payment';
$sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id')";
DB::insert( DB::raw( $sql ) );
$sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
DB::update( DB::raw( $sql ) );

return redirect("appliedservice/Pending")->With("success","Application submitted Succesfully");

}

public function submitapply_gst(Request $request){

    $user_id = 0;
    $retailer_id = 0;
    $distributor_id = 0;
    if(Auth::user()->user_type_id == 3){
        $user_id = $request ->user_id;
        $distributor_id = Auth::user()->id;
    }elseif(Auth::user()->user_type_id == 4){
        $user_id = $request ->user_id;
        $retailer_id = Auth::user()->id;
    } elseif(Auth::user()->user_type_id == 5){
        $user_id = Auth::user()->id;
    }
    $serviceid = $request ->serviceid;
    DB::table( 'gst' )->insert( [
        'user_id'              => $user_id,
        'retailer_id'          => $retailer_id,
        'distributor_id'       => $distributor_id,
        'service_id'           => $request ->serviceid,
        'amount'               => $request->amount,
        'trade_name'           => $request->trade_name,
        'mobile'               => $request->mobile,
        'aadhaar_no'           => $request->aadhaar_no,
        'pan_no'               => $request->pan_no,
        'dist_id'              => $request->dist_id,
        'taluk_id'             => $request->taluk_id,
        'panchayath_id'        => $request->panchayath_id,
        'business_details'     => $request->business_details,
        'business_address'     => $request->business_address,
        'business_details_documents'=> $request->business_details_documents,
        'status'       => 'Pending',
        'applied_date' => date("Y-m-d"),
        'created_at'   => date("Y-m-d"),
    ] );

    $insertid = DB::getPdo()->lastInsertId();
    $aadhaarimg = "";
    $pancardimg = "";
    $photo = "";
    $pass = "";
    $rental_agreement = "";
    $ebbill = "";
    $property_tax = "";

    if ($request->aadhaar_card != null) {
     $aadhaarimg = uniqid().'.'.$request->file('aadhaar_card')->extension();
     $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
     move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);

 }
 DB::table('gst')->where('id', $insertid)->update([
   'aadhaar_card' => $aadhaarimg,
]);
 if ($request->pan_card != null) {
   $pancardimg = uniqid().'.'.$request->file('pan_card')->extension();
   $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'pan_card' . DIRECTORY_SEPARATOR);
   move_uploaded_file($_FILES['pan_card']['tmp_name'], $filepath . $pancardimg);

}
DB::table('gst')->where('id', $insertid)->update([
 'pan_card' => $pancardimg,
]);
if ($request->photo != null) {
 $photo = uniqid().'.'.$request->file('photo')->extension();
 $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
 move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);

}
DB::table('gst')->where('id', $insertid)->update([
   'photo' => $photo,
]);
if ($request->bank_pass_book_front_page != null) {
 $pass = uniqid().'.'.$request->file('bank_pass_book_front_page')->extension();
 $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'passbook_front' . DIRECTORY_SEPARATOR);
 move_uploaded_file($_FILES['bank_pass_book_front_page']['tmp_name'], $filepath . $pass);

}
DB::table('gst')->where('id', $insertid)->update([
   'bank_pass_book_front_page' => $pass,
]);

if ($request->rental_agreement != null) {
 $rental_agreement = uniqid().'.'.$request->file('rental_agreement')->extension();
 $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'rental_agreement' . DIRECTORY_SEPARATOR);
 move_uploaded_file($_FILES['rental_agreement']['tmp_name'], $filepath . $rental_agreement);

}
DB::table('gst')->where('id', $insertid)->update([
   'rental_agreement' => $rental_agreement,
]);

if ($request->ebbill != null) {
 $ebbill = uniqid().'.'.$request->file('ebbill')->extension();
 $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'ebbill' . DIRECTORY_SEPARATOR);
 move_uploaded_file($_FILES['ebbill']['tmp_name'], $filepath . $ebbill);

}
DB::table('gst')->where('id', $insertid)->update([
   'ebbill' => $ebbill,
]);

if ($request->property_tax != null) {
 $property_tax = uniqid().'.'.$request->file('property_tax')->extension();
 $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'property_tax' . DIRECTORY_SEPARATOR);
 move_uploaded_file($_FILES['property_tax']['tmp_name'], $filepath . $property_tax);

}
DB::table('gst')->where('id', $insertid)->update([
   'property_tax' => $property_tax,
]);

$servicepayment = $request->service_amount;
if(Auth::user()->user_type_id == 3){
    $user_id = $distributor_id;
}elseif(Auth::user()->user_type_id == 4){
    $user_id = $retailer_id;
}elseif(Auth::user()->user_type_id == 5){
    $user_id = $user_id;
}
$date = date( 'Y-m-d' );
$time = date( 'H:i:s' );
$service_status = 'Out Payment';
$ad_info = 'Service Payment';
$sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id')";
DB::insert( DB::raw( $sql ) );
$sql = "update users set wallet = wallet + $servicepayment where id = 2";
DB::update( DB::raw( $sql ) );
$service_status = 'IN Payment';
$ad_info = 'Service Payment';
$sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id')";
DB::insert( DB::raw( $sql ) );
$sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
DB::update( DB::raw( $sql ) );

return redirect("appliedservice/Pending")->With("success","Application submitted Succesfully");

}

public function submitapply_tecexam(Request $request){

    $user_id = 0;
    $retailer_id = 0;
    $distributor_id = 0;
    if(Auth::user()->user_type_id == 3){
        $user_id = $request ->user_id;
        $distributor_id = Auth::user()->id;
    }elseif(Auth::user()->user_type_id == 4){
        $user_id = $request ->user_id;
        $retailer_id = Auth::user()->id;
    } elseif(Auth::user()->user_type_id == 5){
        $user_id = Auth::user()->id;
    }
    $serviceid = $request ->serviceid;
    DB::table( 'tec_exam' )->insert( [
     'user_id'      => $user_id,
     'retailer_id'  => $retailer_id,
     'distributor_id'  => $distributor_id,
     'service_id'   => $request ->serviceid,
     'amount'       => $request->amount,
     'tec_number'=> $request->tec_number,
     'tec_password'=> $request->tec_password,
     'status'       => 'Pending',
     'applied_date' => date("Y-m-d"),
     'created_at'   => date("Y-m-d"),
 ] );

    $insertid = DB::getPdo()->lastInsertId();
    $aadhaarimg = "";
    $photo = "";

    if ($request->aadhaar_card != null) {
        $aadhaarimg = uniqid().'.'.$request->file('aadhaar_card')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);

    }
    DB::table('tec_exam')->where('id', $insertid)->update([
      'aadhaar_card' => $aadhaarimg,
  ]);

    if ($request->photo != null) {
        $photo = uniqid().'.'.$request->file('photo')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);

    }
    DB::table('tec_exam')->where('id', $insertid)->update([
      'photo' => $photo,
  ]);

    $servicepayment = $request->service_amount;
    if(Auth::user()->user_type_id == 3){
        $user_id = $distributor_id;
    }elseif(Auth::user()->user_type_id == 4){
        $user_id = $retailer_id;
    }elseif(Auth::user()->user_type_id == 5){
        $user_id = $user_id;
    }
    $date = date( 'Y-m-d' );
    $time = date( 'H:i:s' );
    $service_status = 'Out Payment';
    $ad_info = 'Service Payment';
    $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id')";
    DB::insert( DB::raw( $sql ) );
    $sql = "update users set wallet = wallet + $servicepayment where id = 2";
    DB::update( DB::raw( $sql ) );
    $service_status = 'IN Payment';
    $ad_info = 'Service Payment';
    $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id')";
    DB::insert( DB::raw( $sql ) );
    $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
    DB::update( DB::raw( $sql ) );

    return redirect("appliedservice/Pending")->With("success","Application submitted Succesfully");

}

public function submittecexam_register(Request $request){

    $user_id = 0;
    $retailer_id = 0;
    $distributor_id = 0;
    if(Auth::user()->user_type_id == 3){
        $user_id = $request ->user_id;
        $distributor_id = Auth::user()->id;
    }elseif(Auth::user()->user_type_id == 4){
        $user_id = $request ->user_id;
        $retailer_id = Auth::user()->id;
    } elseif(Auth::user()->user_type_id == 5){
        $user_id = Auth::user()->id;
    }
    $serviceid = $request ->serviceid;
    DB::table( 'tec_exam' )->insert( [
       'user_id'           => $user_id,
       'retailer_id'       => $retailer_id,
       'distributor_id'    => $distributor_id,
       'service_id'        => $request ->serviceid,
       'amount'            => $request->amount,
       'applicant_name'    => $request->applicant_name,
       'email'             => $request->email,
       'father_name'       => $request->father_name,
       'dob'               => $request->dob,
       'mobile'            => $request->mobile,
       'gender'            => $request->gender,
       'district'          => $request->district,
       'address'           => $request->address,
       'status'            => 'Pending',
       'applied_date'      => date("Y-m-d"),
       'created_at'        => date("Y-m-d"),
   ] );

    $insertid = DB::getPdo()->lastInsertId();
    $aadhaarimg = "";
    $photo = "";

    if ($request->aadhaar_card != null) {
        $aadhaarimg = uniqid().'.'.$request->file('aadhaar_card')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);

    }
    DB::table('tec_exam')->where('id', $insertid)->update([
      'aadhaar_card' => $aadhaarimg,
  ]);

    if ($request->photo != null) {
        $photo = uniqid().'.'.$request->file('photo')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);

    }
    DB::table('tec_exam')->where('id', $insertid)->update([
      'photo' => $photo,
  ]);

    $servicepayment = $request->service_amount;
    if(Auth::user()->user_type_id == 3){
        $user_id = $distributor_id;
    }elseif(Auth::user()->user_type_id == 4){
        $user_id = $retailer_id;
    }elseif(Auth::user()->user_type_id == 5){
        $user_id = $user_id;
    }
    $date = date( 'Y-m-d' );
    $time = date( 'H:i:s' );
    $service_status = 'Out Payment';
    $ad_info = 'Service Payment';
    $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id')";
    DB::insert( DB::raw( $sql ) );
    $sql = "update users set wallet = wallet + $servicepayment where id = 2";
    DB::update( DB::raw( $sql ) );
    $service_status = 'IN Payment';
    $ad_info = 'Service Payment';
    $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id')";
    DB::insert( DB::raw( $sql ) );
    $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
    DB::update( DB::raw( $sql ) );

    return redirect("appliedservice/Pending")->With("success","Application submitted Succesfully");

}

public function submitapply_teccorrection(Request $request){

    $user_id = 0;
    $retailer_id = 0;
    $distributor_id = 0;
    if(Auth::user()->user_type_id == 3){
        $user_id = $request ->user_id;
        $distributor_id = Auth::user()->id;
    }elseif(Auth::user()->user_type_id == 4){
        $user_id = $request ->user_id;
        $retailer_id = Auth::user()->id;
    } elseif(Auth::user()->user_type_id == 5){
        $user_id = Auth::user()->id;
    }
    $serviceid = $request ->serviceid;
    DB::table( 'tec_exam' )->insert( [
       'user_id'         => $user_id,
       'retailer_id'     => $retailer_id,
       'distributor_id'  => $distributor_id,
       'service_id'      => $request ->serviceid,
       'amount'          => $request->amount,
       'applicant_name'  => $request->applicant_name,
       'mobile'          => $request->mobile,
       'email'           => $request->email,
       'tec_password'    => $request->tec_password,
       'status'          => 'Pending',
       'applied_date'    => date("Y-m-d"),
       'created_at'      => date("Y-m-d"),
   ] );

    $insertid = DB::getPdo()->lastInsertId();
    $aadhaarimg = "";
    $photo = "";

    if ($request->aadhaar_card != null) {
        $aadhaarimg = uniqid().'.'.$request->file('aadhaar_card')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);

    }
    DB::table('tec_exam')->where('id', $insertid)->update([
      'aadhaar_card' => $aadhaarimg,
  ]);

    if ($request->photo != null) {
        $photo = uniqid().'.'.$request->file('photo')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);

    }
    DB::table('tec_exam')->where('id', $insertid)->update([
      'photo' => $photo,
  ]);

    $servicepayment = $request->service_amount;
    if(Auth::user()->user_type_id == 3){
        $user_id = $distributor_id;
    }elseif(Auth::user()->user_type_id == 4){
        $user_id = $retailer_id;
    }elseif(Auth::user()->user_type_id == 5){
        $user_id = $user_id;
    }
    $date = date( 'Y-m-d' );
    $time = date( 'H:i:s' );
    $service_status = 'Out Payment';
    $ad_info = 'Service Payment';
    $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id')";
    DB::insert( DB::raw( $sql ) );
    $sql = "update users set wallet = wallet + $servicepayment where id = 2";
    DB::update( DB::raw( $sql ) );
    $service_status = 'IN Payment';
    $ad_info = 'Service Payment';
    $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id')";
    DB::insert( DB::raw( $sql ) );
    $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
    DB::update( DB::raw( $sql ) );

    return redirect("appliedservice/Pending")->With("success","Application submitted Succesfully");

}

public function submitapply_canedit(Request $request){
    $user_id = 0;
    $retailer_id = 0;
    $distributor_id = 0;
    if(Auth::user()->user_type_id == 3){
       $user_id = $request ->user_id;
       $distributor_id = Auth::user()->id;
    }elseif(Auth::user()->user_type_id == 4){
       $user_id = $request ->user_id;
       $retailer_id = Auth::user()->id;
    } elseif(Auth::user()->user_type_id == 5){
       $user_id = Auth::user()->id;
    }
    $serviceid = $request ->serviceid;

    if($serviceid == 60 || $serviceid == 121){
    DB::table( 'can_edit' )->insert( [
    'user_id'                    => $user_id,
    'retailer_id'                => $retailer_id,
    'distributor_id'             => $distributor_id,
    'service_id'                 => $request ->serviceid,
    'dist_id'                    => $request->dist_id,
    'taluk_id'                   => $request->taluk_id,
    'panchayath_id'              => $request->panchayath_id,
    'amount'                     => $request->amount,
    'mobile'                     => $request->mobile,
    'personalized_name_english'  => $request->personalized_name_english,
    'personalized'               => $request->personalized,
    'personalized_name_tamil'    => $request->personalized_name_tamil,
    'relationship'               => $request->relationship,
    'relationship_name_tamil'    => $request->relationship_name_tamil,
    'relationship_name_english'  => $request->relationship_name_english,
    'dob'                        => $request->dob,
    'religion'                   => $request->religion,
    'education'                  => $request->education,
    'work'                       => $request->work,
    'door_no'                    => $request->door_no,
    'village_administrative_area'=> $request->village_administrative_area,
    'community'                  => $request->community,
    'caste'                      => $request->caste,
    'maritial_status'            => $request->maritial_status,
    'aadhaar_number'             => $request->aadhaar_number,
    'smartcard_number'           => $request->smartcard_number,
    'street_name_tamil'          => $request->street_name_tamil,
    'postal_name'                => $request->postal_name,
    'street_name'                => $request->street_name,
    'pin_code'                   => $request->pin_code,
    'status'                     => 'Pending',
    'applied_date'               => date("Y-m-d"),
    'created_at'                 => date("Y-m-d"),
    ] );

    $insertid = DB::getPdo()->lastInsertId();
    $smartimg = "";
    $aadhaar_card = "";

    if ($request->smart_card != null) {
       $smartimg = uniqid().'.'.$request->file('smart_card')->extension();
       $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
       move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smartimg);

    }
    DB::table('can_edit')->where('id', $insertid)->update([
        'smart_card' => $smartimg,
    ]);

    if ($request->aadhaar_card != null) {
        $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);

    }
    DB::table('can_edit')->where('id', $insertid)->update([
       'aadhaar_card' => $aadhaar_card,
    ]);
}  elseif($serviceid == 62){
    DB::table( 'can_edit' )->insert( [
        'user_id'                    => $user_id,
        'retailer_id'                => $retailer_id,
        'distributor_id'             => $distributor_id,
        'service_id'                 => $request ->serviceid,
        'amount'                     => $request->amount,
        'can_number'                 => $request->can_number,
        'name_tamil'                 => $request->name_tamil,
        'name_english'               => $request->name_english,
        'status'                     => 'Pending',
        'applied_date'               => date("Y-m-d"),
        'created_at'                 => date("Y-m-d"),
        ] );

        $insertid = DB::getPdo()->lastInsertId();
        $aadhaar_card = "";

         if ($request->aadhaar_card != null) {
             $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
             $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
             move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);

         }
         DB::table('can_edit')->where('id', $insertid)->update([
            'aadhaar_card' => $aadhaar_card,
         ]);
}   elseif($serviceid == 63){
    DB::table( 'can_edit' )->insert( [
        'user_id'                    => $user_id,
        'retailer_id'                => $retailer_id,
        'distributor_id'             => $distributor_id,
        'service_id'                 => $request ->serviceid,
        'amount'                     => $request->amount,
        'can_number'                 => $request->can_number,
        'original_dob'               => $request->original_dob,
        'status'                     => 'Pending',
        'applied_date'               => date("Y-m-d"),
        'created_at'                 => date("Y-m-d"),
        ] );

        $insertid = DB::getPdo()->lastInsertId();
        $aadhaar_card = "";

         if ($request->aadhaar_card != null) {
             $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
             $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
             move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);

         }
         DB::table('can_edit')->where('id', $insertid)->update([
            'aadhaar_card' => $aadhaar_card,
         ]);
}   elseif($serviceid == 64){
    DB::table( 'can_edit' )->insert( [
        'user_id'                    => $user_id,
        'retailer_id'                => $retailer_id,
        'distributor_id'             => $distributor_id,
        'service_id'                 => $request ->serviceid,
        'amount'                     => $request->amount,
        'can_number'                 => $request->can_number,
        'new_mobile_no'              => $request->new_mobile_no,
        'status'                     => 'Pending',
        'applied_date'               => date("Y-m-d"),
        'created_at'                 => date("Y-m-d"),
        ] );

        $insertid = DB::getPdo()->lastInsertId();
        $aadhaar_card = "";

         if ($request->aadhaar_card != null) {
             $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
             $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
             move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);

         }
         DB::table('can_edit')->where('id', $insertid)->update([
            'aadhaar_card' => $aadhaar_card,
         ]);
}   elseif($serviceid == 65){
    DB::table( 'can_edit' )->insert( [
        'user_id'                    => $user_id,
        'retailer_id'                => $retailer_id,
        'distributor_id'             => $distributor_id,
        'service_id'                 => $request ->serviceid,
        'amount'                     => $request->amount,
        'can_number'                 => $request->can_number,
        'certificate_name'           => $request->certificate_name,
        'status'                     => 'Pending',
        'applied_date'               => date("Y-m-d"),
        'created_at'                 => date("Y-m-d"),
        ] );

        $insertid = DB::getPdo()->lastInsertId();
        $aadhaar_card = "";

         if ($request->aadhaar_card != null) {
             $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
             $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
             move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);

         }
         DB::table('can_edit')->where('id', $insertid)->update([
            'aadhaar_card' => $aadhaar_card,
         ]);
}   elseif($serviceid == 66){
    DB::table( 'can_edit' )->insert( [
        'user_id'                    => $user_id,
        'retailer_id'                => $retailer_id,
        'distributor_id'             => $distributor_id,
        'service_id'                 => $request ->serviceid,
        'amount'                     => $request->amount,
        'can_number'                 => $request->can_number,
        'status'                     => 'Pending',
        'applied_date'               => date("Y-m-d"),
        'created_at'                 => date("Y-m-d"),
        ] );

        $insertid = DB::getPdo()->lastInsertId();
        $aadhaar_card = "";

         if ($request->aadhaar_card != null) {
             $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
             $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
             move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);

         }
         DB::table('can_edit')->where('id', $insertid)->update([
            'aadhaar_card' => $aadhaar_card,
         ]);
}   elseif($serviceid == 67){
    DB::table( 'can_edit' )->insert( [
        'user_id'                    => $user_id,
        'retailer_id'                => $retailer_id,
        'distributor_id'             => $distributor_id,
        'service_id'                 => $request ->serviceid,
        'amount'                     => $request->amount,
        'can_number'                 => $request->can_number,
        'address_tamil'              => $request->address_tamil,
        'address_english'            => $request->address_english,
        'status'                     => 'Pending',
        'applied_date'               => date("Y-m-d"),
        'created_at'                 => date("Y-m-d"),
        ] );

        $insertid = DB::getPdo()->lastInsertId();
        $aadhaar_card = "";

         if ($request->aadhaar_card != null) {
             $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
             $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
             move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);

         }
         DB::table('can_edit')->where('id', $insertid)->update([
            'aadhaar_card' => $aadhaar_card,
         ]);
}
    $servicepayment = $request->service_amount;
    if(Auth::user()->user_type_id == 3){
       $user_id = $distributor_id;
    }elseif(Auth::user()->user_type_id == 4){
       $user_id = $retailer_id;
    }elseif(Auth::user()->user_type_id == 5){
       $user_id = $user_id;
    }
    $date = date( 'Y-m-d' );
    $time = date( 'H:i:s' );
    $service_status = 'Out Payment';
    $ad_info = 'Service Payment';
    $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id')";
    DB::insert( DB::raw( $sql ) );
    $sql = "update users set wallet = wallet + $servicepayment where id = 2";
    DB::update( DB::raw( $sql ) );
    $service_status = 'IN Payment';
    $ad_info = 'Service Payment';
    $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id')";
    DB::insert( DB::raw( $sql ) );
    $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
    DB::update( DB::raw( $sql ) );

 return redirect("appliedservice/Pending")->With("success","Application submitted Succesfully");

}
public function submitvoterid(Request $request){

    $user_id = 0;
    $retailer_id = 0;
    $distributor_id = 0;
    if(Auth::user()->user_type_id == 3){
        $user_id = $request ->user_id;
        $distributor_id = Auth::user()->id;
    }elseif(Auth::user()->user_type_id == 4){
        $user_id = $request ->user_id;
        $retailer_id = Auth::user()->id;
    } elseif(Auth::user()->user_type_id == 5){
        $user_id = Auth::user()->id;
    }
    $serviceid = $request ->serviceid;
    DB::table( 'voterid' )->insert( [
     'user_id'           => $user_id,
     'retailer_id'       => $retailer_id,
     'distributor_id'    => $distributor_id,
     'service_id'        => $request ->serviceid,
     'amount'            => $request->amount,
     'name'              => $request->name,
     'mobile'            => $request->mobile,
     'epic_no'           => $request->epic_no,
     'relationship'      => $request->relationship,
     'status'            => 'Pending',
     'applied_date'      => date("Y-m-d"),
     'created_at'        => date("Y-m-d"),
 ] );

    $insertid = DB::getPdo()->lastInsertId();
    $aadhaarimg = "";
    $photo = "";
    $voter_id = "";

    if ($request->aadhaar_card != null) {
      $aadhaarimg = uniqid().'.'.$request->file('aadhaar_card')->extension();
      $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
      move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);

  }
  DB::table('voterid')->where('id', $insertid)->update([
    'aadhaar_card' => $aadhaarimg,
]);
  if ($request->photo != null) {
    $photo = uniqid().'.'.$request->file('photo')->extension();
    $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
    move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);

}
DB::table('voterid')->where('id', $insertid)->update([
  'photo' => $photo,
]);
if ($request->voter_id != null) {
    $voter_id = uniqid().'.'.$request->file('voter_id')->extension();
    $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'voter_id' . DIRECTORY_SEPARATOR);
    move_uploaded_file($_FILES['voter_id']['tmp_name'], $filepath . $voter_id);

}
DB::table('voterid')->where('id', $insertid)->update([
  'voter_id' => $voter_id,
]);




$servicepayment = $request->service_amount;
if(Auth::user()->user_type_id == 3){
  $user_id = $distributor_id;
}elseif(Auth::user()->user_type_id == 4){
  $user_id = $retailer_id;
}elseif(Auth::user()->user_type_id == 5){
  $user_id = $user_id;
}
$date = date( 'Y-m-d' );
$time = date( 'H:i:s' );
$service_status = 'Out Payment';
$ad_info = 'Service Payment';
$sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id')";
DB::insert( DB::raw( $sql ) );
$sql = "update users set wallet = wallet + $servicepayment where id = 2";
DB::update( DB::raw( $sql ) );
$service_status = 'IN Payment';
$ad_info = 'Service Payment';
$sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id')";
DB::insert( DB::raw( $sql ) );
$sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
DB::update( DB::raw( $sql ) );

return redirect("appliedservice/Pending")->With("success","Application submitted Succesfully");

}
public function bondsubmit(Request $request){

    $user_id = 0;
    $retailer_id = 0;
    $distributor_id = 0;
    if(Auth::user()->user_type_id == 3){
        $user_id = $request ->user_id;
        $distributor_id = Auth::user()->id;
    }elseif(Auth::user()->user_type_id == 4){
        $user_id = $request ->user_id;
        $retailer_id = Auth::user()->id;
    } elseif(Auth::user()->user_type_id == 5){
        $user_id = Auth::user()->id;
    }
    $serviceid = $request ->serviceid;
    DB::table( 'bond' )->insert( [
     'user_id'                   => $user_id,
     'retailer_id'               => $retailer_id,
     'distributor_id'            => $distributor_id,
     'service_id'                => $request ->serviceid,
     'dist_id'                   => $request ->dist_id,
     'taluk_id'                  => $request ->taluk_id,
     'amount'                    => $request->amount,
     'applicant_name'            => $request->applicant_name,
     'aadhaar_no'                => $request->aadhaar_no,
     'document_number'           => $request->document_number,
     'year'                      => $request->year,
     'status'                    => 'Pending',
     'applied_date'              => date("Y-m-d"),
     'created_at'                => date("Y-m-d"),
 ] );

    return redirect("appliedservice/Pending")->With("success","Application submitted Succesfully");

}

public function submit_fssaiservice(Request $request){

    $user_id = 0;
    $retailer_id = 0;
    $distributor_id = 0;
    if(Auth::user()->user_type_id == 3){
        $user_id = $request ->user_id;
        $distributor_id = Auth::user()->id;
    }elseif(Auth::user()->user_type_id == 4){
        $user_id = $request ->user_id;
        $retailer_id = Auth::user()->id;
    } elseif(Auth::user()->user_type_id == 5){
        $user_id = Auth::user()->id;
    }
    $serviceid = $request ->serviceid;
    if($serviceid == 122 || $serviceid == 123){

        DB::table( 'fssai' )->insert( [
         'user_id'           => $user_id,
         'retailer_id'       => $retailer_id,
         'distributor_id'    => $distributor_id,
         'service_id'        => $request ->serviceid,
         'amount'            => $request->amount,
         'shop_name'         => $request->shop_name,
         'mobile'            => $request->mobile,
         'email_id'          => $request->email_id,
         'status'            => 'Pending',
         'applied_date'      => date("Y-m-d"),
         'created_at'        => date("Y-m-d"),
     ] );

        $insertid = DB::getPdo()->lastInsertId();
        $aadhaarimg = "";
        $photo = "";
        $pan_card = "";
        $old_food_license = "";

        if ($request->aadhaar_card != null) {
          $aadhaarimg = uniqid().'.'.$request->file('aadhaar_card')->extension();
          $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
          move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);

      }
      DB::table('fssai')->where('id', $insertid)->update([
        'aadhaar_card' => $aadhaarimg,
    ]);
      if ($request->photo != null) {
        $photo = uniqid().'.'.$request->file('photo')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);

    }
    DB::table('fssai')->where('id', $insertid)->update([
      'photo' => $photo,
  ]);
    if ($request->pan_card != null) {
        $pan_card = uniqid().'.'.$request->file('pan_card')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'pan_card' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['pan_card']['tmp_name'], $filepath . $pan_card);

    }
    DB::table('fssai')->where('id', $insertid)->update([
      'pan_card' => $pan_card,
  ]);
    if ($request->old_food_license != null) {
        $old_food_license = uniqid().'.'.$request->file('old_food_license')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'old_food_license' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['old_food_license']['tmp_name'], $filepath . $old_food_license);

    }
    DB::table('fssai')->where('id', $insertid)->update([
      'old_food_license' => $old_food_license,
  ]);

}


$servicepayment = $request->service_amount;
if(Auth::user()->user_type_id == 3){
  $user_id = $distributor_id;
}elseif(Auth::user()->user_type_id == 4){
  $user_id = $retailer_id;
}elseif(Auth::user()->user_type_id == 5){
  $user_id = $user_id;
}
$date = date( 'Y-m-d' );
$time = date( 'H:i:s' );
$service_status = 'Out Payment';
$ad_info = 'Service Payment';
$sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id')";
DB::insert( DB::raw( $sql ) );
$sql = "update users set wallet = wallet + $servicepayment where id = 2";
DB::update( DB::raw( $sql ) );
$service_status = 'IN Payment';
$ad_info = 'Service Payment';
$sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id')";
DB::insert( DB::raw( $sql ) );
$sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
DB::update( DB::raw( $sql ) );

return redirect("appliedservice/Pending")->With("success","Application submitted Succesfully");

}

public function submitapply_covid(Request $request){

    $user_id = 0;
    $retailer_id = 0;
    $distributor_id = 0;
    if(Auth::user()->user_type_id == 3){
        $user_id = $request ->user_id;
        $distributor_id = Auth::user()->id;
    }elseif(Auth::user()->user_type_id == 4){
        $user_id = $request ->user_id;
        $retailer_id = Auth::user()->id;
    } elseif(Auth::user()->user_type_id == 5){
        $user_id = Auth::user()->id;
    }
    $serviceid = $request ->serviceid;
    DB::table( 'covid' )->insert( [
       'user_id'      => $user_id,
       'retailer_id'  => $retailer_id,
       'distributor_id'  => $distributor_id,
       'service_id'   => $request ->serviceid,
       'amount'       => $request->amount,
       'name'         => $request->name,
       'mobile'       => $request->mobile,
       'gender'       => $request->gender,
       'dob'          => $request->dob,
       'aadhaar_no'   => $request->aadhaar_no,
       'passport_no'  => $request->passport_no,
       'status'       => 'Pending',
       'applied_date' => date("Y-m-d"),
       'created_at'   => date("Y-m-d"),
   ] );



    $servicepayment = $request->service_amount;
    if(Auth::user()->user_type_id == 3){
        $user_id = $distributor_id;
    }elseif(Auth::user()->user_type_id == 4){
        $user_id = $retailer_id;
    }elseif(Auth::user()->user_type_id == 5){
        $user_id = $user_id;
    }
    $date = date( 'Y-m-d' );
    $time = date( 'H:i:s' );
    $service_status = 'Out Payment';
    $ad_info = 'Service Payment';
    $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id')";
    DB::insert( DB::raw( $sql ) );
    $sql = "update users set wallet = wallet + $servicepayment where id = 2";
    DB::update( DB::raw( $sql ) );
    $service_status = 'IN Payment';
    $ad_info = 'Service Payment';
    $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id')";
    DB::insert( DB::raw( $sql ) );
    $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
    DB::update( DB::raw( $sql ) );

    return redirect("appliedservice/Pending")->With("success","Application submitted Succesfully");

}


public function get_taluk($distid)
{
    $response = DB::table('taluk')->where('district_id',$distid)->orderBy( 'id', 'Asc' )->get();
    return response()->json( $response );
}

public function get_panchayath($taluk_id)
{
    $response = DB::table('panchayath')->where('taluk_id',$taluk_id)->orderBy( 'id', 'Asc' )->get();
    return response()->json( $response );
}
}
