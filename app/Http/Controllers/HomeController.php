<?php

namespace App\Http\Controllers;

use App\Models\Otp;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index () {

        return view('layers.home');
    }
}
