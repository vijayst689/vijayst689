<?php
namespace App\Http\Controllers;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CoursestatusController extends Controller
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

    public function tailorappliedservice($status)
    {
        if(Auth::user()->user_type_id == 2 || Auth::user()->user_type_id == 1){

            $service = DB::table('tailor')->select('courses.name', 'tailor.*')
            ->Join('courses', 'courses.id', '=', 'tailor.service_id')
            ->where('tailor.status',$status)
            ->orderBy('tailor.id', 'Desc')->get();

            $service = $service->merge($service);

            $service = json_decode( json_encode( $service ), true );
        foreach ( $service as $key => $s ) {
            $user_id = 0;
            $context = "";
            if($s['retailer_id'] == 0 && $s['distributor_id'] == 0){
            $user_id = $s['user_id'];
            $context = "Customer";
        }
        elseif($s['retailer_id'] == 0){
            $user_id = $s['distributor_id'];
            $context = "Distributor";
        }elseif($s['distributor_id'] == 0){
            $user_id = $s['retailer_id'];
            $context = "Retailer";
        }
        $user_id = $user_id;
        $sql = "select name,phone from users where id=$user_id";
        $result = DB::select( $sql );
        $name = "";
        $mobile = "";
        if(count($result) > 0){
            $name = $result[0]->name;
            $mobile = $result[0]->phone;
        }
        $service[ $key ][ 'applyname' ] = $name;
        $service[ $key ][ 'applymobile' ] = $mobile;
        $service[ $key ][ 'context' ] = $context;
        $service[ $key ][ 'applyuserid' ] = $user_id;
    }
        $service = json_decode( json_encode( $service ));

        }elseif(Auth::user()->user_type_id == 3){

            $service = DB::table('tailor')->select('services.service_name', 'tailor.*')
            ->Join('services', 'services.id', '=', 'tailor.service_id')
            ->where('tailor.status',$status)
            ->where('tailor.distributor_id',Auth::user()->id)
            ->orderBy('tailor.id', 'Desc')->get();

            $service = $service->merge($service);

        }elseif(Auth::user()->user_type_id == 4){

            $service = DB::table('tailor')->select('services.service_name', 'tailor.*')
            ->Join('services', 'services.id', '=', 'tailor.service_id')
            ->where('tailor.status',$status)
            ->where('tailor.retailer_id',Auth::user()->id)
            ->orderBy('tailor.id', 'Desc')->get();

            $service = $service->merge($service);

        }elseif(Auth::user()->user_type_id == 5){

            $service = DB::table('tailor')->select('services.service_name', 'tailor.*')
            ->Join('services', 'services.id', '=', 'tailor.service_id')
            ->where('tailor.status',$status)
            ->where('tailor.user_id',Auth::user()->id)
            ->orderBy('tailor.id', 'Desc')->get();

            $service = $service->merge($service);
        }
        return view( 'tailoring.tailorappliedservice',compact('service','status') );
    }


    public function tailoringservicestatus($status,$id,$service_id)
    {
        $user_id = 0;
        $serviceid = 0;
        if($service_id == 1 || $service_id == 2 || $service_id == 3 || $service_id == 4){
            $services = DB::table('tailor')->where('id',$id)->where('status',$status)->first();
        }

        $customers = DB::table('users')->where('id',$user_id)->first();
        $districts = DB::table( 'district' )->get();
        $sql = "select name,amount from courses where id = $serviceid";
        $result = DB::select(DB::raw($sql));
        $servicename = "";
        $amount = 0;
        if(count($result) > 0){
            $servicename = $result[0]->name;
            $amount = $result[0]->amount;
        }

        if($service_id == 1 || $service_id == 2 || $service_id == 3 || $service_id == 4 ){
            return view('tailoringservicestatus.tailorshop_statusupdate',compact('id','services','servicename','customers','serviceid','amount','districts') );
        }

}

public function tailorshop_update(Request $request){
    $apply_user_id = 0;
    if($request->retailer_id == 0){
     $apply_user_id = $request->distributor_id;
 }elseif($request->distributor_id == 0){
     $apply_user_id = $request->retailer_id;
 }
 if($request->distributor_id != Auth::user()->id && $apply_user_id != Auth::user()->id){
     $status = $request->status;
     if($status == "Resubmit"){
         DB::table( 'tailor' )->where('id', $request->applied_serviceid)->update( [
             'remarks'  => $request->remarks,
             'status'  => $status,
         ] );
     }elseif($status == "Processing"){
         if ( $request->acknowledgement != null ) {
             $acknowledgement = uniqid().'.'.$request->file( 'acknowledgement' )->extension();
             $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'acknowledgement' . DIRECTORY_SEPARATOR);
             move_uploaded_file( $_FILES[ 'acknowledgement' ][ 'tmp_name' ], $filepath . $acknowledgement );
             DB::table( 'tailor' )->where( 'id', $request->applied_serviceid )->update( [
                 'acknowledgement' => $acknowledgement,
                 'status' => $status,
                 'application_no' => $request->application_no,
             ] );
         }
     }elseif($status == "Approved"){
         if ( $request->certificate != null ) {
             $certificate = uniqid().'.'.$request->file( 'certificate' )->extension();
             $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'certificate'. DIRECTORY_SEPARATOR);
             move_uploaded_file( $_FILES[ 'certificate' ][ 'tmp_name' ], $filepath . $certificate );
             DB::table( 'tailor' )->where( 'id', $request->applied_serviceid )->update( [
                 'certificate' => $certificate,
                 'status' => $status,
                 'completed_date' => date("Y-m-d"),
             ] );
         }
     }
 }else{
     $status = "Pending";
     $serviceid = $request->serviceid;
     if ($request->pan_card != null) {
         $pan_card = uniqid().'.'.$request->file('pan_card')->extension();
         $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'pan_card' . DIRECTORY_SEPARATOR);
         move_uploaded_file($_FILES['pan_card']['tmp_name'], $filepath . $pan_card);
         DB::table( 'tailor' )->where( 'id', $request->applied_serviceid )->update( [
          'pan_card'             => $pan_card,
      ] );
     }
     if($serviceid == 1 || $serviceid == 2 || $serviceid == 3 || $serviceid == 4){
         DB::table('tailor')->where('id', $request->applied_serviceid)->update([
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
          'pincode'             => $request->pincode,
          'status'              => 'Pending',
          'applied_date'        => date("Y-m-d"),
          'created_at'          => date("Y-m-d"),
      ]);

         DB::table( 'tailor' )->where( 'id', $request->applied_serviceid )->update( [
             'status' => $status,
         ] );

         if ($request->photo != null) {
            $photo = uniqid().'.'.$request->file('photo')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);
        }
        DB::table('tailor')->where( 'id', $request->applied_serviceid )->update( [
            'photo' => $photo,
        ]);
    }

}
return redirect("tailorappliedservice/$status")->With("success","Application submitted Succesfully");
}

}

