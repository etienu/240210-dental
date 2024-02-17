<!DOCTYPE html>
<html lang="ja-JP">
<?php
/*
※ CSSはみ出し確認
$$("*").forEach(v => v.style.outline = '1px solid red')
*/
?>    
<?php get_header();

?>
<body>
<?php $pageid = "top"; ?>

<?php /* ヘッダーバー */ ?>
<?php get_template_part(GET_PATH_R('tpl').'obj/p-headerbar', null, ['page'=>$pageid]); ?>

    <!-- FV -->
    <div class="l-section p-fv" id="fv">
        <div class="p-fv-bg">
            <!-- スワイパー-->
            <div class="p-fv-swiper">
                <div class="swiper" data-name="fv">
                    <div class="swiper-wrapper">
                        <!-- Slides 1 -->
                        <div class="swiper-slide">
                            <picture>
                                <source media="(max-width: 767px)" srcset="<?php echo GET_PATH()?>/fv/sp/fv1.jpg, <?php echo GET_PATH()?>/fv/sp/fv1@2x.jpg 2x">
                                <source media="(min-width: 768px)" srcset="<?php echo GET_PATH()?>fv/fv1.jpg, <?php echo GET_PATH()?>/fv/fv1@2x.jpg 2x">
                                <img src="<?php echo GET_PATH()?>/fv/fv1@2x.jpg" alt="" width="1160" height="520">
                            </picture>
                        </div>
                        <!-- Slides 2 -->
                        <div class="swiper-slide">
                            <picture>
                                <source media="(max-width: 767px)" srcset="<?php echo GET_PATH()?>/fv/sp/fv2.jpg, <?php echo GET_PATH()?>/fv/sp/fv2@2x.jpg 2x">
                                <source media="(min-width: 768px)" type="image/png" srcset="<?php echo GET_PATH()?>/fv/fv2.jpg, <?php echo GET_PATH()?>/fv/fv2@2x.jpg 2x">
                                <img src="<?php echo GET_PATH()?>/fv/fv2@2x.jpg" alt="" width="1160" height="520">
                            </picture>
                        </div>
                        <!-- Slides 3 -->
                        <div class="swiper-slide">
                            <picture>
                                <source media="(max-width: 767px)" srcset="<?php echo GET_PATH()?>/fv/sp/fv3.jpg, <?php echo GET_PATH()?>/fv/sp/fv3@2x.jpg 2x">
                                <source media="(min-width: 768px)" srcset="<?php echo GET_PATH()?>/fv/fv3.jpg, <?php echo GET_PATH()?>/fv/fv3@2x.jpg 2x">
                                <img src="<?php echo GET_PATH()?>/fv/fv3@2x.jpg" alt="" width="1160" height="520">
                            </picture>
                        </div>
                    </div>
                </div><!-- swiper -->
                <!-- navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
                <!-- pagination  -->
                <div class="swiper-pagination"></div>
                <div class="p-fv-swiper-inner">
                    <div class="p-fv-swiper-content">
                        <h2 class="ttl">
                            <span>街の皆さまの笑顔を守る</span>
                            <span>アットホームな歯医者さん</span>
                        </h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-fv-content">
            <div class="p-fv-newswrap">
                <div class="l-heading p-fv-news-heading">
                    <h2 class="c-ttl --fvnews">お知らせ<span>NEWS</span></h2>
                    <a href="<?php echo esc_url(home_url( '/news/' )) ?>" class="oldlink">過去のお知らせはこちら</a>
                </div>
                <?php /* ニュースリスト */ ?>
                <?php get_template_part(GET_PATH_R('tpl').'obj/p-news-card-list', null,
                ['page'=>'top', 'type'=>'line', 'cat'=>'news', 'limit'=>3 ] ); ?>
            </div>
            <!-- 週間受付時間表-->
            <?php get_template_part(GET_PATH_R('tpl').'obj/p-weeklytable' ); ?>
        </div>
    </div>
    <!-- div:END -->

    <main class="l-main" id="top">
    <!-- section : concept -->
    <section class="l-section p-concept" id="concept">
        <div class="p-concept-bg">
            <img src="<?php echo GET_PATH()?>common/concept-bg.svg" alt="" width="1306" height="715">
        </div>
        <div class="p-concept__inner">
            <div class="p-concept-img" data-eff="fadein-right">
                <picture>
                    <source media="(max-width: 768px)" srcset="<?php echo GET_PATH()?>top/concept_1@2x.jpg 2x">
                    <img src="<?php echo GET_PATH()?>top/concept_1.jpg" alt="" width="600" height="680">
                </picture>
            </div>
            <div class="p-concept-txtwrap" data-eff="fadein-up">
                <p class="sec-ttl">CONCEPT</p>
                <h2 class="ttl">健康的で素敵な笑顔あふれる<br>街づくりを目指して</h2>
                <p class="txt">私たちは最新の医療技術を追求すると共に、患者様とのコミュニケーションを大事することで、気軽に通いやすく些細なことでも相談できる「街の掛かり付け医」を目指しております。<br>
                    お子様からご高齢の方まで、快適な空間で治療が受けられる場を作り、地域医療に貢献しきたいと考えております。</p>
                <div class="l-btn --left --sp-center">
                    <a href="<?php echo esc_url(home_url('/')) ?>about/" class="c-btn">当院について</a>
                </div>
            </div>
        </div>
    </section>
    <!-- section:END -->
    
    <!-- section : recommend -->
    <section class="l-section p-top-rec" id="recommend">
        <div class="l-heading --center" data-eff="fadein-up">
            <h2 class="c-ttl --sec">当院の3つのおすすめ</h2>
        </div>
        <div class="p-top-rec__inner">
            <ul class="cardlist" data-eff="fadein-upgroup">
                <li class="card">
                    <img class="no" src="<?php echo GET_PATH()?>top/rec_1_head.svg" alt="おすすめ01" width="177" height="32">
                    <picture class="img">
                        <img class="no01" src="<?php echo GET_PATH()?>top/rec_1_img.svg" alt="歯" width="220" height="220">
                    </picture>
                    <h3 class="ttl c-ttl --serif">痛くない歯科医療の追求</h3>
                    <p class="txt">歯の治療において、小さな違和感は大きなストレスにつながります。<br>
                    私たちは常に快適な歯科医療技術の研究を行っております。</p>
                </li>
                <li class="card">
                    <img class="no" src="<?php echo GET_PATH()?>top/rec_2_head.svg" alt="おすすめ02" width="182" height="32">
                    <picture class="img">
                        <img class="no02" src="<?php echo GET_PATH()?>top/rec_2_img.svg" alt="電車" width="220" height="220">
                    </picture>
                    <h3 class="ttl c-ttl --serif">駅から徒歩3分</h3>
                    <p class="txt">「通いやすさ」も医院選びの重要なポイントと考え、2019年のリニューアルを期に更に駅の近くへ場所を移しました。</p>
                </li>
                <li class="card">
                    <img class="no" src="<?php echo GET_PATH()?>top/rec_3_head.svg" alt="おすすめ03" width="182" height="32">
                    <picture class="img">
                        <img class="no03" src="<?php echo GET_PATH()?>top/rec_3_img.svg" alt="時計" width="220" height="220">
                    </picture>
                    <h3 class="ttl c-ttl --serif">夜20:30まで営業</h3>
                    <p class="txt">朝から夜までお仕事をされている方のために、診療時間を見直しました。<br>
                    <span>※駆け込みでも対応可能ですが、事前にご連絡いただけるとスムーズです。</span></p>
                </li>
            </ul>
        </div>
    </section>
    <!-- section:END -->

    <!-- section : guide -->
    <section class="l-section p-top-guide" id="guide">
        <div class="p-section-top-bg"></div>
        <div class="p-top-guide-body">
            <div class="l-heading --center" data-eff="fadein-up">
                <h2 class="c-ttl --sec">診療案内</h2>
            </div>
            <div class="p-top-guide-inner">
                <ul class="cardlist" data-eff="fadein-upgroup">
                    <li class="card">
                        <a href="<?php echo esc_url(home_url('/')) ?>medical#gtop">
                            <div class="frame"></div>
                            <picture class="bg">
                                <img src="<?php echo GET_PATH()?>top/guid_1.png" alt="" width="460" height="290">
                            </picture>
                            <h3 class="ttl">一般診療</h3>
                            <div class="border"></div>
                            <p class="txt">虫歯・入れ歯・小児歯科</p>
                        </a>
                    </li>
                    <li class="card">
                        <a href="<?php echo esc_url(home_url('/')) ?>medical#stop">
                            <div class="frame"></div>
                            <picture class="bg">
                                <img src="<?php echo GET_PATH()?>top/guid_2.png" alt="" width="460" height="290">
                            </picture>
                            <h3 class="ttl">特殊診療</h3>
                            <div class="border"></div>
                            <p class="txt">インプラント・ホワイトニング</p>
                            <p class="txt">予防歯科・口腔外科・審美歯科</p>
                        </a>
                    </li>
                </ul>
                <div class="textbox">
                    <p>当院では、患者さんの歯の健康状態や治療方針を丁寧にカウンセリングし、十分ご理解していただいた上で治療いたします。<br>
