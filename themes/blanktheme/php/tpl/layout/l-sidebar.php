<?php
?>
            <!-- sidebar  -->
            <sidebar class="l-sidebar">
                <!-- about -->
                <div class="p-sidebar-about-wrap">
                    <div class="l-heading --under">
                        <i class="c-icon --build"></i><h3 class="c-ttl --under">クリニックの紹介</h3>
                    </div>
                    <picture class="pic">
                        <source media="(max-width: 768px)" srcset="<?php echo GET_PATH()?>blog/about_1@2x.jpg 2x">
                        <img src="<?php echo GET_PATH()?>blog/about_1.jpg" alt="クリニック" width="300" height="188">
                    </picture>
                    <p class="ttl">みなみ歯科クリニック</p>
                    <p class="txt">お子様からご高齢の方まで、快適な空間で治療が受けられる場を作り、地域医療に貢献しきたいと考えております。</p>
                    <a class="link" href="<?php echo esc_url(home_url( '/about/' )) ?>">当院について<i class="c-icon --angle-right"></i></a>
                </div>
                <!-- about : END -->

                <!-- newslist -->
                <div class="p-sidebar-newslist-wrap">
                    <div class="l-heading --under">
                        <i class="c-icon --paper"></i><h3 class="c-ttl --under">新着記事</h3>
                    </div>
                    <ul class="p-sidebar-newslist">
                        <?php
                            $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                            //$list_cnt = 5; //表示させたい記事の合計件数
                            $sticky = get_option('sticky_posts'); //先頭固定の記事
                            //if ( !empty($sticky) ) $list_cnt -= count($sticky); //先頭固定の記事がある場合は、その件数を「$list_cnt」の値から引く
                            $ary = array(
                                'post_type' => array('post'), // 取得する投稿タイプのスラッグ
                                'post_status' => array('publish'),
                                'post_not_in ' => get_option('sticky_posts'),
                                'ignore_sticky_posts' => 1,
                                'posts_per_page' => 5, // 表示する投稿数
                                //'paged' => $paged, //ページングを表示する場合
                                'orderby' => 'post_date',
                                'order' => 'DESC' // 降順 or 昇順
                                );
                            $query = new WP_Query($ary);
                        while( $query->have_posts()):
                            $query->the_post();
                        ?>
                        <li class="item">
                            <?php /* 記事 */ ?>
                            <?php get_template_part(GET_PATH_R('tpl').'obj/p-article-card-loop', null,
                            ['page'=>$args['page'], 'postid'=>$query->get_the_ID(), 'type'=>'side'] ); ?>
                        </li>
                        <?php endwhile;  ?>
                        <?php wp_reset_postdata(); ?>
                    </ul>
                </div>
                <!-- newslist : END -->

                <!-- categorylist -->
                <div class="p-sidebar-categorylist-wrap">
                    <div class="l-heading --under">
                        <i class="c-icon --folder"></i><h3 class="c-ttl --under">カテゴリー</h3>
                    </div>
                    <ul class="p-sidebar-categorylist">
                        <?php
                            //  カテゴリ取得
                            $cary = array(
                                'orderby' => 'id',
                                'order' => 'asc',
                                'hide_empty' => 0,
                            );                            
                            $cats = get_categories($cary);
                            $ccnt = 0;
                            $fover = false;
                            foreach ($cats as $cat):
                                $cat_name = $cat->name;
                                $cat_count = $cat->category_count;
                                $cat_url = get_category_link($cat->term_id);
                                $cat_slug = $cat->category_nicename;
                                $ccnt ++;
                                if( 30<$ccnt && !$fover ){
                                    $fover = true;
                        ?>
                    </ul>
                    <p class="p-sidebar-categorylist-over-btn c-btn --min --noicon" data-js="button" data-name="sidebar_tagover" data-tar="#js-over">
                        ... 他 <?php echo (count($cats)-30);?>カテゴリを表示
                    </p>
                    <ul class="p-sidebar-categorylist-over" id="js-over">
                        <?php
                                }
                        ?>
                        <li class="item <?php echo $cat_slug;?>">
                            <i class="c-icon --triangle-arrow-right"></i>
                            <a href="<?php echo $cat_url;?>">
                                <p class="cat"><?php echo $cat_name;?><span class="cnt">(<?php echo $cat_count;?>)</span></p>
                            </a>
                        </li>
                        <?php
                            endforeach;
                        ?>
                    </ul>
                </div>
                <!-- categorylist : END -->
            </sidebar>
            <!-- sidebar:END -->
