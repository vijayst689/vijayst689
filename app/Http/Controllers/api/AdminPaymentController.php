<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class AdminPaymentController extends Controller
{
    public function updateadminpayment(Request $request)
    {

        $API_KEY = env('API_KEY', '');
        $WEBSITE_INDEX = env('WEBSITE_INDEX', '');
        $key = $request->key;
        $index = $request->index;
        $response = array();
        $message = "";
        if ($key == $API_KEY && $index == $WEBSITE_INDEX) {
            $parentId = $request->parent_id;
            $payments = $request->data;
            $tablename = $request->table;
            $type = $request->type;

            if($tablename == 'service_payment'){
            foreach ($payments as $payment) {
                DB::table('service_payment')
                    //->where('parent_id', $parentId)
                    ->where('ramjiservice_id', $payment['service_id'])
                    ->update([
                        'admin_amount' => $payment['othersite_amount'],
                    ]);
            }
        }else{
            foreach ($payments as $payment) {
                DB::table($tablename)
                    ->where('ramjiservice_id', $payment['service_id'])
                    ->update([
                        'amount' => $payment['othersite_amount'],
                    ]);
            }
        }
            $status = "Success";
            $message = "Payment Updated Successfully";
        } else {
            $status = "Failed";
            $message = "Invalid API Key";
        }
        $response["message"] = $message;
        $response["status"] = $status;
        $response["type"] = $type;
        return response()->json($response);
    }
}
