<?php
namespace App\Calendar; // ファイルの設置場所
use Carbon\Carbon; // CarbonはDateTimeに関するライブラリ

class CalendarView {
    private $carbon;

    protected function getWeeks() {
        $weeks = [];

        // 初日
        $firstDay = $this->carbon->copy()->firstOfMonth(); // copy()を挟むことで、影響がでないように

        // 月末
        $lastDay = $this->carbon->copy()->lastOfMonth();

        // 1週目
        $week = new CalendarWeek($firstDay->copy());
        $weeks[] = $week;

        // 作業用の日
        $tmpDay = $firstDay->copy()->addDay(7)->startOfWeek();

        // 月末までループさせる
        while ($tmpDay->lte($lastDay)) {
            $week = new CalendarWeek($tmpDay, count($weeks)); // 何週目かを伝えるために、count($weeks)を入れた
            $weeks[] = $week;

            // 次の週+=7日
            $tmpDay->addDay(7);
        }
        return $weeks;
    }

    function __construct($date) {
        $this->carbon = new Carbon($date);
    }

    // タイトル(○年○月形式にformatメソッドで表示を整える)
    public function getTitle() {
        return $this->carbon->format('Y年n月');
    }

    function render() {
        $html = []; // 要素が空の配列を作る
        $html[] = '<div class="calendar">'; // 配列に要素を追加する
        $html[] = '<table class="table">';
        $html[] = '<thead>';
        $html[] = '<tr>';
        $html[] = '<th>月</th>'; // テーブルを作っていく
        $html[] = '<th>火</th>';
        $html[] = '<th>水</th>';
        $html[] = '<th>木</th>';
        $html[] = '<th>金</th>';
        $html[] = '<th>土</th>';
        $html[] = '<th>日</th>';
        $html[] = '</tr>';
        $html[] = '</thead>';

        $html[] = '<tbody>';

        $weeks = $this->getWeeks();
        foreach ($weeks as $week) {
            $html[] = '<tr class="'.$day->getClassName().'">';
            $days = $week->getDays();
            foreach ($days as $day) {
                $html[] = '<td class="'.$day->getClassName().'">';
                $html[] = $day->render();
                $html[] = '</td>';
            }
            $html[] = '</tr>';
        }

        $html[] = '</tbody>';

        $html[] = '</table>';
        $html[] = '</div>';

        return implode("", $html);
    }
}
?>