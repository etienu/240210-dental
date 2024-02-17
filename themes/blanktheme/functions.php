<?php
//  ※リンク移動で謎の404が発生した場合
//  キャッシュされているリンクの初期化方法
//global $wp_rewrite;
//$wp_rewrite->flush_rules();

//-----------------------------------------------------
//  グローバル変数
//-----------------------------------------------------
// パス
$WP_ROOT_PATH = get_stylesheet_directory_uri();
//  相対(Relative)パス
//  PHPのincludeは相対パス
$WP_IMG_PATH_R= esc_html( 'assets/img/' );
$WP_CSS_PATH_R= esc_html( 'assets/css/' );
$WP_JS_PATH_R = esc_html( 'assets/js/' );
$WP_LIB_PATH_R = esc_html( 'assets/lib/' );
$WP_PHP_PATH_R= esc_html( 'php/' );
$WP_FONT_PATH_R= esc_html( 'assets/webfonts/' );

//  img/cssは絶対パス
$WP_IMG_PATH= esc_html( $WP_ROOT_PATH . '/'. $WP_IMG_PATH_R );
$WP_CSS_PATH= esc_html( $WP_ROOT_PATH . '/'. $WP_CSS_PATH_R );
$WP_JS_PATH = esc_html( $WP_ROOT_PATH . '/'. $WP_JS_PATH_R );
$WP_LIB_PATH = esc_html( $WP_ROOT_PATH . '/'. $WP_LIB_PATH_R );
$WP_PHP_PATH= esc_html( $WP_ROOT_PATH . '/'. $WP_PHP_PATH_R );
$WP_FONT_PATH= esc_html( $WP_ROOT_PATH . '/'. $WP_FONT_PATH_R );
function GET_PATH(string $_type = 'img')
{
    global $WP_ROOT_PATH;
    global $WP_IMG_PATH;
    global $WP_CSS_PATH;
    global $WP_JS_PATH;
    global $WP_LIB_PATH;
    global $WP_PHP_PATH;
    global $WP_FONT_PATH;    
    switch ($_type) {
        case 'root': return $WP_ROOT_PATH;  break;
        case 'img': return $WP_IMG_PATH;  break;
        case 'css': return $WP_CSS_PATH;  break;
        case 'js':  return $WP_JS_PATH;   break;
        case 'lib':  return $WP_LIB_PATH;   break;
        case 'php': return $WP_PHP_PATH;  break;
        case 'tpl': return $WP_PHP_PATH."tpl/";  break;
        case 'font': return $WP_FONT_PATH;  break;
        default:  return '';      break;
    }
}


function GET_PATH_R(string $_type = 'img')
{
    global $WP_ROOT_PATH;
    global $WP_IMG_PATH_R;
    global $WP_CSS_PATH_R;
    global $WP_JS_PATH_R;
    global $WP_LIB_PATH_R;
    global $WP_PHP_PATH_R;
    global $WP_FONT_PATH_R;
    switch ($_type) {
        case 'img': return $WP_IMG_PATH_R;  break;
        case 'css': return $WP_CSS_PATH_R;  break;
        case 'js':  return $WP_JS_PATH_R;   break;
        case 'lib':  return $WP_LIB_PATH_R;   break;
        case 'php': return $WP_PHP_PATH_R;  break;
        case 'tpl': return $WP_PHP_PATH_R."tpl/";  break;
        case 'font': return $WP_FONT_PATH_R;  break;
        default:  return '';      break;
    }
}

//

// メインループの表示件数制御
$WP_ROOP_VIEW_ARCHIVE = 3;
$WP_ROOP_VIEW_TAX = 3;

// OGP用
$FACEBOOK_APP_ID = '';
$TWITTER_ACCOUNT_ID = '';

//  パスワードなどの設定は分離
include GET_PATH_R('php')."inc/info.php";


//----------------------------------------------------
//  初期化
//----------------------------------------------------
//  デフォルトjQuery削除
function remove_default_jquery() {
  if ( !is_admin() ) { wp_deregister_script( 'jquery' ); }
}
add_action('init', 'remove_default_jquery');

