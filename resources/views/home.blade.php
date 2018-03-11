@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">推广链接</div>
                <div class="panel-body">
                    <input onfocus="this.select()" type="url" value="{{ url('/login?u=').Auth::user()->id }}" style="width:100%;">
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">推广等级</div>
                <div class="panel-body">
                    <p>已经邀请<span class="badge">{{ $invite_count }}</span>人</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
