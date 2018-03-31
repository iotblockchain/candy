<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gregwar\Captcha\CaptchaBuilder;

class CaptchaController extends Controller
{
    public function get(Request $request)
    {
        mt_srand(microtime(true));
        $builder = new CaptchaBuilder(mt_rand(1000, 9999));
        $builder->setDistortion(1);
        $builder->build(100, 36);

        $request->session()->put('captcha_phrase', $builder->getPhrase());

        return response($builder->get())->header('Content-Type', 'image/jpeg');
    }
}
