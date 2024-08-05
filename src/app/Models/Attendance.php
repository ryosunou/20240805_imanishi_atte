<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'start_time',
        'end_time'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    

    public function rests()
    {
        return $this->hasMany(Rest::class);
    }

    public function getTotalRestTimeAttribute()
    {
        $totalRestTime = 0;

        foreach ($this->rests as $rest) {
            $totalRestTime += Carbon::parse($rest->end_time)->diffInSeconds(Carbon::parse($rest->start_time));
        }

        return gmdate('H:i:s', $totalRestTime);
    }
}