痛みに配慮することと、可能な限り削らない・抜かない治療に努めております。<br>
<span class="red">※特殊性の高い矯正治療などは保険の適応外となります。 これらの治療を行う際は事前に詳細と費用のご説明いたします。</span></p>
                </div>
            </div>
        </div>
        <div class="p-section-bottom-bg"></div>
    </section>
    <!-- section:END -->

    <!-- section : blog -->
    <section class="l-section p-top-blog" id="blog">
        <div class="l-inner p-top-blog-inner">
            <div class="l-heading --center" data-eff="fadein-up">
                <h2 class="c-ttl --sec">スタッフブログ</h2>
            </div>
            <div class="p-top-blog-content">
                <div class="p-article-box-wrap">
                    <ul class="list" data-eff="fadein-upgroup">
                        <?php
                            $limit = 6;
                            $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                            $args = array(
                                'post_type' => array('post'), // 取得する投稿タイプのスラッグ
                                'post_status' => array('publish'),
                                'ignore_sticky_posts' => 1, //  先頭固定フラグ無効化
                                'posts_per_page' => $limit, // 表示する投稿数
                                'paged' => $paged, //ページングを表示する場合
                                'orderby' => 'post_date',
                                'order' => 'DESC' // 降順 or 昇順
                                );
                            $query = new WP_Query($args);
                        while( $query->have_posts()):
                            $query->the_post();
                        ?>

                            <li class="item">
                                <?php /* 記事 */ ?>
                                <?php get_template_part(GET_PATH_R('tpl').'obj/p-article-box-loop', null,
                                ['page'=>$pageid, 'postid'=>$query->get_the_ID(), 'type'=>'main'] ); ?>
                            </li>
                        <?php endwhile;  ?>
                        <?php wp_reset_postdata(); ?>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="l-btn --center">
                <a href="<?php echo esc_url(home_url('/')) ?>blog/">
                    <div class="c-btn">
                        スタッフブログ一覧はこちら
                    </div>
                </a>
            </div>
        </div>
    </section>
    <!-- section:END -->
    </main>

<?php get_footer(); ?>
</body>

</html>
