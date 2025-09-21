<?php
namespace App\Http\Controllers;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServicestatusController extends Controller
{
    public function __construct()
  {
    $this->middleware(function ($request, $next) {
            $this->restrictIfNotActivated();
            return $next($request);
        });
    $this->middleware('auth');
  }

    public function appliedservice($status)
    {
        if(Auth::user()->user_type_id == 2 || Auth::user()->user_type_id == 1){

            $service = DB::table('msme')->select('services.service_name', 'msme.*')
            ->Join('services', 'services.id', '=', 'msme.service_id')
            ->where('msme.status',$status)
            ->orderBy('msme.id', 'Desc')->get();

            $itr = DB::table('itr')->select('services.service_name', 'itr.*')
            ->Join('services', 'services.id', '=', 'itr.service_id')
            ->where('itr.status',$status)
            ->orderBy('itr.id', 'Desc')->get();

            $gst = DB::table('gst')->select('services.service_name', 'gst.*')
            ->Join('services', 'services.id', '=', 'gst.service_id')
            ->where('gst.status',$status)
            ->orderBy('gst.id', 'Desc')->get();

            $tec_exam = DB::table('tec_exam')->select('services.service_name', 'tec_exam.*')
            ->Join('services', 'services.id', '=', 'tec_exam.service_id')
            ->where('tec_exam.status',$status)
            ->orderBy('tec_exam.id', 'Desc')->get();

            $tnegaservices = DB::table('tnega_services')->select('services.service_name', 'users.name','tnega_services.*')
            ->Join('services', 'services.id', '=', 'tnega_services.service_id')
            ->Join('users', 'users.id', '=', 'tnega_services.user_id')
            ->where('tnega_services.status',$status)
            ->orderBy('tnega_services.id', 'Desc')->get();

            $smartcard = DB::table('smartcard')->select('services.service_name', 'smartcard.*')
            ->Join('services', 'services.id', '=', 'smartcard.service_id')
            ->where('smartcard.status',$status)
            ->orderBy('smartcard.id', 'Desc')->get();

            $aadhaarcard = DB::table('aadhaarcard')->select('services.service_name', 'aadhaarcard.*')
            ->Join('services', 'services.id', '=', 'aadhaarcard.service_id')
            ->where('aadhaarcard.status',$status)
            ->orderBy('aadhaarcard.id', 'Desc')->get();

            $can_edit = DB::table('can_edit')->select('services.service_name', 'users.name','can_edit.*')
            ->Join('services', 'services.id', '=', 'can_edit.service_id')
            ->Join('users', 'users.id', '=', 'can_edit.user_id')
            ->where('can_edit.status',$status)
            ->orderBy('can_edit.id', 'Desc')->get();

            $bond = DB::table('bond')->select('services.service_name', 'bond.*')
            ->Join('services', 'services.id', '=', 'bond.service_id')
            ->where('bond.status',$status)
            ->orderBy('bond.id', 'Desc')->get();

            $voterid = DB::table('voterid')->select('services.service_name', 'voterid.*')
            ->Join('services', 'services.id', '=', 'voterid.service_id')
            ->where('voterid.status',$status)
            ->orderBy('voterid.id', 'Desc')->get();

            $fssai = DB::table('fssai')->select('services.service_name', 'fssai.*')
            ->Join('services', 'services.id', '=', 'fssai.service_id')
            ->where('fssai.status',$status)
            ->orderBy('fssai.id', 'Desc')->get();

            $covid = DB::table('covid')->select('services.service_name', 'covid.*')
            ->Join('services', 'services.id', '=', 'covid.service_id')
            ->where('covid.status',$status)
            ->orderBy('covid.id', 'Desc')->get();

            $nalavariyam = DB::table('nalavariyam')->select('services.service_name', 'nalavariyam.*')
            ->Join('services', 'services.id', '=', 'nalavariyam.service_id')
            ->where('nalavariyam.status',$status)
            ->orderBy('nalavariyam.id', 'Desc')->get();

            $license = DB::table('license')->select('services.service_name', 'license.*')
            ->Join('services', 'services.id', '=', 'license.service_id')
            ->where('license.status',$status)
            ->orderBy('license.id', 'Desc')->get();

            $tailor = DB::table('tailor')->select('services.service_name', 'tailor.*')
            ->Join('services', 'services.id', '=', 'tailor.service_id')
            ->where('tailor.status',$status)
            ->orderBy('tailor.id', 'Desc')->get();

            $pmkissan = DB::table('pmkissan')->select('services.service_name', 'pmkissan.*')
            ->Join('services', 'services.id', '=', 'pmkissan.service_id')
            ->where('pmkissan.status',$status)
            ->orderBy('pmkissan.id', 'Desc')->get();

            $birth_certificate = DB::table('birth_certificate')->select('services.service_name', 'birth_certificate.*')
            ->Join('services', 'services.id', '=', 'birth_certificate.service_id')
            ->where('birth_certificate.status',$status)
            ->orderBy('birth_certificate.id', 'Desc')->get();

            $medicalscheme = DB::table('medicalscheme')->select('services.service_name', 'medicalscheme.*')
            ->Join('services', 'services.id', '=', 'medicalscheme.service_id')
            ->where('medicalscheme.status',$status)
            ->orderBy('medicalscheme.id', 'Desc')->get();

            $dharsan = DB::table('dharsan')->select('services.service_name', 'dharsan.*')
            ->Join('services', 'services.id', '=', 'dharsan.service_id')
            ->where('dharsan.status',$status)
            ->orderBy('dharsan.id', 'Desc')->get();

            $utisl = DB::table('utislpan')->select('services.service_name', 'utislpan.*')
            ->Join('services', 'services.id', '=', 'utislpan.service_id')
            ->where('utislpan.status',$status)
            ->orderBy('utislpan.id', 'Desc')->get();

            $patta = DB::table('patta')->select('services.service_name', 'patta.*')
            ->Join('services', 'services.id', '=', 'patta.service_id')
            ->where('patta.status',$status)
            ->orderBy('patta.id', 'Desc')->get();

            $software = DB::table('software')->select('services.service_name', 'software.*')
            ->Join('services', 'services.id', '=', 'software.service_id')
            ->where('software.status',$status)
            ->orderBy('software.id', 'Desc')->get();

            $smartcard_otp = DB::table('smartcard_otp')->select('services.service_name', 'smartcard_otp.*')
            ->Join('services', 'services.id', '=', 'smartcard_otp.service_id')
            ->where('smartcard_otp.status',$status)
            ->orderBy('smartcard_otp.id', 'Desc')->get();

            $service = $service->merge($itr);
            $service = $service->merge($gst);
            $service = $service->merge($tec_exam);
            $service = $service->merge($tnegaservices);
            $service = $service->merge($smartcard);
            $service = $service->merge($aadhaarcard);
            $service = $service->merge($can_edit);
            $service = $service->merge($bond);
            $service = $service->merge($voterid);
            $service = $service->merge($fssai);
            $service = $service->merge($covid);
            $service = $service->merge($nalavariyam);
            $service = $service->merge($license);
            $service = $service->merge($tailor);
            $service = $service->merge($pmkissan);
            $service = $service->merge($birth_certificate);
            $service = $service->merge($medicalscheme);
            $service = $service->merge($dharsan);
            $service = $service->merge($utisl);
            $service = $service->merge($patta);
            $service = $service->merge($software);
            $service = $service->merge($smartcard_otp);

            $service = json_decode( json_encode( $service ), true );
        foreach ( $service as $key => $s ) {
            $user_id = 0;
            $context = "";
            if($s['retailer_id'] == 0 && $s['distributor_id'] == 0){
            $user_id = $s['user_id'];
            $context = "Customer";
        }
        elseif($s['retailer_id'] == 0){
            $user_id = $s['distributor_id'];
            $context = "Distributor";
        }elseif($s['distributor_id'] == 0){
            $user_id = $s['retailer_id'];
            $context = "Retailer";
        }
        $user_id = $user_id;
        $sql = "select name,phone from users where id=$user_id";
        $result = DB::select( $sql );
        $name = "";
        $mobile = "";
        if(count($result) > 0){
            $name = $result[0]->name;
            $mobile = $result[0]->phone;
        }
        $service[ $key ][ 'applyname' ] = $name;
        $service[ $key ][ 'applymobile' ] = $mobile;
        $service[ $key ][ 'context' ] = $context;
        $service[ $key ][ 'applyuserid' ] = $user_id;
    }
        $service = json_decode( json_encode( $service ));

        }elseif(Auth::user()->user_type_id == 3){

            $service = DB::table('msme')->select('services.service_name', 'msme.*')
            ->Join('services', 'services.id', '=', 'msme.service_id')
            ->Join('users', 'users.id', '=', 'msme.user_id')
            ->where('msme.status',$status)
            ->where('msme.distributor_id',Auth::user()->id)
            ->orderBy('msme.id', 'Desc')->get();


            $itr = DB::table('itr')->select('services.service_name', 'itr.*')
            ->Join('services', 'services.id', '=', 'itr.service_id')
            ->where('itr.status',$status)
            ->where('itr.distributor_id',Auth::user()->id)
            ->orderBy('itr.id', 'Desc')->get();

            $gst = DB::table('gst')->select('services.service_name', 'gst.*')
            ->Join('services', 'services.id', '=', 'gst.service_id')
            ->where('gst.status',$status)
            ->where('gst.distributor_id',Auth::user()->id)
            ->orderBy('gst.id', 'Desc')->get();

            $tec_exam = DB::table('tec_exam')->select('services.service_name', 'tec_exam.*')
            ->Join('services', 'services.id', '=', 'tec_exam.service_id')
            ->where('tec_exam.status',$status)
            ->where('tec_exam.distributor_id',Auth::user()->id)
            ->orderBy('tec_exam.id', 'Desc')->get();

            $tnegaservices = DB::table('tnega_services')->select('services.service_name', 'tnega_services.*')
            ->Join('services', 'services.id', '=', 'tnega_services.service_id')
            ->where('tnega_services.status',$status)
            ->where('tnega_services.distributor_id',Auth::user()->id)
            ->orderBy('tnega_services.id', 'Desc')->get();

            $smartcard = DB::table('smartcard')->select('services.service_name', 'smartcard.*')
            ->Join('services', 'services.id', '=', 'smartcard.service_id')
            ->where('smartcard.status',$status)
            ->where('smartcard.distributor_id',Auth::user()->id)
            ->orderBy('smartcard.id', 'Desc')->get();

            $aadhaarcard = DB::table('aadhaarcard')->select('services.service_name', 'aadhaarcard.*')
            ->Join('services', 'services.id', '=', 'aadhaarcard.service_id')
            ->where('aadhaarcard.status',$status)
            ->where('aadhaarcard.distributor_id',Auth::user()->id)
            ->orderBy('aadhaarcard.id', 'Desc')->get();

            $can_edit = DB::table('can_edit')->select('services.service_name', 'users.name','can_edit.*')
            ->Join('services', 'services.id', '=', 'can_edit.service_id')
            ->Join('users', 'users.id', '=', 'can_edit.user_id')
            ->where('can_edit.status',$status)
            ->where('can_edit.distributor_id',Auth::user()->id)
            ->orderBy('can_edit.id', 'Desc')->get();

            $bond = DB::table('bond')->select('services.service_name', 'bond.*')
            ->Join('services', 'services.id', '=', 'bond.service_id')
            ->where('bond.status',$status)
            ->where('bond.distributor_id',Auth::user()->id)
            ->orderBy('bond.id', 'Desc')->get();

            $voterid = DB::table('voterid')->select('services.service_name', 'voterid.*')
            ->Join('services', 'services.id', '=', 'voterid.service_id')
            ->where('voterid.status',$status)
            ->where('voterid.distributor_id',Auth::user()->id)
            ->orderBy('voterid.id', 'Desc')->get();

            $fssai = DB::table('fssai')->select('services.service_name', 'fssai.*')
            ->Join('services', 'services.id', '=', 'fssai.service_id')
            ->where('fssai.status',$status)
            ->where('fssai.distributor_id',Auth::user()->id)
            ->orderBy('fssai.id', 'Desc')->get();

            $covid = DB::table('covid')->select('services.service_name', 'covid.*')
            ->Join('services', 'services.id', '=', 'covid.service_id')
            ->where('covid.status',$status)
            ->where('covid.distributor_id',Auth::user()->id)
            ->orderBy('covid.id', 'Desc')->get();

            $nalavariyam = DB::table('nalavariyam')->select('services.service_name', 'nalavariyam.*')
            ->Join('services', 'services.id', '=', 'nalavariyam.service_id')
            ->where('nalavariyam.status',$status)
            ->where('nalavariyam.distributor_id',Auth::user()->id)
            ->orderBy('nalavariyam.id', 'Desc')->get();

            $license = DB::table('license')->select('services.service_name', 'license.*')
            ->Join('services', 'services.id', '=', 'license.service_id')
            ->where('license.status',$status)
            ->where('license.distributor_id',Auth::user()->id)
            ->orderBy('license.id', 'Desc')->get();

            $tailor = DB::table('tailor')->select('services.service_name', 'tailor.*')
            ->Join('services', 'services.id', '=', 'tailor.service_id')
            ->where('tailor.status',$status)
            ->where('tailor.distributor_id',Auth::user()->id)
            ->orderBy('tailor.id', 'Desc')->get();

            $pmkissan = DB::table('pmkissan')->select('services.service_name', 'pmkissan.*')
            ->Join('services', 'services.id', '=', 'pmkissan.service_id')
            ->where('pmkissan.status',$status)
            ->where('pmkissan.distributor_id',Auth::user()->id)
            ->orderBy('pmkissan.id', 'Desc')->get();

            $birth_certificate = DB::table('birth_certificate')->select('services.service_name', 'birth_certificate.*')
            ->Join('services', 'services.id', '=', 'birth_certificate.service_id')
            ->where('birth_certificate.status',$status)
            ->where('birth_certificate.distributor_id',Auth::user()->id)
            ->orderBy('birth_certificate.id', 'Desc')->get();

            $medicalscheme = DB::table('medicalscheme')->select('services.service_name', 'medicalscheme.*')
            ->Join('services', 'services.id', '=', 'medicalscheme.service_id')
            ->where('medicalscheme.status',$status)
            ->where('medicalscheme.distributor_id',Auth::user()->id)
            ->orderBy('medicalscheme.id', 'Desc')->get();

            $dharsan = DB::table('dharsan')->select('services.service_name', 'dharsan.*')
            ->Join('services', 'services.id', '=', 'dharsan.service_id')
            ->where('dharsan.status',$status)
            ->where('dharsan.distributor_id',Auth::user()->id)
            ->orderBy('dharsan.id', 'Desc')->get();

            $utisl = DB::table('utislpan')->select('services.service_name', 'utislpan.*')
            ->Join('services', 'services.id', '=', 'utislpan.service_id')
            ->where('utislpan.status',$status)
            ->where('utislpan.distributor_id',Auth::user()->id)
            ->orderBy('utislpan.id', 'Desc')->get();

            $patta = DB::table('patta')->select('services.service_name', 'patta.*')
            ->Join('services', 'services.id', '=', 'patta.service_id')
            ->where('patta.status',$status)
            ->where('patta.distributor_id',Auth::user()->id)
            ->orderBy('patta.id', 'Desc')->get();

            $software = DB::table('software')->select('services.service_name', 'software.*')
            ->Join('services', 'services.id', '=', 'software.service_id')
            ->where('software.status',$status)
            ->where('software.distributor_id',Auth::user()->id)
            ->orderBy('software.id', 'Desc')->get();

            $smartcard_otp = DB::table('smartcard_otp')->select('services.service_name', 'smartcard_otp.*')
            ->Join('services', 'services.id', '=', 'smartcard_otp.service_id')
            ->where('smartcard_otp.status',$status)
            ->where('smartcard_otp.distributor_id',Auth::user()->id)
            ->orderBy('smartcard_otp.id', 'Desc')->get();

            $service = $service->merge($itr);
            $service = $service->merge($gst);
            $service = $service->merge($tec_exam);
            $service = $service->merge($tnegaservices);
            $service = $service->merge($smartcard);
            $service = $service->merge($aadhaarcard);
            $service = $service->merge($can_edit);
            $service = $service->merge($bond);
            $service = $service->merge($voterid);
            $service = $service->merge($fssai);
            $service = $service->merge($covid);
            $service = $service->merge($nalavariyam);
            $service = $service->merge($license);
            $service = $service->merge($tailor);
            $service = $service->merge($pmkissan);
            $service = $service->merge($birth_certificate);
            $service = $service->merge($medicalscheme);
            $service = $service->merge($dharsan);
            $service = $service->merge($utisl);
            $service = $service->merge($patta);
            $service = $service->merge($software);
            $service = $service->merge($smartcard_otp);

        }elseif(Auth::user()->user_type_id == 4){

            $service = DB::table('msme')->select('services.service_name', 'msme.*')
            ->Join('services', 'services.id', '=', 'msme.service_id')
            ->where('msme.status',$status)
            ->where('msme.retailer_id',Auth::user()->id)
            ->orderBy('msme.id', 'Desc')->get();

            $itr = DB::table('itr')->select('services.service_name', 'itr.*')
            ->Join('services', 'services.id', '=', 'itr.service_id')
            ->where('itr.status',$status)
            ->where('itr.retailer_id',Auth::user()->id)
            ->orderBy('itr.id', 'Desc')->get();

            $gst = DB::table('gst')->select('services.service_name', 'gst.*')
            ->Join('services', 'services.id', '=', 'gst.service_id')
            ->where('gst.status',$status)
            ->where('gst.retailer_id',Auth::user()->id)
            ->orderBy('gst.id', 'Desc')->get();

            $tec_exam = DB::table('tec_exam')->select('services.service_name', 'tec_exam.*')
            ->Join('services', 'services.id', '=', 'tec_exam.service_id')
            ->where('tec_exam.status',$status)
            ->where('tec_exam.retailer_id',Auth::user()->id)
            ->orderBy('tec_exam.id', 'Desc')->get();

            $tnegaservices = DB::table('tnega_services')->select('services.service_name', 'tnega_services.*')
            ->Join('services', 'services.id', '=', 'tnega_services.service_id')
            ->where('tnega_services.status',$status)
            ->where('tnega_services.retailer_id',Auth::user()->id)
            ->orderBy('tnega_services.id', 'Desc')->get();

            $smartcard = DB::table('smartcard')->select('services.service_name', 'smartcard.*')
            ->Join('services', 'services.id', '=', 'smartcard.service_id')
            ->where('smartcard.status',$status)
            ->where('smartcard.retailer_id',Auth::user()->id)
            ->orderBy('smartcard.id', 'Desc')->get();

            $aadhaarcard = DB::table('aadhaarcard')->select('services.service_name', 'aadhaarcard.*')
            ->Join('services', 'services.id', '=', 'aadhaarcard.service_id')
            ->where('aadhaarcard.status',$status)
            ->where('aadhaarcard.retailer_id',Auth::user()->id)
            ->orderBy('aadhaarcard.id', 'Desc')->get();

            $can_edit = DB::table('can_edit')->select('services.service_name', 'users.name','can_edit.*')
            ->Join('services', 'services.id', '=', 'can_edit.service_id')
            ->Join('users', 'users.id', '=', 'can_edit.user_id')
            ->where('can_edit.status',$status)
            ->where('can_edit.retailer_id',Auth::user()->id)
            ->orderBy('can_edit.id', 'Desc')->get();

            $bond = DB::table('bond')->select('services.service_name', 'bond.*')
            ->Join('services', 'services.id', '=', 'bond.service_id')
            ->where('bond.status',$status)
            ->where('bond.retailer_id',Auth::user()->id)
            ->orderBy('bond.id', 'Desc')->get();

            $voterid = DB::table('voterid')->select('services.service_name', 'voterid.*')
            ->Join('services', 'services.id', '=', 'voterid.service_id')
            ->where('voterid.status',$status)
            ->where('voterid.retailer_id',Auth::user()->id)
            ->orderBy('voterid.id', 'Desc')->get();

            $fssai = DB::table('fssai')->select('services.service_name', 'fssai.*')
            ->Join('services', 'services.id', '=', 'fssai.service_id')
            ->where('fssai.status',$status)
            ->where('fssai.retailer_id',Auth::user()->id)
            ->orderBy('fssai.id', 'Desc')->get();

            $covid = DB::table('covid')->select('services.service_name', 'covid.*')
            ->Join('services', 'services.id', '=', 'covid.service_id')
            ->where('covid.status',$status)
            ->where('covid.retailer_id',Auth::user()->id)
            ->orderBy('covid.id', 'Desc')->get();

            $nalavariyam = DB::table('nalavariyam')->select('services.service_name', 'nalavariyam.*')
            ->Join('services', 'services.id', '=', 'nalavariyam.service_id')
            ->where('nalavariyam.status',$status)
            ->where('nalavariyam.retailer_id',Auth::user()->id)
            ->orderBy('nalavariyam.id', 'Desc')->get();

            $license = DB::table('license')->select('services.service_name', 'license.*')
            ->Join('services', 'services.id', '=', 'license.service_id')
            ->where('license.status',$status)
            ->where('license.retailer_id',Auth::user()->id)
            ->orderBy('license.id', 'Desc')->get();

            $tailor = DB::table('tailor')->select('services.service_name', 'tailor.*')
            ->Join('services', 'services.id', '=', 'tailor.service_id')
            ->where('tailor.status',$status)
            ->where('tailor.retailer_id',Auth::user()->id)
            ->orderBy('tailor.id', 'Desc')->get();

            $pmkissan = DB::table('pmkissan')->select('services.service_name', 'pmkissan.*')
            ->Join('services', 'services.id', '=', 'pmkissan.service_id')
            ->where('pmkissan.status',$status)
            ->where('pmkissan.retailer_id',Auth::user()->id)
            ->orderBy('pmkissan.id', 'Desc')->get();

            $birth_certificate = DB::table('birth_certificate')->select('services.service_name', 'birth_certificate.*')
            ->Join('services', 'services.id', '=', 'birth_certificate.service_id')
            ->where('birth_certificate.status',$status)
            ->where('birth_certificate.retailer_id',Auth::user()->id)
            ->orderBy('birth_certificate.id', 'Desc')->get();

            $medicalscheme = DB::table('medicalscheme')->select('services.service_name', 'medicalscheme.*')
            ->Join('services', 'services.id', '=', 'medicalscheme.service_id')
            ->where('medicalscheme.status',$status)
            ->where('medicalscheme.retailer_id',Auth::user()->id)
            ->orderBy('medicalscheme.id', 'Desc')->get();

            $dharsan = DB::table('dharsan')->select('services.service_name', 'dharsan.*')
            ->Join('services', 'services.id', '=', 'dharsan.service_id')
            ->where('dharsan.status',$status)
            ->where('dharsan.retailer_id',Auth::user()->id)
            ->orderBy('dharsan.id', 'Desc')->get();

            $utisl = DB::table('utislpan')->select('services.service_name', 'utislpan.*')
            ->Join('services', 'services.id', '=', 'utislpan.service_id')
            ->where('utislpan.status',$status)
            ->where('utislpan.retailer_id',Auth::user()->id)
            ->orderBy('utislpan.id', 'Desc')->get();

            $patta = DB::table('patta')->select('services.service_name', 'patta.*')
            ->Join('services', 'services.id', '=', 'patta.service_id')
            ->where('patta.status',$status)
            ->where('patta.retailer_id',Auth::user()->id)
            ->orderBy('patta.id', 'Desc')->get();

            $software = DB::table('software')->select('services.service_name', 'software.*')
            ->Join('services', 'services.id', '=', 'software.service_id')
            ->where('software.status',$status)
            ->where('software.retailer_id',Auth::user()->id)
            ->orderBy('software.id', 'Desc')->get();

            $smartcard_otp = DB::table('smartcard_otp')->select('services.service_name', 'smartcard_otp.*')
            ->Join('services', 'services.id', '=', 'smartcard_otp.service_id')
            ->where('smartcard_otp.status',$status)
            ->where('smartcard_otp.retailer_id',Auth::user()->id)
            ->orderBy('smartcard_otp.id', 'Desc')->get();

            $service = $service->merge($itr);
            $service = $service->merge($gst);
            $service = $service->merge($tec_exam);
            $service = $service->merge($tnegaservices);
            $service = $service->merge($smartcard);
            $service = $service->merge($aadhaarcard);
            $service = $service->merge($can_edit);
            $service = $service->merge($bond);
            $service = $service->merge($voterid);
            $service = $service->merge($fssai);
            $service = $service->merge($covid);
            $service = $service->merge($nalavariyam);
            $service = $service->merge($license);
            $service = $service->merge($tailor);
            $service = $service->merge($pmkissan);
            $service = $service->merge($birth_certificate);
            $service = $service->merge($medicalscheme);
            $service = $service->merge($dharsan);
            $service = $service->merge($utisl);
            $service = $service->merge($patta);
            $service = $service->merge($software);
            $service = $service->merge($smartcard_otp);

        }elseif(Auth::user()->user_type_id == 5){

            $service = DB::table('msme')->select('services.service_name', 'msme.*')
            ->Join('services', 'services.id', '=', 'msme.service_id')
            ->where('msme.status',$status)
            ->where('msme.user_id',Auth::user()->id)
            ->orderBy('msme.id', 'Desc')->get();

            $itr = DB::table('itr')->select('services.service_name', 'itr.*')
            ->Join('services', 'services.id', '=', 'itr.service_id')
            ->where('itr.status',$status)
            ->where('itr.user_id',Auth::user()->id)
            ->orderBy('itr.id', 'Desc')->get();

            $gst = DB::table('gst')->select('services.service_name', 'gst.*')
            ->Join('services', 'services.id', '=', 'gst.service_id')
            ->where('gst.status',$status)
            ->where('gst.user_id',Auth::user()->id)
            ->orderBy('gst.id', 'Desc')->get();

            $tec_exam = DB::table('tec_exam')->select('services.service_name', 'tec_exam.*')
            ->Join('services', 'services.id', '=', 'tec_exam.service_id')
            ->where('tec_exam.status',$status)
            ->where('tec_exam.user_id',Auth::user()->id)
            ->orderBy('tec_exam.id', 'Desc')->get();

            $tnegaservices = DB::table('tnega_services')->select('services.service_name', 'tnega_services.*')
            ->Join('services', 'services.id', '=', 'tnega_services.service_id')
            ->where('tnega_services.status',$status)
            ->where('tnega_services.user_id',Auth::user()->id)
            ->orderBy('tnega_services.id', 'Desc')->get();

            $smartcard = DB::table('smartcard')->select('services.service_name', 'smartcard.*')
            ->Join('services', 'services.id', '=', 'smartcard.service_id')
            ->where('smartcard.status',$status)
            ->where('smartcard.user_id',Auth::user()->id)
            ->orderBy('smartcard.id', 'Desc')->get();

            $aadhaarcard = DB::table('aadhaarcard')->select('services.service_name', 'aadhaarcard.*')
            ->Join('services', 'services.id', '=', 'aadhaarcard.service_id')
            ->where('aadhaarcard.status',$status)
            ->where('aadhaarcard.user_id',Auth::user()->id)
            ->orderBy('aadhaarcard.id', 'Desc')->get();

            $can_edit = DB::table('can_edit')->select('services.service_name', 'users.name','can_edit.*')
            ->Join('services', 'services.id', '=', 'can_edit.service_id')
            ->Join('users', 'users.id', '=', 'can_edit.user_id')
            ->where('can_edit.status',$status)
            ->where('can_edit.user_id',Auth::user()->id)
            ->orderBy('can_edit.id', 'Desc')->get();

            $bond = DB::table('bond')->select('services.service_name', 'bond.*')
            ->Join('services', 'services.id', '=', 'bond.service_id')
            ->where('bond.status',$status)
            ->where('bond.user_id',Auth::user()->id)
            ->orderBy('bond.id', 'Desc')->get();

            $voterid = DB::table('voterid')->select('services.service_name', 'voterid.*')
            ->Join('services', 'services.id', '=', 'voterid.service_id')
            ->where('voterid.status',$status)
            ->where('voterid.user_id',Auth::user()->id)
            ->orderBy('voterid.id', 'Desc')->get();

            $fssai = DB::table('fssai')->select('services.service_name', 'fssai.*')
            ->Join('services', 'services.id', '=', 'fssai.service_id')
            ->where('fssai.status',$status)
            ->where('fssai.user_id',Auth::user()->id)
            ->orderBy('fssai.id', 'Desc')->get();

            $covid = DB::table('covid')->select('services.service_name', 'covid.*')
            ->Join('services', 'services.id', '=', 'covid.service_id')
            ->where('covid.status',$status)
            ->where('covid.user_id',Auth::user()->id)
            ->orderBy('covid.id', 'Desc')->get();

            $nalavariyam = DB::table('nalavariyam')->select('services.service_name', 'nalavariyam.*')
            ->Join('services', 'services.id', '=', 'nalavariyam.service_id')
            ->where('nalavariyam.status',$status)
            ->where('nalavariyam.user_id',Auth::user()->id)
            ->orderBy('nalavariyam.id', 'Desc')->get();

            $license = DB::table('license')->select('services.service_name', 'license.*')
            ->Join('services', 'services.id', '=', 'license.service_id')
            ->where('license.status',$status)
            ->where('license.user_id',Auth::user()->id)
            ->orderBy('license.id', 'Desc')->get();

            $tailor = DB::table('tailor')->select('services.service_name', 'tailor.*')
            ->Join('services', 'services.id', '=', 'tailor.service_id')
            ->where('tailor.status',$status)
            ->where('tailor.user_id',Auth::user()->id)
            ->orderBy('tailor.id', 'Desc')->get();

            $pmkissan = DB::table('pmkissan')->select('services.service_name', 'pmkissan.*')
            ->Join('services', 'services.id', '=', 'pmkissan.service_id')
            ->where('pmkissan.status',$status)
            ->where('pmkissan.user_id',Auth::user()->id)
            ->orderBy('pmkissan.id', 'Desc')->get();

            $birth_certificate = DB::table('birth_certificate')->select('services.service_name', 'birth_certificate.*')
            ->Join('services', 'services.id', '=', 'birth_certificate.service_id')
            ->where('birth_certificate.status',$status)
            ->where('birth_certificate.user_id',Auth::user()->id)
            ->orderBy('birth_certificate.id', 'Desc')->get();

            $medicalscheme = DB::table('medicalscheme')->select('services.service_name', 'medicalscheme.*')
            ->Join('services', 'services.id', '=', 'medicalscheme.service_id')
            ->where('medicalscheme.status',$status)
            ->where('medicalscheme.user_id',Auth::user()->id)
            ->orderBy('medicalscheme.id', 'Desc')->get();

            $dharsan = DB::table('dharsan')->select('services.service_name', 'dharsan.*')
            ->Join('services', 'services.id', '=', 'dharsan.service_id')
            ->where('dharsan.status',$status)
            ->where('dharsan.user_id',Auth::user()->id)
            ->orderBy('dharsan.id', 'Desc')->get();

            $utisl = DB::table('utislpan')->select('services.service_name', 'utislpan.*')
            ->Join('services', 'services.id', '=', 'utislpan.service_id')
            ->where('utislpan.status',$status)
            ->where('utislpan.user_id',Auth::user()->id)
            ->orderBy('utislpan.id', 'Desc')->get();

            $patta = DB::table('patta')->select('services.service_name', 'patta.*')
            ->Join('services', 'services.id', '=', 'patta.service_id')
            ->where('patta.status',$status)
            ->where('patta.user_id',Auth::user()->id)
            ->orderBy('patta.id', 'Desc')->get();

            $software = DB::table('software')->select('services.service_name', 'software.*')
            ->Join('services', 'services.id', '=', 'software.service_id')
            ->where('software.status',$status)
            ->where('software.user_id',Auth::user()->id)
            ->orderBy('software.id', 'Desc')->get();

            $smartcard_otp = DB::table('smartcard_otp')->select('services.service_name', 'smartcard_otp.*')
            ->Join('services', 'services.id', '=', 'smartcard_otp.service_id')
            ->where('smartcard_otp.status',$status)
            ->where('smartcard_otp.user_id',Auth::user()->id)
            ->orderBy('smartcard_otp.id', 'Desc')->get();

            $service = $service->merge($itr);
            $service = $service->merge($gst);
            $service = $service->merge($tec_exam);
            $service = $service->merge($tnegaservices);
            $service = $service->merge($smartcard);
            $service = $service->merge($aadhaarcard);
            $service = $service->merge($can_edit);
            $service = $service->merge($bond);
            $service = $service->merge($voterid);
            $service = $service->merge($fssai);
            $service = $service->merge($covid);
            $service = $service->merge($nalavariyam);
            $service = $service->merge($license);
            $service = $service->merge($tailor);
            $service = $service->merge($pmkissan);
            $service = $service->merge($birth_certificate);
            $service = $service->merge($medicalscheme);
            $service = $service->merge($dharsan);
            $service = $service->merge($utisl);
            $service = $service->merge($patta);
            $service = $service->merge($software);
            $service = $service->merge($smartcard_otp);
        }
        return view( 'services.appliedservice',compact('service','status') );
    }


