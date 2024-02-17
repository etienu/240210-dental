<?php
/*------------------------------------------
フッター
------------------------------------------*/
?>
    <!-- footer -->
    <footer id="footer" class="l-section p-footer">
        <div class="p-footer-sec-top-bg"></div>
        <div class="p-footer__body">
			<!-- トップに戻るボタン -->
			<button class="c-gotoTopButton" data-js="gotoTopButton">
				<span class="c-gotoTopButton__inner">
					<span class="c-gotoTopButton__arrow">
					</span>
				</span>
			</button>
			<!-- トップに戻るボタン : END -->
			<div class="p-footer__inner">
				<div class="p-footer-contact">
					<div class="contentwrap">
						<address>
							<picture class="logo">
								<img src="<?php echo GET_PATH()?>/header/logo.svg" width="270" height="32" alt="みなみ歯科クリニック">
							</picture>
							<p class="addr">
								<span>〒166-0001</span><span>東京都杉並区阿佐谷北7-3-1</span>
							</p>
                            <a href="tel:03-1234-5678" class="tel">
                                <i class="c-icon --tel"></i><span>03-1234-5678</span>
                            </a>
							<p class="teltxt">(年中無休 AM9:00〜PM22:00)</p>
						</address>
						<div class="l-btn --center btnwrap">
							<a href="<?php echo esc_url(home_url( '/reserv/' )) ?>"><div class="c-btn__cv --pcs">WEB予約</div></a>
							<a href="<?php echo esc_url(home_url( '/contact/' )) ?>"><div class="c-btn__cv --email">お問い合わせ</div></a>
						</div>
						<!-- 週間受付時間表-->
						<?php get_template_part(GET_PATH_R('tpl').'obj/p-weeklytable' ); ?>
					</div>
					<div class="map">
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6479.335906069384!2d139.63547941145816!3d35.70978790015495!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6018ed89400bb025%3A0xe163fbc6ba8a0d1c!2z44CSMTY2LTAwMDEg5p2x5Lqs6YO95p2J5Lim5Yy66Zi_5L2Q6LC35YyX!5e0!3m2!1sja!2sjp!4v1707619550755!5m2!1sja!2sjp" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
					</div>
				</div>
				<div class="p-footer-nav">
					<div class="catlist">
						<a class="ttl" href="<?php echo esc_url(home_url('/')) ?>">TOP</a>
					</div>
					<div class="catlist">
						<a class="ttl" href="<?php echo esc_url(home_url('/')) ?>about/">当院について</a>
						<ul class="list">
							<li class="item"><a href="<?php echo esc_url(home_url('/')) ?>about#policy">ポリシーと特徴</a></li>
							<li class="item"><a href="<?php echo esc_url(home_url('/')) ?>about#look">当院の様子</a></li>
						</ul>
					</div>
					<div class="catlist">
						<a class="ttl" href="<?php echo esc_url(home_url('/')) ?>staff/">スタッフ紹介</a>
						<ul class="list">
							<li class="item"><a href="<?php echo esc_url(home_url('/')) ?>staff#director">院長のあいさつ</a></li>
							<li class="item"><a href="<?php echo esc_url(home_url('/')) ?>staff#member">スタッフ</a></li>
							<li class="item"><a href="<?php echo esc_url(home_url('/')) ?>blog/">スタッフブログ</a></li>
						</ul>
					</div>
					<div class="catlist">
						<a class="ttl" href="<?php echo esc_url(home_url('/')) ?>medical/">診療内容</a>
						<div class="listwrap">
							<ul class="list">
								<li class="item"><a href="<?php echo esc_url(home_url('/')) ?>medical#g1">一般歯科</a></li>
								<li class="item"><a href="<?php echo esc_url(home_url('/')) ?>medical#g2">小児歯科</a></li>
								<li class="item"><a href="<?php echo esc_url(home_url('/')) ?>medical#g3">予防歯科</a></li>
								<li class="item"><a href="<?php echo esc_url(home_url('/')) ?>medical#s1">入れ歯</a></li>
							</ul>
							<ul class="list">
								<li class="item"><a href="<?php echo esc_url(home_url('/')) ?>medical#s2">矯正歯科</a></li>
								<li class="item"><a href="<?php echo esc_url(home_url('/')) ?>medical#s3">ホワイトニング</a></li>
								<li class="item"><a href="<?php echo esc_url(home_url('/')) ?>medical#s4">口腔外科</a></li>
								<li class="item"><a href="<?php echo esc_url(home_url('/')) ?>medical#s5">レーザー治療</a></li>
							</ul>
						</div>
					</div>
					<div class="catlist">
						<a class="ttl" href="<?php echo esc_url(home_url('/')) ?>contact/">お問い合わせ</a>
						<ul class="list">
							<li class="item"><a href="<?php echo esc_url(home_url('/')) ?>contact/">お問い合わせフォーム</a></li>
							<li class="item"><a href="<?php echo esc_url(home_url('/')) ?>reserv/">WEB予約</a></li>
						</ul>
					</div>
				</div>
			</div>
        </div>
		<div class="p-footer-btm">
                <div class="p-footer-btm__inner">
                    <div class="p-footer__copylight">
                        <p class="txt">&copy;<?php echo date('Y');?>　<?php bloginfo('name')?></p>
				</div>
			</div>
		</div>
	</footer><!-- /footer -->


    <?php wp_footer(); ?>
