<?php

namespace App\Http\Controllers;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\JsonResponse;

use App\Services\SarathiScraperService;

class PDFServiceController extends Controller
{
    protected $scraperService;
  
  public function __construct(SarathiScraperService $scraperService)
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
    $this->scraperService = $scraperService;
  }

  public function addfindservice(){
    return view( 'panservice.addfindservice');
  }

  public function getpdf()
  {
    $getpdf = DB::table('rc')->where('status', 'RcApproved')->orderBy('id', 'Asc')->get();
    return view('pdfservice.getpdf', compact('getpdf'));
  }

  public function viewfind(){
    $find = DB::table( 'find_services' )->orderBy( 'id', 'Asc' )->get();
    return view( 'panservice.viewfind' ,compact('find'));
  }

  public function savefind( Request $request ) {
    DB::table( 'find_services' )->insert( [
      'name'        => $request->name,
      'amount'      => $request->amount,
      'ramjiservice_id'      => $request->ramjiservice_id,
      'date'        => date("Y-m-d H:i:s"),
      'status'      => 'Active',
    ] );

    $insertid = DB::getPdo()->lastInsertId();

    $ser_image = '';
    if ( $request->ser_image != null ) {
      $ser_image = $insertid.'.'.$request->file( 'ser_image' )->extension();
      $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'find_service' . DIRECTORY_SEPARATOR );
      move_uploaded_file( $_FILES[ 'ser_image' ][ 'tmp_name' ], $filepath . $ser_image );
    }
    $image = DB::table( 'find_services' )->where( 'id', $insertid )->update( [
      'ser_image' => $ser_image,
    ] );
    return redirect('/viewfind')->with('success', 'Find Service Added Successfully ... !');
  }

  public function updatefind( Request $request ) {
    DB::table( 'find_services' )->where('id', $request->findid)->update( [
      'name'     => $request->name,
      'amount'   => $request->amount,
      'ramjiservice_id'      => $request->ramjiservice_id,
    ] );

    if ( $request->ser_image != null ) {
      $ser_image = $request->findid.'.'.$request->file( 'ser_image' )->extension();
      $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'find_service' . DIRECTORY_SEPARATOR );
      move_uploaded_file( $_FILES[ 'ser_image' ][ 'tmp_name' ], $filepath . $ser_image );
      $image = DB::table( 'find_services' )->where( 'id', $request->findid )->update( [
        'ser_image' => $ser_image,
      ] );
    }

    return redirect()->back()->with( 'success', 'Find Service Updated Successfully' );
  }

  public function updatestatus( Request $request ) {
    DB::table( 'find_services' )->where('id', $request->statusid)->update( [
      'status'     => $request->status,
    ] );

    return redirect()->back()->with( 'success', 'Status Updated Successfully' );
  }

    public function pdfservices()
    {
        $usertype       = Auth::user()->user_type_id;
       $userId = Auth::id();

// Check if the user has service_id 71 or 125 with parent_id 3
$check = DB::table('user_permission')
    ->where('user_id', $userId)
    ->whereIn('service_id', [71, 125])
    ->where('parent_id', 3)
    ->exists();

// Fetch base user permissions for parent_id 1 once
$userPermission = DB::table('user_permission')
    ->where('user_id', $userId)
    ->where('parent_id', 1)
    ->pluck('service_id');

// Push 12 and 7 to the collection if the check passes
if ($check) {
    $userPermission->push(12, 6);
}

// Fetch admin permissions
$adminPermission = DB::table('user_permission')
    ->where('user_id', 2)
    ->where('parent_id', 1)
    ->pluck('service_id');

// Get the intersection of both collections
$finalServiceIds = $userPermission->intersect($adminPermission);

        $finalServiceIds = $userPermission->intersect($adminPermission);
        if (Auth::user()->user_type_id == 1 || Auth::user()->user_type_id == 5) {
            $service = DB::table('find_services')->where('status', 'Active')->orderBy('id', 'ASC')->get();
        } else {
            $service = DB::table('find_services')->where('status', 'Active')->whereIn('id', $finalServiceIds)->orderBy('id', 'ASC')->get();
        }

        $service = json_decode(json_encode($service), true);
        foreach ($service as $key => $s) {

            $serviceid          = $s['id'];
            $getservice_payment = DB::table('find_payment')->where('service_id', $serviceid)->first();
            $payment            = 0;

            if ($getservice_payment) {
                if ($usertype == 2) {
                    $payment = $s['amount'];
                } elseif ($usertype == 3) {
                    $payment = $getservice_payment->distributor_amount;
                } elseif ($usertype == 4) {
                    $payment = $getservice_payment->retailer_amount;
                } elseif ($usertype == 5) {
                    $payment = $getservice_payment->customer_amount;
                }
            } else {
                if ($usertype == 2) {
                    $payment = $s['amount'];
                }
            }

            if ($payment == "") {
                $payment = 0;
            }
            $service[$key]['payment'] = $payment;
        }
        $service = json_decode(json_encode($service));
        return view('panservice.pdfservices', compact('service'));
    }

  public function applypdfservice($serviceid) {
 
       $userId = Auth::id();

// Check if the user has service_id 71 or 125 with parent_id 3
$check = DB::table('user_permission')
    ->where('user_id', $userId)
    ->whereIn('service_id', [71, 125])
    ->where('parent_id', 3)
    ->exists();

// Fetch base user permissions for parent_id 1 once
$userPermission = DB::table('user_permission')
    ->where('user_id', $userId)
    ->where('parent_id', 1)
    ->pluck('service_id');

// Push 12 and 7 to the collection if the check passes
if ($check) {
    $userPermission->push(12, 6);
}

// Fetch admin permissions
$adminPermission = DB::table('user_permission')
    ->where('user_id', 2)
    ->where('parent_id', 1)
    ->pluck('service_id');

// Get the intersection of both collections
$finalServiceIds = $userPermission->intersect($adminPermission);

        if (!$finalServiceIds->contains($serviceid)) {
            return response()
                ->view('errors.no_permission', [], 403);
        }
        $getservicename = DB::table('find_services')->where('id', $serviceid)->first();
          if ($getservicename->status == "Inactive") {
            return response()
                ->view('errors.no_permission', [], 403);
        }
        $servicename    = "";
        $amount         = 0;
        if ($getservicename) {
            $servicename = $getservicename->name;
            $amount      = $getservicename->amount;
        }
        $getservice_payment = DB::table('find_payment')->where('service_id', $serviceid)->first();
        $payment            = 0;
    if($getservice_payment){
      if(Auth::user()->user_type_id == 2){
        $payment = $amount;
      }elseif(Auth::user()->user_type_id == 3){
        $payment = $getservice_payment->distributor_amount;
      }elseif(Auth::user()->user_type_id == 4){
        $payment = $getservice_payment->retailer_amount;
      }elseif(Auth::user()->user_type_id == 5){
        $payment = $getservice_payment->customer_amount;
      }
    }else{
      if(Auth::user()->user_type_id == 2){
        $payment = $amount;
      }
    }
    if($payment == ""){
      $payment = 0;
    }
    $mainbalance = DB::table( 'users' )->select('rawallet')->where('id',2)->first();
    if($serviceid == 1){
      $pandetails = DB::table( 'pancard_find' )->where('user_id',Auth::user()->id)->where('service_id',$serviceid)->orderBy( 'id', 'Desc' )->get();
      return view( 'panservice.panfind',compact('serviceid','servicename','payment','mainbalance','pandetails','amount'));
    }elseif($serviceid == 2){
      $pandetails = DB::table( 'pancard_find' )->where('user_id',Auth::user()->id)->where('service_id',$serviceid)->orderBy( 'id', 'Desc' )->get();
      return view( 'panservice.panadvance',compact('serviceid','servicename','payment','mainbalance','pandetails','amount'));
    }elseif( $serviceid == 3 ){
      $dldetails = DB::table( 'dl' )->where('user_id',Auth::user()->id)->orderBy( 'id', 'Desc' )->get();
      return view( 'pdfservice.dlservice',compact('serviceid','servicename','payment','mainbalance','dldetails','amount'));
    }elseif( $serviceid == 4 ){
      $rcdetails = DB::table( 'rc' )->where('user_id',Auth::user()->id)->orderBy( 'id', 'Desc' )->get();
      return view( 'pdfservice.rcservice',compact('serviceid','servicename','payment','mainbalance','rcdetails','amount'));
    }elseif( $serviceid == 5 ){
      $rationdetails = DB::table( 'ration' )->where('user_id',Auth::user()->id)->orderBy( 'id', 'Desc' )->get();
      return view( 'pdfservice.rationcardverify',compact('serviceid','servicename','payment','mainbalance','rationdetails','amount'));
    }elseif( $serviceid == 6 ){
        $voterdetails = DB::table( 'voter_find' )->where('user_id',Auth::user()->id)->where('service_id',$serviceid)->orderBy( 'id', 'Desc' )->get();
        return view( 'pdfservice.voterservice',compact('serviceid','servicename','payment','mainbalance','voterdetails','amount'));
    }elseif( $serviceid == 7 ){
        $voterdetails = DB::table( 'voter_find' )->where('user_id',Auth::user()->id)->where('service_id',$serviceid)->orderBy( 'id', 'Desc' )->get();
        return view( 'pdfservice.voteridpdf',compact('serviceid','servicename','payment','mainbalance','voterdetails','amount'));
    }elseif( $serviceid == 8 ){
      $aadhaar_verify = DB::table( 'aadhaar_verify' )->where('user_id',Auth::user()->id)->where('service_id',$serviceid)->orderBy( 'id', 'Desc' )->get();
      return view( 'pdfservice.aadhaar_verify',compact('serviceid','servicename','payment','mainbalance','aadhaar_verify','amount'));
  }elseif( $serviceid == 9 ){
        $gst_verify = DB::table( 'gst_find' )->where('user_id',Auth::user()->id)->where('service_id',$serviceid)->orderBy( 'id', 'Desc' )->get();
        return view( 'pdfservice.pancard_gst',compact('serviceid','servicename','payment','mainbalance','gst_verify','amount'));
    }elseif ($serviceid == 10) {
        $sharmcard = DB::table('sharmcard')->where('user_id', Auth::user()->id)->where('service_id', $serviceid)->orderBy('id', 'Desc')->get();
        return view('pdfservice.sharmcard', compact('serviceid', 'servicename', 'payment', 'mainbalance', 'sharmcard', 'amount'));
    } elseif ($serviceid == 11) {
        $vehicle_mobilefind = DB::table('vehicle_mobilefind')->where('user_id', Auth::user()->id)->where('service_id', $serviceid)->orderBy('id', 'Desc')->get();
        return view('pdfservice.vehicle_mobilefind', compact('serviceid', 'servicename', 'payment', 'mainbalance', 'vehicle_mobilefind', 'amount'));
    } elseif ($serviceid == 12) {
        $agristack = DB::table('agristack_instant')->where('user_id', Auth::user()->id)->where('service_id', $serviceid)->orderBy('id', 'Desc')->get();
        return view('pdfservice.agristack_instant', compact('serviceid', 'servicename', 'payment', 'mainbalance', 'agristack', 'amount'));
    }
  }

  
    public function submitpanfind(Request $request)
    {
        try {

            $user_id        = Auth::user()->id;
            $aadhaar        = trim($request->aadhaar_no);
            $wallet         = Auth::user()->wallet;
            $serviceid      = $request->serviceid;
            $servicepayment = 0;
            $amount         = 0;

            $getadminpayment = DB::table('find_services')
                ->where('id', $serviceid)
                ->first();

            if ($getadminpayment) {
                $amount = $getadminpayment->amount;
            }

            $getservicepayment = DB::table('find_payment')
                ->where('service_id', $serviceid)
                ->first();

            if ($getservicepayment) {

                if (Auth::user()->user_type_id == 2) {
                    $servicepayment = 0;
                } elseif (Auth::user()->user_type_id == 3) {
                    $servicepayment = $getservicepayment->distributor_amount;
                } elseif (Auth::user()->user_type_id == 4) {
                    $servicepayment = $getservicepayment->retailer_amount;
                } elseif (Auth::user()->user_type_id == 5) {
                    $servicepayment = $getservicepayment->customer_amount;
                }
            }

            if ($wallet < $servicepayment) {
                return redirect()->back()
                    ->with('error', 'Insufficient wallet balance.');
            }

            $key = '61285b3a51c8ad7304175bd5a9816e16f6d3279b3fe4f3b5f1b701b162b6';

            $url = "https://www.apizone.info/api/find_pan/aadhaar_to_pan.php?api_key=$key&aadhaar_no=$aadhaar";

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL            => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING       => "",
                CURLOPT_MAXREDIRS      => 10,
                CURLOPT_TIMEOUT        => 30,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST  => "GET",
            ]);

            $response = curl_exec($curl);

            if (curl_errno($curl)) {
                throw new \Exception(curl_error($curl));
            }

            curl_close($curl);

            $resdata = json_decode($response, true);

            if (! $resdata) {
                return redirect('/applypdfservice/' . $serviceid)
                    ->with('error', 'Invalid API Response');
            }

            $status = $resdata['status'] ?? '';

            if ($status == "200") {

                $message = $resdata['message'] ?? '';
                $pan     = $resdata['pan_no'] ?? '';
                $name    = $resdata['name'] ?? '';
                $dob     = $resdata['dob'] ?? '';

                $insert = DB::table('pancard_find')->insert([
                    'user_id'    => $user_id,
                    'aadhaar_no' => $aadhaar,
                    'pan_no'     => $pan,
                    'name'       => $name,
                    'dob'        => $dob,
                    'service_id' => $serviceid,
                    'amount'     => $servicepayment,
                    'message'    => $message,
                    'status'     => 'Approved',
                    'date'       => date('Y-m-d'),
                ]);
                $date           = date('Y-m-d');
                $time           = date('H:i:s');
                $service_status = 'Out Payment';
                $ad_info        = 'Ramji Wallet Debit(Panfind)';
                $getrawallet    = DB::table('users')->select('rawallet')->where('id', 1)->first();
                $rawallet       = 0;
                if ($getrawallet) {
                    $balance1 = $getrawallet->rawallet;
                }

                $getrawallet1 = DB::table('users')->select('rawallet')->where('id', 2)->first();
                $rawallet1    = 0;
                if ($getrawallet1) {
                    $balance2 = $getrawallet1->rawallet;
                }
                $newbalance2 = $balance1 + $amount;
                $newbalance3 = $balance2 - $amount;
                $sql         = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$amount','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
                DB::insert(DB::raw($sql));
                $sql = "update users set rawallet = rawallet + $amount where id = 1";
                DB::update(DB::raw($sql));
                $service_status = 'IN Payment';
                $ad_info        = 'Ramji Wallet Credit(DL PDF)';
                $sql            = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$amount','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
                DB::insert(DB::raw($sql));
                $sql = "update users set rawallet = rawallet - $amount where id = 2";
                DB::update(DB::raw($sql));

                if (Auth::user()->user_type_id != 2) {
                    $getservicename = DB::table('find_services')->select('name')->where('id', $serviceid)->first();
                    $servicename    = "";
                    if ($getservicename) {
                        $servicename = $getservicename->name;
                    }
                    $date           = date('Y-m-d');
                    $time           = date('H:i:s');
                    $service_status = 'Out Payment';
                    $ad_info        = 'Service Payment' . ' ' . $servicename;

                    $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
                    $balance   = 0;
                    if ($getwallet) {
                        $balance = $getwallet->wallet;
                    }
                    $newbalance  = $balance + $servicepayment;
                    $newbalance1 = Auth::user()->wallet - $servicepayment;

                    $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
                    DB::insert(DB::raw($sql));
                    $sql = "update users set wallet = wallet + $servicepayment where id = 2";
                    DB::update(DB::raw($sql));
                    $service_status = 'IN Payment';
                    $sql            = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
                    DB::insert(DB::raw($sql));
                    $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
                    DB::update(DB::raw($sql));
                }

                if (! $insert) {
                    throw new \Exception('Insert Failed');
                }

                return redirect('/applypdfservice/' . $serviceid)
                    ->with('success', 'Pan No Find Successfully');
            }

            return redirect('/applypdfservice/' . $serviceid)
                ->with('error', $resdata['message'] ?? 'PAN Not Found');

        } catch (\Exception $e) {

            return redirect('/applypdfservice/' . $serviceid)
                ->with('error', $e->getMessage());
        }
    }

    public function submitdlfind(Request $request)
    {
        $user_id = Auth::user()->id;
        $dl_no   = $request->dl_no;
        $dob     = $request->dob;
        if ($request->ser == 2) {
            $apikey = '3e2a83212d3e5e4755390b84612f110d45d393c8c75946786de9ea4f283dcaa9';
        } else {
            $apikey = '2f8c633222b317bca08c80f46dbdbc38e5a1659b45338a82bc80330d4f53f071';
        }
        $Apikey          = 'cdf94c6d43b5367276d87107b1538aa50b50eb8f8c665fbcd9f1998abe73957e619d4e';
        $wallet          = Auth::user()->wallet;
        $serviceid       = $request->serviceid;
        $servicepayment  = 0;
        $amount          = 0;
        $getadminpayment = DB::table('find_services')->where('id', $serviceid)->first();
        if ($getadminpayment) {
            $amount = $getadminpayment->amount;
        }
        $getservicepayment = DB::table('find_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {
            if (Auth::user()->user_type_id == 2) {
                $amount;
            } elseif (Auth::user()->user_type_id == 3) {
                $servicepayment = $getservicepayment->distributor_amount;
            } elseif (Auth::user()->user_type_id == 4) {
                $servicepayment = $getservicepayment->retailer_amount;
            } elseif (Auth::user()->user_type_id == 5) {
                $servicepayment = $getservicepayment->customer_amount;
            }
        }
        if (Auth::user()->wallet < $servicepayment) {
            return redirect()->back()->with('error', 'Insufficient wallet balance. Please recharge your wallet to proceed.');
        }
        if ($wallet < $servicepayment) {
            return redirect('/applypdfservice/' . $serviceid)->with('error', 'Low Balance for the Service....Please Check Your Balance...');
        }

        $apidomain = "https://www.apizone.in";
        $api_key   = "61285b3a51c8ad7304175bd5a9816e16f6d3279b3fe4f3b5f1b701b162b6"; // Replace with your actual API key
        $cardtype  = "2";                                                            // Enter 1 for white background and 2 for Light Blue background

        if ($request->ser == 1) {
            $url = "https://secure.thenextgenapi.co.in/dl_pdf_verification?apikey=TNG-API-ac66a9-666d5f-8a416b-99647d-ac35b1&dl_number=$dl_no&dob=$dob&dltype=1";
        } elseif ($request->ser == 2) {

            $dob = date("d-m-Y", strtotime($dob));

            $url = "$apidomain/api/dl_pdf/dlprint.php?api_key=$api_key&dlno=$dl_no&dob=$dob&cardtype=$cardtype";
        } elseif ($request->ser == 3) {
            $url = "https://usedaily.co.in/serviceApi/V1/driving_licence_hd.php";
        } else {
            $url = "https://authorized.p4point.co.in/api/v1/dlVerificationPDF?apiKey=$Apikey&dlNo=$dl_no&dob=$dob";
        }
        $data = [
            'apiKey' => $apikey,
            'dlNo'   => $dl_no,
            'dob'    => $dob,
        ];
        if ($request->ser == 3) {
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL            => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING       => '',
                CURLOPT_MAXREDIRS      => 10,
                CURLOPT_TIMEOUT        => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST  => 'POST',
                CURLOPT_POSTFIELDS     => $data,
            ]);
        } elseif ($request->ser == 1 || $request->ser == 2) {
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL            => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_MAXREDIRS      => 10,
                CURLOPT_TIMEOUT        => 30,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST  => 'GET',
                CURLOPT_VERBOSE        => true,
            ]);
        }

        $response = curl_exec($curl);
        $resdata  = json_decode($response, true);
        // dd($resdata);
        if ($resdata) {
            if (($request->ser == 1 && $resdata['Message'] == "Success") || ($request->ser == 2 && $resdata['status'] == "200") || ($request->ser == 3 && $resdata['StatusCode'] == "100") || ($request->ser == 4 && $resdata['status'] == "100")) {
                $pdf = "";
                if ($request->ser == 2) {
                    $pdf = $resdata['pdf'];

                    $filename = uniqid() . '.pdf';
                    $filePath = 'upload/dl/' . $filename;

                    file_put_contents($filePath, base64_decode($pdf));
                } else {
                    if ($request->ser == 1) {
                        $pdf = $resdata['Driving_Pdf'];
                    }

                    $pdf_parts = explode(";base64", $pdf);
                    $pdf_types = explode("pdf/", $pdf_parts[0]);
                    $pdf_type  = base64_decode($pdf_parts[1]);
                    $filename  = uniqid() . '.pdf';
                    $filePath  = 'upload/dl/' . $filename;

                    file_put_contents($filePath, $pdf_type);
                }

                if ($request->ser == 1 || $request->ser == 2 || $request->ser == 3) {
                    $message = $resdata['message'];
                } else {
                    $message = $resdata['statusMessage'];
                }

                DB::table('dl')->insert([
                    'user_id'    => Auth::user()->id,
                    'dlnumber'   => $request->dl_no,
                    'dob'        => $dob,
                    'pdf'        => $filename,
                    'service_id' => $serviceid,
                    'amount'     => $servicepayment,
                    'status'     => 'Approved',
                    'date'       => date("Y-m-d H:i:s"),
                ]);
                $date           = date('Y-m-d');
                $time           = date('H:i:s');
                $service_status = 'Out Payment';
                $ad_info        = 'Ramji Wallet Debit(DL PDF)';
                $getrawallet    = DB::table('users')->select('rawallet')->where('id', 1)->first();
                $rawallet       = 0;
                if ($getrawallet) {
                    $balance1 = $getrawallet->rawallet;
                }

                $getrawallet1 = DB::table('users')->select('rawallet')->where('id', 2)->first();
                $rawallet1    = 0;
                if ($getrawallet1) {
                    $balance2 = $getrawallet1->rawallet;
                }
                $newbalance2 = $balance1 + $amount;
                $newbalance3 = $balance2 - $amount;
                $sql         = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$amount','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
                DB::insert(DB::raw($sql));
                $sql = "update users set rawallet = rawallet + $amount where id = 1";
                DB::update(DB::raw($sql));
                $service_status = 'IN Payment';
                $ad_info        = 'Ramji Wallet Credit(DL PDF)';
                $sql            = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$amount','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
                DB::insert(DB::raw($sql));
                $sql = "update users set rawallet = rawallet - $amount where id = 2";
                DB::update(DB::raw($sql));

                if (Auth::user()->user_type_id != 2) {
                    $getservicename = DB::table('find_services')->select('name')->where('id', $serviceid)->first();
                    $servicename    = "";
                    if ($getservicename) {
                        $servicename = $getservicename->name;
                    }
                    $date           = date('Y-m-d');
                    $time           = date('H:i:s');
                    $service_status = 'Out Payment';
                    $ad_info        = 'Service Payment' . ' ' . $servicename;

                    $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
                    $balance   = 0;
                    if ($getwallet) {
                        $balance = $getwallet->wallet;
                    }
                    $newbalance  = $balance + $servicepayment;
                    $newbalance1 = Auth::user()->wallet - $servicepayment;

                    $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
                    DB::insert(DB::raw($sql));
                    $sql = "update users set wallet = wallet + $servicepayment where id = 2";
                    DB::update(DB::raw($sql));
                    $service_status = 'IN Payment';
                    $sql            = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
                    DB::insert(DB::raw($sql));
                    $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
                    DB::update(DB::raw($sql));
                }

                return redirect('/applypdfservice/' . $serviceid)->with('success', $message);
            } else {
                if ($request->ser == 1) {
                    $error = $resdata['Message'];
                } else {
                    $error = $resdata['message'];
                }
                return redirect('/applypdfservice/' . $serviceid)->with('error', $error);
            }
        } else {
            return redirect('/applypdfservice/' . $serviceid)->with('error', 'Something Went Wrong.....');
        }
    }

    public function submitrcfind(Request $request)
    {
        $user_id = Auth::user()->id;
        $rc_no   = $request->rc_no;

        $amount          = $request->amount;
        $wallet          = Auth::user()->wallet;
        $serviceid       = $request->serviceid;
        $servicepayment  = 0;
        $amount          = 0;
        $getadminpayment = DB::table('find_services')->where('id', $serviceid)->first();
        if ($getadminpayment) {
            $amount = $getadminpayment->amount;
        }
        $getservicepayment = DB::table('find_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {
            if (Auth::user()->user_type_id == 2) {
                $amount;
            } elseif (Auth::user()->user_type_id == 3) {
                $servicepayment = $getservicepayment->distributor_amount;
            } elseif (Auth::user()->user_type_id == 4) {
                $servicepayment = $getservicepayment->retailer_amount;
            } elseif (Auth::user()->user_type_id == 5) {
                $servicepayment = $getservicepayment->customer_amount;
            }
        }
        if (Auth::user()->wallet < $servicepayment) {
            return redirect()->back()->with('error', 'Insufficient wallet balance. Please recharge your wallet to proceed.');
        }
        if ($wallet < $servicepayment) {
            return redirect('/applypdfservice/' . $serviceid)->with('error', 'Low Balance for the Service....Please Check Your Balance...');
        }
        $apidomain = "https://www.apizone.in";
        $api_key   = "61285b3a51c8ad7304175bd5a9816e16f6d3279b3fe4f3b5f1b701b162b6";
        $cardtype  = "1";
        $chiptype  = "1";
        $curl      = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL            => "$apidomain/api/rc_pdf/rc.php?api_key=$api_key&rcno=$rc_no&cardtype=$cardtype&chiptype=$chiptype",
            CURLOPT_RETURNTRANSFER => true, // Return response as a string
            CURLOPT_ENCODING       => "",
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => "GET", // Set the request method to GET
        ]);
        // Execute the cURL request and get the response
        $response = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($response, true);
        if ($result) {
            $status = $result['status'];
            if ($status == "200") {
                $name       = $result['name'];
                $message    = $result['message'];
                $pdf_base64 = $result['pdf'];

                $filename = uniqid() . '.pdf';
                $filePath = 'upload/rc/' . $filename;

                // Decode and save
                file_put_contents($filePath, base64_decode($pdf_base64));
                DB::table('rc')->insert([
                    'user_id'    => Auth::user()->id,
                    'rc_no'      => $request->rc_no,
                    'name'       => $name,
                    'pdf'        => $filename,
                    'service_id' => $serviceid,
                    'amount'     => $servicepayment,
                    'status'     => 'Approved',
                    'date'       => date("Y-m-d H:i:s"),
                ]);
                $date           = date('Y-m-d');
                $time           = date('H:i:s');
                $service_status = 'Out Payment';
                $ad_info        = 'Ramji Wallet Debit(RC PDF)';
                $getrawallet    = DB::table('users')->select('rawallet')->where('id', 1)->first();
                $rawallet       = 0;
                if ($getrawallet) {
                    $balance1 = $getrawallet->rawallet;
                }

                $getrawallet1 = DB::table('users')->select('rawallet')->where('id', 2)->first();
                $rawallet1    = 0;
                if ($getrawallet1) {
                    $balance2 = $getrawallet1->rawallet;
                }
                $newbalance2 = $balance1 + $amount;
                $newbalance3 = $balance2 - $amount;
                $sql         = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$amount','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
                DB::insert(DB::raw($sql));
                $sql = "update users set rawallet = rawallet + $amount where id = 1";
                DB::update(DB::raw($sql));
                $service_status = 'IN Payment';
                $ad_info        = 'Ramji Wallet Credit(RC PDF)';

                $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$amount','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
                DB::insert(DB::raw($sql));
                $sql = "update users set rawallet = rawallet - $amount where id = 2";
                DB::update(DB::raw($sql));

                if (Auth::user()->user_type_id != 2) {
                    $getservicename = DB::table('find_services')->select('name')->where('id', $serviceid)->first();
                    $servicename    = "";
                    if ($getservicename) {
                        $servicename = $getservicename->name;
                    }
                    $date           = date('Y-m-d');
                    $time           = date('H:i:s');
                    $service_status = 'Out Payment';
                    $ad_info        = 'Service Payment' . ' ' . $servicename;

                    $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
                    $balance   = 0;
                    if ($getwallet) {
                        $balance = $getwallet->wallet;
                    }
                    $newbalance  = $balance + $servicepayment;
                    $newbalance1 = Auth::user()->wallet - $servicepayment;

                    $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
                    DB::insert(DB::raw($sql));
                    $sql = "update users set wallet = wallet + $servicepayment where id = 2";
                    DB::update(DB::raw($sql));
                    $service_status = 'IN Payment';
                    $sql            = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
                    DB::insert(DB::raw($sql));
                    $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
                    DB::update(DB::raw($sql));
                }

                return redirect('/applypdfservice/' . $serviceid)->with('success', $message);
            } else {

                $error = $result['message'];

                return redirect('/applypdfservice/' . $serviceid)->with('error', $error);
            }
        } else {
            return redirect('/applypdfservice/' . $serviceid)->with('error', 'Something Went Wrong.....');
        }

    }

 public function submitrationfind(Request $request){
  $user_id = Auth::user()->id;
    $aadhaar_no = $request->aadhaar_no;
    $apikey = 'd468061352c00bc0eea59acb1846f358';
    $wallet = Auth::user()->wallet;
    $serviceid         = $request->serviceid;
        $servicepayment    = 0;
        $amount    = 0;
         $getadminpayment = DB::table('find_services')->where('id', $serviceid)->first();
        if ($getadminpayment) {
            $amount = $getadminpayment->amount;
        }
        $getservicepayment = DB::table('find_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {
            if (Auth::user()->user_type_id == 2) {
                $amount;
            } elseif (Auth::user()->user_type_id == 3) {
                $servicepayment = $getservicepayment->distributor_amount;
            } elseif (Auth::user()->user_type_id == 4) {
                $servicepayment = $getservicepayment->retailer_amount;
            } elseif (Auth::user()->user_type_id == 5) {
                $servicepayment = $getservicepayment->customer_amount;
            }
        }
        if (Auth::user()->wallet < $servicepayment) {
            return redirect()->back()->with('error', 'Insufficient wallet balance. Please recharge your wallet to proceed.');
        }
    if ($wallet < $servicepayment) {
      return redirect('/applypdfservice/' . $serviceid)->with('error', 'Low Balance for the Service....Please Check Your Balance...');
    }

    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL =>  "https://goodapi.in/api_services/V1/rasanServices/aadhar_to_rationno_find.php?apiKey=$apikey&uidNumber=$aadhaar_no",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 25,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_SSL_VERIFYPEER => false,
      CURLOPT_SSL_VERIFYHOST => false,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    $resdata = json_decode($response, true);
    if ($resdata) {
     if (isset($resdata['Status']) && $resdata['Status'] == 'Success') {
        $message = "Successfully Ration Card Details Found";
        $rationNumber = $resdata['rationNumber'];
        DB::table('ration')->insert([
          'user_id'    => Auth::user()->id,
          'aadhaar_no' => $request->aadhaar_no,
          'pdf'        => $rationNumber,
          'service_id' => $serviceid,
          'amount'     => $servicepayment,
          'status'     => 'Approved',
          'date'       => date("Y-m-d H:i:s"),
        ]);
        $date = date('Y-m-d');
        $time = date('H:i:s');

    $service_status = 'Out Payment';
    $ad_info = 'Ramji Wallet Debit(RATION PDF)';
    $getrawallet = DB::table( 'users' )->select('rawallet')->where('id',1)->first();
          $rawallet = 0;
          if($getrawallet){
            $balance1 = $getrawallet->rawallet;
          }

          $getrawallet1 = DB::table( 'users' )->select('rawallet')->where('id',2)->first();
          $rawallet1 = 0;
          if($getrawallet1){
            $balance2 = $getrawallet1->rawallet;
          }
          $newbalance2 = $balance1 + $amount;
          $newbalance3 = $balance2 - $amount;
 $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$amount','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
    DB::insert( DB::raw( $sql ) );
    $sql = "update users set rawallet = rawallet + $amount where id = 1";
    DB::update( DB::raw( $sql ) );
    $service_status = 'IN Payment';
    $ad_info = 'Ramji Wallet Credit(RATION PDF)';


    $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$amount','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
    DB::insert( DB::raw( $sql ) );
    $sql = "update users set rawallet = rawallet - $amount where id = 2";
    DB::update( DB::raw( $sql ) );

    if(Auth::user()->user_type_id != 2){
        $getservicename = DB::table( 'find_services' )->select('name')->where('id',$serviceid)->first();
        $servicename = "";
        if($getservicename){
          $servicename = $getservicename->name;
        }
        $date = date( 'Y-m-d' );
        $time = date( 'H:i:s' );
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment'. ' '. $servicename;

        $getwallet = DB::table( 'users' )->select('wallet')->where('id',2)->first();
        $balance = 0;
        if($getwallet){
          $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update( DB::raw( $sql ) );
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update( DB::raw( $sql ) );
      }

    return redirect('/applypdfservice/'.$serviceid)->with('success',$message);


  }else{
    $message=$resdata['message'];

    return redirect('/applypdfservice/'.$serviceid)->with('error',$message);
  }

}else{
    return redirect('/applypdfservice/'.$serviceid)->with('error','Something Went Wrong..Please Check Aadhaar Number...');
  }

}

public function submitpanadvance(Request $request){
    $user_id = Auth::user()->id;
    $pan_no = $request->pan_no;
    $apikey = '61285b3a51c8ad7304175bd5a9816e16f6d3279b3fe4f3b5f1b701b162b6';
    $amount = $request->amount;
    $wallet = Auth::user()->wallet;
    $serviceid         = $request->serviceid;
        $servicepayment    = 0;
        $amount    = 0;
         $getadminpayment = DB::table('find_services')->where('id', $serviceid)->first();
        if ($getadminpayment) {
            $amount = $getadminpayment->amount;
        }
        $getservicepayment = DB::table('find_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {
            if (Auth::user()->user_type_id == 2) {
                $amount;
            } elseif (Auth::user()->user_type_id == 3) {
                $servicepayment = $getservicepayment->distributor_amount;
            } elseif (Auth::user()->user_type_id == 4) {
                $servicepayment = $getservicepayment->retailer_amount;
            } elseif (Auth::user()->user_type_id == 5) {
                $servicepayment = $getservicepayment->customer_amount;
            }
        }
        if (Auth::user()->wallet < $servicepayment) {
            return redirect()->back()->with('error', 'Insufficient wallet balance. Please recharge your wallet to proceed.');
        }
        if($wallet < $servicepayment){
          return redirect('/applypdfservice/'.$serviceid)->with('error','Low Balance for the Service....Please Check Your Balance...');
        }
    $url = "https://www.apizone.info/api/pan_details/pan.php?api_key=$apikey&panno=$pan_no";
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL =>  $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_SSL_VERIFYPEER => false,
      CURLOPT_SSL_VERIFYHOST => false,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    $resdata = json_decode($response, true);


if ($resdata) {
    if ($resdata['status'] == "200") {

        $message = "Successfully Pan Details Found";
        $dob = $resdata['dob'];
        $name = $resdata['name'];
        $gender = $resdata['gender'];
        DB::table('pancard_find')->insert([
            'user_id' => Auth::user()->id,
            'pan_no' => $request->pan_no,
            'name' => $name,
            'dob' => $dob,
            'gender' => $gender,
            'service_id' => $serviceid,
            'amount' => $servicepayment,
            'message' => $message,
            'status'    => 'Approved',
            'date'    => date("Y-m-d H:i:s"),
        ]);
        $date = date( 'Y-m-d' );
        $time = date( 'H:i:s' );
        $service_status = 'Out Payment';
        $ad_info = 'Ramji Wallet Debit(PANADVANCE VERIFY)';
        $getrawallet = DB::table( 'users' )->select('rawallet')->where('id',1)->first();
          $rawallet = 0;
          if($getrawallet){
            $balance1 = $getrawallet->rawallet;
          }

          $getrawallet1 = DB::table( 'users' )->select('rawallet')->where('id',2)->first();
          $rawallet1 = 0;
          if($getrawallet1){
            $balance2 = $getrawallet1->rawallet;
          }
          $newbalance2 = $balance1 + $amount;
          $newbalance3 = $balance2 - $amount;
        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$amount','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set rawallet = rawallet + $amount where id = 1";
        DB::update( DB::raw( $sql ) );
        $service_status = 'IN Payment';
        $ad_info = 'Ramji Wallet Credit(PANADVANCE VERIFY)';

        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$amount','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set rawallet = rawallet - $amount where id = 2";
        DB::update( DB::raw( $sql ) );

        if(Auth::user()->user_type_id != 2){
        $getservicename = DB::table( 'find_services' )->select('name')->where('id',$serviceid)->first();
        $servicename = "";
        if($getservicename){
          $servicename = $getservicename->name;
        }
        $date = date( 'Y-m-d' );
        $time = date( 'H:i:s' );
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment'. ' '. $servicename;

        $getwallet = DB::table( 'users' )->select('wallet')->where('id',2)->first();
        $balance = 0;
        if($getwallet){
          $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update( DB::raw( $sql ) );
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update( DB::raw( $sql ) );
      }

       return redirect('/applypdfservice/' . $serviceid)->with('success', $message);
    } else {
      

        $error = $resdata['message'];
      }

      return redirect('/applypdfservice/' . $serviceid)->with('error', $error);
    }
    else {
      return redirect('/applypdfservice/' . $serviceid)->with('error', 'Something Went Wrong.....');
    }
}

public function getepic($epic_no) {
    $apikey = "3e2a83212d3e5e4755390b84612f110d45d393c8c75946786de9ea4f283dcaa9";
    $url = "http://api-good.xyz/serviceApi/V1/VCM/Vcm-Search.php?epic=$epic_no&apiKey=$apikey";
    $crl = curl_init();
    curl_setopt( $crl, CURLOPT_URL, $url );
    curl_setopt( $crl, CURLOPT_FRESH_CONNECT, true );
    curl_setopt( $crl, CURLOPT_RETURNTRANSFER, true );
    $result = curl_exec($crl);
    $result = json_decode($result);
    curl_close($crl);
    return response()->json( $result );
}

public function getotp($mobile) {
    $apikey = "3e2a83212d3e5e4755390b84612f110d45d393c8c75946786de9ea4f283dcaa9";
    $url = "http://api-good.xyz/serviceApi/V1/VCM/Vcm-Sent-Tp.php?mobile_no=$mobile";
    $crl = curl_init();
    curl_setopt( $crl, CURLOPT_URL, $url );
    curl_setopt( $crl, CURLOPT_FRESH_CONNECT, true );
    curl_setopt( $crl, CURLOPT_RETURNTRANSFER, true );
    $result = curl_exec($crl);
    $result = json_decode($result);
    curl_close($crl);
    return response()->json( $result );
}


public function submitvoterfind(Request $request){
    $user_id = Auth::user()->id;
    $epic_no = $request->epic_no;
    $phone   = $request->mobile;



    $api_key        = '61285b3a51c8ad7304175bd5a9816e16f6d3279b3fe4f3b5f1b701b162b6'; // Replace with your actual API key
    $wallet         = Auth::user()->wallet;
    $servicepayment = $request->servicepayment;
    $serviceid      = $request->serviceid;
      $servicepayment    = 0;
        $amount    = 0;
         $getadminpayment = DB::table('find_services')->where('id', $serviceid)->first();
        if ($getadminpayment) {
            $amount = $getadminpayment->amount;
        }
        $getservicepayment = DB::table('find_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {
            if (Auth::user()->user_type_id == 2) {
                $amount;
            } elseif (Auth::user()->user_type_id == 3) {
                $servicepayment = $getservicepayment->distributor_amount;
            } elseif (Auth::user()->user_type_id == 4) {
                $servicepayment = $getservicepayment->retailer_amount;
            } elseif (Auth::user()->user_type_id == 5) {
                $servicepayment = $getservicepayment->customer_amount;
            }
        }

    // 1. Wallet Balance Check
    if ($wallet < $servicepayment) {
        return redirect('/applypdfservice/' . $serviceid)->with('error', 'Low Balance for the Service....Please Check Your Balance...');
    }

    // 2. Call New API Endpoint
    $apidomain = "https://www.apicentre.in";
    $apiUrl    = "{$apidomain}/api/voter_link_instent?api_key={$api_key}&epic={$epic_no}&mobile={$phone}";

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL            => $apiUrl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_CUSTOMREQUEST  => "GET",
    ]);

    $result = curl_exec($curl);
    curl_close($curl);

    $resdata = json_decode($result);

    // 3. Check API Response Status
    if (isset($resdata->status) && $resdata->status == "200") {
        $message = $resdata->message ?? 'Mobile Link Request Submitted Successfully';

        // Insert request log into voter_find table
        DB::table('voter_find')->insert([
            'user_id'    => $user_id,
            'service_id' => $serviceid,
            'epic_no'    => $epic_no,
            'mobile'     => $phone,
            'message'    => $message,
            'amount'     => $servicepayment,
            'status'     => 'Approved',
            'date'       => date("Y-m-d H:i:s"),
        ]);
        $date = date( 'Y-m-d' );
        $time = date( 'H:i:s' );
        $service_status = 'Out Payment';
        $ad_info = 'Ramji Wallet Debit(Voter Mobile Link)';
        $getrawallet = DB::table( 'users' )->select('rawallet')->where('id',1)->first();
          $rawallet = 0;
          if($getrawallet){
            $balance1 = $getrawallet->rawallet;
          }

          $getrawallet1 = DB::table( 'users' )->select('rawallet')->where('id',2)->first();
          $rawallet1 = 0;
          if($getrawallet1){
            $balance2 = $getrawallet1->rawallet;
          }
          $newbalance2 = $balance1 + $amount;
          $newbalance3 = $balance2 - $amount;
        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$amount','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set rawallet = rawallet + $amount where id = 1";
        DB::update( DB::raw( $sql ) );
        $service_status = 'IN Payment';
        $ad_info = 'Ramji Wallet Credit(Voter Mobile Link)';

        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$amount','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set rawallet = rawallet - $amount where id = 2";
        DB::update( DB::raw( $sql ) );

        if(Auth::user()->user_type_id != 2){
        $getservicename = DB::table( 'find_services' )->select('name')->where('id',$serviceid)->first();
        $servicename = "";
        if($getservicename){
          $servicename = $getservicename->name;
        }
        $date = date( 'Y-m-d' );
        $time = date( 'H:i:s' );
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment'. ' '. $servicename;

        $getwallet = DB::table( 'users' )->select('wallet')->where('id',2)->first();
        $balance = 0;
        if($getwallet){
          $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update( DB::raw( $sql ) );
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update( DB::raw( $sql ) );
      }

       return redirect('/applypdfservice/' . $serviceid)->with('success', $message);
    } else {
       $error = $resdata->message ?? 'Request Failed';
      return redirect('/applypdfservice/' . $serviceid)->with('error', $error);
    }
}


public function getpdfotp($epic_no) {

    $apikey = "3e2a83212d3e5e4755390b84612f110d45d393c8c75946786de9ea4f283dcaa9";
    $url = "http://api-good.xyz/serviceApi/V1/VCPFD/Vc_Send_Tp.php?apiKey=$apikey&epic=$epic_no";
    $crl = curl_init();
    curl_setopt( $crl, CURLOPT_URL, $url );
    curl_setopt( $crl, CURLOPT_FRESH_CONNECT, true );
    curl_setopt( $crl, CURLOPT_RETURNTRANSFER, true );
    $result = curl_exec($crl);
    $result = json_decode($result);
    curl_close($crl);
    return response()->json( $result );
}

public function submitvoterpdf(Request $request){
    $user_id = Auth::user()->id;
    $epic_no = $request->epic_no;
    $name = $request->name;
    $otp = $request->otp;
    $stateCd = $request->stateCd;
    $apikey = '3e2a83212d3e5e4755390b84612f110d45d393c8c75946786de9ea4f283dcaa9';
    $amount = $request->amount;
    $wallet = Auth::user()->wallet;
    $serviceid         = $request->serviceid;
        $servicepayment    = 0;
        $amount    = 0;
         $getadminpayment = DB::table('find_services')->where('id', $serviceid)->first();
        if ($getadminpayment) {
            $amount = $getadminpayment->amount;
        }
        $getservicepayment = DB::table('find_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {
            if (Auth::user()->user_type_id == 2) {
                $amount;
            } elseif (Auth::user()->user_type_id == 3) {
                $servicepayment = $getservicepayment->distributor_amount;
            } elseif (Auth::user()->user_type_id == 4) {
                $servicepayment = $getservicepayment->retailer_amount;
            } elseif (Auth::user()->user_type_id == 5) {
                $servicepayment = $getservicepayment->customer_amount;
            }
        }
        if (Auth::user()->wallet < $servicepayment) {
            return redirect()->back()->with('error', 'Insufficient wallet balance. Please recharge your wallet to proceed.');
        }
        if($wallet < $servicepayment){
          return redirect('/applypdfservice/'.$serviceid)->with('error','Low Balance for the Service....Please Check Your Balance...');
        }

        $url = "http://api-good.xyz/serviceApi/V1/VCPFD/Vc_Verification_Tp.php?apiKey=$apikey&stateCd=$stateCd&otp=$otp&epic=$epic_no";

        $crl = curl_init();
        curl_setopt( $crl, CURLOPT_URL, $url );
        curl_setopt( $crl, CURLOPT_FRESH_CONNECT, true );
        curl_setopt( $crl, CURLOPT_RETURNTRANSFER, true );
        $result = curl_exec($crl);
        $resdata = json_decode($result);
        curl_close($crl);

    if($resdata->StatusCode == "100"){
        $message=$resdata->message;
        $pdf=$resdata->pdf;
        $pdf_parts = explode(";base64", $pdf);
        $pdf_types = explode("pdf/", $pdf_parts[0]);
        $pdf_type = base64_decode($pdf_parts[1]);
        $filename = uniqid().'.pdf';
        file_put_contents('upload/voterpdf/'.$filename,$pdf_type );

            DB::table('voter_find')->insert([
            'user_id'    => Auth::user()->id,
            'service_id' => $serviceid,
            'epic_no'    => $request->epic_no,
            'scode'      => $request->stateCd,
            'name'       => $name,
            'pdf'        => $filename,
            'message'    => $message,
            'amount'     => $servicepayment,
            'status'     => 'Approved',
            'date'       => date("Y-m-d H:i:s"),
        ]);
        $date = date( 'Y-m-d' );
        $time = date( 'H:i:s' );
        $service_status = 'Out Payment';
        $ad_info = 'Ramji Wallet Debit(Voter Mobile Link)';
        $getrawallet = DB::table( 'users' )->select('rawallet')->where('id',1)->first();
          $rawallet = 0;
          if($getrawallet){
            $balance1 = $getrawallet->rawallet;
          }

          $getrawallet1 = DB::table( 'users' )->select('rawallet')->where('id',2)->first();
          $rawallet1 = 0;
          if($getrawallet1){
            $balance2 = $getrawallet1->rawallet;
          }
          $newbalance2 = $balance1 + $amount;
          $newbalance3 = $balance2 - $amount;
        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$amount','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set rawallet = rawallet + $amount where id = 1";
        DB::update( DB::raw( $sql ) );
        $service_status = 'IN Payment';
        $ad_info = 'Ramji Wallet Credit(Voter Mobile Link)';

        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$amount','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set rawallet = rawallet - $amount where id = 2";
        DB::update( DB::raw( $sql ) );

        if(Auth::user()->user_type_id != 2){
        $getservicename = DB::table( 'find_services' )->select('name')->where('id',$serviceid)->first();
        $servicename = "";
        if($getservicename){
          $servicename = $getservicename->name;
        }
        $date = date( 'Y-m-d' );
        $time = date( 'H:i:s' );
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment'. ' '. $servicename;

        $getwallet = DB::table( 'users' )->select('wallet')->where('id',2)->first();
        $balance = 0;
        if($getwallet){
          $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update( DB::raw( $sql ) );
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update( DB::raw( $sql ) );
      }

        return redirect('/applypdfservice/'.$serviceid)->with('success',$message);
    }else{
        $error=$resdata->error;
        return redirect('/applypdfservice/'.$serviceid)->with('error',$error);
    }
}
public function getcaptcha() {
  $url = "https://authorized.p4point.co.in/api/v1/eid/captcha";
  $crl = curl_init();
  curl_setopt( $crl, CURLOPT_URL, $url );
  curl_setopt( $crl, CURLOPT_FRESH_CONNECT, true );
  curl_setopt( $crl, CURLOPT_RETURNTRANSFER, true );
  $result = curl_exec($crl);
  $result = json_decode($result);
  curl_close($crl);
  return response()->json( $result );
}

public function submitaadhaar_verify(Request $request){
  $user_id = Auth::user()->id;
  $aadhaar_no = $request->aadhaar_no;
  $captcha_txid = $request->captcha_txid;
  $captcha_data = $request->captcha_data;
  $apikey = 'cdf94c6d43b5367276d87107b1538aa50b50eb8f8c665fbcd9f1998abe73957e619d4e';
  $amount = $request->amount;
  $wallet = Auth::user()->wallet;
  $serviceid         = $request->serviceid;
        $servicepayment    = 0;
        $amount    = 0;
         $getadminpayment = DB::table('find_services')->where('id', $serviceid)->first();
        if ($getadminpayment) {
            $amount = $getadminpayment->amount;
        }
        $getservicepayment = DB::table('find_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {
            if (Auth::user()->user_type_id == 2) {
                $amount;
            } elseif (Auth::user()->user_type_id == 3) {
                $servicepayment = $getservicepayment->distributor_amount;
            } elseif (Auth::user()->user_type_id == 4) {
                $servicepayment = $getservicepayment->retailer_amount;
            } elseif (Auth::user()->user_type_id == 5) {
                $servicepayment = $getservicepayment->customer_amount;
            }
        }
        if (Auth::user()->wallet < $servicepayment) {
            return redirect()->back()->with('error', 'Insufficient wallet balance. Please recharge your wallet to proceed.');
        }
  if($wallet < $servicepayment){
    return redirect('/applypdfservice/'.$serviceid)->with('error','Low Balance for the Service....Please Check Your Balance...');
  }

  $curl = curl_init();
  curl_setopt_array($curl, array(
  CURLOPT_URL =>  "https://authorized.p4point.co.in/api/v1/eid/verifyUid?apiKey=$apikey&uidNumber=$aadhaar_no&imgcaptcha=$captcha_data&captchaTxnId=$captcha_txid",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_SSL_VERIFYPEER => false,
  CURLOPT_SSL_VERIFYHOST => false,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
  "cache-control: no-cache",
  ),
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);
  $resdata = json_decode($response, true);
  if($resdata['status'] == "100"){
      $aadhar = $resdata['uidNumber'];
      $address=$resdata['address'];
      $age=$resdata['ageBand'];
      $gender=$resdata['gender'];
      $message=$resdata['uidMessage'];
      $mobile=$resdata['maskedMobileNumber'];
      DB::table('aadhaar_verify')->insert([
          'user_id' => Auth::user()->id,
          'gender' => $gender,
          'message' => $message,
          'mobile' => $mobile,
          'address' => $address,
          'aadhaar_no' => $aadhar,
          'age' => $age,
          'service_id' => $serviceid,
          'amount' => $servicepayment,
          'message' => $message,
          'status'    => 'Approved',
          'date'    => date("Y-m-d H:i:s"),
      ]);
      $date = date( 'Y-m-d' );
      $time = date( 'H:i:s' );
      $service_status = 'Out Payment';
      $ad_info = 'Ramji Wallet Debit(DL PDF)';
      $getrawallet = DB::table( 'users' )->select('rawallet')->where('id',1)->first();
          $rawallet = 0;
          if($getrawallet){
            $balance1 = $getrawallet->rawallet;
          }

          $getrawallet1 = DB::table( 'users' )->select('rawallet')->where('id',2)->first();
          $rawallet1 = 0;
          if($getrawallet1){
            $balance2 = $getrawallet1->rawallet;
          }
          $newbalance2 = $balance1 + $amount;
          $newbalance3 = $balance2 - $amount;
      $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$amount','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
      DB::insert( DB::raw( $sql ) );
      $sql = "update users set rawallet = rawallet + $amount where id = 1";
      DB::update( DB::raw( $sql ) );
      $service_status = 'IN Payment';
      $ad_info = 'Ramji Wallet Credit(DL PDF)';
      $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$amount','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
      DB::insert( DB::raw( $sql ) );
      $sql = "update users set rawallet = rawallet - $amount where id = 2";
      DB::update( DB::raw( $sql ) );
      $date = date( 'Y-m-d' );
      $time = date( 'H:i:s' );
      if(Auth::user()->user_type_id != 2){
      $getservicename = DB::table( 'find_services' )->select('name')->where('id',$serviceid)->first();
      $servicename = "";
      if($getservicename){
        $servicename = $getservicename->name;
      }
      $date = date( 'Y-m-d' );
      $time = date( 'H:i:s' );
      $service_status = 'Out Payment';
      $ad_info = 'Service Payment'. ' '. $servicename;

      $getwallet = DB::table( 'users' )->select('wallet')->where('id',1)->first();
      $balance = 0;
      if($getwallet){
        $balance = $getwallet->wallet;
      }
      $newbalance = $balance + $servicepayment;
      $newbalance1 = Auth::user()->wallet - $servicepayment;

      $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
      DB::insert( DB::raw( $sql ) );
      $sql = "update users set wallet = wallet + $servicepayment where id = 2";
      DB::update( DB::raw( $sql ) );
      $service_status = 'IN Payment';
      $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
      DB::insert( DB::raw( $sql ) );
      $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
      DB::update( DB::raw( $sql ) );
    }
      $smessage=$resdata['statusMessage'];
      return redirect('/applypdfservice/' . $serviceid)->with('success', $message);
    } else {
      //$error=$resdata['error'];
      return redirect('/applypdfservice/' . $serviceid)->with('error', "Something Went Wrong....");
    }
}

  public function submitgstfind(Request $request){
    $user_id = Auth::user()->id;
    $pan_no = $request->pan_no;
    $wallet         = Auth::user()->wallet;
    $apikey = '3d77fb-c95462-6d17f3-a92b88-9b8b9c';
    $amount = $request->amount;
    $serviceid         = $request->serviceid;
        $servicepayment    = 0;
        $amount    = 0;
         $getadminpayment = DB::table('find_services')->where('id', $serviceid)->first();
        if ($getadminpayment) {
            $amount = $getadminpayment->amount;
        }
        $getservicepayment = DB::table('find_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {
            if (Auth::user()->user_type_id == 2) {
                $amount;
            } elseif (Auth::user()->user_type_id == 3) {
                $servicepayment = $getservicepayment->distributor_amount;
            } elseif (Auth::user()->user_type_id == 4) {
                $servicepayment = $getservicepayment->retailer_amount;
            } elseif (Auth::user()->user_type_id == 5) {
                $servicepayment = $getservicepayment->customer_amount;
            }
        }
        if (Auth::user()->wallet < $servicepayment) {
            return redirect()->back()->with('error', 'Insufficient wallet balance. Please recharge your wallet to proceed.');
        }

    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://server.webtechly.co.in/PanToGst.php?api_key=$apikey&pan=$pan_no",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_SSL_VERIFYHOST => false,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    $resdata = json_decode($response, true);
    if($resdata['response_code'] == "200"){
        $details = $resdata['enrichment_details']['online_provider']['details'] ?? [];
        DB::table('gst_find')->insert([
            'service_id'           => $serviceid,
            'pan_no'               => $request->pan_no,
            'status'               => 'Completed',
            'user_id'              => Auth::user()->id,
            'gstin'                => $details['gstin']['value'] ?? null,
            'legal_name'           => $details['legal_name']['value'] ?? null,
            'constitution'         => $details['constitution']['value'] ?? null,
            'tax_payer_type'       => $details['tax_payer_type']['value'] ?? null,
            'gst_status'           => $details['status']['value'] ?? null,
            'state_jurisdiction'   => $details['state_jurisdiction']['value'] ?? null,
            'central_jurisdiction' => $details['central_jurisdiction']['value'] ?? null,
            'trade_name'           => $details['trade_name']['value'] ?? null,
            'primary_address'      => $details['primary_address']['value'] ?? null,
            'registration_date'    => !empty($details['registration_date']['value'])
                                        ? date('Y-m-d', strtotime($details['registration_date']['value']))
                                        : null,
]);

      $date = date( 'Y-m-d' );
      $time = date( 'H:i:s' );
      $service_status = 'Out Payment';
      $ad_info = 'Ramji Wallet Debit(DL PDF)';
      $getrawallet = DB::table( 'users' )->select('rawallet')->where('id',1)->first();
          $rawallet = 0;
          if($getrawallet){
            $balance1 = $getrawallet->rawallet;
          }

          $getrawallet1 = DB::table( 'users' )->select('rawallet')->where('id',2)->first();
          $rawallet1 = 0;
          if($getrawallet1){
            $balance2 = $getrawallet1->rawallet;
          }
          $newbalance2 = $balance1 + $amount;
          $newbalance3 = $balance2 - $amount;
      $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$amount','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
      DB::insert( DB::raw( $sql ) );
      $sql = "update users set rawallet = rawallet + $amount where id = 1";
      DB::update( DB::raw( $sql ) );
      $service_status = 'IN Payment';
      $ad_info = 'Ramji Wallet Credit(DL PDF)';
      $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$amount','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
      DB::insert( DB::raw( $sql ) );
      $sql = "update users set rawallet = rawallet - $amount where id = 2";
      DB::update( DB::raw( $sql ) );
      $date = date( 'Y-m-d' );
      $time = date( 'H:i:s' );

      if(Auth::user()->user_type_id != 2){
      $getservicename = DB::table( 'find_services' )->select('name')->where('id',$serviceid)->first();
      $servicename = "";
      if($getservicename){
        $servicename = $getservicename->name;
      }
      $date = date( 'Y-m-d' );
      $time = date( 'H:i:s' );
      $service_status = 'Out Payment';
      $ad_info = 'Service Payment'. ' '. $servicename;

      $getwallet = DB::table( 'users' )->select('wallet')->where('id',1)->first();
      $balance = 0;
      if($getwallet){
        $balance = $getwallet->wallet;
      }
      $newbalance = $balance + $servicepayment;
      $newbalance1 = Auth::user()->wallet - $servicepayment;

      $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
      DB::insert( DB::raw( $sql ) );
      $sql = "update users set wallet = wallet + $servicepayment where id = 2";
      DB::update( DB::raw( $sql ) );
      $service_status = 'IN Payment';
      $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
      DB::insert( DB::raw( $sql ) );
      $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
      DB::update( DB::raw( $sql ) );
      }
        $smessage=$resdata['message'];
        return redirect('/applypdfservice/' . $serviceid)->with('success', $smessage);
    } else {
      $error = $resdata['message'];
      return redirect('/applypdfservice/' . $serviceid)->with('error', $error);
    }
}

   public function submitsharmcard(Request $request)
    {
        $user_id = Auth::user()->id;
        $aadhaar = $request->aadhaar;
        $wallet         = Auth::user()->wallet;
        $apikey  = '2f8c633222b317bca08c80f46dbdbc38e5a1659b45338a82bc80330d4f53f071';
        $amount  = $request->amount;
        $serviceid         = $request->serviceid;
        $servicepayment    = 0;
        $amount    = 0;
         $getadminpayment = DB::table('find_services')->where('id', $serviceid)->first();
        if ($getadminpayment) {
            $amount = $getadminpayment->amount;
        }
        $getservicepayment = DB::table('find_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {
            if (Auth::user()->user_type_id == 2) {
                $amount;
            } elseif (Auth::user()->user_type_id == 3) {
                $servicepayment = $getservicepayment->distributor_amount;
            } elseif (Auth::user()->user_type_id == 4) {
                $servicepayment = $getservicepayment->retailer_amount;
            } elseif (Auth::user()->user_type_id == 5) {
                $servicepayment = $getservicepayment->customer_amount;
            }
        }
        if (Auth::user()->wallet < $servicepayment) {
            return redirect()->back()->with('error', 'Insufficient wallet balance. Please recharge your wallet to proceed.');
        }

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL            => "https://usedaily.co.in/serviceApi/V1/sharmVerfication.php?apiKey=$apikey&aadhaar=$aadhaar",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => "",
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => "GET",
            CURLOPT_HTTPHEADER     => [
                "cache-control: no-cache",
            ],
        ]);

        $response = curl_exec($curl);
        $err      = curl_error($curl);
        curl_close($curl);
        $resdata = json_decode($response, true);
        if (isset($resdata['Status']) && $resdata['Status'] == 'Success') {

            $pdf       = $resdata['pdf'];
            $pdf_parts = explode(";base64", $pdf);
            $pdf_types = explode("pdf/", $pdf_parts[0]);
            $pdf_type  = base64_decode($pdf_parts[1]);
            $filename  = uniqid() . '.pdf';
            file_put_contents('upload/sharmcard/' . $filename, $pdf_type);
            DB::table('sharmcard')->insert([
                'service_id' => $serviceid,
                'aadhaar'    => $aadhaar,
                'status'     => 'Completed',
                'user_id'    => Auth::user()->id,
                'name'       => $resdata['name'] ?? null,
                'uan'        => $resdata['uan'] ?? null,
                'pdf'        => $filename,
                'date'       => date("Y-m-d H:i:s"),
            ]);
            $date           = date('Y-m-d');
            $time           = date('H:i:s');
            $service_status = 'Out Payment';
            $ad_info        = 'Ramji Wallet Debit(DL PDF)';
            $getrawallet    = DB::table('users')->select('rawallet')->where('id', 1)->first();
            $rawallet       = 0;
            if ($getrawallet) {
                $balance1 = $getrawallet->rawallet;
            }

            $getrawallet1 = DB::table('users')->select('rawallet')->where('id', 2)->first();
            $rawallet1    = 0;
            if ($getrawallet1) {
                $balance2 = $getrawallet1->rawallet;
            }
            $newbalance2 = $balance1 + $amount;
            $newbalance3 = $balance2 - $amount;
            $sql         = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$amount','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
            DB::insert(DB::raw($sql));
            $sql = "update users set rawallet = rawallet + $amount where id = 1";
            DB::update(DB::raw($sql));
            $service_status = 'IN Payment';
            $ad_info        = 'Ramji Wallet Credit(DL PDF)';
            $sql            = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$amount','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
            DB::insert(DB::raw($sql));
            $sql = "update users set rawallet = rawallet - $amount where id = 2";
            DB::update(DB::raw($sql));
            $date = date('Y-m-d');
            $time = date('H:i:s');

            if (Auth::user()->user_type_id != 2) {
                $getservicename = DB::table('find_services')->select('name')->where('id', $serviceid)->first();
                $servicename    = "";
                if ($getservicename) {
                    $servicename = $getservicename->name;
                }
                $date           = date('Y-m-d');
                $time           = date('H:i:s');
                $service_status = 'Out Payment';
                $ad_info        = 'Service Payment' . ' ' . $servicename;

                $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
                $balance   = 0;
                if ($getwallet) {
                    $balance = $getwallet->wallet;
                }
                $newbalance  = $balance + $servicepayment;
                $newbalance1 = Auth::user()->wallet - $servicepayment;

                $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
                DB::insert(DB::raw($sql));
                $sql = "update users set wallet = wallet + $servicepayment where id = 2";
                DB::update(DB::raw($sql));
                $service_status = 'IN Payment';
                $sql            = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
                DB::insert(DB::raw($sql));
                $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
                DB::update(DB::raw($sql));
            }
            $smessage = $resdata['message'];
            return redirect('/applypdfservice/' . $serviceid)->with('success', $smessage);
        } else {
            $error = $resdata['message'];
            return redirect('/applypdfservice/' . $serviceid)->with('error', $error);
        }
    }

    public function submitvehicle_mobilefind(Request $request)
    {
        $user_id        = Auth::user()->id;
        $rcno           = $request->rcno;
        $apikey         = 'd468061352c00bc0eea59acb1846f358';
        $wallet         = Auth::user()->wallet;
        $serviceid         = $request->serviceid;
        $servicepayment    = 0;
        $amount    = 0;
         $getadminpayment = DB::table('find_services')->where('id', $serviceid)->first();
        if ($getadminpayment) {
            $amount = $getadminpayment->amount;
        }
        $getservicepayment = DB::table('find_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {
            if (Auth::user()->user_type_id == 2) {
                $amount;
            } elseif (Auth::user()->user_type_id == 3) {
                $servicepayment = $getservicepayment->distributor_amount;
            } elseif (Auth::user()->user_type_id == 4) {
                $servicepayment = $getservicepayment->retailer_amount;
            } elseif (Auth::user()->user_type_id == 5) {
                $servicepayment = $getservicepayment->customer_amount;
            }
        }
        if (Auth::user()->wallet < $servicepayment) {
            return redirect()->back()->with('error', 'Insufficient wallet balance. Please recharge your wallet to proceed.');
        }
        if ($wallet < $servicepayment) {
            return redirect('/applypdfservice/' . $serviceid)->with('error', 'Low Balance for the Service....Please Check Your Balance...');
        }

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL            => "https://goodapi.in/api_services/V1/vahanServices/vehicle_to_mobile.php?rcNumber=$rcno&apiKey=$apikey",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => "",
            CURLOPT_MAXREDIRS      => 25,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => "GET",
            CURLOPT_HTTPHEADER     => [
                "cache-control: no-cache",
            ],
        ]);

        $response = curl_exec($curl);
        $err      = curl_error($curl);
        curl_close($curl);
        $resdata = json_decode($response, true);
        if ($resdata) {
            if (isset($resdata['Status']) && $resdata['Status'] == 'Success') {
                $message = $resdata['message'];
                $rc_no   = $resdata['rcNumber'];
                $mobile  = $resdata['mobile_no'];
                DB::table('vehicle_mobilefind')->insert([
                    'user_id'    => Auth::user()->id,
                    'rcno'       => $rc_no,
                    'mobile'     => $mobile,
                    'service_id' => $serviceid,
                    'amount'     => $servicepayment,
                    'status'     => 'Approved',
                    'date'       => date("Y-m-d H:i:s"),
                ]);
                $date           = date('Y-m-d');
                $time           = date('H:i:s');
                $service_status = 'Out Payment';
                $ad_info        = 'Ramji Wallet Debit(Vehicle Mobilefind)';
                $getrawallet    = DB::table('users')->select('rawallet')->where('id', 1)->first();
                $rawallet       = 0;
                if ($getrawallet) {
                    $balance1 = $getrawallet->rawallet;
                }

                $getrawallet1 = DB::table('users')->select('rawallet')->where('id', 2)->first();
                $rawallet1    = 0;
                if ($getrawallet1) {
                    $balance2 = $getrawallet1->rawallet;
                }
                $newbalance2 = $balance1 + $amount;
                $newbalance3 = $balance2 - $amount;
                $sql         = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$amount','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
                DB::insert(DB::raw($sql));
                $sql = "update users set rawallet = rawallet + $amount where id = 1";
                DB::update(DB::raw($sql));
                $service_status = 'IN Payment';
                $ad_info        = 'Ramji Wallet Credit(DL PDF)';
                $sql            = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$amount','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
                DB::insert(DB::raw($sql));
                $sql = "update users set rawallet = rawallet - $amount where id = 2";
                DB::update(DB::raw($sql));
                $date = date('Y-m-d');
                $time = date('H:i:s');

                if (Auth::user()->user_type_id != 2) {
                    $getservicename = DB::table('find_services')->select('name')->where('id', $serviceid)->first();
                    $servicename    = "";
                    if ($getservicename) {
                        $servicename = $getservicename->name;
                    }
                    $date           = date('Y-m-d');
                    $time           = date('H:i:s');
                    $service_status = 'Out Payment';
                    $ad_info        = 'Service Payment' . ' ' . $servicename;

                    $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
                    $balance   = 0;
                    if ($getwallet) {
                        $balance = $getwallet->wallet;
                    }
                    $newbalance  = $balance + $servicepayment;
                    $newbalance1 = Auth::user()->wallet - $servicepayment;

                    $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
                    DB::insert(DB::raw($sql));
                    $sql = "update users set wallet = wallet + $servicepayment where id = 2";
                    DB::update(DB::raw($sql));
                    $service_status = 'IN Payment';
                    $sql            = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
                    DB::insert(DB::raw($sql));
                    $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
                    DB::update(DB::raw($sql));
                }
                return redirect('/applypdfservice/' . $serviceid)->with('success', $message);
            } else {
                $error = $resdata['message'];
                return redirect('/applypdfservice/' . $serviceid)->with('error', $error);
            }
        } else {
            return redirect('/applypdfservice/' . $serviceid)->with('error', 'Something Went Wrong.....');
        }
    }

    // public function submitagristackcard(Request $request)
    // {
    //     $user_id         = Auth::user()->id;
    //     $aadhaar         = $request->aadhaar;
    //     $wallet          = Auth::user()->wallet;
    //     $serviceid       = $request->serviceid;
    //     $servicepayment  = 0;
    //     $amount          = 0;
    //     $getadminpayment = DB::table('find_services')->where('id', $serviceid)->first();
    //     if ($getadminpayment) {
    //         $amount = $getadminpayment->amount;
    //     }
    //     $getservicepayment = DB::table('find_payment')->where('service_id', $serviceid)->first();
    //     if ($getservicepayment) {
    //         if (Auth::user()->user_type_id == 2) {
    //             $amount;
    //         } elseif (Auth::user()->user_type_id == 3) {
    //             $servicepayment = $getservicepayment->distributor_amount;
    //         } elseif (Auth::user()->user_type_id == 4) {
    //             $servicepayment = $getservicepayment->retailer_amount;
    //         } elseif (Auth::user()->user_type_id == 5) {
    //             $servicepayment = $getservicepayment->customer_amount;
    //         }
    //     }
    //     if (Auth::user()->wallet < $servicepayment) {
    //         return redirect()->back()->with('error', 'Insufficient wallet balance. Please recharge your wallet to proceed.');
    //     }
    //     if ($wallet < $servicepayment) {
    //         return redirect('/applypdfservice/' . $serviceid)->with('error', 'Low Balance for the Service....Please Check Your Balance...');
    //     }

    //     $curl = curl_init();
    // curl_setopt_array($curl, array(
    //        CURLOPT_URL => "https://darkxen.in/api/v3/FARMER/agri_farmer_card_pdf_verification.php?apiKey=dbc548c2ae72c7434c9c8a5301222353a40fb641a2f4b3aa2a39f1fc9c55e336&aadhar=" . $aadhaar . "&state=TN",
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => "",
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 30,
    //         CURLOPT_SSL_VERIFYPEER => false,
    //         CURLOPT_SSL_VERIFYHOST => false,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => "GET",
    //         CURLOPT_HTTPHEADER => array(
    //        "cache-control: no-cache",
    //       ),
    //      ));

    // $response = curl_exec($curl);
    // $err = curl_error($curl);
    // curl_close($curl);
    // $resdata = json_decode($response, true);
    // if (isset($resdata['sampleCode']) && $resdata['sampleCode'] == '200') {

    //   $pdf = $resdata['pdf'];

    //   $filename = uniqid() . '.pdf';
    //     $pdf_parts = explode(";base64", $pdf);
    //       $pdf_types = explode("pdf/", $pdf_parts[0]);
    //       $pdf_type = base64_decode($pdf_parts[1]);
    //   file_put_contents('upload/agristack/' . $filename, $pdf_type);
    //   DB::table('agristack_instant')->insert([
    //     'service_id'           => $serviceid,
    //     'aadhaar'              => $aadhaar,
    //     'status'               => 'Completed',
    //     'user_id'              => Auth::user()->id,
    //     'name'                 => $resdata['fullname'] ?? null,
    //     'pdf'                  => $filename,
    //     'date'                 => date("Y-m-d H:i:s"),
    //   ]);
    //             $date           = date('Y-m-d');
    //             $time           = date('H:i:s');
    //             $service_status = 'Out Payment';
    //             $ad_info        = 'Ramji Wallet Debit(Agri Stack Pdf)';
    //             $getrawallet    = DB::table('users')->select('rawallet')->where('id', 1)->first();
    //             $rawallet       = 0;
    //             if ($getrawallet) {
    //                 $balance1 = $getrawallet->rawallet;
    //             }

    //             $getrawallet1 = DB::table('users')->select('rawallet')->where('id', 2)->first();
    //             $rawallet1    = 0;
    //             if ($getrawallet1) {
    //                 $balance2 = $getrawallet1->rawallet;
    //             }
    //             $newbalance2 = $balance1 + $amount;
    //             $newbalance3 = $balance2 - $amount;
    //             $sql         = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$amount','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
    //             DB::insert(DB::raw($sql));
    //             $sql = "update users set rawallet = rawallet + $amount where id = 1";
    //             DB::update(DB::raw($sql));
    //             $service_status = 'IN Payment';
    //             $ad_info        = 'Ramji Wallet Credit(DL PDF)';
    //             $sql            = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$amount','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
    //             DB::insert(DB::raw($sql));
    //             $sql = "update users set rawallet = rawallet - $amount where id = 2";
    //             DB::update(DB::raw($sql));
    //             $date = date('Y-m-d');
    //             $time = date('H:i:s');

    //             if (Auth::user()->user_type_id != 2) {
    //                 $getservicename = DB::table('find_services')->select('name')->where('id', $serviceid)->first();
    //                 $servicename    = "";
    //                 if ($getservicename) {
    //                     $servicename = $getservicename->name;
    //                 }
    //                 $date           = date('Y-m-d');
    //                 $time           = date('H:i:s');
    //                 $service_status = 'Out Payment';
    //                 $ad_info        = 'Service Payment' . ' ' . $servicename;

    //                 $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
    //                 $balance   = 0;
    //                 if ($getwallet) {
    //                     $balance = $getwallet->wallet;
    //                 }
    //                 $newbalance  = $balance + $servicepayment;
    //                 $newbalance1 = Auth::user()->wallet - $servicepayment;

    //                 $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
    //                 DB::insert(DB::raw($sql));
    //                 $sql = "update users set wallet = wallet + $servicepayment where id = 2";
    //                 DB::update(DB::raw($sql));
    //                 $service_status = 'IN Payment';
    //                 $sql            = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
    //                 DB::insert(DB::raw($sql));
    //                 $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
    //                 DB::update(DB::raw($sql));
    //             }
    //              $smessage = "Agri Stack Pdf Successfully ... !";
    //              return redirect('/applypdfservice/' . $serviceid)->with('success', $smessage);
    //            } else {
    //         $error = $resdata['message'];
    //         return redirect('/applypdfservice/' . $serviceid)->with('error', $error);
    //     }
    // }   
    public function fetchFarmerData(Request $request)
{
    $uid =
        preg_replace(
            '/[^0-9]/',
            '',
            $request->aadhaar
        );

    if (strlen($uid) != 12) {

        return response()->json([

            'status' => 'failed',

            'message' =>
                'Invalid Aadhaar Number'

        ]);
    }

    $apiUrl =
        "https://ehub.in.net/Agri/get_farmer_data.php?uid_number=".$uid;

    $curl = curl_init();

    curl_setopt_array($curl, [

        CURLOPT_URL =>
            $apiUrl,

        CURLOPT_RETURNTRANSFER =>
            true,

        CURLOPT_SSL_VERIFYPEER =>
            false,

        CURLOPT_TIMEOUT =>
            30,

    ]);

    $response =
        curl_exec($curl);

    $httpCode =
        curl_getinfo(
            $curl,
            CURLINFO_HTTP_CODE
        );

    $error =
        curl_error($curl);

    curl_close($curl);

    if ($response && $httpCode == 200) {

        return response($response)
            ->header(
                'Content-Type',
                'application/json'
            );
    }

    return response()->json([

        'status' =>
            'failed',

        'message' =>
            'API Fetch Failed',

        'error' =>
            $error

    ]);
}

    public function saveFarmerPdf(Request $request)
{
    try {

        DB::beginTransaction();

        $user_id =
            Auth::user()->id;

        $serviceid =
            $request->service_id;

        $servicepayment =
            (float)$request->amount;
             $servicepayment  = 0;
        $amount          = 0;
        $wallet          = Auth::user()->wallet;
             $getadminpayment = DB::table('find_services')->where('id', $serviceid)->first();
        if ($getadminpayment) {
            $amount = $getadminpayment->amount;
        }
        $getservicepayment = DB::table('find_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {
            if (Auth::user()->user_type_id == 2) {
                $amount;
            } elseif (Auth::user()->user_type_id == 3) {
                $servicepayment = $getservicepayment->distributor_amount;
            } elseif (Auth::user()->user_type_id == 4) {
                $servicepayment = $getservicepayment->retailer_amount;
            } elseif (Auth::user()->user_type_id == 5) {
                $servicepayment = $getservicepayment->customer_amount;
            }
        }
        if (Auth::user()->wallet < $servicepayment) {
            return redirect()->back()->with('error', 'Insufficient wallet balance. Please recharge your wallet to proceed.');
             return response()->json([

            'status' =>
                'failed',

            'message' =>
                'Insufficient wallet balance. Please recharge your wallet to proceed.'

        ]);
        }
        if ($wallet < $servicepayment) {

             return response()->json([

            'status' =>
                'failed',

            'message' =>
                'Low Balance for the Service....Please Check Your Balance...'

        ]);
        }


        /*
        |--------------------------------------------------------------------------
        | PDF SAVE
        |--------------------------------------------------------------------------
        */

        $pdfData =
            $request->pdf;

        $pdfData =
            str_replace(
                'data:application/pdf;base64,',
                '',
                $pdfData
            );

        $pdfData =
            str_replace(
                ' ',
                '+',
                $pdfData
            );

             $pdf = str_replace(
    'data:application/pdf;filename=generated.pdf;base64,',
    '',
    $pdfData
);

        $pdfBinary =
            base64_decode($pdf);

        $filename =
            time().'_'.rand(1000,9999).'.pdf';

        $folder =
            public_path('upload/agristack');

        if (!file_exists($folder)) {

            mkdir(
                $folder,
                0777,
                true
            );
        }

        file_put_contents(
            public_path(
                'upload/agristack/'.$filename
            ),
            $pdfBinary
        );

        /*
        |--------------------------------------------------------------------------
        | INSERT AGRISTACK
        |--------------------------------------------------------------------------
        */

        DB::table('agristack_instant')->insert([

            'service_id' =>
                $serviceid,

            'aadhaar' =>
                $request->aadhaar_number,

            'status' =>
                'Completed',

            'user_id' =>
                $user_id,

            'name' =>
                $request->name_en,

            'pdf' =>
                $filename,

            'date' =>
                now(),

        ]);

        /*
        |--------------------------------------------------------------------------
        | WALLET DEDUCTION
        |--------------------------------------------------------------------------
        */

        if (Auth::user()->user_type_id != 2) {

            $getservicename =
                DB::table('find_services')
                    ->select('name')
                    ->where('id',$serviceid)
                    ->first();

            $servicename =
                $getservicename->name ?? '';

            $date =
                date('Y-m-d');

            $time =
                date('H:i:s');

            $service_status =
                'Out Payment';

            $ad_info =
                'Service Payment '.$servicename;

            /*
            |--------------------------------------------------------------------------
            | ADMIN WALLET
            |--------------------------------------------------------------------------
            */

            $admin =
                DB::table('users')
                    ->where('id',2)
                    ->first();

            $adminBalance =
                $admin->wallet +
                $servicepayment;

            /*
            |--------------------------------------------------------------------------
            | USER WALLET
            |--------------------------------------------------------------------------
            */

            $user =
                DB::table('users')
                    ->where('id',$user_id)
                    ->first();

            $userBalance =
                $user->wallet -
                $servicepayment;

            /*
            |--------------------------------------------------------------------------
            | PAYMENT OUT ENTRY
            |--------------------------------------------------------------------------
            */

            DB::table('payment')->insert([

                'log_id' =>
                    $user_id,

                'from_id' =>
                    $user_id,

                'to_id' =>
                    2,

                'amount' =>
                    $servicepayment,

                'ad_info' =>
                    $ad_info,

                'service_status' =>
                    'Out Payment',

                'time' =>
                    $time,

                'paydate' =>
                    $date,

                'pay_id' =>
                    $user_id,

                'newbalance' =>
                    $userBalance

            ]);

            /*
            |--------------------------------------------------------------------------
            | ADMIN WALLET UPDATE
            |--------------------------------------------------------------------------
            */

            DB::table('users')
                ->where('id',2)
                ->update([

                    'wallet' =>
                        $adminBalance

                ]);

            /*
            |--------------------------------------------------------------------------
            | PAYMENT IN ENTRY
            |--------------------------------------------------------------------------
            */

            DB::table('payment')->insert([

                'log_id' =>
                    $user_id,

                'from_id' =>
                    2,

                'to_id' =>
                    $user_id,

                'amount' =>
                    $servicepayment,

                'ad_info' =>
                    $ad_info,

                'service_status' =>
                    'IN Payment',

                'time' =>
                    $time,

                'paydate' =>
                    $date,

                'pay_id' =>
                    $user_id,

                'newbalance' =>
                    $adminBalance

            ]);

            /*
            |--------------------------------------------------------------------------
            | USER WALLET UPDATE
            |--------------------------------------------------------------------------
            */

            DB::table('users')
                ->where('id',$user_id)
                ->update([

                    'wallet' =>
                        $userBalance

                ]);

        }
                $date           = date('Y-m-d');
                $time           = date('H:i:s');
                $service_status = 'Out Payment';
                $ad_info        = 'Ramji Wallet Debit(Agri Stack Pdf)';
                $getrawallet    = DB::table('users')->select('rawallet')->where('id', 1)->first();
                $rawallet       = 0;
                if ($getrawallet) {
                    $balance1 = $getrawallet->rawallet;
                }

                $getrawallet1 = DB::table('users')->select('rawallet')->where('id', 2)->first();
                $rawallet1    = 0;
                if ($getrawallet1) {
                    $balance2 = $getrawallet1->rawallet;
                }
                $newbalance2 = $balance1 + $amount;
                $newbalance3 = $balance2 - $amount;
                $sql         = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$amount','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
                DB::insert(DB::raw($sql));
                $sql = "update users set rawallet = rawallet + $amount where id = 1";
                DB::update(DB::raw($sql));
                $service_status = 'IN Payment';
                $ad_info        = 'Ramji Wallet Credit(Agri Stack PDF)';
                $sql            = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$amount','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
                DB::insert(DB::raw($sql));
                $sql = "update users set rawallet = rawallet - $amount where id = 2";
                DB::update(DB::raw($sql));

        DB::commit();

        return response()->json([

            'status' =>
                'success',

            'file' =>
                url(
                    '/upload/agristack/'.$filename
                )

        ]);

    } catch (\Exception $e) {

        DB::rollback();

        return response()->json([

            'status' =>
                'failed',

            'message' =>
                $e->getMessage()

        ]);
    }
}

