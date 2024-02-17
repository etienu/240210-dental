<?php
//---------------------------------------------
//
//  カスタムフィールド用セクションの宣言
//  診療案内
//---------------------------------------------

function create_custom_fields_staff()
{
  add_meta_box(
    'custom_field_staff',         //セクションのID
    'カスタムフィールドエリア', //セクションのタイトル
    'insert_custom_fields_staff',     //フォーム部分を指定する関数
    'staff',             //  投稿タイプ名、カスタム投稿タイプ名
    'normal',           //  セクションの表示場所
    'default'           //  優先度
  );
}
add_action('admin_menu', 'create_custom_fields_staff');

//---------------------------------------------
//
//  見た目（フォーム部分）の指定
//
//---------------------------------------------
function insert_custom_fields_staff($post)
{
  //    nounceフィールドの追加
  wp_nonce_field('custom_field_save_meta_box_data', 'custom_field_meta_box_nonce');

  //    データ
  $cf_txt_origin = get_post_meta($post->ID, 'staff_txt_origin', true);
  $cf_txt_hobby = get_post_meta($post->ID, 'staff_txt_hobby', true);
  $cf_txt_favfood = get_post_meta($post->ID, 'staff_txt_favfood', true);
?> 
    <style>
        .cf{
            display: flex;
            flex-direction :row;
            gap: 20px;
        }
        .cf__row{
            display: flex;
            flex-direction : column;
        }
        .cf__row > input {
            min-width: 200px;
        }
        .cf__row > textarea{
            white-space:pre-wrap;
            min-width: 400px;
            min-height: 200px;
        }
        .cf__row > p{
            white-space:pre-wrap;
        }
        #cf_txt_testsummary{
            white-space:pre-wrap;
        }
    </style>
    <div class ="cf">
        <div class ="cf__row">
            <!-- 名前は記事タイトル -->
            <label for="cf_txt_origin">出身地</label>
            <input id="cf_txt_origin" type="text" name="cf_txt_origin" value="<?php echo $cf_txt_origin; ?>">
            <br>
            <label for="cf_txt_hobby">趣味</label>
            <input id="cf_txt_hobby" type="text" name="cf_txt_hobby" value="<?php echo $cf_txt_hobby; ?>">
            <br>
            <label for="cf_txt_favfood">好きな食べ物</label>
            <textarea id="cf_txt_favfood" name="cf_txt_favfood"><?php echo $cf_txt_favfood; ?></textarea>
        </div>
    </div>
  <br>
<?php
}

//---------------------------------------------
//
//  データの保存処理
//
//---------------------------------------------
function save_custom_fields_staff($post_id)
{
  //nounceがセットされているか確認
  if (!isset($_POST['custom_field_meta_box_nonce'])) {
    return;
  }

  //nounceが正しいか検証
  if (!wp_verify_nonce($_POST['custom_field_meta_box_nonce'], 'custom_field_save_meta_box_data')) {
    return;
  }

  //    スタッフ
  if (isset($_POST['cf_txt_origin'])) {
    $data = sanitize_text_field($_POST['cf_txt_origin']);
    update_post_meta($post_id, 'staff_txt_origin', $data);
  }
  if (isset($_POST['cf_txt_hobby'])) {
    $data = sanitize_text_field($_POST['cf_txt_hobby']);
    update_post_meta($post_id, 'staff_txt_hobby', $data);
  }
  if (isset($_POST['cf_txt_favfood'])) {
    $data = sanitize_text_field($_POST['cf_txt_favfood']);
    update_post_meta($post_id, 'staff_txt_favfood', $data);
  }

}

add_action('save_post', 'save_custom_fields_staff');
