<?php

namespace App\Http\Controllers;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class WebsiteController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }


    public function website(){
        $website = DB::table('website_data')->orderBy('id', 'Asc')->get();
        return view('website.website',compact('website'));

   }
   public function savewebsite(Request $request)
   {
    
          $website = DB::table('website_data')->insert([
             
              'website_name'    => $request->website_name,
              'website_link'    => $request->website_link,
              'index'    => uniqid(),
              'status'    => 'Active',
            
          ]);

          return redirect( "/website" );
   }

   public function updatewebsite(Request $request)
    {
        $website = DB::table('website_data')->where('id', $request->id)->update([

              'website_name'    => $request->website_name,
              'website_link'    => $request->website_link,
              'status'          => $request->status,
          ]);

          
      return redirect()->back()->with('success', 'Website Updated Successfully ... !');
    }          
  
  
}
