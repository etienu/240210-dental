<!DOCTYPE html>
<html lang="ja-JP">
<?php get_header(); ?>
<body>

<?php $pageid = "about"; ?>

<?php /* ヘッダーバー */ ?>
<?php get_template_part(GET_PATH_R('tpl').'obj/p-headerbar', null, ['page'=>$pageid]); ?>

<?php /* SUB FV */ ?>
<?php get_template_part(GET_PATH_R('tpl').'obj/p-fvsub', null,
    ['page'=>$pageid,'ttl'=>'当院について','enttl'=>'ABOUT OUR CLINIC'] ); ?>

<?php /* パンくず */ ?>
<?php get_template_part(GET_PATH_R('tpl').'obj/p-breadcrumb', null, ['page'=>$pageid] ); ?>


    <main class="l-main" id="<?php echo $pageid;?>">
    <!-- section : concept -->
    <section class="l-section --center p-concept --about" id="concept">
        <div class="l-heading --center">
            <div class="c-anchor-t100" id="policy"></div>
            <h2 class="c-ttl --sec">ポリシーと特徴</h2>
        </div>
        <div class="p-concept__inner --about">
            <ul class="list">
                <li class="item">
                    <div class="p-concept-bg --about">
                        <img src="<?php echo GET_PATH()?>common/concept-bg.svg" alt="" width="1306" height="715">
                    </div>
                    <div class="p-concept-img" data-eff="fadein-right">
                        <picture>
                            <source media="(max-width: 768px)" srcset="<?php echo GET_PATH()?>about/policy_1@2x.jpg 2x">
                            <img src="<?php echo GET_PATH()?>about/policy_1.jpg" alt="ポリシー" width="640" height="438">
                        </picture>
                    </div>
                    <div class="p-concept-txtwrap" data-eff="fadein-up">
                        <p class="sec-ttl">POLICY</p>
                        <h2 class="ttl">コミュニケーションから始まる最適な医療提供</h2>
                        <p class="txt">当院ではまず患者様から詳しくお話を伺います。<br>
                            難しい言葉は使わず、実際に感じている小さな違和感からあらゆる可能性を考え、最適な治療方法をご提案いたします。</p>

                        <p class="txt">「どこよりも本音で話せる歯医者さん」を目指し、スタッフ一同、「人間力の向上」にも勤めております。</p>
                    </div>
                </li>

                <li class="item --rev">
                    <div class="p-concept-img" data-eff="fadein-left">
                        <picture>
                            <source media="(max-width: 768px)" srcset="<?php echo GET_PATH()?>about/feature_1@2x.jpg 2x">
                            <img src="<?php echo GET_PATH()?>about/feature_1.jpg" alt="フューチャー" width="640" height="438">
                        </picture>
                    </div>
                    <div class="p-concept-txtwrap" data-eff="fadein-up">
                        <p class="sec-ttl">FEATURE</p>
                        <h2 class="ttl">「医療技術の追求」と<br>「通いやすさ」</h2>
                        <p class="txt">歯の治療において、小さな違和感は大きなストレスにつながります。私たちは常に快適な歯科医療技術の研究を行っております。
                            また、「通いやすさ」も医院選びの重要なポイントと考え、2019年のリニューアルを期に更に駅の近くへ場所を移しました。</p>

                        <p class="txt">朝から夜までお仕事をされている方のために診療時間を見直し、平日でもご利用いただけるようにいたしました。</p>
                    </div>
                </li>
            </ul>
        </div>
    </section>
    <section class="l-section --center p-about" id="about">
        <div class="l-heading --center">
            <div class="c-anchor-t100" id="look"></div>
            <h2 class="c-ttl --sec">院内の様子</h2>
        </div>
        <div class="l-inner p-about__inner">
            <ul class="p-about-list" data-eff="fadein-upgroup">
                <li class="p-about-card">
                    <picture>
                        <source media="(max-width: 768px)" srcset="<?php echo GET_PATH()?>about/inside1@2x.jpg 2x">
                        <img src="<?php echo GET_PATH()?>about/inside1.jpg" alt="院内の様子1" width="317" height="317">
                    </picture>
                </li>
                <li class="p-about-card">
                    <picture>
                        <source media="(max-width: 768px)" srcset="<?php echo GET_PATH()?>about/inside2@2x.jpg 2x">
                        <img src="<?php echo GET_PATH()?>about/inside2.jpg" alt="院内の様子2" width="317" height="317">
                    </picture>
                </li>
                <li class="p-about-card">
                    <picture>
                        <source media="(max-width: 768px)" srcset="<?php echo GET_PATH()?>about/inside3@2x.jpg 2x">
                        <img src="<?php echo GET_PATH()?>about/inside3.jpg" alt="院内の様子3" width="317" height="317">
                    </picture>
                </li>
                <li class="p-about-card">
                    <picture>
                        <source media="(max-width: 768px)" srcset="<?php echo GET_PATH()?>about/inside4@2x.jpg 2x">
                        <img src="<?php echo GET_PATH()?>about/inside4.jpg" alt="院内の様子4" width="317" height="317">
                    </picture>
                </li>
                <li class="p-about-card">
                    <picture>
                        <source media="(max-width: 768px)" srcset="<?php echo GET_PATH()?>about/inside5@2x.jpg 2x">
                        <img src="<?php echo GET_PATH()?>about/inside5.jpg" alt="院内の様子5" width="317" height="317">
                    </picture>
                </li>
                <li class="p-about-card">
                    <picture>
                        <source media="(max-width: 768px)" srcset="<?php echo GET_PATH()?>about/inside6@2x.jpg 2x">
                        <img src="<?php echo GET_PATH()?>about/inside6.jpg" alt="院内の様子6" width="317" height="317">
                    </picture>
                </li>
            </ul>
        </div>
    </section>
    <!-- section:END -->
    </main>

<?php get_footer(); ?>
</body>

</html>
