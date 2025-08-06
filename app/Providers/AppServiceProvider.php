<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    // public function boot()
    // {
    //     Schema::defaultStringLength(191);
    //     $this->services = DB::table('services')->where('status', '=', 'Active' )->where('parent_id',0 )->where('id','!=',6)->orderBy( 'id' , 'Asc' )->get();
    //      view()->composer('layouts.sidebar', function($view) {
    //         $view->with(['services' => $this->services]);
    //     });
    //     $this->smartservice = DB::table('services')->where('status', '=', 'Active' )->where('id', 35 )->orderBy( 'id' , 'Asc' )->get();
    //     view()->composer('layouts.sidebar', function($view) {
    //        $view->with(['smartservice' => $this->smartservice]);
    //    });
    //    $this->utilityservice = DB::table('utility_services')->where('status', '=', 'Active' )->orderBy( 'id' , 'Asc' )->get();
    //     view()->composer('layouts.sidebar', function($view) {
    //        $view->with(['utilityservice' => $this->utilityservice]);
    //    });
    // }

    public function boot()
{
    Schema::defaultStringLength(191);

    // Sidebar composers
    $this->services = DB::table('services')->where('status', 'Active')->where('parent_id', 0)->where('id', '!=', 6)->orderBy('id', 'Asc')->get();
    $this->smartservice = DB::table('services')->where('status', 'Active')->where('id', 35)->orderBy('id', 'Asc')->get();
    $this->utilityservice = DB::table('utility_services')->where('status', 'Active')->orderBy('id', 'Asc')->get();

    view()->composer('layouts.sidebar', function($view) {
        $view->with([
            'services' => $this->services,
            'smartservice' => $this->smartservice,
            'utilityservice' => $this->utilityservice
        ]);
    });

    // Header composer for activation popup
    view()->composer('layouts.header', function ($view) {
        if (Auth::check()) {
            $user = Auth::user();
            $this->activation = DB::table( 'users' )->where( 'id',$user->id)->get();
            $view->with(['activation' => $this->activation]); // if you're using it elsewhere

            $showPopup = false;
            $daysLeft = null;

            if ($user->user_type_id == 2 && $user->payment_date) {
                $activationDate = Carbon::parse($user->payment_date);
                $today = Carbon::today();
                $daysLeft = $today->diffInDays($activationDate, false);

                if ($daysLeft >= 0 && $daysLeft <= 5) {
                    $showPopup = true;
                }
            }
            $view->with([
                'showPopup' => $showPopup,
                'daysLeft' => $daysLeft
            ]);
        }
    });
}
}