    public function servicestatus($status,$id,$service_id)
    {
        $user_id = 0;
        $serviceid = 0;
        if($service_id == 34){
            $services = DB::table('msme')->where('id',$id)->where('status',$status)->first();
        }elseif($service_id == 51){
            $services = DB::table('itr')->where('id',$id)->where('status',$status)->first();
        }elseif($service_id == 52){
            $services = DB::table('gst')->where('id',$id)->where('status',$status)->first();
        } elseif($service_id == 54){
            $services = DB::table('tec_exam')->where('id',$id)->where('status',$status)->first();
        } elseif($service_id == 55){
            $services = DB::table('tec_exam')->where('id',$id)->where('status',$status)->first();
        } elseif($service_id == 124 || $service_id == 165 || $service_id == 166 || $service_id == 167 ||$service_id == 168 || $service_id == 169 ){
            $services = DB::table('tec_exam')->where('id',$id)->where('status',$status)->first();

        } elseif($service_id == 36 || $service_id == 37 || $service_id == 38 || $service_id == 39 || $service_id == 41 || $service_id == 42 || $service_id == 43 || $service_id == 77 || $service_id == 78 || $service_id == 79 || $service_id == 80 || $service_id == 81 || $service_id == 82 || $service_id == 83 || $service_id == 84 || $service_id == 221 || $service_id == 222 || $service_id == 227 || $service_id == 228 || $service_id == 229 || $service_id == 230 || $service_id == 231 || $service_id == 232 || $service_id == 235){
            $services = DB::table('smartcard')->where('id',$id)->where('status',$status)->first();

        } elseif($service_id == 56 || $service_id == 58 || $service_id == 74 || $service_id == 158 || $service_id == 159 || $service_id == 160 || $service_id == 161 || $service_id == 162 || $service_id == 163 || $service_id == 72){
            $services = DB::table('aadhaarcard')->where('id',$id)->where('status',$status)->first();

        } elseif($service_id == 60 || $service_id == 62 || $service_id == 63 || $service_id == 64 || $service_id == 65 || $service_id == 66 || $service_id == 67 || $service_id == 121){
            $services = DB::table('can_edit')->where('id',$id)->where('status',$status)->first();

        } elseif($service_id == 208 || $service_id == 209 || $service_id == 210 || $service_id == 211 || $service_id == 225 || $service_id == 226 || $service_id == 233 || $service_id == 234){
            $services = DB::table('can_edit')->where('id',$id)->where('status',$status)->first();

        } elseif($service_id == 100 ){
            $services = DB::table('bond')->where('id',$id)->where('status',$status)->first();

        }elseif($service_id == 113 || $service_id == 120 || $service_id == 164 || $service_id == 182){
            $services = DB::table('voterid')->where('id',$id)->where('status',$status)->first();
            $selectedCorrections = $services->correction
            ? explode(',', $services->correction)
            : [];

        }
        elseif($service_id == 113 || $service_id == 122 || $service_id == 123 ){
            $services = DB::table('fssai')->where('id',$id)->where('status',$status)->first();

        } elseif($service_id == 95 || $service_id == 96 || $service_id == 97 || $service_id == 98){
            $services = DB::table('nalavariyam')->where('id',$id)->where('status',$status)->first();

        } elseif($service_id == 125 ){
            $services = DB::table('covid')->where('id',$id)->where('status',$status)->first();
        } elseif($service_id == 148 || $service_id == 150 ){
            $services = DB::table('license')->where('id',$id)->where('status',$status)->first();

        } elseif($service_id == 152 || $service_id == 153 || $service_id == 154){
            $services = DB::table('tailor')->where('id',$id)->where('status',$status)->first();

        } elseif($service_id == 157 ){
            $services = DB::table('pmkissan')->where('id',$id)->where('status',$status)->first();
        } elseif($service_id == 155 || $service_id == 156){
            $services = DB::table('birth_certificate')->where('id',$id)->where('status',$status)->first();
        } elseif($service_id == 179 || $service_id == 180 ){
            $services = DB::table('medicalscheme')->where('id',$id)->where('status',$status)->first();
        }elseif($service_id == 183 || $service_id == 184 || $service_id == 185 || $service_id == 186 ){
            $services = DB::table('dharsan')->where('id',$id)->where('status',$status)->first();
        }elseif($service_id == 187 || $service_id == 188 || $service_id == 189 || $service_id == 190 || $service_id == 191 || $service_id == 192 || $service_id == 193 || $service_id == 194 || $service_id == 195 || $service_id == 196 || $service_id == 197 || $service_id == 198 || $service_id == 199 || $service_id == 200 || $service_id == 201 || $service_id == 202 || $service_id == 203){
            $services = DB::table('software')->where('id',$id)->where('status',$status)->first();
        }elseif($service_id == 213 || $service_id == 214 || $service_id == 215 ){
            $services = DB::table('patta')->where('id',$id)->where('status',$status)->first();
        }elseif($service_id == 196 || $service_id == 197 ){
            $services = DB::table('utislpan')->where('id',$id)->where('status',$status)->first();

        } elseif($service_id == 220 ){
            $services = DB::table('smartcard_otp')->where('id',$id)->where('status',$status)->first();

        }elseif($service_id == 181){
            $votercorrection_services = DB::table('voterid')->where('id',$id)->where('status',$status)->get();
            $votercorrection_services = json_decode( json_encode( $votercorrection_services ), true );
            foreach ( $votercorrection_services as $key => $ser ) {
                $votercorrection_services[ $key ][ 'details' ] = array();
                $ser_id = $ser[ 'id' ];
                $sql = "select * from voterid_details where service_id=$ser_id order by id Asc";
                $result = DB::select( $sql );
                $votercorrection_services[ $key ][ 'details' ] = $result;
            }
            $services = json_decode( json_encode( $votercorrection_services ));
           //dd($services);
        }elseif($service_id == 2){
            $services = DB::table('tnega_services')->where('id',$id)->where('status',$status)->get();
            $services = json_decode( json_encode( $services ), true );
            foreach ( $services as $key => $ser ) {
                $services[ $key ][ 'family_details' ] = array();
                $ser_id = $ser[ 'id' ];
                $sql = "select * from family_member where service_id=$ser_id order by id Asc";
                $result = DB::select( $sql );
                $services[ $key ][ 'family_details' ] = $result;
            }
            $services = json_decode( json_encode( $services ));
           //dd($services);
        }elseif($service_id == 15){
            $services = DB::table('tnega_services')->where('id',$id)->where('status',$status)->get();
            $services = json_decode( json_encode( $services ), true );
            foreach ( $services as $key => $ser ) {
                $services[ $key ][ 'family_details' ] = array();
                $services[ $key ][ 'details' ] = array();
                $ser_id = $ser[ 'id' ];
                $sql = "select * from family_member where service_id=$ser_id and user_id=0 order by id Asc";
                $result = DB::select( $sql );
                $services[ $key ][ 'family_details' ] = $result;

                $sql = "select * from family_member where service_id=$ser_id and user_id=$ser_id order by id Asc";
                $result1 = DB::select( $sql );
                $services[ $key ][ 'details' ] = $result1;
            }
            $services = json_decode( json_encode( $services ));
           //dd($services);
        }
        elseif($service_id == 23){
            $services = DB::table('tnega_services')->where('id',$id)->where('status',$status)->get();
            $services = json_decode( json_encode( $services ), true );
            foreach ( $services as $key => $ser ) {
                $services[ $key ][ 'documents' ] = array();
                $services[ $key ][ 'details' ] = array();
                $ser_id = $ser[ 'id' ];
                $sql = "select * from document where service_id=$ser_id order by id Asc";
                $result = DB::select( $sql );
                $services[ $key ][ 'documents' ] = $result;
                $sql = "select * from agri_details where service_id=$ser_id order by id Asc";
                $result1 = DB::select( $sql );
                $services[ $key ][ 'details' ] = $result1;
            }
            $services = json_decode( json_encode( $services ));
           //dd($services);
        }else{
            $services = DB::table('tnega_services')->where('id',$id)->where('status',$status)->first();
        }

        if($service_id == 181 || $service_id == 2 || $service_id == 15 || $service_id == 23 ){
            if(count($services) > 0){
                $serviceid = $services[0]->service_id;
                $user_id = $services[0]->user_id;
            }
        }else{
            if($services){
                $serviceid = $services->service_id;
                $user_id = $services->user_id;
            }
        }


        //dd($votercorrection_services);
        //if(count($votercorrection_services) > 0){
            //$serviceid = $votercorrection_services[0]->service_id;
            //$user_id = $votercorrection_services[0]->user_id;
        //}
        $customers = DB::table('users')->where('id',$user_id)->first();
        $districts = DB::table( 'district' )->get();
        $sql = "select service_name,amount from services where id = $serviceid";
        $result = DB::select(DB::raw($sql));
        $servicename = "";
        $amount = 0;
        if(count($result) > 0){
            $servicename = $result[0]->service_name;
            $amount = $result[0]->amount;
        }
        if($service_id == 2){
            return view( 'servicestatus.incomecertificateupdate',compact('id','services','servicename','customers','serviceid','amount','districts') );

        }elseif($service_id == 23){
        return view( 'servicestatus.smallagriserviceupdate',compact('id','services','servicename','customers','serviceid','amount','districts') );

        }elseif($service_id == 3 || $service_id == 4 || $service_id == 11 || $service_id == 14 || $service_id == 20 ){
            // dd($services);
            return view( 'servicestatus.tnegastatusupdate1',compact('id','services','servicename','customers','serviceid','amount','districts') );
        }
        elseif($service_id == 15 ){
            return view('servicestatus.tnegastatusupdate6',compact('id','services','servicename','customers','serviceid','amount','districts') );
        }
        elseif($service_id == 22 || $service_id == 24 || $service_id == 25 || $service_id == 26){

            return view('servicestatus.tnegastatusupdate2',compact('id','services','servicename','customers','serviceid','amount','districts') );
        }
        elseif($service_id == 27 || $service_id == 28 || $service_id == 129){
            return view('servicestatus.tnegastatusupdate3',compact('id','services','servicename','customers','serviceid','amount','districts') );
        }
        elseif($service_id == 151 ){
            return view('servicestatus.tnegastatusupdate4',compact('id','services','servicename','customers','serviceid','amount','districts') );
        }
        elseif($service_id == 170 || $service_id == 171 || $service_id == 172 || $service_id == 176 || $service_id == 177 || $service_id == 178 ){
            return view('servicestatus.tnegastatusupdate5',compact('id','services','servicename','customers','serviceid','amount','districts') );
        }
        elseif($service_id == 169 ){
            return view('servicestatus.vle_insurancestatusupdate',compact('id','services','servicename','customers','serviceid','amount','districts') );
        }
        elseif($service_id == 167 ){
            return view('servicestatus.ins_examstatusupdate',compact('id','services','servicename','customers','serviceid','amount','districts') );
        }
        elseif($service_id == 166 ){
            return view('servicestatus.iibf_exam_registerstatusupdate',compact('id','services','servicename','customers','serviceid','amount','districts') );
        }
        elseif($service_id == 168 ){
            return view('servicestatus.rap_exam_statusupdate',compact('id','services','servicename','customers','serviceid','amount','districts') );
        }
        elseif($service_id == 34 ){
///dd($services);
            return view('servicestatus.msmestatusupdate',compact('id','services','servicename','customers','serviceid','amount','districts') );
        }
        elseif($service_id == 51 ){
///dd($services);
            return view('servicestatus.itrstatusupdate',compact('id','services','servicename','customers','serviceid','amount','districts') );
        }
        elseif($service_id == 52 ){
///dd($services);
            return view('servicestatus.gststatusupdate',compact('id','services','servicename','customers','serviceid','amount','districts') );
        }elseif($service_id == 54 ){
///dd($services);
            return view('servicestatus.tecexamstatusupdate',compact('id','services','servicename','customers','serviceid','amount','districts') );
        }elseif($service_id == 55 ){
///dd($services);
            return view('servicestatus.tecexamregisterstatusupdate',compact('id','services','servicename','customers','serviceid','amount','districts') );
        }elseif( $service_id == 36 || $service_id == 37 || $service_id == 38 || $service_id == 39 || $service_id == 41 || $service_id == 42 || $service_id == 43 ){
///dd($services);
            return view('servicestatus.smartcardstatusupdate',compact('id','services','servicename','customers','serviceid','amount','districts') );
        }elseif($service_id == 56 || $service_id == 58 || $service_id == 158 || $service_id == 159 || $service_id == 160 || $service_id == 161 || $service_id == 162 || $service_id == 163){
///dd($services);
            return view('servicestatus.aadhaarcardupdate',compact('id','services','servicename','customers','serviceid','amount','districts') );
        } elseif($service_id == 60 || $service_id == 62 || $service_id == 63 || $service_id == 64 || $service_id == 66 || $service_id  == 121 ){
            return view('servicestatus.caneditupdate',compact('id','services','servicename','customers','serviceid','amount','districts') );

        }elseif($service_id == 65 || $service_id == 67 || $service_id == 225 || $service_id == 226){
            return view('servicestatus.cancertificate_find_update',compact('id','services','servicename','customers','serviceid','amount','districts') );

        }elseif($service_id == 69 || $service_id == 71 || $service_id == 70){
            $mainbalance = DB::table( 'users' )->select('rawallet')->where('id',2)->first();
            $services = DB::table('pancard')->where('id',$id)->where('status',$status)->first();

        } elseif($service_id == 72 ){
            return view('servicestatus.findaadhaar_numberupdate',compact('id','services','servicename','customers','serviceid','amount','districts') );

        } elseif($service_id == 113 || $service_id == 120 || $service_id == 164 || $service_id == 182){
            return view('servicestatus.voteridupdate',compact('id','services','servicename','customers','serviceid','amount','districts','selectedCorrections') );

        }elseif($service_id == 181){
            return view('servicestatus.voteridcorrectionupdate',compact('id','services','servicename','customers','serviceid','amount','districts') );

        }
        elseif($service_id == 77 || $service_id == 78 || $service_id == 79 || $service_id == 80 || $service_id == 81 || $service_id == 82 || $service_id == 83 || $service_id == 84 ){
            return view('servicestatus.smartcardupdate1',compact('id','services','servicename','customers','serviceid','amount','districts') );

        } elseif( $service_id == 100 ){
            return view('servicestatus.bondupdate',compact('id','services','servicename','customers','serviceid','amount','districts') );

        } elseif( $service_id == 122 || $service_id == 123){
            return view('servicestatus.fssaiupdate',compact('id','services','servicename','customers','serviceid','amount','districts') );

        }   elseif( $service_id == 124 ){
            return view('servicestatus.teccorrectionstatusupdate',compact('id','services','servicename','customers','serviceid','amount','districts') );

        }   elseif( $service_id == 125 ){
            return view('servicestatus.covidstatusupdate',compact('id','services','servicename','customers','serviceid','amount','districts') );

        }   elseif( $service_id == 155 || $service_id == 156){
            return view('servicestatus.birthcertificate_statusupdate',compact('id','services','servicename','customers','serviceid','amount','districts') );

        }  elseif($service_id == 148 || $service_id == 150 ){
         return view('servicestatus.licensestatusupdate',compact('id','services','servicename','customers','serviceid','amount','districts') );

    }  elseif( $service_id == 95 || $service_id == 96 || $service_id == 97 || $service_id == 98 ){
        return view('servicestatus.nalavariyamupdate',compact('id','services','servicename','customers','serviceid','amount','districts') );

    }  elseif( $service_id == 157 ){
        return view('servicestatus.pmkissanservice_update',compact('id','services','servicename','customers','serviceid','amount','districts') );

    }   elseif( $service_id == 165 ){
        return view('servicestatus.tec_csc_service_update',compact('id','services','servicename','customers','serviceid','amount','districts') );

    }   elseif( $service_id == 179 || $service_id == 180 ){
        return view('servicestatus.medicalscheme_statusupdate',compact('id','services','servicename','customers','serviceid','amount','districts') );

    }   elseif( $service_id == 183 || $service_id == 184 || $service_id == 185 || $service_id == 186 ){
        return view('servicestatus.dharsan_statusupdate',compact('id','services','servicename','customers','serviceid','amount','districts') );

    }   elseif( $service_id == 187 || $service_id == 188 || $service_id == 189 || $service_id == 190 || $service_id == 191 || $service_id == 192 || $service_id == 193 || $service_id == 194 || $service_id == 195 || $service_id == 196 || $service_id == 197 || $service_id == 198 || $service_id == 199 || $service_id == 200 || $service_id == 201 || $service_id == 202 || $service_id == 203 ){
        return view('servicestatus.softwarestatusupdate',compact('id','services','servicename','customers','serviceid','amount','districts') );

    }   elseif( $service_id == 213 || $service_id == 214 || $service_id == 215 ){
        return view('servicestatus.pattastatusupdate',compact('id','services','servicename','customers','serviceid','amount','districts') );

    }   elseif( $service_id == 208 || $service_id == 209 || $service_id == 210 || $service_id == 211 || $service_id == 233 || $service_id == 234){
    return view('servicestatus.can_editupdate',compact('id','services','servicename','customers','serviceid','amount','districts') );

    }  elseif( $service_id == 152 || $service_id == 153 || $service_id == 154){
        return view('servicestatus.tailorshop_statusupdate',compact('id','services','servicename','customers','serviceid','amount','districts') );

     }  elseif($service_id == 220 ){
        return view('servicestatus.smartcard_otpstatusupdate',compact('id','services','servicename','customers','serviceid','amount','districts') );
 }  elseif($service_id == 221 || $service_id == 222 || $service_id == 227 || $service_id == 228 || $service_id == 229 || $service_id == 230 || $service_id == 231 || $service_id == 232 || $service_id == 235){
        return view('servicestatus.smartcard_nametransferstatusupdate',compact('id','services','servicename','customers','serviceid','amount','districts') );

}


}

public function submit_statusupdate_tnegaservices1(Request $request){
    $apply_user_id = 0;
    if ($request->distributor_id == 0 && $request->retailer_id == 0) {
        $apply_user_id = $request->user_id;
    }
    elseif($request->retailer_id == 0){
        $apply_user_id = $request->distributor_id;
    }elseif($request->distributor_id == 0){
        $apply_user_id = $request->retailer_id;
    }
    if($apply_user_id != Auth::user()->id){
        $status = $request->status;
        if($status == "Resubmit"){
            DB::table( 'tnega_services' )->where('id', $request->applied_serviceid)->update( [
                'remarks'  => $request->remarks,
                'status'  => $status,
            ] );
        }elseif($status == "Processing"){
            if ( $request->acknowledgement != null ) {
                $acknowledgement = uniqid().'.'.$request->file( 'acknowledgement' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'acknowledgement' . DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'acknowledgement' ][ 'tmp_name' ], $filepath . $acknowledgement );
                DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
                    'acknowledgement' => $acknowledgement,
                ] );
            }
            DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
                'status' => $status,
                'application_no' => $request->application_no,
                'selects' => $request->selects,
            ] );
        }elseif($status == "Approved"){
            if ( $request->certificate != null ) {
                $certificate = uniqid().'.'.$request->file( 'certificate' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'certificate'. DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'certificate' ][ 'tmp_name' ], $filepath . $certificate );
                DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
                    'certificate' => $certificate,
                    'status' => $status,
                    'completed_date' => date("Y-m-d"),
                ] );
            }
            DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
                'status' => $status,
                'application' => $request->application,
                'lects' => $request->lects,
            ] );
        }elseif($status == "Rejected"){
            $serviceid = $request->serviceid;
            $getservice_payment = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
            $getusers = DB::table( 'users' )->where('id',$apply_user_id)->first();
            $usertype = 0;
            if($getusers){
                $usertype = $getusers->user_type_id;
            }
            $payment = 0;
            if($getservice_payment){
                if($usertype == 3){
                  $payment = $getservice_payment->distributor_amount;
              }elseif($usertype == 4){
                  $payment = $getservice_payment->retailer_amount;
              }elseif($usertype == 5){
                  $payment = $getservice_payment->customer_amount;
              }
          }

          $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
          $servicename = "";
          if($getservicename){
            $servicename = $getservicename->service_name;
        }
        $date = date( 'Y-m-d' );
        $time = date( 'H:i:s' );
        $service_status = 'Out Payment';
        $ad_info = "Service Refund For". ' ' .$servicename;

        $getwallet = DB::table( 'users' )->select('wallet')->where('id',1)->first();
        $balance = 0;
        if($getwallet){
            $balance = $getwallet->wallet;
        }
        $getuserswallet = DB::table( 'users' )->select('wallet')->where('id',$apply_user_id)->first();
        $balance1 = 0;
        if($getuserswallet){
            $balance1 = $getuserswallet->wallet;
        }
        $newbalance = $balance - $payment;
        $newbalance1 = $balance1 + $payment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$apply_user_id','1','$apply_user_id','$payment','$ad_info', '$service_status','$time','$date','$apply_user_id','$newbalance')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet - $payment where id = 1";
        DB::update( DB::raw( $sql ) );
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$apply_user_id','$apply_user_id','1','$payment','$ad_info', '$service_status','$time','$date','$apply_user_id','$newbalance1')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet + $payment where id = $apply_user_id";
        DB::update( DB::raw( $sql ) );

        DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
        ] );

    }
    }else{
        $status = "Pending";
        $serviceid = $request->serviceid;
        if($serviceid == 3){
            if ($request->tc_community_certificate != null) {
                $tc_community_certificate = uniqid().'.'.$request->file('tc_community_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'tc_community_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['tc_community_certificate']['tmp_name'], $filepath . $tc_community_certificate);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'tc_community_certificate'         => $tc_community_certificate,
                ]);
            }

            DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                'relationship'           => $request->relationship,

            ]);
        }elseif($serviceid == 4){
            if ($request->income_certificate != null) {
                $income_certificate = uniqid().'.'.$request->file('income_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'income_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['income_certificate']['tmp_name'], $filepath . $income_certificate);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'income_certificate'         => $income_certificate,
                ]);
            }
            if ($request->community_certificate != null) {
                $community_certificate = uniqid().'.'.$request->file('community_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'community_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['community_certificate']['tmp_name'], $filepath . $community_certificate);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'community_certificate'         => $community_certificate,
                ]);
            }

        }elseif($serviceid == 11){
            if ($request->birth_certificate != null) {
                $birth_certificate = uniqid().'.'.$request->file('birth_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'birth_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['birth_certificate']['tmp_name'], $filepath . $birth_certificate);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'birth_certificate'         => $birth_certificate,
                ]);
            }

        } elseif($serviceid == 14){
            if ($request->smartcard_online != null) {
                $smartcard_online = uniqid().'.'.$request->file('smartcard_online')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'smartcard_online' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['smartcard_online']['tmp_name'], $filepath . $smartcard_online);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'smartcard_online'         => $smartcard_online,
                ]);
            }

            DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                'smartcard_no'             => $request->smartcard_no,
            ]);
        }
        elseif($serviceid == 20){
            if ($request->birth_certificate != null) {
                $birth_certificate = uniqid().'.'.$request->file('birth_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'birth_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['birth_certificate']['tmp_name'], $filepath . $birth_certificate);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'birth_certificate'         => $birth_certificate,
                ]);
            }

            if ($request->voterid != null) {
                $voterid = uniqid().'.'.$request->file('voterid')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'voterid' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['voterid']['tmp_name'], $filepath . $voterid);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'voterid'         => $voterid,
                ]);
            }

            if ($request->driving_license != null) {
                $driving_license = uniqid().'.'.$request->file('driving_license')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'driving_license' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['driving_license']['tmp_name'], $filepath . $driving_license);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'driving_license'         => $driving_license,
                ]);
            }

            if ($request->marksheet != null) {
                $marksheet = uniqid().'.'.$request->file('marksheet')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'marksheet' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['marksheet']['tmp_name'], $filepath . $marksheet);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'marksheet'         => $marksheet,
                ]);
            }

            if ($request->tc_community_certificate != null) {
                $tc_community_certificate = uniqid().'.'.$request->file('tc_community_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'tc_community_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['tc_community_certificate']['tmp_name'], $filepath . $tc_community_certificate);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'tc_community_certificate'         => $tc_community_certificate,
                ]);
            }

            if ($request->mrg_invitation != null) {
                $mrg_invitation = uniqid().'.'.$request->file('mrg_invitation')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'mrg_invitation' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['mrg_invitation']['tmp_name'], $filepath . $mrg_invitation);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'mrg_invitation'         => $mrg_invitation,
                ]);
            }
            DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                'age_proof'         => $request->age_proof,
            ]);

        }

        DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
            'can_number'        => $request->can_number,
            'can_details'        => $request->can_details,
            'personalized'        => $request->personalized,
            'relationship_1'        => $request->relationship_1,
            'mother_name_tamil'        => $request->mother_name_tamil,
            'mother_name_english'        => $request->mother_name_english,
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
            'postal_area_tamil'        => $request->postal_area_tamil,
            'postal_area_english'        => $request->postal_area_english,
            'father_community'        => $request->father_community,
            'father_caste'          => $request->father_caste,
            'mother_community'        => $request->mother_community,
            'mother_caste'        => $request->mother_caste,
        ] );
   $getpermission = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
    $coordinator_permission = 0;
    if($getpermission){
        $coordinator_permission = $getpermission->coordinator_permission;
    }
    if($coordinator_permission == 1){
      $post_data = array();
     $getdata = DB::table( 'tnega_services' )->where('id',$request->applied_serviceid)->get();
     $getdata = json_decode( json_encode( $getdata ), true );
            foreach ( $getdata as $key => $ser ) {
                $getdata[ $key ][ 'family_details' ] = array();
                $getdata[ $key ][ 'customer_details' ] = array();
                $getdata[ $key ][ 'details' ] = array();
                $getdata[ $key ][ 'agri_details' ] = array();
                $getdata[ $key ][ 'agri_documents' ] = array();
                $ser_id = $ser[ 'id' ];
                $user_id = $ser[ 'user_id' ];
                $sql = "select * from family_member where service_id=$ser_id order by id Asc";
                $result = DB::select( $sql );
                $sql = "select * from users where id=$user_id";
                $result1 = DB::select( $sql );
                $getdata[ $key ][ 'family_details' ] = $result;
                $getdata[ $key ][ 'customer_details' ] = $result1;
            }
    if(count($getdata) > 0){

     $API_KEY = env( 'API_KEY', '' );
     $RAMJIPAY_URL = env( 'RAMJIPAY_URL', '' );
     $WEBSITE_INDEX = env( 'WEBSITE_INDEX', '' );
      $post_data['data'] = $getdata;
      $post_data['key'] = $API_KEY;
      $post_data['index'] = $WEBSITE_INDEX;
     $ch = curl_init();

        //dd($post_data);
        $url1 = $RAMJIPAY_URL.'/api/update_tnegaservices_api';
        //echo $url1;die;

        curl_setopt( $ch, CURLOPT_URL, $url1 );
        curl_setopt( $ch, CURLOPT_POST, 1 );
        curl_setopt( $ch, CURLOPT_POSTFIELDS,json_encode($post_data) );
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $server_output = curl_exec( $ch );
        curl_close( $ch );
        $resdata = json_decode($server_output, true);
    //dd($resdata);
    }
    }
     DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
        ] );
    }

    return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}
public function submit_statusupdate_incomecertificate(Request $request){
    //dd($request->all());
$apply_user_id = 0;
if ($request->distributor_id == 0 && $request->retailer_id == 0) {
    $apply_user_id = $request->user_id;
}
elseif($request->retailer_id == 0){
    $apply_user_id = $request->distributor_id;
}elseif($request->distributor_id == 0){
    $apply_user_id = $request->retailer_id;
}
if($apply_user_id != Auth::user()->id){
    $status = $request->status;
    if($status == "Resubmit"){
        DB::table( 'tnega_services' )->where('id', $request->applied_serviceid)->update( [
            'remarks'  => $request->remarks,
            'status'  => $status,
        ] );
    }elseif($status == "Processing"){
        if ( $request->acknowledgement != null ) {
            $acknowledgement = uniqid().'.'.$request->file( 'acknowledgement' )->extension();
            $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'acknowledgement' . DIRECTORY_SEPARATOR);
            move_uploaded_file( $_FILES[ 'acknowledgement' ][ 'tmp_name' ], $filepath . $acknowledgement );
            DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
                'acknowledgement' => $acknowledgement,
            ] );
        }
        DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
            'application_no' => $request->application_no,
            'selects' => $request->selects,
        ] );
    }elseif($status == "Approved"){
        if ( $request->certificate != null ) {
            $certificate = uniqid().'.'.$request->file( 'certificate' )->extension();
            $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'certificate'. DIRECTORY_SEPARATOR);
            move_uploaded_file( $_FILES[ 'certificate' ][ 'tmp_name' ], $filepath . $certificate );
            DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
                'certificate' => $certificate,
                'status' => $status,
                'completed_date' => date("Y-m-d"),
            ] );
        }
        DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
            'application' => $request->application,
            'lects' => $request->lects,
        ] );
    }elseif($status == "Rejected"){
        $serviceid = $request->serviceid;
        $getservice_payment = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
        $getusers = DB::table( 'users' )->where('id',$apply_user_id)->first();
        $usertype = 0;
        if($getusers){
            $usertype = $getusers->user_type_id;
        }
        $payment = 0;
        if($getservice_payment){
            if($usertype == 3){
              $payment = $getservice_payment->distributor_amount;
          }elseif($usertype == 4){
              $payment = $getservice_payment->retailer_amount;
          }elseif($usertype == 5){
              $payment = $getservice_payment->customer_amount;
          }
      }

      $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
      $servicename = "";
      if($getservicename){
        $servicename = $getservicename->service_name;
    }
    $date = date( 'Y-m-d' );
    $time = date( 'H:i:s' );
    $service_status = 'Out Payment';
    $ad_info = "Service Refund For". ' ' .$servicename;

    $getwallet = DB::table( 'users' )->select('wallet')->where('id',1)->first();
    $balance = 0;
    if($getwallet){
        $balance = $getwallet->wallet;
    }
    $getuserswallet = DB::table( 'users' )->select('wallet')->where('id',$apply_user_id)->first();
    $balance1 = 0;
    if($getuserswallet){
        $balance1 = $getuserswallet->wallet;
    }
    $newbalance = $balance - $payment;
    $newbalance1 = $balance1 + $payment;

    $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$apply_user_id','1','$apply_user_id','$payment','$ad_info', '$service_status','$time','$date','$apply_user_id','$newbalance')";
    DB::insert( DB::raw( $sql ) );
    $sql = "update users set wallet = wallet - $payment where id = 1";
    DB::update( DB::raw( $sql ) );
    $service_status = 'IN Payment';
    $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$apply_user_id','$apply_user_id','1','$payment','$ad_info', '$service_status','$time','$date','$apply_user_id','$newbalance1')";
    DB::insert( DB::raw( $sql ) );
    $sql = "update users set wallet = wallet + $payment where id = $apply_user_id";
    DB::update( DB::raw( $sql ) );

    DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
        'status' => $status,
    ] );

}
}else{
$status = "Pending";
$serviceid = $request->serviceid;
if($serviceid == 2){
    if ($request->salary_slip != null) {
        $salaryslip = uniqid().'.'.$request->file('salary_slip')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'salary_slip' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['salary_slip']['tmp_name'], $filepath . $salaryslip);
        DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
            'salary_slip'         => $salaryslip,
        ]);
    }

    if ($request->pancard != null) {
        $pancard = uniqid().'.'.$request->file('pancard')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'pancard' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['pancard']['tmp_name'], $filepath . $pancard);
        DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
            'pancard'         => $pancard,
        ]);
    }
    DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
        'job_type'            => $request->job_type,
        'income_yearly'       => $request->income_yearly,
        'income_monthly'       => $request->income_monthly,

    ]);

}

DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
    'status' => $status,
    'can_number'        => $request->can_number,
    'can_details'        => $request->can_details,
    'personalized'        => $request->personalized,
    'relationship_1'        => $request->relationship_1,
    'mother_name_tamil'        => $request->mother_name_tamil,
    'mother_name_english'        => $request->mother_name_english,
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
    'postal_area_tamil'        => $request->postal_area_tamil,
    'postal_area_english'        => $request->postal_area_english,
    'mother_name_tamil'        => $request->mother_name_tamil,
    'mother_name_english'        => $request->mother_name_english,

] );

if($request->has('family_relationship')){
    DB::table( 'family_member' )->where('service_id', $request->applied_serviceid)->delete();
    foreach ( $request->family_relationship as $key => $relation ) {
      $relation_name = $request->relation_name[ $key ];
      $relation_name_tamil = $request->relation_name_tamil[ $key ];
      $relation_age = $request->relation_age[ $key ];
      $relation_income = $request->relation_income[ $key ];
      $occupation = $request->occupation[ $key ];

      $sql = "insert into family_member (service_id,relation,relation_name,relation_name_tamil,relation_age,relation_income,occupation) values ($request->applied_serviceid,'$relation','$relation_name','$relation_name_tamil','$relation_age','$relation_income','$occupation')";
      DB::insert( $sql );


  }
}
$getpermission = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
    $coordinator_permission = 0;
    if($getpermission){
        $coordinator_permission = $getpermission->coordinator_permission;
    }
    if($coordinator_permission == 1){
      $post_data = array();
     $getdata = DB::table( 'tnega_services' )->where('id',$request->applied_serviceid)->get();
     $getdata = json_decode( json_encode( $getdata ), true );
            foreach ( $getdata as $key => $ser ) {
                $getdata[ $key ][ 'family_details' ] = array();
                $getdata[ $key ][ 'customer_details' ] = array();
                $getdata[ $key ][ 'details' ] = array();
                $getdata[ $key ][ 'agri_details' ] = array();
                $getdata[ $key ][ 'agri_documents' ] = array();
                $ser_id = $ser[ 'id' ];
                $user_id = $ser[ 'user_id' ];
                $sql = "select * from family_member where service_id=$ser_id order by id Asc";
                $result = DB::select( $sql );
                $sql = "select * from users where id=$user_id";
                $result1 = DB::select( $sql );
                $getdata[ $key ][ 'family_details' ] = $result;
                $getdata[ $key ][ 'customer_details' ] = $result1;
            }
    if(count($getdata) > 0){

     $API_KEY = env( 'API_KEY', '' );
     $RAMJIPAY_URL = env( 'RAMJIPAY_URL', '' );
     $WEBSITE_INDEX = env( 'WEBSITE_INDEX', '' );
      $post_data['data'] = $getdata;
      $post_data['key'] = $API_KEY;
      $post_data['index'] = $WEBSITE_INDEX;
      $ch = curl_init();

        //dd($post_data);
        $url1 = $RAMJIPAY_URL.'/api/update_tnegaservices_api';
        //echo $url1;die;

        curl_setopt( $ch, CURLOPT_URL, $url1 );
        curl_setopt( $ch, CURLOPT_POST, 1 );
        curl_setopt( $ch, CURLOPT_POSTFIELDS,json_encode($post_data) );
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $server_output = curl_exec( $ch );
        curl_close( $ch );
        $resdata = json_decode($server_output, true);
       //dd($resdata);
    }

        }
        DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
        ] );
    }

return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}

public function submit_statusupdate_smallagriservice(Request $request){
    //dd($request->all());
$apply_user_id = 0;
if ($request->distributor_id == 0 && $request->retailer_id == 0) {
    $apply_user_id = $request->user_id;
}
elseif($request->retailer_id == 0){
    $apply_user_id = $request->distributor_id;
}elseif($request->distributor_id == 0){
    $apply_user_id = $request->retailer_id;
}
if($apply_user_id != Auth::user()->id){
    $status = $request->status;
    if($status == "Resubmit"){
        DB::table( 'tnega_services' )->where('id', $request->applied_serviceid)->update( [
            'remarks'  => $request->remarks,
            'status'  => $status,
        ] );
    }elseif($status == "Processing"){
        if ( $request->acknowledgement != null ) {
            $acknowledgement = uniqid().'.'.$request->file( 'acknowledgement' )->extension();
            $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'acknowledgement' . DIRECTORY_SEPARATOR);
            move_uploaded_file( $_FILES[ 'acknowledgement' ][ 'tmp_name' ], $filepath . $acknowledgement );
            DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
                'acknowledgement' => $acknowledgement,
            ] );
        }
        DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
            'application_no' => $request->application_no,
            'selects' => $request->selects,
        ] );
    }elseif($status == "Approved"){
        if ( $request->certificate != null ) {
            $certificate = uniqid().'.'.$request->file( 'certificate' )->extension();
            $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'certificate'. DIRECTORY_SEPARATOR);
            move_uploaded_file( $_FILES[ 'certificate' ][ 'tmp_name' ], $filepath . $certificate );
            DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
                'certificate' => $certificate,
                'status' => $status,
                'completed_date' => date("Y-m-d"),
            ] );
        }
        DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
            'application' => $request->application,
            'lects' => $request->lects,
        ] );
    }elseif($status == "Rejected"){
        $serviceid = $request->serviceid;
        $getservice_payment = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
        $getusers = DB::table( 'users' )->where('id',$apply_user_id)->first();
        $usertype = 0;
        if($getusers){
            $usertype = $getusers->user_type_id;
        }
        $payment = 0;
        if($getservice_payment){
            if($usertype == 3){
              $payment = $getservice_payment->distributor_amount;
          }elseif($usertype == 4){
              $payment = $getservice_payment->retailer_amount;
          }elseif($usertype == 5){
              $payment = $getservice_payment->customer_amount;
          }
      }

      $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
      $servicename = "";
      if($getservicename){
        $servicename = $getservicename->service_name;
    }
    $date = date( 'Y-m-d' );
    $time = date( 'H:i:s' );
    $service_status = 'Out Payment';
    $ad_info = "Service Refund For". ' ' .$servicename;

    $getwallet = DB::table( 'users' )->select('wallet')->where('id',1)->first();
    $balance = 0;
    if($getwallet){
        $balance = $getwallet->wallet;
    }
    $getuserswallet = DB::table( 'users' )->select('wallet')->where('id',$apply_user_id)->first();
    $balance1 = 0;
    if($getuserswallet){
        $balance1 = $getuserswallet->wallet;
    }
    $newbalance = $balance - $payment;
    $newbalance1 = $balance1 + $payment;

    $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$apply_user_id','1','$apply_user_id','$payment','$ad_info', '$service_status','$time','$date','$apply_user_id','$newbalance')";
    DB::insert( DB::raw( $sql ) );
    $sql = "update users set wallet = wallet - $payment where id = 1";
    DB::update( DB::raw( $sql ) );
    $service_status = 'IN Payment';
    $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$apply_user_id','$apply_user_id','1','$payment','$ad_info', '$service_status','$time','$date','$apply_user_id','$newbalance1')";
    DB::insert( DB::raw( $sql ) );
    $sql = "update users set wallet = wallet + $payment where id = $apply_user_id";
    DB::update( DB::raw( $sql ) );

    DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
        'status' => $status,
    ] );

}
}else{
$status = "Pending";
$serviceid = $request->serviceid;
if($serviceid == 23){
    if ($request->chitta != null) {
         $chitta = uniqid().'.'.$request->file('chitta')->extension();
         $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'chitta' . DIRECTORY_SEPARATOR);
         move_uploaded_file($_FILES['chitta']['tmp_name'], $filepath . $chitta);
         DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
             'chitta'         => $chitta,
         ]);
     }

     if ($request->aggregation != null) {
         $aggregation = uniqid().'.'.$request->file('aggregation')->extension();
         $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aggregation' . DIRECTORY_SEPARATOR);
         move_uploaded_file($_FILES['aggregation']['tmp_name'], $filepath . $aggregation);
         DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
             'aggregation'         => $aggregation,
         ]);
     }

    if ($request->strap != null) {
        $strap = uniqid().'.'.$request->file('strap')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'strap' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['strap']['tmp_name'], $filepath . $strap);
        DB::table('tnega_services')->where('id', $insertid)->update([
        'strap'         => $strap,
    ]);
    }

    DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
        'any_proof'            => $request->any_proof,
        'area'       => $request->area,

    ]);

}

DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
    'status' => $status,
    'can_number'        => $request->can_number,
    'can_details'        => $request->can_details,
    'personalized'        => $request->personalized,
    'relationship_1'        => $request->relationship_1,
    'mother_name_tamil'        => $request->mother_name_tamil,
    'mother_name_english'        => $request->mother_name_english,
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
    'postal_area_tamil'        => $request->postal_area_tamil,
    'postal_area_english'        => $request->postal_area_english,
] );

if($request->has('doc_id')){
    foreach ( $request->doc_id as $key => $id ) {
      $doc_name = $request->doc_name[ $key ];
     DB::table( 'document' )->where( 'id', $id )->update( [
              'doc_name'       => $doc_name,
          ] );
              if (isset($request->doc[$key])) {
        if ($request->doc[$key] != null) {
            $file1 = uniqid().'.'.$request->file('doc')[$key]->extension();
      //dd($request->doc[$key]);
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'doc' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['doc']['tmp_name'][$key], $filepath . $file1);
            DB::table( 'document' )->where( 'id', $id )->update( [
              'doc'       => $file1,
          ] );
        }
    }
  }
}

if($request->has('district')){
DB::table( 'agri_details' )->where('service_id', $request->applied_serviceid)->delete();
 foreach ( $request->proof as $key => $proof ) {
  $district = $request->district[ $key ];
  $taluk = $request->taluk[ $key ];
  $village = $request->village[ $key ];
  $patta_no = $request->patta_no[ $key ];
  $field_no = $request->field_no[ $key ];
  $subdivision_no = $request->subdivision_no[ $key ];
  $area = $request->area1[ $key ];

  $sql = "insert into agri_details (service_id,district,taluk,village,patta_no,field_no,subdivision_no,area,pattatype) values ($request->applied_serviceid,'$district','$taluk','$village','$patta_no','$field_no','$subdivision_no','$area','$proof')";
  DB::insert( $sql );


}
}
$getpermission = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
    $coordinator_permission = 0;
    if($getpermission){
        $coordinator_permission = $getpermission->coordinator_permission;
    }
    if($coordinator_permission == 1){
     $post_data = array();
     $getdata = DB::table( 'tnega_services' )->where('id',$request->applied_serviceid)->get();
     $getdata = json_decode( json_encode( $getdata ), true );
            foreach ( $getdata as $key => $ser ) {
                $getdata[ $key ][ 'family_details' ] = array();
                $getdata[ $key ][ 'customer_details' ] = array();
                $getdata[ $key ][ 'agri_details' ] = array();
                $getdata[ $key ][ 'agri_documents' ] = array();
                $getdata[ $key ][ 'details' ] = array();
                $ser_id = $ser[ 'id' ];
                $user_id = $ser[ 'user_id' ];
                $sql = "select * from family_member where service_id=$ser_id order by id Asc";
                $result = DB::select( $sql );
                $sql = "select * from users where id=$user_id";
                $result1 = DB::select( $sql );
                 $sql = "select * from agri_details where service_id=$ser_id order by id Asc";
                $result2 = DB::select( $sql );
                 $sql = "select * from document where service_id=$ser_id order by id Asc";
                $result3 = DB::select( $sql );
                $getdata[ $key ][ 'family_details' ] = $result;
                $getdata[ $key ][ 'customer_details' ] = $result1;
                $getdata[ $key ][ 'agri_details' ] = $result2;
                $getdata[ $key ][ 'agri_documents' ] = $result3;

            }
    if(count($getdata) > 0){

     $API_KEY = env( 'API_KEY', '' );
     $RAMJIPAY_URL = env( 'RAMJIPAY_URL', '' );
     $WEBSITE_INDEX = env( 'WEBSITE_INDEX', '' );
      $post_data['data'] = $getdata;
      $post_data['key'] = $API_KEY;
      $post_data['index'] = $WEBSITE_INDEX;
     $ch = curl_init();

        //dd($post_data);
        $url1 = $RAMJIPAY_URL.'/api/update_tnegaservices_api';
        //echo $url1;die;

        curl_setopt( $ch, CURLOPT_URL, $url1 );
        curl_setopt( $ch, CURLOPT_POST, 1 );
        curl_setopt( $ch, CURLOPT_POSTFIELDS,json_encode($post_data) );
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $server_output = curl_exec( $ch );
        curl_close( $ch );
        $resdata = json_decode($server_output, true);
       //dd($resdata);
    }
    }
     DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
        ] );
    }

return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}

