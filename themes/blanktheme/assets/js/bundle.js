/******/ (function() { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "../themes/blanktheme/assets_src/js/anim/gsap.js":
/*!*******************************************************!*\
  !*** ../themes/blanktheme/assets_src/js/anim/gsap.js ***!
  \*******************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ anim_gsap; }
/* harmony export */ });
//----------------------------------------
//
//  GSAP アニメーション
//
//----------------------------------------
class anim_gsap {
  constructor() {}

  //----------------------------------------
  //  各種イベントの登録
  //----------------------------------------
  eventRegistration(i_common) {
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
    if (elms.length <= 0) return;
    elms.forEach(elm => {
      gsap.set(elm, {
        opacity: 0,
        x: -40
      });
      const tl = gsap.timeline();
      tl.to(elm, {
        autoAlpha: 0,
        x: -40,
        duration: 0.5,
        scrollTrigger: {
          trigger: elm,
          start: "top 85%",
          onEnter: () => {
            tl.play();
          }
        }
      }).to(elm, {
        duration: 0.5,
        x: 0,
        autoAlpha: 1
      });
      tl.pause();
      elm.gsaptl_fadeinLeft = tl;
    });
  }

  //----------------------------------------
  //  フェードイン - popup 右から左へ
  //----------------------------------------
  set_fadein_left() {
    let elms = document.querySelectorAll('[data-eff="fadein-left"]');
    if (elms.length <= 0) return;
    elms.forEach(elm => {
      gsap.set(elm, {
        opacity: 0,
        x: 40
      });
      const tl = gsap.timeline();
      tl.to(elm, {
        autoAlpha: 0,
        x: 40,
        duration: 0.5,
        scrollTrigger: {
          trigger: elm,
          start: "top 85%",
          onEnter: () => {
            tl.play();
          }
        }
      }).to(elm, {
        duration: 0.5,
        x: 0,
        autoAlpha: 1
      });
      tl.pause();
      elm.gsaptl_fadeinLeft = tl;
    });
  }

  //----------------------------------------
  //  フェードイン - popup 下から上へ
  //----------------------------------------
  set_fadein_up() {
    let elms = document.querySelectorAll('[data-eff="fadein-up"]');
    if (elms.length <= 0) return;
    elms.forEach(elm => {
      gsap.set(elm, {
        opacity: 0,
        y: 40
      });
      const tl = gsap.timeline();
      tl.to(elm, {
        autoAlpha: 0,
        y: 40,
        duration: 0.5,
        scrollTrigger: {
          trigger: elm,
          // アニメーションが始まるトリガーとなる要素
          start: "top 85%",
          // アニメーションの開始位置
          onEnter: () => {
            tl.play();
          }
        }
      }).to(elm, {
        duration: 0.5,
        y: 0,
        // アニメーション後の縦位置(上に100px)
        autoAlpha: 1 // アニメーション後に出現(透過率0)
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
    if (elms.length <= 0) return;
    elms.forEach(target => {
      let divs = target.querySelectorAll('div,li,picture');
      gsap.fromTo(divs, {
        autoAlpha: 0,
        rotate: 0,
        scale: 1,
        y: 20
      }, {
        y: 0,
        autoAlpha: 1,
        rotate: 0,
        scale: 1,
        duration: 1,
        scrollTrigger: {
          trigger: target,
          start: 'top center+=50%'
        },
        stagger: {
          amount: 0.5,
          //アニメーション間隔の合計時間
          from: "start",
          // 動作を始める要素を指定
          ease: "sine.in"
        }
      });
    });
  }
} //class anim_gsap

/***/ }),

/***/ "../themes/blanktheme/assets_src/js/func/accordion.js":
/*!************************************************************!*\
  !*** ../themes/blanktheme/assets_src/js/func/accordion.js ***!
  \************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ accordion; }
/* harmony export */ });
// GSAP使用
//------------------------------------------------------------
//  
//  アコーディオンを閉じる時のアニメーション
//
//------------------------------------------------------------
const closingAnim = (content, element) => gsap.to(content, {
  height: 0,
  opacity: 0,
  duration: 0.4,
  //ease: "power3.out",Z
  overwrite: true,
  onComplete: () => {
    // アニメーションの完了後にopen属性を取り除く( <details>用 )
    element.removeAttribute("open");
  }
});

//------------------------------------------------------------
//
//  アコーディオンを開く時のアニメーション
//
//------------------------------------------------------------
const openingAnim = content => gsap.fromTo(content, {
  height: 0,
  opacity: 0
}, {
  height: "auto",
  opacity: 1,
  duration: 0.4,
  ease: "power3.out",
  overwrite: true
});

//----------------------------------------
//  アコーディオン処理
//  
//----------------------------------------
class accordion {
  constructor() {}

