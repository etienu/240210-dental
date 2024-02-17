<?php
    $data_page = "";
    $pici = GET_PATH().'fvsub/';
    $picsp = GET_PATH().'fvsub/sp/';
    $iname = "";
    $ttl = $args['ttl'];
    $sub = $args['enttl'];
    if( !empty($args['page']) ){
        switch( $args['page'] ){
        case "about" : $iname = 'page-about_top'; break;
        case "medical" : $iname = 'page-medical_top'; break;
        case "staff" : $iname = 'page-staff_top'; break;
        case "blog" : $iname = 'archive_top'; break;
        case "single" : $iname = 'archive_top'; break;
        case "contact" : $iname = 'page-contact_top'; break;
        case "reserv" : $iname = 'page-contact_top'; break;
        case "404" : $iname = 'page-contact_top'; break;
        }
    }
    $pici .= $iname;
    $picsp .= $iname;
//コンタクト - コンバージョンボタン
?>
    <!-- FV SUB -->
    <div class="l-section p-fvsub" id="fvsub">
        <div class="p-fvsub-bg">
            <picture>
                <source media="(max-width: 767px)" srcset="<?php echo $picsp;?>.jpg, <?php echo $picsp?>@2x.jpg 2x">
                <source media="(min-width: 768px)" srcset="<?php echo $pici;?>.jpg, <?php echo $pici;?>@2x.jpg 2x">
                <img src="<?php echo $pici;?>.jpg" alt="" width="1160" height="340">
            </picture>
            <div class="p-fvsub-inner">
                <div class="p-fvsub-content">
                    <h2 class="ttlwrap">
                        <span class="ttl"><?php echo $ttl;?></span>
                        <span class="sub"><?php echo $sub;?></span>
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- div:END -->