public function submit_statusupdate_tnegaservices2(Request $request){
    $apply_user_id = 0;
    if ($request->distributor_id == 0 && $request->retailer_id == 0) {
        $apply_user_id = $request->user_id;
    }
    elseif($request->retailer_id == 0){
        $apply_user_id = $request->distributor_id;
    }elseif($request->distributor_id == 0){
        $apply_user_id = $request->retailer_id;
    }
    if($apply_user_id != Auth::user()->id){
        $status = $request->status;
        if($status == "Resubmit"){
            DB::table( 'tnega_services' )->where('id', $request->applied_serviceid)->update( [
                'remarks'  => $request->remarks,
                'status'  => $status,
            ] );
        }elseif($status == "Processing"){
            if ( $request->acknowledgement != null ) {
                $acknowledgement = uniqid().'.'.$request->file( 'acknowledgement' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'acknowledgement' . DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'acknowledgement' ][ 'tmp_name' ], $filepath . $acknowledgement );
                DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
                    'acknowledgement' => $acknowledgement,
                ] );
            }
            DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
                'status' => $status,
                'application_no' => $request->application_no,
                'selects' => $request->selects,
            ] );
        }elseif($status == "Approved"){
            if ( $request->certificate != null ) {
                $certificate = uniqid().'.'.$request->file( 'certificate' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'certificate'. DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'certificate' ][ 'tmp_name' ], $filepath . $certificate );
                DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
                    'certificate' => $certificate,
                    'status' => $status,
                    'completed_date' => date("Y-m-d"),
                ] );
            }
            DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
                'status' => $status,
                'application' => $request->application,
                'lects' => $request->lects,
            ] );
        }elseif($status == "Rejected"){
            $serviceid = $request->serviceid;
            $getservice_payment = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
            $getusers = DB::table( 'users' )->where('id',$apply_user_id)->first();
            $usertype = 0;
            if($getusers){
                $usertype = $getusers->user_type_id;
            }
            $payment = 0;
            if($getservice_payment){
                if($usertype == 3){
                  $payment = $getservice_payment->distributor_amount;
              }elseif($usertype == 4){
                  $payment = $getservice_payment->retailer_amount;
              }elseif($usertype == 5){
                  $payment = $getservice_payment->customer_amount;
              }
          }

          $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
          $servicename = "";
          if($getservicename){
            $servicename = $getservicename->service_name;
        }
        $date = date( 'Y-m-d' );
        $time = date( 'H:i:s' );
        $service_status = 'Out Payment';
        $ad_info = "Service Refund For". ' ' .$servicename;

        $getwallet = DB::table( 'users' )->select('wallet')->where('id',1)->first();
        $balance = 0;
        if($getwallet){
            $balance = $getwallet->wallet;
        }
        $getuserswallet = DB::table( 'users' )->select('wallet')->where('id',$apply_user_id)->first();
        $balance1 = 0;
        if($getuserswallet){
            $balance1 = $getuserswallet->wallet;
        }
        $newbalance = $balance - $payment;
        $newbalance1 = $balance1 + $payment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$apply_user_id','1','$apply_user_id','$payment','$ad_info', '$service_status','$time','$date','$apply_user_id','$newbalance')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet - $payment where id = 1";
        DB::update( DB::raw( $sql ) );
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$apply_user_id','$apply_user_id','1','$payment','$ad_info', '$service_status','$time','$date','$apply_user_id','$newbalance1')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet + $payment where id = $apply_user_id";
        DB::update( DB::raw( $sql ) );

        DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
        ] );

    }
    }else{
        $status = "Pending";
        $serviceid = $request->serviceid;
        if($serviceid == 22){
            if ($request->hus_wife_photo != null) {
                $hus_wife_photo = uniqid().'.'.$request->file('hus_wife_photo')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'hus_wife_photo' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['hus_wife_photo']['tmp_name'], $filepath . $hus_wife_photo);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'hus_wife_photo'         => $hus_wife_photo,
                ]);
            }

            if ($request->permanent_social_certificate_groom != null) {
                $permanent_social_certificate_groom = uniqid().'.'.$request->file('permanent_social_certificate_groom')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'permanent_social_certificate_groom' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['permanent_social_certificate_groom']['tmp_name'], $filepath . $permanent_social_certificate_groom);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'permanent_social_certificate_groom'         => $permanent_social_certificate_groom,
                ]);
            }

            if ($request->bride_permanent_social_certificate != null) {
                $bride_permanent_social_certificate = uniqid().'.'.$request->file('bride_permanent_social_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'bride_permanent_social_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['bride_permanent_social_certificate']['tmp_name'], $filepath . $bride_permanent_social_certificate);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'bride_permanent_social_certificate'         => $bride_permanent_social_certificate,
                ]);
            }

            if ($request->mrg_registration_certificate != null) {
                $mrg_registration_certificate = uniqid().'.'.$request->file('mrg_registration_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'mrg_registration_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['mrg_registration_certificate']['tmp_name'], $filepath . $mrg_registration_certificate);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'mrg_registration_certificate'         => $mrg_registration_certificate,
                ]);
            }

            if ($request->anyothers_certificate != null) {
                $anyothers_certificate = uniqid().'.'.$request->file('anyothers_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'anyothers_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['anyothers_certificate']['tmp_name'], $filepath . $anyothers_certificate);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'anyothers_certificate'         => $anyothers_certificate,
                ]);
            }

        }elseif($serviceid == 23){
            if ($request->chitta != null) {
                $chitta = uniqid().'.'.$request->file('chitta')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'chitta' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['chitta']['tmp_name'], $filepath . $chitta);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'chitta'         => $chitta,
                ]);
            }

            if ($request->aggregation != null) {
                $aggregation = uniqid().'.'.$request->file('aggregation')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aggregation' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aggregation']['tmp_name'], $filepath . $aggregation);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'aggregation'         => $aggregation,
                ]);
            }

            if ($request->ec_certificate != null) {
                $ec_certificate = uniqid().'.'.$request->file('ec_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'ec_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['ec_certificate']['tmp_name'], $filepath . $ec_certificate);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'ec_certificate'         => $ec_certificate,
                ]);
            }

            if ($request->villankam != null) {
                $villankam = uniqid().'.'.$request->file('villankam')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'villankam' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['villankam']['tmp_name'], $filepath . $villankam);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'villankam'         => $villankam,
                ]);
            }

            if ($request->vao_certificate != null) {
                $vao_certificate = uniqid().'.'.$request->file('vao_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'vao_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['vao_certificate']['tmp_name'], $filepath . $vao_certificate);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'vao_certificate'         => $vao_certificate,
                ]);
            }

            if ($request->self_declaration_certificate != null) {
                $self_declaration_certificate = uniqid().'.'.$request->file('self_declaration_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'self_declaration_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['self_declaration_certificate']['tmp_name'], $filepath . $self_declaration_certificate);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'self_declaration_certificate'         => $self_declaration_certificate,
                ]);
            }

            if ($request->other_certificate != null) {
                $other_certificate = uniqid().'.'.$request->file('other_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'other_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['other_certificate']['tmp_name'], $filepath . $other_certificate);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'other_certificate'         => $other_certificate,
                ]);
            }

        }elseif ($serviceid == 24) {
            if ($request->bank_pass_book != null) {
                $bank_pass_book = uniqid().'.'.$request->file('bank_pass_book')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'bank_pass_book' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['bank_pass_book']['tmp_name'], $filepath . $bank_pass_book);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'bank_pass_book'         => $bank_pass_book,
                ]);
            }
            DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                'any_proof'         => $request->any_proof,
            ]);
            if ($request->passport != null) {
                $passport = uniqid().'.'.$request->file('passport')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'passport' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['passport']['tmp_name'], $filepath . $passport);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'passport'         => $passport,
                ]);
            }

            if ($request->pancard != null) {
                $pancard = uniqid().'.'.$request->file('pancard')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'pancard' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['pancard']['tmp_name'], $filepath . $pancard);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'pancard'         => $pancard,
                ]);
            }

            if ($request->voterid != null) {
                $voterid = uniqid().'.'.$request->file('voterid')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'voterid' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['voterid']['tmp_name'], $filepath . $voterid);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'voterid'         => $voterid,
                ]);
            }

            if ($request->driving_license != null) {
                $driving_license = uniqid().'.'.$request->file('driving_license')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'driving_license' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['driving_license']['tmp_name'], $filepath . $driving_license);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'driving_license'         => $driving_license,
                ]);
            }

        }   elseif ($serviceid == 25) {
            if ($request->placement_registration != null) {
                $placement_registration = uniqid().'.'.$request->file('placement_registration')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'placement_registration' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['placement_registration']['tmp_name'], $filepath . $placement_registration);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'placement_registration'         => $placement_registration,
                ]);
            }

            if ($request->school_transfer_certificate != null) {
                $school_transfer_certificate = uniqid().'.'.$request->file('school_transfer_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'school_transfer_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['school_transfer_certificate']['tmp_name'], $filepath . $school_transfer_certificate);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'school_transfer_certificate'         => $school_transfer_certificate,
                ]);
            }

            if ($request->study_proof != null) {
                $study_proof = uniqid().'.'.$request->file('study_proof')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'study_proof' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['study_proof']['tmp_name'], $filepath . $study_proof);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'study_proof'         => $study_proof,
                ]);
            }

            if ($request->family_income_certificate != null) {
                $family_income_certificate = uniqid().'.'.$request->file('family_income_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'family_income_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['family_income_certificate']['tmp_name'], $filepath . $family_income_certificate);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'family_income_certificate'         => $family_income_certificate,
                ]);
            }

        }
        elseif ($serviceid == 26) {
            if ($request->husband_death_certificate != null) {
                $husband_death_certificate = uniqid().'.'.$request->file('husband_death_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'husband_death_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['husband_death_certificate']['tmp_name'], $filepath . $husband_death_certificate);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'husband_death_certificate'         => $husband_death_certificate,
                ]);
            }

            if ($request->legal_heir_certificate != null) {
                $legal_heir_certificate = uniqid().'.'.$request->file('legal_heir_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'legal_heir_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['legal_heir_certificate']['tmp_name'], $filepath . $legal_heir_certificate);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'legal_heir_certificate'         => $legal_heir_certificate,
                ]);
            }

            if ($request->income_certificate != null) {
                $income_certificate = uniqid().'.'.$request->file('income_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'income_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['income_certificate']['tmp_name'], $filepath . $income_certificate);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'income_certificate'         => $income_certificate,
                ]);
            }

            if ($request->anyothers_certificate != null) {
                $anyothers_certificate = uniqid().'.'.$request->file('anyothers_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'anyothers_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['anyothers_certificate']['tmp_name'], $filepath . $anyothers_certificate);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'anyothers_certificate'         => $anyothers_certificate,
                ]);
            }

        }
        DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
        'status' => $status,
        'can_number'        => $request->can_number,
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
        'caste'        => $request->caste,
        'street_name'        => $request->street_name,
        'pin_code'        => $request->pin_code,
        'postal_area_tamil'        => $request->postal_area_tamil,
        'postal_area_english'        => $request->postal_area_english,
        'mother_name_tamil'        => $request->mother_name_tamil,
        'mother_name_english'        => $request->mother_name_english,
    ] );

   $getpermission = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
    $coordinator_permission = 0;
    if($getpermission){
        $coordinator_permission = $getpermission->coordinator_permission;
    }
    if($coordinator_permission == 1){
      $post_data = array();
     $getdata = DB::table( 'tnega_services' )->where('id',$request->applied_serviceid)->get();
     $getdata = json_decode( json_encode( $getdata ), true );
            foreach ( $getdata as $key => $ser ) {
                $getdata[ $key ][ 'family_details' ] = array();
                $getdata[ $key ][ 'customer_details' ] = array();
                $getdata[ $key ][ 'details' ] = array();
                $getdata[ $key ][ 'agri_details' ] = array();
                $getdata[ $key ][ 'agri_documents' ] = array();
                $ser_id = $ser[ 'id' ];
                $user_id = $ser[ 'user_id' ];
                $sql = "select * from family_member where service_id=$ser_id order by id Asc";
                $result = DB::select( $sql );
                $sql = "select * from users where id=$user_id";
                $result1 = DB::select( $sql );
                $getdata[ $key ][ 'family_details' ] = $result;
                $getdata[ $key ][ 'customer_details' ] = $result1;
            }
    if(count($getdata) > 0){

     $API_KEY = env( 'API_KEY', '' );
     $RAMJIPAY_URL = env( 'RAMJIPAY_URL', '' );
     $WEBSITE_INDEX = env( 'WEBSITE_INDEX', '' );
      $post_data['data'] = $getdata;
      $post_data['key'] = $API_KEY;
      $post_data['index'] = $WEBSITE_INDEX;
     $ch = curl_init();

        //dd($post_data);
        $url1 = $RAMJIPAY_URL.'/api/update_tnegaservices_api';
        //echo $url1;die;
        curl_setopt( $ch, CURLOPT_URL, $url1 );
        curl_setopt( $ch, CURLOPT_POST, 1 );
        curl_setopt( $ch, CURLOPT_POSTFIELDS,json_encode($post_data) );
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $server_output = curl_exec( $ch );
        curl_close( $ch );
        $resdata = json_decode($server_output, true);
       //dd($resdata);
    }
    }
     DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
        ] );
    }
    return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}

public function submit_statusupdate_tnegaservices3(Request $request){
    $apply_user_id = 0;
    if ($request->distributor_id == 0 && $request->retailer_id == 0) {
        $apply_user_id = $request->user_id;
    }
    elseif($request->retailer_id == 0){
        $apply_user_id = $request->distributor_id;
    }elseif($request->distributor_id == 0){
        $apply_user_id = $request->retailer_id;
    }
    if($apply_user_id != Auth::user()->id){
        $status = $request->status;
        if($status == "Resubmit"){
            DB::table( 'tnega_services' )->where('id', $request->applied_serviceid)->update( [
                'remarks'  => $request->remarks,
                'status'  => $status,
            ] );
        }elseif($status == "Processing"){
            if ( $request->acknowledgement != null ) {
                $acknowledgement = uniqid().'.'.$request->file( 'acknowledgement' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'acknowledgement' . DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'acknowledgement' ][ 'tmp_name' ], $filepath . $acknowledgement );
                DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
                    'acknowledgement' => $acknowledgement,
                ] );
            }
            DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
                'status' => $status,
                'application_no' => $request->application_no,
                'selects' => $request->selects,
            ] );
        }elseif($status == "Approved"){
            if ( $request->certificate != null ) {
                $certificate = uniqid().'.'.$request->file( 'certificate' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'certificate'. DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'certificate' ][ 'tmp_name' ], $filepath . $certificate );
                DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
                    'certificate' => $certificate,
                    'status' => $status,
                    'completed_date' => date("Y-m-d"),
                ] );
            }
            DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
                'status' => $status,
                'application' => $request->application,
                'lects' => $request->lects,
            ] );
        }elseif($status == "Rejected"){
            $serviceid = $request->serviceid;
            $getservice_payment = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
            $getusers = DB::table( 'users' )->where('id',$apply_user_id)->first();
            $usertype = 0;
            if($getusers){
                $usertype = $getusers->user_type_id;
            }
            $payment = 0;
            if($getservice_payment){
                if($usertype == 3){
                  $payment = $getservice_payment->distributor_amount;
              }elseif($usertype == 4){
                  $payment = $getservice_payment->retailer_amount;
              }elseif($usertype == 5){
                  $payment = $getservice_payment->customer_amount;
              }
          }

          $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
          $servicename = "";
          if($getservicename){
            $servicename = $getservicename->service_name;
        }
        $date = date( 'Y-m-d' );
        $time = date( 'H:i:s' );
        $service_status = 'Out Payment';
        $ad_info = "Service Refund For". ' ' .$servicename;

        $getwallet = DB::table( 'users' )->select('wallet')->where('id',1)->first();
        $balance = 0;
        if($getwallet){
            $balance = $getwallet->wallet;
        }
        $getuserswallet = DB::table( 'users' )->select('wallet')->where('id',$apply_user_id)->first();
        $balance1 = 0;
        if($getuserswallet){
            $balance1 = $getuserswallet->wallet;
        }
        $newbalance = $balance - $payment;
        $newbalance1 = $balance1 + $payment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$apply_user_id','1','$apply_user_id','$payment','$ad_info', '$service_status','$time','$date','$apply_user_id','$newbalance')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet - $payment where id = 1";
        DB::update( DB::raw( $sql ) );
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$apply_user_id','$apply_user_id','1','$payment','$ad_info', '$service_status','$time','$date','$apply_user_id','$newbalance1')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet + $payment where id = $apply_user_id";
        DB::update( DB::raw( $sql ) );

        DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
        ] );

    }
    }else{
        $status = "Pending";
        $serviceid = $request->serviceid;
        if($serviceid == 27){
            DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                'any_proof'         => $request->id_proof,
            ]);
            if ($request->husband_death_certificate != null) {
                $husband_death_certificate = uniqid().'.'.$request->file('husband_death_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'husband_death_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['husband_death_certificate']['tmp_name'], $filepath . $husband_death_certificate);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'husband_death_certificate'         => $husband_death_certificate,
                ]);
            }

            if ($request->widow_certificate != null) {
                $widow_certificate = uniqid().'.'.$request->file('widow_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'widow_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['widow_certificate']['tmp_name'], $filepath . $widow_certificate);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'widow_certificate'         => $widow_certificate,
                ]);
            }

            if ($request->bank_pass_book != null) {
                $bank_pass_book = uniqid().'.'.$request->file('bank_pass_book')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'bank_pass_book' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['bank_pass_book']['tmp_name'], $filepath . $bank_pass_book);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'bank_pass_book'         => $bank_pass_book,
                ]);
            }

            if ($request->passport != null) {
                $passport = uniqid().'.'.$request->file('passport')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'passport' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['passport']['tmp_name'], $filepath . $passport);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'passport'         => $passport,
                ]);
            }

            if ($request->pancard != null) {
                $pancard = uniqid().'.'.$request->file('pancard')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'pancard' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['pancard']['tmp_name'], $filepath . $pancard);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'pancard'         => $pancard,
                ]);
            }

            if ($request->voterid != null) {
                $voterid = uniqid().'.'.$request->file('voterid')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'voterid' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['voterid']['tmp_name'], $filepath . $voterid);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'voterid'         => $voterid,
                ]);
            }

            if ($request->driving_license != null) {
                $driving_license = uniqid().'.'.$request->file('driving_license')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'driving_license' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['driving_license']['tmp_name'], $filepath . $driving_license);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'driving_license'         => $driving_license,
                ]);
            }

        }elseif($serviceid == 28){
           DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
            'mrg_docdetails'         => $request->mrg_docdetails,
        ]);
           if ($request->husband_death_certificate != null) {
            $husband_death_certificate = uniqid().'.'.$request->file('husband_death_certificate')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'husband_death_certificate' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['husband_death_certificate']['tmp_name'], $filepath . $husband_death_certificate);
            DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                'husband_death_certificate'         => $husband_death_certificate,
            ]);
        }

        if ($request->mrg_invitation != null) {
            $mrg_invitation = uniqid().'.'.$request->file('mrg_invitation')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'mrg_invitation' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['mrg_invitation']['tmp_name'], $filepath . $mrg_invitation);
            DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                'mrg_invitation'         => $mrg_invitation,
            ]);
        }

        if ($request->mrg_registration_certificate != null) {
            $mrg_registration_certificate = uniqid().'.'.$request->file('mrg_registration_certificate')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'mrg_registration_certificate' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['mrg_registration_certificate']['tmp_name'], $filepath . $mrg_registration_certificate);
            DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                'mrg_registration_certificate'         => $mrg_registration_certificate,
            ]);
        }

        if ($request->mrg_documents != null) {
            $mrg_documents = uniqid().'.'.$request->file('mrg_documents')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'mrg_documents' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['mrg_documents']['tmp_name'], $filepath . $mrg_documents);
            DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                'mrg_documents'         => $mrg_documents,
            ]);
        }

    }elseif ($serviceid == 129) {
        if ($request->tc_community_certificate != null) {
            $tc_community_certificate = uniqid().'.'.$request->file('tc_community_certificate')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'tc_community_certificate' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['tc_community_certificate']['tmp_name'], $filepath . $tc_community_certificate);
            DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                'tc_community_certificate'         => $tc_community_certificate,
            ]);
        }

    }
 $getpermission = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
    $coordinator_permission = 0;
    if($getpermission){
        $coordinator_permission = $getpermission->coordinator_permission;
    }
    if($coordinator_permission == 1){
     $post_data = array();
     $getdata = DB::table( 'tnega_services' )->where('id',$request->applied_serviceid)->get();
     $getdata = json_decode( json_encode( $getdata ), true );
            foreach ( $getdata as $key => $ser ) {
                $getdata[ $key ][ 'family_details' ] = array();
                $getdata[ $key ][ 'customer_details' ] = array();
                $getdata[ $key ][ 'details' ] = array();
                $getdata[ $key ][ 'agri_details' ] = array();
                $getdata[ $key ][ 'agri_documents' ] = array();
                $ser_id = $ser[ 'id' ];
                $user_id = $ser[ 'user_id' ];
                $sql = "select * from family_member where service_id=$ser_id order by id Asc";
                $result = DB::select( $sql );
                $sql = "select * from users where id=$user_id";
                $result1 = DB::select( $sql );
                $getdata[ $key ][ 'family_details' ] = $result;
                $getdata[ $key ][ 'customer_details' ] = $result1;
            }
    if(count($getdata) > 0){

     $API_KEY = env( 'API_KEY', '' );
     $RAMJIPAY_URL = env( 'RAMJIPAY_URL', '' );
     $WEBSITE_INDEX = env( 'WEBSITE_INDEX', '' );
      $post_data['data'] = $getdata;
      $post_data['key'] = $API_KEY;
      $post_data['index'] = $WEBSITE_INDEX;
     $ch = curl_init();
        //dd($post_data);
        $url1 = $RAMJIPAY_URL.'/api/update_tnegaservices_api';
        //echo $url1;die;
        curl_setopt( $ch, CURLOPT_URL, $url1 );
        curl_setopt( $ch, CURLOPT_POST, 1 );
        curl_setopt( $ch, CURLOPT_POSTFIELDS,json_encode($post_data) );
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $server_output = curl_exec( $ch );
        curl_close( $ch );
        $resdata = json_decode($server_output, true);
       //dd($resdata);
    }
    }
     DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
        ] );
    }

return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}

public function submit_statusupdate_tnegaservices4(Request $request){
    $apply_user_id = 0;
    if ($request->distributor_id == 0 && $request->retailer_id == 0) {
        $apply_user_id = $request->user_id;
    }
    elseif($request->retailer_id == 0){
        $apply_user_id = $request->distributor_id;
    }elseif($request->distributor_id == 0){
        $apply_user_id = $request->retailer_id;
    }
    if($apply_user_id != Auth::user()->id){
        $status = $request->status;
        if($status == "Resubmit"){
            DB::table( 'tnega_services' )->where('id', $request->applied_serviceid)->update( [
                'remarks'  => $request->remarks,
                'status'  => $status,
            ] );
        }elseif($status == "Processing"){
            if ( $request->acknowledgement != null ) {
                $acknowledgement = uniqid().'.'.$request->file( 'acknowledgement' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'acknowledgement' . DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'acknowledgement' ][ 'tmp_name' ], $filepath . $acknowledgement );
                DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
                    'acknowledgement' => $acknowledgement,
                ] );
            }
            DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
                'status' => $status,
                'application_no' => $request->application_no,
                'selects' => $request->selects,
            ] );
        }elseif($status == "Approved"){
            if ( $request->certificate != null ) {
                $certificate = uniqid().'.'.$request->file( 'certificate' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'certificate'. DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'certificate' ][ 'tmp_name' ], $filepath . $certificate );
                DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
                    'certificate' => $certificate,
                    'status' => $status,
                    'completed_date' => date("Y-m-d"),
                ] );
            }
            DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
                'status' => $status,
                'application' => $request->application,
                'lects' => $request->lects,
            ] );
        }elseif($status == "Rejected"){
            $serviceid = $request->serviceid;
            $getservice_payment = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
            $getusers = DB::table( 'users' )->where('id',$apply_user_id)->first();
            $usertype = 0;
            if($getusers){
                $usertype = $getusers->user_type_id;
            }
            $payment = 0;
            if($getservice_payment){
                if($usertype == 3){
                  $payment = $getservice_payment->distributor_amount;
              }elseif($usertype == 4){
                  $payment = $getservice_payment->retailer_amount;
              }elseif($usertype == 5){
                  $payment = $getservice_payment->customer_amount;
              }
          }

          $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
          $servicename = "";
          if($getservicename){
            $servicename = $getservicename->service_name;
        }
        $date = date( 'Y-m-d' );
        $time = date( 'H:i:s' );
        $service_status = 'Out Payment';
        $ad_info = "Service Refund For". ' ' .$servicename;

        $getwallet = DB::table( 'users' )->select('wallet')->where('id',1)->first();
        $balance = 0;
        if($getwallet){
            $balance = $getwallet->wallet;
        }
        $getuserswallet = DB::table( 'users' )->select('wallet')->where('id',$apply_user_id)->first();
        $balance1 = 0;
        if($getuserswallet){
            $balance1 = $getuserswallet->wallet;
        }
        $newbalance = $balance - $payment;
        $newbalance1 = $balance1 + $payment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$apply_user_id','1','$apply_user_id','$payment','$ad_info', '$service_status','$time','$date','$apply_user_id','$newbalance')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet - $payment where id = 1";
        DB::update( DB::raw( $sql ) );
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$apply_user_id','$apply_user_id','1','$payment','$ad_info', '$service_status','$time','$date','$apply_user_id','$newbalance1')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet + $payment where id = $apply_user_id";
        DB::update( DB::raw( $sql ) );

        DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
        ] );

    }
    }else{
        $status = "Pending";
        $serviceid = $request->serviceid;
        if ($request->aadhaar_card != null) {
            $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
            DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                'aadhaar_card'         => $aadhaar_card,
            ]);
        }

        if ($request->smart_card != null) {
            $smart_card = uniqid().'.'.$request->file('smart_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smart_card);
            DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                'smart_card'         => $smart_card,
            ]);
        }

        if ($request->photo != null) {
            $photo = uniqid().'.'.$request->file('photo')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);
            DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                'photo'         => $photo,
            ]);
        }

        if ($request->signature != null) {
            $signature = uniqid().'.'.$request->file('signature')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'signature' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['signature']['tmp_name'], $filepath . $signature);
            DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                'signature'         => $signature,
            ]);
        }

        if ($request->tailoring_certificate != null) {
            $tailoring_certificate = uniqid().'.'.$request->file('tailoring_certificate')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'tailoring_certificate' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['tailoring_certificate']['tmp_name'], $filepath . $tailoring_certificate);
            DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                'tailoring_certificate'         => $tailoring_certificate,
            ]);
        }

        if ($request->income_certificate != null) {
            $income_certificate = uniqid().'.'.$request->file('income_certificate')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'income_certificate' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['income_certificate']['tmp_name'], $filepath . $income_certificate);
            DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                'income_certificate'         => $income_certificate,
            ]);
        }

            DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
                    'status' => $status,
                    'can_number'        => $request->can_number,
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
                    'caste'        => $request->caste,
                    'street_name'        => $request->street_name,
                    'pin_code'        => $request->pin_code,
                    'postal_area_tamil'        => $request->postal_area_tamil,
                    'postal_area_english'        => $request->postal_area_english,
                    'mother_name_tamil'        => $request->mother_name_tamil,
                    'mother_name_english'        => $request->mother_name_english,
                ] );
    $getpermission = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
    $coordinator_permission = 0;
    if($getpermission){
        $coordinator_permission = $getpermission->coordinator_permission;
    }
    if($coordinator_permission == 1){
      $post_data = array();
     $getdata = DB::table( 'tnega_services' )->where('id',$request->applied_serviceid)->get();
     $getdata = json_decode( json_encode( $getdata ), true );
            foreach ( $getdata as $key => $ser ) {
                $getdata[ $key ][ 'family_details' ] = array();
                $getdata[ $key ][ 'customer_details' ] = array();
                $getdata[ $key ][ 'details' ] = array();
                $getdata[ $key ][ 'agri_details' ] = array();
                $getdata[ $key ][ 'agri_documents' ] = array();
                $ser_id = $ser[ 'id' ];
                $user_id = $ser[ 'user_id' ];
                $sql = "select * from family_member where service_id=$ser_id order by id Asc";
                $result = DB::select( $sql );
                $sql = "select * from users where id=$user_id";
                $result1 = DB::select( $sql );
                $getdata[ $key ][ 'family_details' ] = $result;
                $getdata[ $key ][ 'customer_details' ] = $result1;
            }
    if(count($getdata) > 0){

     $API_KEY = env( 'API_KEY', '' );
     $RAMJIPAY_URL = env( 'RAMJIPAY_URL', '' );
     $WEBSITE_INDEX = env( 'WEBSITE_INDEX', '' );
      $post_data['data'] = $getdata;
      $post_data['key'] = $API_KEY;
      $post_data['index'] = $WEBSITE_INDEX;
     $ch = curl_init();

        //dd($post_data);
        $url1 = $RAMJIPAY_URL.'/api/update_tnegaservices_api';
        //echo $url1;die;

        curl_setopt( $ch, CURLOPT_URL, $url1 );
        curl_setopt( $ch, CURLOPT_POST, 1 );
        curl_setopt( $ch, CURLOPT_POSTFIELDS,json_encode($post_data) );
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $server_output = curl_exec( $ch );
        curl_close( $ch );
        $resdata = json_decode($server_output, true);
       //dd($resdata);
    }

        }
        DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
        ] );
    }


    return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}

public function submit_statusupdate_tnegaservices5(Request $request){
    $apply_user_id = 0;
    if ($request->distributor_id == 0 && $request->retailer_id == 0) {
        $apply_user_id = $request->user_id;
    }
    elseif($request->retailer_id == 0){
        $apply_user_id = $request->distributor_id;
    }elseif($request->distributor_id == 0){
        $apply_user_id = $request->retailer_id;
    }
    if($apply_user_id != Auth::user()->id){
        $status = $request->status;
        if($status == "Resubmit"){
            DB::table( 'tnega_services' )->where('id', $request->applied_serviceid)->update( [
                'remarks'  => $request->remarks,
                'status'  => $status,
            ] );
        }elseif($status == "Processing"){
            if ( $request->acknowledgement != null ) {
                $acknowledgement = uniqid().'.'.$request->file( 'acknowledgement' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'acknowledgement' . DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'acknowledgement' ][ 'tmp_name' ], $filepath . $acknowledgement );
                DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
                    'acknowledgement' => $acknowledgement,
                ] );
            }
            DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
                'status' => $status,
                'application_no' => $request->application_no,
                'selects' => $request->selects,
            ] );
        }elseif($status == "Approved"){
            if ( $request->certificate != null ) {
                $certificate = uniqid().'.'.$request->file( 'certificate' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'certificate'. DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'certificate' ][ 'tmp_name' ], $filepath . $certificate );
                DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
                    'certificate' => $certificate,
                    'status' => $status,
                    'completed_date' => date("Y-m-d"),
                ] );
            }
            DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
                'status' => $status,
                'application' => $request->application,
                'lects' => $request->lects,
            ] );
        }elseif($status == "Rejected"){
            $serviceid = $request->serviceid;
            $getservice_payment = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
            $getusers = DB::table( 'users' )->where('id',$apply_user_id)->first();
            $usertype = 0;
            if($getusers){
                $usertype = $getusers->user_type_id;
            }
            $payment = 0;
            if($getservice_payment){
                if($usertype == 3){
                  $payment = $getservice_payment->distributor_amount;
              }elseif($usertype == 4){
                  $payment = $getservice_payment->retailer_amount;
              }elseif($usertype == 5){
                  $payment = $getservice_payment->customer_amount;
              }
          }

          $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
          $servicename = "";
          if($getservicename){
            $servicename = $getservicename->service_name;
        }
        $date = date( 'Y-m-d' );
        $time = date( 'H:i:s' );
        $service_status = 'Out Payment';
        $ad_info = "Service Refund For". ' ' .$servicename;

        $getwallet = DB::table( 'users' )->select('wallet')->where('id',1)->first();
        $balance = 0;
        if($getwallet){
            $balance = $getwallet->wallet;
        }
        $getuserswallet = DB::table( 'users' )->select('wallet')->where('id',$apply_user_id)->first();
        $balance1 = 0;
        if($getuserswallet){
            $balance1 = $getuserswallet->wallet;
        }
        $newbalance = $balance - $payment;
        $newbalance1 = $balance1 + $payment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$apply_user_id','1','$apply_user_id','$payment','$ad_info', '$service_status','$time','$date','$apply_user_id','$newbalance')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet - $payment where id = 1";
        DB::update( DB::raw( $sql ) );
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$apply_user_id','$apply_user_id','1','$payment','$ad_info', '$service_status','$time','$date','$apply_user_id','$newbalance1')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet + $payment where id = $apply_user_id";
        DB::update( DB::raw( $sql ) );

        DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
        ] );

    }
    }else{
        $status = "Pending";
        $serviceid = $request->serviceid;
        if($serviceid == 170 || $serviceid == 172 || $serviceid == 176 || $serviceid == 177 || $serviceid == 178){
            DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                'handicapped_proof'         => $request->handicapped_proof,
            ]);

            if ($request->family_photo != null) {
                $family_photo = uniqid().'.'.$request->file('family_photo')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'family_photo' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['family_photo']['tmp_name'], $filepath . $family_photo);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'family_photo'         => $family_photo,
                ]);
            }
            if ($request->id_proof != null) {
                $id_proof = uniqid().'.'.$request->file('id_proof')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'id_proof' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['id_proof']['tmp_name'], $filepath . $id_proof);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'id_proof'         => $id_proof,
                ]);
            }

            if ($request->birth_certificate_children != null) {
                $birth_certificate_children = uniqid().'.'.$request->file('birth_certificate_children')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'birth_certificate_children' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['birth_certificate_children']['tmp_name'], $filepath . $birth_certificate_children);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'birth_certificate_children'         => $birth_certificate_children,
                ]);
            }

            if ($request->family_plannnig_certificate != null) {
                $family_plannnig_certificate = uniqid().'.'.$request->file('family_plannnig_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'family_plannnig_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['family_plannnig_certificate']['tmp_name'], $filepath . $family_plannnig_certificate);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'family_plannnig_certificate'         => $family_plannnig_certificate,
                ]);
            }
            if ($request->self_declaration_certificate != null) {
                $self_declaration_certificate = uniqid().'.'.$request->file('self_declaration_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'self_declaration_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['self_declaration_certificate']['tmp_name'], $filepath . $self_declaration_certificate);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'self_declaration_certificate'         => $self_declaration_certificate,
                ]);
            }

            if ($request->anyothers_certificate != null) {
                $anyothers_certificate = uniqid().'.'.$request->file('anyothers_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'anyothers_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['anyothers_certificate']['tmp_name'], $filepath . $anyothers_certificate);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'anyothers_certificate'         => $anyothers_certificate,
                ]);
            }
        } elseif($serviceid == 171){
            if ($request->udid_card != null) {
                $udid_card = uniqid().'.'.$request->file('udid_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'udid_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['udid_card']['tmp_name'], $filepath . $udid_card);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'udid_card'         => $udid_card,
                ]);
            }
            if ($request->bank_pass_book != null) {
                $bank_pass_book = uniqid().'.'.$request->file('bank_pass_book')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'bank_pass_book' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['bank_pass_book']['tmp_name'], $filepath . $bank_pass_book);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                    'bank_pass_book'         => $bank_pass_book,
                ]);
            }
            if ($request->passport != null) {
                $passport = uniqid().'.'.$request->file('passport')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'passport' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['passport']['tmp_name'], $filepath . $passport);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                  'passport'         => $passport,
              ]);
            }
            if ($request->pancard != null) {
                $pancard = uniqid().'.'.$request->file('pancard')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'pancard' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['pancard']['tmp_name'], $filepath . $pancard);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                  'pancard'         => $pancard,
              ]);
            }

            if ($request->voterid != null) {
                $voterid = uniqid().'.'.$request->file('voterid')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'voterid' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['voterid']['tmp_name'], $filepath . $voterid);
                DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
                 'voterid'         => $voterid,
             ]);
            }

            if ($request->driving_license != null) {
             $driving_license = uniqid().'.'.$request->file('driving_license')->extension();
             $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'driving_license' . DIRECTORY_SEPARATOR);
             move_uploaded_file($_FILES['driving_license']['tmp_name'], $filepath . $driving_license);
             DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
               'driving_license'         => $driving_license,
           ]);
         }

     } elseif($serviceid == 172){
        if ($request->age_proof != null) {
            $age_proof = uniqid().'.'.$request->file('age_proof')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'age_proof' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['age_proof']['tmp_name'], $filepath . $age_proof);
            DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
              'age_proof'         => $age_proof,
          ]);
        }
        if ($request->vao_certificate != null) {
            $vao_certificate = uniqid().'.'.$request->file('vao_certificate')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'vao_certificate' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['vao_certificate']['tmp_name'], $filepath . $vao_certificate);
            DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
              'vao_certificate'         => $vao_certificate,
          ]);
        }

        if ($request->self_declaration_certificate != null) {
            $self_declaration_certificate = uniqid().'.'.$request->file('self_declaration_certificate')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'self_declaration_certificate' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['self_declaration_certificate']['tmp_name'], $filepath . $self_declaration_certificate);
            DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
             'self_declaration_certificate'         => $self_declaration_certificate,
         ]);
        }

        if ($request->other_certificate != null) {
         $other_certificate = uniqid().'.'.$request->file('other_certificate')->extension();
         $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'other_certificate' . DIRECTORY_SEPARATOR);
         move_uploaded_file($_FILES['other_certificate']['tmp_name'], $filepath . $other_certificate);
         DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
           'other_certificate'         => $other_certificate,
       ]);
     }

 } elseif($serviceid == 176){
    if ($request->residential_certificate != null) {
        $residential_certificate = uniqid().'.'.$request->file('residential_certificate')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'residential_certificate' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['residential_certificate']['tmp_name'], $filepath . $residential_certificate);
        DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
          'residential_certificate'         => $residential_certificate,
      ]);
    }
    if ($request->solvency_certificate != null) {
        $solvency_certificate = uniqid().'.'.$request->file('solvency_certificate')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'solvency_certificate' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['solvency_certificate']['tmp_name'], $filepath . $solvency_certificate);
        DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
          'solvency_certificate'         => $solvency_certificate,
      ]);
    }
    if ($request->shop_address_proof != null) {
        $shop_address_proof = uniqid().'.'.$request->file('building_blue_print')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'building_blue_print' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['building_blue_print']['tmp_name'], $filepath . $building_blue_print);
        DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
          'building_blue_print'         => $building_blue_print,
      ]);
    }
    if ($request->chitta != null) {
        $chitta = uniqid().'.'.$request->file('chitta')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'chitta' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['chitta']['tmp_name'], $filepath . $chitta);
        DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
          'chitta'         => $chitta,
      ]);
    }

    if ($request->previous_licence != null) {
        $previous_licence = uniqid().'.'.$request->file('previous_licence')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'previous_licence' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['previous_licence']['tmp_name'], $filepath . $previous_licence);
        DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
         'previous_licence'         => $previous_licence,
     ]);
    }

    if ($request->challan != null) {
     $challan = uniqid().'.'.$request->file('challan')->extension();
     $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'challan' . DIRECTORY_SEPARATOR);
     move_uploaded_file($_FILES['challan']['tmp_name'], $filepath . $challan);
     DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
       'challan'         => $challan,
   ]);
 }
 if ($request->form_A != null) {
    $form_A = uniqid().'.'.$request->file('form_A')->extension();
    $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'form_A' . DIRECTORY_SEPARATOR);
    move_uploaded_file($_FILES['form_A']['tmp_name'], $filepath . $form_A);
    DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
      'form_A'         => $form_A,
  ]);
}
if ($request->building_licence_document != null) {
    $building_licence_document = uniqid().'.'.$request->file('building_licence_document')->extension();
    $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'building_licence_document' . DIRECTORY_SEPARATOR);
    move_uploaded_file($_FILES['building_licence_document']['tmp_name'], $filepath . $building_licence_document);
    DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
      'building_licence_document'         => $building_licence_document,
  ]);
}
if ($request->building_blue_print != null) {
    $building_blue_print = uniqid().'.'.$request->file('building_blue_print')->extension();
    $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'building_blue_print' . DIRECTORY_SEPARATOR);
    move_uploaded_file($_FILES['building_blue_print']['tmp_name'], $filepath . $building_blue_print);
    DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
      'building_blue_print'         => $building_blue_print,
  ]);
}
if ($request->pancard != null) {
    $pancard = uniqid().'.'.$request->file('pancard')->extension();
    $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'pancard' . DIRECTORY_SEPARATOR);
    move_uploaded_file($_FILES['pancard']['tmp_name'], $filepath . $pancard);
    DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
      'pancard'         => $pancard,
  ]);
}