  //----------------------------------------
  //
  //  GSAPを使ってアコーディオンのアニメーションを制御
  //
  //----------------------------------------
  set_accordions__details() {
    //  全てのdata属性"accordion-details"を取得
    //  直接<datails>タグを取得してもよい。しかし万が一他の処理と被る場合を考慮し指定している
    const details = document.querySelectorAll('[data-js="accordion-details"]');
    //  全detailsに対して処理
    details.forEach(element => {
      //  <summary> Q 質問部分
      const summary = element.querySelector('[data-js="accordion-summary"]');
      //  <div> A 出現する返答部分
      const content = element.querySelector('[data-js="accordion-content"]');

      //  <summary>部分にクリックイベント追加
      summary.addEventListener("click", event => {
        // デフォルトの挙動を無効化
        event.preventDefault();
        //  "data-open"と"open"の二種類の属性の違い
        //  "open" : <details>の開閉機能に関わるフラグ
        //  "data-open" : アイコンや開閉のアニメーション切り替えフラグ
        //  タイミングが違う

        //  クリック時data-openがtrueならアコーディオン閉じる処理
        if (element.dataset["open"] == "true") {
          // アイコン操作用フラグを倒す
          element.dataset["open"] = "false";
          content.dataset["open"] = "false";
          // アニメーション実行
          closingAnim(content, element).restart();

          //  クリック時data-openがfalseならアコーディオン開く処理
        } else {
          //  必要とあらば他の全detailsを閉じる処理

          // アイコン操作用フラグを立てる
          element.dataset["open"] = "true";
          content.dataset["open"] = "true";
          // 属性"open"を付与
          element.setAttribute("open", "true");

          // アニメーション実行
          openingAnim(content).restart();
        }
      });
    });
  }

  //----------------------------------------
  //  各種イベントの登録
  //----------------------------------------
  eventRegistration() {
    //  全アコーディオンを取得して設定
    this.set_accordions__details();
  }
}

/***/ }),

/***/ "../themes/blanktheme/assets_src/js/func/adjustviewport.js":
/*!*****************************************************************!*\
  !*** ../themes/blanktheme/assets_src/js/func/adjustviewport.js ***!
  \*****************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ adjustViewport; }
/* harmony export */ });
//---------------------------------------------
//
//  iPhone以下の画面サイズへの対応
//  ViewPortを書き換え縮小させる
//
//---------------------------------------------
class adjustViewport {
  constructor() {}

  //------------------------------------------------
  //  起動時375px以下なら375pxで固定
  //------------------------------------------------
  set(_executeWindowWidth) {
    //  リサイズ処理
    this.task();
    return;
  }

  //------------------------------------------------
  //  resizeイベントで使用
  //  低予算爆速対応の場合使用する、デザインの固定化
  //------------------------------------------------
  task() {
    //  未使用の場合
    //        return;

    let fFixed = false;
    const ww = window.outerWidth; //  ブラウザのリアル幅( リアル幅なのでリアルタイム変更に対応できる )
    //const ww = window.innerWidth; //  コンテンツ領域の幅( viewport固定したら以降そのままになってしまう )
    const elmViewport = document.querySelector('meta[name="viewport"]');
    let fixedwidth = 375;
    /*
            //  TAB時の画面固定化
            //  PCデザイン(1440px)～SPデザイン入るまでの間
            if( 768 < ww && ww <= 1440  ){
                fFixed = true;
                fixedwidth = 1440;
            }
            //  SP時の画面固定化
            //  SP時(768px以下)デザインの完全固定化
            else if(  ww <= 768  ){
                fFixed = true;
                fixedwidth = 390;
            }
    */

    //  SP時(375px以下)デザインの縮小方向固定化
    //        else if(  ww <= 375  ){
    if (ww <= 375) {
      fFixed = true;
      fixedwidth = 375;
    }

    //  固定範囲なので固定する / 固定しない時は通常に戻す
    let valueViewport = fFixed ? `width=${fixedwidth}, user-scalable=no` : 'width=device-width, initial-scale=1';
    if (elmViewport) {
      elmViewport.setAttribute('content', valueViewport);
    }
  }
}

/***/ }),

/***/ "../themes/blanktheme/assets_src/js/func/btn_gototop.js":
/*!**************************************************************!*\
  !*** ../themes/blanktheme/assets_src/js/func/btn_gototop.js ***!
  \**************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ buttonGotoTop; }
/* harmony export */ });
//========================================================
//
//  トップに戻るボタン
//
//  読み込み
//  import buttonGotoTop from './content/btn_gototop';
//
//  初期化
//  const btnGotoTop = new buttonGotoTop(切替スクロールY位置);
//  const btnGotoTop = new buttonGotoTop( 80 );
//
//  使い方
//  window.addEventListener('scroll', () => {
//    btnGotoTop.task();
//  });
//
//========================================================
class buttonGotoTop {
  constructor(i_overPosition) {
    //  スクロール
    //  一般的にはヘッダー超えた位置
    this.overPosition = i_overPosition;
    this.items = [];
  }

  //  指定Y位置超えてるか確認
  checkOver() {
    return document.documentElement.scrollTop > this.overPosition;
  }

  //  data-disp=openを設定して表示
  disp(i_item) {
    i_item.dataset.disp = "open";
  }
  //  data-disp=hideを設定して非表示
  hide(i_item) {
    i_item.dataset.disp = "hide";
  }
  //  スクロールイベント内で処理
  task(i_item) {
    this.checkOver() ? this.disp(i_item) : this.hide(i_item);
    //  アイテム名で分岐する要素があればここに書く等する
  }

