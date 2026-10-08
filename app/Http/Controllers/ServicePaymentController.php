<?php

namespace App\Http\Controllers;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use GuzzleHttp\Pool;

class ServicePaymentController extends Controller
{
  public function __construct()
  {
    $this->middleware(function ($request, $next) {
            $this->restrictIfNotActivated();
            return $next($request);
        });
    $this->middleware(function ($request, $next) {
        $this->restrictIfSitePaymentDueFromSession();
        return $next($request);
    });
    $this->middleware('auth');
  }

  public function servicepayment($serviceid){
    $services = DB::table('services')->where('status', 'Active')->where('parent_id',$serviceid )->orderBy( 'id' , 'Asc' )->get();
    $services = json_decode( json_encode( $services ), true );
    foreach ( $services as $key => $service ) {
      $services[ $key ][ 'payment' ] = array();
      $service_id = $service[ 'id' ];
      $payment = DB::table('service_payment')->where('service_id',$service_id)->get();
      if(count($payment) > 0){
        $services[ $key ][ 'payment' ] = $payment;
      }
       $admin_amount = 0;
       $payment1 = DB::table('service_payment')->where('service_id',$service_id)->get();
        $services[ $key ][ 'admin_amount' ] = 0;
       if(count($payment1) > 0){
        $services[ $key ][ 'admin_amount' ] = $payment1[0]->admin_amount;
      }
    }
    $services = json_decode( json_encode( $services ));
    //dd($services);
    return view('servicepayment.servicepayment',compact('services','serviceid'));
  }


