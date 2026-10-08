<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class WalletApiController extends Controller
{

    public function approve_payment(Request $request){
        //return response($request);
        $API_KEY = env('API_KEY','');
        $key = $request->key;
        $response = array();
        $message = "";
        if($key == $API_KEY){
            $index = $request->index;
            $getdata = DB::table( 'website_data' )->where('index',$index)->first();
            $website_name = "";
            if($getdata){
                $website_name = $getdata->website_name;
            }

            DB::table( 'wallet_topup_api' )->insert( [

             'row_id'             => $request->rowid,
             'website_index'      => $request->index,
             'website_name'       => $website_name,
             'payment'            => $request->payment,
             'date'               => date("Y-m-d H:i:s"),
             'payment_proof'      => $request->payment_proof,
             'status'             => $request->status,
         ]);
            $message = "Success";
        }else{
            $message = "Access Denied";
        }
        $response["message"] = $message;
        return response()->json($response);
    }

    public function getadmin_wallet(Request $request)
    {
        $API_KEY = env('API_KEY', '');
        $key = $request->key;

        $response = [
            'message' => '',
            'data' => null
        ];

        if ($key === $API_KEY) {
            $data = DB::table('users')
            ->select( 'rawallet')
            ->where('id', 2)
            ->first();

            if ($data) {
                $response['message'] = "Success";
                $response['data'] = $data;
            } else {
                $response['message'] = "Admin not found";
            }
        } else {
            $response['message'] = "Access Denied";
        }

        return response()->json($response);
    }

    public function update_ramji_wallet(Request $request)
    {
        $API_KEY = env('API_KEY', '');
        $key = $request->key;

        $response = [
            'message' => '',
        ];

        if ($key === $API_KEY) {
            $amount = $request->amount;
            $context = $request->context;
            $date = date( 'Y-m-d' );
            $time = date( 'H:i:s' );

            $service_status = 'Out Payment';
            $getrawallet = DB::table( 'users' )->select('rawallet')->where('id',1)->first();
            $balance1 = 0;
            if($getrawallet){
                $balance1 = $getrawallet->rawallet;
            }

            $getrawallet1 = DB::table( 'users' )->select('rawallet')->where('id',2)->first();
            $balance2 = 0;
            if($getrawallet1){
                $balance2 = $getrawallet1->rawallet;
            }
            $newbalance2 = $balance1 + $amount;
            $newbalance3 = $balance2 - $amount;
            //return response($request);
            $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$amount','$context', '$service_status','$time','$date','2','$newbalance3')";
            DB::insert( DB::raw( $sql ) );
            $sql = "update users set rawallet = rawallet + $amount where id = 1";
            DB::update( DB::raw( $sql ) );
            $service_status = 'IN Payment';

            $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$amount','$context', '$service_status','$time','$date','2','$newbalance2')";
            DB::insert( DB::raw( $sql ) );
            $sql = "update users set rawallet = rawallet - $amount where id = 2";
            DB::update( DB::raw( $sql ) );
            $response['message'] = "Success";
        } else {
            $response['message'] = "Access Denied";
        }

        return response()->json($response);
    }

   public function update_nalavariyamform_payment(Request $request)
    {
        $API_KEY = env('API_KEY', '');
        $key = $request->key;

        $response = [
            'message' => '',
        ];
        if ($key === $API_KEY) {
            $amount = $request->amount;
            $superadminamount = $request->superadminamount;
            $context = $request->context;
            $date = date( 'Y-m-d' );
            $time = date( 'H:i:s' );


            $getrawallet = DB::table( 'users' )->select('nalavariyamwallet')->where('id',1)->first();
            $balance1 = 0;
            if($getrawallet){
                $balance1 = $getrawallet->nalavariyamwallet;
            }

            $getrawallet1 = DB::table( 'users' )->select('nalavariyamwallet','wallet')->where('id',2)->first();
            $balance2 = 0;
            if($getrawallet1){
                $balance2 = $getrawallet1->nalavariyamwallet;
                $balance = $getrawallet1->wallet;
            }
            $newbalance2 = $balance1 + $superadminamount;
            $newbalance3 = $balance2 - $superadminamount;
            $newbalance = $balance + $amount;


            $sql = "update users set wallet = wallet + $amount where id = 2";
            DB::update( DB::raw( $sql ) );
            $service_status = 'IN Payment';
            $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('0','2','0','$amount','$context', '$service_status','$time','$date','0','$newbalance')";
            DB::insert( DB::raw( $sql ) );



            //return response($request);
             $service_status = 'Out Payment';
            $sql = "insert into nalavariyampayment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$superadminamount','$context', '$service_status','$time','$date','2','$newbalance3')";
            DB::insert( DB::raw( $sql ) );
            $sql = "update users set nalavariyamwallet = nalavariyamwallet + $superadminamount where id = 1";
            DB::update( DB::raw( $sql ) );
            $service_status = 'IN Payment';

            $sql = "insert into nalavariyampayment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$superadminamount','$context', '$service_status','$time','$date','2','$newbalance2')";
            DB::insert( DB::raw( $sql ) );
            $sql = "update users set nalavariyamwallet = nalavariyamwallet - $superadminamount where id = 2";
            DB::update( DB::raw( $sql ) );
            $response['message'] = "Success";
        } else {
            $response['message'] = "Access Denied";
        }

        return response()->json($response);
    }


    public function update_activation_payment(Request $request)
    {
        $API_KEY = env('API_KEY', '');
        $key = $request->key;

        $response = [
            'message' => '',
        ];
        if ($key === $API_KEY) {
            $amount = $request->amount;
            $superadminamount = $request->superadminamount;
            $context = $request->context;
            $context1 = $request->context1;
            $date = date( 'Y-m-d' );
            $time = date( 'H:i:s' );


            $getrawallet = DB::table( 'users' )->select('rawallet')->where('id',1)->first();
            $balance1 = 0;
            if($getrawallet){
                $balance1 = $getrawallet->rawallet;
            }

            $getrawallet1 = DB::table( 'users' )->select('rawallet','wallet')->where('id',2)->first();
            $balance2 = 0;
            if($getrawallet1){
                $balance2 = $getrawallet1->rawallet;
                $balance = $getrawallet1->wallet;
            }
            $newbalance2 = $balance1 + $superadminamount;
            $newbalance3 = $balance2 - $superadminamount;
            $newbalance = $balance + $amount;


            $sql = "update users set wallet = wallet + $amount where id = 2";
            DB::update( DB::raw( $sql ) );
            $service_status = 'IN Payment';
            $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('0','2','0','$amount','$context1', '$service_status','$time','$date','0','$newbalance')";
            DB::insert( DB::raw( $sql ) );



            //return response($request);
             $service_status = 'Out Payment';
            $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$superadminamount','$context', '$service_status','$time','$date','2','$newbalance3')";
            DB::insert( DB::raw( $sql ) );
            $sql = "update users set rawallet = rawallet + $superadminamount where id = 1";
            DB::update( DB::raw( $sql ) );
            $service_status = 'IN Payment';

            $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$superadminamount','$context', '$service_status','$time','$date','2','$newbalance2')";
            DB::insert( DB::raw( $sql ) );
            $sql = "update users set rawallet = rawallet - $superadminamount where id = 2";
            DB::update( DB::raw( $sql ) );
            $response['message'] = "Success";
        } else {
            $response['message'] = "Access Denied";
        }

        return response()->json($response);
    }

    // district add panura time amount cut agurathu

public function update_district_payment(Request $request)
{
    $API_KEY = env('API_KEY');

    if ($request->key != $API_KEY) {
        return response()->json([
            'status' => false,
            'message' => 'Access Denied'
        ]);
    }

    $amount = $request->amount;
    $ad_info = $request->ad_info;

    DB::beginTransaction();

    try {

        $time = date('H:i:s');
        $date = date('Y-m-d');

        $admin = DB::table('users')->where('id',1)->first();
        $district = DB::table('users')->where('id',2)->first();

$adminBalance = $admin->nalavariyamwallet + $amount;
$districtBalance = $district->nalavariyamwallet - $amount;

DB::table('nalavariyampayment')->insert([
    'log_id' => 2,
    'from_id' => 1,
    'to_id' => 2,
    'amount' => $amount,
    'ad_info' => $ad_info,
    'service_status' => 'Out Payment',
    'time' => $time,
    'paydate' => $date,
    'pay_id' => 2,
    'newbalance' => $districtBalance
]);

DB::table('users')
    ->where('id', 1)
    ->increment('nalavariyamwallet', $amount);

DB::table('ramji_payment')->insert([
    'log_id' => 2,
    'from_id' => 2,
    'to_id' => 1,
    'amount' => $amount,
    'ad_info' => $ad_info,
    'service_status' => 'IN Payment',
    'time' => $time,
    'paydate' => $date,
    'pay_id' => 2,
    'newbalance' => $adminBalance
]);

DB::table('users')
    ->where('id', 2)
    ->decrement('nalavariyamwallet', $amount);

        DB::commit();

        return response()->json([
            'status' => true,
            'message' => 'Payment Updated Successfully'
        ]);

    } catch (\Exception $e) {

        DB::rollback();

        return response()->json([
            'status' => false,
            'message' => $e->getMessage()
        ]);
    }
}

// service Apply Comision payment

public function update_service_payment(Request $request)
    {
        $API_KEY = env('API_KEY', '');
        $key = $request->key;

        $response = [
            'message' => '',
        ];

        if ($key === $API_KEY) {

            $amount = $request->amount;
            $context = $request->context;
            $ramjiservice_id = $request->ramjiservice_id;
            $date = date( 'Y-m-d' );
            $time = date( 'H:i:s' );

            $getsuperadminamount = DB::table( 'service_payment' )->select('admin_amount')->where('ramjiservice_id',$ramjiservice_id)->first();
            $superadminamount = 0;
            if($getsuperadminamount){
                $superadminamount = $getsuperadminamount->admin_amount;
            }
           
            $getrawallet = DB::table( 'users' )->select('rawallet')->where('id',1)->first();
            $balance1 = 0;
            if($getrawallet){
                $balance1 = $getrawallet->rawallet;
            }

            $getrawallet1 = DB::table( 'users' )->select('rawallet','wallet')->where('id',2)->first();
            $balance2 = 0;
            if($getrawallet1){
                $balance2 = $getrawallet1->rawallet;
                $balance = $getrawallet1->wallet;
            }
            $newbalance2 = $balance1 + $superadminamount;
            $newbalance3 = $balance2 - $superadminamount;
            $newbalance = $balance + $amount; 


            $sql = "update users set wallet = wallet + $amount where id = 2";
            DB::update( DB::raw( $sql ) );
            $service_status = 'IN Payment';

            $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('0','2','0','$amount','$context', '$service_status','$time','$date','0','$newbalance')";
            DB::insert( DB::raw( $sql ) );
            


            //return response($request);
             $service_status = 'Out Payment';
            $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$superadminamount','$context', '$service_status','$time','$date','2','$newbalance3')";
            DB::insert( DB::raw( $sql ) );
            $sql = "update users set rawallet = rawallet + $superadminamount where id = 1";
            DB::update( DB::raw( $sql ) );
            $service_status = 'IN Payment';

            $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$superadminamount','$context', '$service_status','$time','$date','2','$newbalance2')";
            DB::insert( DB::raw( $sql ) );
            $sql = "update users set rawallet = rawallet - $superadminamount where id = 2";
            DB::update( DB::raw( $sql ) );
            $response['message'] = "Success";


        } else {
            $response['message'] = "Access Denied";
        }

        return response()->json($response);
    }

    // Refund

        public function refund_service_payment(Request $request)
    {
        $API_KEY = env('API_KEY', '');
        $key = $request->key;

        $response = [
            'message' => '',
        ];

        if ($key === $API_KEY) {

            $amount = $request->amount;
            $context = $request->context;
            $ramjiservice_id = $request->ramjiservice_id;
            $date = date( 'Y-m-d' );
            $time = date( 'H:i:s' );

            $getsuperadminamount = DB::table( 'service_payment' )->select('admin_amount')->where('ramjiservice_id',$ramjiservice_id)->first();
            $superadminamount = 0;
            if($getsuperadminamount){
                $superadminamount = $getsuperadminamount->admin_amount;
            }
           
            $getrawallet = DB::table( 'users' )->select('rawallet')->where('id',1)->first();
            $balance1 = 0;
            if($getrawallet){
                $balance1 = $getrawallet->rawallet;
            }

            $getrawallet1 = DB::table( 'users' )->select('rawallet','wallet')->where('id',2)->first();
            $balance2 = 0;
            if($getrawallet1){
                $balance2 = $getrawallet1->rawallet;
                $balance = $getrawallet1->wallet;
            }
            $newbalance2 = $balance1 - $superadminamount;
            $newbalance3 = $balance2 + $superadminamount;
            $newbalance = $balance - $amount; 


            $sql = "update users set wallet = wallet - $amount where id = 2";
            DB::update( DB::raw( $sql ) );
            $service_status = 'Out Payment';

            $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('0','2','0','$amount','$context', '$service_status','$time','$date','0','$newbalance')";
            DB::insert( DB::raw( $sql ) );
            


            //return response($request);
             $service_status = 'Out Payment';
              $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('1','2','1','$superadminamount','$context', '$service_status','$time','$date','2','$newbalance2')";
                DB::insert( DB::raw( $sql ) );
                $sql = "update users set rawallet = rawallet - $superadminamount where id = 1";
                DB::update( DB::raw( $sql ) );
                $service_status = 'IN Payment';
                $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('1','1','2','$superadminamount','$context', '$service_status','$time','$date','2','$newbalance3')";
                DB::insert( DB::raw( $sql ) );
                $sql = "update users set rawallet = rawallet + $superadminamount where id = 2";
                DB::update( DB::raw( $sql ) );

            $response['message'] = "Success";


        } else {
            $response['message'] = "Access Denied";
        }

        return response()->json($response);
    }

}
