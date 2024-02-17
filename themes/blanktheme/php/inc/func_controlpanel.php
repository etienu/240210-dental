<?php

//============================================================================
//
//  管理画面に対する処理
//
//============================================================================
//----------------------------------------------------
//  管理画面全体にCSS適用
//----------------------------------------------------
add_action('admin_enqueue_scripts', 'my_add_admin_style');
function my_add_admin_style()
{
  global $WP_CSS_PATH;
  wp_enqueue_style('my_add_admin_style', $WP_CSS_PATH . 'style-admin.css');
//  wp_enqueue_style('my_add_admin_style', '../../css/style-admin.css');
}

//----------------------------------------------------
//  ビジュアルエディタにCSS適用
//----------------------------------------------------
add_action('admin_init', 'my_add_editor_style');
function my_add_editor_style()
{
  global $WP_CSS_PATH;
//  add_editor_style(str_replace('/' . get_stylesheet_directory_uri(), '', $WP_CSS_PATH) . 'style-editor.css');
}

//----------------------------------------------------
//  管理画面全体にjs適用
//----------------------------------------------------
add_action('admin_enqueue_scripts', 'my_add_admin_js');
function my_add_admin_js($hook)
{
  global $WP_JS_PATH;
//  wp_enqueue_script('my_admin_script', $WP_JS_PATH . 'admin.js');
}
//------------ 管理画面にjs追加 -------------
function admin_func() {
  global $WP_ROOT_PATH;
  echo '<script type="text/javascript" src="'.$WP_ROOT_PATH.'/assets/controlpanel/js/wp-settings.js"></script>';
}
add_action('admin_head', 'admin_func');


//----------------------------------------------------
//   不要なメニューを非表示
//  （コメントアウトした行のメニューは表示される）
//----------------------------------------------------
add_action('admin_menu', 'my_add_remove_admin_menus');
function my_add_remove_admin_menus()
{
  global $menu;
  unset($menu[2]);  // ダッシュボード
  unset($menu[4]);  // メニューの線1
  // unset($menu[5]);  // 投稿
  // unset($menu[10]); // メディア
  // unset($menu[15]); // リンク
  // unset($menu[20]); // ページ
  unset($menu[25]); // コメント
  unset($menu[59]); // メニューの線2
  // unset($menu[60]); // テーマ
  // unset($menu[65]); // プラグイン
  // unset($menu[70]); // プロフィール
  // unset($menu[75]); // ツール
  // unset($menu[80]); // 設定
  unset($menu[90]); // メニューの線3
}

//----------------------------------------------------
//  投稿の自動整形を無効（ダブルクオーテーションなど）
//----------------------------------------------------
add_filter('run_wptexturize', '__return_false');

//----------------------------------------------------
//  投稿一覧にサムネイル表示
//----------------------------------------------------
add_theme_support( 'post-thumbnails', array( 'post' ) );
set_post_thumbnail_size( 50, 50, true );

function manage_posts_columns($columns) {
  $columns['thumbnail'] = __('Thumbnail');
  return $columns;
}

function add_column_thumb($column_name, $post_id) {
  //アイキャッチ取得 array(サイズ,サイズ)
  if ( 'thumbnail' == $column_name) {
    $thum = get_the_post_thumbnail($post_id, array(150,150), 'thumbnail');
  }

  //使用していない場合「なし」を表示
  if ( isset($thum) && $thum ) {
    echo $thum;
  } else {
    echo __('None');
  }
}
add_filter( 'manage_posts_columns', 'manage_posts_columns' );
add_action( 'manage_posts_custom_column', 'add_column_thumb', 10, 2 );

//----------------------------------------------------
//  設定ページ生成
// （関連ファイル：admin-theme-setting-page.php）
// ↑で<input>を追加したら、↓を実行する
// register_setting('custom-menu-group', '↑で定義した<input>のname値');
//
// 画像アップローダーについて
// @see https://nelog.jp/media-uploader-javascript-api
// admin-theme-setting-page.phpにて以下を実行
// 1. <input>を追加
// 2. ファイル下部で new_wp_uploader('<input>のid') を実行（ボタンなどの属性値も変える）
//----------------------------------------------------
add_action('admin_menu', 'my_add_admin_setting_page');
function my_add_admin_setting_page()
{
//    add_menu_page('カスタムテーマ設定', 'カスタムテーマ設定', 'manage_options', 'custom-setting', 'my_setting_file_path', 'dashicons-admin-generic', 90);
    add_menu_page(get_bloginfo('name').' 設定', '★【'.get_bloginfo('name').' 設定】', 'manage_options', 'custom-setting', 'my_setting_file_path', 'dashicons-admin-generic', 90);
    add_action('admin_init', 'my_register_setting');
}
function my_setting_file_path()
{
//    $return_url = '../wp-content/themes/blank_themes/admin-theme-setting-page.php';
//    $return_url = 'admin-theme-setting-page.php';
//  テーマ名URLに気を付ける
    $return_url = '../wp-content/themes/blanktheme/admin-custom-page.php';
require $return_url;
}
function my_register_setting()
{
    register_setting('custom-menu-group', 'general');
    // register_setting('custom-menu-group', '2つ目のname値');
    // register_setting('custom-menu-group', '3つ目のname値');
}
// メディアアップローダーAPIを管理画面へ読み込ませる
add_action('admin_print_scripts', 'my_add_setting_media_api_scripts');
function my_add_setting_media_api_scripts()
{
    wp_enqueue_media();
}

//----------------------------------------------------
//  ツールバー非表示
//----------------------------------------------------
//  margin-top: 32px !important; 対策
//  これはWordPressの管理バーの表示仕様が関係しているので外す
add_filter('show_admin_bar', '__return_false');






?>