  public function addservice_payment(Request $request){
     $parent_id = is_array($request->parent_id) ? $request->parent_id[0] : $request->parent_id;
      if ($request->has('service_id')) {
    foreach ($request->service_id as $key => $payment) {
        $name = 'check_' . $payment;
        $pre = $request[$name] ?? 0;

        $coordinator_permission = $pre == '1' ? 1 : 0;
        $parent_id = $request->parent_id[$key];
        $ramjiservice_id = $request->ramjiservice_id[$key];
        $distributor_amount = $request->distributor_amount[$key];
        $retailer_amount = $request->retailer_amount[$key];
        $admin_amount = $request->admin_amount[$key];

        DB::table('service_payment')->updateOrInsert(
            [
                'parent_id'  => $parent_id,
                'service_id' => $payment, // condition to find existing
            ],
            [
                'ramjiservice_id'       => $ramjiservice_id,
                'admin_amount'          => $admin_amount,
                'distributor_amount'    => $distributor_amount,
                'retailer_amount'       => $retailer_amount,
                'coordinator_permission'=> $coordinator_permission,
                'othersite_amount' => $request->othersite_amount[$key] ?? 0,

                // 'othersite_amount'      => $request->othersite_amount[$key],
            ]
        );
    }
}
    // 3. Get websites and payment data
        $getwebsitedata = DB::table('website_data')->get();
        $getotheradminpayment = DB::table('service_payment')
            ->select('othersite_amount', 'service_id')
            ->where('othersite_amount', '!=', 0)
            ->get();

        $client      = new Client(['timeout' => 15, 'connect_timeout' => 5]);
        $maxRetries  = 3;
        $baseDelay   = 1000; // ms
        $concurrency = 15;   // safe for 100+ sites

        // Insert pending logs before sending requests
        $refs = [];
        foreach ($getwebsitedata as $webdata) {
            $ref = uniqid();
            $refs[$webdata->website_link] = $ref;
            DB::table('service_payment_logs')->insert([
                'parent_id'  => $parent_id,
                'website'    => $webdata->website_link,
                'status'     => 'pending',
                'type'       => null,
                'ref'       => $ref,
                'retries'    => 0,
                'response'   => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 4. Async requests
        $requests = function () use ($getwebsitedata, $getotheradminpayment, $parent_id, $maxRetries, $baseDelay, $client,$refs) {
            foreach ($getwebsitedata as $webdata) {
                $url = $webdata->website_link . '/api/updateadminpayment';
                $ref = $refs[$webdata->website_link];
                $post_data = [
                    'json' => [
                        'data'      => $getotheradminpayment,
                        'key'       => env('API_KEY', ''),
                        'index'     => $webdata->index,
                        'parent_id' => $parent_id,
                        'table'     => 'service_payment',
                        'type'     => 'service',
                        'ref'     => $ref,
                    ],
                    'headers' => ['Accept' => 'application/json']
                ];
                // dd($post_data);
                yield function () use ($client, $url, $post_data, $webdata, $maxRetries, $baseDelay, $parent_id,$ref) {
                    return $this->sendWithRetryAsync($client, $url, $post_data, $webdata, $maxRetries, $baseDelay, $parent_id,1,$ref);
                };
            }
        };

        // 5. Guzzle Pool
        $pool = new Pool($client, $requests(), [
            'concurrency' => $concurrency,
        ]);
        $pool->promise()->wait();

        return back()->with('success', "Service Payment Updated Successfully!");
    }
public function showSummary()
  {

    return view('servicepayment.summary');
  }
    // Fetch logs for AJAX
    public function fetchLogs()
    {
        try {
            $logs = DB::table('service_payment_logs')
                ->orderBy('id')
                ->get();

            // Return JSON with status
            return response()->json([
                'status' => true,
                'data'   => $logs
            ]);
        } catch (\Exception $e) {
            // Return JSON error instead of HTML
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // Async retry
    private function sendWithRetryAsync(
    $client,
    $url,
    $options,
    $webdata,
    $maxRetries = 3,
    $baseDelay = 1000,
    $parent_id,
    $attempt = 1,
    $ref = null
) {
    return $client->postAsync($url, array_merge($options, [
        'delay' => (int)$baseDelay * ((int)$attempt - 1),
    ]))
    ->then(
        function ($response) use ($webdata, $parent_id, $attempt, $ref) {
            // Decode response safely
            $resdata = json_decode($response->getBody(), true);
            $message = $resdata['message'] ?? null;
            $type    = $resdata['type'] ?? null;
            $remoteRef = $resdata['ref'] ?? null; // keep separate
            $status  = (!empty($resdata['status']) && strtolower($resdata['status']) === 'success')
                        ? 'success'
                        : 'failed';

            // Use the original $ref (not the returned one)
            DB::table('service_payment_logs')
                ->where('website', $webdata->website_link)
                ->where('ref', $ref)
                ->update([
                    'status'     => $status,
                    'type'       => $type,
                    'retries'    => $attempt - 1,
                    'response'   => $message,
                    'updated_at' => now(),
                ]);
        },
        function ($exception) use ($client, $url, $options, $webdata, $maxRetries, $baseDelay, $parent_id, $attempt, $ref) {
            // Retry logic
            if ($maxRetries > 1) {
                return $this->sendWithRetryAsync(
                    $client,
                    $url,
                    $options,
                    $webdata,
                    $maxRetries - 1,
                    $baseDelay,
                    $parent_id,
                    $attempt + 1,
                    $ref // keep the same ref for all retries
                );
            }

            // Final failure update
            DB::table('service_payment_logs')
                ->where('website', $webdata->website_link)
                ->where('ref', $ref)
                ->update([
                    'status'     => 'failed',
                    'type'       => null,
                    'retries'    => $attempt - 1,
                    'response'   => $exception->getMessage(),
                    'updated_at' => now(),
                ]);
        }
    );
}
  public function smartcardpayment($serviceid){
    $services = DB::table('services')->where('status', 'Active')->where('parent_id', $serviceid )->orderBy( 'id' , 'Asc' )->get();
    $taluk = DB::table('taluk')->orderBy( 'id' , 'Asc' )->get();
    return view('servicepayment.smartcardpayment',compact('services','serviceid','taluk'));
  }

  public function savesmart_payment(Request $request){
    // dd($request->all());
   DB::table('smartcard_payment')->updateOrInsert(
    [
        'parent_id'  => $request->parent_id,
        'service_id' => $request->serviceid,
        'taluk_id'   => $request->taluk_id,
    ],
    [
        'distributor_amount' => $request->distributor_amount,
        'retailer_amount'    => $request->retailer_amount,
        'customer_amount'    => $request->customer_amount,
        'admin_amount'       => $request->admin_amount,
    ]
);

return redirect('smartcardpayment/'.$request->parent_id)->with('success' ,"SmartCard Payment Updated Succesfully !") ;
  }

   public function get_smartcard_payment($talukid,$serviceid){
    $response = DB::table('smartcard_payment')->where('service_id', $serviceid )->where('taluk_id', $talukid )->first();

    return response()->json( $response );
  }

public function findpayment(){
    $services = DB::table('find_services')->where('status', 'Active')->orderBy( 'id' , 'Asc' )->get();
    $services = json_decode( json_encode( $services ), true );
    foreach ( $services as $key => $service ) {
      $services[ $key ][ 'payment' ] = array();
      $service_id = $service[ 'id' ];

      $payment = DB::table('find_payment')->where('service_id',$service_id)->get();
      if(count($payment) > 0){
        $services[ $key ][ 'payment' ] = $payment;
      }
    }
    $services = json_decode( json_encode( $services ));
    return view('servicepayment.findpayment',compact('services'));
  }

  public function addfind_payment(Request $request){
     $parent_id = is_array($request->parent_id) ? $request->parent_id[0] : $request->parent_id;
  if ($request->has('parent_id')) {
    foreach ($request->parent_id as $key => $payment) {
        $service_id         = $request->service_id[$key];
        $ramjiservice_id         = $request->ramjiservice_id[$key];
        $distributor_amount = $request->distributor_amount[$key];
        $retailer_amount    = $request->retailer_amount[$key];

        DB::table('find_payment')->updateOrInsert(
            [
                'parent_id'  => $payment,
                'service_id' => $service_id,
            ],
            [
                'ramjiservice_id'       => $ramjiservice_id,
                'distributor_amount' => $distributor_amount,
                'retailer_amount'    => $retailer_amount,
                'othersite_amount'      => $request->othersite_amount[$key],
            ]
        );
    }
}

// 3. Get websites and payment data
        $getwebsitedata = DB::table('website_data')->get();
        $getotheradminpayment = DB::table('find_payment')
            ->select('othersite_amount', 'ramjiservice_id')
            ->where('othersite_amount', '!=', 0)
            ->get();

        $client      = new Client(['timeout' => 15, 'connect_timeout' => 5]);
        $maxRetries  = 3;
        $baseDelay   = 1000; // ms
        $concurrency = 15;   // safe for 100+ sites

        // Insert pending logs before sending requests
        $refs = [];
        foreach ($getwebsitedata as $webdata) {
            $ref = uniqid();
            $refs[$webdata->website_link] = $ref;
            DB::table('service_payment_logs')->insert([
                'parent_id'  => $parent_id,
                'website'    => $webdata->website_link,
                'status'     => 'pending',
                'type'       => null,
                'ref'       => $ref,
                'retries'    => 0,
                'response'   => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 4. Async requests
        $requests = function () use ($getwebsitedata, $getotheradminpayment, $parent_id, $maxRetries, $baseDelay, $client,$refs) {
            foreach ($getwebsitedata as $webdata) {
                $url = $webdata->website_link . '/api/updateadminpayment';
                $ref = $refs[$webdata->website_link];
                $post_data = [
                    'json' => [
                        'data'      => $getotheradminpayment,
                        'key'       => env('API_KEY', ''),
                        'index'     => $webdata->index,
                        'parent_id' => $parent_id,
                        'table'     => 'find_services',
                        'type'     => 'PDF',
                        'ref'     => $ref,
                    ],
                    'headers' => ['Accept' => 'application/json']
                ];
                yield function () use ($client, $url, $post_data, $webdata, $maxRetries, $baseDelay, $parent_id,$ref) {
                    return $this->sendWithRetryAsync($client, $url, $post_data, $webdata, $maxRetries, $baseDelay, $parent_id,1,$ref);
                };
            }
        };

        // 5. Guzzle Pool
        $pool = new Pool($client, $requests(), [
            'concurrency' => $concurrency,
        ]);
        $pool->promise()->wait();

        return back()->with('success', "Service Payment Updated Successfully!");

  }

  public function rechargepayment($serviceid){
    $services = DB::table('operator')->where('status', 'Active')->where('service_type',$serviceid)->orderBy( 'id' , 'Asc' )->get();
    $services = json_decode( json_encode( $services ), true );
    foreach ( $services as $key => $service ) {
      $services[ $key ][ 'payment' ] = array();
      $service_id = $service[ 'id' ];

    //   print_r( $service_id );die();

      $payment = DB::table('recharge_payment')->where('service_id',$service_id)->get();
      if(count($payment) > 0){
        $services[ $key ][ 'payment' ] = $payment;
      }
    }
    $services = json_decode( json_encode( $services ));
    return view('servicepayment.rechargepayment',compact('services','serviceid'));
  }
  public function panservicepayment(){
    $services = DB::table('panservice')->where('status', 'Active')->orderBy( 'id' , 'Asc' )->get();
    $services = json_decode( json_encode( $services ), true );
    foreach ( $services as $key => $service ) {
      $services[ $key ][ 'payment' ] = array();
      $service_id = $service[ 'id' ];

    //   print_r( $service_id );die();

      $payment = DB::table('panpayment')->where('service_id',$service_id)->get();
      if(count($payment) > 0){
        $services[ $key ][ 'payment' ] = $payment;
      }
    }
    $services = json_decode( json_encode( $services ));
    return view('servicepayment.panservicepayment',compact('services'));
  }

  public function addpan_payment(Request $request){
     $parent_id = is_array($request->parent_id) ? $request->parent_id[0] : $request->parent_id;
    if ($request->has('parent_id')) {
    foreach ($request->parent_id as $key => $payment) {
        $service_id         = $request->service_id[$key];
        $ramjiservice_id         = $request->ramjiservice_id[$key];
        $distributor_amount = $request->distributor_amount[$key];
        $retailer_amount    = $request->retailer_amount[$key];

        DB::table('panpayment')->updateOrInsert(
            [
                'parent_id'  => $payment,
                'service_id' => $service_id,
            ],
            [
                'ramjiservice_id'       => $ramjiservice_id,
                'distributor_amount' => $distributor_amount,
                'retailer_amount'    => $retailer_amount,
                'othersite_amount'      => $request->othersite_amount[$key],
            ]
        );
    }
}
    // 3. Get websites and payment data
        $getwebsitedata = DB::table('website_data')->get();
        $getotheradminpayment = DB::table('panpayment')
            ->select('othersite_amount', 'ramjiservice_id')
            ->where('othersite_amount', '!=', 0)
            ->get();
        $client      = new Client(['timeout' => 15, 'connect_timeout' => 5]);
        $maxRetries  = 3;
        $baseDelay   = 1000; // ms
        $concurrency = 15;   // safe for 100+ sites

        // Insert pending logs before sending requests
        $refs = [];
        foreach ($getwebsitedata as $webdata) {
            $ref = uniqid();
            $refs[$webdata->website_link] = $ref;
            DB::table('service_payment_logs')->insert([
                'parent_id'  => $parent_id,
                'website'    => $webdata->website_link,
                'status'     => 'pending',
                'type'       => null,
                'ref'       => $ref,
                'retries'    => 0,
                'response'   => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 4. Async requests
        $requests = function () use ($getwebsitedata, $getotheradminpayment, $parent_id, $maxRetries, $baseDelay, $client,$refs) {
            foreach ($getwebsitedata as $webdata) {
                $url = $webdata->website_link . '/api/updateadminpayment';
                $ref = $refs[$webdata->website_link];
                $post_data = [
                    'json' => [
                        'data'      => $getotheradminpayment,
                        'key'       => env('API_KEY', ''),
                        'index'     => $webdata->index,
                        'parent_id' => $parent_id,
                        'table'     => 'panservice',
                        'type'     => 'PDF',
                        'ref'     => $ref,
                    ],
                    'headers' => ['Accept' => 'application/json']
                ];
                yield function () use ($client, $url, $post_data, $webdata, $maxRetries, $baseDelay, $parent_id,$ref) {
                    return $this->sendWithRetryAsync($client, $url, $post_data, $webdata, $maxRetries, $baseDelay, $parent_id,1,$ref);
                };
            }
        };

        // 5. Guzzle Pool
        $pool = new Pool($client, $requests(), [
            'concurrency' => $concurrency,
        ]);
        $pool->promise()->wait();

        return back()->with('success', "Service Payment Updated Successfully!");
  }

  public function coursepayment(){
    $services = DB::table('courses')->where('status', 'Active')->orderBy( 'id' , 'Asc' )->get();
    $services = json_decode( json_encode( $services ), true );
    foreach ( $services as $key => $service ) {
      $services[ $key ][ 'payment' ] = array();
      $service_id = $service[ 'id' ];

    //   print_r( $service_id );die();

      $payment = DB::table('coursepayment')->where('service_id',$service_id)->get();
      if(count($payment) > 0){
        $services[ $key ][ 'payment' ] = $payment;
      }
    }
    $services = json_decode( json_encode( $services ));
    return view('servicepayment.coursepayment',compact('services'));
  }

  public function addcourse_payment(Request $request){
   if ($request->has('parent_id')) {
    foreach ($request->parent_id as $key => $payment) {
        $service_id         = $request->service_id[$key];
        $admin_amount       = $request->admin_amount[$key];
        $distributor_amount = $request->distributor_amount[$key];
        $retailer_amount    = $request->retailer_amount[$key];
        $customer_amount    = $request->customer_amount[$key];

        DB::table('coursepayment')->updateOrInsert(
            [
                'parent_id'  => $payment,
                'service_id' => $service_id,
            ],
            [
                'admin_amount'       => $admin_amount,
                'distributor_amount' => $distributor_amount,
                'retailer_amount'    => $retailer_amount,
                'customer_amount'    => $customer_amount,
            ]
        );
    }
}

return redirect('coursepayment')->with('success' ,"Course Payment Updated Succesfully !");
  }

 public function useractivation($activation_id)
{
    // Get all saved payments once (FAST)
    $payments = DB::table('useractivation')
        ->where('parent_id', $activation_id)
        ->get()
        ->keyBy('service_id');

    if ($activation_id == 3) {

        $services = DB::table('services')
            ->select('services.*', 'services.service_name as name')
            ->where('parent_id', 0)
            ->where('status', 'Active')
            ->where('id', '!=', 6)
            ->orderBy('id', 'Asc')
            ->get();

        foreach ($services as $service) {

            $service->activation_id = 3;

            // Main payment
            $service->payment = $payments[$service->id] ?? null;

            // Sub services
            $children = $this->getSubServices($service->id);

            foreach ($children as $child) {
                $child->activation_id = 3;
                $child->payment = $payments[$child->id] ?? null;
            }

            $service->children = $children;
        }

    } elseif ($activation_id == 2) {

        $services = DB::table('utility_services')->where('status','Active')->get();
        foreach ($services as $service) {
            $service->activation_id = 2;
            $service->payment = $payments[$service->id] ?? null;
        }

    } elseif ($activation_id == 1) {

        $services = DB::table('find_services')->where('status','Active')->get();
        foreach ($services as $service) {
            $service->activation_id = 1;
            $service->payment = $payments[$service->id] ?? null;
        }

    } elseif ($activation_id == 4) {

        $services = DB::table('panservice')->where('status','Active')->get();
        foreach ($services as $service) {
            $service->activation_id = 4;
            $service->payment = $payments[$service->id] ?? null;
        }

    }

    return view('servicepayment.useractivation', [
        'services'       => $services,
        'activation_id'  => $activation_id,
        'user_id'  => Auth::id(),
    ]);
}
private function getSubServices($parent_id)
{
    $subs = DB::table('services')
        ->where('parent_id', $parent_id)
        ->where('status', 'Active')
        ->orderBy('id', 'ASC')
        ->get();

    foreach ($subs as $sub) {
        $sub->children = $this->getSubServices($sub->id);
    }

    return $subs;
}


  public function adduser_activation(Request $request)
{
    // ✅ Validate request
    $request->validate([
        'parent_id' => 'required|array',
        'user_id.*' => 'required|integer',
        'service_id.*' => 'required|integer',
        'admin_amount.*' => 'nullable|numeric',
        'distributor_amount.*' => 'nullable|numeric',
        'retailer_amount.*' => 'nullable|numeric',
    ], [
        'parent_id.required' => 'No services selected!',
    ]);

    $parentIds = $request->parent_id;

    // Wrap in transaction
    DB::transaction(function() use ($parentIds, $request) {

        // ✅ Special Rule: if ALL parent_id = 3, delete except service_id = 6
        if (count(array_unique($parentIds)) === 1 && $parentIds[0] == 3) {
            DB::table('useractivation')
                ->where('parent_id', 3)
                ->where('service_id', '!=', 6)
                ->delete();
        } else {
            DB::table('useractivation')
                ->whereIn('parent_id', $parentIds)
                ->delete();
        }

        $insertData = [];

        foreach ($parentIds as $key => $parent_id) {

            // Skip if any required value missing
            if (!isset($request->user_id[$key], $request->service_id[$key])) {
                continue;
            }

            $insertData[] = [
                'parent_id'          => $parent_id,
                'user_id'            => $request->user_id[$key],
                'service_id'         => $request->service_id[$key],
                'admin_amount'       => $request->admin_amount[$key] ?? 0,
                'distributor_amount' => $request->distributor_amount[$key] ?? 0,
                'retailer_amount'    => $request->retailer_amount[$key] ?? 0,
            ];
        }

        if (!empty($insertData)) {
            DB::table('useractivation')->insert($insertData);
        }
    });

    // Redirect back to the first parent id page
    $redirectParent = $parentIds[0];
    return redirect("useractivation/{$redirectParent}")
        ->with('success', "Payment Updated Successfully!");
}

  public function sitepayment(){
    $data = DB::table('sitepayment')->orderBy( 'payment_status' , 'Asc' )->get();

    return view('servicepayment.sitepayment',compact('data'));
  }

   public function save_sitepayment( Request $request ) {
    $status = 'Waiting';
    DB::table( 'sitepayment' )->where( 'id', $request->row_id )->update( [
      'paid_status'      =>  $status,
    ] );

    $insertid = $request->row_id;
    $payment_proof = '';
    if ( $request->payment_proof != null ) {
      $payment_proof = $insertid.'.'.$request->file( 'payment_proof' )->extension();
      $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'sitepayment_image' . DIRECTORY_SEPARATOR );
      move_uploaded_file( $_FILES[ 'payment_proof' ][ 'tmp_name' ], $filepath . $payment_proof );
    }
     DB::table( 'sitepayment' )->where( 'id', $insertid )->update( [
      'paid_image' => $payment_proof,
    ] );

    $getdata = DB::table( 'sitepayment' )->where('id',$insertid)->first();
    if($getdata){
     $site_paymentid = $getdata->site_paymentid;
     $website_id = $getdata->website_id;
     $url = url('/');
     $payment_proof = $url.'/upload/sitepayment_image/'.$payment_proof;
     $API_KEY = env( 'API_KEY', '' );
     $RAMJIPAY_URL = env( 'RAMJIPAY_URL', '' );
     $WEBSITE_INDEX = env( 'WEBSITE_INDEX', '' );
     $ch = curl_init();

     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&payment_proof=$payment_proof&site_paymentid=$site_paymentid&website_id=$website_id&status=$status";

    //dd($post_data);
     $url1 = $RAMJIPAY_URL.'/api/sitepayment_approve';
  //echo $url1;die;
     curl_setopt( $ch, CURLOPT_URL, $url1 );
     curl_setopt( $ch, CURLOPT_POST, 1 );
     curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_data );
     curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
     $server_output = curl_exec( $ch );
     curl_close( $ch );
     $resdata = json_decode($server_output, true);
       }
    return redirect()->back()->with('success', 'Payments saved successfully!');

}

}

