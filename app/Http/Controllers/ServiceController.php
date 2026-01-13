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

  public function service()
  {
    if(Auth::user()->user_type_id != 1){
        return redirect("/dashboard");
    }
    return view('services.service');
}

  public function ourservice()
  {
    $canservice = DB::table('canservice')->where('status', '=', 'Active' )->orderBy( 'id' , 'Asc' )->get();

    $pat = DB::table('services')->where('ser_id', '=', 2 )->where('status', '=', 'Active' )->orderBy( 'id' , 'Asc' )->get();

    return view('services.ourservice',compact('canservice','pat'));
}

public function allservice($customerid)
{
$userPermission = DB::table('user_permission')
    ->where('user_id', Auth::user()->id)
    ->where('parent_id', 3)
    ->pluck('service_id');

$adminPermission = DB::table('user_permission')
    ->where('user_id', 2) 
    ->where('parent_id', 3)
    ->pluck('service_id');

$finalServiceIds = $userPermission->intersect($adminPermission);
    if(Auth::user()->user_type_id == 2){
        $ourservice = DB::table('services')->where('status','=' , 'Active')->where('ser_id',1 )->orderBy( 'id' , 'Asc' )->get();
    }else{
        $ourservice = DB::table('services')->where('status','=' , 'Active')->where('ser_id',1 )->whereIn('id',$finalServiceIds)->orderBy( 'id' , 'Asc' )->get();
    }

    return view('services.allservice',compact('ourservice','customerid'));
}

    public function allservices()
    {

        $ourservice = DB::table('services')->where('status', '=', 'Active')->where('parent_id', 0)->where('ser_id', 0)->orderBy('id', 'Asc')->get();
        return view('services.allservices', compact('ourservice'));
    }


public function subservice( $id )
{
    if( Auth::user()->user_type_id != 1 && Auth::user()->user_type_id != 2 ){
        return redirect("/dashboard");
    }
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
    if(Auth::user()->user_type_id != 1 && Auth::user()->user_type_id != 2){
        return redirect("/dashboard");
    }

    $checkpermission = DB::table( 'user_permission' )->where('user_id' , Auth::user()->id)->where('parent_id' , 3)->get();
    if( Auth::user()->user_type_id == 2 ){
        $allservice = DB::table('services')->where('parent_id',0 )->where('ser_id',0 )->whereIn('id',$checkpermission->pluck('service_id'))->orderBy( 'id' , 'Asc' )->get();
    }else{
        $allservice = DB::table('services')->where('parent_id',0)->orderBy( 'id' , 'Asc' )->get();
    }
    return view('services.viewservice',compact('allservice'));
}

public function addservice(Request $request)
{

    $addservice = DB::table('services')->insert([
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
        'ramjiservice_id'        => $request->ramjiservice_id,
        'status' => 'Active',
    ] );

    return redirect()->back()->with( 'success', 'SubService Added Successfully' );
}

public function updatesubservice( Request $request ) {
    DB::table( 'services' )->where('id', $request->service_id)->update( [
        'service_name'  => $request->service_name,
        'status'        => $request->status,
        'amount'        => $request->amount,
        'ramjiservice_id'        => $request->ramjiservice_id,
    ] );
    if ($request->sub_service_image != null) {
        $sub_service_image = uniqid().'.'.$request->file('sub_service_image')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'sub_service' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['sub_service_image']['tmp_name'], $filepath . $sub_service_image);

        $sql = "update services set sub_service_image='$sub_service_image' where id = $request->service_id";
        DB::update(DB::raw($sql));
    }

     if ($request->software != null) {
        $filename = $request->file('software')->getClientOriginalName();
        $software = $filename;
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'software' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['software']['tmp_name'], $filepath . $software);

        $sql = "update services set software='$software' where id = $request->service_id";
        DB::update(DB::raw($sql));
    }
    return redirect()->back()->with( 'success', 'SubService Updated Successfully' );
}

public function updatesubstatus( Request $request ) {
    DB::table( 'services' )->where('id', $request->service_id)->update( [
        'service_name'  => $request->service_name,
        'status'        => $request->status,
    ] );

    return redirect()->back()->with( 'success', 'SubService Updated Successfully' );
}

// public function services($serviceid,$customerid) {
//  $services = DB::table('services')->where('status', '=' , 'Active')->where('parent_id',$serviceid)->orderBy( 'id' , 'Asc' )->get();
//  $customers = DB::table('users')->where('id',$customerid)->get();
//  $customers = json_decode( json_encode( $customers ), true );
//  foreach ( $customers as $key => $customer ) {
//     $customers[ $key ][ 'document' ] = array();
//     $customerid = $customer[ 'id' ];
//     $customer_document = DB::table('cus_document')->where('customer_id',$customerid)->get();
//     if(count($customer_document) > 0){
//         $customers[ $key ][ 'document' ] = $customer_document;
//     }
// }
// $customers = json_decode( json_encode( $customers ));

// return view('services.services',compact( 'services','customers','customerid','serviceid'));
// }

public function services($serviceid, $customerid)
    {
        $userid = Auth::user()->id;

        // User permissions
        $userPermission = DB::table('user_permission')
            ->where('service_id', '!=', 6)
            ->where('user_id', $userid)
            ->where('parent_id', 3)
            ->pluck('service_id');

        // Admin permissions
        $adminPermission = DB::table('user_permission')
            ->where('service_id', '!=', 6)
            ->where('user_id', 2) // admin id
            ->where('parent_id', 3)
            ->pluck('service_id');

        // Final allowed services
        $finalServiceIds = $userPermission
            ->intersect($adminPermission)
            ->push(6);

        if (Auth::user()->user_type_id == 1) {

            // Services
            $services = DB::table('services')
                ->where('status', 'Active')
                ->where('parent_id', $serviceid)
                ->orderBy('id', 'Asc')
                ->get();

            // Customer
            $customers = DB::table('users')
                ->where('id', $customerid)
                ->get()
                ->map(function ($customer) {
                    $customer->document = DB::table('cus_document')
                        ->where('customer_id', $customer->id)
                        ->get();
                    return $customer;
                });
        } else {
            $services = DB::table('services')
                ->where('status', 'Active')
                ->where('parent_id', $serviceid)
                ->whereIn('id', $finalServiceIds)
                ->orderBy('id', 'Asc')
                ->get();

            // Customer
            $customers = DB::table('users')
                ->where('id', $customerid)
                ->get()
                ->map(function ($customer) {
                    $customer->document = DB::table('cus_document')
                        ->where('customer_id', $customer->id)
                        ->get();
                    return $customer;
                });

        }

        return view(
            'services.services',
            compact('services', 'customers', 'customerid', 'serviceid')
        );
    }

public function servicesone($serviceid)
    {
        $userid         = Auth::user()->id;
        $userPermission = DB::table('user_permission')
            ->where('service_id', '!=', 6)
            ->where('user_id', Auth::user()->id)
            ->where('parent_id', 3)
            ->pluck('service_id');

        $adminPermission = DB::table('user_permission')
            ->where('service_id', '!=', 6)
            ->where('user_id', 2) // admin id
            ->where('parent_id', 3)
            ->pluck('service_id');
        $finalServiceIds = $userPermission->intersect($adminPermission)->push(6);
        if (Auth::user()->user_type_id == 1) {
            $services = DB::table('services')->where('status', '=', 'Active')->where('parent_id', $serviceid)->orderBy('id', 'Asc')->get();
        } else {
            $services = DB::table('services')->where('status', '=', 'Active')->where('parent_id', $serviceid)->whereIn('id', $finalServiceIds)->orderBy('id', 'Asc')->get();
        }
     $rawallet = DB::table( 'users' )->select('rawallet')->where('id',2)->first();
        return view('services.servicesone', compact('services', 'serviceid','rawallet'));
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
   $coordinator_permission = 0;
   $admin_payment = 0;

   if($getservice_payment){
    $coordinator_permission = $getservice_payment->coordinator_permission;
    if($coordinator_permission == 1){
        $admin_payment = $getservice_payment->admin_amount;
    }
       if(Auth::user()->user_type_id == 3){
           $payment = $getservice_payment->distributor_amount;
       }elseif(Auth::user()->user_type_id == 4){
           $payment = $getservice_payment->retailer_amount;
       }elseif(Auth::user()->user_type_id == 5){
           $payment = $getservice_payment->customer_amount;
       }
   }
   if($payment == ""){
       $payment = 0;
   }
   $customers = DB::table( 'users' )->where('id',$customerid)->first();
         //dd($customers);
   if($serviceid == 2){
    $mainbalance = DB::table( 'users' )->select('rawallet')->where('id',2)->first();
       return view( 'applyservice.tnegaservice1',compact('serviceid','districts','servicename','amount','customers','payment','mainbalance','coordinator_permission','admin_payment'));
   } elseif ($serviceid == 3){
    $mainbalance = DB::table( 'users' )->select('rawallet')->where('id',2)->first();
       return view( 'applyservice.tnegaservice1',compact('serviceid','districts','servicename','amount','customers','payment','mainbalance','coordinator_permission','admin_payment'));

   } elseif ($serviceid == 4){
    $mainbalance = DB::table( 'users' )->select('rawallet')->where('id',2)->first();
       return view( 'applyservice.tnegaservice1',compact('serviceid','districts','servicename','amount','customers','payment','mainbalance','coordinator_permission','admin_payment'));

   } elseif ($serviceid == 11){
    $mainbalance = DB::table( 'users' )->select('rawallet')->where('id',2)->first();
       return view( 'applyservice.tnegaservice1',compact('serviceid','districts','servicename','amount','customers','payment','mainbalance','coordinator_permission','admin_payment'));

   } elseif ($serviceid == 14){
    $mainbalance = DB::table( 'users' )->select('rawallet')->where('id',2)->first();
       return view( 'applyservice.tnegaservice1',compact('serviceid','districts','servicename','amount','customers','payment','mainbalance','coordinator_permission','admin_payment'));

   } elseif ($serviceid == 20){
    $mainbalance = DB::table( 'users' )->select('rawallet')->where('id',2)->first();
       return view( 'applyservice.tnegaservice1',compact('serviceid','districts','servicename','amount','customers','payment','mainbalance','coordinator_permission','admin_payment'));

   } elseif ($serviceid == 22 || $serviceid == 23 || $serviceid == 24 || $serviceid == 25 || $serviceid == 26){
    $mainbalance = DB::table( 'users' )->select('rawallet')->where('id',2)->first();
       return view( 'applyservice.tnegaservice2',compact('serviceid','districts','servicename','amount','customers','payment','mainbalance','coordinator_permission','admin_payment'));

   }elseif ($serviceid == 27 || $serviceid == 28 || $serviceid == 129){
    $mainbalance = DB::table( 'users' )->select('rawallet')->where('id',2)->first();
       return view( 'applyservice.tnegaservice3',compact('serviceid','districts','servicename','amount','customers','payment','mainbalance','coordinator_permission','admin_payment'));

    } elseif ($serviceid == 60 || $serviceid == 62 || $serviceid == 63 || $serviceid == 64 || $serviceid == 66 || $serviceid == 121){
            $mainbalance = DB::table( 'users' )->select('rawallet')->where('id',2)->first();
        return view( 'applyservice.caneditservice',compact('serviceid','districts','servicename','amount','customers','payment','mainbalance','coordinator_permission','admin_payment'));

   }  elseif ($serviceid == 151){
    $mainbalance = DB::table( 'users' )->select('rawallet')->where('id',2)->first();
       return view( 'applyservice.tnegaservice4',compact('serviceid','districts','servicename','amount','customers','payment','mainbalance','coordinator_permission','admin_payment'));

   }elseif ($serviceid == 170 || $serviceid == 171 || $serviceid == 172 || $serviceid == 176 || $serviceid == 177 ||$serviceid == 178 ){
    $mainbalance = DB::table( 'users' )->select('rawallet')->where('id',2)->first();
       return view( 'applyservice.tnegaservice5',compact('serviceid','districts','servicename','amount','customers','payment','mainbalance','coordinator_permission','admin_payment'));
   }  elseif ($serviceid == 15){
        $mainbalance = DB::table( 'users' )->select('rawallet')->where('id',2)->first();
        return view( 'applyservice.tnegaservice6',compact('serviceid','districts','servicename','amount','customers','payment','mainbalance','coordinator_permission','admin_payment'));

}

}

public function applyservices($serviceid) {
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
   $coordinator_permission = 0;
   $admin_payment = 0;

   if($getservice_payment){
    $coordinator_permission = $getservice_payment->coordinator_permission;
    if($coordinator_permission == 1){
        $admin_payment = $getservice_payment->admin_amount;
    }
       if(Auth::user()->user_type_id == 3){
           $payment = $getservice_payment->distributor_amount;
       }elseif(Auth::user()->user_type_id == 4){
           $payment = $getservice_payment->retailer_amount;
       }elseif(Auth::user()->user_type_id == 5){
           $payment = $getservice_payment->customer_amount;
       }
   }
   if($payment == ""){
       $payment = 0;
   }
   $customers = DB::table( 'users' )->orderBy('id', 'Asc')->first();
 // $customers = DB::table( 'users' )->where('id',$customerid)->first();
         //dd($customers);
   if ($serviceid == 17){
       return view( 'backend.services.applyservice1',compact('serviceid','districts','servicename','amount','customers','payment'));

   }  elseif ($serviceid == 32){
       return view( 'applyservice.agricultureservice',compact('serviceid','districts','servicename','amount','customers','payment'));

   }  elseif ($serviceid == 34){
       return view( 'applyservice.msmeservice',compact('serviceid','districts','servicename','amount','payment','customers'));

   }  elseif ($serviceid == 36 || $serviceid == 37 || $serviceid == 38 || $serviceid == 39 || $serviceid == 41 || $serviceid == 42 || $serviceid == 43 ){
       $districts = DB::table( 'district' )->where('id','!=',3)->get();
       return view( 'applyservice.smartcardapply',compact('serviceid','districts','servicename','amount','payment','customers'));

   }  elseif ($serviceid == 39){
       return view( 'backend.services.applyservice6',compact('serviceid','districts','servicename','amount','customers','payment'));

   }  elseif ($serviceid == 41){
       return view( 'backend.services.applyservice6',compact('serviceid','districts','servicename','amount','customers','payment'));

   }  elseif ($serviceid == 42){
       return view( 'backend.services.applyservice6',compact('serviceid','districts','servicename','amount','customers','payment'));

   }  elseif ($serviceid == 43){
       return view( 'backend.services.applyservice6',compact('serviceid','districts','servicename','amount','customers','payment'));

   }  elseif ($serviceid == 51){
       return view( 'applyservice.itrservice',compact('serviceid','districts','servicename','amount','payment','customers'));

   }  elseif ($serviceid == 52){
       return view( 'applyservice.gstservice',compact('serviceid','districts','servicename','amount','payment','customers'));

   }  elseif ($serviceid == 54){
       return view( 'applyservice.techexamservice',compact('serviceid','districts','servicename','amount','payment','customers'));

   }  elseif ($serviceid == 55){
       return view( 'applyservice.techexamregister',compact('serviceid','districts','servicename','amount','payment','customers'));

   } elseif ($serviceid == 60 || $serviceid == 62 || $serviceid == 63 || $serviceid == 64 || $serviceid == 66 || $serviceid == 121){
         $mainbalance = DB::table( 'users' )->select('rawallet')->where('id',2)->first();
        return view( 'applyservice.caneditservice',compact('serviceid','districts','servicename','amount','customers','payment','mainbalance','coordinator_permission','admin_payment'));

  }elseif ($serviceid == 65 || $serviceid == 67 || $serviceid == 225 || $serviceid == 226){
    $mainbalance = DB::table( 'users' )->select('rawallet')->where('id',2)->first();
    return view( 'applyservice.caneditservice1',compact('serviceid','districts','servicename','amount','customers','payment','mainbalance','coordinator_permission','admin_payment'));

   }  elseif ($serviceid == 124){
       return view( 'applyservice.techcorrectionservice',compact('serviceid','districts','servicename','amount','payment','customers'));

   }  elseif ($serviceid == 56 || $serviceid == 58 || $serviceid == 158){
    $mainbalance = DB::table( 'users' )->select('rawallet')->where('id',2)->first();
       return view( 'applyservice.aadhaarcard_apply',compact('serviceid','districts','servicename','amount','payment','customers','mainbalance','coordinator_permission','admin_payment'));

}   elseif ( $serviceid == 69 || $serviceid == 70 || $serviceid == 71 ){
    $mainbalance = DB::table( 'users' )->select('rawallet')->where('id',2)->first();
    return view( 'applyservice.voterid_pdfdownloadservice',compact('serviceid','districts','servicename','amount','customers','payment','mainbalance','coordinator_permission','admin_payment'));


//    }  elseif ($serviceid == 71 || $serviceid == 69 || $serviceid == 70){
//     $mainbalance = DB::table( 'users' )->select('rawallet')->where('id',2)->first();
//     return view( 'applyservice.panservice',compact('serviceid','districts','servicename','amount','payment','customers','mainbalance'));

}  elseif ($serviceid == 113 || $serviceid == 120 || $serviceid == 164 || $serviceid == 182|| $serviceid == 181){
   return view( 'applyservice.voteridservice',compact('serviceid','districts','servicename','amount','payment','customers'));

}  elseif ($serviceid == 72){
   return view( 'applyservice.find_aadhaarcard_number',compact('serviceid','districts','servicename','amount','payment','customers'));

}  elseif ($serviceid == 95 || $serviceid == 96 || $serviceid == 97 || $serviceid == 98){
   return view( 'applyservice.nalavariyamservice',compact('serviceid','districts','servicename','amount','payment','customers'));

}  elseif ( $serviceid == 77 || $serviceid == 78 ||  $serviceid == 79 || $serviceid == 80 || $serviceid == 81 || $serviceid == 82 || $serviceid == 83 || $serviceid == 84){
    return view( 'applyservice.smartcardapply1',compact('serviceid','districts','servicename','amount','payment','customers'));

}  elseif ( $serviceid == 100 ){
    return view( 'applyservice.bondapply',compact('serviceid','districts','servicename','amount','payment','customers'));

}  elseif ( $serviceid == 122 || $serviceid == 123 ){
    $mainbalance = DB::table( 'users' )->select('rawallet')->where('id',2)->first();
   return view( 'applyservice.fssaiservice_apply',compact('serviceid','districts','servicename','amount','payment','customers','mainbalance','coordinator_permission','admin_payment'));

}  elseif ( $serviceid == 125 ){
     $mainbalance = DB::table( 'users' )->select('rawallet')->where('id',2)->first();
   return view( 'applyservice.agri_stackservice',compact('serviceid','districts','servicename','amount','payment','customers','mainbalance','coordinator_permission','admin_payment'));

}  elseif ( $serviceid == 150 || $serviceid == 148){
   return view( 'applyservice.driving_licenceservice',compact('serviceid','districts','servicename','amount','payment','customers'));

}  elseif ($serviceid == 152 || $serviceid == 153 || $serviceid == 154){
    $mainbalance = DB::table( 'users' )->select('nalavariyamwallet')->where('id',2)->first();
   return view( 'applyservice.tailor_shop_service',compact('serviceid','districts','servicename','amount','payment','customers','mainbalance','coordinator_permission','admin_payment'));

}  elseif ($serviceid == 155 || $serviceid == 156){
   return view( 'applyservice.birthcertificate_service',compact('serviceid','districts','servicename','amount','payment','customers'));

// }  elseif ($serviceid == 157 ){
//    return view( 'applyservice.pmkissanservice',compact('serviceid','districts','servicename','amount','payment','customers'));

}  elseif ($serviceid == 165 ){
   return view( 'applyservice.tec_csc_service',compact('serviceid','districts','servicename','amount','payment','customers'));

}  elseif ($serviceid == 166 ){
   return view( 'applyservice.iibf_exam_registeration',compact('serviceid','districts','servicename','amount','payment','customers'));

}  elseif ($serviceid == 167){
   return view( 'applyservice.ins_exam',compact('serviceid','districts','servicename','amount','customers','payment'));

}  elseif ($serviceid == 168 ){
   return view( 'applyservice.rap_exam',compact('serviceid','districts','servicename','amount','customers','payment'));

}  elseif ($serviceid == 169){
   return view( 'applyservice.vle_insurance',compact('serviceid','districts','servicename','amount','customers','payment'));

} elseif ($serviceid == 179 || $serviceid == 180){
    $mainbalance = DB::table( 'users' )->select('rawallet')->where('id',2)->first();
   return view( 'applyservice.medicalscheme',compact('serviceid','districts','servicename','amount','customers','payment','mainbalance','coordinator_permission','admin_payment'));

}  elseif ($serviceid == 183 || $serviceid == 184 || $serviceid == 185 || $serviceid == 186){
   return view( 'applyservice.dharsanservice',compact('serviceid','districts','servicename','amount','customers','payment'));

}  elseif ($serviceid == 208 || $serviceid == 209 || $serviceid == 210 || $serviceid == 211 || $serviceid == 233 || $serviceid == 234){
     $mainbalance = DB::table( 'users' )->select('rawallet')->where('id',2)->first();
    return view( 'applyservice.can_editservice',compact('serviceid','districts','servicename','amount','customers','payment','mainbalance','coordinator_permission','admin_payment'));

}  elseif ($serviceid == 213 || $serviceid == 214 || $serviceid == 215){
    return view( 'applyservice.pattaservice',compact('serviceid','districts','servicename','amount','customers','payment'));

}  elseif ($serviceid == 192 || $serviceid == 193 || $serviceid == 194){
    return view( 'applyservice.pattaservice',compact('serviceid','districts','servicename','amount','customers','payment'));

} elseif ( $serviceid == 196 ){
    $mainbalance = DB::table( 'users' )->select('wallet')->where('id',2)->first();
    $pandetails = DB::table( 'utislpan' )->where('user_id',Auth::user()->id)->where('service_id',$serviceid)->orderBy( 'id', 'Desc' )->get();
    return view( 'applyservice.newpan',compact('serviceid','districts','servicename','amount','customers','payment','pandetails','mainbalance'));

 }elseif ( $serviceid == 197 ){
    $mainbalance = DB::table( 'users' )->select('wallet')->where('id',2)->first();
    $pandetails = DB::table( 'utislpan' )->where('user_id',Auth::user()->id)->where('service_id',$serviceid)->orderBy( 'id', 'Desc' )->get();
    return view( 'applyservice.utislpancorrection',compact('serviceid','districts','servicename','amount','customers','payment','pandetails','mainbalance'));

}elseif ($serviceid == 220 ){
    $mainbalance = DB::table( 'users' )->select('rawallet')->where('id',2)->first();
    return view( 'applyservice.smartcard_otpservice',compact('serviceid','districts','servicename','amount','customers','payment','mainbalance','coordinator_permission','admin_payment'));

}elseif ($serviceid == 221 || $serviceid == 222 || $serviceid == 227|| $serviceid == 228 || $serviceid == 229 || $serviceid == 230 || $serviceid == 231 || $serviceid == 232 || $serviceid == 235 ){
    $mainbalance = DB::table( 'users' )->select('rawallet')->where('id',2)->first();
    return view( 'applyservice.smartcard_nametransfer',compact('serviceid','districts','servicename','amount','customers','payment','mainbalance','coordinator_permission','admin_payment'));
 }  elseif ( $serviceid == 217 ){
    $mainbalance = DB::table( 'users' )->select('wallet')->where('id',2)->first();
    $pandetails = DB::table( 'utislpan' )->where('user_id',Auth::user()->id)->where('service_id',$serviceid)->orderBy( 'id', 'Desc' )->get();
    return view( 'applyservice.newpan',compact('serviceid','districts','servicename','amount','customers','payment','pandetails','mainbalance'));

 }elseif ( $serviceid == 218 ){
    $mainbalance = DB::table( 'users' )->select('wallet')->where('id',2)->first();
    $pandetails = DB::table( 'utislpan' )->where('user_id',Auth::user()->id)->where('service_id',$serviceid)->orderBy( 'id', 'Desc' )->get();
    return view( 'applyservice.utislpancorrection',compact('serviceid','districts','servicename','amount','customers','payment','pandetails','mainbalance'));

} elseif ($serviceid == 157) {
    return view('applyservice.pvccardprint', compact('serviceid', 'districts', 'servicename', 'amount', 'customers', 'payment'));

}
}


