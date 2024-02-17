<?php
    $pid = $args['postid'];
    $catlimit = 2;
    //  使用場所
    if( array_key_exists('type',$args) ){
        //  ループで使用
        if( $args['type']=='loop'){
        }
    }

    //  カテゴリ(タクソノミー)取得
    $cat_name ="";
    //$cats = get_the_category();
    if ($terms = get_the_terms($post->ID, 'staff-category')) {
        foreach ( $terms as $term ) {
            $cat_name = $term->name;
        }
    }
    //  カスタムフィールド取得
    $meta_origin = get_post_meta($post->ID, 'staff_txt_origin', true);
    $meta_hobby = get_post_meta($post->ID, 'staff_txt_hobby', true);
    $meta_favfood = get_post_meta($post->ID, 'staff_txt_favfood', true);
?>

                    <article class="card">
                        <?php // サムネイルがあれば使用 ?>
                        <picture class="pic">
                        <?php if(has_post_thumbnail()): ?>
                                <img src="<?php echo get_the_post_thumbnail_url();?>" alt="<?php echo get_the_title();?>" width="280" height="280">
                        <?php else: ?>
                                <img src="<?php echo GET_PATH()?>/staff/staff_2_1@2x.png" alt="" width="280" height="280">
                        <?php endif; ?>
                        </picture>
                        <p class="txtwrap">
                            <span class="work"><?php echo $cat_name;?></span><span class="name"><?php the_title();?></span>
                        </p>
                        <dl class="tbl">
                            <div class="row"><dt class="tbl_ttl">出身地</dt><dd class="tbl_txt"><?php echo $meta_origin;?></dd></div>
                            <div class="row"><dt class="tbl_ttl">趣味</dt><dd class="tbl_txt"><?php echo $meta_hobby;?></dd></div>
                            <div class="row"><dt class="tbl_ttl">好きな食べ物</dt><dd class="tbl_txt"><?php echo $meta_favfood;?></dd></div>
                        </dl>
                    </article>
