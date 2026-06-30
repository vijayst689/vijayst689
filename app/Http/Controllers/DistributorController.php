<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DistributorController extends Controller
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

    public function adddistributor()
    {
        return view('distributor.adddistributor');
    }

    public function distributors()
    {
        $userid = Auth::user()->id;

        if (Auth::user()->user_type_id == 1) {

            $distributors = DB::table('users')->where('user_type_id', '=', 3)->orderBy('id', 'Desc')->get();

        }

        if (Auth::user()->user_type_id == 2) {

            $distributors = DB::table('users')->where('user_type_id', '=', 3)->orderBy('id', 'Desc')->get();

        }

        return view('distributor.distributors', compact('distributors'));
    }

    public function savedistributor(Request $request)
    {

        $postData = [
            "name"       => $request->name,
            "aadhaar_no" => $request->aadhaar_no,
            "password"   => $request->password,
            "email"      => $request->email,
            "phone"      => $request->phone,
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://app.flowzo.ai/ecom-gateway/ecom-svc-crm-1.0-SNAPSHOT/api/ig/lead/capture/new/website?name=pkrmsolution');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);

        $response = curl_exec($ch);

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error    = curl_error($ch);

        curl_close($ch);

// Optional Log
        \Log::info('Flowzo API Response', [
            'http_code' => $httpCode,
            'response'  => $response,
            'error'     => $error,
        ]);

// API fail aana stop pannalam
        if ($httpCode != 200) {
            return back()->with('error', 'Lead API Failed');
        }
        // dd($httpCode, json_decode($response, true), $error);

        $userid = Auth::user()->id;

        $savedistributor = DB::table('users')->insert([
            'name'         => $request->name,
            'aadhaar_no'   => $request->aadhaar_no,
            'password'     => Hash::make($request->password),
            'cpassword'    => $request->password,
            'email'        => $request->email,
            'phone'        => $request->phone,
            'address'      => $request->address,
            'refferal_id'  => $userid,
            'user_type_id' => '3',
            'status'       => 'Active',
        ]);

        $insertid = DB::getPdo()->lastInsertId();

        $profile = "";

        if ($request->profile != null) {

            $profile = $insertid . '.' . $request->file('profile')->extension();

            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'distributor' . DIRECTORY_SEPARATOR);

            move_uploaded_file(
                $_FILES['profile']['tmp_name'],
                $filepath . $profile
            );

            DB::table('users')
                ->where('id', $insertid)
                ->update([
                    'profile' => $profile,
                ]);
        }

        return redirect('/distributors')->with('success', 'Distributer Add Successfully ... !');
    }

    public function updatedistributor(Request $request)
    {
        $updatedistributor = DB::table('users')->where('id', $request->distributor_id)->update([
            'name'       => $request->name,
            'aadhaar_no' => $request->aadhaar_no,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'address'    => $request->address,
            'gender'     => $request->gender,
            'status'     => $request->status,
        ]);

        $profile = "";
        if ($request->profile != null) {
            $profile  = $request->distributor_id . '.' . $request->file('profile')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'distributor' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['profile']['tmp_name'], $filepath . $profile);
            $sql = "update users set profile='$profile' where id = $request->distributor_id";
            DB::update(DB::raw($sql));
        }

        return redirect('/distributors')->with('success', 'retailer Updated Successfully ... !');
    }

    public function dropdistributor($id)
    {

        $dropretailer = DB::table('users')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'distributor Deleted Successfully ... !');
    }

    public function statusupdate(Request $request)
    {

        $statusupdate = DB::table('users')->where('id', $request->statusid)->update([
            'status' => $request->status,
        ]);

        return redirect('/distributors')->with('success', 'Status Updated Successfully ... !');
    }

}