function my_after_setup()
{
    // 翻訳ファイルの場所を指定
    load_theme_textdomain('blankslate', get_template_directory() . '/languages');
    // 管理画面の設定ページで設定したタイトルを<title>に使用する
    add_theme_support('title-tag');
    // 投稿でサムネイルを有効にする
    add_theme_support('post-thumbnails');
    // YouTubeなどの埋め込みコンテンツをレスポンシブ対応にする
    add_theme_support('responsive-embeds');
    // 投稿とコメントのRSSフィードのリンクを有効にする
    add_theme_support('automatic-feed-links');
    // html5で出力する
    add_theme_support('html5', array(
        'comment-list',
        'comment-form',
        'search-form',
        'gallery',
        'caption',
    ));
    // ナビゲーション
    register_nav_menus(array('header-menu' => esc_html__('ヘッダーメニュー', 'blankslate')));
}
add_action('after_setup_theme', 'my_after_setup' );


//親ページ条件分岐確認
function is_parent_slug() {
  global $post;
  if( is_404() ) return '404';
  if ($post->post_parent) {
      $post_data = get_post($post->post_parent);
      return $post_data->post_name;
  }
}

//  記事ループ中、取得記事が新着か確認
//  https://wordpressday.jp/wp-customization/2206/
function is_post_new( $i_type = "days", $i_limit = 3, $i_post = null ){
  //  記事指定なし
  if( !$i_post ){
    switch( $i_type ){
    //  日付
    case 'days' :
        $days = $i_limit;  //  期限日数
        $today = date_i18n('U');
        $entry_day = get_the_time('U'); //  記事の時間取得
        $keika = date('U',($today - $entry_day)) / 86400;
        if ( $days > $keika ) return true;
        break;
    }
  }
  //  記事指定あり
  else{

  }
  return false;
}


//  セキュリティ
//  ログインアドレスは簡易変更なので、wp-guardに任せた方が良い
include GET_PATH_R('php')."inc/func_security.php";

//  JS読み込み
include GET_PATH_R('php')."inc/func_loadjs.php";
//  CSS読み込み
include GET_PATH_R('php')."inc/func_loadcss.php";

//  <head>タグに関する処理
include GET_PATH_R('php')."inc/func_head.php";
//  Contact Form 7 に関する記述	
include GET_PATH_R('php')."inc/func_cf7.php";

//  管理画面に対する処理
include GET_PATH_R('php')."inc/func_controlpanel.php";

//  ユーザーが見るページに対する処理
//  archive.phpのスラッグ変更 : /blog/
include GET_PATH_R('php')."inc/func_page.php";


//-----------------------------------------------------
//  基本設定
//-----------------------------------------------------
//wp-block-library読み込み停止(グーテンベルク)
function remove_unuse_css() { wp_dequeue_style('wp-block-library');  }
add_action( 'wp_enqueue_scripts', 'remove_unuse_css' ,9999);


//  カスタム投稿タイプとカスタムカテゴリーの作成
include GET_PATH_R('php')."inc/custompost.php";

//  カスタムフィールドの作成
include GET_PATH_R('php')."inc/customfield.php";
include GET_PATH_R('php')."inc/customfield-staff.php";
include GET_PATH_R('php')."inc/customfield-medical.php";



//----------------------------------------------------
//  メールの送信設定
//  wp_mail()はPHPMailerを使用している
//----------------------------------------------------
add_action("phpmailer_init", function ($phpmailer) {
    $phpmailer->isSMTP();                     //SMTP有効設定
    $phpmailer->Host       = SMTP_HOST;       //メールサーバーのホスト名
    $phpmailer->SMTPAuth   = true;            //SMTP認証の有無（true OR false）
    $phpmailer->Port       = SMTP_PORT;       //SMTPポート番号(ssl:465 tls:587)
    $phpmailer->Username   = SMTP_USERNAME;   //ユーザー名
    $phpmailer->Password   = SMTP_PASSWORD;   //パスワード
    $phpmailer->SMTPSecure = "ssl";           //SMTP暗号化方式（ssl OR tls）
    $phpmailer->From       = get_option( 'admin_email' );    //送信者メールアドレス（Gmailの場合は反映されない）
  });




//  メニューの登録
include GET_PATH_R('php')."inc/menu.php";

//  ウィジェット
include GET_PATH_R('php')."inc/widget.php";


//--------------------------------------------------------
//  投稿ページ設定
//--------------------------------------------------------
//  functions.php に投稿ステータスをフックする追記をして
//  下書きや非公開の親ページを選択可能に
include GET_PATH_R('php')."inc/post-attributes.php";

