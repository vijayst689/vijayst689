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
            'phone'    => 'required',
            'password' => 'required',
        ]);


        $credentials = $request->only('phone', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('Signed in');
        }
        $validator['phonePassword'] = 'Phone address or password is incorrect.';
        return redirect("login")->withErrors($validator);
    }

   public function addenquiry($id)
    {
       $requirement = DB::table('requirement')->orderBy( 'id', 'Asc' )->get();
       return view('enquiry.addenquiry',compact('requirement'));
    }

    public function saveenquiry(Request $request)
    {
      $saveenquiry = DB::table('enquiry')->insert([
        'name'         => $request->name,
        'user_id'      => '2',
        'mobile'       => $request->mobile,
        'email'        => $request->email,
        'requirement'  => $request->requirement,
        'user_name'    => $request->username,
      ]);

      return redirect('/viewenquiry')->with('success', 'Enquiry send Successfully ... !');
    }

    public function register()
    {
        $districts = DB::table( 'district' )->get();
        return view('auth.register',compact('districts'));
    }

    public function get_taluk_register($distid)
  {
      $response = DB::table('taluk')->where('dist_id',$distid)->orderBy( 'id', 'Asc' )->get();
      return response()->json( $response );
  }

  public function get_panchayath_register($taluk_id)
  {
      $response = DB::table('panchayath')->where('taluk_id',$taluk_id)->orderBy( 'id', 'Asc' )->get();
      return response()->json( $response );
  }

    public function saveregister(Request $request)
    {
        DB::table( 'users' )->insert( [
            'name'          => $request->name,
            'phone'         => $request->phone,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'cpassword'     => $request->password,
            'status'        => 'Active',
            'user_type_id'  => '5',
            'refferal_id'   => '2',
        ] );

        $insertid = DB::getPdo()->lastInsertId();

        $profile = "";
        if ($request->profile != null) {
          $profile = $insertid.'.'.$request->file('profile')->extension();
          $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'profile_photo' . DIRECTORY_SEPARATOR);
          move_uploaded_file($_FILES['profile']['tmp_name'], $filepath . $profile);
        }
        $image = DB::table( 'users' )->where( 'id', $insertid )->update( [
          'profile'    => $profile,
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
            'dist_id'       => $request->dist_id,
            'taluk_id'      => $request->taluk_id,
            'password'      => Hash::make($request->password),
            'cpassword'     => $request->password,
            'status'        => 'Active',
            'user_type_id'  => '3',
            'refferal_id'   => '2',
        ] );

        $insertid = DB::getPdo()->lastInsertId();

    if ( Auth::loginUsingId( $insertid ) ) {
         }
        return redirect("/dashboard")->with( 'success', 'You Have Registerd !' );
    }

    public function saveretailerregister(Request $request)
    {
        DB::table( 'users' )->insert( [
            'name'          => $request->name,
            'phone'         => $request->phone,
            'email'         => $request->email,
            'aadhaar_no'    => $request->aadhaar_no,
            'dist_id'      => $request->dist_id,
            'taluk_id'      => $request->taluk_id,
            'password'      => Hash::make($request->password),
            'cpassword'     => $request->password,
            'status'        => 'Active',
            'user_type_id'  => '4',
            'refferal_id'   => '2',
        ] );

        $insertid = DB::getPdo()->lastInsertId();

    if ( Auth::loginUsingId( $insertid ) ) {
         }
        return redirect("/dashboard")->with( 'success', 'You Have Registerd !' );
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

            $activation = DB::table( 'users' )->where('id',$logid)->get();

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
            return view('dashboard',compact('servicecount','customercount','retailer','distributor','retailer_count','distributor_count','customer','activation'));
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function signOut() {
        Session::flush();
        Auth::logout();

        return Redirect('/login');
    }

    public function checkemail( Request $request )
    {
        $email = trim( $request->email );
        $id = trim( $request->id );
        if ( $id == 0 ) {
            $sql = "SELECT * FROM users where email='$email'";
        } else {
            $sql = "SELECT * FROM users where email='$email' and id <> $id";
        }
        $users = DB::select( DB::raw( $sql ) );
        if ( count( $users ) > 0 ) {
            return response()->json( array( 'exists' => true ) );
        } else {
            return response()->json( array( 'exists' => false ) );
        }
    }
    public function checkaadhar( Request $request )
    {
        $aadhaar_no = trim( $request->aadhaar_no );
        $id = trim( $request->id );
        if ( $id == 0 ) {
            $sql = "SELECT * FROM users where aadhaar_no='$aadhaar_no'";
        } else {
            $sql = "SELECT * FROM users where aadhaar_no='$aadhaar_no' and id <> $id";
        }
        $users = DB::select( DB::raw( $sql ) );
        if ( count( $users ) > 0 ) {
            return response()->json( array( 'exists' => true ) );
        } else {
            return response()->json( array( 'exists' => false ) );
        }
    }
    public function checaadhar( Request $request ) {
        $aadhar = trim( $request->aadhar );
        $id = trim( $request->id );
        if ( $id == 0 ) {
            $sql = "SELECT * FROM users where aadhaar_no='$aadhar'";
        } else {
            $sql = "SELECT * FROM users where aadhaar_no='$aadhar' and id <> $id";
        }
        $users = DB::select( DB::raw( $sql ) );
        if ( count( $users ) > 0 ) {
            return response()->json( array( 'exists' => true ) );
        } else {
            return response()->json( array( 'exists' => false ) );
        }
    }
    public function checkphone( Request $request )
    {
        $phone = trim( $request->phone );
        $id = trim( $request->id );
        if ( $id == 0 ) {
            $sql = "SELECT * FROM users where phone='$phone'";
        } else {
            $sql = "SELECT * FROM users where phone='$phone' and id <> $id";
        }
        $users = DB::select( DB::raw( $sql ) );
        if ( count( $users ) > 0 ) {
            return response()->json( array( 'exists' => true ) );
        } else {
            return response()->json( array( 'exists' => false ) );
        }
    }

    public function checkpan( Request $request )
    {
        $pan_no = trim( $request->pan_no );
        $id = trim( $request->id );
        if ( $id == 0 ) {
            $sql = "SELECT * FROM users where pan_no='$pan_no'";
        } else {
            $sql = "SELECT * FROM users where pan_no='$pan_no' and id <> $id";
        }
        $users = DB::select( DB::raw( $sql ) );
        if ( count( $users ) > 0 ) {
            return response()->json( array( 'exists' => true ) );
        } else {
            return response()->json( array( 'exists' => false ) );
        }
    }

    // Distributer Function

    public function checkemailregister( Request $request )
    {
        $email = trim( $request->email );
        $id = trim( $request->id );
        if ( $id == 0 ) {
            $sql = "SELECT * FROM users where email='$email'";
        } else {
            $sql = "SELECT * FROM users where email='$email' and id <> $id";
        }
        $users = DB::select( DB::raw( $sql ) );
        if ( count( $users ) > 0 ) {
            return response()->json( array( 'exists' => true ) );
        } else {
            return response()->json( array( 'exists' => false ) );
        }
    }

    public function checkaadharregister( Request $request ) {
        $aadhaar_no = trim( $request->aadhaar_no );
        $id = trim( $request->id );
        if ( $id == 0 ) {
            $sql = "SELECT * FROM users where aadhaar_no='$aadhaar_no'";
        } else {
            $sql = "SELECT * FROM users where aadhaar_no='$aadhaar_no' and id <> $id";
        }
        $users = DB::select( DB::raw( $sql ) );
        if ( count( $users ) > 0 ) {
            return response()->json( array( 'exists' => true ) );
        } else {
            return response()->json( array( 'exists' => false ) );
        }
    }
    public function checkphoneregister( Request $request )
    {
        $phone = trim( $request->phone );
        $id = trim( $request->id );
        if ( $id == 0 ) {
            $sql = "SELECT * FROM users where phone='$phone'";
        } else {
            $sql = "SELECT * FROM users where phone='$phone' and id <> $id";
        }
        $users = DB::select( DB::raw( $sql ) );
        if ( count( $users ) > 0 ) {
            return response()->json( array( 'exists' => true ) );
        } else {
            return response()->json( array( 'exists' => false ) );
        }
    }
    public function checkpanregister( Request $request )
    {
        $pan_no = trim( $request->pan_no );
        $id = trim( $request->id );
        if ( $id == 0 ) {
            $sql = "SELECT * FROM users where pan_no='$pan_no'";
        } else {
            $sql = "SELECT * FROM users where pan_no='$pan_no' and id <> $id";
        }
        $users = DB::select( DB::raw( $sql ) );
        if ( count( $users ) > 0 ) {
            return response()->json( array( 'exists' => true ) );
        } else {
            return response()->json( array( 'exists' => false ) );
        }
    }

//Retailer Function

    public function checkemailregisterretailer( Request $request )
    {
        $email = trim( $request->email );
        $id = trim( $request->id );
        if ( $id == 0 ) {
            $sql = "SELECT * FROM users where email='$email'";
        } else {
            $sql = "SELECT * FROM users where email='$email' and id <> $id";
        }
        $users = DB::select( DB::raw( $sql ) );
        if ( count( $users ) > 0 ) {
            return response()->json( array( 'exists' => true ) );
        } else {
            return response()->json( array( 'exists' => false ) );
        }
    }

    public function checkaadharregisterretailer( Request $request ) {
        $aadhaar_no = trim( $request->aadhaar_no );
        $id = trim( $request->id );
        if ( $id == 0 ) {
            $sql = "SELECT * FROM users where aadhaar_no='$aadhaar_no'";
        } else {
            $sql = "SELECT * FROM users where aadhaar_no='$aadhaar_no' and id <> $id";
        }
        $users = DB::select( DB::raw( $sql ) );
        if ( count( $users ) > 0 ) {
            return response()->json( array( 'exists' => true ) );
        } else {
            return response()->json( array( 'exists' => false ) );
        }
    }
    public function checkphoneregisterretailer( Request $request )
    {
        $phone = trim( $request->phone );
        $id = trim( $request->id );
        if ( $id == 0 ) {
            $sql = "SELECT * FROM users where phone='$phone'";
        } else {
            $sql = "SELECT * FROM users where phone='$phone' and id <> $id";
        }
        $users = DB::select( DB::raw( $sql ) );
        if ( count( $users ) > 0 ) {
            return response()->json( array( 'exists' => true ) );
        } else {
            return response()->json( array( 'exists' => false ) );
        }
    }
    public function checkpanregisterretailer( Request $request )
    {
        $pan_no = trim( $request->pan_no );
        $id = trim( $request->id );
        if ( $id == 0 ) {
            $sql = "SELECT * FROM users where pan_no='$pan_no'";
        } else {
            $sql = "SELECT * FROM users where pan_no='$pan_no' and id <> $id";
        }
        $users = DB::select( DB::raw( $sql ) );
        if ( count( $users ) > 0 ) {
            return response()->json( array( 'exists' => true ) );
        } else {
            return response()->json( array( 'exists' => false ) );
        }
    }

//Customer Function

    public function checkemailregistercustomer( Request $request )
    {
        $email = trim( $request->email );
        $id = trim( $request->id );
        if ( $id == 0 ) {
            $sql = "SELECT * FROM users where email='$email'";
        } else {
            $sql = "SELECT * FROM users where email='$email' and id <> $id";
        }
        $users = DB::select( DB::raw( $sql ) );
        if ( count( $users ) > 0 ) {
            return response()->json( array( 'exists' => true ) );
        } else {
            return response()->json( array( 'exists' => false ) );
        }
    }

    public function checkaadharregistercustomer( Request $request ) {
        $aadhaar_no = trim( $request->aadhaar_no );
        $id = trim( $request->id );
        if ( $id == 0 ) {
            $sql = "SELECT * FROM users where aadhaar_no='$aadhaar_no'";
        } else {
            $sql = "SELECT * FROM users where aadhaar_no='$aadhaar_no' and id <> $id";
        }
        $users = DB::select( DB::raw( $sql ) );
        if ( count( $users ) > 0 ) {
            return response()->json( array( 'exists' => true ) );
        } else {
            return response()->json( array( 'exists' => false ) );
        }
    }
    public function checkphoneregistercustomer( Request $request )
    {
        $phone = trim( $request->phone );
        $id = trim( $request->id );
        if ( $id == 0 ) {
            $sql = "SELECT * FROM users where phone='$phone'";
        } else {
            $sql = "SELECT * FROM users where phone='$phone' and id <> $id";
        }
        $users = DB::select( DB::raw( $sql ) );
        if ( count( $users ) > 0 ) {
            return response()->json( array( 'exists' => true ) );
        } else {
            return response()->json( array( 'exists' => false ) );
        }
    }

    public function checkPhonelogin(Request $request)
{
    $exists = User::where('phone', $request->phone)->exists();
    return response()->json(['exists' => $exists]);
}

//    public function sendOtp(Request $request)
//     {
//         $v = Validator::make($request->all(), [
//             'phone' => 'required|string'
//         ]);
//         if ($v->fails()) {
//             return response()->json(['success' => false, 'message' => 'Invalid phone.'], 422);
//         }

//         $phone = $request->phone;

//         // Check user exists
//         $userExists = User::where('phone', $phone)->exists();
//         if (! $userExists) {
//             return response()->json(['success' => false, 'message' => 'Phone not registered.'], 404);
//         }

//         // Rate limiting: one OTP per 60 seconds, and max 5 per hour
//         $rateKey = "otp_rate:" . $phone;
//         $sentCount = Cache::get($rateKey . ':count', 0);
//         $firstSentAt = Cache::get($rateKey . ':first_at');

//         // initialize rate window
//         if (! $firstSentAt) {
//             Cache::put($rateKey . ':first_at', now(), now()->addHour());
//             Cache::put($rateKey . ':count', 0, now()->addHour());
//             $sentCount = 0;
//         }

//         // last sent check (1 minute)
//         if (Cache::has("otp_last_sent:$phone") && now()->diffInSeconds(Carbon::parse(Cache::get("otp_last_sent:$phone"))) < 60) {
//             return response()->json(['success' => false, 'message' => 'Please wait before requesting another OTP.'], 429);
//         }

//         if ($sentCount >= 5) {
//             return response()->json(['success' => false, 'message' => 'OTP request limit reached. Try again later.'], 429);
//         }

//         // Generate secure 6-digit OTP
//         $otp = random_int(100000, 999999);

//         // Save OTP to cache (or DB). Keep short TTL, e.g., 5 minutes.
//         $otpKey = "otp:$phone";
//         Cache::put($otpKey, $otp, now()->addMinutes(5));

//         // Update rate counters
//         Cache::increment($rateKey . ':count');
//         Cache::put("otp_last_sent:$phone", now(), now()->addMinutes(60));

//         // Send SMS using your provider (example: Twilio)
//         try {
//             // Example Twilio usage (uncomment and configure your credentials):
//             // $sid = config('services.twilio.sid');
//             // $token = config('services.twilio.token');
//             // $from = config('services.twilio.from');
//             // $twilio = new \Twilio\Rest\Client($sid, $token);
//             // $twilio->messages->create($phone, ['from' => $from, 'body' => "Your OTP is: $otp"]);

//             // If you don't use Twilio, integrate your provider here.
//             // For demonstration we will log it (DO NOT log in production).
//             Log::info("OTP for {$phone}: {$otp} (for debug only — remove in prod)");

//             return response()->json(['success' => true]);
//         } catch (\Exception $e) {
//             // Clean up OTP on failure
//             Cache::forget($otpKey);
//             Log::error("OTP send failed for $phone: {$e->getMessage()}");
//             return response()->json(['success' => false, 'message' => 'Failed to send OTP. Try again later.'], 500);
//         }
//     }

}