  taskAll() {
    this.items.forEach(item => {
      this.task(item);
    });
  }

  //----------------------------------------
  //  gotoTop処理設定
  //----------------------------------------
  regist_gotoTop(i_item, i_name) {
    let itm = i_item;
    //  クリックイベントセット
    itm.addEventListener("click", () => {
      //  y0に戻る
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });
    //  登録時にY位置確認して表示/非表示処理
    this.task(itm);
  }

  //----------------------------------------
  //  名称で処理の分岐
  //----------------------------------------
  registItem(i_item, i_name) {
    //  名称で分岐
    switch (i_name) {
      case null:
        this.regist_gotoTop(i_item, i_name);
        break;
    }
  }

  //----------------------------------------
  //  イベント登録
  //----------------------------------------
  eventRegistration() {
    //  data-js="btngototop" : 全て取得
    let itmgroup = document.querySelectorAll('[data-js="gotoTopButton"]');
    //  ボタンの数だけループ
    itmgroup.forEach(item => {
      this.items.push(item); //配列に追加
      //  名前があれば取得、なければnull
      let name = item.dataset.name ? tem.dataset.name : null;
      this.registItem(item, name);
    });
  }
}

/***/ }),

/***/ "../themes/blanktheme/assets_src/js/func/buttons.js":
/*!**********************************************************!*\
  !*** ../themes/blanktheme/assets_src/js/func/buttons.js ***!
  \**********************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ buttons; }
/* harmony export */ });
//----------------------------------------
//  ボタン( ハンバーガー含む )
//----------------------------------------
class buttons {
  constructor() {
    this.buttons = [];
  }

  //----------------------------------------
  // スクロールを禁止にする関数
  //----------------------------------------
  disableScroll(event) {
    event.preventDefault();
  }
  addScrollStop() {
    document.addEventListener('touchmove', this.disableScroll, {
      passive: false
    });
    document.addEventListener('mousewheel', this.disableScroll, {
      passive: false
    });
  }
  removeScrollStop() {
    document.removeEventListener('touchmove', this.disableScroll, {
      passive: false
    });
    document.removeEventListener('mousewheel', this.disableScroll, {
      passive: false
    });
  }

  //----------------------------------------
  //  ウインドウリサイズ時の処理
  //----------------------------------------
  resize() {
    this.buttons.forEach(btn => {
      let name = btn.dataset.name;
      //  ハンバーガー
      if (name == "hamburger") {
        let elms = this.get_hamburgerElements(btn);
        this.hamburgerClose_isPC(btn, elms);
      }
    });
  }

  //----------------------------------------
  //  PC時リサイズでSP以下の幅になったら強制的に閉じる
  //----------------------------------------
  hamburgerClose_isPC(i_btn, i_elms) {
    //  ブラウザのリアル幅( リアル幅なのでリアルタイム変更に対応できる )
    const ww = window.outerWidth;
    //  commonを使ってサイトの分岐幅を設定しておくこと
    //  タブレット以上なら強制的に閉じる処理
    if (768 <= ww) {
      this.hamburgerClose(i_btn, i_elms);
    }
  }

  //----------------------------------------
  //  サイドバー タグオーバー
  //----------------------------------------
  regist_sidebar_tagover(i_item, i_name) {
    //  要素取得
    let elm = i_item;
    //  ボタンにクリックイベントセット
    elm.addEventListener("click", () => {
      let tar = document.querySelector(elm.dataset.tar);
      tar.style.height = '100%';
      elm.style.display = 'none';
    });
  }

  //========================================================
  //  ハンバーガー
  //----------------------------------------
  //  このハンバーガー要素に付属するdataから関連要素を全て取得
  //----------------------------------------
  get_hamburgerElements(i_item) {
    let itm = i_item;
    let elm = [];
    elm['btn'] = i_item;
    elm['header'] = document.querySelector("#" + itm.dataset.headerid);
    //  メニュー要素
    elm['menu'] = document.querySelector("#" + itm.dataset.menuid);
    elm['menubg'] = document.querySelector("#" + itm.dataset.menubgid);
    //  メニュー要素のul ID
    elm['ul'] = elm['menu'].querySelector("ul");
    elm['lia'] = elm['ul'].querySelectorAll("li a");
    return elm;
  }
  //----------------------------------------
  //  ハンバーガーの処理設定
  //----------------------------------------
  regist_hamburger(i_item, i_name) {
    let ham = i_item;
    //  要素要素取得
    let elm = this.get_hamburgerElements(i_item);
    //  ボタンにクリックイベントセット
    ham.addEventListener("click", () => {
      this.hamburgerToggle(i_item, elm);
    });
    //  ul liのメニューがクリックされたら閉じる
    elm['lia'].forEach(lia => {
      lia.addEventListener("click", () => {
        //  画面見えてから遷移するのが不格好なので閉じずに遷移させる
        //    this.hamburgerClose( i_item, elm );
      });
    });
  }