if ($request->self_declaration_certificate != null) {
    $self_declaration_certificate = uniqid().'.'.$request->file('self_declaration_certificate')->extension();
    $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'self_declaration_certificate' . DIRECTORY_SEPARATOR);
    move_uploaded_file($_FILES['self_declaration_certificate']['tmp_name'], $filepath . $self_declaration_certificate);
    DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
     'self_declaration_certificate'         => $self_declaration_certificate,
 ]);
}

if ($request->lease_agreement != null) {
 $lease_agreement = uniqid().'.'.$request->file('lease_agreement')->extension();
 $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'lease_agreement' . DIRECTORY_SEPARATOR);
 move_uploaded_file($_FILES['lease_agreement']['tmp_name'], $filepath . $lease_agreement);
 DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
   'lease_agreement'         => $lease_agreement,
]);
}
if ($request->it_return_document != null) {
    $it_return_document = uniqid().'.'.$request->file('it_return_document')->extension();
    $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'it_return_document' . DIRECTORY_SEPARATOR);
    move_uploaded_file($_FILES['it_return_document']['tmp_name'], $filepath . $it_return_document);
    DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
      'it_return_document'         => $it_return_document,
  ]);
}
} elseif($serviceid == 177){
    if ($request->registered_deed != null) {
        $registered_deed = uniqid().'.'.$request->file('registered_deed')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'registered_deed' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['registered_deed']['tmp_name'], $filepath . $registered_deed);
        DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
          'registered_deed'         => $registered_deed,
      ]);
    }
    if ($request->chitta_and_villangam != null) {
        $chitta_and_villangam = uniqid().'.'.$request->file('chitta_and_villangam')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'chitta_and_villangam' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['chitta_and_villangam']['tmp_name'], $filepath . $chitta_and_villangam);
        DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
          'chitta_and_villangam'         => $chitta_and_villangam,
      ]);
    }
    if ($request->property_details != null) {
        $property_details = uniqid().'.'.$request->file('property_details')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'property_details' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['property_details']['tmp_name'], $filepath . $property_details);
        DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
          'property_details'         => $property_details,
      ]);
    }

    if ($request->self_declaration_certificate != null) {
        $self_declaration_certificate = uniqid().'.'.$request->file('self_declaration_certificate')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'self_declaration_certificate' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['self_declaration_certificate']['tmp_name'], $filepath . $self_declaration_certificate);
        DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
         'self_declaration_certificate'         => $self_declaration_certificate,
     ]);
    }

} elseif($serviceid == 178){
    if ($request->residential_certificate != null) {
        $residential_certificate = uniqid().'.'.$request->file('residential_certificate')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'residential_certificate' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['residential_certificate']['tmp_name'], $filepath . $residential_certificate);
        DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
          'residential_certificate'         => $residential_certificate,
      ]);
    }
    if ($request->self_declaration_certificate != null) {
        $self_declaration_certificate = uniqid().'.'.$request->file('self_declaration_certificate')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'self_declaration_certificate' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['self_declaration_certificate']['tmp_name'], $filepath . $self_declaration_certificate);
        DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
         'self_declaration_certificate'         => $self_declaration_certificate,
     ]);
    }
    if ($request->damage_certificate != null) {
        $damage_certificate = uniqid().'.'.$request->file('damage_certificate')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'damage_certificate' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['damage_certificate']['tmp_name'], $filepath . $damage_certificate);
        DB::table('tnega_services')->where('id', $request->applied_serviceid)->update([
          'damage_certificate'         => $damage_certificate,
      ]);
    }
}

DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
    'status' => $status,
    'can_number'        => $request->can_number,
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
    'postal_area_tamil'        => $request->postal_area_tamil,
    'postal_area_english'        => $request->postal_area_english,
    'mother_name_tamil'        => $request->mother_name_tamil,
    'mother_name_english'        => $request->mother_name_english,
] );

$getpermission = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
    $coordinator_permission = 0;
    if($getpermission){
        $coordinator_permission = $getpermission->coordinator_permission;
    }
    if($coordinator_permission == 1){
      $post_data = array();
     $getdata = DB::table( 'tnega_services' )->where('id',$request->applied_serviceid)->get();
     $getdata = json_decode( json_encode( $getdata ), true );
            foreach ( $getdata as $key => $ser ) {
                $getdata[ $key ][ 'family_details' ] = array();
                $getdata[ $key ][ 'customer_details' ] = array();
                $getdata[ $key ][ 'details' ] = array();
                $getdata[ $key ][ 'agri_details' ] = array();
                $getdata[ $key ][ 'agri_documents' ] = array();
                $ser_id = $ser[ 'id' ];
                $user_id = $ser[ 'user_id' ];
                $sql = "select * from family_member where service_id=$ser_id order by id Asc";
                $result = DB::select( $sql );
                $sql = "select * from users where id=$user_id";
                $result1 = DB::select( $sql );
                $getdata[ $key ][ 'family_details' ] = $result;
                $getdata[ $key ][ 'customer_details' ] = $result1;
            }
    if(count($getdata) > 0){

     $API_KEY = env( 'API_KEY', '' );
     $RAMJIPAY_URL = env( 'RAMJIPAY_URL', '' );
     $WEBSITE_INDEX = env( 'WEBSITE_INDEX', '' );
      $post_data['data'] = $getdata;
      $post_data['key'] = $API_KEY;
      $post_data['index'] = $WEBSITE_INDEX;
      $ch = curl_init();

        //dd($post_data);
        $url1 = $RAMJIPAY_URL.'/api/update_tnegaservices_api';
        //echo $url1;die;

        curl_setopt( $ch, CURLOPT_URL, $url1 );
        curl_setopt( $ch, CURLOPT_POST, 1 );
        curl_setopt( $ch, CURLOPT_POSTFIELDS,json_encode($post_data) );
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $server_output = curl_exec( $ch );
        curl_close( $ch );
        $resdata = json_decode($server_output, true);
       //dd($resdata);
    }

        }
        DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
        ] );
    }

return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}
public function submit_statusupdate_tnegaservices6(Request $request){
    // dd($request->all());
 $apply_user_id = 0;
 if ($request->distributor_id == 0 && $request->retailer_id == 0) {
     $apply_user_id = $request->user_id;
 }
 elseif($request->retailer_id == 0){
     $apply_user_id = $request->distributor_id;
 }elseif($request->distributor_id == 0){
     $apply_user_id = $request->retailer_id;
 }
 if($apply_user_id != Auth::user()->id){
     $status = $request->status;
     if($status == "Resubmit"){
         DB::table( 'tnega_services' )->where('id', $request->applied_serviceid)->update( [
             'remarks'  => $request->remarks,
             'status'  => $status,
         ] );
        }elseif($status == "Processing"){
            if ( $request->acknowledgement != null ) {
                $acknowledgement = uniqid().'.'.$request->file( 'acknowledgement' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'acknowledgement' . DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'acknowledgement' ][ 'tmp_name' ], $filepath . $acknowledgement );
                DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
                    'acknowledgement' => $acknowledgement,
                ] );
            }
            DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
                'status' => $status,
                'application_no' => $request->application_no,
                'selects' => $request->selects,
            ] );
        }elseif($status == "Approved"){
            if ( $request->certificate != null ) {
                $certificate = uniqid().'.'.$request->file( 'certificate' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'certificate'. DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'certificate' ][ 'tmp_name' ], $filepath . $certificate );
                DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
                    'certificate' => $certificate,
                    'status' => $status,
                    'completed_date' => date("Y-m-d"),
                ] );
            }
            DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
                'status' => $status,
                'application' => $request->application,
                'lects' => $request->lects,
            ] );
        }elseif($status == "Rejected"){
            $serviceid = $request->serviceid;
            $getservice_payment = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
            $getusers = DB::table( 'users' )->where('id',$apply_user_id)->first();
            $usertype = 0;
            if($getusers){
                $usertype = $getusers->user_type_id;
            }
            $payment = 0;
            if($getservice_payment){
                if($usertype == 3){
                  $payment = $getservice_payment->distributor_amount;
              }elseif($usertype == 4){
                  $payment = $getservice_payment->retailer_amount;
              }elseif($usertype == 5){
                  $payment = $getservice_payment->customer_amount;
              }
          }

          $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
          $servicename = "";
          if($getservicename){
            $servicename = $getservicename->service_name;
        }
        $date = date( 'Y-m-d' );
        $time = date( 'H:i:s' );
        $service_status = 'Out Payment';
        $ad_info = "Service Refund For". ' ' .$servicename;

        $getwallet = DB::table( 'users' )->select('wallet')->where('id',2)->first();
        $balance = 0;
        if($getwallet){
            $balance = $getwallet->wallet;
        }
        $getuserswallet = DB::table( 'users' )->select('wallet')->where('id',$apply_user_id)->first();
        $balance1 = 0;
        if($getuserswallet){
            $balance1 = $getuserswallet->wallet;
        }
        $newbalance = $balance - $payment;
        $newbalance1 = $balance1 + $payment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$apply_user_id','2','$apply_user_id','$payment','$ad_info', '$service_status','$time','$date','$apply_user_id','$newbalance')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet - $payment where id = 2";
        DB::update( DB::raw( $sql ) );
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$apply_user_id','$apply_user_id','2','$payment','$ad_info', '$service_status','$time','$date','$apply_user_id','$newbalance1')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet + $payment where id = $apply_user_id";
        DB::update( DB::raw( $sql ) );

        DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
        ] );
        }
 }else{
     $status = "Pending";
     $serviceid = $request->serviceid;

     DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
        'status' => $status,
        'can_number'        => $request->can_number,
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
        'caste'        => $request->caste,
        'street_name'        => $request->street_name,
        'pin_code'        => $request->pin_code,
        'postal_area_tamil'        => $request->postal_area_tamil,
        'postal_area_english'        => $request->postal_area_english,
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
    ] );

    if ($request->signature1 != null) {
        $signature1 = uniqid().'.'.$request->file('signature1')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'signature1' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['signature1']['tmp_name'], $filepath . $signature1);
         DB::table('tnega_services')->where('id', $insertid)->update([
        'signature1'         => $signature1,
    ]);
    }

    if ($request->signature2 != null) {
        $signature2 = uniqid().'.'.$request->file('signature2')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'signature2' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['signature2']['tmp_name'], $filepath . $signature2);
         DB::table('tnega_services')->where('id', $insertid)->update([
        'signature2'         => $signature2,
    ]);
    }



    if($request->has('doc_id')){
        foreach ( $request->doc_id as $key => $id ) {
          $relation = $request->relation[ $key ];
          $relation_name_tamil = $request->name_tamil[ $key ];
          $relation_name = $request->name_english[ $key ];
          $living_status = $request->living_status[ $key ];
          $age = $request->age[ $key ];
          $education = $request->education_type[ $key ];

           DB::table( 'family_member' )->where( 'id', $id )->update( [
                  'relation'       => $relation,
                  'relation_name'       => $relation_name,
                  'relation_name_tamil'       => $relation_name_tamil,
                  'relation_status'       => $living_status,
                  'education'       => $education,
                  'relation_age'       => $age,
              ] );

                        if (isset($request->doc[$key])) {
            if ($request->doc[$key] != null) {
                $file1 = uniqid().'.'.$request->file('doc')[$key]->extension();
          //dd($request->doc[$key]);
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'doc' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['doc']['tmp_name'][$key], $filepath . $file1);
                DB::table( 'family_member' )->where( 'id', $id )->update( [
                  'doc'       => $file1,
              ] );
            }
        }


    }
}

if($request->has('doc_id')){
        foreach ( $request->doc__add_id as $key => $id ) {
        $relation = $request->relationship_add[ $key ];
        $relation_name_tamil = $request->name_tamil_add[ $key ];
        $relation_name = $request->name_english_add[ $key ];
        $living_status = $request->living_status_add[ $key ];
        $age = $request->age_add[ $key ];
        $education = $request->education_type_add[ $key ];

       DB::table( 'family_member' )->where( 'id', $id )->update( [
                  'relation'       => $relation,
                  'relation_name'       => $relation_name,
                  'relation_name_tamil'       => $relation_name_tamil,
                  'relation_status'       => $living_status,
                  'education'       => $education,
                  'relation_age'       => $age,
              ] );
         $file1 = "";
    if (isset($request->doc1[$key])) {
            if ($request->doc1[$key] != null) {
                $file1 = uniqid().'.'.$request->file('doc1')[$key]->extension();
          //dd($request->doc[$key]);
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'doc' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['doc']['tmp_name'][$key], $filepath . $file1);
                DB::table( 'family_member' )->where( 'id', $id )->update( [
                  'doc'       => $file1,
              ] );
            }
        }
    }
}

    $getpermission = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
    $coordinator_permission = 0;
    if($getpermission){
        $coordinator_permission = $getpermission->coordinator_permission;
    }
    if($coordinator_permission == 1){
      $post_data = array();
     $getdata = DB::table( 'tnega_services' )->where('id',$request->applied_serviceid)->get();
     $getdata = json_decode( json_encode( $getdata ), true );
            foreach ( $getdata as $key => $ser ) {
                $getdata[ $key ][ 'family_details' ] = array();
                $getdata[ $key ][ 'details' ] = array();
                $getdata[ $key ][ 'customer_details' ] = array();
                $getdata[ $key ][ 'agri_details' ] = array();
                $getdata[ $key ][ 'agri_documents' ] = array();
                $ser_id = $ser[ 'id' ];
                $user_id = $ser[ 'user_id' ];
                $sql = "select * from family_member where service_id=$ser_id order by id Asc";
                $result = DB::select( $sql );
                $sql = "select * from users where id=$user_id";
                $result1 = DB::select( $sql );
                 $sql = "select * from family_member where service_id=$ser_id and user_id=$ser_id order by id Asc";
                $result3 = DB::select( $sql );
                $getdata[ $key ][ 'family_details' ] = $result;
                $getdata[ $key ][ 'details' ] = $result3;
                $getdata[ $key ][ 'customer_details' ] = $result1;
            }
    if(count($getdata) > 0){

     $API_KEY = env( 'API_KEY', '' );
     $RAMJIPAY_URL = env( 'RAMJIPAY_URL', '' );
     $WEBSITE_INDEX = env( 'WEBSITE_INDEX', '' );
      $post_data['data'] = $getdata;
      $post_data['key'] = $API_KEY;
      $post_data['index'] = $WEBSITE_INDEX;
     $ch = curl_init();

        //dd($post_data);
        $url1 = $RAMJIPAY_URL.'/api/update_tnegaservices_api';
        //echo $url1;die;

        curl_setopt( $ch, CURLOPT_URL, $url1 );
        curl_setopt( $ch, CURLOPT_POST, 1 );
        curl_setopt( $ch, CURLOPT_POSTFIELDS,json_encode($post_data) );
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $server_output = curl_exec( $ch );
        curl_close( $ch );
        $resdata = json_decode($server_output, true);
       //dd($resdata);
    }
    }
     DB::table( 'tnega_services' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
        ] );
    }
  return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}

public function submit_statusupdate_msme(Request $request){
    $apply_user_id = 0;
    if($request->retailer_id == 0){
        $apply_user_id = $request->distributor_id;
    }elseif($request->distributor_id == 0){
        $apply_user_id = $request->retailer_id;
    }
    if($request->distributor_id != Auth::user()->id && $apply_user_id != Auth::user()->id){
        $status = $request->status;
        if($status == "Resubmit"){
            DB::table( 'msme' )->where('id', $request->applied_serviceid)->update( [
                'remarks'  => $request->remarks,
                'status'  => $status,
            ] );
        }elseif($status == "Processing"){
            if ( $request->acknowledgement != null ) {
                $acknowledgement = uniqid().'.'.$request->file( 'acknowledgement' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'acknowledgement' . DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'acknowledgement' ][ 'tmp_name' ], $filepath . $acknowledgement );
                DB::table( 'msme' )->where( 'id', $request->applied_serviceid )->update( [
                    'acknowledgement' => $acknowledgement,
                    'status' => $status,
                    'application_no' => $request->application_no,
                ] );
            }
        }elseif($status == "Approved"){
            if ( $request->certificate != null ) {
                $certificate = uniqid().'.'.$request->file( 'certificate' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'certificate'. DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'certificate' ][ 'tmp_name' ], $filepath . $certificate );
                DB::table( 'msme' )->where( 'id', $request->applied_serviceid )->update( [
                    'certificate' => $certificate,
                    'status' => $status,
                    'completed_date' => date("Y-m-d"),
                ] );
            }
        }
    }else{
        $status = "Pending";
        $serviceid = $request->serviceid;
        if($serviceid == 34){
            if ($request->aadhaar_card != null) {
                $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
                DB::table( 'msme' )->where( 'id', $request->applied_serviceid )->update( [
                    'aadhaar_card'         => $aadhaar_card,
                ] );
            }

            if ($request->pan_card != null) {
                $pan_card = uniqid().'.'.$request->file('pan_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'pan_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['pan_card']['tmp_name'], $filepath . $pan_card);
                DB::table( 'msme' )->where( 'id', $request->applied_serviceid )->update( [
                    'pan_card'             => $pan_card,
                ] );
            }
            if ($request->itr_form != null) {
                $itr_form = uniqid().'.'.$request->file('itr_form')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'itr_form' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['itr_form']['tmp_name'], $filepath . $itr_form);
                DB::table( 'msme' )->where( 'id', $request->applied_serviceid )->update( [
                    'itr_form'             => $itr_form,
                ] );
            }
            DB::table('msme')->where('id', $request->applied_serviceid)->update([
                'name'           => $request->name,
                'mobile'        => $request->mobile,
                'dist_id'        => $request->dist_id,
                'taluk_id'        => $request->taluk_id,
                'panchayath_id'        => $request->panchayath_id,
                'cmp_name'        => $request->cmp_name,
                'community'        => $request->community,
                'building_name'        => $request->building_name,
                'ward_no'        => $request->ward_no,
                'pin_code'        => $request->pin_code,
                'account_no'        => $request->account_no,
                'confirm_account_no'=> $request->confirm_account_no,
                'ifsc_code'         => $request->ifsc_code,
                'micr_no'         => $request->micr_no,
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

        }

        DB::table( 'msme' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
        ] );

    }

    return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}

public function submit_statusupdate_itr(Request $request){
    $apply_user_id = 0;
    if($request->retailer_id == 0){
        $apply_user_id = $request->distributor_id;
    }elseif($request->distributor_id == 0){
        $apply_user_id = $request->retailer_id;
    }
    if($request->distributor_id != Auth::user()->id && $apply_user_id != Auth::user()->id){
        $status = $request->status;
        if($status == "Resubmit"){
            DB::table( 'itr' )->where('id', $request->applied_serviceid)->update( [
                'remarks'  => $request->remarks,
                'status'  => $status,
            ] );
        }elseif($status == "Processing"){
            if ( $request->acknowledgement != null ) {
                $acknowledgement = uniqid().'.'.$request->file( 'acknowledgement' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'acknowledgement' . DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'acknowledgement' ][ 'tmp_name' ], $filepath . $acknowledgement );
                DB::table( 'itr' )->where( 'id', $request->applied_serviceid )->update( [
                    'acknowledgement' => $acknowledgement,
                    'status' => $status,
                    'application_no' => $request->application_no,
                ] );
            }
        }elseif($status == "Approved"){
            if ( $request->certificate != null ) {
                $certificate = uniqid().'.'.$request->file( 'certificate' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'certificate'. DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'certificate' ][ 'tmp_name' ], $filepath . $certificate );
                DB::table( 'itr' )->where( 'id', $request->applied_serviceid )->update( [
                    'certificate' => $certificate,
                    'status' => $status,
                    'completed_date' => date("Y-m-d"),
                ] );
            }
        }
    }else{
        $status = "Pending";
        $serviceid = $request->serviceid;
        if ($request->pan_card != null) {
            $pan_card = uniqid().'.'.$request->file('pan_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'pan_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['pan_card']['tmp_name'], $filepath . $pan_card);
            DB::table( 'itr' )->where( 'id', $request->applied_serviceid )->update( [
                'pan_card'             => $pan_card,
            ] );
        }
        if ($request->aadhaar_card != null) {
            $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
            DB::table( 'itr' )->where( 'id', $request->applied_serviceid )->update( [
                'aadhaar_card'             => $aadhaar_card,
            ] );
        }
        if ($request->bank_passbook != null) {
            $bank_passbook = uniqid().'.'.$request->file('bank_passbook')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'bank_passbook' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['bank_passbook']['tmp_name'], $filepath . $bank_passbook);
            DB::table( 'itr' )->where( 'id', $request->applied_serviceid )->update( [
                'bank_passbook'             => $bank_passbook,
            ] );
        }
        DB::table('itr')->where('id', $request->applied_serviceid)->update([
            'name'           => $request->name,
            'mobile'        => $request->mobile,
            'email'        => $request->email,
            'aadhaar_no'        => $request->aadhaar_no,
            'status'        => 'Pending',
            'applied_date'  => date("Y-m-d"),
            'created_at'    => date("Y-m-d"),
        ]);

        DB::table( 'itr' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
        ] );

    }

    return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}

public function submit_statusupdate_gst(Request $request){
    $apply_user_id = 0;
    if($request->retailer_id == 0){
        $apply_user_id = $request->distributor_id;
    }elseif($request->distributor_id == 0){
        $apply_user_id = $request->retailer_id;
    }
    if($request->distributor_id != Auth::user()->id && $apply_user_id != Auth::user()->id){
        $status = $request->status;
        if($status == "Resubmit"){
            DB::table( 'gst' )->where('id', $request->applied_serviceid)->update( [
                'remarks'  => $request->remarks,
                'status'  => $status,
            ] );
        }elseif($status == "Processing"){
            if ( $request->acknowledgement != null ) {
                $acknowledgement = uniqid().'.'.$request->file( 'acknowledgement' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'acknowledgement' . DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'acknowledgement' ][ 'tmp_name' ], $filepath . $acknowledgement );
                DB::table( 'gst' )->where( 'id', $request->applied_serviceid )->update( [
                    'acknowledgement' => $acknowledgement,
                    'status' => $status,
                    'application_no' => $request->application_no,
                ] );
            }
        }elseif($status == "Approved"){
            if ( $request->certificate != null ) {
                $certificate = uniqid().'.'.$request->file( 'certificate' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'certificate'. DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'certificate' ][ 'tmp_name' ], $filepath . $certificate );
                DB::table( 'gst' )->where( 'id', $request->applied_serviceid )->update( [
                    'certificate' => $certificate,
                    'status' => $status,
                    'completed_date' => date("Y-m-d"),
                ] );
            }
        }
    }else{
        $status = "Pending";
        $serviceid = $request->serviceid;
        if ($request->pan_card != null) {
            $pan_card = uniqid().'.'.$request->file('pan_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'pan_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['pan_card']['tmp_name'], $filepath . $pan_card);
            DB::table( 'gst' )->where( 'id', $request->applied_serviceid )->update( [
                'pan_card'             => $pan_card,
            ] );
        }
        if ($request->aadhaar_card != null) {
            $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
            DB::table( 'gst' )->where( 'id', $request->applied_serviceid )->update( [
                'aadhaar_card'             => $aadhaar_card,
            ] );
        }
        if ($request->bank_pass_book_front_page != null) {
            $bank_passbook = uniqid().'.'.$request->file('bank_pass_book_front_page')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'passbook_front' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['bank_pass_book_front_page']['tmp_name'], $filepath . $bank_passbook);
            DB::table( 'gst' )->where( 'id', $request->applied_serviceid )->update( [
                'bank_pass_book_front_page'       => $bank_passbook,
            ] );
        }
        if ($request->photo != null) {
            $photo = uniqid().'.'.$request->file('photo')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);
            DB::table( 'gst' )->where( 'id', $request->applied_serviceid )->update( [
                'photo'       => $photo,
            ] );
        }
        if ($request->rental_agreement != null) {
            $rental_agreement = uniqid().'.'.$request->file('rental_agreement')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'rental_agreement' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['rental_agreement']['tmp_name'], $filepath . $rental_agreement);
            DB::table( 'gst' )->where( 'id', $request->applied_serviceid )->update( [
                'rental_agreement'       => $rental_agreement,
            ] );
        }
        if ($request->ebbill != null) {
            $ebbill = uniqid().'.'.$request->file('ebbill')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'ebbill' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['ebbill']['tmp_name'], $filepath . $ebbill);
            DB::table( 'gst' )->where( 'id', $request->applied_serviceid )->update( [
                'ebbill'       => $ebbill,
            ] );
        }
        if ($request->property_tax != null) {
            $property_tax = uniqid().'.'.$request->file('property_tax')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'property_tax' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['property_tax']['tmp_name'], $filepath . $property_tax);
            DB::table( 'gst' )->where( 'id', $request->applied_serviceid )->update( [
                'property_tax'       => $property_tax,
            ] );
        }
        DB::table('gst')->where('id', $request->applied_serviceid)->update([
            'trade_name'           => $request->trade_name,
            'mobile'               => $request->mobile,
            'aadhaar_no'           => $request->aadhaar_no,
            'pan_no'               => $request->pan_no,
            'business_details'     => $request->business_details,
            'business_address'     => $request->business_address,
            'business_details_documents'=> $request->business_details_documents,
            'status'       => 'Pending',
            'applied_date' => date("Y-m-d"),
            'created_at'   => date("Y-m-d"),
        ] );

        DB::table( 'gst' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
        ] );

    }

    return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}

public function submit_statusupdate_tecexam(Request $request){
    $apply_user_id = 0;
    if($request->retailer_id == 0){
        $apply_user_id = $request->distributor_id;
    }elseif($request->distributor_id == 0){
        $apply_user_id = $request->retailer_id;
    }
    if($request->distributor_id != Auth::user()->id && $apply_user_id != Auth::user()->id){
        $status = $request->status;
        if($status == "Resubmit"){
            DB::table( 'tec_exam' )->where('id', $request->applied_serviceid)->update( [
                'remarks'  => $request->remarks,
                'status'  => $status,
            ] );
        }elseif($status == "Processing"){
            if ( $request->acknowledgement != null ) {
                $acknowledgement = uniqid().'.'.$request->file( 'acknowledgement' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'acknowledgement' . DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'acknowledgement' ][ 'tmp_name' ], $filepath . $acknowledgement );
                DB::table( 'tec_exam' )->where( 'id', $request->applied_serviceid )->update( [
                    'acknowledgement' => $acknowledgement,
                    'status' => $status,
                    'application_no' => $request->application_no,
                ] );
            }
        }elseif($status == "Approved"){
            if ( $request->certificate != null ) {
                $certificate = uniqid().'.'.$request->file( 'certificate' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'certificate'. DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'certificate' ][ 'tmp_name' ], $filepath . $certificate );
                DB::table( 'tec_exam' )->where( 'id', $request->applied_serviceid )->update( [
                    'certificate' => $certificate,
                    'status' => $status,
                    'completed_date' => date("Y-m-d"),
                ] );
            }
        }
    }else{
        $status = "Pending";
        $serviceid = $request->serviceid;
        if ($request->photo != null) {
            $photo = uniqid().'.'.$request->file('photo')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);
            DB::table( 'tec_exam' )->where( 'id', $request->applied_serviceid )->update( [
                'photo'             => $photo,
            ] );
        }
        if ($request->aadhaar_card != null) {
            $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
            DB::table( 'tec_exam' )->where( 'id', $request->applied_serviceid )->update( [
                'aadhaar_card'             => $aadhaar_card,
            ] );
        }

        DB::table('tec_exam')->where('id', $request->applied_serviceid)->update([
            'tec_number'           => $request->tec_number,
            'tec_password'         => $request->tec_password,
            'status'               => 'Pending',
            'applied_date'         => date("Y-m-d"),
            'created_at'           => date("Y-m-d"),
        ]);

        DB::table( 'tec_exam' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
        ] );

    }

    return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}

public function submit_statusupdate_tecexamregister(Request $request){
    $apply_user_id = 0;
    if($request->retailer_id == 0){
        $apply_user_id = $request->distributor_id;
    }elseif($request->distributor_id == 0){
        $apply_user_id = $request->retailer_id;
    }
    if($request->distributor_id != Auth::user()->id && $apply_user_id != Auth::user()->id){
        $status = $request->status;
        if($status == "Resubmit"){
            DB::table( 'tec_exam' )->where('id', $request->applied_serviceid)->update( [
                'remarks'  => $request->remarks,
                'status'  => $status,
            ] );
        }elseif($status == "Processing"){
            if ( $request->acknowledgement != null ) {
                $acknowledgement = uniqid().'.'.$request->file( 'acknowledgement' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'acknowledgement' . DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'acknowledgement' ][ 'tmp_name' ], $filepath . $acknowledgement );
                DB::table( 'tec_exam' )->where( 'id', $request->applied_serviceid )->update( [
                    'acknowledgement' => $acknowledgement,
                    'status' => $status,
                    'application_no' => $request->application_no,
                ] );
            }
        }elseif($status == "Approved"){
            if ( $request->certificate != null ) {
                $certificate = uniqid().'.'.$request->file( 'certificate' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'certificate'. DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'certificate' ][ 'tmp_name' ], $filepath . $certificate );
                DB::table( 'tec_exam' )->where( 'id', $request->applied_serviceid )->update( [
                    'certificate' => $certificate,
                    'status' => $status,
                    'completed_date' => date("Y-m-d"),
                ] );
            }
        }
    }else{
        $status = "Pending";
        $serviceid = $request->serviceid;
        if ($request->photo != null) {
            $photo = uniqid().'.'.$request->file('photo')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);
            DB::table( 'tec_exam' )->where( 'id', $request->applied_serviceid )->update( [
                'photo'             => $photo,
            ] );
        }
        if ($request->aadhaar_card != null) {
            $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
            DB::table( 'tec_exam' )->where( 'id', $request->applied_serviceid )->update( [
                'aadhaar_card'             => $aadhaar_card,
            ] );
        }

        DB::table('tec_exam')->where('id', $request->applied_serviceid)->update([
            'applicant_name'       => $request->applicant_name,
            'district'             => $request->district,
            'gender'               => $request->gender,
            'email'                => $request->email,
            'address'              => $request->address,
            'dob'                  => $request->dob,
            'mobile'               => $request->mobile,
            'father_name'          => $request->father_name,
            'status'               => 'Pending',
            'applied_date'         => date("Y-m-d"),
            'created_at'           => date("Y-m-d"),
        ]);

        DB::table( 'tec_exam' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
        ] );

    }

    return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}

public function submit_statusupdate_teccorrection(Request $request){
    $apply_user_id = 0;
    if($request->retailer_id == 0){
        $apply_user_id = $request->distributor_id;
    }elseif($request->distributor_id == 0){
        $apply_user_id = $request->retailer_id;
    }
    if($request->distributor_id != Auth::user()->id && $apply_user_id != Auth::user()->id){
        $status = $request->status;
        if($status == "Resubmit"){
            DB::table( 'tec_exam' )->where('id', $request->applied_serviceid)->update( [
                'remarks'  => $request->remarks,
                'status'  => $status,
            ] );
        }elseif($status == "Processing"){
            if ( $request->acknowledgement != null ) {
                $acknowledgement = uniqid().'.'.$request->file( 'acknowledgement' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'acknowledgement' . DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'acknowledgement' ][ 'tmp_name' ], $filepath . $acknowledgement );
                DB::table( 'tec_exam' )->where( 'id', $request->applied_serviceid )->update( [
                    'acknowledgement' => $acknowledgement,
                    'status' => $status,
                    'application_no' => $request->application_no,
                ] );
            }
        }elseif($status == "Approved"){
            if ( $request->certificate != null ) {
                $certificate = uniqid().'.'.$request->file( 'certificate' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'certificate'. DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'certificate' ][ 'tmp_name' ], $filepath . $certificate );
                DB::table( 'tec_exam' )->where( 'id', $request->applied_serviceid )->update( [
                    'certificate' => $certificate,
                    'status' => $status,
                    'completed_date' => date("Y-m-d"),
                ] );
            }
        }
    }else{
        $status = "Pending";
        $serviceid = $request->serviceid;
        if ($request->photo != null) {
            $photo = uniqid().'.'.$request->file('photo')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);
            DB::table( 'tec_exam' )->where( 'id', $request->applied_serviceid )->update( [
                'photo'             => $photo,
            ] );
        }
        if ($request->aadhaar_card != null) {
            $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
            DB::table( 'tec_exam' )->where( 'id', $request->applied_serviceid )->update( [
                'aadhaar_card'             => $aadhaar_card,
            ] );
        }

        DB::table('tec_exam')->where('id', $request->applied_serviceid)->update([
            'applicant_name'  => $request->applicant_name,
            'mobile'          => $request->mobile,
            'email'           => $request->email,
            'tec_password'    => $request->tec_password,
            'status'          => 'Pending',
            'applied_date'    => date("Y-m-d"),
            'created_at'      => date("Y-m-d"),
        ]);

        DB::table( 'tec_exam' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
        ] );

    }

    return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}
public function insexam_update(Request $request){
    $apply_user_id = 0;
    if($request->retailer_id == 0){
        $apply_user_id = $request->distributor_id;
    }elseif($request->distributor_id == 0){
        $apply_user_id = $request->retailer_id;
    }
    if($request->distributor_id != Auth::user()->id && $apply_user_id != Auth::user()->id){
        $status = $request->status;
        if($status == "Resubmit"){
            DB::table( 'tec_exam' )->where('id', $request->applied_serviceid)->update( [
                'remarks'  => $request->remarks,
                'status'  => $status,
            ] );
        }elseif($status == "Processing"){
            if ( $request->acknowledgement != null ) {
                $acknowledgement = uniqid().'.'.$request->file( 'acknowledgement' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'acknowledgement' . DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'acknowledgement' ][ 'tmp_name' ], $filepath . $acknowledgement );
                DB::table( 'tec_exam' )->where( 'id', $request->applied_serviceid )->update( [
                    'acknowledgement' => $acknowledgement,
                    'status' => $status,
                    'application_no' => $request->application_no,
                ] );
            }
        }elseif($status == "Approved"){
            if ( $request->certificate != null ) {
                $certificate = uniqid().'.'.$request->file( 'certificate' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'certificate'. DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'certificate' ][ 'tmp_name' ], $filepath . $certificate );
                DB::table( 'tec_exam' )->where( 'id', $request->applied_serviceid )->update( [
                    'certificate' => $certificate,
                    'status' => $status,
                    'completed_date' => date("Y-m-d"),
                ] );
            }
        }
    }else{
        $status = "Pending";
        $serviceid = $request->serviceid;

        if ($request->aadhaar_card != null) {
            $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
            DB::table( 'tec_exam' )->where( 'id', $request->applied_serviceid )->update( [
                'aadhaar_card'             => $aadhaar_card,
            ] );
        }

        DB::table('tec_exam')->where('id', $request->applied_serviceid)->update([
            'csc_id_number'       => $request->csc_id_number,
            'csc_password'             => $request->csc_password,
            'status'               => 'Pending',
            'applied_date'         => date("Y-m-d"),
            'created_at'           => date("Y-m-d"),
        ]);

        DB::table( 'tec_exam' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
        ] );

    }

    return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}

public function iibfexam_update(Request $request){
        //dd($request->all());
    $apply_user_id = 0;
    if($request->retailer_id == 0){
        $apply_user_id = $request->distributor_id;
    }elseif($request->distributor_id == 0){
        $apply_user_id = $request->retailer_id;
    }
    if($request->distributor_id != Auth::user()->id && $apply_user_id != Auth::user()->id){
        $status = $request->status;
        if($status == "Resubmit"){
            DB::table( 'tec_exam' )->where('id', $request->applied_serviceid)->update( [
                'remarks'  => $request->remarks,
                'status'  => $status,
            ] );
        }elseif($status == "Processing"){
            if ( $request->acknowledgement != null ) {
                $acknowledgement = uniqid().'.'.$request->file( 'acknowledgement' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'acknowledgement' . DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'acknowledgement' ][ 'tmp_name' ], $filepath . $acknowledgement );
                DB::table( 'tec_exam' )->where( 'id', $request->applied_serviceid )->update( [
                    'acknowledgement' => $acknowledgement,
                    'status' => $status,
                    'application_no' => $request->application_no,
                ] );
            }
        }elseif($status == "Approved"){
            if ( $request->certificate != null ) {
                $certificate = uniqid().'.'.$request->file( 'certificate' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'certificate'. DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'certificate' ][ 'tmp_name' ], $filepath . $certificate );
                DB::table( 'tec_exam' )->where( 'id', $request->applied_serviceid )->update( [
                    'certificate' => $certificate,
                    'status' => $status,
                    'completed_date' => date("Y-m-d"),
                ] );
            }
        }
    }else{
        $status = "Pending";
        $serviceid = $request->serviceid;

        if ($request->aadhaar_card != null) {
            $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
            DB::table( 'tec_exam' )->where( 'id', $request->applied_serviceid )->update( [
                'aadhaar_card'             => $aadhaar_card,
            ] );
        }
        if ($request->pan_card != null) {
            $pan_card = uniqid().'.'.$request->file('pan_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'pan_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['pan_card']['tmp_name'], $filepath . $pan_card);
            DB::table( 'tec_exam' )->where( 'id', $request->applied_serviceid )->update( [
                'pan_card'             => $pan_card,
            ] );
        }
        if ($request->signature != null) {
            $signature = uniqid().'.'.$request->file('signature')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'signature' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['signature']['tmp_name'], $filepath . $signature);
            DB::table( 'tec_exam' )->where( 'id', $request->applied_serviceid )->update( [
                'signature'             => $signature,
            ] );
        }
        if ($request->photo != null) {
            $photo = uniqid().'.'.$request->file('photo')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);
            DB::table( 'tec_exam' )->where( 'id', $request->applied_serviceid )->update( [
                'photo'             => $photo,
            ] );
        }
        DB::table('tec_exam')->where('id', $request->applied_serviceid)->update([

            'status'               => 'Pending',
            'applied_date'         => date("Y-m-d"),
            'created_at'           => date("Y-m-d"),
        ]);

        DB::table( 'tec_exam' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
        ] );

    }

    return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}

public function rapexam_update(Request $request){
    $apply_user_id = 0;
    if($request->retailer_id == 0){
        $apply_user_id = $request->distributor_id;
    }elseif($request->distributor_id == 0){
        $apply_user_id = $request->retailer_id;
    }
    if($request->distributor_id != Auth::user()->id && $apply_user_id != Auth::user()->id){
        $status = $request->status;
        if($status == "Resubmit"){
            DB::table( 'tec_exam' )->where('id', $request->applied_serviceid)->update( [
                'remarks'  => $request->remarks,
                'status'  => $status,
            ] );
        }elseif($status == "Processing"){
            if ( $request->acknowledgement != null ) {
                $acknowledgement = uniqid().'.'.$request->file( 'acknowledgement' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'acknowledgement' . DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'acknowledgement' ][ 'tmp_name' ], $filepath . $acknowledgement );
                DB::table( 'tec_exam' )->where( 'id', $request->applied_serviceid )->update( [
                    'acknowledgement' => $acknowledgement,
                    'status' => $status,
                    'application_no' => $request->application_no,
                ] );
            }
        }elseif($status == "Approved"){
            if ( $request->certificate != null ) {
                $certificate = uniqid().'.'.$request->file( 'certificate' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'certificate'. DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'certificate' ][ 'tmp_name' ], $filepath . $certificate );
                DB::table( 'tec_exam' )->where( 'id', $request->applied_serviceid )->update( [
                    'certificate' => $certificate,
                    'status' => $status,
                    'completed_date' => date("Y-m-d"),
                ] );
            }
        }
    }else{
        $status = "Pending";
        $serviceid = $request->serviceid;

        if ($request->aadhaar_card != null) {
            $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
            DB::table( 'tec_exam' )->where( 'id', $request->applied_serviceid )->update( [
                'aadhaar_card'             => $aadhaar_card,
            ] );
        }
        if ($request->e_aadhaar_pdf != null) {
            $e_aadhaar_pdf = uniqid().'.'.$request->file('e_aadhaar_pdf')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'e_aadhaar_pdf' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['e_aadhaar_pdf']['tmp_name'], $filepath . $e_aadhaar_pdf);
            DB::table( 'tec_exam' )->where( 'id', $request->applied_serviceid )->update( [
                'e_aadhaar_pdf'             => $e_aadhaar_pdf,
            ] );
        }

        DB::table('tec_exam')->where('id', $request->applied_serviceid)->update([
            'csc_id_number'        => $request->csc_id_number,
            'csc_password'         => $request->csc_password,
            'e_aadhaar_password'   => $request->e_aadhaar_password,
            'status'               => 'Pending',
            'applied_date'         => date("Y-m-d"),
            'created_at'           => date("Y-m-d"),
        ]);

        DB::table( 'tec_exam' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
        ] );

    }

    return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}

