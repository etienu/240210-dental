<head prefix="og: https://ogp.me/ns# fb: https://ogp.me/ns/fb# article: https://ogp.me/ns/article#">
	<?php /* Base */ ?>
    <meta charset="UTF-8">
	<?php /* 基本的には全てwp_head()内に記述 */ ?>

	<?php wp_head(); ?>

	<?php
	/*	contact-form系はwp_head()の後でないと消せない
		function.php内、wp_head()の前では消えない
		//	読み込まれているqueueを出力するショートコード
		<p>
			<?php echo do_shortcode('[pluginhandles]'); ?>
		</p>

	*/
	recaptcha_limitation();
	?>
	

</head>
