<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{

    public function Index()
    {
        return view('Frontend.home');
    }
    
    public function About_us()
    {
        return view('Frontend.about_us');
    }

    public function Contact_us()
    {
        return view('Frontend.Contact_us');
    }


}


