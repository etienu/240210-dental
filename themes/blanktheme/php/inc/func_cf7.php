<?php
//----------------------------------------------------
//  post成功時にセッションをセット
//  サンクスページアクセス時、このセッションが無いとTOPへリダイレクトさせる（URL直打ちのアクセス対策）
//----------------------------------------------------
add_action('wpcf7_mail_sent', 'my_wpcf7_mail_sent_session_start');
function my_wpcf7_mail_sent_session_start()
{
    session_start();
    $_SESSION['thanks_judge'] = true;
}


//----------------------------------------------------
//  Contact Form 7を使用するページのみ、関係ファイルを読み込ませる
//----------------------------------------------------
/*
add_action('wp_enqueue_scripts', 'my_enqueue_wpcf7_files');
function my_enqueue_wpcf7_files()
{
    if (!is_page('contact')) {
        wp_dequeue_style('contact-form-7');
        wp_dequeue_script('contact-form-7');
        wp_dequeue_script('google-recaptcha');
    }
}
*/

// reCaptcha読み込み制限
function recaptcha_limitation() {
if( !(is_page( 'contact' )) && !(is_parent_slug() === 'contact') &&
        !(is_page( 'reserv' ) ) && !(is_parent_slug() === 'reserv') )
    {
            wp_dequeue_style( 'contact-form-7' );
            wp_dequeue_style( 'wpcf7-redirect-script-frontend' );
            wp_dequeue_style( 'wpcf7-recaptcha' );

            wp_dequeue_script('contact-form-7' );
            wp_dequeue_script('wpcf7-redirect-script' );
            wp_dequeue_script('wpcf7-recaptcha-js' );
            wp_dequeue_script('wpcf7-recaptcha' );
            wp_dequeue_script('google-recaptcha' );
            wp_dequeue_script('google-invisible-recaptcha' );
            wp_dequeue_script('c4wp' );
            //wp_dequeue_script('headjs-bundle' );

            wp_deregister_script( 'contact-form-7' );
            wp_deregister_script( 'wpcf7-recaptcha-js' );
            wp_deregister_script( 'wpcf7-recaptcha' );
            wp_deregister_script( 'google-recaptcha' );
            wp_deregister_script( 'google-invisible-recaptcha' );
            wp_deregister_script( 'c4wp' );
            remove_action( 'wp_loaded', 'C4WP_Settings' );
        }
}
add_action( 'wp_enqueue_scripts', 'recaptcha_limitation' );

?>