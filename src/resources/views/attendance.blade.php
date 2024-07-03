@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
@endsection

@section('link')
<a class="header__link" href="/">ホーム</a>
<a class="header__link" href="/attendance">日付一覧</a>
<a class="header__link" href="/login">ログアウト</a>
@endsection

@section('content')
<div class="date-content">
    <div class="date-navigation">
        <button>&lt;</button>
        <span>{{ $date->format('Y-m-d') }}</span>
        <button>&gt;</button>
    </div>
    <table>
        <thead>
            <tr>
                <th>名前</th>
                <th>勤務開始</th>
                <th>勤務終了</th>
                <th>休憩時間</th>
                <th>勤務時間</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $attendance)
            <tr>
                <td>{{ $attendance->user->name }}</td>
                <td>{{ \Carbon\Carbon::parse($attendance->start_time)->format('H:i:s') }}</td>
                <td>{{ \Carbon\Carbon::parse($attendance->end_time)->format('H:i:s') }}</td>
                <!-- <td>{{ $attendance->rest_time }}</td>
                <td>{{ $attendance->work_time }}</td> -->
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $attendances->links() }}
</div>
@endsection