//----------------------------------------
//  共有変数グループ
//----------------------------------------
export default class Common {
    constructor() {
        this.wpvar = null;
    }

    //------------------------------------------------
    //  指定要素内の指定タグをspanで分割する
    //------------------------------------------------
    splitTarget_span( i_target, i_tag, i_reverse ){
        let divs = i_target;
        let spanText = null;
        //  タグが指定されていない場合
        if( (i_tag == "" || i_tag== null) ){
            divs = i_target;
        //  指定されている場合は取得
            spanText = divs.innerHTML;
        }else{
            divs = i_target.querySelector(i_tag);
            console.log(i_target );
            spanText = divs.innerHTML;
        }
        //  要素内文字をspanで分割
        let newText = "";
        spanText.split('').forEach((char)=>{
            //  反転 :全て頭に入れ込む
            if( i_reverse ){
                newText = '<span>' + char + '</span>' + newText;
            }else{
                newText += '<span>' + char + '</span>';
            }
        });
        divs.innerHTML = newText;
        return divs;
    }

    //----------------------------------------
    //  phpから変数を取得
    //----------------------------------------
    get_phpvar(){
        //const json = '<?php echo $json_array; ?>';
        //const json1 = '{"result":true, "count":42}';
        this.wpvar = wp_var;//JSON.parse( json1 );
        //console.log( this.wpvar );
    }

    //----------------------------------------
    //  各種イベントの登録
    //----------------------------------------
    setting() {
        this.get_phpvar();
    }
}