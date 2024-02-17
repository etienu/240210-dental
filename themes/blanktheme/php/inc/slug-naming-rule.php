<?php
//--------------------------------------------------------
//  テンプレートファイル名命名規則を弄る
//  ドメイン/親スラッグ/下層スラッグ
//  に対して
//  page-親スラッグ__下層スラッグ.php
//  というファイル名で対応できるようにする
//
//  例)
//  https://abc.com/contact/ : page-contact.php
//  https://abc.com/contact/thanks/ : page-contact__thanks.php
//  https://abc.com/contact-thanks/ : page-contact-thanks.php
//  以下の様に名前が被る下層ファイルがある場合に有効
//  https://abc.com/reserv/ : page-reserv.php
//  https://abc.com/reserv/thanks/ : page-reserv__thanks.php
//--------------------------------------------------------
add_filter('page_template_hierarchy', 'my_page_templates');
function my_page_templates($templates) {
    global $wp_query;

    $template = get_page_template_slug();
    $pagename = $wp_query->query['pagename'];

    if ($pagename && ! $template) {
        $pagename = str_replace('/', '__', $pagename);
        $decoded = urldecode($pagename);

        if ($decoded == $pagename) {
            array_unshift($templates, "page-{$pagename}.php");
        }
    }

    return $templates;
}

?>