  //----------------------------------------
  //  ハンバーガー開く
  //----------------------------------------
  hamburgerToggle(i_item, i_elements) {
    let elms = i_elements;
    //  data-open="open"ではないので開く
    if (i_item.dataset.open != "open") {
      i_item.dataset.open = "open";
      elms['menu'].dataset.open = "open";
      elms['header'].dataset.open = "open";
      //  開いた スクロール停止
      //gsap.fromTo('.p-spmenu__background .stripe',{x:"100%"},{x:"0%",stagger:{each:0.1,from:"end"}});
      //gsap.fromTo('.p-spmenu__inner',{opacity:0},{opacity:1, duration :1.5} );
      this.addScrollStop();
    }
    //  "open"しているなら閉じる
    else {
      this.hamburgerClose(i_item, i_elements);
    }
  }

  //----------------------------------------
  //  ハンバーガー閉じる( 主にメニュークリック時 )
  //----------------------------------------
  hamburgerClose(i_item, i_elements) {
    let elms = i_elements;
    //  data-open="open"で開いている場合
    if (i_item.hasAttribute('data-open') && i_item.dataset.open == "open") {
      //console.log("SP→タブなので強制的に閉じます");
      i_item.dataset.open = "close";
      elms['menu'].dataset.open = "close";
      elms['header'].dataset.open = "close";
      // スクロール解除
      this.removeScrollStop();
    }
  }

  //----------------------------------------
  //  名称で処理の分岐
  //----------------------------------------
  registItem(i_item, i_name) {
    //  名称で分岐
    switch (i_name) {
      case "hamburger":
        this.regist_hamburger(i_item, i_name);
        break;
      case "sidebar_tagover":
        this.regist_sidebar_tagover(i_item, i_name);
        break;
    }
  }

  //----------------------------------------
  //  各種イベントの登録
  //----------------------------------------
  eventRegistration() {
    //  data-js="hamburger" : 全て取得
    let btngroup = document.querySelectorAll('[data-js="button"]');
    //  ボタンの数だけループ
    btngroup.forEach(btn => {
      this.buttons.push(btn); //配列に追加
      let name = btn.dataset.name;
      //  ボタンの識別名称があれば登録
      if (name) this.registItem(btn, name);
    });
  }
}

/***/ }),

/***/ "../themes/blanktheme/assets_src/js/func/common.js":
/*!*********************************************************!*\
  !*** ../themes/blanktheme/assets_src/js/func/common.js ***!
  \*********************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ Common; }
/* harmony export */ });
//----------------------------------------
//  共有変数グループ
//----------------------------------------
class Common {
  constructor() {
    this.wpvar = null;
  }

  //------------------------------------------------
  //  指定要素内の指定タグをspanで分割する
  //------------------------------------------------
  splitTarget_span(i_target, i_tag, i_reverse) {
    let divs = i_target;
    let spanText = null;
    //  タグが指定されていない場合
    if (i_tag == "" || i_tag == null) {
      divs = i_target;
      //  指定されている場合は取得
      spanText = divs.innerHTML;
    } else {
      divs = i_target.querySelector(i_tag);
      //console.log(i_target );
      spanText = divs.innerHTML;
    }
    //  要素内文字をspanで分割
    let newText = "";
    spanText.split('').forEach(char => {
      //  反転 :全て頭に入れ込む
      if (i_reverse) {
        newText = '<span>' + char + '</span>' + newText;
      } else {
        newText += '<span>' + char + '</span>';
      }
    });
    divs.innerHTML = newText;
    return divs;
  }

  //----------------------------------------
  //  phpから変数を取得
  //----------------------------------------
  get_phpvar() {
    //const json = '<?php echo $json_array; ?>';
    //const json1 = '{"result":true, "count":42}';
    this.wpvar = wp_var; //JSON.parse( json1 );
    //console.log( this.wpvar );
  }

  //----------------------------------------
  //  各種イベントの登録
  //----------------------------------------
  setting() {
    this.get_phpvar();
  }
}

/***/ }),

/***/ "../themes/blanktheme/assets_src/js/func/contactform.js":
/*!**************************************************************!*\
  !*** ../themes/blanktheme/assets_src/js/func/contactform.js ***!
  \**************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ contactform; }
/* harmony export */ });
//----------------------------------------
//  コンタクトフォーム処理
//  ( contactform7、自作問わず混合 )
//----------------------------------------
class contactform {
  constructor() {
    this.common = null;
    this.contactform = [];
  }

  //----------------------------------------
  //  WEB予約 : コンタクトフォームの処理設定
  //----------------------------------------
  regist_reserv(i_item, i_name) {
    let ham = i_item;
    //  要素取得
    let elm = i_item.querySelector('.wpcf7-form');
    const parent = this;
    //  contactform7のsubmitイベント
    elm.addEventListener('wpcf7mailsent', function (event) {
      //  ページ遷移
      const wpvar = parent.common.wpvar;
      location = wpvar.homeurl + 'reserv/thanks/';
    }, false);

    //  カレンダー入力の設定
    let elm_dates = elm.querySelectorAll("input[type='date']");
    elm_dates.forEach(d => {
      //console.log("初期値:",d.value); 
      d.addEventListener(`change`, function () {
        //  日付データ
        //console.log(d.value);
        //  データが空でないのでdata-dateに値をセット
        if (d.value) {
          d.dataset.date = d.value;
          //  データが空なのでdata-dateを削除
        } else {
          delete d.dataset.date;
        }
      });
    });
  }

