<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calendar\CalendarView;

class CalendarController extends Controller
{
    public function show() {
        $calendar = new CalendarView(time());
        /* time()を使って現在時刻を取得することで、
        今月のカレンダーを作成しようとしている*/

        return view('calendar', [
            'calendar' => $calendar
        ]);
    }
}
