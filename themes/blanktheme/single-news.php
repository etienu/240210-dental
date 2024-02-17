<?php
    $fnew=false;
    //  新着フラグ( 日数 )
    if( is_post_new( "days", 3 ) ) $fnew = " --new";

    $post_date = get_the_date( 'Y-m-d' );
    $post_datetxt = get_the_date( 'Y.m.d' );
?>

<!DOCTYPE html>
<html lang="ja-JP">
<?php get_header(); ?>
<body>

<?php $pageid = "single"; ?>

<?php /* ヘッダーバー */ ?>
<?php get_template_part(GET_PATH_R('tpl').'obj/p-headerbar', null, ['page'=>$pageid]); ?>

<?php /* SUB FV */ ?>
<?php get_template_part(GET_PATH_R('tpl').'obj/p-fvsub', null,
    ['page'=>$pageid,'ttl'=>'お知らせ','enttl'=>'NEWS'] ); ?>

<?php /* パンくず */ ?>
<?php get_template_part(GET_PATH_R('tpl').'obj/p-breadcrumb', null, ['page'=>$pageid] ); ?>


    <div class="p-single" id="<?php echo $pageid;?>">
        <div class="l-inner p-single__inner">
            <!-- section  -->
            <main class="l-main p-single-main">
                <article class="p-article">
                <?php while (have_posts()) : the_post(); ?>
                    <div class="l-heading --left">
                        <h2><?php the_title(); ?></h2>
                        <div class="headinfowrap">
                            <i class="c-icon --pen"></i>
                            <time class="tim" datetime="<?php echo $post_date;?>"><?php echo $post_datetxt;?></time>
                            <?php get_template_part(GET_PATH_R('tpl').'obj/p-article-card-category', null, [ 'type'=>'single'] ); ?>
                        </div>
                    </div>
                    <div class="p-article-content">
                        <?php the_content(); ?>
                    </div>
                <?php endwhile; ?>
                </article>

                <div class="p-article-pagination__wrap">
                    <?php $nextpost = get_adjacent_post(false, '', false); if ($nextpost) : ?>
                    <a href="<?php echo get_permalink($nextpost->ID); ?>" title="<?php echo esc_attr($nextpost->post_title); ?>">
                        <div class="p-article-pagination__left">
                            <i class="c-icon --circle-left"></i>
                            <span class="post__pagination__left__text"><?php echo esc_attr($nextpost->post_title); ?></span>
                        </div>
                    </a>
                    <?php endif; ?>

                    <a href="<?php echo esc_url(home_url( '/news/' )) ?>">
                        <div class="p-article-pagination__archive">
                            <span>お知らせ一覧</span>
                        </div>
                    </a>

                    <?php $prevpost = get_adjacent_post(false, '', true); if ($prevpost) : ?>
                    <a href="<?php echo get_permalink($prevpost->ID); ?>" title="<?php echo esc_attr($prevpost->post_title); ?>">
                        <div class="p-article-pagination__right">
                            <span class="post__pagination__right__text"><?php echo esc_attr($prevpost->post_title); ?></span>
                            <i class="c-icon --circle-right"></i>
                        </div>
                    </a>
                    <?php endif; ?>
                </div>

            </main>
            <!-- main:END -->
        </div>
    </div>


<?php get_footer(); ?>
</body>

</html>