  //----------------------------------------
  //  コンタクトフォームの処理設定
  //----------------------------------------
  regist_contact(i_item, i_name) {
    let ham = i_item;
    //  要素取得
    let elm = i_item.querySelector('.wpcf7-form');
    const parent = this;
    //  contactform7のsubmitイベント
    elm.addEventListener('wpcf7mailsent', function (event) {
      //  ページ遷移
      const wpvar = parent.common.wpvar;
      location = wpvar.homeurl + 'contact/thanks/';
    }, false);
  }

  //----------------------------------------
  //  名称で処理の分岐
  //----------------------------------------
  registItem(i_item, i_name) {
    //  名称で分岐
    switch (i_name) {
      case "contact":
        this.regist_contact(i_item, i_name);
        break;
      case "reserv":
        this.regist_reserv(i_item, i_name);
        break;
    }
  }

  //----------------------------------------
  //  各種イベントの登録
  //----------------------------------------
  eventRegistration(i_common) {
    this.common = i_common;
    //  data-js="hamburger" : 全て取得
    let cfgroup = document.querySelectorAll('[data-js="contactform"]');
    //  ボタンの数だけループ
    cfgroup.forEach(cf => {
      this.contactform.push(cf); //配列に追加
      let name = null;
      //  ボタンの識別名称があれば登録
      if (cf.dataset.name) name = cf.dataset.name;
      this.registItem(cf, name);
    });
  }
}

/***/ }),

/***/ "../themes/blanktheme/assets_src/js/func/header.js":
/*!*********************************************************!*\
  !*** ../themes/blanktheme/assets_src/js/func/header.js ***!
  \*********************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ partsHeader; }
/* harmony export */ });
//----------------------------------------
//  ヘッダー処理
//  
//  指定位置超えたらヘッダー浮かす
//----------------------------------------
class partsHeader {
  constructor(i_header) {
    this.dispPosition = 0; // 120;    //  ヘッダーの位置による

    this.boxTop = new Array();
    this.current = -1;
  }
  scrollTask() {
    //  ヘッダーのfloat表示
    this.taskFloat();
  }

  //--------------------------------------------------
  //      ヘッダー浮かし処理
  //--------------------------------------------------
  taskFloat() {
    var scroll = document.documentElement.scrollTop;
    if (!this.pheader) return;
    //  位置を超えていたらヘッダーを浮かす
    if (scroll > this.dispPosition) {
      this.lheader.dataset.float = "true";
      this.pheader.dataset.float = "true";
      this.body.dataset.float = "true";
    } else {
      this.lheader.dataset.float = "false";
      this.pheader.dataset.float = "false";
      this.body.dataset.float = "false";
    }
  }

  //----------------------------------------
  //  設定
  //----------------------------------------
  registItem(i_item) {
    //  名称で分岐
    //this.regist_gotoTop( i_item, i_name );
  }

  //----------------------------------------
  //  イベント登録
  //----------------------------------------
  eventRegistration() {
    this.body = document.querySelector("body");
    let itm = document.querySelector('[data-js="header"]');
    if (!itm) return;
    let cr = itm.getBoundingClientRect();
    this.dispPosition = cr.bottom; //  ヘッダーの下超えたら浮かす
    this.lheader = itm;
    this.pheader = this.lheader.querySelector('.p-header');
    if (!this.pheader) return;
    this.registItem(itm);
  }
}

/***/ }),

/***/ "../themes/blanktheme/assets_src/js/func/loading.js":
/*!**********************************************************!*\
  !*** ../themes/blanktheme/assets_src/js/func/loading.js ***!
  \**********************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ loadingScreen; }
/* harmony export */ });
//========================================================
//
//  Nowloading... 読み込み画面
//
//========================================================
class loadingScreen {
  constructor() {
    this.screen = null;
  }
  //--------------------------------
  //  イベント登録
  //--------------------------------
  eventRegistration() {
    let scr = document.querySelector('[data-js="loadingscreen"]');
    //  ローディング画面の指定がある要素があれば設定
    if (scr) {
      this.screen = scr;
      //  一定時間後に非表示
      window.addEventListener('load', () => {
        setTimeout(function () {
          scr.classList.add("hide");
        }, 200);
      });
    }
  }
}

/***/ }),

/***/ "../themes/blanktheme/assets_src/js/func/oscheck.js":
/*!**********************************************************!*\
  !*** ../themes/blanktheme/assets_src/js/func/oscheck.js ***!
  \**********************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ osCheck; }
/* harmony export */ });
//----------------------------------------
//
//  os Check
//  OSとブラウザのチェック
//
//----------------------------------------
class osCheck {
  static isPC = 0;
  static isSP = 1;
  static isTab = 2;
  constructor() {
    //    this.dispUserAgent();

    //  iOSのバージョンがある
    if (this.getiOSVersion()) {
      let body = document.getElementsByTagName('body')[0];
      //body.classList.add('iOS');
    }
  }

