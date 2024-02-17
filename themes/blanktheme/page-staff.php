<!DOCTYPE html>
<html lang="ja-JP">
<?php get_header(); ?>
<body>

<?php $pageid = "staff"; ?>

<?php /* ヘッダーバー */ ?>
<?php get_template_part(GET_PATH_R('tpl').'obj/p-headerbar', null, ['page'=>$pageid]); ?>

<?php /* SUB FV */ ?>
<?php get_template_part(GET_PATH_R('tpl').'obj/p-fvsub', null,
    ['page'=>$pageid,'ttl'=>'スタッフ紹介','enttl'=>'STAFF'] ); ?>

<?php /* パンくず */ ?>
<?php get_template_part(GET_PATH_R('tpl').'obj/p-breadcrumb', null, ['page'=>$pageid] ); ?>


    <main class="l-main" id="<?php echo $pageid;?>">
    <!-- section : concept -->
    <section class="l-section --center p-staff" id="<?php echo $pageid;?>">
        <div class="l-inner p-staff__inner">
            <div class="l-heading --center">
                <div class="c-anchor-t100" id="director"></div>
                <h2 class="c-ttl --sec">院長のあいさつ</h2>
            </div>

            <div class="p-staff-director-wrap">
                <div class="txtwrap">
                    <div class="l-heading --left">
                        <h3 class="c-ttl --n">気軽に相談できる<br>
                            街の歯医者さんでありたい。</h3>
                    </div>
                    <div class="txt-block-top">
                        <div class="leadwrap">
                            <p class="txt">当院は治療はもちろん、予防歯科にも力を入れておりますので、お口に関する相談だけでもお越しいただきたいと考えております。</p>
                            <p class="txt">「患部を直すこと」より「未然に防ぐこと」が最も良い歯科医療と言えますので、些細なことでも気軽に話せる街の歯医者さんとして、明るい街づくりに貢献していきたいと考えております。</p>
                        </div>
                        <div class="namewrap --right">
                            <p class="txt">みなみ歯科クリニック</p>
                            <p class="txt">院長　南 俊雄</p>
                        </div>
                    </div>
                    <div class="txt-block-bottom">
                        <div class="biowrap">
                            <h4 class="ttl">経歴</h4>
                            <dl class="bio">
                                <div class="row"><dt class="year">2004年</dt><dd class="txt">東京医科歯科大学歯学部 卒業</dd></div>
                                <div class="row"><dt class="year">2008年</dt><dd class="txt">東京歯科大学歯学研究科大学院修了<br>博士(歯学)取得</dd></div>
                                <div class="row"><dt class="year">2012年</dt><dd class="txt">みなみ歯科クリニック 開院</dd></div>
                            </dl>
                        </div>
                        <div class="biowrap --second">
                            <h4 class="ttl">資格</h4>
                            <div class="bio">
                                <div class="row"><p class="txt">歯科医師臨床研修指導歯科医</p></div>
                                <div class="row"><p class="txt">博士(歯学)</p></div>
                                <div class="row"><p class="txt">衛生検査技師</p></div>
                            </div>
                        </div>
                    </div>
                </div>
                <picture class="pic">
                    <source media="(max-width: 768px)" srcset="<?php echo GET_PATH()?>staff/director@2x.jpg 2x">
                    <img src="<?php echo GET_PATH()?>staff/director.jpg" alt="院長" width="460" height="613">
                </picture>
            </div>
        </div>

        <!-- スワイパー-->
        <div class="p-staff-swiper-wrap">
            <div class="swiper" data-name="staff">
                <div class="swiper-wrapper">
                    <!-- Slides 1 -->
                    <div class="swiper-slide">
                        <picture class="pic">
                            <source media="(max-width: 767px)" srcset="<?php echo GET_PATH()?>/staff/sp/slide_1@2x.png 2x">
                            <source media="(min-width: 768px)" srcset="<?php echo GET_PATH()?>staff/slide_1.png, <?php echo GET_PATH()?>/staff/slide_1@2x.png 2x">
                            <img src="<?php echo GET_PATH()?>/staff/slide_1.png" alt="スタッフの仕事の様子1" width="305" height="229">
                        </picture>
                    </div>
                    <!-- Slides 2 -->
                    <div class="swiper-slide">
                        <picture class="pic">
                            <source media="(max-width: 767px)" srcset="<?php echo GET_PATH()?>/staff/sp/slide_2@2x.png 2x">
                            <source media="(min-width: 768px)" srcset="<?php echo GET_PATH()?>staff/slide_2.png, <?php echo GET_PATH()?>/staff/slide_2@2x.png 2x">
                            <img src="<?php echo GET_PATH()?>/staff/slide_2.png" alt="スタッフの仕事の様子2" width="305" height="229">
                        </picture>
                    </div>
                    <!-- Slides 3 -->
                    <div class="swiper-slide">
                        <picture class="pic">
                            <source media="(max-width: 767px)" srcset="<?php echo GET_PATH()?>/staff/sp/slide_3@2x.png 2x">
                            <source media="(min-width: 768px)" srcset="<?php echo GET_PATH()?>staff/slide_3.png, <?php echo GET_PATH()?>/staff/slide_3@2x.png 2x">
                            <img src="<?php echo GET_PATH()?>/staff/slide_3.png" alt="スタッフの仕事の様子3" width="305" height="229">
                        </picture>
                    </div>
                    <!-- Slides 4 -->
                    <div class="swiper-slide">
                        <picture class="pic">
                            <source media="(max-width: 767px)" srcset="<?php echo GET_PATH()?>/staff/sp/slide_4@2x.png 2x">
                            <source media="(min-width: 768px)" srcset="<?php echo GET_PATH()?>staff/slide_4.png, <?php echo GET_PATH()?>/staff/slide_4@2x.png 2x">
                            <img src="<?php echo GET_PATH()?>/staff/slide_4.png" alt="スタッフの仕事の様子4" width="305" height="229">
                        </picture>
                    </div>
                    <!-- Slides 5 -->
                    <div class="swiper-slide">
                        <picture class="pic">
                            <source media="(max-width: 767px)" srcset="<?php echo GET_PATH()?>/staff/sp/slide_5@2x.png 2x">
                            <source media="(min-width: 768px)" srcset="<?php echo GET_PATH()?>staff/slide_5.png, <?php echo GET_PATH()?>/staff/slide_5@2x.png 2x">
                            <img src="<?php echo GET_PATH()?>/staff/slide_5.png" alt="スタッフの仕事の様子5" width="305" height="229">
                        </picture>
                    </div>
                </div>
            </div><!-- swiper -->
        </div>

        <!-- スタッフ紹介 -->
        <div class="p-staff-listgroup-wrap">
            <div class="l-heading --center">
                <div class="c-anchor-t100" id="member"></div>
                <h2 class="c-ttl --sec">スタッフ紹介</h2>
            </div>
            <div class="p-staff-list-wrap">
                <div class="l-heading --left">
                    <h2 class="ttl">歯科衛生士</h2>
                </div>
                <?php /* スタッフカードリスト : 歯科衛生士 */ ?>
                <?php get_template_part(GET_PATH_R('tpl').'obj/p-staff-card-list', null,
                ['type'=>'loop', 'cat'=>'hygienist'] ); ?>

            </div>
            <div class="p-staff-list-wrap --second">
                <div class="l-heading --left">
                    <h2 class="ttl">歯科助手</h2>
                </div>
                <?php /* スタッフカードリスト : 歯科助手 */ ?>
                <?php get_template_part(GET_PATH_R('tpl').'obj/p-staff-card-list', null,
                ['type'=>'loop', 'cat'=>'assistant'] ); ?>
            </div>
        </div>

    </section>
    <!-- section:END -->
    </main>

<?php get_footer(); ?>
</body>

</html>
