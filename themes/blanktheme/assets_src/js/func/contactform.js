//----------------------------------------
//  コンタクトフォーム処理
//  ( contactform7、自作問わず混合 )
//----------------------------------------
export default class contactform {
    constructor() {
        this.common = null;
        this.contactform = [];
    }

    //----------------------------------------
    //  WEB予約 : コンタクトフォームの処理設定
    //----------------------------------------
    regist_reserv( i_item, i_name ) {
        let ham = i_item;
        //  要素取得
        let elm = i_item.querySelector('.wpcf7-form');
        const parent = this;
        //  contactform7のsubmitイベント
        elm.addEventListener( 'wpcf7mailsent', function( event ) {
            //  ページ遷移
            const wpvar = parent.common.wpvar;
            location = wpvar.homeurl + 'reserv/thanks/';
        }, false );

        //  カレンダー入力の設定
        let elm_dates = elm.querySelectorAll("input[type='date']");
        elm_dates.forEach((d) => {
            console.log("初期値:",d.value); 
            d.addEventListener(`change`, function () {
                //  日付データ
                //console.log(d.value);
                //  データが空でないのでdata-dateに値をセット
                if( d.value ){
                    d.dataset.date = d.value;
                //  データが空なのでdata-dateを削除
                }else{
                    delete d.dataset.date;
                }
            });
        });


    }

    //----------------------------------------
    //  コンタクトフォームの処理設定
    //----------------------------------------
    regist_contact( i_item, i_name ) {
        let ham = i_item;
        //  要素取得
        let elm = i_item.querySelector('.wpcf7-form');
        const parent = this;
        //  contactform7のsubmitイベント
        elm.addEventListener( 'wpcf7mailsent', function( event ) {
            //  ページ遷移
            const wpvar = parent.common.wpvar;
            location = wpvar.homeurl + 'contact/thanks/';
        }, false );
        

    }



    //----------------------------------------
    //  名称で処理の分岐
    //----------------------------------------
    registItem( i_item, i_name ) {
        //  名称で分岐
        switch( i_name ){
        case "contact" : this.regist_contact( i_item, i_name ); break;
        case "reserv" : this.regist_reserv( i_item, i_name ); break;
        }
    }    

    //----------------------------------------
    //  各種イベントの登録
    //----------------------------------------
    eventRegistration( i_common ) {
        this.common = i_common;
        //  data-js="hamburger" : 全て取得
        let cfgroup = document.querySelectorAll('[data-js="contactform"]');
        //  ボタンの数だけループ
        cfgroup.forEach((cf) => {
            this.contactform.push( cf );   //配列に追加
            let name = null;
            //  ボタンの識別名称があれば登録
            if( cf.dataset.name ) name = cf.dataset.name;
            this.registItem( cf, name );
        });
    }
}