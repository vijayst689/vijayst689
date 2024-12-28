<?php

namespace App\Http\Controllers;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function userpermission($userid){
    $checkpermission_services = DB::table( 'user_permission' )->where('user_id' , Auth::user()->id)->where('parent_id' , 3)->get();
    if(Auth::user()->user_type_id == 1){
      $services = DB::table( 'services' )->where('parent_id',0)->where('status','Active')->orderBy( 'id', 'Asc' )->get();
    }else{
      $services = DB::table( 'services' )->where('parent_id',0)->whereIn('id',$checkpermission_services->pluck('service_id'))->where('status','Active')->orderBy( 'id', 'Asc' )->get();
    }

    $checkpermission_findservices = DB::table( 'user_permission' )->where('user_id' , Auth::user()->id)->where('parent_id' , 1)->get();
    if(Auth::user()->user_type_id == 1){
     $findservices = DB::table( 'find_services' )->where('status','Active')->orderBy( 'id', 'Asc' )->get();
   }else{
     $findservices = DB::table( 'find_services' )->where('status','Active')->whereIn('id',$checkpermission_findservices->pluck('service_id'))->orderBy( 'id', 'Asc' )->get();
   }
   

   $checkpermission_utilityservices = DB::table( 'user_permission' )->where('user_id' , Auth::user()->id)->where('parent_id' , 1)->get();
   if(Auth::user()->user_type_id == 1){
    $utilityservices = DB::table( 'utility_services' )->where('status','Active')->orderBy( 'id', 'Asc' )->get();
  }else{
    $utilityservices = DB::table( 'utility_services' )->where('status','Active')->whereIn('id',$checkpermission_utilityservices->pluck('service_id'))->orderBy( 'id', 'Asc' )->get();
  }
  

  $checkpermission1 = DB::table( 'user_permission' )->where('user_id',$userid)->where('parent_id',1)->get();
  $checkpermission2 = DB::table( 'user_permission' )->where('user_id',$userid)->where('parent_id',2)->get();
  $checkpermission3 = DB::table( 'user_permission' )->where('user_id',$userid)->where('parent_id',3)->get();
  return view( 'permission.userpermission',compact('userid','services','findservices','utilityservices','checkpermission1','checkpermission2','checkpermission3'));
}
    //1 - Utility
    //2 - PDF
    //3 - Services
public function savepermission(Request $request){
  $userid = $request->user_id;
  $services = DB::table( 'user_permission' )->where('user_id',$userid)->delete();
  foreach(request()->service_id as $serviceid) {
    $val = explode('_',$serviceid);
    $service_id = $val[0];
    $parent_id = $val[1];

    DB::table('user_permission')->insert([
      'user_id'          => $request->user_id,
      'parent_id'    => $parent_id,
      'service_id'      => $service_id,
      'date'        => date("y-m-d H:i:s")
    ]);
  }
  return redirect('/userpermission/'.$userid)->with('success','Permission Updated Successfully');
}
}