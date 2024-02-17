<?php
    $ftype = 'main';
    $fdisplimit = true;
    $limit = 2;
    //  使用場所 : メインorサイド
    if( array_key_exists('type',$args) ){
        $ftype = $args['type'];
        switch( $args['type'] ){
        case 'single':
            $fdisplimit = false;
            break;
        }
    }
    if( array_key_exists('limit',$args) ){
        $limit = $args['limit'];
    }
?>
                                <div class="catwrap">
                                <?php
                                    //  カテゴリ取得
                                    $cats = get_the_category();
                                    $ccnt = 0;
                                    foreach ($cats as $cat):
                                        $cat_name = $cat->name;
                                        $cat_count = $cat->category_count;
                                        $cat_url = get_category_link($cat->term_id);
                                        $cat_slug = $cat->category_nicename;
                                        $ccnt ++;
                                        if( $fdisplimit && $limit < $ccnt ) break;
                                ?>
                                <?php if($ftype=='side') :  ?>
                                    <div class="c-tag --cat --min <?php echo $cat_slug;?>"><?php echo $cat_name;?></div>
                                <?php elseif($ftype=='main') : ?>
                                    <div class="c-tag --cat <?php echo $cat_slug;?>"><?php echo $cat_name;?></div>
                                <?php elseif($ftype=='single') : ?>
                                    <a href="<?php echo $cat_url;?>"><div class="c-tagh --cat <?php echo $cat_slug;?>"><?php echo $cat_name;?></div></a>
                                <?php endif; ?>
                                <?php
                                    endforeach;
                                    if( $fdisplimit && $limit < $ccnt){
                                        echo '<div class="c-tag --line --min">他'.(count($cats)-1).'</div>';
                                    }
                                ?>
                                </div>
