<!DOCTYPE html>
<html lang="ja-JP">
<?php get_header(); ?>
<body>

<?php $pageid = "medical"; ?>

<?php /* ヘッダーバー */ ?>
<?php get_template_part(GET_PATH_R('tpl').'obj/p-headerbar', null, ['page'=>$pageid]); ?>

<?php /* SUB FV */ ?>
<?php get_template_part(GET_PATH_R('tpl').'obj/p-fvsub', null,
    ['page'=>$pageid,'ttl'=>'診療案内','enttl'=>'MEDICAL'] ); ?>

<?php /* パンくず */ ?>
<?php get_template_part(GET_PATH_R('tpl').'obj/p-breadcrumb', null, ['page'=>$pageid] ); ?>


    <main class="l-main" id="<?php echo $pageid;?>">
    <!-- section : concept -->
    <section class="l-section --center p-medical" id="<?php echo $pageid;?>">
        <div class="p-medical-taglistwrap">
            <div class="l-heading --left">
                <h2 class="c-ttl --n">一般診療</h2><p class="tag --blue">保険対象</p>
            </div>
            <ul class="p-medical-taglist">
                <li class="item"><a href="#g1"><div class="p-medical-tagitem"><span class="txt">一般歯科</span></div></a></li>
                <li class="item"><a href="#g2"><div class="p-medical-tagitem"><span class="txt">小児歯科</span></div></a></li>
                <li class="item"><a href="#g3"><div class="p-medical-tagitem"><span class="txt">予防歯科</span></div></a></li>
            </ul>
        </div>
        <div class="p-medical-taglistwrap --special">
            <div class="l-heading --left">
                <h2 class="c-ttl --n">特殊診療</h2><p class="tag --red">実費</p>
            </div>
            <ul class="p-medical-taglist">
                <li class="item"><a href="#s1"><div class="p-medical-tagitem"><span class="txt">入れ歯</sapn></div></a></li>
                <li class="item"><a href="#s2"><div class="p-medical-tagitem"><span class="txt">矯正歯科</sapn></div></a></li>
                <li class="item"><a href="#s3"><div class="p-medical-tagitem"><span class="txt">ホワイトニング</sapn></div></a></li>
                <li class="item"><a href="#s4"><div class="p-medical-tagitem"><span class="txt">口腔外科</sapn></div></a></li>
                <li class="item"><a href="#s5"><div class="p-medical-tagitem"><span class="txt">レーザー治療</sapn></div></a></li>
            </ul>
        </div>

        <!-- 一般診療 -->
        <div class="p-medical-article-wrap --normal">
            <div class="p-section-top-bg"></div>
            <div class="p-medical-article-body">
                <div class="l-heading --center">
                    <div class="c-anchor-t100" id="gtop"></div>
                    <h2 class="c-ttl --sec">一般診療</h2>
                </div>

                <?php /* 診療案内リスト : 一般診療 */ ?>
                <?php get_template_part(GET_PATH_R('tpl').'obj/p-medical-card-list', null,
                ['type'=>'loop', 'cat'=>'general'] ); ?>
            </div>
            <div class="p-section-bottom-bg"></div>
        </div>

        <!-- 特殊診療 -->
        <div class="p-medical-article-wrap --special">
            <div class="p-section-top-bg"></div>
            <div class="p-medical-article-body">
                <div class="l-heading --center">
                    <div class="c-anchor-t100" id="stop"></div>
                    <h2 class="c-ttl --sec">特殊診療</h2>
                </div>
                <?php /* 診療案内リスト : 特殊診療 */ ?>
                <?php get_template_part(GET_PATH_R('tpl').'obj/p-medical-card-list', null,
                ['type'=>'loop', 'cat'=>'special'] ); ?>
            </div>
            <div class="p-section-bottom-bg"></div>
        </div>
    </section>
    <!-- section:END -->
    </main>

<?php get_footer(); ?>
</body>

</html>
