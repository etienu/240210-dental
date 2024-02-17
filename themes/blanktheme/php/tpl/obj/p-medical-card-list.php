<?php
    //  使用場所
    $usetype = 'loop';
    if( array_key_exists('type',$args) ){
        $usetype = $args['type'];
    }
    //  カテゴリ
    $listcat = "general";
    if( array_key_exists('cat',$args) ){
        $listcat = $args['cat'];
    }
?>
                <ul class="l-inner list">
                    <?php
                        //  カスタム投稿タイプ、カテゴリhygienistの表示
                        $my_args = array(
                            'post_type' => array('medical'),
                            'posts_per_page' => 10,
                            'order' => 'ASC',
                            'orderby' => 'post_date',
                            //  タクソノミーの指定
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'medical-category',
                                    'field' => 'slug',  
                                    'terms' => array($listcat)
                                )
                            )
                        );                            
                        $query = new WP_Query($my_args);
                    while( $query->have_posts()):
                        $query->the_post();
                    ?>
                    <li class="item">
                        <?php /* 診療案内カード */ ?>
                        <?php get_template_part(GET_PATH_R('tpl').'obj/p-medical-card', null,
                        ['postid'=>$query->get_the_ID(), 'type'=>$usetype] ); ?>
                    </li>
                    <?php endwhile;  ?>
                    <?php wp_reset_postdata(); ?>
                </ul>
