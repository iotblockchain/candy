@extends('layouts.app')

@section('content')
<div class="home">
    <div class="home-attent">
        <div class="panel">
            <div class="panel-body">
                <div>推广链接</div>
                <input readonly value="{{ $url }}" style="width:100%;">
                <a href="{{ $qr_url }}" style="display:inline-block; margin-top: 4px; padding: 4px 0;">点击获取推广图片</a>
            </div>
        </div>
    </div>
    <div class="attent-motion"></div>
    <div class="panel level-box" style="font-family:monospace;">
        <div class="panel-body">
            <h1 class="text-center">当前等级：<span class="cur-level">VIP0</span></h1>
            <div class="row text-center">
                <div class="col-xs-4">
                    <h2>已邀请</h2>
                    <span><i>{{ $invite_count }}</i>人</span>
                </div>
                <div class="col-xs-4">
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
        <div class="panel-heading">奖励规则</div>
        <div class="panel-body">
            <table class="table">
                @foreach($levels as $item)
                <tr>
                    <th>VIP{{$item['level']}}</th>
                    <td>{{empty($item['invite']) ? '新用户' : '邀请'.$item['invite'].'人'}}<br>
                    {{empty($item['invite']) ? '获得系统赠送的' : '每邀请一人赠送'}}{{$item['ldbc']}}枚LDBC</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection

@section('inline-style')
<style>
body {}

.home
    h1 {
        font-size: 16px;
    }
    h2,h3 {
        font-size: 14px;
    }
    .home-attent {
        margin-top: -22px;
        padding: 22px 15px 1px;
        background: linear-gradient(to bottom, #5400E6, #C200E4);
    }
    .attent-motion {
        height: 20px;
        background: linear-gradient(to bottom, #C200E4, rgba(194,0,228, 0.2));
    }
    .panel {
        border-radius: 0;
    }
    .panel-heading {
        border-bottom: 0;
    }
    .level-box
        .cur-level {
            color: #F4005F;
        }
        h2 {
            font-weight: 400;
            color: #8d8c92;
        }
        i {
            font-size: 16px;
            font-weight: 500;
        }
    .level-rule {
        margin-bottom: 0;
    }
    .level-rule
        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
            border-top: 0;
            border-bottom: 1px solid #ddd;
        }
</style>
@endsection
