"use strict";
//----------------------------------------
//  swiperグループ
//----------------------------------------
export default class swiperGroup {
    constructor() {
        this.swiperObjs = [];   //  HTML上の.swiper
        this.swipers = [];      //  js上のswiper
    }


    //----------------------------------------
    //  hTMLタグ : スライドの複製処理
    //  自力で複製する必要がある
    //----------------------------------------
    make_clone( i_swiper ) {
        //  swiperを作成する前に、要素を複製する
        //  swiperの仕様上、swiper-slide数>=SlidePerView*2.5でないと正常にループできない為
        const slides = i_swiper.querySelectorAll('.swiper-slide');

        //  スライド数をSlidePerView*2.5を超えるために必要な複製回数( 綺麗にループできる倍数 )
        let spv = 5;    //  最大表示したい枚数
        let sscnt = slides.length >= spv*2.5 ? 0 : Math.floor( (spv*2.5)/slides.length );
        let clones = [];
        let i = 0, j= 0;
        //  同じ複製自体を何度もコピーできないので、必要な数複製する
        for( j = 0; j < sscnt ; j ++ ){
            slides.forEach((slide) => { clones.push( slide.cloneNode(true) ); });
        }

        //  複製をSlidePerView*2.5を超えるようにセット(2回)
        let swipw = i_swiper.querySelector(".swiper-wrapper");
        for( i = 0; i < clones.length ; i ++ ){
            swipw.appendChild( clones[i] );
        }
        return slides;
    }    

    //----------------------------------------
    //  個別 : fv
    //----------------------------------------
    make_fv( i_swiper, i_name ) {
        const sname = i_swiper + ' .swiper';
        // swiperslider
        this.swipers[i_name] = new Swiper( sname, {
            loop: true,
            allowTouchMove: false,  //  ドラッグ有効
            //  ページネーション
            pagination: {
                el: i_swiper +' .swiper-pagination',
                type: "bullets",
                clickable: "clickable"
            },
            // Navigation arrows
            navigation: {
                nextEl: i_swiper +' .swiper-button-next',
                prevEl: i_swiper +' .swiper-button-prev',
            },            
            effect : 'fade',
            centeredSlides: true, //アクティブなスライドを中央に表示
            spaceBetween: 16,   //スライド間の距離を16pxに
            slidesPerView: 1,   //スライダーのコンテナ上に1枚同時に表示
            breakpoints: {      //小さい順に設定する
                1024: { slidesPerView: 1 },
            },
            updateOnWindowResize: true, //  ウインドウサイズ変更時自動再計算
            autoplay: true
        });
        this.swipers[i_name].element = document.querySelector(sname);
    }


    //----------------------------------------
    //  個別 : staff
    //----------------------------------------
    make_staff( i_swiper, i_name ) {
        const sname = i_swiper + ' .swiper';
        const swiobj = document.querySelectorAll( sname );
        //  クローン作成
        this.make_clone( swiobj.item(0) );
        // swiper slider
        this.swipers[i_name] = new Swiper( sname, {
            loop: true,
            allowTouchMove: true,  //  ドラッグ有効
            //  ページネーション
            centeredSlides: true,   //アクティブなスライドを中央に表示
            spaceBetween: 20,       //スライド間の距離を16pxに
            loopAdditionalSlides:1, // 本来見えていない部分にスライドを複製する
            slidesPerView: 'auto',   //スライダーのコンテナ上に1枚同時に表示
            updateOnWindowResize: true, //  ウインドウサイズ変更時自動再計算
            speed : 6000,
            autoplay: {
                delay:0,
                pauseOnMouseEnter: true,        // ホバー時停止
                disableOnInteraction: false,    // ホバー解除時再開
            }
        });
        this.swipers[i_name].element = document.querySelector(sname);
    }


    //----------------------------------------
    //  swiperの作成
    //----------------------------------------
    registSwiper( i_swiper, i_name ) {
        this.swiperObjs[i_name] = i_swiper; //  HTML swiperタグ
        switch( i_name )
        {
        case "fv": this.make_fv( ".p-fv-swiper", i_name );  break;
        case "staff": this.make_staff( ".p-staff-swiper-wrap", i_name );  break;
        }
    }



    //----------------------------------------
    //  各種イベントの登録
    //----------------------------------------
    eventRegistration() {
        //  swiperを全て取得
        let swipergroup = document.querySelectorAll('.swiper');
        swipergroup.forEach((swiper) => {
            //  swiperに指定してある"data-name"を取得
            let name = swiper.dataset.name;
            //  swiperの識別名称がある場合は設定
            if( name )
                this.registSwiper( swiper, name );
        });
    }
}
