@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">用户登录</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">手机号</label>

                            <div class="col-md-6">
                                <input id="email" type="number" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="captcha-phrase" class="col-md-4 control-label">验证码</label>

                            <div class="col-md-6">
                                <img id="captcha" style="float:left;" src="/captcha">
                                <input id="captcha-phrase" style="width: calc(100% - 100px); margin-bottom:0.5em;" type="number" class="form-control">
                                <span style="color:gray;">点击更新验证码</span>
                                <a id="send-sms-code" style="float:right;" href="#">点击获取验证码</a>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">短信验证码</label>

                            <div class="col-md-6">
                                <input id="password" type="number" class="form-control" name="password" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <input type="hidden" name="remember" value="1">

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">登录</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var i = document.getElementById('captcha');
        i.addEventListener('click', function (e) {
            e.target.src = "/captcha?_=" + new Date().getTime();
        })

        var a = document.getElementById('send-sms-code');
        a.addEventListener('click', function (e) {
            if (a.disabled) {
                return;
            }

            e.preventDefault();

            var phone = document.getElementById('email');
            var captcha = document.getElementById('captcha-phrase');

            if (!phone.value) {
                alert("请输入手机号");
            }

            if (!captcha.value) {
                alert("请输入验证码");
            }

            var r = new XMLHttpRequest();
            var sms_url = "/sms-code?phone="+phone.value+"&captcha="+captcha.value;

            var u = new URL(document.URL).searchParams.get('u');
            if (u) {
                sms_url += '&u=' + u;
            }

            r.open("GET", sms_url);
            r.addEventListener('load', function (e) {
                if (r.status !== 200) {
                    alert(r.responseText);
                } else {
                    var old_text = a.text;
                    var i = 10;
                    a.text = i + "s 后重新获取";
                    a.disabled = true;

                    var f = function () {
                        if (i > 0) {
                            i = i - 1;
                            a.text = i + "s 后重新获取";
                            setTimeout(f, 1000);
                        } else {
                            a.text = old_text;
                            a.disabled = false;
                        }
                    };

                    setTimeout(f, 1000);
                }
            });

            r.send();
        });
    });
</script>
@endsection
