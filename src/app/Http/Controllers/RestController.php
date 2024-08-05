<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\Rest;



class RestController extends Controller
{

    public function startRest(Request $request)
    {
        $userId = $request->user()->id;

        $attendance = Attendance::firstOrCreate([
            'user_id' => $userId,
            'date' => now()->toDateString(),
        ]);

        $rest = new Rest();
        $rest->attendance_id = $attendance->id;
        $rest->start_time = now();
        $rest->save();

        session()->put('restStarted', true);

        return redirect()->back()->with('message', '休憩を開始しました。');
    }

    public function endRest(Request $request)
    {
        $userId = $request->user()->id;

        $attendance = Attendance::firstOrCreate([
            'user_id' => $userId,
            'date' => now()->toDateString(),
        ]);

        $lastRest = Rest::where('attendance_id', $attendance->id)
            ->whereNull('end_time')
            ->latest()
            ->first();


        if ($lastRest) {
            $lastRest->end_time = now();
            $lastRest->save();
        }

        session()->forget('restStarted');

        $total_rest_time = 0;

        $rests = Rest::where('attendance_id', $attendance->id)->get();

        foreach ($rests as $rest) {
            $start_time = strtotime($rest->start_time);

            $end_time = strtotime($rest->end_time);

            $total_rest_time += ($end_time - $start_time);

            $attendance->update(['total_rest_time' => $total_rest_time]);
        }

        return redirect()->back()->with('message', '休憩を終了しました。');
    }
}