public function vleinsurance_update(Request $request){
    $apply_user_id = 0;
    if($request->retailer_id == 0){
        $apply_user_id = $request->distributor_id;
    }elseif($request->distributor_id == 0){
        $apply_user_id = $request->retailer_id;
    }
    if($request->distributor_id != Auth::user()->id && $apply_user_id != Auth::user()->id){
        $status = $request->status;
        if($status == "Resubmit"){
            DB::table( 'tec_exam' )->where('id', $request->applied_serviceid)->update( [
                'remarks'  => $request->remarks,
                'status'  => $status,
            ] );
        }elseif($status == "Processing"){
            if ( $request->acknowledgement != null ) {
                $acknowledgement = uniqid().'.'.$request->file( 'acknowledgement' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'acknowledgement' . DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'acknowledgement' ][ 'tmp_name' ], $filepath . $acknowledgement );
                DB::table( 'tec_exam' )->where( 'id', $request->applied_serviceid )->update( [
                    'acknowledgement' => $acknowledgement,
                    'status' => $status,
                    'application_no' => $request->application_no,
                ] );
            }
        }elseif($status == "Approved"){
            if ( $request->certificate != null ) {
                $certificate = uniqid().'.'.$request->file( 'certificate' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'certificate'. DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'certificate' ][ 'tmp_name' ], $filepath . $certificate );
                DB::table( 'tec_exam' )->where( 'id', $request->applied_serviceid )->update( [
                    'certificate' => $certificate,
                    'status' => $status,
                    'completed_date' => date("Y-m-d"),
                ] );
            }
        }
    }else{
        $status = "Pending";
        $serviceid = $request->serviceid;

        if ($request->aadhaar_card != null) {
            $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
            DB::table( 'tec_exam' )->where( 'id', $request->applied_serviceid )->update( [
                'aadhaar_card'             => $aadhaar_card,
            ] );
        }

        DB::table('tec_exam')->where('id', $request->applied_serviceid)->update([
            'csc_id_number'        => $request->csc_id_number,
            'csc_password'         => $request->csc_password,
            'status'               => 'Pending',
            'applied_date'         => date("Y-m-d"),
            'created_at'           => date("Y-m-d"),
        ]);

        DB::table( 'tec_exam' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
        ] );

    }

    return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}

public function submitsmartcard_register_update(Request $request){
    $apply_user_id = 0;
    if($request->retailer_id == 0){
        $apply_user_id = $request->distributor_id;
    }elseif($request->distributor_id == 0){
        $apply_user_id = $request->retailer_id;
    }
    if($request->distributor_id != Auth::user()->id && $request->retailer_id != Auth::user()->id){
        $status = $request->status;
        if($status == "Resubmit"){
            DB::table( 'smartcard' )->where('id', $request->applied_serviceid)->update( [
                'remarks' => $request->remarks,
                'status'  => $status,
            ] );
        }elseif($status == "Processing"){
            if ( $request->acknowledgement != null ) {
                $acknowledgement = uniqid().'.'.$request->file( 'acknowledgement' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'acknowledgement' . DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'acknowledgement' ][ 'tmp_name' ], $filepath . $acknowledgement );
                DB::table( 'smartcard' )->where( 'id', $request->applied_serviceid )->update( [
                    'acknowledgement' => $acknowledgement,
                    'status' => $status,
                    'application_no' => $request->application_no,
                ] );
            }
        }elseif($status == "Approved"){
            if ( $request->certificate != null ) {
                $certificate = uniqid().'.'.$request->file( 'certificate' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'certificate'. DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'certificate' ][ 'tmp_name' ], $filepath . $certificate );
                DB::table( 'smartcard' )->where( 'id', $request->applied_serviceid )->update( [
                    'certificate' => $certificate,
                    'status' => $status,
                    'completed_date' => date("Y-m-d"),
                ] );
            }
        }
    }else{
        $status = "Pending";
        $serviceid = $request->serviceid;
        if( $serviceid == 36 ) {
            DB::table('smartcard')->where('id', $request->applied_serviceid)->update([
                'service_id'                => $request ->serviceid,
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
            ] );
            if($request->has('relationship')){
                foreach ( $request->relationship as $key => $relation ) {
                    $relation_name = $request->relation_name[ $key ];
                    $relation_dob = $request->relation_dob[ $key ];
                    $maritial_status = $request->maritial_status[ $key ];

                    $sql = "insert into smartcard_family_member (user_id,relation,relation_name,maritial_status,relation_dob) values ($user_id,'$relation','$relation_name','$maritial_status','$relation_dob')";
                    DB::insert( $sql );
                    $relation_id = DB::getPdo()->lastInsertId();
                    if ($request->doc[$key] != null) {
                        $aadhaarcard = uniqid().'.'.$request->file('doc')[$key]->extension();
                        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'users' . DIRECTORY_SEPARATOR . 'relationaadhaar_card' . DIRECTORY_SEPARATOR);
                        move_uploaded_file($_FILES['doc']['tmp_name'][$key], $filepath . $aadhaarcard);
                        DB::table( 'smartcard_family_member' )->where( 'id', $relation_id )->update( [
                            'relationaadhaar_card'       => $aadhaarcard,
                        ] );
                    }
                }
            }
            if ($request->aadhaar_card != null) {
                $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
                DB::table( 'smartcard' )->where( 'id', $request->applied_serviceid )->update( [
                    'aadhaar_card'         => $aadhaar_card,
                ] );
            }
            if ($request->family_head_photo != null) {
                $family_head_photo = uniqid().'.'.$request->file('family_head_photo')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'family_head_photo' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['family_head_photo']['tmp_name'], $filepath . $family_head_photo);
                DB::table( 'smartcard' )->where( 'id', $request->applied_serviceid )->update( [
                    'family_head_photo'         => $family_head_photo,
                ]);
            }
            if ($request->commodity_card != null) {
                $commodity_card = uniqid().'.'.$request->file('commodity_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'commodity_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['commodity_card']['tmp_name'], $filepath . $commodity_card);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'commodity_card' => $commodity_card,
                ]);
            }
            if ($request->smart_card != null) {
                $smart_card = uniqid().'.'.$request->file('smart_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smart_card);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'smart_card' => $smart_card,
                ]);
            }
            if ($request->electricity_bill_receipt != null) {
                $electricity_bill_receipt = uniqid().'.'.$request->file('electricity_bill_receipt')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'electricity_bill' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['electricity_bill_receipt']['tmp_name'], $filepath . $electricity_bill_receipt);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'electricity_bill_receipt' => $electricity_bill_receipt,
                ]);
            }
            if ($request->telephone_charges != null) {
                $telephone_charges = uniqid().'.'.$request->file('telephone_charges')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'telephonebill' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['telephone_charges']['tmp_name'], $filepath . $telephone_charges);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'telephone_charges'         => $telephone_charges,
                ]);
            }
            if ($request->voter_id != null) {
                $voter_id = uniqid().'.'.$request->file('voter_id')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'voterid' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['voter_id']['tmp_name'], $filepath . $voter_id);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'voter_id'         => $voter_id,
                ]);
            }
            if ($request->passport != null) {
                $passport = uniqid().'.'.$request->file('passport')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'passport' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['passport']['tmp_name'], $filepath . $passport);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'passport'         => $passport,
                ]);
            }
            if ($request->gas_cylinder_receipt != null) {
                $gas_cylinder_receipt = uniqid().'.'.$request->file('gas_cylinder_receipt')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'gas_cylinder' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['gas_cylinder_receipt']['tmp_name'], $filepath . $gas_cylinder_receipt);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'gas_cylinder_receipt'         => $gas_cylinder_receipt,
                ]);
            }
            if ($request->property_tax_applicant_owns_house != null) {
                $property_tax_applicant_owns_house = uniqid().'.'.$request->file('property_tax_applicant_owns_house')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'property_tax' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['property_tax_applicant_owns_house']['tmp_name'], $filepath . $property_tax_applicant_owns_house);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'property_tax_applicant_owns_house'         => $property_tax_applicant_owns_house,
                ]);
            }
            if ($request->lease_deed != null) {
                $lease_deed = uniqid().'.'.$request->file('lease_deed')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'lease_deed' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['lease_deed']['tmp_name'], $filepath . $lease_deed);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'lease_deed'         => $lease_deed,
                ]);
            }
            if ($request->allotment_rder_of_slum_replacement_board != null) {
                $allotment_rder_of_slum_replacement_board = uniqid().'.'.$request->file('allotment_rder_of_slum_replacement_board')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'allotment' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['allotment_rder_of_slum_replacement_board']['tmp_name'], $filepath . $lease_deed);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'allotment_rder_of_slum_replacement_board' => $allotment_rder_of_slum_replacement_board,
                ]);
            }
            if ($request->first_page_of_bank_account_book != null) {
                $bond_leave_proof = uniqid().'.'.$request->file('first_page_of_bank_account_book')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'first_page_of_bank' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['first_page_of_bank_account_book']['tmp_name'], $filepath . $lease_deed);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'first_page_of_bank_account_book'   => $first_page_of_bank_account_book,
                ]);
            }
            if ($request->bond_leave_proof != null) {
                $bond_leave_proof = uniqid().'.'.$request->file('bond_leave_proof')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'bond_leave' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['bond_leave_proof']['tmp_name'], $filepath . $lease_deed);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'bond_leave_proof'         => $bond_leave_proof,
                ]);
            }
            if ($request->rice_card != null) {
                $rice_card = uniqid().'.'.$request->file('rice_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'ricecard' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['rice_card']['tmp_name'], $filepath . $rice_card);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'rice_card'         => $rice_card,
                ]);
            }
            if ($request->sugar_card != null) {
                $sugar_card = uniqid().'.'.$request->file('sugar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'sugarcard' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['sugar_card']['tmp_name'], $filepath . $sugar_card);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'sugar_card'         => $sugar_card,
                ]);
            }
            if ($request->others != null) {
                $others = uniqid().'.'.$request->file('others')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'others' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['others']['tmp_name'], $filepath . $others);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'others'         => $others,
                ]);
            }
        }elseif( $serviceid == 37 ){
            DB::table('smartcard')->where('id', $request->applied_serviceid)->update([
                'service_id'                => $request ->serviceid,
                'name'                      => $request->name,
                'mobile'                    => $request->mobile,
                'dist_id'                   => $request->dist_id,
                'status'                    => 'Pending',
                'applied_date'              => date("Y-m-d"),
                'created_at'                => date("Y-m-d"),
            ] );

            if ($request->aadhaar_card != null) {
                $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'aadhaar_card' => $aadhaar_card,
                ]);
            }
            if ($request->smart_card != null) {
                $smart_card = uniqid().'.'.$request->file('smart_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smart_card);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'smart_card' => $smart_card,
                ]);
            }
            if ($request->photo != null) {
                $photo = uniqid().'.'.$request->file('photo')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'photo' => $photo,
                ]);
            }
        }elseif( $serviceid == 38 ){
            DB::table( 'smartcard' )->where('id', $request->applied_serviceid)->update([
                'service_id'                => $request ->serviceid,
                'name'                      => $request->name,
                'mobile'                    => $request->mobile,
                'any_proof'                 => $request->any_proof,
                'status'                    => 'Pending',
                'applied_date'              => date("Y-m-d"),
                'created_at'                => date("Y-m-d"),
            ] );
            if ($request->aadhaar_card != null) {
                $aadhaarimg = uniqid().'.'.$request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'aadhaar_card' => $aadhaarimg,
                ]);
            }
            if ($request->smart_card != null) {
                $smart_card = uniqid().'.'.$request->file('smart_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smart_card);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'smart_card' => $smart_card,
                ]);
            }
            if ($request->death_certificate != null) {
                $death_certificate = uniqid().'.'.$request->file('death_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'deathcertificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['death_certificate']['tmp_name'], $filepath . $death_certificate);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'death_certificate' => $death_certificate,
                ]);
            }
            if ($request->mrg_certificate != null) {
                $mrg_certificate = uniqid().'.'.$request->file('mrg_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'mrgcertificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['mrg_certificate']['tmp_name'], $filepath . $mrg_certificate);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'mrg_certificate' => $mrg_certificate,
                ]);
            }
            if ($request->mrg_invitation != null) {
                $mrg_invitation = uniqid().'.'.$request->file('mrg_invitation')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'mrginvitation' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['mrg_invitation']['tmp_name'], $filepath . $mrg_invitation);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'mrg_invitation' => $mrg_invitation,
                ]);
            }
        }elseif( $serviceid == 39 ){
            DB::table( 'smartcard' )->where('id', $request->applied_serviceid)->update([
                'service_id'                => $request ->serviceid,
                'name'                      => $request->name,
                'mobile'                    => $request->mobile,
                'status'                    => 'Pending',
                'applied_date'              => date("Y-m-d"),
                'created_at'                => date("Y-m-d"),
            ] );
            if ($request->aadhaar_card != null) {
                $aadhaarimg = uniqid().'.'.$request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'aadhaar_card' => $aadhaarimg,
                ]);
            }
            if ($request->smart_card != null) {
                $smart_card = uniqid().'.'.$request->file('smart_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smart_card);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'smart_card' => $smart_card,
                ]);
            }
        }elseif( $serviceid == 41 ){
            DB::table( 'smartcard' )->where('id', $request->applied_serviceid)->update([
                'service_id'                => $request ->serviceid,
                'name'                      => $request->name,
                'mobile'                    => $request->mobile,
                'new_proof'                 => $request->new_proof,
                'status'                    => 'Pending',
                'applied_date'              => date("Y-m-d"),
                'created_at'                => date("Y-m-d"),
            ] );
            if ($request->aadhaar_card != null) {
                $aadhaarimg = uniqid().'.'.$request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'aadhaar_card' => $aadhaarimg,
                ]);
            }
            if ($request->smart_card != null) {
                $smart_card = uniqid().'.'.$request->file('smart_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smart_card);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'smart_card' => $smart_card,
                ]);
            }
            if ($request->birth_certificate != null) {
                $birth_certificate = uniqid().'.'.$request->file('birth_certificate')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'birth_certificate' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['birth_certificate']['tmp_name'], $filepath . $birth_certificate);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'birth_certificate'         => $birth_certificate,
                ]);
            }
            if ($request->voter_id != null) {
                $voter_id = uniqid().'.'.$request->file('voter_id')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'voterid' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['voter_id']['tmp_name'], $filepath . $voter_id);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'voter_id'         => $voter_id,
                ]);
            }
        }elseif( $serviceid == 42 ){
            DB::table( 'smartcard' )->where('id', $request->applied_serviceid)->update([
                'service_id'                => $request ->serviceid,
                'name'                      => $request->name,
                'mobile'                    => $request->mobile,
                'any_document'              => $request->any_document,
                'status'                    => 'Pending',
                'applied_date'              => date("Y-m-d"),
                'created_at'                => date("Y-m-d"),
            ] );
            if ($request->aadhaar_card != null) {
                $aadhaarimg = uniqid().'.'.$request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'aadhaar_card' => $aadhaarimg,
                ]);
            }
            if ($request->smart_card != null) {
                $smart_card = uniqid().'.'.$request->file('smart_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smart_card);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'smart_card' => $smart_card,
                ]);
            }
            if ($request->passport != null) {
                $passport = uniqid().'.'.$request->file('passport')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'passport' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['passport']['tmp_name'], $filepath . $passport);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'passport'         => $passport,
                ]);
            }
            if ($request->voter_id != null) {
                $voter_id = uniqid().'.'.$request->file('voter_id')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'voterid' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['voter_id']['tmp_name'], $filepath . $voter_id);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'voter_id'         => $voter_id,
                ]);
            }
            if ($request->electricity_bill_receipt != null) {
                $electricity_bill_receipt = uniqid().'.'.$request->file('electricity_bill_receipt')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'electricity_bill' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['electricity_bill_receipt']['tmp_name'], $filepath . $electricity_bill_receipt);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'electricity_bill_receipt'         => $electricity_bill_receipt,
                ]);
            }
            if ($request->telephone_charges != null) {
                $telephone_charges = uniqid().'.'.$request->file('telephone_charges')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'telephonebill' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['telephone_charges']['tmp_name'], $filepath . $telephone_charges);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'telephone_charges'       => $telephone_charges,
                ]);
            }
            if ($request->gas_cylinder_receipt != null) {
                $gas_cylinder_receipt = uniqid().'.'.$request->file('gas_cylinder_receipt')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'gas_cylinder' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['gas_cylinder_receipt']['tmp_name'], $filepath . $gas_cylinder_receipt);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'gas_cylinder_receipt'     => $gas_cylinder_receipt,
                ]);
            }
            if ($request->property_tax_applicant_owns_house != null) {
                $property_tax_applicant_owns_house = uniqid().'.'.$request->file('property_tax_applicant_owns_house')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'property_tax' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['property_tax_applicant_owns_house']['tmp_name'], $filepath . $property_tax_applicant_owns_house);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'property_tax_applicant_owns_house'    => $property_tax_applicant_owns_house,
                ]);
            }
            if ($request->lease_deed != null) {
                $lease_deed = uniqid().'.'.$request->file('lease_deed')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'lease_deed' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['lease_deed']['tmp_name'], $filepath . $lease_deed);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'lease_deed'         => $lease_deed,
                ]);
            }
            if ($request->allotment_rder_of_slum_replacement_board != null) {
                $allotment_rder_of_slum_replacement_board = uniqid().'.'.$request->file('allotment_rder_of_slum_replacement_board')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'allotment' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['allotment_rder_of_slum_replacement_board']['tmp_name'], $filepath . $lease_deed);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'allotment_rder_of_slum_replacement_board' => $allotment_rder_of_slum_replacement_board,
                ]);
            }
            if ($request->bond_leave_proof != null) {
                $bond_leave_proof = uniqid().'.'.$request->file('bond_leave_proof')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'bond_leave' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['bond_leave_proof']['tmp_name'], $filepath . $lease_deed);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'bond_leave_proof'         => $bond_leave_proof,
                ]);
            }
            if ($request->first_page_of_bank_account_book != null) {
                $bond_leave_proof = uniqid().'.'.$request->file('first_page_of_bank_account_book')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'first_page_of_bank' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['first_page_of_bank_account_book']['tmp_name'], $filepath . $lease_deed);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'first_page_of_bank_account_book'   => $first_page_of_bank_account_book,
                ]);
            }
        }elseif( $serviceid == 43 ){
            DB::table( 'smartcard' )->where( 'id', $request->applied_serviceid )->update( [
                'service_id'                => $request ->serviceid,
                'name'                      => $request->name,
                'mobile'                    => $request->mobile,
                'status'                    => 'Pending',
                'applied_date'              => date("Y-m-d"),
                'created_at'                => date("Y-m-d"),
            ] );
            if ($request->aadhaar_card != null) {
                $aadhaarimg = uniqid().'.'.$request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'aadhaar_card' => $aadhaarimg,
                ]);
            }
            if ($request->smart_card != null) {
                $smart_card = uniqid().'.'.$request->file('smart_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smart_card);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'smart_card' => $smart_card,
                ]);
            }
            if ($request->photo != null) {
                $photo = uniqid().'.'.$request->file('photo')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'photo' => $photo,
                ]);
            }
        }
        DB::table( 'smartcard' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
        ] );
    }

    return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}
public function aadhaarcardupdate(Request $request){
    $apply_user_id = 0;
    if($request->retailer_id == 0){
        $apply_user_id = $request->distributor_id;
    }elseif($request->distributor_id == 0){
        $apply_user_id = $request->retailer_id;
    }
    if($request->distributor_id != Auth::user()->id && $request->retailer_id != Auth::user()->id){
        $status = $request->status;
        if($status == "Resubmit"){
            DB::table( 'aadhaarcard' )->where('id', $request->applied_serviceid)->update( [
                'remarks' => $request->remarks,
                'status'  => $status,
            ] );
        }elseif($status == "Processing"){
            if ( $request->acknowledgement != null ) {
                $acknowledgement = uniqid().'.'.$request->file( 'acknowledgement' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'acknowledgement' . DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'acknowledgement' ][ 'tmp_name' ], $filepath . $acknowledgement );
                DB::table( 'aadhaarcard' )->where( 'id', $request->applied_serviceid )->update( [
                    'acknowledgement' => $acknowledgement,
                    'status' => $status,
                    'application_no' => $request->application_no,
                ] );
            }
        }elseif($status == "Approved"){
            if ( $request->certificate != null ) {
                $certificate = uniqid().'.'.$request->file( 'certificate' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'certificate'. DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'certificate' ][ 'tmp_name' ], $filepath . $certificate );
                DB::table( 'aadhaarcard' )->where( 'id', $request->applied_serviceid )->update( [
                    'certificate' => $certificate,
                    'status' => $status,
                    'completed_date' => date("Y-m-d"),
                ] );
            }
        }
    }else{
        $status = "Pending";
        $serviceid = $request->serviceid;
        if($serviceid == 56){
            if ($request->aadhaar_card != null) {
                $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
                DB::table( 'aadhaarcard' )->where( 'id', $request->applied_serviceid )->update( [
                    'aadhaar_card'         => $aadhaar_card,
                ] );
            }

            if ($request->signature != null) {
                $signature = uniqid().'.'.$request->file('signature')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['signature']['tmp_name'], $filepath . $signature);
                DB::table( 'aadhaarcard' )->where( 'id', $request->applied_serviceid )->update( [
                    'signature'             => $signature,
                ] );
            }

            if ($request->photo != null) {
                $photo = uniqid().'.'.$request->file('photo')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);
                DB::table( 'aadhaarcard' )->where( 'id', $request->applied_serviceid )->update( [
                    'photo'             => $photo,
                ] );
            }

            DB::table('aadhaarcard')->where('id', $request->applied_serviceid)->update([
                'user_id'           => $request->user_id,
                'retailer_id'       => $request->retailer_id,
                'service_id'        => $request ->serviceid,
               'name'                 => $request->name,
                    'dist_id'              => $request->dist_id,
                    'taluk_id'             => $request->taluk_id,
                    'mobile'               => $request->mobile,
                    'relationship'         => $request->relationship,
                    'name_tamil'           => $request->name_tamil,
                    'name_english'         => $request->name_english,
                    'address_tamil'        => $request->address_tamil,
                    'address_english'      => $request->address_english,
                    'door_no'              => $request->door_no,
                    'street_name'          => $request->street_name,
                    'postal_area_english'  => $request->postal_area_english,
                    'pin_code'             => $request->pin_code,
                    'street_name_tamil'    => $request->street_name_tamil,
                    'postal_area_tamil'    => $request->postal_area_tamil,
                    'status'               => 'Pending',
                    'applied_date'         => date("Y-m-d"),
                    'created_at'           => date("Y-m-d"),
                ]);

    $getpermission = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
    $coordinator_permission = 0;
    if($getpermission){
        $coordinator_permission = $getpermission->coordinator_permission;
    }
    //echo$coordinator_permission;die;
    if($coordinator_permission == 1){
     $getdata = DB::table( 'aadhaarcard' )->where('id',$request->applied_serviceid)->first();
     if($getdata){
     $aadhaar_card = $getdata->aadhaar_card;
     $photo = $getdata->photo;
     $signature = $getdata->signature;
     $service_id = $getdata->service_id;
     $rowid = $getdata->id;
     $name = $getdata->name;
     $door_no = $getdata->door_no;
     $dist_id = $getdata->dist_id;
     $taluk_id = $getdata->taluk_id;
     $street_name = $getdata->street_name;
     $postal_area_english = $getdata->postal_area_english;
     $address_english = $getdata->address_english;
     $mobile = $getdata->mobile;
     $pin_code = $getdata->pin_code;
     $street_name_tamil = $getdata->street_name_tamil;
     $postal_area_tamil = $getdata->postal_area_tamil;
     $address_tamil = $getdata->address_tamil;
     $status = $getdata->status;
     $url = url('/');
     $aadhaar_url = $url.'/upload/services/aadhaar_card/'.$aadhaar_card;
     $photo_url = $url.'/upload/services/photo/'.$photo;
     $signature_url = $url.'/upload/services/signature/'.$signature;
     $API_KEY = env( 'API_KEY', '' );
     $RAMJIPAY_URL = env( 'RAMJIPAY_URL', '' );
     $WEBSITE_INDEX = env( 'WEBSITE_INDEX', '' );

     $ch = curl_init();
        $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=$service_id&rowid=$rowid&status=$status&photo=$photo_url&signature=$signature_url&name=$name&door_no=$door_no&dist_id=$dist_id&taluk_id=$taluk_id&street_name=$street_name&postal_area_english=$postal_area_english&address_english=$address_english&mobile=$mobile&pin_code=$pin_code&street_name_tamil=$street_name_tamil&postal_area_tamil=$postal_area_tamil&address_tamil=$address_tamil";
        //dd($post_data);
        $url1 = $RAMJIPAY_URL.'/api/update_aadhaarcard_api';
        //echo $url1;die;

        curl_setopt( $ch, CURLOPT_URL, $url1 );
        curl_setopt( $ch, CURLOPT_POST, 1 );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_data );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $server_output = curl_exec( $ch );
        curl_close( $ch );
        $resdata = json_decode($server_output, true);
       //dd($resdata);
    }
}

        }elseif($serviceid == 58){

            if ($request->aadhaar_card != null) {
                $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
                DB::table( 'aadhaarcard' )->where( 'id', $request->applied_serviceid )->update( [
                    'aadhaar_card'         => $aadhaar_card,
                ] );
            }

            if ($request->signature != null) {
                $signature = uniqid().'.'.$request->file('signature')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['signature']['tmp_name'], $filepath . $signature);
                DB::table( 'aadhaarcard' )->where( 'id', $request->applied_serviceid )->update( [
                    'signature'             => $signature,
                ] );
            }

            if ($request->photo != null) {
                $photo = uniqid().'.'.$request->file('photo')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);
                DB::table( 'aadhaarcard' )->where( 'id', $request->applied_serviceid )->update( [
                    'photo'             => $photo,
                ] );
            }

            if ($request->proof != null) {
                $proof = uniqid().'.'.$request->file('proof')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'proof' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['proof']['tmp_name'], $filepath . $proof);
                DB::table( 'aadhaarcard' )->where( 'id', $request->applied_serviceid )->update( [
                    'proof'             => $proof,
                ] );
            }

            DB::table('aadhaarcard')->where('id', $request->applied_serviceid)->update([
                'user_id'           => $request->user_id,
                'retailer_id'       => $request->retailer_id,
                'service_id'        => $request ->serviceid,
                'name'              => $request->name,
                'mobile'            => $request->mobile,
                'relationship'      => $request->relationship,
                'name_tamil'        => $request->name_tamil,
                'name_english'      => $request->name_english,
                'address_tamil'     => $request->address_tamil,
                'address_english'   => $request->address_english,
                'address_proof'     => $request->address_proof,
                'status'            => 'Pending',
                'applied_date'      => date("Y-m-d"),
                'created_at'        => date("Y-m-d"),
            ]);
        }elseif($serviceid == 158 || $serviceid == 159 ){
            if ($request->aadhaar_card != null) {
                $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
                DB::table( 'aadhaarcard' )->where( 'id', $request->applied_serviceid )->update( [
                    'aadhaar_card'         => $aadhaar_card,
                ] );
            }

            if ($request->enrollment_slip != null) {
                $enrollment_slip = uniqid().'.'.$request->file('enrollment_slip')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'enrollment_slip' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['enrollment_slip']['tmp_name'], $filepath . $enrollment_slip);
                DB::table( 'aadhaarcard' )->where( 'id', $request->applied_serviceid )->update( [
                    'enrollment_slip'             => $enrollment_slip,
                ] );
            }

            if ($request->correction_proof != null) {
                $correction_proof = uniqid().'.'.$request->file('correction_proof')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'correction_proof' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['correction_proof']['tmp_name'], $filepath . $correction_proof);
                DB::table( 'aadhaarcard' )->where( 'id', $request->applied_serviceid )->update( [
                    'correction_proof'             => $correction_proof,
                ] );
            }

            DB::table('aadhaarcard')->where('id', $request->applied_serviceid)->update([
                'user_id'           => $request->user_id,
                'retailer_id'       => $request->retailer_id,
                'service_id'        => $request ->serviceid,
                'name'              => $request->name,
                'status'            => 'Pending',
                'applied_date'      => date("Y-m-d"),
                'created_at'        => date("Y-m-d"),
            ]);
        }elseif($serviceid == 160 || $serviceid == 161 ){

            if ($request->enrollment_slip != null) {
                $enrollment_slip = uniqid().'.'.$request->file('enrollment_slip')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'enrollment_slip' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['enrollment_slip']['tmp_name'], $filepath . $enrollment_slip);
                DB::table( 'aadhaarcard' )->where( 'id', $request->applied_serviceid )->update( [
                    'enrollment_slip'             => $enrollment_slip,
                ] );
            }

            DB::table('aadhaarcard')->where('id', $request->applied_serviceid)->update([
                'user_id'           => $request->user_id,
                'retailer_id'       => $request->retailer_id,
                'service_id'        => $request ->serviceid,
                'name'              => $request->name,
                'enrollment_no'     => $request->enrollment_no,
                'enrollment_type'   => $request->enrollment_type,
                'status'            => 'Pending',
                'applied_date'      => date("Y-m-d"),
                'created_at'        => date("Y-m-d"),
            ]);
        }elseif($serviceid == 162 ){

            DB::table('aadhaarcard')->where('id', $request->applied_serviceid)->update([
                'user_id'           => $request->user_id,
                'retailer_id'       => $request->retailer_id,
                'service_id'        => $request ->serviceid,
                'name'              => $request->name,
                'mobile'            => $request->mobile,
                'aadhaar_no'        => $request->aadhaar_no,
                'status'            => 'Pending',
                'applied_date'      => date("Y-m-d"),
                'created_at'        => date("Y-m-d"),
            ]);
        }elseif($serviceid == 163 ){
            DB::table('aadhaarcard')->where('id', $request->applied_serviceid)->update([
                'user_id'           => $request->user_id,
                'retailer_id'       => $request->retailer_id,
                'service_id'        => $request ->serviceid,
                'amount'            => $request->amount,
                'name'              => $request->name,
                'aadhaar_no'        => $request->aadhaar_no,
                'status'            => 'Pending',
                'applied_date'      => date("Y-m-d"),
                'created_at'        => date("Y-m-d"),
            ]);
        }

        DB::table( 'aadhaarcard' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
        ] );

    }

    return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}
public function findaadhaar_numberupdate(Request $request){
//dd($request->all());
    $apply_user_id = 0;
    if($request->retailer_id == 0){
        $apply_user_id = $request->distributor_id;
    }elseif($request->distributor_id == 0){
        $apply_user_id = $request->retailer_id;
    }
    if($request->distributor_id != Auth::user()->id && $request->retailer_id != Auth::user()->id){
        $status = $request->status;
        if($status == "Resubmit"){
            DB::table( 'aadhaarcard' )->where('id', $request->applied_serviceid)->update( [
                'remarks' => $request->remarks,
                'status'  => $status,
            ] );
        }elseif($status == "Processing"){
            if ( $request->acknowledgement != null ) {
                $acknowledgement = uniqid().'.'.$request->file( 'acknowledgement' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'acknowledgement' . DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'acknowledgement' ][ 'tmp_name' ], $filepath . $acknowledgement );
                DB::table( 'aadhaarcard' )->where( 'id', $request->applied_serviceid )->update( [
                    'acknowledgement' => $acknowledgement,
                    'status' => $status,
                    'application_no' => $request->application_no,
                ] );
            }
        }elseif($status == "Approved"){
            if ( $request->certificate != null ) {
                $certificate = uniqid().'.'.$request->file( 'certificate' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'certificate'. DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'certificate' ][ 'tmp_name' ], $filepath . $certificate );
                DB::table( 'aadhaarcard' )->where( 'id', $request->applied_serviceid )->update( [
                    'certificate' => $certificate,
                    'status' => $status,
                    'completed_date' => date("Y-m-d"),
                ] );
            }
        }
    }else{
        $status = "Pending";
        $serviceid = $request->serviceid;
        if ($request->aadhaar_entrolment_slip != null) {
            $aadhaar_entrolment_slip = uniqid().'.'.$request->file('aadhaar_entrolment_slip')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'aadhaar_entrolment_slip' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['aadhaar_entrolment_slip']['tmp_name'], $filepath . $aadhaar_entrolment_slip);
            DB::table( 'aadhaarcard' )->where( 'id', $request->applied_serviceid )->update( [
                'aadhaar_entrolment_slip'         => $aadhaar_entrolment_slip,
            ] );
        }

        DB::table('aadhaarcard')->where('id', $request->applied_serviceid)->update([
            'name'              => $request->name,
            'documents'         => $request->documents,
            'pan_card_no'       => $request->pan_card_no,
            'smart_link_no'     => $request->smart_link_no,
            'status'            => 'Pending',
            'applied_date'      => date("Y-m-d"),
            'created_at'        => date("Y-m-d"),
        ]);


        DB::table( 'aadhaarcard' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
        ] );

    }

    return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}
