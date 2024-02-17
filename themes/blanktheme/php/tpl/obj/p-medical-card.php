<?php
    //  カテゴリ(タクソノミー)取得
    $cat_name ="";
    $cat_slug ="";
    if ($terms = get_the_terms($post->ID, 'medical-category')) {
        foreach ( $terms as $term ) {
            $cat_name = $term->name;
            $cat_slug = $term->slug;
        }
    }
    $labeltxt = "";
    $labelcoltxt = "";
    switch( $cat_slug){
    case "general": $labeltxt = "保険対象"; $labelcoltxt=" --blue"; break;
    case "special": $labeltxt = "実費"; $labelcoltxt=" --red";  break;
    }
    //  カスタムフィールド取得
    $meta_description = get_post_meta($post->ID, 'medical_txt_description', true);
    $meta_id = get_post_meta($post->ID, 'medical_txt_id', true);
?>
                        <article class="card">
                            <div class="label<?php echo $labelcoltxt;?>"><?php echo $labeltxt; ?></div>
                            <div class="head">
                                <div class="c-anchor-t140" id="<?php echo $meta_id;?>"></div>
                                <h3 class="c-ttl --n"><?php the_title();?></h3><span class="sub"><?php echo $meta_description;?></span>
                            </div>
                            <div class="content">
                                <div class="txt">
                                    <?php the_content(); ?>
                                </div>
                                <?php // サムネイルがあれば使用 ?>
                                <picture class="pic">
                                <?php if(has_post_thumbnail()): ?>
                                        <?php the_post_thumbnail('full');?>
                                <?php else: ?>
                                        <img src="<?php echo GET_PATH()?>medical/medical_1.jpg" alt="一般歯科" width="420" height="315">
                                <?php endif; ?>
                                </picture>
                            </div>
                        </article>
