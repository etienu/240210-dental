<?php

//-----------------------------------------------------
//    JavaScript読み込み
//-----------------------------------------------------
function my_enqueue_scripts(){
    $pathjs = GET_PATH('js');
    $pathlib = GET_PATH('lib');
    //$pathjs = "../js/";
    //$pathlib = "../../lib/";
    $is_footer = true;

    if (!is_admin()) {
      //デフォルトjquery削除
      //wp_deregister_script( 'jquery' );
      //  必要な場合jQuery
      //wp_enqueue_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js', array(), NULL, false);
  
      //  指定名は全て別にしないと最初の１つしか読み込まれない
      wp_register_script( "headjs-gsap", $pathlib . "gsap/gsap.min.js", array(),'1.0', $is_footer );
      wp_register_script( "headjs-motionpath", $pathlib . "gsap/MotionPathPlugin.min.js", array(),'1.0', $is_footer );
      wp_register_script( "headjs-customease", $pathlib . "gsap/CustomEase.min.js", array(),'1.0', $is_footer );
      wp_register_script( "headjs-scrolltrigger", $pathlib . "gsap/ScrollTrigger.min.js", array(),'1.0', $is_footer );
      wp_register_script( "headjs-swiperbundle", $pathlib . "swiper/swiper-bundle.min.js", array(),'1.0',  $is_footer );
      wp_enqueue_script( "headjs-bundle",
        $pathjs . "bundle.js?v=".esc_html(date_i18n('Ymd_His')),
        array('headjs-gsap',
            'headjs-motionpath',
            'headjs-customease',
            'headjs-scrolltrigger',
            'headjs-swiperbundle'
        ),
        '1.0',  $is_footer);  //  trueでフッターに移動
/*
      //	コンタクトフォームのみ
      global $reCAPTCHA_site_key;
      if (is_page('contact')||is_page('contact-confirm') ) :
        wp_enqueue_script( "headjs-recaptcha", "https://www.google.com/recaptcha/api.js?render=".$reCAPTCHA_site_key, false, false );
      endif;
*/  
      //  JavaScript変数受け渡し
        global $template;
      $ary = array(
        'templatepath' => basename( $template ),
        'homeurl' => esc_url( home_url( '/' ) ),
        'imgpath' => GET_PATH(),
        'rootpath' => GET_PATH('root'),
        'slug' => is_404()?'404':get_page(get_the_ID())->post_name,  //  現在ページのスラッグ
      );
      wp_localize_script('headjs-bundle', 'wp_var', $ary );
    }

  }
  add_action( "wp_enqueue_scripts", "my_enqueue_scripts" );
  
  //  上記scriptの読み込み時に特定名称にdeferを付与
  add_filter('script_loader_tag', 'add_defer', 10, 2);
  function add_defer($tag, $handle) {
    //if( $handle !== 'headjs' ) {   return $tag;  }
    if( strpos( $handle, 'headjs' ) === false ) {   return $tag;  }
    return str_replace(' src=', ' defer src=', $tag);
  }
  
  /*
  //  上記scriptの読み込み時に特定名称にasyncを付与
  add_filter('script_loader_tag', 'add_async', 10, 2);
  function add_async($tag, $handle) {
    if($handle !== 'headjs') {   return $tag;  }
    return str_replace(' src=', ' async src=', $tag);
  }
  */

  

//-----------------------------------------------------
//
//  プラグイン : contactform7に関する処理
//
//-----------------------------------------------------
/*
// 該当ファイルのロード停止
add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );

// 限定ページのみロード
function cf7_enqueue_scripts_and_styles(){
  if ( is_page(array( 'contact','contact__thanks','reserv','reserv__thanks' ) ) ) {
      if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
          wpcf7_enqueue_scripts();
      }
      if ( function_exists( 'wpcf7_enqueue_styles' ) ) {
          wpcf7_enqueue_styles();
      }
  }
}
add_action( 'wp_enqueue_scripts', 'cf7_enqueue_scripts_and_styles');
*/
/*
// recaptchaのロード範囲
add_action('wp_enqueue_scripts', function() {
	$page_list = [
	'contact',
	'contact__thanks',
	'reserv', 
	'reserv__thanks', 
	];
	if(is_page($page_list)) return;
	wp_deregister_script('google-recaptcha');
}, 100);
*/

/**
 * コンタクトページ以外でreCAPTCHAを無効化
 */
/*
if (!function_exists('dequeue_recaptcha_scripts')) {
  function dequeue_recaptcha_scripts()
  {
      // Contact Form 7を使用しているページのスラッグ
      $contact_slugs = array(
           // 問い合わせページのスラッグ
          'contact',
          'contact__thanks',
          'reserv',
          'reserv__thanks'
      );

      if (is_page() || is_single()) {
          global $post;
          $slug = $post->post_name;

          $is_contact_page = in_array($slug, $contact_slugs);
          
          if(!$is_contact_page) {
              // 問い合わせページ以外で無効化
              wp_dequeue_script('google-recaptcha');
              wp_dequeue_script('wpcf7-recaptcha');
          }
      } else {
          // 固定ページ・投稿ページ以外では無効化
          wp_dequeue_script('google-recaptcha');
          wp_dequeue_script('wpcf7-recaptcha');
      }
  }
  add_action('wp_enqueue_scripts', 'dequeue_recaptcha_scripts', 100, 1);
}

function load_recaptcha_js() {
  //お問い合わせページ以外では読み込まない
  if (! is_page( array( 'contact', 'reserv' ) )) {
      wp_deregister_script( 'google-recaptcha' );
  }
}
add_action( 'wp_enqueue_scripts', 'load_recaptcha_js',100 );
*/
?>