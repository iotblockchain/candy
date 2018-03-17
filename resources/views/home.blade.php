@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2" style="font-family:monospace;">
            <div class="panel panel-default">
                <div class="panel-heading">推广链接</div>
                <div class="panel-body">
                    <input onfocus="this.select()" type="url" value="{{ $url }}" style="width:100%;">
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">推广等级</div>
                <div class="panel-body">
                    <p>你已经邀请<span class="badge">{{ $invite_count }}</span>人，等级为 <span class="badge">VIP{{$level}}</span>，应发 LDBC <span class="badge">{{$bonus}}</span>枚，已发 LDBC <span class="badge">{{$sent_bonus}}</span> 枚。</p>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">奖励规则</div>
                <div class="panel-body">
                    <p>新用户注册直接升级为VIP0，获得系统赠送的 100 枚 LDBC。</p>
                    <p>邀请人数为01-05人，则升级为 VIP1，每邀请一人赠送 100 枚 LDBC。</p>
                    <p>邀请人数为06-10人，则升级为 VIP2，每邀请一人赠送 177 枚 LDBC。</p>
                    <p>邀请人数为11-20人，则升级为 VIP3，每邀请一人赠送 277 枚 LDBC。</p>
                    <p>邀请人数为21-30人，则升级为 VIP4，每邀请一人赠送 377 枚 LDBC。</p>
                    <p>邀请人数为31-50人，则升级为 VIP5，每邀请一人赠送 677 枚 LDBC。</p>
                    <p>邀请人数为 > 50人，则升级为 VIP6，每邀请一人赠送 777 枚 LDBC。</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
