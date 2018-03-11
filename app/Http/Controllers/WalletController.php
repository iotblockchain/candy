<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gregwar\Captcha\CaptchaBuilder;

class WalletController extends Controller
{
    public function index(Request $request)
    {
        return view('wallet');
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
}
