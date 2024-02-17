<?php
add_action('init', 'create_post_type');
function create_post_type()
{
    //  https://teru1213.com/wordpress-customiz/#index_id2

    //  診療案内
    create_post_type_medical();
    //  スタッフ
    create_post_type_staff();
    //  ニュース
    create_post_type_news();
}

//----------------------------------------
//  カスタム投稿 追加 : 診療案内(medical)
//----------------------------------------
function create_post_type_medical()
{
    //  カスタム投稿タイプの追加
    $labels = array( // 投稿タイプ名の定義
        'name' => '診療案内', // 管理画面上で表示する投稿タイプ名
        'singular_name' => 'medical', // カスタム投稿の識別名
    );
    $args = array(
        'labels' => $labels,
        'public' => true,   // 投稿タイプをpublicにするか
        'has_archive' => false, // アーカイブ機能ON/OFF
        'menu_position'=> 5,    // 管理画面上での配置場所(投稿の下に配置)
        'show_in_rest' => true, // wordpress5.x系から出てきた新エディタ「Gutenberg」を有効にする
        'description' => '', 
        // カスタム投稿で使用する項目を設定（タイトル、エディター、アイキャッチ）
        'supports' => array('title','editor','custom-fields','thumbnail','revisions' ),
    );
    register_post_type('medical', $args );
    
    //  タクソノミー(カテゴリー分け)の定義
    register_taxonomy(
        'medical-category', // タクソノミーの名前
        'medical', //   使用するカスタム投稿タイプ名
        array(
        'hierarchical' => true, // trueだと親子関係が使用可能。falseで使用不可
        'update_count_callback' => '_update_post_term_count',
        'label' => '診療案内カテゴリー',
        'singular_label' => '診療案内カテゴリー',
        'public' => true,
        'show_ui' => true,// 管理画面表示ON/OFF
        'show_in_rest'=> true,  //  記事編集で選択可能
        'show_admin_column' => true,    //  管理画面一覧で表示
        )
    );
}


//----------------------------------------
//  カスタム投稿 追加 : スタッフ(staff)
//----------------------------------------
function create_post_type_staff()
{
    //  カスタム投稿タイプの追加
    register_post_type('staff', [ // 投稿タイプ名の定義
        'labels' => [
        'name' => 'スタッフ', // 管理画面上で表示する投稿タイプ名
        'singular_name' => 'staff', // カスタム投稿の識別名
        ],
        'public' => true, // 投稿タイプをpublicにするか
        'has_archive' => false, // アーカイブ機能ON/OFF
        'menu_position' => 6, // 管理画面上での配置場所(投稿の下に配置)
        'show_in_rest' => true, // wordpress5.x系から出てきた新エディタ「Gutenberg」を有効にする
        // カスタム投稿で使用する項目を設定（タイトル、エディター、アイキャッチ）
        'supports' => array(
            'title',
            //'editor', //  消すと編集画面がデータ用のものになりカスタムフィールドの追加画面が出る
            'custom-fields',
            'thumbnail',
            'revisions',
            ),
        ]
    );
    
    //  タクソノミー(カテゴリー分け)の定義
    register_taxonomy(
        'staff-category', // タクソノミーの名前
        'staff',          // 使用するカスタム投稿タイプ名
        array(
        'hierarchical' => true, // trueだと親子関係が使用可能。falseで使用不可
        'update_count_callback' => '_update_post_term_count',
        'label' => 'スタッフカテゴリー',
        'singular_label' => 'スタッフカテゴリー',
        'public' => true,
        'show_ui' => true,// 管理画面表示ON/OFF
        'show_in_rest'=> true,  //  記事編集で選択可能
        'show_admin_column' => true,    //  管理画面一覧で表示
        )
    );
}


//----------------------------------------
//  カスタム投稿 追加 : ニュース(news)
//----------------------------------------
function create_post_type_news()
{
    //  カスタム投稿タイプの追加
    register_post_type('news', [ // 投稿タイプ名の定義
        'labels' => [
        'name' => 'ニュース', // 管理画面上で表示する投稿タイプ名
        'singular_name' => 'news', // カスタム投稿の識別名
        ],
        'public' => true, // 投稿タイプをpublicにするか
        'has_archive' => true, // アーカイブ機能ON/OFF
        'menu_position' => 7, // 管理画面上での配置場所(投稿の下に配置)
        'show_in_rest' => true, // wordpress5.x系から出てきた新エディタ「Gutenberg」を有効にする
        // カスタム投稿で使用する項目を設定（タイトル、エディター、アイキャッチ）
        'supports' => array(
            'title',
            'editor', //  消すと編集画面がデータ用のものになりカスタムフィールドの追加画面が出る
            'custom-fields',
            //'thumbnail',
            'revisions',
            ),
        ]
    );
    
    //  タクソノミー(カテゴリー分け)の定義
    register_taxonomy(
        'news-category', // タクソノミーの名前
        'news',          // 使用するカスタム投稿タイプ名
        array(
        'hierarchical' => true, // trueだと親子関係が使用可能。falseで使用不可
        'update_count_callback' => '_update_post_term_count',
        'label' => 'ニュースカテゴリー',
        'singular_label' => 'ニュースカテゴリー',
        'public' => true,
        'show_ui' => true,// 管理画面表示ON/OFF
        'show_in_rest'=> true,  //  記事編集で選択可能
        'show_admin_column' => true,    //  管理画面一覧で表示
        )
    );
}


//----------------------------------------
//  メニュー画面でのみ投稿タイプ名の表示を変える
//  ( 利用者の利便性を考慮した表示 )
//----------------------------------------
function Change_menulabel() {
	global $menu;
	global $submenu;
	$menu[5][0] = "★【".$menu[5][0]."】";  //  投稿
	$menu[6][0] = "★【".$menu[6][0]."】";  //  診療案内
	$menu[7][0] = "★【".$menu[7][0]."】";  //  スタッフ
	$menu[8][0] = "★【".$menu[8][0]."】";  //  お知らせ
	//$submenu['edit.php'][5][0] = $name.'一覧';
	//$submenu['edit.php'][10][0] = '新しい'.$name;
}
add_action( 'admin_menu', 'Change_menulabel' );

?>
