<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class SmsCodeController extends Controller
{
    public function send(Request $request)
    {
        $session = $request->session();

        $true_phrase = $session->get('captcha_phrase');
        $input_phrase = trim($request->input('captcha'));
        $u = trim($request->input('u'));

        $phone = trim($request->input('phone'));

        if (!preg_match('/\d{1,15}/', $phone)) {
            return response("请输入正确的手机号", 400);
        }

        if (!$true_phrase || $true_phrase != $input_phrase) {
            return response("请输入正确的验证码", 400);
        }

        if ($session->get('next_send_ts') > time()) {
            return response("请勿频繁发送验证码", 400);
        }

        mt_srand(microtime(true));
        $code = mt_rand(1000, 9999);

        $code = $input_phrase; // TODO remove

        exec(base_path('w.sh'), $data, $status);

        if ($status !== 0) {
            return response("无法生成钱包", 500);
        }

        list($address, $key) = explode(' ', $data[0]);

        $user = User::firstOrNew(['email' => $phone]);
        $user->password = Hash::make($code);

        if (!$user->id) {
            $user->name = $phone;

            $user->key = $key;
            $user->address = $address;

            $from_user = User::find($u);
            if ($from_user) {
                $user->from = $from_user->id;
            }
        }

        if ($user->save()) {
            return "发送成功";
        }

        return response("系统错误", 500);
    }
}