public function get_subservice($parentid)
{
    $get_subservice = DB::table('services')->where('parent_id', $parentid)->orderBy('id', 'Asc')->get();
    return response()->json($get_subservice);
}

public function get_taluk($distid)
{
    $response = DB::table('taluk')->where('dist_id',$distid)->orderBy( 'id', 'Asc' )->get();
    return response()->json( $response );
}

public function variyamget_taluk($districtid)
{
    $response = DB::table('nalavariyam_taluk')->where('parent',$districtid)->orderBy( 'id', 'Asc' )->get();
    return response()->json( $response );
}

public function get_panchayath($taluk_id)
{
    $response = DB::table('panchayath')->where('taluk_id',$taluk_id)->orderBy( 'id', 'Asc' )->get();
    return response()->json( $response );
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

    $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
    $servicename = "";
    if($getservicename){
        $servicename = $getservicename->service_name;
    }
    $date = date( 'Y-m-d' );
    $time = date( 'H:i:s' );
    $service_status = 'Out Payment';
    $ad_info = 'Service Payment'. ' '. $servicename;
    $getwallet = DB::table( 'users' )->select('wallet')->where('id',1)->first();
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

    return redirect()->back()->with( 'success', 'Service Applied Successfully' );
}

public function submitapply_tnegaservices1(Request $request){
    //dd($request->all());
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
            'personalized'        => $request->personalized,
            'relationship_1'        => $request->relationship_1,
            'relationship_2'        => $request->relationship_2,
            'relationship_3'        => $request->relationship_3,
            'dob'        => $request->dob,
            'religion'        => $request->religion,
            'education'        => $request->education,
            'work'        => $request->work,
            'door_no'        => $request->door_no,
            'personalized_name_tamil'        => $request->personalized_name_tamil,
            'relationship_name_tamil_1'        => $request->relationship_name_tamil_1,
            'relationship_name_tamil_2'        => $request->relationship_name_tamil_2,
            'relationship_name_tamil_3'        => $request->relationship_name_tamil_3,
            'community'        => $request->community,
            'smartcard_number'        => $request->smartcard_number,
            'street_name_tamil'        => $request->street_name_tamil,
            'personalized_name_english'        => $request->personalized_name_english,
            'relationship_name_english_1'        => $request->relationship_name_english_1,
            'relationship_name_english_2'        => $request->relationship_name_english_2,
            'relationship_name_english_3'        => $request->relationship_name_english_3,
            'maritial_status'        => $request->maritial_status,
            'caste'                  => $request->caste,
            'street_name'        => $request->street_name,
            'pin_code'        => $request->pin_code,
            'postal_area_tamil'        => $request->postal_area_tamil,
            'postal_area_english'        => $request->postal_area_english,
            'can_number'        => $request->can_number,
            'mother_name_tamil'        => $request->mother_name_tamil,
            'mother_name_english'        => $request->mother_name_english,
            'father_community'        => $request->father_community,
            'father_caste'        => $request->father_caste,
            'mother_community'        => $request->mother_community,
            'mother_caste'        => $request->mother_caste,
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
                'income_monthly'       => $request->income_monthly,

            ]);
        }elseif($serviceid == 3){
            $tc_community_certificate = "";
            $affidavit = "";
            $self_community_certificate = "";
            if ($request->tc_community_certificate != null) {
                $tc_community_certificate = uniqid().'.'.$request->file('tc_community_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'tc_community_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['tc_community_certificate']['tmp_name'], $filepath . $tc_community_certificate);
            }
            if ($request->affidavit != null) {
                $affidavit = uniqid().'.'.$request->file('affidavit')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'affidavit' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['affidavit']['tmp_name'], $filepath . $affidavit);
            }
            if ($request->self_community_certificate != null) {
                $self_community_certificate = uniqid().'.'.$request->file('self_community_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'self_community_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['self_community_certificate']['tmp_name'], $filepath . $self_community_certificate);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'relationship'                     => $request->relationship,
                'tc_community_certificate'         => $tc_community_certificate,
                'affidavit'                        => $affidavit,
                'self_community_certificate'       => $self_community_certificate,
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

            DB::table('tnega_services')->where('id', $insertid)->update([
                'age_proof'         => $request->age_proof,
            ]);

        }

        if($request->has('family_relationship')){
            foreach ( $request->family_relationship as $key => $relation ) {
              $relation_name = $request->relation_name[ $key ];
              $relation_name_tamil = $request->relation_name_tamil[ $key ];
              $relation_age = $request->relation_age[ $key ];
              $relation_income = $request->relation_income[ $key ];
              $occupation = $request->occupation[ $key ];

              $sql = "insert into family_member (service_id,relation,relation_name,relation_name_tamil,relation_age,relation_income,occupation) values ($insertid,'$relation','$relation_name','$relation_name_tamil','$relation_age','$relation_income','$occupation')";
              DB::insert( $sql );


            }
          }



        $servicepayment = $request->service_amount;
        if(Auth::user()->user_type_id == 3){
            $user_id = $distributor_id;
        }elseif(Auth::user()->user_type_id == 4){
            $user_id = $retailer_id;
        }elseif(Auth::user()->user_type_id == 5){
            $user_id = $user_id;
        }
        $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
        $servicename = "";
        if($getservicename){
            $servicename = $getservicename->service_name;
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
        $ad_info = 'Service Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update( DB::raw( $sql ) );

$getpermission = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
$coordinator_permission = 0;
$admin_payment = 0;
if($getpermission){
    $coordinator_permission = $getpermission->coordinator_permission;
    $admin_payment = $getpermission->admin_amount;
}
if($coordinator_permission == 1){
    $post_data = array();

    $getdata = DB::table( 'tnega_services' )->where('id',$insertid)->get();
     $getdata = json_decode( json_encode( $getdata ), true );
            foreach ( $getdata as $key => $ser ) {
                $getdata[ $key ][ 'family_details' ] = array();
                $getdata[ $key ][ 'customer_details' ] = array();
                $getdata[ $key ][ 'details' ] = array();
                $getdata[ $key ][ 'agri_details' ] = array();
                $getdata[ $key ][ 'agri_documents' ] = array();
                $ser_id = $ser[ 'id' ];
                $user_id = $ser[ 'user_id' ];
                $sql = "select * from family_member where service_id=$ser_id order by id Asc";
                $result = DB::select( $sql );
                $sql = "select * from users where id=$user_id";
                $result1 = DB::select( $sql );
                $getdata[ $key ][ 'family_details' ] = $result;
                $getdata[ $key ][ 'customer_details' ] = $result1;
            }
    if(count($getdata) > 0){

     $API_KEY = env( 'API_KEY', '' );
     $RAMJIPAY_URL = env( 'RAMJIPAY_URL', '' );
     $WEBSITE_INDEX = env( 'WEBSITE_INDEX', '' );
      $post_data['data'] = $getdata;
      $post_data['key'] = $API_KEY;
      $post_data['index'] = $WEBSITE_INDEX;
     $ch = curl_init();
    //echo "<pre>";print_r($post_data);echo"</pre>";die;
    //dd(json_encode($post_data));
     //dd($post_data);
     $url1 = $RAMJIPAY_URL.'/api/get_tnegaservices_api';
   //echo $url1;die;
     curl_setopt( $ch, CURLOPT_URL, $url1 );
     curl_setopt( $ch, CURLOPT_POST, 1 );
     curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode($post_data) );
     curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
     curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
     $server_output = curl_exec( $ch );
     curl_close( $ch );
     $resdata = json_decode($server_output, true);
        //
     if($resdata){
        $status = $resdata['message'];
        if($status == "Success"){
         $date = date( 'Y-m-d' );
         $time = date( 'H:i:s' );
         $service_status = 'Out Payment';
         $ad_info = 'Ramji Wallet Debit'.' '.$servicename;
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
         $newbalance2 = $balance1 + $admin_payment;
         $newbalance3 = $balance2 - $admin_payment;
         $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
         DB::insert( DB::raw( $sql ) );
         $sql = "update users set rawallet = rawallet + $admin_payment where id = 1";
         DB::update( DB::raw( $sql ) );
         $service_status = 'IN Payment';
         $ad_info = 'Ramji Wallet Credit'.' '.$servicename;

         $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
         DB::insert( DB::raw( $sql ) );
         $sql = "update users set rawallet = rawallet - $admin_payment where id = 2";
         DB::update( DB::raw( $sql ) );
     }
 }

}
}

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
            'personalized'        => $request->personalized,
            'relationship_1'        => $request->relationship_1,
            'relationship_2'        => $request->relationship_2,
            'relationship_3'        => $request->relationship_3,
            'dob'        => $request->dob,
            'religion'        => $request->religion,
            'education'        => $request->education,
            'work'        => $request->work,
            'door_no'        => $request->door_no,
            'personalized_name_tamil'        => $request->personalized_name_tamil,
            'relationship_name_tamil_1'        => $request->relationship_name_tamil_1,
            'relationship_name_tamil_2'        => $request->relationship_name_tamil_2,
            'relationship_name_tamil_3'        => $request->relationship_name_tamil_3,
            'community'        => $request->community,
            'smartcard_number'        => $request->smartcard_number,
            'street_name_tamil'        => $request->street_name_tamil,
            'personalized_name_english'        => $request->personalized_name_english,
            'relationship_name_english_1'        => $request->relationship_name_english_1,
            'relationship_name_english_2'        => $request->relationship_name_english_2,
            'relationship_name_english_3'        => $request->relationship_name_english_3,
            'maritial_status'        => $request->maritial_status,
            'caste'        => $request->caste,
            'street_name'        => $request->street_name,
            'pin_code'        => $request->pin_code,
            'postal_area_tamil'        => $request->postal_area_tamil,
            'postal_area_english'        => $request->postal_area_english,
            'can_number'        => $request->can_number,
            'mother_name_tamil'        => $request->mother_name_tamil,
            'mother_name_english'        => $request->mother_name_english,
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
            $strap = "";
            if ($request->strap != null) {
                $strap = uniqid().'.'.$request->file('strap')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'strap' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['strap']['tmp_name'], $filepath . $strap);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'strap'         => $strap,
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

             DB::table('tnega_services')->where('id', $insertid)->update([
                'any_proof'         => $request->any_proof,
                'area'         => $request->area,
            ]);


            if($request->has('doc_name')){
            foreach ( $request->doc_name as $key => $r ) {

              $sql = "insert into document (service_id,doc_name) values ($insertid,'$r')";
              DB::insert( $sql );

              $relation_id = DB::getPdo()->lastInsertId();
              $file1 = "";
              if (isset($request->doc[$key])) {
                if ($request->doc[$key] != null) {
                    $file1 = uniqid().'.'.$request->file('doc')[$key]->extension();
              //dd($request->doc[$key]);
                    $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'doc' . DIRECTORY_SEPARATOR);
                    move_uploaded_file($_FILES['doc']['tmp_name'][$key], $filepath . $file1);
                    DB::table( 'document' )->where( 'id', $relation_id )->update( [
                      'doc'       => $file1,
                  ] );
                }
            }


        }
    }
    if($request->has('proof')){
        foreach ( $request->proof as $key => $proof ) {
          $district = $request->district[ $key ];
          $taluk = $request->taluk[ $key ];
          $village = $request->village[ $key ];
          $patta_no = $request->patta_no[ $key ];
          $field_no = $request->field_no[ $key ];
          $subdivision_no = $request->subdivision_no[ $key ];
          $area = $request->area1[ $key ];

          $sql = "insert into agri_details (service_id,district,taluk,village,patta_no,field_no,subdivision_no,area,pattatype) values ($insertid,'$district','$taluk','$village','$patta_no','$field_no','$subdivision_no','$area','$proof')";
          DB::insert( $sql );


      }
        }
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
        $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
        $servicename = "";
        if($getservicename){
            $servicename = $getservicename->service_name;
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
        $ad_info = 'Service Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update( DB::raw( $sql ) );

$getpermission = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
$coordinator_permission = 0;
$admin_payment = 0;
if($getpermission){
    $coordinator_permission = $getpermission->coordinator_permission;
    $admin_payment = $getpermission->admin_amount;
}
if($coordinator_permission == 1){
    $post_data = array();

    $getdata = DB::table( 'tnega_services' )->where('id',$insertid)->get();
     $getdata = json_decode( json_encode( $getdata ), true );
            foreach ( $getdata as $key => $ser ) {
                $getdata[ $key ][ 'family_details' ] = array();
                $getdata[ $key ][ 'customer_details' ] = array();
                $getdata[ $key ][ 'agri_details' ] = array();
                $getdata[ $key ][ 'agri_documents' ] = array();
                $ser_id = $ser[ 'id' ];
                $user_id = $ser[ 'user_id' ];
                $sql = "select * from family_member where service_id=$ser_id order by id Asc";
                $result = DB::select( $sql );
                $sql = "select * from users where id=$user_id";
                $result1 = DB::select( $sql );
                 $sql = "select * from agri_details where service_id=$ser_id order by id Asc";
                $result2 = DB::select( $sql );
                 $sql = "select * from document where service_id=$ser_id order by id Asc";
                $result3 = DB::select( $sql );
                $getdata[ $key ][ 'family_details' ] = $result;
                $getdata[ $key ][ 'customer_details' ] = $result1;
                $getdata[ $key ][ 'agri_details' ] = $result2;
                $getdata[ $key ][ 'agri_documents' ] = $result3;
            }

    if(count($getdata) > 0){

     $API_KEY = env( 'API_KEY', '' );
     $RAMJIPAY_URL = env( 'RAMJIPAY_URL', '' );
     $WEBSITE_INDEX = env( 'WEBSITE_INDEX', '' );
      $post_data['data'] = $getdata;
      $post_data['key'] = $API_KEY;
      $post_data['index'] = $WEBSITE_INDEX;
     $ch = curl_init();

    //echo "<pre>";print_r($post_data);echo"</pre>";die;
    //dd(json_encode($post_data));
     //dd($post_data);
     $url1 = $RAMJIPAY_URL.'/api/get_tnegaservices_api';
   //echo $url1;die;
     curl_setopt( $ch, CURLOPT_URL, $url1 );
     curl_setopt( $ch, CURLOPT_POST, 1 );
     curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode($post_data) );
     curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
     curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
     $server_output = curl_exec( $ch );
     curl_close( $ch );
     $resdata = json_decode($server_output, true);
        //dd($resdata);
     if($resdata){
        $status = $resdata['message'];
        if($status == "Success"){
         $date = date( 'Y-m-d' );
         $time = date( 'H:i:s' );
         $service_status = 'Out Payment';
         $ad_info = 'Ramji Wallet Debit'.' '.$servicename;
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
         $newbalance2 = $balance1 + $admin_payment;
         $newbalance3 = $balance2 - $admin_payment;
         $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
         DB::insert( DB::raw( $sql ) );
         $sql = "update users set rawallet = rawallet + $admin_payment where id = 1";
         DB::update( DB::raw( $sql ) );
         $service_status = 'IN Payment';
         $ad_info = 'Ramji Wallet Credit'.' '.$servicename;

         $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
         DB::insert( DB::raw( $sql ) );
         $sql = "update users set rawallet = rawallet - $admin_payment where id = 2";
         DB::update( DB::raw( $sql ) );
     }
 }

}
}
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
            'personalized'        => $request->personalized,
            'relationship_1'        => $request->relationship_1,
            'relationship_2'        => $request->relationship_2,
            'relationship_3'        => $request->relationship_3,
            'dob'        => $request->dob,
            'religion'        => $request->religion,
            'education'        => $request->education,
            'work'        => $request->work,
            'door_no'        => $request->door_no,
            'personalized_name_tamil'        => $request->personalized_name_tamil,
            'relationship_name_tamil_1'        => $request->relationship_name_tamil_1,
            'relationship_name_tamil_2'        => $request->relationship_name_tamil_2,
            'relationship_name_tamil_3'        => $request->relationship_name_tamil_3,
            'community'        => $request->community,
            'smartcard_number'        => $request->smartcard_number,
            'street_name_tamil'        => $request->street_name_tamil,
            'personalized_name_english'        => $request->personalized_name_english,
            'relationship_name_english_1'        => $request->relationship_name_english_1,
            'relationship_name_english_2'        => $request->relationship_name_english_2,
            'relationship_name_english_3'        => $request->relationship_name_english_3,
            'maritial_status'        => $request->maritial_status,
            'caste'        => $request->caste,
            'street_name'        => $request->street_name,
            'pin_code'        => $request->pin_code,
            'postal_area_tamil'        => $request->postal_area_tamil,
            'postal_area_english'        => $request->postal_area_english,
            'can_number'        => $request->can_number,
            'mother_name_tamil'        => $request->mother_name_tamil,
            'mother_name_english'        => $request->mother_name_english,
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
        $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
        $servicename = "";
        if($getservicename){
            $servicename = $getservicename->service_name;
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
        $ad_info = 'Service Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update( DB::raw( $sql ) );

$getpermission = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
$coordinator_permission = 0;
$admin_payment = 0;
if($getpermission){
    $coordinator_permission = $getpermission->coordinator_permission;
    $admin_payment = $getpermission->admin_amount;
}
if($coordinator_permission == 1){
    $post_data = array();

    $getdata = DB::table( 'tnega_services' )->where('id',$insertid)->get();
     $getdata = json_decode( json_encode( $getdata ), true );
            foreach ( $getdata as $key => $ser ) {
                $getdata[ $key ][ 'family_details' ] = array();
                $getdata[ $key ][ 'customer_details' ] = array();
                $getdata[ $key ][ 'details' ] = array();
                $getdata[ $key ][ 'agri_details' ] = array();
                $getdata[ $key ][ 'agri_documents' ] = array();
                $ser_id = $ser[ 'id' ];
                $user_id = $ser[ 'user_id' ];
                $sql = "select * from family_member where service_id=$ser_id order by id Asc";
                $result = DB::select( $sql );
                $sql = "select * from users where id=$user_id";
                $result1 = DB::select( $sql );
                $getdata[ $key ][ 'family_details' ] = $result;
                $getdata[ $key ][ 'customer_details' ] = $result1;
            }
    if(count($getdata) > 0){

     $API_KEY = env( 'API_KEY', '' );
     $RAMJIPAY_URL = env( 'RAMJIPAY_URL', '' );
     $WEBSITE_INDEX = env( 'WEBSITE_INDEX', '' );
      $post_data['data'] = $getdata;
      $post_data['key'] = $API_KEY;
      $post_data['index'] = $WEBSITE_INDEX;
     $ch = curl_init();

    //echo "<pre>";print_r($post_data);echo"</pre>";die;
    //dd(json_encode($post_data));
     //dd($post_data);
     $url1 = $RAMJIPAY_URL.'/api/get_tnegaservices_api';
   //echo $url1;die;
     curl_setopt( $ch, CURLOPT_URL, $url1 );
     curl_setopt( $ch, CURLOPT_POST, 1 );
     curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode($post_data) );
     curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
     curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
     $server_output = curl_exec( $ch );
     curl_close( $ch );
     $resdata = json_decode($server_output, true);
        //
         //dd($resdata);
     if($resdata){
        $status = $resdata['message'];
        if($status == "Success"){
         $date = date( 'Y-m-d' );
         $time = date( 'H:i:s' );
         $service_status = 'Out Payment';
         $ad_info = 'Ramji Wallet Debit'.' '.$servicename;
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
         $newbalance2 = $balance1 + $admin_payment;
         $newbalance3 = $balance2 - $admin_payment;
         $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
         DB::insert( DB::raw( $sql ) );
         $sql = "update users set rawallet = rawallet + $admin_payment where id = 1";
         DB::update( DB::raw( $sql ) );
         $service_status = 'IN Payment';
         $ad_info = 'Ramji Wallet Credit'.' '.$servicename;

         $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
         DB::insert( DB::raw( $sql ) );
         $sql = "update users set rawallet = rawallet - $admin_payment where id = 2";
         DB::update( DB::raw( $sql ) );
     }
 }

}
}
        return redirect("appliedservice/Pending")->With("success","Application submitted Succesfully");

    }
    public function submitapply_tnegaservices4(Request $request){

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
            'personalized'        => $request->personalized,
            'relationship_1'        => $request->relationship_1,
            'relationship_2'        => $request->relationship_2,
            'relationship_3'        => $request->relationship_3,
            'dob'        => $request->dob,
            'religion'        => $request->religion,
            'education'        => $request->education,
            'work'        => $request->work,
            'door_no'        => $request->door_no,
            'personalized_name_tamil'        => $request->personalized_name_tamil,
            'relationship_name_tamil_1'        => $request->relationship_name_tamil_1,
            'relationship_name_tamil_2'        => $request->relationship_name_tamil_2,
            'relationship_name_tamil_3'        => $request->relationship_name_tamil_3,
            'community'        => $request->community,
            'smartcard_number'        => $request->smartcard_number,
            'street_name_tamil'        => $request->street_name_tamil,
            'personalized_name_english'        => $request->personalized_name_english,
            'relationship_name_english_1'        => $request->relationship_name_english_1,
            'relationship_name_english_2'        => $request->relationship_name_english_2,
            'relationship_name_english_3'        => $request->relationship_name_english_3,
            'maritial_status'        => $request->maritial_status,
            'caste'        => $request->caste,
            'street_name'        => $request->street_name,
            'pin_code'        => $request->pin_code,
           'postal_area_tamil'        => $request->postal_area_tamil,
            'postal_area_english'        => $request->postal_area_english,
            'can_number'        => $request->can_number,
            'mother_name_tamil'        => $request->mother_name_tamil,
            'mother_name_english'        => $request->mother_name_english,
            'status'        => 'Pending',
            'applied_date'  => date("Y-m-d"),
            'created_at'    => date("Y-m-d"),
        ] );

        $insertid = DB::getPdo()->lastInsertId();

        $aadhaar_card = "";
        if ($request->aadhaar_card != null) {
            $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'aadhaar_card'         => $aadhaar_card,
        ]);
        $smart_card = "";
        if ($request->smart_card != null) {
            $smart_card = uniqid().'.'.$request->file('smart_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smart_card);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'smart_card'         => $smart_card,
        ]);
        $photo = "";
        if ($request->photo != null) {
            $photo = uniqid().'.'.$request->file('photo')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'photo'         => $photo,
        ]);
        $signature = "";
        if ($request->signature != null) {
            $signature = uniqid().'.'.$request->file('signature')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'signature' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['signature']['tmp_name'], $filepath . $signature);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'signature'         => $signature,
        ]);
        $tailoring_certificate = "";
        if ($request->tailoring_certificate != null) {
            $tailoring_certificate = uniqid().'.'.$request->file('tailoring_certificate')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'tailoring_certificate' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['tailoring_certificate']['tmp_name'], $filepath . $tailoring_certificate);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'tailoring_certificate'         => $tailoring_certificate,
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



        $servicepayment = $request->service_amount;
        if(Auth::user()->user_type_id == 3){
            $user_id = $distributor_id;
        }elseif(Auth::user()->user_type_id == 4){
            $user_id = $retailer_id;
        }elseif(Auth::user()->user_type_id == 5){
            $user_id = $user_id;
        }
        $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
        $servicename = "";
        if($getservicename){
            $servicename = $getservicename->service_name;
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
        $ad_info = 'Service Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update( DB::raw( $sql ) );

$getpermission = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
$coordinator_permission = 0;
$admin_payment = 0;
if($getpermission){
    $coordinator_permission = $getpermission->coordinator_permission;
    $admin_payment = $getpermission->admin_amount;
}
if($coordinator_permission == 1){
    $post_data = array();

    $getdata = DB::table( 'tnega_services' )->where('id',$insertid)->get();
     $getdata = json_decode( json_encode( $getdata ), true );
            foreach ( $getdata as $key => $ser ) {
                $getdata[ $key ][ 'family_details' ] = array();
                $getdata[ $key ][ 'customer_details' ] = array();
                $getdata[ $key ][ 'details' ] = array();
                $getdata[ $key ][ 'agri_details' ] = array();
                $getdata[ $key ][ 'agri_documents' ] = array();
                $ser_id = $ser[ 'id' ];
                $user_id = $ser[ 'user_id' ];
                $sql = "select * from family_member where service_id=$ser_id order by id Asc";
                $result = DB::select( $sql );
                $sql = "select * from users where id=$user_id";
                $result1 = DB::select( $sql );
                $getdata[ $key ][ 'family_details' ] = $result;
                $getdata[ $key ][ 'customer_details' ] = $result1;
            }
    if(count($getdata) > 0){

     $API_KEY = env( 'API_KEY', '' );
     $RAMJIPAY_URL = env( 'RAMJIPAY_URL', '' );
     $WEBSITE_INDEX = env( 'WEBSITE_INDEX', '' );
      $post_data['data'] = $getdata;
      $post_data['key'] = $API_KEY;
      $post_data['index'] = $WEBSITE_INDEX;
     $ch = curl_init();

    //echo "<pre>";print_r($post_data);echo"</pre>";die;
    //dd(json_encode($post_data));
     //dd($post_data);
     $url1 = $RAMJIPAY_URL.'/api/get_tnegaservices_api';
   //echo $url1;die;
     curl_setopt( $ch, CURLOPT_URL, $url1 );
     curl_setopt( $ch, CURLOPT_POST, 1 );
     curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode($post_data) );
     curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
     curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
     $server_output = curl_exec( $ch );
     curl_close( $ch );
     $resdata = json_decode($server_output, true);
        //
         //dd($resdata);
     if($resdata){
        $status = $resdata['message'];
        if($status == "Success"){
         $date = date( 'Y-m-d' );
         $time = date( 'H:i:s' );
         $service_status = 'Out Payment';
         $ad_info = 'Ramji Wallet Debit'.' '.$servicename;
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
         $newbalance2 = $balance1 + $admin_payment;
         $newbalance3 = $balance2 - $admin_payment;
         $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
         DB::insert( DB::raw( $sql ) );
         $sql = "update users set rawallet = rawallet + $admin_payment where id = 1";
         DB::update( DB::raw( $sql ) );
         $service_status = 'IN Payment';
         $ad_info = 'Ramji Wallet Credit'.' '.$servicename;

         $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
         DB::insert( DB::raw( $sql ) );
         $sql = "update users set rawallet = rawallet - $admin_payment where id = 2";
         DB::update( DB::raw( $sql ) );
     }
 }

}
}
    return redirect("appliedservice/Pending")->With("success","Application submitted Succesfully");

}

    public function submitapply_tnegaservices5(Request $request){

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
            'user_id'       =>   $user_id,
            'retailer_id'   =>   $retailer_id,
            'distributor_id'=>   $distributor_id,
            'service_id'    => $request->serviceid,
            'amount'        => $request->amount,
            'can_details'        => $request->can_details,
            'personalized'        => $request->personalized,
            'relationship_1'        => $request->relationship_1,
            'relationship_2'        => $request->relationship_2,
            'relationship_3'        => $request->relationship_3,
            'dob'        => $request->dob,
            'religion'        => $request->religion,
            'education'        => $request->education,
            'work'        => $request->work,
            'door_no'        => $request->door_no,
            'personalized_name_tamil'        => $request->personalized_name_tamil,
            'relationship_name_tamil_1'        => $request->relationship_name_tamil_1,
            'relationship_name_tamil_2'        => $request->relationship_name_tamil_2,
            'relationship_name_tamil_3'        => $request->relationship_name_tamil_3,
            'community'        => $request->community,
            'smartcard_number'        => $request->smartcard_number,
            'street_name_tamil'        => $request->street_name_tamil,
            'personalized_name_english'        => $request->personalized_name_english,
            'relationship_name_english_1'        => $request->relationship_name_english_1,
            'relationship_name_english_2'        => $request->relationship_name_english_2,
            'relationship_name_english_3'        => $request->relationship_name_english_3,
            'maritial_status'        => $request->maritial_status,
            'caste'        => $request->caste,
            'street_name'        => $request->street_name,
            'pin_code'        => $request->pin_code,
            'postal_area_tamil'        => $request->postal_area_tamil,
            'postal_area_english'        => $request->postal_area_english,
            'can_number'    => $request->can_number,
            'mother_name_tamil'        => $request->mother_name_tamil,
            'mother_name_english'        => $request->mother_name_english,
            'handicapped_proof'    => $request->handicapped_proof,
            'status'        => 'Pending',
            'applied_date'  => date("Y-m-d"),
            'created_at'    => date("Y-m-d"),
        ] );

        $insertid = DB::getPdo()->lastInsertId();
        if($serviceid == 170){
            $aadhaar_card = "";
            if ($request->aadhaar_card != null) {
                $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'aadhaar_card'         => $aadhaar_card,
            ]);
            $smart_card = "";
            if ($request->smart_card != null) {
                $smart_card = uniqid().'.'.$request->file('smart_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smart_card);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'smart_card'         => $smart_card,
            ]);
            $photo = "";
            if ($request->photo != null) {
                $photo = uniqid().'.'.$request->file('photo')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'photo'         => $photo,
            ]);
            $signature = "";
            if ($request->signature != null) {
                $signature = uniqid().'.'.$request->file('signature')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'signature' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['signature']['tmp_name'], $filepath . $signature);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'signature'         => $signature,
            ]);
            $family_photo = "";
            if ($request->family_photo != null) {
                $family_photo = uniqid().'.'.$request->file('family_photo')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'family_photo' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['family_photo']['tmp_name'], $filepath . $family_photo);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'family_photo'         => $family_photo,
            ]);
            $id_proof = "";
            if ($request->id_proof != null) {
                $id_proof = uniqid().'.'.$request->file('id_proof')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'id_proof' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['id_proof']['tmp_name'], $filepath . $id_proof);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'id_proof'         => $id_proof,
            ]);
            $birth_certificate_children = "";
            if ($request->birth_certificate_children != null) {
                $birth_certificate_children = uniqid().'.'.$request->file('birth_certificate_children')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'birth_certificate_children' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['birth_certificate_children']['tmp_name'], $filepath . $birth_certificate_children);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'birth_certificate_children'         => $birth_certificate_children,
            ]);
            $family_plannnig_certificate = "";
            if ($request->family_plannnig_certificate != null) {
                $family_plannnig_certificate = uniqid().'.'.$request->file('family_plannnig_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'family_plannnig_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['family_plannnig_certificate']['tmp_name'], $filepath . $family_plannnig_certificate);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'family_plannnig_certificate'         => $family_plannnig_certificate,
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
            $anyothers_certificate = "";
            if ($request->anyothers_certificate != null) {
                $anyothers_certificate = uniqid().'.'.$request->file('anyothers_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'anyothers_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['anyothers_certificate']['tmp_name'], $filepath . $anyothers_certificate);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'anyothers_certificate'         => $anyothers_certificate,
            ]);
        }elseif($serviceid == 171){

            $udid_card = "";
            if ($request->udid_card != null) {
                $udid_card = uniqid().'.'.$request->file('udid_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'udid_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['udid_card']['tmp_name'], $filepath . $udid_card);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'udid_card'         => $udid_card,
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

        }elseif($serviceid == 172){

            $age_proof = "";
            if ($request->age_proof != null) {
                $age_proof = uniqid().'.'.$request->file('age_proof')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'age_proof' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['age_proof']['tmp_name'], $filepath . $age_proof);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'age_proof'         => $age_proof,
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
        }elseif($serviceid == 176){

            $residential_certificate = "";
            if ($request->residential_certificate != null) {
                $residential_certificate = uniqid().'.'.$request->file('residential_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'residential_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['residential_certificate']['tmp_name'], $filepath . $residential_certificate);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'residential_certificate'         => $residential_certificate,
            ]);
            $solvency_certificate = "";
            if ($request->solvency_certificate != null) {
                $solvency_certificate = uniqid().'.'.$request->file('solvency_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'solvency_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['solvency_certificate']['tmp_name'], $filepath . $solvency_certificate);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'solvency_certificate'         => $solvency_certificate,
            ]);
            $shop_address_proof = "";
            if ($request->shop_address_proof != null) {
                $shop_address_proof = uniqid().'.'.$request->file('shop_address_proof')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'shop_address_proof' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['shop_address_proof']['tmp_name'], $filepath . $shop_address_proof);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'shop_address_proof'         => $shop_address_proof,
            ]);
            $chitta = "";
            if ($request->chitta != null) {
                $chitta = uniqid().'.'.$request->file('chitta')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'chitta' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['chitta']['tmp_name'], $filepath . $chitta);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'chitta'         => $chitta,
            ]);
            $previous_licence = "";
            if ($request->previous_licence != null) {
                $previous_licence = uniqid().'.'.$request->file('previous_licence')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'previous_licence' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['previous_licence']['tmp_name'], $filepath . $previous_licence);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'previous_licence'         => $previous_licence,
            ]);
            $challan = "";
            if ($request->challan != null) {
                $challan = uniqid().'.'.$request->file('challan')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'challan' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['challan']['tmp_name'], $filepath . $challan);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'challan'         => $challan,
            ]);
            $form_A = "";
            if ($request->form_A != null) {
                $form_A = uniqid().'.'.$request->file('form_A')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'form_A' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['form_A']['tmp_name'], $filepath . $form_A);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'form_A'         => $form_A,
            ]);
            $building_licence_document = "";
            if ($request->building_licence_document != null) {
                $building_licence_document = uniqid().'.'.$request->file('building_licence_document')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'building_licence_document' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['building_licence_document']['tmp_name'], $filepath . $building_licence_document);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'building_licence_document'         => $building_licence_document,
            ]);
            $building_blue_print = "";
            if ($request->building_blue_print != null) {
                $building_blue_print = uniqid().'.'.$request->file('building_blue_print')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'building_blue_print' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['building_blue_print']['tmp_name'], $filepath . $building_blue_print);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'building_blue_print'         => $building_blue_print,
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
            $self_declaration_certificate = "";
            if ($request->self_declaration_certificate != null) {
                $self_declaration_certificate = uniqid().'.'.$request->file('self_declaration_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'self_declaration_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['self_declaration_certificate']['tmp_name'], $filepath . $self_declaration_certificate);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'self_declaration_certificate'         => $self_declaration_certificate,
            ]);
            $lease_agreement = "";
            if ($request->lease_agreement != null) {
                $lease_agreement = uniqid().'.'.$request->file('lease_agreement')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'lease_agreement' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['lease_agreement']['tmp_name'], $filepath . $lease_agreement);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'lease_agreement'         => $lease_agreement,
            ]);
            $it_return_document = "";
            if ($request->it_return_document != null) {
                $it_return_document = uniqid().'.'.$request->file('it_return_document')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'it_return_document' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['it_return_document']['tmp_name'], $filepath . $it_return_document);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'it_return_document'         => $it_return_document,
            ]);
        }elseif($serviceid == 177){

            $registered_deed = "";
            if ($request->registered_deed != null) {
                $registered_deed = uniqid().'.'.$request->file('registered_deed')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'registered_deed' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['registered_deed']['tmp_name'], $filepath . $registered_deed);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'registered_deed'         => $registered_deed,
            ]);
            $chitta_and_villangam = "";
            if ($request->chitta_and_villangam != null) {
                $chitta_and_villangam = uniqid().'.'.$request->file('chitta_and_villangam')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'chitta_and_villangam' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['chitta_and_villangam']['tmp_name'], $filepath . $chitta_and_villangam);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'chitta_and_villangam'         => $chitta_and_villangam,
            ]);
            $property_details = "";
            if ($request->property_details != null) {
                $property_details = uniqid().'.'.$request->file('property_details')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'property_details' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['property_details']['tmp_name'], $filepath . $property_details);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'property_details'         => $property_details,
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

        }elseif($serviceid == 178){

            $residential_certificate = "";
            if ($request->residential_certificate != null) {
                $residential_certificate = uniqid().'.'.$request->file('residential_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'residential_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['residential_certificate']['tmp_name'], $filepath . $residential_certificate);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'residential_certificate'         => $residential_certificate,
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
            $damage_certificate = "";
            if ($request->damage_certificate != null) {
                $damage_certificate = uniqid().'.'.$request->file('damage_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'damage_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['damage_certificate']['tmp_name'], $filepath . $damage_certificate);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'damage_certificate'         => $damage_certificate,
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
        $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
        $servicename = "";
        if($getservicename){
            $servicename = $getservicename->service_name;
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
        $ad_info = 'Service Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update( DB::raw( $sql ) );

        $getpermission = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
$coordinator_permission = 0;
$admin_payment = 0;
if($getpermission){
    $coordinator_permission = $getpermission->coordinator_permission;
    $admin_payment = $getpermission->admin_amount;
}
if($coordinator_permission == 1){
    $post_data = array();

    $getdata = DB::table( 'tnega_services' )->where('id',$insertid)->get();
     $getdata = json_decode( json_encode( $getdata ), true );
            foreach ( $getdata as $key => $ser ) {
                $getdata[ $key ][ 'family_details' ] = array();
                $getdata[ $key ][ 'customer_details' ] = array();
                $getdata[ $key ][ 'details' ] = array();
                $getdata[ $key ][ 'agri_details' ] = array();
                $getdata[ $key ][ 'agri_documents' ] = array();
                $ser_id = $ser[ 'id' ];
                $user_id = $ser[ 'user_id' ];
                $sql = "select * from family_member where service_id=$ser_id order by id Asc";
                $result = DB::select( $sql );
                $sql = "select * from users where id=$user_id";
                $result1 = DB::select( $sql );
                $getdata[ $key ][ 'family_details' ] = $result;
                $getdata[ $key ][ 'customer_details' ] = $result1;
            }
    if(count($getdata) > 0){

     $API_KEY = env( 'API_KEY', '' );
     $RAMJIPAY_URL = env( 'RAMJIPAY_URL', '' );
     $WEBSITE_INDEX = env( 'WEBSITE_INDEX', '' );
      $post_data['data'] = $getdata;
      $post_data['key'] = $API_KEY;
      $post_data['index'] = $WEBSITE_INDEX;
     $ch = curl_init();

    //echo "<pre>";print_r($post_data);echo"</pre>";die;
    //dd(json_encode($post_data));
     //dd($post_data);
     $url1 = $RAMJIPAY_URL.'/api/get_tnegaservices_api';
   //echo $url1;die;
     curl_setopt( $ch, CURLOPT_URL, $url1 );
     curl_setopt( $ch, CURLOPT_POST, 1 );
     curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode($post_data) );
     curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
     curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
     $server_output = curl_exec( $ch );
     curl_close( $ch );
     $resdata = json_decode($server_output, true);

         //dd($resdata);
     if($resdata){
        $status = $resdata['message'];
        if($status == "Success"){
         $date = date( 'Y-m-d' );
         $time = date( 'H:i:s' );
         $service_status = 'Out Payment';
         $ad_info = 'Ramji Wallet Debit'.' '.$servicename;
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
         $newbalance2 = $balance1 + $admin_payment;
         $newbalance3 = $balance2 - $admin_payment;
         $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
         DB::insert( DB::raw( $sql ) );
         $sql = "update users set rawallet = rawallet + $admin_payment where id = 1";
         DB::update( DB::raw( $sql ) );
         $service_status = 'IN Payment';
         $ad_info = 'Ramji Wallet Credit'.' '.$servicename;

         $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
         DB::insert( DB::raw( $sql ) );
         $sql = "update users set rawallet = rawallet - $admin_payment where id = 2";
         DB::update( DB::raw( $sql ) );
     }
 }

}
}
        return redirect("appliedservice/Pending")->With("success","Application submitted Succesfully");

    }
    public function submitapply_tnegaservices6(Request $request){
        //dd($request->all());
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
                'personalized'        => $request->personalized,
                'relationship_1'        => $request->relationship_1,
                'relationship_2'        => $request->relationship_2,
                'relationship_3'        => $request->relationship_3,
                'dob'        => $request->dob,
                'religion'        => $request->religion,
                'education'        => $request->education,
                'work'        => $request->work,
                'door_no'        => $request->door_no,
                'personalized_name_tamil'        => $request->personalized_name_tamil,
                'relationship_name_tamil_1'        => $request->relationship_name_tamil_1,
                'relationship_name_tamil_2'        => $request->relationship_name_tamil_2,
                'relationship_name_tamil_3'        => $request->relationship_name_tamil_3,
                'community'        => $request->community,
                'smartcard_number'        => $request->smartcard_number,
                'street_name_tamil'        => $request->street_name_tamil,
                'personalized_name_english'        => $request->personalized_name_english,
                'relationship_name_english_1'        => $request->relationship_name_english_1,
                'relationship_name_english_2'        => $request->relationship_name_english_2,
                'relationship_name_english_3'        => $request->relationship_name_english_3,
                'maritial_status'        => $request->maritial_status,
                'caste'                  => $request->caste,
                'street_name'        => $request->street_name,
                'pin_code'        => $request->pin_code,
                'postal_area_tamil'        => $request->postal_area_tamil,
                'postal_area_english'        => $request->postal_area_english,
                'can_number'        => $request->can_number,
                'mother_name_tamil'        => $request->mother_name_tamil,
                'mother_name_english'        => $request->mother_name_english,
                'course_complete'        => $request->course_complete,
                'year_of_passing'        => $request->year_of_passing,
                'current_course'         => $request->current_course,
                'current_academy_yr'        => $request->current_academy_yr,
                'institute_name_tamil'        => $request->institute_name_tamil,
                'institute_name_english'        => $request->institute_name_english,
                'institute_address_tamil'        => $request->institute_address_tamil,
                'institute_address_english'        => $request->institute_address_english,
                'living_status_1'        => $request->living_status_1,
                'living_status_2'        => $request->living_status_2,
                'status'        => 'Pending',
                'applied_date'  => date("Y-m-d"),
                'created_at'    => date("Y-m-d"),
            ] );
            $insertid = DB::getPdo()->lastInsertId();

            $signature1 = "";
        if ($request->signature1 != null) {
            $signature1 = uniqid().'.'.$request->file('signature1')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'signature1' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['signature1']['tmp_name'], $filepath . $signature1);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'signature1'         => $signature1,
        ]);
        $signature2 = "";
        if ($request->signature2 != null) {
            $signature2 = uniqid().'.'.$request->file('signature2')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'signature2' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['signature2']['tmp_name'], $filepath . $signature2);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'signature2'         => $signature2,
        ]);

        if($request->has('relation')){
            foreach ( $request->relation as $key => $r ) {
              $relation_name_tamil = $request->name_tamil[ $key ];
              $relation_name = $request->name_english[ $key ];
              $living_status = $request->living_status[ $key ];
              $age = $request->age[ $key ];
              $education = $request->education_type[ $key ];

              $sql = "insert into family_member (service_id,relation,relation_name,relation_name_tamil,relation_status,education,relation_age) values ($insertid,'$r','$relation_name','$relation_name_tamil','$living_status','$education','$age')";
              DB::insert( $sql );

              $relation_id = DB::getPdo()->lastInsertId();
              $file1 = "";
              if (isset($request->doc[$key])) {
                if ($request->doc[$key] != null) {
                    $file1 = uniqid().'.'.$request->file('doc')[$key]->extension();
              //dd($request->doc[$key]);
                    $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'doc' . DIRECTORY_SEPARATOR);
                    move_uploaded_file($_FILES['doc']['tmp_name'][$key], $filepath . $file1);
                    DB::table( 'family_member' )->where( 'id', $relation_id )->update( [
                      'doc'       => $file1,
                  ] );
                }
            }


        }
    }

    if($request->has('relationship_add')){
        foreach ( $request->relationship_add as $key => $r ) {
            $relation_name_tamil = $request->name_tamil_add[ $key ];
            $relation_name = $request->name_english_add[ $key ];
            $living_status = $request->living_status_add[ $key ];
            $age = $request->age_add[ $key ];
            $education = $request->education_type_add[ $key ];

            $sql = "insert into family_member (user_id,service_id,relation,relation_name,relation_name_tamil,relation_status,education,relation_age) values ($insertid,$insertid,'$r','$relation_name','$relation_name_tamil','$living_status','$education','$age')";
            DB::insert( $sql );

            $relation_id = DB::getPdo()->lastInsertId();
             $file1 = "";
            if (isset($request->doc1[$key])) {
                if ($request->doc1[$key] != null) {
                    $file1 = uniqid().'.'.$request->file('doc1')[$key]->extension();
              //dd($request->doc[$key]);
                    $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'doc' . DIRECTORY_SEPARATOR);
                    move_uploaded_file($_FILES['doc']['tmp_name'][$key], $filepath . $file1);
                    DB::table( 'family_member' )->where( 'id', $relation_id )->update( [
                      'doc'       => $file1,
                  ] );
                }
            }


        }
    }

            $servicepayment = $request->service_amount;
            if(Auth::user()->user_type_id == 3){
                $user_id = $distributor_id;
            }elseif(Auth::user()->user_type_id == 4){
                $user_id = $retailer_id;
            }elseif(Auth::user()->user_type_id == 5){
                $user_id = $user_id;
            }
            $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
            $servicename = "";
            if($getservicename){
                $servicename = $getservicename->service_name;
            }
            $date = date( 'Y-m-d' );
            $time = date( 'H:i:s' );
            $service_status = 'Out Payment';
            $ad_info = "Service Payment". ' ' .$servicename;

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

