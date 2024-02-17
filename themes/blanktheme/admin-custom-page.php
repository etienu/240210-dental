<?php
//----------------------------------------
//
//  管理画面
//  独自テーマ設定ページ
//
//  処理実行用js、phpは「assets/controlpanel/」以下にあります
//
//----------------------------------------
make_section_dispmenuindex();


//----------------------------------------
//サイト設定ページ内容
//----------------------------------------
function make_section_dispmenuindex() {
	global $menu;
	global $submenu;
    $i;
    echo "<h2>■ ←メニューの配列番号確認 ■</h2>";
    echo "<p>ここにカスタムフィールドとテーブルボタンで、<br>管理メニュー表示をON/OFF切り替えるのもいいだろうか</p>";
    foreach($menu as $ind => $m ){
        //echo "<p>".var_dump($m)."</p><br>";
        echo "<span>[$ind]".$m[0]."</span><br>";
    }
}
?>
