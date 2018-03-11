@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">钱包地址</div>
                <div class="panel-body">
                    <input onfocus="this.select()" value="{{ Auth::user()->address }}" style="width:100%;">
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">钱包私钥</div>
                <div class="panel-body">
                    <input onfocus="this.select()" value="{{ Auth::user()->key }}" style="width:100%;">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
