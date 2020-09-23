<?php
namespace App\Calendar;

use Carbon\Carbon;

class CalendarWeek {
    protected $carbon;
    protected $index = 0;

    function __construct($date, $index = 0) {
        $this->carbon = new Carbon($date);
        $this->index = $index;
    }

    function getClassName() {
        return "week-".$this->index;
    }

    /**
     * @return CalendarWeekDay[]
     */

    // 月の初日から最終日までを作成
    function getDays() {
        $days = []; // 空の配列

        // 開始日
        $startDay = $this->carbon->copy()->startOfWeek();

        // 終了日
        $lastDay = $this->carbon->copy()->endOfWeek();

        // 作業用
        $tmpDay = $startDay->copy();

        // 月曜日〜日曜日までをループさせる
        while ($tmpDay->lte($lastDay)) {
            if ($tmpDay->month !=$this->carbon->month) {
                $day = new CalendarWeekBlankDay($tmpDay->copy());
                $days[] = $day; // 余白用に用意した配列
                $tmpDay->addDay(1);
                continue;
            }

            // 今月
            $day = new CalendarWeekDay($tmpDay->copy());
            $days[] = $day;

            // 翌日に移動
            $tmpDay->addDay(1);
        }
        return $days;
    }
}
?>