public function fetchApiData(Request $request): JsonResponse
{
    $dlno = trim($request->query('dlno'));
    $dob = trim($request->query('dob'));

    // 1. Validate Parameters
    if (empty($dlno) || empty($dob)) {
        return response()->json([
            "status" => "error", 
            "message" => "Missing parameters."
        ], 400, [], JSON_PRETTY_PRINT);
    }

    try {
        // 2. Primary Attempt: Call the Remote Third-Party API Gateway
        $response = Http::withoutVerifying()
            ->timeout(15) // Shorter timeout so fallback triggers quickly if the API stalls
            ->get("https://smartpdf.in.net/members/Dlpdf/api.php", [
                'dlno' => $dlno,
                'dob' => $dob
            ]);

        // If the API call succeeded and returned a valid structural payload
        if ($response->successful()) {
            $apiData = $response->json();
            
            // Check if the API explicitly sent a success block inside its payload
            if (isset($apiData['status']) && $apiData['status'] === 'success') {
                return response()->json(
                    $apiData, 
                    200, 
                    [], 
                    JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
                );
            }
        }
        
        // If execution reaches here, the API failed. Fall through to the backup scraper.
    } catch (\Exception $apiException) {
        // Log the exception if needed, then let execution continue downward to the scraper fallback
        // Log::warning("Primary DL API failed: " . $apiException->getMessage());
    }

   try {
    // 3. Fallback Attempt: Execute Sarathi Scraping Engine Directly
    $scrapedData = $this->scraperService->scrapeDrivingLicense($dlno, $dob);

    return response()->json([
        "status" => "success",
        "message" => "Details Extracted Successfully via Backup Scraper",
        "data" => $scrapedData
    ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

} catch (\Exception $scraperException) {
    $errorMessage = $scraperException->getMessage();

    // If the scraper specifically reports bad data/captcha, return a clean validation code (422)
    if (str_contains($errorMessage, 'Invalid') || str_contains($errorMessage, 'Captcha')) {
        return response()->json([
            "status" => "error",
            "message" => "Sarathi Validation Failed: Please verify your DL Number, DOB, or try again shortly."
        ], 422, [], JSON_PRETTY_PRINT);
    }

    // Otherwise, it was a system connection timeout / scraper crash code (500)
    return response()->json([
        "status" => "error",
        "message" => "All retrieval methods exhausted. System Error: " . $errorMessage
    ], 500, [], JSON_PRETTY_PRINT);
}
}
public function saveDLPdf(Request $request)
{
    try {

        DB::beginTransaction();

        $user_id =
            Auth::user()->id;

        $serviceid =
            $request->service_id;

        $servicepayment =
            (float)$request->amount;
             $servicepayment  = 0;
        $amount          = 0;
        $wallet          = Auth::user()->wallet;
             $getadminpayment = DB::table('find_services')->where('id', $serviceid)->first();
        if ($getadminpayment) {
            $amount = $getadminpayment->amount;
        }
        $getservicepayment = DB::table('find_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {
            if (Auth::user()->user_type_id == 2) {
                $amount;
            } elseif (Auth::user()->user_type_id == 3) {
                $servicepayment = $getservicepayment->distributor_amount;
            } elseif (Auth::user()->user_type_id == 4) {
                $servicepayment = $getservicepayment->retailer_amount;
            } elseif (Auth::user()->user_type_id == 5) {
                $servicepayment = $getservicepayment->customer_amount;
            }
        }
        if (Auth::user()->wallet < $servicepayment) {
            return redirect()->back()->with('error', 'Insufficient wallet balance. Please recharge your wallet to proceed.');
             return response()->json([

            'status' =>
                'failed',

            'message' =>
                'Insufficient wallet balance. Please recharge your wallet to proceed.'

        ]);
        }
        if ($wallet < $servicepayment) {

             return response()->json([

            'status' =>
                'failed',

            'message' =>
                'Low Balance for the Service....Please Check Your Balance...'

        ]);
        }


        /*
        |--------------------------------------------------------------------------
        | PDF SAVE
        |--------------------------------------------------------------------------
        */

        $pdfData =
            $request->pdf;

        $pdfData =
            str_replace(
                'data:application/pdf;base64,',
                '',
                $pdfData
            );

        $pdfData =
            str_replace(
                ' ',
                '+',
                $pdfData
            );

             $pdf = str_replace(
    'data:application/pdf;filename=generated.pdf;base64,',
    '',
    $pdfData
);

        $pdfBinary =
            base64_decode($pdf);

        $filename =
            time().'_'.rand(1000,9999).'.pdf';

        $folder =
            public_path('upload/dl');

        if (!file_exists($folder)) {

            mkdir(
                $folder,
                0777,
                true
            );
        }

        file_put_contents(
            public_path(
                'upload/dl/'.$filename
            ),
            $pdfBinary
        );

        /*
        |--------------------------------------------------------------------------
        | INSERT AGRISTACK
        |--------------------------------------------------------------------------
        */

         DB::table('dl')->insert([

            'service_id' =>
                $serviceid,

            'dlnumber' =>
                $request->dl_number,

            'status' =>
                'Completed',

            'user_id' =>
                $user_id,

              'dob' =>
                $request->dob,

            'pdf' =>
                $filename,

            'date' =>
                now(),

        ]);

        /*
        |--------------------------------------------------------------------------
        | WALLET DEDUCTION
        |--------------------------------------------------------------------------
        */

        if (Auth::user()->user_type_id != 2) {

            $getservicename =
                DB::table('find_services')
                    ->select('name')
                    ->where('id',$serviceid)
                    ->first();

            $servicename =
                $getservicename->name ?? '';

            $date =
                date('Y-m-d');

            $time =
                date('H:i:s');

            $service_status =
                'Out Payment';

            $ad_info =
                'Service Payment '.$servicename;

            /*
            |--------------------------------------------------------------------------
            | ADMIN WALLET
            |--------------------------------------------------------------------------
            */

            $admin =
                DB::table('users')
                    ->where('id',2)
                    ->first();

            $adminBalance =
                $admin->wallet +
                $servicepayment;

            /*
            |--------------------------------------------------------------------------
            | USER WALLET
            |--------------------------------------------------------------------------
            */

            $user =
                DB::table('users')
                    ->where('id',$user_id)
                    ->first();

            $userBalance =
                $user->wallet -
                $servicepayment;

            /*
            |--------------------------------------------------------------------------
            | PAYMENT OUT ENTRY
            |--------------------------------------------------------------------------
            */

            DB::table('payment')->insert([

                'log_id' =>
                    $user_id,

                'from_id' =>
                    $user_id,

                'to_id' =>
                    2,

                'amount' =>
                    $servicepayment,

                'ad_info' =>
                    $ad_info,

                'service_status' =>
                    'Out Payment',

                'time' =>
                    $time,

                'paydate' =>
                    $date,

                'pay_id' =>
                    $user_id,

                'newbalance' =>
                    $userBalance

            ]);

            /*
            |--------------------------------------------------------------------------
            | ADMIN WALLET UPDATE
            |--------------------------------------------------------------------------
            */

            DB::table('users')
                ->where('id',2)
                ->update([

                    'wallet' =>
                        $adminBalance

                ]);

            /*
            |--------------------------------------------------------------------------
            | PAYMENT IN ENTRY
            |--------------------------------------------------------------------------
            */

            DB::table('payment')->insert([

                'log_id' =>
                    $user_id,

                'from_id' =>
                    2,

                'to_id' =>
                    $user_id,

                'amount' =>
                    $servicepayment,

                'ad_info' =>
                    $ad_info,

                'service_status' =>
                    'IN Payment',

                'time' =>
                    $time,

                'paydate' =>
                    $date,

                'pay_id' =>
                    $user_id,

                'newbalance' =>
                    $adminBalance

            ]);

            /*
            |--------------------------------------------------------------------------
            | USER WALLET UPDATE
            |--------------------------------------------------------------------------
            */

            DB::table('users')
                ->where('id',$user_id)
                ->update([

                    'wallet' =>
                        $userBalance

                ]);

        }
                $date           = date('Y-m-d');
                $time           = date('H:i:s');
                $service_status = 'Out Payment';
                $ad_info        = 'Ramji Wallet Debit(DL Pdf)';
                $getrawallet    = DB::table('users')->select('rawallet')->where('id', 1)->first();
                $rawallet       = 0;
                if ($getrawallet) {
                    $balance1 = $getrawallet->rawallet;
                }

                $getrawallet1 = DB::table('users')->select('rawallet')->where('id', 2)->first();
                $rawallet1    = 0;
                if ($getrawallet1) {
                    $balance2 = $getrawallet1->rawallet;
                }
                $newbalance2 = $balance1 + $amount;
                $newbalance3 = $balance2 - $amount;
                $sql         = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$amount','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
                DB::insert(DB::raw($sql));
                $sql = "update users set rawallet = rawallet + $amount where id = 1";
                DB::update(DB::raw($sql));
                $service_status = 'IN Payment';
                $ad_info        = 'Ramji Wallet Credit(DL PDF)';
                $sql            = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$amount','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
                DB::insert(DB::raw($sql));
                $sql = "update users set rawallet = rawallet - $amount where id = 2";
                DB::update(DB::raw($sql));

        DB::commit();

        return response()->json([

            'status' =>
                'success',

            'file' =>
                url(
                    '/upload/dl/'.$filename
                )

        ]);

    } catch (\Exception $e) {

        DB::rollback();

        return response()->json([

            'status' =>
                'failed',

            'message' =>
                $e->getMessage()

        ]);
    }
}
}