  //  userAgent確認用領域があれば、取得情報を出力
  dispUserAgent(i_output) {
    let div_ua = document.querySelector(i_output);
    if (div_ua) {
      div_ua.innerText = navigator.userAgent;
    }
  }

  //  bodyタグにclass付与する
  markBody() {
    //  識別したbodyにclass付与
    if (navigator.userAgent.indexOf('iPhone') > 0) {
      let body = document.getElementsByTagName('body')[0];
      body.classList.add('iphone');
    }
    //  識別したbodyにclass付与
    if (navigator.userAgent.indexOf('Macintosh') > 0) {
      let body = document.getElementsByTagName('body')[0];
      body.classList.add('macintosh');
    }
    if (navigator.userAgent.indexOf('iPad') > 0) {
      let body = document.getElementsByTagName('body')[0];
      body.classList.add('ipad');
    }
    if (navigator.userAgent.indexOf('Android') > 0) {
      let body = document.getElementsByTagName('body')[0];
      body.classList.add('android');
    }
    //  ブラウザ名を追加
    document.body.classList.add(this.getBrowser().toLowerCase());
  }

  //  ユーザーエージェントの確認
  checkUA() {
    var ua = navigator.userAgent;
    //    console.log(ua);
    // スマートフォン用の記述

    if (ua.indexOf('iPhone') > 0 || ua.indexOf('iPod') > 0 || ua.indexOf('Android') > 0 && ua.indexOf('Mobile') > 0) {
      //    if ((ua.indexOf('iPhone') > 0 || ua.indexOf('Android') > 0) && ua.indexOf('Mobile') > 0) {
      //        console.log("isSP");
      return isSP;

      // タブレット用の記述
    } else if (ua.indexOf('iPad') > 0 || ua.indexOf('Android') > 0) {
      //        console.log("isTab");
      return isTab;

      // PC用の記述
    } else {
      //        console.log("isPC");
      return isPC;
    }
  }
  getBrowser() {
    const userAgent = navigator.userAgent.toLowerCase();
    //console.log( userAgent );
    if (userAgent.indexOf('chrome') !== -1) {
      return 'Chrome';
    } else if (userAgent.indexOf('firefox') !== -1) {
      return 'Firefox';
    } else if (userAgent.indexOf('safari') !== -1) {
      return 'Safari';
    } else if (userAgent.indexOf('edge') !== -1) {
      return 'Edge';
    } else if (userAgent.indexOf('msie') !== -1 || userAgent.indexOf('trident') !== -1) {
      //  IEの場合<picture>非対応なのでpicturefill.jsを使用する
      const head = document.head;
      head.insertAdjacentHTML('beforeEnd', '<script src="js/picturefill.min.js" async><\/script>');
      return 'IE';
    } else {
      return 'Unknown';
    }
  }

  //  iOSバージョン
  getiOSVersion() {
    return parseFloat(('' + (/CPU.*OS ([0-9_]{1,5})|(CPU like).*AppleWebKit.*Mobile/i.exec(navigator.userAgent) || [0, ''])[1]).replace('undefined', '3_2').replace('_', '.').replace('_', '')) || false;
  }
}

/***/ }),

/***/ "../themes/blanktheme/assets_src/js/func/smoothscroll.js":
/*!***************************************************************!*\
  !*** ../themes/blanktheme/assets_src/js/func/smoothscroll.js ***!
  \***************************************************************/
/***/ (function() {

const pHeader = document.querySelector('header');
const headerHeight = pHeader ? pHeader.offsetHeight : 0;
const adjustHeader = 0;
const smoothScrollSpeed = 500;

//  全てのa href="#"を取得
let alinks = document.querySelectorAll('a[href^="#"]');
//  全てのaにクリックイベント設定
alinks.forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    var target = null;
    // クリックされたときのデフォルトの挙動を防ぐ
    e.preventDefault();
    let href = anchor.getAttribute("href");
    let rep = href.replace('#', '');
    // href属性の#を取り除いた部分と一致するIDを取得
    if (rep != "") target = document.getElementById(rep);

    //取得した要素の位置を取得するために、getBoundingClientRect()を呼び出し、ページ上の位置を計算。
    //headerの高さを引いて、スクロール位置がヘッダーの下になるように調整します。
    let targetPosition = 0;
    if (target) {
      targetPosition = target.getBoundingClientRect().top + window.scrollY - headerHeight;
    }

    // window.scrollTo()を呼び出して、スクロール位置を設定します。behaviorオプションをsmoothに設定することで、スムーズなスクロールを実現します。
    window.scrollTo({
      top: targetPosition,
      behavior: 'smooth'
    });
  });
});

/***/ }),

/***/ "../themes/blanktheme/assets_src/js/func/swiper-setting.js":
/*!*****************************************************************!*\
  !*** ../themes/blanktheme/assets_src/js/func/swiper-setting.js ***!
  \*****************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ swiperGroup; }
/* harmony export */ });


