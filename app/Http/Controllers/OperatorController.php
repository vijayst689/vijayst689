<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

class OperatorController extends Controller {

    public function __construct() {
        $this->middleware( 'auth' );
    }

    public function operator () {
        return view( 'operator/operator');
    }

    public function viewoperators () {
        $operator = DB::table( 'operator' )->orderby( 'id', 'Asc' )->get();
        return view( 'operator/viewoperators', compact( 'operator') );
    }

    public function addoperator ( Request $request ) {
        DB::table( 'operator' )->insert([
            'code'             => $request->code,
            'service_type'     => $request->service_type,
            'name'             => $request->name,
            'commission'       => $request->commission,
            'admin_commission' => $request->admin_commission,
        ]);
        return redirect()->back()->with( 'success', 'Operator Added Successfully ... !' );
    }

    public function updateoperator ( Request $request ) {
        DB::table( 'operator' )->where( 'id', $request->opr_id )->update( [
            'code'             => $request->code,
            'service_type'     => $request->service_type,
            'name'             => $request->name,
            'commission'       => $request->commission,
            'admin_commission' => $request->admin_commission,

        ] );

        return redirect()->back()->with( 'success', 'Operator Updated Successfully ... !' );
    }

    public function deleteoperator ( $id ) {
        DB::table( 'operator' )->where( 'id', $id )->delete();
        return redirect( 'admin/operator' )->with( 'success', 'Operator Deleted Successfully ... !' );
    }
}
