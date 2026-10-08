<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class RetailerController extends Controller
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

    public function testapi()
    {
       $curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => "https://sit.paysprint.in/service-api/api/v1/service/fastag/Fastag/operatorsList",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_HTTPHEADER => [
    "Content-Type: application/json",
    "Token: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJQQVlTUFJJTlQiLCJ0aW1lc3RhbXAiOjE2MTAwMjYzMzgsInBhcnRuZXJJZCI6IlBTMDAxIiwicHJvZHVjdCI6IldBTExFVCIsInJlcWlkIjoxNjEwMDI2MzM4fQ.buzD40O8X_41RmJ0PCYbBYx3IBlsmNb9iVmrVH9Ix64",
    "accept: application/json"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
    }

    public function addretailer()
    {
        return view('retailer.addretailer');
    }

    public function Retailer()
    {
        $userid = Auth::user()->id;

        if( Auth::user()->user_type_id == 1 ) {

            $viewretailers = DB::table('users')->where( 'user_type_id', '=', 4 )->orderBy( 'id', 'Asc' )->get();

        }

        if( Auth::user()->user_type_id == 2 ) {

            $viewretailers = DB::table('users')->where( 'user_type_id', '=', 4 )->orderBy( 'id', 'Asc' )->get();

        }

        if( Auth::user()->user_type_id == 4 ) {

        $viewretailers = DB::table('users')->where( 'user_type_id', '=', 4 )->where( 'refferal_id', '=', $userid )->orderBy( 'id', 'Asc' )->get();

        }

        if( Auth::user()->user_type_id == 3 ) {

        $viewretailers = DB::table('users')->where( 'user_type_id', '=', 4 )->where( 'refferal_id', '=', $userid)->orderBy( 'id', 'Asc' )->get();

        }

        return view('retailer.retailers',compact('viewretailers'));
    }

    public function saveretailer(Request $request)
    {
      $userid = Auth::user()->id;
      $saveretailer = DB::table('users')->insert([
        'name'          => $request->name,
        'aadhaar_no'    => $request->aadhaar_no,
        'password'      => Hash::make($request->password),
        'cpassword'     => $request->password,
        'email'         => $request->email,
        'phone'         => $request->phone,
        'address'       => $request->address,
        'gender'        => $request->gender,
        'date_of_birth' => $request->date_of_birth,
        'refferal_id'   => $userid,
        'user_type_id'  => '4',
        'status'        => 'Active'
      ]);

      $insertid = DB::getPdo()->lastInsertId();

      $profile = "";
      if ($request->profile != null) {
        $profile = $insertid.'.'.$request->file('profile')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'retailer' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['profile']['tmp_name'], $filepath . $profile);
      }
      $image = DB::table( 'users' )->where( 'id', $insertid )->update( [
        'profile'    => $profile,
      ] );

      return redirect('/retailers')->with('success', 'retailer Add Successfully ... !');
    }

    public function updateretailer(Request $request)
    {
      $updateretailer = DB::table('users')->where( 'id', $request->retailerid )->update([
        'name'           => $request->name,
        'aadhaar_no'     => $request->aadhaar_no,
        'email'          => $request->email,
        'phone'          => $request->phone,
        'address'        => $request->address,
        'gender'         => $request->gender,
        'date_of_birth'  => $request->date_of_birth,
      ]);

      $profile = "";
      if ($request->profile != null) {
        $profile = $request->retailerid.'.'.$request->file('profile')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'retailer' . DIRECTORY_SEPARATOR );
        move_uploaded_file($_FILES['profile']['tmp_name'], $filepath . $profile);
        $sql = "update users set profile='$profile' where id = $request->retailerid";
        DB::update(DB::raw($sql));
      }

      return redirect('/retailers')->with('success', 'retailer Updated Successfully ... !');
    }

    public function dropretailer( $id ){

        $dropretailer = DB::table('users')->where( 'id', $id )->delete();
     return redirect()->back()->with('success', 'Retailer Deleted Successfully ... !');
    }

    public function retailerstatusupdate(Request $request)
    {
      $retailerstatusupdate = DB::table('users')->where( 'id', $request->statusid )->update([
        'status'          => $request->status,
        'user_type_id'    => $request->user_type_id,
      ]);

      return redirect('/retailers')->with('success', 'retailer Status Updated Successfully ... !');
    }

    public function adminstatusupdate(Request $request)
    {
      $adminstatusupdate = DB::table('users')->where( 'id', $request->adminid )->update([
        'status'          => $request->status,
      ]);

      return redirect('/retailers')->with('success', 'retailer Status Updated Successfully ... !');
    }

    public function updatestatus(Request $request) {

        $status = "Active";
        $amount = $request->amount;
        $from_id = Auth::user()->id;
        $request_id = $request->request_id;
        $login_id = Auth::user()->id;
        $date = date( 'Y-m-d' );
        $time = date( 'H:i:s' );
        $service_status = 'Out Payment';
        $ad_info = 'Fund Transfer';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('$login_id','$login_id','$from_id','$amount','$ad_info', '$service_status','$time','$date','$from_id')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet + $amount where id = 2";
        DB::update( DB::raw( $sql ) );
        $service_status = 'IN Payment';
        $ad_info = 'Fund Transfer';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('$login_id','$from_id',2,'$amount','$ad_info', '$service_status','$time','$date','$from_id')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet - $amount where id = $login_id";
        DB::update( DB::raw( $sql ) );
        $sql = "update users set status = '$status' where id = $request_id";
        DB::update( DB::raw( $sql ) );

     return redirect( "/retailers" )->with( 'success', 'Status Update Successfully' );
    }


}
