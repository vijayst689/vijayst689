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
            if (Auth::user()->status != 'Active') {

            // Immediately logout
            Auth::logout();

            return redirect()->back()->withErrors([
                'login_error' => 'Your account is inactive. Please contact admin.'
            ]);
        }

        // ✅ Active user
        return redirect()->intended('dashboard')->with('success', 'Signed in');
    }

    // Login FAILED → Show message
    return redirect()->back()
        ->withErrors(['login_error' => 'Email address or password is incorrect'])
        ->withInput();
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
            'aadhaar_no'    => $request->aadhaar_no,
            'password'      => Hash::make($request->password),
            'cpassword'     => $request->password,
            'status'        => 'Active',
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
            'status'        => 'Inactive',
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
            'status'        => 'Inactive',
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

        public function checkDuplicateAdmin(Request $request)
{
    $field = $request->field;   // email | phone | aadhaar_no
    $value = trim($request->value);
    $id    = $request->id;

    if (!$field || !$value) {
        return response()->json(['exists' => false]);
    }

    $query = DB::table('users')->where($field, $value);

    if (!empty($id) && is_numeric($id)) {
        $query->where('id', '<>', $id);
    }

    return response()->json([
        'exists' => $query->exists()
    ]);
}

// Distributer Function

   private function checkDuplicate($column, $value)
    {
        return DB::table('users')
            ->where($column, trim($value))
            ->exists();
    }

    /* ================= DISTRIBUTOR AJAX ================= */

    public function checkphoneregister(Request $request)
    {
        return response()->json([
            'exists' => $this->checkDuplicate('phone', $request->phone)
        ]);
    }

    public function checkemailregister(Request $request)
    {
        return response()->json([
            'exists' => $this->checkDuplicate('email', $request->email)
        ]);
    }

    public function checkaadharregister(Request $request)
    {
        return response()->json([
            'exists' => $this->checkDuplicate('aadhaar_no', $request->aadhaar_no)
        ]);
    }

    public function checkpanregister(Request $request)
    {
        return response()->json([
            'exists' => $this->checkDuplicate('pan_no', $request->pan_no)
        ]);
    }

    /* ================= RETAILER AJAX ================= */

    public function checkphoneregisterretailer(Request $request)
    {
        return response()->json([
            'exists' => $this->checkDuplicate('phone', $request->phone)
        ]);
    }

    public function checkemailregisterretailer(Request $request)
    {
        return response()->json([
            'exists' => $this->checkDuplicate('email', $request->email)
        ]);
    }

    public function checkaadharregisterretailer(Request $request)
    {
        return response()->json([
            'exists' => $this->checkDuplicate('aadhaar_no', $request->aadhaar_no)
        ]);
    }

        public function checkpanretailerregister(Request $request)
    {
        return response()->json([
            'exists' => $this->checkDuplicate('pan_no', $request->pan_no)
        ]);
    }


    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }



    public function signOut() {
        Session::flush();
        Auth::logout();

        return Redirect('user/login');
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

}
