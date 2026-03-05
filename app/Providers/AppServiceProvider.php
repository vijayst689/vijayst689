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
    //     $this->utilityservice = DB::table('utility_services')->where('status', '=', 'Active' )->orderBy( 'id' , 'Asc' )->get();
    //     view()->composer('layouts.sidebar', function($view) {
    //        $view->with(['utilityservice' => $this->utilityservice]);
    //    });
    //    $this->canservice = DB::table('canservice')->where('status', '=', 'Active' )->orderBy( 'id' , 'Asc' )->get();
    //    view()->composer('layouts.sidebar', function($view) {
    //       $view->with(['canservice' => $this->canservice]);
    //   });
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
                $this->activation = DB::table('users')->where('id', $user->id)->get();
                $this->qrlabel = DB::table( 'users' )->where( 'id', 2 )->orderBy( 'id' , 'Asc' )->first();
                $view->with(['activation' => $this->activation]);
                $view->with(['qrlabel' => $this->qrlabel]);

                $showPopup = false;
                $daysLeft  = null;
                $siteshowPopup = false;
                $sitedaysLeft  = null;

                if ($user->user_type_id == 2 && $user->payment_date) {
                    $activationDate = \Carbon\Carbon::parse($user->payment_date)->startOfDay();
                    $today          = \Carbon\Carbon::today()->startOfDay();

                    // Difference in days (negative if payment_date is in past)
                    $daysLeft = $today->diffInDays($activationDate, false);

                    // Show popup only if payment date is in the future (1–5 days left)
                    if ($daysLeft > 0 && $daysLeft <= 5) {
                        $showPopup = true;
                    }
                }

                $view->with([
                    'showPopup' => $showPopup,
                    'daysLeft'  => $daysLeft
                ]);

                // if we have a selected unpaid payment in session → use it

           $unpaidPayment = DB::table('sitepayment')
    ->where('payment_status', 'UNPAID')
    ->orderBy('payment_date', 'asc') // oldest first
    ->first();

        // if not found or already paid → pick new one

                if ($user->user_type_id == 2 && $unpaidPayment && $unpaidPayment->payment_date) {
                    $paymentDate = Carbon::parse($unpaidPayment->payment_date)->startOfDay();
                    $today       = Carbon::today()->startOfDay();

                    // Days difference (negative if overdue, positive if future)
                    $sitedaysLeft = $today->diffInDays($paymentDate, false);
                    // Show popup if exactly 1 day before
                    if ($sitedaysLeft === 1) {
                        $siteshowPopup = true;
                    }
                }

                $view->with([
                    'siteshowPopup' => $siteshowPopup,
                    'sitedaysLeft'  => $sitedaysLeft,
                    'unpaidPayment' => $unpaidPayment,
                ]);
            }
        });
    }
}
