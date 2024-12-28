<?php

namespace App\Http\Controllers;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UtilityController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }


  public function addutilityservice(){
    return view( 'utility.addutilityservice');
  }

  public function viewutility(){
    $utility = DB::table( 'utility_services' )->orderBy( 'id', 'Asc' )->get();
    return view( 'utility.viewutility' ,compact('utility'));
  }

  public function saveutility( Request $request ) {
    DB::table( 'utility_services' )->insert( [
      'name'        => $request->name,
      'date'        => date("Y-m-d H:i:s"),
      'status'      => 'Active',
    ] );

    $insertid = DB::getPdo()->lastInsertId();

    $ser_image = '';
    if ( $request->ser_image != null ) {
      $ser_image = $insertid.'.'.$request->file( 'ser_image' )->extension();
      $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'uti_image' . DIRECTORY_SEPARATOR );
      move_uploaded_file( $_FILES[ 'ser_image' ][ 'tmp_name' ], $filepath . $ser_image );
    }
    $image = DB::table( 'utility_services' )->where( 'id', $insertid )->update( [
      'ser_image' => $ser_image,
    ] );
    return redirect('/viewutility')->with('success', 'Utility Service Added Successfully ... !');
  }

  public function updateutility( Request $request ) {
    DB::table( 'utility_services' )->where('id', $request->utilityid)->update( [
      'name'     => $request->name,
    ] );

    if ( $request->ser_image != null ) {
      $ser_image = $request->utilityid.'.'.$request->file( 'ser_image' )->extension();
      $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'uti_image' . DIRECTORY_SEPARATOR );
      move_uploaded_file( $_FILES[ 'ser_image' ][ 'tmp_name' ], $filepath . $ser_image );
      $image = DB::table( 'utility_services' )->where( 'id', $request->utilityid )->update( [
        'ser_image' => $ser_image,
      ] );
    }

    return redirect()->back()->with( 'success', 'Utility Service Updated Successfully' );
  }

  public function updatestatusuti( Request $request ) {
    DB::table( 'utility_services' )->where('id', $request->utiid)->update( [
      'status'     => $request->status,
    ] );

    return redirect()->back()->with( 'success', 'Utility Status Updated Successfully' );
  }

}