public function caneditupdate(Request $request){
    $apply_user_id = 0;
    if ($request->distributor_id == 0 && $request->retailer_id == 0) {
        $apply_user_id = $request->user_id;
    }
    elseif($request->retailer_id == 0){
        $apply_user_id = $request->distributor_id;
    }elseif($request->distributor_id == 0){
        $apply_user_id = $request->retailer_id;
    }
    if($apply_user_id != Auth::user()->id){
        $status = $request->status;
        if($status == "Resubmit"){
            DB::table( 'can_edit' )->where('id', $request->applied_serviceid)->update( [
                'remarks'  => $request->remarks,
                'status'  => $status,
            ] );
        }elseif($status == "Processing"){

                DB::table( 'can_edit' )->where( 'id', $request->applied_serviceid )->update( [
                    'status' => $status,
                    'application_no' => $request->application_no,
                    'selects' => $request->selects,
                ] );
            }elseif($status == "Approved"){

                DB::table( 'can_edit' )->where( 'id', $request->applied_serviceid )->update( [
                    'status' => $status,
                    'application' => $request->application,
                ] );
            }elseif($status == "Rejected"){
                $serviceid = $request->serviceid;
                $getservice_payment = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
                $getusers = DB::table( 'users' )->where('id',$apply_user_id)->first();
                $usertype = 0;
                if($getusers){
                    $usertype = $getusers->user_type_id;
                }
                $payment = 0;
                if($getservice_payment){
                    if($usertype == 3){
                      $payment = $getservice_payment->distributor_amount;
                  }elseif($usertype == 4){
                      $payment = $getservice_payment->retailer_amount;
                  }elseif($usertype == 5){
                      $payment = $getservice_payment->customer_amount;
                  }
              }

              $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
              $servicename = "";
              if($getservicename){
                $servicename = $getservicename->service_name;
            }
            $date = date( 'Y-m-d' );
            $time = date( 'H:i:s' );
            $service_status = 'Out Payment';
            $ad_info = "Service Refund For". ' ' .$servicename;

            $getwallet = DB::table( 'users' )->select('wallet')->where('id',2)->first();
            $balance = 0;
            if($getwallet){
                $balance = $getwallet->wallet;
            }
            $getuserswallet = DB::table( 'users' )->select('wallet')->where('id',$apply_user_id)->first();
            $balance1 = 0;
            if($getuserswallet){
                $balance1 = $getuserswallet->wallet;
            }
            $newbalance = $balance - $payment;
            $newbalance1 = $balance1 + $payment;

            $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$apply_user_id','2','$apply_user_id','$payment','$ad_info', '$service_status','$time','$date','$apply_user_id','$newbalance')";
            DB::insert( DB::raw( $sql ) );
            $sql = "update users set wallet = wallet - $payment where id = 2";
            DB::update( DB::raw( $sql ) );
            $service_status = 'IN Payment';
            $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$apply_user_id','$apply_user_id','2','$payment','$ad_info', '$service_status','$time','$date','$apply_user_id','$newbalance1')";
            DB::insert( DB::raw( $sql ) );
            $sql = "update users set wallet = wallet + $payment where id = $apply_user_id";
            DB::update( DB::raw( $sql ) );

            DB::table( 'can_edit' )->where( 'id', $request->applied_serviceid )->update( [
                'status' => $status,
                'remarks'  => $request->remarks,

            ] );

    }
    }else{
        $status = "Pending";
        $serviceid = $request->serviceid;
        if($serviceid == 60 || $serviceid == 121){
            if ($request->aadhaar_card != null) {
                $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
                DB::table( 'can_edit' )->where( 'id', $request->applied_serviceid )->update( [
                    'aadhaar_card'         => $aadhaar_card,
                ] );
            }

            if ($request->smart_card != null) {
                $smart_card = uniqid().'.'.$request->file('smart_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smart_card);
                DB::table( 'can_edit' )->where( 'id', $request->applied_serviceid )->update( [
                    'smart_card'             => $smart_card,
                ] );
            }

            DB::table('can_edit')->where('id', $request->applied_serviceid)->update([
                'service_id'                 => $request ->serviceid,
                'dist_id'                    => $request->dist_id,
                'taluk_id'                   => $request->taluk_id,
                'panchayath_id'              => $request->panchayath_id,
                'amount'                     => $request->amount,
                'mobile'                     => $request->mobile,
                'personalized_name_english'  => $request->personalized_name_english,
                'personalized'               => $request->personalized,
                'personalized_name_tamil'    => $request->personalized_name_tamil,
                'relationship'               => $request->relationship,
                'relationship_name_tamil'    => $request->relationship_name_tamil,
                'relationship_name_english'  => $request->relationship_name_english,
                'dob'                        => $request->dob,
                'religion'                   => $request->religion,
                'education'                  => $request->education,
                'work'                       => $request->work,
                'door_no'                    => $request->door_no,
                'village_administrative_area'=> $request->village_administrative_area,
                'community'                  => $request->community,
                'caste'                      => $request->caste,
                'maritial_status'            => $request->maritial_status,
                'aadhaar_number'             => $request->aadhaar_number,
                'smartcard_number'           => $request->smartcard_number,
                'street_name_tamil'          => $request->street_name_tamil,
                'postal_name'                => $request->postal_name,
                'street_name'                => $request->street_name,
                'pin_code'                   => $request->pin_code,
                'status'                     => 'Pending',
                'applied_date'               => date("Y-m-d"),
                'created_at'                 => date("Y-m-d"),
            ]);

    $getpermission = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
    $coordinator_permission = 0;
    if($getpermission){
        $coordinator_permission = $getpermission->coordinator_permission;
    }
    //echo$coordinator_permission;die;
    if($coordinator_permission == 1){
     $getdata = DB::table( 'can_edit' )->where('id',$request->applied_serviceid)->first();
     if($getdata){
     $aadhaar_card = $getdata->aadhaar_card;
     $service_id = $getdata->service_id;
     $rowid = $getdata->id;
     $status = $getdata->status;
     $can_number = $getdata->can_number;
     $aadhaar_number = $getdata->aadhaar_number;
     $url = url('/');
     $aadhaar_url = $url.'/upload/services/aadhaar_card/'.$aadhaar_card;
     $API_KEY = env( 'API_KEY', '' );
     $RAMJIPAY_URL = env( 'RAMJIPAY_URL', '' );
     $WEBSITE_INDEX = env( 'WEBSITE_INDEX', '' );

     $ch = curl_init();
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=$service_id&rowid=$rowid&status=$status&can_number=$can_number&aadhaar_number=$aadhaar_number";
        //dd($post_data);
        $url1 = $RAMJIPAY_URL.'/api/update_cannumber_api';
        //echo $url1;die;

        curl_setopt( $ch, CURLOPT_URL, $url1 );
        curl_setopt( $ch, CURLOPT_POST, 1 );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_data );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $server_output = curl_exec( $ch );
        curl_close( $ch );
        $resdata = json_decode($server_output, true);
       //dd($resdata);
    }
}

          }elseif($serviceid == 62){

                if ($request->aadhaar_card != null) {
                    $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
                    $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'aadhaar_card' . DIRECTORY_SEPARATOR);
                    move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
                    DB::table( 'can_edit' )->where( 'id', $request->applied_serviceid )->update( [
                        'aadhaar_card'         => $aadhaar_card,
                    ] );
                }

                DB::table('can_edit')->where('id', $request->applied_serviceid)->update([

                    'service_id'                 => $request ->serviceid,
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

    $getpermission = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
    $coordinator_permission = 0;
    if($getpermission){
        $coordinator_permission = $getpermission->coordinator_permission;
    }
    //echo$coordinator_permission;die;
    if($coordinator_permission == 1){
     $getdata = DB::table( 'can_edit' )->where('id',$request->applied_serviceid)->first();
     if($getdata){
     $aadhaar_card = $getdata->aadhaar_card;
     $service_id = $getdata->service_id;
     $rowid = $getdata->id;
     $status = $getdata->status;
     $can_number = $getdata->can_number;
     $select_name = $getdata->select_name;
     $name_tamil = $getdata->name_tamil;
     $name_english = $getdata->name_english;
     $dist_id = $getdata->dist_id;
     $url = url('/');
     $aadhaar_url = $url.'/upload/services/aadhaar_card/'.$aadhaar_card;
     $API_KEY = env( 'API_KEY', '' );
     $RAMJIPAY_URL = env( 'RAMJIPAY_URL', '' );
     $WEBSITE_INDEX = env( 'WEBSITE_INDEX', '' );

     $ch = curl_init();
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=$service_id&rowid=$rowid&status=$status&can_number=$can_number&select_name=$select_name&dist_id=$dist_id&name_tamil=$name_tamil&name_english=$name_english";
            //dd($post_data);
        $url1 = $RAMJIPAY_URL.'/api/update_cannumber_api';
        //echo $url1;die;

        curl_setopt( $ch, CURLOPT_URL, $url1 );
        curl_setopt( $ch, CURLOPT_POST, 1 );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_data );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $server_output = curl_exec( $ch );
        curl_close( $ch );
        $resdata = json_decode($server_output, true);
       //dd($resdata);
    }
}
        } elseif($serviceid == 63){

                if ($request->aadhaar_card != null) {
                    $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
                    $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'aadhaar_card' . DIRECTORY_SEPARATOR);
                    move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
                    DB::table( 'can_edit' )->where( 'id', $request->applied_serviceid )->update( [
                        'aadhaar_card'         => $aadhaar_card,
                    ] );
                }

                DB::table('can_edit')->where('id', $request->applied_serviceid)->update([

                    'service_id'                 => $request ->serviceid,
                    'amount'                     => $request->amount,
                    'can_number'                 => $request->can_number,
                    'original_dob'               => $request->original_dob,
                    'dist_id'                    => $request->dist_id,
                    'status'                     => 'Pending',
                    'applied_date'               => date("Y-m-d"),
                    'created_at'                 => date("Y-m-d"),
                ]);

    $getpermission = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
    $coordinator_permission = 0;
    if($getpermission){
        $coordinator_permission = $getpermission->coordinator_permission;
    }
    //echo$coordinator_permission;die;
    if($coordinator_permission == 1){
     $getdata = DB::table( 'can_edit' )->where('id',$request->applied_serviceid)->first();
     if($getdata){
     $aadhaar_card = $getdata->aadhaar_card;
     $service_id = $getdata->service_id;
     $rowid = $getdata->id;
     $status = $getdata->status;
     $can_number = $getdata->can_number;
     $dob1 = $getdata->original_dob;
     $dist_id = $getdata->dist_id;
     $url = url('/');
     $aadhaar_url = $url.'/upload/services/aadhaar_card/'.$aadhaar_card;
     $API_KEY = env( 'API_KEY', '' );
     $RAMJIPAY_URL = env( 'RAMJIPAY_URL', '' );
     $WEBSITE_INDEX = env( 'WEBSITE_INDEX', '' );

     $ch = curl_init();
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=$service_id&rowid=$rowid&status=$status&can_number=$can_number&dob=$dob1&dist_id=$dist_id";
        //dd($post_data);
        $url1 = $RAMJIPAY_URL.'/api/update_cannumber_api';
        //echo $url1;die;

        curl_setopt( $ch, CURLOPT_URL, $url1 );
        curl_setopt( $ch, CURLOPT_POST, 1 );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_data );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $server_output = curl_exec( $ch );
        curl_close( $ch );
        $resdata = json_decode($server_output, true);
       //dd($resdata);
    }
}

       } elseif($serviceid == 64){

                if ($request->aadhaar_card != null) {
                    $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
                    $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'aadhaar_card' . DIRECTORY_SEPARATOR);
                    move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
                    DB::table( 'can_edit' )->where( 'id', $request->applied_serviceid )->update( [
                        'aadhaar_card'         => $aadhaar_card,
                    ] );
                }

                DB::table('can_edit')->where('id', $request->applied_serviceid)->update([

                    'service_id'                 => $request ->serviceid,
                    'amount'                     => $request->amount,
                    'can_number'                 => $request->can_number,
                    'new_mobile_no'              => $request->new_mobile_no,
                    'status'                     => 'Pending',
                    'applied_date'               => date("Y-m-d"),
                    'created_at'                 => date("Y-m-d"),
                ]);

    $getpermission = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
    $coordinator_permission = 0;
    if($getpermission){
        $coordinator_permission = $getpermission->coordinator_permission;
    }
    //echo$coordinator_permission;die;
    if($coordinator_permission == 1){
     $getdata = DB::table( 'can_edit' )->where('id',$request->applied_serviceid)->first();
     if($getdata){
     $aadhaar_card = $getdata->aadhaar_card;
     $service_id = $getdata->service_id;
     $rowid = $getdata->id;
     $status = $getdata->status;
     $can_number = $getdata->can_number;
     $mobile1 = $getdata->new_mobile_no;
     $url = url('/');
     $aadhaar_url = $url.'/upload/services/aadhaar_card/'.$aadhaar_card;
     $API_KEY = env( 'API_KEY', '' );
     $RAMJIPAY_URL = env( 'RAMJIPAY_URL', '' );
     $WEBSITE_INDEX = env( 'WEBSITE_INDEX', '' );

     $ch = curl_init();
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=$service_id&rowid=$rowid&status=$status&can_number=$can_number&mobile=$mobile1";
        //dd($post_data);
        $url1 = $RAMJIPAY_URL.'/api/update_cannumber_api';
        //echo $url1;die;

        curl_setopt( $ch, CURLOPT_URL, $url1 );
        curl_setopt( $ch, CURLOPT_POST, 1 );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_data );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $server_output = curl_exec( $ch );
        curl_close( $ch );
        $resdata = json_decode($server_output, true);
       //dd($resdata);
    }
}
        } elseif($serviceid == 66){

                if ($request->aadhaar_card != null) {
                    $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
                    $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'aadhaar_card' . DIRECTORY_SEPARATOR);
                    move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
                    DB::table( 'can_edit' )->where( 'id', $request->applied_serviceid )->update( [
                        'aadhaar_card'         => $aadhaar_card,
                    ] );
                }

                DB::table('can_edit')->where('id', $request->applied_serviceid)->update([
                    'service_id'                 => $request ->serviceid,
                    'amount'                     => $request->amount,
                    'can_number'                 => $request->can_number,
                    'aadhaar_number'             => $request->aadhaar_number,
                    'status'                     => 'Pending',
                    'applied_date'               => date("Y-m-d"),
                    'created_at'                 => date("Y-m-d"),
                ]);

    $getpermission = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
    $coordinator_permission = 0;
    if($getpermission){
        $coordinator_permission = $getpermission->coordinator_permission;
    }
    //echo$coordinator_permission;die;
    if($coordinator_permission == 1){
     $getdata = DB::table( 'can_edit' )->where('id',$request->applied_serviceid)->first();
     if($getdata){
     $service_id = $getdata->service_id;
     $rowid = $getdata->id;
     $status = $getdata->status;
     $can_number = $getdata->can_number;
     $aadhaar_number = $getdata->aadhaar_number;
     $API_KEY = env( 'API_KEY', '' );
     $RAMJIPAY_URL = env( 'RAMJIPAY_URL', '' );
     $WEBSITE_INDEX = env( 'WEBSITE_INDEX', '' );

     $ch = curl_init();
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&service_id=$service_id&rowid=$rowid&status=$status&can_number=$can_number&aadhaar_number=$aadhaar_number";
        //dd($post_data);
        $url1 = $RAMJIPAY_URL.'/api/update_cannumber_api';
        //echo $url1;die;

        curl_setopt( $ch, CURLOPT_URL, $url1 );
        curl_setopt( $ch, CURLOPT_POST, 1 );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_data );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $server_output = curl_exec( $ch );
        curl_close( $ch );
        $resdata = json_decode($server_output, true);
       //dd($resdata);
    }
}

        }   elseif($serviceid == 208 || $serviceid == 209 || $serviceid == 210 || $serviceid == 211 || $serviceid == 233 || $serviceid == 234){

                 if ($request->aadhaar_card != null) {
                $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
                DB::table( 'can_edit' )->where( 'id', $request->applied_serviceid )->update( [
                    'aadhaar_card'         => $aadhaar_card,
                ] );
            }

            DB::table('can_edit')->where('id', $request->applied_serviceid)->update([

                'service_id'                 => $request ->serviceid,
                'amount'                     => $request->amount,
                'can_number'                 => $request->can_number,
                'select_name'                => $request->select_name,
                'mobile'                     => $request->mobile,
                'dob'                        => $request->dob,
                'name_tamil'                 => $request->name_tamil,
                'name_english'               => $request->name_english,
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

    $getpermission = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
    $coordinator_permission = 0;
    if($getpermission){
        $coordinator_permission = $getpermission->coordinator_permission;
    }
    //echo$coordinator_permission;die;
    if($coordinator_permission == 1){
     $getdata = DB::table( 'can_edit' )->where('id',$request->applied_serviceid)->first();
     if($getdata){
     $aadhaar_card = $getdata->aadhaar_card;
     $service_id = $getdata->service_id;
     $rowid = $getdata->id;
     $status = $getdata->status;
     $can_number = $getdata->can_number;
     $select_name = $getdata->select_name;
     $name_tamil = $getdata->name_tamil;
     $name_english = $getdata->name_english;
     $mobile = $getdata->mobile;
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
     $url = url('/');
     $aadhaar_url = $url.'/upload/services/aadhaar_card/'.$aadhaar_card;
     $API_KEY = env( 'API_KEY', '' );
     $RAMJIPAY_URL = env( 'RAMJIPAY_URL', '' );
     $WEBSITE_INDEX = env( 'WEBSITE_INDEX', '' );

     $ch = curl_init();

    if($serviceid == 233){
    $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=241&rowid=$rowid&status=$status&can_number=$can_number&dist_id=$dist_id&father_name=$father_name&father_name_english=$father_name_english";
    }elseif($serviceid == 234){
    $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=242&rowid=$rowid&status=$status&can_number=$can_number&dist_id=$dist_id&taluk_id=$taluk_id&revenue_village=$revenue_village&door_no=$door_no&street_name=$street_name&pin_code=$pin_code&street_name_tamil=$street_name_tamil&postal_area_tamil=$postal_area_tamil&postal_area_english=$postal_area_english";
    }else{
    $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=$service_id&rowid=$rowid&status=$status&can_number=$can_number&select_name=$select_name&name_tamil=$name_tamil&name_english=$name_english&mobile=$mobile&dob=$dob&revenue_village=$revenue_village&door_no=$door_no&street_name=$street_name&postal_area_english=$postal_area_english&dist_id=$dist_id&taluk_id=$taluk_id&pin_code=$pin_code&street_name_tamil=$street_name_tamil&postal_area_tamil=$postal_area_tamil&father_name=$father_name&father_name_english=$father_name_english";
    }
        //dd($post_data);
        $url1 = $RAMJIPAY_URL.'/api/update_cannumber_api';
        //echo $url1;die;

        curl_setopt( $ch, CURLOPT_URL, $url1 );
        curl_setopt( $ch, CURLOPT_POST, 1 );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_data );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $server_output = curl_exec( $ch );
        curl_close( $ch );
        $resdata = json_decode($server_output, true);
       //dd($resdata);
    }
}
    }

    DB::table( 'can_edit' )->where( 'id', $request->applied_serviceid )->update( [
        'status' => $status,
    ] );

}
    return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}

public function cancertificate_find_update(Request $request){
    $apply_user_id = 0;
        if ($request->distributor_id == 0 && $request->retailer_id == 0) {
            $apply_user_id = $request->user_id;
        }
        elseif($request->retailer_id == 0){
            $apply_user_id = $request->distributor_id;
        }elseif($request->distributor_id == 0){
            $apply_user_id = $request->retailer_id;
        }
        //echo Auth::user()->id;die;
        if($apply_user_id != Auth::user()->id){
            $status = $request->status;
        if($status == "Resubmit"){
            DB::table( 'can_edit' )->where('id', $request->applied_serviceid)->update( [
                'remarks'  => $request->remarks,
                'status'  => $status,
            ] );
        }elseif($status == "Processing"){
                if ( $request->acknowledgement != null ) {
                    $acknowledgement = uniqid().'.'.$request->file( 'acknowledgement' )->extension();
                    $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'acknowledgement' . DIRECTORY_SEPARATOR);
                    move_uploaded_file( $_FILES[ 'acknowledgement' ][ 'tmp_name' ], $filepath . $acknowledgement );
                    DB::table( 'can_edit' )->where( 'id', $request->applied_serviceid )->update( [
                        'acknowledgement' => $acknowledgement,
                    ] );
                }
                DB::table( 'can_edit' )->where( 'id', $request->applied_serviceid )->update( [
                    'status' => $status,
                    'application_no' => $request->application_no,
                    'selects' => $request->selects,
                ] );
            }elseif($status == "Approved"){
                if ( $request->certificate != null ) {
                    $certificate = uniqid().'.'.$request->file( 'certificate' )->extension();
                    $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'certificate'. DIRECTORY_SEPARATOR);
                    move_uploaded_file( $_FILES[ 'certificate' ][ 'tmp_name' ], $filepath . $certificate );
                    DB::table( 'can_edit' )->where( 'id', $request->applied_serviceid )->update( [
                        'certificate' => $certificate,
                        'status' => $status,
                        'completed_date' => date("Y-m-d"),
                    ] );
                }
                DB::table( 'can_edit' )->where( 'id', $request->applied_serviceid )->update( [
                    'status' => $status,
                    'application' => $request->application,
                    'lects' => $request->lects,
                ] );
            }elseif($status == "Rejected"){
                $serviceid = $request->serviceid;
                $getservice_payment = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
                $getusers = DB::table( 'users' )->where('id',$apply_user_id)->first();
                $usertype = 0;
                if($getusers){
                    $usertype = $getusers->user_type_id;
                }
                $payment = 0;
                if($getservice_payment){
                    if($usertype == 3){
                      $payment = $getservice_payment->distributor_amount;
                  }elseif($usertype == 4){
                      $payment = $getservice_payment->retailer_amount;
                  }elseif($usertype == 5){
                      $payment = $getservice_payment->customer_amount;
                  }
              }

              $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
              $servicename = "";
              if($getservicename){
                $servicename = $getservicename->service_name;
            }
            $date = date( 'Y-m-d' );
            $time = date( 'H:i:s' );
            $service_status = 'Out Payment';
            $ad_info = "Service Refund For". ' ' .$servicename;

            $getwallet = DB::table( 'users' )->select('wallet')->where('id',2)->first();
            $balance = 0;
            if($getwallet){
                $balance = $getwallet->wallet;
            }
            $getuserswallet = DB::table( 'users' )->select('wallet')->where('id',$apply_user_id)->first();
            $balance1 = 0;
            if($getuserswallet){
                $balance1 = $getuserswallet->wallet;
            }
            $newbalance = $balance - $payment;
            $newbalance1 = $balance1 + $payment;

            $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$apply_user_id','2','$apply_user_id','$payment','$ad_info', '$service_status','$time','$date','$apply_user_id','$newbalance')";
            DB::insert( DB::raw( $sql ) );
            $sql = "update users set wallet = wallet - $payment where id = 2";
            DB::update( DB::raw( $sql ) );
            $service_status = 'IN Payment';
            $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$apply_user_id','$apply_user_id','2','$payment','$ad_info', '$service_status','$time','$date','$apply_user_id','$newbalance1')";
            DB::insert( DB::raw( $sql ) );
            $sql = "update users set wallet = wallet + $payment where id = $apply_user_id";
            DB::update( DB::raw( $sql ) );

            DB::table( 'can_edit' )->where( 'id', $request->applied_serviceid )->update( [
                'status' => $status,
                'remarks'  => $request->remarks,
            ] );

        }
        }else{
            $status = "Pending";
            $serviceid = $request->serviceid;
            if($serviceid == 65 || $serviceid == 67 || $serviceid == 225 || $serviceid == 226 ){

                if ($request->aadhaar_card != null) {
                    $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
                    $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'aadhaar_card' . DIRECTORY_SEPARATOR);
                    move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
                    DB::table( 'can_edit' )->where( 'id', $request->applied_serviceid )->update( [
                        'aadhaar_card'         => $aadhaar_card,
                    ] );
                }

            DB::table('can_edit')->where('id', $request->applied_serviceid)->update([
                'service_id'             => $request ->serviceid,
                'amount'                 => $request->amount,
                'can_number'             => $request->can_number,
                'certificate_name'       => $request->certificate_name,
                'certificate_number'     => $request->certificate_number,
                'aadhaar_number'         => $request->aadhaar_number,
                'applicant_name'         => $request->applicant_name,
                'status'                 => 'Pending',
                'applied_date'           => date("Y-m-d"),
                'created_at'             => date("Y-m-d"),
            ]);


   $getpermission = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
    $coordinator_permission = 0;
    if($getpermission){
        $coordinator_permission = $getpermission->coordinator_permission;
    }
    //echo$coordinator_permission;die;
    if($coordinator_permission == 1){
     $getdata = DB::table( 'can_edit' )->where('id',$request->applied_serviceid)->first();
     if($getdata){
     $aadhaar_card = $getdata->aadhaar_card;
     $service_id = $getdata->service_id;
     $rowid = $getdata->id;
     $status = $getdata->status;
     $can_number = $getdata->can_number;
     $certificate_name = $getdata->certificate_name;
     $certificate_number = $getdata->certificate_number;
     $aadhaar_number = $getdata->aadhaar_number;
     $applicant_name = $getdata->applicant_name;
     $url = url('/');
     $aadhaar_url = $url.'/upload/services/aadhaar_card/'.$aadhaar_card;
     $API_KEY = env( 'API_KEY', '' );
     $RAMJIPAY_URL = env( 'RAMJIPAY_URL', '' );
     $WEBSITE_INDEX = env( 'WEBSITE_INDEX', '' );

     $ch = curl_init();
     if($serviceid == 225){
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=226&rowid=$rowid&status=$status&can_number=$can_number&certificate_number=$certificate_number&certificate_name=$certificate_name&applicant_name=$applicant_name";
     }elseif($serviceid == 226){
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=227&rowid=$rowid&status=$status&can_number=$can_number&certificate_number=$certificate_number&certificate_name=$certificate_name&applicant_name=$applicant_name";
     }else{
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=$service_id&rowid=$rowid&status=$status&can_number=$can_number&certificate_name=$certificate_name&certificate_number=$certificate_number&applicant_name=$applicant_name&aadhaar_number=$aadhaar_number";
    }
        //dd($post_data);
        $url1 = $RAMJIPAY_URL.'/api/update_cannumber_api';
        //echo $url1;die;

        curl_setopt( $ch, CURLOPT_URL, $url1 );
        curl_setopt( $ch, CURLOPT_POST, 1 );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_data );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $server_output = curl_exec( $ch );
        curl_close( $ch );
        $resdata = json_decode($server_output, true);
       //dd($resdata);
    }
}
    }
    DB::table( 'can_edit' )->where( 'id', $request->applied_serviceid )->update( [
        'status' => $status,
    ] );

}
    return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}

public function smartcard_update1(Request $request){
    $apply_user_id = 0;
    if($request->retailer_id == 0){
        $apply_user_id = $request->distributor_id;
    }elseif($request->distributor_id == 0){
        $apply_user_id = $request->retailer_id;
    }
    if($request->distributor_id != Auth::user()->id && $request->retailer_id != Auth::user()->id){
        $status = $request->status;
        if($status == "Resubmit"){
            DB::table( 'smartcard' )->where('id', $request->applied_serviceid)->update( [
                'remarks' => $request->remarks,
                'status'  => $status,
            ] );
        }elseif($status == "Processing"){
            if ( $request->acknowledgement != null ) {
                $acknowledgement = uniqid().'.'.$request->file( 'acknowledgement' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'acknowledgement' . DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'acknowledgement' ][ 'tmp_name' ], $filepath . $acknowledgement );
                DB::table( 'smartcard' )->where( 'id', $request->applied_serviceid )->update( [
                    'acknowledgement' => $acknowledgement,
                    'status' => $status,
                    'application_no' => $request->application_no,
                ] );
            }
        }elseif($status == "Approved"){
            if ( $request->certificate != null ) {
                $certificate = uniqid().'.'.$request->file( 'certificate' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'certificate'. DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'certificate' ][ 'tmp_name' ], $filepath . $certificate );
                DB::table( 'smartcard' )->where( 'id', $request->applied_serviceid )->update( [
                    'certificate' => $certificate,
                    'status' => $status,
                    'completed_date' => date("Y-m-d"),
                ] );
            }
        }
    }else{
        $status = "Pending";
        $serviceid = $request->serviceid;
        if( $serviceid == 77 ) {
            DB::table('smartcard')->where('id', $request->applied_serviceid)->update([
                'service_id'                => $request ->serviceid,
                'name'                      => $request->name,
                'status'                    => 'Pending',
                'applied_date'              => date("Y-m-d"),
                'created_at'                => date("Y-m-d"),
            ] );

            if ($request->aadhaar_card != null) {
                $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
                DB::table( 'smartcard' )->where( 'id', $request->applied_serviceid )->update( [
                    'aadhaar_card'         => $aadhaar_card,
                ] );
            }

        }elseif( $serviceid == 78 ){
            DB::table('smartcard')->where('id', $request->applied_serviceid)->update([
                'service_id'                => $request ->serviceid,
                'status'                    => 'Pending',
                'applied_date'              => date("Y-m-d"),
                'created_at'                => date("Y-m-d"),
            ] );

            if ($request->aadhaar_card != null) {
                $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'aadhaar_card' => $aadhaar_card,
                ]);
            }
            if ($request->smart_card != null) {
                $smart_card = uniqid().'.'.$request->file('smart_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smart_card);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'smart_card' => $smart_card,
                ]);
            }
        }elseif( $serviceid == 79 ){
            DB::table( 'smartcard' )->where('id', $request->applied_serviceid)->update([
                'service_id'                => $request ->serviceid,
                'name'                      => $request->name,
                'mobile'                    => $request->mobile,
                'status'                    => 'Pending',
                'applied_date'              => date("Y-m-d"),
                'created_at'                => date("Y-m-d"),
            ] );

            if ($request->aadhaar_card != null) {
                $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'aadhaar_card' => $aadhaar_card,
                ]);
            }
            if ($request->applicant_reciept != null) {
                $applicant_reciept = uniqid().'.'.$request->file('applicant_reciept')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'applicantreciept' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['applicant_reciept']['tmp_name'], $filepath . $applicant_reciept);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'applicant_reciept' => $applicant_reciept,
                ]);
            }
            if ($request->photo != null) {
                $photo = uniqid().'.'.$request->file('photo')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'photo' => $photo,
                ]);
            }
        }elseif( $serviceid == 80 ){
            DB::table( 'smartcard' )->where('id', $request->applied_serviceid)->update([
                'service_id'                => $request ->serviceid,
                'name'                      => $request->name,
                'mobile'                    => $request->mobile,
                'smart_mobile'              => $request->smart_mobile,
                'status'                    => 'Pending',
                'applied_date'              => date("Y-m-d"),
                'created_at'                => date("Y-m-d"),
            ] );
        }elseif( $serviceid == 81 ){
            DB::table( 'smartcard' )->where('id', $request->applied_serviceid)->update([
                'service_id'                => $request ->serviceid,
                'name'                      => $request->name,
                'change_cardtype'           => $request->change_cardtype,
                'status'                    => 'Pending',
                'applied_date'              => date("Y-m-d"),
                'created_at'                => date("Y-m-d"),
            ] );
            if ($request->photo != null) {
                $photo = uniqid().'.'.$request->file('photo')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'photo' => $photo,
                ]);
            }
            if ($request->smartcard_online != null) {
                $smartcard_online = uniqid().'.'.$request->file('smartcard_online')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'onlineprint' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['smartcard_online']['tmp_name'], $filepath . $smartcard_online);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'smartcard_online' => $smartcard_online,
                ]);
            }
        }elseif( $serviceid == 82 ){
            DB::table( 'smartcard' )->where('id', $request->applied_serviceid)->update([
                'service_id'                => $request ->serviceid,
                'name'                      => $request->name,
                'mobile'                    => $request->mobile,
                'status'                    => 'Pending',
                'applied_date'              => date("Y-m-d"),
                'created_at'                => date("Y-m-d"),
            ] );
            if ($request->aadhaar_card != null) {
                $aadhaarimg = uniqid().'.'.$request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'aadhaar_card' => $aadhaarimg,
                ]);
            }
            if ($request->smart_card != null) {
                $smart_card = uniqid().'.'.$request->file('smart_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smart_card);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'smart_card' => $smart_card,
                ]);
            }
        }elseif( $serviceid == 83 ){
            DB::table( 'smartcard' )->where( 'id', $request->applied_serviceid )->update( [
                'service_id'                => $request ->serviceid,
                'name'                      => $request->name,
                'mobile'                    => $request->mobile,
                'status'                    => 'Pending',
                'applied_date'              => date("Y-m-d"),
                'created_at'                => date("Y-m-d"),
            ] );
            if ($request->aadhaar_card != null) {
                $aadhaarimg = uniqid().'.'.$request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'aadhaar_card' => $aadhaarimg,
                ]);
            }
        }
        DB::table( 'smartcard' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
        ] );
    }

    return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}
public function voterid_update(Request $request){
    $apply_user_id = 0;
    if($request->retailer_id == 0){
        $apply_user_id = $request->distributor_id;
    }elseif($request->distributor_id == 0){
        $apply_user_id = $request->retailer_id;
    }
    if($request->distributor_id != Auth::user()->id && $request->retailer_id != Auth::user()->id){
        $status = $request->status;
        if($status == "Resubmit"){
            DB::table( 'voterid' )->where('id', $request->applied_serviceid)->update( [
                'remarks' => $request->remarks,
                'status'  => $status,
            ] );
        }elseif($status == "Processing"){
            if ( $request->acknowledgement != null ) {
                $acknowledgement = uniqid().'.'.$request->file( 'acknowledgement' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'acknowledgement' . DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'acknowledgement' ][ 'tmp_name' ], $filepath . $acknowledgement );
                DB::table( 'voterid' )->where( 'id', $request->applied_serviceid )->update( [
                    'acknowledgement' => $acknowledgement,
                    'status' => $status,
                    'application_no' => $request->application_no,
                ] );
            }
        }elseif($status == "Approved"){
            if ( $request->certificate != null ) {
                $certificate = uniqid().'.'.$request->file( 'certificate' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'certificate'. DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'certificate' ][ 'tmp_name' ], $filepath . $certificate );
                DB::table( 'voterid' )->where( 'id', $request->applied_serviceid )->update( [
                    'certificate' => $certificate,
                    'status' => $status,
                    'completed_date' => date("Y-m-d"),
                ] );
            }
        }
    }else{
        $status = "Pending";
        $serviceid = $request->serviceid;
        if($serviceid == 113 || $serviceid == 120 || $serviceid == 164 || $serviceid == 181 || $service_id == 182){
            DB::table('voterid')->where('id', $request->applied_serviceid)->update([
                'service_id'        => $request ->serviceid,
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
        'father_name_tamil'           => $request->father_name_tamil,
        'father_name_english'         => $request->father_name_english,
        'husband_name_tamil'          => $request->husband_name_tamil,
        'husband_name_english'        => $request->husband_name_english,
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
        'other_percentage'            => $request->dumb_percentage,
        'description'                 => $request->description,
        'correction'                  =>is_array($request->correction)
                                      ? implode(',', $request->correction)
                                      : $request->correction,
        'gender'                      => $request->gender,
        'dob'                         => $request->dob,
        'relation'                    => $request->relation,
        'name_tamil'                    => $request->name_tamil,
        'name_english'                    => $request->name_english,
        'status'                      => 'Pending',
        'applied_date'                => date("Y-m-d"),
        'created_at'                  => date("Y-m-d"),
    ] );

    if ($request->photo != null) {
        $photo = uniqid().'.'.$request->file('photo')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);
        DB::table('voterid')->where( 'id', $request->applied_serviceid )->update( [
            'photo' => $photo,
        ]);
    }
    if ($request->aadhaar_card != null) {
        $aadhaarimg = uniqid().'.'.$request->file('aadhaar_card')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);

        DB::table('voterid')->where( 'id', $request->applied_serviceid )->update( [
            'aadhaar_card' => $aadhaarimg,
        ]);
    }
    if ($request->voter_id != null) {
        $voter_id = uniqid().'.'.$request->file('voter_id')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'voter_id' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['voter_id']['tmp_name'], $filepath . $voter_id);

        DB::table('voterid')->where( 'id', $request->applied_serviceid )->update( [
            'voter_id' => $voter_id,
        ]);
    }
    if ($request->locomotive_certificate != null) {
        $locomotive_certificate = uniqid().'.'.$request->file('locomotive_certificate')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'locomotive_certificate' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['locomotive_certificate']['tmp_name'], $filepath . $locomotive_certificate);

        DB::table('voterid')->where( 'id', $request->applied_serviceid )->update( [
            'locomotive_certificate' => $locomotive_certificate,
        ]);
    }
    if ($request->visual_certificate != null) {
        $visual_certificate = uniqid().'.'.$request->file('visual_certificate')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'visual_certificate' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['visual_certificate']['tmp_name'], $filepath . $visual_certificate);

        DB::table('voterid')->where( 'id', $request->applied_serviceid )->update( [
            'votevisual_certificater_id' => $visual_certificate,
        ]);
    }
    if ($request->dumb_certificate != null) {
        $dumb_certificate = uniqid().'.'.$request->file('dumb_certificate')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'dumb_certificate' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['dumb_certificate']['tmp_name'], $filepath . $dumb_certificate);

        DB::table('voterid')->where( 'id', $request->applied_serviceid )->update( [
            'dumb_certificate' => $dumb_certificate,
        ]);
    }
    if ($request->other_certificate != null) {
        $other_certificate = uniqid().'.'.$request->file('other_certificate')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'other_certificate' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['other_certificate']['tmp_name'], $filepath . $other_certificate);

        DB::table('voterid')->where( 'id', $request->applied_serviceid )->update( [
            'other_certificate' => $other_certificate,
        ]);
    }
    if ($request->age_proof != null) {
        $age_proof = uniqid().'.'.$request->file('age_proof')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'age_proof' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['age_proof']['tmp_name'], $filepath . $age_proof);

        DB::table('voterid')->where( 'id', $request->applied_serviceid )->update( [
            'age_proof' => $age_proof,
        ]);
    }
    if ($request->document != null) {
        $document = uniqid().'.'.$request->file('document')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'document' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['document']['tmp_name'], $filepath . $document);

        DB::table('voterid')->where( 'id', $request->applied_serviceid )->update( [
            'document' => $document,
        ]);
    }
    if($serviceid == 181){
        DB::table('voterid_details')->where( 'service_id', $request->applied_serviceid )->delete();
        foreach ( $request->details_id as $key => $details_id ) {
          $new_data = $request->new_data[ $key ];
          $correction_documents = $request->correction_documents[ $key ];
          $voterid_correction = $request->voterid_correction[ $key ];

          DB::table('voterid_details')->where('id', $details_id)->update([
            'service_id'        => $request->applied_serviceid,
            'new_data'            => $new_data,
            'correction_documents'              => $correction_documents,
            'voterid_correction'            => $voterid_correction,
        ] );

          if (is_null($request->doc[$key])) {
              $doc = uniqid().'.'.$request->file('doc')[$key]->extension();
                //dd($request->doc[$key]);
              $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'doc' . DIRECTORY_SEPARATOR);
              move_uploaded_file($_FILES['doc']['tmp_name'][$key], $filepath . $doc);
              DB::table( 'voterid_details' )->where( 'id', $relation_id )->update( [
                'doc'       => $doc,
            ] );
          }

      }
  }
  DB::table( 'voterid' )->where( 'id', $request->applied_serviceid )->update( [
    'status' => $status,
] );
}
    }
    return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}
public function bond_update(Request $request){
    $apply_user_id = 0;
    if($request->retailer_id == 0){
        $apply_user_id = $request->distributor_id;
    }elseif($request->distributor_id == 0){
        $apply_user_id = $request->retailer_id;
    }
    if($request->distributor_id != Auth::user()->id && $request->retailer_id != Auth::user()->id){
        $status = $request->status;
        if($status == "Resubmit"){
            DB::table( 'bond' )->where('id', $request->applied_serviceid)->update( [
                'remarks' => $request->remarks,
                'status'  => $status,
            ] );
        }elseif($status == "Processing"){
            if ( $request->acknowledgement != null ) {
                $acknowledgement = uniqid().'.'.$request->file( 'acknowledgement' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'acknowledgement' . DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'acknowledgement' ][ 'tmp_name' ], $filepath . $acknowledgement );
                DB::table( 'bond' )->where( 'id', $request->applied_serviceid )->update( [
                    'acknowledgement' => $acknowledgement,
                    'status' => $status,
                    'application_no' => $request->application_no,
                ] );
            }
        }elseif($status == "Approved"){
            if ( $request->certificate != null ) {
                $certificate = uniqid().'.'.$request->file( 'certificate' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'certificate'. DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'certificate' ][ 'tmp_name' ], $filepath . $certificate );
                DB::table( 'bond' )->where( 'id', $request->applied_serviceid )->update( [
                    'certificate' => $certificate,
                    'status' => $status,
                    'completed_date' => date("Y-m-d"),
                ] );
            }
        }
    }else{
        $status = "Pending";
        $serviceid = $request->serviceid;
        DB::table('bond')->where('id', $request->applied_serviceid)->update([
            'service_id'                => $request ->serviceid,
            'name'                      => $request->name,
            'aadhaar_no'                => $request->aadhaar_no,
            'dist_id'                   => $request ->dist_id,
            'taluk_id'                  => $request ->taluk_id,
            'applicant_name'            => $request->applicant_name,
            'aadhaar_no'                => $request->aadhaar_no,
            'document_number'           => $request->document_number,
            'year'                      => $request->year,
            'status'                    => 'Pending',
            'applied_date'              => date("Y-m-d"),
            'created_at'                => date("Y-m-d"),
        ] );

        DB::table( 'bond' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
        ] );
    }

    return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}

