<!DOCTYPE html>
<html lang="ja-JP">
<?php get_header(); ?>
<body>

<?php $pageid = "blog"; ?>

<?php /* ヘッダーバー */ ?>
<?php get_template_part(GET_PATH_R('tpl').'obj/p-headerbar', null, ['page'=>$pageid]); ?>

<?php /* SUB FV */ ?>
<?php get_template_part(GET_PATH_R('tpl').'obj/p-fvsub', null,
    ['page'=>$pageid,'ttl'=>'スタッフブログ','enttl'=>'STAFF BLOG'] ); ?>

<?php /* パンくず */ ?>
<?php get_template_part(GET_PATH_R('tpl').'obj/p-breadcrumb', null, ['page'=>$pageid] ); ?>


    <div class="p-archive" id="<?php echo $pageid;?>">
        <div class="l-inner p-archive__inner">
            <!-- section  -->
            <main class="l-main --two p-archive-main">
                <div class="l-heading --left u-mb40">
                    <div class="c-anchor-t100" id="category"></div>
                    <h2 class="c-ttl --n">カテゴリー：『<?php single_cat_title();?>』の記事一覧</h2>
                </div>

                <ul class="p-archive-list">
                    <?php
                        $cat_id = get_query_var('cat'); //  ページのカテゴリID
                        // カテゴリーIDを元に、一致するカテゴリーオブジェクトを取得する
                        $cat = get_category($cat_id);
                        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                        $args = array(
                            'post_type' => array('post'), // 取得する投稿タイプのスラッグ
                            'post_status' => array('publish'),
                            'ignore_sticky_posts' => 1, //  先頭固定フラグ無効化
                            'posts_per_page' => 10, // 表示する投稿数
                            'paged' => $paged, //ページングを表示する場合
                            'orderby' => 'post_date',
                            'category_name' => $cat->slug,
                            'order' => 'DESC' // 降順 or 昇順
                            );
                        $query = new WP_Query($args);
                    while( $query->have_posts()):
                        $query->the_post();
                    ?>
                    <li class="item">
                        <?php /* 記事 */ ?>
                        <?php get_template_part(GET_PATH_R('tpl').'obj/p-article-card-loop', null,
                        ['page'=>$pageid, 'postid'=>$query->get_the_ID(), 'type'=>'main'] ); ?>
                    </li>
                    <?php endwhile;  ?>
                </ul>
                <?php
                    /* ページネーション */
                    $big = 999999999;
                    echo paginate_links(array(
                        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                        'show_all' => true,
                        'type' => 'list',
                        'format' => '?paged=%#%',
                        'current' => max(1, get_query_var('paged')),
                        'total' => $query->max_num_pages,
                        'prev_text' => '<',
                        'next_text' => '>',
                    ));
                ?>
                <?php wp_reset_postdata(); ?>
            </main>
            <!-- main:END -->

            <!-- sidebar  -->
            <?php get_template_part(GET_PATH_R('tpl').'layout/l-sidebar', null,
             ['page'=>$pageid]); ?>
        </div>
    </div>


<?php get_footer(); ?>
</body>

</html>
