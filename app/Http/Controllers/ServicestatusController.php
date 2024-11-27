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
        $this->middleware( 'auth' );
    }

    public function appliedservice($status)
    {
       if(Auth::user()->user_type_id == 1 || Auth::user()->user_type_id == 2){

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

        $pancard = DB::table('pancard')->select('services.service_name', 'pancard.*')
        ->Join('services', 'services.id', '=', 'pancard.service_id')
        ->where('pancard.status',$status)
        ->orderBy('pancard.id', 'Desc')->get();

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

        $passport = DB::table('passport')->select('services.service_name', 'passport.*')
        ->Join('services', 'services.id', '=', 'passport.service_id')
        ->where('passport.status',$status)
        ->orderBy('passport.id', 'Desc')->get();

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
        $service = $service->merge($pancard);
        $service = $service->merge($tailor);
        $service = $service->merge($pmkissan);
        $service = $service->merge($birth_certificate);
        $service = $service->merge($medicalscheme);
        $service = $service->merge($dharsan);
        $service = $service->merge($passport);

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

            $pancard = DB::table('pancard')->select('services.service_name', 'pancard.*')
            ->Join('services', 'services.id', '=', 'pancard.service_id')
            ->where('pancard.status',$status)
            ->where('pancard.distributor_id',Auth::user()->id)
            ->orderBy('pancard.id', 'Desc')->get();

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

            $passport = DB::table('passport')->select('services.service_name', 'users.name','passport.*')
            ->Join('services', 'services.id', '=', 'passport.service_id')
            ->Join('users', 'users.id', '=', 'passport.user_id')
            ->where('passport.status',$status)
            ->where('passport.retailer_id',Auth::user()->id)
            ->orderBy('passport.id', 'Desc')->get();

            $service = $service->merge($tnegaservices);
            $service = $service->merge($smartcard);
            $service = $service->merge($itr);
            $service = $service->merge($gst);
            $service = $service->merge($tec_exam);
            $service = $service->merge($can_edit);
            $service = $service->merge($aadhaarcard);
            $service = $service->merge($voterid);
            $service = $service->merge($pancard);
            $service = $service->merge($bond);
            $service = $service->merge($fssai);
            $service = $service->merge($covid);
            $service = $service->merge($license);
            $service = $service->merge($nalavariyam);
            $service = $service->merge($passport);

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

            $pancard = DB::table('pancard')->select('services.service_name', 'pancard.*')
            ->Join('services', 'services.id', '=', 'pancard.service_id')
            ->where('pancard.status',$status)
            ->where('pancard.retailer_id',Auth::user()->id)
            ->orderBy('pancard.id', 'Desc')->get();

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

            $passport = DB::table('passport')->select('services.service_name', 'users.name','passport.*')
            ->Join('services', 'services.id', '=', 'passport.service_id')
            ->Join('users', 'users.id', '=', 'passport.user_id')
            ->where('passport.status',$status)
            ->where('passport.retailer_id',Auth::user()->id)
            ->orderBy('passport.id', 'Desc')->get();

            $service = $service->merge($tnegaservices);
            $service = $service->merge($smartcard);
            $service = $service->merge($itr);
            $service = $service->merge($gst);
            $service = $service->merge($tec_exam);
            $service = $service->merge($can_edit);
            $service = $service->merge($aadhaarcard);
            $service = $service->merge($voterid);
            $service = $service->merge($pancard);
            $service = $service->merge($bond);
            $service = $service->merge($fssai);
            $service = $service->merge($covid);
            $service = $service->merge($license);
            $service = $service->merge($nalavariyam);
            $service = $service->merge($passport);

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

            $pancard = DB::table('pancard')->select('services.service_name', 'pancard.*')
            ->Join('services', 'services.id', '=', 'pancard.service_id')
            ->where('pancard.status',$status)
            ->where('pancard.user_id',Auth::user()->id)
            ->orderBy('pancard.id', 'Desc')->get();

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

           $passport = DB::table('passport')->select('services.service_name', 'users.name','passport.*')
           ->Join('services', 'services.id', '=', 'passport.service_id')
           ->Join('users', 'users.id', '=', 'passport.user_id')
           ->where('passport.status',$status)
           ->where('passport.user_id',Auth::user()->id)
           ->orderBy('passport.id', 'Desc')->get();

           $service = $service->merge($tnegaservices);
           $service = $service->merge($smartcard);
           $service = $service->merge($itr);
           $service = $service->merge($gst);
           $service = $service->merge($tec_exam);
           $service = $service->merge($can_edit);
           $service = $service->merge($aadhaarcard);
           $service = $service->merge($voterid);
           $service = $service->merge($pancard);
           $service = $service->merge($bond);
           $service = $service->merge($fssai);
           $service = $service->merge($covid);
           $service = $service->merge($license);
           $service = $service->merge($nalavariyam);
           $service = $service->merge($passport);
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

        } elseif($service_id == 36 || $service_id == 37 || $service_id == 38 || $service_id == 39 || $service_id == 41 || $service_id == 42 || $service_id == 43 || $service_id == 77 || $service_id == 78 || $service_id == 79 || $service_id == 80 || $service_id == 81 || $service_id == 82 || $service_id == 83 || $service_id == 84 ){
            $services = DB::table('smartcard')->where('id',$id)->where('status',$status)->first();

        } elseif($service_id == 56 || $service_id == 58 || $service_id == 74 || $service_id == 158 || $service_id == 159 || $service_id == 160 || $service_id == 161 || $service_id == 162 || $service_id == 163 || $service_id == 72){
            $services = DB::table('aadhaarcard')->where('id',$id)->where('status',$status)->first();

        } elseif($service_id == 60 || $service_id == 62 || $service_id == 63 || $service_id == 64 || $service_id == 65 || $service_id == 66 || $service_id == 67 || $service_id == 121){
            $services = DB::table('can_edit')->where('id',$id)->where('status',$status)->first();

        }elseif($service_id == 69 || $service_id == 71){
            $services = DB::table('pancard')->where('id',$id)->where('status',$status)->first();

        } elseif($service_id == 100 ){
            $services = DB::table('bond')->where('id',$id)->where('status',$status)->first();

        }elseif($service_id == 113 || $service_id == 120 || $service_id == 164){
            $services = DB::table('voterid')->where('id',$id)->where('status',$status)->first();

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

        }else{
            $services = DB::table('tnega_services')->where('id',$id)->where('status',$status)->first();
        }

        if($services){
            $serviceid = $services->service_id;
            $user_id = $services->user_id;
        }
        if($service_id == 181){
            $votercorrection_services = DB::table('voterid')->where('id',$id)->where('status',$status)->get();
            $votercorrection_services = json_decode( json_encode( $votercorrection_services ), true );
            foreach ( $votercorrection_services as $key => $ser ) {
            $votercorrection_services[ $key ][ 'details' ] = array();
            $ser_id = $ser[ 'id' ];
            $sql = "select * from voterid_details where service_id=$ser_id order by id Asc";
            $result = DB::select( $sql );
            $votercorrection_services[ $key ][ 'details' ] = $result;
        }
            $votercorrection_services = json_decode( json_encode( $votercorrection_services ));
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
        if($service_id == 2 || $service_id == 3 || $service_id == 4 || $service_id == 11 || $service_id == 14 || $service_id == 20 ){
            return view( 'servicestatus.tnegastatusupdate1',compact('id','services','servicename','customers','serviceid','amount','districts') );
        }

        elseif($service_id == 22 || $service_id == 23 || $service_id == 24 || $service_id == 25 || $service_id == 26){

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
        } elseif($service_id == 60 || $service_id == 62 || $service_id == 63 || $service_id == 64 || $service_id == 65 || $service_id == 66 || $service_id == 67 || $service_id  == 121 ){
            return view('servicestatus.caneditupdate',compact('id','services','servicename','customers','serviceid','amount','districts') );

        } elseif($service_id == 69 || $service_id == 71 ){
            return view('servicestatus.pancardstatusupdate',compact('id','services','servicename','customers','serviceid','amount','districts') );

        } elseif($service_id == 72 ){
            return view('servicestatus.findaadhaar_numberupdate',compact('id','services','servicename','customers','serviceid','amount','districts') );

        } elseif($service_id == 113 || $service_id == 120 || $service_id == 164){
            return view('servicestatus.voteridupdate',compact('id','services','servicename','customers','serviceid','amount','districts') );

        }elseif($service_id == 181){
            return view('servicestatus.voteridcorrectionupdate',compact('id','votercorrection_services','servicename','customers','serviceid','amount','districts') );

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

        }  elseif( $service_id == 152 || $service_id == 153 || $service_id == 154){
            return view('servicestatus.tailorshop_statusupdate',compact('id','services','servicename','customers','serviceid','amount','districts') );

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
        }

}

public function submit_statusupdate_tnegaservices1(Request $request){
    $apply_user_id = 0;
    if($request->retailer_id == 0){
        $apply_user_id = $request->distributor_id;
    }elseif($request->distributor_id == 0){
        $apply_user_id = $request->retailer_id;
    }
    if($request->user_id != Auth::user()->id && $apply_user_id != Auth::user()->id){
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
                    'status' => $status,
                    'application_no' => $request->application_no,
                ] );
            }
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
        ] );
    }

    return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}

