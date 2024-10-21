<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class CustomAuthController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }

    public function customLogin(Request $request)
    {
       $validator =  $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);


        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('Signed in');
        }
        $validator['emailPassword'] = 'Email address or password is incorrect.';
        return redirect("login")->withErrors($validator);
    }



    public function register()
    {
        return view('auth.register');
    }

    public function saveregister(Request $request)
    {
        DB::table( 'users' )->insert( [
            'name'          => $request->name,
            'phone'         => $request->phone,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'cpassword'     => $request->password,
            'user_type_id'  => '5',
            'refferal_id'   => '2',
        ] );

        $insertid = DB::getPdo()->lastInsertId();

        $aadhaar_file = "";
        if ($request->aadhaar_file != null) {
          $aadhaar_file = $insertid.'.'.$request->file('aadhaar_file')->extension();
          $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'aadhaarimage' . DIRECTORY_SEPARATOR);
          move_uploaded_file($_FILES['aadhaar_file']['tmp_name'], $filepath . $aadhaar_file);
        }
        $image = DB::table( 'users' )->where( 'id', $insertid )->update( [
          'aadhaar_file'    => $aadhaar_file,
        ] );

        return redirect("/")->with( 'success', 'You Have Registerd !' );
    }

    public function savedistributorregister(Request $request)
    {
        DB::table( 'users' )->insert( [
            'name'          => $request->name,
            'phone'         => $request->phone,
            'email'         => $request->email,
            'aadhaar_no'    => $request->aadhaar_no,
            'pan_no'        => $request->pan_no,
            'password'      => Hash::make($request->password),
            'cpassword'     => $request->password,
            'user_type_id'  => '3',
            'refferal_id'   => '2',
        ] );

        $insertid = DB::getPdo()->lastInsertId();

        $aadhaar_file = "";
        if ($request->aadhaar_file != null) {
          $aadhaar_file = $insertid.'.'.$request->file('aadhaar_file')->extension();
          $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'aadhaarimage' . DIRECTORY_SEPARATOR);
          move_uploaded_file($_FILES['aadhaar_file']['tmp_name'], $filepath . $aadhaar_file);
        }

        $pan_file = "";
        if ($request->pan_file != null) {
          $pan_file = $insertid.'.'.$request->file('pan_file')->extension();
          $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'panimage' . DIRECTORY_SEPARATOR);
          move_uploaded_file($_FILES['pan_file']['tmp_name'], $filepath . $pan_file);
        }

        $image = DB::table( 'users' )->where( 'id', $insertid )->update( [
          'aadhaar_file'    => $aadhaar_file,
          'pan_file'        => $pan_file,
        ] );

        return redirect("/")->with( 'success', 'You Have Registerd !' );
    }

    public function saveretailerregister(Request $request)
    {
        DB::table( 'users' )->insert( [
            'name'          => $request->name,
            'phone'         => $request->phone,
            'email'         => $request->email,
            'aadhaar_no'    => $request->aadhaar_no,
            'pan_no'        => $request->pan_no,
            'password'      => Hash::make($request->password),
            'cpassword'     => $request->password,
            'user_type_id'  => '4',
            'refferal_id'   => '2',
        ] );

        $insertid = DB::getPdo()->lastInsertId();

        $aadhaar_file = "";
        if ($request->aadhaar_file != null) {
          $aadhaar_file = $insertid.'.'.$request->file('aadhaar_file')->extension();
          $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'aadhaarimage' . DIRECTORY_SEPARATOR);
          move_uploaded_file($_FILES['aadhaar_file']['tmp_name'], $filepath . $aadhaar_file);
        }

        $pan_file = "";
        if ($request->pan_file != null) {
          $pan_file = $insertid.'.'.$request->file('pan_file')->extension();
          $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'panimage' . DIRECTORY_SEPARATOR);
          move_uploaded_file($_FILES['pan_file']['tmp_name'], $filepath . $pan_file);
        }

        $image = DB::table( 'users' )->where( 'id', $insertid )->update( [
          'aadhaar_file'    => $aadhaar_file,
          'pan_file'        => $pan_file,
        ] );

        return redirect("/")->with( 'success', 'You Have Registerd !' );
    }


    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }

    public function dashboard()
    {
        $logid = Auth::user()->id;
        if(Auth::check()){

            $sql = "select count(*) as servicecount from users";
            $users = DB::select(DB::raw($sql));
            if (count($users) > 0) {
                $servicecount = $users[0]->servicecount;
            }

            $sql = "select count(*) as distributor from users where user_type_id = 3";
            $users = DB::select(DB::raw($sql));
            if (count($users) > 0) {
                $distributor = $users[0]->distributor;
            }

            $sql = "select count(*) as distributor_count from users where user_type_id = 3 and refferal_id = $logid";
            $users = DB::select(DB::raw($sql));
            if (count($users) > 0) {
                $distributor_count = $users[0]->distributor_count;
            }

            $sql = "select count(*) as customercount from users where user_type_id = 5";
            $users = DB::select(DB::raw($sql));
            if (count($users) > 0) {
                $customercount = $users[0]->customercount;
            }
            $sql = "select count(*) as customer from users where user_type_id = 5 and refferal_id = $logid";
            $users = DB::select(DB::raw($sql));
            if (count($users) > 0) {
                $customer = $users[0]->customer;
            }

            $sql = "select count(*) as retailer from users where user_type_id = 4";
            $users = DB::select(DB::raw($sql));
            if (count($users) > 0) {
                $retailer = $users[0]->retailer;
            }

            $sql = "select count(*) as retailer_count from users where user_type_id = 4 and refferal_id = $logid";
            $users = DB::select(DB::raw($sql));
            if (count($users) > 0) {
                $retailer_count = $users[0]->retailer_count;
            }
            return view('dashboard',compact('servicecount','customercount','retailer','distributor','retailer_count','distributor_count','customer'));
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function signOut() {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }

}
