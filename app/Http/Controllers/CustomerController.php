<?php

namespace App\Http\Controllers;
use Auth;
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
}
