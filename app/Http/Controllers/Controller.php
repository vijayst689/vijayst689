<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

   public function restrictIfNotActivated()
{
    // $user = Auth::user();

    // if ($user && $user->user_type_id == 2) {
    //     $today = \Carbon\Carbon::today()->startOfDay();
    //     $paymentDate = $user->payment_date ? \Carbon\Carbon::parse($user->payment_date)->startOfDay() : null;

    //     if ($paymentDate) {
    //         $daysDiff = $today->diffInDays($paymentDate, false); // negative if past

    //         // On or after due date → restrict
    //         if ($daysDiff <= 0) {
    //             return redirect('/serverpayment')->send();
    //         }
    //     }
    // }
}

public function restrictIfSitePaymentDueFromSession()
{
   
}
}
