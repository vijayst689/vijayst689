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
        $districts = DB::table( 'district' )->get();
        return view('customer.addcustomer',compact('districts'));
    }

    public function editcustomer($id)
    {
        $editcustomer = DB::table('users')->where( 'id', $id )->orderBy('id', 'Asc')->get();
        $editcustomer = json_decode( json_encode( $editcustomer ), true );
        foreach ( $editcustomer as $key => $customer ) {
        $editcustomer[ $key ][ 'familymember' ] = array();
        $customer_id = $customer[ 'id' ];
        $sql = "select * from family_member where user_id=$customer_id order by id Asc";
        $result = DB::select( $sql );
        $editcustomer[ $key ][ 'familymember' ] = $result;
    }
        $editcustomer = json_decode( json_encode( $editcustomer ));
        $districts = DB::table( 'district' )->get();
        return view('customer.editcustomer', compact('districts','editcustomer'));
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

    public function admins()
    {

        $viewadmin = DB::table('users')->where( 'user_type_id', '=', 2)->orderBy( 'id', 'Asc' )->get();

        return view('admin.admins',compact('viewadmin'));
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
     
    public function enquiry(){
        $enquiry = DB::table('enquiry')->orderBy('id', 'Asc')->get();
        return view('enquiry.enquiry',compact('enquiry'));

   }
   public function viewenquiry()
   {
       if(Auth::user()->user_type_id != 2){
           return redirect("/dashboard");
       }
       $enquiry = DB::table('enquiry')->orderBy( 'id' , 'Asc' )->get();
       return view('enquiry.viewenquiry',compact('enquiry'));
   }

   public function saveenquiry(Request $request){
    
    $saveenquiry = DB::table('enquiry')->insert([
        'name'          => $request->name,
        'email'         => $request->email,
        'mobile'         => $request->mobile,
        'requirement'   => $request->requirement,
    ]);
   
   
   return redirect('/enquiry')->with('success', 'Enquiry Add Successfully ... !');
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
        'gender'        => $request->gender,
        'taluk_id'      => $request->taluk_id,
        'panchayath_name' => $request->panchayath_name,
        'dist_id'       => $request->dist_id,
        'can_details'   => $request->can_details,
        'can_number'    => $request->can_number,
        'smartcard_no'  => $request->smartcard_no,
        'user_type_id'  => '5',
        'status'        => 'Active'
      ]);

      $insertid = DB::getPdo()->lastInsertId();

      $aadhaarimg = "";
      $smartcardimg = "";
      $signature = "";
      $profile = "";
    //   $old_can_document = "";
    //   if ($request->old_can_document != null) {
    //     $old_can_document = $insertid.'.'.$request->file('old_can_document')->extension();
    //     $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'old_can_document' . DIRECTORY_SEPARATOR);
    //     move_uploaded_file($_FILES['old_can_document']['tmp_name'], $filepath . $old_can_document);
    //   }

      if ($request->aadhaar_file != null) {
        $aadhaarimg = $insertid.'.'.$request->file('aadhaar_file')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'users' . DIRECTORY_SEPARATOR . 'aadhaar_file' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['aadhaar_file']['tmp_name'], $filepath . $aadhaarimg);
      }
      if ($request->smartcard != null) {
        $smartcardimg = $insertid.'.'.$request->file('smartcard')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'users' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['smartcard']['tmp_name'], $filepath . $smartcardimg);
      }
      if ($request->signature != null) {
        $signature = $insertid.'.'.$request->file('signature')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'users' . DIRECTORY_SEPARATOR . 'signature' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['signature']['tmp_name'], $filepath . $signature);
      }
      if ($request->profile != null) {
        $profile = $insertid.'.'.$request->file('profile')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'users' . DIRECTORY_SEPARATOR . 'profile_photo' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['profile']['tmp_name'], $filepath . $profile);
      }
      $image = DB::table( 'users' )->where( 'id', $insertid )->update( [
        'smartcard'        => $smartcardimg,
        'aadhaar_file'     => $aadhaarimg,
        'signature'        => $signature,
        // 'old_can_document' => $old_can_document,
        'profile'          => $profile,
      ] );

      if($request->has('relationship')){
        foreach ( $request->relationship as $key => $relation ) {
            $relation_name = $request->relation_name[ $key ];
            $relation_age = $request->relation_age[ $key ];
            $relation_status = $request->relationship_status[ $key ];
            $profession = $request->profession[ $key ];
            $income = $request->income[ $key ];

            $sql = "insert into family_member (user_id,relation,relation_name,relation_age,relation_status,profession,income) values ($insertid,'$relation','$relation_name','$relation_age','$relation_status','$profession','$income')";
            DB::insert( $sql );
            DB::insert( $sql );
            $relation_id = DB::getPdo()->lastInsertId();
            if($relation_status == "Dead"){
              if ($request->doc[$key] != null) {
                $deathcert = $relation_id.'.'.$request->file('doc')[$key]->extension();
                  //dd($request->doc[$key]);
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'users' . DIRECTORY_SEPARATOR . 'relationdeath_cert' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['doc']['tmp_name'][$key], $filepath . $deathcert);
                DB::table( 'family_member' )->where( 'id', $relation_id )->update( [
                  'relationdeath_cert'       => $deathcert,
                ] );
              }
            }else{
                if ($request->doc[$key] != null) {
                  $aadhaar_card = $relation_id.'.'.$request->file('doc')[$key]->extension();
                    //dd($request->doc[$key]);
                  $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'users' . DIRECTORY_SEPARATOR . 'relationaadhaar_card' . DIRECTORY_SEPARATOR);
                  move_uploaded_file($_FILES['doc']['tmp_name'][$key], $filepath . $aadhaar_card);
                  DB::table( 'family_member' )->where( 'id', $relation_id )->update( [
                    'relationaadhaar_card'       => $aadhaar_card,
                  ] );
                }
            }
  }
}

      return redirect('/customers')->with('success', 'Customer Add Successfully ... !');
    }

    public function updatecustomer(Request $request)
    {
        $updatecustomer = DB::table('users')->where('id', $request->customer_id)->update([
            'name'          => $request->name,
            'aadhaar_no'    => $request->aadhaar_no,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'address'       => $request->address,
            'date_of_birth' => $request->date_of_birth,
            'gender'        => $request->gender,
            'taluk_id'      => $request->taluk_id,
            'panchayath_name' => $request->panchayath_name,
            'dist_id'       => $request->dist_id,
            'can_details'   => $request->can_details,
            'can_number'    => $request->can_number,
            'smartcard_no'  => $request->smartcard_no,
          ]);

          $customer_id = $request->customer_id;
          $aadhaarimg = "";
          $smartcardimg = "";
          $signature = "";
          $profile = "";
        //   $old_can_document = "";

        //   if ($request->old_can_document != null) {
        //     $old_can_document = $request->customer_id.'.'.$request->file('old_can_document')->extension();
        //     $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'old_can_document' . DIRECTORY_SEPARATOR);
        //     move_uploaded_file($_FILES['old_can_document']['tmp_name'], $filepath . $old_can_document);
        //     $sql = "update users set old_can_document='$old_can_document' where id = $customer_id";
        //     DB::update(DB::raw($sql));
        //   }

          if ($request->aadhaar_file != null) {
            $aadhaarimg = $request->customer_id.'.'.$request->file('aadhaar_file')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'users' . DIRECTORY_SEPARATOR . 'aadhaar_file' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['aadhaar_file']['tmp_name'], $filepath . $aadhaarimg);
            $sql = "update users set aadhaar_file='$aadhaarimg' where id = $customer_id";
            DB::update(DB::raw($sql));
          }

          if ($request->smartcard != null) {
            $smartcardimg = $request->customer_id.'.'.$request->file('smartcard')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'users' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['smartcard']['tmp_name'], $filepath . $smartcardimg);
            $sql = "update users set smartcard='$smartcardimg' where id = $customer_id";
            DB::update(DB::raw($sql));
          }
          if ($request->signature != null) {
            $signature = $request->customer_id.'.'.$request->file('signature')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'users' . DIRECTORY_SEPARATOR . 'signature' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['signature']['tmp_name'], $filepath . $signature);
            $sql = "update users set signature='$signature' where id = $customer_id";
            DB::update(DB::raw($sql));
          }

          if ($request->profile != null) {
            $profile = $request->customer_id.'.'.$request->file('profile')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'users' . DIRECTORY_SEPARATOR . 'profile_photo' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['profile']['tmp_name'], $filepath . $profile);
            $sql = "update users set profile='$profile' where id = $customer_id";
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
}
