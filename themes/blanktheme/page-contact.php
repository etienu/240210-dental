<?php
?>

<!DOCTYPE html>
<html lang="ja-JP">
<?php get_header(); ?>
<body>

<?php $pageid = "contact"; ?>

<?php /* ヘッダーバー */ ?>
<?php get_template_part(GET_PATH_R('tpl').'obj/p-headerbar', null, ['page'=>$pageid]); ?>

<?php /* SUB FV */ ?>
<?php get_template_part(GET_PATH_R('tpl').'obj/p-fvsub', null,
    ['page'=>$pageid,'ttl'=>'お問い合わせ','enttl'=>'CONTACT'] ); ?>

<?php /* パンくず */ ?>
<?php get_template_part(GET_PATH_R('tpl').'obj/p-breadcrumb', null, ['page'=>$pageid] ); ?>


    <main class="l-main">
    <!-- section  -->
    <section class="p-contact" id="<?php echo $pageid;?>">
        <div class="l-inner p-contact__inner">
            <div class="p-contact-txtwrap">
                <p>
                お急ぎの方は、お電話(TEL 03-1234-5678)での連絡がスムーズです。<br>
                以下のフォームからお問い合わせ頂いた場合、ご連絡が2～3日後になる場合がございます。<br>
                また、メールアドレスの入力間違いにより送信できない事が発生しておりますので、メールアドレスは正しくご入力下さい。<br>
                <br>
                <span class="red">
                ※3営業日以内に当院からの返信がない場合には、お電話(TEL 03-1234-5678)にてお問い合わせ下さい。
                </span>
                </p>
            </div>
            <div class="l-heading --center u-mb70">
                <h2 class="c-ttl --sec">お問い合わせフォーム</h2>
            </div>
            <div class="p-contact__form" data-js="contactform" data-name="contact">
                <?php echo do_shortcode('[contact-form-7 id="6e567a6" title="お問い合わせ"]'); ?>
            </div>
        </div>
    </section>
    <!-- main:END -->
    </main>


<?php get_footer(); ?>
</body>

</html>
