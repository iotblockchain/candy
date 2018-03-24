@extends('layouts.app')

@section('content')
<div class="home">
    <div class="home-attent">
        <div class="panel">
            <div class="panel-heading">推广链接</div>
            <div class="panel-body">
                <input onfocus="this.select()" type="url" value="{{ $url }}" style="width:100%;">
            </div>
        </div>
    </div>
    <div class="panel level-box" style="font-family:monospace;">
        <div class="panel-body">
            <h1 class="text-center">当前等级：<span class="cur-level">VIP0</span></h1>
            <div class="row text-center achieve-list">
                <div class="col-xs-4 achieve-item">
                    <h2>已邀请</h2>
                    <span><i>{{ $invite_count }}</i>人</span>
                </div>
                <div class="col-xs-4 achieve-item">
                    <h2>应发LDBC</h2>
                    <span><i>{{$bonus}}</i>枚</span>
                </div>
                <div class="col-xs-4">
                    <h2>已发LDBC</h2>
                    <span><i>{{$sent_bonus}}</i>枚</span>
                </div>
            </div>
        </div>
    </div>
    @php
        $levels = [
            [
                'level' => 0,
                'invite' => '',
                'ldbc' => 100
            ],
            [
                'level' => 1,
                'invite' => '01-05',
                'ldbc' => 100
            ],
            [
                'level' => 2,
                'invite' => '06-10',
                'ldbc' => 177
            ],
            [
                'level' => 3,
                'invite' => '11-20',
                'ldbc' => 277
            ],
            [
                'level' => 4,
                'invite' => '21-30',
                'ldbc' => 377
            ],
            [
                'level' => 5,
                'invite' => '31-50',
                'ldbc' => 677
            ],
            [
                'level' => 6,
                'invite' => '>50',
                'ldbc' => 777
            ]
        ];
    @endphp
    <div class="panel level-rule" style="font-family:monospace;">
        <div class="panel-heading text-center">奖励规则</div>
        <div class="panel-body">
            <ul class="list-group">
                @foreach($levels as $item)
                <li class="list-group-item">
                    <div class="vip-level-item">VIP{{$item['level']}}</div>
                    <div class="vip-detail-item">{!!empty($item['invite']) ? '新用户' : '邀请<span class="invite-people">'.$item['invite'].'</span>人'!!}<br>
                    {{empty($item['invite']) ? '获得系统赠送的' : '每邀请一人赠送'}}<span class="coin-num">{{$item['ldbc']}}</span>枚LDBC</div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection

@section('inline-style')
<style>
.home h1 {
    font-size: 16px;
}
.home h2,
.home h3 {
    font-size: 14px;
}
body {
    color: #fff;
    background: linear-gradient(0, #28314c, #3e496c);
}
.home .panel {
    border-radius: 0;
}
.home .panel-heading {
    border-bottom: 0;
}
.home-attent {
    padding: 0 12px;
}
.home-attent .panel {
    background: linear-gradient(to right, #343f62, #586487 70%),
                linear-gradient(to top, #4e5a7e, #384263 70%);
    border-radius: 4px;
    border: 0;
}
.home-attent .panel-body input {
    background-color: transparent;
    border: 0;
}
.home .level-box,
.home .level-rule {
    background-color: transparent;
}
.level-box {
    border-bottom-color: #4b5882;
}
.level-box .cur-level {
    color: #e64b98;
}
.level-box h2 {
    font-weight: 400;
    color: #8196b5;
}
.level-box i {
    font-size: 16px;
    font-weight: 500;
}
.level-box .achieve-list .achieve-item:after {
    content: '';
    position: absolute;
    top: 50%;
    right: 0;
    margin-top: -10px;
    width: 1px;
    height: 30px;
    background: #4b5882;
}
.level-rule {
    margin-bottom: 0;
}
.level-rule .list-group {
    background-color: transparent;
}
.level-rule .list-group .list-group-item {
    display: flex;
    align-items: baseline;
    margin-bottom: 10px;
    background: linear-gradient(to right, #535f81,#364164);
    border: 0;
    border-radius: 4px;

}
.level-rule .list-group-item .vip-level-item {
    width: 80px;
}
.level-rule .list-group-item .vip-detail-item {
    font-size: 12px;
    color: #8d9abb;
}
.level-rule .list-group-item .invite-people {
    color: #00b7e8;
}
.level-rule .list-group-item .coin-num {
    color: #f277b7;
}
</style>
@endsection
