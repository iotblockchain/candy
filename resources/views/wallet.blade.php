@extends('layouts.app')

@section('content')
<div class="container wallet">
    <div class="row" style="font-family:monospace;">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel wallet-addr">
                <div class="panel-heading">钱包地址</div>
                <div class="panel-body">
                    <input onfocus="this.select()" readonly value="0x{{ Auth::user()->address }}" style="width:100%;">
                </div>
            </div>
            <div class="text-center">绑定钱包</div>
            <form method="POST" class="navbar-form wallet-bind" role="search">
                {{ csrf_field() }}
                <div class="col-md-12">
                    <input type="text" name="address" class="form-control" placeholder="请输入钱包地址">
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-block bind-submit" id="submit">绑定</button>
                </div>

                @if (isset($message))
                <div class="text-center">
                    <span class="login-alert-text">{{ $message}}</span>
                </div>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection

@section('inline-style')
<style>
html,body {
    height: 100%;
}
body {
    color: #fff;
    background: linear-gradient(0, #28314c, #3e496c);
}
.wallet-addr {
    background: linear-gradient(to right, #343f62, #586487 70%),
                linear-gradient(to top, #4e5a7e, #384263 70%);
    border: 0;
}
.wallet-addr input {
    background-color: transparent;
    border: 0;
}
.wallet .navbar-form {
    border-top: 0;
    border-bottom: 0;
    box-shadow: none;
}
.wallet-bind input {
    color: #fff;
    background-color: transparent;
    border-color: #8196b5;
}
.wallet .bind-submit {
    margin-top: 15px;
    margin-bottom: 8px;
    color: rgba(255,255,255,0.75);
    border-color: #9441a1;
    background: linear-gradient(40deg, #947fee,#fa74b1);
}
.wallet .login-alert-text {
    color: #d9534f;
}
</style>
@endsection