//----------------------------------------
//  swiperグループ
//----------------------------------------
class swiperGroup {
  constructor() {
    this.swiperObjs = []; //  HTML上の.swiper
    this.swipers = []; //  js上のswiper
  }

  //----------------------------------------
  //  hTMLタグ : スライドの複製処理
  //  自力で複製する必要がある
  //----------------------------------------
  make_clone(i_swiper) {
    //  swiperを作成する前に、要素を複製する
    //  swiperの仕様上、swiper-slide数>=SlidePerView*2.5でないと正常にループできない為
    const slides = i_swiper.querySelectorAll('.swiper-slide');

    //  スライド数をSlidePerView*2.5を超えるために必要な複製回数( 綺麗にループできる倍数 )
    let spv = 5; //  最大表示したい枚数
    let sscnt = slides.length >= spv * 2.5 ? 0 : Math.floor(spv * 2.5 / slides.length);
    let clones = [];
    let i = 0,
      j = 0;
    //  同じ複製自体を何度もコピーできないので、必要な数複製する
    for (j = 0; j < sscnt; j++) {
      slides.forEach(slide => {
        clones.push(slide.cloneNode(true));
      });
    }

    //  複製をSlidePerView*2.5を超えるようにセット(2回)
    let swipw = i_swiper.querySelector(".swiper-wrapper");
    for (i = 0; i < clones.length; i++) {
      swipw.appendChild(clones[i]);
    }
    return slides;
  }

  //----------------------------------------
  //  個別 : fv
  //----------------------------------------
  make_fv(i_swiper, i_name) {
    const sname = i_swiper + ' .swiper';
    // swiperslider
    this.swipers[i_name] = new Swiper(sname, {
      loop: true,
      allowTouchMove: false,
      //  ドラッグ有効
      //  ページネーション
      pagination: {
        el: i_swiper + ' .swiper-pagination',
        type: "bullets",
        clickable: "clickable"
      },
      // Navigation arrows
      navigation: {
        nextEl: i_swiper + ' .swiper-button-next',
        prevEl: i_swiper + ' .swiper-button-prev'
      },
      effect: 'fade',
      centeredSlides: true,
      //アクティブなスライドを中央に表示
      spaceBetween: 16,
      //スライド間の距離を16pxに
      slidesPerView: 1,
      //スライダーのコンテナ上に1枚同時に表示
      breakpoints: {
        //小さい順に設定する
        1024: {
          slidesPerView: 1
        }
      },
      updateOnWindowResize: true,
      //  ウインドウサイズ変更時自動再計算
      autoplay: true
    });
    this.swipers[i_name].element = document.querySelector(sname);
  }

  //----------------------------------------
  //  個別 : staff
  //----------------------------------------
  make_staff(i_swiper, i_name) {
    const sname = i_swiper + ' .swiper';
    const swiobj = document.querySelectorAll(sname);
    //  クローン作成
    this.make_clone(swiobj.item(0));
    // swiper slider
    this.swipers[i_name] = new Swiper(sname, {
      loop: true,
      allowTouchMove: true,
      //  ドラッグ有効
      //  ページネーション
      centeredSlides: true,
      //アクティブなスライドを中央に表示
      spaceBetween: 20,
      //スライド間の距離を16pxに
      loopAdditionalSlides: 1,
      // 本来見えていない部分にスライドを複製する
      slidesPerView: 'auto',
      //スライダーのコンテナ上に1枚同時に表示
      updateOnWindowResize: true,
      //  ウインドウサイズ変更時自動再計算
      speed: 6000,
      autoplay: {
        delay: 0,
        pauseOnMouseEnter: true,
        // ホバー時停止
        disableOnInteraction: false // ホバー解除時再開
      }
    });

    this.swipers[i_name].element = document.querySelector(sname);
  }

  //----------------------------------------
  //  swiperの作成
  //----------------------------------------
  registSwiper(i_swiper, i_name) {
    this.swiperObjs[i_name] = i_swiper; //  HTML swiperタグ
    switch (i_name) {
      case "fv":
        this.make_fv(".p-fv-swiper", i_name);
        break;
      case "staff":
        this.make_staff(".p-staff-swiper-wrap", i_name);
        break;
    }
  }

