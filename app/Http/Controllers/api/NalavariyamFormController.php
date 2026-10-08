<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class NalavariyamFormController extends Controller
{
    public function store_nalavariyamform_application(Request $request)
{
    $data = $request->input('data');
    $key = $request->input('key');
    $index = $request->input('index');

    

    $API_KEY = env('API_KEY', '');
    $response = [];
    $message = '';

    if ($key != $API_KEY) {
        return response()->json([
            'status' => 'Failed',
            'message' => 'Invalid API Key'
        ]);
    }

    $getdata = DB::table('website_data')->where('index', $index)->first();
    $website_name = $getdata ? $getdata->website_name : '';

    try {

       DB::table('nalavariyam_form')->updateOrInsert(
    ['apiid' => $data['id']], // 🔹 Condition to check existing record
    [
        'apistatus'              => 1,
        'website_name'           => $website_name,
        'website_index'          => $index,
        'customer_id'            => 0,
        'dist_id'                => $data['dist_id'] ?? null,
        'taluk_id'               => $data['taluk_id'] ?? null,
        'user_type_id'           => $data['user_type_id'] ?? null,
        'amount'                 => $data['amount'] ?? null,
        'service_id'             => $data['service_id'] ?? null,
        'customer_user_type_id'  => $data['customer_user_type_id'] ?? null,
        'service_status'         => $data['service_status'] ?? null,
        'time'                   => $data['time'] ?? date('H:i:s'),
        'date'                   => $data['date'] ?? date('Y-m-d'),
        'from_image'             => $data['from_image'] ?? '',
        'log_id'                 => 0,
        'online_status'          => $data['online_status'] ?? 0,
    ]
);

        return response()->json([
            'status' => 'Success',
            'message' => 'Application stored successfully',
            
        ], 200);

    } catch (\Exception $e) {
        return response()->json([
            'status' => 'Failure',
            'message' => 'Error inserting data',
            'error' => $e->getMessage()
        ], 500);
    }
}
}
