@extends('layouts.app')

@section('content')
<div class="home">
    <div class="home-attent">
        <div class="panel text-center">
            <div class="panel-heading">推广邀请</div>
            <div class="panel-body">
                <!--<input class="text-center" onfocus="this.select()" type="url" value="{{ $url }}" style="width:100%;">-->
                <p id="txt" style="text-align:left">
物数链（LDBC）<br>
联合国内外著名物流企业研发，望月新一站台，区块链中的菜鸟网络，2018最具潜力的区块链领域糖果派送中。<br>
🏃注册即送，邀请便有，价值1000万现金等你来分。<br>
最高每邀请一个人可获得777个LDBC（价值$40）<br>
🏃注册网址：{{$url}}<br>
🏃官方网址：https://ldbc.io/<br>
🏃电报群：https://t.me/LDBC001<br>
                </p>
                <a href="{{ $qr_url }}" style="display:inline-block; margin-top: 4px; padding: 4px 0;">点击获取推广图片</a>
                <a id="cp" href="#" style="display:inline-block; margin-top: 4px; padding: 4px 0;">点击复制推广文字</a>
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
                <h2>在活动完后将统一发放到钱包<br>一定要绑定自己的钱包地址</h2>
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
    padding: 10px;
    background: linear-gradient(to right, #343f62, #586487 70%),
                linear-gradient(to top, #4e5a7e, #384263 70%);
    background: linear-gradient(355deg, #505d82, rgba(63, 73, 105, .6) 40%, rgba(73, 85, 120, .75)), 
                linear-gradient(92deg, rgba(52, 62, 97, .8), #596587);
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var btn = document.getElementById("cp");

        btn.addEventListener("click", clickHandler, false);

        function clickHandler(e) {
            e.preventDefault();
            document.execCommand('copy');
        }

        document.addEventListener('copy', function(e) {
            var txt = document.getElementById('txt');
            e.clipboardData.setData("text/plain", txt.innerText);
            e.preventDefault();
        });
    });
</script>
@endsection
