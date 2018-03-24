@extends('layouts.app')

<style>
#qr {
    width: 100%;
    margin-top: -22px;
}
</style>
@section('content')
<img id="qr" src="{{$img}}">
@endsection
