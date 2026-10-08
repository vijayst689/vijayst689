<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NalavariyamWalletController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->restrictIfNotActivated();
            return $next($request);
        });
        // $this->middleware(function ($request, $next) {
        //     $this->restrictIfSitePaymentDueFromSession();
        //     return $next($request);
        // });
        $this->middleware('auth');
    }
    public function index()
    {
        $userid = Auth::user()->id;

        if (Auth::user()->user_type_id == 1) {

            $raviewamount = DB::table('nalavariyampayment')->where('to_id', $userid)->orderBy('id', 'desc')->get();
        } elseif (Auth::user()->user_type_id == 2) {

            $raviewamount = DB::table('nalavariyampayment')->where('to_id', 2)->orderBy('id', 'desc')->get();
        }
        return view('nalavariyampayment.index', compact('raviewamount'));
    }

    public function nalavariyam_request()
    {

        $request = DB::table('nalavariyam_request')->orderBy('id', 'desc')->get();
        return view('nalavariyampayment.request', compact('request'));
    }

    public function addMoney(Request $request)
    {

        // $filename = null;
        // if ($request->hasFile('proof')) {
        //     // Get just the extension
        //     $extension = $request->file('proof')->getClientOriginalExtension(); // e.g., "jpg"

        //     // Create a new filename using timestamp + extension
        //     $filename = time() . '.' . $extension;

        //     // Move file to public/uploads
        //     $request->file('proof')->move(public_path('upload/nalavariyamamount'), $filename);
        // }

        // DB::table('nalavariyam_request')->insert([
        //     'from_id'   => 2,
        //     'to_id'     => 1,
        //     'amount'    => $request->amount,
        //     'status'    => 'Pending',
        //     'req_date'  => date("Y-m-d"),
        //     'req_time'  => date("H:i:s"),
        //     'file'  => $filename,
        // ]);
          DB::table( 'wallet_topup_nalavariyam' )->insert( [
          'user_id'        => Auth::user()->id,
          'website_index'  => env( 'WEBSITE_INDEX', '' ),
          'payment'        => $request->amount,
          'date'            => date("Y-m-d H:i:s"),
          'status'          => 'Pending',
    ] );
    
    $insertid = DB::getPdo()->lastInsertId();

    $proof = '';

if ($request->hasFile('proof')) {

    $proof = uniqid() . '.' . $request->file('proof')->extension();

    $filepath = public_path('upload/nalavariyamamount/');

    if (!file_exists($filepath)) {
        mkdir($filepath, 0777, true);
    }

    $request->file('proof')->move($filepath, $proof);
}

DB::table('wallet_topup_nalavariyam')
    ->where('id', $insertid)
    ->update([
        'payment_proof' => $proof,
    ]);

    $getdata = DB::table( 'wallet_topup_nalavariyam' )->where('id',$insertid)->first();
    if($getdata){
     $payment = $getdata->payment;
     $status = $getdata->status;
     $url = url('/');
     $proof = $url.'/upload/nalavariyamamount/'.$proof;
     $API_KEY = env( 'API_KEY', '' );
     $RAMJIPAY_URL = env( 'RAMJIPAY_URL', '' );
     $WEBSITE_INDEX = env( 'WEBSITE_INDEX', '' );
     $ch = curl_init();

     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&proof=$proof&payment=$payment&rowid=$insertid&status=$status";

    // dd($post_data);
     $url1 = $RAMJIPAY_URL.'/api/approve_payment_nalavariyam';
  //echo $url1;die;
     curl_setopt( $ch, CURLOPT_URL, $url1 );
     curl_setopt( $ch, CURLOPT_POST, 1 );
     curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_data );
     curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
     $server_output = curl_exec( $ch );
     curl_close( $ch );
     $resdata = json_decode($server_output, true);
     //dd($resdata);
       }
      return redirect()->back()->with('success', 'Payment Updated Successfully ... !');
    }

    public function decline($toid)
    {

        $sql = "update nalavariyam_request set status = 'Declined' where id = $toid";
        DB::update(DB::raw($sql));

        return redirect()->back()->with('success', 'Request Amount Declined Successfully');
    }

    public function approve(Request $request)
    {
        $request_id = $request->request_id;
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $status = 'Approved';
        $sql = "update nalavariyam_request set status = '$status' where id = $request_id";
        DB::update(DB::raw($sql));
        $getwallet = DB::table('users')->select('nalavariyamwallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->nalavariyamwallet;
        }
        $newBalance = $balance + $request->amount;

        $ad_info = 'Nalavariyam Wallet Add Money';
        $service_status = 'In Payment';
        $time = date('H:i:s');
        $date = date('Y-m-d');
        DB::table('nalavariyampayment')->insert([
            'log_id'        => 2,
            'from_id'       => 1,
            'to_id'         => 2,  // fixed value
            'amount'        => $request->amount,
            'ad_info'       => $ad_info,
            'service_status' => $service_status,
            'time'          => $time,
            'paydate'       => $date,
            'pay_id'        => 1, // fixed value
            'newbalance'    => $newBalance,
        ]);

        $sql = "update users set nalavariyamwallet = nalavariyamwallet + $request->amount where id = 2";
        DB::update(DB::raw($sql));


        return redirect()->back()->with('success', 'Request Amount Approved Successfully');
    }
}