public function submit_statusupdate_tnegaservices2(Request $request){
    $apply_user_id = 0;
    if($request->retailer_id == 0){
        $apply_user_id = $request->distributor_id;
    }elseif($request->distributor_id == 0){
        $apply_user_id = $request->retailer_id;
    }
    if($request->user_id != Auth::user()->id && $apply_user_id != Auth::user()->id){
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
                    'status' => $status,
                    'application_no' => $request->application_no,
                ] );
            }
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
        ] );
    }

    return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}

public function submit_statusupdate_tnegaservices3(Request $request){
    $apply_user_id = 0;
    if($request->retailer_id == 0){
        $apply_user_id = $request->distributor_id;
    }elseif($request->distributor_id == 0){
        $apply_user_id = $request->retailer_id;
    }
    if($request->user_id != Auth::user()->id && $apply_user_id != Auth::user()->id){
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
                    'status' => $status,
                    'application_no' => $request->application_no,
                ] );
            }
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
    }

    return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}
public function submit_statusupdate_tnegaservices4(Request $request){
    $apply_user_id = 0;
    if($request->retailer_id == 0){
        $apply_user_id = $request->distributor_id;
    }elseif($request->distributor_id == 0){
        $apply_user_id = $request->retailer_id;
    }
    if($request->user_id != Auth::user()->id && $apply_user_id != Auth::user()->id){
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
                    'status' => $status,
                    'application_no' => $request->application_no,
                ] );
            }
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


    }

    return redirect("appliedservice/$status")->With("success","Application submitted Succesfully");
}

