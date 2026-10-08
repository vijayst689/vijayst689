<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SitePaymentController extends Controller
{
    public function update_site_payments(Request $request)
{
    $API_KEY       = env('API_KEY','');
    $WEBSITE_INDEX = env('WEBSITE_INDEX','');

    $data   = $request->input('data');
    $key    = $request->input('key');
    $index  = $request->input('index');

    $response = [];

    if ($key == $API_KEY && $index == $WEBSITE_INDEX) {
        if (!empty($data) && is_array($data)) {
            foreach ($data as $row) {
                DB::table('sitepayment')->updateOrInsert(
                    [
                        'website_id'     => $row['website_id'] ?? 0,
                        'site_paymentid' => $row['site_paymentid'] ?? null,
                    ],
                    [
                        'type'            => $row['type'] ?? null,
                    'payment_reason'      => $row['reason'] ?? 0,
                        'amount'         => $row['amount'] ?? 0,
                        'payment_status' => $row['payment_status'] ?? null,
                        'paid_status'    => $row['paid_status'] ?? null,
                        'payment_date'   => $row['payment_date'] ?? null,
                        'updated_at'     => now()->toDateTimeString(),
                        'created_at'     => $row['created_at'] ?? now()->toDateTimeString(),
                    ]
                );
                if (!empty($row['payment_status']) && strtoupper($row['payment_status']) === 'PAID') {
                     DB::table('sitepayment')->where('site_paymentid', $row['site_paymentid'])->update([

                        'paid_status'    => 'Approved',
                    ]);
                }
            }

            $response['status']  = "Success";
            $response['message'] = "Site payments updated successfully.";
        } else {
            $response['status']  = "Failed";
            $response['message'] = "No data received.";
        }
    } else {
        $response['status']  = "Failed";
        $response['message'] = "Invalid API key or index.";
    }

    return response()->json($response);
}

public function update_sitepayment_status(Request $request){
    $API_KEY = env('API_KEY','');
    $WEBSITE_INDEX = env('WEBSITE_INDEX','');
    $key = $request->key;
    $index = $request->index;
    $response = array();
    $message = "";

    if($key == $API_KEY && $index == $WEBSITE_INDEX){
        $rowid = $request->site_paymentid;
        $status = $request->status;

        $nextMonth20 = Carbon::now()->addMonth()->startOfMonth()->addDays(19)->toDateString();
                    DB::table('sitepayment')->where('site_paymentid', $rowid)->update([

                        'paid_status'    => $status,
                    ]);
                   
        if($request->status == "Approved"){
              DB::table('sitepayment')->where('site_paymentid', $rowid)->update([

                        'payment_status'    => 'PAID',
                    ]);
                   
             DB::table('sitepayment')
                        ->where('payment_status', 'UNPAID')
                        ->update([
                            'updated_at'   => now(), // optional if you track updates
                        ]);
                         session()->forget('activePaymentId');
        }
        $message = "Success";
    }else{
        $message = "Access Denied";
    }
    $response["message"] = $message;
    $response["index"] = $index;
    return response()->json($response);
}
}