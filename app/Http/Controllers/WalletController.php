<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gregwar\Captcha\CaptchaBuilder;
use Auth;

class WalletController extends Controller
{
    public function index(Request $request)
    {
        return view('wallet');
    }

    public function updateAddress(Request $request)
    {
        $address = strtolower(trim($request->input('address')));

        if (!$address) {
            return view('wallet', ['message' => '钱包地址错误']);
        }

        if ($address[0] == '0' && $address[1] == 'x') {
            $address = substr($address, 2);
        }

        $address_been_used = \App\User::query()
            ->where('address', $address)
            ->count() > 0;

        if ($address_been_used) {
            return view('wallet', ['message' => '钱包地址已经被绑定']);
        }

        $user = Auth::user();
        $user->address = $address;
        $user->key = '';
        $user->save();

        return view('wallet', ['message' => '绑定成功']);
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
}
