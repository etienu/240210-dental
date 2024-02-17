<?php
    $pid = $args['postid'];

    //  カテゴリ(タクソノミー)取得
    $cat_name ="";
    $cat_slug ="";
    if ($terms = get_the_terms($post->ID, 'news-category')) {
        foreach ( $terms as $term ) {
            $cat_name = $term->name;
            $cat_slug = $term->slug;
        }
    }

    $limit = 1;
    $ftype = "";
    $ftypecls = "";
    //  使用場所 : 
    if( array_key_exists('type',$args) ){
        $ftype = $args['type'];
        //  トップ
        if( $args['type']=='line'){
            $ftypecls = " --line";
            $limit = 1;
        }
    }
    
    //  日付の文字列
    $post_date = get_the_date( 'Y-m-d' );
    $post_datetxt = get_the_date( 'Y.m.d' );

?>
                        <?php /* トップの一行ニュース */ ?>
                        <?php if( $ftype == "line" ): ?>
                        <article class="p-news-card<?php echo $ftypecls;?>">
                            <time datetime="<?php echo $post_date;?>"><?php echo $post_datetxt;?></time>
                            <a href="<?php echo get_permalink();?>">
                                <p class="txt"><?php the_title();?></p>
                            </a>
                        </article>
                        <?php endif; ?>