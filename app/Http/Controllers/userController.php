<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class userController extends Controller
{

    public function addcustomer()
    {
        return view('customer.addcustomer');
    }

    public function customers()
    {
        $userid = Auth::user()->id;

        if( Auth::user()->user_type_id == 1 ) {

        $viewcustomers = DB::table('users')->where( 'user_type_id', '=', 5)->orderBy( 'id', 'Asc' )->get();

        }

        if( Auth::user()->user_type_id == 2 ) {

        $viewcustomers = DB::table('users')->where( 'user_type_id', '=', 5 )->where( 'refferal_id', '=', $userid)->orderBy( 'id', 'Asc' )->get();

        }

        if( Auth::user()->user_type_id == 3 ) {

        $viewcustomers = DB::table('users')->where( 'user_type_id', '=', 5 )->where( 'refferal_id', '=', $userid)->orderBy( 'id', 'Asc' )->get();

        }

        if( Auth::user()->user_type_id == 4 ) {

        $viewcustomers = DB::table('users')->where( 'user_type_id', '=', 5 )->where( 'refferal_id', '=', $userid)->orderBy( 'id', 'Asc' )->get();

        }

        return view('customer.customers',compact('viewcustomers'));
    }

    public function documents($id)
    {
        $documents = DB::table('cus_document')->where( 'customer_id', '=', $id )->orderBy( 'id', 'Asc' )->get();
        return view('customer.documents',compact( 'documents', 'id' ));
    }

    public function applyservice()
    {
        $viewcustomers = DB::table('users')->where( 'user_type_id', '=', 5)->orderBy( 'id', 'Asc' )->get();
        return view('customer.customers',compact('viewcustomers'));
    }

    public function savecustomer(Request $request)
    {

        $userid = Auth::user()->id;
      $savecustomer = DB::table('users')->insert([
        'name'          => $request->name,
        'aadhaar_no'    => $request->aadhaar_no,
        'password'      => Hash::make($request->password),
        'cpassword'     => $request->password,
        'email'         => $request->email,
        'phone'         => $request->phone,
        'address'       => $request->address,
        'gender'        => $request->gender,
        'refferal_id'   => $userid,
        'date_of_birth' => $request->date_of_birth,
        'user_type_id'  => '5',
        'status'        => 'Active'
      ]);

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

      return redirect('/customers')->with('success', 'Customer Add Successfully ... !');
    }

    public function updatecustomer(Request $request)
    {
      $updatecustomer = DB::table('users')->where( 'id', $request->customer_id )->update([
        'name'          => $request->name,
        'aadhaar_no'    => $request->aadhaar_no,
        'email'         => $request->email,
        'phone'         => $request->phone,
        'address'       => $request->address,
        'gender'        => $request->gender,
        'date_of_birth' => $request->date_of_birth,
        'status'        => $request->status,
      ]);

      $profile = "";
      if ($request->profile != null) {
        $profile = $request->customer_id.'.'.$request->file('profile')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'profile_photo' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['profile']['tmp_name'], $filepath . $profile);
        $sql = "update users set profile='$profile' where id = $request->customer_id";
        DB::update(DB::raw($sql));
      }

      return redirect()->back()->with('success', 'Customer Updated Successfully ... !');
    }

    public function dropcustomer( $id ){

        $dropcustomer = DB::table('users')->where( 'id', $id )->delete();
     return redirect()->back()->with('success', 'Customer Deleted Successfully ... !');
    }

    public function adddocument( Request $request ) {
        $file_name = $request->file_name;
        $customer_id = $request->customer_id;
        $sql = "insert into cus_document (customer_id,file_name) values ($customer_id,'$file_name')";
        DB::insert( DB::raw( $sql ) );
        $last_insert_id = DB::getPdo()->lastInsertId();
        if ( $request->cus_docx != null ) {
          $cus_docx = $last_insert_id .'.'. $request->file( 'cus_docx' )->extension();
          $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'document' . DIRECTORY_SEPARATOR );
          move_uploaded_file( $_FILES[ 'cus_docx' ][ 'tmp_name' ], $filepath . $cus_docx );
          $sql = "update cus_document set cus_docx='$cus_docx' where id=$last_insert_id";
          DB::update( DB::raw( $sql ) );
        }
        return redirect()->back()->with( 'success', 'Document uploaded successfully' );
      }

    public function Profile()
    {
        $userid = Auth::user()->id;

        $profile = DB::table( 'users' )->where( 'id', '=', $userid )->get();
        return view('profile',compact('profile'));
    }

    public function updateprofile( Request $request ) {
        $userid = Auth::user()->id;

        $updateprofile = DB::table( 'users' )->where( 'id', $userid )->update( [
            'name'          => $request->name,
            'aadhaar_no'    => $request->aadhaar_no,
            'phone'         => $request->phone,
            'email'         => $request->email,
            'gender'        => $request->gender,
            'address'       => $request->address,
            'date_of_birth' => $request->date_of_birth,
        ] );

        $pro = '';
        if ( $request->profile != null ) {
            $pro = $userid.'.'.$request->file( 'profile' )->extension();
            $filepath = public_path( 'upload'.DIRECTORY_SEPARATOR.'profile_photo'.DIRECTORY_SEPARATOR );
            move_uploaded_file( $_FILES[ 'profile' ][ 'tmp_name' ], $filepath.$pro );
            $sql = "update users set profile='$pro' where id = $userid";
            DB::update( DB::raw( $sql ) );
        }

        return redirect( '/dashboard' )->with( 'success', 'User Updated Successfully ... !' );
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
