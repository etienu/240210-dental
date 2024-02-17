'use strict';

//  スムーススクロール( IDジャンプした際にURLにIDが付与されるのを回避 )
import './func/smoothscroll';

import varCommon from './func/common'; //  共有変数の入れ物

import Header from './func/header';             //  ヘッダ処理
import anim_GSAP from './anim/gsap';            //  GSAPアニメーション
import adjustViewport from './func/adjustviewport'; //  ビューポート調整
import osCheck from './func/oscheck'; //  ビューポート調整
import Buttons from './func/buttons';           //  ボタン( ハンバーガー含む )
import Accordions from './func/accordion';      //  アコーディオン
import buttonGotoTop from './func/btn_gototop'; //  トップに戻る
import swiperGroup from './func/swiper-setting';//  swiper設定
import loadingScreen from './func/loading';         //  ローディング表示

import contactForm from './func/contactform';       //  コンタクト


const varcommon = new varCommon();
const header = new Header();
const anim_gsap = new anim_GSAP();
const adjustviewport = new adjustViewport();
const oscheck = new osCheck();
const btnGotoTop = new buttonGotoTop( 90 ); //  ヘッダーの高さ
const buttons = new Buttons();
const accordions = new Accordions();
const swipergroup = new swiperGroup();
const loadingscreen = new loadingScreen();
const contactform = new contactForm();

// ※WordPressのjs読み込み時に「wp_var」という配列を作成し
// WordPressの変数を受け渡ししている。
// HTMLに記述されるのでセキュリティ的に微妙だが他に方法がない

//  初期化関数
const init = function() {
    //  ビューポートの調整
    adjustviewport.set();
    varcommon.setting();
    //  GSAPアニメ登録
    anim_gsap.eventRegistration( varcommon );    
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
    contactform.eventRegistration( varcommon );
};


//  イベント : ロード
window.addEventListener('DOMContentLoaded', () => {
    init();
});

//  イベント : スクロール
window.addEventListener('scroll', () => {
    header.taskFloat(); //  ヘッダー浮かす/戻す処理    
    btnGotoTop.taskAll();   //  「トップに戻る」の表示/非表示
});

//  イベント : リサイズ
window.addEventListener("resize", () => {
    //  ビューポートの調整
    adjustviewport.task();    
    //  SP→TAB・PCに切り替わった際SPメニュー閉じる処理
    buttons.resize();
});

//  イベント : キー
window.addEventListener("keydown", (event) =>{
});
