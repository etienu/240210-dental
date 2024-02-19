<?php
    //  日付の文字列
    $post_date = get_the_date( 'Y-m-d' );
    $post_datetxt = get_the_date( 'Y.m.d' );
?>
<!DOCTYPE html>
<html lang="ja-JP">
<?php get_header(); ?>
<body>

<?php $pageid = "news-blog"; ?>

<?php /* ヘッダーバー */ ?>
<?php get_template_part(GET_PATH_R('tpl').'obj/p-headerbar', null, ['page'=>$pageid]); ?>

<?php /* SUB FV */ ?>
<?php get_template_part(GET_PATH_R('tpl').'obj/p-fvsub', null,
    ['page'=>$pageid,'ttl'=>'お知らせ','enttl'=>'NEWS'] ); ?>

<?php /* パンくず */ ?>
<?php get_template_part(GET_PATH_R('tpl').'obj/p-breadcrumb', null, ['page'=>$pageid] ); ?>


    <div class="p-news" id="<?php echo $pageid;?>">
        <div class="l-inner p-news__inner">
            <!-- section  -->
            <main class="l-main p-news-main">
            <?php /* ニュースリスト */ ?>
                <?php get_template_part(GET_PATH_R('tpl').'obj/p-news-card-list', null,
                ['page'=>'news', 'type'=>'line', 'cat'=>'news', 'limit'=>10 ] ); ?>
                <div class="l-btn --center u-mt60">
                    <a href="<?php echo esc_url(home_url('/')) ?>">
                        <div class="c-btn">
                            トップに戻る
                        </div>
                    </a>
                </div>

            </main>
            <!-- main:END -->

        </div>
    </div>


<?php get_footer(); ?>
</body>

</html>
