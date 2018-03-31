@extends('layouts.app')

@section('style')
<link href="{{ asset('css/intlTelInput.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container login">
    <div class="panel">
        <div class="panel-heading text-center">
            <img class="login-logo" src="{{asset('img/logo.png')}}" alt="logo">
        </div>

        <div class="panel-body">
            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <div class="col-md-12 phone-box" id="phone-box">
                        <input type="tel" id="phone" placeholder="手机号" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <img id="captcha" style="float:right;" src="{{route('captcha')}}">
                        <input id="captcha-phrase" style="width: calc(100% - 110px);" type="number" class="form-control" placeholder="图形验证码">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <div class="input-group">
                            <input id="password" type="number" class="form-control" name="password" placeholder="手机验证码" required>
                            <div class="input-group-btn">
                                <button id="send-sms-code" class="btn btn-default text-primary code-btn" type="button">获取验证码</button>
                            </div>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="remember" value="1">

                <div class="form-group">
                    <div class="col-md-12">
                        <button class="btn btn-block login-submit" id="submit">登录</button>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12 text-center">
                        <span class="login-alert-text" id="login-alert">{{$errors->has('email') ? $errors->first('email') : ''}}</span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('inline-style')
<style type="text/css">
    html {
        height: 100%;
    }
    body {
        height: 100%;
        background: linear-gradient(127deg, #9441a1, #ec798b);
        background: linear-gradient(175deg, #5400E6, #C200E4);
        /* background: linear-gradient(40deg, #33374b,#888DA5); */
        background: #2d3857;
        background: linear-gradient(0, #28314c, #3c476a);
    }
    .phone-box .intl-tel-input {
        width: 100%;
    }
    .code-btn {
        color: #55b3e2;
        background-color: transparent;
        border-color: #8196b5;
    }
    .login-alert-text {
        color: #d9534f;
    }
    .iti-flag {
        background-image: url({{ asset('img/flags.png') }});
    }
    @media only screen and (-webkit-min-device-pixel-ratio: 2), 
           only screen and (min--moz-device-pixel-ratio: 2), 
           only screen and (-o-min-device-pixel-ratio: 2 / 1), 
           only screen and (min-device-pixel-ratio: 2), 
           only screen and (min-resolution: 192dpi), 
           only screen and (min-resolution: 2dppx) {
        .iti-flag {
            background-image: url({{ asset('img/flags.png') }});
        }
    }
    .login
        .panel {
            background-color: rgba(51,55,75,0.65);
            background: transparent;
        }
        .login-logo {
            /* font-family: 'PingFangSC-light,Microsoft YaHei,Hiragino Sans GB,Heiti SC,WenQuanYi Micro Hei';
            font-size: 16px;
            color: rgba(255,255,255,0.75);
            border-color: rgba(255,255,255,0.1) */
            height: 30px;
        }
        .login-submit {
            color: rgba(255,255,255,0.75);
            background-color: #9441a1;
            border-color: #9441a1;
            background: linear-gradient(40deg, #947fee,#fa74b1);
        }
    .login input {
        color: #fff;
        background: transparent !important;
        border-color: #8196b5;
    }
</style>
@endsection

@section('script')
<script src="{{ asset('js/intlTelInput.min.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var errMsg = {
            telEmp: '请输入手机号',
            telWrong: '手机号格式不对',
            pCodeEmp: '请输入图形验证码',
            codeEmp: '请输入手机验证码'
        };
        var reg = /^1(3[0-9]|4[579]|5[0-35-9]|7[0-9]|8[0-9])\d{8}$/;
        var loginAlert = $('#login-alert');
        var phone = $('#phone');
        phone.intlTelInput({
            allowDropdown: true, // 实际没有筛选后的选择，暂时把下拉框隐藏
            initialCountry: 'cn'
        });

        $('#submit').on('click', function (e) {
            var error = verify();
            if (error) {
                loginAlert.text(error);
            } else {
                loginAlert.text('');
                $('form').submit();
            }
        })
        var i = document.getElementById('captcha');
        i.addEventListener('click', function (e) {
            e.target.src = "{{route('captcha')}}?_=" + new Date().getTime();
        })

        var a = document.getElementById('send-sms-code');
        a.addEventListener('click', function (e) {
            if (a.disabled) {
                return;
            }

            e.preventDefault();

            var phone = document.getElementById('phone');
            var captcha = document.getElementById('captcha-phrase');

            if (!phone.value) {
                loginAlert.text(errMsg.telEmp);
                return;
            }
            if (!reg.test(phone.value)) {
                loginAlert.text(errMsg.telWrong);
                return;
            }

            if (!captcha.value) {
                loginAlert.text(errMsg.pCodeEmp);
                return;
            }

            var r = new XMLHttpRequest();
            var sms_url = "{{route('sms')}}?phone="+phone.value+"&captcha="+captcha.value;
            var url_search = location.search;
            if (url_search.indexOf('?') > -1) {
                var str = url_search.substr(1);
                var query_arr = str.split('&');
                for(var i = 0; i < query_arr.length; i++) {
                    if (query_arr[i].split('=')[0] === 'u') {
                        sms_url += '&' + query_arr[i];
                        break;
                    }
                }
            }

            r.open("GET", sms_url);
            r.addEventListener('load', function (e) {
                if (r.status !== 200) {
                    loginAlert.text(r.responseText);
                } else {
                    loginAlert.text('');
                    var old_text = a.innerText;
                    var i = 60;
                    a.innnerText = i + "s 后重新获取";
                    a.disabled = true;

                    var f = function () {
                        if (i > 0) {
                            i = i - 1;
                            a.innerText = i + "s 后重新获取";
                            setTimeout(f, 1000);
                        } else {
                            a.innerText = old_text;
                            a.disabled = false;
                        }
                    };

                    setTimeout(f, 1000);
                }
            });

            r.send();
        });

        function verify () {
            var phoneNum = phone.val();
            var picCode = $('#captcha-phrase').val();
            var code = $('#password').val();
            if (!phoneNum) {
                return errMsg.telEmp;
            }
            if (!reg.test(phone.val())) {
                return errMsg.telWrong;
            }
            if (!picCode) {
                return errMsg.pCodeEmp;
            }
            if (!code) {
                return errMsg.codeEmp;
            }
            return ''
        }
    });
</script>
@endsection
