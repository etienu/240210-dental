<!DOCTYPE html>
<html lang="ja-JP">
<?php get_header(); ?>
<body>

<?php $pageid = "404"; ?>

<?php /* ヘッダーバー */ ?>
<?php get_template_part(GET_PATH_R('tpl').'obj/p-headerbar', null, ['page'=>$pageid]); ?>

<?php /* SUB FV */ ?>
<?php get_template_part(GET_PATH_R('tpl').'obj/p-fvsub', null,
    ['page'=>$pageid,'ttl'=>'404','enttl'=>'NOT FOUND'] ); ?>

<?php /* パンくず */ ?>
<?php get_template_part(GET_PATH_R('tpl').'obj/p-breadcrumb', null, ['page'=>$pageid] ); ?>


    <main class="l-main">
    <!-- section  -->
    <section class="p-reserv" id="<?php echo $pageid;?>">
        <div class="l-inner p-reserv__inner">
            <div class="p-reserv-txtwrap">
                <div class="l-heading --center u-mb40">
                    <div class="c-anchor-t100" id="404"></div>
                    <h2 class="c-ttl --sec">お探しのページは<br>見つかりませんでした</h2>
                </div>
                <p class="u-mb40">お探しのページは、下記のような理由でご覧いただくことができません。</p>
                <p class="u-mb60">
                    ・入力したURLが間違っているため<br>
                    ・該当するURLページが移転したかURLが変更されたため<br>
                    ・現在、メンテナンス中のため一時的に表示していない<br>
                    ・ページが削除されたため<br>
                </p>
                <p class="u-mb40">一番下のサイトマップからお探しいただくと見つかるかもしれません！</p>
                <div class="l-btn --center">
                    <a href="<?php echo esc_url(home_url('/')) ?>" class="c-btn">トップに戻る</a>
                </div>
            </div>
        </div>
    </section>
    <!-- main:END -->
    </main>


<?php get_footer(); ?>
</body>

</html>
