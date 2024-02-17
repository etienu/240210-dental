<?php
//---------------------------------------------
//
//  カスタムフィールド用セクションの宣言
//  診療案内
//---------------------------------------------

function create_custom_fields_medical()
{
    add_meta_box(
    'custom_field_medical',       //  セクションのID
    'カスタムフィールドエリア',     //  セクションのタイトル
    'insert_custom_fields_medical',  // フォーム部分を指定する関数
    'medical',          //  投稿タイプ名、カスタム投稿タイプ名
    'normal',           //  セクションの表示場所
    'default'           //  優先度
    );
}
add_action('admin_menu', 'create_custom_fields_medical');

//---------------------------------------------
//
//  見た目（フォーム部分）の指定
//
//---------------------------------------------
function insert_custom_fields_medical($post)
{
  //    nounceフィールドの追加
  wp_nonce_field('custom_field_save_meta_box_data', 'custom_field_meta_box_nonce');

  $cf_txt_description = get_post_meta($post->ID, 'medical_txt_description', true);
  $cf_txt_id = get_post_meta($post->ID, 'medical_txt_id', true);
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
            <label for="cf_txt_description">説明</label>
            <textarea id="cf_txt_description" name="cf_txt_description"><?php echo $cf_txt_description; ?></textarea>
        </div>
        <div class ="cf__row">
            <label for="cf_txt_id">Jump ID</label>
            <input id="cf_txt_id" type="text" name="cf_txt_id" value="<?php echo $cf_txt_id; ?>">
            <br>
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
function save_custom_fields_medical($post_id)
{
  //nounceがセットされているか確認
  if (!isset($_POST['custom_field_meta_box_nonce'])) {
    return;
  }

  //nounceが正しいか検証
  if (!wp_verify_nonce($_POST['custom_field_meta_box_nonce'], 'custom_field_save_meta_box_data')) {
    return;
  }

  //    保存
  if (isset($_POST['cf_txt_description'])) {
    $data = sanitize_text_field($_POST['cf_txt_description']);
    update_post_meta($post_id, 'medical_txt_description', $data);
  }
  if (isset($_POST['cf_txt_id'])) {
    $data = sanitize_text_field($_POST['cf_txt_id']);
    update_post_meta($post_id, 'medical_txt_id', $data);
  }

}

add_action('save_post', 'save_custom_fields_medical');
