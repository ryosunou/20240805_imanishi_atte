@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
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
<div class="date-content">
    <div class="date-navigation">
        <a href="/attendances/{{ \Carbon\Carbon::parse($date)->subDay()->format('Y-m-d') }}" class="button">&lt;</a>
        <span>{{ $date }}</span>
        <a href="/attendances/{{ \Carbon\Carbon::parse($date)->addDay()->format('Y-m-d') }}" class="button">&gt;</a>
    </div>
    
    <table>

        <head>
            <tr>
                <th>名前</th>
                <th>勤務開始</th>
                <th>勤務終了</th>
                <th>休憩時間</th>
                <th>勤務時間</th>
            </tr>
        </head>

        <body>
            @foreach($attendances as $attendance)
            <tr>
                <td>{{ $attendance->user->name }}</td>
                <td>{{ \Carbon\Carbon::parse($attendance->start_time)->format('H:i:s') }}</td>
                <td> @if($attendance->end_time)
                    {{ \Carbon\Carbon::parse($attendance->end_time)->format('H:i:s') }}
                    @else
                    -
                    @endif
                </td>
                <td>{{ $attendance->total_rest_time }}</td>
                <td>@if($attendance->work_time_formatted)
                    {{ $attendance->work_time_formatted }}
                    @else
                    -
                    @endif
                </td>
            </tr>
            @endforeach
        </body>
    </table>
    {{ $attendances->links() }}
</div>
</div>
@endsection