<?php /*    以下 全ページ共通パーツの配置  */ ?>
<?php /* ローディング */ ?>
<?php
    //  トップページのみ
    if( is_home() )
        get_template_part(GET_PATH_R('tpl').'layout/l-loader' );
 ?>

    <!-- Header Start -->
    <header class="l-header" data-js="header">
        <div class="p-header" id="header">
            <div class="p-header__inner">
                <div class="p-header__leftwrap">
                    <a href="<?php echo esc_url(home_url()) ?>">
                        <h1>
                            <picture class="logo">
                                <img src="<?php echo GET_PATH()?>/header/logo.svg" width="270" height="32" alt="みなみ歯科クリニック">
                            </picture>
                        </h1>
                    </a>
                </div>

                <div class="p-header__spmenu" id="spmenu">
                    <div class="p-header__spmenu-bg" id="spmenubg"></div>
                    <nav class="p-header__nav">
                        <ul class="navlist">
                            <li class="navitem<?php if($args['page']=='top'){echo " --select";}?>"><a href="<?php echo esc_url(home_url('/')) ?>"><i class="c-icon --home --spwhite" icon="home"></i>ホーム</a></li>
                            <li class="navitem<?php if($args['page']=='about'){echo " --select";}?>"><a href="<?php echo esc_url(home_url( '/about/' )) ?>"><i class="c-icon --build --spwhite"></i>当院について</a></li>
                            <li class="navitem<?php if($args['page']=='medical'){echo " --select";}?>"><a href="<?php echo esc_url(home_url( '/medical/' )) ?>"><i class="c-icon --document --spwhite"></i>診療案内</a></li>
                            <li class="navitem<?php if($args['page']=='staff'){echo " --select";}?>"><a href="<?php echo esc_url(home_url( '/staff/' )) ?>"><i class="c-icon --peoples --spwhite"></i>スタッフ紹介</a></li>
                            <li class="navitem<?php if($args['page']=='blog'||$args['page']=='single'){echo " --select";}?>"><a href="<?php echo esc_url(home_url( '/blog/' )) ?>"><i class="c-icon --edit --spwhite"></i>スタッフブログ</a></li>
                            <li class="navitem<?php if($args['page']=='contact'){echo " --select";}?>"><a href="<?php echo esc_url(home_url( '/contact/' )) ?>"><i class="c-icon --email --spwhite"></i>お問い合わせ</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="p-header__cvwrap">
                    <div class="p-header__cvwrap-inner">
                        <div class="p-header__infowrap">
                            <p class="addr">〒166-0001 <br class="u-display__sp-tab">東京都杉並区阿佐谷北7-3-1</p>
                            <a href="tel:03-1234-5678" class="tel">
                                <i class="c-icon --tel"></i><span>03-1234-5678</span>
                            </a>
                            <p class="time">(年中無休 AM9:00〜PM22:00)</p>
                        </div>
                        <!-- PC時独立 -->
                        <div class="p-header__btnwrap">
                            <a href="<?php echo esc_url(home_url( '/reserv/' )) ?>" class="c-btn__reserv"><i class="c-icon --pcs"></i><span><b>WEB予約</b>はこちら</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header End -->

    <!-- hamburger -->
    <button class="c-hamburger --fixed u-display__sp-tab"
        data-js="button" data-name="hamburger"
        data-headerid="header" data-menuid="spmenu"
        data-menubgid="spmenubg">
        <span class="c-hamburger__inner">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </span>
    </button>