//  記事 : カスタムブロック追加
//  liにファイルツリーのスタイルを適用する為の選択
register_block_style(
    'core/list',
    array(
        'name' => 'tree',
        'label' => 'ツリー構造',
    )
);


//--------------------------------------------------------
//  機能追加
//--------------------------------------------------------
//  アクセスカウンター
//include GET_PATH_R('php')+"inc/access-counter.php";
// 閲覧数の保存する関数を定義、headerに導入
function update_views() {
  global $post;
  //  投稿記事ページ( single )、かつ公開記事だった場合
  if ( 'publish' === get_post_status( $post ) && is_single() ) {
    //  ログイン中ではない、ボットではない = 外部の正式な訪問者
    if( !is_user_logged_in() && !is_bot() ){
      //  保存してある"views"を取得
      $views = intval( get_post_meta( $post->ID, 'external_viewers', true ) );
      //  "views"に1加算して保存
      update_post_meta( $post->ID, 'external_viewers', ( $views + 1 ) );

    //  何者かのアクセス
    }else{
      //  保存してある"views"を取得
      $views = intval( get_post_meta( $post->ID, 'views', true ) );
      //  "views"に1加算して保存
      update_post_meta( $post->ID, 'views', ( $views + 1 ) );
    }
  }
}
add_action( 'wp_head', 'update_views' );


// 管理画面の投稿一覧に閲覧数用のカラムを追加
function add_column_viewcount( $defaults ) {
  $defaults['view_column'] = '閲覧数';
  $defaults['external_viewers_column'] = '外部閲覧者数';
  return $defaults;
}
add_filter('manage_posts_columns', 'add_column_viewcount');


// 閲覧数用のカラムに、実際の閲覧数を表示させる
function add_column_id( $column_name, $id ) {
  global $post;
  if ($column_name == 'view_column') {
    $view_column = get_post_meta( $post->ID, 'views', true );
    echo $view_column;
  }
  if ($column_name == 'external_viewers_column') {
    $ev_column = get_post_meta( $post->ID, 'external_viewers', true );
    echo $ev_column;
  }
}
add_action('manage_posts_custom_column', 'add_column_id', 10, 2);


// 追加したカラムにソート（並び替え）機能を追加
function my_add_sort($columns){
  $columns['view_column'] = 'my_sort';
    return $columns;
}
add_filter( 'manage_edit-post_sortable_columns', 'my_add_sort');


// ソートに利用するキーに「閲覧数」を使用するように設定
function my_add_sort_by_meta( $query ) {
  if ( $query->is_main_query() && ( $orderby = $query->get( 'orderby' ) ) ) {
    switch( $orderby ) {
    case 'my_sort':
      $query->set( 'meta_key', 'views' );
      $query->set( 'orderby', 'meta_value_num' );
      break;
    }
  }
}
add_action( 'pre_get_posts', 'my_add_sort_by_meta', 1 );


//--------------------------------------------------------
//  ショートコード
//--------------------------------------------------------
include GET_PATH_R('php')."inc/shortcode.php";


//--------------------------------------------------------
//  仕組み修正
//--------------------------------------------------------
//  テンプレートファイル名命名規則の操作
//  page-下層スラッグ.php →  page-親スラッグ__下層スラッグ.php
include GET_PATH_R('php')."inc/slug-naming-rule.php";
//  アーカイブタイトルの書き換え
include GET_PATH_R('php')."inc/archive-title-rename.php";
//  検索結果から固定ページを除外
include GET_PATH_R('php')."inc/search-ignore.php";

//  プラグイン :breadcrumb navXT の投稿画面にのみカテゴリ名が出ない事を修正する
function my_static_breadcrumb_adder( $breadcrumb_trail ) {
  $item ="";
  if (is_post_type_archive('blog')) { // デフォルトの投稿一覧ページの場合
    $item = new bcn_breadcrumb('スタッフブログ', null, array('blog'));
  } elseif (get_post_type() === 'post') { // デフォルトの投稿ページの場合
    $item = new bcn_breadcrumb('スタッフブログ', null, array('blog'), home_url('blog/'), null, true);
  }

  $stuck = array_pop( $breadcrumb_trail->breadcrumbs ); // HOME 一時退避
  $breadcrumb_trail->breadcrumbs[] = $item; // 制作実績 追加
  $breadcrumb_trail->breadcrumbs[] = $stuck; // HOME 戻す
}
add_action('bcn_after_fill', 'my_static_breadcrumb_adder');

//  PHP END
?>
