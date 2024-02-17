<!DOCTYPE html>
<html lang="ja-JP">
<?php get_header(); ?>
<body>

<?php $pageid = "reserv"; ?>

<?php /* ヘッダーバー */ ?>
<?php get_template_part(GET_PATH_R('tpl').'obj/p-headerbar', null, ['page'=>$pageid]); ?>

<?php /* SUB FV */ ?>
<?php get_template_part(GET_PATH_R('tpl').'obj/p-fvsub', null,
    ['page'=>$pageid,'ttl'=>'WEB予約','enttl'=>'RESERVE'] ); ?>

<?php /* パンくず */ ?>
<?php get_template_part(GET_PATH_R('tpl').'obj/p-breadcrumb', null, ['page'=>$pageid] ); ?>


    <main class="l-main">
    <!-- section  -->
    <section class="p-reserv" id="<?php echo $pageid;?>">
        <div class="l-inner p-reserv__inner">
            <div class="p-reserv-txtwrap">
                <h2 class="c-ttl --n">お電話でのご予約/ご相談</h2>
                <div class="telwrap">
                    <i class="c-icon --tel"></i>
                    <p class="tel">
                        <span class="num">03-1234-5678</span>
                        <span class="sub">(年中無休 AM9:00〜PM22:00)</span>
                    </p>
                </div>
                <p class="txt">
                    お急ぎの方は電話での連絡がスムーズです。<br>
                    混雑状況によっては当日受診をご利用いただけない場合がございます。<br>
                    あらかじめご了承ください。<br>
                </p>
                <h2 class="c-ttl --n">メールでのご予約/ご相談</h2>
                <p class="txt">
                    【ご予約に関しての注意点】<br>
                    メールアドレスの入力間違いにより送信できない事が発生しておりますので、メールアドレスは正しくご入力下さい。<br>
                    ※24時間以内に当院からの返信がない場合には、お電話(TEL 03-1234-5678)にてお問い合わせ下さい。<br>
                </p>
            </div>
            <div class="l-heading --center u-mb70">
                <h2 class="c-ttl --sec">予約フォーム</h2>
            </div>
            <div class="p-reserv__form" data-js="contactform" data-name="reserv">
                <?php echo do_shortcode('[contact-form-7 id="326d9a3" title="WEB予約"]'); ?>
            </div>
        </div>
    </section>
    <!-- main:END -->
    </main>


<?php get_footer(); ?>
</body>

</html>
