<?php

// テンプレートディレクトリ
$template_dir = __DIR__ . '/../template/';

$config = [
  'debug' => false,

  // 簡易CSRFトークンのチェックを行うか（連続投稿の防止などに使用しますが、ブラウザの戻るボタンで入力画面に戻ることや、更新ボタンによる再投稿ができなくなります）
  'check_token' => true,

  // テンプレートディレクトリ
  'template_dir' => $template_dir,

  // CSVファイル
  'csv' => __DIR__ . '/../file/data.csv',

  // CSVテンプレート
  'csv_template' => [
    'ID' => [ 'value' => '' ],
    '氏名' => 'name',
    'フリガナ' => 'kana',
    '担当' => [ 'value' => '' ],
    '最終更新日' => [ 'value' => '' ],
    '追客' => [ 'value' => '' ],
    'DM' => [ 'value' => 'TRUE' ],
    'DM不要' => [ 'value' => 'FALSE' ],
    '郵便番号' => 'zip',
    '住所' => 'address',
    '電話番号1' => 'tel',
    'メールアドレス' => 'email',
    'ソース' => [ 'value' => 'HPメール' ],
    '希望エリア' => 'examination',
    '内容' => 'message',
    '初回対応日' => [ 'date' => 'Y-m-d' ],
    '土地活用' => 'categ1',
    'AP建築' => 'categ2',
    'リフォーム' => 'categ8',
    '管理' => 'categ3',
    '資料請求' => 'categ4',
    '収益物件' => 'categ7',
    '土地購入' => 'categ5',
    '内覧会' => 'categ6',
    '修繕共済' => 'categ9',
    '資料送付済' => [ 'value' => '' ],
    '備考' => [ 'value' => '' ],
    'ボツ理由' => [ 'value' => '' ],
    'アンケート' => 'enquete',
  ],

  // メール設定
  'mail' => [
    // 送信元として表示されるメールアドレス
    'from' => 'noreply@amix.co.jp',

    // 管理者宛
    'admin' => [
      'to' => 'owner-info@amix.co.jp,matsu@deep-deep.jp,iwata@az-c.com',

      // toのメールアドレスのドメインが設置サーバーと同じドメインになっている場合、sendmailの調整が必要な場合あり
      // https://qiita.com/yukihirog/items/eeaae1e0a0b61b3110bd
      'subject' => 'ウェブサイトから、お問い合わせがありました',
      'template' => $template_dir . '/mail/admin.php',
    ],

    // ユーザー宛
    'user' => [
      'subject' => '【自動返信メール】お問い合わせ・資料請求を受け付けました',
      'template' => $template_dir . '/mail/user.php',
    ],
  ],

  // ファイルアップロードの設定
  'upload' => [
    // 保存先
    'dir' => __DIR__ . '/../file/',

    // 一時ファイルの保存先（確認画面の段階のファイル）
    'temp_dir' => __DIR__ . '/../file/_temp/',

    // 一時ファイルの有効期限（秒）
    'expires' => 60 * 60, // 1時間
  ],

  // 入力項目の設定
  'model' => [
    /*
    'nameの値' => [
      // 必須の設定
      'label' => '表示名',
      'type' => '入力欄のタイプ',

      // 以下は任意
      'required' => true, // 必須入力の場合:true
      'list' => ['値リスト'],
      'multiple' => true, // 複数選択可能な場合:true,
      'autocomplete' => 'autocompleteの種類',
      'placeholder' => 'placeholderの値',
      'minLength' => 最小文字数,
      'maxLength' => 最大文字数,
      'pattern' => '正規表現',
      'accept' => 'ファイルアップロードの種別',
    ]
    */
    'categ1' => [
      'label' => '土地活用について',
      'type' => 'checkbox',
      'list' => [
        '土地活用について',
      ],
      'boolean' => TRUE,
      'single' => TRUE,
    ],
    'categ2' => [
      'label' => 'アパート建築について',
      'type' => 'checkbox',
      'list' => [
        'アパート建築について',
      ],
      'boolean' => TRUE,
      'single' => TRUE,
    ],
    'categ8' => [
      'label' => 'リフォームについて',
      'type' => 'checkbox',
      'list' => [
        'リフォームについて',
      ],
      'boolean' => TRUE,
      'single' => TRUE,
    ],
    'categ3' => [
      'label' => 'サブリース・賃貸管理について',
      'type' => 'checkbox',
      'list' => [
        'サブリース・賃貸管理について',
      ],
      'boolean' => TRUE,
      'single' => TRUE,
    ],
    'categ4' => [
      'label' => 'アパート建築の資料請求',
      'type' => 'checkbox',
      'list' => [
        'アパート建築の資料請求',
      ],
      'boolean' => TRUE,
      'single' => TRUE,
    ],
    'categ7' => [
      'label' => '収益物件について',
      'type' => 'checkbox',
      'list' => [
        '収益物件について',
      ],
      'boolean' => TRUE,
      'single' => TRUE,
    ],
    'categ5' => [
      'label' => '土地購入について',
      'type' => 'checkbox',
      'list' => [
        '土地購入について',
      ],
      'boolean' => TRUE,
      'single' => TRUE,
    ],
    'categ6' => [
      'label' => '内覧会・個別物件見学会について',
      'type' => 'checkbox',
      'list' => [
        '内覧会・個別物件見学会について',
      ],
      'boolean' => TRUE,
      'single' => TRUE,
    ],
    'categ9' => [
      'label' => '賃貸住宅修繕共済について',
      'type' => 'checkbox',
      'list' => [
        '賃貸住宅修繕共済について',
      ],
      'boolean' => TRUE,
      'single' => TRUE,
    ],
    'name' => [
      'label' => 'お名前',
      'type' => 'text',
      'required' => true,
      'autocomplete' => 'name',
    ],
    'kana' => [
      'label' => 'お名前（全角カナ）',
      'type' => 'text',
      'required' => true,
      'pattern' => '/^[ァ-ヴー 　]+$/u',
    ],
    'zip' => [
      'label' => '郵便番号',
      'type' => 'text',
      'required' => true,
      'autocomplete' => 'postal-code',
      'pattern' => '/^[0-9]{3}-[0-9]{4}$/',
      'class' => 'p-postal-code',
    ],
    'address' => [
      'label' => 'ご住所',
      'type' => 'text',
      'autocomplete' => 'address',
      'maxlength' => 255,
      'class' => 'p-region p-locality p-street-address p-extended-address',
    ],
    'tel' => [
      'label' => 'お電話番号',
      'type' => 'tel',
      'required' => true,
      'minLength' => 10,
      'maxLength' => 20,
      'pattern' => '/^[+]?[0-9]+(-?[0-9]+)*$/',
      'autocomplete' => 'tel',
    ],
    'email' => [
      'label' => 'メールアドレス',
      'type' => 'email',
      'required' => true,
      'minLength' => 6,
      'maxLength' => 200,
      'pattern' => '/^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:.[a-zA-Z0-9-]+)*$/',
      'autocomplete' => 'email',
    ],
    'confirm_email' => [
      'label' => 'メールアドレス【確認用】',
      'type' => 'email',
      'required' => true,
      'minLength' => 6,
      'maxLength' => 200,
      'pattern' => '/^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:.[a-zA-Z0-9-]+)*$/',
      'autocomplete' => 'email',
    ],
    'examination' => [
      'label' => '建築をご検討中の地域',
      'type' => 'text',
    ],
    'message' => [
      'label' => 'お問い合せ内容',
      'type' => 'textarea',
      'required' => true,
      'maxLength' => 250,
    ],
    'enquete' => [
      'label' => 'アンケートにご協力お願いいたします',
      'type' => 'radio',
      'list' => [
        'Google検索',
        'Yahoo!検索',
        '折込チラシ',
        'ＤＭ',
        '書籍',
        '知人の紹介',
      ],
      'replace' => [
        'Google検索' => '1',
        'Yahoo!検索' => '2',
        '折込チラシ' => '3',
        'ＤＭ' => '4',
        '書籍' => '5',
        '知人の紹介' => '6',
      ],
    ],
    'agreement' => [
      'label' => '同意する',
      'type' => 'checkbox',
      'required' => true,
    ],
  ],

  // 入力項目のグループ化
  'collection' => [
    'categories' => [
      'categ1',
      'categ2',
      'categ7',
      'categ3',
      'categ4',
      'categ8',
      'categ5',
      'categ6',
      'categ9',
    ],
  ],

  // エラーメッセージ
  'error_messages' => [
    'required' => '%sを入力してください。',
    'minLength' => '%sは%d文字以上で入力してください。',
    'maxLength' => '%sは%d文字以下で入力してください。',
    'pattern' => '%sを正しい形式で入力してください。',
    'confirm_email' => '%sを正しく入力してください。',
  ],

  // セッションの設定
  'session' => [
    // 有効期限（秒）
    'expires' => 60 * 60, // 1時間

    // セッショントークン生成時の追加文字列（sha256など、任意のユニークな文字列）
    'token_prefix' => '648e3890e1f7e9190e3007830f627949ab37dfb947746aa6372bfbf9509e8562',
  ],
];
