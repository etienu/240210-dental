//----------------------------------------
//  ヘッダー処理
//  
//  指定位置超えたらヘッダー浮かす
//----------------------------------------
export default class partsHeader {
    constructor(i_header) {
        this.dispPosition = 0; // 120;    //  ヘッダーの位置による

        this.boxTop = new Array;
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
        if( !this.pheader ) return;
        //  位置を超えていたらヘッダーを浮かす
        if (scroll > this.dispPosition) {
            this.lheader.dataset.float ="true";
            this.pheader.dataset.float ="true";
            this.body.dataset.float ="true";
        } else {
            this.lheader.dataset.float ="false";
            this.pheader.dataset.float ="false";
            this.body.dataset.float ="false";

        }
    }

    //----------------------------------------
    //  設定
    //----------------------------------------
    registItem( i_item ) {
        //  名称で分岐
        //this.regist_gotoTop( i_item, i_name );
    }    

    //----------------------------------------
    //  イベント登録
    //----------------------------------------
    eventRegistration() {
        this.body = document.querySelector("body");
        let itm = document.querySelector('[data-js="header"]');
        if( !itm ) return;
        let cr = itm.getBoundingClientRect();
        this.dispPosition = cr.bottom;   //  ヘッダーの下超えたら浮かす
        this.lheader = itm;
        this.pheader = this.lheader.querySelector('.p-header')
        if( !this.pheader ) return;
        this.registItem( itm );
    }

}