public function fssaiservice_update(Request $request){
    $apply_user_id = 0;
    if($request->retailer_id == 0){
        $apply_user_id = $request->distributor_id;
    }elseif($request->distributor_id == 0){
        $apply_user_id = $request->retailer_id;
    }
    if($request->distributor_id != Auth::user()->id && $request->retailer_id != Auth::user()->id){
        $status = $request->status;
        if($status == "Resubmit"){
            DB::table( 'fssai' )->where('id', $request->applied_serviceid)->update( [
                'remarks' => $request->remarks,
                'status'  => $status,
            ] );
        }elseif($status == "Processing"){
            if ( $request->acknowledgement != null ) {
                $acknowledgement = uniqid().'.'.$request->file( 'acknowledgement' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'acknowledgement' . DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'acknowledgement' ][ 'tmp_name' ], $filepath . $acknowledgement );
                DB::table( 'fssai' )->where( 'id', $request->applied_serviceid )->update( [
                    'acknowledgement' => $acknowledgement,
                    'status' => $status,
                    'application_no' => $request->application_no,
                ] );
            }
        }elseif($status == "Approved"){
            if ( $request->certificate != null ) {
                $certificate = uniqid().'.'.$request->file( 'certificate' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'certificate'. DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'certificate' ][ 'tmp_name' ], $filepath . $certificate );
                DB::table( 'fssai' )->where( 'id', $request->applied_serviceid )->update( [
                    'certificate' => $certificate,
                    'status' => $status,
                    'completed_date' => date("Y-m-d"),
                ] );
            }
        }
    }else{
        $status = "Pending";
        $serviceid = $request->serviceid;
        if($serviceid == 122 || $serviceid == 123){

            DB::table('fssai')->where('id', $request->applied_serviceid)->update([
                'service_id'        => $request ->serviceid,
                'shop_name'         => $request->shop_name,
                'mobile'            => $request->mobile,
                'mobile_no'         => $request->mobile_no,
                'email_id'          => $request->email_id,
                'documents'         => $request->documents,
                'food_service'      => $request->food_service,
                'status'            => 'Pending',
                'applied_date'      => date("Y-m-d"),
                'created_at'        => date("Y-m-d"),
            ] );

            if ($request->photo != null) {
                $photo = uniqid().'.'.$request->file('photo')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);
                DB::table('fssai')->where( 'id', $request->applied_serviceid )->update( [
                    'photo' => $photo,
                ]);
            }
            if ($request->shop_photo != null) {
                $shop_photo = uniqid().'.'.$request->file('shop_photo')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'shop_photo' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['shop_photo']['tmp_name'], $filepath . $shop_photo);
                DB::table('fssai')->where( 'id', $request->applied_serviceid )->update( [
                    'shop_photo' => $shop_photo,
                ]);
            }
            if ($request->aadhaar_card != null) {
                $aadhaarimg = uniqid().'.'.$request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);

                DB::table('fssai')->where( 'id', $request->applied_serviceid )->update( [
                    'aadhaar_card' => $aadhaarimg,
                ]);
            }
            if ($request->pan_card != null) {
                $pan_card = uniqid().'.'.$request->file('pan_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'pan_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['pan_card']['tmp_name'], $filepath . $pan_card);

                DB::table('fssai')->where( 'id', $request->applied_serviceid )->update( [
                    'pan_card' => $pan_card,
                ]);
            }
            if ($request->old_food_license != null) {
                $old_food_license = uniqid().'.'.$request->file('old_food_license')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'old_food_license' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['old_food_license']['tmp_name'], $filepath . $old_food_license);

                DB::table('fssai')->where( 'id', $request->applied_serviceid )->update( [
                    'old_food_license' => $old_food_license,
                ]);
            }

            if ($request->rental_agreement != null) {
                $rental_agreement = uniqid().'.'.$request->file('rental_agreement')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'rental_agreement' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['rental_agreement']['tmp_name'], $filepath . $rental_agreement);

                DB::table('fssai')->where( 'id', $request->applied_serviceid )->update( [
                    'rental_agreement' => $rental_agreement,
                ]);
            }

            if ($request->electricity_bill != null) {
                $electricity_bill = uniqid().'.'.$request->file('electricity_bill')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'electricity_bill' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['electricity_bill']['tmp_name'], $filepath . $electricity_bill);

                DB::table('fssai')->where( 'id', $request->applied_serviceid )->update( [
                    'electricity_bill' => $electricity_bill,
                ]);
            }

            if ($request->property_tax != null) {
                $property_tax = uniqid().'.'.$request->file('property_tax')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'property_tax' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['property_tax']['tmp_name'], $filepath . $property_tax);

                DB::table('fssai')->where( 'id', $request->applied_serviceid )->update( [
                    'property_tax' => $property_tax,
                ]);
            }

    $getpermission = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
    $coordinator_permission = 0;
    if($getpermission){
        $coordinator_permission = $getpermission->coordinator_permission;
    }
    //echo$coordinator_permission;die;
    if($coordinator_permission == 1){
     $getdata = DB::table( 'fssai' )->where('id',$request->applied_serviceid)->first();
     if($getdata){
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
     $email_id = $getdata->email_id;
     $mobile = $getdata->mobile;
     $mobile_no = $getdata->mobile_no;
     $documents = $getdata->documents;
     $status = $getdata->status;
     $url = url('/');
     $aadhaar_url = $url.'/upload/services/aadhaar_card/'.$aadhaar_card;
     $photo_url = $url.'/upload/services/photo/'.$photo;
     $shopphoto_url = $url.'/upload/services/shop_photo/'.$shop_photo;
     $pancard_url = $url.'/upload/services/pan_card/'.$pan_card;
     $rentalagreement_url = $url.'/upload/services/rental_agreement/'.$rental_agreement;
     $electricitybill_url = $url.'/upload/services/electricity_bill/'.$electricity_bill;
     $propertytax_url = $url.'/upload/services/property_tax/'.$property_tax;
     $oldfoodlicense_url = $url.'/upload/services/old_food_license/'.$old_food_license;
     $API_KEY = env( 'API_KEY', '' );
     $RAMJIPAY_URL = env( 'RAMJIPAY_URL', '' );
     $WEBSITE_INDEX = env( 'WEBSITE_INDEX', '' );

     $ch = curl_init();

    if($serviceid == 122){
    $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&photo_file=$photo_url&photo_file=$photo_url&aadhaar_file=$aadhaar_url&shop_photo_file=$shopphoto_url&pan_card_file=$pancard_url&rental_agreement_file=$rentalagreement_url&electricity_bill_file=$electricitybill_url&property_tax_file=$propertytax_url&service_id=$service_id&rowid=$rowid&status=$status&food_service=$food_service&shop_name=$shop_name&email_id=$email_id&mobile=$mobile&mobile_no=$mobile_no&documents=$documents";
    }elseif($serviceid == 123){
    $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&old_food_license_file=$oldfoodlicense_url&photo_file=$photo_url&aadhaar_file=$aadhaar_url&shop_photo_file=$shopphoto_url&pan_card_file=$pancard_url&service_id=$service_id&rowid=$rowid&status=$status&shop_name=$shop_name&email_id=$email_id&mobile=$mobile";
    }else{
    $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&photo_file=$photo_url&photo_file=$photo_url&aadhaar_file=$aadhaar_url&shop_photo_file=$shopphoto_url&pan_card_file=$pancard_url&rental_agreement_file=$rentalagreement_url&electricity_bill_file=$electricitybill_url&property_tax_file=$propertytax_url&old_food_license_file=$oldfoodlicense_url&service_id=$service_id&rowid=$rowid&status=$status&food_service=$food_service&shop_name=$shop_name&email_id=$email_id&mobile=$mobile&mobile_no=$mobile_no&documents=$documents";
    }
        //dd($post_data);
        $url1 = $RAMJIPAY_URL.'/api/update_fssai_api';
        //echo $url1;die;

        curl_setopt( $ch, CURLOPT_URL, $url1 );
        curl_setopt( $ch, CURLOPT_POST, 1 );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_data );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $server_output = curl_exec( $ch );
        curl_close( $ch );
        $resdata = json_decode($server_output, true);
       //dd($resdata);
    }
}
    }
        DB::table( 'fssai' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
        ] );
    }

    return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}

public function covid_update(Request $request){
    $apply_user_id = 0;
    if($request->retailer_id == 0){
        $apply_user_id = $request->distributor_id;
    }elseif($request->distributor_id == 0){
        $apply_user_id = $request->retailer_id;
    }
    if($request->distributor_id != Auth::user()->id && $apply_user_id != Auth::user()->id){
        $status = $request->status;
        if($status == "Resubmit"){
            DB::table( 'covid' )->where('id', $request->applied_serviceid)->update( [
                'remarks'  => $request->remarks,
                'status'  => $status,
            ] );
        }elseif($status == "Processing"){
            if ( $request->acknowledgement != null ) {
                $acknowledgement = uniqid().'.'.$request->file( 'acknowledgement' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'acknowledgement' . DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'acknowledgement' ][ 'tmp_name' ], $filepath . $acknowledgement );
                DB::table( 'covid' )->where( 'id', $request->applied_serviceid )->update( [
                    'acknowledgement' => $acknowledgement,
                    'status' => $status,
                    'application_no' => $request->application_no,
                ] );
            }
        }elseif($status == "Approved"){
            if ( $request->certificate != null ) {
                $certificate = uniqid().'.'.$request->file( 'certificate' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'certificate'. DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'certificate' ][ 'tmp_name' ], $filepath . $certificate );
                DB::table( 'covid' )->where( 'id', $request->applied_serviceid )->update( [
                    'certificate' => $certificate,
                    'status' => $status,
                    'completed_date' => date("Y-m-d"),
                ] );
            }
        }
    }else{
        $status = "Pending";
        $serviceid = $request->serviceid;

        DB::table('covid')->where('id', $request->applied_serviceid)->update([
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

        DB::table( 'covid' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
        ] );

    }

    return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}

public function nalavariyam_update(Request $request){
    $apply_user_id = 0;
    if($request->retailer_id == 0){
        $apply_user_id = $request->distributor_id;
    }elseif($request->distributor_id == 0){
        $apply_user_id = $request->retailer_id;
    }
    if($request->distributor_id != Auth::user()->id && $request->retailer_id != Auth::user()->id){
        $status = $request->status;
        if($status == "Resubmit"){
            DB::table( 'nalavariyam' )->where('id', $request->applied_serviceid)->update( [
                'remarks' => $request->remarks,
                'status'  => $status,
            ] );
        }elseif($status == "Processing"){
            if ( $request->acknowledgement != null ) {
                $acknowledgement = uniqid().'.'.$request->file( 'acknowledgement' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'acknowledgement' . DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'acknowledgement' ][ 'tmp_name' ], $filepath . $acknowledgement );
                DB::table( 'nalavariyam' )->where( 'id', $request->applied_serviceid )->update( [
                    'acknowledgement' => $acknowledgement,
                    'status' => $status,
                    'application_no' => $request->application_no,
                ] );
            }
        }elseif($status == "Approved"){
            if ( $request->certificate != null ) {
                $certificate = uniqid().'.'.$request->file( 'certificate' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'certificate'. DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'certificate' ][ 'tmp_name' ], $filepath . $certificate );
                DB::table( 'nalavariyam' )->where( 'id', $request->applied_serviceid )->update( [
                    'certificate' => $certificate,
                    'status' => $status,
                    'completed_date' => date("Y-m-d"),
                ] );
            }
        }
    }else{
        $status = "Pending";
        $serviceid = $request->serviceid;
        DB::table('nalavariyam')->where('id', $request->applied_serviceid)->update([
            'service_id'      => $request ->serviceid,
            'register_no'     => $request->register_no,
            'mobile'          => $request->mobile,
            'aadhaar_no'      => $request->aadhaar_no,
            'dob'             => $request->dob,
            'status'          => 'Pending',
            'applied_date'    => date("Y-m-d"),
            'created_at'      => date("Y-m-d"),
        ] );

        if ($request->photo != null) {
            $photo = uniqid().'.'.$request->file('photo')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);
            DB::table('nalavariyam')->where( 'id', $request->applied_serviceid )->update( [
                'photo' => $photo,
            ]);
        }
        if ($request->signature != null) {
            $signature = uniqid().'.'.$request->file('signature')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'signature' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['signature']['tmp_name'], $filepath . $signature);

            DB::table('nalavariyam')->where( 'id', $request->applied_serviceid )->update( [
                'signature' => $signature,
            ]);
        }
        DB::table( 'nalavariyam' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
        ] );
    }

    return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}

public function driving_license_update(Request $request){
    $apply_user_id = 0;
    if($request->retailer_id == 0){
        $apply_user_id = $request->distributor_id;
    }elseif($request->distributor_id == 0){
        $apply_user_id = $request->retailer_id;
    }
    if($request->distributor_id != Auth::user()->id && $request->retailer_id != Auth::user()->id){
        $status = $request->status;
        if($status == "Resubmit"){
            DB::table( 'license' )->where('id', $request->applied_serviceid)->update( [
                'remarks' => $request->remarks,
                'status'  => $status,
            ] );
        }elseif($status == "Processing"){
            if ( $request->acknowledgement != null ) {
                $acknowledgement = uniqid().'.'.$request->file( 'acknowledgement' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'acknowledgement' . DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'acknowledgement' ][ 'tmp_name' ], $filepath . $acknowledgement );
                DB::table( 'license' )->where( 'id', $request->applied_serviceid )->update( [
                    'acknowledgement' => $acknowledgement,
                    'status' => $status,
                    'application_no' => $request->application_no,
                ] );
            }
        }elseif($status == "Approved"){
            if ( $request->certificate != null ) {
                $certificate = uniqid().'.'.$request->file( 'certificate' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'certificate'. DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'certificate' ][ 'tmp_name' ], $filepath . $certificate );
                DB::table( 'license' )->where( 'id', $request->applied_serviceid )->update( [
                    'certificate' => $certificate,
                    'status' => $status,
                    'completed_date' => date("Y-m-d"),
                ] );
            }
        }
    }else{
        $status = "Pending";
        $serviceid = $request->serviceid;
        DB::table('license')->where('id', $request->applied_serviceid)->update([
            'service_id'      => $request ->serviceid,
            'id_proof'       => $request->id_proof,
            'rc_number'       => $request->rc_number,
            'driving_license_no'=> $request->driving_license_no,
            'dob'             => $request->dob,
            'status'          => 'Pending',
            'applied_date'    => date("Y-m-d"),
            'created_at'      => date("Y-m-d"),
        ] );

        if ($request->driving_license != null) {
            $driving_license = uniqid().'.'.$request->file('driving_license')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'driving_license' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['driving_license']['tmp_name'], $filepath . $driving_license);
            DB::table('license')->where( 'id', $request->applied_serviceid )->update( [
                'driving_license' => $driving_license,
            ]);
        }
        if ($request->aadhaar_card != null) {
            $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);

            DB::table('license')->where( 'id', $request->applied_serviceid )->update( [
                'aadhaar_card' => $aadhaar_card,
            ]);
        }
        DB::table( 'license' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
        ] );
    }

    return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}

public function pancard_update(Request $request){
    $apply_user_id = 0;
    if($request->retailer_id == 0){
     $apply_user_id = $request->distributor_id;
 }elseif($request->distributor_id == 0){
     $apply_user_id = $request->retailer_id;
 }
 if($request->distributor_id != Auth::user()->id && $apply_user_id != Auth::user()->id){
     $status = $request->status;
     if($status == "Resubmit"){
         DB::table( 'pancard' )->where('id', $request->applied_serviceid)->update( [
             'remarks'  => $request->remarks,
             'status'  => $status,
         ] );
     }elseif($status == "Processing"){
         if ( $request->acknowledgement != null ) {
             $acknowledgement = uniqid().'.'.$request->file( 'acknowledgement' )->extension();
             $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'acknowledgement' . DIRECTORY_SEPARATOR);
             move_uploaded_file( $_FILES[ 'acknowledgement' ][ 'tmp_name' ], $filepath . $acknowledgement );
             DB::table( 'pancard' )->where( 'id', $request->applied_serviceid )->update( [
                 'acknowledgement' => $acknowledgement,
                 'status' => $status,
                 'application_no' => $request->application_no,
             ] );
         }
     }elseif($status == "Approved"){
         if ( $request->certificate != null ) {
             $certificate = uniqid().'.'.$request->file( 'certificate' )->extension();
             $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'certificate'. DIRECTORY_SEPARATOR);
             move_uploaded_file( $_FILES[ 'certificate' ][ 'tmp_name' ], $filepath . $certificate );
             DB::table( 'pancard' )->where( 'id', $request->applied_serviceid )->update( [
                 'certificate' => $certificate,
                 'status' => $status,
                 'completed_date' => date("Y-m-d"),
             ] );
         }
     }
 }else{
     $status = "Pending";
     $serviceid = $request->serviceid;
     if ($request->pan_card != null) {
         $pan_card = uniqid().'.'.$request->file('pan_card')->extension();
         $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'pan_card' . DIRECTORY_SEPARATOR);
         move_uploaded_file($_FILES['pan_card']['tmp_name'], $filepath . $pan_card);
         DB::table( 'pancard' )->where( 'id', $request->applied_serviceid )->update( [
          'pan_card'             => $pan_card,
      ] );
     }
     if($serviceid == 71 || $serviceid == 69){
         DB::table('pancard')->where('id', $request->applied_serviceid)->update([
             'pancard_type' => $request->pancard_type,
             'name'         => $request->name,
             'aadhaar_no'   => $request->aadhaar_no,
             'relative_name'=> $request->relative_name,
             'email_id'     => $request->email_id,
             'relationship' => $request->relationship,
             'mobile'       => $request->mobile,
             'status'       => 'Pending',
             'applied_date' => date("Y-m-d"),
             'created_at'   => date("Y-m-d"),
         ]);

         DB::table( 'pancard' )->where( 'id', $request->applied_serviceid )->update( [
             'status' => $status,
         ] );
         if ($request->pan_card != null) {
            $pan_card = uniqid().'.'.$request->file('pan_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'pan_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['pan_card']['tmp_name'], $filepath . $pan_card);

            DB::table('pancard')->where( 'id', $request->applied_serviceid )->update( [
                'pan_card' => $pan_card,
            ]);
        }
        if ($request->photo != null) {
            $photo = uniqid().'.'.$request->file('photo')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);
            DB::table('pancard')->where( 'id', $request->applied_serviceid )->update( [
                'photo' => $photo,
            ]);
        }
        if ($request->aadhaar_card != null) {
            $aadhaarimg = uniqid().'.'.$request->file('aadhaar_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);

            DB::table('pancard')->where( 'id', $request->applied_serviceid )->update( [
                'aadhaar_card' => $aadhaarimg,
            ]);
        }
        if ($request->signature != null) {
            $signature = uniqid().'.'.$request->file('signature')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'signature' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['signature']['tmp_name'], $filepath . $signature);
        }
        DB::table('pancard')->where( 'id', $request->applied_serviceid )->update( [
            'signature' => $signature,
        ]);
    }

}
return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}

public function update_pmkissan(Request $request){
    $apply_user_id = 0;
    if($request->retailer_id == 0){
        $apply_user_id = $request->distributor_id;
    }elseif($request->distributor_id == 0){
        $apply_user_id = $request->retailer_id;
    }
    if($request->distributor_id != Auth::user()->id && $apply_user_id != Auth::user()->id){
        $status = $request->status;
        if($status == "Resubmit"){
            DB::table( 'pmkissan' )->where('id', $request->applied_serviceid)->update( [
                'remarks'  => $request->remarks,
                'status'  => $status,
            ] );
        }elseif($status == "Processing"){
            if ( $request->acknowledgement != null ) {
                $acknowledgement = uniqid().'.'.$request->file( 'acknowledgement' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'acknowledgement' . DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'acknowledgement' ][ 'tmp_name' ], $filepath . $acknowledgement );
                DB::table( 'pmkissan' )->where( 'id', $request->applied_serviceid )->update( [
                    'acknowledgement' => $acknowledgement,
                    'status' => $status,
                    'application_no' => $request->application_no,
                ] );
            }
        }elseif($status == "Approved"){
            if ( $request->certificate != null ) {
                $certificate = uniqid().'.'.$request->file( 'certificate' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'certificate'. DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'certificate' ][ 'tmp_name' ], $filepath . $certificate );
                DB::table( 'pmkissan' )->where( 'id', $request->applied_serviceid )->update( [
                    'certificate' => $certificate,
                    'status' => $status,
                    'completed_date' => date("Y-m-d"),
                ] );
            }
        }
    }else{
        $status = "Pending";
        $serviceid = $request->serviceid;
        DB::table('pmkissan')->where('id', $request->applied_serviceid)->update([
            'status'       => 'Pending',
            'applied_date' => date("Y-m-d"),
            'created_at'   => date("Y-m-d"),
        ]);
        if ($request->aadhaar_card != null) {
            $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
            DB::table('pmkissan')->where('id', $request->applied_serviceid)->update([
                'aadhaar_card'         => $aadhaar_card,
            ]);
        }

        if ($request->land_document != null) {
            $land_document = uniqid().'.'.$request->file('land_document')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'landdocument' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['land_document']['tmp_name'], $filepath . $land_document);
            DB::table('pmkissan')->where('id', $request->applied_serviceid)->update([
                'land_document'         => $land_document,
            ]);
        }
    }

    return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}
public function tec_csc_update(Request $request){
    $apply_user_id = 0;
    if($request->retailer_id == 0){
        $apply_user_id = $request->distributor_id;
    }elseif($request->distributor_id == 0){
        $apply_user_id = $request->retailer_id;
    }
    if($request->distributor_id != Auth::user()->id && $apply_user_id != Auth::user()->id){
        $status = $request->status;
        if($status == "Resubmit"){
            DB::table( 'tec_exam' )->where('id', $request->applied_serviceid)->update( [
                'remarks'  => $request->remarks,
                'status'  => $status,
            ] );
        }elseif($status == "Processing"){
            if ( $request->acknowledgement != null ) {
                $acknowledgement = uniqid().'.'.$request->file( 'acknowledgement' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'acknowledgement' . DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'acknowledgement' ][ 'tmp_name' ], $filepath . $acknowledgement );
                DB::table( 'tec_exam' )->where( 'id', $request->applied_serviceid )->update( [
                    'acknowledgement' => $acknowledgement,
                    'status' => $status,
                    'application_no' => $request->application_no,
                ] );
            }
        }elseif($status == "Approved"){
            if ( $request->certificate != null ) {
                $certificate = uniqid().'.'.$request->file( 'certificate' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'certificate'. DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'certificate' ][ 'tmp_name' ], $filepath . $certificate );
                DB::table( 'tec_exam' )->where( 'id', $request->applied_serviceid )->update( [
                    'certificate' => $certificate,
                    'status' => $status,
                    'completed_date' => date("Y-m-d"),
                ] );
            }
        }
    }else{
        $status = "Pending";
        $serviceid = $request->serviceid;
        DB::table('tec_exam')->where('id', $request->applied_serviceid)->update([
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
            'status'       => 'Pending',
            'applied_date' => date("Y-m-d"),
            'created_at'   => date("Y-m-d"),
        ]);
        if ($request->aadhaar_card != null) {
            $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
            DB::table('tec_exam')->where('id', $request->applied_serviceid)->update([
                'aadhaar_card'         => $aadhaar_card,
            ]);
        }

        if ($request->pan_card != null) {
            $pan_card = uniqid().'.'.$request->file('pan_card')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'pan_card' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['pan_card']['tmp_name'], $filepath . $pan_card);
            DB::table('tec_exam')->where('id', $request->applied_serviceid)->update([
                'pan_card'         => $pan_card,
            ]);
        }
        if ($request->tec_certificate != null) {
            $tec_certificate = uniqid().'.'.$request->file('tec_certificate')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'tec_certificate' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['tec_certificate']['tmp_name'], $filepath . $tec_certificate);
            DB::table('tec_exam')->where('id', $request->applied_serviceid)->update([
                'tec_certificate'         => $tec_certificate,
            ]);
        }
        if ($request->bank_passbook != null) {
            $bank_passbook = uniqid().'.'.$request->file('bank_passbook')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'bank_passbook' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['bank_passbook']['tmp_name'], $filepath . $bank_passbook);
            DB::table('tec_exam')->where('id', $request->applied_serviceid)->update([
                'bank_passbook'         => $bank_passbook,
            ]);
        }
        if ($request->voterid != null) {
            $voterid = uniqid().'.'.$request->file('voterid')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'voterid' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['voterid']['tmp_name'], $filepath . $voterid);
            DB::table('tec_exam')->where('id', $request->applied_serviceid)->update([
                'voterid'         => $voterid,
            ]);
        }
        if ($request->bc_agent_certificate != null) {
            $bc_agent_certificate = uniqid().'.'.$request->file('bc_agent_certificate')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'bc_agent_certificate' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['bc_agent_certificate']['tmp_name'], $filepath . $bc_agent_certificate);
            DB::table('tec_exam')->where('id', $request->applied_serviceid)->update([
                'bc_agent_certificate'         => $bc_agent_certificate,
            ]);
        }
    }

    return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}
public function medicalscheme_update(Request $request){
    $apply_user_id = 0;
    if($request->retailer_id == 0){
        $apply_user_id = $request->distributor_id;
    }elseif($request->distributor_id == 0){
        $apply_user_id = $request->retailer_id;
    }
    if($request->distributor_id != Auth::user()->id && $apply_user_id != Auth::user()->id){
        $status = $request->status;
        if($status == "Resubmit"){
            DB::table( 'medicalscheme' )->where('id', $request->applied_serviceid)->update( [
                'remarks'  => $request->remarks,
                'status'  => $status,
            ] );
        }elseif($status == "Processing"){
            if ( $request->acknowledgement != null ) {
                $acknowledgement = uniqid().'.'.$request->file( 'acknowledgement' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'acknowledgement' . DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'acknowledgement' ][ 'tmp_name' ], $filepath . $acknowledgement );
                DB::table( 'medicalscheme' )->where( 'id', $request->applied_serviceid )->update( [
                    'acknowledgement' => $acknowledgement,
                    'status' => $status,
                    'application_no' => $request->application_no,
                ] );
            }
        }elseif($status == "Approved"){
            if ( $request->certificate != null ) {
                $certificate = uniqid().'.'.$request->file( 'certificate' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'certificate'. DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'certificate' ][ 'tmp_name' ], $filepath . $certificate );
                DB::table( 'medicalscheme' )->where( 'id', $request->applied_serviceid )->update( [
                    'certificate' => $certificate,
                    'status' => $status,
                    'completed_date' => date("Y-m-d"),
                ] );
            }
        }
    }else{
        $status = "Pending";
        $serviceid = $request->serviceid;
        if($serviceid == 179){
            if ($request->family_head_photo != null) {
                $family_head_photo = uniqid().'.'.$request->file('family_head_photo')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'family_head_photo' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['family_head_photo']['tmp_name'], $filepath . $family_head_photo);
                DB::table('medicalscheme')->where('id', $request->applied_serviceid)->update([
                    'family_head_photo'         => $family_head_photo,
                ]);
            }
            if ($request->smartcard_onlineprint != null) {
                $smartcard_onlineprint = uniqid().'.'.$request->file('smartcard_onlineprint')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'smartcard_onlineprint' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['smartcard_onlineprint']['tmp_name'], $filepath . $smartcard_onlineprint);
                DB::table('medicalscheme')->where('id', $request->applied_serviceid)->update([
                    'smartcard_onlineprint'         => $smartcard_onlineprint,
                ]);
            }
            if ($request->allfamily_mem_aadhaarcard != null) {
                $allfamily_mem_aadhaarcard = uniqid().'.'.$request->file('allfamily_mem_aadhaarcard')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'allfamily_mem_aadhaarcard' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['allfamily_mem_aadhaarcard']['tmp_name'], $filepath . $allfamily_mem_aadhaarcard);
                DB::table('medicalscheme')->where('id', $request->applied_serviceid)->update([
                    'allfamily_mem_aadhaarcard'         => $allfamily_mem_aadhaarcard,
                ]);
            }

            DB::table('medicalscheme')->where('id', $request->applied_serviceid)->update([
                'family_head_name'     => $request->family_head_name,
                'mobile'               => $request->mobile,
                'status'               => 'Pending',
                'applied_date'         => date("Y-m-d"),
                'created_at'           => date("Y-m-d"),

            ]);
        }elseif($serviceid == 180){
            if ($request->aadhaar_card != null) {
                $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
                DB::table('medicalscheme')->where('id', $request->applied_serviceid)->update([
                    'aadhaar_card'         => $aadhaar_card,
                ]);
            }

            DB::table('medicalscheme')->where('id', $request->applied_serviceid)->update([

                'mobile'               => $request->mobile,
                'status'               => 'Pending',
                'applied_date'         => date("Y-m-d"),
                'created_at'           => date("Y-m-d"),
            ]);

        }

        DB::table( 'medicalscheme' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
        ] );

    }

    return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}
public function birthcertificate_update(Request $request){
    $apply_user_id = 0;
    if($request->retailer_id == 0){
        $apply_user_id = $request->distributor_id;
    }elseif($request->distributor_id == 0){
        $apply_user_id = $request->retailer_id;
    }
    if($request->distributor_id != Auth::user()->id && $apply_user_id != Auth::user()->id){
        $status = $request->status;
        if($status == "Resubmit"){
            DB::table( 'birth_certificate' )->where('id', $request->applied_serviceid)->update( [
                'remarks'  => $request->remarks,
                'status'  => $status,
            ] );
        }elseif($status == "Processing"){
            if ( $request->acknowledgement != null ) {
                $acknowledgement = uniqid().'.'.$request->file( 'acknowledgement' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'acknowledgement' . DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'acknowledgement' ][ 'tmp_name' ], $filepath . $acknowledgement );
                DB::table( 'birth_certificate' )->where( 'id', $request->applied_serviceid )->update( [
                    'acknowledgement' => $acknowledgement,
                    'status' => $status,
                    'application_no' => $request->application_no,
                ] );
            }
        }elseif($status == "Approved"){
            if ( $request->certificate != null ) {
                $certificate = uniqid().'.'.$request->file( 'certificate' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'certificate'. DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'certificate' ][ 'tmp_name' ], $filepath . $certificate );
                DB::table( 'birth_certificate' )->where( 'id', $request->applied_serviceid )->update( [
                    'certificate' => $certificate,
                    'status' => $status,
                    'completed_date' => date("Y-m-d"),
                ] );
            }
        }
    }else{
        $status = "Pending";
        $serviceid = $request->serviceid;
        if($serviceid == 155 || $serviceid == 156){

            DB::table('birth_certificate')->where('id', $request->applied_serviceid)->update([
                'childname'         => $request->childname,
                'date_of_birth'     => $request->date_of_birth,
                'date_of_death'     => $request->date_of_death,
                'dist_id'           => $request->dist_id,
                'place_of_birth'    => $request->place_of_birth,
                'place_of_death'    => $request->place_of_death,
                'hospital_name'     => $request->hospital_name,
                'name'              => $request->name,
                'mobile'            => $request->mobile,
                'aadhaar_no'        => $request->aadhaar_no,
                'status'               => 'Pending',
                'applied_date'         => date("Y-m-d"),
                'created_at'           => date("Y-m-d"),

            ]);

        }
        DB::table( 'birth_certificate' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
        ] );

    }

    return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}
public function dharsan_update(Request $request){
    $apply_user_id = 0;
    if($request->retailer_id == 0){
        $apply_user_id = $request->distributor_id;
    }elseif($request->distributor_id == 0){
        $apply_user_id = $request->retailer_id;
    }
    if($request->distributor_id != Auth::user()->id && $apply_user_id != Auth::user()->id){
        $status = $request->status;
        if($status == "Resubmit"){
            DB::table( 'dharsan' )->where('id', $request->applied_serviceid)->update( [
                'remarks'  => $request->remarks,
                'status'  => $status,
            ] );
        }elseif($status == "Processing"){
            if ( $request->acknowledgement != null ) {
                $acknowledgement = uniqid().'.'.$request->file( 'acknowledgement' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'acknowledgement' . DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'acknowledgement' ][ 'tmp_name' ], $filepath . $acknowledgement );
                DB::table( 'dharsan' )->where( 'id', $request->applied_serviceid )->update( [
                    'acknowledgement' => $acknowledgement,
                    'status' => $status,
                    'application_no' => $request->application_no,
                ] );
            }
        }elseif($status == "Approved"){
            if ( $request->certificate != null ) {
                $certificate = uniqid().'.'.$request->file( 'certificate' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'certificate'. DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'certificate' ][ 'tmp_name' ], $filepath . $certificate );
                DB::table( 'dharsan' )->where( 'id', $request->applied_serviceid )->update( [
                    'certificate' => $certificate,
                    'status' => $status,
                    'completed_date' => date("Y-m-d"),
                ] );
            }
        }
    }else{
        $status = "Pending";
        $serviceid = $request->serviceid;
        if($serviceid == 183 || $serviceid == 184 || $serviceid == 185 || $serviceid == 186){
            DB::table('dharsan')->where('id', $request->applied_serviceid)->update([
                'service_id'   => $request ->serviceid,
                'amount'       => $request->amount,
                'name'         => $request->name,
                'mobile'       => $request->mobile,
                'darshan_date' => $request->darshan_date,
                'time'         => $request->time,
                'status'       => 'Pending',
                'applied_date' => date("Y-m-d"),
                'created_at'   => date("Y-m-d"),
            ]);
            if ($request->aadhaar_card != null) {
                $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
                DB::table('dharsan')->where('id', $request->applied_serviceid)->update([
                    'aadhaar_card'         => $aadhaar_card,
                ]);
            }

            if ($request->photo != null) {
                $photo = uniqid().'.'.$request->file('photo')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);
                DB::table('dharsan')->where('id', $request->applied_serviceid)->update([
                    'photo'         => $photo,
                ]);
            }
        }
        DB::table( 'dharsan' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
        ] );
    }

    return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}

public function patta_update(Request $request){
    $apply_user_id = 0;
    if ($request->distributor_id == 0 && $request->retailer_id == 0) {
        $apply_user_id = $request->user_id;
    }
    elseif($request->retailer_id == 0){
        $apply_user_id = $request->distributor_id;
    }elseif($request->distributor_id == 0){
        $apply_user_id = $request->retailer_id;
    }
    if($apply_user_id != Auth::user()->id){
        $status = $request->status;
        if($status == "Resubmit"){
            DB::table( 'patta' )->where('id', $request->applied_serviceid)->update( [
                'remarks'  => $request->remarks,
                'status'  => $status,
            ] );
        }elseif($status == "Processing"){
            if ( $request->acknowledgement != null ) {
                $acknowledgement = uniqid().'.'.$request->file( 'acknowledgement' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'acknowledgement' . DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'acknowledgement' ][ 'tmp_name' ], $filepath . $acknowledgement );
                DB::table( 'patta' )->where( 'id', $request->applied_serviceid )->update( [
                    'acknowledgement' => $acknowledgement,
                ] );
            }
            DB::table( 'patta' )->where( 'id', $request->applied_serviceid )->update( [
                'status' => $status,
                'application_no' => $request->application_no,
                'selects' => $request->selects,
            ] );
        }elseif($status == "Approved"){
            if ( $request->certificate != null ) {
                $certificate = uniqid().'.'.$request->file( 'certificate' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'certificate'. DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'certificate' ][ 'tmp_name' ], $filepath . $certificate );
                DB::table( 'patta' )->where( 'id', $request->applied_serviceid )->update( [
                    'certificate' => $certificate,
                    'status' => $status,
                    'completed_date' => date("Y-m-d"),
                ] );
            }
            DB::table( 'patta' )->where( 'id', $request->applied_serviceid )->update( [
                'status' => $status,
                'application' => $request->application,
                'lects' => $request->lects,
            ] );
        }elseif($status == "Rejected"){
            $serviceid = $request->serviceid;
            $getservice_payment = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
            $getusers = DB::table( 'users' )->where('id',$apply_user_id)->first();
            $usertype = 0;
            if($getusers){
                $usertype = $getusers->user_type_id;
            }
            $payment = 0;
            if($getservice_payment){
                if($usertype == 3){
                  $payment = $getservice_payment->distributor_amount;
              }elseif($usertype == 4){
                  $payment = $getservice_payment->retailer_amount;
              }elseif($usertype == 5){
                  $payment = $getservice_payment->customer_amount;
              }
          }

          $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
          $servicename = "";
          if($getservicename){
            $servicename = $getservicename->service_name;
        }
        $date = date( 'Y-m-d' );
        $time = date( 'H:i:s' );
        $service_status = 'Out Payment';
        $ad_info = "Service Refund For". ' ' .$servicename;

        $getwallet = DB::table( 'users' )->select('wallet')->where('id',1)->first();
        $balance = 0;
        if($getwallet){
            $balance = $getwallet->wallet;
        }
        $getuserswallet = DB::table( 'users' )->select('wallet')->where('id',$apply_user_id)->first();
        $balance1 = 0;
        if($getuserswallet){
            $balance1 = $getuserswallet->wallet;
        }
        $newbalance = $balance - $payment;
        $newbalance1 = $balance1 + $payment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$apply_user_id','1','$apply_user_id','$payment','$ad_info', '$service_status','$time','$date','$apply_user_id','$newbalance')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet - $payment where id = 1";
        DB::update( DB::raw( $sql ) );
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$apply_user_id','$apply_user_id','1','$payment','$ad_info', '$service_status','$time','$date','$apply_user_id','$newbalance1')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet + $payment where id = $apply_user_id";
        DB::update( DB::raw( $sql ) );

        DB::table( 'patta' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
        ] );

    }
    }else{
        $status = "Pending";
        $serviceid = $request->serviceid;

        DB::table('patta')->where('id', $request->applied_serviceid)->update([
            'can_no'          => $request->can_no,
            'dist_id'         => $request->dist_id,
            'taluk_id'        => $request->taluk_id,
            'reg_office'      => $request->reg_office,
            'subdivision_no'  => $request->subdivision_no,
            'rev_village'     => $request->rev_village,
            'survey_no'       => $request->survey_no,
            'transacted_area' => $request->transacted_area,
            'status'          => 'Pending',
            'applied_date'    => date("Y-m-d"),
            'created_at'      => date("Y-m-d"),
        ]);

        if ($request->bond_doc != null) {
            $bond_doc = uniqid().'.'.$request->file('bond_doc')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'bond_doc' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['bond_doc']['tmp_name'], $filepath . $bond_doc);
            DB::table('patta')->where('id', $request->applied_serviceid)->update([
                'bond_doc'         => $bond_doc,
            ]);
        }

        if ($request->ec != null) {
            $ec = uniqid().'.'.$request->file('ec')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'ec' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['ec']['tmp_name'], $filepath . $ec);
            DB::table('patta')->where('id', $request->applied_serviceid)->update([
                'ec'         => $ec,
            ]);
        }
    }
        DB::table( 'patta' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
        ] );


    return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}


public function utislupdate(Request $request){
    $apply_user_id = 0;
    if ($request->distributor_id == 0 && $request->retailer_id == 0) {
        $apply_user_id = $request->user_id;
    }
    elseif($request->retailer_id == 0){
        $apply_user_id = $request->distributor_id;
    }elseif($request->distributor_id == 0){
        $apply_user_id = $request->retailer_id;
    }
    if($apply_user_id != Auth::user()->id){
        $status = $request->status;
        if($status == "Resubmit"){
            DB::table( 'utislpan' )->where('id', $request->applied_serviceid)->update( [
                'remarks'  => $request->remarks,
                'status'  => $status,
            ] );
        }elseif($status == "Processing"){
            if ( $request->acknowledgement != null ) {
                $acknowledgement = uniqid().'.'.$request->file( 'acknowledgement' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'acknowledgement' . DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'acknowledgement' ][ 'tmp_name' ], $filepath . $acknowledgement );
                DB::table( 'utislpan' )->where( 'id', $request->applied_serviceid )->update( [
                    'acknowledgement' => $acknowledgement,
                ] );
            }
            DB::table( 'utislpan' )->where( 'id', $request->applied_serviceid )->update( [
                'status' => $status,
                'application_no' => $request->application_no,
                'selects' => $request->selects,
            ] );
        }elseif($status == "Approved"){
            if ( $request->certificate != null ) {
                $certificate = uniqid().'.'.$request->file( 'certificate' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'certificate'. DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'certificate' ][ 'tmp_name' ], $filepath . $certificate );
                DB::table( 'utislpan' )->where( 'id', $request->applied_serviceid )->update( [
                    'certificate' => $certificate,
                    'status' => $status,
                    'completed_date' => date("Y-m-d"),
                ] );
            }
            DB::table( 'utislpan' )->where( 'id', $request->applied_serviceid )->update( [
                'status' => $status,
                'application' => $request->application,
                'lects' => $request->lects,
            ] );
        }elseif($status == "Rejected"){
            $serviceid = $request->serviceid;
            $getservice_payment = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
            $getusers = DB::table( 'users' )->where('id',$apply_user_id)->first();
            $usertype = 0;
            if($getusers){
                $usertype = $getusers->user_type_id;
            }
            $payment = 0;
            if($getservice_payment){
                if($usertype == 3){
                  $payment = $getservice_payment->distributor_amount;
              }elseif($usertype == 4){
                  $payment = $getservice_payment->retailer_amount;
              }elseif($usertype == 5){
                  $payment = $getservice_payment->customer_amount;
              }
          }

          $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
          $servicename = "";
          if($getservicename){
            $servicename = $getservicename->service_name;
        }
        $date = date( 'Y-m-d' );
        $time = date( 'H:i:s' );
        $service_status = 'Out Payment';
        $ad_info = "Service Refund For". ' ' .$servicename;

        $getwallet = DB::table( 'users' )->select('wallet')->where('id',1)->first();
        $balance = 0;
        if($getwallet){
            $balance = $getwallet->wallet;
        }
        $getuserswallet = DB::table( 'users' )->select('wallet')->where('id',$apply_user_id)->first();
        $balance1 = 0;
        if($getuserswallet){
            $balance1 = $getuserswallet->wallet;
        }
        $newbalance = $balance - $payment;
        $newbalance1 = $balance1 + $payment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$apply_user_id','1','$apply_user_id','$payment','$ad_info', '$service_status','$time','$date','$apply_user_id','$newbalance')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet - $payment where id = 2";
        DB::update( DB::raw( $sql ) );
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$apply_user_id','$apply_user_id','1','$payment','$ad_info', '$service_status','$time','$date','$apply_user_id','$newbalance1')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet + $payment where id = $apply_user_id";
        DB::update( DB::raw( $sql ) );

        DB::table( 'patta' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
        ] );

    }
    }else{
        $status = "Pending";
        $serviceid = $request->serviceid;

        DB::table('utislpan')->where('id', $request->applied_serviceid)->update([
            // 'amount'              => $request->amount,
            'name'                => $request->name,
            'mobile'              => $request->mobile,
            'email'               => $request->email,
            'pan_no'              => $request->pan_no,
            'date_of_birth'       => $request->date_of_birth,
            'father_name'         => $request->father_name,

        ]);

        if ($request->aadhaar_pdf != null) {
            $aadhaar_pdf = uniqid().'.'.$request->file('aadhaar_pdf')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaarpdf' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['aadhaar_pdf']['tmp_name'], $filepath . $aadhaar_pdf);
            DB::table('utislpan')->where('id', $request->applied_serviceid)->update([
                'aadhaar_pdf'     => $aadhaar_pdf,
            ]);
        }
        if ($request->signature != null) {
            $ec = uniqid().'.'.$request->file('signature')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'signature' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['signature']['tmp_name'], $filepath . $ec);
            DB::table('utislpan')->where('id', $request->applied_serviceid)->update([
                'signature'         => $signature,
            ]);
        }
        if ($request->photo != null) {
            $ec = uniqid().'.'.$request->file('photo')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $ec);
            DB::table('utislpan')->where('id', $request->applied_serviceid)->update([
                'photo'         => $photo,
            ]);
        }
    }
        DB::table( 'utislpan' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
        ] );


    return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}

