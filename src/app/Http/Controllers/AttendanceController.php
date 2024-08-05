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

    public function getAttendance(Request $request, $date = null)
    {
        $today = Carbon::today();

        $date = $date ?: Carbon::today()->toDateString();

        $attendances = Attendance::with(['user', 'rests'])
            ->whereDate('start_time', $today)
            ->orderBy('start_time', 'desc')
            ->paginate(5);

        $attendances->getCollection()->transform(function ($attendance) {
            $totalWorkTime = 0;

            if ($attendance->end_time) {

                $totalWorkTime = Carbon::parse($attendance->end_time)->diffInSeconds(Carbon::parse($attendance->start_time));
            } 
            
            else {
                $attendance->work_time_formatted = null;
                return $attendance; 
            }

            $totalRestTime = 0;

            foreach ($attendance->rests as $rest) {

                if ($rest->end_time) {
                    $totalRestTime += Carbon::parse($rest->end_time)->diffInSeconds(Carbon::parse($rest->start_time));
                }
            }

            $workTimeInSeconds = $totalWorkTime - $totalRestTime;

            $attendance->work_time_formatted = gmdate('H:i:s', $workTimeInSeconds);

            
            return $attendance;
        });

        return view('attendance', compact('attendances', 'date'));
    }

    public function show($date)
    {


        $attendances = Attendance::with('user', 'rests')
          ->whereDate('start_time', $date)->paginate(5);
        

        $attendances->getCollection()->transform(function ($attendance) {
            $totalWorkTime = 0;

            if ($attendance->end_time) {

                $totalWorkTime = Carbon::parse($attendance->end_time)->diffInSeconds(Carbon::parse($attendance->start_time));
            } 
            
            else {
                $attendance->work_time_formatted = null;
                return $attendance;
            }

            $totalRestTime = 0;

            foreach ($attendance->rests as $rest) {

                if ($rest->end_time) {
                    $totalRestTime += Carbon::parse($rest->end_time)->diffInSeconds(Carbon::parse($rest->start_time));
                }
            }

            $workTimeInSeconds = $totalWorkTime - $totalRestTime;

            $attendance->work_time_formatted = gmdate('H:i:s', $workTimeInSeconds);

            return $attendance;
        });


        return view('attendance', compact('attendances', 'date'));
    }

}
