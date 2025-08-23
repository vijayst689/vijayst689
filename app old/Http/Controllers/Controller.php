<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

     public function restrictIfNotActivated()
{
    $user = Auth::user();

    if ($user && $user->user_type_id == 2) {
        $today = now();
        $paymentDate = $user->payment_date ? \Carbon\Carbon::parse($user->payment_date) : null;

        if ($paymentDate) {
            $daysDiff = $today->diffInDays($paymentDate, false); // negative if past

            if ($daysDiff < 0 || $daysDiff === 0) {
                // On or after due date → restrict
                redirect('/serverpayment')->send();
                exit;
            }
            // else if $daysDiff <= 5 → allow dashboard but payment button will show in blade
        }
    }
}
}
