<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class NotificationController extends Controller
{

  public function __construct()
  {
    $this->middleware(function ($request, $next) {
            $this->restrictIfNotActivated();
            return $next($request);
        });
    $this->middleware('auth');
  }
    public function addnotification()
    {
        return view('notification.addnotification');
    }

    public function viewnotification()
    {
        $userid = Auth::user()->id;

            $notify = DB::table('notification')->orderBy( 'id', 'Asc' )->get();

        return view('notification.viewnotification',compact('notify'));
    }

    public function savenotification(Request $request)
    {
      $userid = Auth::user()->id;
      $savenotification = DB::table('notification')->insert([
        'notify'        => $request->notify,
        'status'        => 'Active'
      ]);

      return redirect('/viewnotification')->with('success', 'Notification Add Successfully ... !');
    }

    public function updatenotification(Request $request)
    {
      $updateretailer = DB::table('notification')->where( 'id', $request->notify_id )->update([
        'notify'         => $request->notify,
      ]);

      return redirect('/viewnotification')->with('success', 'Notification Updated Successfully ... !');
    }

    public function dropnotification( $id ){

        $dropnotification = DB::table('notification')->where( 'id', $id )->delete();
     return redirect()->back()->with('success', 'Notification Deleted Successfully ... !');
    }

    public function notificationstatusupdate(Request $request)
    {
      $notificationstatusupdate = DB::table('notification')->where( 'id', $request->status_id )->update([
        'status'          => $request->status,
      ]);

      return redirect('/viewnotification')->with('success', 'Notification Status Updated Successfully ... !');
    }

}
