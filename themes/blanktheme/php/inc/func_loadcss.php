<?php
//-----------------------------------------------------
//  ※24/02/16
//  未だにwp_enqueue_styleでもwp_headでもフッターに出力されてしまう問題が解決していない
//  ( wp_enqueue_scriptはフラグによってheadかfooterか自由に出力可能 )
//
//  結論としてwp_headにechoで直書き出力する方法を取っている
//  一般的なmetaもその出力方法なので問題ないと考えている
//-----------------------------------------------------
//    CSS読み込み
//    何故かfooterで読まれてしまう。
//    それだと一瞬でも適応されない時間が出るとまずい。
//-----------------------------------------------------

function my_enqueue_styles(){
//    wp_enqueue_style( "my", get_template_directory_uri() . "/assets/css/style.css?".date('YmdHis'), array(), "1.0.0", "all" );
wp_register_style ('swiper-bundle', GET_PATH('lib'). 'swiper/swiper-bundle.min.css' );
wp_enqueue_style ('mystyle', GET_PATH('css').'style.css', array('swiper-bundle') );
//wp_register_style ('swiper-bundle', GET_PATH('lib'). 'swiper/swiper-bundle.min.css', array(),'1.0','all' );
//wp_enqueue_style ('mystyle', GET_PATH('css').'style.css', array('swiper-bundle'),esc_html(date_i18n('Ymd_His')),'all' );

}
//add_action( "wp_enqueue_scripts", "my_enqueue_styles" );
//add_action( "wp_head", "my_enqueue_styles" );

function my_custom_header_code(){
  wp_enqueue_style ('customstyle', GET_PATH('css').'style.css' );
}
//add_action( 'wp_head', 'my_custom_header_code' );

//-----------------------------------------------------
//    CSS読み込み 強制的にhead内で読み込む
//-----------------------------------------------------
function my_head_styles(){
  $pathcss = GET_PATH('css');
  $pathfont = GET_PATH('font');
  $pathlib = GET_PATH('lib');

  //  css本体
  //echo '<link rel="stylesheet" href="'.$pathcss.'style.css?v='.esc_html(date_i18n('Ymd_His')).'">';
  echo '<link rel="stylesheet" id="swiper-bundle-css" href="'.$pathlib.'swiper/swiper-bundle.min.css?='.esc_html(date_i18n('Ymd_His')).'" type="text/css" media="all">';
  echo '<link rel="stylesheet" id="mystyle-css" href="'.$pathcss.'style.css?ver='.esc_html(date_i18n('Ymd_His')).'" type="text/css" media="all">';
}
add_action('wp_head', 'my_head_styles');

?>
