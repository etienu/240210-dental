<?php
//  投稿者一覧ページを自動で生成されないようにする
add_filter('author_rewrite_rules', '__return_empty_array');

//----------------------------------------------------
//  ?author=1 などでアクセスしたらリダイレクトさせる
//  @see https://www.webdesignleaves.com/pr/wp/wp_user_enumeration.html
//----------------------------------------------------
if (!is_admin()) {
  // default URL format
  if (preg_match('/author=([0-9]*)/i', $_SERVER['QUERY_STRING'])) die();
  add_filter('redirect_canonical', 'my_shapespace_check_enum', 10, 2);
}
function my_shapespace_check_enum($redirect, $request) {
  // permalink URL format
  if (preg_match('/\?author=([0-9]*)(\/*)/i', $request)) die();
  else return $redirect;
}

//----------------------------------------------------
//  投稿者 ?auther=1対策、404に飛ばす
//----------------------------------------------------
function disable_author_archive() {
    if( isset($_GET['author']) || preg_match('#/author/.+#', $_SERVER['REQUEST_URI']) ){
      wp_safe_redirect( home_url('/404.php') );
      exit;
    }
}
add_action('init', 'disable_author_archive');

//----------------------------------------------------
//  管理用の固定ページにアクセスしたら404リダイレクト
//  【WordPress】URLのパラメータ
//  https://blogdeoshiete.com/%E3%80%90wordpress%E3%80%91url%E3%81%AE%E3%83%91%E3%83%A9%E3%83%A1%E3%83%BC%E3%82%BF/
//  ※更新 : 24/02/17 : 他に危険なものがあれば追記していく
//----------------------------------------------------
function disable_page() {
  $fexit = false;
  //  管理用カスタムフィールドを保持している固定ページ
  //  URLに"site_customfield"が含まれている
  if( preg_match('.site_customfield.', $_SERVER['REQUEST_URI']) ) $fexit = true;
  //  URLに"post_type="が含まれている : 強制投稿一覧
  if( preg_match('.post_type=.', $_SERVER['REQUEST_URI']) ) $fexit = true;
  //  URLに"category_name=" : 強制カテゴリ一覧
  if( preg_match('.category_name=.', $_SERVER['REQUEST_URI']) ) $fexit = true;
  //  URLに"name=" : 入力が一部でも、もっとも近い名称の記事を表示( 必要性がなく偶然性があり危険 )
  if( preg_match('.name=.', $_SERVER['REQUEST_URI']) ) $fexit = true;
  //  URLに"s= : 検索
  if( preg_match('.\?s=.', $_SERVER['REQUEST_URI']) ) $fexit = true;
  //  URLに"tb=" : トラックバック
  if( preg_match('.\?tb=.', $_SERVER['REQUEST_URI']) ) $fexit = true;
  //  URLに"feed=" : フィード : feed/は表示。=feed2などを使用する場合は隠さない。
  //if( preg_match('.feed=.', $_SERVER['REQUEST_URI']) ) $fexit = true;
  
    if( !is_admin() && $fexit ){
    wp_safe_redirect( home_url('/404.php') );
    exit;
  }    

}
add_action('init', 'disable_page');


//----------------------------------------------------
//  ログインページ変更
//----------------------------------------------------
//include GET_PATH_R('php')."inc/login.php";
include "login.php";


//----------------------------------------------------
//  WP REST API を無効にする（必要に応じて一部プラグインのみ有効にさせる）
//  @see https://www.webdesignleaves.com/pr/wp/wp_user_enumeration.html
//----------------------------------------------------
add_filter('rest_pre_dispatch', 'deny_rest_api_except_permitted', 10, 3);
function deny_rest_api_except_permitted($result, $wp_rest_server, $request)
{
  // permit oembed, Contact Form 7, Akismet
  // $permitted_routes に有効にしたいプラグインを指定
  $permitted_routes = ['oembed', 'contact-form-7', 'akismet'];
  $route = $request->get_route();
  foreach ($permitted_routes as $r) {
    if (strpos($route, "/$r/") === 0) return $result;
  }
  // permit Gutenberg（ユーザーが投稿やページの編集が可能な場合）
  if (current_user_can('edit_posts') || current_user_can('edit_pages')) {
    return $result;
  }
  return new WP_Error('rest_disabled', __('The REST API on this site has been disabled.'), array('status' => rest_authorization_required_code()));
}


?>