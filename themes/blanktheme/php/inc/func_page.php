<?php

//----------------------------------------------------
//  ループの表示件数制御
//----------------------------------------------------
add_action('pre_get_posts', 'my_pre_get_posts');
function my_pre_get_posts($query)
{
  global $WP_ROOP_VIEW_ARCHIVE;
  global $WP_ROOP_VIEW_TAX;
  if (is_admin() || !$query->is_main_query()) return;

  // 表示件数を制御
  $query->set('posts_per_page', $WP_ROOP_VIEW_ARCHIVE);

  // ページごとに件数を変える場合は以下のように条件分岐する
  // if ($query->is_archive()) {
  //   $query->set('posts_per_page', $WP_ROOP_VIEW_ARCHIVE);
  //   return;
  // }
  // if ($query->is_post_type_archive()) {
  //   $query->set('posts_per_page', $WP_ROOP_VIEW_ARCHIVE);
  //   return;
  // }
  // if ($query->is_tax()) {
  //   $query->set('posts_per_page', $WP_ROOP_VIEW_TAX);
  //   return;
  // }
}

//----------------------------------------------------
//  投稿アーカイブページの作成
//  ※ スラッグ変更時にWPの管理画面からパーマリンクの設定を保存し直さないと更新されない
//  https://lpeg.info/wordpress/archive.html#m1
//----------------------------------------------------
add_filter('register_post_type_args', 'my_post_has_archive', 10, 2);
function my_post_has_archive( $args, $post_type ) {
	if ('post' === $post_type) {
		$args['rewrite'] = true;
		$args['has_archive'] = 'blog'; // スラッグを指定（これがURLになる）
	}
  //  カスタム投稿 : news
	if ('news' === $post_type) {
		$args['rewrite'] = true;
		$args['has_archive'] = 'news'; // スラッグを指定（これがURLになる archive-news.php）
	}
	return $args;
}

//----------------------------------------------------
//  検索結果ファイルを使い分ける（カスタム投稿newsならsearch-news.phpを作る）
//----------------------------------------------------
add_filter('template_include','my_search_template');
function my_search_template($template){
  if (is_search()){
    $post_types = get_query_var('post_type');
    foreach((array) $post_types as $post_type)
      $templates[] = "search-{$post_type}.php";
      $templates[] = 'search.php';
      $template = get_query_template('search', $templates);
    }
  return $template;
}




//============================================================================
//  投稿の人気記事（PV）取得
//      各投稿のカスタムフィールドにPVフィールドを追加（投稿ページアクセス時に値を+1する）
//      @see https://cage.tokyo/wordpress/wordpress-ranking/
//============================================================================
//
//  投稿ページ（single-○○.php）の1行目に以下を記述
// <?php if(!is_user_logged_in() && !is_bot()) { set_post_views(get_the_ID()); } ? >
//
//============================================================================
//----------------------------------------------------
function set_post_views($postID)
{
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

//クローラーのアクセスを判別するために追記
function is_bot()
{
    $ua = $_SERVER['HTTP_USER_AGENT'];
    $bot = array(
        'Googlebot',
        'Yahoo! Slurp',
        'Mediapartners-Google',
        'msnbot',
        'bingbot',
        'MJ12bot',
        'Ezooms',
        'pirst; MSIE 8.0;',
        'Google Web Preview',
        'ia_archiver',
        'Sogou web spider',
        'Googlebot-Mobile',
        'AhrefsBot',
        'YandexBot',
        'Purebot',
        'Baiduspider',
        'UnwindFetchor',
        'TweetmemeBot',
        'MetaURI',
        'PaperLiBot',
        'Showyoubot',
        'JS-Kit',
        'PostRank',
        'Crowsnest',
        'PycURL',
        'bitlybot',
        'Hatena',
        'facebookexternalhit',
        'NINJA bot',
        'YahooCacheSystem',
        'NHN Corp.',
        'Steeler',
        'DoCoMo',
    );
    foreach ($bot as $bot) {
        if (stripos($ua, $bot) !== false) {
        return true;
        }
    }
    return false;
}


?>