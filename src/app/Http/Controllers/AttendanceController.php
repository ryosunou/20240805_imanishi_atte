<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AttendanceController extends Controller
{

    public function getindex()
    {
        $user = Auth::user();
        $today = Carbon::today()->toDateString();

        $attendance = Attendance::where('user_id', $user->id)
            ->whereDate('start_time', $today)
            ->first();

        $startAttendance = $attendance ? true : false;
        $endAttendance = $attendance && $attendance->end_time ? true : false;



        return view('index', [
            'startAttendance' => $startAttendance,
            'endAttendance' => $endAttendance,
        ]);
    }


    public function startAttendance(Request $request)
    {
        $user = Auth::user();

        $today = Carbon::today();

        if (Carbon::now()->hour < 0) {
            $today = $today->subDay();
        }

        $attendance = Attendance::where('user_id', $user->id)->whereDate('start_time', $today->toDateString())->first();

        if ($attendance) {
            return redirect()->back()->with('message', 'すでに勤務開始されています');
        }


        Attendance::create([
            'user_id' => $user->id,
            'start_time' => now(),
            'date' => $today->toDateString(),



        ]);

        return redirect()->back()->with('message', '勤務を開始しました');
    }

    public function endAttendance(Request $request)
    {
        $user = Auth::user();
        $today = Carbon::today();


        $attendance = Attendance::where('user_id', $user->id)->whereDate('start_time', $today->toDateString())->first();

        if (!$attendance) {

            return redirect()->back()->with('message', '勤務が開始されていません');
        }

        $attendance->update([
            'end_time' => now(),
        ]);

        return redirect()->back()->with('message', '勤務終了が記録されました');
    }

    public function getAttendance($num)
    {

        $attendances = Attendance::where('user_id', Auth::id())->paginate(5);

        $date = Carbon::now();

        return view('attendance', ['attendances' => $attendances, 'date' => $date]);
    }
}
