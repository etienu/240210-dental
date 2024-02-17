<?php
    $fnew=false;
    $fmin='';
    $fnolink = false;
    $catlimit = 1;
    $pid = $args['postid'];
    if( array_key_exists('nolink',$args) ){
        $fnolink = $args['nolink'];
    }
    //  使用場所 : メインorサイド
    if( array_key_exists('type',$args) ){
        if( $args['type']=='side'){
            $fmin = ' --min';
        }
    }
    //  新着フラグ( 日数 )
    if( is_post_new( "days", 3 ) ) $fnew = " --new";
    //  日付の文字列
    $post_date = get_the_date( 'Y-m-d' );
    $post_datetxt = get_the_date( 'Y.m.d' );

?>
<?php if( !$fnolink ) : ?>
                    <a href="<?php echo get_permalink();?>">
<?php endif; ?>
                        <article class="p-article-box<?php echo $fnew; echo $fmin;?>">
                            <?php // サムネイルがあれば使用 ?>
                            <?php if(has_post_thumbnail()): ?>
                                <picture class="pic">
                                    <?php the_post_thumbnail(); ?>
                                </picture>
                            <?php else: ?>
                                <picture class="pic">
                                    <img src="<?php echo GET_PATH()?>/blog/article_1.jpg" alt="記事" width="300" height="188">
                                </picture>
                            <?php endif; ?>

                            <div class="textwrap">
                                <?php get_template_part(GET_PATH_R('tpl').'obj/p-article-card-category', null, [ 'type'=>$args['type'], 'limit'=>$catlimit] ); ?>
                                <p class="ttl"><?php the_title();?></p>
                                <time class="tm" datetime="<?php echo $post_date;?>"><?php echo $post_datetxt;?></time>
                            </div>
                        </article>
<?php if( !$fnolink ) : ?>
                    </a>
<?php endif; ?>
