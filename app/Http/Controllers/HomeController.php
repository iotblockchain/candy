<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        return view('home', [
            'url' => route('login').'?u='.$user->id,
            'qr_url' => route('qr'),
            'invite_count' => $user->invite_count,
            'level' => $user->vip,
            'bonus' => $user->bonus,
            'sent_bonus' => $user->sent_bonus,
        ]);
    }
}
