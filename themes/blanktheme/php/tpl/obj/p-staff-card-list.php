<?php
    //  使用場所
    $usetype = 'loop';
    if( array_key_exists('type',$args) ){
        $usetype = $args['type'];
    }
    //  カテゴリ
    $listcat = "hygienist";
    if( array_key_exists('cat',$args) ){
        $listcat = $args['cat'];
    }
?>
                <ul class="list">
                    <?php
                        //  カスタム投稿タイプ、カテゴリhygienistの表示
                        $my_args = array(
                            'post_type' => array('staff'),
                            'posts_per_page' => 10,
                            'order' => 'DESC',
                            'orderby' => 'post_date',
                            //  タクソノミーの指定
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'staff-category',
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
                        <?php /* スタッフカード */ ?>
                        <?php get_template_part(GET_PATH_R('tpl').'obj/p-staff-card', null,
                        ['postid'=>$query->get_the_ID(), 'type'=>$usetype] ); ?>
                    </li>
                    <?php endwhile;  ?>
                    <?php wp_reset_postdata(); ?>                    
                </ul>
