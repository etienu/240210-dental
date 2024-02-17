<?php
//=================================================================
//
//    ショートコード
//
//=================================================================
//-----------------------------------------------------------------
//
//  文字列の中のURLパラメータバインド変数({%パラメータ名})を実際の値に置換
//
//-----------------------------------------------------------------
function replace_req_params($atts, $content){
	
	//パラメータ初期化
	extract(shortcode_atts(array(
		'encode' => 'esc_html', //使用するエンコードorエスケープ関数 esc_html, urlencode
	), $atts));

	if($encode != "esc_html" && $encode != "urlencode"){
		return null; //それ以外エンコード指定は危ないので出力しない
	}	
		
	return replace_req_params_base($atts, $content);

}

add_shortcode('replace_req_params', 'replace_req_params');



// 不要なページで出力されているCSSとスクリプトを確認する
//	https://digipress.info/wordpress/tips/how-to-disable-plugin-css-js-in-specific-pages/
function dp_display_pluginhandles() {
	$wp_styles = wp_styles();
	$wp_scripts = wp_scripts();
	$handlename = '<dl><dt>Queuing scripts</dt><dd><ul>';
	foreach( $wp_styles->queue as $handle ) :
	  $handlename .=  '<li>' . $handle .'</li>';
	endforeach;
	$handlename .= '</ul></dd>';
	$handlename .= '<dt>Queuing styles</dt><dd><ul>';
	foreach( $wp_scripts->queue as $handle ) :
	  $handlename .=  '<li>' . $handle .'</li>';
	endforeach;
	$handlename .= '</ul></dd></dl>';
	return $handlename;
  }
  add_shortcode( 'pluginhandles', 'dp_display_pluginhandles');

?>