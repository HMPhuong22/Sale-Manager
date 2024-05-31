<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Time extends Model
{
    use HasFactory;
    public function getTime(){
        $time = Carbon::now('UTC');
        $setTimeHN = $time->setTimezone('Asia/Ho_Chi_Minh');
        $getTimeHN = $setTimeHN->format('Y-m-d H:i:s');   // Định dạng thời gian
        return $getTimeHN;
    }

    public function GetDay(){
        $day = Carbon::today();
        return $day->toDateString();
    }

    public function GetMonth(){
        $month = Carbon::now()->month;
        return $month;
    }

    public function GetYear(){
        $year = Carbon::now()->year;
        return $year;
    }
}   
