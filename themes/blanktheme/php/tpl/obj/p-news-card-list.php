<?php
    //  使用場所
    $pageid = 'top';
    if( array_key_exists('page',$args) ){
        $usetype = $args['page'];
    }
    //  表示タイプ
    $usetype = 'line';
    if( array_key_exists('type',$args) ){
        $usetype = $args['type'];
    }
    //  カテゴリ
    $listcat = "news";
    if( array_key_exists('cat',$args) ){
        $listcat = $args['cat'];
    }
    $limit = 10;
    if( array_key_exists('limit',$args) ){
        $limit = $args['limit'];
    }

?>
                <ul class="list">
                    <?php
                        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                        //  カスタム投稿タイプ、カテゴリhygienistの表示
                        $my_args = array(
                            'post_type' => array('news'),
                            'post_status' => array('publish'),
                            'ignore_sticky_posts' => 1, //  先頭固定フラグ無効化
                            'posts_per_page' => $limit,
                            'paged' => $paged, //ページングを表示する場合
                            'order' => 'DESC',
                            'orderby' => 'post_date',
                            //  タクソノミーの指定
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'news-category',
                                    'field' => 'slug',
                                    'terms' => 'news'
                                )
                            )
                        );                            
                        $query = new WP_Query($my_args);
                    while( $query->have_posts()):
                        $query->the_post();
                    ?>
                    <li class="item">
                        <?php /* ニュース記事 */ ?>
                        <?php get_template_part(GET_PATH_R('tpl').'obj/p-news-card', null,
                        ['postid'=>$query->get_the_ID(), 'type'=>$usetype] ); ?>

                    </li>
                    <?php endwhile;  ?>
                </ul>
                <?php
                    if( $pageid != "top" ){
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
                    }
                ?>
                <?php wp_reset_postdata(); ?>
