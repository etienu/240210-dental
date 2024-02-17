<?php
//----------------------------------------------------
//  <title>の区切り文字を変更
//----------------------------------------------------
add_filter('document_title_separator', 'my_document_title_separator');
function my_document_title_separator($sep)
{
    $sep = '|';
    return $sep;
}

//----------------------------------------------------
//  <title>のテキストの形式を変える
//----------------------------------------------------
add_filter('document_title_parts', 'my_document_title_parts', 10, 1);
function my_document_title_parts($title)
{
    if (is_home() || is_front_page()) {
        unset($title['tagline']);
        //  カデコリー
    } else if (is_category()) {
        $title['title'] = '「' . single_term_title('', false) . '」カテゴリー一覧';
        //  タクソノミー
    } else if (is_tax()) {
        $title['title'] = '「' . single_term_title('', false) . '」カテゴリー一覧';
        //  タグ
    } else if (is_tag()) {
        $title['title'] = '「' . single_term_title('', false) . '」タグ一覧';
    }
    return $title;
}


// 固定ページで「抜粋」を有効化
add_post_type_support('page', 'excerpt');

// カテゴリーとタグのmeta descriptionからpタグを除去
remove_filter('term_description','wpautop');

//----------------------------------------------------
//  wp_head()で出力されるタグの内、不要なものを削除
//----------------------------------------------------
//wp_headで出力されるtitleタグを削除( 下記の出力関数で被る為 )
remove_action('wp_head', '_wp_render_title_tag', 1);
//  RSSフィードのURL
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
//  非推奨の読み込み手段
remove_action('wp_head', 'wp_print_styles', 8);
//  絵文字利用可能調整
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');
//  REST APIのURL表示
remove_action('wp_head', 'rest_output_link_wp_head');
//  外部ブログツールからの投稿を受け入れ
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
//  WPバージョンの表記( セキュリティ面で削除推奨 )
remove_action('wp_head', 'wp_generator');
//  短縮URLの出力
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
// ウィジェット「最近のコメント」の表示
function remove_recent_comment_css() {
    global $wp_widget_factory;
    remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
}
add_action( 'widgets_init', 'remove_recent_comment_css');

//  外部コンテンツの埋め込み(サイト内にTwitterやYoutubeなど埋め込む際に必要な機能)
//remove_action('wp_head', 'wp_oembed_add_discovery_links');
//remove_action('wp_head', 'wp_oembed_add_host_js');

//  ページ読み込み速度向上
//add_filter('wp_resource_hints', 'remove_dns_prefetch', 10, 2);
function remove_dns_prefetch($hints, $relation_type)
{
  if ('dns-prefetch' === $relation_type) {
    return array_diff(wp_dependencies_unique_hosts(), $hints);
  }
  return $hints;
}

//  不要なstyle設定の排除
add_action('wp_enqueue_scripts', 'my_dequeue_plugins_style', 9999);
function my_dequeue_plugins_style()
{
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style( 'global-styles' );
    wp_dequeue_style( 'classic-theme-styles' );

}


//----------------------------------------------------
//  wp_head()出力
//----------------------------------------------------
function my_add_head_meta(){
    $post_obj =  get_queried_object(); // 投稿情報まとめ
    $post_title = '';   // ページタイトル
    $post_desc = '';    // ディスクリプション
    $page_type = '';    // website or article
    $ogp_img = '';  // 画像
    $page_url = ''; // ページURL
    $site_name = get_bloginfo('name'); // サイト名
    $head_all = ''; // コードをまとめる

    // 現在のページ、SSL判定
    $http = is_ssl() ? 'https' : 'http' . '://';
    $page_url = $http . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

    //  OGP画像の設定
    //  詳細ページ、かつ画像が設定されていればアイキャッチをOGPに設定
    if ( is_single() && has_post_thumbnail() ) :
        $ps_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
        $ogp_img = $ps_thumb[0];
    else :
        $ogp_img = home_url(GET_PATH().'/ogp/ogp.png');
    endif;

    //  トップページの場合
    if ( is_home() || is_front_page() ) :
        $post_desc = get_bloginfo('description'); // ディスクリプション
        $site_name = get_bloginfo(); // サイト名
        $page_type = 'website';
    //  トップページ以外
    else:
        $page_type = 'article'; //  下層は全てarticle
        // 固定ページ、詳細ページ
        if(is_page() || is_single()):
            if(is_page()):
                $page_name = $post_obj->post_name;
            elseif(is_single()):
                $page_name = $post_obj->name;
            endif;
            $post_title = $post_obj->post_title;
            $post_desc = str_replace('\n',' ',strip_tags(mb_substr($post_obj->post_content,0,150)));
        // 一覧ページ
        elseif(is_archive() || is_tax()):
            if(is_tax()):
                $post_title = $post_obj->name;
            elseif(is_archive()):
                $post_title = $post_obj->label;
            endif;
            $post_desc = $post_obj->description;
        endif;
    endif;

	//  metadescription その他
	if( is_home() || is_front_page() ):
        $post_desc = get_bloginfo('description');
	elseif( is_category() ) :
        $post_desc = category_description();
	elseif( is_tag() ):
        $post_desc = tag_description();
	elseif( is_singular() ) :
        $post_desc = get_the_excerpt();
	endif;


    //  データまとめて出力
    $head_all .="<!-- TDK -->";
    if ( is_home() || is_front_page() ) : // TOPページ
        $head_all .=  "\n".'<title>'.$site_name.' '.$post_desc.'</title>' . "\n";
    else:
        $head_all .=  "\n".'<title>'.$post_title.' | '.$site_name.'</title>' . "\n";
    endif;
    $head_all .= '<meta name="description" content="'.$post_desc.'">' . "\n";
    $head_all .="<!-- TDK END -->";

    $head_all .= '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    $head_all .= '<meta name="format-detection" content="telephone=no">';
	$head_all .= '<meta http-equiv="X-UA-Compatible" content="IE=edge">';   //  基本的には不要

	$head_all .= '<meta name="theme-color" content="#1391e6">';

	$head_all .= '<!-- favicon -->';
	$head_all .= '<link rel="shortcut icon" href="'.GET_PATH().'favicon/favicon.ico">';
    $head_all .= '<link rel="icon" type="image/png" href="'.GET_PATH().'favicon/android-icon.png" sizes="192x192">';
    $head_all .= '<link rel="apple-touch-icon" href="'.GET_PATH().'favicon/apple-icon.png" sizes="180x180">';
	$head_all .= '<!-- favicon END -->';

    //  OGP
	$head_all .= '<!-- OGP -->';
    $head_all .= '<meta property="og:url" content="'.$page_url.'">' . "\n";
    if ( is_home() || is_front_page() ) : // TOPページ
        $head_all .= '<meta property="og:title" content="'.$site_name.' '.$post_desc.'">' . "\n";
    else:
        $head_all .= '<meta property="og:title" content="'.$post_title.' | '.$site_name.'">' . "\n";
    endif;
    $head_all .= '<meta property="og:description" content="'.$post_desc.'">' . "\n";
    $head_all .= '<meta property="og:site_name" content="'.$site_name.'"> ' . "\n";
    $head_all .= '<meta property="og:type" content="'.$page_type.'">' . "\n";
    $head_all .= '<meta property="og:image" content="'.$ogp_img.'">' . "\n";
    $head_all .= '<meta name="twitter:card" content="summary_large_image">' . "\n";
	$head_all .= '<!-- OGP END -->';

    //  他
	$head_all .= '<link rel="canonical" href="'.get_pagenum_link(1).'">';
    //  noindex
    $head_all .= '<meta name="robots" content="noindex,nofollow">';

    echo $head_all;
    // 出力 END
}