public function utislcorection_update(Request $request){
    $apply_user_id = 0;
    if ($request->distributor_id == 0 && $request->retailer_id == 0) {
        $apply_user_id = $request->user_id;
    }
    elseif($request->retailer_id == 0){
        $apply_user_id = $request->distributor_id;
    }elseif($request->distributor_id == 0){
        $apply_user_id = $request->retailer_id;
    }
    if($apply_user_id != Auth::user()->id){
        $status = $request->status;
        if($status == "Resubmit"){
            DB::table( 'utislpan' )->where('id', $request->applied_serviceid)->update( [
                'remarks'  => $request->remarks,
                'status'  => $status,
            ] );
        }elseif($status == "Processing"){
            if ( $request->acknowledgement != null ) {
                $acknowledgement = uniqid().'.'.$request->file( 'acknowledgement' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'acknowledgement' . DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'acknowledgement' ][ 'tmp_name' ], $filepath . $acknowledgement );
                DB::table( 'utislpan' )->where( 'id', $request->applied_serviceid )->update( [
                    'acknowledgement' => $acknowledgement,
                ] );
            }
            DB::table( 'utislpan' )->where( 'id', $request->applied_serviceid )->update( [
                'status' => $status,
                'application_no' => $request->application_no,
                'selects' => $request->selects,
            ] );
        }elseif($status == "Approved"){
            if ( $request->certificate != null ) {
                $certificate = uniqid().'.'.$request->file( 'certificate' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'certificate'. DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'certificate' ][ 'tmp_name' ], $filepath . $certificate );
                DB::table( 'utislpan' )->where( 'id', $request->applied_serviceid )->update( [
                    'certificate' => $certificate,
                    'status' => $status,
                    'completed_date' => date("Y-m-d"),
                ] );
            }
            DB::table( 'utislpan' )->where( 'id', $request->applied_serviceid )->update( [
                'status' => $status,
                'application' => $request->application,
                'lects' => $request->lects,
            ] );
        }elseif($status == "Rejected"){
            $serviceid = $request->serviceid;
            $getservice_payment = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
            $getusers = DB::table( 'users' )->where('id',$apply_user_id)->first();
            $usertype = 0;
            if($getusers){
                $usertype = $getusers->user_type_id;
            }
            $payment = 0;
            if($getservice_payment){
                if($usertype == 3){
                  $payment = $getservice_payment->distributor_amount;
              }elseif($usertype == 4){
                  $payment = $getservice_payment->retailer_amount;
              }elseif($usertype == 5){
                  $payment = $getservice_payment->customer_amount;
              }
          }

          $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
          $servicename = "";
          if($getservicename){
            $servicename = $getservicename->service_name;
        }
        $date = date( 'Y-m-d' );
        $time = date( 'H:i:s' );
        $service_status = 'Out Payment';
        $ad_info = "Service Refund For". ' ' .$servicename;

        $getwallet = DB::table( 'users' )->select('wallet')->where('id',1)->first();
        $balance = 0;
        if($getwallet){
            $balance = $getwallet->wallet;
        }
        $getuserswallet = DB::table( 'users' )->select('wallet')->where('id',$apply_user_id)->first();
        $balance1 = 0;
        if($getuserswallet){
            $balance1 = $getuserswallet->wallet;
        }
        $newbalance = $balance - $payment;
        $newbalance1 = $balance1 + $payment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$apply_user_id','1','$apply_user_id','$payment','$ad_info', '$service_status','$time','$date','$apply_user_id','$newbalance')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet - $payment where id = 2";
        DB::update( DB::raw( $sql ) );
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$apply_user_id','$apply_user_id','1','$payment','$ad_info', '$service_status','$time','$date','$apply_user_id','$newbalance1')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet + $payment where id = $apply_user_id";
        DB::update( DB::raw( $sql ) );

        DB::table( 'utislpan' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
        ] );

    }
    }else{
        $status = "Pending";
        $serviceid = $request->serviceid;

        DB::table('utislpan')->where('id', $request->applied_serviceid)->update([

            'name'                => $request->name,
            'pan_no'              => $request->pan_no,
            'mode'                => $request->mode,
            'name'                => $request->name,
            'mobile'              => $request->mobile,
            'email'               => $request->email,
            'date_of_birth'       => $request->date_of_birth,
            'father_name'         => $request->father_name,

        ]);

        if ($request->pan_file != null) {
            $pan_file = uniqid().'.'.$request->file('pan_file')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'pancard' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['pan_file']['tmp_name'], $filepath . $pan_file);
            DB::table('utislpan')->where('id', $request->applied_serviceid)->update([
                'pan_file'     => $pan_file,
            ]);
        }
        if ($request->aadhaar_pdf != null) {
            $aadhaar_pdf = uniqid().'.'.$request->file('aadhaar_pdf')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaarpdf' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['aadhaar_pdf']['tmp_name'], $filepath . $aadhaar_pdf);
            DB::table('utislpan')->where('id', $request->applied_serviceid)->update([
                'aadhaar_pdf'     => $aadhaar_pdf,
            ]);
        }
        if ($request->signature != null) {
            $ec = uniqid().'.'.$request->file('signature')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'signature' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['signature']['tmp_name'], $filepath . $ec);
            DB::table('utislpan')->where('id', $request->applied_serviceid)->update([
                'signature'         => $signature,
            ]);
        }
        if ($request->photo != null) {
            $ec = uniqid().'.'.$request->file('photo')->extension();
            $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
            move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $ec);
            DB::table('utislpan')->where('id', $request->applied_serviceid)->update([
                'photo'         => $photo,
            ]);
        }
    }
        DB::table( 'utislpan' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
        ] );


    return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}
public function smartcardotp_update(Request $request){
    $apply_user_id = 0;
    if ($request->distributor_id == 0 && $request->retailer_id == 0) {
        $apply_user_id = $request->user_id;
    }
    elseif($request->retailer_id == 0){
        $apply_user_id = $request->distributor_id;
    }elseif($request->distributor_id == 0){
        $apply_user_id = $request->retailer_id;
    }
    if($apply_user_id != Auth::user()->id){
        $status = $request->status;
        if($status == "Resubmit"){
            DB::table( 'smartcard_otp' )->where('id', $request->applied_serviceid)->update( [
                'remarks'  => $request->remarks,
                'status'  => $status,
            ] );
        }elseif($status == "Processing"){
            if ( $request->acknowledgement != null ) {
                $acknowledgement = uniqid().'.'.$request->file( 'acknowledgement' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'acknowledgement' . DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'acknowledgement' ][ 'tmp_name' ], $filepath . $acknowledgement );
                DB::table( 'smartcard_otp' )->where( 'id', $request->applied_serviceid )->update( [
                    'acknowledgement' => $acknowledgement,
                ] );
            }
            DB::table( 'smartcard_otp' )->where( 'id', $request->applied_serviceid )->update( [
                'status' => $status,
                'application_no' => $request->application_no,
                'selects' => $request->selects,
            ] );
        }elseif($status == "Approved"){
            if ( $request->certificate != null ) {
                $certificate = uniqid().'.'.$request->file( 'certificate' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'certificate'. DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'certificate' ][ 'tmp_name' ], $filepath . $certificate );
                DB::table( 'smartcard_otp' )->where( 'id', $request->applied_serviceid )->update( [
                    'certificate' => $certificate,
                    'status' => $status,
                    'completed_date' => date("Y-m-d"),
                ] );
            }
            DB::table( 'smartcard_otp' )->where( 'id', $request->applied_serviceid )->update( [
                'status' => $status,
                'application' => $request->application,
                'lects' => $request->lects,
            ] );
        }elseif($status == "Rejected"){
            $serviceid = $request->serviceid;
            $getservice_payment = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
            $getusers = DB::table( 'users' )->where('id',$apply_user_id)->first();
            $usertype = 0;
            if($getusers){
                $usertype = $getusers->user_type_id;
            }
            $payment = 0;
            if($getservice_payment){
                if($usertype == 3){
                  $payment = $getservice_payment->distributor_amount;
              }elseif($usertype == 4){
                  $payment = $getservice_payment->retailer_amount;
              }elseif($usertype == 5){
                  $payment = $getservice_payment->customer_amount;
              }
          }

          $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
          $servicename = "";
          if($getservicename){
            $servicename = $getservicename->service_name;
        }
        $date = date( 'Y-m-d' );
        $time = date( 'H:i:s' );
        $service_status = 'Out Payment';
        $ad_info = "Service Refund For". ' ' .$servicename;

        $getwallet = DB::table( 'users' )->select('wallet')->where('id',2)->first();
        $balance = 0;
        if($getwallet){
            $balance = $getwallet->wallet;
        }
        $getuserswallet = DB::table( 'users' )->select('wallet')->where('id',$apply_user_id)->first();
        $balance1 = 0;
        if($getuserswallet){
            $balance1 = $getuserswallet->wallet;
        }
        $newbalance = $balance - $payment;
        $newbalance1 = $balance1 + $payment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$apply_user_id','2','$apply_user_id','$payment','$ad_info', '$service_status','$time','$date','$apply_user_id','$newbalance')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet - $payment where id = 2";
        DB::update( DB::raw( $sql ) );
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$apply_user_id','$apply_user_id','2','$payment','$ad_info', '$service_status','$time','$date','$apply_user_id','$newbalance1')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet + $payment where id = $apply_user_id";
        DB::update( DB::raw( $sql ) );

        DB::table( 'smartcard_otp' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
            'remarks'  => $request->remarks,

        ] );

    }
    }else{
        $status = "Pending";
        $serviceid = $request->serviceid;
            DB::table( 'smartcard_otp' )->where( 'id', $request->applied_serviceid )->update( [
                'service_id'                => $request ->serviceid,
                'name'                      => $request->name,
                'documents'                 => $request->documents,
                'status'                    => 'Pending',
                'applied_date'              => date("Y-m-d"),
                'created_at'                => date("Y-m-d"),
            ] );

            if ($request->aadhaar_card != null) {
                $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
                DB::table('smartcard_otp')->where('id', $request->applied_serviceid)->update([
                    'aadhaar_card'         => $aadhaar_card,
                ]);
            }
            if ($request->smart_card != null) {
                $smart_card = uniqid().'.'.$request->file('smart_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smart_card);
                DB::table('smartcard_otp')->where('id', $request->applied_serviceid)->update([
                    'smart_card'         => $smart_card,
                ]);
            }

    $getpermission = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
    $coordinator_permission = 0;
    if($getpermission){
        $coordinator_permission = $getpermission->coordinator_permission;
    }
    if($coordinator_permission == 1){
     $getdata = DB::table( 'smartcard_otp' )->where('id',$request->applied_serviceid)->first();
     if($getdata){
     $aadhaar_card = $getdata->aadhaar_card;
     $smart_card = $getdata->smart_card;
     $service_id = $getdata->service_id;
     $rowid = $getdata->id;
     $name = $getdata->name;
     $documents = $getdata->documents;
     $status = $getdata->status;
     $url = url('/');
     $aadhaar_url = $url.'/upload/services/aadhaar_card/'.$aadhaar_card;
     $smartcard_url = $url.'/upload/services/smart_card/'.$smart_card;
     $API_KEY = env( 'API_KEY', '' );
     $RAMJIPAY_URL = env( 'RAMJIPAY_URL', '' );
     $WEBSITE_INDEX = env( 'WEBSITE_INDEX', '' );

     $ch = curl_init();
    if($serviceid == 220){
        $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&smartcard_file=$smartcard_url&service_id=218&rowid=$rowid&name=$name&documents=$documents&status=$status";

    }
        $url1 = $RAMJIPAY_URL.'/api/update_smartcardotp_api';
        //echo $url1;die;

        curl_setopt( $ch, CURLOPT_URL, $url1 );
        curl_setopt( $ch, CURLOPT_POST, 1 );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_data );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $server_output = curl_exec( $ch );
        curl_close( $ch );
        $resdata = json_decode($server_output, true);
       //dd($resdata);
    }
}
        DB::table( 'smartcard_otp' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
        ] );
    }
    return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}

public function smartcard_member_update(Request $request){
    $apply_user_id = 0;
    if ($request->distributor_id == 0 && $request->retailer_id == 0) {
        $apply_user_id = $request->user_id;
    }
    elseif($request->retailer_id == 0){
        $apply_user_id = $request->distributor_id;
    }elseif($request->distributor_id == 0){
        $apply_user_id = $request->retailer_id;
    }
    if($apply_user_id != Auth::user()->id){
        $status = $request->status;
        if($status == "Resubmit"){
            DB::table( 'smartcard' )->where('id', $request->applied_serviceid)->update( [
                'remarks'  => $request->remarks,
                'status'  => $status,
            ] );
        }elseif($status == "Processing"){
            if ( $request->acknowledgement != null ) {
                $acknowledgement = uniqid().'.'.$request->file( 'acknowledgement' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'acknowledgement' . DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'acknowledgement' ][ 'tmp_name' ], $filepath . $acknowledgement );
                DB::table( 'smartcard' )->where( 'id', $request->applied_serviceid )->update( [
                    'acknowledgement' => $acknowledgement,
                ] );
            }
            DB::table( 'smartcard' )->where( 'id', $request->applied_serviceid )->update( [
                'status' => $status,
                'application_no' => $request->application_no,
                'selects' => $request->selects,
            ] );
        }elseif($status == "Approved"){
            if ( $request->certificate != null ) {
                $certificate = uniqid().'.'.$request->file( 'certificate' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'certificate'. DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'certificate' ][ 'tmp_name' ], $filepath . $certificate );
                DB::table( 'smartcard' )->where( 'id', $request->applied_serviceid )->update( [
                    'certificate' => $certificate,
                    'status' => $status,
                    'completed_date' => date("Y-m-d"),
                ] );
            }
            DB::table( 'smartcard' )->where( 'id', $request->applied_serviceid )->update( [
                'status' => $status,
                'application' => $request->application,
                'lects' => $request->lects,
            ] );
        }elseif($status == "Rejected"){
            $serviceid = $request->serviceid;
            $getservice_payment = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
            $getusers = DB::table( 'users' )->where('id',$apply_user_id)->first();
            $usertype = 0;
            if($getusers){
                $usertype = $getusers->user_type_id;
            }
            $payment = 0;
            if($getservice_payment){
                if($usertype == 3){
                  $payment = $getservice_payment->distributor_amount;
              }elseif($usertype == 4){
                  $payment = $getservice_payment->retailer_amount;
              }elseif($usertype == 5){
                  $payment = $getservice_payment->customer_amount;
              }
          }

          $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
          $servicename = "";
          if($getservicename){
            $servicename = $getservicename->service_name;
        }
        $date = date( 'Y-m-d' );
        $time = date( 'H:i:s' );
        $service_status = 'Out Payment';
        $ad_info = "Service Refund For". ' ' .$servicename;

        $getwallet = DB::table( 'users' )->select('wallet')->where('id',2)->first();
        $balance = 0;
        if($getwallet){
            $balance = $getwallet->wallet;
        }
        $getuserswallet = DB::table( 'users' )->select('wallet')->where('id',$apply_user_id)->first();
        $balance1 = 0;
        if($getuserswallet){
            $balance1 = $getuserswallet->wallet;
        }
        $newbalance = $balance - $payment;
        $newbalance1 = $balance1 + $payment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$apply_user_id','2','$apply_user_id','$payment','$ad_info', '$service_status','$time','$date','$apply_user_id','$newbalance')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet - $payment where id = 2";
        DB::update( DB::raw( $sql ) );
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$apply_user_id','$apply_user_id','2','$payment','$ad_info', '$service_status','$time','$date','$apply_user_id','$newbalance1')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet + $payment where id = $apply_user_id";
        DB::update( DB::raw( $sql ) );

        DB::table( 'smartcard' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
            'remarks'  => $request->remarks,

        ] );

    }
    }else{
        $status = "Pending";
        $serviceid = $request->serviceid;
 if( $serviceid == 226 ){
            DB::table( 'smartcard' )->where( 'id', $request->applied_serviceid )->update( [
                'service_id'                => $request ->serviceid,
                'dist_id'                   => $request->dist_id,
                'taluk_id'                  => $request->taluk_id,
                'add_member'                => $request->add_member,
                'mobile'                    => $request->mobile,
                'documents'                 => $request->documents,
                'status'                    => 'Pending',
                'applied_date'              => date("Y-m-d"),
                'created_at'                => date("Y-m-d"),
            ] );
            if ($request->aadhaar_card != null) {
                $aadhaarimg = uniqid().'.'.$request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaarimg);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'aadhaar_card' => $aadhaarimg,
                ]);
            }
            if ($request->aadhaar_card2 != null) {
                $aadhaarimg2 = uniqid().'.'.$request->file('aadhaar_card2')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card2' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card2']['tmp_name'], $filepath . $aadhaarimg2);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'aadhaar_card2' => $aadhaarimg2,
                ]);
            }
            if ($request->aadhaar_card3 != null) {
                $aadhaarimg3 = uniqid().'.'.$request->file('aadhaar_card3')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card3' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card3']['tmp_name'], $filepath . $aadhaarimg3);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'aadhaar_card3' => $aadhaarimg3,
                ]);
            }
            if ($request->aadhaar_card4 != null) {
                $aadhaarimg4 = uniqid().'.'.$request->file('aadhaar_card4')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card4' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card4']['tmp_name'], $filepath . $aadhaarimg4);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'aadhaar_card4' => $aadhaarimg4,
                ]);
            }
            if ($request->aadhaar_card5 != null) {
                $aadhaarimg5 = uniqid().'.'.$request->file('aadhaar_card5')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card5' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card5']['tmp_name'], $filepath . $aadhaarimg5);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'aadhaar_card5' => $aadhaarimg5,
                ]);
            }
            if ($request->smart_card != null) {
                $smart_card = uniqid().'.'.$request->file('smart_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smart_card);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'smart_card' => $smart_card,
                ]);
            }
            if ($request->family_head_photo != null) {
                $family_head_photo = uniqid().'.'.$request->file('family_head_photo')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'family_head_photo' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['family_head_photo']['tmp_name'], $filepath . $family_head_photo);
                DB::table('smartcard')->where('id', $request->applied_serviceid)->update([
                    'family_head_photo'         => $family_head_photo,
                ]);
            }
            if ($request->rental_agreement != null) {
                $rental_agreement = uniqid().'.'.$request->file('rental_agreement')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'rental_agreement' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['rental_agreement']['tmp_name'], $filepath . $rental_agreement);
                DB::table('smartcard')->where('id', $request->applied_serviceid)->update([
                    'rental_agreement'         => $rental_agreement,
                ]);
            }
            if ($request->electricity_bill_receipt != null) {
                $electricity_bill_receipt = uniqid().'.'.$request->file('electricity_bill_receipt')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'electricity_bill_receipt' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['electricity_bill_receipt']['tmp_name'], $filepath . $electricity_bill_receipt);
                DB::table('smartcard')->where('id', $request->applied_serviceid)->update([
                    'electricity_bill_receipt'         => $electricity_bill_receipt,
                ]);
            }
            if ($request->patta != null) {
                $patta = uniqid().'.'.$request->file('patta')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'patta' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['patta']['tmp_name'], $filepath . $patta);
                DB::table('smartcard')->where('id', $request->applied_serviceid)->update([
                    'patta'         => $patta,
                ]);
            }
            if ($request->gas_cylinder_receipt != null) {
                $gas_cylinder_receipt = uniqid().'.'.$request->file('gas_cylinder_receipt')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR. 'gas_cylinder_receipt' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['gas_cylinder_receipt']['tmp_name'], $filepath . $gas_cylinder_receipt);
                DB::table('smartcard')->where('id', $request->applied_serviceid)->update([
                    'gas_cylinder_receipt'         => $gas_cylinder_receipt,
                ]);
            }
        }elseif( $serviceid == 228 ){
                DB::table( 'smartcard' )->where( 'id', $request->applied_serviceid )->update( [
                'service_id'                => $request ->serviceid,
                'dist_id'                   => $request->dist_id,
                'taluk_id'                  => $request->taluk_id,
                'member'                    => $request->member,
                'status'                    => 'Pending',
                'applied_date'              => date("Y-m-d"),
                'created_at'                => date("Y-m-d"),
            ] );
            if ($request->aadhaar != null) {
                $aadhaarimg = uniqid().'.'.$request->file('aadhaar')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar']['tmp_name'], $filepath . $aadhaarimg);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'aadhaar' => $aadhaarimg,
                ]);
            }
            if ($request->aadhaar2 != null) {
                $aadhaarimg2 = uniqid().'.'.$request->file('aadhaar2')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar2' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar2']['tmp_name'], $filepath . $aadhaarimg2);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'aadhaar2' => $aadhaarimg2,
                ]);
            }
            if ($request->aadhaar3 != null) {
                $aadhaarimg3 = uniqid().'.'.$request->file('aadhaar3')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar3' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar3']['tmp_name'], $filepath . $aadhaarimg3);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'aadhaar3' => $aadhaarimg3,
                ]);
            }
            if ($request->aadhaar4 != null) {
                $aadhaarimg4 = uniqid().'.'.$request->file('aadhaar4')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar4' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar4']['tmp_name'], $filepath . $aadhaarimg4);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'aadhaar4' => $aadhaarimg4,
                ]);
            }
            if ($request->aadhaar5 != null) {
                $aadhaarimg5 = uniqid().'.'.$request->file('aadhaar5')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar5' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar5']['tmp_name'], $filepath . $aadhaarimg5);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'aadhaar5' => $aadhaarimg5,
                ]);
            }
            if ($request->smart_card != null) {
                $smart_card = uniqid().'.'.$request->file('smart_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smart_card);
                DB::table('smartcard')->where( 'id', $request->applied_serviceid )->update( [
                    'smart_card' => $smart_card,
                ]);
            }

        }

        DB::table( 'smartcard' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
        ] );
    }

    return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}

public function smartcard_nametransfer_update(Request $request){
    $apply_user_id = 0;
    if ($request->distributor_id == 0 && $request->retailer_id == 0) {
        $apply_user_id = $request->user_id;
    }
    elseif($request->retailer_id == 0){
        $apply_user_id = $request->distributor_id;
    }elseif($request->distributor_id == 0){
        $apply_user_id = $request->retailer_id;
    }
    if($apply_user_id != Auth::user()->id){
        $status = $request->status;
        if($status == "Resubmit"){
            DB::table( 'smartcard' )->where('id', $request->applied_serviceid)->update( [
                'remarks'  => $request->remarks,
                'status'  => $status,
            ] );
        }elseif($status == "Processing"){
            if ( $request->acknowledgement != null ) {
                $acknowledgement = uniqid().'.'.$request->file( 'acknowledgement' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'acknowledgement' . DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'acknowledgement' ][ 'tmp_name' ], $filepath . $acknowledgement );
                DB::table( 'smartcard' )->where( 'id', $request->applied_serviceid )->update( [
                    'acknowledgement' => $acknowledgement,
                ] );
            }
            DB::table( 'smartcard' )->where( 'id', $request->applied_serviceid )->update( [
                'status' => $status,
                'application_no' => $request->application_no,
                'selects' => $request->selects,
            ] );
        }elseif($status == "Approved"){
            if ( $request->certificate != null ) {
                $certificate = uniqid().'.'.$request->file( 'certificate' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'certificate'. DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'certificate' ][ 'tmp_name' ], $filepath . $certificate );
                DB::table( 'smartcard' )->where( 'id', $request->applied_serviceid )->update( [
                    'certificate' => $certificate,
                    'status' => $status,
                    'completed_date' => date("Y-m-d"),
                ] );
            }
            DB::table( 'smartcard' )->where( 'id', $request->applied_serviceid )->update( [
                'status' => $status,
                'application' => $request->application,
                'lects' => $request->lects,
            ] );
        }elseif($status == "Rejected"){
            $serviceid = $request->serviceid;
            $getservice_payment = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
            $getusers = DB::table( 'users' )->where('id',$apply_user_id)->first();
            $usertype = 0;
            if($getusers){
                $usertype = $getusers->user_type_id;
            }
            $payment = 0;
            if($getservice_payment){
                if($usertype == 3){
                  $payment = $getservice_payment->distributor_amount;
              }elseif($usertype == 4){
                  $payment = $getservice_payment->retailer_amount;
              }elseif($usertype == 5){
                  $payment = $getservice_payment->customer_amount;
              }
          }

          $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
          $servicename = "";
          if($getservicename){
            $servicename = $getservicename->service_name;
        }
        $date = date( 'Y-m-d' );
        $time = date( 'H:i:s' );
        $service_status = 'Out Payment';
        $ad_info = "Service Refund For". ' ' .$servicename;

        $getwallet = DB::table( 'users' )->select('wallet')->where('id',2)->first();
        $balance = 0;
        if($getwallet){
            $balance = $getwallet->wallet;
        }
        $getuserswallet = DB::table( 'users' )->select('wallet')->where('id',$apply_user_id)->first();
        $balance1 = 0;
        if($getuserswallet){
            $balance1 = $getuserswallet->wallet;
        }
        $newbalance = $balance - $payment;
        $newbalance1 = $balance1 + $payment;

        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$apply_user_id','2','$apply_user_id','$payment','$ad_info', '$service_status','$time','$date','$apply_user_id','$newbalance')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet - $payment where id = 2";
        DB::update( DB::raw( $sql ) );
        $service_status = 'IN Payment';
        $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$apply_user_id','$apply_user_id','2','$payment','$ad_info', '$service_status','$time','$date','$apply_user_id','$newbalance1')";
        DB::insert( DB::raw( $sql ) );
        $sql = "update users set wallet = wallet + $payment where id = $apply_user_id";
        DB::update( DB::raw( $sql ) );

        DB::table( 'smartcard' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
            'remarks'  => $request->remarks,

        ] );

    }
    }else{
         $status = "Pending";
        $serviceid = $request->serviceid;
          if($serviceid == 221 || $serviceid == 222 || $serviceid == 227 || $serviceid == 228 || $serviceid == 229 || $serviceid == 230 || $serviceid == 231 || $serviceid == 232 || $serviceid == 235){
            DB::table('smartcard')->where('id', $request->applied_serviceid)->update([
                'service_id'   => $request ->serviceid,
                'amount'       => $request->amount,
                'dist_id'      => $request->dist_id,
                'taluk_id'     => $request->taluk_id,
                'dob'          => $request->dob,
                'relationship' => $request->relationship,
                'name_tamil'   => $request->name_tamil,
                'name_english' => $request->name_english,
                'status'       => 'Pending',
                'applied_date' => date("Y-m-d"),
                'created_at'   => date("Y-m-d"),
            ]);
            if ($request->aadhaar_card != null) {
                $aadhaar_card = uniqid().'.'.$request->file('aadhaar_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'aadhaar_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['aadhaar_card']['tmp_name'], $filepath . $aadhaar_card);
                DB::table('smartcard')->where('id', $request->applied_serviceid)->update([
                    'aadhaar_card'         => $aadhaar_card,
                ]);
            }
            if ($request->smart_card != null) {
                $smart_card = uniqid().'.'.$request->file('smart_card')->extension();
                $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'smart_card' . DIRECTORY_SEPARATOR);
                move_uploaded_file($_FILES['smart_card']['tmp_name'], $filepath . $smart_card);
                DB::table('smartcard')->where('id', $request->applied_serviceid)->update([
                    'smart_card'         => $smart_card,
                ]);
            }

    $getpermission = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
    $coordinator_permission = 0;
    if($getpermission){
        $coordinator_permission = $getpermission->coordinator_permission;
    }
    //echo$coordinator_permission;die;
    if($coordinator_permission == 1){
     $getdata = DB::table( 'smartcard' )->where('id',$request->applied_serviceid)->first();
     if($getdata){
     $aadhaar_card = $getdata->aadhaar_card;
     $smart_card = $getdata->smart_card;
     $service_id = $getdata->service_id;
     $rowid = $getdata->id;
     $status = $getdata->status;
     $dob = $getdata->dob;
     $dist_id = $getdata->dist_id;
     $taluk_id = $getdata->taluk_id;
     $relationship = $getdata->relationship;
     $name_tamil = $getdata->name_tamil;
     $name_english = $getdata->name_english;
     $url = url('/');
     $aadhaar_url = $url.'/upload/services/aadhaar_card/'.$aadhaar_card;
     $smartcard_url = $url.'/upload/services/smart_card/'.$smart_card;
     $API_KEY = env( 'API_KEY', '' );
     $RAMJIPAY_URL = env( 'RAMJIPAY_URL', '' );
     $WEBSITE_INDEX = env( 'WEBSITE_INDEX', '' );

     $ch = curl_init();
    if($serviceid == 221){
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=219&rowid=$rowid&status=$status&smartcard_file=$smartcard_url&dist_id=$dist_id&taluk_id=$taluk_id&relationship=$relationship&name_tamil=$name_tamil&name_english=$name_english&dob=$dob";
    }elseif($serviceid == 222){
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=224&rowid=$rowid&status=$status&smartcard_file=$smartcard_url";
    }elseif($serviceid == 227){
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=225&rowid=$rowid&status=$status&smartcard_file=$smartcard_url&name_tamil=$name_tamil&name_english=$name_english";
    }elseif($serviceid == 228){
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=234&rowid=$rowid&status=$status&smartcard_file=$smartcard_url&dob=$dob";
    }elseif($serviceid == 229){
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=235&rowid=$rowid&status=$status&smartcard_file=$smartcard_url&relationship=$relationship";
    }elseif($serviceid == 230){
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=236&rowid=$rowid&status=$status&smartcard_file=$smartcard_url&name_tamil=$name_tamil&name_english=$name_english&dob=$dob";
    }elseif($serviceid == 231){
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=237&rowid=$rowid&status=$status&smartcard_file=$smartcard_url&dist_id=$dist_id&taluk_id=$taluk_id&relationship=$relationship&name_tamil=$name_tamil&name_english=$name_english&dob=$dob";
    }elseif($serviceid == 232){
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=238&rowid=$rowid&status=$status&smartcard_file=$smartcard_url&relationship=$relationship&name_tamil=$name_tamil&name_english=$name_english";
    }elseif($serviceid == 235){
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&service_id=245&rowid=$rowid&status=$status&smartcard_file=$smartcard_url&relationship=$relationship&dob=$dob";
    }else{
     $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&aadhaar_file=$aadhaar_url&smartcard_file=$smartcard_url&service_id=$service_id&rowid=$rowid&status=$status&dist_id=$dist_id&taluk_id=$taluk_id&relationship=$relationship&name_tamil=$name_tamil&name_english=$name_english&dob=$dob";
    }
        $url1 = $RAMJIPAY_URL.'/api/update_smartcard_api';
        //echo $url1;die;

        curl_setopt( $ch, CURLOPT_URL, $url1 );
        curl_setopt( $ch, CURLOPT_POST, 1 );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_data );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $server_output = curl_exec( $ch );
        curl_close( $ch );
        $resdata = json_decode($server_output, true);
       //dd($resdata);
    }
}
        }

        DB::table( 'smartcard' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
        ] );
    }

    return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}

public function tailorshop_update(Request $request){
    $apply_user_id = 0;
    if ($request->distributor_id == 0 && $request->retailer_id == 0) {
        $apply_user_id = $request->user_id;
    }
    elseif($request->retailer_id == 0){
        $apply_user_id = $request->distributor_id;
    }elseif($request->distributor_id == 0){
        $apply_user_id = $request->retailer_id;
    }
    //echo Auth::user()->id;die;
    if($apply_user_id != Auth::user()->id){
       $status = $request->status;
       if($status == "Resubmit"){
           DB::table( 'tailor' )->where('id', $request->applied_serviceid)->update( [
               'remarks'  => $request->remarks,
               'status'  => $status,
           ] );
       }elseif($status == "Processing"){
           if ( $request->acknowledgement != null ) {
               $acknowledgement = uniqid().'.'.$request->file( 'acknowledgement' )->extension();
               $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'acknowledgement' . DIRECTORY_SEPARATOR);
               move_uploaded_file( $_FILES[ 'acknowledgement' ][ 'tmp_name' ], $filepath . $acknowledgement );
               DB::table( 'tailor' )->where( 'id', $request->applied_serviceid )->update( [
                   'acknowledgement' => $acknowledgement,
                   'status' => $status,
                   'application_no' => $request->application_no,
               ] );
           }
           DB::table( 'tailor' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
            'application_no' => $request->application_no,
            'selects' => $request->selects,
        ] );
       }elseif($status == "Approved"){
           if ( $request->certificate != null ) {
               $certificate = uniqid().'.'.$request->file( 'certificate' )->extension();
               $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'certificate'. DIRECTORY_SEPARATOR);
               move_uploaded_file( $_FILES[ 'certificate' ][ 'tmp_name' ], $filepath . $certificate );
               DB::table( 'tailor' )->where( 'id', $request->applied_serviceid )->update( [
                   'certificate' => $certificate,
                   'status' => $status,
                   'completed_date' => date("Y-m-d"),
               ] );
           }
           DB::table( 'tailor' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
            'application' => $request->application,
            'lects' => $request->lects,
        ] );
       }elseif($status == "Rejected"){
        $serviceid = $request->serviceid;
        $getservice_payment = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
        $getusers = DB::table( 'users' )->where('id',$apply_user_id)->first();
        $usertype = 0;
        if($getusers){
            $usertype = $getusers->user_type_id;
        }
        $payment = 0;
        if($getservice_payment){
            if($usertype == 3){
              $payment = $getservice_payment->distributor_amount;
          }elseif($usertype == 4){
              $payment = $getservice_payment->retailer_amount;
          }elseif($usertype == 5){
              $payment = $getservice_payment->customer_amount;
          }
      }

      $getservicename = DB::table( 'services' )->select('service_name')->where('id',$serviceid)->first();
      $servicename = "";
      if($getservicename){
        $servicename = $getservicename->service_name;
    }
    $date = date( 'Y-m-d' );
    $time = date( 'H:i:s' );
    $service_status = 'Out Payment';
    $ad_info = "Service Refund For". ' ' .$servicename;

    $getwallet = DB::table( 'users' )->select('wallet')->where('id',2)->first();
    $balance = 0;
    if($getwallet){
        $balance = $getwallet->wallet;
    }
    $getuserswallet = DB::table( 'users' )->select('wallet')->where('id',$apply_user_id)->first();
    $balance1 = 0;
    if($getuserswallet){
        $balance1 = $getuserswallet->wallet;
    }
    $newbalance = $balance - $payment;
    $newbalance1 = $balance1 + $payment;

    $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$apply_user_id','2','$apply_user_id','$payment','$ad_info', '$service_status','$time','$date','$apply_user_id','$newbalance')";
    DB::insert( DB::raw( $sql ) );
    $sql = "update users set wallet = wallet - $payment where id = 2";
    DB::update( DB::raw( $sql ) );
    $service_status = 'IN Payment';
    $sql = "insert into payment (log_id,from_id,to_id,amount,ad_info,service_status,time,paydate,pay_id,newbalance) values ('$apply_user_id','$apply_user_id','2','$payment','$ad_info', '$service_status','$time','$date','$apply_user_id','$newbalance1')";
    DB::insert( DB::raw( $sql ) );
    $sql = "update users set wallet = wallet + $payment where id = $apply_user_id";
    DB::update( DB::raw( $sql ) );

    DB::table( 'tailor' )->where( 'id', $request->applied_serviceid )->update( [
        'status' => $status,
        'remarks'  => $request->remarks,
    ] );
}
}else{
   $status = "Pending";
   $serviceid = $request->serviceid;
   if ($request->pan_card != null) {
       $pan_card = uniqid().'.'.$request->file('pan_card')->extension();
       $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'pan_card' . DIRECTORY_SEPARATOR);
       move_uploaded_file($_FILES['pan_card']['tmp_name'], $filepath . $pan_card);
       DB::table( 'tailor' )->where( 'id', $request->applied_serviceid )->update( [
          'pan_card'             => $pan_card,
      ] );
   }
   if($serviceid == 152 || $serviceid == 153 || $serviceid == 154){
       DB::table('tailor')->where('id', $request->applied_serviceid)->update([
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

       DB::table( 'tailor' )->where( 'id', $request->applied_serviceid )->update( [
           'status' => $status,
       ] );

       if ($request->photo != null) {
        $photo = uniqid().'.'.$request->file('photo')->extension();
        $filepath = public_path('upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR);
        move_uploaded_file($_FILES['photo']['tmp_name'], $filepath . $photo);

    DB::table('tailor')->where( 'id', $request->applied_serviceid )->update( [
        'photo' => $photo,
    ]);
}




    $getpermission = DB::table( 'service_payment' )->where('service_id',$serviceid)->first();
    $coordinator_permission = 0;
    if($getpermission){
        $coordinator_permission = $getpermission->coordinator_permission;
    }
    //echo$coordinator_permission;die;
    if($coordinator_permission == 1){
     $getdata = DB::table( 'tailor' )->where('id',$request->applied_serviceid)->first();
     if($getdata){
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
     $father_or_hus_name = $getdata->father_or_hus_name;
     $pincode = $getdata->pincode;
     $url = url('/');
     $photo_url = $url.'/upload/services/photo/'.$request->photo;
     $API_KEY = env( 'API_KEY', '' );
     $RAMJIPAY_URL = env( 'RAMJIPAY_URL', '' );
     $WEBSITE_INDEX = env( 'WEBSITE_INDEX', '' );

     $ch = curl_init();
      $post_data = "key=$API_KEY&index=$WEBSITE_INDEX&photo_file=$photo_url&service_id=$service_id&rowid=$rowid&status=$status&name=$name&dist_id=$dist_id&taluk_id=$taluk_id&panchayath_id=$panchayath_id&aadhaar_no=$aadhaar_no&door_no=$door_no&significant=$significant&postal_area=$postal_area&street_name=$street_name&course_name=$course_name&father_or_hus_name=$father_or_hus_name&pincode=$pincode";
        //dd($post_data);
        $url1 = $RAMJIPAY_URL.'/api/update_tailor_api';
        //echo $url1;die;

        curl_setopt( $ch, CURLOPT_URL, $url1 );
        curl_setopt( $ch, CURLOPT_POST, 1 );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_data );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $server_output = curl_exec( $ch );
        curl_close( $ch );
        $resdata = json_decode($server_output, true);
       //dd($resdata);
    }
}

}

}
return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}



}