$getpermission = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
$coordinator_permission = 0;
$admin_payment = 0;
if($getpermission){
    $coordinator_permission = $getpermission->coordinator_permission;
    $admin_payment = $getpermission->admin_amount;
}
if($coordinator_permission == 1){
    $post_data = array();

    $getdata = DB::table( 'tnega_services' )->where('id',$insertid)->get();
     $getdata = json_decode( json_encode( $getdata ), true );
            foreach ( $getdata as $key => $ser ) {
                $getdata[ $key ][ 'family_details' ] = array();
                $getdata[ $key ][ 'details' ] = array();
                $getdata[ $key ][ 'customer_details' ] = array();
                $getdata[ $key ][ 'agri_details' ] = array();
                $getdata[ $key ][ 'agri_documents' ] = array();
                $ser_id = $ser[ 'id' ];
                $user_id = $ser[ 'user_id' ];

                $sql = "select * from family_member where service_id=$ser_id order by id Asc";
                $result = DB::select( $sql );

                $sql = "select * from users where id=$user_id";
                $result1 = DB::select( $sql );

                 $sql = "select * from family_member where service_id=$ser_id and user_id=$ser_id order by id Asc";
                $result3 = DB::select( $sql );

                $getdata[ $key ][ 'family_details' ] = $result;
                $getdata[ $key ][ 'details' ] = $result3;
                $getdata[ $key ][ 'customer_details' ] = $result1;
            }
    if(count($getdata) > 0){

     $API_KEY = env( 'API_KEY', '' );
     $RAMJIPAY_URL = env( 'RAMJIPAY_URL', '' );
     $WEBSITE_INDEX = env( 'WEBSITE_INDEX', '' );
      $post_data['data'] = $getdata;
      $post_data['key'] = $API_KEY;
      $post_data['index'] = $WEBSITE_INDEX;
     $ch = curl_init();

    //echo "<pre>";print_r($post_data);echo"</pre>";die;
    //dd(json_encode($post_data));
    //dd($post_data);
     $url1 = $RAMJIPAY_URL.'/api/get_tnegaservices_api';
   //echo $url1;die;
     curl_setopt( $ch, CURLOPT_URL, $url1 );
     curl_setopt( $ch, CURLOPT_POST, 1 );
     curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode($post_data) );
     curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
     curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
     $server_output = curl_exec( $ch );
     curl_close( $ch );
     $resdata = json_decode($server_output, true);

        //dd($resdata);
     if($resdata){
        $status = $resdata['message'];
        if($status == "Success"){
         $date = date( 'Y-m-d' );
         $time = date( 'H:i:s' );
         $service_status = 'Out Payment';
         $ad_info = 'Ramji Wallet Debit'.' '.$servicename;
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
         $newbalance2 = $balance1 + $admin_payment;
         $newbalance3 = $balance2 - $admin_payment;
         $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
         DB::insert( DB::raw( $sql ) );
         $sql = "update users set rawallet = rawallet + $admin_payment where id = 1";
         DB::update( DB::raw( $sql ) );
         $service_status = 'IN Payment';
         $ad_info = 'Ramji Wallet Credit'.' '.$servicename;

         $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
         DB::insert( DB::raw( $sql ) );
         $sql = "update users set rawallet = rawallet - $admin_payment where id = 2";
         DB::update( DB::raw( $sql ) );
     }
 }

}
}
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
        'user_id'           =>   $user_id,
        'distributor_id'    =>   $distributor_id,
        'retailer_id'       =>   $retailer_id,
        'service_id'        => $request ->serviceid,
        'amount'            => $request->amount,
        'name'              => $request->name,
        'mobile'            => $request->mobile,
        'dist_id'           => $request->dist_id,
        'taluk_id'          => $request->taluk_id,
        'panchayath_id'     => $request->panchayath_id,
        'cmp_name'          => $request->cmp_name,
        'community'         => $request->community,
        'building_name'     => $request->building_name,
        'ward_no'           => $request->ward_no,
        'pin_code'          => $request->pin_code,
        'account_no'        => $request->account_no,
        'confirm_account_no'=> $request->confirm_account_no,
        'ifsc_code'         => $request->ifsc_code,
        'micr_no'           => $request->micr_no,
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
    $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
    $servicename = "";
    if($getservicename){
        $servicename = $getservicename->service_name;
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
$getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
    $servicename = "";
    if($getservicename){
        $servicename = $getservicename->service_name;
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


return redirect("appliedservice/Pending")->With("success","Application submitted Succesfully");

}

public function submitapply_birthcertificate(Request $request){

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
    if($serviceid == 155 || $serviceid == 156){
        DB::table( 'birth_certificate' )->insert( [
         'user_id'           => $user_id,
         'retailer_id'       => $retailer_id,
         'distributor_id'    => $distributor_id,
         'service_id'        => $request ->serviceid,
         'amount'            => $request->amount,
         'childname'         => $request->childname,
         'dist_id'           => $request->dist_id,
         'date_of_birth'     => $request->date_of_birth,
         'date_of_death'     => $request->date_of_death,
         'place_of_birth'    => $request->place_of_birth,
         'place_of_death'    => $request->place_of_death,
         'hospital_name'     => $request->hospital_name,
         'name'              => $request->name,
         'mobile'            => $request->mobile,
         'aadhaar_no'        => $request->aadhaar_no,
         'status'            => 'Pending',
         'applied_date'      => date("Y-m-d"),
         'created_at'        => date("Y-m-d"),
     ] );


    }
    $servicepayment = $request->service_amount;
    if(Auth::user()->user_type_id == 3){
        $user_id = $distributor_id;
    }elseif(Auth::user()->user_type_id == 4){
        $user_id = $retailer_id;
    }elseif(Auth::user()->user_type_id == 5){
        $user_id = $user_id;
    }
    $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
    $servicename = "";
    if($getservicename){
        $servicename = $getservicename->service_name;
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
$getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
    $servicename = "";
    if($getservicename){
        $servicename = $getservicename->service_name;
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
    $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
    $servicename = "";
    if($getservicename){
        $servicename = $getservicename->service_name;
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

    return redirect("appliedservice/Pending")->With("success","Application submitted Succesfully");

}

public function submitapply_rapexam(Request $request){

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
     'csc_id_number'=> $request->csc_id_number,
     'csc_password'=> $request->csc_password,
     'e_aadhaar_password'=> $request->e_aadhaar_password,
     'status'       => 'Pending',
     'applied_date' => date("Y-m-d"),
     'created_at'   => date("Y-m-d"),
 ] );

    $insertid = DB::getPdo()->lastInsertId();
    $aadhaarimg = "";
    $e_aadhaar_pdf = "";

    if ($request->aadhaar_card != null) {
        $aadhaarimg = uniqid().'.'.$request->file('aadhaar_card')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);

    }
    DB::table('tec_exam')->where('id', $insertid)->update([
      'aadhaar_card' => $aadhaarimg,
  ]);

    if ($request->e_aadhaar_pdf != null) {
        $aadhaarimg = uniqid().'.'.$request->file('e_aadhaar_pdf')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'e_aadhaar_pdf' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['e_aadhaar_pdf']['tmp_name'], $filepath . $aadhaarimg);

    }
    DB::table('tec_exam')->where('id', $insertid)->update([
      'e_aadhaar_pdf' => $e_aadhaar_pdf,
  ]);

    $servicepayment = $request->service_amount;
    if(Auth::user()->user_type_id == 3){
        $user_id = $distributor_id;
    }elseif(Auth::user()->user_type_id == 4){
        $user_id = $retailer_id;
    }elseif(Auth::user()->user_type_id == 5){
        $user_id = $user_id;
    }
    $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
    $servicename = "";
    if($getservicename){
        $servicename = $getservicename->service_name;
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

    return redirect("appliedservice/Pending")->With("success","Application submitted Succesfully");

}

public function submitapply_iibf_exam_register(Request $request){
//dd($request->all());
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
     'status'       => 'Pending',
     'applied_date' => date("Y-m-d"),
     'created_at'   => date("Y-m-d"),
 ] );

    $insertid = DB::getPdo()->lastInsertId();
    $aadhaarimg = "";
    $photo = "";
    $signature = "";
    $pan_card = "";

    if ($request->aadhaar_card != null) {
        $aadhaarimg = uniqid().'.'.$request->file('aadhaar_card')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);

    }
    DB::table('tec_exam')->where('id', $insertid)->update([
      'aadhaar_card' => $aadhaarimg,
  ]);

    if ($request->signature != null) {
        $signature = uniqid().'.'.$request->file('signature')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'signature' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['signature']['tmp_name'], $filepath . $signature);

    }
    DB::table('tec_exam')->where('id', $insertid)->update([
      'signature' => $signature,
  ]);

    if ($request->pan_card != null) {
        $pan_card = uniqid().'.'.$request->file('pan_card')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'pan_card' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['pan_card']['tmp_name'], $filepath . $pan_card);

    }
    DB::table('tec_exam')->where('id', $insertid)->update([
        'pan_card' => $pan_card,
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
    $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
    $servicename = "";
    if($getservicename){
        $servicename = $getservicename->service_name;
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


    return redirect("appliedservice/Pending")->With("success","Application submitted Succesfully");

}

public function submitapply_insexam(Request $request){

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
     'csc_id_number'=> $request->csc_id_number,
     'csc_password'=> $request->csc_password,
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

    $servicepayment = $request->service_amount;
    if(Auth::user()->user_type_id == 3){
        $user_id = $distributor_id;
    }elseif(Auth::user()->user_type_id == 4){
        $user_id = $retailer_id;
    }elseif(Auth::user()->user_type_id == 5){
        $user_id = $user_id;
    }
    $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
    $servicename = "";
    if($getservicename){
        $servicename = $getservicename->service_name;
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


    return redirect("appliedservice/Pending")->With("success","Application submitted Succesfully");

}

public function submitapply_vle_insurance(Request $request){

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
     'csc_id_number'=> $request->csc_id_number,
     'csc_password'=> $request->csc_password,
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

    $servicepayment = $request->service_amount;
    if(Auth::user()->user_type_id == 3){
        $user_id = $distributor_id;
    }elseif(Auth::user()->user_type_id == 4){
        $user_id = $retailer_id;
    }elseif(Auth::user()->user_type_id == 5){
        $user_id = $user_id;
    }
    $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
    $servicename = "";
    if($getservicename){
        $servicename = $getservicename->service_name;
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
    $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
    $servicename = "";
    if($getservicename){
        $servicename = $getservicename->service_name;
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
    $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
    $servicename = "";
    if($getservicename){
        $servicename = $getservicename->service_name;
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
      move_uploaded_file($_FILES['allotment_rder_of_slum_replacement_board']['tmp_name'], $filepath . $lease_deed);
  }
  DB::table('smartcard')->where('id', $insertid)->update([
      'allotment_rder_of_slum_replacement_board' => $allotment_rder_of_slum_replacement_board,
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
  $first_page_of_bank_account_book = "";
  if ($request->first_page_of_bank_account_book != null) {
      $bond_leave_proof = uniqid().'.'.$request->file('first_page_of_bank_account_book')->extension();
      $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'first_page_of_bank' . DIRECTORY_SEPARATOR);
      move_uploaded_file($_FILES['first_page_of_bank_account_book']['tmp_name'], $filepath . $lease_deed);
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
$getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
    $servicename = "";
    if($getservicename){
        $servicename = $getservicename->service_name;
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


return redirect("appliedservice/Pending")->With("success","Application submitted Succesfully");

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
          'amount'                => $request->amount,
           'dist_id'               => $request->dist_id,
           'taluk_id'              => $request->taluk_id,
           'name'                  => $request->name,
           'mobile'                => $request->mobile,
           'name_tamil'            => $request->name_tamil,
           'name_english'          => $request->name_english,
           'address_tamil'         => $request->address_tamil,
           'address_english'       => $request->address_english,
           'door_no'               => $request->door_no,
           'street_name'           => $request->street_name,
           'postal_area_english'   => $request->postal_area_english,
           'pin_code'              => $request->pin_code,
           'street_name_tamil'     => $request->street_name_tamil,
           'postal_area_tamil'     => $request->postal_area_tamil,
           'relationship'          => $request->relationship,
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
}elseif($serviceid == 158 || $serviceid == 159){
    DB::table( 'aadhaarcard' )->insert( [
        'user_id'           => $user_id,
        'retailer_id'       => $retailer_id,
        'distributor_id'    => $distributor_id,
        'service_id'        => $request ->serviceid,
        'amount'            => $request->amount,
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
   if ($request->enrollment_slip != null) {
       $enrollment_slip = uniqid().'.'.$request->file('enrollment_slip')->extension();
       $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'enrollment_slip' . DIRECTORY_SEPARATOR);
       move_uploaded_file($_FILES['enrollment_slip']['tmp_name'], $filepath . $enrollment_slip);

   }
   DB::table('aadhaarcard')->where('id', $insertid)->update([
     'enrollment_slip' => $enrollment_slip,
 ]);

   if ($request->correction_proof != null) {
       $correction_proof = uniqid().'.'.$request->file('correction_proof')->extension();
       $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'correction_proof' . DIRECTORY_SEPARATOR);
       move_uploaded_file($_FILES['correction_proof']['tmp_name'], $filepath . $correction_proof);

   }
   DB::table('aadhaarcard')->where('id', $insertid)->update([
     'correction_proof' => $correction_proof,
 ]);
}elseif($serviceid == 160 || $serviceid == 161 ){
    DB::table( 'aadhaarcard' )->insert( [
        'user_id'           => $user_id,
        'retailer_id'       => $retailer_id,
        'distributor_id'    => $distributor_id,
        'service_id'        => $request ->serviceid,
        'amount'            => $request->amount,
        'enrollment_no'     => $request->enrollment_no,
        'enrollment_type'   => $request->enrollment_type,
        'status'            => 'Pending',
        'applied_date'      => date("Y-m-d"),
        'created_at'        => date("Y-m-d"),
    ] );

    $insertid = DB::getPdo()->lastInsertId();
    $enrollment_slip = "";

    if ($request->enrollment_slip != null) {
       $enrollment_slip = uniqid().'.'.$request->file('enrollment_slip')->extension();
       $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'enrollment_slip' . DIRECTORY_SEPARATOR);
       move_uploaded_file($_FILES['enrollment_slip']['tmp_name'], $filepath . $enrollment_slip);

   }
   DB::table('aadhaarcard')->where('id', $insertid)->update([
     'enrollment_slip' => $enrollment_slip,
 ]);

}elseif($serviceid == 162 ){
    DB::table( 'aadhaarcard' )->insert( [
        'user_id'           => $user_id,
        'retailer_id'       => $retailer_id,
        'distributor_id'    => $distributor_id,
        'service_id'        => $request ->serviceid,
        'amount'            => $request->amount,
        'name'              => $request->name,
        'mobile'            => $request->mobile,
        'aadhaar_no'        => $request->aadhaar_no,
        'status'            => 'Pending',
        'applied_date'      => date("Y-m-d"),
        'created_at'        => date("Y-m-d"),
    ] );

}elseif($serviceid == 163 ){
    DB::table( 'aadhaarcard' )->insert( [
        'user_id'           => $user_id,
        'retailer_id'       => $retailer_id,
        'distributor_id'    => $distributor_id,
        'service_id'        => $request ->serviceid,
        'amount'            => $request->amount,
        'name'              => $request->name,
        'aadhaar_no'        => $request->aadhaar_no,
        'status'            => 'Pending',
        'applied_date'      => date("Y-m-d"),
        'created_at'        => date("Y-m-d"),
    ] );

}


$servicepayment = $request->service_amount;
if(Auth::user()->user_type_id == 3){
  $user_id = $distributor_id;
}elseif(Auth::user()->user_type_id == 4){
  $user_id = $retailer_id;
}elseif(Auth::user()->user_type_id == 5){
  $user_id = $user_id;
}
$getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
    $servicename = "";
    if($getservicename){
        $servicename = $getservicename->service_name;
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

    $getpermission = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
$coordinator_permission = 0;
$admin_payment = 0;
if($getpermission){
    $coordinator_permission = $getpermission->coordinator_permission;
    $admin_payment = $getpermission->admin_amount;
}
if($coordinator_permission == 1){
    $getdata = DB::table( 'aadhaarcard' )->where('id',$insertid)->first();
    if($getdata){
     $aadhaar_card = $getdata->aadhaar_card;
     $photo = $getdata->photo;
     $signature = $getdata->signature;
     $service_id = $getdata->service_id;
     $rowid = $getdata->id;
     $name = $getdata->name;
     $door_no = $getdata->door_no;
     $dist_id = $getdata->dist_id;
     $taluk_id = $getdata->taluk_id;
     $street_name = $getdata->street_name;
     $postal_area_english = $getdata->postal_area_english;
     $address_english = $getdata->address_english;
     $mobile = $getdata->mobile;
     $pin_code = $getdata->pin_code;
     $street_name_tamil = $getdata->street_name_tamil;
     $postal_area_tamil = $getdata->postal_area_tamil;
     $address_tamil = $getdata->address_tamil;
     $status = $getdata->status;
     $url = url('/');
     $aadhaar_url = $url.'/upload/services/aadhaar_card/'.$aadhaar_card;
     $photo_url = $url.'/upload/services/photo/'.$photo;
     $signature_url = $url.'/upload/services/signature/'.$signature;
     $API_KEY = env( 'API_KEY', '' );
     $RAMJIPAY_URL = env( 'RAMJIPAY_URL', '' );
     $WEBSITE_INDEX = env( 'WEBSITE_INDEX', '' );
     $ch = curl_init();

     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=$service_id&rowid=$rowid&status=$status&photo=$photo_url&signature=$signature_url&name=$name&door_no=$door_no&dist_id=$dist_id&taluk_id=$taluk_id&street_name=$street_name&postal_area_english=$postal_area_english&address_english=$address_english&mobile=$mobile&pin_code=$pin_code&street_name_tamil=$street_name_tamil&postal_area_tamil=$postal_area_tamil&address_tamil=$address_tamil";

    //dd($post_data);
     $url1 = $RAMJIPAY_URL.'/api/get_aadhaarcard_api';
     curl_setopt( $ch, CURLOPT_URL, $url1 );
     curl_setopt( $ch, CURLOPT_POST, 1 );
     curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_data );
     curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
     $server_output = curl_exec( $ch );
     curl_close( $ch );
     $resdata = json_decode($server_output, true);
     //dd($resdata);
     if($resdata){
        $status = $resdata['message'];
        if($status == "Success"){
         $date = date( 'Y-m-d' );
         $time = date( 'H:i:s' );
         $service_status = 'Out Payment';
         $ad_info = 'Ramji Wallet Debit'.' '.$servicename;
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
         $newbalance2 = $balance1 + $admin_payment;
         $newbalance3 = $balance2 - $admin_payment;
         $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
         DB::insert( DB::raw( $sql ) );
         $sql = "update users set rawallet = rawallet + $admin_payment where id = 1";
         DB::update( DB::raw( $sql ) );
         $service_status = 'IN Payment';
         $ad_info = 'Ramji Wallet Credit'.' '.$servicename;

         $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
         DB::insert( DB::raw( $sql ) );
         $sql = "update users set rawallet = rawallet - $admin_payment where id = 2";
          DB::update( DB::raw( $sql ) );
   }
 }

}
}
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
  $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
    $servicename = "";
    if($getservicename){
        $servicename = $getservicename->service_name;
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

   if($serviceid == 1 || $serviceid == 121){
    DB::table( 'can_edit' )->insert( [
        'user_id'                    => $user_id,
        'retailer_id'                => $retailer_id,
        'distributor_id'             => $distributor_id,
        'service_id'                 => $request->serviceid,
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
        'select_name'                => $request->select_name,
        'name_tamil'                 => $request->name_tamil,
        'name_english'               => $request->name_english,
        'dist_id'                    => $request->dist_id,
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
        'dist_id'                    => $request->dist_id,
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
    // dd(date("Y-m-d H:i:s"));die;
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

//     if ($request->aadhaar_card != null) {
//      $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
//      $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
//      move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);

//  }
//  DB::table('can_edit')->where('id', $insertid)->update([
//     'aadhaar_card' => $aadhaar_card,
// ]);
}   elseif($serviceid == 65){
    DB::table( 'can_edit' )->insert( [
        'user_id'                    => $user_id,
        'retailer_id'                => $retailer_id,
        'distributor_id'             => $distributor_id,
        'service_id'                 => $request ->serviceid,
        'amount'                     => $request->amount,
        'can_number'                 => $request->can_number,
        'certificate_name'           => $request->certificate_name,
        'aadhaar_number'             => $request->aadhaar_number,
        'applicant_name'             => $request->applicant_name,
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
        'aadhaar_number'             => $request->aadhaar_number,
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
        'certificate_number'         => $request->certificate_number,
        'aadhaar_number'             => $request->aadhaar_number,
        'applicant_name'             => $request->applicant_name,
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
}   elseif($serviceid == 208 || $serviceid == 209 || $serviceid == 210 || $serviceid == 211 || $serviceid == 225 || $serviceid == 226 || $serviceid == 233 || $serviceid == 234){
    DB::table( 'can_edit' )->insert( [
        'user_id'                    => $user_id,
        'retailer_id'                => $retailer_id,
        'distributor_id'             => $distributor_id,
        'service_id'                 => $request ->serviceid,
        'amount'                     => $request->amount,
        'can_number'                 => $request->can_number,
        'mobile'                     => $request->mobile,
        'dob'                        => $request->dob,
        'select_name'                => $request->select_name,
        'name_tamil'                 => $request->name_tamil,
        'name_english'               => $request->name_english,
        'application_name'           => $request->application_name,
        'certificate_name'           => $request->certificate_name,
        'applicant_name'             => $request->applicant_name,
        'certificate_number'         => $request->certificate_number,
        'father_name'                => $request->father_name,
        'father_name_english'        => $request->father_name_english,
        'revenue_village'            => $request->revenue_village,
        'door_no'                    => $request->door_no,
        'street_name'                => $request->street_name,
        'postal_area_english'        => $request->postal_area_english,
        'dist_id'                    => $request->dist_id,
        'taluk_id'                   => $request->taluk_id,
        'pin_code'                   => $request->pin_code,
        'street_name_tamil'          => $request->street_name_tamil,
        'postal_area_tamil'          => $request->postal_area_tamil,
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
$getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
    $servicename = "";
    if($getservicename){
        $servicename = $getservicename->service_name;
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
    $ad_info = 'Service Payment';
    $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
    DB::insert( DB::raw( $sql ) );
    $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
    DB::update( DB::raw( $sql ) );


$getpermission = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
$coordinator_permission = 0;
$admin_payment = 0;
if($getpermission){
    $coordinator_permission = $getpermission->coordinator_permission;
    $admin_payment = $getpermission->admin_amount;
}
if($coordinator_permission == 1){
    $getdata = DB::table( 'can_edit' )->where('id',$insertid)->first();
    if($getdata){
    $aadhaar_card = $getdata->aadhaar_card;
     $service_id = $getdata->service_id;
     $rowid = $getdata->id;
     $status = $getdata->status;
     $can_number = $getdata->can_number;
     $select_name = $getdata->select_name;
     $name_tamil = $getdata->name_tamil;
     $name_english = $getdata->name_english;
     $dob1 = $getdata->original_dob;
     $mobile1 = $getdata->new_mobile_no;
     $mobile = $getdata->mobile;
     $certificate_name = $getdata->certificate_name;
     $certificate_number = $getdata->certificate_number;
     $aadhaar_number = $getdata->aadhaar_number;
     $application_name = $getdata->application_name;
     $applicant_name = $getdata->applicant_name;
     $dob = $getdata->dob;
     $select_name = $getdata->select_name;
     $revenue_village = $getdata->revenue_village;
     $door_no = $getdata->door_no;
     $street_name = $getdata->street_name;
     $postal_area_english = $getdata->postal_area_english;
     $dist_id = $getdata->dist_id;
     $taluk_id = $getdata->taluk_id;
     $pin_code = $getdata->pin_code;
     $street_name_tamil = $getdata->street_name_tamil;
     $postal_area_tamil = $getdata->postal_area_tamil;
     $father_name = $getdata->father_name;
     $father_name_english = $getdata->father_name_english;
     $url = url('/');
     $aadhaar_url = $url.'/upload/services/aadhaar_card/'.$aadhaar_card;
     $API_KEY = env( 'API_KEY', '' );
     $RAMJIPAY_URL = env( 'RAMJIPAY_URL', '' );
     $WEBSITE_INDEX = env( 'WEBSITE_INDEX', '' );
     $ch = curl_init();
     if($serviceid == 62){
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=$service_id&rowid=$rowid&status=$status&can_number=$can_number&select_name=$select_name&name_tamil=$name_tamil&name_english=$name_english&dist_id=$dist_id";
     }elseif($serviceid == 63){
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=$service_id&rowid=$rowid&status=$status&can_number=$can_number&dob=$dob1&dist_id=$dist_id";
     }elseif($serviceid == 64){
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=$service_id&rowid=$rowid&status=$status&can_number=$can_number&mobile=$mobile1";
     }elseif($serviceid == 65 || $serviceid == 67){
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=$service_id&rowid=$rowid&status=$status&can_number=$can_number&mobile=$mobile&certificate_name=$certificate_name&certificate_number=$certificate_number&aadhaar_number=$aadhaar_number&applicant_name=$applicant_name";
     }elseif($serviceid == 66){
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=$service_id&rowid=$rowid&status=$status&can_number=$can_number";
     }elseif($serviceid == 121){
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=$service_id&rowid=$rowid&status=$status&can_number=$can_number&aadhaar_number=$aadhaar_number";
     }elseif($serviceid == 208 || $serviceid == 209 || $serviceid == 210 || $serviceid == 211 ){
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=$service_id&rowid=$rowid&status=$status&can_number=$can_number&select_name=$select_name&dist_id=$dist_id&name_tamil=$name_tamil&name_english=$name_english&mobile=$mobile&dob=$dob&application_name=$application_name&certificate_name=$certificate_name";
     }elseif($serviceid == 225){
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=226&rowid=$rowid&status=$status&can_number=$can_number&certificate_number=$certificate_number&certificate_name=$certificate_name&applicant_name=$applicant_name";
     }elseif($serviceid == 226){
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=227&rowid=$rowid&status=$status&can_number=$can_number&certificate_number=$certificate_number&certificate_name=$certificate_name&applicant_name=$applicant_name";
     }elseif($serviceid == 233){
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=241&rowid=$rowid&status=$status&can_number=$can_number&dist_id=$dist_id&father_name=$father_name&father_name_english=$father_name_english";
     }elseif($serviceid == 234){
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=242&rowid=$rowid&status=$status&can_number=$can_number&dist_id=$dist_id&taluk_id=$taluk_id&revenue_village=$revenue_village&door_no=$door_no&street_name=$street_name&pin_code=$pin_code&street_name_tamil=$street_name_tamil&postal_area_tamil=$postal_area_tamil&postal_area_english=$postal_area_english";
}


    //dd($post_data);
     $url1 = $RAMJIPAY_URL.'/api/get_cannumber_api';
   //echo $url1;die;
     curl_setopt( $ch, CURLOPT_URL, $url1 );
     curl_setopt( $ch, CURLOPT_POST, 1 );
     curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_data );
     curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
     $server_output = curl_exec( $ch );
     curl_close( $ch );
     $resdata = json_decode($server_output, true);
    //dd($resdata);
     if($resdata){
        $status = $resdata['message'];
        if($status == "Success"){
         $date = date( 'Y-m-d' );
         $time = date( 'H:i:s' );
         $service_status = 'Out Payment';
         $ad_info = 'Ramji Wallet Debit'.' '.$servicename;
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
         $newbalance2 = $balance1 + $admin_payment;
         $newbalance3 = $balance2 - $admin_payment;
         $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
         DB::insert( DB::raw( $sql ) );
         $sql = "update users set rawallet = rawallet + $admin_payment where id = 1";
         DB::update( DB::raw( $sql ) );
         $service_status = 'IN Payment';
         $ad_info = 'Ramji Wallet Credit'.' '.$servicename;

         $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
         DB::insert( DB::raw( $sql ) );
         $sql = "update users set rawallet = rawallet - $admin_payment where id = 2";
          DB::update( DB::raw( $sql ) );
   }
 }

}
}
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
       $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smartcard_online' . DIRECTORY_SEPARATOR);
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
       $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smartcard_online' . DIRECTORY_SEPARATOR);
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
$getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
    $servicename = "";
    if($getservicename){
        $servicename = $getservicename->service_name;
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
    if($serviceid == 113 || $serviceid == 120 || $serviceid == 164 || $serviceid == 182 || $serviceid == 181){
        DB::table( 'voterid' )->insert( [
           'user_id'                     => $user_id,
           'retailer_id'                 => $retailer_id,
           'distributor_id'              => $distributor_id,
           'service_id'                  => $request ->serviceid,
           'amount'                      => $request->amount,
           'name'                        => $request->name,
           'mobile'                      => $request->mobile,
           'epic_no'                     => $request->epic_no,
           'relationship'                => $request->relationship,
           'dist_id'                     => $request->dist_id,
           'taluk_id'                    => $request->taluk_id,
           'panchayath_id'               => $request->panchayath_id,
           'constituent_assembly'        => $request->constituent_assembly,
           'name_in_tamil'               => $request->name_in_tamil,
           'name_in_english'             => $request->name_in_english,
           'door_no'                     => $request->door_no,
           'postal_area_tamil'           => $request->postal_area_tamil,
           'postal_area_english'         => $request->postal_area_english,
           'street_name_tamil'           => $request->street_name_tamil,
           'street_name_english'         => $request->street_name_english,
           'voterid_no'                  => $request->voterid_no,
           'pin_code'                    => $request->pin_code,
           'select_relationship'         => $request->select_relationship,
           'father_name_tamil'           => $request->father_name_tamil,
           'father_name_english'         => $request->father_name_english,
           'husband_name_tamil'          => $request->husband_name_tamil,
           'husband_name_english'        => $request->husband_name_english,
           'within_assembly'             => $request->within_assembly,
           'street_name'                 => $request->street_name,
           'post_office'                 => $request->post_office,
           'apartment_no'                => $request->apartment_no,
           'taluqa_mandal'               => $request->taluqa_mandal,
           'town_village'                => $request->town_village,
           'name_assembly_constituency'  => $request->name_assembly_constituency,
           'disability'                  => $request->disability,
           'locomotive_percentage'       => $request->locomotive_percentage,
           'visual_percentage'           => $request->visual_percentage,
           'dumb_percentage'             => $request->dumb_percentage,
           'other_percentage'            => $request->dumb_percentage,
           'description'                 => $request->description,
           'correction'                  => is_array($request->correction)
                                      ? implode(',', $request->correction)
                                      : $request->correction,
           'gender'                      => $request->gender,
           'dob'                         => $request->dob,
           'relation'                    => $request->relation,
           'name_tamil'                  => $request->name_tamil,
           'name_english'                => $request->name_english,
           'status'                      => 'Pending',
           'applied_date'                => date("Y-m-d"),
           'created_at'                  => date("Y-m-d"),
        ] );

    $insertid = DB::getPdo()->lastInsertId();
    $aadhaarimg = "";
    $photo = "";
    $voter_id = "";
    $locomotive_certificate = "";
    $visual_certificate = "";
    $dumb_certificate = "";
    $other_certificate = "";
    $age_proof = "";
    $document = "";

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
if ($request->locomotive_certificate != null) {
    $locomotive_certificate = uniqid().'.'.$request->file('locomotive_certificate')->extension();
    $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'locomotive_certificate' . DIRECTORY_SEPARATOR);
    move_uploaded_file($_FILES['locomotive_certificate']['tmp_name'], $filepath . $locomotive_certificate);

}
DB::table('voterid')->where('id', $insertid)->update([
  'locomotive_certificate' => $locomotive_certificate,
]);
if ($request->visual_certificate != null) {
    $visual_certificate = uniqid().'.'.$request->file('visual_certificate')->extension();
    $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'visual_certificate' . DIRECTORY_SEPARATOR);
    move_uploaded_file($_FILES['visual_certificate']['tmp_name'], $filepath . $visual_certificate);

}
DB::table('voterid')->where('id', $insertid)->update([
  'visual_certificate' => $visual_certificate,
]);
if ($request->dumb_certificate != null) {
    $dumb_certificate = uniqid().'.'.$request->file('dumb_certificate')->extension();
    $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'dumb_certificate' . DIRECTORY_SEPARATOR);
    move_uploaded_file($_FILES['dumb_certificate']['tmp_name'], $filepath . $dumb_certificate);

}
DB::table('voterid')->where('id', $insertid)->update([
  'dumb_certificate' => $dumb_certificate,
]);
if ($request->other_certificate != null) {
    $other_certificate = uniqid().'.'.$request->file('other_certificate')->extension();
    $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'other_certificate' . DIRECTORY_SEPARATOR);
    move_uploaded_file($_FILES['other_certificate']['tmp_name'], $filepath . $other_certificate);

}
DB::table('voterid')->where('id', $insertid)->update([
  'other_certificate' => $other_certificate,
]);
if ($request->age_proof != null) {
    $age_proof = uniqid().'.'.$request->file('age_proof')->extension();
    $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'age_proof' . DIRECTORY_SEPARATOR);
    move_uploaded_file($_FILES['age_proof']['tmp_name'], $filepath . $age_proof);

}
DB::table('voterid')->where('id', $insertid)->update([
  'age_proof' => $age_proof,
]);
if ($request->document != null) {
    $document = uniqid().'.'.$request->file('document')->extension();
    $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'document' . DIRECTORY_SEPARATOR);
    move_uploaded_file($_FILES['document']['tmp_name'], $filepath . $document);

}
DB::table('voterid')->where('id', $insertid)->update([
  'document' => $document,
]);

    if($request->has('voterid_correction')){
        foreach ( $request->voterid_correction as $key => $voterid_correction ) {
          $new_data = $request->new_data[ $key ];
          $correction_documents = $request->correction_documents[ $key ];

          $sql = "insert into voterid_details (service_id,new_data,correction_documents,voterid_correction) values ($insertid,'$new_data','$correction_documents','$voterid_correction')";
          DB::insert( $sql );
          $relation_id = DB::getPdo()->lastInsertId();
          if ($request->doc[$key] != null) {
              $doc = uniqid().'.'.$request->file('doc')[$key]->extension();
            //dd($request->doc[$key]);
              $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'doc' . DIRECTORY_SEPARATOR);
              move_uploaded_file($_FILES['doc']['tmp_name'][$key], $filepath . $doc);
              DB::table( 'voterid_details' )->where( 'id', $relation_id )->update( [
                'doc'       => $doc,
            ] );
          }

      }
  }

}

$servicepayment = $request->service_amount;
if(Auth::user()->user_type_id == 3){
  $user_id = $distributor_id;
}elseif(Auth::user()->user_type_id == 4){
  $user_id = $retailer_id;
}elseif(Auth::user()->user_type_id == 5){
  $user_id = $user_id;
}
$getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
    $servicename = "";
    if($getservicename){
        $servicename = $getservicename->service_name;
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
           'food_service'      => $request->food_service,
           'shop_name'         => $request->shop_name,
           'mobile'            => $request->mobile,
           'mobile_no'         => $request->mobile_no,
           'email_id'          => $request->email_id,
           'documents'         => $request->documents,
           'status'            => 'Pending',
           'applied_date'      => date("Y-m-d"),
           'created_at'        => date("Y-m-d"),
       ] );

        $insertid = DB::getPdo()->lastInsertId();
        $aadhaarimg = "";
        $photo = "";
        $shop_photo = "";
        $pan_card = "";
        $old_food_license = "";
        $rental_agreement ="";
        $electricity_bill ="";
        $property_tax ="";

        if ($request->rental_agreement != null) {
            $rental_agreement = uniqid().'.'.$request->file('rental_agreement')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'rental_agreement' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['rental_agreement']['tmp_name'], $filepath . $rental_agreement);

        }
        DB::table('fssai')->where('id', $insertid)->update([
          'rental_agreement' => $rental_agreement,
        ]);

        if ($request->electricity_bill != null) {
            $electricity_bill = uniqid().'.'.$request->file('electricity_bill')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'electricity_bill' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['electricity_bill']['tmp_name'], $filepath . $electricity_bill);

        }
        DB::table('fssai')->where('id', $insertid)->update([
          'electricity_bill' => $electricity_bill,
        ]);

        if ($request->property_tax != null) {
            $property_tax = uniqid().'.'.$request->file('property_tax')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'property_tax' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['property_tax']['tmp_name'], $filepath . $property_tax);

        }
        DB::table('fssai')->where('id', $insertid)->update([
          'property_tax' => $property_tax,
        ]);

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
        if ($request->shop_photo != null) {
           $shop_photo = uniqid().'.'.$request->file('shop_photo')->extension();
           $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'shop_photo' . DIRECTORY_SEPARATOR);
           move_uploaded_file($_FILES['shop_photo']['tmp_name'], $filepath . $shop_photo);

        }
        DB::table('fssai')->where('id', $insertid)->update([
           'shop_photo' => $shop_photo,
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
$getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
    $servicename = "";
    if($getservicename){
        $servicename = $getservicename->service_name;
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

$getpermission = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
$coordinator_permission = 0;
$admin_payment = 0;
if($getpermission){
    $coordinator_permission = $getpermission->coordinator_permission;
    $admin_payment = $getpermission->admin_amount;
}
if($coordinator_permission == 1){
    $getdata = DB::table( 'fssai' )->where('id',$insertid)->first();
    if($getdata){
     $aadhaar_card = $getdata->aadhaar_card;
     $photo = $getdata->photo;
     $shop_photo = $getdata->shop_photo;
     $pan_card = $getdata->pan_card;
     $rental_agreement = $getdata->rental_agreement;
     $electricity_bill = $getdata->electricity_bill;
     $property_tax = $getdata->property_tax;
     $old_food_license = $getdata->old_food_license;
     $service_id = $getdata->service_id;
     $rowid = $getdata->id;
     $food_service = $getdata->food_service;
     $shop_name = $getdata->shop_name;
     $email_id = $getdata->email_id;
     $mobile = $getdata->mobile;
     $mobile_no = $getdata->mobile_no;
     $documents = $getdata->documents;
     $status = $getdata->status;
     $url = url('/');
     $aadhaar_url = $url.'/upload/services/aadhaar_card/'.$aadhaar_card;
     $photo_url = $url.'/upload/services/photo/'.$photo;
     $shopphoto_url = $url.'/upload/services/shop_photo/'.$shop_photo;
     $pancard_url = $url.'/upload/services/pan_card/'.$pan_card;
     $rentalagreement_url = $url.'/upload/services/rental_agreement/'.$rental_agreement;
     $electricitybill_url = $url.'/upload/services/electricity_bill/'.$electricity_bill;
     $propertytax_url = $url.'/upload/services/property_tax/'.$property_tax;
     $oldfoodlicense_url = $url.'/upload/services/old_food_license/'.$old_food_license;
     $API_KEY = env( 'API_KEY', '' );
     $RAMJIPAY_URL = env( 'RAMJIPAY_URL', '' );
     $WEBSITE_INDEX = env( 'WEBSITE_INDEX', '' );
     $ch = curl_init();

     if($serviceid == 122){
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&photo_file=$photo_url&photo_file=$photo_url&aadhaar_file=$aadhaar_url&shop_photo_file=$shopphoto_url&pan_card_file=$pancard_url&rental_agreement_file=$rentalagreement_url&electricity_bill_file=$electricitybill_url&property_tax_file=$propertytax_url&service_id=$service_id&rowid=$rowid&status=$status&food_service=$food_service&shop_name=$shop_name&email_id=$email_id&mobile=$mobile&mobile_no=$mobile_no&documents=$documents";
     }elseif($serviceid == 123){
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&old_food_license_file=$oldfoodlicense_url&photo_file=$photo_url&aadhaar_file=$aadhaar_url&shop_photo_file=$shopphoto_url&pan_card_file=$pancard_url&service_id=$service_id&rowid=$rowid&status=$status&shop_name=$shop_name&email_id=$email_id&mobile=$mobile";
}

    //dd($post_data);
     $url1 = $RAMJIPAY_URL.'/api/get_fssai_api';
  //echo $url1;die;
     curl_setopt( $ch, CURLOPT_URL, $url1 );
     curl_setopt( $ch, CURLOPT_POST, 1 );
     curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_data );
     curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
     $server_output = curl_exec( $ch );
     curl_close( $ch );
     $resdata = json_decode($server_output, true);
     //dd($resdata);
     if($resdata){
        $status = $resdata['message'];
        if($status == "Success"){
         $date = date( 'Y-m-d' );
         $time = date( 'H:i:s' );
         $service_status = 'Out Payment';
         $ad_info = 'Ramji Wallet Debit'.' '.$servicename;
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
         $newbalance2 = $balance1 + $admin_payment;
         $newbalance3 = $balance2 - $admin_payment;
         $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
         DB::insert( DB::raw( $sql ) );
         $sql = "update users set rawallet = rawallet + $admin_payment where id = 1";
         DB::update( DB::raw( $sql ) );
         $service_status = 'IN Payment';
         $ad_info = 'Ramji Wallet Credit'.' '.$servicename;

         $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
         DB::insert( DB::raw( $sql ) );
         $sql = "update users set rawallet = rawallet - $admin_payment where id = 2";
          DB::update( DB::raw( $sql ) );
   }
 }

}
}
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
    $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
    $servicename = "";
    if($getservicename){
        $servicename = $getservicename->service_name;
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

    return redirect("appliedservice/Pending")->With("success","Application submitted Succesfully");

}
public function submitapply_nalavariyam(Request $request){

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
    DB::table( 'nalavariyam' )->insert( [
     'user_id'         => $user_id,
     'retailer_id'     => $retailer_id,
     'distributor_id'  => $distributor_id,
     'service_id'      => $request ->serviceid,
     'amount'          => $request->amount,
     'register_no'     => $request->register_no,
     'mobile'          => $request->mobile,
     'aadhaar_no'      => $request->aadhaar_no,
     'dob'             => $request->dob,
     'status'          => 'Pending',
     'applied_date'    => date("Y-m-d"),
     'created_at'      => date("Y-m-d"),
 ] );
    $insertid = DB::getPdo()->lastInsertId();
    $photo = "";
    $signature = "";
    if ($request->photo != null) {
        $photo = uniqid().'.'.$request->file('photo')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);

    }
    DB::table('nalavariyam')->where('id', $insertid)->update([
      'photo' => $photo,
  ]);
    if ($request->signature != null) {
        $signature = uniqid().'.'.$request->file('signature')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'signature' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['signature']['tmp_name'], $filepath . $signature);

    }
    DB::table('nalavariyam')->where('id', $insertid)->update([
      'signature' => $signature,
  ]);

    $servicepayment = $request->service_amount;
    if(Auth::user()->user_type_id == 3){
        $user_id = $distributor_id;
    }elseif(Auth::user()->user_type_id == 4){
        $user_id = $retailer_id;
    }elseif(Auth::user()->user_type_id == 5){
        $user_id = $user_id;
    }
    $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
    $servicename = "";
    if($getservicename){
        $servicename = $getservicename->service_name;
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

    return redirect("appliedservice/Pending")->With("success","Application submitted Succesfully");

}
public function submitapply_driving_license(Request $request){

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
    if($serviceid == 150 || $serviceid == 148){

        DB::table( 'license' )->insert( [
         'user_id'         => $user_id,
         'retailer_id'     => $retailer_id,
         'distributor_id'  => $distributor_id,
         'service_id'      => $request ->serviceid,
         'amount'          => $request->amount,
         'id_proof'          => $request->id_proof,
         'rc_number'       => $request->rc_number,
         'driving_license_no'=> $request->driving_license_no,
         'dob'             => $request->dob,
         'status'          => 'Pending',
         'applied_date'    => date("Y-m-d"),
         'created_at'      => date("Y-m-d"),
     ] );
        $insertid = DB::getPdo()->lastInsertId();
        $aadhaar_card = "";
        $driving_license = "";
        if ($request->aadhaar_card != null) {
            $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);

        }
        DB::table('license')->where('id', $insertid)->update([
          'aadhaar_card' => $aadhaar_card,
      ]);
        if ($request->driving_license != null) {
            $driving_license = uniqid().'.'.$request->file('driving_license')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'driving_license' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['driving_license']['tmp_name'], $filepath . $driving_license);

        }
        DB::table('license')->where('id', $insertid)->update([
          'driving_license' => $driving_license,
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
    $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
    $servicename = "";
    if($getservicename){
        $servicename = $getservicename->service_name;
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


    return redirect("appliedservice/Pending")->With("success","Application submitted Succesfully");

}
// public function submitapply_pancard(Request $request){

//     $user_id = 0;
//     $retailer_id = 0;
//     $distributor_id = 0;
//     if(Auth::user()->user_type_id == 3){
//         $user_id = $request ->user_id;
//         $distributor_id = Auth::user()->id;
//     }elseif(Auth::user()->user_type_id == 4){
//         $user_id = $request ->user_id;
//         $retailer_id = Auth::user()->id;
//     } elseif(Auth::user()->user_type_id == 5){
//         $user_id = Auth::user()->id;
//     }

//     $serviceid = $request ->serviceid;
//     $status = "";
//     if($serviceid == 69){
//         $mobile = $request->mobile;
//         $mode = $request->mode;
//         $orderid = rand(000000,999999);
//         $panurl =  "https://connect.inspay.in/v4/nsdl/new_pan?username=IP7598984380&token=836a596851ed939b19a4b71157c47e1d&number=$mobile&mode=$mode&orderid=$orderid";
//         // echo $panurl;die;
//         $crl = curl_init();
//         curl_setopt( $crl, CURLOPT_URL, $panurl );
//         curl_setopt( $crl, CURLOPT_FRESH_CONNECT, true );
//         curl_setopt( $crl, CURLOPT_RETURNTRANSFER, true );
//         $result = curl_exec($crl);
//         $result = json_decode($result);
//         //echo "<pre>"; print_r($result);echo "</pre>";die;
//         $status = $result->status;
//         $url = "";
//         $message = "";
//         if($status == "Success"){
//             $url = $result->url;
//             $orderid = $result->orderid;
//             $message = $result->message;
//         }else{
//             $orderid = $result->orderid;
//             $message = $result->message;
//         }
//         curl_close($crl);
//     }else if($serviceid == 70){
//         $mobile = $request->mobile;
//         $mode = $request->mode;
//         $orderid = rand(000000,999999);
//         $panurl =  "https://connect.inspay.in/v4/nsdl/correction?username=IP7598984380&token=836a596851ed939b19a4b71157c47e1d&number=$mobile&mode=$mode&orderid=$orderid";
//         $crl = curl_init();
//         curl_setopt( $crl, CURLOPT_URL, $panurl );
//         curl_setopt( $crl, CURLOPT_FRESH_CONNECT, true );
//         curl_setopt( $crl, CURLOPT_RETURNTRANSFER, true );
//         $result = curl_exec($crl);
//         $result = json_decode($result);
//         //echo "<pre>"; print_r($result);echo "</pre>";die;
//         $status = $result->status;
//         $url = "";
//         $message = "";
//         if($status == "Success"){
//             $url = $result->url;
//             $orderid = $result->orderid;
//             $message = $result->message;
//         }else{
//             $orderid = $result->orderid;
//             $message = $result->message;
//         }
//         curl_close($crl);

//     }
//     //dd($result);

//     if($serviceid == 69 || $serviceid == 70){
//         DB::table( 'pancard' )->insert( [

//            'user_id'      => $user_id,
//            'retailer_id'  => $retailer_id,
//            'distributor_id'=> $distributor_id,
//            'service_id'   => $request ->serviceid,
//            'amount'       => $request->amount,
//            'name'         => $request->name,
//            'last_name'    => $request->last_name,
//            'email'        => $request->email,
//            'title'        => $request->title,
//            'mode'         => $request->mode,
//            'gender'       => $request->gender,
//            'aadhaar_no'   => $request->aadhaar_no,
//            'mobile'       => $request->mobile,
//            'status'       => 'Pending',
//            'applied_date' => date("Y-m-d"),
//            'created_at'   => date("Y-m-d"),
//        ] );

//         $insertid = DB::getPdo()->lastInsertId();
//         $pan_card = "";
//         $photo = "";
//         $aadhaar_card = "";
//         $signature = "";

//         DB::table('pancard')->where('id', $insertid)->update([
//             'api_url' => $url,
//             'api_status' => $status,
//             'api_txid' => $orderid,
//         ]);

//     }

//     if($status == "Success"){
//         $servicepayment = $request->service_amount;
//         if(Auth::user()->user_type_id == 3){
//             $user_id = $distributor_id;
//         }elseif(Auth::user()->user_type_id == 4){
//             $user_id = $retailer_id;
//         }elseif(Auth::user()->user_type_id == 5){
//             $user_id = $user_id;
//         }
//         $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
//     $servicename = "";
//     if($getservicename){
//         $servicename = $getservicename->service_name;
//     }
//     $date = date( 'Y-m-d' );
//     $time = date( 'H:i:s' );
//     $service_status = 'Out Payment';
//     $ad_info = 'Service Payment'. ' '. $servicename;
//     $getwallet = DB::table( 'users' )->select('wallet')->where('id',2)->first();
//     $balance = 0;
//     if($getwallet){
//         $balance = $getwallet->wallet;
//     }
//     $newbalance = $balance + $servicepayment;
//     $newbalance1 = Auth::user()->wallet - $servicepayment;

//     $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
//     DB::insert( DB::raw( $sql ) );
//     $sql = "update users set wallet = wallet + $servicepayment where id = 2";
//     DB::update( DB::raw( $sql ) );
//     $service_status = 'IN Payment';
//     $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
//     DB::insert( DB::raw( $sql ) );
//     $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
//     DB::update( DB::raw( $sql ) );



//         $ramjidebit_amount = $request->ramjidebit_amount;
//         $service_status = 'Out Payment';
//         $ad_info = 'Ramji Wallet Debit(PanCard)';
//         $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('2','2','1','$ramjidebit_amount','$ad_info', '$service_status','$time','$date','2')";
//         DB::insert( DB::raw( $sql ) );
//         $sql = "update users set rawallet = rawallet + $ramjidebit_amount where id = 1";
//         DB::update( DB::raw( $sql ) );
//         $service_status = 'IN Payment';
//         $ad_info = 'Ramji Wallet Credit(PanCard)';
//         $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('2','1','2','$ramjidebit_amount','$ad_info', '$service_status','$time','$date','2')";
//         DB::insert( DB::raw( $sql ) );
//         $sql = "update users set rawallet = rawallet - $ramjidebit_amount where id = 2";
//         DB::update( DB::raw( $sql ) );
//     }

//     if($serviceid == 71){
//         $aadhaar_no = $request->aadhaar_no;
//         $orderid = rand(000000,999999);
//         $panurl =  "https://goodapi.in/serviceApi/V1/panFind?apiKey=3e2a83212d3e5e4755390b84612f110d45d393c8c75946786de9ea4f283dcaa9&order_id=$orderid&uidNumber=$aadhaar_no";
//         $crl = curl_init();
//         curl_setopt( $crl, CURLOPT_URL, $panurl );
//         curl_setopt( $crl, CURLOPT_FRESH_CONNECT, true );
//         curl_setopt( $crl, CURLOPT_RETURNTRANSFER, true );
//         $result = curl_exec($crl);
//         $result = json_decode($result,true);
//         $statuscode = $result['StatusCode'];
//         $pan_no = "";
//         $name = "";
//         $dob = "";
//         $message = "";
//         if($statuscode == "100"){
//             $pan_no = $result['pan_no'];
//             $name = $result['name'];
//             $dob = $result['dob'];

//             DB::table( 'pancard' )->insert( [

//                'user_id'      => $user_id,
//                'retailer_id'  => $retailer_id,
//                'distributor_id'=> $distributor_id,
//                'service_id'   => $request->serviceid,
//                'amount'       => $request->amount,
//                'name'         => $name,
//                'aadhaar_no'   => $request->aadhaar_no,
//                'pan_no'       => $pan_no,
//                'dob'          => $dob,
//                'status'       => 'Approved',
//                'applied_date' => date("Y-m-d"),
//                'created_at'   => date("Y-m-d"),
//                'completed_date'   => date("Y-m-d"),
//            ] );

//             $insertid = DB::getPdo()->lastInsertId();

//             $servicepayment = $request->service_amount;
//             if(Auth::user()->user_type_id == 3){
//                 $user_id = $distributor_id;
//             }elseif(Auth::user()->user_type_id == 4){
//                 $user_id = $retailer_id;
//             }elseif(Auth::user()->user_type_id == 5){
//                 $user_id = $user_id;
//             }
//             $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
//     $servicename = "";
//     if($getservicename){
//         $servicename = $getservicename->service_name;
//     }
//     $date = date( 'Y-m-d' );
//     $time = date( 'H:i:s' );
//     $service_status = 'Out Payment';
//     $ad_info = 'Service Payment'. ' '. $servicename;
//     $getwallet = DB::table( 'users' )->select('wallet')->where('id',2)->first();
//     $balance = 0;
//     if($getwallet){
//         $balance = $getwallet->wallet;
//     }
//     $newbalance = $balance + $servicepayment;
//     $newbalance1 = Auth::user()->wallet - $servicepayment;

//     $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
//     DB::insert( DB::raw( $sql ) );
//     $sql = "update users set wallet = wallet + $servicepayment where id = 2";
//     DB::update( DB::raw( $sql ) );
//     $service_status = 'IN Payment';
//     $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
//     DB::insert( DB::raw( $sql ) );
//     $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
//     DB::update( DB::raw( $sql ) );

//              $ramjidebit_amount = $request->ramjidebit_amount;
//         $service_status = 'Out Payment';
//         $ad_info = 'Ramji Wallet Debit(PanCard)';
//         $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('2','2','1','$ramjidebit_amount','$ad_info', '$service_status','$time','$date','2')";
//         DB::insert( DB::raw( $sql ) );
//         $sql = "update users set rawallet = rawallet + $ramjidebit_amount where id = 1";
//         DB::update( DB::raw( $sql ) );
//         $service_status = 'IN Payment';
//         $ad_info = 'Ramji Wallet Credit(PanCard)';
//         $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('2','1','2','$ramjidebit_amount','$ad_info', '$service_status','$time','$date','2')";
//         DB::insert( DB::raw( $sql ) );
//         $sql = "update users set rawallet = rawallet - $ramjidebit_amount where id = 2";
//         DB::update( DB::raw( $sql ) );


//             return redirect('servicestatus/Approved/'.$insertid.'/'.$serviceid)->With("success","Pan Number Find Successful...");
//         }else{
//             $message = $result['message'];
//             return redirect('applyservices/'.$serviceid)->With("error",$message);
//         }

//     }
//     if($status == "Success"){
//         return redirect($url);
//     }else{
//      return redirect('applyservices/'.$serviceid)->With("error",$message);
//  }

// }

public function pancard_reapply($txid){

    $panurl =  "https://connect.inspay.in/v4/nsdl/incomplete?username=IP7598984380&token=836a596851ed939b19a4b71157c47e1d&orderid=$txid";
    $crl = curl_init();
    curl_setopt( $crl, CURLOPT_URL, $panurl );
    curl_setopt( $crl, CURLOPT_FRESH_CONNECT, true );
    curl_setopt( $crl, CURLOPT_RETURNTRANSFER, true );
    $result = curl_exec($crl);
    $result = json_decode($result);
        //echo "<pre>"; print_r($result);echo "</pre>";die;
    $status = $result->status;
    $url = "";
    $message = "";
    if($status == "Success"){
        $url = $result->url;
        $orderid = $result->txid;
        $message = $result->message;
    }else{
        $orderid = $result->orderid;
        $message = $result->message;
    }
    curl_close($crl);
    if($status == "Success"){
        return redirect($url);
    }else{
     return redirect('appliedservice/Pending')->With("error",$message);
 }
}

public function submitapply_tailorshop(Request $request){

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
    if($serviceid == 152 || $serviceid == 153 || $serviceid == 154){
        DB::table( 'tailor' )->insert( [
           'user_id'             => $user_id,
           'retailer_id'         => $retailer_id,
           'distributor_id'      => $distributor_id,
           'service_id'          => $request ->serviceid,
           'amount'              => $request->amount,
           'dist_id'             => $request->dist_id,
           'taluk_id'            => $request->taluk_id,
           'panchayath_id'       => $request->panchayath_id,
           'name'                => $request->name,
           'aadhaar_no'          => $request->aadhaar_no,
           'door_no'             => $request->door_no,
           'significant'         => $request->significant,
           'street_name'         => $request->street_name,
           'course_name'         => $request->course_name,
           'father_or_hus_name'  => $request->father_or_hus_name,
           'postal_area'         => $request->postal_area,
           'pincode'             => $request->pincode,
           'status'              => 'Pending',
           'applied_date'        => date("Y-m-d"),
           'created_at'          => date("Y-m-d"),
       ] );

        $insertid = DB::getPdo()->lastInsertId();
        $pan_card = "";
        $photo = "";
        $aadhaar_card = "";
        $signature = "";


        if ($request->photo != null) {
            $photo = uniqid().'.'.$request->file('photo')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);

        }
        DB::table('tailor')->where('id', $insertid)->update([
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
    $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
    $servicename = "";
    if($getservicename){
        $servicename = $getservicename->service_name;
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

$getpermission = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
$coordinator_permission = 0;
$admin_payment = 0;
if($getpermission){
    $coordinator_permission = $getpermission->coordinator_permission;
    $admin_payment = $getpermission->admin_amount;
}
if($coordinator_permission == 1){
    $getdata = DB::table( 'tailor' )->where('id',$insertid)->first();
    if($getdata){

     $service_id = $getdata->service_id;
     $rowid = $getdata->id;
     $status = $getdata->status;
     $name = $getdata->name;
     $dist_id = $getdata->dist_id;
     $taluk_id = $getdata->taluk_id;
     $panchayath_id = $getdata->panchayath_id;
     $aadhaar_no = $getdata->aadhaar_no;
     $door_no = $getdata->door_no;
     $significant = $getdata->significant;
     $street_name = $getdata->street_name;
     $postal_area = $getdata->postal_area;
     $course_name = $getdata->course_name;
     $course_name = str_replace('&', "-", $course_name);
     //echo $course_name;die;
     $father_or_hus_name = $getdata->father_or_hus_name;
     $pincode = $getdata->pincode;
     $url = url('/');
     $photo_url = $url.'/upload/services/photo/'.$photo;
     $API_KEY = env( 'API_KEY', '' );
     $RAMJIPAY_URL = env( 'RAMJIPAY_URL', '' );
     $WEBSITE_INDEX = env( 'WEBSITE_INDEX', '' );
     $ch = curl_init();
     if($serviceid == 152){
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&photo_file=$photo_url&service_id=$service_id&rowid=$rowid&status=$status&name=$name&dist_id=$dist_id&taluk_id=$taluk_id&panchayath_id=$panchayath_id&aadhaar_no=$aadhaar_no&door_no=$door_no&significant=$significant&postal_area=$postal_area&street_name=$street_name&course_name=$course_name&father_or_hus_name=$father_or_hus_name&pincode=$pincode";
     }elseif($serviceid == 153){
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&photo_file=$photo_url&service_id=$service_id&rowid=$rowid&status=$status&name=$name&dist_id=$dist_id&taluk_id=$taluk_id&panchayath_id=$panchayath_id&aadhaar_no=$aadhaar_no&door_no=$door_no&significant=$significant&street_name=$street_name&postal_area=$postal_area&course_name=$course_name&father_or_hus_name=$father_or_hus_name&pincode=$pincode";
     }elseif($serviceid == 154){
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&photo_file=$photo_url&service_id=$service_id&rowid=$rowid&status=$status&name=$name&dist_id=$dist_id&taluk_id=$taluk_id&panchayath_id=$panchayath_id&aadhaar_no=$aadhaar_no&door_no=$door_no&significant=$significant&street_name=$street_name&postal_area=$postal_area&course_name=$course_name&father_or_hus_name=$father_or_hus_name&pincode=$pincode";
}

    //dd($post_data);
     $url1 = $RAMJIPAY_URL.'/api/get_tailor_api';
  // echo $url1;die;
     curl_setopt( $ch, CURLOPT_URL, $url1 );
     curl_setopt( $ch, CURLOPT_POST, 1 );
     curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_data );
     curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
     $server_output = curl_exec( $ch );
     curl_close( $ch );
     $resdata = json_decode($server_output, true);
        // dd($resdata);
     if($resdata){
        $status = $resdata['message'];
        if($status == "Success"){
         $date = date( 'Y-m-d' );
         $time = date( 'H:i:s' );
         $service_status = 'Out Payment';
         $ad_info = 'Ramji Wallet Debit'.' '.$servicename;
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
         $newbalance2 = $balance1 + $admin_payment;
         $newbalance3 = $balance2 - $admin_payment;
         $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
         DB::insert( DB::raw( $sql ) );
         $sql = "update users set nalavariyamwallet = nalavariyamwallet + $admin_payment where id = 1";
         DB::update( DB::raw( $sql ) );
         $service_status = 'IN Payment';
         $ad_info = 'Ramji Wallet Credit'.' '.$servicename;

         $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
         DB::insert( DB::raw( $sql ) );
         $sql = "update users set nalavariyamwallet = nalavariyamwallet - $admin_payment where id = 2";
         DB::update( DB::raw( $sql ) );
   }
 }

}
}

    return redirect("appliedservice/Pending")->With("success","Application submitted Succesfully");

}

public function savepmkissan(Request $request){

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
    DB::table( 'pmkissan' )->insert( [
        'user_id'        =>   $user_id,
        'retailer_id'    =>   $retailer_id,
        'distributor_id' =>   $distributor_id,
        'service_id'     => $request ->serviceid,
        'status'              => 'Pending',
        'applied_date'        => date("Y-m-d"),
        'created_at'          => date("Y-m-d"),
    ] );

    $insertid = DB::getPdo()->lastInsertId();

    $aadhaar_card = "";
    if ($request->aadhaar_card != null) {
        $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
    }
    DB::table('pmkissan')->where('id', $insertid)->update([
        'aadhaar_card'         => $aadhaar_card,
    ]);
    $land_document = "";
    if ($request->land_document != null) {
        $land_document = uniqid().'.'.$request->file('land_document')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'landdocument' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['land_document']['tmp_name'], $filepath . $land_document);
    }
    DB::table('pmkissan')->where('id', $insertid)->update([
        'land_document'         => $land_document,
    ]);

    $servicepayment = $request->service_amount;
    if(Auth::user()->user_type_id == 3){
        $user_id = $distributor_id;
    }elseif(Auth::user()->user_type_id == 4){
        $user_id = $retailer_id;
    }elseif(Auth::user()->user_type_id == 5){
        $user_id = $user_id;
    }
    $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
    $servicename = "";
    if($getservicename){
        $servicename = $getservicename->service_name;
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

    return redirect("appliedservice/Pending")->With("success","Application submitted Succesfully");

}
public function submitapply_csc_tec(Request $request){

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
        'user_id'             =>   $user_id,
        'retailer_id'         =>   $retailer_id,
        'distributor_id'      =>   $distributor_id,
        'service_id'          => $request ->serviceid,
        'amount'              => $request->amount,
        'dist_id'             => $request->dist_id,
        'taluk_id'            => $request->taluk_id,
        'panchayath_id'       => $request->panchayath_id,
        'name'                => $request->name,
        'mobile'              => $request->mobile,
        'shop_name'           => $request->shop_name,
        'shop_address'        => $request->shop_address,
        'door_no'             => $request->door_no,
        'street_name'         => $request->street_name,
        'postal_name'         => $request->postal_name,
        'village_name'        => $request->village_name,
        'pincode'             => $request->pincode,
        'status'              => 'Pending',
        'applied_date'        => date("Y-m-d"),
        'created_at'          => date("Y-m-d"),
    ] );

    $insertid = DB::getPdo()->lastInsertId();

    $aadhaar_card = "";
    if ($request->aadhaar_card != null) {
        $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
    }
    DB::table('tec_exam')->where('id', $insertid)->update([
        'aadhaar_card'         => $aadhaar_card,
    ]);
    $pan_card = "";
    if ($request->pan_card != null) {
        $pan_card = uniqid().'.'.$request->file('pan_card')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'pan_card' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['pan_card']['tmp_name'], $filepath . $pan_card);
    }
    DB::table('tec_exam')->where('id', $insertid)->update([
        'pan_card'         => $pan_card,
    ]);
    $bc_agent_certificate = "";
    if ($request->bc_agent_certificate != null) {
        $bc_agent_certificate = uniqid().'.'.$request->file('bc_agent_certificate')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'bc_agent_certificate' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['bc_agent_certificate']['tmp_name'], $filepath . $bc_agent_certificate);
    }
    DB::table('tec_exam')->where('id', $insertid)->update([
        'bc_agent_certificate'         => $bc_agent_certificate,
    ]);
    $voterid = "";
    if ($request->voterid != null) {
        $voterid = uniqid().'.'.$request->file('voterid')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'voterid' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['voterid']['tmp_name'], $filepath . $voterid);
    }
    DB::table('tec_exam')->where('id', $insertid)->update([
        'voterid'         => $voterid,
    ]);
    $bank_passbook = "";
    if ($request->bank_passbook != null) {
        $bank_passbook = uniqid().'.'.$request->file('bank_passbook')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'bank_passbook' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['bank_passbook']['tmp_name'], $filepath . $bank_passbook);
    }
    DB::table('tec_exam')->where('id', $insertid)->update([
        'bank_passbook'         => $bank_passbook,
    ]);
    $tec_certificate = "";
    if ($request->tec_certificate != null) {
        $tec_certificate = uniqid().'.'.$request->file('tec_certificate')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'tec_certificate' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['tec_certificate']['tmp_name'], $filepath . $tec_certificate);
    }
    DB::table('tec_exam')->where('id', $insertid)->update([
        'tec_certificate'         => $tec_certificate,
    ]);

    $servicepayment = $request->service_amount;
    if(Auth::user()->user_type_id == 3){
        $user_id = $distributor_id;
    }elseif(Auth::user()->user_type_id == 4){
        $user_id = $retailer_id;
    }elseif(Auth::user()->user_type_id == 5){
        $user_id = $user_id;
    }
    $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
    $servicename = "";
    if($getservicename){
        $servicename = $getservicename->service_name;
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

    return redirect("appliedservice/Pending")->With("success","Application submitted Succesfully");

}

public function submitapply_medicalscheme(Request $request){

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
   if($serviceid == 179){
        DB::table( 'medicalscheme' )->insert( [
         'user_id'      => $user_id,
         'retailer_id'  => $retailer_id,
         'distributor_id' => $distributor_id,
         'service_id'   => $request ->serviceid,
         'amount'       => $request->amount,
         'family_head_name'=> $request->family_head_name,
         'mobile'       => $request->mobile,
         'relationship'       => $request->relationship,
         'smartcard_no'       => $request->smartcard_no,
         'aadhaar_no'       => $request->aadhaar_no,
         'marital_status'       => $request->marital_status,
         'father_name'       => $request->father_name,
         'husband_name'       => $request->husband_name,
         'pin_code'       => $request->pin_code,
         'status'       => 'Pending',
         'applied_date' => date("Y-m-d"),
         'created_at'   => date("Y-m-d"),
     ] );

        $insertid = DB::getPdo()->lastInsertId();
        $passportsize_photo = "";
        $smartcard_onlineprint = "";
        $vao_or_income_certificate = "";
        $photo = "";
        $aadhaarimg = "";
        $aadhaarimg2 = "";
        $aadhaarimg3 = "";
        $aadhaarimg4 = "";
        $aadhaarimg5 = "";
        $aadhaarimg6 = "";

        if ($request->passportsize_photo != null) {
            $passportsize_photo = uniqid().'.'.$request->file('passportsize_photo')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'passportsize_photo' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['passportsize_photo']['tmp_name'], $filepath . $passportsize_photo);
        }
        DB::table('medicalscheme')->where('id', $insertid)->update([
           'passportsize_photo' => $passportsize_photo,
       ]);
        if ($request->smartcard_onlineprint != null) {
            $smartcard_onlineprint = uniqid().'.'.$request->file('smartcard_onlineprint')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smartcard_onlineprint' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['smartcard_onlineprint']['tmp_name'], $filepath . $smartcard_onlineprint);
        }
        DB::table('medicalscheme')->where('id', $insertid)->update([
           'smartcard_onlineprint' => $smartcard_onlineprint,
       ]);

        if ($request->vao_or_income_certificate != null) {
            $vao_or_income_certificate = uniqid().'.'.$request->file('vao_or_income_certificate')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'vao_or_income_certificate' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['vao_or_income_certificate']['tmp_name'], $filepath . $vao_or_income_certificate);
        }
        DB::table('medicalscheme')->where('id', $insertid)->update([
           'vao_or_income_certificate' => $vao_or_income_certificate,
       ]);
        
       if ($request->photo != null) {
           $photo = uniqid().'.'.$request->file('photo')->extension();
           $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
           move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);

}
DB::table('medicalscheme')->where('id', $insertid)->update([
  'photo' => $photo,
]);

       if ($request->aadhaar != null) {
       $aadhaarimg = uniqid().'.'.$request->file('aadhaar')->extension();
       $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar' . DIRECTORY_SEPARATOR);
       move_uploaded_file($_FILES['aadhaar']['tmp_name'], $filepath . $aadhaarimg);
   }
   DB::table('medicalscheme')->where('id', $insertid)->update([
     'aadhaar' => $aadhaarimg,
 ]);
 if ($request->aadhaar2 != null) {
    $aadhaarimg2 = uniqid().'.'.$request->file('aadhaar2')->extension();
    $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar2' . DIRECTORY_SEPARATOR);
    move_uploaded_file($_FILES['aadhaar2']['tmp_name'], $filepath . $aadhaarimg2);

}
DB::table('medicalscheme')->where('id', $insertid)->update([
  'aadhaar2' => $aadhaarimg2,
]);
if ($request->aadhaar3 != null) {
    $aadhaarimg3 = uniqid().'.'.$request->file('aadhaar3')->extension();
    $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar3' . DIRECTORY_SEPARATOR);
    move_uploaded_file($_FILES['aadhaar3']['tmp_name'], $filepath . $aadhaarimg3);

}
DB::table('medicalscheme')->where('id', $insertid)->update([
  'aadhaar3' => $aadhaarimg3,
]);
if ($request->aadhaar4 != null) {
    $aadhaarimg4 = uniqid().'.'.$request->file('aadhaar4')->extension();
    $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar4' . DIRECTORY_SEPARATOR);
    move_uploaded_file($_FILES['aadhaar4']['tmp_name'], $filepath . $aadhaarimg4);

}
DB::table('medicalscheme')->where('id', $insertid)->update([
  'aadhaar4' => $aadhaarimg4,
]);
if ($request->aadhaar5 != null) {
    $aadhaarimg5 = uniqid().'.'.$request->file('aadhaar5')->extension();
    $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar5' . DIRECTORY_SEPARATOR);
    move_uploaded_file($_FILES['aadhaar5']['tmp_name'], $filepath . $aadhaarimg5);

}
DB::table('medicalscheme')->where('id', $insertid)->update([
  'aadhaar5' => $aadhaarimg5,
]);
if ($request->aadhaar6 != null) {
    $aadhaarimg6 = uniqid().'.'.$request->file('aadhaar6')->extension();
    $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar6' . DIRECTORY_SEPARATOR);
    move_uploaded_file($_FILES['aadhaar6']['tmp_name'], $filepath . $aadhaarimg6);

}
DB::table('medicalscheme')->where('id', $insertid)->update([
  'aadhaar6' => $aadhaarimg6,
]);
    }elseif( $serviceid == 180 ){
        DB::table( 'medicalscheme' )->insert( [
            'user_id'                   => $user_id,
            'retailer_id'               => $retailer_id,
            'distributor_id'            => $distributor_id,
            'service_id'                => $request ->serviceid,
            'amount'                    => $request->amount,
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
       DB::table('medicalscheme')->where('id', $insertid)->update([
         'aadhaar_card' => $aadhaarimg,
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
$getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
    $servicename = "";
    if($getservicename){
        $servicename = $getservicename->service_name;
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

$getpermission = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
$coordinator_permission = 0;
$admin_payment = 0;
if($getpermission){
    $coordinator_permission = $getpermission->coordinator_permission;
    $admin_payment = $getpermission->admin_amount;
}
if($coordinator_permission == 1){
    $getdata = DB::table( 'medicalscheme' )->where('id',$insertid)->first();
    if($getdata){
     $passportsize_photo = $getdata->passportsize_photo;
     $vao_or_income_certificate = $getdata->vao_or_income_certificate;
     $smartcard_onlineprint = $getdata->smartcard_onlineprint;
     $photo = $getdata->photo;
     $service_id = $getdata->service_id;
     $rowid = $getdata->id;
     $family_head_name = $getdata->family_head_name;
     $father_name = $getdata->father_name;
     $smartcard_no = $getdata->smartcard_no;
     $mobile = $getdata->mobile;
     $aadhaar_no = $getdata->aadhaar_no;
     $pin_code = $getdata->pin_code;
     $husband_name = $getdata->husband_name;
     $marital_status = $getdata->marital_status;
     $status = $getdata->status;
     $url = url('/');
     $photo_url = $url.'/upload/services/photo/'.$photo;
     $smartcard_url = $url.'/upload/services/smartcard_onlineprint/'.$smartcard_onlineprint;
     $vao_or_income_certificate_url = $url.'/upload/services/vao_or_income_certificate/'.$vao_or_income_certificate;
     $passportsize_url = $url.'/upload/services/passportsize_photo/'.$passportsize_photo;
     $API_KEY = env( 'API_KEY', '' );
     $RAMJIPAY_URL = env( 'RAMJIPAY_URL', '' );
     $WEBSITE_INDEX = env( 'WEBSITE_INDEX', '' );
     $ch = curl_init();

     if($serviceid == 179){
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&photo=$photo_url&passportsize_photo=$passportsize_url&vao_or_income_certificate=$vao_or_income_certificate_url&smartcard_onlineprint=$smartcard_url&service_id=$service_id&rowid=$rowid&status=$status&family_head_name=$family_head_name&father_name=$father_name&smartcard_no=$smartcard_no&mobile=$mobile&aadhaar_no=$aadhaar_no&pin_code=$pin_code&husband_name=$husband_name&marital_status=$marital_status";
    
}

    //dd($post_data);
     $url1 = $RAMJIPAY_URL.'/api/get_medicalscheme_api';
  //echo $url1;die;
     curl_setopt( $ch, CURLOPT_URL, $url1 );
     curl_setopt( $ch, CURLOPT_POST, 1 );
     curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_data );
     curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
     $server_output = curl_exec( $ch );
     curl_close( $ch );
     $resdata = json_decode($server_output, true);
    //dd($resdata);
     if($resdata){
        $status = $resdata['message'];
        if($status == "Success"){
         $date = date( 'Y-m-d' );
         $time = date( 'H:i:s' );
         $service_status = 'Out Payment';
         $ad_info = 'Ramji Wallet Debit'.' '.$servicename;
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
         $newbalance2 = $balance1 + $admin_payment;
         $newbalance3 = $balance2 - $admin_payment;
         $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
         DB::insert( DB::raw( $sql ) );
         $sql = "update users set rawallet = rawallet + $admin_payment where id = 1";
         DB::update( DB::raw( $sql ) );
         $service_status = 'IN Payment';
         $ad_info = 'Ramji Wallet Credit'.' '.$servicename;
         $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
         DB::insert( DB::raw( $sql ) );
         $sql = "update users set rawallet = rawallet - $admin_payment where id = 2";
          DB::update( DB::raw( $sql ) );
   }
 }

}
}
return redirect("appliedservice/Pending")->With("success","Application submitted Succesfully");

}
public function submitapply_dharsan(Request $request){

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
    if($serviceid == 183 || $serviceid == 184 || $serviceid == 185 || $serviceid == 186 ){
        DB::table( 'dharsan' )->insert( [
         'user_id'      => $user_id,
         'retailer_id'  => $retailer_id,
         'distributor_id' => $distributor_id,
         'service_id'   => $request ->serviceid,
         'amount'       => $request->amount,
         'name'         => $request->name,
         'mobile'       => $request->mobile,
         'darshan_date' => $request->darshan_date,
         'time'         => $request->time,
         'route'         => $request->route,
         'status'       => 'Pending',
         'applied_date' => date("Y-m-d"),
         'created_at'   => date("Y-m-d"),
     ] );

        $insertid = DB::getPdo()->lastInsertId();
        $photo = "";
        $aadhaar_card = "";

        if ($request->photo != null) {
            $photo = uniqid().'.'.$request->file('photo')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);
        }
        DB::table('dharsan')->where('id', $insertid)->update([
           'photo' => $photo,
       ]);
        if ($request->aadhaar_card != null) {
            $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
        }
        DB::table('dharsan')->where('id', $insertid)->update([
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
    $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
    $servicename = "";
    if($getservicename){
        $servicename = $getservicename->service_name;
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

    return redirect("appliedservice/Pending")->With("success","Application submitted Succesfully");

}


public function panfind(){
    $pandetails = DB::table( 'pancard_find' )->orderBy( 'id', 'Desc' )->get();
    $mainbalance = DB::table( 'users' )->select('rawallet')->where('id',2)->first();
    return view( 'panservice.panfind',compact('mainbalance','pandetails'));
}



public function dlfind(){
    $dldetails = DB::table( 'dl' )->orderBy( 'id', 'Desc' )->get();
    $mainbalance = DB::table( 'users' )->select('rawallet')->where('id',2)->first();
    return view( 'pdfservice.dlservice',compact('mainbalance','dldetails'));
}

public function submitdlfind(Request $request){
    $dl_no = $request->dl_no;
    $dob = $request->dob;
    $apikey = '3e2a83212d3e5e4755390b84612f110d45d393c8c75946786de9ea4f283dcaa9';
    $amount = $request->amount;

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
    //dd($resdata);


    if($resdata['StatusCode'] == "100"){
        $pdf = $resdata['pdf'];
        $message = $resdata['message'];
        DB::table('dl')->insert([
            'user_id' => Auth::user()->id,
            'dlnumber' => $request->dl_no,
            'dob' => $dob,
            'pdf' => $pdf,
            'status'    => 'Approved',
            'date'    => date("Y-m-d H:i:s"),
        ]);
        $date = date( 'Y-m-d' );
        $time = date( 'H:i:s' );
        $service_status = 'Out Payment';
        $ad_info = 'Ramji Wallet Debit(DL PDF)';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('2','2','1','$amount','$ad_info', '$service_status','$time','$date','2')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set rawallet = rawallet + $amount where id = 1";
        DB::update( DB::raw( $sql ) );
        $service_status = 'IN Payment';
        $ad_info = 'Ramji Wallet Credit(DL PDF)';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('2','1','2','$amount','$ad_info', '$service_status','$time','$date','2')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set rawallet = rawallet - $amount where id = 2";
        DB::update( DB::raw( $sql ) );
        return redirect('/dlfind')->with('success',$message);
    }else{
        $error=$resdata['error'];
        return redirect('/dlfind')->with('error',$error);
    }
}



public function rcfind(){
    $rcdetails = DB::table( 'rc' )->orderBy( 'id', 'Desc' )->get();
    $mainbalance = DB::table( 'users' )->select('rawallet')->where('id',2)->first();
    return view( 'pdfservice.rcservice',compact('mainbalance','rcdetails'));
}

public function submitrcfind(Request $request){
    $rc_no = $request->rc_no;
    $apikey = 'e6890313368bd0f5c8c8e9383fa83763';
    $amount = $request->amount;
    $url = "https://apipanel.online/api/rc/rcpdf.php?api_key=$apikey&rcno=$rc_no";
    $crl = curl_init();
curl_setopt( $crl, CURLOPT_URL, $url );
curl_setopt( $crl, CURLOPT_FRESH_CONNECT, true );
curl_setopt( $crl, CURLOPT_RETURNTRANSFER, true );
$result = curl_exec($crl);
$result = json_decode($result);
curl_close($crl);

   if($result){
    if($result->status == "success"){
         $name = $result->name;
         $message = $result->message;
         $pdf = $result->pdf;
        DB::table('rc')->insert([
            'user_id' => Auth::user()->id,
            'rc_no' => $request->rc_no,
            'name' => $name,
            'pdf' => $pdf,
            'status'    => 'Approved',
            'date'    => date("Y-m-d H:i:s"),
        ]);
        $date = date( 'Y-m-d' );
        $time = date( 'H:i:s' );
        $service_status = 'Out Payment';
        $ad_info = 'Ramji Wallet Debit(RC PDF)';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('2','2','1','$amount','$ad_info', '$service_status','$time','$date','2')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set rawallet = rawallet + $amount where id = 1";
        DB::update( DB::raw( $sql ) );
        $service_status = 'IN Payment';
        $ad_info = 'Ramji Wallet Credit(RC PDF)';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('2','1','2','$amount','$ad_info', '$service_status','$time','$date','2')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set rawallet = rawallet - $amount where id = 2";
        DB::update( DB::raw( $sql ) );
        return redirect('/rcfind')->with('success',$message);
    }else{
        $error=$result->error;
        return redirect('/rcfind')->with('error',$error);
    }
}else{
    return redirect('/rcfind')->with('error','Something Went Wrong.....');
}

}

public function panadvance(){
    $pandetails = DB::table( 'pancard_find' )->orderBy( 'id', 'Desc' )->get();
    $mainbalance = DB::table( 'users' )->select('rawallet')->where('id',2)->first();
    return view( 'panservice.panadvance',compact('mainbalance','pandetails'));
}

public function submitpanadvance(Request $request){

    $pan_no = $request->pan_no;
    $apikey = '3e2a83212d3e5e4755390b84612f110d45d393c8c75946786de9ea4f283dcaa9';
    $amount = $request->amount;

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
            'message' => $message,
            'status'    => 'Approved',
            'date'    => date("Y-m-d H:i:s"),
        ]);
        $date = date( 'Y-m-d' );
        $time = date( 'H:i:s' );
        $service_status = 'Out Payment';
        $ad_info = 'Ramji Wallet Debit(PANADVANCE VERIFY)';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('2','2','1','$amount','$ad_info', '$service_status','$time','$date','2')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set rawallet = rawallet + $amount where id = 1";
        DB::update( DB::raw( $sql ) );
        $service_status = 'IN Payment';
        $ad_info = 'Ramji Wallet Credit(PANADVANCE VERIFY)';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('2','1','2','$amount','$ad_info', '$service_status','$time','$date','2')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set rawallet = rawallet - $amount where id = 2";
        DB::update( DB::raw( $sql ) );
        return redirect('/panadvance')->with('success',$message);
    }else{
        $error=$resdata['error'];
        return redirect('/panadvance')->with('error',$error);
    }
}

public function rationcardverify(){
    $rationdetails = DB::table( 'ration' )->orderBy( 'id', 'Desc' )->get();
    $mainbalance = DB::table( 'users' )->select('rawallet')->where('id',2)->first();
    return view( 'pdfservice.rationcardverify',compact('mainbalance','rationdetails'));
}

public function submitrationfind(Request $request){
    $aadhaar_no = $request->aadhaar_no;
    $apikey = '3e2a83212d3e5e4755390b84612f110d45d393c8c75946786de9ea4f283dcaa9';
    $amount = $request->amount;

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
        $name = $resdata['name'];
        DB::table('ration')->insert([
            'user_id'    => Auth::user()->id,
            'aadhaar_no' => $request->aadhaar_no,
            'name'       => $name,
            'pdf'        => $pdf,
            'status'     => 'Approved',
            'date'       => date("Y-m-d H:i:s"),
        ]);
        $date = date( 'Y-m-d' );
        $time = date( 'H:i:s' );
        $service_status = 'Out Payment';
        $ad_info = 'Ramji Wallet Debit(RATION PDF)';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('2','2','1','$amount','$ad_info', '$service_status','$time','$date','2')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set rawallet = rawallet + $amount where id = 1";
        DB::update( DB::raw( $sql ) );
        $service_status = 'IN Payment';
        $ad_info = 'Ramji Wallet Credit(RATION PDF)';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('2','1','2','$amount','$ad_info', '$service_status','$time','$date','2')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set rawallet = rawallet - $amount where id = 2";
        DB::update( DB::raw( $sql ) );
        return redirect('/rationcardverify')->with('success',$message);

}else{
    $message=$resdata['message'];

    return redirect('/rationcardverify')->with('error',$message);
}

}

public function submitutislnew(Request $request){
    // dd($request->all());
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
    DB::table( 'utislpan' )->insert( [
        'user_id'             =>   $user_id,
        'retailer_id'         =>   $retailer_id,
        'distributor_id'      =>   $distributor_id,
        'service_id'          => $request ->serviceid,
        // 'amount'              => $request->amount,
        'name'                => $request->name,
        'mobile'              => $request->mobile,
        'email'               => $request->email,
        'date_of_birth'       => $request->date_of_birth,
        'father_name'         => $request->father_name,
        'status'              => 'Pending',
        'applied_date'        => date("Y-m-d"),
        'created_at'          => date("Y-m-d"),
    ] );

    $insertid = DB::getPdo()->lastInsertId();

    $aadhaar_pdf = "";
    if ($request->aadhaar_pdf != null) {
        $aadhaar_pdf = uniqid().'.'.$request->file('aadhaar_pdf')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaarpdf' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['aadhaar_pdf']['tmp_name'], $filepath . $aadhaar_pdf);
    }
    DB::table('utislpan')->where('id', $insertid)->update([
        'aadhaar_pdf'         => $aadhaar_pdf,
    ]);
    $signature = "";
    if ($request->signature != null) {
        $signature = uniqid().'.'.$request->file('signature')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'signature' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['signature']['tmp_name'], $filepath . $signature);
    }
    DB::table('utislpan')->where('id', $insertid)->update([
        'signature'         => $signature,
    ]);
    $photo = "";
    if ($request->photo != null) {
        $photo = uniqid().'.'.$request->file('photo')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);
    }
    DB::table('utislpan')->where('id', $insertid)->update([
        'photo'         => $photo,
    ]);

    $servicepayment = $request->servicepayment;
    if(Auth::user()->user_type_id == 3){
        $user_id = $distributor_id;
    }elseif(Auth::user()->user_type_id == 4){
        $user_id = $retailer_id;
    }elseif(Auth::user()->user_type_id == 5){
        $user_id = $user_id;
    }
    $getservicename = DB::table( 'utislpanservice' )->select('service_name')->where('id',$serviceid)->first();
    $servicename = "";
    if($getservicename){
        $servicename = $getservicename->service_name;
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

    return redirect("appliedservice/Pending")->With("success","Application submitted Succesfully");

}

public function submitutisl_corection(Request $request){
    // dd($request->all());
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
    DB::table( 'utislpan' )->insert( [
        'user_id'             =>   $user_id,
        'retailer_id'         =>   $retailer_id,
        'distributor_id'      =>   $distributor_id,
        'service_id'          => $request ->serviceid,
        'pan_no'              => $request ->pan_no,
        'mode'                => $request ->mode,
        // 'amount'              => $request->amount,
        'name'                => $request->name,
        'mobile'              => $request->mobile,
        'email'               => $request->email,
        'date_of_birth'       => $request->date_of_birth,
        'father_name'         => $request->father_name,
        'status'              => 'Pending',
        'applied_date'        => date("Y-m-d"),
        'created_at'          => date("Y-m-d"),
    ] );

    $insertid = DB::getPdo()->lastInsertId();

    $aadhaar_pdf = "";
    if ($request->aadhaar_pdf != null) {
        $aadhaar_pdf = uniqid().'.'.$request->file('aadhaar_pdf')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaarpdf' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['aadhaar_pdf']['tmp_name'], $filepath . $aadhaar_pdf);
    }
    DB::table('utislpan')->where('id', $insertid)->update([
        'aadhaar_pdf'         => $aadhaar_pdf,
    ]);
    $pan_file = "";
    if ($request->pan_file != null) {
        $pan_file = uniqid().'.'.$request->file('pan_file')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'pancard' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['pan_file']['tmp_name'], $filepath . $pan_file);
    }
    DB::table('utislpan')->where('id', $insertid)->update([
        'pan_file'         => $pan_file,
    ]);
    $signature = "";
    if ($request->signature != null) {
        $signature = uniqid().'.'.$request->file('signature')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'signature' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['signature']['tmp_name'], $filepath . $signature);
    }
    DB::table('utislpan')->where('id', $insertid)->update([
        'signature'         => $signature,
    ]);
    $photo = "";
    if ($request->photo != null) {
        $photo = uniqid().'.'.$request->file('photo')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);
    }
    DB::table('utislpan')->where('id', $insertid)->update([
        'photo'         => $photo,
    ]);

    $servicepayment = $request->servicepayment;
    if(Auth::user()->user_type_id == 3){
        $user_id = $distributor_id;
    }elseif(Auth::user()->user_type_id == 4){
        $user_id = $retailer_id;
    }elseif(Auth::user()->user_type_id == 5){
        $user_id = $user_id;
    }
    $getservicename = DB::table( 'utislpanservice' )->select('service_name')->where('id',$serviceid)->first();
    $servicename = "";
    if($getservicename){
        $servicename = $getservicename->service_name;
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

    return redirect("appliedservice/Pending")->With("success","Application submitted Succesfully");

}

public function submitapply_patta(Request $request){

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
    DB::table( 'patta' )->insert( [
     'user_id'      => $user_id,
     'retailer_id'  => $retailer_id,
     'distributor_id'  => $distributor_id,
     'service_id'   => $request ->serviceid,
     'amount'       => $request->amount,
     'can_no'         => $request->can_no,
     'dist_id'         => $request->dist_id,
     'taluk_id'       => $request->taluk_id,
     'reg_office'       => $request->reg_office,
     'subdivision_no'          => $request->subdivision_no,
     'rev_village'          => $request->rev_village,
     'survey_no'          => $request->survey_no,
     'transacted_area'          => $request->transacted_area,

     'status'       => 'Pending',
     'applied_date' => date("Y-m-d"),
     'created_at'   => date("Y-m-d"),
 ] );

 $insertid = DB::getPdo()->lastInsertId();

    $bond_doc = "";
    if ($request->bond_doc != null) {
        $bond_doc = uniqid().'.'.$request->file('bond_doc')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'bond_doc' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['bond_doc']['tmp_name'], $filepath . $bond_doc);
    }
    DB::table('patta')->where('id', $insertid)->update([
        'bond_doc'         => $bond_doc,
    ]);
    $ec = "";
    if ($request->ec != null) {
        $ec = uniqid().'.'.$request->file('ec')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'ec' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['ec']['tmp_name'], $filepath . $ec);
    }
    DB::table('patta')->where('id', $insertid)->update([
        'ec'         => $ec,
    ]);

    $servicepayment = $request->service_amount;
    if(Auth::user()->user_type_id == 3){
        $user_id = $distributor_id;
    }elseif(Auth::user()->user_type_id == 4){
        $user_id = $retailer_id;
    }elseif(Auth::user()->user_type_id == 5){
        $user_id = $user_id;
    }
    $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
    $servicename = "";
    if($getservicename){
        $servicename = $getservicename->service_name;
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

    return redirect("appliedservice/Pending")->With("success","Application submitted Succesfully");

}
public function submitapply_smartcardotp(Request $request){
    //dd($request->all());
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
        DB::table( 'smartcard_otp' )->insert( [
         'user_id'         => $user_id,
         'retailer_id'     => $retailer_id,
         'distributor_id'  => $distributor_id,
         'service_id'      => $request ->serviceid,
         'amount'          => $request->amount,
         'name'            => $request->name,
         'documents'       => $request->documents,
         'status'          => 'Pending',
         'applied_date'    => date("Y-m-d"),
         'created_at'      => date("Y-m-d"),
     ] );

        $insertid = DB::getPdo()->lastInsertId();
        $aadhaar_card = "";
        $smart_card = "";

        if ($request->aadhaar_card != null) {
            $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
        }
        DB::table('smartcard_otp')->where('id', $insertid)->update([
           'aadhaar_card' => $aadhaar_card,
       ]);
  if ($request->smart_card != null) {
            $smart_card = uniqid().'.'.$request->file('smart_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smart_card);
        }
        DB::table('smartcard_otp')->where('id', $insertid)->update([
           'smart_card' => $smart_card,
       ]);

    $servicepayment = $request->service_amount;
    if(Auth::user()->user_type_id == 3){
        $user_id = $distributor_id;
    }elseif(Auth::user()->user_type_id == 4){
        $user_id = $retailer_id;
    }elseif(Auth::user()->user_type_id == 5){
        $user_id = $user_id;
    }
    $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
    $servicename = "";
    if($getservicename){
        $servicename = $getservicename->service_name;
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


$getpermission = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
$coordinator_permission = 0;
$admin_payment = 0;
if($getpermission){
    $coordinator_permission = $getpermission->coordinator_permission;
    $admin_payment = $getpermission->admin_amount;
}
if($coordinator_permission == 1){
    $getdata = DB::table( 'smartcard_otp' )->where('id',$insertid)->first();
    if($getdata){
     $aadhaar_card = $getdata->aadhaar_card;
     $smart_card = $getdata->smart_card;
     $service_id = $getdata->service_id;
     $rowid = $getdata->id;
     $name = $getdata->name;
     $documents = $getdata->documents;
     $status = $getdata->status;
     $url = url('/');
     $aadhaar_url = $url.'/upload/services/aadhaar_card/'.$aadhaar_card;
     $smartcard_url = $url.'/upload/services/smart_card/'.$smart_card;
     $API_KEY = env( 'API_KEY', '' );
     $RAMJIPAY_URL = env( 'RAMJIPAY_URL', '' );
     $WEBSITE_INDEX = env( 'WEBSITE_INDEX', '' );
     $ch = curl_init();

     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=218&rowid=$rowid&status=$status&smartcard_file=$smartcard_url&name=$name&documents=$documents";

    //dd($post_data);
     $url1 = $RAMJIPAY_URL.'/api/get_smartcardotp_api';
  //echo $url1;die;
     curl_setopt( $ch, CURLOPT_URL, $url1 );
     curl_setopt( $ch, CURLOPT_POST, 1 );
     curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_data );
     curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
     $server_output = curl_exec( $ch );
     curl_close( $ch );
     $resdata = json_decode($server_output, true);
     //dd($resdata);
     if($resdata){
        $status = $resdata['message'];
        if($status == "Success"){
         $date = date( 'Y-m-d' );
         $time = date( 'H:i:s' );
         $service_status = 'Out Payment';
         $ad_info = 'Ramji Wallet Debit'.' '.$servicename;
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
         $newbalance2 = $balance1 + $admin_payment;
         $newbalance3 = $balance2 - $admin_payment;
         $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
         DB::insert( DB::raw( $sql ) );
         $sql = "update users set rawallet = rawallet + $admin_payment where id = 1";
         DB::update( DB::raw( $sql ) );
         $service_status = 'IN Payment';
         $ad_info = 'Ramji Wallet Credit'.' '.$servicename;

         $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
         DB::insert( DB::raw( $sql ) );
         $sql = "update users set rawallet = rawallet - $admin_payment where id = 2";
          DB::update( DB::raw( $sql ) );
   }
 }

}
}
    return redirect("appliedservice/Pending")->With("success","Application submitted Succesfully");

}

public function submitapply_smart_nametransfer(Request $request){
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
     if($serviceid == 221 || $serviceid == 222 || $serviceid == 227 || $serviceid == 228 || $serviceid == 229 || $serviceid == 230 || $serviceid == 231 || $serviceid == 232 || $serviceid == 235 ){
        DB::table( 'smartcard' )->insert( [
         'user_id'      => $user_id,
         'retailer_id'  => $retailer_id,
         'distributor_id' => $distributor_id,
         'service_id'   => $request ->serviceid,
         'amount'       => $request->amount,
         'dist_id'      => $request->dist_id,
         'taluk_id'     => $request->taluk_id,
         'dob'          => $request->dob,
         'relationship' => $request->relationship,
         'name_tamil'   => $request->name_tamil,
         'name_english' => $request->name_english,
         'status'       => 'Pending',
         'applied_date' => date("Y-m-d"),
         'created_at'   => date("Y-m-d"),
     ] );

        $insertid = DB::getPdo()->lastInsertId();
        $aadhaar_card = "";
        $smart_card = "";
        if ($request->aadhaar_card != null) {
            $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
        }
        DB::table('smartcard')->where('id', $insertid)->update([
           'aadhaar_card' => $aadhaar_card,
       ]);
       if ($request->smart_card != null) {
            $smart_card = uniqid().'.'.$request->file('smart_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smart_card);
        }
        DB::table('smartcard')->where('id', $insertid)->update([
           'smart_card' => $smart_card,
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
$getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
    $servicename = "";
    if($getservicename){
        $servicename = $getservicename->service_name;
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

$getpermission = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
$coordinator_permission = 0;
$admin_payment = 0;
if($getpermission){
    $coordinator_permission = $getpermission->coordinator_permission;
    $admin_payment = $getpermission->admin_amount;
}
if($coordinator_permission == 1){
    $getdata = DB::table( 'smartcard' )->where('id',$insertid)->first();
    if($getdata){
     $aadhaar_card = $getdata->aadhaar_card;
     $smart_card = $getdata->smart_card;
     $service_id = $getdata->service_id;
     $rowid = $getdata->id;
     $status = $getdata->status;
     $dist_id = $getdata->dist_id;
     $taluk_id = $getdata->taluk_id;
     $relationship = $getdata->relationship;
     $name_tamil = $getdata->name_tamil;
     $name_english = $getdata->name_english;
     $dob = $getdata->dob;
     $url = url('/');
     $aadhaar_url = $url.'/upload/services/aadhaar_card/'.$aadhaar_card;
     $smartcard_url = $url.'/upload/services/smart_card/'.$smart_card;
     $API_KEY = env( 'API_KEY', '' );
     $RAMJIPAY_URL = env( 'RAMJIPAY_URL', '' );
     $WEBSITE_INDEX = env( 'WEBSITE_INDEX', '' );
     $ch = curl_init();
     if($serviceid == 221){
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=219&rowid=$rowid&status=$status&smartcard_file=$smartcard_url&dist_id=$dist_id&taluk_id=$taluk_id&relationship=$relationship&name_tamil=$name_tamil&name_english=$name_english&dob=$dob";
     }elseif($serviceid == 222){
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=224&rowid=$rowid&status=$status&smartcard_file=$smartcard_url&relationship=$relationship";
     }elseif($serviceid == 227){
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=225&rowid=$rowid&status=$status&smartcard_file=$smartcard_url&name_tamil=$name_tamil&name_english=$name_english";
     }elseif($serviceid == 228){
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=234&rowid=$rowid&status=$status&smartcard_file=$smartcard_url&dob=$dob";
      }elseif($serviceid == 229){
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=235&rowid=$rowid&status=$status&smartcard_file=$smartcard_url&relationship=$relationship";
      }elseif($serviceid == 230){
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=236&rowid=$rowid&status=$status&smartcard_file=$smartcard_url&name_tamil=$name_tamil&name_english=$name_english&dob=$dob";
      }elseif($serviceid == 231){
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=237&rowid=$rowid&status=$status&smartcard_file=$smartcard_url&dist_id=$dist_id&taluk_id=$taluk_id&relationship=$relationship&name_tamil=$name_tamil&name_english=$name_english&dob=$dob";
      }elseif($serviceid == 232){
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=238&rowid=$rowid&status=$status&smartcard_file=$smartcard_url&relationship=$relationship&name_tamil=$name_tamil&name_english=$name_english";
      }elseif($serviceid == 235){
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=245&rowid=$rowid&status=$status&smartcard_file=$smartcard_url&relationship=$relationship&dob=$dob";
}
    //dd($post_data);
     $url1 = $RAMJIPAY_URL.'/api/get_smartcard_api';
   //echo $url1;die;
     curl_setopt( $ch, CURLOPT_URL, $url1 );
     curl_setopt( $ch, CURLOPT_POST, 1 );
     curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_data );
     curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
     $server_output = curl_exec( $ch );
     curl_close( $ch );
     $resdata = json_decode($server_output, true);
     //dd($resdata);

     if($resdata){
        $status = $resdata['message'];
        if($status == "Success"){
         $date = date( 'Y-m-d' );
         $time = date( 'H:i:s' );
         $service_status = 'Out Payment';
         $ad_info = 'Ramji Wallet Debit'.' '.$servicename;
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
         $newbalance2 = $balance1 + $admin_payment;
         $newbalance3 = $balance2 - $admin_payment;
         $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
         DB::insert( DB::raw( $sql ) );
         $sql = "update users set rawallet = rawallet + $admin_payment where id = 1";
         DB::update( DB::raw( $sql ) );
         $service_status = 'IN Payment';
         $ad_info = 'Ramji Wallet Credit'.' '.$servicename;

         $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
         DB::insert( DB::raw( $sql ) );
         $sql = "update users set rawallet = rawallet - $admin_payment where id = 2";
          DB::update( DB::raw( $sql ) );
   }
 }

}
}
    return redirect("appliedservice/Pending")->With("success","Application submitted Succesfully");

}

public function submitapply_voteridpdfdownload(Request $request){
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
    DB::table('voteridpdf_download')->insert( [
         'user_id'             => $user_id,
         'retailer_id'         => $retailer_id,
         'distributor_id'      => $distributor_id,
         'service_id'          => $request ->serviceid,
         'name'                => $request->name,
         'mobile'              => $request->mobile,
         'epic_no'             => $request->epic_no,
         'status'              => 'Pending',
         'applied_date'        => date("Y-m-d"),
         'created_at'          => date("Y-m-d"),
     ] );
$insertid = DB::getPdo()->lastInsertId();

$servicepayment = $request->service_amount;
if(Auth::user()->user_type_id == 3){
    $user_id = $distributor_id;
}elseif(Auth::user()->user_type_id == 4){
    $user_id = $retailer_id;
}elseif(Auth::user()->user_type_id == 5){
    $user_id = $user_id;
}
$getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
$servicename = "";
if($getservicename){
    $servicename = $getservicename->service_name;
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

$getpermission = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
$coordinator_permission = 0;
$admin_payment = 0;
if($getpermission){
    $coordinator_permission = $getpermission->coordinator_permission;
    $admin_payment = $getpermission->admin_amount;
}
if($coordinator_permission == 1){
    $getdata = DB::table( 'voteridpdf_download' )->where('id',$insertid)->first();
    if($getdata){
     $service_id = $getdata->service_id;
     $rowid = $getdata->id;
     $status = $getdata->status;
     $name = $getdata->name;
     $mobile = $getdata->mobile;
     $epic_no = $getdata->epic_no;
     $url = url('/');
     $API_KEY = env( 'API_KEY', '' );
     $RAMJIPAY_URL = env( 'RAMJIPAY_URL', '' );
     $WEBSITE_INDEX = env( 'WEBSITE_INDEX', '' );
     $ch = curl_init();
     if($serviceid == 69){
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&service_id=$service_id&rowid=$rowid&status=$status&name=$name&epic_no=$epic_no";
     }elseif($serviceid == 70){
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&service_id=$service_id&rowid=$rowid&status=$status&name=$name&epic_no=$epic_no&mobile=$mobile";
     }elseif($serviceid == 71){
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&service_id=$service_id&rowid=$rowid&status=$status&name=$name&epic_no=$epic_no&mobile=$mobile";
    
}
     //dd($post_data);
     $url1 = $RAMJIPAY_URL.'/api/get_voteridpdf_download_api';
  //echo $url1;die;
    curl_setopt( $ch, CURLOPT_URL, $url1 );
     curl_setopt( $ch, CURLOPT_POST, 1 );
     curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_data );
     curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
     $server_output = curl_exec( $ch );
     curl_close( $ch );
     $resdata = json_decode($server_output, true);
    //dd($resdata);
     if($resdata){
        $status = $resdata['message'];
        if($status == "Success"){
         $date = date( 'Y-m-d' );
         $time = date( 'H:i:s' );
         $service_status = 'Out Payment';
         $ad_info = 'Ramji Wallet Debit'.' '.$servicename;
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
         $newbalance2 = $balance1 + $admin_payment;
         $newbalance3 = $balance2 - $admin_payment;
         $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
         DB::insert( DB::raw( $sql ) );
         $sql = "update users set rawallet = rawallet + $admin_payment where id = 1";
         DB::update( DB::raw( $sql ) );
         $service_status = 'IN Payment';
         $ad_info = 'Ramji Wallet Credit'.' '.$servicename;
         $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
         DB::insert( DB::raw( $sql ) );
         $sql = "update users set rawallet = rawallet - $admin_payment where id = 2";
          DB::update( DB::raw( $sql ) );
   }
 }

}
}
return redirect("appliedservice/Pending")->With("success","Application submitted Succesfully");

}

public function submitapply_agri_stack(Request $request){
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
    DB::table('agri_stack')->insert( [
         'user_id'             => $user_id,
         'retailer_id'         => $retailer_id,
         'distributor_id'      => $distributor_id,
         'service_id'          => $request ->serviceid,
         'aadhaar_no'          => $request->aadhaar_no,
         'status'              => 'Pending',
         'applied_date'        => date("Y-m-d"),
         'created_at'          => date("Y-m-d"),
     ] );

     $insertid = DB::getPdo()->lastInsertId();

$servicepayment = $request->service_amount;
if(Auth::user()->user_type_id == 3){
    $user_id = $distributor_id;
}elseif(Auth::user()->user_type_id == 4){
    $user_id = $retailer_id;
}elseif(Auth::user()->user_type_id == 5){
    $user_id = $user_id;
}
$getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
$servicename = "";
if($getservicename){
    $servicename = $getservicename->service_name;
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

$getpermission = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
$coordinator_permission = 0;
$admin_payment = 0;
if($getpermission){
    $coordinator_permission = $getpermission->coordinator_permission;
    $admin_payment = $getpermission->admin_amount;
}
if($coordinator_permission == 1){
    $getdata = DB::table( 'agri_stack' )->where('id',$insertid)->first();
    if($getdata){
     $service_id = $getdata->service_id;
     $rowid = $getdata->id;
     $status = $getdata->status;
     $aadhaar_no = $getdata->aadhaar_no;
     $url = url('/');
     $API_KEY = env( 'API_KEY', '' );
     $RAMJIPAY_URL = env( 'RAMJIPAY_URL', '' );
     $WEBSITE_INDEX = env( 'WEBSITE_INDEX', '' );
     $ch = curl_init();
    
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&service_id=$service_id&rowid=$rowid&status=$status&aadhaar_no=$aadhaar_no";
    
     //dd($post_data);
     $url1 = $RAMJIPAY_URL.'/api/get_agristack_api';
  //echo $url1;die;
    curl_setopt( $ch, CURLOPT_URL, $url1 );
     curl_setopt( $ch, CURLOPT_POST, 1 );
     curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_data );
     curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
     $server_output = curl_exec( $ch );
     curl_close( $ch );
     $resdata = json_decode($server_output, true);
    //dd($resdata);
     if($resdata){
        $status = $resdata['message'];
        if($status == "Success"){
         $date = date( 'Y-m-d' );
         $time = date( 'H:i:s' );
         $service_status = 'Out Payment';
         $ad_info = 'Ramji Wallet Debit'.' '.$servicename;
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
         $newbalance2 = $balance1 + $admin_payment;
         $newbalance3 = $balance2 - $admin_payment;
         $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
         DB::insert( DB::raw( $sql ) );
         $sql = "update users set rawallet = rawallet + $admin_payment where id = 1";
         DB::update( DB::raw( $sql ) );
         $service_status = 'IN Payment';
         $ad_info = 'Ramji Wallet Credit'.' '.$servicename;
         $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
         DB::insert( DB::raw( $sql ) );
         $sql = "update users set rawallet = rawallet - $admin_payment where id = 2";
          DB::update( DB::raw( $sql ) );
   }
 }

}
}
return redirect("appliedservice/Pending")->With("success","Application submitted Succesfully");

}

public function submitpvccardprint(Request $request){
$user_id        = 0;
$retailer_id    = 0;
$distributor_id = 0;

if (Auth::user()->user_type_id == 3) {
    $user_id        = $request->user_id;
    $distributor_id = Auth::user()->id;

} elseif (Auth::user()->user_type_id == 4) {
    $user_id     = $request->user_id;
    $retailer_id = Auth::user()->id;

} elseif (Auth::user()->user_type_id == 5) {
    $user_id = Auth::user()->id;
}

   $pvc_id = DB::table('pvc_card')->insertGetId([
    'user_id'        => $user_id,
    'retailer_id'    => $retailer_id,
    'distributor_id' => $distributor_id,
    'service_id'     => $request->serviceid,
    'amount'   => $request->service_amount,

    'delivery_name'    => $request->delivery['name'] ?? null,
    'delivery_mobile'  => $request->delivery['mobile'] ?? null,
    'delivery_address' => $request->delivery['address'] ?? null,
    'pincode'          => $request->delivery['pincode'] ?? null,

    'status'        => 'Pending',
    'applied_date'  => date('Y-m-d'),
    'created_at'    => date('Y-m-d'),
]);

if (!empty($request->service)) {
    foreach ($request->service as $service) {
        $filePath = null;
        $filePath1 = null;

        if (isset($service['file']) && $service['file'] instanceof \Illuminate\Http\UploadedFile) {
            $file = $service['file'];

            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('upload/pvc_documents');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Move file to destination
            $file->move($destinationPath, $filename);

            // Relative file path to save in DB
            $filePath = 'upload/pvc_documents/' . $filename;
        }
        if (isset($service['ration_pdf']) && $service['ration_pdf'] instanceof \Illuminate\Http\UploadedFile) {
            $file = $service['ration_pdf'];

            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('upload/pvc_rationpdf');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Move file to destination
            $file->move($destinationPath, $filename);

            // Relative file path to save in DB
            $filePath1 = 'upload/pvc_rationpdf/' . $filename;
        }

        DB::table('pvc_details')->insert([
            'pvc_id'        => $pvc_id,
            'service_name'  => $service['name'],
            'password'      => $service['password'] ?? null,
            'document'      => $filePath,
            'pvc_rationpdf' => $filePath1,
            'created_at'  => now(),
        ]);
    }
}

  $servicepayment = $request->service_amount;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $request->serviceid)->first();
        $servicename    = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date           = date('Y-m-d');
        $time           = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info        = 'Service Payment' . ' ' . $servicename;
        $getwallet      = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance        = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance  = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql            = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");

    }
}
