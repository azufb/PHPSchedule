<?php
namespace App\Calendar;
use Carbon\Carbon;

class CalendarWeekDay {
    protected $carbon;

    function __construct($date) {
        $this->carbon = new Carbon($date);
    }

    function getClassName() {
        return "day-".strtolower($this->carbon->format("D"));
        // "D"で、曜日を英省略式で取得できる。eg.Mon
        // strtolowerは、小文字変換。string to lowerのこと。
    }

    /**
     * @return
     */

    function render() {
        return '<p class="day">'.$this->carbon->format("j").'</p>';
        // "j"で、ゼロを付けない日付を取得できる。
    }
}
?>
