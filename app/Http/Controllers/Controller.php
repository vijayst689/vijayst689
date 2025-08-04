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
            $today = now()->format('Y-m-d');
            $paymentDate = $user->payment_date;
            if (
                $today >= $paymentDate
            ) {
                // Redirect to activation page
                redirect('/serverpayment')->send();
                exit;
            }
        }
    }
}
