@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('link')
<a class="header__link" href="/">ホーム</a>
<a class="header__link" href="/attendance">日付一覧</a>
<form class="form" action="/logout" method="post">
    @csrf
    <button class="header__link">ログアウト</button>
</form>
@endsection

@section('content')
<div class="attendance__content">
    <h2 class="attendance-title">
        {{ Auth::user()->name }}さんお疲れ様です！
    </h2>
    @if (session('message'))
    <p>{{ session('message') }}</p>
    @endif
    <div class="attendance__panel">
        <form class="attendance__button" method="get" action="{{ url('/attendance/start') }}" id="start-form">
            @csrf
            <button class="attendance__button-submit" type="submit" {{ $startAttendance ? 'disabled' : '' }}>勤務開始</button>
        </form>
        <form class="attendance__button" method="get" action="{{ url('/attendance/end') }}" id="end-form">
            @csrf
            <button class="attendance__button-submit" type="submit" {{ !$startAttendance || $endAttendance ? 'disabled' : '' }}>勤務終了</button>
        </form>
        <form class="attendance__button" action="{{ url('/break/start') }}" method="get" id="start-break-form">
            @csrf
            <button class="attendance__button-submit" type="submit" {{ session('restStarted') ? 'disabled' : '' }}>休憩開始</button>
        </form>
        <form class="attendance__button" action="{{ url('/break/end') }}" method="get" id="end-break-form">
            @csrf
            <button class="attendance__button-submit" type="submit" {{ !session('restStarted') ? 'disabled' : '' }}>休憩終了</button>
        </form>
    </div>
</div>
@endsection