  //----------------------------------------
  //  各種イベントの登録
  //----------------------------------------
  eventRegistration() {
    //  swiperを全て取得
    let swipergroup = document.querySelectorAll('.swiper');
    swipergroup.forEach(swiper => {
      //  swiperに指定してある"data-name"を取得
      let name = swiper.dataset.name;
      //  swiperの識別名称がある場合は設定
      if (name) this.registSwiper(swiper, name);
    });
  }
}

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	!function() {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = function(module) {
/******/ 			var getter = module && module.__esModule ?
/******/ 				function() { return module['default']; } :
/******/ 				function() { return module; };
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	!function() {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = function(exports, definition) {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	!function() {
/******/ 		__webpack_require__.o = function(obj, prop) { return Object.prototype.hasOwnProperty.call(obj, prop); }
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	!function() {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = function(exports) {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	}();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be in strict mode.
!function() {
"use strict";
/*!****************************************************!*\
  !*** ../themes/blanktheme/assets_src/js/_index.js ***!
  \****************************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _func_smoothscroll__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./func/smoothscroll */ "../themes/blanktheme/assets_src/js/func/smoothscroll.js");
/* harmony import */ var _func_smoothscroll__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_func_smoothscroll__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _func_common__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./func/common */ "../themes/blanktheme/assets_src/js/func/common.js");
/* harmony import */ var _func_header__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./func/header */ "../themes/blanktheme/assets_src/js/func/header.js");
/* harmony import */ var _anim_gsap__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./anim/gsap */ "../themes/blanktheme/assets_src/js/anim/gsap.js");
/* harmony import */ var _func_adjustviewport__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./func/adjustviewport */ "../themes/blanktheme/assets_src/js/func/adjustviewport.js");
/* harmony import */ var _func_oscheck__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./func/oscheck */ "../themes/blanktheme/assets_src/js/func/oscheck.js");
/* harmony import */ var _func_buttons__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./func/buttons */ "../themes/blanktheme/assets_src/js/func/buttons.js");
/* harmony import */ var _func_accordion__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./func/accordion */ "../themes/blanktheme/assets_src/js/func/accordion.js");
/* harmony import */ var _func_btn_gototop__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./func/btn_gototop */ "../themes/blanktheme/assets_src/js/func/btn_gototop.js");
/* harmony import */ var _func_swiper_setting__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ./func/swiper-setting */ "../themes/blanktheme/assets_src/js/func/swiper-setting.js");
/* harmony import */ var _func_loading__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! ./func/loading */ "../themes/blanktheme/assets_src/js/func/loading.js");
/* harmony import */ var _func_contactform__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! ./func/contactform */ "../themes/blanktheme/assets_src/js/func/contactform.js");


//  スムーススクロール( IDジャンプした際にURLにIDが付与されるのを回避 )

 //  共有変数の入れ物

 //  ヘッダ処理
 //  GSAPアニメーション
 //  ビューポート調整
 //  ビューポート調整
 //  ボタン( ハンバーガー含む )
 //  アコーディオン
 //  トップに戻る
 //  swiper設定
 //  ローディング表示

 //  コンタクト

const varcommon = new _func_common__WEBPACK_IMPORTED_MODULE_1__["default"]();
const header = new _func_header__WEBPACK_IMPORTED_MODULE_2__["default"]();
const anim_gsap = new _anim_gsap__WEBPACK_IMPORTED_MODULE_3__["default"]();
const adjustviewport = new _func_adjustviewport__WEBPACK_IMPORTED_MODULE_4__["default"]();
const oscheck = new _func_oscheck__WEBPACK_IMPORTED_MODULE_5__["default"]();
const btnGotoTop = new _func_btn_gototop__WEBPACK_IMPORTED_MODULE_8__["default"](90); //  ヘッダーの高さ
const buttons = new _func_buttons__WEBPACK_IMPORTED_MODULE_6__["default"]();
const accordions = new _func_accordion__WEBPACK_IMPORTED_MODULE_7__["default"]();
const swipergroup = new _func_swiper_setting__WEBPACK_IMPORTED_MODULE_9__["default"]();
const loadingscreen = new _func_loading__WEBPACK_IMPORTED_MODULE_10__["default"]();
const contactform = new _func_contactform__WEBPACK_IMPORTED_MODULE_11__["default"]();

// ※WordPressのjs読み込み時に「wp_var」という配列を作成し
// WordPressの変数を受け渡ししている。
// HTMLに記述されるのでセキュリティ的に微妙だが他に方法がない

//  初期化関数
const init = function () {
  //  ビューポートの調整
  adjustviewport.set();
  varcommon.setting();
  //  GSAPアニメ登録
  anim_gsap.eventRegistration(varcommon);
  //  bodyに機種とブラウザを記述
  oscheck.markBody();

  //  ヘッダー設定
  header.eventRegistration();

  //  スワイパー
  swipergroup.eventRegistration();
  varcommon.swipers = swipergroup.swipers;

  //  ヘッダーハンバーガーの設定
  buttons.eventRegistration();
  //  トップに戻る
  btnGotoTop.eventRegistration();
  //  アコーディオン設定
  //accordions.eventRegistration();
  //  ローディング
  loadingscreen.eventRegistration();

  //  コンタクトフォーム
  contactform.eventRegistration(varcommon);
};

//  イベント : ロード
window.addEventListener('DOMContentLoaded', () => {
  init();
});

//  イベント : スクロール
window.addEventListener('scroll', () => {
  header.taskFloat(); //  ヘッダー浮かす/戻す処理    
  btnGotoTop.taskAll(); //  「トップに戻る」の表示/非表示
});

//  イベント : リサイズ
window.addEventListener("resize", () => {
  //  ビューポートの調整
  adjustviewport.task();
  //  SP→TAB・PCに切り替わった際SPメニュー閉じる処理
  buttons.resize();
});

//  イベント : キー
window.addEventListener("keydown", event => {});
}();
/******/ })()
;
//# sourceMappingURL=bundle.js.map