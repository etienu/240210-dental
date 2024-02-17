//----------------------------------------
//
//  GSAP アニメーション
//
//----------------------------------------
export default class anim_gsap {
    constructor() {
    }

    //----------------------------------------
    //  各種イベントの登録
    //----------------------------------------
    eventRegistration( i_common ) {
        //  共有変数クラスの確保
        this.common = i_common;
        this.set_fadein_right();
        this.set_fadein_left();
        this.set_fadein_up();
        this.set_fadein_upgroup();
    }


    //----------------------------------------
    //  フェードイン - popup 左から右へ
    //----------------------------------------
    set_fadein_right() {
        let elms = document.querySelectorAll('[data-eff="fadein-right"]');
        if( elms.length <= 0 ) return;
        elms.forEach((elm) => {
            gsap.set(elm,{ opacity : 0, x : -40});
            const tl = gsap.timeline();
            tl
            .to(elm,{ autoAlpha: 0, x:-40, duration :0.5,
                scrollTrigger: {
                    trigger: elm,
                    start: "top 85%",
                    onEnter: () => {  tl.play()  },
                },
            })
            .to(elm,{ duration : 0.5, x: 0, autoAlpha: 1, });
            tl.pause();
            elm.gsaptl_fadeinLeft = tl;
        });
    }


    //----------------------------------------
    //  フェードイン - popup 右から左へ
    //----------------------------------------
    set_fadein_left() {
        let elms = document.querySelectorAll('[data-eff="fadein-left"]');
        if( elms.length <= 0 ) return;
        elms.forEach((elm) => {
            gsap.set(elm,{ opacity : 0, x : 40});
            const tl = gsap.timeline();
            tl
            .to(elm,{ autoAlpha: 0, x:40, duration :0.5,
                scrollTrigger: {
                    trigger: elm,
                    start: "top 85%",
                    onEnter: () => {  tl.play()  },
                },
            })
            .to(elm,{ duration : 0.5, x: 0, autoAlpha: 1, });
            tl.pause();
            elm.gsaptl_fadeinLeft = tl;
        });
    }

    //----------------------------------------
    //  フェードイン - popup 下から上へ
    //----------------------------------------
    set_fadein_up() {
        let elms = document.querySelectorAll('[data-eff="fadein-up"]');
        if( elms.length <= 0 ) return;
        elms.forEach((elm) => {
            gsap.set(elm,{ opacity : 0, y: 40});
            const tl = gsap.timeline();
            tl
            .to(elm,{
                autoAlpha: 0,
                y:40,
                duration :0.5,
                scrollTrigger: {
                    trigger: elm,   // アニメーションが始まるトリガーとなる要素
                    start: "top 85%", // アニメーションの開始位置
                    onEnter: () => {  tl.play()  },
                },
            })
            .to(elm,{
                duration : 0.5,
                y: 0, // アニメーション後の縦位置(上に100px)
                autoAlpha: 1, // アニメーション後に出現(透過率0)
            });
            tl.pause();

            //  要素にセットしておく
            elm.gsaptl_fadeinUp = tl;

        });
    }
    //----------------------------------------
    //  フェードイン - popup 下から上へ - グループ
    //----------------------------------------
    set_fadein_upgroup() {
        let elms = document.querySelectorAll('[data-eff="fadein-upgroup"]');
        if( elms.length <= 0 ) return;
        elms.forEach((target) => {
            let divs = target.querySelectorAll('div,li,picture');
            gsap.fromTo(divs, { autoAlpha: 0, rotate: 0, scale: 1, y: 20 }, {
                y: 0,
                autoAlpha: 1,
                rotate: 0,
                scale: 1,
                duration: 1,
                scrollTrigger: {
                    trigger: target,
                    start: 'top center+=50%',
                },
                stagger: {
                    amount: 0.5, //アニメーション間隔の合計時間
                    from: "start", // 動作を始める要素を指定
                    ease: "sine.in"
                }
    
            });
        });        
    }
}//class anim_gsap
