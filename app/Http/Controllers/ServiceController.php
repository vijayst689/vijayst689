<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class ServiceController extends Controller
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

    public function service()
    {
        if (Auth::user()->user_type_id != 1) {
            return redirect("/dashboard");
        }
        return view('services.service');
    }

    public function allservice($customerid)
    {
        $userPermission = DB::table('user_permission')
            ->where('user_id', Auth::user()->id)
            ->where('parent_id', 3)
            ->pluck('service_id');

        $adminPermission = DB::table('user_permission')
            ->where('user_id', 2)
            ->where('parent_id', 3)
            ->pluck('service_id');

        $finalServiceIds = $userPermission->intersect($adminPermission);
        if (Auth::user()->user_type_id == 1 || Auth::user()->user_type_id == 5) {
            $ourservice = DB::table('services')->where('status', '=', 'Active')->where('ser_id', 1)->orderBy('id', 'Asc')->get();
        } else {
            $ourservice = DB::table('services')->where('status', '=', 'Active')->where('ser_id', 1)->whereIn('id', $finalServiceIds)->orderBy('id', 'Asc')->get();
        }

        return view('services.allservice', compact('ourservice', 'customerid'));
    }

    public function allservices()
    {

        $ourservice = DB::table('services')->where('status', '=', 'Active')->where('parent_id', 0)->where('ser_id', 0)->orderBy('id', 'Asc')->get();

        return view('services.allservices', compact('ourservice'));
    }

    public function ourservice()
    {
        return view('services.ourservice');
    }

    public function subservice($id)
    {
        if (Auth::user()->user_type_id != 1 && Auth::user()->user_type_id != 2) {
            return redirect("/dashboard");
        }
        $service = DB::table('services')->where('parent_id', $id)->orderBy('id', 'Asc')->get();
        $getservicename = DB::table('services')->where('id', $id)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        return view('services.subservice', compact('servicename', 'id', 'service'));
    }

    public function viewservice()
    {
        if (Auth::user()->user_type_id != 1 && Auth::user()->user_type_id != 2) {
            return redirect("/dashboard");
        }
        $checkpermission = DB::table('user_permission')->where('user_id', Auth::user()->id)->where('parent_id', 3)->get();
        if (Auth::user()->user_type_id == 2) {
            $allservice = DB::table('services')->where('parent_id', 0)->where('ser_id', 0)->whereIn('id', $checkpermission->pluck('service_id'))->orderBy('id', 'Asc')->get();
        } else {
            $allservice = DB::table('services')->where('parent_id', 0)->orderBy('id', 'Asc')->get();
        }
        return view('services.viewservice', compact('allservice'));
    }

    public function addservice(Request $request)
    {

        $addservice = DB::table('services')->insert([
            'service_name'  => $request->service_name,
            'status'        => 'Active'
        ]);

        $insertid = DB::getPdo()->lastInsertId();

        $service_image = "";
        if ($request->service_image != null) {
            $service_image = $insertid . '.' . $request->file('service_image')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'service' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['service_image']['tmp_name'], $filepath . $service_image);
        }
        $image = DB::table('services')->where('id', $insertid)->update([
            'service_image'    => $service_image,
        ]);

        return redirect("/viewservice")->with('success', 'Service Add Successfully ... !');
    }

    public function updateservice(Request $request)
    {
        DB::table('services')->where('id', $request->service_id)->update([
            'service_name'  => $request->service_name,
            'status'        => $request->status,
        ]);

        $service_image = "";
        if ($request->service_image != null) {
            $service_image = $request->service_id . '.' . $request->file('service_image')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'service' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['service_image']['tmp_name'], $filepath . $service_image);
            $sql = "update services set service_image='$service_image' where id = $request->service_id";
            DB::update(DB::raw($sql));
        }
        if ($request->software != null) {
            $filename = $request->file('software')->getClientOriginalName();
            $software = $filename . '.' . $request->file('software')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'software' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['software']['tmp_name'], $filepath . $software);

            $sql = "update services set software='$software' where id = $request->service_id";
            DB::update(DB::raw($sql));
        }
        return redirect()->back()->with('success', 'Service Updated Successfully');
    }

    public function dropservice($id)
    {

        $dropservice = DB::table('services')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Service Deleted Successfully ... !');
    }

    public function dropsubservice($id)
    {

        $dropsubservice = DB::table('services')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'SubService Deleted Successfully ... !');
    }

    public function addsubservice(Request $request)
    {
        DB::table('services')->insert([
            'parent_id'  => $request->service_id,
            'service_name'  => $request->service_name,
            'amount'        => $request->amount,
            'ramjiservice_id'        => $request->ramjiservice_id,
            'status' => 'Active',
        ]);

        return redirect()->back()->with('success', 'SubService Added Successfully');
    }

    public function updatesubservice(Request $request)
    {
        //dd($request->all());
        DB::table('services')->where('id', $request->service_id)->update([
            'service_name'  => $request->service_name,
            'status'        => $request->status,
            'ramjiservice_id'        => $request->ramjiservice_id,
            'amount'        => $request->amount,
        ]);
        if ($request->sub_service_image != null) {
            $sub_service_image = uniqid() . '.' . $request->file('sub_service_image')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'sub_service' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['sub_service_image']['tmp_name'], $filepath . $sub_service_image);

            $sql = "update services set sub_service_image='$sub_service_image' where id = $request->service_id";
            DB::update(DB::raw($sql));
        }

        if ($request->software != null) {
            $filename = $request->file('software')->getClientOriginalName();
            $software = $filename;
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'software' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['software']['tmp_name'], $filepath . $software);

            $sql = "update services set software='$software' where id = $request->service_id";
            DB::update(DB::raw($sql));
        }
        return redirect()->back()->with('success', 'SubService Updated Successfully');
    }

    // public function services($serviceid,$customerid) {
    //  $services = DB::table('services')->where('status', '=' , 'Active')->where('parent_id',$serviceid)->orderBy( 'id' , 'Asc' )->get();
    //  $customers = DB::table('users')->where('id',$customerid)->get();
    //  $customers = json_decode( json_encode( $customers ), true );
    //  foreach ( $customers as $key => $customer ) {
    //     $customers[ $key ][ 'document' ] = array();
    //     $customerid = $customer[ 'id' ];
    //     $customer_document = DB::table('cus_document')->where('customer_id',$customerid)->get();
    //     if(count($customer_document) > 0){
    //         $customers[ $key ][ 'document' ] = $customer_document;
    //     }
    // }
    // $customers = json_decode( json_encode( $customers ));

    // return view('services.services',compact( 'services','customers','customerid','serviceid'));
    // }

    public function services($serviceid, $customerid)
    {
        $userid = Auth::user()->id;

        // User permissions
        $userPermission = DB::table('user_permission')
            ->where('service_id', '!=', 6)
            ->where('user_id', $userid)
            ->where('parent_id', 3)
            ->pluck('service_id');

        // Admin permissions
        $adminPermission = DB::table('user_permission')
            ->where('service_id', '!=', 6)
            ->where('user_id', 2) // admin id
            ->where('parent_id', 3)
            ->pluck('service_id');

        // Final allowed services
        $finalServiceIds = $userPermission
            ->intersect($adminPermission)
            ->push(6);

        if (Auth::user()->user_type_id == 1) {

            // Services
            $services = DB::table('services')
                ->where('status', 'Active')
                ->where('parent_id', $serviceid)
                ->orderBy('id', 'Asc')
                ->get();

            // Customer
            $customers = DB::table('users')
                ->where('id', $customerid)
                ->get()
                ->map(function ($customer) {
                    $customer->document = DB::table('cus_document')
                        ->where('customer_id', $customer->id)
                        ->get();
                    return $customer;
                });
        } else {
            $services = DB::table('services')
                ->where('status', 'Active')
                ->where('parent_id', $serviceid)
                ->whereIn('id', $finalServiceIds)
                ->orderBy('id', 'Asc')
                ->get();

            // Customer
            $customers = DB::table('users')
                ->where('id', $customerid)
                ->get()
                ->map(function ($customer) {
                    $customer->document = DB::table('cus_document')
                        ->where('customer_id', $customer->id)
                        ->get();
                    return $customer;
                });
        }

        return view(
            'services.services',
            compact('services', 'customers', 'customerid', 'serviceid')
        );
    }

    public function servicesone($serviceid)
    {
        $userid         = Auth::user()->id;
      $userid = Auth::user()->id;

// User permissions
$userPermission = DB::table('user_permission')
    ->where('service_id', '!=', 6)
    ->where('user_id', $userid)
    ->where('parent_id', 3)
    ->pluck('service_id')
    ->map(fn($id) => (int) $id);

// Admin permissions
$adminPermission = DB::table('user_permission')
    ->where('service_id', '!=', 6)
    ->where('user_id', 2)
    ->where('parent_id', 3)
    ->pluck('service_id')
    ->map(fn($id) => (int) $id);

// Common permissions
$finalServiceIds = $userPermission
    ->intersect($adminPermission)
    ->values();

/*
|--------------------------------------------------------------------------
| OLD TNEGA SERVICE -> NEW SERVICE
|--------------------------------------------------------------------------
*/

$serviceMap = [
    260 => 3,
    261 => 2,
    262 => 15,
    263 => 11,
    264 => 14,
    265 => 25,
    266 => 4,
    267 => 20,
    268 => 171,
    269 => 28,
];


foreach ($serviceMap as $newServiceId => $oldServiceId) {

    if ($finalServiceIds->contains((int) $oldServiceId)) {
        $finalServiceIds->push((int) $newServiceId);
    }
}

// Service 6 always allowed
$finalServiceIds = $finalServiceIds
    ->push(6)
    ->unique()
    ->values();

        if (Auth::user()->user_type_id == 1) {
            $services = DB::table('services')->where('status', '=', 'Active')->where('parent_id', $serviceid)->orderBy('id', 'Asc')->get();
        } else {
            $services = DB::table('services')->where('status', '=', 'Active')->where('parent_id', $serviceid)->whereIn('id', $finalServiceIds)->orderBy('id', 'Asc')->get();
        }
        $sql = "select count(*) as activecount from users where verified = 1 ";
        $users = DB::select(DB::raw($sql));
        if (count($users) > 0) {
            $activecount = $users[0]->activecount;
        }
        $sql = "select count(*) as memcount from nalavariyam_customer where refferal = $userid";
        $users = DB::select(DB::raw($sql));
        if (count($users) > 0) {
            $memcount = $users[0]->memcount;
        }
        $sql = "select count(*) as memcountref from nalavariyam_customer where refferal = $userid ";
        $users = DB::select(DB::raw($sql));
        if (count($users) > 0) {
            $memcountref = $users[0]->memcountref;
        }

        if (Auth::user()->id == 1 || Auth::user()->id == 2) {

            $sql = "select count(*) as pending from nalavariyam_form a,nalavariyam_district b,users c where a.dist_id=b.id and a.log_id=c.id and a.service_status = 'Pending'";
            $result = DB::select(DB::raw($sql));
            if (count($result) > 0) {
                $pendingcount = $result[0]->pending;
            }
        } else {
            $log_id = Auth::user()->id;
            $sql = "select count(*) as pending from nalavariyam_form a,nalavariyam_district b,nalavariyam_customer c where a.dist_id=b.id and a.customer_id=c.id and a.service_status = 'Pending' and a.log_id = $log_id";
            $result = DB::select(DB::raw($sql));
            if (count($result) > 0) {
                $pendingcount = $result[0]->pending;
            }
        }

        if (Auth::user()->id == 1 || Auth::user()->id == 2) {

            $sql = "select count(*) as resubmit from nalavariyam_form a,nalavariyam_district b,users c where a.dist_id=b.id and a.log_id=c.id and a.service_status = 'Resubmit'";
            $result = DB::select(DB::raw($sql));
            if (count($result) > 0) {
                $resubmitcount = $result[0]->resubmit;
            }
        } else {
            $log_id = Auth::user()->id;
            $sql = "select count(*) as resubmit from nalavariyam_form a,nalavariyam_district b,nalavariyam_customer c where a.dist_id=b.id and a.customer_id=c.id and a.service_status = 'Resubmit' and a.log_id = $log_id";
            $result = DB::select(DB::raw($sql));
            if (count($result) > 0) {
                $resubmitcount = $result[0]->resubmit;
            }
        }

        if (Auth::user()->id == 1 || Auth::user()->id == 2) {

            $sql = "select count(*) as approved from nalavariyam_form a,nalavariyam_district b,users c where a.dist_id=b.id and a.log_id=c.id and a.service_status = 'Completed'";
            $result = DB::select(DB::raw($sql));
            if (count($result) > 0) {
                $approvedcount = $result[0]->approved;
            }
        } else {
            $log_id = Auth::user()->id;
            $sql = "select count(*) as approved from nalavariyam_form a,nalavariyam_district b,nalavariyam_customer c where a.dist_id=b.id and a.customer_id=c.id and a.service_status = 'Completed' and a.log_id = $log_id";
            $result = DB::select(DB::raw($sql));
            if (count($result) > 0) {
                $approvedcount = $result[0]->approved;
            }
        }
        $districts = DB::table('nalavariyam_district')->get();
        $rawallet = DB::table('users')->select('nalavariyamwallet')->where('id', 2)->first();

        return view('services.servicesone', compact('services', 'serviceid', 'activecount', 'memcount', 'memcountref', 'pendingcount', 'resubmitcount', 'approvedcount', 'districts', 'rawallet'));
    }

    public function applyservice($serviceid, $customerid)
    {
        $userid = Auth::user()->id;

// Get services user has permission for (excluding service 6)
$userPermission = DB::table('user_permission')
    ->where('service_id', '!=', 6)
    ->where('user_id', $userid)
    ->where('parent_id', 3)
    ->pluck('service_id')
    ->map(fn($id) => (int) $id);

// Get admin allowed services (excluding service 6)
$adminPermission = DB::table('user_permission')
    ->where('service_id', '!=', 6)
    ->where('user_id', 2) // admin id
    ->where('parent_id', 3)
    ->pluck('service_id')
    ->map(fn($id) => (int) $id);

// Intersect user and admin permissions
$finalServiceIds = $userPermission
    ->intersect($adminPermission)
    ->values();

/*
|--------------------------------------------------------------------------
| OLD TNEGA SERVICE -> NEW FLOW SERVICE
|--------------------------------------------------------------------------
| New Service ID => Old TNEGA Service ID
|--------------------------------------------------------------------------
*/

$serviceMap = [
    260 => 3,
    261 => 2,
    262 => 15,
    263 => 11,
    264 => 14,
    265 => 25,
    266 => 4,
    267 => 20,
    268 => 171,
    269 => 28,
];

/*
|--------------------------------------------------------------------------
| AUTOMATIC NEW SERVICE
|--------------------------------------------------------------------------
*/

foreach ($serviceMap as $newServiceId => $oldServiceId) {

    if ($finalServiceIds->contains((int) $oldServiceId)) {

        $finalServiceIds->push((int) $newServiceId);
    }
}

/*
|--------------------------------------------------------------------------
| Always allow Service ID 6
|--------------------------------------------------------------------------
*/

$finalServiceIds = $finalServiceIds
    ->push(6)
    ->unique()
    ->values();
    
        // Check if user has permission for this service
        if (!$finalServiceIds->contains($serviceid)) {
            return view('errors.no_permission'); // or any view you want
        }
        $districts = DB::table( 'district' )->get();
        $getservicename = DB::table('services')->where('id', $serviceid)->first();
        $servicename = "";
        $amount = 0;
        if ($getservicename) {
            $servicename = $getservicename->service_name;
            $amount = $getservicename->amount;
        }
        $getservice_payment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        $payment = 0;
        $coordinator_permission = 0;
        $admin_payment = 0;

        if ($getservice_payment) {
            $coordinator_permission = $getservice_payment->coordinator_permission;
            if ($coordinator_permission == 1) {
                $admin_payment = $getservice_payment->admin_amount;
            }
            if (Auth::user()->user_type_id == 3) {
                $payment = $getservice_payment->distributor_amount;
            } elseif (Auth::user()->user_type_id == 4) {
                $payment = $getservice_payment->retailer_amount;
            } elseif (Auth::user()->user_type_id == 5) {
                $payment = $getservice_payment->customer_amount;
            }
        }
        if ($payment == "") {
            $payment = 0;
        }
        $customers = DB::table('customers')->where('id', $customerid)->first();
        $mainbalance = DB::table('users')->select('rawallet')->where('id', 2)->first();
        view()->share('mainbalance', $mainbalance);
        view()->share('admin_payment', $admin_payment);
        $declar = DB::table('declaration')->get();

        if ($serviceid == 2) {
            $mainbalance = DB::table('users')->select('rawallet')->where('id', 2)->first();
            return view('applyservice.tnegaservice1', compact('serviceid', 'districts', 'servicename', 'amount', 'customers', 'payment', 'mainbalance', 'coordinator_permission', 'admin_payment'));
        }elseif ($serviceid == 260) {
             $mainbalance = DB::table('users')->select('rawallet')->where('id', 2)->first();
             $customers = null;

        if (!empty($customerid)) {
             $customer_id = Crypt::decryptString(urldecode($customerid));
             $customers = DB::table('tnega_customers')
            ->where('id', $customer_id)
            ->first();          
        }
            return view('applyservice.tnegacommunity', compact('serviceid', 'districts', 'servicename', 'amount', 'customers', 'payment', 'mainbalance', 'coordinator_permission', 'admin_payment'));
        }elseif ($serviceid == 261) {
            $mainbalance = DB::table('users')->select('rawallet')->where('id', 2)->first();
            $customers = null;

if (!empty($customerid) && $customerid != 0) {

    $customerid = Crypt::decryptString(urldecode($customerid));

    $customers = DB::table('tnega_customers')
        ->where('id', $customerid)
        ->first();
}
    $customers = null;
    if (!empty($customerid) && $customerid > 0) {
        $customers = DB::table('tnega_customers')
            ->where('id', $customerid)
            ->first();
    }
    return view('applyservice.tnegaincome', compact('serviceid','districts','servicename','amount','customers','payment','mainbalance','coordinator_permission','admin_payment'));

    }elseif ($serviceid == 262) {
        $mainbalance = DB::table('users')->select('rawallet')->where('id', 2)->first();
    $customers = null;
if (!empty($customerid) && $customerid != 0) {

    $customerid = Crypt::decryptString(urldecode($customerid));

    $customers = DB::table('tnega_customers')
        ->where('id', $customerid)
        ->first();
}
    $customers = null;
    if (!empty($customerid) && $customerid > 0) {
        $customers = DB::table('tnega_customers')
            ->where('id', $customerid)
            ->first();
    }
    return view('applyservice.tnegafirstgraduat', compact('serviceid','districts','servicename','amount','customers','payment','mainbalance', 'coordinator_permission','declar'));
    }elseif ($serviceid == 263) {
        $mainbalance = DB::table('users')->select('rawallet')->where('id', 2)->first();
    $customers = null;
if (!empty($customerid) && $customerid != 0) {

    $customerid = Crypt::decryptString(urldecode($customerid));

    $customers = DB::table('tnega_customers')
        ->where('id', $customerid)
        ->first();
}
    $customers = null;
    if (!empty($customerid) && $customerid > 0) {
        $customers = DB::table('tnega_customers')
            ->where('id', $customerid)
            ->first();
    }
    return view('applyservice.tneganativity', compact('serviceid','districts','servicename','amount','customers','mainbalance', 'coordinator_permission','payment'));
    }elseif ($serviceid == 264) {
        $mainbalance = DB::table('users')->select('rawallet')->where('id', 2)->first();
    $customers = null;
if (!empty($customerid) && $customerid != 0) {

    $customerid = Crypt::decryptString(urldecode($customerid));

    $customers = DB::table('tnega_customers')
        ->where('id', $customerid)
        ->first();
}
    $customers = null;
    if (!empty($customerid) && $customerid > 0) {
        $customers = DB::table('tnega_customers')
            ->where('id', $customerid)
            ->first();
    }
    return view('applyservice.tnegaresidence', compact('serviceid','districts','servicename','amount','customers','mainbalance', 'coordinator_permission','payment'));
    }elseif ($serviceid == 265) {
        $mainbalance = DB::table('users')->select('rawallet')->where('id', 2)->first();
    $customers = null;
if (!empty($customerid) && $customerid != 0) {

    $customerid = Crypt::decryptString(urldecode($customerid));

    $customers = DB::table('tnega_customers')
        ->where('id', $customerid)
        ->first();
}
    $customers = null;
    if (!empty($customerid) && $customerid > 0) {
        $customers = DB::table('tnega_customers')
            ->where('id', $customerid)
            ->first();
    }
    return view('applyservice.tnegaunemployed', compact('serviceid','districts','servicename','amount','customers','mainbalance', 'coordinator_permission','payment'));
    }elseif ($serviceid == 266) {
        $mainbalance = DB::table('users')->select('rawallet')->where('id', 2)->first();
    $customers = null;
if (!empty($customerid) && $customerid != 0) {

    $customerid = Crypt::decryptString(urldecode($customerid));

    $customers = DB::table('tnega_customers')
        ->where('id', $customerid)
        ->first();
}
    $customers = null;
    if (!empty($customerid) && $customerid > 0) {
        $customers = DB::table('tnega_customers')
            ->where('id', $customerid)
            ->first();
    }
    $obc = DB::table('obc_castes')
    ->orderBy('serial_no')
    ->get();
    return view('applyservice.tnegaobccertificate', compact('serviceid','districts','servicename','amount','customers','payment','mainbalance', 'coordinator_permission','obc'));
    }elseif ($serviceid == 267) {
        $mainbalance = DB::table('users')->select('rawallet')->where('id', 2)->first();
    $customers = null;
if (!empty($customerid) && $customerid != 0) {

    $customerid = Crypt::decryptString(urldecode($customerid));

    $customers = DB::table('tnega_customers')
        ->where('id', $customerid)
        ->first();
}
    $customers = null;
    if (!empty($customerid) && $customerid > 0) {
        $customers = DB::table('tnega_customers')
            ->where('id', $customerid)
            ->first();
    }
    return view('applyservice.tnegaunmarriedcertificate', compact('serviceid','districts','servicename','amount','customers','mainbalance', 'coordinator_permission','payment'));
    }elseif ($serviceid == 268) {
        $mainbalance = DB::table('users')->select('rawallet')->where('id', 2)->first();
    $customers = null;
if (!empty($customerid) && $customerid != 0) {

    $customerid = Crypt::decryptString(urldecode($customerid));

    $customers = DB::table('tnega_customers')
        ->where('id', $customerid)
        ->first();
}
    $customers = null;
    if (!empty($customerid) && $customerid > 0) {
        $customers = DB::table('tnega_customers')
            ->where('id', $customerid)
            ->first();
    }
    return view('applyservice.tnegadifferentlyabledpersons', compact('serviceid','districts','servicename','amount','customers','mainbalance', 'coordinator_permission','payment'));
    }elseif ($serviceid == 269) {
        $mainbalance = DB::table('users')->select('rawallet')->where('id', 2)->first();
    $customers = null;
if (!empty($customerid) && $customerid != 0) {

    $customerid = Crypt::decryptString(urldecode($customerid));

    $customers = DB::table('tnega_customers')
        ->where('id', $customerid)
        ->first();
}
    $customers = null;
    if (!empty($customerid) && $customerid > 0) {
        $customers = DB::table('tnega_customers')
            ->where('id', $customerid)
            ->first();
    }
    return view('applyservice.tnegawidowcertificate', compact('serviceid','districts','servicename','amount','customers','mainbalance', 'coordinator_permission','payment'));
        } elseif ($serviceid == 3) {
            $mainbalance = DB::table('users')->select('rawallet')->where('id', 2)->first();
            return view('applyservice.tnegaservice1', compact('serviceid', 'districts', 'servicename', 'amount', 'customers', 'payment', 'mainbalance', 'coordinator_permission', 'admin_payment'));
        } elseif ($serviceid == 4) {
            $mainbalance = DB::table('users')->select('rawallet')->where('id', 2)->first();
            return view('applyservice.tnegaservice1', compact('serviceid', 'districts', 'servicename', 'amount', 'customers', 'payment', 'mainbalance', 'coordinator_permission', 'admin_payment'));
        } elseif ($serviceid == 11) {
            $mainbalance = DB::table('users')->select('rawallet')->where('id', 2)->first();
            return view('applyservice.tnegaservice1', compact('serviceid', 'districts', 'servicename', 'amount', 'customers', 'payment', 'mainbalance', 'coordinator_permission', 'admin_payment'));
        } elseif ($serviceid == 14) {
            $mainbalance = DB::table('users')->select('rawallet')->where('id', 2)->first();
            return view('applyservice.tnegaservice1', compact('serviceid', 'districts', 'servicename', 'amount', 'customers', 'payment', 'mainbalance', 'coordinator_permission', 'admin_payment'));
        } elseif ($serviceid == 20) {
            $mainbalance = DB::table('users')->select('rawallet')->where('id', 2)->first();
            return view('applyservice.tnegaservice1', compact('serviceid', 'districts', 'servicename', 'amount', 'customers', 'payment', 'mainbalance', 'coordinator_permission', 'admin_payment'));
        } elseif ($serviceid == 22 || $serviceid == 23 || $serviceid == 24 || $serviceid == 25 || $serviceid == 26) {
            $mainbalance = DB::table('users')->select('rawallet')->where('id', 2)->first();
            return view('applyservice.tnegaservice2', compact('serviceid', 'districts', 'servicename', 'amount', 'customers', 'payment', 'mainbalance', 'coordinator_permission', 'admin_payment'));
        } elseif ($serviceid == 27 || $serviceid == 28 || $serviceid == 129) {
            $mainbalance = DB::table('users')->select('rawallet')->where('id', 2)->first();
            return view('applyservice.tnegaservice3', compact('serviceid', 'districts', 'servicename', 'amount', 'customers', 'payment', 'mainbalance', 'coordinator_permission', 'admin_payment'));
        } elseif ($serviceid == 151) {
            $mainbalance = DB::table('users')->select('rawallet')->where('id', 2)->first();
            return view('applyservice.tnegaservice4', compact('serviceid', 'districts', 'servicename', 'amount', 'customers', 'payment', 'mainbalance', 'coordinator_permission', 'admin_payment'));
        } elseif ($serviceid == 170 || $serviceid == 171 || $serviceid == 172 || $serviceid == 176 || $serviceid == 177 || $serviceid == 178) {
            $mainbalance = DB::table('users')->select('rawallet')->where('id', 2)->first();
            return view('applyservice.tnegaservice5', compact('serviceid', 'districts', 'servicename', 'amount', 'customers', 'payment', 'mainbalance', 'coordinator_permission', 'admin_payment'));
        } elseif ($serviceid == 60 || $serviceid == 62 || $serviceid == 63 || $serviceid == 64 || $serviceid == 66 || $serviceid == 121) {
            $mainbalance = DB::table('users')->select('rawallet')->where('id', 2)->first();
            return view('applyservice.caneditservice', compact('serviceid', 'districts', 'servicename', 'amount', 'customers', 'payment', 'mainbalance', 'coordinator_permission', 'admin_payment'));
        } elseif ($serviceid == 15) {
            $mainbalance = DB::table('users')->select('rawallet')->where('id', 2)->first();
            return view('applyservice.tnegaservice6', compact('serviceid', 'districts', 'servicename', 'amount', 'customers', 'declar', 'payment', 'mainbalance', 'coordinator_permission', 'admin_payment'));
        }
    }

    public function applyservices($serviceid)
    {
        $districts = DB::table('district')->get();
        $userPermission = DB::table('user_permission')
            ->where('service_id', '!=', 6)
            ->where('user_id', Auth::user()->id)
            ->where('parent_id', 3)
            ->pluck('service_id');

        $adminPermission = DB::table('user_permission')
            ->where('service_id', '!=', 6)
            ->where('user_id', 2) // admin id
            ->where('parent_id', 3)
            ->pluck('service_id');
        $finalServiceIds = $userPermission->intersect($adminPermission);

        if (!$finalServiceIds->contains($serviceid)) {
            return response()->view('errors.no_permission', [], 403);
        }
        $getservicename = DB::table('services')->where('id', $serviceid)->first();
        $servicename = "";
        $amount = 0;
        if ($getservicename) {
            $servicename = $getservicename->service_name;
            $amount = $getservicename->amount;
        }
        $getservice_payment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        $payment = 0;
        $coordinator_permission = 0;
        $admin_payment = 0;

        if ($getservice_payment) {
            $coordinator_permission = $getservice_payment->coordinator_permission;
            if ($coordinator_permission == 1) {
                $admin_payment = $getservice_payment->admin_amount;
            }
            if (Auth::user()->user_type_id == 3) {
                $payment = $getservice_payment->distributor_amount;
            } elseif (Auth::user()->user_type_id == 4) {
                $payment = $getservice_payment->retailer_amount;
            } elseif (Auth::user()->user_type_id == 5) {
                $payment = $getservice_payment->customer_amount;
            }
        }
        if ($payment == "") {
            $payment = 0;
        }
        $customers = DB::table('users')->orderBy('id', 'Asc')->first();

        $mainbalance = DB::table('users')->select('rawallet')->where('id', 2)->first();
        view()->share('mainbalance', $mainbalance);
        view()->share('admin_payment', $admin_payment);

        if ($serviceid == 17) {
            return view('backend.services.applyservice1', compact('serviceid', 'districts', 'servicename', 'amount', 'customers', 'payment'));

            //    }  elseif ($serviceid == 32){
            //        return view( 'applyservice.agricultureservice',compact('serviceid','districts','servicename','amount','customers','payment'));

        } elseif ($serviceid == 34) {
            return view('applyservice.msmeservice', compact('serviceid', 'districts', 'servicename', 'amount', 'payment', 'customers'));
        } elseif ($serviceid == 36) {
            $districts = DB::table('district')->orderBy('id', 'Asc')->get();
            $taluk = DB::table('taluk')->orderBy('id', 'Asc')->get();
            return view('applyservice.newsmartcardapply', compact('serviceid', 'districts', 'servicename', 'amount', 'smartpayment', 'taluk'));
        } elseif ($serviceid == 37 || $serviceid == 38 || $serviceid == 39 || $serviceid == 41 || $serviceid == 42 || $serviceid == 43) {
            $districts = DB::table('district')->where('id', '!=', 3)->get();
            $taluk = DB::table('taluk')->orderBy('id', 'Asc')->get();
            return view('applyservice.smartcardapply', compact('serviceid', 'districts', 'servicename', 'amount', 'payment', 'customers', 'taluk'));
        } elseif ($serviceid == 39) {
            return view('backend.services.applyservice6', compact('serviceid', 'districts', 'servicename', 'amount', 'customers', 'payment'));
        } elseif ($serviceid == 41) {
            return view('backend.services.applyservice6', compact('serviceid', 'districts', 'servicename', 'amount', 'customers', 'payment'));
        } elseif ($serviceid == 42) {
            return view('backend.services.applyservice6', compact('serviceid', 'districts', 'servicename', 'amount', 'customers', 'payment'));
        } elseif ($serviceid == 43) {
            return view('backend.services.applyservice6', compact('serviceid', 'districts', 'servicename', 'amount', 'customers', 'payment'));
        } elseif ($serviceid == 51) {
            return view('applyservice.itrservice', compact('serviceid', 'districts', 'servicename', 'amount', 'payment', 'customers'));
        } elseif ($serviceid == 52) {
            return view('applyservice.gstservice', compact('serviceid', 'districts', 'servicename', 'amount', 'payment', 'customers'));
        } elseif ($serviceid == 54) {
            return view('applyservice.techexamservice', compact('serviceid', 'districts', 'servicename', 'amount', 'payment', 'customers'));
        } elseif ($serviceid == 55) {
            return view('applyservice.techexamregister', compact('serviceid', 'districts', 'servicename', 'amount', 'payment', 'customers'));
        } elseif ($serviceid == 60 || $serviceid == 62 || $serviceid == 63 || $serviceid == 64 || $serviceid == 66 || $serviceid == 121) {
            $mainbalance = DB::table('users')->select('rawallet')->where('id', 2)->first();
            return view('applyservice.caneditservice', compact('serviceid', 'districts', 'servicename', 'amount', 'customers', 'payment', 'mainbalance', 'coordinator_permission', 'admin_payment'));
        } elseif ($serviceid == 65 || $serviceid == 67 || $serviceid == 226 || $serviceid == 227 || $serviceid == 246) {
            $mainbalance = DB::table('users')->select('rawallet')->where('id', 2)->first();
            return view('applyservice.caneditservice1', compact('serviceid', 'districts', 'servicename', 'amount', 'customers', 'payment', 'mainbalance', 'coordinator_permission', 'admin_payment'));
        } elseif ($serviceid == 124) {
            return view('applyservice.techcorrectionservice', compact('serviceid', 'districts', 'servicename', 'amount', 'payment', 'customers'));
        } elseif ($serviceid == 56) {
            $mainbalance = DB::table('users')->select('rawallet')->where('id', 2)->first();
            return view('applyservice.aadhaarcard_apply1', compact('serviceid', 'districts', 'servicename', 'amount', 'payment', 'customers', 'mainbalance', 'coordinator_permission', 'admin_payment'));
        } elseif ($serviceid == 158) {
            $mainbalance = DB::table('users')->select('rawallet')->where('id', 2)->first();
            return view('applyservice.aadhaarcard_apply2', compact('serviceid', 'districts', 'servicename', 'amount', 'payment', 'customers', 'mainbalance', 'coordinator_permission', 'admin_payment'));
        } elseif ($serviceid == 58 || $serviceid == 159 || $serviceid == 160 || $serviceid == 161 || $serviceid == 162 || $serviceid == 163) {
            $mainbalance = DB::table('users')->select('rawallet')->where('id', 2)->first();
            return view('applyservice.aadhaarcard_apply', compact('serviceid', 'districts', 'servicename', 'amount', 'payment', 'customers', 'mainbalance', 'coordinator_permission', 'admin_payment'));

            //    }  elseif ($serviceid == 71 || $serviceid == 69 || $serviceid == 70){
            //     $mainbalance = DB::table( 'users' )->select('rawallet')->where('id',2)->first();
            //     return view( 'applyservice.panservice',compact('serviceid','districts','servicename','amount','payment','customers','mainbalance'));

        } elseif ($serviceid == 113 || $serviceid == 120 || $serviceid == 164 || $serviceid == 182 || $serviceid == 181) {
            return view('applyservice.voteridservice', compact('serviceid', 'districts', 'servicename', 'amount', 'payment', 'customers'));
        } elseif ($serviceid == 72) {
            $mainbalance = DB::table('users')->select('rawallet')->where('id', 2)->first();
            return view('applyservice.aadhaar_findservice', compact('serviceid', 'districts', 'servicename', 'amount', 'payment', 'customers', 'mainbalance', 'coordinator_permission', 'admin_payment'));
        } elseif ($serviceid == 95 || $serviceid == 96 || $serviceid == 97 || $serviceid == 98) {
            return view('applyservice.nalavariyamservice', compact('serviceid', 'districts', 'servicename', 'amount', 'payment', 'customers'));
        } elseif ($serviceid == 77 || $serviceid == 78 ||  $serviceid == 79 || $serviceid == 80 || $serviceid == 81 || $serviceid == 82 || $serviceid == 83 || $serviceid == 84) {
            return view('applyservice.smartcardapply1', compact('serviceid', 'districts', 'servicename', 'amount', 'payment', 'customers'));
        } elseif ($serviceid == 100) {
            $mainbalance = DB::table('users')->select('rawallet')->where('id', 2)->first();
            return view('applyservice.bondapply', compact('serviceid', 'districts', 'servicename', 'amount', 'payment', 'customers', 'mainbalance', 'coordinator_permission', 'admin_payment'));
        } elseif ($serviceid == 69 || $serviceid == 70 || $serviceid == 71) {
            $mainbalance = DB::table('users')->select('rawallet')->where('id', 2)->first();
            return view('applyservice.voterid_pdfdownloadservice', compact('serviceid', 'districts', 'servicename', 'amount', 'customers', 'payment', 'mainbalance', 'coordinator_permission', 'admin_payment'));
        } elseif ($serviceid == 122 || $serviceid == 123) {
            $mainbalance = DB::table('users')->select('rawallet')->where('id', 2)->first();
            return view('applyservice.fssaiservice_apply', compact('serviceid', 'districts', 'servicename', 'amount', 'payment', 'customers', 'mainbalance', 'coordinator_permission', 'admin_payment'));
        } elseif ($serviceid == 125) {
            $mainbalance = DB::table('users')->select('rawallet')->where('id', 2)->first();
            return view('applyservice.agri_stackservice', compact('serviceid', 'districts', 'servicename', 'amount', 'payment', 'customers', 'mainbalance', 'coordinator_permission', 'admin_payment'));
        } elseif ($serviceid == 150 || $serviceid == 148) {
            return view('applyservice.driving_licenceservice', compact('serviceid', 'districts', 'servicename', 'amount', 'payment', 'customers'));
        } elseif ($serviceid == 152 || $serviceid == 153 || $serviceid == 154) {
            $mainbalance = DB::table('users')->select('nalavariyamwallet')->where('id', 2)->first();
            return view('applyservice.tailor_shop_service', compact('serviceid', 'districts', 'servicename', 'amount', 'payment', 'customers', 'mainbalance', 'coordinator_permission', 'admin_payment'));
        } elseif ($serviceid == 155 || $serviceid == 156) {
            return view('applyservice.birthcertificate_service', compact('serviceid', 'districts', 'servicename', 'amount', 'payment', 'customers'));
        } elseif ($serviceid == 157) {
            return view('applyservice.pmkissanservice', compact('serviceid', 'districts', 'servicename', 'amount', 'payment', 'customers'));
        } elseif ($serviceid == 165) {
            return view('applyservice.tec_csc_service', compact('serviceid', 'districts', 'servicename', 'amount', 'payment', 'customers'));
        } elseif ($serviceid == 166) {
            return view('applyservice.iibf_exam_registeration', compact('serviceid', 'districts', 'servicename', 'amount', 'payment', 'customers'));
        } elseif ($serviceid == 167) {
            return view('applyservice.ins_exam', compact('serviceid', 'districts', 'servicename', 'amount', 'customers', 'payment'));
        } elseif ($serviceid == 168) {
            return view('applyservice.rap_exam', compact('serviceid', 'districts', 'servicename', 'amount', 'customers', 'payment'));
        } elseif ($serviceid == 169) {
            return view('applyservice.vle_insurance', compact('serviceid', 'districts', 'servicename', 'amount', 'customers', 'payment'));
        } elseif ($serviceid == 179 || $serviceid == 180) {
            $mainbalance = DB::table('users')->select('rawallet')->where('id', 2)->first();
            return view('applyservice.medicalscheme', compact('serviceid', 'districts', 'servicename', 'amount', 'customers', 'payment', 'mainbalance', 'coordinator_permission', 'admin_payment'));
        } elseif ($serviceid == 208 || $serviceid == 209 || $serviceid == 210 || $serviceid == 211  || $serviceid == 229 || $serviceid == 230) {
            $mainbalance = DB::table('users')->select('rawallet')->where('id', 2)->first();
            return view('applyservice.can_editservice', compact('serviceid', 'districts', 'servicename', 'amount', 'customers', 'payment', 'mainbalance', 'coordinator_permission', 'admin_payment'));
        } elseif ($serviceid == 183 || $serviceid == 184 || $serviceid == 185 || $serviceid == 186) {
            return view('applyservice.dharsanservice', compact('serviceid', 'districts', 'servicename', 'amount', 'customers', 'payment'));
        } elseif ($serviceid == 213 || $serviceid == 214 || $serviceid == 215 || $serviceid == 219 || $serviceid == 247 || $serviceid == 248) {
            return view('applyservice.pattaservice', compact('serviceid', 'districts', 'servicename', 'amount', 'customers', 'payment'));
        } elseif ($serviceid == 217) {
            $mainbalance = DB::table('users')->select('wallet')->where('id', 2)->first();
            $pandetails = DB::table('utislpan')->where('user_id', Auth::user()->id)->where('service_id', $serviceid)->orderBy('id', 'Desc')->get();
            return view('applyservice.newpan', compact('serviceid', 'districts', 'servicename', 'amount', 'customers', 'payment', 'pandetails', 'mainbalance'));
        } elseif ($serviceid == 218) {
            $mainbalance = DB::table('users')->select('wallet')->where('id', 2)->first();
            $pandetails = DB::table('utislpan')->where('user_id', Auth::user()->id)->where('service_id', $serviceid)->orderBy('id', 'Desc')->get();
            return view('applyservice.utislpancorrection', compact('serviceid', 'districts', 'servicename', 'amount', 'customers', 'payment', 'pandetails', 'mainbalance'));
        } elseif ($serviceid == 225) {
            return view('applyservice.pstmservice', compact('serviceid', 'districts', 'servicename', 'amount', 'payment', 'customers'));
        } elseif ($serviceid == 221) {
            $mainbalance = DB::table('users')->select('rawallet')->where('id', 2)->first();
            return view('applyservice.smartcard_otpservice', compact('serviceid', 'districts', 'servicename', 'amount', 'customers', 'payment', 'mainbalance', 'coordinator_permission', 'admin_payment'));
        } elseif ($serviceid == 222 || $serviceid == 223 || $serviceid == 228 || $serviceid == 231 || $serviceid == 232 || $serviceid == 233 || $serviceid == 234 || $serviceid == 235 || $serviceid == 236 || $serviceid == 237 || $serviceid == 238 || $serviceid == 239 || $serviceid == 240 || $serviceid == 241  || $serviceid == 242 || $serviceid == 243 || $serviceid == 258) {
            $mainbalance = DB::table('users')->select('rawallet')->where('id', 2)->first();
            return view('applyservice.smartcard_nametransfer', compact('serviceid', 'districts', 'servicename', 'amount', 'customers', 'payment', 'mainbalance', 'coordinator_permission', 'admin_payment'));
        } elseif ($serviceid == 242) {
            $mainbalance = DB::table('users')->select('rawallet')->where('id', 2)->first();
            return view('applyservice.smartcard_correctionservice', compact('serviceid', 'districts', 'servicename', 'amount', 'customers', 'payment', 'mainbalance', 'coordinator_permission', 'admin_payment'));
        } elseif ($serviceid == 244 || $serviceid == 251 || $serviceid == 252 || $serviceid == 253 || $serviceid == 254 || $serviceid == 255) {
            $mainbalance = DB::table('users')->select('rawallet')->where('id', 2)->first();
            return view('applyservice.employmentservice', compact('serviceid', 'districts', 'servicename', 'amount', 'customers', 'payment',  'mainbalance', 'coordinator_permission', 'admin_payment'));
        } elseif ($serviceid == 245) {
            return view('applyservice.policeservice', compact('serviceid', 'districts', 'servicename', 'amount', 'customers', 'payment'));
        } elseif ($serviceid == 249) {
            $mainbalance = DB::table('users')->select('rawallet')->where('id', 2)->first();
            return view('applyservice.smartcard_pdfservice', compact('serviceid', 'districts', 'servicename', 'amount', 'customers', 'payment', 'mainbalance', 'coordinator_permission', 'admin_payment'));
        } elseif ($serviceid == 250 || $serviceid == 256 || $serviceid == 257 || $serviceid == 270 || $serviceid == 271) {
            $mainbalance = DB::table('users')->select('rawallet')->where('id', 2)->first();
            return view('applyservice.manual_pdfservice', compact('serviceid', 'districts', 'servicename', 'amount', 'customers', 'payment', 'mainbalance', 'coordinator_permission', 'admin_payment'));
        }
    }


    public function get_subservice($parentid)
    {
        $get_subservice = DB::table('services')->where('parent_id', $parentid)->orderBy('id', 'Asc')->get();
        return response()->json($get_subservice);
    }

    public function get_taluk($distid)
    {
        $response = DB::table('taluk')->where('dist_id', $distid)->orderBy('id', 'Asc')->get();
        return response()->json($response);
    }

    public function variyamget_taluk($districtid)
    {
        $response = DB::table('nalavariyam_taluk')->where('parent', $districtid)->orderBy('id', 'Asc')->get();
        return response()->json($response);
    }

    public function get_panchayath($taluk_id)
    {
        $response = DB::table('panchayath')->where('taluk_id', $taluk_id)->orderBy('id', 'Asc')->get();
        return response()->json($response);
    }



    public function submit_applyservice(Request $request)
    {
        $retailer_id = 0;
        $distributor_id = 0;
        $customer_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $request->customerid;
        }
        $amount = explode('~', $request->serviceid);
        DB::table('applied_service')->insert([
            'service_id'        => $amount[0],
            'amount'            => $amount[1],
            'customer_id'       => $request->customerid,
            'retailer_id'       => $user_id,
            'distributor_id'    => $user_id,
        ]);
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        return redirect()->back()->with('success', 'Service Applied Successfully');
    }

    public function submitapply_tnegaservices1(Request $request)
    {

        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
        DB::table('tnega_services')->insert([
            'user_id'  =>   $user_id,
            'retailer_id'  =>   $retailer_id,
            'distributor_id'  =>   $distributor_id,
            'service_id'    => $request->serviceid,
            'amount'        => $request->amount,
            'can_details'        => $request->can_details,
            'personalized'        => $request->personalized,
            'relationship_1'        => $request->relationship_1,
            'dob'        => $request->dob,
            'religion'        => $request->religion,
            'education'        => $request->education,
            'work'        => $request->work,
            'door_no'        => $request->door_no,
            'personalized_name_tamil'        => $request->personalized_name_tamil,
            'relationship_name_tamil_1'        => $request->relationship_name_tamil_1,
            'community'        => $request->community,
            'smartcard_number'        => $request->smartcard_number,
            'street_name_tamil'        => $request->street_name_tamil,
            'personalized_name_english'        => $request->personalized_name_english,
            'relationship_name_english_1'        => $request->relationship_name_english_1,
            'maritial_status'        => $request->maritial_status,
            'caste'        => $request->caste,
            'street_name'        => $request->street_name,
            'pin_code'        => $request->pin_code,
            'can_number'        => $request->can_number,
            'mother_name_tamil'        => $request->mother_name_tamil,
            'mother_name_english'        => $request->mother_name_english,
            'postal_area_tamil'        => $request->postal_area_tamil,
            'postal_area_english'        => $request->postal_area_english,
            'father_community'        => $request->father_community,
            'father_caste'        => $request->father_caste,
            'mother_community'        => $request->mother_community,
            'mother_caste'        => $request->mother_caste,
            'status'        => 'Pending',
            'applied_date'  => date("Y-m-d"),
            'created_at'    => date("Y-m-d"),
        ]);

        $insertid = DB::getPdo()->lastInsertId();
        if ($serviceid == 2) {
            $salaryslip = "";
            $pancard = "";
            if ($request->salary_slip != null) {
                $salaryslip = uniqid() . '.' . $request->file('salary_slip')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'salary_slip' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['salary_slip']['tmp_name'], $filepath . $salaryslip);
            }

            if ($request->pancard != null) {
                $pancard = uniqid() . '.' . $request->file('pancard')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'pancard' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['pancard']['tmp_name'], $filepath . $pancard);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'job_type'            => $request->job_type,
                'salary_slip'         => $salaryslip,
                'pancard'             => $pancard,
                'income_yearly'       => $request->income_yearly,
                'income_monthly'      => $request->income_monthly,
            ]);
        } elseif ($serviceid == 3) {
            $tc_community_certificate = "";
            $affidavit = "";
            $self_community_certificate = "";
            if ($request->tc_community_certificate != null) {
                $tc_community_certificate = uniqid() . '.' . $request->file('tc_community_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'tc_community_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['tc_community_certificate']['tmp_name'], $filepath . $tc_community_certificate);
            }
            if ($request->affidavit != null) {
                $affidavit = uniqid() . '.' . $request->file('affidavit')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'affidavit' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['affidavit']['tmp_name'], $filepath . $affidavit);
            }
            if ($request->self_community_certificate != null) {
                $self_community_certificate = uniqid() . '.' . $request->file('self_community_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'self_community_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['self_community_certificate']['tmp_name'], $filepath . $self_community_certificate);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'relationship'                     => $request->relationship,
                'tc_community_certificate'         => $tc_community_certificate,
                'affidavit'                        => $affidavit,
                'self_community_certificate'       => $self_community_certificate,
            ]);
        } elseif ($serviceid == 4) {
            $income_certificate = "";
            if ($request->income_certificate != null) {
                $income_certificate = uniqid() . '.' . $request->file('income_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'income_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['income_certificate']['tmp_name'], $filepath . $income_certificate);
            }
            $community_certificate = "";
            if ($request->community_certificate != null) {
                $community_certificate = uniqid() . '.' . $request->file('community_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'community_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['community_certificate']['tmp_name'], $filepath . $community_certificate);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'income_certificate'         => $income_certificate,
                'community_certificate'         => $community_certificate,
            ]);
        } elseif ($serviceid == 11) {
            $birth_certificate = "";
            if ($request->birth_certificate != null) {
                $birth_certificate = uniqid() . '.' . $request->file('birth_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'birth_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['birth_certificate']['tmp_name'], $filepath . $birth_certificate);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'birth_certificate'         => $birth_certificate,
            ]);
        } elseif ($serviceid == 14) {
            $smartcard_online = "";
            if ($request->smartcard_online != null) {
                $smartcard_online = uniqid() . '.' . $request->file('smartcard_online')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smartcard_online' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['smartcard_online']['tmp_name'], $filepath . $smartcard_online);
            }

            DB::table('tnega_services')->where('id', $insertid)->update([
                'smartcard_no'             => $request->smartcard_no,
                'smartcard_online'         => $smartcard_online,
            ]);
        } elseif ($serviceid == 20) {
            $birth_certificate = "";
            if ($request->birth_certificate != null) {
                $birth_certificate = uniqid() . '.' . $request->file('birth_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'birth_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['birth_certificate']['tmp_name'], $filepath . $birth_certificate);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'birth_certificate'         => $birth_certificate,
            ]);
            $voterid = "";
            if ($request->voterid != null) {
                $voterid = uniqid() . '.' . $request->file('voterid')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'voterid' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['voterid']['tmp_name'], $filepath . $voterid);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'voterid'         => $voterid,
            ]);
            $driving_license = "";
            if ($request->driving_license != null) {
                $driving_license = uniqid() . '.' . $request->file('driving_license')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'driving_license' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['driving_license']['tmp_name'], $filepath . $driving_license);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'driving_license'         => $driving_license,
            ]);
            $marksheet = "";
            if ($request->marksheet != null) {
                $marksheet = uniqid() . '.' . $request->file('marksheet')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'marksheet' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['marksheet']['tmp_name'], $filepath . $marksheet);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'marksheet'         => $marksheet,
            ]);
            $tc_community_certificate = "";
            if ($request->tc_community_certificate != null) {
                $tc_community_certificate = uniqid() . '.' . $request->file('tc_community_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'tc_community_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['tc_community_certificate']['tmp_name'], $filepath . $tc_community_certificate);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'tc_community_certificate'         => $tc_community_certificate,
            ]);
            $mrg_invitation = "";
            if ($request->mrg_invitation != null) {
                $mrg_invitation = uniqid() . '.' . $request->file('mrg_invitation')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'mrg_invitation' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['mrg_invitation']['tmp_name'], $filepath . $mrg_invitation);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'mrg_invitation'         => $mrg_invitation,
            ]);

            DB::table('tnega_services')->where('id', $insertid)->update([
                'age_proof'         => $request->age_proof,
            ]);
        }

        if ($request->has('family_relationship')) {
            foreach ($request->family_relationship as $key => $relation) {
                $relation_name = $request->relation_name[$key];
                $relation_name_tamil = $request->relation_name_tamil[$key];
                $relation_age = $request->relation_age[$key];
                $relation_income = $request->relation_income[$key];
                $occupation = $request->occupation[$key];

                $sql = "insert into family_member (service_id,relation,relation_name,relation_name_tamil,relation_age,relation_income,occupation) values ($insertid,'$relation','$relation_name','$relation_name_tamil','$relation_age','$relation_income','$occupation')";
                DB::insert($sql);
            }
        }


        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        $getpermission = DB::table('service_payment')->where('service_id', $serviceid)->first();
        $coordinator_permission = 0;
        $admin_payment = 0;
        if ($getpermission) {
            $coordinator_permission = $getpermission->coordinator_permission;
            $admin_payment = $getpermission->admin_amount;
        }
        if ($coordinator_permission == 1) {
            $post_data = array();

            $getdata = DB::table('tnega_services')->where('id', $insertid)->get();
            $getdata = json_decode(json_encode($getdata), true);
            foreach ($getdata as $key => $ser) {
                $getdata[$key]['family_details'] = array();
                $getdata[$key]['customer_details'] = array();
                $getdata[$key]['details'] = array();
                $getdata[$key]['agri_details'] = array();
                $getdata[$key]['agri_documents'] = array();
                $ser_id = $ser['id'];
                $user_id = $ser['user_id'];
                $sql = "select * from family_member where service_id=$ser_id order by id Asc";
                $result = DB::select($sql);
                $sql = "select * from customers where id=$user_id";
                $result1 = DB::select($sql);
                $getdata[$key]['family_details'] = $result;
                $getdata[$key]['customer_details'] = $result1;
            }
            if (count($getdata) > 0) {

                $API_KEY = env('API_KEY', '');
                $RAMJIPAY_URL = env('RAMJIPAY_URL', '');
                $WEBSITE_INDEX = env('WEBSITE_INDEX', '');
                $post_data['data'] = $getdata;
                $post_data['key'] = $API_KEY;
                $post_data['index'] = $WEBSITE_INDEX;
                $ch = curl_init();
                //dd(json_encode($post_data));
                //dd($post_data);
                $url1 = $RAMJIPAY_URL . '/api/get_tnegaservices_api';
                //echo $url1;die;
                curl_setopt($ch, CURLOPT_URL, $url1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $server_output = curl_exec($ch);
                curl_close($ch);
                $resdata = json_decode($server_output, true);
                //dd($resdata);
                if ($resdata) {
                    $status = $resdata['message'];
                    if ($status == "Success") {
                        $date = date('Y-m-d');
                        $time = date('H:i:s');
                        $service_status = 'Out Payment';
                        $ad_info = 'Ramji Wallet Debit' . ' ' . $servicename;
                        $getrawallet = DB::table('users')->select('rawallet')->where('id', 1)->first();
                        $rawallet = 0;
                        if ($getrawallet) {
                            $balance1 = $getrawallet->rawallet;
                        }

                        $getrawallet1 = DB::table('users')->select('rawallet')->where('id', 2)->first();
                        $rawallet1 = 0;
                        if ($getrawallet1) {
                            $balance2 = $getrawallet1->rawallet;
                        }
                        $newbalance2 = $balance1 + $admin_payment;
                        $newbalance3 = $balance2 - $admin_payment;
                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet + $admin_payment where id = 1";
                        DB::update(DB::raw($sql));
                        $service_status = 'IN Payment';
                        $ad_info = 'Ramji Wallet Credit' . ' ' . $servicename;

                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet - $admin_payment where id = 2";
                        DB::update(DB::raw($sql));
                    }
                }
            }
        }

        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }
    public function submitapply_tnegaservices2(Request $request)
    {

        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
        DB::table('tnega_services')->insert([
            'user_id'         =>   $user_id,
            'retailer_id'     =>   $retailer_id,
            'distributor_id'  =>   $distributor_id,
            'service_id'      => $request->serviceid,
            'amount'          => $request->amount,
            'can_details'     => $request->can_details,
            'personalized'        => $request->personalized,
            'relationship_1'        => $request->relationship_1,
            'dob'        => $request->dob,
            'religion'        => $request->religion,
            'education'        => $request->education,
            'work'        => $request->work,
            'door_no'        => $request->door_no,
            'personalized_name_tamil'        => $request->personalized_name_tamil,
            'relationship_name_tamil_1'        => $request->relationship_name_tamil_1,
            'community'        => $request->community,
            'smartcard_number'        => $request->smartcard_number,
            'street_name_tamil'        => $request->street_name_tamil,
            'personalized_name_english'        => $request->personalized_name_english,
            'relationship_name_english_1'        => $request->relationship_name_english_1,
            'maritial_status'        => $request->maritial_status,
            'caste'        => $request->caste,
            'street_name'        => $request->street_name,
            'pin_code'        => $request->pin_code,
            'can_number'      => $request->can_number,
            'mother_name_tamil'        => $request->mother_name_tamil,
            'mother_name_english'        => $request->mother_name_english,
            'postal_area_tamil'        => $request->postal_area_tamil,
            'postal_area_english'        => $request->postal_area_english,
            'status'          => 'Pending',
            'applied_date'    => date("Y-m-d"),
            'created_at'      => date("Y-m-d"),
        ]);

        $insertid = DB::getPdo()->lastInsertId();
        if ($serviceid == 22) {
            $hus_wife_photo = "";
            if ($request->hus_wife_photo != null) {
                $hus_wife_photo = uniqid() . '.' . $request->file('hus_wife_photo')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'hus_wife_photo' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['hus_wife_photo']['tmp_name'], $filepath . $hus_wife_photo);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'hus_wife_photo'         => $hus_wife_photo,
            ]);
            $permanent_social_certificate_groom = "";
            if ($request->permanent_social_certificate_groom != null) {
                $permanent_social_certificate_groom = uniqid() . '.' . $request->file('permanent_social_certificate_groom')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'permanent_social_certificate_groom' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['permanent_social_certificate_groom']['tmp_name'], $filepath . $permanent_social_certificate_groom);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'permanent_social_certificate_groom'         => $permanent_social_certificate_groom,
            ]);
            $bride_permanent_social_certificate = "";
            if ($request->bride_permanent_social_certificate != null) {
                $bride_permanent_social_certificate = uniqid() . '.' . $request->file('bride_permanent_social_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'bride_permanent_social_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['bride_permanent_social_certificate']['tmp_name'], $filepath . $bride_permanent_social_certificate);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'bride_permanent_social_certificate'         => $bride_permanent_social_certificate,
            ]);
            $mrg_registration_certificate = "";
            if ($request->mrg_registration_certificate != null) {
                $mrg_registration_certificate = uniqid() . '.' . $request->file('mrg_registration_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'mrg_registration_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['mrg_registration_certificate']['tmp_name'], $filepath . $mrg_registration_certificate);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'mrg_registration_certificate'         => $mrg_registration_certificate,
            ]);
            $anyothers_certificate = "";
            if ($request->anyothers_certificate != null) {
                $anyothers_certificate = uniqid() . '.' . $request->file('anyothers_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'anyothers_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['anyothers_certificate']['tmp_name'], $filepath . $anyothers_certificate);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'anyothers_certificate'         => $anyothers_certificate,
            ]);
        } elseif ($serviceid == 23) {
            $chitta = "";
            if ($request->chitta != null) {
                $chitta = uniqid() . '.' . $request->file('chitta')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'chitta' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['chitta']['tmp_name'], $filepath . $chitta);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'chitta'         => $chitta,
            ]);
            $aggregation = "";
            if ($request->aggregation != null) {
                $aggregation = uniqid() . '.' . $request->file('aggregation')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aggregation' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aggregation']['tmp_name'], $filepath . $aggregation);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'aggregation'         => $aggregation,
            ]);
            $strap = "";
            if ($request->strap != null) {
                $strap = uniqid() . '.' . $request->file('strap')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'strap' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['strap']['tmp_name'], $filepath . $strap);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'strap'         => $strap,
            ]);
            $villankam = "";
            if ($request->villankam != null) {
                $villankam = uniqid() . '.' . $request->file('villankam')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'villankam' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['villankam']['tmp_name'], $filepath . $villankam);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'villankam'         => $villankam,
            ]);
            $vao_certificate = "";
            if ($request->vao_certificate != null) {
                $vao_certificate = uniqid() . '.' . $request->file('vao_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'vao_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['vao_certificate']['tmp_name'], $filepath . $vao_certificate);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'vao_certificate'         => $vao_certificate,
            ]);
            $self_declaration_certificate = "";
            if ($request->self_declaration_certificate != null) {
                $self_declaration_certificate = uniqid() . '.' . $request->file('self_declaration_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'self_declaration_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['self_declaration_certificate']['tmp_name'], $filepath . $self_declaration_certificate);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'self_declaration_certificate'         => $self_declaration_certificate,
            ]);
            $other_certificate = "";
            if ($request->other_certificate != null) {
                $other_certificate = uniqid() . '.' . $request->file('other_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'other_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['other_certificate']['tmp_name'], $filepath . $other_certificate);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'other_certificate'         => $other_certificate,
            ]);

            DB::table('tnega_services')->where('id', $insertid)->update([
                'any_proof'         => $request->any_proof,
                'area'         => $request->area,
            ]);


            if ($request->has('doc_name')) {
                foreach ($request->doc_name as $key => $r) {

                    $sql = "insert into document (service_id,doc_name) values ($insertid,'$r')";
                    DB::insert($sql);

                    $relation_id = DB::getPdo()->lastInsertId();
                    $file1 = "";
                    if (isset($request->doc[$key])) {
                        if ($request->doc[$key] != null) {
                            $file1 = uniqid() . '.' . $request->file('doc')[$key]->extension();
                            //dd($request->doc[$key]);
                            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'doc' . DIRECTORY_SEPARATOR);
                            move_uploaded_file($_FILES['doc']['tmp_name'][$key], $filepath . $file1);
                            DB::table('document')->where('id', $relation_id)->update([
                                'doc'       => $file1,
                            ]);
                        }
                    }
                }
            }
            if ($request->has('proof')) {
                foreach ($request->proof as $key => $proof) {
                    $district = $request->district[$key];
                    $taluk = $request->taluk[$key];
                    $village = $request->village[$key];
                    $patta_no = $request->patta_no[$key];
                    $field_no = $request->field_no[$key];
                    $subdivision_no = $request->subdivision_no[$key];
                    $area = $request->area1[$key];

                    $sql = "insert into agri_details (service_id,district,taluk,village,patta_no,field_no,subdivision_no,area,pattatype) values ($insertid,'$district','$taluk','$village','$patta_no','$field_no','$subdivision_no','$area','$proof')";
                    DB::insert($sql);
                }
            }
        } elseif ($serviceid == 24) {
            $bank_pass_book = "";
            if ($request->bank_pass_book != null) {
                $bank_pass_book = uniqid() . '.' . $request->file('bank_pass_book')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'bank_pass_book' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['bank_pass_book']['tmp_name'], $filepath . $bank_pass_book);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'bank_pass_book'         => $bank_pass_book,
                'any_proof'         => $request->any_proof,
            ]);
            $passport = "";
            if ($request->passport != null) {
                $passport = uniqid() . '.' . $request->file('passport')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'passport' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['passport']['tmp_name'], $filepath . $passport);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'passport'         => $passport,
            ]);
            $pancard = "";
            if ($request->pancard != null) {
                $pancard = uniqid() . '.' . $request->file('pancard')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'pancard' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['pancard']['tmp_name'], $filepath . $pancard);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'pancard'         => $pancard,
            ]);
            $voterid = "";
            if ($request->voterid != null) {
                $voterid = uniqid() . '.' . $request->file('voterid')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'voterid' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['voterid']['tmp_name'], $filepath . $voterid);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'voterid'         => $voterid,
            ]);
            $driving_license = "";
            if ($request->driving_license != null) {
                $driving_license = uniqid() . '.' . $request->file('driving_license')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'driving_license' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['driving_license']['tmp_name'], $filepath . $driving_license);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'driving_license'         => $driving_license,
            ]);
        } elseif ($serviceid == 25) {
            $placement_registration = "";
            if ($request->placement_registration != null) {
                $placement_registration = uniqid() . '.' . $request->file('placement_registration')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'placement_registration' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['placement_registration']['tmp_name'], $filepath . $placement_registration);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'placement_registration'         => $placement_registration,
            ]);
            $school_transfer_certificate = "";
            if ($request->school_transfer_certificate != null) {
                $school_transfer_certificate = uniqid() . '.' . $request->file('school_transfer_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'school_transfer_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['school_transfer_certificate']['tmp_name'], $filepath . $school_transfer_certificate);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'school_transfer_certificate'         => $school_transfer_certificate,
            ]);
            $study_proof = "";
            if ($request->study_proof != null) {
                $study_proof = uniqid() . '.' . $request->file('study_proof')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'study_proof' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['study_proof']['tmp_name'], $filepath . $study_proof);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'study_proof'         => $study_proof,
            ]);
            $family_income_certificate = "";
            if ($request->family_income_certificate != null) {
                $family_income_certificate = uniqid() . '.' . $request->file('family_income_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'family_income_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['family_income_certificate']['tmp_name'], $filepath . $family_income_certificate);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'family_income_certificate'         => $family_income_certificate,
            ]);
        } elseif ($serviceid == 26) {
            $husband_death_certificate = "";
            if ($request->husband_death_certificate != null) {
                $husband_death_certificate = uniqid() . '.' . $request->file('husband_death_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'husband_death_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['husband_death_certificate']['tmp_name'], $filepath . $husband_death_certificate);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'husband_death_certificate'         => $husband_death_certificate,
            ]);
            $legal_heir_certificate = "";
            if ($request->legal_heir_certificate != null) {
                $legal_heir_certificate = uniqid() . '.' . $request->file('legal_heir_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'legal_heir_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['legal_heir_certificate']['tmp_name'], $filepath . $legal_heir_certificate);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'legal_heir_certificate'         => $legal_heir_certificate,
            ]);
            $income_certificate = "";
            if ($request->income_certificate != null) {
                $income_certificate = uniqid() . '.' . $request->file('income_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'income_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['income_certificate']['tmp_name'], $filepath . $income_certificate);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'income_certificate'         => $income_certificate,
            ]);
            $anyothers_certificate = "";
            if ($request->anyothers_certificate != null) {
                $anyothers_certificate = uniqid() . '.' . $request->file('anyothers_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'anyothers_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['anyothers_certificate']['tmp_name'], $filepath . $anyothers_certificate);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'anyothers_certificate'         => $anyothers_certificate,
            ]);
        }



        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        $getpermission = DB::table('service_payment')->where('service_id', $serviceid)->first();
        $coordinator_permission = 0;
        $admin_payment = 0;
        if ($getpermission) {
            $coordinator_permission = $getpermission->coordinator_permission;
            $admin_payment = $getpermission->admin_amount;
        }
        if ($coordinator_permission == 1) {
            $post_data = array();

            $getdata = DB::table('tnega_services')->where('id', $insertid)->get();
            $getdata = json_decode(json_encode($getdata), true);
            foreach ($getdata as $key => $ser) {
                $getdata[$key]['family_details'] = array();
                $getdata[$key]['customer_details'] = array();
                $getdata[$key]['agri_details'] = array();
                $getdata[$key]['agri_documents'] = array();
                $getdata[$key]['details'] = array();

                $ser_id = $ser['id'];
                $user_id = $ser['user_id'];
                $sql = "select * from family_member where service_id=$ser_id order by id Asc";
                $result = DB::select($sql);

                $sql = "select * from customers where id=$user_id";
                $result1 = DB::select($sql);

                $sql = "select * from agri_details where service_id=$ser_id order by id Asc";
                $result2 = DB::select($sql);

                $sql = "select * from document where service_id=$ser_id order by id Asc";
                $result3 = DB::select($sql);

                $getdata[$key]['family_details'] = $result;
                $getdata[$key]['customer_details'] = $result1;
                $getdata[$key]['agri_details'] = $result2;
                $getdata[$key]['agri_documents'] = $result3;
            }

            if (count($getdata) > 0) {

                $API_KEY = env('API_KEY', '');
                $RAMJIPAY_URL = env('RAMJIPAY_URL', '');
                $WEBSITE_INDEX = env('WEBSITE_INDEX', '');
                $post_data['data'] = $getdata;
                $post_data['key'] = $API_KEY;
                $post_data['index'] = $WEBSITE_INDEX;
                $ch = curl_init();

                //echo "<pre>";print_r($post_data);echo"</pre>";die;
                //dd(json_encode($post_data));
                //dd($post_data);
                $url1 = $RAMJIPAY_URL . '/api/get_tnegaservices_api';
                //echo $url1;die;
                curl_setopt($ch, CURLOPT_URL, $url1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $server_output = curl_exec($ch);
                curl_close($ch);
                $resdata = json_decode($server_output, true);
                //dd($resdata);
                if ($resdata) {
                    $status = $resdata['message'];
                    if ($status == "Success") {
                        $date = date('Y-m-d');
                        $time = date('H:i:s');
                        $service_status = 'Out Payment';
                        $ad_info = 'Ramji Wallet Debit' . ' ' . $servicename;
                        $getrawallet = DB::table('users')->select('rawallet')->where('id', 1)->first();
                        $rawallet = 0;
                        if ($getrawallet) {
                            $balance1 = $getrawallet->rawallet;
                        }

                        $getrawallet1 = DB::table('users')->select('rawallet')->where('id', 2)->first();
                        $rawallet1 = 0;
                        if ($getrawallet1) {
                            $balance2 = $getrawallet1->rawallet;
                        }
                        $newbalance2 = $balance1 + $admin_payment;
                        $newbalance3 = $balance2 - $admin_payment;
                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet + $admin_payment where id = 1";
                        DB::update(DB::raw($sql));
                        $service_status = 'IN Payment';
                        $ad_info = 'Ramji Wallet Credit' . ' ' . $servicename;

                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet - $admin_payment where id = 2";
                        DB::update(DB::raw($sql));
                    }
                }
            }
        }
        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }

    public function submitapply_tnegaservices3(Request $request)
    {

        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
        DB::table('tnega_services')->insert([
            'user_id'         =>   $user_id,
            'retailer_id'     =>   $retailer_id,
            'distributor_id'  =>   $distributor_id,
            'service_id'      => $request->serviceid,
            'amount'          => $request->amount,
            'can_details'     => $request->can_details,
            'personalized'        => $request->personalized,
            'relationship_1'        => $request->relationship_1,
            'dob'        => $request->dob,
            'religion'        => $request->religion,
            'education'        => $request->education,
            'work'        => $request->work,
            'door_no'        => $request->door_no,
            'personalized_name_tamil'        => $request->personalized_name_tamil,
            'relationship_name_tamil_1'        => $request->relationship_name_tamil_1,
            'community'        => $request->community,
            'smartcard_number'        => $request->smartcard_number,
            'street_name_tamil'        => $request->street_name_tamil,
            'personalized_name_english'        => $request->personalized_name_english,
            'relationship_name_english_1'        => $request->relationship_name_english_1,
            'maritial_status'        => $request->maritial_status,
            'caste'        => $request->caste,
            'street_name'        => $request->street_name,
            'pin_code'        => $request->pin_code,
            'can_number'      => $request->can_number,
            'mother_name_tamil'        => $request->mother_name_tamil,
            'mother_name_english'        => $request->mother_name_english,
            'postal_area_tamil'        => $request->postal_area_tamil,
            'postal_area_english'        => $request->postal_area_english,
            'status'          => 'Pending',
            'applied_date'    => date("Y-m-d"),
            'created_at'      => date("Y-m-d"),
        ]);

        $insertid = DB::getPdo()->lastInsertId();
        if ($serviceid == 27) {
            DB::table('tnega_services')->where('id', $insertid)->update([
                'any_proof'         => $request->id_proof,
            ]);
            $husband_death_certificate = "";
            if ($request->husband_death_certificate != null) {
                $husband_death_certificate = uniqid() . '.' . $request->file('husband_death_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'husband_death_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['husband_death_certificate']['tmp_name'], $filepath . $husband_death_certificate);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'husband_death_certificate'         => $husband_death_certificate,
            ]);
            $widow_certificate = "";
            if ($request->widow_certificate != null) {
                $widow_certificate = uniqid() . '.' . $request->file('widow_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'widow_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['widow_certificate']['tmp_name'], $filepath . $widow_certificate);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'widow_certificate'         => $widow_certificate,
            ]);
            $bank_pass_book = "";
            if ($request->bank_pass_book != null) {
                $bank_pass_book = uniqid() . '.' . $request->file('bank_pass_book')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'bank_pass_book' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['bank_pass_book']['tmp_name'], $filepath . $bank_pass_book);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'bank_pass_book'         => $bank_pass_book,
            ]);
            $passport = "";
            if ($request->passport != null) {
                $passport = uniqid() . '.' . $request->file('passport')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'passport' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['passport']['tmp_name'], $filepath . $passport);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'passport'         => $passport,
            ]);
            $pancard = "";
            if ($request->pancard != null) {
                $pancard = uniqid() . '.' . $request->file('pancard')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'pancard' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['pancard']['tmp_name'], $filepath . $pancard);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'pancard'         => $pancard,
            ]);
            $voterid = "";
            if ($request->voterid != null) {
                $voterid = uniqid() . '.' . $request->file('voterid')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'voterid' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['voterid']['tmp_name'], $filepath . $voterid);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'voterid'         => $voterid,
            ]);
            $driving_license = "";
            if ($request->driving_license != null) {
                $driving_license = uniqid() . '.' . $request->file('driving_license')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'driving_license' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['driving_license']['tmp_name'], $filepath . $driving_license);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'driving_license'         => $driving_license,
            ]);
        } elseif ($serviceid == 28) {
            DB::table('tnega_services')->where('id', $insertid)->update([
                'mrg_docdetails'         => $request->mrg_docdetails,
            ]);
            $husband_death_certificate = "";
            if ($request->husband_death_certificate != null) {
                $husband_death_certificate = uniqid() . '.' . $request->file('husband_death_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'husband_death_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['husband_death_certificate']['tmp_name'], $filepath . $husband_death_certificate);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'husband_death_certificate'         => $husband_death_certificate,
            ]);
            $mrg_invitation = "";
            if ($request->mrg_invitation != null) {
                $mrg_invitation = uniqid() . '.' . $request->file('mrg_invitation')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'mrg_invitation' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['mrg_invitation']['tmp_name'], $filepath . $mrg_invitation);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'mrg_invitation'         => $mrg_invitation,
            ]);
            $mrg_registration_certificate = "";
            if ($request->mrg_registration_certificate != null) {
                $mrg_registration_certificate = uniqid() . '.' . $request->file('mrg_registration_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'mrg_registration_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['mrg_registration_certificate']['tmp_name'], $filepath . $mrg_registration_certificate);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'mrg_registration_certificate'         => $mrg_registration_certificate,
            ]);
            $mrg_documents = "";
            if ($request->mrg_documents != null) {
                $mrg_documents = uniqid() . '.' . $request->file('mrg_documents')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'mrg_documents' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['mrg_documents']['tmp_name'], $filepath . $mrg_documents);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'mrg_documents'         => $mrg_documents,
            ]);
        } elseif ($serviceid == 129) {
            $tc_community_certificate = "";
            if ($request->tc_community_certificate != null) {
                $tc_community_certificate = uniqid() . '.' . $request->file('tc_community_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'tc_community_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['tc_community_certificate']['tmp_name'], $filepath . $tc_community_certificate);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'tc_community_certificate'         => $tc_community_certificate,
            ]);
        }

        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        $getpermission = DB::table('service_payment')->where('service_id', $serviceid)->first();
        $coordinator_permission = 0;
        $admin_payment = 0;
        if ($getpermission) {
            $coordinator_permission = $getpermission->coordinator_permission;
            $admin_payment = $getpermission->admin_amount;
        }
        if ($coordinator_permission == 1) {
            $post_data = array();

            $getdata = DB::table('tnega_services')->where('id', $insertid)->get();
            $getdata = json_decode(json_encode($getdata), true);
            foreach ($getdata as $key => $ser) {
                $getdata[$key]['family_details'] = array();
                $getdata[$key]['customer_details'] = array();
                $getdata[$key]['details'] = array();
                $getdata[$key]['agri_details'] = array();
                $getdata[$key]['agri_documents'] = array();
                $ser_id = $ser['id'];
                $user_id = $ser['user_id'];
                $sql = "select * from family_member where service_id=$ser_id order by id Asc";
                $result = DB::select($sql);
                $sql = "select * from customers where id=$user_id";
                $result1 = DB::select($sql);
                $getdata[$key]['family_details'] = $result;
                $getdata[$key]['customer_details'] = $result1;
            }
            if (count($getdata) > 0) {

                $API_KEY = env('API_KEY', '');
                $RAMJIPAY_URL = env('RAMJIPAY_URL', '');
                $WEBSITE_INDEX = env('WEBSITE_INDEX', '');
                $post_data['data'] = $getdata;
                $post_data['key'] = $API_KEY;
                $post_data['index'] = $WEBSITE_INDEX;
                $ch = curl_init();

                //echo "<pre>";print_r($post_data);echo"</pre>";die;
                //dd(json_encode($post_data));
                //dd($post_data);
                $url1 = $RAMJIPAY_URL . '/api/get_tnegaservices_api';
                //echo $url1;die;
                curl_setopt($ch, CURLOPT_URL, $url1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $server_output = curl_exec($ch);
                curl_close($ch);
                $resdata = json_decode($server_output, true);
                //
                //dd($resdata);
                if ($resdata) {
                    $status = $resdata['message'];
                    if ($status == "Success") {
                        $date = date('Y-m-d');
                        $time = date('H:i:s');
                        $service_status = 'Out Payment';
                        $ad_info = 'Ramji Wallet Debit' . ' ' . $servicename;
                        $getrawallet = DB::table('users')->select('rawallet')->where('id', 1)->first();
                        $rawallet = 0;
                        if ($getrawallet) {
                            $balance1 = $getrawallet->rawallet;
                        }

                        $getrawallet1 = DB::table('users')->select('rawallet')->where('id', 2)->first();
                        $rawallet1 = 0;
                        if ($getrawallet1) {
                            $balance2 = $getrawallet1->rawallet;
                        }
                        $newbalance2 = $balance1 + $admin_payment;
                        $newbalance3 = $balance2 - $admin_payment;
                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet + $admin_payment where id = 1";
                        DB::update(DB::raw($sql));
                        $service_status = 'IN Payment';
                        $ad_info = 'Ramji Wallet Credit' . ' ' . $servicename;

                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet - $admin_payment where id = 2";
                        DB::update(DB::raw($sql));
                    }
                }
            }
        }
        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }
    public function submitapply_tnegaservices4(Request $request)
    {

        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
        DB::table('tnega_services')->insert([
            'user_id'         =>   $user_id,
            'retailer_id'     =>   $retailer_id,
            'distributor_id'  =>   $distributor_id,
            'service_id'      => $request->serviceid,
            'amount'          => $request->amount,
            'can_details'     => $request->can_details,
            'personalized'        => $request->personalized,
            'relationship_1'        => $request->relationship_1,
            'dob'        => $request->dob,
            'religion'        => $request->religion,
            'education'        => $request->education,
            'work'        => $request->work,
            'door_no'        => $request->door_no,
            'personalized_name_tamil'        => $request->personalized_name_tamil,
            'relationship_name_tamil_1'        => $request->relationship_name_tamil_1,
            'community'        => $request->community,
            'smartcard_number'        => $request->smartcard_number,
            'street_name_tamil'        => $request->street_name_tamil,
            'personalized_name_english'        => $request->personalized_name_english,
            'relationship_name_english_1'        => $request->relationship_name_english_1,
            'maritial_status'        => $request->maritial_status,
            'caste'        => $request->caste,
            'street_name'        => $request->street_name,
            'pin_code'        => $request->pin_code,
            'can_number'      => $request->can_number,
            'mother_name_tamil'        => $request->mother_name_tamil,
            'mother_name_english'        => $request->mother_name_english,
            'postal_area_tamil'        => $request->postal_area_tamil,
            'postal_area_english'        => $request->postal_area_english,
            'status'          => 'Pending',
            'applied_date'    => date("Y-m-d"),
            'created_at'      => date("Y-m-d"),
        ]);

        $insertid = DB::getPdo()->lastInsertId();

        $aadhaar_card = "";
        if ($request->aadhaar_card != null) {
            $aadhaar_card = uniqid() . '.' . $request->file('aadhaar_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'aadhaar_card'         => $aadhaar_card,
        ]);
        $smart_card = "";
        if ($request->smart_card != null) {
            $smart_card = uniqid() . '.' . $request->file('smart_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smart_card);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'smart_card'         => $smart_card,
        ]);
        $photo = "";
        if ($request->photo != null) {
            $photo = uniqid() . '.' . $request->file('photo')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'photo'         => $photo,
        ]);
        $signature = "";
        if ($request->signature != null) {
            $signature = uniqid() . '.' . $request->file('signature')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'signature' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['signature']['tmp_name'], $filepath . $signature);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'signature'         => $signature,
        ]);
        $tailoring_certificate = "";
        if ($request->tailoring_certificate != null) {
            $tailoring_certificate = uniqid() . '.' . $request->file('tailoring_certificate')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'tailoring_certificate' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['tailoring_certificate']['tmp_name'], $filepath . $tailoring_certificate);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'tailoring_certificate'         => $tailoring_certificate,
        ]);
        $income_certificate = "";
        if ($request->income_certificate != null) {
            $income_certificate = uniqid() . '.' . $request->file('income_certificate')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'income_certificate' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['income_certificate']['tmp_name'], $filepath . $income_certificate);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'income_certificate'         => $income_certificate,
        ]);




        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        $getpermission = DB::table('service_payment')->where('service_id', $serviceid)->first();
        $coordinator_permission = 0;
        $admin_payment = 0;
        if ($getpermission) {
            $coordinator_permission = $getpermission->coordinator_permission;
            $admin_payment = $getpermission->admin_amount;
        }
        if ($coordinator_permission == 1) {
            $post_data = array();

            $getdata = DB::table('tnega_services')->where('id', $insertid)->get();
            $getdata = json_decode(json_encode($getdata), true);
            foreach ($getdata as $key => $ser) {
                $getdata[$key]['family_details'] = array();
                $getdata[$key]['customer_details'] = array();
                $getdata[$key]['details'] = array();
                $getdata[$key]['agri_details'] = array();
                $getdata[$key]['agri_documents'] = array();
                $ser_id = $ser['id'];
                $user_id = $ser['user_id'];
                $sql = "select * from family_member where service_id=$ser_id order by id Asc";
                $result = DB::select($sql);
                $sql = "select * from customers where id=$user_id";
                $result1 = DB::select($sql);
                $getdata[$key]['family_details'] = $result;
                $getdata[$key]['customer_details'] = $result1;
            }
            if (count($getdata) > 0) {

                $API_KEY = env('API_KEY', '');
                $RAMJIPAY_URL = env('RAMJIPAY_URL', '');
                $WEBSITE_INDEX = env('WEBSITE_INDEX', '');
                $post_data['data'] = $getdata;
                $post_data['key'] = $API_KEY;
                $post_data['index'] = $WEBSITE_INDEX;
                $ch = curl_init();

                //echo "<pre>";print_r($post_data);echo"</pre>";die;
                //dd(json_encode($post_data));
                //dd($post_data);
                $url1 = $RAMJIPAY_URL . '/api/get_tnegaservices_api';
                //echo $url1;die;
                curl_setopt($ch, CURLOPT_URL, $url1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $server_output = curl_exec($ch);
                curl_close($ch);
                $resdata = json_decode($server_output, true);
                //
                //dd($resdata);
                if ($resdata) {
                    $status = $resdata['message'];
                    if ($status == "Success") {
                        $date = date('Y-m-d');
                        $time = date('H:i:s');
                        $service_status = 'Out Payment';
                        $ad_info = 'Ramji Wallet Debit' . ' ' . $servicename;
                        $getrawallet = DB::table('users')->select('rawallet')->where('id', 1)->first();
                        $rawallet = 0;
                        if ($getrawallet) {
                            $balance1 = $getrawallet->rawallet;
                        }

                        $getrawallet1 = DB::table('users')->select('rawallet')->where('id', 2)->first();
                        $rawallet1 = 0;
                        if ($getrawallet1) {
                            $balance2 = $getrawallet1->rawallet;
                        }
                        $newbalance2 = $balance1 + $admin_payment;
                        $newbalance3 = $balance2 - $admin_payment;
                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet + $admin_payment where id = 1";
                        DB::update(DB::raw($sql));
                        $service_status = 'IN Payment';
                        $ad_info = 'Ramji Wallet Credit' . ' ' . $servicename;

                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet - $admin_payment where id = 2";
                        DB::update(DB::raw($sql));
                    }
                }
            }
        }
        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }

    public function submitapply_tnegaservices5(Request $request)
    {

        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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

        DB::table('tnega_services')->insert([
            'user_id'       =>   $user_id,
            'retailer_id'   =>   $retailer_id,
            'distributor_id' =>   $distributor_id,
            'service_id'    => $request->serviceid,
            'amount'        => $request->amount,
            'can_details'   => $request->can_details,
            'personalized'        => $request->personalized,
            'relationship_1'        => $request->relationship_1,
            'dob'        => $request->dob,
            'religion'        => $request->religion,
            'education'        => $request->education,
            'work'        => $request->work,
            'door_no'        => $request->door_no,
            'personalized_name_tamil'        => $request->personalized_name_tamil,
            'relationship_name_tamil_1'        => $request->relationship_name_tamil_1,
            'community'        => $request->community,
            'smartcard_number'        => $request->smartcard_number,
            'street_name_tamil'        => $request->street_name_tamil,
            'personalized_name_english'        => $request->personalized_name_english,
            'relationship_name_english_1'        => $request->relationship_name_english_1,
            'maritial_status'        => $request->maritial_status,
            'caste'        => $request->caste,
            'street_name'        => $request->street_name,
            'pin_code'        => $request->pin_code,
            'can_number'    => $request->can_number,
            'handicapped_proof'    => $request->handicapped_proof,
            'mother_name_tamil'        => $request->mother_name_tamil,
            'mother_name_english'        => $request->mother_name_english,
            'postal_area_tamil'        => $request->postal_area_tamil,
            'postal_area_english'        => $request->postal_area_english,
            'status'        => 'Pending',
            'applied_date'  => date("Y-m-d"),
            'created_at'    => date("Y-m-d"),
        ]);

        $insertid = DB::getPdo()->lastInsertId();
        if ($serviceid == 170) {
            $aadhaar_card = "";
            if ($request->aadhaar_card != null) {
                $aadhaar_card = uniqid() . '.' . $request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'aadhaar_card'         => $aadhaar_card,
            ]);
            $smart_card = "";
            if ($request->smart_card != null) {
                $smart_card = uniqid() . '.' . $request->file('smart_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smart_card);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'smart_card'         => $smart_card,
            ]);
            $photo = "";
            if ($request->photo != null) {
                $photo = uniqid() . '.' . $request->file('photo')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'photo'         => $photo,
            ]);
            $signature = "";
            if ($request->signature != null) {
                $signature = uniqid() . '.' . $request->file('signature')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'signature' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['signature']['tmp_name'], $filepath . $signature);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'signature'         => $signature,
            ]);
            $family_photo = "";
            if ($request->family_photo != null) {
                $family_photo = uniqid() . '.' . $request->file('family_photo')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'family_photo' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['family_photo']['tmp_name'], $filepath . $family_photo);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'family_photo'         => $family_photo,
            ]);
            $address_proof = "";
            if ($request->address_proof != null) {
                $address_proof = uniqid() . '.' . $request->file('address_proof')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'address_proof' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['address_proof']['tmp_name'], $filepath . $address_proof);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'address_proof'         => $address_proof,
            ]);
            $birth_certificate_children = "";
            if ($request->birth_certificate_children != null) {
                $birth_certificate_children = uniqid() . '.' . $request->file('birth_certificate_children')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'birth_certificate_children' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['birth_certificate_children']['tmp_name'], $filepath . $birth_certificate_children);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'birth_certificate_children'         => $birth_certificate_children,
            ]);
            $family_plannnig_certificate = "";
            if ($request->family_plannnig_certificate != null) {
                $family_plannnig_certificate = uniqid() . '.' . $request->file('family_plannnig_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'family_plannnig_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['family_plannnig_certificate']['tmp_name'], $filepath . $family_plannnig_certificate);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'family_plannnig_certificate'         => $family_plannnig_certificate,
            ]);
            $self_declaration_certificate = "";
            if ($request->self_declaration_certificate != null) {
                $self_declaration_certificate = uniqid() . '.' . $request->file('self_declaration_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'self_declaration_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['self_declaration_certificate']['tmp_name'], $filepath . $self_declaration_certificate);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'self_declaration_certificate'         => $self_declaration_certificate,
            ]);
            $anyothers_certificate = "";
            if ($request->anyothers_certificate != null) {
                $anyothers_certificate = uniqid() . '.' . $request->file('anyothers_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'anyothers_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['anyothers_certificate']['tmp_name'], $filepath . $anyothers_certificate);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'anyothers_certificate'         => $anyothers_certificate,
            ]);
        } elseif ($serviceid == 171) {

            $udid_card = "";
            if ($request->udid_card != null) {
                $udid_card = uniqid() . '.' . $request->file('udid_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'udid_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['udid_card']['tmp_name'], $filepath . $udid_card);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'udid_card'         => $udid_card,
            ]);
            $bank_pass_book = "";
            if ($request->bank_pass_book != null) {
                $bank_pass_book = uniqid() . '.' . $request->file('bank_pass_book')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'bank_pass_book' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['bank_pass_book']['tmp_name'], $filepath . $bank_pass_book);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'bank_pass_book'         => $bank_pass_book,
            ]);
            $passport = "";
            if ($request->passport != null) {
                $passport = uniqid() . '.' . $request->file('passport')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'passport' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['passport']['tmp_name'], $filepath . $passport);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'passport'         => $passport,
            ]);
            $pancard = "";
            if ($request->pancard != null) {
                $pancard = uniqid() . '.' . $request->file('pancard')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'pancard' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['pancard']['tmp_name'], $filepath . $pancard);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'pancard'         => $pancard,
            ]);
            $voterid = "";
            if ($request->voterid != null) {
                $voterid = uniqid() . '.' . $request->file('voterid')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'voterid' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['voterid']['tmp_name'], $filepath . $voterid);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'voterid'         => $voterid,
            ]);
            $driving_license = "";
            if ($request->driving_license != null) {
                $driving_license = uniqid() . '.' . $request->file('driving_license')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'driving_license' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['driving_license']['tmp_name'], $filepath . $driving_license);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'driving_license'         => $driving_license,
            ]);
        } elseif ($serviceid == 172) {

            $age_proof = "";
            if ($request->age_proof != null) {
                $age_proof = uniqid() . '.' . $request->file('age_proof')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'age_proof' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['age_proof']['tmp_name'], $filepath . $age_proof);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'age_proof'         => $age_proof,
            ]);
            $vao_certificate = "";
            if ($request->vao_certificate != null) {
                $vao_certificate = uniqid() . '.' . $request->file('vao_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'vao_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['vao_certificate']['tmp_name'], $filepath . $vao_certificate);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'vao_certificate'         => $vao_certificate,
            ]);
            $self_declaration_certificate = "";
            if ($request->self_declaration_certificate != null) {
                $self_declaration_certificate = uniqid() . '.' . $request->file('self_declaration_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'self_declaration_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['self_declaration_certificate']['tmp_name'], $filepath . $self_declaration_certificate);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'self_declaration_certificate'         => $self_declaration_certificate,
            ]);
            $other_certificate = "";
            if ($request->other_certificate != null) {
                $other_certificate = uniqid() . '.' . $request->file('other_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'other_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['other_certificate']['tmp_name'], $filepath . $other_certificate);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'other_certificate'         => $other_certificate,
            ]);
        } elseif ($serviceid == 176) {

            $residential_certificate = "";
            if ($request->residential_certificate != null) {
                $residential_certificate = uniqid() . '.' . $request->file('residential_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'residential_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['residential_certificate']['tmp_name'], $filepath . $residential_certificate);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'residential_certificate'         => $residential_certificate,
            ]);
            $solvency_certificate = "";
            if ($request->solvency_certificate != null) {
                $solvency_certificate = uniqid() . '.' . $request->file('solvency_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'solvency_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['solvency_certificate']['tmp_name'], $filepath . $solvency_certificate);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'solvency_certificate'         => $solvency_certificate,
            ]);
            $shop_address_proof = "";
            if ($request->shop_address_proof != null) {
                $shop_address_proof = uniqid() . '.' . $request->file('shop_address_proof')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'shop_address_proof' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['shop_address_proof']['tmp_name'], $filepath . $shop_address_proof);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'shop_address_proof'         => $shop_address_proof,
            ]);
            $chitta = "";
            if ($request->chitta != null) {
                $chitta = uniqid() . '.' . $request->file('chitta')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'chitta' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['chitta']['tmp_name'], $filepath . $chitta);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'chitta'         => $chitta,
            ]);
            $previous_licence = "";
            if ($request->previous_licence != null) {
                $previous_licence = uniqid() . '.' . $request->file('previous_licence')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'previous_licence' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['previous_licence']['tmp_name'], $filepath . $previous_licence);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'previous_licence'         => $previous_licence,
            ]);
            $challan = "";
            if ($request->challan != null) {
                $challan = uniqid() . '.' . $request->file('challan')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'challan' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['challan']['tmp_name'], $filepath . $challan);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'challan'         => $challan,
            ]);
            $form_A = "";
            if ($request->form_A != null) {
                $form_A = uniqid() . '.' . $request->file('form_A')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'form_A' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['form_A']['tmp_name'], $filepath . $form_A);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'form_A'         => $form_A,
            ]);
            $building_licence_document = "";
            if ($request->building_licence_document != null) {
                $building_licence_document = uniqid() . '.' . $request->file('building_licence_document')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'building_licence_document' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['building_licence_document']['tmp_name'], $filepath . $building_licence_document);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'building_licence_document'         => $building_licence_document,
            ]);
            $building_blue_print = "";
            if ($request->building_blue_print != null) {
                $building_blue_print = uniqid() . '.' . $request->file('building_blue_print')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'building_blue_print' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['building_blue_print']['tmp_name'], $filepath . $building_blue_print);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'building_blue_print'         => $building_blue_print,
            ]);
            $pancard = "";
            if ($request->pancard != null) {
                $pancard = uniqid() . '.' . $request->file('pancard')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'pancard' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['pancard']['tmp_name'], $filepath . $pancard);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'pancard'         => $pancard,
            ]);
            $self_declaration_certificate = "";
            if ($request->self_declaration_certificate != null) {
                $self_declaration_certificate = uniqid() . '.' . $request->file('self_declaration_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'self_declaration_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['self_declaration_certificate']['tmp_name'], $filepath . $self_declaration_certificate);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'self_declaration_certificate'         => $self_declaration_certificate,
            ]);
            $lease_agreement = "";
            if ($request->lease_agreement != null) {
                $lease_agreement = uniqid() . '.' . $request->file('lease_agreement')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'lease_agreement' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['lease_agreement']['tmp_name'], $filepath . $lease_agreement);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'lease_agreement'         => $lease_agreement,
            ]);
            $it_return_document = "";
            if ($request->it_return_document != null) {
                $it_return_document = uniqid() . '.' . $request->file('it_return_document')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'it_return_document' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['it_return_document']['tmp_name'], $filepath . $it_return_document);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'it_return_document'         => $it_return_document,
            ]);
        } elseif ($serviceid == 177) {

            $registered_deed = "";
            if ($request->registered_deed != null) {
                $registered_deed = uniqid() . '.' . $request->file('registered_deed')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'registered_deed' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['registered_deed']['tmp_name'], $filepath . $registered_deed);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'registered_deed'         => $registered_deed,
            ]);
            $chitta_and_villangam = "";
            if ($request->chitta_and_villangam != null) {
                $chitta_and_villangam = uniqid() . '.' . $request->file('chitta_and_villangam')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'chitta_and_villangam' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['chitta_and_villangam']['tmp_name'], $filepath . $chitta_and_villangam);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'chitta_and_villangam'         => $chitta_and_villangam,
            ]);
            $property_details = "";
            if ($request->property_details != null) {
                $property_details = uniqid() . '.' . $request->file('property_details')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'property_details' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['property_details']['tmp_name'], $filepath . $property_details);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'property_details'         => $property_details,
            ]);
            $self_declaration_certificate = "";
            if ($request->self_declaration_certificate != null) {
                $self_declaration_certificate = uniqid() . '.' . $request->file('self_declaration_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'self_declaration_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['self_declaration_certificate']['tmp_name'], $filepath . $self_declaration_certificate);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'self_declaration_certificate'         => $self_declaration_certificate,
            ]);
        } elseif ($serviceid == 178) {

            $residential_certificate = "";
            if ($request->residential_certificate != null) {
                $residential_certificate = uniqid() . '.' . $request->file('residential_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'residential_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['residential_certificate']['tmp_name'], $filepath . $residential_certificate);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'residential_certificate'         => $residential_certificate,
            ]);

            $self_declaration_certificate = "";
            if ($request->self_declaration_certificate != null) {
                $self_declaration_certificate = uniqid() . '.' . $request->file('self_declaration_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'self_declaration_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['self_declaration_certificate']['tmp_name'], $filepath . $self_declaration_certificate);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'self_declaration_certificate'         => $self_declaration_certificate,
            ]);
            $damage_certificate = "";
            if ($request->damage_certificate != null) {
                $damage_certificate = uniqid() . '.' . $request->file('damage_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'damage_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['damage_certificate']['tmp_name'], $filepath . $damage_certificate);
            }
            DB::table('tnega_services')->where('id', $insertid)->update([
                'damage_certificate'         => $damage_certificate,
            ]);
        }



        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        $getpermission = DB::table('service_payment')->where('service_id', $serviceid)->first();
        $coordinator_permission = 0;
        $admin_payment = 0;
        if ($getpermission) {
            $coordinator_permission = $getpermission->coordinator_permission;
            $admin_payment = $getpermission->admin_amount;
        }
        if ($coordinator_permission == 1) {
            $post_data = array();

            $getdata = DB::table('tnega_services')->where('id', $insertid)->get();
            $getdata = json_decode(json_encode($getdata), true);
            foreach ($getdata as $key => $ser) {
                $getdata[$key]['family_details'] = array();
                $getdata[$key]['customer_details'] = array();
                $getdata[$key]['details'] = array();
                $getdata[$key]['agri_details'] = array();
                $getdata[$key]['agri_documents'] = array();
                $ser_id = $ser['id'];
                $user_id = $ser['user_id'];
                $sql = "select * from family_member where service_id=$ser_id order by id Asc";
                $result = DB::select($sql);
                $sql = "select * from customers where id=$user_id";
                $result1 = DB::select($sql);
                $getdata[$key]['family_details'] = $result;
                $getdata[$key]['customer_details'] = $result1;
            }
            if (count($getdata) > 0) {

                $API_KEY = env('API_KEY', '');
                $RAMJIPAY_URL = env('RAMJIPAY_URL', '');
                $WEBSITE_INDEX = env('WEBSITE_INDEX', '');
                $post_data['data'] = $getdata;
                $post_data['key'] = $API_KEY;
                $post_data['index'] = $WEBSITE_INDEX;
                $ch = curl_init();

                //echo "<pre>";print_r($post_data);echo"</pre>";die;
                //dd(json_encode($post_data));
                //dd($post_data);
                $url1 = $RAMJIPAY_URL . '/api/get_tnegaservices_api';
                //echo $url1;die;
                curl_setopt($ch, CURLOPT_URL, $url1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $server_output = curl_exec($ch);
                curl_close($ch);
                $resdata = json_decode($server_output, true);

                //dd($resdata);
                if ($resdata) {
                    $status = $resdata['message'];
                    if ($status == "Success") {
                        $date = date('Y-m-d');
                        $time = date('H:i:s');
                        $service_status = 'Out Payment';
                        $ad_info = 'Ramji Wallet Debit' . ' ' . $servicename;
                        $getrawallet = DB::table('users')->select('rawallet')->where('id', 1)->first();
                        $rawallet = 0;
                        if ($getrawallet) {
                            $balance1 = $getrawallet->rawallet;
                        }

                        $getrawallet1 = DB::table('users')->select('rawallet')->where('id', 2)->first();
                        $rawallet1 = 0;
                        if ($getrawallet1) {
                            $balance2 = $getrawallet1->rawallet;
                        }
                        $newbalance2 = $balance1 + $admin_payment;
                        $newbalance3 = $balance2 - $admin_payment;
                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet + $admin_payment where id = 1";
                        DB::update(DB::raw($sql));
                        $service_status = 'IN Payment';
                        $ad_info = 'Ramji Wallet Credit' . ' ' . $servicename;

                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet - $admin_payment where id = 2";
                        DB::update(DB::raw($sql));
                    }
                }
            }
        }
        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }

    public function submitapply_tnegaservices6(Request $request)
    {
        //dd($request->all());
        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
        DB::table('tnega_services')->insert([
            'user_id'  =>   $user_id,
            'retailer_id'  =>   $retailer_id,
            'distributor_id'  =>   $distributor_id,
            'service_id'    => $request->serviceid,
            'amount'        => $request->amount,
            'can_details'        => $request->can_details,
            'personalized'        => $request->personalized,
            'relationship_1'        => $request->relationship_1,
            'relationship_2'        => $request->relationship_2,
            'relationship_3'        => $request->relationship_3,
            'dob'        => $request->dob,
            'religion'        => $request->religion,
            'education'        => $request->education,
            'work'        => $request->work,
            'door_no'        => $request->door_no,
            'personalized_name_tamil'        => $request->personalized_name_tamil,
            'relationship_name_tamil_1'        => $request->relationship_name_tamil_1,
            'relationship_name_tamil_2'        => $request->relationship_name_tamil_2,
            'relationship_name_tamil_3'        => $request->relationship_name_tamil_3,
            'community'        => $request->community,
            'smartcard_number'        => $request->smartcard_number,
            'street_name_tamil'        => $request->street_name_tamil,
            'personalized_name_english'        => $request->personalized_name_english,
            'relationship_name_english_1'        => $request->relationship_name_english_1,
            'relationship_name_english_2'        => $request->relationship_name_english_2,
            'relationship_name_english_3'        => $request->relationship_name_english_3,
            'maritial_status'        => $request->maritial_status,
            'caste'                  => $request->caste,
            'street_name'        => $request->street_name,
            'pin_code'        => $request->pin_code,
            'postal_area_tamil'        => $request->postal_area_tamil,
            'postal_area_english'        => $request->postal_area_english,
            'can_number'        => $request->can_number,
            'mother_name_tamil'        => $request->mother_name_tamil,
            'mother_name_english'        => $request->mother_name_english,
            'course_complete'        => $request->course_complete,
            'year_of_passing'        => $request->year_of_passing,
            'current_course'         => $request->current_course,
            'current_academy_yr'        => $request->current_academy_yr,
            'institute_name_tamil'        => $request->institute_name_tamil,
            'institute_name_english'        => $request->institute_name_english,
            'institute_address_tamil'        => $request->institute_address_tamil,
            'institute_address_english'        => $request->institute_address_english,
            'living_status_1'        => $request->living_status_1,
            'living_status_2'        => $request->living_status_2,
            'status'        => 'Pending',
            'applied_date'  => date("Y-m-d"),
            'created_at'    => date("Y-m-d"),
        ]);
        $insertid = DB::getPdo()->lastInsertId();

        $father_form = "";
        if ($request->father_form != null) {
            $father_form = uniqid() . '.' . $request->file('father_form')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'father_form' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['father_form']['tmp_name'], $filepath . $father_form);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'father_form'         => $father_form,
        ]);
        $tc = "";
        if ($request->tc != null) {
            $tc = uniqid() . '.' . $request->file('tc')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'tc' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['tc']['tmp_name'], $filepath . $tc);
        }
        DB::table('tnega_services')->where('id', $insertid)->update([
            'tc'         => $tc,
        ]);

        if ($request->has('relation')) {
            foreach ($request->relation as $key => $r) {
                $relation_name_tamil = $request->name_tamil[$key];
                $relation_name = $request->name_english[$key];
                $living_status = $request->living_status[$key];
                $age = $request->age[$key];
                $education = $request->education_type[$key];

                $sql = "insert into family_member (service_id,relation,relation_name,relation_name_tamil,relation_status,education,relation_age) values ($insertid,'$r','$relation_name','$relation_name_tamil','$living_status','$education','$age')";
                DB::insert($sql);

                $relation_id = DB::getPdo()->lastInsertId();
                $file1 = "";
                if (isset($request->doc[$key])) {
                    if ($request->doc[$key] != null) {
                        $file1 = uniqid() . '.' . $request->file('doc')[$key]->extension();
                        //dd($request->doc[$key]);
                        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'doc' . DIRECTORY_SEPARATOR);
                        move_uploaded_file($_FILES['doc']['tmp_name'][$key], $filepath . $file1);
                        DB::table('family_member')->where('id', $relation_id)->update([
                            'doc'       => $file1,
                        ]);
                    }
                }
            }
        }

        if ($request->has('relationship_add')) {
            foreach ($request->relationship_add as $key => $r) {
                $relation_name_tamil = $request->name_tamil_add[$key];
                $relation_name = $request->name_english_add[$key];
                $living_status = $request->living_status_add[$key];
                $age = $request->age_add[$key];
                $education = $request->education_type_add[$key];

                $sql = "insert into family_member (user_id,service_id,relation,relation_name,relation_name_tamil,relation_status,education,relation_age) values ($insertid,$insertid,'$r','$relation_name','$relation_name_tamil','$living_status','$education','$age')";
                DB::insert($sql);

                $relation_id = DB::getPdo()->lastInsertId();
                $file1 = "";
                if (isset($request->doc1[$key])) {
                    if ($request->doc1[$key] != null) {
                        $file1 = uniqid() . '.' . $request->file('doc1')[$key]->extension();
                        //dd($request->doc[$key]);
                        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'doc' . DIRECTORY_SEPARATOR);
                        move_uploaded_file($_FILES['doc1']['tmp_name'][$key], $filepath . $file1);
                        DB::table('family_member')->where('id', $relation_id)->update([
                            'doc'       => $file1,
                        ]);
                    }
                }
            }
        }


        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        $getpermission = DB::table('service_payment')->where('service_id', $serviceid)->first();
        $coordinator_permission = 0;
        $admin_payment = 0;
        if ($getpermission) {
            $coordinator_permission = $getpermission->coordinator_permission;
            $admin_payment = $getpermission->admin_amount;
        }
        if ($coordinator_permission == 1) {
            $post_data = array();

            $getdata = DB::table('tnega_services')->where('id', $insertid)->get();
            $getdata = json_decode(json_encode($getdata), true);
            foreach ($getdata as $key => $ser) {
                $getdata[$key]['family_details'] = array();
                $getdata[$key]['details'] = array();
                $getdata[$key]['customer_details'] = array();
                $getdata[$key]['agri_details'] = array();
                $getdata[$key]['agri_documents'] = array();
                $ser_id = $ser['id'];
                $user_id = $ser['user_id'];
                $sql = "select * from family_member where service_id=$ser_id order by id Asc";
                $result = DB::select($sql);
                $sql = "select * from customers where id=$user_id";
                $result1 = DB::select($sql);
                $getdata[$key]['family_details'] = $result;
                $getdata[$key]['details'] = $result;
                $getdata[$key]['customer_details'] = $result1;
            }
            if (count($getdata) > 0) {

                $API_KEY = env('API_KEY', '');
                $RAMJIPAY_URL = env('RAMJIPAY_URL', '');
                $WEBSITE_INDEX = env('WEBSITE_INDEX', '');
                $post_data['data'] = $getdata;
                $post_data['key'] = $API_KEY;
                $post_data['index'] = $WEBSITE_INDEX;
                $ch = curl_init();

                //echo "<pre>";print_r($post_data);echo"</pre>";die;
                //dd(json_encode($post_data));
                //dd($post_data);
                $url1 = $RAMJIPAY_URL . '/api/get_tnegaservices_api';
                //echo $url1;die;
                curl_setopt($ch, CURLOPT_URL, $url1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $server_output = curl_exec($ch);
                curl_close($ch);
                $resdata = json_decode($server_output, true);

                //dd($resdata);
                if ($resdata) {
                    $status = $resdata['message'];
                    if ($status == "Success") {
                        $date = date('Y-m-d');
                        $time = date('H:i:s');
                        $service_status = 'Out Payment';
                        $ad_info = 'Ramji Wallet Debit' . ' ' . $servicename;
                        $getrawallet = DB::table('users')->select('rawallet')->where('id', 1)->first();
                        $rawallet = 0;
                        if ($getrawallet) {
                            $balance1 = $getrawallet->rawallet;
                        }

                        $getrawallet1 = DB::table('users')->select('rawallet')->where('id', 2)->first();
                        $rawallet1 = 0;
                        if ($getrawallet1) {
                            $balance2 = $getrawallet1->rawallet;
                        }
                        $newbalance2 = $balance1 + $admin_payment;
                        $newbalance3 = $balance2 - $admin_payment;
                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet + $admin_payment where id = 1";
                        DB::update(DB::raw($sql));
                        $service_status = 'IN Payment';
                        $ad_info = 'Ramji Wallet Credit' . ' ' . $servicename;

                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet - $admin_payment where id = 2";
                        DB::update(DB::raw($sql));
                    }
                }
            }
        }
        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }


    public function submitapply_msme(Request $request)
    {

        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
        DB::table('msme')->insert([
            'user_id'           =>   $user_id,
            'distributor_id'    =>   $distributor_id,
            'retailer_id'       =>   $retailer_id,
            'service_id'        => $request->serviceid,
            'amount'            => $request->amount,
            'name'              => $request->name,
            'mobile'            => $request->mobile,
            'dist_id'           => $request->dist_id,
            'taluk_id'          => $request->taluk_id,
            'panchayath_id'     => $request->panchayath_id,
            'cmp_name'          => $request->cmp_name,
            'community'         => $request->community,
            'building_name'     => $request->building_name,
            'ward_no'           => $request->ward_no,
            'pin_code'          => $request->pin_code,
            'account_no'        => $request->account_no,
            'confirm_account_no' => $request->confirm_account_no,
            'ifsc_code'         => $request->ifsc_code,
            'micr_no'           => $request->micr_no,
            'male_count'        => $request->male_count,
            'female_count'      => $request->female_count,
            'amount_in_lakhs'   => $request->amount_in_lakhs,
            'gst'               => $request->gst,
            'gst_number'        => $request->gst_number,
            'itr'               => $request->itr,
            'organization'      => $request->organization,
            'category_of_work'  => $request->category_of_work,
            'status'        => 'Pending',
            'applied_date'  => date("Y-m-d"),
            'created_at'    => date("Y-m-d"),
        ]);
        $insertid = DB::getPdo()->lastInsertId();
        $aadhaarimg = "";
        $pancardimg = "";

        if ($request->aadhaar_card != null) {
            $aadhaarimg = uniqid() . '.' . $request->file('aadhaar_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);
        }

        if ($request->pan_card != null) {
            $pancardimg = uniqid() . '.' . $request->file('pan_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'pan_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['pan_card']['tmp_name'], $filepath . $pancardimg);
        }

        DB::table('msme')->where('id', $insertid)->update([
            'aadhaar_card' => $aadhaarimg,
            'pan_card'     => $pancardimg,
        ]);

        if ($serviceid == 34) {
            $itr_form = "";
            if ($request->itr_form != null) {
                $itr_form = uniqid() . '.' . $request->file('itr_form')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'itr_form' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['itr_form']['tmp_name'], $filepath . $itr_form);
            }
            DB::table('msme')->where('id', $insertid)->update([
                'itr_form'         => $itr_form,
            ]);
        }

        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));


        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }

    public function submitapply_itr(Request $request)
    {

        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
        DB::table('itr')->insert([
            'user_id'      => $user_id,
            'retailer_id'  => $retailer_id,
            'distributor_id'  => $distributor_id,
            'service_id'   => $request->serviceid,
            'amount'       => $request->amount,
            'name'         => $request->name,
            'mobile'       => $request->mobile,
            'email'       => $request->email,
            'aadhaar_no'   => $request->aadhaar_no,
            'status'       => 'Pending',
            'applied_date' => date("Y-m-d"),
            'created_at'   => date("Y-m-d"),
        ]);

        $insertid = DB::getPdo()->lastInsertId();
        $pancardimg = "";
        $bank_passbook = "";
        $aadhaar_card = "";

        if ($request->pan_card != null) {
            $pancardimg = uniqid() . '.' . $request->file('pan_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'pan_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['pan_card']['tmp_name'], $filepath . $pancardimg);
        }
        DB::table('itr')->where('id', $insertid)->update([
            'pan_card' => $pancardimg,
        ]);

        if ($request->aadhaar_card != null) {
            $aadhaar_card = uniqid() . '.' . $request->file('aadhaar_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
        }
        DB::table('itr')->where('id', $insertid)->update([
            'aadhaar_card' => $aadhaar_card,
        ]);

        if ($request->bank_passbook != null) {
            $bank_passbook = uniqid() . '.' . $request->file('bank_passbook')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'bank_passbook' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['bank_passbook']['tmp_name'], $filepath . $bank_passbook);
        }
        DB::table('itr')->where('id', $insertid)->update([
            'bank_passbook' => $bank_passbook,
        ]);



        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }

    public function submitapply_birthcertificate(Request $request)
    {

        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
        if ($serviceid == 155 || $serviceid == 156) {
            DB::table('birth_certificate')->insert([
                'user_id'           => $user_id,
                'retailer_id'       => $retailer_id,
                'distributor_id'    => $distributor_id,
                'service_id'        => $request->serviceid,
                'amount'            => $request->amount,
                'childname'         => $request->childname,
                'dist_id'           => $request->dist_id,
                'date_of_birth'     => $request->date_of_birth,
                'date_of_death'     => $request->date_of_death,
                'place_of_birth'    => $request->place_of_birth,
                'place_of_death'    => $request->place_of_death,
                'hospital_name'     => $request->hospital_name,
                'name'              => $request->name,
                'mobile'            => $request->mobile,
                'aadhaar_no'        => $request->aadhaar_no,
                'status'            => 'Pending',
                'applied_date'      => date("Y-m-d"),
                'created_at'        => date("Y-m-d"),
            ]);
        }

        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }

    public function submitapply_gst(Request $request)
    {

        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
        DB::table('gst')->insert([
            'user_id'              => $user_id,
            'retailer_id'          => $retailer_id,
            'distributor_id'       => $distributor_id,
            'service_id'           => $request->serviceid,
            'amount'               => $request->amount,
            'trade_name'           => $request->trade_name,
            'mobile'               => $request->mobile,
            'aadhaar_no'           => $request->aadhaar_no,
            'pan_no'               => $request->pan_no,
            'dist_id'              => $request->dist_id,
            'taluk_id'             => $request->taluk_id,
            'panchayath_id'        => $request->panchayath_id,
            'business_details'     => $request->business_details,
            'business_address'     => $request->business_address,
            'business_details_documents' => $request->business_details_documents,
            'status'       => 'Pending',
            'applied_date' => date("Y-m-d"),
            'created_at'   => date("Y-m-d"),
        ]);

        $insertid = DB::getPdo()->lastInsertId();
        $aadhaarimg = "";
        $pancardimg = "";
        $photo = "";
        $pass = "";
        $rental_agreement = "";
        $ebbill = "";
        $property_tax = "";

        if ($request->aadhaar_card != null) {
            $aadhaarimg = uniqid() . '.' . $request->file('aadhaar_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);
        }
        DB::table('gst')->where('id', $insertid)->update([
            'aadhaar_card' => $aadhaarimg,
        ]);
        if ($request->pan_card != null) {
            $pancardimg = uniqid() . '.' . $request->file('pan_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'pan_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['pan_card']['tmp_name'], $filepath . $pancardimg);
        }
        DB::table('gst')->where('id', $insertid)->update([
            'pan_card' => $pancardimg,
        ]);
        if ($request->photo != null) {
            $photo = uniqid() . '.' . $request->file('photo')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);
        }
        DB::table('gst')->where('id', $insertid)->update([
            'photo' => $photo,
        ]);
        if ($request->bank_pass_book_front_page != null) {
            $pass = uniqid() . '.' . $request->file('bank_pass_book_front_page')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'passbook_front' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['bank_pass_book_front_page']['tmp_name'], $filepath . $pass);
        }
        DB::table('gst')->where('id', $insertid)->update([
            'bank_pass_book_front_page' => $pass,
        ]);

        if ($request->rental_agreement != null) {
            $rental_agreement = uniqid() . '.' . $request->file('rental_agreement')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'rental_agreement' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['rental_agreement']['tmp_name'], $filepath . $rental_agreement);
        }
        DB::table('gst')->where('id', $insertid)->update([
            'rental_agreement' => $rental_agreement,
        ]);

        if ($request->ebbill != null) {
            $ebbill = uniqid() . '.' . $request->file('ebbill')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'ebbill' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['ebbill']['tmp_name'], $filepath . $ebbill);
        }
        DB::table('gst')->where('id', $insertid)->update([
            'ebbill' => $ebbill,
        ]);

        if ($request->property_tax != null) {
            $property_tax = uniqid() . '.' . $request->file('property_tax')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'property_tax' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['property_tax']['tmp_name'], $filepath . $property_tax);
        }
        DB::table('gst')->where('id', $insertid)->update([
            'property_tax' => $property_tax,
        ]);


        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));


        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }

    public function submitapply_tecexam(Request $request)
    {

        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
        DB::table('tec_exam')->insert([
            'user_id'      => $user_id,
            'retailer_id'  => $retailer_id,
            'distributor_id'  => $distributor_id,
            'service_id'   => $request->serviceid,
            'amount'       => $request->amount,
            'tec_number' => $request->tec_number,
            'tec_password' => $request->tec_password,
            'status'       => 'Pending',
            'applied_date' => date("Y-m-d"),
            'created_at'   => date("Y-m-d"),
        ]);

        $insertid = DB::getPdo()->lastInsertId();
        $aadhaarimg = "";
        $photo = "";

        if ($request->aadhaar_card != null) {
            $aadhaarimg = uniqid() . '.' . $request->file('aadhaar_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);
        }
        DB::table('tec_exam')->where('id', $insertid)->update([
            'aadhaar_card' => $aadhaarimg,
        ]);

        if ($request->photo != null) {
            $photo = uniqid() . '.' . $request->file('photo')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);
        }
        DB::table('tec_exam')->where('id', $insertid)->update([
            'photo' => $photo,
        ]);


        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }

    public function submitapply_rapexam(Request $request)
    {

        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
        DB::table('tec_exam')->insert([
            'user_id'      => $user_id,
            'retailer_id'  => $retailer_id,
            'distributor_id'  => $distributor_id,
            'service_id'   => $request->serviceid,
            'amount'       => $request->amount,
            'csc_id_number' => $request->csc_id_number,
            'csc_password' => $request->csc_password,
            'e_aadhaar_password' => $request->e_aadhaar_password,
            'status'       => 'Pending',
            'applied_date' => date("Y-m-d"),
            'created_at'   => date("Y-m-d"),
        ]);

        $insertid = DB::getPdo()->lastInsertId();
        $aadhaarimg = "";
        $e_aadhaar_pdf = "";

        if ($request->aadhaar_card != null) {
            $aadhaarimg = uniqid() . '.' . $request->file('aadhaar_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);
        }
        DB::table('tec_exam')->where('id', $insertid)->update([
            'aadhaar_card' => $aadhaarimg,
        ]);

        if ($request->e_aadhaar_pdf != null) {
            $aadhaarimg = uniqid() . '.' . $request->file('e_aadhaar_pdf')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'e_aadhaar_pdf' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['e_aadhaar_pdf']['tmp_name'], $filepath . $aadhaarimg);
        }
        DB::table('tec_exam')->where('id', $insertid)->update([
            'e_aadhaar_pdf' => $e_aadhaar_pdf,
        ]);


        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }

    public function submitapply_iibf_exam_register(Request $request)
    {
        //dd($request->all());
        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
        DB::table('tec_exam')->insert([
            'user_id'      => $user_id,
            'retailer_id'  => $retailer_id,
            'distributor_id'  => $distributor_id,
            'service_id'   => $request->serviceid,
            'amount'       => $request->amount,
            'status'       => 'Pending',
            'applied_date' => date("Y-m-d"),
            'created_at'   => date("Y-m-d"),
        ]);

        $insertid = DB::getPdo()->lastInsertId();
        $aadhaarimg = "";
        $photo = "";
        $signature = "";
        $pan_card = "";

        if ($request->aadhaar_card != null) {
            $aadhaarimg = uniqid() . '.' . $request->file('aadhaar_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);
        }
        DB::table('tec_exam')->where('id', $insertid)->update([
            'aadhaar_card' => $aadhaarimg,
        ]);

        if ($request->signature != null) {
            $signature = uniqid() . '.' . $request->file('signature')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'signature' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['signature']['tmp_name'], $filepath . $signature);
        }
        DB::table('tec_exam')->where('id', $insertid)->update([
            'signature' => $signature,
        ]);

        if ($request->pan_card != null) {
            $pan_card = uniqid() . '.' . $request->file('pan_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'pan_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['pan_card']['tmp_name'], $filepath . $pan_card);
        }
        DB::table('tec_exam')->where('id', $insertid)->update([
            'pan_card' => $pan_card,
        ]);


        if ($request->photo != null) {
            $photo = uniqid() . '.' . $request->file('photo')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);
        }
        DB::table('tec_exam')->where('id', $insertid)->update([
            'photo' => $photo,
        ]);


        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));


        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }

    public function submitapply_insexam(Request $request)
    {

        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
        DB::table('tec_exam')->insert([
            'user_id'      => $user_id,
            'retailer_id'  => $retailer_id,
            'distributor_id'  => $distributor_id,
            'service_id'   => $request->serviceid,
            'amount'       => $request->amount,
            'csc_id_number' => $request->csc_id_number,
            'csc_password' => $request->csc_password,
            'status'       => 'Pending',
            'applied_date' => date("Y-m-d"),
            'created_at'   => date("Y-m-d"),
        ]);

        $insertid = DB::getPdo()->lastInsertId();
        $aadhaarimg = "";
        $photo = "";

        if ($request->aadhaar_card != null) {
            $aadhaarimg = uniqid() . '.' . $request->file('aadhaar_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);
        }
        DB::table('tec_exam')->where('id', $insertid)->update([
            'aadhaar_card' => $aadhaarimg,
        ]);


        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }

    public function submitapply_vle_insurance(Request $request)
    {

        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
        DB::table('tec_exam')->insert([
            'user_id'      => $user_id,
            'retailer_id'  => $retailer_id,
            'distributor_id'  => $distributor_id,
            'service_id'   => $request->serviceid,
            'amount'       => $request->amount,
            'csc_id_number' => $request->csc_id_number,
            'csc_password' => $request->csc_password,
            'status'       => 'Pending',
            'applied_date' => date("Y-m-d"),
            'created_at'   => date("Y-m-d"),
        ]);

        $insertid = DB::getPdo()->lastInsertId();
        $aadhaarimg = "";
        $photo = "";

        if ($request->aadhaar_card != null) {
            $aadhaarimg = uniqid() . '.' . $request->file('aadhaar_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);
        }
        DB::table('tec_exam')->where('id', $insertid)->update([
            'aadhaar_card' => $aadhaarimg,
        ]);


        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }

    public function submittecexam_register(Request $request)
    {

        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
        DB::table('tec_exam')->insert([
            'user_id'           => $user_id,
            'retailer_id'       => $retailer_id,
            'distributor_id'    => $distributor_id,
            'service_id'        => $request->serviceid,
            'amount'            => $request->amount,
            'applicant_name'    => $request->applicant_name,
            'email'             => $request->email,
            'father_name'       => $request->father_name,
            'dob'               => $request->dob,
            'mobile'            => $request->mobile,
            'gender'            => $request->gender,
            'district'          => $request->district,
            'address'           => $request->address,
            'status'            => 'Pending',
            'applied_date'      => date("Y-m-d"),
            'created_at'        => date("Y-m-d"),
        ]);

        $insertid = DB::getPdo()->lastInsertId();
        $aadhaarimg = "";
        $photo = "";

        if ($request->aadhaar_card != null) {
            $aadhaarimg = uniqid() . '.' . $request->file('aadhaar_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);
        }
        DB::table('tec_exam')->where('id', $insertid)->update([
            'aadhaar_card' => $aadhaarimg,
        ]);

        if ($request->photo != null) {
            $photo = uniqid() . '.' . $request->file('photo')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);
        }
        DB::table('tec_exam')->where('id', $insertid)->update([
            'photo' => $photo,
        ]);


        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }
    public function submitapply_teccorrection(Request $request)
    {

        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
        DB::table('tec_exam')->insert([
            'user_id'         => $user_id,
            'retailer_id'     => $retailer_id,
            'distributor_id'  => $distributor_id,
            'service_id'      => $request->serviceid,
            'amount'          => $request->amount,
            'applicant_name'  => $request->applicant_name,
            'mobile'          => $request->mobile,
            'email'           => $request->email,
            'tec_password'    => $request->tec_password,
            'status'          => 'Pending',
            'applied_date'    => date("Y-m-d"),
            'created_at'      => date("Y-m-d"),
        ]);

        $insertid = DB::getPdo()->lastInsertId();
        $aadhaarimg = "";
        $photo = "";

        if ($request->aadhaar_card != null) {
            $aadhaarimg = uniqid() . '.' . $request->file('aadhaar_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);
        }
        DB::table('tec_exam')->where('id', $insertid)->update([
            'aadhaar_card' => $aadhaarimg,
        ]);

        if ($request->photo != null) {
            $photo = uniqid() . '.' . $request->file('photo')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);
        }
        DB::table('tec_exam')->where('id', $insertid)->update([
            'photo' => $photo,
        ]);


        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }

    public function submitsmartcard_register(Request $request)
    {

        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
        if ($serviceid == 36) {
            DB::table('smartcard')->insert([
                'user_id'                   => $user_id,
                'retailer_id'               => $retailer_id,
                'distributor_id'            => $distributor_id,
                'service_id'                => $request->serviceid,
                'amount'                    => $request->amount,
                'family_head_name'          => $request->family_head_name,
                'father_or_husband_tamil'   => $request->father_or_husband_tamil,
                'father_or_husband_english' => $request->father_or_husband_english,
                'name_tamil'                => $request->name_tamil,
                'name_english'              => $request->name_english,
                'name'                      => $request->name,
                'mobile'                    => $request->mobile,
                'pin_code'                  => $request->pin_code,
                'address_tamil_1'           => $request->address_tamil_1,
                'address_tamil_2'           => $request->address_tamil_2,
                'address_tamil_3'           => $request->address_tamil_3,
                'address_english_1'         => $request->address_english_1,
                'address_english_2'         => $request->address_english_2,
                'address_english_3'         => $request->address_english_3,
                'monthly_income'            => $request->monthly_income,
                'gas_connection_no'         => $request->gas_connection_no,
                'card_selection'            => $request->card_selection,
                'residence_proof'           => $request->residence_proof,
                'email_id'                  => $request->email_id,
                'dist_id'                   => $request->dist_id,
                'status'                    => 'Pending',
                'applied_date'              => date("Y-m-d"),
                'created_at'                => date("Y-m-d"),
            ]);
            if ($request->has('relationship')) {
                foreach ($request->relationship as $key => $relation) {
                    $relation_name = $request->relation_name[$key];
                    $relation_dob = $request->relation_dob[$key];
                    $maritial_status = $request->maritial_status[$key];

                    $sql = "insert into smartcard_family_member (user_id,relation,relation_name,maritial_status,relation_dob) values ($user_id,'$relation','$relation_name','$maritial_status','$relation_dob')";
                    DB::insert($sql);
                    $relation_id = DB::getPdo()->lastInsertId();
                    if ($request->doc[$key] != null) {
                        $aadhaarcard = uniqid() . '.' . $request->file('doc')[$key]->extension();
                        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'users' . DIRECTORY_SEPARATOR . 'relationaadhaar_card' . DIRECTORY_SEPARATOR);
                        move_uploaded_file($_FILES['doc']['tmp_name'][$key], $filepath . $aadhaarcard);
                        DB::table('smartcard_family_member')->where('id', $relation_id)->update([
                            'relationaadhaar_card'       => $aadhaarcard,
                        ]);
                    }
                }
            }
            $insertid = DB::getPdo()->lastInsertId();
            $aadhaarimg = "";
            $electricity_bill_receipt = "";
            $family_head_photo = "";
            $commodity_card = "";
            $smart_card = "";

            if ($request->aadhaar_card != null) {
                $aadhaarimg = uniqid() . '.' . $request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'aadhaar_card' => $aadhaarimg,
            ]);

            if ($request->family_head_photo != null) {
                $family_head_photo = uniqid() . '.' . $request->file('family_head_photo')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'family_head_photo' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['family_head_photo']['tmp_name'], $filepath . $family_head_photo);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'family_head_photo' => $family_head_photo,
            ]);

            if ($request->commodity_card != null) {
                $commodity_card = uniqid() . '.' . $request->file('commodity_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'commodity_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['commodity_card']['tmp_name'], $filepath . $commodity_card);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'commodity_card' => $commodity_card,
            ]);

            if ($request->smart_card != null) {
                $smart_card = uniqid() . '.' . $request->file('smart_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smart_card);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'smart_card' => $smart_card,
            ]);

            if ($request->electricity_bill_receipt != null) {
                $electricity_bill_receipt = uniqid() . '.' . $request->file('electricity_bill_receipt')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'electricity_bill' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['electricity_bill_receipt']['tmp_name'], $filepath . $electricity_bill_receipt);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'electricity_bill_receipt' => $electricity_bill_receipt,
            ]);
            $telephone_charges = "";
            if ($request->telephone_charges != null) {
                $telephone_charges = uniqid() . '.' . $request->file('telephone_charges')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'telephonebill' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['telephone_charges']['tmp_name'], $filepath . $telephone_charges);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'telephone_charges'         => $telephone_charges,
            ]);

            $voter_id = "";
            if ($request->voter_id != null) {
                $voter_id = uniqid() . '.' . $request->file('voter_id')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'voterid' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['voter_id']['tmp_name'], $filepath . $voter_id);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'voter_id'         => $voter_id,
            ]);

            $passport = "";
            if ($request->passport != null) {
                $passport = uniqid() . '.' . $request->file('passport')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'passport' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['passport']['tmp_name'], $filepath . $passport);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'passport'         => $passport,
            ]);

            $gas_cylinder_receipt = "";
            if ($request->gas_cylinder_receipt != null) {
                $gas_cylinder_receipt = uniqid() . '.' . $request->file('gas_cylinder_receipt')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'gas_cylinder' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['gas_cylinder_receipt']['tmp_name'], $filepath . $gas_cylinder_receipt);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'gas_cylinder_receipt'         => $gas_cylinder_receipt,
            ]);

            $property_tax_applicant_owns_house = "";
            if ($request->property_tax_applicant_owns_house != null) {
                $property_tax_applicant_owns_house = uniqid() . '.' . $request->file('property_tax_applicant_owns_house')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'property_tax' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['property_tax_applicant_owns_house']['tmp_name'], $filepath . $property_tax_applicant_owns_house);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'property_tax_applicant_owns_house'         => $property_tax_applicant_owns_house,
            ]);

            $lease_deed = "";
            if ($request->lease_deed != null) {
                $lease_deed = uniqid() . '.' . $request->file('lease_deed')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'lease_deed' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['lease_deed']['tmp_name'], $filepath . $lease_deed);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'lease_deed'         => $lease_deed,
            ]);

            $allotment_rder_of_slum_replacement_board = "";
            if ($request->allotment_rder_of_slum_replacement_board != null) {
                $allotment_rder_of_slum_replacement_board = uniqid() . '.' . $request->file('allotment_rder_of_slum_replacement_board')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'allotment' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['allotment_rder_of_slum_replacement_board']['tmp_name'], $filepath . $lease_deed);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'allotment_rder_of_slum_replacement_board' => $allotment_rder_of_slum_replacement_board,
            ]);

            $first_page_of_bank_account_book = "";
            if ($request->first_page_of_bank_account_book != null) {
                $bond_leave_proof = uniqid() . '.' . $request->file('first_page_of_bank_account_book')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'first_page_of_bank' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['first_page_of_bank_account_book']['tmp_name'], $filepath . $lease_deed);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'first_page_of_bank_account_book'   => $first_page_of_bank_account_book,
            ]);

            $bond_leave_proof = "";
            if ($request->bond_leave_proof != null) {
                $bond_leave_proof = uniqid() . '.' . $request->file('bond_leave_proof')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'bond_leave' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['bond_leave_proof']['tmp_name'], $filepath . $lease_deed);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'bond_leave_proof'         => $bond_leave_proof,
            ]);
            $rice_card = "";
            if ($request->rice_card != null) {
                $rice_card = uniqid() . '.' . $request->file('rice_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'ricecard' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['rice_card']['tmp_name'], $filepath . $lease_deed);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'rice_card'         => $rice_card,
            ]);
            $sugar_card = "";
            if ($request->sugar_card != null) {
                $sugar_card = uniqid() . '.' . $request->file('sugar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'sugarcard' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['sugar_card']['tmp_name'], $filepath . $lease_deed);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'sugar_card'         => $sugar_card,
            ]);
            $others = "";
            if ($request->others != null) {
                $others = uniqid() . '.' . $request->file('others')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'others' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['others']['tmp_name'], $filepath . $lease_deed);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'others'         => $others,
            ]);
        } elseif ($serviceid == 37) {
            DB::table('smartcard')->insert([
                'user_id'                   => $user_id,
                'retailer_id'               => $retailer_id,
                'distributor_id'            => $distributor_id,
                'service_id'                => $request->serviceid,
                'amount'                    => $request->amount,
                'name'                      => $request->name,
                'mobile'                    => $request->mobile,
                'dist_id'                   => $request->dist_id,
                'status'                    => 'Pending',
                'applied_date'              => date("Y-m-d"),
                'created_at'                => date("Y-m-d"),
            ]);

            $insertid = DB::getPdo()->lastInsertId();
            $aadhaarimg = "";
            $photo = "";
            $smart_card = "";

            if ($request->aadhaar_card != null) {
                $aadhaarimg = uniqid() . '.' . $request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'aadhaar_card' => $aadhaarimg,
            ]);
            if ($request->smart_card != null) {
                $smart_card = uniqid() . '.' . $request->file('smart_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smart_card);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'smart_card' => $smart_card,
            ]);
            if ($request->photo != null) {
                $photo = uniqid() . '.' . $request->file('photo')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'photo' => $photo,
            ]);
        } elseif ($serviceid == 38) {
            DB::table('smartcard')->insert([
                'user_id'                   => $user_id,
                'retailer_id'               => $retailer_id,
                'distributor_id'            => $distributor_id,
                'service_id'                => $request->serviceid,
                'amount'                    => $request->amount,
                'name'                      => $request->name,
                'mobile'                    => $request->mobile,
                'any_proof'                 => $request->any_proof,
                'status'                    => 'Pending',
                'applied_date'              => date("Y-m-d"),
                'created_at'                => date("Y-m-d"),
            ]);

            $insertid = DB::getPdo()->lastInsertId();
            $aadhaarimg = "";
            $smart_card = "";
            $death_certificate = "";
            $mrg_certificate = "";
            $mrg_invitation = "";

            if ($request->aadhaar_card != null) {
                $aadhaarimg = uniqid() . '.' . $request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'aadhaar_card' => $aadhaarimg,
            ]);
            if ($request->smart_card != null) {
                $smart_card = uniqid() . '.' . $request->file('smart_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smart_card);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'smart_card' => $smart_card,
            ]);
            if ($request->death_certificate != null) {
                $death_certificate = uniqid() . '.' . $request->file('death_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'deathcertificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['death_certificate']['tmp_name'], $filepath . $death_certificate);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'death_certificate' => $death_certificate,
            ]);
            if ($request->mrg_certificate != null) {
                $mrg_certificate = uniqid() . '.' . $request->file('mrg_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'mrgcertificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['mrg_certificate']['tmp_name'], $filepath . $mrg_certificate);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'mrg_certificate' => $mrg_certificate,
            ]);
            if ($request->mrg_invitation != null) {
                $mrg_invitation = uniqid() . '.' . $request->file('mrg_invitation')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'mrginvitation' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['mrg_invitation']['tmp_name'], $filepath . $mrg_invitation);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'mrg_invitation' => $mrg_invitation,
            ]);
        } elseif ($serviceid == 39) {
            DB::table('smartcard')->insert([
                'user_id'                   => $user_id,
                'retailer_id'               => $retailer_id,
                'distributor_id'            => $distributor_id,
                'service_id'                => $request->serviceid,
                'amount'                    => $request->amount,
                'name'                      => $request->name,
                'mobile'                    => $request->mobile,
                'status'                    => 'Pending',
                'applied_date'              => date("Y-m-d"),
                'created_at'                => date("Y-m-d"),
            ]);

            $insertid = DB::getPdo()->lastInsertId();
            $aadhaarimg = "";
            $smart_card = "";

            if ($request->aadhaar_card != null) {
                $aadhaarimg = uniqid() . '.' . $request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'aadhaar_card' => $aadhaarimg,
            ]);
            if ($request->smart_card != null) {
                $smart_card = uniqid() . '.' . $request->file('smart_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smart_card);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'smart_card' => $smart_card,
            ]);
        } elseif ($serviceid == 41) {
            DB::table('smartcard')->insert([
                'user_id'                   => $user_id,
                'retailer_id'               => $retailer_id,
                'distributor_id'            => $distributor_id,
                'service_id'                => $request->serviceid,
                'amount'                    => $request->amount,
                'name'                      => $request->name,
                'mobile'                    => $request->mobile,
                'new_proof'                 => $request->new_proof,
                'status'                    => 'Pending',
                'applied_date'              => date("Y-m-d"),
                'created_at'                => date("Y-m-d"),
            ]);

            $insertid = DB::getPdo()->lastInsertId();
            $aadhaarimg = "";
            $smart_card = "";
            $birth_certificate = "";

            if ($request->aadhaar_card != null) {
                $aadhaarimg = uniqid() . '.' . $request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'aadhaar_card' => $aadhaarimg,
            ]);
            if ($request->smart_card != null) {
                $smart_card = uniqid() . '.' . $request->file('smart_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smart_card);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'smart_card' => $smart_card,
            ]);
            if ($request->birth_certificate != null) {
                $birth_certificate = uniqid() . '.' . $request->file('birth_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'birth_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['birth_certificate']['tmp_name'], $filepath . $birth_certificate);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'birth_certificate'         => $birth_certificate,
            ]);
            $voter_id = "";
            if ($request->voter_id != null) {
                $voter_id = uniqid() . '.' . $request->file('voter_id')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'voterid' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['voter_id']['tmp_name'], $filepath . $voter_id);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'voter_id'         => $voter_id,
            ]);
        } elseif ($serviceid == 42) {
            DB::table('smartcard')->insert([
                'user_id'                   => $user_id,
                'retailer_id'               => $retailer_id,
                'distributor_id'            => $distributor_id,
                'service_id'                => $request->serviceid,
                'amount'                    => $request->amount,
                'name'                      => $request->name,
                'mobile'                    => $request->mobile,
                'any_document'              => $request->any_document,
                'status'                    => 'Pending',
                'applied_date'              => date("Y-m-d"),
                'created_at'                => date("Y-m-d"),
            ]);

            $insertid = DB::getPdo()->lastInsertId();
            $aadhaarimg = "";
            $pancardimg = "";
            $smart_card = "";

            if ($request->aadhaar_card != null) {
                $aadhaarimg = uniqid() . '.' . $request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'aadhaar_card' => $aadhaarimg,
            ]);
            if ($request->smart_card != null) {
                $smart_card = uniqid() . '.' . $request->file('smart_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smart_card);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'smart_card' => $smart_card,
            ]);
            $passport = "";
            if ($request->passport != null) {
                $passport = uniqid() . '.' . $request->file('passport')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'passport' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['passport']['tmp_name'], $filepath . $passport);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'passport'         => $passport,
            ]);
            $voter_id = "";
            if ($request->voter_id != null) {
                $voter_id = uniqid() . '.' . $request->file('voter_id')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'voter_id' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['voter_id']['tmp_name'], $filepath . $voter_id);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'voter_id'         => $voter_id,
            ]);
            $electricity_bill_receipt = "";
            if ($request->electricity_bill_receipt != null) {
                $electricity_bill_receipt = uniqid() . '.' . $request->file('electricity_bill_receipt')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'electricity_bill' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['electricity_bill_receipt']['tmp_name'], $filepath . $electricity_bill_receipt);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'electricity_bill_receipt'         => $electricity_bill_receipt,
            ]);
            $telephone_charges = "";
            if ($request->telephone_charges != null) {
                $telephone_charges = uniqid() . '.' . $request->file('telephone_charges')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'telephonebill' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['telephone_charges']['tmp_name'], $filepath . $telephone_charges);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'telephone_charges'         => $telephone_charges,
            ]);
            $gas_cylinder_receipt = "";
            if ($request->gas_cylinder_receipt != null) {
                $gas_cylinder_receipt = uniqid() . '.' . $request->file('gas_cylinder_receipt')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'gas_cylinder' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['gas_cylinder_receipt']['tmp_name'], $filepath . $gas_cylinder_receipt);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'gas_cylinder_receipt'         => $gas_cylinder_receipt,
            ]);
            $property_tax_applicant_owns_house = "";
            if ($request->property_tax_applicant_owns_house != null) {
                $property_tax_applicant_owns_house = uniqid() . '.' . $request->file('property_tax_applicant_owns_house')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'property_tax' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['property_tax_applicant_owns_house']['tmp_name'], $filepath . $property_tax_applicant_owns_house);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'property_tax_applicant_owns_house'         => $property_tax_applicant_owns_house,
            ]);
            $lease_deed = "";
            if ($request->lease_deed != null) {
                $lease_deed = uniqid() . '.' . $request->file('lease_deed')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'lease_deed' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['lease_deed']['tmp_name'], $filepath . $lease_deed);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'lease_deed'         => $lease_deed,
            ]);
            $allotment_rder_of_slum_replacement_board = "";
            if ($request->allotment_rder_of_slum_replacement_board != null) {
                $allotment_rder_of_slum_replacement_board = uniqid() . '.' . $request->file('allotment_rder_of_slum_replacement_board')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'allotment' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['allotment_rder_of_slum_replacement_board']['tmp_name'], $filepath . $lease_deed);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'allotment_rder_of_slum_replacement_board' => $allotment_rder_of_slum_replacement_board,
            ]);
            $bond_leave_proof = "";
            if ($request->bond_leave_proof != null) {
                $bond_leave_proof = uniqid() . '.' . $request->file('bond_leave_proof')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'bond_leave' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['bond_leave_proof']['tmp_name'], $filepath . $lease_deed);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'bond_leave_proof'         => $bond_leave_proof,
            ]);
            $first_page_of_bank_account_book = "";
            if ($request->first_page_of_bank_account_book != null) {
                $bond_leave_proof = uniqid() . '.' . $request->file('first_page_of_bank_account_book')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'first_page_of_bank' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['first_page_of_bank_account_book']['tmp_name'], $filepath . $lease_deed);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'first_page_of_bank_account_book'   => $first_page_of_bank_account_book,
            ]);
        } elseif ($serviceid == 43) {
            DB::table('smartcard')->insert([
                'user_id'                   => $user_id,
                'retailer_id'               => $retailer_id,
                'distributor_id'            => $distributor_id,
                'service_id'                => $request->serviceid,
                'amount'                    => $request->amount,
                'name'                      => $request->name,
                'mobile'                    => $request->mobile,
                'status'                    => 'Pending',
                'applied_date'              => date("Y-m-d"),
                'created_at'                => date("Y-m-d"),
            ]);

            $insertid = DB::getPdo()->lastInsertId();
            $aadhaarimg = "";
            $photo = "";
            $smart_card = "";

            if ($request->aadhaar_card != null) {
                $aadhaarimg = uniqid() . '.' . $request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'aadhaar_card' => $aadhaarimg,
            ]);
            if ($request->smart_card != null) {
                $smart_card = uniqid() . '.' . $request->file('smart_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smart_card);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'smart_card' => $smart_card,
            ]);
            if ($request->photo != null) {
                $photo = uniqid() . '.' . $request->file('photo')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'photo' => $photo,
            ]);
        }


        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }

    public function submitaadhaar(Request $request)
    {

        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
        if ($serviceid == 56) {
            DB::table('aadhaarcard')->insert([
                'user_id'             => $user_id,
                'retailer_id'         => $retailer_id,
                'distributor_id'      => $distributor_id,
                'service_id'          => $request->serviceid,
                'amount'              => $request->amount,
                'dist_id'             => $request->dist_id,
                'taluk_id'            => $request->taluk_id,
                'name'                => $request->name,
                'mobile'              => $request->mobile,
                'door_no'             => $request->door_no,
                'aadhaar_no'          => $request->aadhaar_no,
                'postal_area_english' => $request->postal_area_english,
                'pin_code'            => $request->pin_code,
                'id_proof'            => $request->id_proof,
                'state'               => $request->state,
                'postal_area_tamil'          => $request->postal_area_tamil,
                'apartment'       => $request->apartment,
                'street_name'     => $request->street_name,
                'street_name_tamil'               => $request->street_name_tamil,
                'state_tamil'               => $request->state_tamil,
                'district_tamil'               => $request->district_tamil,
                'post_office'               => $request->post_office,
                'post_office_tamil'               => $request->post_office_tamil,
                'village'               => $request->village,
                'village_tamil'               => $request->village_tamil,
                'district'               => $request->district,
                'taluka'               => $request->taluka,
                'taluka_tamil'               => $request->taluka_tamil,
                'centerno'            => Auth::user()->phone,
                'status'                => 'Pending',
                'applied_date'          => date("Y-m-d"),
                'created_at'            => date("Y-m-d"),
            ]);

            $insertid = DB::getPdo()->lastInsertId();
            $aadhaarimg = "";
            $bank_pass_book  = "";
            $smartcard_onlineprint  = "";
            $voterid  = "";

            if ($request->aadhaar_card != null) {
                $aadhaarimg = uniqid() . '.' . $request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);
            }
            DB::table('aadhaarcard')->where('id', $insertid)->update([
                'aadhaar_card' => $aadhaarimg,
            ]);

            if ($request->bank_pass_book != null) {
                $bank_pass_book    = uniqid() . '.' . $request->file('bank_pass_book')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'bank_pass_book' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['bank_pass_book']['tmp_name'], $filepath . $bank_pass_book);
            }
            DB::table('aadhaarcard')->where('id', $insertid)->update([
                'bank_pass_book' => $bank_pass_book,
            ]);
            if ($request->smartcard_onlineprint != null) {
                $smartcard_onlineprint    = uniqid() . '.' . $request->file('smartcard_onlineprint')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smartcard_onlineprint' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['smartcard_onlineprint']['tmp_name'], $filepath . $smartcard_onlineprint);
            }
            DB::table('aadhaarcard')->where('id', $insertid)->update([
                'smartcard_onlineprint' => $smartcard_onlineprint,
            ]);
            if ($request->voterid != null) {
                $voterid    = uniqid() . '.' . $request->file('voterid')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'voterid' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['voterid']['tmp_name'], $filepath . $voterid);
            }
            DB::table('aadhaarcard')->where('id', $insertid)->update([
                'voterid' => $voterid,
            ]);
        } elseif ($serviceid == 58) {
            //dd($request->all());
            $insertid = DB::table('aadhaarcard')->insertGetId([

                'user_id'            => $user_id,
                'retailer_id'        => $retailer_id,
                'distributor_id'     => $distributor_id,
                'service_id'     => $serviceid,

                'name' => $request->applicant_name,
                'aadhaar_no' => $request->applicant_aadhaar,
                'mobile' => $request->applicant_mobile,
                'applicant_document_type' => $request->applicant_document_type,

                'relationship' => $request->relationship,
                'parent_name' => $request->parent_name,
                'parent_aadhaar' => $request->parent_aadhaar,
                'parent_mobile' => $request->parent_mobile,
                'parent_document_type' => $request->document_type,

                'address_tamil' => $request->address_tamil,
                'relative_address_tamil' => $request->relative_address_tamil,
                'relative_address_english' => $request->relative_address_english,
                'centerno'            => Auth::user()->phone,

                'status'             => 'Pending',
                'applied_date'       => date("Y-m-d"),
                'created_at'         => now(),
            ]);
            $docType = $request->applicant_document_type;

            switch ($docType) {
                case 'aadhaar':
                    $applicantColumn = 'aadhaar_card';
                    break;

                case 'school':
                    $applicantColumn = 'schl_id_card';
                    break;

                case 'birth':
                    $applicantColumn = 'birth_certificate';
                    break;

                case 'photo':
                    $applicantColumn = 'photo';
                    break;

                default:
                    $applicantColumn = null;
                    break;
            }
            if ($request->hasFile($applicantColumn)) {

                $file = $request->file($applicantColumn);
                $filename = 'APP_' . time() . '.' . $file->getClientOriginalExtension();

                $path = public_path('upload/services/doctype');
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }

                $file->move($path, $filename);

                DB::table('aadhaarcard')->where('id', $insertid)->update([
                    $applicantColumn => $filename
                ]);
            }

            $parentDocType = $request->document_type;

            switch ($parentDocType) {
                case 'aadhaar':
                    $parentColumn = 'parent_aadhaar_front';
                    break;

                case 'voter':
                    $parentColumn = 'voterid';
                    break;

                case 'bank':
                    $parentColumn = 'bank_pass_book';
                    break;

                default:
                    $parentColumn = null;
                    break;
            }

            if ($request->hasFile($parentColumn)) {

                $file = $request->file($parentColumn);
                $filename = 'PAR_' . time() . '.' . $file->getClientOriginalExtension();

                $path = public_path('upload/services/parentdoctype');
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }

                $file->move($path, $filename);

                DB::table('aadhaarcard')->where('id', $insertid)->update([
                    $parentColumn => $filename
                ]);
            }
        } elseif ($serviceid == 158) {
            //dd($request->all());
            $insertid = DB::table('aadhaarcard')->insertGetId([

                'user_id'            => $user_id,
                'retailer_id'        => $retailer_id,
                'distributor_id'     => $distributor_id,
                'service_id'         => $serviceid,
                'dist_id'             => $request->dist_id,
                'taluk_id'            => $request->taluk_id,
                'name'                => $request->name,
                'mobile'              => $request->mobile,
                'door_no'             => $request->door_no,
                'aadhaar_no'          => $request->aadhaar_no,
                'postal_area_english' => $request->postal_area_english,
                'pin_code'            => $request->pin_code,
                'id_proof'            => $request->id_proof,
                'state'               => $request->state,
                'postal_area_tamil'          => $request->postal_area_tamil,
                'apartment'       => $request->apartment,
                'street_name'     => $request->street_name,
                'street_name_tamil'               => $request->street_name_tamil,
                'state_tamil'               => $request->state_tamil,
                'district_tamil'               => $request->district_tamil,
                'post_office'               => $request->post_office,
                'post_office_tamil'               => $request->post_office_tamil,
                'village'               => $request->village,
                'village_tamil'               => $request->village_tamil,
                'district'               => $request->district,
                'taluka'               => $request->taluka,
                'taluka_tamil'               => $request->taluka_tamil,
                'relationship'               => $request->relationship,
                'relation_name_tamil'               => $request->relation_name_tamil,
                'relation_name_english'               => $request->relation_name_english,
                'relation_aadhaar'               => $request->relation_aadhaar,
                'relationship_tamil'               => $request->relationship_tamil,
                'centerno'            => Auth::user()->phone,

                'status'             => 'Pending',
                'applied_date'       => date("Y-m-d"),
                'created_at'         => now(),
            ]);

            $insertid = DB::getPdo()->lastInsertId();
            $aadhaarimg = "";
            $bank_pass_book  = "";
            $smartcard_onlineprint  = "";
            $voterid  = "";

            if ($request->aadhaar_card != null) {
                $aadhaarimg = uniqid() . '.' . $request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);
            }
            DB::table('aadhaarcard')->where('id', $insertid)->update([
                'aadhaar_card' => $aadhaarimg,
            ]);

            if ($request->bank_pass_book != null) {
                $bank_pass_book    = uniqid() . '.' . $request->file('bank_pass_book')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'bank_pass_book' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['bank_pass_book']['tmp_name'], $filepath . $bank_pass_book);
            }
            DB::table('aadhaarcard')->where('id', $insertid)->update([
                'bank_pass_book' => $bank_pass_book,
            ]);
            if ($request->smartcard_onlineprint != null) {
                $smartcard_onlineprint    = uniqid() . '.' . $request->file('smartcard_onlineprint')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smartcard_onlineprint' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['smartcard_onlineprint']['tmp_name'], $filepath . $smartcard_onlineprint);
            }
            DB::table('aadhaarcard')->where('id', $insertid)->update([
                'smartcard_onlineprint' => $smartcard_onlineprint,
            ]);
            if ($request->voterid != null) {
                $voterid    = uniqid() . '.' . $request->file('voterid')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'voterid' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['voterid']['tmp_name'], $filepath . $voterid);
            }
            DB::table('aadhaarcard')->where('id', $insertid)->update([
                'voterid' => $voterid,
            ]);
        } elseif ($serviceid == 159) {
            DB::table('aadhaarcard')->insert([
                'user_id'           => $user_id,
                'retailer_id'       => $retailer_id,
                'distributor_id'    => $distributor_id,
                'service_id'        => $request->serviceid,
                'amount'                      => $request->amount,
                'name'                       => $request->name,
                'mobile'                     => $request->mobile,
                'father_hus_aadhaar_no'      => $request->father_hus_aadhaar_no,
                'aadhaar_no'                 => $request->aadhaar_no,
                'father_hus_mobile'          => $request->father_hus_mobile,
                'relationship'          => $request->relationship,
                'centerno'            => Auth::user()->phone,
                'status'            => 'Pending',
                'applied_date'      => date("Y-m-d"),
                'created_at'        => date("Y-m-d"),
            ]);

            $insertid = DB::getPdo()->lastInsertId();
            $enrollment_slip = "";
            $correction_proof = "";
            $aadhaarimg = "";

            if ($request->aadhaar_card != null) {
                $aadhaarimg = uniqid() . '.' . $request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);
            }
            DB::table('aadhaarcard')->where('id', $insertid)->update([
                'aadhaar_card' => $aadhaarimg,
            ]);
            if ($request->enrollment_slip != null) {
                $enrollment_slip = uniqid() . '.' . $request->file('enrollment_slip')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'enrollment_slip' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['enrollment_slip']['tmp_name'], $filepath . $enrollment_slip);
            }
            DB::table('aadhaarcard')->where('id', $insertid)->update([
                'enrollment_slip' => $enrollment_slip,
            ]);

            if ($request->correction_proof != null) {
                $correction_proof = uniqid() . '.' . $request->file('correction_proof')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'correction_proof' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['correction_proof']['tmp_name'], $filepath . $correction_proof);
            }
            DB::table('aadhaarcard')->where('id', $insertid)->update([
                'correction_proof' => $correction_proof,
            ]);
        } elseif ($serviceid == 160 || $serviceid == 161) {
            DB::table('aadhaarcard')->insert([
                'user_id'           => $user_id,
                'retailer_id'       => $retailer_id,
                'distributor_id'    => $distributor_id,
                'service_id'        => $request->serviceid,
                'amount'            => $request->amount,
                'enrollment_no'     => $request->enrollment_no,
                'enrollment_type'   => $request->enrollment_type,
                'centerno'            => Auth::user()->phone,
                'status'            => 'Pending',
                'applied_date'      => date("Y-m-d"),
                'created_at'        => date("Y-m-d"),
            ]);

            $insertid = DB::getPdo()->lastInsertId();
            $enrollment_slip = "";

            if ($request->enrollment_slip != null) {
                $enrollment_slip = uniqid() . '.' . $request->file('enrollment_slip')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'enrollment_slip' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['enrollment_slip']['tmp_name'], $filepath . $enrollment_slip);
            }
            DB::table('aadhaarcard')->where('id', $insertid)->update([
                'enrollment_slip' => $enrollment_slip,
            ]);
        } elseif ($serviceid == 162) {
            DB::table('aadhaarcard')->insert([
                'user_id'           => $user_id,
                'retailer_id'       => $retailer_id,
                'distributor_id'    => $distributor_id,
                'service_id'        => $request->serviceid,
                'amount'            => $request->amount,
                'name'              => $request->name,
                'mobile'            => $request->mobile,
                'aadhaar_no'        => $request->aadhaar_no,
                'centerno'            => Auth::user()->phone,
                'status'            => 'Pending',
                'applied_date'      => date("Y-m-d"),
                'created_at'        => date("Y-m-d"),
            ]);
        } elseif ($serviceid == 163) {
            DB::table('aadhaarcard')->insert([
                'user_id'           => $user_id,
                'retailer_id'       => $retailer_id,
                'distributor_id'    => $distributor_id,
                'service_id'        => $request->serviceid,
                'amount'            => $request->amount,
                'name'              => $request->name,
                'aadhaar_no'        => $request->aadhaar_no,
                'centerno'            => Auth::user()->phone,
                'status'            => 'Pending',
                'applied_date'      => date("Y-m-d"),
                'created_at'        => date("Y-m-d"),
            ]);
        }


        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));


        $getpermission = DB::table('service_payment')->where('service_id', $serviceid)->first();
        $coordinator_permission = 0;
        $admin_payment = 0;
        if ($getpermission) {
            $coordinator_permission = $getpermission->coordinator_permission;
            $admin_payment = $getpermission->admin_amount;
        }
        if ($coordinator_permission == 1) {
            $getdata = DB::table('aadhaarcard')->where('id', $insertid)->first();
            if ($getdata) {
                $bank_pass_book = $getdata->bank_pass_book;
                $smartcard_onlineprint = $getdata->smartcard_onlineprint;
                $voterid = $getdata->voterid;
                $voterid_file = $getdata->voterid;
                $aadhaar_card = $getdata->aadhaar_card;
                $aadhaar_file = $getdata->aadhaar_card;
                $parent_aadhaar_front = $getdata->parent_aadhaar_front;
                $schl_id_card = $getdata->schl_id_card;
                $photo = $getdata->photo;
                $birth_certificate = $getdata->birth_certificate;
                $service_id = $getdata->service_id;
                $rowid = $getdata->id;
                $name = $getdata->name;
                $door_no = $getdata->door_no;
                $dist_id = $getdata->dist_id;
                $taluk_id = $getdata->taluk_id;
                $postal_area_english = $getdata->postal_area_english;
                $street_name_tamil = $getdata->street_name_tamil;
                $mobile = $getdata->mobile;
                $pin_code = $getdata->pin_code;
                $street_name = $getdata->street_name;
                $aadhaar_no = $getdata->aadhaar_no;
                $id_proof = $getdata->id_proof;
                $relationship = $getdata->relationship;
                $applicant_document_type = $getdata->applicant_document_type;
                $parent_document_type = $getdata->parent_document_type;
                $parent_mobile = $getdata->parent_mobile;
                $parent_aadhaar = $getdata->parent_aadhaar;
                $parent_name = $getdata->parent_name;
                $relative_address_tamil = $getdata->relative_address_tamil;
                $relative_address_english = $getdata->relative_address_english;
                $relation_name = $getdata->relation_name;
                $relation_aadhaar = $getdata->relation_aadhaar;
                $relation_mobile = $getdata->relation_mobile;
                $marital_status = $getdata->marital_status;
                $postal_area_tamil = $getdata->postal_area_tamil;
                $apartment = $getdata->apartment;
                $state_tamil = $getdata->state_tamil;
                $district_tamil = $getdata->district_tamil;
                $post_office = $getdata->post_office;
                $post_office_tamil = $getdata->post_office_tamil;
                $village = $getdata->village;
                $village_tamil = $getdata->village_tamil;
                $district = $getdata->district;
                $taluka = $getdata->taluka;
                $taluka_tamil = $getdata->taluka_tamil;
                $state = $getdata->state;
                $relationship = $getdata->relationship;
                $relation_name_tamil = $getdata->relation_name_tamil;
                $relation_name_english = $getdata->relation_name_english;
                $relationship_tamil = $getdata->relationship_tamil;
                $status = $getdata->status;
                $centerno = $getdata->centerno;
                $url = url('/');
                $aadhaar_url = $url . '/upload/services/aadhaar_card/' . $aadhaar_card;
                $bank_pass_book_url = $url . '/upload/services/bank_pass_book/' . $bank_pass_book;
                $smartcard_onlineprint_url = $url . '/upload/services/smartcard_onlineprint/' . $smartcard_onlineprint;
                $voterid_url = $url . '/upload/services/voterid/' . $voterid;

                $doctype_aadhaar_url = $url . '/upload/services/doctype/' . $aadhaar_card;
                $doctype_photo_url = $url . '/upload/services/doctype/' . $photo;
                $doctype_birth_certificate_url = $url . '/upload/services/doctype/' . $birth_certificate;
                $doctype_schl_id_card_url = $url . '/upload/services/doctype/' . $schl_id_card;
                $doctype_smartcard_onlineprint_url = $url . '/upload/services/doctype/' . $smartcard_onlineprint;
                $doctype_voterid_url = $url . '/upload/services/doctype/' . $voterid;

                $parent_aadhaar_url = $url . '/upload/services/parentdoctype/' . $parent_aadhaar_front;
                $parentdoctype_bank_pass_book_url = $url . '/upload/services/parentdoctype/' . $bank_pass_book;
                $parentdoctype_voterid_url = $url . '/upload/services/parentdoctype/' . $voterid;
                $API_KEY = env('API_KEY', '');
                $RAMJIPAY_URL = env('RAMJIPAY_URL', '');
                $WEBSITE_INDEX = env('WEBSITE_INDEX', '');
                $ch = curl_init();

                if ($serviceid == 56) {
                    $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&bank_pass_book=$bank_pass_book_url&smartcard_onlineprint=$smartcard_onlineprint_url&voterid=$voterid_url&aadhaar_file=$aadhaar_url&service_id=$service_id&rowid=$rowid&status=$status&name=$name&door_no=$door_no&dist_id=$dist_id&taluk_id=$taluk_id&postal_area_tamil=$postal_area_tamil&postal_area_english=$postal_area_english&state=$state&mobile=$mobile&pin_code=$pin_code&apartment=$apartment&aadhaar_no=$aadhaar_no&id_proof=$id_proof&street_name=$street_name&street_name_tamil=$street_name_tamil&state_tamil=$state_tamil&district_tamil=$district_tamil&post_office=$post_office&post_office_tamil=$post_office_tamil&village=$village&village_tamil=$village_tamil&district=$district&taluka=$taluka&taluka_tamil=$taluka_tamil&centerno=$centerno";
                } elseif ($serviceid == 58) {
                    $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&service_id=$service_id&rowid=$rowid&status=$status&aadhaar_no=$aadhaar_no&mobile=$mobile&name=$name&relationship=$relationship&parent_name=$parent_name&parent_aadhaar=$parent_aadhaar&parent_mobile=$parent_mobile&relative_address_english=$relative_address_english&relative_address_tamil=$relative_address_tamil&applicant_document_type=$applicant_document_type&parent_document_type=$parent_document_type&aadhaar_card=$doctype_aadhaar_url&schl_id_card=$doctype_schl_id_card_url&birth_certificate=$doctype_birth_certificate_url&photo=$doctype_photo_url&parent_aadhaar_front=$parent_aadhaar_url&bank_pass_book=$parentdoctype_bank_pass_book_url&voterid=$parentdoctype_voterid_url&centerno=$centerno";
                } elseif ($serviceid == 158) {
                    $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&bank_pass_book=$bank_pass_book_url&smartcard_onlineprint=$smartcard_onlineprint_url&voterid=$voterid_url&aadhaar_file=$aadhaar_url&service_id=$service_id&rowid=$rowid&status=$status&name=$name&door_no=$door_no&dist_id=$dist_id&taluk_id=$taluk_id&postal_area_tamil=$postal_area_tamil&postal_area_english=$postal_area_english&state=$state&mobile=$mobile&pin_code=$pin_code&apartment=$apartment&aadhaar_no=$aadhaar_no&id_proof=$id_proof&street_name=$street_name&street_name_tamil=$street_name_tamil&state_tamil=$state_tamil&district_tamil=$district_tamil&post_office=$post_office&post_office_tamil=$post_office_tamil&village=$village&village_tamil=$village_tamil&district=$district&taluka=$taluka&taluka_tamil=$taluka_tamil&centerno=$centerno&relationship=$relationship&relation_name_tamil=$relation_name_tamil&relation_name_english=$relation_name_english&relation_aadhaar=$relation_aadhaar&relationship_tamil=$relationship_tamil";
                }

                //dd($post_data);
                $url1 = $RAMJIPAY_URL . '/api/get_aadhaarcard_api';
                curl_setopt($ch, CURLOPT_URL, $url1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $server_output = curl_exec($ch);
                curl_close($ch);
                $resdata = json_decode($server_output, true);
                //dd($resdata);
                if ($resdata) {
                    $status = $resdata['message'];
                    if ($status == "Success") {
                        $date = date('Y-m-d');
                        $time = date('H:i:s');
                        $service_status = 'Out Payment';
                        $ad_info = 'Ramji Wallet Debit' . ' ' . $servicename;
                        $getrawallet = DB::table('users')->select('rawallet')->where('id', 1)->first();
                        $rawallet = 0;
                        if ($getrawallet) {
                            $balance1 = $getrawallet->rawallet;
                        }

                        $getrawallet1 = DB::table('users')->select('rawallet')->where('id', 2)->first();
                        $rawallet1 = 0;
                        if ($getrawallet1) {
                            $balance2 = $getrawallet1->rawallet;
                        }
                        $newbalance2 = $balance1 + $admin_payment;
                        $newbalance3 = $balance2 - $admin_payment;
                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet + $admin_payment where id = 1";
                        DB::update(DB::raw($sql));
                        $service_status = 'IN Payment';
                        $ad_info = 'Ramji Wallet Credit' . ' ' . $servicename;

                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet - $admin_payment where id = 2";
                        DB::update(DB::raw($sql));
                    }
                }
            }
        }
        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }
    public function submitapply_aadhaarfind(Request $request)
    {

        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
        DB::table('aadhaarfind')->insert([
            'user_id'           => $user_id,
            'retailer_id'       => $retailer_id,
            'distributor_id'    => $distributor_id,
            'service_id'        => $request->serviceid,
            'amount'            => $request->amount,
            'name'              => $request->name,
            'mobile'              => $request->mobile,
            'find_number'         => $request->find_number,
            'nalavariyam_reg_no'       => $request->nalavariyam_reg_no,
            'status'            => 'Pending',
            'applied_date'      => date("Y-m-d"),
            'created_at'        => date("Y-m-d"),
        ]);

        $insertid = DB::getPdo()->lastInsertId();

        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        $getpermission = DB::table('service_payment')->where('service_id', $serviceid)->first();
        $coordinator_permission = 0;
        $admin_payment = 0;
        if ($getpermission) {
            $coordinator_permission = $getpermission->coordinator_permission;
            $admin_payment = $getpermission->admin_amount;
        }
        if ($coordinator_permission == 1) {
            $getdata = DB::table('aadhaarfind')->where('id', $insertid)->first();
            if ($getdata) {
                $service_id = $getdata->service_id;
                $rowid = $getdata->id;
                $name = $getdata->name;
                $mobile = $getdata->mobile;
                $find_number = $getdata->find_number;
                $nalavariyam_reg_no = $getdata->nalavariyam_reg_no;
                $status = $getdata->status;
                $url = url('/');
                $API_KEY = env('API_KEY', '');
                $RAMJIPAY_URL = env('RAMJIPAY_URL', '');
                $WEBSITE_INDEX = env('WEBSITE_INDEX', '');
                $ch = curl_init();

                if ($serviceid == 72) {
                    $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&service_id=271&rowid=$rowid&status=$status&find_number=$find_number&mobile=$mobile&name=$name&nalavariyam_reg_no=$nalavariyam_reg_no";
                }

                //dd($post_data);
                $url1 = $RAMJIPAY_URL . '/api/get_aadhaarfind_api';
                curl_setopt($ch, CURLOPT_URL, $url1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $server_output = curl_exec($ch);
                curl_close($ch);
                $resdata = json_decode($server_output, true);
                //dd($resdata);
                if ($resdata) {
                    $status = $resdata['message'];
                    if ($status == "Success") {
                        $date = date('Y-m-d');
                        $time = date('H:i:s');
                        $service_status = 'Out Payment';
                        $ad_info = 'Ramji Wallet Debit' . ' ' . $servicename;
                        $getrawallet = DB::table('users')->select('rawallet')->where('id', 1)->first();
                        $rawallet = 0;
                        if ($getrawallet) {
                            $balance1 = $getrawallet->rawallet;
                        }

                        $getrawallet1 = DB::table('users')->select('rawallet')->where('id', 2)->first();
                        $rawallet1 = 0;
                        if ($getrawallet1) {
                            $balance2 = $getrawallet1->rawallet;
                        }
                        $newbalance2 = $balance1 + $admin_payment;
                        $newbalance3 = $balance2 - $admin_payment;
                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet + $admin_payment where id = 1";
                        DB::update(DB::raw($sql));
                        $service_status = 'IN Payment';
                        $ad_info = 'Ramji Wallet Credit' . ' ' . $servicename;

                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet - $admin_payment where id = 2";
                        DB::update(DB::raw($sql));
                    }
                }
            }
        }
        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }
    public function submitapply_canedit(Request $request)
    {
        //dd($request->all());
        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
        if ($serviceid == 60 || $serviceid == 121) {
            DB::table('can_edit')->insert([
                'user_id'                     => $user_id,
                'retailer_id'                 => $retailer_id,
                'distributor_id'              => $distributor_id,
                'service_id'                  => $request->serviceid,
                'dist_id'                     => $request->dist_id,
                'taluk_id'                    => $request->taluk_id,
                'panchayath_id'               => $request->panchayath_id,
                'vao_area'                    => $request->vao_area,
                'amount'                      => $request->amount,
                'mobile'                      => $request->mobile,
                'personalized_name_english'   => $request->personalized_name_english,
                'personalized'                => $request->personalized,
                'mother_name_tamil'           => $request->mother_name_tamil,
                'mother_name_english'         => $request->mother_name_english,
                'personalized_name_tamil'     => $request->personalized_name_tamil,
                'relationship_1'              => $request->relationship_1,
                'relationship_2'              => $request->relationship_2,
                'relationship_3'              => $request->relationship_3,
                'relationship_name_tamil_1'   => $request->relationship_name_tamil_1,
                'relationship_name_tamil_2'   => $request->relationship_name_tamil_2,
                'relationship_name_tamil_3'   => $request->relationship_name_tamil_3,
                'relationship_name_english_1' => $request->relationship_name_english_1,
                'relationship_name_english_2' => $request->relationship_name_english_2,
                'relationship_name_english_3' => $request->relationship_name_english_3,
                'postal_area_tamil'           => $request->postal_area_tamil,
                'postal_area_english'         => $request->postal_area_english,
                'dob'                         => $request->dob,
                'religion'                    => $request->religion,
                'education'                   => $request->education,
                'work'                        => $request->work,
                'door_no'                     => $request->door_no,
                'community'                   => $request->community,
                'caste'                       => $request->caste,
                'maritial_status'             => $request->maritial_status,
                'aadhaar_number'              => $request->aadhaar_number,
                'smartcard_number'            => $request->smartcard_number,
                'street_name_tamil'           => $request->street_name_tamil,
                'street_name'                 => $request->street_name,
                'pin_code'                    => $request->pin_code,
                'doc_type'                    => $request->doc_type,
                'address_english'                    => $request->address_english,
                'ration_no'                    => $request->ration_no,
                'epic_no'                    => $request->epic_no,
                'pan_no'                    => $request->pan_no,
                'srilanka_rationcard_no'                    => $request->srilanka_rationcard_no,
                'name_tamil'                    => $request->name_tamil,
                'address_tamil'                    => $request->address_tamil,
                'name_english'                    => $request->name_english,
                'relationship'                    => $request->relationship,
                'status'                      => 'Pending',
                'applied_date'                => date("Y-m-d"),
                'created_at'                  => date("Y-m-d"),
            ]);

            $insertid     = DB::getPdo()->lastInsertId();
            $smartimg     = "";
            $aadhaar_card = "";

            if ($request->smart_card != null) {
                $smartimg = uniqid() . '.' . $request->file('smart_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smartimg);
            }
            DB::table('can_edit')->where('id', $insertid)->update([
                'smart_card' => $smartimg,
            ]);

            if ($request->aadhaar_card != null) {
                $aadhaar_card = uniqid() . '.' . $request->file('aadhaar_card')->extension();
                $filepath     = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
            }
            DB::table('can_edit')->where('id', $insertid)->update([
                'aadhaar_card' => $aadhaar_card,
            ]);
        } elseif ($serviceid == 62) {
            DB::table('can_edit')->insert([
                'user_id'                    => $user_id,
                'retailer_id'                => $retailer_id,
                'distributor_id'             => $distributor_id,
                'service_id'                 => $request->serviceid,
                'amount'                     => $request->amount,
                'can_number'                 => $request->can_number,
                'select_name'                => $request->select_name,
                'name_tamil'                 => $request->name_tamil,
                'name_english'               => $request->name_english,
                'dist_id'                    => $request->dist_id,
                'status'                     => 'Pending',
                'applied_date'               => date("Y-m-d"),
                'created_at'                 => date("Y-m-d"),
            ]);

            $insertid = DB::getPdo()->lastInsertId();
            $aadhaar_card = "";

            if ($request->aadhaar_card != null) {
                $aadhaar_card = uniqid() . '.' . $request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
            }
            DB::table('can_edit')->where('id', $insertid)->update([
                'aadhaar_card' => $aadhaar_card,
            ]);
        } elseif ($serviceid == 63) {
            DB::table('can_edit')->insert([
                'user_id'                    => $user_id,
                'retailer_id'                => $retailer_id,
                'distributor_id'             => $distributor_id,
                'service_id'                 => $request->serviceid,
                'amount'                     => $request->amount,
                'can_number'                 => $request->can_number,
                'original_dob'               => $request->original_dob,
                'dist_id'                    => $request->dist_id,
                'status'                     => 'Pending',
                'applied_date'               => date("Y-m-d"),
                'created_at'                 => date("Y-m-d"),
            ]);

            $insertid = DB::getPdo()->lastInsertId();
            $aadhaar_card = "";

            if ($request->aadhaar_card != null) {
                $aadhaar_card = uniqid() . '.' . $request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
            }
            DB::table('can_edit')->where('id', $insertid)->update([
                'aadhaar_card' => $aadhaar_card,
            ]);
        } elseif ($serviceid == 64) {
            // dd(date("Y-m-d H:i:s"));die;
            DB::table('can_edit')->insert([
                'user_id'                    => $user_id,
                'retailer_id'                => $retailer_id,
                'distributor_id'             => $distributor_id,
                'service_id'                 => $request->serviceid,
                'amount'                     => $request->amount,
                'can_number'                 => $request->can_number,
                'new_mobile_no'              => $request->new_mobile_no,
                'status'                     => 'Pending',
                'applied_date'               => date("Y-m-d"),
                'created_at'                 => date("Y-m-d"),
            ]);

            $insertid = DB::getPdo()->lastInsertId();
            $aadhaar_card = "";

            //     if ($request->aadhaar_card != null) {
            //      $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
            //      $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
            //      move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);

            //  }
            //  DB::table('can_edit')->where('id', $insertid)->update([
            //     'aadhaar_card' => $aadhaar_card,
            // ]);
        } elseif ($serviceid == 65) {
            DB::table('can_edit')->insert([
                'user_id'                    => $user_id,
                'retailer_id'                => $retailer_id,
                'distributor_id'             => $distributor_id,
                'service_id'                 => $request->serviceid,
                'amount'                     => $request->amount,
                'can_number'                 => $request->can_number,
                'certificate_name'           => $request->certificate_name,
                'aadhaar_number'             => $request->aadhaar_number,
                'applicant_name'             => $request->applicant_name,
                'status'                     => 'Pending',
                'applied_date'               => date("Y-m-d"),
                'created_at'                 => date("Y-m-d"),
            ]);

            $insertid = DB::getPdo()->lastInsertId();
            $aadhaar_card = "";

            if ($request->aadhaar_card != null) {
                $aadhaar_card = uniqid() . '.' . $request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
            }
            DB::table('can_edit')->where('id', $insertid)->update([
                'aadhaar_card' => $aadhaar_card,
            ]);
        } elseif ($serviceid == 66) {
            DB::table('can_edit')->insert([
                'user_id'                    => $user_id,
                'retailer_id'                => $retailer_id,
                'distributor_id'             => $distributor_id,
                'service_id'                 => $request->serviceid,
                'amount'                     => $request->amount,
                'can_number'                 => $request->can_number,
                'aadhaar_number'             => $request->aadhaar_number,
                'status'                     => 'Pending',
                'applied_date'               => date("Y-m-d"),
                'created_at'                 => date("Y-m-d"),
            ]);

            $insertid = DB::getPdo()->lastInsertId();
            $aadhaar_card = "";

            if ($request->aadhaar_card != null) {
                $aadhaar_card = uniqid() . '.' . $request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
            }
            DB::table('can_edit')->where('id', $insertid)->update([
                'aadhaar_card' => $aadhaar_card,
            ]);
        } elseif ($serviceid == 67 || $serviceid == 246) {
            DB::table('can_edit')->insert([
                'user_id'                    => $user_id,
                'retailer_id'                => $retailer_id,
                'distributor_id'             => $distributor_id,
                'service_id'                 => $request->serviceid,
                'amount'                     => $request->amount,
                'can_number'                 => $request->can_number,
                'certificate_number'           => $request->certificate_number,
                'applicant_name'             => $request->applicant_name,
                'dob'                        => $request->dob,
                'aadhaar_number'         => $request->aadhaar_number,
                'mobile'                 => $request->mobile,
                'name_english'           => $request->name_english,
                'name_tamil'             => $request->name_tamil,
                'status'                     => 'Pending',
                'applied_date'               => date("Y-m-d"),
                'created_at'                 => date("Y-m-d"),
            ]);

            $insertid = DB::getPdo()->lastInsertId();
            $aadhaar_card = "";

            if ($request->aadhaar_card != null) {
                $aadhaar_card = uniqid() . '.' . $request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
            }
            DB::table('can_edit')->where('id', $insertid)->update([
                'aadhaar_card' => $aadhaar_card,
            ]);
        } elseif ($serviceid == 208 || $serviceid == 209 || $serviceid == 210 || $serviceid == 211 || $serviceid == 226 || $serviceid == 227 || $serviceid == 229 || $serviceid == 230) {
            DB::table('can_edit')->insert([
                'user_id'                    => $user_id,
                'retailer_id'                => $retailer_id,
                'distributor_id'             => $distributor_id,
                'service_id'                 => $request->serviceid,
                'amount'                     => $request->amount,
                'can_number'                 => $request->can_number,
                'select_name'                 => $request->select_name,
                'mobile'                     => $request->mobile,
                'dob'                        => $request->dob,
                'name_tamil'                 => $request->name_tamil,
                'name_english'               => $request->name_english,
                'application_name'           => $request->application_name,
                'certificate_name'           => $request->certificate_name,
                'applicant_name'             => $request->applicant_name,
                'certificate_number'         => $request->certificate_number,
                'father_name'                => $request->father_name,
                'father_name_english'        => $request->father_name_english,
                'revenue_village'            => $request->revenue_village,
                'door_no'                    => $request->door_no,
                'street_name'                => $request->street_name,
                'postal_area_english'        => $request->postal_area_english,
                'dist_id'                    => $request->dist_id,
                'taluk_id'                   => $request->taluk_id,
                'pin_code'                   => $request->pin_code,
                'street_name_tamil'          => $request->street_name_tamil,
                'postal_area_tamil'          => $request->postal_area_tamil,
                'status'                     => 'Pending',
                'applied_date'               => date("Y-m-d"),
                'created_at'                 => date("Y-m-d"),
            ]);

            $insertid = DB::getPdo()->lastInsertId();
            $aadhaar_card = "";

            if ($request->aadhaar_card != null) {
                $aadhaar_card = uniqid() . '.' . $request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
            }
            DB::table('can_edit')->where('id', $insertid)->update([
                'aadhaar_card' => $aadhaar_card,
            ]);
        }

        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));


        $getpermission = DB::table('service_payment')->where('service_id', $serviceid)->first();
        $coordinator_permission = 0;
        $admin_payment = 0;
        if ($getpermission) {
            $coordinator_permission = $getpermission->coordinator_permission;
            $admin_payment = $getpermission->admin_amount;
        }
        if ($coordinator_permission == 1) {
            $getdata = DB::table('can_edit')->where('id', $insertid)->first();
            if ($getdata) {
                $aadhaar_card = $getdata->aadhaar_card;
                $service_id = $getdata->service_id;
                $rowid = $getdata->id;
                $status = $getdata->status;
                $can_number = $getdata->can_number;
                $select_name = $getdata->select_name;
                $name_tamil = $getdata->name_tamil;
                $name_english = $getdata->name_english;
                $dob1 = $getdata->original_dob;
                $mobile1 = $getdata->new_mobile_no;
                $mobile = $getdata->mobile;
                $certificate_name = $getdata->certificate_name;
                $certificate_number = $getdata->certificate_number;
                $aadhaar_number = $getdata->aadhaar_number;
                $application_name = $getdata->application_name;
                $applicant_name = $getdata->applicant_name;
                $dob = $getdata->dob;
                $revenue_village = $getdata->revenue_village;
                $door_no = $getdata->door_no;
                $street_name = $getdata->street_name;
                $postal_area_english = $getdata->postal_area_english;
                $dist_id = $getdata->dist_id;
                $taluk_id = $getdata->taluk_id;
                $pin_code = $getdata->pin_code;
                $street_name_tamil = $getdata->street_name_tamil;
                $postal_area_tamil = $getdata->postal_area_tamil;
                $father_name = $getdata->father_name;
                $father_name_english = $getdata->father_name_english;
                $doc_type = $getdata->doc_type;
                $ration_no = $getdata->ration_no;
                $epic_no = $getdata->epic_no;
                $pan_no = $getdata->pan_no;
                $srilanka_rationcard_no = $getdata->srilanka_rationcard_no;
                $husband_name_tamil = $getdata->husband_name_tamil;
                $husband_name_english = $getdata->husband_name_english;
                $personalized = $getdata->personalized;
                $relationship = $getdata->relationship;
                $religion = $getdata->religion;
                $vao_area = $getdata->vao_area;
                $mother_name_english = $getdata->mother_name_english;
                $mother_name_tamil = $getdata->mother_name_tamil;
                $personalized_name_english = $getdata->personalized_name_english;
                $personalized_name_tamil = $getdata->personalized_name_tamil;
                $address_tamil = $getdata->address_tamil;
                $address_english = $getdata->address_english;
                $maritial_status = $getdata->maritial_status;
                $community = $getdata->community;
                $url = url('/');
                $aadhaar_url = $url . '/upload/services/aadhaar_card/' . $aadhaar_card;
                $API_KEY = env('API_KEY', '');
                $RAMJIPAY_URL = env('RAMJIPAY_URL', '');
                $WEBSITE_INDEX = env('WEBSITE_INDEX', '');
                $ch = curl_init();
                if ($serviceid == 60) {
                    $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=$service_id&rowid=$rowid&status=$status&name_tamil=$name_tamil&name_english=$name_english&dist_id=$dist_id&taluk_id=$taluk_id&aadhaar_number=$aadhaar_number&personalized=$personalized&relationship=$relationship&vao_area=$vao_area&dob=$dob&religion=$religion&door_no=$door_no&pin_code=$pin_code&mobile=$mobile&community=$community&maritial_status=$maritial_status&doc_type=$doc_type&ration_no=$ration_no&epic_no=$epic_no&pan_no=$pan_no&srilanka_rationcard_no=$srilanka_rationcard_no&mother_name_english=$mother_name_english&address_tamil=$address_tamil&address_english=$address_english&personalized_name_tamil=$personalized_name_tamil&personalized_name_english=$personalized_name_english&mother_name_tamil=$mother_name_tamil";
                } elseif ($serviceid == 62) {
                    $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=$service_id&rowid=$rowid&status=$status&can_number=$can_number&select_name=$select_name&name_tamil=$name_tamil&name_english=$name_english&dist_id=$dist_id";
                } elseif ($serviceid == 63) {
                    $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=$service_id&rowid=$rowid&status=$status&can_number=$can_number&dob=$dob1&dist_id=$dist_id";
                } elseif ($serviceid == 64) {
                    $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=$service_id&rowid=$rowid&status=$status&can_number=$can_number&mobile=$mobile1";
                } elseif ($serviceid == 65 || $serviceid == 67) {
                    $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=$service_id&rowid=$rowid&status=$status&can_number=$can_number&mobile=$mobile&certificate_name=$certificate_name&certificate_number=$certificate_number&aadhaar_number=$aadhaar_number&applicant_name=$applicant_name";
                } elseif ($serviceid == 66) {
                    $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=$service_id&rowid=$rowid&status=$status&can_number=$can_number&name_tamil=$name_tamil";
                } elseif ($serviceid == 121) {
                    $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=$service_id&rowid=$rowid&status=$status&can_number=$can_number&aadhaar_number=$aadhaar_number";
                } elseif ($serviceid == 208 || $serviceid == 209 || $serviceid == 210 || $serviceid == 211) {
                    $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=$service_id&rowid=$rowid&status=$status&can_number=$can_number&select_name=$select_name&dist_id=$dist_id&name_tamil=$name_tamil&name_english=$name_english&mobile=$mobile&dob=$dob&application_name=$application_name&certificate_name=$certificate_name";
                } elseif ($serviceid == 226) {
                    $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=226&rowid=$rowid&status=$status&can_number=$can_number&certificate_number=$certificate_number&certificate_name=$certificate_name&applicant_name=$applicant_name";
                } elseif ($serviceid == 227) {
                    $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=227&rowid=$rowid&status=$status&can_number=$can_number&certificate_number=$certificate_number&certificate_name=$certificate_name&applicant_name=$applicant_name";
                } elseif ($serviceid == 229) {
                    $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=241&rowid=$rowid&status=$status&can_number=$can_number&dist_id=$dist_id&father_name=$father_name&father_name_english=$father_name_english";
                } elseif ($serviceid == 230) {
                    $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=242&rowid=$rowid&status=$status&can_number=$can_number&dist_id=$dist_id&taluk_id=$taluk_id&revenue_village=$revenue_village&door_no=$door_no&street_name=$street_name&pin_code=$pin_code&street_name_tamil=$street_name_tamil&postal_area_tamil=$postal_area_tamil&postal_area_english=$postal_area_english";
                }



                //dd($post_data);
                $url1 = $RAMJIPAY_URL . '/api/get_cannumber_api';
                //echo $url1;die;
                curl_setopt($ch, CURLOPT_URL, $url1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $server_output = curl_exec($ch);
                curl_close($ch);
                $resdata = json_decode($server_output, true);
                //dd($resdata);
                if ($resdata) {
                    $status = $resdata['message'];
                    if ($status == "Success") {
                        $date = date('Y-m-d');
                        $time = date('H:i:s');
                        $service_status = 'Out Payment';
                        $ad_info = 'Ramji Wallet Debit' . ' ' . $servicename;
                        $getrawallet = DB::table('users')->select('rawallet')->where('id', 1)->first();
                        $rawallet = 0;
                        if ($getrawallet) {
                            $balance1 = $getrawallet->rawallet;
                        }

                        $getrawallet1 = DB::table('users')->select('rawallet')->where('id', 2)->first();
                        $rawallet1 = 0;
                        if ($getrawallet1) {
                            $balance2 = $getrawallet1->rawallet;
                        }
                        $newbalance2 = $balance1 + $admin_payment;
                        $newbalance3 = $balance2 - $admin_payment;
                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet + $admin_payment where id = 1";
                        DB::update(DB::raw($sql));
                        $service_status = 'IN Payment';
                        $ad_info = 'Ramji Wallet Credit' . ' ' . $servicename;

                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet - $admin_payment where id = 2";
                        DB::update(DB::raw($sql));
                    }
                }
            }
        }

        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }


    public function submitsmartcardapply1(Request $request)
    {

        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
        if ($serviceid == 77) {
            DB::table('smartcard')->insert([
                'user_id'                   => $user_id,
                'retailer_id'               => $retailer_id,
                'distributor_id'            => $distributor_id,
                'service_id'                => $request->serviceid,
                'amount'                    => $request->amount,
                'name'                      => $request->name,
                'status'                    => 'Pending',
                'applied_date'              => date("Y-m-d"),
                'created_at'                => date("Y-m-d"),
            ]);

            $insertid = DB::getPdo()->lastInsertId();

            $aadhaarimg = "";

            if ($request->aadhaar_card != null) {
                $aadhaarimg = uniqid() . '.' . $request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'aadhaar_card' => $aadhaarimg,
            ]);
        } elseif ($serviceid == 78) {
            DB::table('smartcard')->insert([
                'user_id'                   => $user_id,
                'retailer_id'               => $retailer_id,
                'distributor_id'            => $distributor_id,
                'service_id'                => $request->serviceid,
                'amount'                    => $request->amount,
                'status'                    => 'Pending',
                'applied_date'              => date("Y-m-d"),
                'created_at'                => date("Y-m-d"),
            ]);

            $insertid = DB::getPdo()->lastInsertId();
            $aadhaarimg = "";
            $smart_card = "";

            if ($request->aadhaar_card != null) {
                $aadhaarimg = uniqid() . '.' . $request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'aadhaar_card' => $aadhaarimg,
            ]);
            if ($request->smart_card != null) {
                $smart_card = uniqid() . '.' . $request->file('smart_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smart_card);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'smart_card' => $smart_card,
            ]);
        } elseif ($serviceid == 79) {
            DB::table('smartcard')->insert([
                'user_id'                   => $user_id,
                'retailer_id'               => $retailer_id,
                'distributor_id'            => $distributor_id,
                'service_id'                => $request->serviceid,
                'amount'                    => $request->amount,
                'name'                      => $request->name,
                'mobile'                    => $request->mobile,
                'status'                    => 'Pending',
                'applied_date'              => date("Y-m-d"),
                'created_at'                => date("Y-m-d"),
            ]);

            $insertid = DB::getPdo()->lastInsertId();
            $aadhaarimg = "";
            $applicant_reciept = "";
            $photo = "";

            if ($request->aadhaar_card != null) {
                $aadhaarimg = uniqid() . '.' . $request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'aadhaar_card' => $aadhaarimg,
            ]);
            if ($request->applicant_reciept != null) {
                $applicant_reciept = uniqid() . '.' . $request->file('applicant_reciept')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'applicantreciept' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['applicant_reciept']['tmp_name'], $filepath . $aadhaarimg);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'applicant_reciept' => $applicant_reciept,
            ]);
            if ($request->photo != null) {
                $photo = uniqid() . '.' . $request->file('photo')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $aadhaarimg);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'photo' => $photo,
            ]);
        } elseif ($serviceid == 80) {
            DB::table('smartcard')->insert([
                'user_id'                   => $user_id,
                'retailer_id'               => $retailer_id,
                'distributor_id'            => $distributor_id,
                'service_id'                => $request->serviceid,
                'amount'                    => $request->amount,
                'smart_mobile'              => $request->smart_mobile,
                'mobile'                    => $request->mobile,
                'status'                    => 'Pending',
                'applied_date'              => date("Y-m-d"),
                'created_at'                => date("Y-m-d"),
            ]);
        } elseif ($serviceid == 81) {
            DB::table('smartcard')->insert([
                'user_id'                   => $user_id,
                'retailer_id'               => $retailer_id,
                'distributor_id'            => $distributor_id,
                'service_id'                => $request->serviceid,
                'amount'                    => $request->amount,
                'name'                      => $request->name,
                'change_cardtype'           => $request->change_cardtype,
                'status'                    => 'Pending',
                'applied_date'              => date("Y-m-d"),
                'created_at'                => date("Y-m-d"),
            ]);

            $insertid = DB::getPdo()->lastInsertId();
            $photo = "";
            $smartcard_online = "";

            if ($request->photo != null) {
                $photo = uniqid() . '.' . $request->file('photo')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'photo' => $photo,
            ]);
            if ($request->smartcard_online != null) {
                $smartcard_online = uniqid() . '.' . $request->file('smartcard_online')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smartcard_online' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['smartcard_online']['tmp_name'], $filepath . $smartcard_online);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'smartcard_online' => $smartcard_online,
            ]);
        } elseif ($serviceid == 82) {
            DB::table('smartcard')->insert([
                'user_id'                   => $user_id,
                'retailer_id'               => $retailer_id,
                'distributor_id'            => $distributor_id,
                'service_id'                => $request->serviceid,
                'amount'                    => $request->amount,
                'name'                      => $request->name,
                'mobile'                    => $request->mobile,
                'status'                    => 'Pending',
                'applied_date'              => date("Y-m-d"),
                'created_at'                => date("Y-m-d"),
            ]);

            $insertid = DB::getPdo()->lastInsertId();
            $aadhaarimg = "";
            $smart_card = "";

            if ($request->aadhaar_card != null) {
                $aadhaarimg = uniqid() . '.' . $request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'aadhaar_card' => $aadhaarimg,
            ]);
            if ($request->smart_card != null) {
                $smart_card = uniqid() . '.' . $request->file('smart_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smart_card);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'smart_card' => $smart_card,
            ]);
        } elseif ($serviceid == 83) {
            DB::table('smartcard')->insert([
                'user_id'                   => $user_id,
                'retailer_id'               => $retailer_id,
                'distributor_id'            => $distributor_id,
                'service_id'                => $request->serviceid,
                'amount'                    => $request->amount,
                'name'                      => $request->name,
                'mobile'                    => $request->mobile,
                'status'                    => 'Pending',
                'applied_date'              => date("Y-m-d"),
                'created_at'                => date("Y-m-d"),
            ]);

            $insertid = DB::getPdo()->lastInsertId();
            $aadhaarimg = "";

            if ($request->aadhaar_card != null) {
                $aadhaarimg = uniqid() . '.' . $request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'aadhaar_card' => $aadhaarimg,
            ]);
        } elseif ($serviceid == 84) {
            DB::table('smartcard')->insert([
                'user_id'                   => $user_id,
                'retailer_id'               => $retailer_id,
                'distributor_id'            => $distributor_id,
                'service_id'                => $request->serviceid,
                'amount'                    => $request->amount,
                'name'                      => $request->name,
                'mobile'                    => $request->mobile,
                'status'                    => 'Pending',
                'applied_date'              => date("Y-m-d"),
                'created_at'                => date("Y-m-d"),
            ]);

            $insertid = DB::getPdo()->lastInsertId();
            $smart_card = "";
            $smartcard_online = "";

            if ($request->smart_card != null) {
                $smart_card = uniqid() . '.' . $request->file('smart_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smart_card);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'smart_card' => $smart_card,
            ]);
            if ($request->smartcard_online != null) {
                $smartcard_online = uniqid() . '.' . $request->file('smartcard_online')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smartcard_online' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['smartcard_online']['tmp_name'], $filepath . $smartcard_online);
            }
            DB::table('smartcard')->where('id', $insertid)->update([
                'smartcard_online' => $smartcard_online,
            ]);
        }


        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));


        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }
    public function bondsubmit(Request $request)
    {

        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
        DB::table('bond')->insert([
            'user_id'                   => $user_id,
            'retailer_id'               => $retailer_id,
            'distributor_id'            => $distributor_id,
            'service_id'                => $request->serviceid,
            'dist_id'                   => $request->dist_id,
            'amount'                    => $request->amount,
            'sub_reg_office'            => $request->sub_reg_office,
            'aadhaar_no'                => $request->aadhaar_no,
            'document_number'           => $request->document_number,
            'year'                      => $request->year,
            'mobile'                    => $request->mobile,
            'revenue_village'           => $request->revenue_village,
            'status'                    => 'Pending',
            'applied_date'              => date("Y-m-d"),
            'created_at'                => date("Y-m-d"),
        ]);

        $insertid = DB::getPdo()->lastInsertId();


        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        $getpermission = DB::table('service_payment')->where('service_id', $serviceid)->first();
        $coordinator_permission = 0;
        $admin_payment = 0;
        if ($getpermission) {
            $coordinator_permission = $getpermission->coordinator_permission;
            $admin_payment = $getpermission->admin_amount;
        }
        if ($coordinator_permission == 1) {
            $getdata = DB::table('bond')->where('id', $insertid)->first();
            if ($getdata) {

                $service_id = $getdata->service_id;
                $rowid = $getdata->id;
                $name = $getdata->name;
                $aadhaar_no = $getdata->aadhaar_no;
                $dist_id = $getdata->dist_id;
                $taluk_id = $getdata->taluk_id;
                $sub_reg_office = $getdata->sub_reg_office;
                $document_number = $getdata->document_number;
                $year = $getdata->year;
                $mobile = $getdata->mobile;
                $revenue_village = $getdata->revenue_village;
                $status = $getdata->status;
                $url = url('/');
                $API_KEY = env('API_KEY', '');
                $RAMJIPAY_URL = env('RAMJIPAY_URL', '');
                $WEBSITE_INDEX = env('WEBSITE_INDEX', '');

                $ch = curl_init();
                $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&service_id=$service_id&rowid=$rowid&status=$status&name=$name&aadhaar_no=$aadhaar_no&dist_id=$dist_id&taluk_id=$taluk_id&sub_reg_office=$sub_reg_office&document_number=$document_number&year=$year&mobile=$mobile&revenue_village=$revenue_village";


                //dd($post_data);
                $url1 = $RAMJIPAY_URL . '/api/get_bond_api';
                //echo $url1;die;
                curl_setopt($ch, CURLOPT_URL, $url1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $server_output = curl_exec($ch);
                curl_close($ch);
                $resdata = json_decode($server_output, true);
                //dd($resdata);
                if ($resdata) {
                    $status = $resdata['message'];
                    if ($status == "Success") {
                        $date = date('Y-m-d');
                        $time = date('H:i:s');
                        $service_status = 'Out Payment';
                        $ad_info = 'Ramji Wallet Debit' . ' ' . $servicename;
                        $getrawallet = DB::table('users')->select('rawallet')->where('id', 1)->first();
                        $rawallet = 0;
                        if ($getrawallet) {
                            $balance1 = $getrawallet->rawallet;
                        }

                        $getrawallet1 = DB::table('users')->select('rawallet')->where('id', 2)->first();
                        $rawallet1 = 0;
                        if ($getrawallet1) {
                            $balance2 = $getrawallet1->rawallet;
                        }
                        $newbalance2 = $balance1 + $admin_payment;
                        $newbalance3 = $balance2 - $admin_payment;
                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet + $admin_payment where id = 1";
                        DB::update(DB::raw($sql));
                        $service_status = 'IN Payment';
                        $ad_info = 'Ramji Wallet Credit' . ' ' . $servicename;
                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet - $admin_payment where id = 2";
                        DB::update(DB::raw($sql));
                    }
                }
            }
        }
        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }

    public function submitvoterid(Request $request)
    {

        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
        $within_assembly = $request->within_assembly;

        if ($serviceid == 120) {
            if ($within_assembly == 1) {
                DB::table('voterid')->insert([
                    'user_id'                     => $user_id,
                    'retailer_id'                 => $retailer_id,
                    'distributor_id'              => $distributor_id,
                    'service_id'                  => $request->serviceid,
                    'amount'                      => $request->amount,
                    'epic_no'                     => $request->epic_no,
                    'aadhaar_no'                     => $request->aadhaar_no,
                    'mobile'                     => $request->mobile,
                    'dist_id'                     => $request->dist_id,
                    'taluk_id'                    => $request->taluk_id,
                    'pin_code'                    => $request->pin_code,
                    'within_assembly'             => $request->within_assembly,
                    'street_name'                 => $request->street_name,
                    'post_office'                 => $request->post_office,
                    'apartment_no'                => $request->apartment_no,
                    'taluqa_mandal'               => $request->taluqa_mandal,
                    'town_village'                => $request->town_village,
                    'street_name_tamil'                 => $request->street_name_tamil,
                    'post_office_tamil'                 => $request->post_office_tamil,
                    'taluqa_mandal_tamil'               => $request->taluqa_mandal_tamil,
                    'town_village_tamil'                => $request->town_village_tamil,
                    'status'                      => 'Pending',
                    'applied_date'                => date("Y-m-d"),
                    'created_at'                  => date("Y-m-d"),
                ]);
            } else {
                DB::table('voterid')->insert([
                    'user_id'                     => $user_id,
                    'retailer_id'                 => $retailer_id,
                    'distributor_id'              => $distributor_id,
                    'service_id'                  => $request->serviceid,
                    'amount'                      => $request->amount,
                    'epic_no'                     => $request->epic_no1,
                    'aadhaar_no'                     => $request->aadhaar_no1,
                    'mobile'                     => $request->mobile1,
                    'dist_id'                     => $request->dist_id1,
                    'taluk_id'                    => $request->taluk_id1,
                    'pin_code'                    => $request->pin_code1,
                    'within_assembly'             => $request->within_assembly,
                    'street_name'                 => $request->street_name1,
                    'post_office'                 => $request->post_office1,
                    'apartment_no'                => $request->apartment_no1,
                    'taluqa_mandal'               => $request->taluqa_mandal1,
                    'town_village'                => $request->town_village1,
                    'name_assembly_constituency'  => $request->name_assembly_constituency,
                    'street_name_tamil'                 => $request->street_name_tamil1,
                    'post_office_tamil'                 => $request->post_office_tamil1,
                    'taluqa_mandal_tamil'               => $request->taluqa_mandal_tamil1,
                    'town_village_tamil'                => $request->town_village_tamil1,
                    'status'                      => 'Pending',
                    'applied_date'                => date("Y-m-d"),
                    'created_at'                  => date("Y-m-d"),
                ]);
            }
        } else {
            DB::table('voterid')->insert([
                'user_id'                     => $user_id,
                'retailer_id'                 => $retailer_id,
                'distributor_id'              => $distributor_id,
                'service_id'                  => $request->serviceid,
                'amount'                      => $request->amount,
                'name'                        => $request->name,
                'mobile'                      => $request->mobile,
                'epic_no'                     => $request->epic_no,
                'relationship'                => $request->relationship,
                'dist_id'                     => $request->dist_id,
                'taluk_id'                    => $request->taluk_id,
                'panchayath_id'               => $request->panchayath_id,
                'constituent_assembly'        => $request->constituent_assembly,
                'name_in_tamil'               => $request->name_in_tamil,
                'name_in_english'             => $request->name_in_english,
                'door_no'                     => $request->door_no,
                'postal_area_tamil'           => $request->postal_area_tamil,
                'postal_area_english'         => $request->postal_area_english,
                'street_name_tamil'           => $request->street_name_tamil,
                'street_name_english'         => $request->street_name_english,
                'voterid_no'                  => $request->voterid_no,
                'pin_code'                    => $request->pin_code,
                'select_relationship'         => $request->select_relationship,
                'father_name_tamil'                 => $request->father_name_tamil,
                'father_name_english'                 => $request->father_name_english,
                'husband_name_tamil'                => $request->husband_name_tamil,
                'husband_name_english'                => $request->husband_name_english,
                'within_assembly'             => $request->within_assembly,
                'street_name'                 => $request->street_name,
                'post_office'                 => $request->post_office,
                'apartment_no'                => $request->apartment_no,
                'taluqa_mandal'               => $request->taluqa_mandal,
                'town_village'                => $request->town_village,
                'name_assembly_constituency'  => $request->name_assembly_constituency,
                'disability'                  => $request->disability,
                'locomotive_percentage'       => $request->locomotive_percentage,
                'visual_percentage'           => $request->visual_percentage,
                'dumb_percentage'             => $request->dumb_percentage,
                'other_percentage'             => $request->dumb_percentage,
                'description'                 => $request->description,
                'correction'                  => is_array($request->correction)
                    ? implode(',', $request->correction)
                    : $request->correction,
                'gender'                      => $request->gender,
                'dob'                         => $request->dob,
                'relation'                    => $request->relation,
                'name_tamil'                    => $request->name_tamil,
                'name_english'                    => $request->name_english,
                'name_family_member'                    => $request->name_family_member,
                'aadhaar_no'                    => $request->aadhaar_no,
                'street_name_tamil'                 => $request->street_name_tamil,
                'post_office_tamil'                 => $request->post_office_tamil,
                'taluqa_mandal_tamil'               => $request->taluqa_mandal_tamil,
                'town_village_tamil'                => $request->town_village_tamil,
                'status'                      => 'Pending',
                'applied_date'                => date("Y-m-d"),
                'created_at'                  => date("Y-m-d"),
            ]);
        }

        $insertid = DB::getPdo()->lastInsertId();
        $aadhaarimg = "";
        $photo = "";
        $voter_id = "";
        $locomotive_certificate = "";
        $visual_certificate = "";
        $dumb_certificate = "";
        $other_certificate = "";
        $age_proof = "";
        $document = "";

        if ($within_assembly == 1) {
            if ($request->aadhaar_card != null) {
                $aadhaarimg = uniqid() . '.' . $request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);
            }
        } else {
            if ($request->aadhaar_card1 != null) {
                $aadhaarimg = uniqid() . '.' . $request->file('aadhaar_card1')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card1']['tmp_name'], $filepath . $aadhaarimg);
            }
        }
        DB::table('voterid')->where('id', $insertid)->update([
            'aadhaar_card' => $aadhaarimg,
        ]);

        if ($request->photo != null) {
            $photo = uniqid() . '.' . $request->file('photo')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);
        }
        DB::table('voterid')->where('id', $insertid)->update([
            'photo' => $photo,
        ]);
        if ($request->voter_id != null) {
            $voter_id = uniqid() . '.' . $request->file('voter_id')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'voter_id' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['voter_id']['tmp_name'], $filepath . $voter_id);
        }
        DB::table('voterid')->where('id', $insertid)->update([
            'voter_id' => $voter_id,
        ]);
        if ($request->locomotive_certificate != null) {
            $locomotive_certificate = uniqid() . '.' . $request->file('locomotive_certificate')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'locomotive_certificate' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['locomotive_certificate']['tmp_name'], $filepath . $locomotive_certificate);
        }
        DB::table('voterid')->where('id', $insertid)->update([
            'locomotive_certificate' => $locomotive_certificate,
        ]);
        if ($request->visual_certificate != null) {
            $visual_certificate = uniqid() . '.' . $request->file('visual_certificate')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'visual_certificate' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['visual_certificate']['tmp_name'], $filepath . $visual_certificate);
        }
        DB::table('voterid')->where('id', $insertid)->update([
            'visual_certificate' => $visual_certificate,
        ]);
        if ($request->dumb_certificate != null) {
            $dumb_certificate = uniqid() . '.' . $request->file('dumb_certificate')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'dumb_certificate' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['dumb_certificate']['tmp_name'], $filepath . $dumb_certificate);
        }
        DB::table('voterid')->where('id', $insertid)->update([
            'dumb_certificate' => $dumb_certificate,
        ]);
        if ($request->other_certificate != null) {
            $other_certificate = uniqid() . '.' . $request->file('other_certificate')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'other_certificate' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['other_certificate']['tmp_name'], $filepath . $other_certificate);
        }
        DB::table('voterid')->where('id', $insertid)->update([
            'other_certificate' => $other_certificate,
        ]);
        if ($request->age_proof != null) {
            $age_proof = uniqid() . '.' . $request->file('age_proof')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'age_proof' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['age_proof']['tmp_name'], $filepath . $age_proof);
        }
        DB::table('voterid')->where('id', $insertid)->update([
            'age_proof' => $age_proof,
        ]);
        if ($request->document != null) {
            $document = uniqid() . '.' . $request->file('document')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'document' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['document']['tmp_name'], $filepath . $document);
        }
        DB::table('voterid')->where('id', $insertid)->update([
            'document' => $document,
        ]);

        if ($request->has('voterid_correction')) {
            foreach ($request->voterid_correction as $key => $voterid_correction) {
                $new_data = $request->new_data[$key];
                $correction_documents = $request->correction_documents[$key];

                $sql = "insert into voterid_details (service_id,new_data,correction_documents,voterid_correction) values ($insertid,'$new_data','$correction_documents','$voterid_correction')";
                DB::insert($sql);
                $relation_id = DB::getPdo()->lastInsertId();
                if ($request->doc[$key] != null) {
                    $doc = uniqid() . '.' . $request->file('doc')[$key]->extension();
                    //dd($request->doc[$key]);
                    $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'doc' . DIRECTORY_SEPARATOR);
                    move_uploaded_file($_FILES['doc']['tmp_name'][$key], $filepath . $doc);
                    DB::table('voterid_details')->where('id', $relation_id)->update([
                        'doc'       => $doc,
                    ]);
                }
            }
        }


        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        // $getpermission = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
        // $coordinator_permission = 0;
        // $admin_payment = 0;
        // if($getpermission){
        //     $coordinator_permission = $getpermission->coordinator_permission;
        //     $admin_payment = $getpermission->admin_amount;
        // }
        // if($coordinator_permission == 1){
        //     $getdata = DB::table( 'voterid' )->where('id',$insertid)->first();
        //     if($getdata){
        //         $within_assembly = $getdata->within_assembly;

        //     if($within_assembly == 1){
        //         // within assembly ku files and post data
        //         $aadhaar_card = $getdata->aadhaar_card;
        //         $service_id = $getdata->service_id;
        //         $rowid = $getdata->id;
        //         $epic_no = $getdata->epic_no;
        //         $aadhaar_no = $getdata->aadhaar_no;
        //         $mobile  = $getdata->mobile;
        //         $dist_id = $getdata->dist_id;
        //         $taluk_id = $getdata->taluk_id;
        //         $pin_code = $getdata->pin_code;
        //         $within_assembly = $getdata->within_assembly;
        //         $street_name = $getdata->street_name;
        //         $post_office = $getdata->post_office;
        //         $apartment_no = $getdata->apartment_no;
        //         $taluqa_mandal = $getdata->taluqa_mandal;
        //         $town_village = $getdata->town_village;
        //         $street_name_tamil = $getdata->street_name_tamil;
        //         $post_office_tamil = $getdata->post_office_tamil;
        //         $taluqa_mandal_tamil = $getdata->taluqa_mandal_tamil;
        //         $town_village_tamil = $getdata->town_village_tamil;
        //     } else {
        //         // outside assembly ku files and post data
        //         $aadhaar_card = $getdata->aadhaar_card1;
        //         $epic_no = $request->epic_no1;
        //         $aadhaar_no = $request->aadhaar_no1;
        //         $mobile = $request->mobile1;
        //         $dist_id = $request->dist_id1;
        //         $taluk_id = $request->taluk_id1;
        //         $pin_code = $request->pin_code1;
        //         $within_assembly = $request->within_assembly;
        //         $street_name = $request->street_name1;
        //         $post_office = $request->post_office1;
        //         $apartment_no = $request->apartment_no1;
        //         $taluqa_mandal = $request->taluqa_mandal1;
        //         $town_village = $request->town_village1;
        //         $name_assembly_constituency = $request->name_assembly_constituency;
        //         $street_name_tamil = $request->street_name_tamil1;
        //         $post_office_tamil = $request->post_office_tamil1;
        //         $taluqa_mandal_tamil = $request->taluqa_mandal_tamil1;
        //         $town_village_tamil = $request->town_village_tamil1;
        //     }

        //      $aadhaar_card = $getdata->aadhaar_card;
        //      $photo = $getdata->photo;
        //      $locomotive_certificate = $getdata->locomotive_certificate;
        //      $visual_certificate = $getdata->visual_certificate;
        //      $dumb_certificate = $getdata->dumb_certificate;
        //      $other_certificate = $getdata->other_certificate;
        //      $age_proof = $getdata->age_proof;
        //      $document = $getdata->document;
        //      $service_id = $getdata->service_id;
        //      $rowid = $getdata->id;
        //      $dist_id = $getdata->dist_id;
        //      $taluk_id = $getdata->taluk_id;
        //      $panchayath_id = $getdata->panchayath_id;
        //      $aadhaar_no = $getdata->aadhaar_no;
        //      $mobile = $getdata->mobile;
        //      $epic_no = $getdata->epic_no;
        //      $relationship = $getdata->relationship;
        //      $constituent_assembly = $getdata->constituent_assembly;
        //      $pin_code = $getdata->pin_code;
        //      $street_name  = $getdata->street_name;
        //      $apartment_no  = $getdata->apartment_no;
        //      $post_office  = $getdata->post_office;
        //      $taluqa_mandal  = $getdata->taluqa_mandal;
        //      $town_village  = $getdata->town_village;
        //      $door_no                     = $getdata->door_no;
        //      $postal_area_tamil           = $getdata->postal_area_tamil;
        //      $postal_area_english         = $getdata->postal_area_english;
        //      $street_name_tamil           = $getdata->street_name_tamil;
        //      $street_name_english         = $getdata->street_name_english;
        //      $voterid_no                 = $getdata->voterid_no;
        //      $select_relationship         =$getdata->select_relationship;
        //      $father_name_tamil                 = $getdata->father_name_tamil;
        //      $father_name_english                 = $getdata->father_name_english;
        //      $husband_name_tamil               = $getdata->husband_name_tamil;
        //      $husband_name_english               = $getdata->husband_name_english;
        //      $within_assembly               = $getdata->within_assembly;
        //      $town_village                = $getdata->town_village;
        //      $name_assembly_constituency  = $getdata->name_assembly_constituency;
        //      $disability                  = $getdata->disabilit;
        //      $locomotive_percentage       = $getdata->locomotive_percentage;
        //      $visual_percentage           = $getdata->visual_percentage;
        //      $dumb_percentage             = $getdata->dumb_percentage;
        //      $other_percentage             = $getdata->dumb_percentage;
        //      $description                 = $getdata->description;
        //      $gender                      = $getdata->gender;
        //      $dob                         = $getdata->dob;
        //      $relation                    = $getdata->relation;
        //      $name_tamil                    = $getdata->name_tamil;
        //      $name_english                    = $getdata->name_english;
        //      $name_family_member                    = $getdata->name_family_member;
        //      $name_in_english                    = $getdata->name_in_english;
        //      $name_in_tamil                    = $getdata->name_in_tamil;
        //      $street_name_tamil                 = $getdata->street_name_tamil;
        //      $post_office_tamil                 = $getdata->post_office_tamil;
        //      $taluqa_mandal_tamil               = $getdata->taluqa_mandal_tamil;
        //      $town_village_tamil                = $getdata->town_village_tamil;

        //      $status = $getdata->status;
        //      $url = url('/');
        //      $aadhaar_url = $url.'/upload/services/aadhaar_card/'.$aadhaar_card;
        //      $photo_url = $url.'/upload/services/photo/'.$photo;
        //      $locomotive_certificate_url = $url.'/upload/services/locomotive_certificate/'.$locomotive_certificate;
        //      $visual_certificate_url = $url.'/upload/services/visual_certificate/'.$visual_certificate;
        //      $dumb_certificate_url = $url.'/upload/services/dumb_certificate/'.$dumb_certificate;
        //      $other_certificate_url = $url.'/upload/services/other_certificate/'.$other_certificate;
        //      $age_proof_url = $url.'/upload/services/age_proof/'.$age_proof;
        //      $document_url = $url.'/upload/services/document/'.$document;
        //      $API_KEY = env( 'API_KEY', '' );
        //      $RAMJIPAY_URL = env( 'RAMJIPAY_URL', '' );
        //      $WEBSITE_INDEX = env( 'WEBSITE_INDEX', '' );
        //      $ch = curl_init();

        //      if($serviceid == 113){
        //      $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&photo_file=$photo_url&aadhaar_file=$aadhaar_url&dist_id=$dist_id&taluk_id=$taluk_id&constituent_assembly=$constituent_assembly&name_in_english=$name_in_english&select_relationship=$select_relationship&service_id=$service_id&rowid=$rowid&status=$status&door_no=$door_no&street_name_english=$street_name_english&postal_area_english=$postal_area_english&voterid_no=$voterid_no&mobile=$mobile&name_in_tamil=$name_in_tamil
        //     father_name_tamil=$father_name_tamil&father_name_english=$father_name_english&husband_name_tamil=$husband_name_tamil&husband_name_english=$husband_name_english&pin_code=$pin_code&street_name_tamil=$street_name_tamil&postal_area_tamil=$postal_area_tamil&relationship=$relationship&name_family_member=$name_family_member&aadhaar_no=$aadhaar_no";
        //      }elseif($serviceid == 164){
        //      $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&old_food_license_file=$oldfoodlicense_url&photo_file=$photo_url&aadhaar_file=$aadhaar_url&epic_no=$epic_no&pan_card_file=$pancard_url&service_id=$service_id&rowid=$rowid&status=$status&shop_name=$shop_name&email_id=$email_id&mobile=$mobile";
        //      }elseif($serviceid == 182){
        //      $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&old_food_license_file=$oldfoodlicense_url&photo_file=$photo_url&aadhaar_file=$aadhaar_url&shop_photo_file=$shopphoto_url&pan_card_file=$pancard_url&service_id=$service_id&rowid=$rowid&status=$status&shop_name=$shop_name&email_id=$email_id&mobile=$mobile";

        // }

        //     // dd($post_data);
        //      $url1 = $RAMJIPAY_URL.'/api/get_voterid_api';
        //   //echo $url1;die;
        //      curl_setopt( $ch, CURLOPT_URL, $url1 );
        //      curl_setopt( $ch, CURLOPT_POST, 1 );
        //      curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_data );
        //      curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        //      $server_output = curl_exec( $ch );
        //      curl_close( $ch );
        //      $resdata = json_decode($server_output, true);
        //     //  dd($resdata);
        //      if($resdata){
        //         $status = $resdata['message'];
        //         if($status == "Success"){
        //          $date = date( 'Y-m-d' );
        //          $time = date( 'H:i:s' );
        //          $service_status = 'Out Payment';
        //          $ad_info = 'Ramji Wallet Debit'.' '.$servicename;
        //          $getrawallet = DB::table( 'users' )->select('rawallet')->where('id',1)->first();
        //          $rawallet = 0;
        //          if($getrawallet){
        //              $balance1 = $getrawallet->rawallet;
        //          }

        //          $getrawallet1 = DB::table( 'users' )->select('rawallet')->where('id',2)->first();
        //          $rawallet1 = 0;
        //          if($getrawallet1){
        //              $balance2 = $getrawallet1->rawallet;
        //          }
        //          $newbalance2 = $balance1 + $admin_payment;
        //          $newbalance3 = $balance2 - $admin_payment;
        //          $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
        //          DB::insert( DB::raw( $sql ) );
        //          $sql = "update users set rawallet = rawallet + $admin_payment where id = 1";
        //          DB::update( DB::raw( $sql ) );
        //          $service_status = 'IN Payment';
        //          $ad_info = 'Ramji Wallet Credit'.' '.$servicename;
        //          $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
        //          DB::insert( DB::raw( $sql ) );
        //          $sql = "update users set rawallet = rawallet - $admin_payment where id = 2";
        //           DB::update( DB::raw( $sql ) );
        //    }
        //  }

        // }
        // }

        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }
    public function submit_fssaiservice(Request $request)
    {

        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
        if ($serviceid == 122 || $serviceid == 123) {

            DB::table('fssai')->insert([
                'user_id'           => $user_id,
                'retailer_id'       => $retailer_id,
                'distributor_id'    => $distributor_id,
                'service_id'     => $request->serviceid,
                'amount'                => $request->amount,
                'shop_name'             => $request->shop_name,
                'mobile'                => $request->mobile,
                'mobile_no'             => $request->mobile_no,
                'email_id'              => $request->email_id,
                'documents'             => $request->documents,
                'food_service'          => $request->food_service,
                'dob'                   => $request->dob,
                'food_category'         => $request->food_category,
                'aadhaar_no'            => $request->aadhaar_no,
                'name_as_pan'           => $request->name_as_pan,
                'pan_no'                => $request->pan_no,
                'applicant_name'        => $request->applicant_name,
                'shop_address'          => $request->shop_address,
                'block_or_division'     => $request->block_or_division,
                'pin_code'              => $request->pin_code,
                'fssai_license'         => $request->fssai_license,
                'trade_retail'          => $request->trade_retail,
                'storage'               => $request->storage,
                'wholesaler'            => $request->wholesaler,
                'distributor'           => $request->distributor,
                'transportation'        => $request->transportation,
                'retailer'              => $request->retailer,
                'direct_seller'         => $request->direct_seller,
                'food_vending_agencies' => $request->food_vending_agencies,
                'importer'              => $request->importer,
                'trader_merchant'       => $request->trader_merchant,
                'petty_retailer'        => $request->petty_retailer,
                'central_govt_agencies' => $request->central_govt_agencies,
                'storage1'              => $request->storage1,
                'wholesaler1'           => $request->wholesaler1,
                'distributor1'          => $request->distributor1,
                'retailer1'             => $request->retailer1,
                'status'                => 'Pending',
                'applied_date'          => date("Y-m-d"),
                'created_at'            => date("Y-m-d"),
            ]);

            $insertid         = DB::getPdo()->lastInsertId();
            $aadhaarimg       = "";
            $photo            = "";
            $shop_photo       = "";
            $pan_card         = "";
            $old_food_license = "";
            $rental_agreement = "";
            $electricity_bill = "";
            $property_tax     = "";

            if ($request->rental_agreement != null) {
                $rental_agreement = uniqid() . '.' . $request->file('rental_agreement')->extension();
                $filepath         = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'rental_agreement' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['rental_agreement']['tmp_name'], $filepath . $rental_agreement);
            }
            DB::table('fssai')->where('id', $insertid)->update([
                'rental_agreement' => $rental_agreement,
            ]);

            if ($request->electricity_bill != null) {
                $electricity_bill = uniqid() . '.' . $request->file('electricity_bill')->extension();
                $filepath         = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'electricity_bill' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['electricity_bill']['tmp_name'], $filepath . $electricity_bill);
            }
            DB::table('fssai')->where('id', $insertid)->update([
                'electricity_bill' => $electricity_bill,
            ]);

            if ($request->property_tax != null) {
                $property_tax = uniqid() . '.' . $request->file('property_tax')->extension();
                $filepath     = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'property_tax' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['property_tax']['tmp_name'], $filepath . $property_tax);
            }
            DB::table('fssai')->where('id', $insertid)->update([
                'property_tax' => $property_tax,
            ]);

            if ($request->aadhaar_card != null) {
                $aadhaarimg = uniqid() . '.' . $request->file('aadhaar_card')->extension();
                $filepath   = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);
            }
            DB::table('fssai')->where('id', $insertid)->update([
                'aadhaar_card' => $aadhaarimg,
            ]);
            if ($request->photo != null) {
                $photo    = uniqid() . '.' . $request->file('photo')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);
            }
            DB::table('fssai')->where('id', $insertid)->update([
                'photo' => $photo,
            ]);
            if ($request->shop_photo != null) {
                $shop_photo = uniqid() . '.' . $request->file('shop_photo')->extension();
                $filepath   = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'shop_photo' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['shop_photo']['tmp_name'], $filepath . $shop_photo);
            }
            DB::table('fssai')->where('id', $insertid)->update([
                'shop_photo' => $shop_photo,
            ]);
            if ($request->pan_card != null) {
                $pan_card = uniqid() . '.' . $request->file('pan_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'pan_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['pan_card']['tmp_name'], $filepath . $pan_card);
            }
            DB::table('fssai')->where('id', $insertid)->update([
                'pan_card' => $pan_card,
            ]);
            if ($request->old_food_license != null) {
                $old_food_license = uniqid() . '.' . $request->file('old_food_license')->extension();
                $filepath         = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'old_food_license' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['old_food_license']['tmp_name'], $filepath . $old_food_license);
            }
            DB::table('fssai')->where('id', $insertid)->update([
                'old_food_license' => $old_food_license,
            ]);
        }


        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        $getpermission = DB::table('service_payment')->where('service_id', $serviceid)->first();
        $coordinator_permission = 0;
        $admin_payment = 0;
        if ($getpermission) {
            $coordinator_permission = $getpermission->coordinator_permission;
            $admin_payment = $getpermission->admin_amount;
        }
        if ($coordinator_permission == 1) {
            $getdata = DB::table('fssai')->where('id', $insertid)->first();
            if ($getdata) {
                $aadhaar_card = $getdata->aadhaar_card;
                $photo = $getdata->photo;
                $shop_photo = $getdata->shop_photo;
                $pan_card = $getdata->pan_card;
                $rental_agreement = $getdata->rental_agreement;
                $electricity_bill = $getdata->electricity_bill;
                $property_tax = $getdata->property_tax;
                $old_food_license = $getdata->old_food_license;
                $service_id = $getdata->service_id;
                $rowid = $getdata->id;
                $food_service = $getdata->food_service;
                $shop_name = $getdata->shop_name;
                $shop_address = $getdata->shop_address;
                $email_id = $getdata->email_id;
                $mobile = $getdata->mobile;
                $documents = $getdata->documents;
                $mobile_no = $getdata->mobile_no;
                $pan_no = $getdata->pan_no;
                $name_as_pan = $getdata->name_as_pan;
                $aadhaar_no = $getdata->aadhaar_no;
                $food_category = $getdata->food_category;
                $block_or_division = $getdata->block_or_division;
                $pin_code = $getdata->pin_code;
                $fssai_license = $getdata->fssai_license;
                $trade_retail = $getdata->trade_retail;
                $storage = $getdata->storage;
                $wholesaler = $getdata->wholesaler;
                $distributor = $getdata->distributor;
                $transportation = $getdata->transportation;
                $retailer = $getdata->retailer;
                $direct_seller = $getdata->direct_seller;
                $food_vending_agencies = $getdata->food_vending_agencies;
                $importer = $getdata->importer;
                $trader_merchant = $getdata->trader_merchant;
                $petty_retailer = $getdata->petty_retailer;
                $central_govt_agencies = $getdata->central_govt_agencies;
                $storage1 = $getdata->storage1;
                $wholesaler1 = $getdata->wholesaler1;
                $distributor1 = $getdata->distributor1;
                $retailer1 = $getdata->retailer1;
                $status = $getdata->status;
                $url = url('/');
                $aadhaar_url = $url . '/upload/services/aadhaar_card/' . $aadhaar_card;
                $photo_url = $url . '/upload/services/photo/' . $photo;
                $shopphoto_url = $url . '/upload/services/shop_photo/' . $shop_photo;
                $pancard_url = $url . '/upload/services/pan_card/' . $pan_card;
                $rentalagreement_url = $url . '/upload/services/rental_agreement/' . $rental_agreement;
                $electricitybill_url = $url . '/upload/services/electricity_bill/' . $electricity_bill;
                $propertytax_url = $url . '/upload/services/property_tax/' . $property_tax;
                $oldfoodlicense_url = $url . '/upload/services/old_food_license/' . $old_food_license;
                $API_KEY = env('API_KEY', '');
                $RAMJIPAY_URL = env('RAMJIPAY_URL', '');
                $WEBSITE_INDEX = env('WEBSITE_INDEX', '');
                $ch = curl_init();

                if ($serviceid == 122) {
                    $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&photo_file=$photo_url&aadhaar_file=$aadhaar_url&shop_photo_file=$shopphoto_url&pan_card_file=$pancard_url&rental_agreement_file=$rentalagreement_url&electricity_bill_file=$electricitybill_url&property_tax_file=$propertytax_url&service_id=$service_id&rowid=$rowid&status=$status&food_service=$food_service&shop_name=$shop_name&email_id=$email_id&mobile=$mobile&documents=$documents&mobile_no=$mobile_no&shop_address=$shop_address&storage=$storage&transportation=$transportation&aadhaar_no=$aadhaar_no&food_category=$food_category&block_or_division=$block_or_division&pin_code=$pin_code&wholesaler=$wholesaler&fssai_license=$fssai_license&trade_retail=$trade_retail&distributor=$distributor&retailer=$retailer&direct_seller=$direct_seller&food_vending_agencies=$food_vending_agencies&importer=$importer&trader_merchant=$trader_merchant&petty_retailer=$petty_retailer&central_govt_agencies=$central_govt_agencies&storage1=$storage1&wholesaler1=$wholesaler1&distributor1=$distributor1&retailer1=$retailer1";
                } elseif ($serviceid == 123) {
                    $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&old_food_license_file=$oldfoodlicense_url&photo_file=$photo_url&aadhaar_file=$aadhaar_url&shop_photo_file=$shopphoto_url&pan_card_file=$pancard_url&service_id=$service_id&rowid=$rowid&status=$status&shop_name=$shop_name&email_id=$email_id&mobile_no=$mobile_no&mobile=$mobile";
                }

                $url1 = $RAMJIPAY_URL . '/api/get_fssai_api';
                //echo $url1;die;
                //   dd($post_data);
                curl_setopt($ch, CURLOPT_URL, $url1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $server_output = curl_exec($ch);
                curl_close($ch);
                $resdata = json_decode($server_output, true);
                //  dd($resdata);
                if ($resdata) {
                    $status = $resdata['message'];
                    if ($status == "Success") {
                        $date = date('Y-m-d');
                        $time = date('H:i:s');
                        $service_status = 'Out Payment';
                        $ad_info = 'Ramji Wallet Debit' . ' ' . $servicename;
                        $getrawallet = DB::table('users')->select('rawallet')->where('id', 1)->first();
                        $rawallet = 0;
                        if ($getrawallet) {
                            $balance1 = $getrawallet->rawallet;
                        }

                        $getrawallet1 = DB::table('users')->select('rawallet')->where('id', 2)->first();
                        $rawallet1 = 0;
                        if ($getrawallet1) {
                            $balance2 = $getrawallet1->rawallet;
                        }
                        $newbalance2 = $balance1 + $admin_payment;
                        $newbalance3 = $balance2 - $admin_payment;
                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet + $admin_payment where id = 1";
                        DB::update(DB::raw($sql));
                        $service_status = 'IN Payment';
                        $ad_info = 'Ramji Wallet Credit' . ' ' . $servicename;
                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet - $admin_payment where id = 2";
                        DB::update(DB::raw($sql));
                    }
                }
            }
        }
        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }
    public function submitapply_covid(Request $request)
    {

        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
        DB::table('covid')->insert([
            'user_id'      => $user_id,
            'retailer_id'  => $retailer_id,
            'distributor_id'  => $distributor_id,
            'service_id'   => $request->serviceid,
            'amount'       => $request->amount,
            'name'         => $request->name,
            'mobile'       => $request->mobile,
            'gender'       => $request->gender,
            'dob'          => $request->dob,
            'aadhaar_no'   => $request->aadhaar_no,
            'passport_no'  => $request->passport_no,
            'status'       => 'Pending',
            'applied_date' => date("Y-m-d"),
            'created_at'   => date("Y-m-d"),
        ]);




        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }
    public function submitapply_nalavariyam(Request $request)
    {

        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
        DB::table('nalavariyam')->insert([
            'user_id'         => $user_id,
            'retailer_id'     => $retailer_id,
            'distributor_id'  => $distributor_id,
            'service_id'      => $request->serviceid,
            'amount'          => $request->amount,
            'register_no'     => $request->register_no,
            'mobile'          => $request->mobile,
            'aadhaar_no'      => $request->aadhaar_no,
            'dob'             => $request->dob,
            'status'          => 'Pending',
            'applied_date'    => date("Y-m-d"),
            'created_at'      => date("Y-m-d"),
        ]);
        $insertid = DB::getPdo()->lastInsertId();
        $photo = "";
        $signature = "";
        if ($request->photo != null) {
            $photo = uniqid() . '.' . $request->file('photo')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);
        }
        DB::table('nalavariyam')->where('id', $insertid)->update([
            'photo' => $photo,
        ]);
        if ($request->signature != null) {
            $signature = uniqid() . '.' . $request->file('signature')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'signature' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['signature']['tmp_name'], $filepath . $signature);
        }
        DB::table('nalavariyam')->where('id', $insertid)->update([
            'signature' => $signature,
        ]);


        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }
    public function submitapply_driving_license(Request $request)
    {

        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
        if ($serviceid == 150 || $serviceid == 148) {

            DB::table('license')->insert([
                'user_id'         => $user_id,
                'retailer_id'     => $retailer_id,
                'distributor_id'  => $distributor_id,
                'service_id'      => $request->serviceid,
                'amount'          => $request->amount,
                'id_proof'          => $request->id_proof,
                'rc_number'       => $request->rc_number,
                'driving_license_no' => $request->driving_license_no,
                'dob'             => $request->dob,
                'status'          => 'Pending',
                'applied_date'    => date("Y-m-d"),
                'created_at'      => date("Y-m-d"),
            ]);
            $insertid = DB::getPdo()->lastInsertId();
            $aadhaar_card = "";
            $driving_license = "";
            if ($request->aadhaar_card != null) {
                $aadhaar_card = uniqid() . '.' . $request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
            }
            DB::table('license')->where('id', $insertid)->update([
                'aadhaar_card' => $aadhaar_card,
            ]);
            if ($request->driving_license != null) {
                $driving_license = uniqid() . '.' . $request->file('driving_license')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'driving_license' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['driving_license']['tmp_name'], $filepath . $driving_license);
            }
            DB::table('license')->where('id', $insertid)->update([
                'driving_license' => $driving_license,
            ]);
        }

        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }
    // public function submitapply_pancard(Request $request){

    //     $user_id = 0;
    //     $retailer_id = 0;
    //     $distributor_id = 0;
    //     if(Auth::user()->user_type_id == 3){
    //         $user_id = $request ->user_id;
    //         $distributor_id = Auth::user()->id;
    //     }elseif(Auth::user()->user_type_id == 4){
    //         $user_id = $request ->user_id;
    //         $retailer_id = Auth::user()->id;
    //     } elseif(Auth::user()->user_type_id == 5){
    //         $user_id = Auth::user()->id;
    //     }

    //     $serviceid = $request ->serviceid;
    //     $status = "";
    //     if($serviceid == 69){
    //         $mobile = $request->mobile;
    //         $mode = $request->mode;
    //         $orderid = rand(000000,999999);
    //         $panurl =  "https://connect.inspay.in/v4/nsdl/new_pan?username=IP7598984380&token=836a596851ed939b19a4b71157c47e1d&number=$mobile&mode=$mode&orderid=$orderid";
    //         $crl = curl_init();
    //         curl_setopt( $crl, CURLOPT_URL, $panurl );
    //         curl_setopt( $crl, CURLOPT_FRESH_CONNECT, true );
    //         curl_setopt( $crl, CURLOPT_RETURNTRANSFER, true );
    //         $result = curl_exec($crl);
    //         $result = json_decode($result);
    //         //echo "<pre>"; print_r($result);echo "</pre>";die;
    //         $status = $result->status;
    //         $url = "";
    //         $message = "";
    //         if($status == "Success"){
    //             $url = $result->url;
    //             $orderid = $result->orderid;
    //             $message = $result->message;
    //         }else{
    //             $orderid = $result->orderid;
    //             $message = $result->message;
    //         }
    //         curl_close($crl);
    //     }else if($serviceid == 70){
    //         $mobile = $request->mobile;
    //         $mode = $request->mode;
    //         $orderid = rand(000000,999999);
    //         $panurl =  "https://connect.inspay.in/v4/nsdl/correction?username=IP7598984380&token=836a596851ed939b19a4b71157c47e1d&number=$mobile&mode=$mode&orderid=$orderid";
    //         $crl = curl_init();
    //         curl_setopt( $crl, CURLOPT_URL, $panurl );
    //         curl_setopt( $crl, CURLOPT_FRESH_CONNECT, true );
    //         curl_setopt( $crl, CURLOPT_RETURNTRANSFER, true );
    //         $result = curl_exec($crl);
    //         $result = json_decode($result);
    //         //echo "<pre>"; print_r($result);echo "</pre>";die;
    //         $status = $result->status;
    //         $url = "";
    //         $message = "";
    //         if($status == "Success"){
    //             $url = $result->url;
    //             $orderid = $result->orderid;
    //             $message = $result->message;
    //         }else{
    //             $orderid = $result->orderid;
    //             $message = $result->message;
    //         }
    //         curl_close($crl);

    //     }
    //     //dd($result);

    //     if($serviceid == 69 || $serviceid == 70){
    //         DB::table( 'pancard' )->insert( [

    //            'user_id'      => $user_id,
    //            'retailer_id'  => $retailer_id,
    //            'distributor_id'=> $distributor_id,
    //            'service_id'   => $request ->serviceid,
    //            'amount'       => $request->amount,
    //            'name'         => $request->name,
    //            'last_name'    => $request->last_name,
    //            'email'        => $request->email,
    //            'title'        => $request->title,
    //            'mode'         => $request->mode,
    //            'gender'       => $request->gender,
    //            'aadhaar_no'   => $request->aadhaar_no,
    //            'mobile'       => $request->mobile,
    //            'status'       => 'Pending',
    //            'applied_date' => date("Y-m-d"),
    //            'created_at'   => date("Y-m-d"),
    //        ] );

    //         $insertid = DB::getPdo()->lastInsertId();
    //         $pan_card = "";
    //         $photo = "";
    //         $aadhaar_card = "";
    //         $signature = "";

    //         DB::table('pancard')->where('id', $insertid)->update([
    //             'api_url' => $url,
    //             'api_status' => $status,
    //             'api_txid' => $orderid,
    //         ]);

    //     }

    //     if($status == "Success"){
    //         
    //         if(Auth::user()->user_type_id == 3){
    //             $user_id = $distributor_id;
    //         }elseif(Auth::user()->user_type_id == 4){
    //             $user_id = $retailer_id;
    //         }elseif(Auth::user()->user_type_id == 5){
    //             $user_id = $user_id;
    //         }
    //         $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
    //         $servicename = "";
    //         if($getservicename){
    //             $servicename = $getservicename->service_name;
    //         }
    //             $date = date( 'Y-m-d' );
    //             $time = date( 'H:i:s' );
    //             $service_status = 'Out Payment';
    //             $ad_info = 'Service Payment'. ' '. $servicename;
    //             $getwallet = DB::table( 'users' )->select('wallet')->where('id',2)->first();
    //         $balance = 0;
    //         if($getwallet){
    //             $balance = $getwallet->wallet;
    //         }
    //         $newbalance = $balance + $servicepayment;
    //         $newbalance1 = Auth::user()->wallet - $servicepayment;

    //         $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
    //         DB::insert( DB::raw( $sql ) );
    //         $sql = "update users set wallet = wallet + $servicepayment where id = 2";
    //         DB::update( DB::raw( $sql ) );
    //         $service_status = 'IN Payment';
    //         $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
    //         DB::insert( DB::raw( $sql ) );
    //         $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
    //         DB::update( DB::raw( $sql ) );


    //         $ramjidebit_amount = $request->ramjidebit_amount;
    //         $service_status = 'Out Payment';
    //         $ad_info = 'Ramji Wallet Debit(PanCard)';
    //         $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('2','2','1','$ramjidebit_amount','$ad_info', '$service_status','$time','$date','2')";
    //         DB::insert( DB::raw( $sql ) );
    //         $sql = "update users set rawallet = rawallet + $ramjidebit_amount where id = 1";
    //         DB::update( DB::raw( $sql ) );
    //         $service_status = 'IN Payment';
    //         $ad_info = 'Ramji Wallet Credit(PanCard)';
    //         $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('2','1','2','$ramjidebit_amount','$ad_info', '$service_status','$time','$date','2')";
    //         DB::insert( DB::raw( $sql ) );
    //         $sql = "update users set rawallet = rawallet - $ramjidebit_amount where id = 2";
    //         DB::update( DB::raw( $sql ) );
    //     }

    //     if($serviceid == 71){
    //         $aadhaar_no = $request->aadhaar_no;
    //         $orderid = rand(000000,999999);
    //         $panurl =  "https://goodapi.in/serviceApi/V1/panFind?apiKey=3e2a83212d3e5e4755390b84612f110d45d393c8c75946786de9ea4f283dcaa9&order_id=$orderid&uidNumber=$aadhaar_no";
    //         $crl = curl_init();
    //         curl_setopt( $crl, CURLOPT_URL, $panurl );
    //         curl_setopt( $crl, CURLOPT_FRESH_CONNECT, true );
    //         curl_setopt( $crl, CURLOPT_RETURNTRANSFER, true );
    //         $result = curl_exec($crl);
    //         $result = json_decode($result,true);
    //         $statuscode = $result['StatusCode'];
    //         $pan_no = "";
    //         $name = "";
    //         $dob = "";
    //         $message = "";
    //         if($statuscode == "100"){
    //             $pan_no = $result['pan_no'];
    //             $name = $result['name'];
    //             $dob = $result['dob'];

    //             DB::table( 'pancard' )->insert( [

    //                'user_id'      => $user_id,
    //                'retailer_id'  => $retailer_id,
    //                'distributor_id'=> $distributor_id,
    //                'service_id'   => $request->serviceid,
    //                'amount'       => $request->amount,
    //                'name'         => $name,
    //                'aadhaar_no'   => $request->aadhaar_no,
    //                'pan_no'       => $pan_no,
    //                'dob'          => $dob,
    //                'status'       => 'Approved',
    //                'applied_date' => date("Y-m-d"),
    //                'created_at'   => date("Y-m-d"),
    //                'completed_date'   => date("Y-m-d"),
    //            ] );

    //             $insertid = DB::getPdo()->lastInsertId();

    //             
    //             if(Auth::user()->user_type_id == 3){
    //                 $user_id = $distributor_id;
    //             }elseif(Auth::user()->user_type_id == 4){
    //                 $user_id = $retailer_id;
    //             }elseif(Auth::user()->user_type_id == 5){
    //                 $user_id = $user_id;
    //             }
    //             $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
    //             $servicename = "";
    //             if($getservicename){
    //                 $servicename = $getservicename->service_name;
    //             }
    //                 $date = date( 'Y-m-d' );
    //                 $time = date( 'H:i:s' );
    //                 $service_status = 'Out Payment';
    //                 $ad_info = 'Service Payment'. ' '. $servicename;
    //                 $getwallet = DB::table( 'users' )->select('wallet')->where('id',2)->first();
    //             $balance = 0;
    //             if($getwallet){
    //                 $balance = $getwallet->wallet;
    //             }
    //             $newbalance = $balance + $servicepayment;
    //             $newbalance1 = Auth::user()->wallet - $servicepayment;

    //             $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
    //             DB::insert( DB::raw( $sql ) );
    //             $sql = "update users set wallet = wallet + $servicepayment where id = 2";
    //             DB::update( DB::raw( $sql ) );
    //             $service_status = 'IN Payment';
    //             $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
    //             DB::insert( DB::raw( $sql ) );
    //             $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
    //             DB::update( DB::raw( $sql ) );

    //              $ramjidebit_amount = $request->ramjidebit_amount;
    //         $service_status = 'Out Payment';
    //         $ad_info = 'Ramji Wallet Debit(PanCard)';
    //         $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('2','2','1','$ramjidebit_amount','$ad_info', '$service_status','$time','$date','2')";
    //         DB::insert( DB::raw( $sql ) );
    //         $sql = "update users set rawallet = rawallet + $ramjidebit_amount where id = 1";
    //         DB::update( DB::raw( $sql ) );
    //         $service_status = 'IN Payment';
    //         $ad_info = 'Ramji Wallet Credit(PanCard)';
    //         $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id) values ('2','1','2','$ramjidebit_amount','$ad_info', '$service_status','$time','$date','2')";
    //         DB::insert( DB::raw( $sql ) );
    //         $sql = "update users set rawallet = rawallet - $ramjidebit_amount where id = 2";
    //         DB::update( DB::raw( $sql ) );


    //             return redirect('servicestatus/Approved/'.$insertid.'/'.$serviceid)->With("success","Pan Number Find Successful...");
    //         }else{
    //             $message = $result['message'];
    //             return redirect('applyservices/'.$serviceid)->With("error",$message);
    //         }

    //     }
    //     if($status == "Success"){
    //         return redirect($url);
    //     }else{
    //      return redirect('applyservices/'.$serviceid)->With("error",$message);
    //  }

    // }

    public function pancard_reapply($txid)
    {

        $panurl =  "https://connect.inspay.in/v4/nsdl/incomplete?username=IP7598984380&token=836a596851ed939b19a4b71157c47e1d&orderid=$txid";
        $crl = curl_init();
        curl_setopt($crl, CURLOPT_URL, $panurl);
        curl_setopt($crl, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($crl);
        $result = json_decode($result);
        //echo "<pre>"; print_r($result);echo "</pre>";die;
        $status = $result->status;
        $url = "";
        $message = "";
        if ($status == "Success") {
            $url = $result->url;
            $orderid = $result->txid;
            $message = $result->message;
        } else {
            $orderid = $result->orderid;
            $message = $result->message;
        }
        curl_close($crl);
        if ($status == "Success") {
            return redirect($url);
        } else {
            return redirect('appliedservice/Pending')->With("error", $message);
        }
    }

    public function submitapply_tailorshop(Request $request)
    {

        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
        if ($serviceid == 152 || $serviceid == 153 || $serviceid == 154) {
            DB::table('tailor')->insert([
                'user_id'             => $user_id,
                'retailer_id'         => $retailer_id,
                'distributor_id'      => $distributor_id,
                'service_id'          => $request->serviceid,
                'amount'              => $request->amount,
                'dist_id'             => $request->dist_id,
                'taluk_id'            => $request->taluk_id,
                'panchayath_id'       => $request->panchayath_id,
                'name'                => $request->name,
                'aadhaar_no'          => $request->aadhaar_no,
                'door_no'             => $request->door_no,
                'significant'         => $request->significant,
                'street_name'         => $request->street_name,
                'course_name'         => $request->course_name,
                'father_or_hus_name'  => $request->father_or_hus_name,
                'pincode'             => $request->pincode,
                'postal_area'         => $request->postal_area,
                'status'              => 'Pending',
                'applied_date'        => date("Y-m-d"),
                'created_at'          => date("Y-m-d"),
            ]);

            $insertid = DB::getPdo()->lastInsertId();
            $pan_card = "";
            $photo = "";
            $aadhaar_card = "";
            $signature = "";


            if ($request->photo != null) {
                $photo = uniqid() . '.' . $request->file('photo')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);


                DB::table('tailor')->where('id', $insertid)->update([
                    'photo' => $photo,
                ]);
            }
        }

        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        $getpermission = DB::table('service_payment')->where('service_id', $serviceid)->first();
        $coordinator_permission = 0;
        $admin_payment = 0;
        if ($getpermission) {
            $coordinator_permission = $getpermission->coordinator_permission;
            $admin_payment = $getpermission->admin_amount;
        }
        if ($coordinator_permission == 1) {
            $getdata = DB::table('tailor')->where('id', $insertid)->first();
            if ($getdata) {

                $service_id = $getdata->service_id;
                $rowid = $getdata->id;
                $status = $getdata->status;
                $name = $getdata->name;
                $dist_id = $getdata->dist_id;
                $taluk_id = $getdata->taluk_id;
                $panchayath_id = $getdata->panchayath_id;
                $aadhaar_no = $getdata->aadhaar_no;
                $door_no = $getdata->door_no;
                $significant = $getdata->significant;
                $street_name = $getdata->street_name;
                $postal_area = $getdata->postal_area;
                $course_name = $getdata->course_name;
                $course_name = str_replace('&', "-", $course_name);
                //echo $course_name;die;
                $father_or_hus_name = $getdata->father_or_hus_name;
                $pincode = $getdata->pincode;
                $url = url('/');
                $photo_url = $url . '/upload/services/photo/' . $photo;
                $API_KEY = env('API_KEY', '');
                $RAMJIPAY_URL = env('RAMJIPAY_URL', '');
                $WEBSITE_INDEX = env('WEBSITE_INDEX', '');
                $ch = curl_init();
                if ($serviceid == 152) {
                    $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&photo_file=$photo_url&service_id=$service_id&rowid=$rowid&status=$status&name=$name&dist_id=$dist_id&taluk_id=$taluk_id&panchayath_id=$panchayath_id&aadhaar_no=$aadhaar_no&door_no=$door_no&significant=$significant&postal_area=$postal_area&street_name=$street_name&course_name=$course_name&father_or_hus_name=$father_or_hus_name&pincode=$pincode";
                } elseif ($serviceid == 153) {
                    $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&photo_file=$photo_url&service_id=$service_id&rowid=$rowid&status=$status&name=$name&dist_id=$dist_id&taluk_id=$taluk_id&panchayath_id=$panchayath_id&aadhaar_no=$aadhaar_no&door_no=$door_no&significant=$significant&street_name=$street_name&postal_area=$postal_area&course_name=$course_name&father_or_hus_name=$father_or_hus_name&pincode=$pincode";
                } elseif ($serviceid == 154) {
                    $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&photo_file=$photo_url&service_id=$service_id&rowid=$rowid&status=$status&name=$name&dist_id=$dist_id&taluk_id=$taluk_id&panchayath_id=$panchayath_id&aadhaar_no=$aadhaar_no&door_no=$door_no&significant=$significant&street_name=$street_name&postal_area=$postal_area&course_name=$course_name&father_or_hus_name=$father_or_hus_name&pincode=$pincode";
                }

                //dd($post_data);
                $url1 = $RAMJIPAY_URL . '/api/get_tailor_api';
                // echo $url1;die;
                curl_setopt($ch, CURLOPT_URL, $url1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $server_output = curl_exec($ch);
                curl_close($ch);
                $resdata = json_decode($server_output, true);
                // dd($resdata);
                if ($resdata) {
                    $status = $resdata['message'];
                    if ($status == "Success") {
                        $date = date('Y-m-d');
                        $time = date('H:i:s');
                        $service_status = 'Out Payment';
                        $ad_info = 'Ramji Wallet Debit' . ' ' . $servicename;
                        $getrawallet = DB::table('users')->select('nalavariyamwallet')->where('id', 1)->first();
                        $rawallet = 0;
                        if ($getrawallet) {
                            $balance1 = $getrawallet->nalavariyamwallet;
                        }

                        $getrawallet1 = DB::table('users')->select('nalavariyamwallet')->where('id', 2)->first();
                        $rawallet1 = 0;
                        if ($getrawallet1) {
                            $balance2 = $getrawallet1->nalavariyamwallet;
                        }
                        $newbalance2 = $balance1 + $admin_payment;
                        $newbalance3 = $balance2 - $admin_payment;
                        $sql = "insert into nalavariyampayment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set nalavariyamwallet = nalavariyamwallet + $admin_payment where id = 1";
                        DB::update(DB::raw($sql));
                        $service_status = 'IN Payment';
                        $ad_info = 'Ramji Wallet Credit' . ' ' . $servicename;

                        $sql = "insert into nalavariyampayment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set nalavariyamwallet = nalavariyamwallet - $admin_payment where id = 2";
                        DB::update(DB::raw($sql));
                    }
                }
            }
        }
        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }


    public function savepmkissan(Request $request)
    {

        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
        DB::table('pmkissan')->insert([
            'user_id'        =>   $user_id,
            'retailer_id'    =>   $retailer_id,
            'distributor_id' =>   $distributor_id,
            'service_id'     => $request->serviceid,
            'status'              => 'Pending',
            'applied_date'        => date("Y-m-d"),
            'created_at'          => date("Y-m-d"),
        ]);

        $insertid = DB::getPdo()->lastInsertId();

        $aadhaar_card = "";
        if ($request->aadhaar_card != null) {
            $aadhaar_card = uniqid() . '.' . $request->file('aadhaar_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
        }
        DB::table('pmkissan')->where('id', $insertid)->update([
            'aadhaar_card'         => $aadhaar_card,
        ]);
        $land_document = "";
        if ($request->land_document != null) {
            $land_document = uniqid() . '.' . $request->file('land_document')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'landdocument' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['land_document']['tmp_name'], $filepath . $land_document);
        }
        DB::table('pmkissan')->where('id', $insertid)->update([
            'land_document'         => $land_document,
        ]);


        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));


        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }
    public function submitapply_csc_tec(Request $request)
    {

        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
        DB::table('tec_exam')->insert([
            'user_id'             =>   $user_id,
            'retailer_id'         =>   $retailer_id,
            'distributor_id'      =>   $distributor_id,
            'service_id'          => $request->serviceid,
            'amount'              => $request->amount,
            'dist_id'             => $request->dist_id,
            'taluk_id'            => $request->taluk_id,
            'panchayath_id'       => $request->panchayath_id,
            'name'                => $request->name,
            'mobile'              => $request->mobile,
            'shop_name'           => $request->shop_name,
            'shop_address'        => $request->shop_address,
            'door_no'             => $request->door_no,
            'street_name'         => $request->street_name,
            'postal_name'         => $request->postal_name,
            'village_name'        => $request->village_name,
            'pincode'             => $request->pincode,
            'status'              => 'Pending',
            'applied_date'        => date("Y-m-d"),
            'created_at'          => date("Y-m-d"),
        ]);

        $insertid = DB::getPdo()->lastInsertId();

        $aadhaar_card = "";
        if ($request->aadhaar_card != null) {
            $aadhaar_card = uniqid() . '.' . $request->file('aadhaar_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
        }
        DB::table('tec_exam')->where('id', $insertid)->update([
            'aadhaar_card'         => $aadhaar_card,
        ]);
        $pan_card = "";
        if ($request->pan_card != null) {
            $pan_card = uniqid() . '.' . $request->file('pan_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'pan_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['pan_card']['tmp_name'], $filepath . $pan_card);
        }
        DB::table('tec_exam')->where('id', $insertid)->update([
            'pan_card'         => $pan_card,
        ]);
        $bc_agent_certificate = "";
        if ($request->bc_agent_certificate != null) {
            $bc_agent_certificate = uniqid() . '.' . $request->file('bc_agent_certificate')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'bc_agent_certificate' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['bc_agent_certificate']['tmp_name'], $filepath . $bc_agent_certificate);
        }
        DB::table('tec_exam')->where('id', $insertid)->update([
            'bc_agent_certificate'         => $bc_agent_certificate,
        ]);
        $voterid = "";
        if ($request->voterid != null) {
            $voterid = uniqid() . '.' . $request->file('voterid')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'voterid' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['voterid']['tmp_name'], $filepath . $voterid);
        }
        DB::table('tec_exam')->where('id', $insertid)->update([
            'voterid'         => $voterid,
        ]);
        $bank_passbook = "";
        if ($request->bank_passbook != null) {
            $bank_passbook = uniqid() . '.' . $request->file('bank_passbook')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'bank_passbook' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['bank_passbook']['tmp_name'], $filepath . $bank_passbook);
        }
        DB::table('tec_exam')->where('id', $insertid)->update([
            'bank_passbook'         => $bank_passbook,
        ]);
        $tec_certificate = "";
        if ($request->tec_certificate != null) {
            $tec_certificate = uniqid() . '.' . $request->file('tec_certificate')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'tec_certificate' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['tec_certificate']['tmp_name'], $filepath . $tec_certificate);
        }
        DB::table('tec_exam')->where('id', $insertid)->update([
            'tec_certificate'         => $tec_certificate,
        ]);


        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));


        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }

    public function submitapply_medicalscheme(Request $request)
    {

        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
        if ($serviceid == 179) {
            DB::table('medicalscheme')->insert([
                'user_id'      => $user_id,
                'retailer_id'  => $retailer_id,
                'distributor_id' => $distributor_id,
                'service_id'   => $request->serviceid,
                'amount'       => $request->amount,
                'family_head_name' => $request->family_head_name,
                'mobile'       => $request->mobile,
                'relationship'       => $request->relationship,
                'smartcard_no'       => $request->smartcard_no,
                'aadhaar_no'       => $request->aadhaar_no,
                'marital_status'       => $request->marital_status,
                'father_name'       => $request->father_name,
                'husband_name'       => $request->husband_name,
                'pin_code'       => $request->pin_code,
                'relation'       => $request->relation,
                'status'       => 'Pending',
                'applied_date' => date("Y-m-d"),
                'created_at'   => date("Y-m-d"),
            ]);

            $insertid = DB::getPdo()->lastInsertId();
            $passportsize_photo = "";
            $smartcard_onlineprint = "";
            $vao_or_income_certificate = "";
            $photo = "";
            $aadhaarimg = "";
            $aadhaarimg2 = "";
            $aadhaarimg3 = "";
            $aadhaarimg4 = "";
            $aadhaarimg5 = "";
            $aadhaarimg6 = "";
            $aadhaar_card = "";

            if ($request->aadhaar_card != null) {
                $aadhaar_card = uniqid() . '.' . $request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
            }
            DB::table('medicalscheme')->where('id', $insertid)->update([
                'aadhaar_card' => $aadhaar_card,
            ]);
            if ($request->passportsize_photo != null) {
                $passportsize_photo = uniqid() . '.' . $request->file('passportsize_photo')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'passportsize_photo' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['passportsize_photo']['tmp_name'], $filepath . $passportsize_photo);
            }
            DB::table('medicalscheme')->where('id', $insertid)->update([
                'passportsize_photo' => $passportsize_photo,
            ]);
            if ($request->smartcard_onlineprint != null) {
                $smartcard_onlineprint = uniqid() . '.' . $request->file('smartcard_onlineprint')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smartcard_onlineprint' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['smartcard_onlineprint']['tmp_name'], $filepath . $smartcard_onlineprint);
            }
            DB::table('medicalscheme')->where('id', $insertid)->update([
                'smartcard_onlineprint' => $smartcard_onlineprint,
            ]);

            if ($request->vao_or_income_certificate != null) {
                $vao_or_income_certificate = uniqid() . '.' . $request->file('vao_or_income_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'vao_or_income_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['vao_or_income_certificate']['tmp_name'], $filepath . $vao_or_income_certificate);
            }
            DB::table('medicalscheme')->where('id', $insertid)->update([
                'vao_or_income_certificate' => $vao_or_income_certificate,
            ]);

            if ($request->photo != null) {
                $photo = uniqid() . '.' . $request->file('photo')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);
            }
            DB::table('medicalscheme')->where('id', $insertid)->update([
                'photo' => $photo,
            ]);

            if ($request->aadhaar != null) {
                $aadhaarimg = uniqid() . '.' . $request->file('aadhaar')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar']['tmp_name'], $filepath . $aadhaarimg);
            }
            DB::table('medicalscheme')->where('id', $insertid)->update([
                'aadhaar' => $aadhaarimg,
            ]);
            if ($request->aadhaar2 != null) {
                $aadhaarimg2 = uniqid() . '.' . $request->file('aadhaar2')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar2' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar2']['tmp_name'], $filepath . $aadhaarimg2);
            }
            DB::table('medicalscheme')->where('id', $insertid)->update([
                'aadhaar2' => $aadhaarimg2,
            ]);
            if ($request->aadhaar3 != null) {
                $aadhaarimg3 = uniqid() . '.' . $request->file('aadhaar3')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar3' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar3']['tmp_name'], $filepath . $aadhaarimg3);
            }
            DB::table('medicalscheme')->where('id', $insertid)->update([
                'aadhaar3' => $aadhaarimg3,
            ]);
            if ($request->aadhaar4 != null) {
                $aadhaarimg4 = uniqid() . '.' . $request->file('aadhaar4')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar4' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar4']['tmp_name'], $filepath . $aadhaarimg4);
            }
            DB::table('medicalscheme')->where('id', $insertid)->update([
                'aadhaar4' => $aadhaarimg4,
            ]);
            if ($request->aadhaar5 != null) {
                $aadhaarimg5 = uniqid() . '.' . $request->file('aadhaar5')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar5' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar5']['tmp_name'], $filepath . $aadhaarimg5);
            }
            DB::table('medicalscheme')->where('id', $insertid)->update([
                'aadhaar5' => $aadhaarimg5,
            ]);
            if ($request->aadhaar6 != null) {
                $aadhaarimg6 = uniqid() . '.' . $request->file('aadhaar6')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar6' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar6']['tmp_name'], $filepath . $aadhaarimg6);
            }
            DB::table('medicalscheme')->where('id', $insertid)->update([
                'aadhaar6' => $aadhaarimg6,
            ]);
        } elseif ($serviceid == 180) {
            DB::table('medicalscheme')->insert([
                'user_id'                   => $user_id,
                'retailer_id'               => $retailer_id,
                'distributor_id'            => $distributor_id,
                'service_id'                => $request->serviceid,
                'amount'                    => $request->amount,
                'mobile'                    => $request->mobile,
                'status'                    => 'Pending',
                'applied_date'              => date("Y-m-d"),
                'created_at'                => date("Y-m-d"),
            ]);

            $insertid = DB::getPdo()->lastInsertId();
            $aadhaarimg = "";

            if ($request->aadhaar_card != null) {
                $aadhaarimg = uniqid() . '.' . $request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);
            }
            DB::table('medicalscheme')->where('id', $insertid)->update([
                'aadhaar_card' => $aadhaarimg,
            ]);
        }


        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        $getpermission = DB::table('service_payment')->where('service_id', $serviceid)->first();
        $coordinator_permission = 0;
        $admin_payment = 0;
        if ($getpermission) {
            $coordinator_permission = $getpermission->coordinator_permission;
            $admin_payment = $getpermission->admin_amount;
        }
        if ($coordinator_permission == 1) {
            $getdata = DB::table('medicalscheme')->where('id', $insertid)->first();
            if ($getdata) {
                $aadhaar_card = $getdata->aadhaar_card;
                $passportsize_photo = $getdata->passportsize_photo;
                $vao_or_income_certificate = $getdata->vao_or_income_certificate;
                $smartcard_onlineprint = $getdata->smartcard_onlineprint;
                $photo = $getdata->photo;
                $service_id = $getdata->service_id;
                $rowid = $getdata->id;
                $family_head_name = $getdata->family_head_name;
                $father_name = $getdata->father_name;
                $smartcard_no = $getdata->smartcard_no;
                $mobile = $getdata->mobile;
                $aadhaar_no = $getdata->aadhaar_no;
                $pin_code = $getdata->pin_code;
                $husband_name = $getdata->husband_name;
                $marital_status = $getdata->marital_status;
                $relation = $getdata->relation;
                $status = $getdata->status;
                $url = url('/');
                $photo_url = $url . '/upload/services/photo/' . $photo;
                $smartcard_url = $url . '/upload/services/smartcard_onlineprint/' . $smartcard_onlineprint;
                $vao_or_income_certificate_url = $url . '/upload/services/vao_or_income_certificate/' . $vao_or_income_certificate;
                $passportsize_url = $url . '/upload/services/passportsize_photo/' . $passportsize_photo;
                $aadhaar_url = $url . '/upload/services/aadhaar_card/' . $aadhaar_card;
                $API_KEY = env('API_KEY', '');
                $RAMJIPAY_URL = env('RAMJIPAY_URL', '');
                $WEBSITE_INDEX = env('WEBSITE_INDEX', '');
                $ch = curl_init();

                if ($serviceid == 179) {
                    $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_card=$aadhaar_url&photo=$photo_url&passportsize_photo=$passportsize_url&vao_or_income_certificate=$vao_or_income_certificate_url&smartcard_onlineprint=$smartcard_url&service_id=$service_id&rowid=$rowid&status=$status&family_head_name=$family_head_name&father_name=$father_name&smartcard_no=$smartcard_no&mobile=$mobile&aadhaar_no=$aadhaar_no&pin_code=$pin_code&husband_name=$husband_name&marital_status=$marital_status&relation=$relation";
                }
                //dd($post_data);
                $url1 = $RAMJIPAY_URL . '/api/get_medicalscheme_api';
                //echo $url1;die;
                curl_setopt($ch, CURLOPT_URL, $url1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $server_output = curl_exec($ch);
                curl_close($ch);
                $resdata = json_decode($server_output, true);
                //dd($resdata);
                if ($resdata) {
                    $status = $resdata['message'];
                    if ($status == "Success") {
                        $date = date('Y-m-d');
                        $time = date('H:i:s');
                        $service_status = 'Out Payment';
                        $ad_info = 'Ramji Wallet Debit' . ' ' . $servicename;
                        $getrawallet = DB::table('users')->select('rawallet')->where('id', 1)->first();
                        $rawallet = 0;
                        if ($getrawallet) {
                            $balance1 = $getrawallet->rawallet;
                        }

                        $getrawallet1 = DB::table('users')->select('rawallet')->where('id', 2)->first();
                        $rawallet1 = 0;
                        if ($getrawallet1) {
                            $balance2 = $getrawallet1->rawallet;
                        }
                        $newbalance2 = $balance1 + $admin_payment;
                        $newbalance3 = $balance2 - $admin_payment;
                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet + $admin_payment where id = 1";
                        DB::update(DB::raw($sql));
                        $service_status = 'IN Payment';
                        $ad_info = 'Ramji Wallet Credit' . ' ' . $servicename;
                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet - $admin_payment where id = 2";
                        DB::update(DB::raw($sql));
                    }
                }
            }
        }
        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }
    public function submitapply_dharsan(Request $request)
    {

        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
        if ($serviceid == 183 || $serviceid == 184 || $serviceid == 185 || $serviceid == 186) {
            DB::table('dharsan')->insert([
                'user_id'      => $user_id,
                'retailer_id'  => $retailer_id,
                'distributor_id' => $distributor_id,
                'service_id'   => $request->serviceid,
                'amount'       => $request->amount,
                'name'         => $request->name,
                'mobile'       => $request->mobile,
                'darshan_date' => $request->darshan_date,
                'time'         => $request->time,
                'route'         => $request->route,
                'status'       => 'Pending',
                'applied_date' => date("Y-m-d"),
                'created_at'   => date("Y-m-d"),
            ]);

            $insertid = DB::getPdo()->lastInsertId();
            $photo = "";
            $aadhaar_card = "";

            if ($request->photo != null) {
                $photo = uniqid() . '.' . $request->file('photo')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);
            }
            DB::table('dharsan')->where('id', $insertid)->update([
                'photo' => $photo,
            ]);
            if ($request->aadhaar_card != null) {
                $aadhaar_card = uniqid() . '.' . $request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
            }
            DB::table('dharsan')->where('id', $insertid)->update([
                'aadhaar_card' => $aadhaar_card,
            ]);
        }


        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }
    public function submitapply_banner(Request $request)
    {

        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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

        DB::table('banner')->insert([
            //dd($banner);
            'user_id'      => $user_id,
            'retailer_id'  => $retailer_id,
            'distributor_id'  => $distributor_id,
            'service_id'   => $request->serviceid,
            'amount'       => $request->amount,
            'organization_name'         => $request->organization_name,
            'mobile'       => $request->mobile,
            'content'       => $request->content,
            'status'       => 'Pending',
            'applied_date' => date("Y-m-d"),
            'created_at'   => date("Y-m-d"),
        ]);

        $insertid = DB::getPdo()->lastInsertId();
        $model_image = "";

        if ($request->model_image != null) {
            $model_image = uniqid() . '.' . $request->file('model_image')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'banner' . DIRECTORY_SEPARATOR . 'model_image' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['model_image']['tmp_name'], $filepath . $model_image);
        }
        DB::table('banner')->where('id', $insertid)->update([
            'model_image' => $model_image,
        ]);


        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }

    public function submitapply_patta(Request $request)
    {

        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
        if ($serviceid == 213 || $serviceid == 214 || $serviceid == 215) {
            DB::table('patta')->insert([
                'user_id'          => $user_id,
                'retailer_id'      => $retailer_id,
                'distributor_id'   => $distributor_id,
                'service_id'       => $request->serviceid,
                'amount'           => $request->amount,
                'can_no'           => $request->can_no,
                'dist_id'          => $request->dist_id,
                'taluk_id'         => $request->taluk_id,
                'reg_office'       => $request->reg_office,
                'subdivision_no'   => $request->subdivision_no,
                'rev_village'      => $request->rev_village,
                'survey_no'        => $request->survey_no,
                'transacted_area'  => $request->transacted_area,
                'status'           => 'Pending',
                'applied_date'     => date("Y-m-d"),
                'created_at'       => date("Y-m-d"),
            ]);

            $insertid = DB::getPdo()->lastInsertId();

            $bond_doc = "";
            if ($request->bond_doc != null) {
                $bond_doc = uniqid() . '.' . $request->file('bond_doc')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'bond_doc' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['bond_doc']['tmp_name'], $filepath . $bond_doc);
            }
            DB::table('patta')->where('id', $insertid)->update([
                'bond_doc'         => $bond_doc,
            ]);
            $ec = "";
            if ($request->ec != null) {
                $ec = uniqid() . '.' . $request->file('ec')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'ec' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['ec']['tmp_name'], $filepath . $ec);
            }
            DB::table('patta')->where('id', $insertid)->update([
                'ec'         => $ec,
            ]);
        } elseif ($serviceid == 219) {
            DB::table('patta')->insert([
                'user_id'          => $user_id,
                'retailer_id'      => $retailer_id,
                'distributor_id'   => $distributor_id,
                'service_id'       => $request->serviceid,
                'amount'           => $request->amount,
                'can_no'           => $request->can_no,
                'dist_id'          => $request->dist_id,
                'taluk_id'         => $request->taluk_id,
                'reg_office'       => $request->reg_office,
                'subdivision_no'   => $request->subdivision_no,
                'rev_village'      => $request->rev_village,
                'survey_no'        => $request->survey_no,
                'transacted_area'  => $request->transacted_area,
                'status'           => 'Pending',
                'applied_date'     => date("Y-m-d"),
                'created_at'       => date("Y-m-d"),
            ]);

            $insertid = DB::getPdo()->lastInsertId();
            $bond_doc = "";
            if ($request->bond_doc != null) {
                $bond_doc = uniqid() . '.' . $request->file('bond_doc')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'bond_doc' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['bond_doc']['tmp_name'], $filepath . $bond_doc);
            }
            DB::table('patta')->where('id', $insertid)->update([
                'bond_doc'         => $bond_doc,
            ]);
            $ec = "";
            if ($request->ec != null) {
                $ec = uniqid() . '.' . $request->file('ec')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'ec' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['ec']['tmp_name'], $filepath . $ec);
            }
            DB::table('patta')->where('id', $insertid)->update([
                'ec'         => $ec,
            ]);
            $legal_heir = "";
            if ($request->legal_heir != null) {
                $legal_heir = uniqid() . '.' . $request->file('legal_heir')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'legal_heir_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['legal_heir']['tmp_name'], $filepath . $legal_heir);
            }
            DB::table('patta')->where('id', $insertid)->update([
                'legal_heir'       => $legal_heir,
            ]);
            $death_certificate = "";
            if ($request->death_certificate != null) {
                $death_certificate = uniqid() . '.' . $request->file('death_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'deathcertificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['death_certificate']['tmp_name'], $filepath . $death_certificate);
            }
            DB::table('patta')->where('id', $insertid)->update([
                'death_certificate'         => $death_certificate,
            ]);
            $chitta_copy = "";
            if ($request->chitta_copy != null) {
                $chitta_copy = uniqid() . '.' . $request->file('chitta_copy')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'chitta' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['chitta_copy']['tmp_name'], $filepath . $chitta_copy);
            }
            DB::table('patta')->where('id', $insertid)->update([
                'chitta_copy'         => $chitta_copy,
            ]);
        } elseif ($serviceid == 247 || $serviceid == 248) {
            //dd($request->all());
            DB::table('patta')->insert([
                'user_id'          => $user_id,
                'retailer_id'      => $retailer_id,
                'distributor_id'   => $distributor_id,
                'service_id'       => $request->serviceid,
                'amount'           => $request->amount,
                'can_no'           => $request->can_no,
                'survey_no'        => $request->survey_no,
                'patta_no'         => $request->patta_no,
                'mobile'           => $request->mobile,
                'status'           => 'Pending',
                'applied_date'     => date("Y-m-d"),
                'created_at'       => date("Y-m-d"),
            ]);

            $insertid = DB::getPdo()->lastInsertId();
            $document_page = "";
            $Palmistry_page = "";
            $oldpatta_chitta = "";
            $death_certificate = "";
            $original_document = "";
            $tabasil_property = "";
            $anecdotal_evidence = "";
            $heir_proof = "";
            $aadhaar_card = "";

            if ($request->document_page != null) {
                $document_page = uniqid() . '.' . $request->file('document_page')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'document_page' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['document_page']['tmp_name'], $filepath . $document_page);
            }
            DB::table('patta')->where('id', $insertid)->update([
                'document_page'         => $document_page,
            ]);
            if ($request->Palmistry_page != null) {
                $Palmistry_page = uniqid() . '.' . $request->file('Palmistry_page')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'Palmistry_page' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['Palmistry_page']['tmp_name'], $filepath . $Palmistry_page);
            }
            DB::table('patta')->where('id', $insertid)->update([
                'Palmistry_page'         => $Palmistry_page,
            ]);
            if ($request->oldpatta_chitta != null) {
                $oldpatta_chitta = uniqid() . '.' . $request->file('oldpatta_chitta')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'oldpatta_chitta' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['oldpatta_chitta']['tmp_name'], $filepath . $oldpatta_chitta);
            }
            DB::table('patta')->where('id', $insertid)->update([
                'oldpatta_chitta'       => $oldpatta_chitta,
            ]);
            if ($request->death_certificate != null) {
                $death_certificate = uniqid() . '.' . $request->file('death_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'deathcertificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['death_certificate']['tmp_name'], $filepath . $death_certificate);
            }
            DB::table('patta')->where('id', $insertid)->update([
                'death_certificate'         => $death_certificate,
            ]);
            if ($request->original_document != null) {
                $original_document = uniqid() . '.' . $request->file('original_document')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'original_document' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['original_document']['tmp_name'], $filepath . $original_document);
            }
            DB::table('patta')->where('id', $insertid)->update([
                'original_document'         => $original_document,
            ]);
            if ($request->tabasil_property != null) {
                $tabasil_property = uniqid() . '.' . $request->file('tabasil_property')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'tabasil_property' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['tabasil_property']['tmp_name'], $filepath . $tabasil_property);
            }
            DB::table('patta')->where('id', $insertid)->update([
                'tabasil_property'         => $tabasil_property,
            ]);
            if ($request->anecdotal_evidence != null) {
                $anecdotal_evidence = uniqid() . '.' . $request->file('anecdotal_evidence')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'anecdotal_evidence' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['anecdotal_evidence']['tmp_name'], $filepath . $anecdotal_evidence);
            }
            DB::table('patta')->where('id', $insertid)->update([
                'anecdotal_evidence'         => $anecdotal_evidence,
            ]);
            if ($request->heir_proof != null) {
                $heir_proof = uniqid() . '.' . $request->file('heir_proof')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'heir_proof' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['heir_proof']['tmp_name'], $filepath . $heir_proof);
            }
            DB::table('patta')->where('id', $insertid)->update([
                'heir_proof'         => $heir_proof,
            ]);
            if ($request->aadhaar_card != null) {
                $aadhaar_card = uniqid() . '.' . $request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
            }
            DB::table('patta')->where('id', $insertid)->update([
                'aadhaar_card'         => $aadhaar_card,
            ]);
        }


        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        $getpermission = DB::table('service_payment')->where('service_id', $serviceid)->first();
        $coordinator_permission = 0;
        $admin_payment = 0;
        if ($getpermission) {
            $coordinator_permission = $getpermission->coordinator_permission;
            $admin_payment = $getpermission->admin_amount;
        }
        if ($coordinator_permission == 1) {
            $getdata = DB::table('patta')->where('id', $insertid)->first();
            if ($getdata) {
                $bond_doc = $getdata->bond_doc;
                $ec = $getdata->ec;
                $legal_heir = $getdata->legal_heir;
                $chitta_copy = $getdata->chitta_copy;
                $death_certificate = $getdata->death_certificate;
                $document_page = $getdata->document_page;
                $Palmistry_page = $getdata->Palmistry_page;
                $oldpatta_chitta = $getdata->oldpatta_chitta;
                $original_document = $getdata->original_document;
                $tabasil_property = $getdata->tabasil_property;
                $anecdotal_evidence = $getdata->anecdotal_evidence;
                $heir_proof = $getdata->heir_proof;
                $aadhaar_card = $getdata->aadhaar_card;
                $service_id = $getdata->service_id;
                $rowid = $getdata->id;
                $can_no = $getdata->can_no;
                $taluk_id = $getdata->taluk_id;
                $dist_id = $getdata->dist_id;
                $reg_office = $getdata->reg_office;
                $dist_id = $getdata->dist_id;
                $subdivision_no = $getdata->subdivision_no;
                $rev_village = $getdata->rev_village;
                $survey_no = $getdata->survey_no;
                $transacted_area = $getdata->transacted_area;
                $patta_no = $getdata->patta_no;
                $mobile = $getdata->mobile;
                $status = $getdata->status;
                $url = url('/');
                $bond_doc_url = $url . '/upload/services/bond_doc/' . $bond_doc;
                $ec_url = $url . '/upload/services/ec/' . $ec;
                $legal_heir_url = $url . '/upload/services/legal_heir_certificate/' . $legal_heir;
                $chitta_copy_url = $url . '/upload/services/chitta/' . $chitta_copy;
                $death_certificate_url = $url . '/upload/services/deathcertificate/' . $death_certificate;
                $document_page_url = $url . '/upload/services/document_page/' . $document_page;
                $Palmistry_page_url = $url . '/upload/services/Palmistry_page/' . $Palmistry_page;
                $oldpatta_chitta_url = $url . '/upload/services/oldpatta_chitta/' . $oldpatta_chitta;
                $original_document_url = $url . '/upload/services/original_document/' . $original_document;
                $tabasil_property_url = $url . '/upload/services/tabasil_property/' . $tabasil_property;
                $anecdotal_evidence_url = $url . '/upload/services/anecdotal_evidence/' . $anecdotal_evidence;
                $heir_proof_url = $url . '/upload/services/heir_proof/' . $heir_proof;
                $aadhaar_card_url = $url . '/upload/services/aadhaar_card/' . $aadhaar_card;
                $API_KEY = env('API_KEY', '');
                $RAMJIPAY_URL = env('RAMJIPAY_URL', '');
                $WEBSITE_INDEX = env('WEBSITE_INDEX', '');
                $ch = curl_init();

                if ($serviceid == 213) {
                    $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&bond_doc=$bond_doc_url&service_id=228&rowid=$rowid&status=$status&ec=$ec_url&can_no=$can_no&dist_id=$dist_id&taluk_id=$taluk_id&reg_office=$reg_office&subdivision_no=$subdivision_no&rev_village=$rev_village&survey_no=$survey_no&transacted_area=$transacted_area";
                } elseif ($serviceid == 214) {
                    $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&bond_doc=$bond_doc_url&service_id=229&rowid=$rowid&status=$status&ec=$ec_url&can_no=$can_no&dist_id=$dist_id&taluk_id=$taluk_id&reg_office=$reg_office&subdivision_no=$subdivision_no&rev_village=$rev_village&survey_no=$survey_no&transacted_area=$transacted_area";
                } elseif ($serviceid == 215) {
                    $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&bond_doc=$bond_doc_url&service_id=230&rowid=$rowid&status=$status&ec=$ec_url&can_no=$can_no&dist_id=$dist_id&taluk_id=$taluk_id&reg_office=$reg_office&subdivision_no=$subdivision_no&rev_village=$rev_village&survey_no=$survey_no&transacted_area=$transacted_area";
                } elseif ($serviceid == 219) {
                    $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&legal_heir_certificate=$legal_heir_url&service_id=231&rowid=$rowid&status=$status&ec=$ec_url&bond_doc=$bond_doc_url&chitta=$chitta_copy_url&death_certificate=$death_certificate_url&can_no=$can_no&taluk_id=$taluk_id&reg_office=$reg_office&subdivision_no=$subdivision_no&dist_id=$dist_id&rev_village=$rev_village&survey_no=$survey_no&transacted_area=$transacted_area";
                } elseif ($serviceid == 247) {
                    $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&Palmistry_page=$Palmistry_page_url&service_id=269&rowid=$rowid&status=$status&document_page=$document_page_url&oldpatta_chitta=$oldpatta_chitta_url&death_certificate=$death_certificate_url&original_document=$original_document_url&tabasil_property=$tabasil_property_url&anecdotal_evidence=$anecdotal_evidence_url&heir_proof=$heir_proof_url&can_no=$can_no&survey_no=$survey_no";
                } elseif ($serviceid == 248) {
                    $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_card_url&service_id=270&rowid=$rowid&status=$status&mobile=$mobile&patta_no=$patta_no";
                }


                //dd($post_data);
                $url1 = $RAMJIPAY_URL . '/api/get_patta_api';
                curl_setopt($ch, CURLOPT_URL, $url1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $server_output = curl_exec($ch);
                curl_close($ch);
                $resdata = json_decode($server_output, true);
                //dd($resdata);
                if ($resdata) {
                    $status = $resdata['message'];
                    if ($status == "Success") {
                        $date = date('Y-m-d');
                        $time = date('H:i:s');
                        $service_status = 'Out Payment';
                        $ad_info = 'Ramji Wallet Debit' . ' ' . $servicename;
                        $getrawallet = DB::table('users')->select('rawallet')->where('id', 1)->first();
                        $rawallet = 0;
                        if ($getrawallet) {
                            $balance1 = $getrawallet->rawallet;
                        }

                        $getrawallet1 = DB::table('users')->select('rawallet')->where('id', 2)->first();
                        $rawallet1 = 0;
                        if ($getrawallet1) {
                            $balance2 = $getrawallet1->rawallet;
                        }
                        $newbalance2 = $balance1 + $admin_payment;
                        $newbalance3 = $balance2 - $admin_payment;
                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet + $admin_payment where id = 1";
                        DB::update(DB::raw($sql));
                        $service_status = 'IN Payment';
                        $ad_info = 'Ramji Wallet Credit' . ' ' . $servicename;

                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet - $admin_payment where id = 2";
                        DB::update(DB::raw($sql));
                    }
                }
            }
        }
        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }

    public function submitutislnew(Request $request)
    {
        // dd($request->all());
        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
        DB::table('utislpan')->insert([
            'user_id'             =>   $user_id,
            'retailer_id'         =>   $retailer_id,
            'distributor_id'      =>   $distributor_id,
            'service_id'          => $request->serviceid,
            // 'amount'              => $request->amount,
            'name'                => $request->name,
            'mobile'              => $request->mobile,
            'email'               => $request->email,
            'date_of_birth'       => $request->date_of_birth,
            'father_name'         => $request->father_name,
            'status'              => 'Pending',
            'applied_date'        => date("Y-m-d"),
            'created_at'          => date("Y-m-d"),
        ]);

        $insertid = DB::getPdo()->lastInsertId();

        $aadhaar_pdf = "";
        if ($request->aadhaar_pdf != null) {
            $aadhaar_pdf = uniqid() . '.' . $request->file('aadhaar_pdf')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaarpdf' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['aadhaar_pdf']['tmp_name'], $filepath . $aadhaar_pdf);
        }
        DB::table('utislpan')->where('id', $insertid)->update([
            'aadhaar_pdf'         => $aadhaar_pdf,
        ]);
        $signature = "";
        if ($request->signature != null) {
            $signature = uniqid() . '.' . $request->file('signature')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'signature' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['signature']['tmp_name'], $filepath . $signature);
        }
        DB::table('utislpan')->where('id', $insertid)->update([
            'signature'         => $signature,
        ]);
        $photo = "";
        if ($request->photo != null) {
            $photo = uniqid() . '.' . $request->file('photo')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);
        }
        DB::table('utislpan')->where('id', $insertid)->update([
            'photo'         => $photo,
        ]);

        $servicepayment = $request->servicepayment;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('utislpanservice')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }

    public function submitutisl_corection(Request $request)
    {
        // dd($request->all());
        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
        DB::table('utislpan')->insert([
            'user_id'             =>   $user_id,
            'retailer_id'         =>   $retailer_id,
            'distributor_id'      =>   $distributor_id,
            'service_id'          => $request->serviceid,
            'pan_no'              => $request->pan_no,
            'mode'                => $request->mode,
            // 'amount'              => $request->amount,
            'name'                => $request->name,
            'mobile'              => $request->mobile,
            'email'               => $request->email,
            'date_of_birth'       => $request->date_of_birth,
            'father_name'         => $request->father_name,
            'status'              => 'Pending',
            'applied_date'        => date("Y-m-d"),
            'created_at'          => date("Y-m-d"),
        ]);

        $insertid = DB::getPdo()->lastInsertId();

        $aadhaar_pdf = "";
        if ($request->aadhaar_pdf != null) {
            $aadhaar_pdf = uniqid() . '.' . $request->file('aadhaar_pdf')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaarpdf' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['aadhaar_pdf']['tmp_name'], $filepath . $aadhaar_pdf);
        }
        DB::table('utislpan')->where('id', $insertid)->update([
            'aadhaar_pdf'         => $aadhaar_pdf,
        ]);
        $pan_file = "";
        if ($request->pan_file != null) {
            $pan_file = uniqid() . '.' . $request->file('pan_file')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'pancard' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['pan_file']['tmp_name'], $filepath . $pan_file);
        }
        DB::table('utislpan')->where('id', $insertid)->update([
            'pan_file'         => $pan_file,
        ]);
        $signature = "";
        if ($request->signature != null) {
            $signature = uniqid() . '.' . $request->file('signature')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'signature' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['signature']['tmp_name'], $filepath . $signature);
        }
        DB::table('utislpan')->where('id', $insertid)->update([
            'signature'         => $signature,
        ]);
        $photo = "";
        if ($request->photo != null) {
            $photo = uniqid() . '.' . $request->file('photo')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);
        }
        DB::table('utislpan')->where('id', $insertid)->update([
            'photo'         => $photo,
        ]);

        $servicepayment = $request->servicepayment;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('utislpanservice')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }

    public function submitapply_smartcardotp (Request $request)
    {
        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }

        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        $servicepayment = 0;

        if ($getservicepayment) {
            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
            } elseif (Auth::user()->user_type_id == 3) {
                $servicepayment = $getservicepayment->distributor_amount;
            } elseif (Auth::user()->user_type_id == 4) {
                $servicepayment = $getservicepayment->retailer_amount;
            } elseif (Auth::user()->user_type_id == 5) {
                $servicepayment = $getservicepayment->customer_amount;
            }
        }

        // Process member data
        $membersData = [];
        $memberNames  = $request->input('member_name', []);
        $aadhaarFiles = $request->file('member_aadhaar_card', []);

        foreach ($memberNames as $index => $name) {
            $filePath = null;

            if (isset($aadhaarFiles[$index])) {
                $file = $aadhaarFiles[$index];
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                // Save to public/upload/services/aadhaarcard
                $file->move(public_path('upload/services/aadhaarcard'), $fileName);

                $filePath = 'services/aadhaarcard/' . $fileName;
            }

            $membersData[] = [
                'name'             => $name,
                'aadhaar_card_path' => $filePath
            ];
        }

        // Calculate total payment based on member count
        $memberCount = count($membersData);
        $totalAmount = $servicepayment * $memberCount;

        // Wallet balance check against total calculated amount
        if (Auth::user()->wallet < $totalAmount) {
            return redirect()->back()->with('error', 'Insufficient wallet balance. Please recharge your wallet to proceed.');
        }

        // Insert into database
        DB::table('smartcard_otp')->insert([
            'user_id'              => $user_id,
            'retailer_id'          => $retailer_id,
            'distributor_id'       => $distributor_id,
            'service_id'           => $request->serviceid,
            'amount'               => $totalAmount, // Calculated total amount
            'name'                 => $request->name,
            'documents'            => $request->documents,
            'linked_mobile_number' => $request->linked_mobile_number,
            'relationship'         => $request->relationship,
            'name_count'           => $memberCount,
            'members'              => json_encode($membersData),
            'application_type'     => $request->input('application_type'),
            'status'               => 'Pending',
            'applied_date'         => date("Y-m-d"),
            'created_at'           => date("Y-m-d"),
        ]);


        $insertid     = DB::getPdo()->lastInsertId();
        $aadhaar_card = "";
        $smart_card   = "";
        if ($request->aadhaar_card != null) {
            $aadhaar_card = uniqid() . '.' . $request->file('aadhaar_card')->extension();
            $filepath     = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
        }
        DB::table('smartcard_otp')->where('id', $insertid)->update([
            'aadhaar_card' => $aadhaar_card,
        ]);
        if ($request->smart_card != null) {
            $smart_card = uniqid() . '.' . $request->file('smart_card')->extension();
            $filepath   = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smart_card);
        }
        DB::table('smartcard_otp')->where('id', $insertid)->update([
            'smart_card' => $smart_card,
        ]);

        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $totalAmount;
        $newbalance1 = Auth::user()->wallet - $totalAmount;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$totalAmount','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $totalAmount where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$totalAmount','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $totalAmount where id = $user_id";
        DB::update(DB::raw($sql));

        $getpermission = DB::table('service_payment')->where('service_id', $serviceid)->first();
        $coordinator_permission = 0;
        $admin_payment = 0;

        if ($getpermission) {
            $coordinator_permission = $getpermission->coordinator_permission;
            $admin_payment = (float)$getpermission->admin_amount;
        }

        if ($coordinator_permission == 1) {
            $getdata = DB::table('smartcard_otp')->where('id', $insertid)->first();

            if ($getdata) {
                // Retrieve count (defaulting to 1 if not set or zero)
                $memberCount = !empty($getdata->name_count) ? (int)$getdata->name_count : 1;

                // Multiply admin payment by member count
                $totalAdminPayment = $admin_payment * $memberCount;

                $aadhaar_card = $getdata->aadhaar_card;
                $smart_card = $getdata->smart_card;
                $service_id = $getdata->service_id;
                $rowid = $getdata->id;
                $name = $getdata->name;
                $smartcard_number = $getdata->smartcard_number;
                $relationship = $getdata->relationship;
                $status = $getdata->status;
                $url = url('/');
                $aadhaar_url = $url . '/upload/services/aadhaar_card/' . $aadhaar_card;
                $smartcard_url = $url . '/upload/services/smart_card/' . $smart_card;

                $API_KEY = env('API_KEY', '');
                $RAMJIPAY_URL = env('RAMJIPAY_URL', '');
                $WEBSITE_INDEX = env('WEBSITE_INDEX', '');

                // Prepare POST fields including count and total calculated payment
                $post_fields = [
                    'key'                  => $API_KEY,
                    'index'                => $WEBSITE_INDEX,
                    'aadhaar_file'         => $aadhaar_url,
                    'service_id'           => 218,
                    'rowid'                => $rowid,
                    'status'               => $status,
                    'smartcard_file'       => $smartcard_url,
                    'name'                 => $name,
                    'smartcard_number'     => $smartcard_number,
                    'linked_mobile_number' => $getdata->linked_mobile_number,
                    'relationship'         => $getdata->relationship,
                    'name_count'           => $memberCount,
                    'members'              => $getdata->members,
                    'application_type'     => $getdata->application_type,
                    'admin_debit_amount'   => $totalAdminPayment
                ];

                $ch = curl_init();
                $url1 = $RAMJIPAY_URL . '/api/get_smartcardotp_api';
                //dd($post_fields);
                curl_setopt($ch, CURLOPT_URL, $url1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_fields));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                $server_output = curl_exec($ch);
                curl_close($ch);

                $resdata = json_decode($server_output, true);

                if ($resdata) {
                    $status = $resdata['message'] ?? '';

                    if ($status == "Success") {
                        $date = date('Y-m-d');
                        $time = date('H:i:s');

                        // Get current rawallet balances
                        $getrawallet1 = DB::table('users')->select('rawallet')->where('id', 1)->first();
                        $balance1 = $getrawallet1 ? (float)$getrawallet1->rawallet : 0;

                        $getrawallet2 = DB::table('users')->select('rawallet')->where('id', 2)->first();
                        $balance2 = $getrawallet2 ? (float)$getrawallet2->rawallet : 0;

                        $newbalance1 = $balance1 + $totalAdminPayment;
                        $newbalance2 = $balance2 - $totalAdminPayment;

                        // 1. Debit from User 2
                        $ad_info_debit = 'Ramji Wallet Debit ' . $servicename;
                        DB::table('ramji_payment')->insert([
                            'log_id'         => 2,
                            'from_id'        => 1,
                            'to_id'          => 2,
                            'amount'         => $totalAdminPayment,
                            'ad_info'        => $ad_info_debit,
                            'service_status' => 'Out Payment',
                            'time'           => $time,
                            'paydate'        => $date,
                            'pay_id'         => 2,
                            'newbalance'     => $newbalance2
                        ]);

                        // Update User 2 rawallet (deduct)
                        DB::table('users')->where('id', 2)->decrement('rawallet', $totalAdminPayment);

                        // 2. Credit to User 1
                        $ad_info_credit = 'Ramji Wallet Credit ' . $servicename;
                        DB::table('ramji_payment')->insert([
                            'log_id'         => 2,
                            'from_id'        => 2,
                            'to_id'          => 1,
                            'amount'         => $totalAdminPayment,
                            'ad_info'        => $ad_info_credit,
                            'service_status' => 'IN Payment',
                            'time'           => $time,
                            'paydate'        => $date,
                            'pay_id'         => 2,
                            'newbalance'     => $newbalance1
                        ]);

                        // Update User 1 rawallet (add)
                        DB::table('users')->where('id', 1)->increment('rawallet', $totalAdminPayment);
                    }
                }
            }
        }
        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }

    // public function submitapply_smart_nametransfer(Request $request)
    //   {

    //     $user_id = 0;
    //     $retailer_id = 0;
    //     $distributor_id = 0;
    //     if (Auth::user()->user_type_id == 3) {
    //         $user_id = $request->user_id;
    //         $distributor_id = Auth::user()->id;
    //     } elseif (Auth::user()->user_type_id == 4) {
    //         $user_id = $request->user_id;
    //         $retailer_id = Auth::user()->id;
    //     } elseif (Auth::user()->user_type_id == 5) {
    //         $user_id = Auth::user()->id;
    //     }
    //     $serviceid = $request->serviceid;
    //     $servicepayment = 0;
    //     $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
    //     if ($getservicepayment) {

    //         if (Auth::user()->user_type_id == 2) {
    //             $servicepayment = $getservicepayment->admin_amount;
    //         } elseif (Auth::user()->user_type_id == 3) {
    //             $servicepayment = $getservicepayment->distributor_amount;
    //         } elseif (Auth::user()->user_type_id == 4) {
    //             $servicepayment = $getservicepayment->retailer_amount;
    //         } elseif (Auth::user()->user_type_id == 5) {
    //             $servicepayment = $getservicepayment->customer_amount;
    //         }
    //     }
    //     if (in_array($serviceid, [222, 258])) {

    //         $count = (int) $request->name_count;

    //         if ($count <= 0) {
    //             $count = 1;
    //         }

    //         $servicepayment *= $count;
    //     }
    //     if (Auth::user()->wallet < $servicepayment) {
    //         return redirect()->back()->with('error', 'Insufficient wallet balance. Please recharge your wallet to proceed.');
    //     }
    //     if ($serviceid == 222 || $serviceid == 223 || $serviceid == 228 || $serviceid == 231 || $serviceid == 232 || $serviceid == 233 || $serviceid == 234 || $serviceid == 235 || $serviceid == 236  || $serviceid == 237 || $serviceid == 238 || $serviceid == 239 || $serviceid == 240 || $serviceid == 241  || $serviceid == 242 || $serviceid == 243 || $serviceid == 258) {
    //         $member_name = null;

    //         if (in_array($serviceid, [222, 258])) {
    //             $member_name = implode(',', $request->member_name ?? []);
    //         }
    //         DB::table('smartcard')->insert([
    //             'user_id'          => $user_id,
    //             'retailer_id'      => $retailer_id,
    //             'distributor_id'   => $distributor_id,
    //             'service_id'       => $request->serviceid,
    //             'amount'           => $servicepayment,
    //             'dist_id'          => $request->dist_id,
    //             'taluk_id'         => $request->taluk_id,
    //             'dob'              => $request->dob,
    //             'name'             => $request->name,
    //             'relationship'     => $request->relationship,
    //             'name_tamil'       => $request->name_tamil,
    //             'name_english'     => $request->name_english,
    //             'address_tamil_1'       => $request->address_tamil_1,
    //             'address_english_1'     => $request->address_english_1,
    //             'mobile'           => $request->mobile,
    //             'taluk'            => $request->taluk,
    //             'smartcard_number' => $request->smartcard_number,
    //             'petition_no' => $request->petition_no,
    //             'aadhaar_no' => $request->aadhaar_no,
    //             'smart_mobile' => $request->smart_mobile,
    //             'name_count'      => $request->name_count,
    //             'member_name'      => $member_name,
    //             'shop_number'      => $request->shop_number,
    //             'application_type'      => $request->application_type,
    //             'status'       => 'Pending',
    //             'applied_date' => date("Y-m-d"),
    //             'created_at'   => date("Y-m-d"),
    //         ]);

    //         $insertid = DB::getPdo()->lastInsertId();
    //         $aadhaar_card      = "";
    //         $smart_card        = "";
    //         $application_print = "";
    //         $photo = "";
    //         $family_head_aadhaar = "";
    //         if ($request->aadhaar_card != null) {
    //             $aadhaar_card = uniqid() . '.' . $request->file('aadhaar_card')->extension();
    //             $filepath     = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
    //             move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
    //         }
    //         DB::table('smartcard')->where('id', $insertid)->update([
    //             'aadhaar_card' => $aadhaar_card,
    //         ]);
    //         if ($request->smart_card != null) {
    //             $smart_card = uniqid() . '.' . $request->file('smart_card')->extension();
    //             $filepath   = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
    //             move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smart_card);
    //         }
    //         DB::table('smartcard')->where('id', $insertid)->update([
    //             'smart_card' => $smart_card,
    //         ]);
    //         if ($request->application_print != null) {
    //             $application_print = uniqid() . '.' . $request->file('application_print')->extension();
    //             $filepath          = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'application_print' . DIRECTORY_SEPARATOR);
    //             move_uploaded_file($_FILES['application_print']['tmp_name'], $filepath . $application_print);
    //         }
    //         DB::table('smartcard')->where('id', $insertid)->update([
    //             'application_print' => $application_print,
    //         ]);
    //         if ($request->photo != null) {
    //             $photo = uniqid() . '.' . $request->file('photo')->extension();
    //             $filepath          = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
    //             move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);
    //         }
    //         DB::table('smartcard')->where('id', $insertid)->update([
    //             'photo' => $photo,
    //         ]);
    //         if ($request->family_head_aadhaar != null) {
    //             $family_head_aadhaar = uniqid() . '.' . $request->file('family_head_aadhaar')->extension();
    //             $filepath          = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'family_head_aadhaar' . DIRECTORY_SEPARATOR);
    //             move_uploaded_file($_FILES['family_head_aadhaar']['tmp_name'], $filepath . $family_head_aadhaar);
    //         }
    //         DB::table('smartcard')->where('id', $insertid)->update([
    //             'family_head_aadhaar' => $family_head_aadhaar,
    //         ]);
    //     } elseif ($serviceid == 237) {
    //         DB::table('smartcard')->insert([
    //             'user_id'                   => $user_id,
    //             'retailer_id'               => $retailer_id,
    //             'distributor_id'            => $distributor_id,
    //             'service_id'                => $request->serviceid,
    //             'amount'                    => $ser,
    //             'dist_id'                   => $request->dist_id,
    //             'taluk_id'                  => $request->taluk_id,
    //             'add_member'                => $request->add_member,
    //             'mobile'                    => $request->mobile,
    //             'documents'                 => $request->documents,
    //             'status'                    => 'Pending',
    //             'applied_date'              => date("Y-m-d"),
    //             'created_at'                => date("Y-m-d"),
    //         ]);

    //         $insertid = DB::getPdo()->lastInsertId();
    //         $aadhaarimg = "";
    //         $aadhaarimg2 = "";
    //         $aadhaarimg3 = "";
    //         $aadhaarimg4 = "";
    //         $aadhaarimg5 = "";
    //         $smart_card = "";
    //         $family_head = "";
    //         $rental_agreement = "";
    //         $electricity_bill_receipt = "";
    //         $patta = "";
    //         $gas_cylinder_receipt = "";

    //         if ($request->aadhaar_card != null) {
    //             $aadhaarimg = uniqid() . '.' . $request->file('aadhaar_card')->extension();
    //             $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
    //             move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);
    //         }
    //         DB::table('smartcard')->where('id', $insertid)->update([
    //             'aadhaar_card' => $aadhaarimg,
    //         ]);
    //         if ($request->aadhaar_card2 != null) {
    //             $aadhaarimg2 = uniqid() . '.' . $request->file('aadhaar_card2')->extension();
    //             $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card2' . DIRECTORY_SEPARATOR);
    //             move_uploaded_file($_FILES['aadhaar_card2']['tmp_name'], $filepath . $aadhaarimg2);
    //         }
    //         DB::table('smartcard')->where('id', $insertid)->update([
    //             'aadhaar_card2' => $aadhaarimg2,
    //         ]);
    //         if ($request->aadhaar_card3 != null) {
    //             $aadhaarimg3 = uniqid() . '.' . $request->file('aadhaar_card3')->extension();
    //             $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card3' . DIRECTORY_SEPARATOR);
    //             move_uploaded_file($_FILES['aadhaar_card3']['tmp_name'], $filepath . $aadhaarimg3);
    //         }
    //         DB::table('smartcard')->where('id', $insertid)->update([
    //             'aadhaar_card3' => $aadhaarimg3,
    //         ]);
    //         if ($request->aadhaar_card4 != null) {
    //             $aadhaarimg4 = uniqid() . '.' . $request->file('aadhaar_card4')->extension();
    //             $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card4' . DIRECTORY_SEPARATOR);
    //             move_uploaded_file($_FILES['aadhaar_card4']['tmp_name'], $filepath . $aadhaarimg4);
    //         }
    //         DB::table('smartcard')->where('id', $insertid)->update([
    //             'aadhaar_card4' => $aadhaarimg4,
    //         ]);
    //         if ($request->aadhaar_card5 != null) {
    //             $aadhaarimg5 = uniqid() . '.' . $request->file('aadhaar_card5')->extension();
    //             $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card5' . DIRECTORY_SEPARATOR);
    //             move_uploaded_file($_FILES['aadhaar_card5']['tmp_name'], $filepath . $aadhaarimg5);
    //         }
    //         DB::table('smartcard')->where('id', $insertid)->update([
    //             'aadhaar_card5' => $aadhaarimg5,
    //         ]);
    //         if ($request->smart_card != null) {
    //             $smart_card = uniqid() . '.' . $request->file('smart_card')->extension();
    //             $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
    //             move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smart_card);
    //         }
    //         DB::table('smartcard')->where('id', $insertid)->update([
    //             'smart_card' => $smart_card,
    //         ]);
    //         if ($request->family_head_photo != null) {
    //             $family_head = uniqid() . '.' . $request->file('family_head_photo')->extension();
    //             $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'family_head_photo' . DIRECTORY_SEPARATOR);
    //             move_uploaded_file($_FILES['family_head_photo']['tmp_name'], $filepath . $family_head);
    //         }
    //         DB::table('smartcard')->where('id', $insertid)->update([
    //             'family_head_photo' => $family_head,
    //         ]);
    //         if ($request->rental_agreement != null) {
    //             $rental_agreement = uniqid() . '.' . $request->file('rental_agreement')->extension();
    //             $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'rental_agreement' . DIRECTORY_SEPARATOR);
    //             move_uploaded_file($_FILES['rental_agreement']['tmp_name'], $filepath . $rental_agreement);
    //         }
    //         DB::table('smartcard')->where('id', $insertid)->update([
    //             'rental_agreement' => $rental_agreement,
    //         ]);
    //         if ($request->electricity_bill_receipt != null) {
    //             $electricity_bill_receipt = uniqid() . '.' . $request->file('electricity_bill_receipt')->extension();
    //             $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'electricity_bill_receipt' . DIRECTORY_SEPARATOR);
    //             move_uploaded_file($_FILES['electricity_bill_receipt']['tmp_name'], $filepath . $electricity_bill_receipt);
    //         }
    //         DB::table('smartcard')->where('id', $insertid)->update([
    //             'electricity_bill_receipt' => $electricity_bill_receipt,
    //         ]);
    //         if ($request->patta != null) {
    //             $patta = uniqid() . '.' . $request->file('patta')->extension();
    //             $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'patta' . DIRECTORY_SEPARATOR);
    //             move_uploaded_file($_FILES['patta']['tmp_name'], $filepath . $patta);
    //         }
    //         DB::table('smartcard')->where('id', $insertid)->update([
    //             'patta' => $patta,
    //         ]);
    //         if ($request->gas_cylinder_receipt != null) {
    //             $gas_cylinder_receipt = uniqid() . '.' . $request->file('gas_cylinder_receipt')->extension();
    //             $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'gas_cylinder_receipt' . DIRECTORY_SEPARATOR);
    //             move_uploaded_file($_FILES['gas_cylinder_receipt']['tmp_name'], $filepath . $gas_cylinder_receipt);
    //         }
    //         DB::table('smartcard')->where('id', $insertid)->update([
    //             'gas_cylinder_receipt' => $gas_cylinder_receipt,
    //         ]);
    //     }
    //     if (Auth::user()->user_type_id == 3) {
    //         $user_id = $distributor_id;
    //     } elseif (Auth::user()->user_type_id == 4) {
    //         $user_id = $retailer_id;
    //     } elseif (Auth::user()->user_type_id == 5) {
    //         $user_id = $user_id;
    //     }
    //     $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
    //     $servicename = "";
    //     if ($getservicename) {
    //         $servicename = $getservicename->service_name;
    //     }
    //     $date = date('Y-m-d');
    //     $time = date('H:i:s');
    //     $service_status = 'Out Payment';
    //     $ad_info = 'Service Payment' . ' ' . $servicename;

    //     $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
    //     $balance = 0;
    //     if ($getwallet) {
    //         $balance = $getwallet->wallet;
    //     }
    //     $newbalance = $balance + $servicepayment;
    //     $newbalance1 = Auth::user()->wallet - $servicepayment;

    //     $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
    //     DB::insert(DB::raw($sql));
    //     $sql = "update users set wallet = wallet + $servicepayment where id = 2";
    //     DB::update(DB::raw($sql));
    //     $service_status = 'IN Payment';
    //     $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
    //     DB::insert(DB::raw($sql));
    //     $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
    //     DB::update(DB::raw($sql));

    //     $getpermission = DB::table('service_payment')->where('service_id', $serviceid)->first();
    //     $coordinator_permission = 0;
    //     $admin_payment = 0;
    //     if ($getpermission) {
    //         $coordinator_permission = $getpermission->coordinator_permission;
    //         $admin_payment = $getpermission->admin_amount;
    //     }
    //     if ($coordinator_permission == 1) {
    //         $getdata = DB::table('smartcard')->where('id', $insertid)->first();
    //         if ($getdata) {
    //             $aadhaar_card = $getdata->aadhaar_card;
    //             $smart_card = $getdata->smart_card;
    //             $application_print = $getdata->application_print;
    //             $photo = $getdata->photo;
    //             $family_head_aadhaar = $getdata->family_head_aadhaar;
    //             $service_id = $getdata->service_id;
    //             $rowid = $getdata->id;
    //             $status = $getdata->status;
    //             $dist_id = $getdata->dist_id;
    //             $taluk_id = $getdata->taluk_id;
    //             $relationship = $getdata->relationship;
    //             $name_tamil = $getdata->name_tamil;
    //             $name_english = $getdata->name_english;
    //             $address_tamil_1 = $getdata->address_tamil_1;
    //             $address_english_1 = $getdata->address_english_1;
    //             $dob = $getdata->dob;
    //             $name = $getdata->name;
    //             $smartcard_number = $getdata->smartcard_number;
    //             $petition_no = $getdata->petition_no;
    //             $aadhaar_no = $getdata->aadhaar_no;
    //             $smart_mobile = $getdata->smart_mobile;
    //             $shop_number = $getdata->shop_number;
    //             $name_count = $getdata->name_count;
    //             $member_name = $getdata->member_name;
    //             $add_member = $getdata->add_member;
    //             $aadhaar2 = $getdata->aadhaar_card2;
    //             $aadhaar3 = $getdata->aadhaar_card3;
    //             $aadhaar4 = $getdata->aadhaar_card4;
    //             $aadhaar5 = $getdata->aadhaar_card5;
    //             $family_head = $getdata->family_head_photo;
    //             $mobile = $getdata->mobile;
    //             $documents = $getdata->documents;
    //             $electricity_bill = $getdata->electricity_bill_receipt;
    //             $patta = $getdata->patta;
    //             $rental_agreement = $getdata->rental_agreement;
    //             $gas_cylinder = $getdata->gas_cylinder_receipt;
    //             $application_type = $getdata->application_type;
    //             $url = url('/');
    //             $aadhaar_url = $url . '/upload/services/aadhaar_card/' . $aadhaar_card;
    //             $smartcard_url = $url . '/upload/services/smart_card/' . $smart_card;
    //             $aadhaar2_url = $url . '/upload/services/aadhaar_card2/' . $aadhaar2;
    //             $aadhaar3_url = $url . '/upload/services/aadhaar_card3/' . $aadhaar3;
    //             $aadhaar4_url = $url . '/upload/services/aadhaar_card4/' . $aadhaar4;
    //             $aadhaar5_url = $url . '/upload/services/aadhaar_card5/' . $aadhaar5;
    //             $family_head_url = $url . '/upload/services/family_head_photo/' . $family_head;
    //             $patta_url = $url . '/upload/services/patta/' . $patta;
    //             $electricity_bill_url = $url . '/upload/services/electricity_bill_receipt/' . $electricity_bill;
    //             $rental_agreement_url = $url . '/upload/services/rental_agreement/' . $rental_agreement;
    //             $gas_cylinder_url = $url . '/upload/services/gas_cylinder_receipt/' . $gas_cylinder;
    //             $application_url = $url . '/upload/services/application_print/' . $application_print;
    //             $photo_url = $url . '/upload/services/photo/' . $photo;
    //             $family_head_aadhaar_url = $url . '/upload/services/family_head_aadhaar/' . $family_head_aadhaar;
    //             $API_KEY = env('API_KEY', '');
    //             $RAMJIPAY_URL = env('RAMJIPAY_URL', '');
    //             $WEBSITE_INDEX = env('WEBSITE_INDEX', '');
    //             $totalAdminPayment = $admin_payment * $name_count;

    //             $ch = curl_init();
    //             if ($serviceid == 222) {
    //                 $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=219&rowid=$rowid&status=$status&application_type=$application_type&petition_no=$petition_no&application_print=$application_url&smartcard_number=$smartcard_number&name_count=$name_count&member_name=$member_name&admin_debit_amount=$totalAdminPayment";
    //             } elseif ($serviceid == 223) {
    //                 $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=224&rowid=$rowid&status=$status&smartcard_file=$smartcard_url&relationship=$relationship&smartcard_number=$smartcard_number";
    //             } elseif ($serviceid == 228) {
    //                 $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=225&rowid=$rowid&status=$status&smartcard_file=$smartcard_url&name_tamil=$name_tamil&name_english=$name_english&smartcard_number=$smartcard_number";
    //             } elseif ($serviceid == 231) {
    //                 $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=234&rowid=$rowid&status=$status&smartcard_file=$smartcard_url&dob=$dob&smartcard_number=$smartcard_number";
    //             } elseif ($serviceid == 232) {
    //                 $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=235&rowid=$rowid&status=$status&smartcard_file=$smartcard_url&relationship=$relationship&smartcard_number=$smartcard_number";
    //             } elseif ($serviceid == 233) {
    //                 $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&shop_number=$shop_number&service_id=236&rowid=$rowid&status=$status&smartcard_file=$smartcard_url&application_print=$application_url&smartcard_number=$smartcard_number";
    //             } elseif ($serviceid == 234) {
    //                 $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=237&rowid=$rowid&status=$status&smartcard_file=$smartcard_url&dist_id=$dist_id&taluk_id=$taluk_id&relationship=$relationship&name_tamil=$name_tamil&name_english=$name_english&dob=$dob&smartcard_number=$smartcard_number";
    //             } elseif ($serviceid == 235) {
    //                 $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=238&rowid=$rowid&status=$status&smartcard_file=$smartcard_url&relationship=$relationship&name_tamil=$name_tamil&name_english=$name_english&dob=$dob&smartcard_number=$smartcard_number&smart_mobile=$smart_mobile&aadhaar_no=$aadhaar_no";
    //             } elseif ($serviceid == 236) {
    //                 $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=245&rowid=$rowid&status=$status&smartcard_file=$smartcard_url&application_print=$application_url&shop_number=$shop_number";
    //             } elseif ($serviceid == 237) {
    //                 $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&dist_id=$dist_id&taluk_id=$taluk_id&service_id=246&rowid=$rowid&status=$status&moblie=$moblie&aadhaar_file=$aadhaar_url&aadhaar_file2=$aadhaar_url2&aadhaar_file3=$aadhaar_url3&aadhaar_file4=$aadhaar_url4&aadhaar_file5=$aadhaar_url5&patta_file=$patta_url&family_head_photo_file=$family_head_url&electricity_bill_receipt_file=$electricity_bill_url&rental_agreement_file=$rental_agreement_url&gas_cylinder_receipt_file=$gas_cylinder_url";
    //             } elseif ($serviceid == 238) {
    //                 $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&service_id=247&rowid=$rowid&status=$status&dist_id=$dist_id&taluk_id=$taluk_id&mobile=$mobile&smartcard_number=$smartcard_number";
    //             } elseif ($serviceid == 239) {
    //                 $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&service_id=248&rowid=$rowid&status=$status&mobile=$mobile&name=$name&application_print=$application_url&smartcard_number=$smartcard_number";
    //             } elseif ($serviceid == 240) {
    //                 $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&service_id=249&rowid=$rowid&status=$status&aadhaar_file=$aadhaar_url&smartcard_file=$smartcard_url&photo_file=$photo_url&smartcard_number=$smartcard_number";
    //             } elseif ($serviceid == 241) {
    //                 $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&service_id=250&rowid=$rowid&status=$status&aadhaar_file=$aadhaar_url&smartcard_file=$smartcard_url&photo_file=$photo_url&name_tamil=$name_tamil&smart_mobile=$smart_mobile&smartcard_number=$smartcard_number";
    //             } elseif ($serviceid == 242) {
    //                 $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&service_id=250&rowid=$rowid&status=$status&aadhaar_file=$aadhaar_url&smartcard_file=$smartcard_url&photo_file=$photo_url&name_tamil=$name_tamil&smart_mobile=$smart_mobile&smartcard_number=$smartcard_number";
    //             } elseif ($serviceid == 243) {
    //                 $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&service_id=252&rowid=$rowid&status=$status&application_print=$application_print&name_tamil=$name_tamil&smartcard_number=$smartcard_number";
    //             } elseif ($serviceid == 258) {
    //                 $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=294&rowid=$rowid&status=$status&smartcard_file=$smartcard_url&petition_no=$petition_no&application_print=$application_url&smartcard_number=$smartcard_number&name_count=$name_count&member_name=$member_name";
    //             }
    //             //dd($post_data);
    //             $url1 = $RAMJIPAY_URL . '/api/get_smartcard_api';
    //             //echo $url1;die;
    //             curl_setopt($ch, CURLOPT_URL, $url1);
    //             curl_setopt($ch, CURLOPT_POST, 1);
    //             curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    //             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //             $server_output = curl_exec($ch);
    //             curl_close($ch);
    //             $resdata = json_decode($server_output, true);
    //             // dd($resdata);

    //             if ($resdata) {
    //                 $status = $resdata['message'];
    //                 if ($status == "Success") {
    //                     $date = date('Y-m-d');
    //                     $time = date('H:i:s');
    //                     $service_status = 'Out Payment';
    //                     $ad_info = 'Ramji Wallet Debit' . ' ' . $servicename;
    //                     $getrawallet = DB::table('users')->select('rawallet')->where('id', 1)->first();
    //                     $rawallet = 0;
    //                     if ($getrawallet) {
    //                         $balance1 = $getrawallet->rawallet;
    //                     }

    //                     $getrawallet1 = DB::table('users')->select('rawallet')->where('id', 2)->first();
    //                     $rawallet1 = 0;
    //                     if ($getrawallet1) {
    //                         $balance2 = $getrawallet1->rawallet;
    //                     }
    //                     $newbalance2 = $balance1 + $admin_payment;
    //                     $newbalance3 = $balance2 - $admin_payment;
    //                     $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
    //                     DB::insert(DB::raw($sql));
    //                     $sql = "update users set rawallet = rawallet + $admin_payment where id = 1";
    //                     DB::update(DB::raw($sql));
    //                     $service_status = 'IN Payment';
    //                     $ad_info = 'Ramji Wallet Credit' . ' ' . $servicename;

    //                     $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
    //                     DB::insert(DB::raw($sql));
    //                     $sql = "update users set rawallet = rawallet - $admin_payment where id = 2";
    //                     DB::update(DB::raw($sql));
    //                 }
    //             }
    //         }
    //     }
    //     return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    // }


    public function submitapply_smart_nametransfer(Request $request)
{
    $user_id = 0;
    $retailer_id = 0;
    $distributor_id = 0;

    if (Auth::user()->user_type_id == 3) {
        $user_id = $request->user_id;
        $distributor_id = Auth::user()->id;
    } elseif (Auth::user()->user_type_id == 4) {
        $user_id = $request->user_id;
        $retailer_id = Auth::user()->id;
    } elseif (Auth::user()->user_type_id == 5) {
        $user_id = Auth::user()->id;
    }

    $serviceid = $request->serviceid;
    $servicepayment = 0;
    $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();

    if ($getservicepayment) {
        if (Auth::user()->user_type_id == 2) {
            $servicepayment = $getservicepayment->admin_amount;
        } elseif (Auth::user()->user_type_id == 3) {
            $servicepayment = $getservicepayment->distributor_amount;
        } elseif (Auth::user()->user_type_id == 4) {
            $servicepayment = $getservicepayment->retailer_amount;
        } elseif (Auth::user()->user_type_id == 5) {
            $servicepayment = $getservicepayment->customer_amount;
        }
    }

    // Name count பெருக்கல் - User Wallet Payment-க்கு
    $count = (int) $request->name_count;
    if ($count <= 0) {
        $count = 1;
    }

    if (in_array($serviceid, [222, 258])) {
        $servicepayment *= $count;
    }

    if (Auth::user()->wallet < $servicepayment) {
        return redirect()->back()->with('error', 'Insufficient wallet balance. Please recharge your wallet to proceed.');
    }

    $insertid = 0;

    if (in_array($serviceid, [222, 223, 228, 231, 232, 233, 234, 235, 236, 237, 238, 239, 240, 241, 242, 243, 258])) {
        $member_name = null;

        if (in_array($serviceid, [222, 258])) {
            $member_name = implode(',', $request->member_name ?? []);
        }

        $insertid = DB::table('smartcard')->insertGetId([
            'user_id'           => $user_id,
            'retailer_id'       => $retailer_id,
            'distributor_id'    => $distributor_id,
            'service_id'        => $request->serviceid,
            'amount'            => $servicepayment,
            'dist_id'           => $request->dist_id,
            'taluk_id'          => $request->taluk_id,
            'dob'               => $request->dob,
            'name'              => $request->name,
            'relationship'      => $request->relationship,
            'name_tamil'        => $request->name_tamil,
            'name_english'      => $request->name_english,
            'address_tamil_1'   => $request->address_tamil_1,
            'address_english_1' => $request->address_english_1,
            'mobile'            => $request->mobile,
            'taluk'             => $request->taluk,
            'smartcard_number'  => $request->smartcard_number,
            'petition_no'       => $request->petition_no,
            'aadhaar_no'        => $request->aadhaar_no,
            'smart_mobile'      => $request->smart_mobile,
            'name_count'        => $request->name_count,
            'member_name'       => $member_name,
            'shop_number'       => $request->shop_number,
            'application_type'  => $request->application_type,
            'status'            => 'Pending',
            'applied_date'      => date("Y-m-d"),
            'created_at'        => date("Y-m-d"),
        ]);

        $fileFields = [
            'aadhaar_card'        => 'aadhaar_card',
            'smart_card'          => 'smart_card',
            'application_print'   => 'application_print',
            'photo'               => 'photo',
            'family_head_aadhaar' => 'family_head_aadhaar'
        ];

        foreach ($fileFields as $field => $folder) {
            if ($request->hasFile($field)) {
                $filename = uniqid() . '.' . $request->file($field)->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR);
                $request->file($field)->move($filepath, $filename);
                DB::table('smartcard')->where('id', $insertid)->update([$field => $filename]);
            }
        }

    } elseif ($serviceid == 237) {
        $insertid = DB::table('smartcard')->insertGetId([
            'user_id'        => $user_id,
            'retailer_id'    => $retailer_id,
            'distributor_id' => $distributor_id,
            'service_id'     => $request->serviceid,
            'amount'         => $servicepayment,
            'dist_id'        => $request->dist_id,
            'taluk_id'       => $request->taluk_id,
            'add_member'     => $request->add_member,
            'mobile'         => $request->mobile,
            'documents'      => $request->documents,
            'status'         => 'Pending',
            'applied_date'   => date("Y-m-d"),
            'created_at'     => date("Y-m-d"),
        ]);

        $extraFiles = [
            'aadhaar_card'             => 'aadhaar_card',
            'aadhaar_card2'            => 'aadhaar_card2',
            'aadhaar_card3'            => 'aadhaar_card3',
            'aadhaar_card4'            => 'aadhaar_card4',
            'aadhaar_card5'            => 'aadhaar_card5',
            'smart_card'               => 'smart_card',
            'family_head_photo'        => 'family_head_photo',
            'rental_agreement'         => 'rental_agreement',
            'electricity_bill_receipt' => 'electricity_bill_receipt',
            'patta'                    => 'patta',
            'gas_cylinder_receipt'     => 'gas_cylinder_receipt'
        ];

        foreach ($extraFiles as $field => $folder) {
            if ($request->hasFile($field)) {
                $filename = uniqid() . '.' . $request->file($field)->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR);
                $request->file($field)->move($filepath, $filename);
                DB::table('smartcard')->where('id', $insertid)->update([$field => $filename]);
            }
        }
    }

    // User Logged-in Account ID
    $pay_user_id = Auth::user()->id;

    $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
    $servicename = $getservicename ? $getservicename->service_name : "";
    
    $date = date('Y-m-d');
    $time = date('H:i:s');
    $ad_info = 'Service Payment ' . $servicename;

    $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
    $balance = $getwallet ? $getwallet->wallet : 0;

    $newbalance_admin = $balance + $servicepayment;
    $newbalance_user = Auth::user()->wallet - $servicepayment;

    // User Wallet Debit & Admin Credit Log
    DB::table('payment')->insert([
        'log_id'         => $pay_user_id,
        'from_id'        => $pay_user_id,
        'to_id'          => '2',
        'amount'         => $servicepayment,
        'ad_info'        => $ad_info,
        'service_status' => 'Out Payment',
        'time'           => $time,
        'paydate'        => $date,
        'pay_id'         => $pay_user_id,
        'newbalance'     => $newbalance_user
    ]);

    DB::table('users')->where('id', 2)->increment('wallet', $servicepayment);

    DB::table('payment')->insert([
        'log_id'         => $pay_user_id,
        'from_id'        => '2',
        'to_id'          => $pay_user_id,
        'amount'         => $servicepayment,
        'ad_info'        => $ad_info,
        'service_status' => 'IN Payment',
        'time'           => $time,
        'paydate'        => $date,
        'pay_id'         => $pay_user_id,
        'newbalance'     => $newbalance_admin
    ]);

    DB::table('users')->where('id', $pay_user_id)->decrement('wallet', $servicepayment);

    // Coordinator & Ramji Wallet API Logic
    $getpermission = DB::table('service_payment')->where('service_id', $serviceid)->first();
    $coordinator_permission = 0;
    $admin_payment_unit = 0;

    if ($getpermission) {
        $coordinator_permission = $getpermission->coordinator_permission;
        $admin_payment_unit = $getpermission->admin_amount;
    }

    if ($coordinator_permission == 1 && $insertid > 0) {
        $getdata = DB::table('smartcard')->where('id', $insertid)->first();

        if ($getdata) {
            $url = url('/');
            $aadhaar_url           = $getdata->aadhaar_card ? $url . '/upload/services/aadhaar_card/' . $getdata->aadhaar_card : '';
            $smartcard_url         = $getdata->smart_card ? $url . '/upload/services/smart_card/' . $getdata->smart_card : '';
            $aadhaar2_url          = $getdata->aadhaar_card2 ? $url . '/upload/services/aadhaar_card2/' . $getdata->aadhaar_card2 : '';
            $aadhaar3_url          = $getdata->aadhaar_card3 ? $url . '/upload/services/aadhaar_card3/' . $getdata->aadhaar_card3 : '';
            $aadhaar4_url          = $getdata->aadhaar_card4 ? $url . '/upload/services/aadhaar_card4/' . $getdata->aadhaar_card4 : '';
            $aadhaar5_url          = $getdata->aadhaar_card5 ? $url . '/upload/services/aadhaar_card5/' . $getdata->aadhaar_card5 : '';
            $family_head_url       = $getdata->family_head_photo ? $url . '/upload/services/family_head_photo/' . $getdata->family_head_photo : '';
            $patta_url             = $getdata->patta ? $url . '/upload/services/patta/' . $getdata->patta : '';
            $electricity_bill_url = $getdata->electricity_bill_receipt ? $url . '/upload/services/electricity_bill_receipt/' . $getdata->electricity_bill_receipt : '';
            $rental_agreement_url = $getdata->rental_agreement ? $url . '/upload/services/rental_agreement/' . $getdata->rental_agreement : '';
            $gas_cylinder_url     = $getdata->gas_cylinder_receipt ? $url . '/upload/services/gas_cylinder_receipt/' . $getdata->gas_cylinder_receipt : '';
            $application_url       = $getdata->application_print ? $url . '/upload/services/application_print/' . $getdata->application_print : '';
            $photo_url             = $getdata->photo ? $url . '/upload/services/photo/' . $getdata->photo : '';

            $API_KEY       = env('API_KEY', '');
            $RAMJIPAY_URL  = env('RAMJIPAY_URL', '');
            $WEBSITE_INDEX = env('WEBSITE_INDEX', '');

            // 1. Service 222 & 258-க்கு மட்டும் name_count எடுக்கப்படும்
            // 2. மற்ற அனைத்து Service-களுக்கும் கட்டாயமாக 1 எனக் கருதப்படும் (Payment சரியாக கழியும்)
            if (in_array($serviceid, [222, 258]) && (int)$getdata->name_count > 0) {
                $actual_name_count = (int)$getdata->name_count;
            } else {
                $actual_name_count = 1;
            }

            $totalAdminPayment = $admin_payment_unit * $actual_name_count;

            $post_data = "";
            if ($serviceid == 222) {
                $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=219&rowid={$getdata->id}&status={$getdata->status}&application_type={$getdata->application_type}&petition_no={$getdata->petition_no}&application_print=$application_url&smartcard_number={$getdata->smartcard_number}&name_count={$getdata->name_count}&member_name={$getdata->member_name}&admin_debit_amount=$totalAdminPayment";
            } elseif ($serviceid == 223) {
                $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=224&rowid={$getdata->id}&status={$getdata->status}&smartcard_file=$smartcard_url&relationship={$getdata->relationship}&smartcard_number={$getdata->smartcard_number}";
            } elseif ($serviceid == 228) {
                $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=225&rowid={$getdata->id}&status={$getdata->status}&smartcard_file=$smartcard_url&name_tamil={$getdata->name_tamil}&name_english={$getdata->name_english}&smartcard_number={$getdata->smartcard_number}";
            } elseif ($serviceid == 231) {
                $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=234&rowid={$getdata->id}&status={$getdata->status}&smartcard_file=$smartcard_url&dob={$getdata->dob}&smartcard_number={$getdata->smartcard_number}";
            } elseif ($serviceid == 232) {
                $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=235&rowid={$getdata->id}&status={$getdata->status}&smartcard_file=$smartcard_url&relationship={$getdata->relationship}&smartcard_number={$getdata->smartcard_number}";
            } elseif ($serviceid == 233) {
                $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&shop_number={$getdata->shop_number}&service_id=236&rowid={$getdata->id}&status={$getdata->status}&smartcard_file=$smartcard_url&application_print=$application_url&smartcard_number={$getdata->smartcard_number}";
            } elseif ($serviceid == 234) {
                $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=237&rowid={$getdata->id}&status={$getdata->status}&smartcard_file=$smartcard_url&dist_id={$getdata->dist_id}&taluk_id={$getdata->taluk_id}&relationship={$getdata->relationship}&name_tamil={$getdata->name_tamil}&name_english={$getdata->name_english}&dob={$getdata->dob}&smartcard_number={$getdata->smartcard_number}";
            } elseif ($serviceid == 235) {
                $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=238&rowid={$getdata->id}&status={$getdata->status}&smartcard_file=$smartcard_url&relationship={$getdata->relationship}&name_tamil={$getdata->name_tamil}&name_english={$getdata->name_english}&dob={$getdata->dob}&smartcard_number={$getdata->smartcard_number}&smart_mobile={$getdata->smart_mobile}&aadhaar_no={$getdata->aadhaar_no}";
            } elseif ($serviceid == 236) {
                $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=245&rowid={$getdata->id}&status={$getdata->status}&smartcard_file=$smartcard_url&application_print=$application_url&shop_number={$getdata->shop_number}";
            } elseif ($serviceid == 237) {
                $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&dist_id={$getdata->dist_id}&taluk_id={$getdata->taluk_id}&service_id=246&rowid={$getdata->id}&status={$getdata->status}&mobile={$getdata->mobile}&aadhaar_file=$aadhaar_url&aadhaar_file2=$aadhaar2_url&aadhaar_file3=$aadhaar3_url&aadhaar_file4=$aadhaar4_url&aadhaar_file5=$aadhaar5_url&patta_file=$patta_url&family_head_photo_file=$family_head_url&electricity_bill_receipt_file=$electricity_bill_url&rental_agreement_file=$rental_agreement_url&gas_cylinder_receipt_file=$gas_cylinder_url";
            } elseif ($serviceid == 238) {
                $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&service_id=247&rowid={$getdata->id}&status={$getdata->status}&dist_id={$getdata->dist_id}&taluk_id={$getdata->taluk_id}&mobile={$getdata->mobile}&smartcard_number={$getdata->smartcard_number}";
            } elseif ($serviceid == 239) {
                $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&service_id=248&rowid={$getdata->id}&status={$getdata->status}&mobile={$getdata->mobile}&name={$getdata->name}&application_print=$application_url&smartcard_number={$getdata->smartcard_number}";
            } elseif ($serviceid == 240) {
                $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&service_id=249&rowid={$getdata->id}&status={$getdata->status}&aadhaar_file=$aadhaar_url&smartcard_file=$smartcard_url&photo_file=$photo_url&smartcard_number={$getdata->smartcard_number}";
            } elseif ($serviceid == 241) {
                $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&service_id=250&rowid={$getdata->id}&status={$getdata->status}&aadhaar_file=$aadhaar_url&smartcard_file=$smartcard_url&photo_file=$photo_url&name_tamil={$getdata->name_tamil}&smart_mobile={$getdata->smart_mobile}&smartcard_number={$getdata->smartcard_number}";
            } elseif ($serviceid == 243) {
                $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&service_id=252&rowid={$getdata->id}&status={$getdata->status}&application_print=$application_url&name_tamil={$getdata->name_tamil}&smartcard_number={$getdata->smartcard_number}";
            } elseif ($serviceid == 258) {
                $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=294&rowid={$getdata->id}&status={$getdata->status}&smartcard_file=$smartcard_url&petition_no={$getdata->petition_no}&application_print=$application_url&smartcard_number={$getdata->smartcard_number}&name_count={$getdata->name_count}&member_name={$getdata->member_name}&admin_debit_amount=$totalAdminPayment";
            }

            $ch = curl_init();
            $url1 = $RAMJIPAY_URL . '/api/get_smartcard_api';
            curl_setopt($ch, CURLOPT_URL, $url1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $server_output = curl_exec($ch);
            curl_close($ch);

            $resdata = json_decode($server_output, true);

            if ($resdata && isset($resdata['message']) && $resdata['message'] == "Success") {
                $ad_info_out = 'Ramji Wallet Debit ' . $servicename;
                $ad_info_in  = 'Ramji Wallet Credit ' . $servicename;

                $user1 = DB::table('users')->select('rawallet')->where('id', 1)->first();
                $user2 = DB::table('users')->select('rawallet')->where('id', 2)->first();

                $balance1 = $user1 ? $user1->rawallet : 0;
                $balance2 = $user2 ? $user2->rawallet : 0;

                // Admin rawallet-ல் கணக்கிடப்பட்ட மொத்தத் தொகை கழியும்
                $newbalance_user1 = $balance1 + $totalAdminPayment;
                $newbalance_user2 = $balance2 - $totalAdminPayment;

                // Ramji Payment Table Update
                DB::table('ramji_payment')->insert([
                    'log_id'         => '2',
                    'from_id'        => '1',
                    'to_id'          => '2',
                    'amount'         => $totalAdminPayment,
                    'ad_info'        => $ad_info_out,
                    'service_status' => 'Out Payment',
                    'time'           => $time,
                    'paydate'        => $date,
                    'pay_id'         => '2',
                    'newbalance'     => $newbalance_user2
                ]);

                DB::table('users')->where('id', 1)->increment('rawallet', $totalAdminPayment);

                DB::table('ramji_payment')->insert([
                    'log_id'         => '2',
                    'from_id'        => '2',
                    'to_id'          => '1',
                    'amount'         => $totalAdminPayment,
                    'ad_info'        => $ad_info_in,
                    'service_status' => 'IN Payment',
                    'time'           => $time,
                    'paydate'        => $date,
                    'pay_id'         => '2',
                    'newbalance'     => $newbalance_user1
                ]);

                DB::table('users')->where('id', 2)->decrement('rawallet', $totalAdminPayment);
            }
        }
    }

    return redirect("appliedservice/Pending")->with("success", "Application submitted successfully");
}




    public function submitapply_smartcard_correction(Request $request)
    {
        // ---------------- USER TYPE LOGIC ----------------
        $user_id        = 0;
        $retailer_id    = 0;
        $distributor_id = 0;

        $currentUserType = Auth::user()->user_type_id;

        if ($currentUserType == 3) {
            $user_id        = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif ($currentUserType == 4) {
            $user_id     = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif ($currentUserType == 5) {
            $user_id = Auth::user()->id;
        }

        $serviceid = $request->serviceid;

        // ---------------- COUNT & PAYMENT DYNAMIC CALCULATION ----------------
        $memberCount = count(array_filter($request->member_existing_name ?? []));
        $itemCount   = $request->name_count ?? ($memberCount > 0 ? $memberCount : 1);

        $unitPrice   = $request->unit_amount ?? $request->amount;
        $totalAmount = $unitPrice * $itemCount;

        // ---------------- 1. USER WALLET CHECK ----------------
        if (Auth::user()->wallet < $totalAmount) {
            return back()->with('error', 'Insufficient wallet balance. Total required: ₹' . $totalAmount);
        }
//dd($totalAmount);
        // ---------------- 2. COORDINATOR & ADMIN WALLET CHECK ----------------
        $getpermission = DB::table('service_payment')->where('service_id', $serviceid)->first();
        $coordinator_permission = $getpermission->coordinator_permission ?? 0;
        $admin_payment          = $getpermission->admin_amount ?? 0;
        $totalAdminPayment      = $admin_payment * $itemCount;
        if ($coordinator_permission == 1) {
            // Fetch rawallet balance for User ID 2 (or admin account)
            $adminRawallet = DB::table('users')->where('id', 2)->value('rawallet') ?? 0;

            if ($adminRawallet < $totalAdminPayment) {
                return back()->with('error', 'Low balance, contact admin.');
            }
        }

        // ---------------- FILE UPLOADS ----------------
        $smartCardFile = "";
        if ($request->hasFile('smartcard_file')) {
            $smartCardFile = uniqid() . '.' . $request->file('smartcard_file')->extension();
            $request->file('smartcard_file')->move(public_path('upload/services/smartcard/'), $smartCardFile);
        }

        $photoFile = "";
        if ($request->hasFile('additional_photo')) {
            $photoFile = uniqid() . '.' . $request->file('additional_photo')->extension();
            $request->file('additional_photo')->move(public_path('upload/services/photo/'), $photoFile);
        }

        // ---------------- PREPARE DYNAMIC ARRAYS ----------------
       $count = (int) $request->name_count;

$existingNamesArr = [];
$namesEnArr       = [];
$namesTaArr       = [];
$dobsArr          = [];
$gendersArr       = [];
$relationshipsArr = [];

for ($i = 0; $i < $count; $i++) {
    $existingNamesArr[] = trim($request->member_existing_name[$i] ?? '');
    $namesEnArr[]       = trim($request->member_name_en[$i] ?? '');
    $namesTaArr[]       = trim($request->member_name_ta[$i] ?? '');
    $dobsArr[]          = trim($request->dob[$i] ?? '');
    $gendersArr[]       = trim($request->gender[$i] ?? '');
    $relationshipsArr[] = trim($request->relationship[$i] ?? '');
}

$existingNames   = implode(',', $existingNamesArr);
$namesEn         = implode(',', $namesEnArr);
$namesTa         = implode(',', $namesTaArr);
$dobs            = implode(',', $dobsArr);
$genders         = implode(',', $gendersArr);
$relationships   = implode(',', $relationshipsArr);
$correctionTypes = $request->correction_categories ? implode(',', $request->correction_categories) : '';

// ---------------- TRANSACTION & INSERT ----------------
DB::beginTransaction();

try {
    $insertId = DB::table('smartcard')->insertGetId([
        'user_id'          => $user_id,
        'retailer_id'      => $retailer_id,
        'distributor_id'   => $distributor_id,
        'service_id'       => $serviceid,
        'amount'           => $totalAmount,
        'smartcard_number' => $request->smartcard_number,
        'smartcard_file'   => $smartCardFile,
        'correction_type'  => $correctionTypes,
        'name_count'       => $count,
        'existing_name'    => $existingNames,
        'member_name_en'   => $namesEn,
        'member_name_ta'   => $namesTa,
        'dob'              => $dobs,
        'gender'           => $genders,
        'relationship'     => $relationships,
        'address_english'  => $request->address_english ?? null,
        'address_tamil'    => $request->address_tamil ?? null,
        'photo'            => $photoFile,
        'status'           => 'Pending',
        'applied_date'     => now()->toDateString(),
    ]);
            // ---------------- WALLET DEDUCTION ----------------
            $logUser = Auth::user()->id;

            DB::table('users')->where('id', 2)->increment('wallet', $totalAmount);
            DB::table('users')->where('id', $logUser)->decrement('wallet', $totalAmount);

            $adminNewBalance = DB::table('users')->where('id', 2)->value('wallet');
            $userNewBalance  = DB::table('users')->where('id', $logUser)->value('wallet');

            // ---------------- PAYMENT LOGS ----------------
            $adInfo = "Smart Card Correction Payment ($itemCount member(s))";

            DB::table('payment')->insert([
                [
                    'log_id'         => $logUser,
                    'from_id'        => $logUser,
                    'to_id'          => 2,
                    'amount'         => $totalAmount,
                    'ad_info'        => $adInfo,
                    'service_status' => 'Out Payment',
                    'time'           => now()->toTimeString(),
                    'paydate'        => now()->toDateString(),
                    'pay_id'         => $logUser,
                    'newbalance'     => $userNewBalance
                ],
                [
                    'log_id'         => $logUser,
                    'from_id'        => 2,
                    'to_id'          => $logUser,
                    'amount'         => $totalAmount,
                    'ad_info'        => $adInfo,
                    'service_status' => 'IN Payment',
                    'time'           => now()->toTimeString(),
                    'paydate'        => now()->toDateString(),
                    'pay_id'         => $logUser,
                    'newbalance'     => $adminNewBalance
                ]
            ]);

            // ---------------- COORDINATOR PERMISSION & EXTERNAL API INTEGRATION ----------------
            if ($coordinator_permission == 1) {
                $API_KEY       = env('API_KEY', '');
                $RAMJIPAY_URL  = env('RAMJIPAY_URL', '');
                $WEBSITE_INDEX = env('WEBSITE_INDEX', '');

                // Prepare external API payload with all smartcard submission data
                $postFields = [
                    'key'              => $API_KEY,
                    'index'            => $WEBSITE_INDEX,
                    'rowid'            => $insertId,
                    'user_id'          => $user_id,
                    'retailer_id'      => $retailer_id,
                    'distributor_id'   => $distributor_id,
                    'service_id'       => 251,
                    'amount'           => $totalAmount,
                    'smartcard_number' => $request->smartcard_number ?? '',
                    'smartcard_file'   => !empty($smartCardFile) ? url('/upload/services/smartcard/' . $smartCardFile) : '',
                    'correction_type'  => $correctionTypes,
                    'name_count'       => $itemCount,
                    'existing_name'    => $existingNames,
                    'member_name_en'   => $namesEn,
                    'member_name_ta'   => $namesTa,
                    'dob'              => $dobs,
                    'gender'           => $genders,
                    'relationship'     => $relationships,
                    'address_english'  => $request->address_english ?? '',
                    'address_tamil'    => $request->address_tamil ?? '',
                    'photo'            => !empty($photoFile) ? url('/upload/services/photo/' . $photoFile) : '',
                    'status'           => 'Pending',
                ];

                $postData = http_build_query($postFields);

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $RAMJIPAY_URL . '/api/get_smartcardcorrection_api');
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $server_output = curl_exec($ch);
                curl_close($ch);

                $resdata = json_decode($server_output, true);

                if (isset($resdata['message']) && $resdata['message'] == "Success") {
                    $date = now()->toDateString();
                    $time = now()->toTimeString();

                    $servicename = DB::table('services')->where('id', $serviceid)->value('service_name') ?? '';

                    // Safely update rawallet balances
                    DB::table('users')->where('id', 2)->decrement('rawallet', $totalAdminPayment);
                    DB::table('users')->where('id', 1)->increment('rawallet', $totalAdminPayment);

                    $newbalance1 = DB::table('users')->where('id', 2)->value('rawallet') ?? 0;
                    $newbalance2 = DB::table('users')->where('id', 1)->value('rawallet') ?? 0;

                    // Internal Ramji Wallet Debit & Credit entries
                    DB::table('ramji_payment')->insert([
                        [
                            'log_id'         => 2,
                            'from_id'        => 1,
                            'to_id'          => 2,
                            'amount'         => $totalAdminPayment,
                            'ad_info'        => 'Ramji Wallet Debit ' . $servicename,
                            'service_status' => 'Out Payment',
                            'time'           => $time,
                            'paydate'        => $date,
                            'pay_id'         => 2,
                            'newbalance'     => $newbalance1
                        ],
                        [
                            'log_id'         => 2,
                            'from_id'        => 2,
                            'to_id'          => 1,
                            'amount'         => $totalAdminPayment,
                            'ad_info'        => 'Ramji Wallet Credit ' . $servicename,
                            'service_status' => 'IN Payment',
                            'time'           => $time,
                            'paydate'        => $date,
                            'pay_id'         => 2,
                            'newbalance'     => $newbalance2
                        ]
                    ]);
                } else {
                    DB::rollBack();
                    return back()->with('error', 'API integration error. Application failed.');
                }
            }

            DB::commit();

            return redirect("appliedservice/Pending")->with("success", "Application submitted successfully");
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('SmartCard Application Insert Error: ' . $e->getMessage());

            return back()->with('error', 'An error occurred while submitting your application.');
        }
    }

    public function submitapply_pstm(Request $request)
    {

        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
        DB::table('pstm')->insert([
            'user_id'           => $user_id,
            'retailer_id'       => $retailer_id,
            'distributor_id'    => $distributor_id,
            'service_id'        => $request->serviceid,
            'name'              => $request->name,
            'name_tamil'        => $request->name_tamil,
            'dob'               => $request->dob,
            'father_name'       => $request->father_name,
            'father_name_tamil' => $request->father_name_tamil,
            'mobile'            => $request->mobile,
            'mother_name'       => $request->mother_name,
            'mother_name_tamil'       => $request->mother_name_tamil,
            'emis_id'       => $request->emis_id,
            'academic_yr_from'       => $request->academic_yr_from,
            'class_to'       => $request->class_to,
            'school_type'       => $request->school_type,
            'academic_yr_to'       => $request->academic_yr_to,
            'dist_id'       => $request->dist_id,
            'school_name'       => $request->school_name,
            'class_from'       => $request->class_from,
            'block'       => $request->block,
            'status'            => 'Pending',
            'applied_date'      => date("Y-m-d"),
            'created_at'        => date("Y-m-d"),
        ]);

        $insertid = DB::getPdo()->lastInsertId();

        $tc = "";
        if ($request->tc != null) {
            $tc = uniqid() . '.' . $request->file('tc')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'tc' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['tc']['tmp_name'], $filepath . $tc);
        }
        DB::table('pstm')->where('id', $insertid)->update([
            'tc'         => $tc,
        ]);



        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }

    public function submitapply_employement(Request $request)
    {
        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }

        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
        if ($serviceid == 244 || $serviceid == 251 || $serviceid == 252) {
            DB::table('employment')->insert([
                'user_id'        => $user_id,
                'retailer_id'    => $retailer_id,
                'distributor_id' => $distributor_id,
                'service_id'     => $request->serviceid,
                'amount'         => $request->amount,
                'emp_reg_number' => $request->emp_reg_number,
                'aadhaar_no'     => $request->aadhaar_no,
                'name'           => $request->name,
                'dob'            => $request->dob,
                'password'            => $request->password,
                'status'         => 'Pending',
                'applied_date'   => date("Y-m-d"),
                'created_at'     => date("Y-m-d"),
            ]);
            $insertid     = DB::getPdo()->lastInsertId();
            $employment_card        = "";

            if ($request->employment_card != null) {
                $employment_card = uniqid() . '.' . $request->file('employment_card')->extension();
                $filepath     = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'employment_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['employment_card']['tmp_name'], $filepath . $employment_card);
            }
            DB::table('employment')->where('id', $insertid)->update([
                'employment_card' => $employment_card,
            ]);
        } elseif ($serviceid == 253 || $serviceid == 254) {
            DB::table('employment')->insert([
                'user_id'        => $user_id,
                'retailer_id'    => $retailer_id,
                'distributor_id' => $distributor_id,
                'service_id'     => $request->serviceid,
                'amount'         => $request->amount,
                'password' => $request->password,
                'name'           => $request->name,
                'status'         => 'Pending',
                'applied_date'   => date("Y-m-d"),
                'created_at'     => date("Y-m-d"),
            ]);

            $insertid     = DB::getPdo()->lastInsertId();

            $marksheet        = "";

            if ($request->marksheet != null) {
                $marksheet = uniqid() . '.' . $request->file('marksheet')->extension();
                $filepath     = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'marksheet' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['marksheet']['tmp_name'], $filepath . $marksheet);
            }
            DB::table('employment')->where('id', $insertid)->update([
                'marksheet' => $marksheet,
            ]);
        } elseif ($serviceid == 255) {
            DB::table('employment')->insert([
                'user_id'        => $user_id,
                'retailer_id'    => $retailer_id,
                'distributor_id' => $distributor_id,
                'service_id'     => $request->serviceid,
                'amount'         => $request->amount,
                'name'           => $request->name,
                'father_name'    => $request->father_name,
                'dob'            => $request->dob,
                'mobile'         => $request->mobile,
                'community'      => $request->community,
                'caste'          => $request->caste,
                'email'          => $request->email,
                'address'        => $request->address,
                'status'         => 'Pending',
                'applied_date'   => date("Y-m-d"),
                'created_at'     => date("Y-m-d"),
            ]);
        }

        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        $getpermission = DB::table('service_payment')->where('service_id', $serviceid)->first();
        $coordinator_permission = 0;
        $admin_payment = 0;
        if ($getpermission) {
            $coordinator_permission = $getpermission->coordinator_permission;
            $admin_payment = $getpermission->admin_amount;
        }
        if ($coordinator_permission == 1) {
            $getdata = DB::table('employment')->where('id', $insertid)->first();
            if ($getdata) {
                $employment_card    = $getdata->employment_card;
                $service_id    = $getdata->service_id;
                $rowid         = $getdata->id;
                $status        = $getdata->status;
                $name    = $getdata->name;
                $password    = $getdata->password;
                $dob    = $getdata->dob;
                $emp_reg_number    = $getdata->emp_reg_number;
                $url           = url('/');
                $employment_url = $url . '/upload/services/employment_card/' . $employment_card;
                $API_KEY       = env('API_KEY', '');
                $RAMJIPAY_URL  = env('RAMJIPAY_URL', '');
                $WEBSITE_INDEX = env('WEBSITE_INDEX', '');
                $ch            = curl_init();
                if ($serviceid == 244) {
                    $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&service_id=257&rowid=$rowid&status=$status&emp_reg_number=$emp_reg_number&employment_card=$employment_url&name=$name&dob=$dob&password=$password";
                }
                //dd($post_data);
                $url1 = $RAMJIPAY_URL . '/api/get_employment_api';
                //echo $url1;die;
                curl_setopt($ch, CURLOPT_URL, $url1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $server_output = curl_exec($ch);
                curl_close($ch);
                $resdata = json_decode($server_output, true);
                //dd($resdata);
                if ($resdata) {
                    $status = $resdata['message'];
                    if ($status == "Success") {
                        $date = date('Y-m-d');
                        $time = date('H:i:s');
                        $service_status = 'Out Payment';
                        $ad_info = 'Ramji Wallet Debit' . ' ' . $servicename;
                        $getrawallet = DB::table('users')->select('rawallet')->where('id', 1)->first();
                        $rawallet = 0;
                        if ($getrawallet) {
                            $balance1 = $getrawallet->rawallet;
                        }

                        $getrawallet1 = DB::table('users')->select('rawallet')->where('id', 2)->first();
                        $rawallet1 = 0;
                        if ($getrawallet1) {
                            $balance2 = $getrawallet1->rawallet;
                        }
                        $newbalance2 = $balance1 + $admin_payment;
                        $newbalance3 = $balance2 - $admin_payment;
                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet + $admin_payment where id = 1";
                        DB::update(DB::raw($sql));
                        $service_status = 'IN Payment';
                        $ad_info = 'Ramji Wallet Credit' . ' ' . $servicename;
                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet - $admin_payment where id = 2";
                        DB::update(DB::raw($sql));
                    }
                }
            }
        }
        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }

    public function submitapply_police(Request $request)
    {
        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }

        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
        DB::table('police_verification')->insert([
            'user_id'      => $user_id,
            'retailer_id'  => $retailer_id,
            'distributor_id'  => $distributor_id,
            'service_id'   => $request->serviceid,
            'amount'       => $request->amount,
            'name'         => $request->name,
            'mobile'   => $request->mobile,
            'father_name'   => $request->father_name,
            'emailid'   => $request->emailid,
            'address_tamil'   => $request->address_tamil,
            'address_english'   => $request->address_english,
            'pincode'   => $request->pincode,
            'dob'   => $request->dob,
            'status'       => 'Pending',
            'applied_date' => date("Y-m-d"),
            'created_at'   => date("Y-m-d"),
        ]);

        $insertid = DB::getPdo()->lastInsertId();
        $aadhaarimg = "";

        if ($request->aadhaar_card != null) {
            $aadhaarimg = uniqid() . '.' . $request->file('aadhaar_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);
        }
        DB::table('police_verification')->where('id', $insertid)->update([
            'aadhaar_card' => $aadhaarimg,
        ]);



        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }
    public function submitapply_voteridpdfdownload(Request $request)
    {
        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }

        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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

        DB::table('voteridpdf_download')->insert([
            'user_id'             => $user_id,
            'retailer_id'         => $retailer_id,
            'distributor_id'      => $distributor_id,
            'service_id'          => $request->serviceid,
            'name'                => $request->name,
            'mobile'              => $request->mobile,
            'epic_no'             => $request->epic_no,
            'status'              => 'Pending',
            'applied_date'        => date("Y-m-d"),
            'created_at'          => date("Y-m-d"),
        ]);

        $insertid = DB::getPdo()->lastInsertId();
        //  $aadhaarimg = "";

        //   if ($request->aadhaar_card != null) {
        //        $aadhaarimg = uniqid().'.'.$request->file('aadhaar_card')->extension();
        //        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
        //        move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);

        //    }
        //    DB::table('voteridpdf_download')->where('id', $insertid)->update([
        //      'aadhaar_card' => $aadhaarimg,
        //  ]);



        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        $getpermission = DB::table('service_payment')->where('service_id', $serviceid)->first();
        $coordinator_permission = 0;
        $admin_payment = 0;
        if ($getpermission) {
            $coordinator_permission = $getpermission->coordinator_permission;
            $admin_payment = $getpermission->admin_amount;
        }
        if ($coordinator_permission == 1) {
            $getdata = DB::table('voteridpdf_download')->where('id', $insertid)->first();
            if ($getdata) {
                $service_id = $getdata->service_id;
                $rowid = $getdata->id;
                $status = $getdata->status;
                $name = $getdata->name;
                $mobile = $getdata->mobile;
                $epic_no = $getdata->epic_no;
                $url = url('/');
                $API_KEY = env('API_KEY', '');
                $RAMJIPAY_URL = env('RAMJIPAY_URL', '');
                $WEBSITE_INDEX = env('WEBSITE_INDEX', '');
                $ch = curl_init();
                if ($serviceid == 69) {
                    $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&service_id=$service_id&rowid=$rowid&status=$status&name=$name&epic_no=$epic_no";
                } elseif ($serviceid == 70) {
                    $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&service_id=$service_id&rowid=$rowid&status=$status&name=$name&epic_no=$epic_no&mobile=$mobile";
                } elseif ($serviceid == 71) {
                    $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&service_id=$service_id&rowid=$rowid&status=$status&name=$name&epic_no=$epic_no&mobile=$mobile";
                }
                //dd($post_data);
                $url1 = $RAMJIPAY_URL . '/api/get_voteridpdf_download_api';
                //echo $url1;die;
                curl_setopt($ch, CURLOPT_URL, $url1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $server_output = curl_exec($ch);
                curl_close($ch);
                $resdata = json_decode($server_output, true);
                //dd($resdata);
                if ($resdata) {
                    $status = $resdata['message'];
                    if ($status == "Success") {
                        $date = date('Y-m-d');
                        $time = date('H:i:s');
                        $service_status = 'Out Payment';
                        $ad_info = 'Ramji Wallet Debit' . ' ' . $servicename;
                        $getrawallet = DB::table('users')->select('rawallet')->where('id', 1)->first();
                        $rawallet = 0;
                        if ($getrawallet) {
                            $balance1 = $getrawallet->rawallet;
                        }

                        $getrawallet1 = DB::table('users')->select('rawallet')->where('id', 2)->first();
                        $rawallet1 = 0;
                        if ($getrawallet1) {
                            $balance2 = $getrawallet1->rawallet;
                        }
                        $newbalance2 = $balance1 + $admin_payment;
                        $newbalance3 = $balance2 - $admin_payment;
                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet + $admin_payment where id = 1";
                        DB::update(DB::raw($sql));
                        $service_status = 'IN Payment';
                        $ad_info = 'Ramji Wallet Credit' . ' ' . $servicename;
                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet - $admin_payment where id = 2";
                        DB::update(DB::raw($sql));
                    }
                }
            }
        }
        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }

    public function submitapply_agri_stack(Request $request)
    {
        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }

        $serviceid = $request->serviceid;
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
        DB::table('agri_stack')->insert([
            'user_id'             => $user_id,
            'retailer_id'         => $retailer_id,
            'distributor_id'      => $distributor_id,
            'service_id'          => $request->serviceid,
            'aadhaar_no'          => $request->aadhaar_no,
            'status'              => 'Pending',
            'applied_date'        => date("Y-m-d"),
            'created_at'          => date("Y-m-d"),
        ]);

        $insertid = DB::getPdo()->lastInsertId();

        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        $getpermission = DB::table('service_payment')->where('service_id', $serviceid)->first();
        $coordinator_permission = 0;
        $admin_payment = 0;
        if ($getpermission) {
            $coordinator_permission = $getpermission->coordinator_permission;
            $admin_payment = $getpermission->admin_amount;
        }
        if ($coordinator_permission == 1) {
            $getdata = DB::table('agri_stack')->where('id', $insertid)->first();
            if ($getdata) {
                $service_id = $getdata->service_id;
                $rowid = $getdata->id;
                $status = $getdata->status;
                $aadhaar_no = $getdata->aadhaar_no;
                $url = url('/');
                $API_KEY = env('API_KEY', '');
                $RAMJIPAY_URL = env('RAMJIPAY_URL', '');
                $WEBSITE_INDEX = env('WEBSITE_INDEX', '');
                $ch = curl_init();

                $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&service_id=$service_id&rowid=$rowid&status=$status&aadhaar_no=$aadhaar_no";

                //dd($post_data);
                $url1 = $RAMJIPAY_URL . '/api/get_agristack_api';
                //echo $url1;die;
                curl_setopt($ch, CURLOPT_URL, $url1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $server_output = curl_exec($ch);
                curl_close($ch);
                $resdata = json_decode($server_output, true);
                //dd($resdata);
                if ($resdata) {
                    $status = $resdata['message'];
                    if ($status == "Success") {
                        $date = date('Y-m-d');
                        $time = date('H:i:s');
                        $service_status = 'Out Payment';
                        $ad_info = 'Ramji Wallet Debit' . ' ' . $servicename;
                        $getrawallet = DB::table('users')->select('rawallet')->where('id', 1)->first();
                        $rawallet = 0;
                        if ($getrawallet) {
                            $balance1 = $getrawallet->rawallet;
                        }

                        $getrawallet1 = DB::table('users')->select('rawallet')->where('id', 2)->first();
                        $rawallet1 = 0;
                        if ($getrawallet1) {
                            $balance2 = $getrawallet1->rawallet;
                        }
                        $newbalance2 = $balance1 + $admin_payment;
                        $newbalance3 = $balance2 - $admin_payment;
                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet + $admin_payment where id = 1";
                        DB::update(DB::raw($sql));
                        $service_status = 'IN Payment';
                        $ad_info = 'Ramji Wallet Credit' . ' ' . $servicename;
                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet - $admin_payment where id = 2";
                        DB::update(DB::raw($sql));
                    }
                }
            }
        }
        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }

    public function submitapply_smartcard_pdf(Request $request)
    {
        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }

        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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

        DB::table('smartcard_pdf')->insert([
            'user_id'             => $user_id,
            'retailer_id'         => $retailer_id,
            'distributor_id'      => $distributor_id,
            'service_id'          => $request->serviceid,
            'status'              => 'Pending',
            'applied_date'        => date("Y-m-d"),
            'created_at'          => date("Y-m-d"),
        ]);

        $insertid = DB::getPdo()->lastInsertId();
        $smartcard_onlineprint = "";
        $smartcard_back_side = "";
        $smartcard_front_side = "";

        if ($request->smartcard_onlineprint != null) {
            $smartcard_onlineprint = uniqid() . '.' . $request->file('smartcard_onlineprint')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smartcard_onlineprint' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['smartcard_onlineprint']['tmp_name'], $filepath . $smartcard_onlineprint);
        }
        DB::table('smartcard_pdf')->where('id', $insertid)->update([
            'smartcard_onlineprint' => $smartcard_onlineprint,
        ]);

        if ($request->smartcard_back_side != null) {
            $smartcard_back_side = uniqid() . '.' . $request->file('smartcard_back_side')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smartcard_back_side' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['smartcard_back_side']['tmp_name'], $filepath . $smartcard_back_side);
        }
        DB::table('smartcard_pdf')->where('id', $insertid)->update([
            'smartcard_back_side' => $smartcard_back_side,
        ]);

        if ($request->smartcard_front_side != null) {
            $smartcard_front_side = uniqid() . '.' . $request->file('smartcard_front_side')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smartcard_front_side' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['smartcard_front_side']['tmp_name'], $filepath . $smartcard_front_side);
        }
        DB::table('smartcard_pdf')->where('id', $insertid)->update([
            'smartcard_front_side' => $smartcard_front_side,
        ]);



        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        $getpermission = DB::table('service_payment')->where('service_id', $serviceid)->first();
        $coordinator_permission = 0;
        $admin_payment = 0;
        if ($getpermission) {
            $coordinator_permission = $getpermission->coordinator_permission;
            $admin_payment = $getpermission->admin_amount;
        }
        if ($coordinator_permission == 1) {
            $getdata = DB::table('smartcard_pdf')->where('id', $insertid)->first();
            if ($getdata) {
                $smartcard_onlineprint = $getdata->smartcard_onlineprint;
                $smartcard_front_side = $getdata->smartcard_front_side;
                $smartcard_back_side = $getdata->smartcard_back_side;
                $service_id = $getdata->service_id;
                $rowid = $getdata->id;
                $status = $getdata->status;
                $url = url('/');
                $smartcard_onlineprint_url = $url . '/upload/services/smartcard_onlineprint/' . $smartcard_onlineprint;
                $smartcard_front_side_url = $url . '/upload/services/smartcard_front_side/' . $smartcard_front_side;
                $smartcard_back_side_url = $url . '/upload/services/smartcard_back_side/' . $smartcard_back_side;
                $API_KEY = env('API_KEY', '');
                $RAMJIPAY_URL = env('RAMJIPAY_URL', '');
                $WEBSITE_INDEX = env('WEBSITE_INDEX', '');
                $ch = curl_init();

                $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&service_id=279&rowid=$rowid&status=$status&smartcard_onlineprint=$smartcard_onlineprint_url&smartcard_front_side=$smartcard_front_side_url&smartcard_back_side=$smartcard_back_side_url";

                //dd($post_data);
                $url1 = $RAMJIPAY_URL . '/api/get_smartcard_pdf_api';
                //echo $url1;die;
                curl_setopt($ch, CURLOPT_URL, $url1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $server_output = curl_exec($ch);
                curl_close($ch);
                $resdata = json_decode($server_output, true);
                //dd($resdata);
                if ($resdata) {
                    $status = $resdata['message'];
                    if ($status == "Success") {
                        $date = date('Y-m-d');
                        $time = date('H:i:s');
                        $service_status = 'Out Payment';
                        $ad_info = 'Ramji Wallet Debit' . ' ' . $servicename;
                        $getrawallet = DB::table('users')->select('rawallet')->where('id', 1)->first();
                        $rawallet = 0;
                        if ($getrawallet) {
                            $balance1 = $getrawallet->rawallet;
                        }

                        $getrawallet1 = DB::table('users')->select('rawallet')->where('id', 2)->first();
                        $rawallet1 = 0;
                        if ($getrawallet1) {
                            $balance2 = $getrawallet1->rawallet;
                        }
                        $newbalance2 = $balance1 + $admin_payment;
                        $newbalance3 = $balance2 - $admin_payment;
                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet + $admin_payment where id = 1";
                        DB::update(DB::raw($sql));
                        $service_status = 'IN Payment';
                        $ad_info = 'Ramji Wallet Credit' . ' ' . $servicename;
                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet - $admin_payment where id = 2";
                        DB::update(DB::raw($sql));
                    }
                }
            }
        }
        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }

    public function submitapply_manualpdf(Request $request)
    {
        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }

        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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

        DB::table('manual_pdf')->insert([
            'user_id'             => $user_id,
            'retailer_id'         => $retailer_id,
            'distributor_id'      => $distributor_id,
            'service_id'          => $request->serviceid,
            'aadhaar_no'              => $request->aadhaar_no,
            'dl_no'              => $request->dl_no,
            'rc_no'         => $request->rc_no,
            'dob'       => $request->dob,
            'mobile'       => $request->mobile,
            'smartcard_no' => $request->smartcard_no,
            'status'              => 'Pending',
            'applied_date'        => date("Y-m-d"),
            'created_at'          => date("Y-m-d"),
        ]);

        $insertid = DB::getPdo()->lastInsertId();
        $aadhaar_card = "";
        if ($request->aadhaar_card != null) {
            $aadhaar_card = uniqid() . '.' . $request->file('aadhaar_card')->extension();
            $filepath     = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
        }
        DB::table('manual_pdf')->where('id', $insertid)->update([
            'aadhaar_card' => $aadhaar_card,
        ]);

        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        $getpermission = DB::table('service_payment')->where('service_id', $serviceid)->first();
        $coordinator_permission = 0;
        $admin_payment = 0;
        if ($getpermission) {
            $coordinator_permission = $getpermission->coordinator_permission;
            $admin_payment = $getpermission->admin_amount;
        }
        if ($coordinator_permission == 1) {
            $getdata = DB::table('manual_pdf')->where('id', $insertid)->first();
            if ($getdata) {
                $service_id    = $getdata->service_id;
                $rowid         = $getdata->id;
                $status        = $getdata->status;
                $aadhaar_no    = $getdata->aadhaar_no;
                $aadhaar_card    = $getdata->aadhaar_card;
                $smartcard_no    = $getdata->smartcard_no;
                $mobile          = $getdata->mobile;
                $url           = url('/');
                $aadhaar_url = $url . '/upload/services/aadhaar_card/' . $aadhaar_card;
                $API_KEY       = env('API_KEY', '');
                $RAMJIPAY_URL  = env('RAMJIPAY_URL', '');
                $WEBSITE_INDEX = env('WEBSITE_INDEX', '');
                $ch            = curl_init();

                if ($serviceid == 250) {
                    $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&service_id=284&rowid=$rowid&status=$status&aadhaar_no=$aadhaar_no&aadhaar_card=$aadhaar_url";
                } elseif ($serviceid == 256) {
                    $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&service_id=291&rowid=$rowid&status=$status&smartcard_no=$smartcard_no&mobile=$mobile";
                } elseif ($serviceid == 257) {
                    $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&service_id=292&rowid=$rowid&status=$status&smartcard_no=$smartcard_no";
                } elseif ($serviceid == 270) {
                    $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&service_id=295&rowid=$rowid&status=$status&aadhaar_no=$aadhaar_no";
                } elseif ($serviceid == 271) {
                    $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&service_id=296&rowid=$rowid&status=$status&smartcard_no=$smartcard_no"; 
                }

                //dd($post_data);
                $url1 = $RAMJIPAY_URL . '/api/get_manualpdf_api';
                //echo $url1;die;
                curl_setopt($ch, CURLOPT_URL, $url1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $server_output = curl_exec($ch);
                curl_close($ch);
                $resdata = json_decode($server_output, true);
                //dd($resdata);
                if ($resdata) {
                    $status = $resdata['message'];
                    if ($status == "Success") {
                        $date = date('Y-m-d');
                        $time = date('H:i:s');
                        $service_status = 'Out Payment';
                        $ad_info = 'Ramji Wallet Debit' . ' ' . $servicename;
                        $getrawallet = DB::table('users')->select('rawallet')->where('id', 1)->first();
                        $rawallet = 0;
                        if ($getrawallet) {
                            $balance1 = $getrawallet->rawallet;
                        }

                        $getrawallet1 = DB::table('users')->select('rawallet')->where('id', 2)->first();
                        $rawallet1 = 0;
                        if ($getrawallet1) {
                            $balance2 = $getrawallet1->rawallet;
                        }
                        $newbalance2 = $balance1 + $admin_payment;
                        $newbalance3 = $balance2 - $admin_payment;
                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet + $admin_payment where id = 1";
                        DB::update(DB::raw($sql));
                        $service_status = 'IN Payment';
                        $ad_info = 'Ramji Wallet Credit' . ' ' . $servicename;
                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet - $admin_payment where id = 2";
                        DB::update(DB::raw($sql));
                    }
                }
            }
        }
        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }

     // <!-- New Tnega Function Code -->

        // Community Insert Function

    public function submittnegacommunity(Request $request)
    {
        //dd($user_id);
        //dd($request->all());
        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
        if ($user_id == 0) {

            $user_id = DB::table('tnega_customers')->insertGetId([
                'service_id'          => $request->serviceid,
                'user_id'             => 0,
                'name'                => $request->name,
                'name_tamil'          => $request->name_tamil,
                'aadhaar_no'          => $request->aadhaar_no,
                'mobile'              => $request->mobile,
                'can_number'          => $request->can_number,
                'dob'                 => $request->dob,
                'religion'            => $request->religion,
                'father_name_english' => $request->father_name_english,
                'mother_name_english' => $request->mother_name_english,
                'father_name_tamil'   => $request->father_name_tamil,
                'mother_name_tamil'   => $request->mother_name_tamil,
                'gender'              => $request->gender,
                'district_name'       => $request->district_name,
                'panchayath_name'     => $request->panchayath_name,
                'taluk_name'          => $request->taluk_name,
                'address'             => $request->address,
                'address_tamil'       => $request->address_tamil,
                'marital_status'      => $request->marital_status,
                'created_at'          => date('Y-m-d'),
            ]);

            DB::table('tnega_customers')
                ->where('id', $user_id)
                ->update([
                    'user_id' => $user_id
                ]);
        } else {
            DB::table('tnega_customers')->where('user_id', $user_id)->update([
                'name'                => $request->name,
                'name_tamil'          => $request->name_tamil,
                'aadhaar_no'          => $request->aadhaar_no,
                'mobile'              => $request->mobile,
                'can_number'          => $request->can_number,
                'dob'                 => $request->dob,
                'religion'            => $request->religion,
                'father_name_english' => $request->father_name_english,
                'mother_name_english' => $request->mother_name_english,
                'father_name_tamil'   => $request->father_name_tamil,
                'mother_name_tamil'   => $request->mother_name_tamil,
                'gender'              => $request->gender,
                'district_name'       => $request->district_name,
                'panchayath_name'     => $request->panchayath_name,
                'taluk_name'          => $request->taluk_name,
                'address'             => $request->address,
                'address_tamil'       => $request->address_tamil,
                'marital_status'      => $request->marital_status,

            ]);
        }

        // Second Insert Service
        DB::table('tnega_services')->insert([
            'user_id'                     => $user_id,
            'retailer_id'                 => $retailer_id,
            'distributor_id'              => $distributor_id,
            'service_id'                  => $request->serviceid,
            'amount'                      => $request->amount,
            'can_details'                 => $request->can_details,
            'personalized'                => $request->personalized,
            'relationship_1'              => $request->relationship_1,
            'relationship_2'              => $request->relationship_2,
            'relationship_3'              => $request->relationship_3,
            'education'                   => $request->education,
            'work'                        => $request->work,
            'door_no'                     => $request->door_no,
            'personalized_name_tamil'     => $request->personalized_name_tamil,
            'relationship_name_tamil_1'   => $request->relationship_name_tamil_1,
            'relationship_name_tamil_2'   => $request->relationship_name_tamil_2,
            'relationship_name_tamil_3'   => $request->relationship_name_tamil_3,
            'community'                   => $request->community,
            'smartcard_number'            => $request->smartcard_number,
            'street_name_tamil'           => $request->street_name_tamil,
            'personalized_name_english'   => $request->personalized_name_english,
            'relationship_name_english_1' => $request->relationship_name_english_1,
            'relationship_name_english_2' => $request->relationship_name_english_2,
            'relationship_name_english_3' => $request->relationship_name_english_3,
            'caste'                       => $request->caste,
            'street_name'                 => $request->street_name,
            'pin_code'                    => $request->pin_code,
            'postal_area_tamil'           => $request->postal_area_tamil,
            'postal_area_english'         => $request->postal_area_english,
            'father_community'            => $request->father_community,
            'father_caste'                => $request->father_caste,
            'mother_community'            => $request->mother_community,
            'mother_caste'                => $request->mother_caste,
            'requested_community'         => $request->requested_community,
            'requeste_caste'              => $request->requeste_caste,
            'status'                      => 'Pending',
            'applied_date'                => date('Y-m-d'),
            'created_at'                  => date('Y-m-d'),
        ]);

$insertid = DB::getPdo()->lastInsertId();

$files = [
    'address_proof' => [
        'folder' => 'address_proof',
        'compress' => true
    ],

    'signature' => [
        'folder' => 'signature',
        'compress' => true
    ],

    'photo' => [
        'folder' => 'photo',
        'resize' => true
    ]
];

$updateData = [];


/*
|--------------------------------------------------------------------------
| Community Certificate
|--------------------------------------------------------------------------
| Form has 3 different file names:
| father_community_certificate
| mother_community_certificate
| siblings_community_certificate
|
| But DB column is community_certificate
|--------------------------------------------------------------------------
*/

$communityFile = null;

if ($request->hasFile('father_community_certificate')) {

    $communityFile = $request->file('father_community_certificate');

} elseif ($request->hasFile('mother_community_certificate')) {

    $communityFile = $request->file('mother_community_certificate');

} elseif ($request->hasFile('siblings_community_certificate')) {

    $communityFile = $request->file('siblings_community_certificate');
}


if ($communityFile) {

    $extension = $communityFile->extension();

    $fileName = $insertid . '.' . $extension;

    $folderPath = public_path(
        'upload' . DIRECTORY_SEPARATOR .
        'services' . DIRECTORY_SEPARATOR .
        'community_certificate'
    );

    // Create folder if not exists
    if (!file_exists($folderPath)) {
        mkdir($folderPath, 0777, true);
    }

    // Move file
    $communityFile->move($folderPath, $fileName);

    $fullPath = $folderPath . DIRECTORY_SEPARATOR . $fileName;

    // Compress
    $this->compressFileTo200KB($fullPath, 200);

    // Save filename into DB
    $updateData['community_certificate'] = $fileName;
}


/*
|--------------------------------------------------------------------------
| Other Files
|--------------------------------------------------------------------------
*/

foreach ($files as $field => $config) {

    if ($request->hasFile($field)) {

        $extension = $request->file($field)->extension();

        $fileName = $insertid . '.' . $extension;

        $folderPath = public_path(
            'upload' . DIRECTORY_SEPARATOR .
            'services' . DIRECTORY_SEPARATOR .
            $config['folder']
        );

        // Create folder if not exists
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        $request->file($field)->move($folderPath, $fileName);

        $fullPath = $folderPath . DIRECTORY_SEPARATOR . $fileName;

        if (!empty($config['compress'])) {
            $this->compressFileTo200KB($fullPath, 200);
        }

        if (!empty($config['resize'])) {
            $this->resizeUserPhoto(
                $fullPath,
                250,
                250,
                50
            );
        }

        $updateData[$field] = $fileName;
    }
}


/*
|--------------------------------------------------------------------------
| Update DB
|--------------------------------------------------------------------------
*/

if (!empty($updateData)) {

    DB::table('tnega_services')
        ->where('id', $insertid)
        ->update($updateData);
}


        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        $getpermission = DB::table('service_payment')->where('service_id', $serviceid)->first();
        $coordinator_permission = 0;
        $admin_payment = 0;
        if ($getpermission) {
            $coordinator_permission = $getpermission->coordinator_permission;
            $admin_payment = $getpermission->admin_amount;
        }
        if ($coordinator_permission == 1) {
            $post_data = array();

            $getdata = DB::table('tnega_services')->where('id', $insertid)->get();
            $getdata = json_decode(json_encode($getdata), true);
            foreach ($getdata as $key => $ser) {
                $getdata[$key]['customer_details'] = array();
                $ser_id = $ser['id'];
                $user_id = $ser['user_id'];
                $sql = "select * from tnega_customers where user_id=$user_id";
                $result1 = DB::select($sql);
                $getdata[$key]['customer_details'] = $result1;
            }
            if (count($getdata) > 0) {

                $API_KEY = env('API_KEY', '');
                $RAMJIPAY_URL = env('RAMJIPAY_URL', '');
                $WEBSITE_INDEX = env('WEBSITE_INDEX', '');
                $post_data['data'] = $getdata;
                $post_data['key'] = $API_KEY;
                $post_data['index'] = $WEBSITE_INDEX;
                         // 250 -> 187
        if ($serviceid == 260) {
            $post_data['service_id'] = 187;
        }

                $ch = curl_init();
                //echo "<pre>";print_r($post_data);echo"</pre>";die;
                //dd(json_encode($getdata));
                // dd($post_data);
                $url1 = $RAMJIPAY_URL . '/api/get_esevai_api';
                //echo $url1;die;
                curl_setopt($ch, CURLOPT_URL, $url1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $server_output = curl_exec($ch);
                curl_close($ch);
                $resdata = json_decode($server_output, true);
                // dd($resdata);
                if ($resdata) {
                    $status = $resdata['message'];
                    if ($status == "Success") {
                        $date = date('Y-m-d');
                        $time = date('H:i:s');
                        $service_status = 'Out Payment';
                        $ad_info = 'Ramji Wallet Debit' . ' ' . $servicename;
                        $getrawallet = DB::table('users')->select('rawallet')->where('id', 1)->first();
                        $rawallet = 0;
                        if ($getrawallet) {
                            $balance1 = $getrawallet->rawallet;
                        }

                        $getrawallet1 = DB::table('users')->select('rawallet')->where('id', 2)->first();
                        $rawallet1 = 0;
                        if ($getrawallet1) {
                            $balance2 = $getrawallet1->rawallet;
                        }
                        $newbalance2 = $balance1 + $admin_payment;
                        $newbalance3 = $balance2 - $admin_payment;
                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet + $admin_payment where id = 1";
                        DB::update(DB::raw($sql));
                        $service_status = 'IN Payment';
                        $ad_info = 'Ramji Wallet Credit' . ' ' . $servicename;
                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet - $admin_payment where id = 2";
                        DB::update(DB::raw($sql));
                    }
                }
            }
        }
        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }

    // submittnegagraduate

        public function submittnegagraduate(Request $request)
    {
    //    dd($request->all(), $request->file('family_document'));
        
        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
       if (empty($request->user_id)) {

    $user_id = DB::table('tnega_customers')->insertGetId([

        'service_id'          => $request->serviceid,
        'user_id'             => 0,
        'name'                => $request->name,
        'name_tamil'          => $request->name_tamil,
        'aadhaar_no'          => $request->aadhaar_no,
        'mobile'              => $request->mobile,
        'can_number'          => $request->can_number,
        'dob'                 => $request->dob,
        'religion'            => $request->religion,
        'father_name_english' => $request->father_name_english,
        'mother_name_english' => $request->mother_name_english,
        'father_name_tamil'   => $request->father_name_tamil,
        'mother_name_tamil'   => $request->mother_name_tamil,
        'gender'              => $request->gender,
        'district_name'       => $request->district_name,
        'panchayath_name'     => $request->panchayath_name,
        'taluk_name'          => $request->taluk_name,
        'address'             => $request->address,
        'address_tamil'       => $request->address_tamil,
        'marital_status'      => $request->marital_status,
        'created_at'                  => now(),
    ]);

    DB::table('tnega_customers')
        ->where('id', $user_id)
        ->update([
            'user_id' => $user_id
        ]);

} else {

    $user_id = $request->user_id;

    DB::table('tnega_customers')
        ->where('id', $user_id)
        ->update([

            'service_id'          => $request->serviceid,
            'name'                => $request->name,
            'name_tamil'          => $request->name_tamil,
            'aadhaar_no'          => $request->aadhaar_no,
            'mobile'              => $request->mobile,
            'can_number'          => $request->can_number,
            'dob'                 => $request->dob,
            'religion'            => $request->religion,
            'father_name_english' => $request->father_name_english,
            'mother_name_english' => $request->mother_name_english,
            'father_name_tamil'   => $request->father_name_tamil,
            'mother_name_tamil'   => $request->mother_name_tamil,
            'gender'              => $request->gender,
            'district_name'       => $request->district_name,
            'panchayath_name'     => $request->panchayath_name,
            'taluk_name'          => $request->taluk_name,
            'address'             => $request->address,
            'address_tamil'       => $request->address_tamil,
            'marital_status'      => $request->marital_status,
            'created_at'                  => now(),

        ]);
}

// ==========================
// Upload Files First
// ==========================

if($request->hasFile('applicant_tc'))
{

    $file = $request->file('applicant_tc');

    $filename = time().'_'.$file->getClientOriginalName();

    $file->move(
        public_path('upload/services/applicant_tc'),
        $filename
    );

    $applicant_tc = $filename;

}
else
{
    $applicant_tc = null;
}

// ==========================
// Update Main Service
// ==========================

$insertid = DB::table('tnega_services')->insertGetId([

    'user_id'                   => $user_id,
    'retailer_id'               => $retailer_id,
    'distributor_id'            => $distributor_id,
    'service_id'                => $request->serviceid,
    'amount'                    => $request->amount,
    'course_complete'           => $request->course_complete,
    'year_of_passing'           => $request->year_of_passing,
    'current_course'            => $request->current_course,
    'current_academy_yr'        => $request->current_academy_yr,
    'institute_name_tamil'      => $request->institute_name_tamil,
    'institute_name_english'    => $request->institute_name_english,
    'institute_address_tamil'   => $request->institute_address_tamil,
    'institute_address_english' => $request->institute_address_english,
    'family_graduation'         => $request->family_graduation,
    'sibling_graduation'        => $request->sibling_graduation,
    'applicant_tc'              => $applicant_tc,
    'education' => is_array($request->education_type)
    ? ($request->education_type[0] ?? '')
    : $request->education_type,
    'status'                    => 'Pending',
    'applied_date'              => date('Y-m-d'),
]);


// ===========================================
// DELETE OLD FAMILY MEMBER RECORDS
// ===========================================

DB::table('family_member')
    ->where('service_id', $insertid)
    ->delete();
DB::table('family_member_new')
    ->where('service_id', $insertid)
    ->delete();

// ==========================
// Step 4 Family Members
// ==========================

if (!empty($request->relationship_add1)) {

    foreach ($request->relationship_add1 as $key => $relation) {

        $father_form = "";
        $education_document = "";

        $education = $request->education_type_add1[$key] ?? '';

        if ($request->hasFile('family_document') &&
            isset($request->file('family_document')[$key])) {

            $file = $request->file('family_document')[$key];

            if ($education == "Non Literate") {

                $father_form = time()."_father_".$key.".".$file->getClientOriginalExtension();

                $file->move(
                    public_path('upload/services/family'),
                    $father_form
                );

            } else {

                $education_document = time()."_education_".$key.".".$file->getClientOriginalExtension();

                $file->move(
                    public_path('upload/services/family'),
                    $education_document
                );
            }
        }

        DB::table('family_member')->insert([

            'service_id'         => $insertid,
            'user_id'            => $user_id,
            'relation'           => $relation,
            'tamil_name'         => $request->tamil_name_add1[$key],
            'english_name'       => $request->english_name_add1[$key],
            'relation_age'       => $request->age_add1[$key],
            'sex'                => $request->sex_add1[$key],
            'living_status'      => $request->livingstatus_add1[$key],
            'education'          => $education,
            'father_form'        => $father_form,
            'education_document' => $education_document,

        ]);
    }
}
/*
|--------------------------------------------------------------------------
| STEP 5 - FAMILY MEMBER NEW
|--------------------------------------------------------------------------
*/

if (!empty($request->relationship_add2)) {

    foreach ($request->relationship_add2 as $key => $relation) {

        $doc2 = [];

        /*
        |--------------------------------------------------------------------------
        | Declaration Upload
        |--------------------------------------------------------------------------
        */

        if (
            $request->hasFile('father_form_add2') &&
            isset($request->file('father_form_add2')[$key])
        ) {

            $file = $request->file('father_form_add2')[$key];

            $name = $insertid . '_declaration_' . $key . '.' . $file->getClientOriginalExtension();

            $folder = public_path('upload/services/family_declaration');

            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }

            $file->move($folder, $name);

            $doc2[] = 'family_declaration/' . $name;
        }

        /*
        |--------------------------------------------------------------------------
        | TC / Bonafide Upload
        |--------------------------------------------------------------------------
        */

        if (
            $request->hasFile('education_document_add2') &&
            isset($request->file('education_document_add2')[$key])
        ) {

            $file = $request->file('education_document_add2')[$key];

            $name = $insertid . '_tc_' . $key . '.' . $file->getClientOriginalExtension();

            $folder = public_path('upload/services/family_tc');

            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }

            $file->move($folder, $name);

            $doc2[] = 'family_tc/' . $name;
        }

        /*
        |--------------------------------------------------------------------------
        | Insert Family Member
        |--------------------------------------------------------------------------
        */

        DB::table('family_member_new')->insert([

            'service_id'     => $insertid,

            'user_id'        => $user_id,

            'relation'       => $request->relationship_add2[$key] ?? '',

            'tamil_name'     => $request->name_tamil_add2[$key] ?? '',

            'english_name'   => $request->name_english_add2[$key] ?? '',

            'relation_age'   => $request->age_add2[$key] ?? '',

            'living_status'  => $request->living_status_add2[$key] ?? '',

            'education'      => $request->education_type_add2[$key] ?? '',

            'family_count'   => $request->family_count,

            'doc'            => !empty($doc2) ? implode(',', $doc2) : '',

        ]);

    }

}
// ==========================
// Upload Documents
// ==========================

$files = [
    'address_proof' => [
        'folder' => 'address_proof',
        'compress' => true
    ],
    'community_certificate' => [
        'folder' => 'community_certificate',
        'compress' => true
    ],
    'signature' => [
        'folder' => 'signature',
        'compress' => true
    ],
    'photo' => [
        'folder' => 'photo',
        'resize' => true
    ]
];

$updateData = [];

foreach ($files as $field => $config) {

    if ($request->hasFile($field)) {

        $extension = $request->file($field)->extension();

        $fileName = $insertid . '.' . $extension;

        $folderPath = public_path(
            'upload/services/' . $config['folder']
        );

        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        $request->file($field)->move($folderPath, $fileName);

        $fullPath = $folderPath . '/' . $fileName;

        if (!empty($config['compress'])) {
            $this->compressFileTo200KB($fullPath, 200);
        }

        if (!empty($config['resize'])) {
            $this->resizeUserPhoto($fullPath, 250, 250, 50);
        }

        $updateData[$field] = $fileName;
    }
}

if (!empty($updateData)) {

    DB::table('tnega_services')
        ->where('id', $insertid)
        ->update($updateData);
}

        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        $getpermission = DB::table('service_payment')->where('service_id', $serviceid)->first();
        $coordinator_permission = 0;
        $admin_payment = 0;
        if ($getpermission) {
            $coordinator_permission = $getpermission->coordinator_permission;
            $admin_payment = $getpermission->admin_amount;
        }
        if ($coordinator_permission == 1) {
            $post_data = array();

            $getdata = DB::table('tnega_services')->where('id', $insertid)->get();
            $getdata = json_decode(json_encode($getdata), true);
            foreach ($getdata as $key => $ser) {
                $getdata[$key]['customer_details'] = array();
                $ser_id = $ser['id'];
                $user_id = $ser['user_id'];
                $sql = "select * from tnega_customers where user_id=$user_id";
                $result1 = DB::select($sql);
                $getdata[$key]['customer_details'] = $result1;

                $getdata[$key]['family_members'] = array();
                $ser_id = $ser['id'];
                $user_id = $ser['user_id'];
                $sql = "select * from family_member where user_id=$user_id";
                $result1 = DB::select($sql);
                $getdata[$key]['family_members'] = $result1;

                $getdata[$key]['family_members_new'] = array();
                $ser_id = $ser['id'];
                $user_id = $ser['user_id'];
                $sql = "select * from family_member_new where user_id=$user_id";
                $result1 = DB::select($sql);
                $getdata[$key]['family_members_new'] = $result1;
            }
            if (count($getdata) > 0) {

                $API_KEY = env('API_KEY', '');
                $RAMJIPAY_URL = env('RAMJIPAY_URL', '');
                $WEBSITE_INDEX = env('WEBSITE_INDEX', '');
                $post_data['data'] = $getdata;
                $post_data['key'] = $API_KEY;
                $post_data['index'] = $WEBSITE_INDEX;
                         // 258 -> 189
        if ($serviceid == 262) {
            $post_data['service_id'] = 189;
        }

                $ch = curl_init();
                //echo "<pre>";print_r($post_data);echo"</pre>";die;
                //dd(json_encode($getdata));
                // dd($post_data);
                $url1 = $RAMJIPAY_URL . '/api/get_graduate_api';
                //echo $url1;die;
                curl_setopt($ch, CURLOPT_URL, $url1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $server_output = curl_exec($ch);
                curl_close($ch);
                $resdata = json_decode($server_output, true);
                // dd($resdata);
                if ($resdata) {
                    $status = $resdata['message'];
                    if ($status == "Success") {
                        $date = date('Y-m-d');
                        $time = date('H:i:s');
                        $service_status = 'Out Payment';
                        $ad_info = 'Ramji Wallet Debit' . ' ' . $servicename;
                        $getrawallet = DB::table('users')->select('rawallet')->where('id', 1)->first();
                        $rawallet = 0;
                        if ($getrawallet) {
                            $balance1 = $getrawallet->rawallet;
                        }

                        $getrawallet1 = DB::table('users')->select('rawallet')->where('id', 2)->first();
                        $rawallet1 = 0;
                        if ($getrawallet1) {
                            $balance2 = $getrawallet1->rawallet;
                        }
                        $newbalance2 = $balance1 + $admin_payment;
                        $newbalance3 = $balance2 - $admin_payment;
                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet + $admin_payment where id = 1";
                        DB::update(DB::raw($sql));
                        $service_status = 'IN Payment';
                        $ad_info = 'Ramji Wallet Credit' . ' ' . $servicename;
                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet - $admin_payment where id = 2";
                        DB::update(DB::raw($sql));
                    }
                }
            }
        }
        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }

    public function submittneganativity(Request $request)
    {
        //dd($request->all());
        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
        if ($user_id == 0) {

            $user_id = DB::table('tnega_customers')->insertGetId([
                'service_id'          => $request->serviceid,
                'user_id'             => 0,
                'name'                => $request->name,
                'name_tamil'          => $request->name_tamil,
                'aadhaar_no'          => $request->aadhaar_no,
                'mobile'              => $request->mobile,
                'can_number'          => $request->can_number,
                'dob'                 => $request->dob,
                'religion'            => $request->religion,
                'father_name_english' => $request->father_name_english,
                'mother_name_english' => $request->mother_name_english,
                'father_name_tamil'   => $request->father_name_tamil,
                'mother_name_tamil'   => $request->mother_name_tamil,
                'gender'              => $request->gender,
                'district_name'       => $request->district_name,
                'panchayath_name'     => $request->panchayath_name,
                'taluk_name'          => $request->taluk_name,
                'address'             => $request->address,
                'address_tamil'       => $request->address_tamil,
                'marital_status'      => $request->marital_status,
                'created_at'          => date('Y-m-d'),
            ]);

            DB::table('tnega_customers')
                ->where('id', $user_id)
                ->update([
                    'user_id' => $user_id
                ]);
        } else {
            DB::table('tnega_customers')->where('user_id', $user_id)->update([
                'name'                => $request->name,
                'name_tamil'          => $request->name_tamil,
                'aadhaar_no'          => $request->aadhaar_no,
                'mobile'              => $request->mobile,
                'can_number'          => $request->can_number,
                'dob'                 => $request->dob,
                'religion'            => $request->religion,
                'father_name_english' => $request->father_name_english,
                'mother_name_english' => $request->mother_name_english,
                'father_name_tamil'   => $request->father_name_tamil,
                'mother_name_tamil'   => $request->mother_name_tamil,
                'gender'              => $request->gender,
                'district_name'       => $request->district_name,
                'panchayath_name'     => $request->panchayath_name,
                'taluk_name'          => $request->taluk_name,
                'address'             => $request->address,
                'address_tamil'       => $request->address_tamil,
                'marital_status'      => $request->marital_status,

            ]);
        }

        // Second Insert Service
        $insertid = DB::table('nativity')->insertGetId([
            'user_id'                     => $user_id,
            'retailer_id'                 => $retailer_id,
            'distributor_id'              => $distributor_id,
            'service_id'                  => $request->serviceid,
            'amount'                      => $request->amount,
            'address_count'               => $request->address_count,
            'nativity_type'               => $request->nativity_type,
            'door_no'                     => json_encode($request->door_no),
            'street_name'                 => json_encode($request->street_name),
            'pin_code'                    => json_encode($request->pin_code),
            'revenue_village'             => json_encode($request->revenue_village),
            'nativity_taluk'              => json_encode($request->nativity_taluk),
            'nativity_district'           => json_encode($request->nativity_district),
            'from_date'                   => json_encode($request->from_date),
            'to_date'                     => json_encode($request->to_date),
            'status'                      => 'Pending',
            'applied_date'                => date('Y-m-d'),
            'created_at'                  => date('Y-m-d'),
        ]);

        // $insertid = DB::getPdo()->lastInsertId();

        $files = [];

        if ($request->nativity_type == 'birth') {

            $files = [
                'birth_photo' => [
                    'folder' => 'photo',
                    'resize' => true,
                ],
                'birth_aadhaar_card' => [
                    'folder' => 'aadhaar_card',
                    'compress' => true,
                ],
                'birth_certificate' => [
                    'folder' => 'birth_certificate',
                    'compress' => true,
                ],
                'birth_signature' => [
                    'folder' => 'signature',
                    'compress' => true,
                ],
            ];
        } else {

            $files = [
                'photo' => [
                    'folder' => 'photo',
                    'resize' => true,
                ],
                'aadhaar_card' => [
                    'folder' => 'aadhaar_card',
                    'compress' => true,
                ],
                'resisdence_birth_certificate' => [
                    'folder' => 'birth_certificate',
                    'compress' => true,
                ],
                'signature' => [
                    'folder' => 'signature',
                    'compress' => true,
                ],
                'school_proof' => [
                    'folder' => 'school_proof',
                    'resize' => true,
                ],
            ];
        }

        $updateData = [];

        foreach ($files as $field => $config) {

            if ($request->hasFile($field)) {

                $extension = $request->file($field)->extension();
                $fileName = $insertid . '.' . $extension;

                $folderPath = public_path('upload/services/' . $config['folder']);

                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                }

                $request->file($field)->move($folderPath, $fileName);

                $fullPath = $folderPath . '/' . $fileName;

                if (!empty($config['compress'])) {
                    $this->compressFileTo200KB($fullPath, 200);
                }

                if (!empty($config['resize'])) {
                    $this->resizeUserPhoto($fullPath, 250, 250, 50);
                }

                // Database column mapping
                switch ($field) {
                    case 'birth_photo':
                        $updateData['photo'] = $fileName;
                        break;

                    case 'birth_aadhaar_card':
                        $updateData['aadhaar_card'] = $fileName;
                        break;

                    case 'birth_signature':
                        $updateData['signature'] = $fileName;
                        break;

                    case 'resisdence_birth_certificate':
                        $updateData['birth_certificate'] = $fileName;
                        break;

                    default:
                        $updateData[$field] = $fileName;
                        break;
                }
            }
        }

        if (!empty($updateData)) {
            DB::table('nativity')
                ->where('id', $insertid)
                ->update($updateData);
        }

        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        $getpermission = DB::table('service_payment')->where('service_id', $serviceid)->first();
        $coordinator_permission = 0;
        $admin_payment = 0;
        if ($getpermission) {
            $coordinator_permission = $getpermission->coordinator_permission;
            $admin_payment = $getpermission->admin_amount;
        }
        if ($coordinator_permission == 1) {
            $post_data = array();

            $getdata = DB::table('nativity')->where('id', $insertid)->get();
            $getdata = json_decode(json_encode($getdata), true);
            foreach ($getdata as $key => $ser) {
                $getdata[$key]['customer_details'] = array();
                $ser_id = $ser['id'];
                $user_id = $ser['user_id'];
                $sql = "select * from tnega_customers where user_id=$user_id";
                $result1 = DB::select($sql);
                $getdata[$key]['customer_details'] = $result1;
            }
            if (count($getdata) > 0) {

                $API_KEY = env('API_KEY', '');
                $RAMJIPAY_URL = env('RAMJIPAY_URL', '');
                $WEBSITE_INDEX = env('WEBSITE_INDEX', '');
                $post_data['data'] = $getdata;
                $post_data['key'] = $API_KEY;
                $post_data['index'] = $WEBSITE_INDEX;
                 // 259 -> 193
        if ($serviceid == 263) {
            $post_data['service_id'] = 193;
        }

                $ch = curl_init();
                //echo "<pre>";print_r($post_data);echo"</pre>";die;
                //dd(json_encode($getdata));
                //dd($post_data);
                $url1 = $RAMJIPAY_URL . '/api/get_nativity_api';
                //echo $url1;die;
                curl_setopt($ch, CURLOPT_URL, $url1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $server_output = curl_exec($ch);
                curl_close($ch);
                $resdata = json_decode($server_output, true);
                // dd($resdata);
                if ($resdata) {
                    $status = $resdata['message'];
                    if ($status == "Success") {
                        $date = date('Y-m-d');
                        $time = date('H:i:s');
                        $service_status = 'Out Payment';
                        $ad_info = 'Ramji Wallet Debit' . ' ' . $servicename;
                        $getrawallet = DB::table('users')->select('rawallet')->where('id', 1)->first();
                        $rawallet = 0;
                        if ($getrawallet) {
                            $balance1 = $getrawallet->rawallet;
                        }

                        $getrawallet1 = DB::table('users')->select('rawallet')->where('id', 2)->first();
                        $rawallet1 = 0;
                        if ($getrawallet1) {
                            $balance2 = $getrawallet1->rawallet;
                        }
                        $newbalance2 = $balance1 + $admin_payment;
                        $newbalance3 = $balance2 - $admin_payment;
                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet + $admin_payment where id = 1";
                        DB::update(DB::raw($sql));
                        $service_status = 'IN Payment';
                        $ad_info = 'Ramji Wallet Credit' . ' ' . $servicename;
                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet - $admin_payment where id = 2";
                        DB::update(DB::raw($sql));
                    }
                }
            }
        }
        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }

    public function submittnegaresidence(Request $request)
    {
        //dd($request->all());
        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
        if ($user_id == 0) {

            $user_id = DB::table('tnega_customers')->insertGetId([
                'service_id'          => $request->serviceid,
                'user_id'             => 0,
                'name'                => $request->name,
                'name_tamil'          => $request->name_tamil,
                'aadhaar_no'          => $request->aadhaar_no,
                'mobile'              => $request->mobile,
                'can_number'          => $request->can_number,
                'dob'                 => $request->dob,
                'religion'            => $request->religion,
                'father_name_english' => $request->father_name_english,
                'mother_name_english' => $request->mother_name_english,
                'father_name_tamil'   => $request->father_name_tamil,
                'mother_name_tamil'   => $request->mother_name_tamil,
                'gender'              => $request->gender,
                'district_name'       => $request->district_name,
                'panchayath_name'     => $request->panchayath_name,
                'taluk_name'          => $request->taluk_name,
                'address'             => $request->address,
                'address_tamil'       => $request->address_tamil,
                'marital_status'      => $request->marital_status,
                'created_at'          => date('Y-m-d'),
            ]);

            DB::table('tnega_customers')
                ->where('id', $user_id)
                ->update([
                    'user_id' => $user_id
                ]);
        } else {
            DB::table('tnega_customers')->where('user_id', $user_id)->update([
                'name'                => $request->name,
                'name_tamil'          => $request->name_tamil,
                'aadhaar_no'          => $request->aadhaar_no,
                'mobile'              => $request->mobile,
                'can_number'          => $request->can_number,
                'dob'                 => $request->dob,
                'religion'            => $request->religion,
                'father_name_english' => $request->father_name_english,
                'mother_name_english' => $request->mother_name_english,
                'father_name_tamil'   => $request->father_name_tamil,
                'mother_name_tamil'   => $request->mother_name_tamil,
                'gender'              => $request->gender,
                'district_name'       => $request->district_name,
                'panchayath_name'     => $request->panchayath_name,
                'taluk_name'          => $request->taluk_name,
                'address'             => $request->address,
                'address_tamil'       => $request->address_tamil,
                'marital_status'      => $request->marital_status,

            ]);
        }

        // Second Insert Service
        DB::table('tnega_residence')->insert([
            'user_id'                     => $user_id,
            'retailer_id'                 => $retailer_id,
            'distributor_id'              => $distributor_id,
            'service_id'                  => $request->serviceid,
            'amount'                      => $request->amount,
            'address_count'               => $request->address_count,
            'street_name'                 => json_encode($request->street_name),
            'pin_code'                    => json_encode($request->pin_code),
            'door_no'                     => json_encode($request->door_no),
            'revenue_village'             => json_encode($request->revenue_village),
            'nativity_taluk'              => json_encode($request->nativity_taluk),
            'nativity_district'           => json_encode($request->nativity_district),
            'from_date'                   => json_encode($request->from_date),
            'to_date'                     => json_encode($request->to_date),
            'status'                      => 'Pending',
            'applied_date'                => date('Y-m-d'),
            'created_at'                  => date('Y-m-d'),
        ]);

        $insertid = DB::getPdo()->lastInsertId();

        $files = [];

        $files = [
            'photo' => [
                'folder' => 'photo',
                'resize' => true,
            ],
            'aadhaar_card' => [
                'folder' => 'aadhaar_card',
                'compress' => true,
            ],
            'birth_certificate' => [
                'folder' => 'birth_certificate',
                'compress' => true,
            ],
            'signature' => [
                'folder' => 'signature',
                'compress' => true,
            ],
            'school_proof' => [
                'folder' => 'school_proof',
                'resize' => true,
            ],
        ];

        $updateData = [];

        foreach ($files as $field => $config) {

            if ($request->hasFile($field)) {

                $extension = $request->file($field)->extension();
                $fileName = $insertid . '.' . $extension;

                $folderPath = public_path('upload/services/' . $config['folder']);

                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                }

                $request->file($field)->move($folderPath, $fileName);

                $fullPath = $folderPath . '/' . $fileName;

                if (!empty($config['compress'])) {
                    $this->compressFileTo200KB($fullPath, 200);
                }

                if (!empty($config['resize'])) {
                    $this->resizeUserPhoto($fullPath, 250, 250, 50);
                }

                // Database column mapping
                switch ($field) {
                    case 'birth_photo':
                        $updateData['photo'] = $fileName;
                        break;

                    case 'birth_aadhaar_card':
                        $updateData['aadhaar_card'] = $fileName;
                        break;

                    case 'birth_signature':
                        $updateData['signature'] = $fileName;
                        break;

                    case 'resisdence_birth_certificate':
                        $updateData['birth_certificate'] = $fileName;
                        break;

                    default:
                        $updateData[$field] = $fileName;
                        break;
                }
            }
        }

        if (!empty($updateData)) {
            DB::table('tnega_residence')
                ->where('id', $insertid)
                ->update($updateData);
        }

        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        $getpermission = DB::table('service_payment')->where('service_id', $serviceid)->first();
        $coordinator_permission = 0;
        $admin_payment = 0;
        if ($getpermission) {
            $coordinator_permission = $getpermission->coordinator_permission;
            $admin_payment = $getpermission->admin_amount;
        }
        if ($coordinator_permission == 1) {
            $post_data = array();

            $getdata = DB::table('tnega_residence')->where('id', $insertid)->get();
            $getdata = json_decode(json_encode($getdata), true);
            foreach ($getdata as $key => $ser) {
                $getdata[$key]['customer_details'] = array();
                $ser_id = $ser['id'];
                $user_id = $ser['user_id'];
                $sql = "select * from tnega_customers where user_id=$user_id";
                $result1 = DB::select($sql);
                $getdata[$key]['customer_details'] = $result1;
            }
            if (count($getdata) > 0) {

                $API_KEY = env('API_KEY', '');
                $RAMJIPAY_URL = env('RAMJIPAY_URL', '');
                $WEBSITE_INDEX = env('WEBSITE_INDEX', '');
                $post_data['data'] = $getdata;
                $post_data['key'] = $API_KEY;
                $post_data['index'] = $WEBSITE_INDEX;
                                 // 260 -> 194
        if ($serviceid == 264) {
            $post_data['service_id'] = 194;
        }
                $ch = curl_init();
                //echo "<pre>";print_r($post_data);echo"</pre>";die;
                //dd(json_encode($getdata));
                //dd($post_data);
                $url1 = $RAMJIPAY_URL . '/api/get_residence_api';
                //echo $url1;die;
                curl_setopt($ch, CURLOPT_URL, $url1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $server_output = curl_exec($ch);
                curl_close($ch);
                $resdata = json_decode($server_output, true);
                //dd($resdata);
                if ($resdata) {
                    $status = $resdata['message'];
                    if ($status == "Success") {
                        $date = date('Y-m-d');
                        $time = date('H:i:s');
                        $service_status = 'Out Payment';
                        $ad_info = 'Ramji Wallet Debit' . ' ' . $servicename;
                        $getrawallet = DB::table('users')->select('rawallet')->where('id', 1)->first();
                        $rawallet = 0;
                        if ($getrawallet) {
                            $balance1 = $getrawallet->rawallet;
                        }

                        $getrawallet1 = DB::table('users')->select('rawallet')->where('id', 2)->first();
                        $rawallet1 = 0;
                        if ($getrawallet1) {
                            $balance2 = $getrawallet1->rawallet;
                        }
                        $newbalance2 = $balance1 + $admin_payment;
                        $newbalance3 = $balance2 - $admin_payment;
                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet + $admin_payment where id = 1";
                        DB::update(DB::raw($sql));
                        $service_status = 'IN Payment';
                        $ad_info = 'Ramji Wallet Credit' . ' ' . $servicename;
                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet - $admin_payment where id = 2";
                        DB::update(DB::raw($sql));
                    }
                }
            }
        }
        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }
    public function submittnegaunemployed(Request $request)
    {
        //dd($request->all());
        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
        if ($user_id == 0) {

            $user_id = DB::table('tnega_customers')->insertGetId([
                'service_id'          => $request->serviceid,
                'user_id'             => 0,
                'name'                => $request->name,
                'name_tamil'          => $request->name_tamil,
                'aadhaar_no'          => $request->aadhaar_no,
                'mobile'              => $request->mobile,
                'can_number'          => $request->can_number,
                'dob'                 => $request->dob,
                'religion'            => $request->religion,
                'father_name_english' => $request->father_name_english,
                'mother_name_english' => $request->mother_name_english,
                'father_name_tamil'   => $request->father_name_tamil,
                'mother_name_tamil'   => $request->mother_name_tamil,
                'gender'              => $request->gender,
                'district_name'       => $request->district_name,
                'panchayath_name'     => $request->panchayath_name,
                'taluk_name'          => $request->taluk_name,
                'address'             => $request->address,
                'address_tamil'       => $request->address_tamil,
                'marital_status'      => $request->marital_status,
                'created_at'          => date('Y-m-d'),
            ]);

            DB::table('tnega_customers')
                ->where('id', $user_id)
                ->update([
                    'user_id' => $user_id
                ]);
        } else {
            DB::table('tnega_customers')->where('user_id', $user_id)->update([
                'name'                => $request->name,
                'name_tamil'          => $request->name_tamil,
                'aadhaar_no'          => $request->aadhaar_no,
                'mobile'              => $request->mobile,
                'can_number'          => $request->can_number,
                'dob'                 => $request->dob,
                'religion'            => $request->religion,
                'father_name_english' => $request->father_name_english,
                'mother_name_english' => $request->mother_name_english,
                'father_name_tamil'   => $request->father_name_tamil,
                'mother_name_tamil'   => $request->mother_name_tamil,
                'gender'              => $request->gender,
                'district_name'       => $request->district_name,
                'panchayath_name'     => $request->panchayath_name,
                'taluk_name'          => $request->taluk_name,
                'address'             => $request->address,
                'address_tamil'       => $request->address_tamil,
                'marital_status'      => $request->marital_status,

            ]);
        }

        // Second Insert Service
        DB::table('tnega_unemployed')->insert([
            'user_id'                     => $user_id,
            'retailer_id'                 => $retailer_id,
            'distributor_id'              => $distributor_id,
            'service_id'                  => $request->serviceid,
            'amount'                      => $request->amount,
            'school_college_name'         => $request->school_college_name,
            'board_university'            => $request->board_university,
            'year_of_birth'               => $request->year_of_birth,
            'graduation'                  => $request->graduation,
            'qualification'               => $request->qualification,
            'year_of_passing'             => $request->year_of_passing,
            'from_date'                   => $request->from_date,
            'to_date'                     => $request->to_date,
            'status'                      => 'Pending',
            'applied_date'                => date('Y-m-d'),
            'created_at'                  => date('Y-m-d'),
        ]);

        $insertid = DB::getPdo()->lastInsertId();

        $files = [];

        $files = [
            'photo' => [
                'folder' => 'photo',
                'resize' => true,
            ],
            'aadhaar_card' => [
                'folder' => 'aadhaar_card',
                'compress' => true,
            ],
            'study_proof' => [
                'folder' => 'study_proof',
                'compress' => true,
            ],
            'applicant_tc' => [
                'folder' => 'applicant_tc',
                'compress' => true,
            ],
            'income_certificate' => [
                'folder' => 'income_certificate',
                'compress' => true,
            ],
            'signature' => [
                'folder' => 'signature',
                'compress' => true,
            ],
            'employment_card' => [
                'folder' => 'employment_card',
                'compress' => true,
            ],
        ];

        $updateData = [];

        foreach ($files as $field => $config) {

            if ($request->hasFile($field)) {

                $extension = $request->file($field)->extension();
                $fileName = $insertid . '.' . $extension;

                $folderPath = public_path('upload/services/' . $config['folder']);

                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                }

                $request->file($field)->move($folderPath, $fileName);

                $fullPath = $folderPath . '/' . $fileName;

                if (!empty($config['compress'])) {
                    $this->compressFileTo200KB($fullPath, 200);
                }

                if (!empty($config['resize'])) {
                    $this->resizeUserPhoto($fullPath, 250, 250, 50);
                }

                // Database column mapping
                switch ($field) {

                    case 'photo':
                        $updateData['photo'] = $fileName;
                        break;

                    case 'aadhaar_card':
                        $updateData['aadhaar_card'] = $fileName;
                        break;

                    case 'study_proof':
                        $updateData['study_proof'] = $fileName;
                        break;

                    case 'applicant_tc':
                        $updateData['applicant_tc'] = $fileName;
                        break;

                    case 'income_certificate':
                        $updateData['income_certificate'] = $fileName;
                        break;

                    case 'signature':
                        $updateData['signature'] = $fileName;
                        break;

                    case 'employment_card':
                        $updateData['employment_card'] = $fileName;
                        break;

                    default:
                        $updateData[$field] = $fileName;
                        break;
                }
            }
        }

        if (!empty($updateData)) {
            DB::table('tnega_unemployed')
                ->where('id', $insertid)
                ->update($updateData);
        }

        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        $getpermission = DB::table('service_payment')->where('service_id', $serviceid)->first();
        $coordinator_permission = 0;
        $admin_payment = 0;
        if ($getpermission) {
            $coordinator_permission = $getpermission->coordinator_permission;
            $admin_payment = $getpermission->admin_amount;
        }
        if ($coordinator_permission == 1) {
            $post_data = array();

            $getdata = DB::table('tnega_unemployed')->where('id', $insertid)->get();
            $getdata = json_decode(json_encode($getdata), true);
            foreach ($getdata as $key => $ser) {
                $getdata[$key]['customer_details'] = array();
                $ser_id = $ser['id'];
                $user_id = $ser['user_id'];
                $sql = "select * from tnega_customers where user_id=$user_id";
                $result1 = DB::select($sql);
                $getdata[$key]['customer_details'] = $result1;
            }
            if (count($getdata) > 0) {

                $API_KEY = env('API_KEY', '');
                $RAMJIPAY_URL = env('RAMJIPAY_URL', '');
                $WEBSITE_INDEX = env('WEBSITE_INDEX', '');
                $post_data['data'] = $getdata;
                $post_data['key'] = $API_KEY;
                $post_data['index'] = $WEBSITE_INDEX;
                                                 // 261 -> 195
        if ($serviceid == 265) {
            $post_data['service_id'] = 195;
        }
                $ch = curl_init();
                //echo "<pre>";print_r($post_data);echo"</pre>";die;
                //dd(json_encode($getdata));
                //dd($post_data);
                $url1 = $RAMJIPAY_URL . '/api/get_unemployed_api';
                //echo $url1;die;
                curl_setopt($ch, CURLOPT_URL, $url1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $server_output = curl_exec($ch);
                curl_close($ch);
                $resdata = json_decode($server_output, true);
                // dd($resdata);
                if ($resdata) {
                    $status = $resdata['message'];
                    if ($status == "Success") {
                        $date = date('Y-m-d');
                        $time = date('H:i:s');
                        $service_status = 'Out Payment';
                        $ad_info = 'Ramji Wallet Debit' . ' ' . $servicename;
                        $getrawallet = DB::table('users')->select('rawallet')->where('id', 1)->first();
                        $rawallet = 0;
                        if ($getrawallet) {
                            $balance1 = $getrawallet->rawallet;
                        }

                        $getrawallet1 = DB::table('users')->select('rawallet')->where('id', 2)->first();
                        $rawallet1 = 0;
                        if ($getrawallet1) {
                            $balance2 = $getrawallet1->rawallet;
                        }
                        $newbalance2 = $balance1 + $admin_payment;
                        $newbalance3 = $balance2 - $admin_payment;
                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet + $admin_payment where id = 1";
                        DB::update(DB::raw($sql));
                        $service_status = 'IN Payment';
                        $ad_info = 'Ramji Wallet Credit' . ' ' . $servicename;
                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet - $admin_payment where id = 2";
                        DB::update(DB::raw($sql));
                    }
                }
            }
        }
        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }

         public function submittnegaincome(Request $request)
    {
        //dd($request->all());
        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
        if ($user_id == 0) {

            $user_id = DB::table('tnega_customers')->insertGetId([
                'service_id'          => $request->serviceid,
                'user_id'             => 0,
                'name'                => $request->name,
                'name_tamil'          => $request->name_tamil,
                'aadhaar_no'          => $request->aadhaar_no,
                'mobile'              => $request->mobile,
                'can_number'          => $request->can_number,
                'dob'                 => $request->dob,
                'religion'            => $request->religion,
                'father_name_english' => $request->father_name_english,
                'mother_name_english' => $request->mother_name_english,
                'father_name_tamil'   => $request->father_name_tamil,
                'mother_name_tamil'   => $request->mother_name_tamil,
                'gender'              => $request->gender,
                'district_name'       => $request->district_name,
                'panchayath_name'     => $request->panchayath_name,
                'taluk_name'          => $request->taluk_name,
                'address'             => $request->address,
                'address_tamil'       => $request->address_tamil,
                'marital_status'      => $request->marital_status,
                'created_at'          => date('Y-m-d'),
            ]);

            DB::table('tnega_customers')
                ->where('id', $user_id)
                ->update([
                    'user_id' => $user_id
                ]);
        } else {
            DB::table('tnega_customers')->where('user_id', $user_id)->update([
                'name'                => $request->name,
                'name_tamil'          => $request->name_tamil,
                'aadhaar_no'          => $request->aadhaar_no,
                'mobile'              => $request->mobile,
                'can_number'          => $request->can_number,
                'dob'                 => $request->dob,
                'religion'            => $request->religion,
                'father_name_english' => $request->father_name_english,
                'mother_name_english' => $request->mother_name_english,
                'father_name_tamil'   => $request->father_name_tamil,
                'mother_name_tamil'   => $request->mother_name_tamil,
                'gender'              => $request->gender,
                'district_name'       => $request->district_name,
                'panchayath_name'     => $request->panchayath_name,
                'taluk_name'          => $request->taluk_name,
                'address'             => $request->address,
                'address_tamil'       => $request->address_tamil,
                'marital_status'      => $request->marital_status,

            ]);
        }

        $insertid = DB::table('income')->insertGetId([

            'user_id'                     => $user_id,
            'retailer_id'                 => $retailer_id,
            'distributor_id'              => $distributor_id,
            'service_id'                  => $request->serviceid,
            'amount'                      => $request->amount,
            'age'                         => $request->age,
            'sex'                         => $request->sex,
            'name_tamil'                  => $request->name_tamil,
            'name_english'                => $request->name_english,
            'profession'                  => $request->profession,
            'income_source'               => $request->income_source,
            'family_count'                => $request->family_count,
            'income'                      => $request->income,
            'tin_number'                  => $request->tin_number,
            'owned_house'                 => $request->owned_house,
            'work_tamil'                  => $request->work_tamil,
            'work_english'                => $request->work_english,
            'status'                      => 'Pending',
            'applied_date'                => date('Y-m-d'),
            'created_at'                  => now(),

        ]);

        $pancard = "";
        if ($request->pancard != null) {

            $pancard = uniqid() . "." . $request->file('pancard')->extension();

            $filepath = public_path(
                'upload' . DIRECTORY_SEPARATOR .
                    'services' . DIRECTORY_SEPARATOR .
                    'pancard' . DIRECTORY_SEPARATOR
            );

            if (!file_exists($filepath)) {
                mkdir($filepath, 0777, true);
            }

            move_uploaded_file(
                $_FILES['pancard']['tmp_name'],
                $filepath . $pancard
            );
        }
        $land_hold = "";
        if ($request->land_hold != null) {

            $land_hold = uniqid() . "." . $request->file('land_hold')->extension();

            $filepath = public_path(
                'upload' . DIRECTORY_SEPARATOR .
                    'services' . DIRECTORY_SEPARATOR .
                    'land_hold' . DIRECTORY_SEPARATOR
            );

            if (!file_exists($filepath)) {
                mkdir($filepath, 0777, true);
            }

            move_uploaded_file(
                $_FILES['land_hold']['tmp_name'],
                $filepath . $land_hold
            );
        }
        $salary_slip = "";
        if ($request->salary_slip != null) {

            $salary_slip = uniqid() . "." . $request->file('salary_slip')->extension();

            $filepath = public_path(
                'upload' . DIRECTORY_SEPARATOR .
                    'services' . DIRECTORY_SEPARATOR .
                    'salary_slip' . DIRECTORY_SEPARATOR
            );

            if (!file_exists($filepath)) {
                mkdir($filepath, 0777, true);
            }

            move_uploaded_file(
                $_FILES['salary_slip']['tmp_name'],
                $filepath . $salary_slip
            );
        }
        DB::table('income')
            ->where('id', $insertid)
            ->update([

                'pancard'     => $pancard,
                'land_hold'  => $land_hold,
                'salary_slip'  => $salary_slip,

            ]);
// ---------------------------------------------------------
// FAMILY MEMBER INSERT
// ---------------------------------------------------------

$relationships = $request->input('relation', []);

if (!is_array($relationships)) {
    $relationships = [];
}

$familyCount = (int) $request->input(
    'family_count',
    count($relationships)
);

// family_count 0 / negative என்றால் insert வேண்டாம்
if ($familyCount > 0) {

    $insertedCount = 0;

    foreach ($relationships as $key => $relation) {

        // family_count-க்கு மேல் insert ஆகக்கூடாது
        if ($insertedCount >= $familyCount) {
            break;
        }

        // -------------------------------------------------
        // Every member-ku variables reset
        // -------------------------------------------------

        $family_pan   = "";
        $incomeSource = "";
        $family_extra = "";
        $tin_number   = "";
        $owned_house  = "";
        $land_hold    = "";
        $salary_slip  = "";
        $work_tamil   = "";
        $work_english = "";


        // -------------------------------------------------
        // PAN CARD
        // -------------------------------------------------

        if (
            $request->hasFile('family_pan') &&
            isset($request->file('family_pan')[$key])
        ) {

            $file = $request->file('family_pan')[$key];

            $family_pan = uniqid() . "." .
                $file->getClientOriginalExtension();

            $destination =
                public_path('upload/services/family_pan');

            if (!file_exists($destination)) {
                mkdir($destination, 0777, true);
            }

            $file->move($destination, $family_pan);
        }


        // -------------------------------------------------
        // INCOME SOURCE
        // -------------------------------------------------

        $incomeSources = $request->input('family_income_source', []);

        if (is_array($incomeSources)) {
            $incomeSource = $incomeSources[$key] ?? '';
        }


        // -------------------------------------------------
        // INCOME SOURCE BASED DATA
        // -------------------------------------------------

        if ($incomeSource == "Agriculture and Allied") {

            if (
                $request->hasFile('family_extra') &&
                isset($request->file('family_extra')[$key])
            ) {

                $file = $request->file('family_extra')[$key];

                $land_hold = uniqid() . "." .
                    $file->getClientOriginalExtension();

                $destination =
                    public_path('upload/services/family_extra');

                if (!file_exists($destination)) {
                    mkdir($destination, 0777, true);
                }

                $file->move($destination, $land_hold);

                $family_extra = $land_hold;
            }

        } elseif ($incomeSource == "Salary") {

            if (
                $request->hasFile('family_extra') &&
                isset($request->file('family_extra')[$key])
            ) {

                $file = $request->file('family_extra')[$key];

                $salary_slip = uniqid() . "." .
                    $file->getClientOriginalExtension();

                $destination =
                    public_path('upload/services/family_salary_slip');

                if (!file_exists($destination)) {
                    mkdir($destination, 0777, true);
                }

                $file->move($destination, $salary_slip);

                $family_extra = $salary_slip;
            }

        } elseif ($incomeSource == "Business") {

            $extra = $request->input('family_extra', []);

            if (is_array($extra)) {
                $tin_number = $extra[$key] ?? '';
            }

            $family_extra = $tin_number;

        } elseif ($incomeSource == "Rent") {

            $extra = $request->input('family_extra', []);

            if (is_array($extra)) {
                $owned_house = $extra[$key] ?? '';
            }

            $family_extra = $owned_house;

        } elseif ($incomeSource == "Others") {

            $familyWorkEnglish =
                $request->input('family_work_english', []);

            $familyWorkTamil =
                $request->input('family_work_tamil', []);

            if (is_array($familyWorkEnglish)) {
                $work_english =
                    $familyWorkEnglish[$key] ?? '';
            }

            if (is_array($familyWorkTamil)) {
                $work_tamil =
                    $familyWorkTamil[$key] ?? '';
            }
        }


        // -------------------------------------------------
        // OTHER ARRAY VALUES
        // -------------------------------------------------

        $relationNameTamil =
            $request->input('relation_name_tamil', []);

        $relationName =
            $request->input('relation_name', []);

        $relationAge =
            $request->input('relation_age', []);

        $relationStatus =
            $request->input('relation_status', []);

        $familyProfession =
            $request->input('family_profession', []);

        $familyIncome = $request->input('family_income', []);

$familyIncome = array_map(function ($income) {
    return ($income === '' || $income === null) ? 0 : (int) $income;
}, $familyIncome);

        $familyPan =
            $request->input('family_pan', []);


        // -------------------------------------------------
        // INSERT
        // -------------------------------------------------

        DB::table('family_member')->insert([

            'user_id' =>
                $user_id,

            'service_id' =>
                $request->serviceid,

            'applied_service_id' =>
                $insertid,

            'relationship' =>
                $relation,

            'name_tamil' =>
                is_array($relationNameTamil)
                    ? ($relationNameTamil[$key] ?? '')
                    : '',

            'name_english' =>
                is_array($relationName)
                    ? ($relationName[$key] ?? '')
                    : '',

            'age' =>
                is_array($relationAge)
                    ? ($relationAge[$key] ?? '')
                    : '',

            'sex' =>
                is_array($relationStatus)
                    ? ($relationStatus[$key] ?? '')
                    : '',

            'profession' =>
                is_array($familyProfession)
                    ? ($familyProfession[$key] ?? '')
                    : '',

            'income_source' =>
                $incomeSource,

            'income' =>
                is_array($familyIncome)
                    ? ($familyIncome[$key] ?? '')
                    : '',

            'family_work_english' =>
                $work_english,

            'family_work_tamil' =>
                $work_tamil,

            'tin_number' =>
                $tin_number,

            'owned_house' =>
                $owned_house,

            'land_hold' =>
                $land_hold,

            'salary_slip' =>
                $salary_slip,

            'family_pan' =>
                $family_pan,

            'family_extra' =>
                $family_extra,
        ]);

        $insertedCount++;
    }
}
        //============================
        // STEP 4 DOCUMENT UPLOAD
        //============================

        $photo = "";
        if ($request->hasFile('photo')) {

            $file = $request->file('photo');

            $photo = uniqid() . "." . $file->getClientOriginalExtension();

            $path = public_path('upload/services/photo');

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $file->move($path, $photo);
        }

        $smart_card = "";
        if ($request->hasFile('smart_card')) {

            $file = $request->file('smart_card');

            $smart_card = uniqid() . "." . $file->getClientOriginalExtension();

            $path = public_path('upload/services/smart_card');

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $file->move($path, $smart_card);
        }

        $signature = "";
        if ($request->hasFile('signature')) {

            $file = $request->file('signature');

            $signature = uniqid() . "." . $file->getClientOriginalExtension();

            $path = public_path('upload/services/signature');

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $file->move($path, $signature);
        }

        $aadhaar_card = "";
        if ($request->hasFile('aadhaar_card')) {

            $file = $request->file('aadhaar_card');

            $aadhaar_card = uniqid() . "." . $file->getClientOriginalExtension();

            $path = public_path('upload/services/aadhaar_card');

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $file->move($path, $aadhaar_card);
        }

        //============================
        // UPDATE TNEGA SERVICES
        //============================

        DB::table('income')
            ->where('id', $insertid)
            ->update([
                'photo'         => $photo,
                'smart_card'    => $smart_card,
                'signature'     => $signature,
                'aadhaar_card'  => $aadhaar_card,
            ]);

        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        $getpermission = DB::table('service_payment')->where('service_id', $serviceid)->first();
        $coordinator_permission = 0;
        $admin_payment = 0;
        if ($getpermission) {
            $coordinator_permission = $getpermission->coordinator_permission;
            $admin_payment = $getpermission->admin_amount;
        }
if ($coordinator_permission == 1) {

    $post_data = array();

    $getdata = DB::table('income')
        ->where('id', $insertid)
        ->get();

    $getdata = json_decode(json_encode($getdata), true);

    foreach ($getdata as $key => $ser) {

        $getdata[$key]['customer_details'] = array();

        $ser_id = $ser['id'];
        $user_id = $ser['user_id'];

        $sql = "SELECT * FROM tnega_customers WHERE user_id=$user_id";
        $result1 = DB::select($sql);

        $getdata[$key]['customer_details'] = $result1;

        $getdata[$key]['family_members'] = array();

        $ser_id = $ser['id'];
        $user_id = $ser['user_id'];

        $sql = "SELECT * FROM family_member WHERE user_id=$user_id";
        $result1 = DB::select($sql);

        $getdata[$key]['family_members'] = $result1;
    }

    if (count($getdata) > 0) {

        $API_KEY = env('API_KEY', '');
        $RAMJIPAY_URL = env('RAMJIPAY_URL', '');
        $WEBSITE_INDEX = env('WEBSITE_INDEX', '');

        $post_data['data'] = $getdata;
        $post_data['key'] = $API_KEY;
        $post_data['index'] = $WEBSITE_INDEX;

        // 261 -> 188
        if ($serviceid == 261) {
            $post_data['service_id'] = 188;
        }

        $ch = curl_init();
                //echo "<pre>";print_r($post_data);echo"</pre>";die;
                //dd(json_encode($getdata));
                //dd($post_data);
        $url1 = $RAMJIPAY_URL . '/api/get_income_api';

        curl_setopt($ch, CURLOPT_URL, $url1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close($ch);

        $resdata = json_decode($server_output, true);
                // dd($resdata);
                if ($resdata) {
                    $status = $resdata['message'];
                    if ($status == "Success") {
                        $date = date('Y-m-d');
                        $time = date('H:i:s');
                        $service_status = 'Out Payment';
                        $ad_info = 'Ramji Wallet Debit' . ' ' . $servicename;
                        $getrawallet = DB::table('users')->select('rawallet')->where('id', 1)->first();
                        $rawallet = 0;
                        if ($getrawallet) {
                            $balance1 = $getrawallet->rawallet;
                        }

                        $getrawallet1 = DB::table('users')->select('rawallet')->where('id', 2)->first();
                        $rawallet1 = 0;
                        if ($getrawallet1) {
                            $balance2 = $getrawallet1->rawallet;
                        }
                        $newbalance2 = $balance1 + $admin_payment;
                        $newbalance3 = $balance2 - $admin_payment;
                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet + $admin_payment where id = 1";
                        DB::update(DB::raw($sql));
                        $service_status = 'IN Payment';
                        $ad_info = 'Ramji Wallet Credit' . ' ' . $servicename;
                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet - $admin_payment where id = 2";
                        DB::update(DB::raw($sql));
                    }
                }
            }
        }
        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }

    public function submittnegaobc(Request $request)
    {
        // dd($request->all());
        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
        if ($user_id == 0) {

            $user_id = DB::table('tnega_customers')->insertGetId([
                'service_id'          => $request->serviceid,
                'user_id'             => 0,
                'name'                => $request->name,
                'name_tamil'          => $request->name_tamil,
                'aadhaar_no'          => $request->aadhaar_no,
                'mobile'              => $request->mobile,
                'can_number'          => $request->can_number,
                'dob'                 => $request->dob,
                'religion'            => $request->religion,
                'father_name_english' => $request->father_name_english,
                'mother_name_english' => $request->mother_name_english,
                'father_name_tamil'   => $request->father_name_tamil,
                'mother_name_tamil'   => $request->mother_name_tamil,
                'gender'              => $request->gender,
                'district_name'       => $request->district_name,
                'panchayath_name'     => $request->panchayath_name,
                'taluk_name'          => $request->taluk_name,
                'address'             => $request->address,
                'address_tamil'       => $request->address_tamil,
                'marital_status'      => $request->marital_status,
                'created_at'          => date('Y-m-d'),
            ]);

            DB::table('tnega_customers')
                ->where('id', $user_id)
                ->update([
                    'user_id' => $user_id
                ]);
        } else {
            DB::table('tnega_customers')->where('user_id', $user_id)->update([
                'name'                => $request->name,
                'name_tamil'          => $request->name_tamil,
                'aadhaar_no'          => $request->aadhaar_no,
                'mobile'              => $request->mobile,
                'can_number'          => $request->can_number,
                'dob'                 => $request->dob,
                'religion'            => $request->religion,
                'father_name_english' => $request->father_name_english,
                'mother_name_english' => $request->mother_name_english,
                'father_name_tamil'   => $request->father_name_tamil,
                'mother_name_tamil'   => $request->mother_name_tamil,
                'gender'              => $request->gender,
                'district_name'       => $request->district_name,
                'panchayath_name'     => $request->panchayath_name,
                'taluk_name'          => $request->taluk_name,
                'address'             => $request->address,
                'address_tamil'       => $request->address_tamil,
                'marital_status'      => $request->marital_status,

            ]);
        }

        // Second Insert Service
        $insertid = DB::table('tnega_obc')->insertGetId([
            'user_id'                     => $user_id,
            'retailer_id'                 => $retailer_id,
            'distributor_id'              => $distributor_id,
            'service_id'                  => $request->serviceid,
            'amount'                      => $request->amount,
            'caste'                       => $request->caste,
            'serial_no'                   => $request->serial_no,
            'graduation'                  => $request->graduation,
            'father_alive'                => $request->father_alive,
            'tnega_religion'              => $request->tnega_religion,
            'father_occupation'                 => $request->father_occupation,
            'father_status'                     => $request->father_status,
            'father_pay_scale'                  => $request->father_pay_scale,
            'father_designation'                => $request->father_designation,
            'father_service'                    => $request->father_service,
            'pay_scale'                         => $request->pay_scale,
            'father_date_of_appointment'        => $request->father_date_of_appointment,
            'father_promotion_age'              => $request->father_promotion_age,
            'name_organization'                 => $request->name_organization,
            'service_fromdate'                  => $request->service_fromdate,
            'service_todate'                    => $request->service_todate,
            'father_death_date'                 => $request->father_death_date,
            'father_incapacitation_details'     => $request->father_incapacitation_details,
            'father_psu_appointment_date'       => $request->father_psu_appointment_date,
            'father_profession'                 => $request->father_profession,
            'father_irrigated_land'             => $request->father_irrigated_land,
            'father_irrigated_percentage'       => $request->father_irrigated_percentage,
            'father_holding_size'               => $request->father_holding_size,
            'father_conversion_formula'         => $request->father_conversion_formula,
            'father_crops_fruits'               => $request->father_crops_fruits,
            'father_area_plantation'            => $request->father_area_plantation,
            'father_unirrigated_land'           => $request->father_unirrigated_land,
            'father_location'                   => $request->father_location,
            'father_size_holding'               => $request->father_size_holding,
            'father_property_use'               => $request->father_property_use,
            'father_property_details'           => $request->father_property_details,
            'father_annual_income'              => $request->father_annual_income,
            'father_tax_payer'                  => $request->father_tax_payer,
            'father_wealth_tax'                 => $request->father_wealth_tax,
            'father_wealth_tax_details'         => $request->father_wealth_tax_details,
            'father_other_remarks'              => $request->father_other_remarks,
            'mother_wealth_tax_details'         => $request->mother_wealth_tax_details,
            'mother_alive'                      => $request->mother_alive,
            'mother_occupation'                 => $request->mother_occupation,
            'mother_status'                     => $request->mother_status,
            'mother_pay_scale'                  => $request->mother_pay_scale,
            'mother_designation'                => $request->mother_designation,
            'mother_service'                    => $request->mother_service,
            'mother_gov_designation'            => $request->mother_gov_designation,
            'mother_scale_of_pay'               => $request->mother_scale_of_pay,
            'mother_date_of_appointment'        => $request->mother_date_of_appointment,
            'mother_promotion_age'              => $request->mother_promotion_age,
            'mother_name_organization'          => $request->mother_name_organization,
            'mother_servicefromdate'            => $request->mother_servicefromdate,
            'mother_servicetodate'              => $request->mother_servicetodate,
            'mother_death_date'                 => $request->mother_death_date,
            'mother_incapacitation_details'     => $request->mother_incapacitation_details,
            'mother_psu_organisation'           => $request->mother_psu_organisation,
            'mother_psu_appointment_date'       => $request->mother_psu_appointment_date,
            'mother_profession'                 => $request->mother_profession,
            'mother_location'                   => $request->mother_location,
            'mother_irrigated_land'             => $request->mother_irrigated_land,
            'mother_irrigated_percentage'       => $request->mother_irrigated_percentage,
            'mother_holding_size'               => $request->mother_holding_size,
            'mother_conversion_formula'         => $request->mother_conversion_formula,
            'mother_crops_fruits'               => $request->mother_crops_fruits,
            'mother_area_plantation'            => $request->mother_area_plantation,
            'mother_unirrigated_land'           => $request->mother_unirrigated_land,
            'mother_property_use'               => $request->mother_property_use,
            'mother_property_details'           => $request->mother_property_details,
            'mother_annual_income'              => $request->mother_annual_income,
            'mother_tax_payer'                  => $request->mother_tax_payer,
            'mother_wealth_tax'                 => $request->mother_wealth_tax,
            'mother_wealth_tax_details'         => $request->mother_wealth_tax_details,
            'mother_other_remarks'              => $request->mother_other_remarks,
            'mother_income_proof'               => $request->mother_income_proof,
            'father_income_proof'               => $request->father_income_proof,
            'status'                            => 'Pending',
            'applied_date'                      => date('Y-m-d'),
            'created_at'                        => date('Y-m-d'),
        ]);

        // $insertid = DB::getPdo()->lastInsertId();

        $files = [];

        $files = [

            'photo' => [
                'folder' => 'photo',
                'resize' => true,
            ],

            'aadhaar_card' => [
                'folder' => 'aadhaar_card',
                'compress' => true,
            ],

            'community' => [
                'folder' => 'community_certificate',
                'compress' => true,
            ],

            'signature' => [
                'folder' => 'signature',
                'compress' => true,
            ],

            'father_income_proof_file' => [
                'folder' => 'father_income_proof_file',
                'compress' => true,
            ],

            'mother_income_proof_file' => [
                'folder' => 'mother_income_proof_file',
                'compress' => true,
            ],

        ];

        $updateData = [];

        foreach ($files as $field => $config) {

            if ($request->hasFile($field)) {

                $extension = $request->file($field)->extension();
                $fileName = $insertid . '.' . $extension;

                $folderPath = public_path('upload/services/' . $config['folder']);

                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                }

                $request->file($field)->move($folderPath, $fileName);

                $fullPath = $folderPath . '/' . $fileName;

                if (!empty($config['compress'])) {
                    $this->compressFileTo200KB($fullPath, 200);
                }

                if (!empty($config['resize'])) {
                    $this->resizeUserPhoto($fullPath, 250, 250, 50);
                }

                switch ($field) {

                    case 'photo':
                        $updateData['photo'] = $fileName;
                        break;

                    case 'aadhaar_card':
                        $updateData['aadhaar_card'] = $fileName;
                        break;

                    case 'community':
                        $updateData['community'] = $fileName;
                        break;

                    case 'signature':
                        $updateData['signature'] = $fileName;
                        break;

                    case 'father_income_proof_file':
                        $updateData['father_income_proof_file'] = $fileName;
                        break;

                    case 'mother_income_proof_file':
                        $updateData['mother_income_proof_file'] = $fileName;
                        break;

                    default:
                        $updateData[$field] = $fileName;
                        break;
                }
            }
        }

        DB::table('tnega_obc')
            ->where('id', $insertid)
            ->update($updateData);

        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        $getpermission = DB::table('service_payment')->where('service_id', $serviceid)->first();
        $coordinator_permission = 0;
        $admin_payment = 0;
        if ($getpermission) {
            $coordinator_permission = $getpermission->coordinator_permission;
            $admin_payment = $getpermission->admin_amount;
        }
        if ($coordinator_permission == 1) {
            $post_data = array();

            $getdata = DB::table('tnega_obc')->where('id', $insertid)->get();
            $getdata = json_decode(json_encode($getdata), true);
            foreach ($getdata as $key => $ser) {
                $getdata[$key]['customer_details'] = array();
                $getdata[$key]['obc_caste'] = array();
                $ser_id = $ser['id'];
                $user_id = $ser['user_id'];
                $sql = "select * from tnega_customers where user_id=$user_id";
                $result1 = DB::select($sql);
                $sql = "select * from obc_castes where service_id=$ser_id order by id Asc";
                $result2 = DB::select($sql);
                $getdata[$key]['customer_details'] = $result1;
                $getdata[$key]['obc_caste'] = $result2;
            }
            if (count($getdata) > 0) {

                $API_KEY = env('API_KEY', '');
                $RAMJIPAY_URL = env('RAMJIPAY_URL', '');
                $WEBSITE_INDEX = env('WEBSITE_INDEX', '');
                $post_data['data'] = $getdata;
                $post_data['key'] = $API_KEY;
                $post_data['index'] = $WEBSITE_INDEX;
        if ($serviceid == 266) {
            $post_data['service_id'] = 196;
        }
                $ch = curl_init();
                //echo "<pre>";print_r($post_data);echo"</pre>";die;
                //dd(json_encode($getdata));
                // dd($post_data);
                $url1 = $RAMJIPAY_URL . '/api/get_obc_api';
                //echo $url1;die;
                curl_setopt($ch, CURLOPT_URL, $url1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $server_output = curl_exec($ch);
                curl_close($ch);
                $resdata = json_decode($server_output, true);
                // dd($resdata);
                if ($resdata) {
                    $status = $resdata['message'];
                    if ($status == "Success") {
                        $date = date('Y-m-d');
                        $time = date('H:i:s');
                        $service_status = 'Out Payment';
                        $ad_info = 'Ramji Wallet Debit' . ' ' . $servicename;
                        $getrawallet = DB::table('users')->select('rawallet')->where('id', 1)->first();
                        $rawallet = 0;
                        if ($getrawallet) {
                            $balance1 = $getrawallet->rawallet;
                        }

                        $getrawallet1 = DB::table('users')->select('rawallet')->where('id', 2)->first();
                        $rawallet1 = 0;
                        if ($getrawallet1) {
                            $balance2 = $getrawallet1->rawallet;
                        }
                        $newbalance2 = $balance1 + $admin_payment;
                        $newbalance3 = $balance2 - $admin_payment;
                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet + $admin_payment where id = 1";
                        DB::update(DB::raw($sql));
                        $service_status = 'IN Payment';
                        $ad_info = 'Ramji Wallet Credit' . ' ' . $servicename;
                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet - $admin_payment where id = 2";
                        DB::update(DB::raw($sql));
                    }
                }
            }
        }
        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }

    public function submittnegaunmarried(Request $request)
    {
        //dd($request->all());
        $user_id = 0;
        $retailer_id = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid = $request->serviceid;
        $servicepayment = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
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
        if ($user_id == 0) {

            $user_id = DB::table('tnega_customers')->insertGetId([
                'service_id'          => $request->serviceid,
                'user_id'             => 0,
                'name'                => $request->name,
                'name_tamil'          => $request->name_tamil,
                'aadhaar_no'          => $request->aadhaar_no,
                'mobile'              => $request->mobile,
                'can_number'          => $request->can_number,
                'dob'                 => $request->dob,
                'religion'            => $request->religion,
                'father_name_english' => $request->father_name_english,
                'mother_name_english' => $request->mother_name_english,
                'father_name_tamil'   => $request->father_name_tamil,
                'mother_name_tamil'   => $request->mother_name_tamil,
                'gender'              => $request->gender,
                'district_name'       => $request->district_name,
                'panchayath_name'     => $request->panchayath_name,
                'taluk_name'          => $request->taluk_name,
                'address'             => $request->address,
                'address_tamil'       => $request->address_tamil,
                'marital_status'      => $request->marital_status,
                'created_at'          => date('Y-m-d'),
            ]);

            DB::table('tnega_customers')
                ->where('id', $user_id)
                ->update([
                    'user_id' => $user_id
                ]);
        } else {
            DB::table('tnega_customers')->where('user_id', $user_id)->update([
                'name'                => $request->name,
                'name_tamil'          => $request->name_tamil,
                'aadhaar_no'          => $request->aadhaar_no,
                'mobile'              => $request->mobile,
                'can_number'          => $request->can_number,
                'dob'                 => $request->dob,
                'religion'            => $request->religion,
                'father_name_english' => $request->father_name_english,
                'mother_name_english' => $request->mother_name_english,
                'father_name_tamil'   => $request->father_name_tamil,
                'mother_name_tamil'   => $request->mother_name_tamil,
                'gender'              => $request->gender,
                'district_name'       => $request->district_name,
                'panchayath_name'     => $request->panchayath_name,
                'taluk_name'          => $request->taluk_name,
                'address'             => $request->address,
                'address_tamil'       => $request->address_tamil,
                'marital_status'      => $request->marital_status,

            ]);
        }

        // Second Insert Service
        $insertid = DB::table('tnega_unmarried')->insertGetId([
            'user_id'                     => $user_id,
            'retailer_id'                 => $retailer_id,
            'distributor_id'              => $distributor_id,
            'service_id'                  => $request->serviceid,
            'amount'                      => $request->amount,
            'document_type'               => $request->document_type,
            'status'                      => 'Pending',
            'applied_date'                => date('Y-m-d'),
            'created_at'                  => date('Y-m-d'),
        ]);

        // $insertid = DB::getPdo()->lastInsertId();

        $files = [];

        $files = [
            'photo' => [
                'folder' => 'photo',
                'resize' => true,
            ],
            'aadhaar_card' => [
                'folder' => 'aadhaar_card',
                'compress' => true,
            ],
            'signature' => [
                'folder' => 'signature',
                'compress' => true,
            ],
            'applicant_tc' => [
                'folder' => 'applicant_tc',
                'compress' => true,
            ],
            'voterid' => [
                'folder' => 'voterid',
                'compress' => true,
            ],
            'birth_certificate' => [
                'folder' => 'birth_certificate',
                'compress' => true,
            ],
            'licence' => [
                'folder' => 'licence',
                'compress' => true,
            ],
            'marksheet' => [
                'folder' => 'marksheet',
                'compress' => true,
            ],
            'marriage_invitation' => [
                'folder' => 'marriage_invitation',
                'compress' => true,
            ],
        ];

        $updateData = [];

        foreach ($files as $field => $config) {

            if ($request->hasFile($field)) {

                $extension = $request->file($field)->extension();
                $fileName = $insertid . '.' . $extension;

                $folderPath = public_path('upload/services/' . $config['folder']);

                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                }

                $request->file($field)->move($folderPath, $fileName);

                $fullPath = $folderPath . '/' . $fileName;

                if (!empty($config['compress'])) {
                    $this->compressFileTo200KB($fullPath, 200);
                }

                if (!empty($config['resize'])) {
                    $this->resizeUserPhoto($fullPath, 250, 250, 50);
                }

                // Database column mapping
                switch ($field) {

                    case 'photo':
                        $updateData['photo'] = $fileName;
                        break;

                    case 'aadhaar_card':
                        $updateData['aadhaar_card'] = $fileName;
                        break;

                    case 'signature':
                        $updateData['signature'] = $fileName;
                        break;

                    case 'applicant_tc':
                        $updateData['applicant_tc'] = $fileName;
                        break;

                    case 'voterid':
                        $updateData['voterid'] = $fileName;
                        break;

                    case 'licence':
                        $updateData['licence'] = $fileName;
                        break;

                    case 'birth_certificate':
                        $updateData['birth_certificate'] = $fileName;
                        break;

                    case 'marriage_invitation':
                        $updateData['marriage_invitation'] = $fileName;
                        break;

                    case 'marksheet':
                        $updateData['marksheet'] = $fileName;
                        break;

                    default:
                        $updateData[$field] = $fileName;
                        break;
                }
            }
        }

        if (!empty($updateData)) {
            DB::table('tnega_unmarried')
                ->where('id', $insertid)
                ->update($updateData);
        }

        if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        $getpermission = DB::table('service_payment')->where('service_id', $serviceid)->first();
        $coordinator_permission = 0;
        $admin_payment = 0;
        if ($getpermission) {
            $coordinator_permission = $getpermission->coordinator_permission;
            $admin_payment = $getpermission->admin_amount;
        }
        if ($coordinator_permission == 1) {
            $post_data = array();

            $getdata = DB::table('tnega_unmarried')->where('id', $insertid)->get();
            $getdata = json_decode(json_encode($getdata), true);
            foreach ($getdata as $key => $ser) {
                $getdata[$key]['customer_details'] = array();
                $ser_id = $ser['id'];
                $user_id = $ser['user_id'];
                $sql = "select * from tnega_customers where user_id=$user_id";
                $result1 = DB::select($sql);
                $getdata[$key]['customer_details'] = $result1;
            }
            if (count($getdata) > 0) {

                $API_KEY = env('API_KEY', '');
                $RAMJIPAY_URL = env('RAMJIPAY_URL', '');
                $WEBSITE_INDEX = env('WEBSITE_INDEX', '');
                $post_data['data'] = $getdata;
                $post_data['key'] = $API_KEY;
                $post_data['index'] = $WEBSITE_INDEX;
                                        // 263 -> 197
        if ($serviceid == 267) {
            $post_data['service_id'] = 197;
        }
                $ch = curl_init();
                //echo "<pre>";print_r($post_data);echo"</pre>";die;
                //dd(json_encode($getdata));
                //dd($post_data);
                $url1 = $RAMJIPAY_URL . '/api/get_unmarried_api';
                //echo $url1;die;
                curl_setopt($ch, CURLOPT_URL, $url1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $server_output = curl_exec($ch);
                curl_close($ch);
                $resdata = json_decode($server_output, true);
                // dd($resdata);
                if ($resdata) {
                    $status = $resdata['message'];
                    if ($status == "Success") {
                        $date = date('Y-m-d');
                        $time = date('H:i:s');
                        $service_status = 'Out Payment';
                        $ad_info = 'Ramji Wallet Debit' . ' ' . $servicename;
                        $getrawallet = DB::table('users')->select('rawallet')->where('id', 1)->first();
                        $rawallet = 0;
                        if ($getrawallet) {
                            $balance1 = $getrawallet->rawallet;
                        }

                        $getrawallet1 = DB::table('users')->select('rawallet')->where('id', 2)->first();
                        $rawallet1 = 0;
                        if ($getrawallet1) {
                            $balance2 = $getrawallet1->rawallet;
                        }
                        $newbalance2 = $balance1 + $admin_payment;
                        $newbalance3 = $balance2 - $admin_payment;
                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet + $admin_payment where id = 1";
                        DB::update(DB::raw($sql));
                        $service_status = 'IN Payment';
                        $ad_info = 'Ramji Wallet Credit' . ' ' . $servicename;
                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet - $admin_payment where id = 2";
                        DB::update(DB::raw($sql));
                    }
                }
            }
        }
        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }


            // submittnegahandicap Function Start

        public function submittnegahandicap(Request $request)
    {
        // dd($request->all());
        $user_id        = 0;
        $retailer_id    = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id        = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id     = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid         = $request->serviceid;
        $servicepayment    = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
            } elseif (Auth::user()->user_type_id == 3) {
                $servicepayment = $getservicepayment->distributor_amount;
            } elseif (Auth::user()->user_type_id == 4) {
                $servicepayment = $getservicepayment->retailer_amount;
            } elseif (Auth::user()->user_type_id == 5) {
                $servicepayment = $getservicepayment->service_amount;
            }
        }
        if (Auth::user()->wallet < $servicepayment) {
            return redirect()->back()->with('error', 'Insufficient wallet balance. Please recharge your wallet to proceed.');
        } 
       if (empty($request->user_id)) {

    $user_id = DB::table('tnega_customers')->insertGetId([

        'service_id'          => $request->serviceid,
        'user_id'             => 0,
        'name'                => $request->name,
        'name_tamil'          => $request->name_tamil,
        'aadhaar_no'          => $request->aadhaar_no,
        'mobile'              => $request->mobile,
        'can_number'          => $request->can_number,
        'dob'                 => $request->dob,
        'religion'            => $request->religion,
        'father_name_english' => $request->father_name_english,
        'mother_name_english' => $request->mother_name_english,
        'father_name_tamil'   => $request->father_name_tamil,
        'mother_name_tamil'   => $request->mother_name_tamil,
        'gender'              => $request->gender,
        'district_name'       => $request->district_name,
        'panchayath_name'     => $request->panchayath_name,
        'taluk_name'          => $request->taluk_name,
        'address'             => $request->address,
        'address_tamil'       => $request->address_tamil,
        'marital_status'      => $request->marital_status,
        'created_at'                  => now(),
    ]);

    DB::table('tnega_customers')
        ->where('id', $user_id)
        ->update([
            'user_id' => $user_id
        ]);

} else {

    $user_id = $request->user_id;

    DB::table('tnega_customers')
        ->where('id', $user_id)
        ->update([

            'service_id'          => $request->serviceid,
            'name'                => $request->name,
            'name_tamil'          => $request->name_tamil,
            'aadhaar_no'          => $request->aadhaar_no,
            'mobile'              => $request->mobile,
            'can_number'          => $request->can_number,
            'dob'                 => $request->dob,
            'religion'            => $request->religion,
            'father_name_english' => $request->father_name_english,
            'mother_name_english' => $request->mother_name_english,
            'father_name_tamil'   => $request->father_name_tamil,
            'mother_name_tamil'   => $request->mother_name_tamil,
            'gender'              => $request->gender,
            'district_name'       => $request->district_name,
            'panchayath_name'     => $request->panchayath_name,
            'taluk_name'          => $request->taluk_name,
            'address'             => $request->address,
            'address_tamil'       => $request->address_tamil,
            'marital_status'      => $request->marital_status,
            'created_at'                  => now(),

        ]);
}
    // Second Insert Service
$insertid = DB::table('tnega_handicap')->insertGetId([
    'user_id'                     => $user_id,
    'retailer_id'                 => $retailer_id,
    'distributor_id'              => $distributor_id,
    'service_id'                  => $request->serviceid,
    'amount'                      => $request->amount,
    'category_disability'         => $request->category_disability,
    'differently_abled_type'      => $request->differently_abled_type,
    'nidc_disability_type'        => $request->nidc_disability_type,
    'national_idcardno'           => $request->national_idcardno,
    'id_card_type'                => $request->id_card_type,
    'temporary_valid_till'        => $request->temporary_valid_till,
    'scheme'                      => $request->scheme,
    'state_id_card'               => $request->state_id_card,
    'udid_number'                 => $request->udid_number,
    'bank_name'                   => $request->bank_name,
    'bank_district'               => $request->bank_district,
    'branch_name'                 => $request->branch_name,
    'ifsc_code'                   => $request->ifsc_code,
    'account_number'              => $request->account_number,
    'micr_number'                 => $request->micr_number,
    'percentage'                  => $request->percentage,
    'status'                      => 'Pending',
    'applied_date'                => date('Y-m-d'),
    'created_at'                  => date('Y-m-d'),
]);

        // $insertid = DB::getPdo()->lastInsertId();
           
$files = [];

$files = [
    'photo' => [
        'folder' => 'photo',
        'resize' => true,
    ],
    'aadhaar_card' => [
        'folder' => 'aadhaar_card',
        'compress' => true,
    ],
    'parent_guardian_id' => [
        'folder' => 'parent_guardian_id',
        'compress' => true,
    ],
    'bank_passbook' => [
        'folder' => 'bank_passbook',
        'compress' => true,
    ],
    'ration_card' => [
        'folder' => 'ration_card',
        'compress' => true,
    ],
    'disability_certificate' => [
        'folder' => 'disability_certificate',
        'compress' => true,
    ],
    'parent_photo' => [
        'folder' => 'parent_photo',
        'compress' => true,
    ],
    'udid' => [
        'folder' => 'udid',
        'compress' => true,
    ],
];

$updateData = [];

foreach ($files as $field => $config) {

    if ($request->hasFile($field)) {

        $extension = $request->file($field)->extension();
        $fileName = $insertid . '.' . $extension;

        $folderPath = public_path('upload/services/' . $config['folder']);

        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        $request->file($field)->move($folderPath, $fileName);

        $fullPath = $folderPath . '/' . $fileName;

        if (!empty($config['compress'])) {
            $this->compressFileTo200KB($fullPath, 200);
        }

        if (!empty($config['resize'])) {
            $this->resizeUserPhoto($fullPath, 250, 250, 50);
        }

        // Database column mapping
switch ($field) {

    case 'photo':
        $updateData['photo'] = $fileName;
        break;

    case 'aadhaar_card':
        $updateData['aadhaar_card'] = $fileName;
        break;

    case 'parent_guardian_id':
        $updateData['parent_guardian_id'] = $fileName;
        break;

    case 'bank_passbook':
        $updateData['bank_passbook'] = $fileName;
        break;

    case 'ration_card':
        $updateData['ration_card'] = $fileName;
        break;

    case 'disability_certificate':
        $updateData['disability_certificate'] = $fileName;
        break;

    case 'parent_photo':
        $updateData['parent_photo'] = $fileName;
        break;

    case 'udid':
        $updateData['udid'] = $fileName;
        break;

    default:
        $updateData[$field] = $fileName;
        break;
        }
    }
}

if (!empty($updateData)) {
    DB::table('tnega_handicap')
        ->where('id', $insertid)
        ->update($updateData);
}

if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        $getpermission = DB::table('service_payment')->where('service_id', $serviceid)->first();
        $coordinator_permission = 0;
        $admin_payment = 0;
        if ($getpermission) {
            $coordinator_permission = $getpermission->coordinator_permission;
            $admin_payment = $getpermission->admin_amount;
        }
        if ($coordinator_permission == 1) {
            $post_data = array();

            $getdata = DB::table('tnega_handicap')->where('id', $insertid)->get();
            $getdata = json_decode(json_encode($getdata), true);
            foreach ($getdata as $key => $ser) {
                $getdata[$key]['customer_details'] = array();
                $ser_id = $ser['id'];
                $user_id = $ser['user_id'];
                $sql = "select * from tnega_customers where user_id=$user_id";
                $result1 = DB::select($sql);
                $getdata[$key]['customer_details'] = $result1;
            }
            if (count($getdata) > 0) {

                $API_KEY = env('API_KEY', '');
                $RAMJIPAY_URL = env('RAMJIPAY_URL', '');
                $WEBSITE_INDEX = env('WEBSITE_INDEX', '');
                $post_data['data'] = $getdata;
                $post_data['key'] = $API_KEY;
                $post_data['index'] = $WEBSITE_INDEX;
                                        // 264 -> 198
        if ($serviceid == 268) {
            $post_data['service_id'] = 198;
        }
                $ch = curl_init();
                //echo "<pre>";print_r($post_data);echo"</pre>";die;
                //dd(json_encode($getdata));
                //dd($post_data);
                $url1 = $RAMJIPAY_URL . '/api/get_handicap_api';
                //echo $url1;die;
                curl_setopt($ch, CURLOPT_URL, $url1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $server_output = curl_exec($ch);
                curl_close($ch);
                $resdata = json_decode($server_output, true);
                // dd($resdata);
                if ($resdata) {
                    $status = $resdata['message'];
                    if ($status == "Success") {
                        $date = date('Y-m-d');
                        $time = date('H:i:s');
                        $service_status = 'Out Payment';
                        $ad_info = 'Ramji Wallet Debit' . ' ' . $servicename;
                        $getrawallet = DB::table('users')->select('rawallet')->where('id', 1)->first();
                        $rawallet = 0;
                        if ($getrawallet) {
                            $balance1 = $getrawallet->rawallet;
                        }

                        $getrawallet1 = DB::table('users')->select('rawallet')->where('id', 2)->first();
                        $rawallet1 = 0;
                        if ($getrawallet1) {
                            $balance2 = $getrawallet1->rawallet;
                        }
                        $newbalance2 = $balance1 + $admin_payment;
                        $newbalance3 = $balance2 - $admin_payment;
                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet + $admin_payment where id = 1";
                        DB::update(DB::raw($sql));
                        $service_status = 'IN Payment';
                        $ad_info = 'Ramji Wallet Credit' . ' ' . $servicename;
                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet - $admin_payment where id = 2";
                        DB::update(DB::raw($sql));
                    }
                }
            }
        }
        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }

            // submittnegawidow Function Start

        public function submittnegawidow(Request $request)
    {
        // dd($request->all());
        $user_id        = 0;
        $retailer_id    = 0;
        $distributor_id = 0;
        if (Auth::user()->user_type_id == 3) {
            $user_id        = $request->user_id;
            $distributor_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id     = $request->user_id;
            $retailer_id = Auth::user()->id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = Auth::user()->id;
        }
        $serviceid         = $request->serviceid;
        $servicepayment    = 0;
        $getservicepayment = DB::table('service_payment')->where('service_id', $serviceid)->first();
        if ($getservicepayment) {

            if (Auth::user()->user_type_id == 2) {
                $servicepayment = $getservicepayment->admin_amount;
            } elseif (Auth::user()->user_type_id == 3) {
                $servicepayment = $getservicepayment->distributor_amount;
            } elseif (Auth::user()->user_type_id == 4) {
                $servicepayment = $getservicepayment->retailer_amount;
            } elseif (Auth::user()->user_type_id == 5) {
                $servicepayment = $getservicepayment->service_amount;
            }
        }
        if (Auth::user()->wallet < $servicepayment) {
            return redirect()->back()->with('error', 'Insufficient wallet balance. Please recharge your wallet to proceed.');
        } 
       if (empty($request->user_id)) {

    $user_id = DB::table('tnega_customers')->insertGetId([

        'service_id'          => $request->serviceid,
        'user_id'             => 0,
        'name'                => $request->name,
        'name_tamil'          => $request->name_tamil,
        'aadhaar_no'          => $request->aadhaar_no,
        'mobile'              => $request->mobile,
        'can_number'          => $request->can_number,
        'dob'                 => $request->dob,
        'religion'            => $request->religion,
        'father_name_english' => $request->father_name_english,
        'mother_name_english' => $request->mother_name_english,
        'father_name_tamil'   => $request->father_name_tamil,
        'mother_name_tamil'   => $request->mother_name_tamil,
        'gender'              => $request->gender,
        'district_name'       => $request->district_name,
        'panchayath_name'     => $request->panchayath_name,
        'taluk_name'          => $request->taluk_name,
        'address'             => $request->address,
        'address_tamil'       => $request->address_tamil,
        'marital_status'      => $request->marital_status,
        'created_at'                  => now(),
    ]);

    DB::table('tnega_customers')
        ->where('id', $user_id)
        ->update([
            'user_id' => $user_id
        ]);

} else {

    $user_id = $request->user_id;

    DB::table('tnega_customers')
        ->where('id', $user_id)
        ->update([

            'service_id'          => $request->serviceid,
            'name'                => $request->name,
            'name_tamil'          => $request->name_tamil,
            'aadhaar_no'          => $request->aadhaar_no,
            'mobile'              => $request->mobile,
            'can_number'          => $request->can_number,
            'dob'                 => $request->dob,
            'religion'            => $request->religion,
            'father_name_english' => $request->father_name_english,
            'mother_name_english' => $request->mother_name_english,
            'father_name_tamil'   => $request->father_name_tamil,
            'mother_name_tamil'   => $request->mother_name_tamil,
            'gender'              => $request->gender,
            'district_name'       => $request->district_name,
            'panchayath_name'     => $request->panchayath_name,
            'taluk_name'          => $request->taluk_name,
            'address'             => $request->address,
            'address_tamil'       => $request->address_tamil,
            'marital_status'      => $request->marital_status,
            'created_at'                  => now(),

        ]);
}
    // Second Insert Service
$insertid = DB::table('tnega_widow')->insertGetId([
    'user_id'                     => $user_id,
    'retailer_id'                 => $retailer_id,
    'distributor_id'              => $distributor_id,
    'service_id'                  => $request->serviceid,
    'amount'                      => $request->amount,
    'relationship'                => $request->relationship,
    'guardian_name'               => $request->guardian_name,
    'guardian_name_tamil'         => $request->guardian_name_tamil,
    'spouse_name'                 => $request->spouse_name,
    'spouse_name_tamil'           => $request->spouse_name_tamil,
    'date_of_marriage'            => $request->date_of_marriage,
    'date_of_death'               => $request->date_of_death,
    'death_certificate_no'        => $request->death_certificate_no,
    'status'                      => 'Pending',
    'applied_date'                => date('Y-m-d'),
    'created_at'                  => date('Y-m-d'),
]);

        // $insertid = DB::getPdo()->lastInsertId();
           
$files = [];

$files = [
    'photo' => [
        'folder' => 'photo',
        'resize' => true,
    ],
    'address_proof' => [
        'folder' => 'address_proof',
        'compress' => true,
    ],
    'death_certificate_husband' => [
        'folder' => 'death_certificate_husband',
        'compress' => true,
    ],
    'marriage_proof' => [
        'folder' => 'marriage_proof',
        'compress' => true,
    ],
];

$updateData = [];

foreach ($files as $field => $config) {

    if ($request->hasFile($field)) {

        $extension = $request->file($field)->extension();
        $fileName = $insertid . '.' . $extension;

        $folderPath = public_path('upload/services/' . $config['folder']);

        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        $request->file($field)->move($folderPath, $fileName);

        $fullPath = $folderPath . '/' . $fileName;

        if (!empty($config['compress'])) {
            $this->compressFileTo200KB($fullPath, 200);
        }

        if (!empty($config['resize'])) {
            $this->resizeUserPhoto($fullPath, 250, 250, 50);
        }

        // Database column mapping
switch ($field) {

    case 'photo':
        $updateData['photo'] = $fileName;
        break;

    case 'address_proof':
        $updateData['address_proof'] = $fileName;
        break;

    case 'death_certificate_husband':
        $updateData['death_certificate_husband'] = $fileName;
        break;

    case 'marriage_proof':
        $updateData['marriage_proof'] = $fileName;
        break;

    default:
        $updateData[$field] = $fileName;
        break;
        }
    }
}

if (!empty($updateData)) {
    DB::table('tnega_widow')
        ->where('id', $insertid)
        ->update($updateData);
}

if (Auth::user()->user_type_id == 3) {
            $user_id = $distributor_id;
        } elseif (Auth::user()->user_type_id == 4) {
            $user_id = $retailer_id;
        } elseif (Auth::user()->user_type_id == 5) {
            $user_id = $user_id;
        }
        $getservicename = DB::table('services')->select('service_name')->where('id', $serviceid)->first();
        $servicename = "";
        if ($getservicename) {
            $servicename = $getservicename->service_name;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $service_status = 'Out Payment';
        $ad_info = 'Service Payment' . ' ' . $servicename;
        $getwallet = DB::table('users')->select('wallet')->where('id', 2)->first();
        $balance = 0;
        if ($getwallet) {
            $balance = $getwallet->wallet;
        }
        $newbalance = $balance + $servicepayment;
        $newbalance1 = Auth::user()->wallet - $servicepayment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','$user_id','2','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance1')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet + $servicepayment where id = 2";
        DB::update(DB::raw($sql));
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$user_id','2','$user_id','$servicepayment','$ad_info', '$service_status','$time','$date','$user_id','$newbalance')";
        DB::insert(DB::raw($sql));
        $sql = "update users set wallet = wallet - $servicepayment where id = $user_id";
        DB::update(DB::raw($sql));

        $getpermission = DB::table('service_payment')->where('service_id', $serviceid)->first();
        $coordinator_permission = 0;
        $admin_payment = 0;
        if ($getpermission) {
            $coordinator_permission = $getpermission->coordinator_permission;
            $admin_payment = $getpermission->admin_amount;
        }
        if ($coordinator_permission == 1) {
            $post_data = array();

            $getdata = DB::table('tnega_widow')->where('id', $insertid)->get();
            $getdata = json_decode(json_encode($getdata), true);
            foreach ($getdata as $key => $ser) {
                $getdata[$key]['customer_details'] = array();
                $ser_id = $ser['id'];
                $user_id = $ser['user_id'];
                $sql = "select * from tnega_customers where user_id=$user_id";
                $result1 = DB::select($sql);
                $getdata[$key]['customer_details'] = $result1;
            }
            if (count($getdata) > 0) {

                $API_KEY = env('API_KEY', '');
                $RAMJIPAY_URL = env('RAMJIPAY_URL', '');
                $WEBSITE_INDEX = env('WEBSITE_INDEX', '');
                $post_data['data'] = $getdata;
                $post_data['key'] = $API_KEY;
                $post_data['index'] = $WEBSITE_INDEX;
                                        // 265 -> 199
        if ($serviceid == 269) {
            $post_data['service_id'] = 199;
        }
                $ch = curl_init();
                //echo "<pre>";print_r($post_data);echo"</pre>";die;
                //dd(json_encode($getdata));
                //dd($post_data);
                $url1 = $RAMJIPAY_URL . '/api/get_widow_api';
                //echo $url1;die;
                curl_setopt($ch, CURLOPT_URL, $url1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $server_output = curl_exec($ch);
                curl_close($ch);
                $resdata = json_decode($server_output, true);
                // dd($resdata);
                if ($resdata) {
                    $status = $resdata['message'];
                    if ($status == "Success") {
                        $date = date('Y-m-d');
                        $time = date('H:i:s');
                        $service_status = 'Out Payment';
                        $ad_info = 'Ramji Wallet Debit' . ' ' . $servicename;
                        $getrawallet = DB::table('users')->select('rawallet')->where('id', 1)->first();
                        $rawallet = 0;
                        if ($getrawallet) {
                            $balance1 = $getrawallet->rawallet;
                        }

                        $getrawallet1 = DB::table('users')->select('rawallet')->where('id', 2)->first();
                        $rawallet1 = 0;
                        if ($getrawallet1) {
                            $balance2 = $getrawallet1->rawallet;
                        }
                        $newbalance2 = $balance1 + $admin_payment;
                        $newbalance3 = $balance2 - $admin_payment;
                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','1','2','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance3')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet + $admin_payment where id = 1";
                        DB::update(DB::raw($sql));
                        $service_status = 'IN Payment';
                        $ad_info = 'Ramji Wallet Credit' . ' ' . $servicename;
                        $sql = "insert into ramji_payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('2','2','1','$admin_payment','$ad_info', '$service_status','$time','$date','2','$newbalance2')";
                        DB::insert(DB::raw($sql));
                        $sql = "update users set rawallet = rawallet - $admin_payment where id = 2";
                        DB::update(DB::raw($sql));
                    }
                }
            }
        }
        return redirect("appliedservice/Pending")->With("success", "Application submitted Succesfully");
    }

    public function resizeUserPhoto($filePath, $width = 250, $height = 250, $targetKB = 50)
    {
        if (!file_exists($filePath)) {
            return false;
        }

        $info = getimagesize($filePath);
        if (!$info) {
            return false;
        }

        // Load image
        switch ($info['mime']) {
            case 'image/jpeg':
            case 'image/jpg':
                $source = imagecreatefromjpeg($filePath);
                break;

            case 'image/png':
                $source = @imagecreatefrompng($filePath);
                break;

            case 'image/webp':
                $source = imagecreatefromwebp($filePath);
                break;

            default:
                return false;
        }

        // Original dimensions
        $srcWidth  = imagesx($source);
        $srcHeight = imagesy($source);

        // Create 250x250 canvas
        $resized = imagecreatetruecolor($width, $height);

        // White background
        $white = imagecolorallocate($resized, 255, 255, 255);
        imagefill($resized, 0, 0, $white);

        // Resize image exactly to 250x250
        imagecopyresampled(
            $resized,
            $source,
            0,
            0,
            0,
            0,
            $width,
            $height,
            $srcWidth,
            $srcHeight
        );

        // Compress to target size
        $targetBytes = $targetKB * 1024;
        $quality = 90;
        $tempFile = $filePath . '.tmp.jpg';

        do {
            imagejpeg($resized, $tempFile, $quality);
            clearstatcache(true, $tempFile);
            $size = filesize($tempFile);

            $quality -= 5;

            if ($quality < 10) {
                break;
            }
        } while ($size > $targetBytes);

        // Replace original file
        copy($tempFile, $filePath);
        unlink($tempFile);

        // Free memory
        imagedestroy($source);
        imagedestroy($resized);

        return true;
    }

    public function compressFileTo200KB($filePath, $targetKB = 200)
    {
        if (!file_exists($filePath)) {
            return false;
        }

        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

        // PDF compression
        if ($extension === 'pdf') {
            return $this->compressPdfToTarget($filePath, $targetKB);
        }

        // Image compression
        return $this->compressImageToTarget($filePath, $targetKB);
    }

    /**
     * Compress JPG/PNG/WEBP images.
     */
    public function compressImageToTarget($filePath, $targetKB = 200)
    {
        $info = getimagesize($filePath);
        if (!$info) {
            return false;
        }

        switch ($info['mime']) {
            case 'image/jpeg':
            case 'image/jpg':
                $image = imagecreatefromjpeg($filePath);
                break;

            case 'image/png':
                $image = imagecreatefrompng($filePath);
                break;

            case 'image/webp':
                $image = imagecreatefromwebp($filePath);
                break;

            default:
                return false;
        }

        $targetBytes = $targetKB * 1024;
        $quality = 90;
        $tempFile = $filePath . '.tmp.jpg';

        do {
            imagejpeg($image, $tempFile, $quality);
            clearstatcache(true, $tempFile);
            $size = filesize($tempFile);

            $quality -= 5;
            if ($quality < 10) {
                break;
            }
        } while ($size > $targetBytes);

        copy($tempFile, $filePath);
        unlink($tempFile);
        imagedestroy($image);

        return true;
    }

    /**
     * Compress PDF using Ghostscript.
     */
    public function compressPdfToTarget($filePath, $targetKB = 200)
    {
        $targetBytes = $targetKB * 1024;

        // If already below target, do nothing
        if (filesize($filePath) <= $targetBytes) {
            return true;
        }

        $tempFile = $filePath . '.tmp.pdf';

        // Ghostscript executable
        $gs = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN'
            ? 'gswin64c'
            : 'gs';

        // PDF quality presets (best to strongest compression)
        $settings = [
            '/ebook',
            '/screen',
        ];

        foreach ($settings as $setting) {
            $command = $gs
                . ' -sDEVICE=pdfwrite'
                . ' -dCompatibilityLevel=1.4'
                . ' -dPDFSETTINGS=' . $setting
                . ' -dNOPAUSE -dQUIET -dBATCH'
                . ' -sOutputFile=' . escapeshellarg($tempFile)
                . ' ' . escapeshellarg($filePath);

            exec($command, $output, $returnVar);

            if ($returnVar === 0 && file_exists($tempFile)) {
                clearstatcache(true, $tempFile);

                if (filesize($tempFile) <= $targetBytes) {
                    copy($tempFile, $filePath);
                    unlink($tempFile);
                    return true;
                }

                // Keep smallest version even if not exactly 200 KB
                copy($tempFile, $filePath);
                unlink($tempFile);
            }
        }

        return true;
    }


    // Customer Fetch Data

    public function searchCustomerAadhaar(Request $request)
    {
        $customer = DB::table('tnega_customers')
            ->where('aadhaar_no', $request->aadhaar_no)
            ->first();

        //dd($customer);

        if ($customer) {
            return response()->json([
                'status' => true,
                'customer_id' => Crypt::encryptString($customer->id)
            ]);
        }

        return response()->json([
            'status' => false
        ]);
    }
}
