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
                <p>
                お問い合わせありがとうございました。<br>
                3営業日以内に返信いたしますので、しばらくお待ちいただけますと幸いです。<br>
                <span class="red">※3営業日以内に当院からの返信がない場合には、お電話(TEL 03-1234-5678)にてお問い合わせ下さい。</span><br>
                </p>
            </div>
        </div>
    </section>
    <!-- main:END -->
    </main>


<?php get_footer(); ?>
</body>

</html>
