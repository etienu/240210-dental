<?php
    $fnew=false;
    $fmin='';
    $fbox='';
    $fnolink = false;
    $pid = $args['postid'];
    $catlimit = 2;
    if( array_key_exists('nolink',$args) ){
        $fnolink = $args['nolink'];
    }
    //  使用場所 : トップ,メイン,サイド
    if( array_key_exists('type',$args) ){
        //  トップ
        if( $args['type']=='box'){
            $fbox = ' --box';
            $catlimit = 1;
        }
        //  サイド
        if( $args['type']=='side'){
            $fmin = ' --min';
            $catlimit = 1;
        }
    }
    //  新着フラグ( 日数 )
    if( is_post_new( "days", 3 ) ) $fnew = " --new";

    $post_date = get_the_date( 'Y-m-d' );
    $post_datetxt = get_the_date( 'Y.m.d' );
?>
<?php if( !$fnolink ) : ?>
                    <a href="<?php echo get_permalink();?>">
<?php endif; ?>
                        <article class="p-article-card<?php echo $fnew; echo $fmin;?>">
                            <?php // サムネイルがあれば使用 ?>
                            <?php if(has_post_thumbnail()): ?>
                                <picture class="pic">
                                    <?php the_post_thumbnail(); ?>
                                </picture>

                            <?php else: ?>
                                <picture class="pic">
                                    <img src="<?php echo GET_PATH()?>/blog/article_1.jpg" alt="記事" width="120" height="90">
                                </picture>
                            <?php endif; ?>
                            <div class="txtwrap">
                                <?php get_template_part(GET_PATH_R('tpl').'obj/p-article-card-category', null, [ 'type'=>$args['type'], 'limit'=>$catlimit] ); ?>
                                <div class="ttl"><?php the_title();?></div>
                                <time class="tim" datetime="<?php echo $post_date;?>"><?php echo $post_datetxt;?></time>
                            </div>
                        </article>
<?php if( !$fnolink ) : ?>
                    </a>
<?php endif; ?>