public function submit_statusupdate_tnegaservices5(Request $request){
    $apply_user_id = 0;
    if($request->retailer_id == 0){
        $apply_user_id = $request->distributor_id;
    }elseif($request->distributor_id == 0){
        $apply_user_id = $request->retailer_id;
    }
    if($request->user_id != Auth::user()->id && $apply_user_id != Auth::user()->id){
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
                    'status' => $status,
                    'application_no' => $request->application_no,
                ] );
            }
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
    if($request->user_id != Auth::user()->id && $apply_user_id != Auth::user()->id){
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
    if($request->user_id != Auth::user()->id && $apply_user_id != Auth::user()->id){
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
    if($request->user_id != Auth::user()->id && $apply_user_id != Auth::user()->id){
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
    if($request->user_id != Auth::user()->id && $apply_user_id != Auth::user()->id){
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
    if($request->user_id != Auth::user()->id && $apply_user_id != Auth::user()->id){
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
    if($request->user_id != Auth::user()->id && $apply_user_id != Auth::user()->id){
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
    if($request->user_id != Auth::user()->id && $apply_user_id != Auth::user()->id){
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
    if($request->user_id != Auth::user()->id && $apply_user_id != Auth::user()->id){
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
    if($request->user_id != Auth::user()->id && $apply_user_id != Auth::user()->id){
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
    if($request->user_id != Auth::user()->id && $apply_user_id != Auth::user()->id){
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
    if($request->user_id != Auth::user()->id && $request->retailer_id != Auth::user()->id){
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
    if($request->user_id != Auth::user()->id && $request->retailer_id != Auth::user()->id){
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
                'name'              => $request->name,
                'mobile'            => $request->mobile,
                'relationship'      => $request->relationship,
                'name_tamil'        => $request->name_tamil,
                'name_english'      => $request->name_english,
                'address_tamil'     => $request->address_tamil,
                'address_english'   => $request->address_english,
                'status'            => 'Pending',
                'applied_date'      => date("Y-m-d"),
                'created_at'        => date("Y-m-d"),
            ]);

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
    if($request->user_id != Auth::user()->id && $request->retailer_id != Auth::user()->id){
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
    if($request->retailer_id == 0){
        $apply_user_id = $request->distributor_id;
    }elseif($request->distributor_id == 0){
        $apply_user_id = $request->retailer_id;
    }
    if($request->user_id != Auth::user()->id && $request->retailer_id != Auth::user()->id){
        $status = $request->status;
        if($status == "Resubmit"){
            DB::table( 'can_edit' )->where('id', $request->applied_serviceid)->update( [
                'remarks' => $request->remarks,
                'status'  => $status,
            ] );
        }elseif($status == "Processing"){
            if ( $request->acknowledgement != null ) {
                $acknowledgement = uniqid().'.'.$request->file( 'acknowledgement' )->extension();
                $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR .'acknowledgement' . DIRECTORY_SEPARATOR);
                move_uploaded_file( $_FILES[ 'acknowledgement' ][ 'tmp_name' ], $filepath . $acknowledgement );
                DB::table( 'can_edit' )->where( 'id', $request->applied_serviceid )->update( [
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
                DB::table( 'can_edit' )->where( 'id', $request->applied_serviceid )->update( [
                    'certificate' => $certificate,
                    'status' => $status,
                    'completed_date' => date("Y-m-d"),
                ] );
            }
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
                'name_tamil'                 => $request->name_tamil,
                'name_english'               => $request->name_english,
                'status'                     => 'Pending',
                'applied_date'               => date("Y-m-d"),
                'created_at'                 => date("Y-m-d"),
            ]);

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
                'status'                     => 'Pending',
                'applied_date'               => date("Y-m-d"),
                'created_at'                 => date("Y-m-d"),
            ]);

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

        } elseif($serviceid == 65){

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
                'certificate_name'           => $request->certificate_name,
                'status'                     => 'Pending',
                'applied_date'               => date("Y-m-d"),
                'created_at'                 => date("Y-m-d"),
            ]);

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
                'status'                     => 'Pending',
                'applied_date'               => date("Y-m-d"),
                'created_at'                 => date("Y-m-d"),
            ]);

        }  elseif($serviceid == 67){

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
                'address_tamil'              => $request->address_tamil,
                'address_english'            => $request->address_english,
                'status'                     => 'Pending',
                'applied_date'               => date("Y-m-d"),
                'created_at'                 => date("Y-m-d"),
            ]);
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
    if($request->user_id != Auth::user()->id && $request->retailer_id != Auth::user()->id){
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
    if($request->user_id != Auth::user()->id && $request->retailer_id != Auth::user()->id){
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
        if($serviceid == 113 || $serviceid == 120 || $serviceid == 164 || $serviceid == 181){
        DB::table('voterid')->where('id', $request->applied_serviceid)->update([
            'service_id'        => $request ->serviceid,
            'amount'            => $request->amount,
            'name'              => $request->name,
            'mobile'            => $request->mobile,
            'epic_no'           => $request->epic_no,
            'relationship'      => $request->relationship,
            'status'            => 'Pending',
            'applied_date'      => date("Y-m-d"),
            'created_at'        => date("Y-m-d"),
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
    }
        DB::table( 'voterid' )->where( 'id', $request->applied_serviceid )->update( [
            'status' => $status,
        ] );
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
    if($request->user_id != Auth::user()->id && $request->retailer_id != Auth::user()->id){
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
    if($request->user_id != Auth::user()->id && $request->retailer_id != Auth::user()->id){
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
                'amount'            => $request->amount,
                'shop_name'         => $request->shop_name,
                'mobile'            => $request->mobile,
                'email_id'          => $request->email_id,
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
    if($request->user_id != Auth::user()->id && $apply_user_id != Auth::user()->id){
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
    if($request->user_id != Auth::user()->id && $request->retailer_id != Auth::user()->id){
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
    if($request->user_id != Auth::user()->id && $request->retailer_id != Auth::user()->id){
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
if($request->user_id != Auth::user()->id && $apply_user_id != Auth::user()->id){
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
public function tailorshop_update(Request $request){
$apply_user_id = 0;
if($request->retailer_id == 0){
   $apply_user_id = $request->distributor_id;
}elseif($request->distributor_id == 0){
   $apply_user_id = $request->retailer_id;
}
if($request->user_id != Auth::user()->id && $apply_user_id != Auth::user()->id){
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
}
DB::table('tailor')->where( 'id', $request->applied_serviceid )->update( [
    'photo' => $photo,
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
if($request->user_id != Auth::user()->id && $apply_user_id != Auth::user()->id){
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
if($request->user_id != Auth::user()->id && $apply_user_id != Auth::user()->id){
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
if($request->user_id != Auth::user()->id && $apply_user_id != Auth::user()->id){
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
if($request->user_id != Auth::user()->id && $apply_user_id != Auth::user()->id){
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
if($request->user_id != Auth::user()->id && $apply_user_id != Auth::user()->id){
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

}
