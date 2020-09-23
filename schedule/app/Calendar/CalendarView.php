<?php
namespace App\Calendar; // ファイルの設置場所
use Carbon\Carbon; // CarbonはDateTimeに関するライブラリ

class CalendarView {
    private $carbon;

    function __construct($date) {
        $this->carbon = new Carbon($date);
    }

    // タイトル(○年○月形式にformatメソッドで表示を整える)
    public function getTitle() {
        return $this->carbon->format('Y年m月');
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
        $html[] = '</table>';
        $html[] = '</div>';

        return implode("", $html);
    }
}
?>