<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class retailerController extends Controller
{

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

            $viewretailers = DB::table('users')->where( 'user_type_id', '=', 4 )->where( 'refferal_id', '=', $userid )->orderBy( 'id', 'Asc' )->get();

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
      $updateretailer = DB::table('users')->where( 'id', $request->retailer_id )->update([
        'name'          => $request->name,
        'aadhaar_no'    => $request->aadhaar_no,
        'email'         => $request->email,
        'phone'         => $request->phone,
        'address'       => $request->address,
        'gender'        => $request->gender,
        'status'        => $request->status,
      ]);

      $profile = "";
      if ($request->profile != null) {
        $profile = $request->retailer_id.'.'.$request->file('profile')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'retailer' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['profile']['tmp_name'], $filepath . $profile);
        $sql = "update users set profile='$profile' where id = $request->retailer_id";
        DB::update(DB::raw($sql));
      }

      return redirect('/retailers')->with('success', 'retailer Updated Successfully ... !');
    }

    public function dropretailer( $id ){

        $dropretailer = DB::table('users')->where( 'id', $id )->delete();
     return redirect()->back()->with('success', 'Retailer Deleted Successfully ... !');
    }


}
