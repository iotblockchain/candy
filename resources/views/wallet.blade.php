@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="font-family:monospace;">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">钱包地址</div>
                <div class="panel-body">
                    <input onfocus="this.select()" readonly value="0x{{ Auth::user()->address }}" style="width:100%;">
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">绑定钱包</div>
                <div class="panel-body">
                    <form method="POST" class="navbar-form navbar-left" role="search">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="text" name="address" class="form-control" placeholder="请输入钱包地址">
                        </div>
                        <button type="submit" class="btn btn-default">绑定</button>

                        @if (isset($message))
                        <span class="help-block">
                            <strong>{{ $message}}</strong>
                        </span>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