add_action( 'wp_head', 'my_add_head_meta');



//----------------------------------------------------
//  OGP関係のタグを出力
//  @see https://saruwakakun.com/html-css/wordpress/ogp
//----------------------------------------------------
//  未使用
//add_action('wp_head', 'my_add_meta_ogp');
function my_add_meta_ogp()
{
  if (is_front_page() || is_home() || is_singular()) {
    global $WP_IMG_PATH;
    global $FACEBOOK_APP_ID;
    global $TWITTER_ACCOUNT_ID;
    global $post;
    $ogp_title = '';
    $ogp_descr = '';
    $ogp_url = '';
    $ogp_img = '';
    $insert = '';

    if (is_singular() && !is_page()) {
        setup_postdata($post);
        $ogp_title = $post->post_title;
        $ogp_descr = mb_substr(get_the_excerpt(), 0, 100);
        $ogp_url = get_permalink();
        wp_reset_postdata();
    } else {
        $ogp_title = get_bloginfo('name');
        $ogp_descr = get_bloginfo('description');
        $ogp_url = home_url();
    }

    // og:type
    $ogp_type = (is_front_page() || is_home()) ? 'website' : 'article';

    // og:image
    if (is_singular() && has_post_thumbnail()) {
        $ps_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
        $ogp_img = $ps_thumb[0];
        $ogp_imgtw = $ps_thumb[0];
        $ogp_imgfb = $ps_thumb[0];
    } else {
        $ogp_img = $WP_IMG_PATH. 'ogp/ogp.png';
        $ogp_imgtw = $WP_IMG_PATH. 'ogp/ogptw.png';
        $ogp_imgfb = $WP_IMG_PATH. 'ogp/ogpfb.png';
    }

    // タグ出力
    $insert .= '<meta property="og:title" content="' . esc_attr($ogp_title) . '">' . "\n";
    $insert .= '<meta property="og:description" content="' . esc_attr($ogp_descr) . '">' . "\n";
    $insert .= '<meta property="og:type" content="' . $ogp_type . '">' . "\n";
    $insert .= '<meta property="og:url" content="' . esc_url($ogp_url) . '">' . "\n";
    $insert .= '<meta property="og:image" content="' . esc_url($ogp_img) . '">' . "\n";
    $insert .= '<meta property="og:site_name" content="' . esc_attr(get_bloginfo('name')) . '">' . "\n";
    $insert .= '<meta name="twitter:card" content="summary_large_image">' . "\n";
    $insert .= '<meta name="twitter:site" content="' . $TWITTER_ACCOUNT_ID . '">' . "\n";
    $insert .= '<meta name="twitter:image" content="'.esc_url($ogp_imgtw).'">' . "\n";
//  $insert .= '<meta name="twitter:domain" content="'.$og_site_domain.'">';

    $insert .= '<meta property="og:locale" content="ja_JP">' . "\n";
    $insert .= '<meta property="fb:app_id" content="' . $FACEBOOK_APP_ID . '">' . "\n";
//  $insert .= '<meta property="og:publisher" content="'.$og_publisher.'">';     //  facebookURL用

    echo $insert;
  }
}

?>