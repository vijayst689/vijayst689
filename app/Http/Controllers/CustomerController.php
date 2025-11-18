<?php

namespace App\Http\Controllers;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function addcustomer()
  {
    return view('customers.addcustomer',compact('districts'));
  }

    public function get_taluk_register($distid)
  {
      $response = DB::table('taluk')->where('dist_id',$distid)->orderBy( 'id', 'Asc' )->get();
      return response()->json( $response );
  }

  public function get_panchayath_register($taluk_id)
  {
      $response = DB::table('panchayath')->where('taluk_id',$taluk_id)->orderBy( 'id', 'Asc' )->get();
      return response()->json( $response );
  }
}
