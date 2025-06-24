<?php

// テンプレートディレクトリ
$template_dir = __DIR__ . '/../template/';

$config = [
  'debug' => true,

  // 簡易CSRFトークンのチェックを行うか（連続投稿の防止などに使用しますが、ブラウザの戻るボタンで入力画面に戻ることや、更新ボタンによる再投稿ができなくなります）
  'check_token' => true,

  // テンプレートディレクトリ
  'template_dir' => $template_dir,

  // CSVファイル
  'csv' => __DIR__ . '/../file/data.csv',

  // メール設定
  'mail' => [
    // 送信元として表示されるメールアドレス
    'from' => 'noreply@amix.co.jp',

    // 管理者宛
    'admin' => [
      // toのメールアドレスのドメインが設置サーバーと同じドメインになっている場合、sendmailの調整が必要な場合あり
      // https://qiita.com/yukihirog/items/eeaae1e0a0b61b3110bd
      'to' => 'amix0008@amix.co.jp',
      'subject' => '新卒・中途採用エントリーフォーム',
      'template' => $template_dir . '/mail/admin.php',
    ],

    // ユーザー宛
    'user' => [
      'subject' => '株式会社アミックス 新卒・中途採用エントリーフォーム',
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
    'category' => [
      'label' => 'カテゴリ',
      'type' => 'radio',
      'required' => true,
      'list' => [
        '新卒採用',
        '中途採用',
      ]
    ],
    'job' => [
      'label' => '希望職種',
      'type' => 'checkbox',
      'multiple' => true,
      'list' => [
        '営業職',
        '現場職',
        '事務職',
      ]
    ],
    'name' => [
      'label' => 'お名前',
      'type' => 'text',
      'required' => true,
      'autocomplete' => 'name',
      'placeholder' => '山田 太郎',
    ],
    'kana' => [
      'label' => 'ふりがな',
      'type' => 'text',
      'required' => true,
      'placeholder' => 'やまだ たろう',
    ],
    'tel' => [
      'label' => '電話番号',
      'type' => 'tel',
      'required' => true,
      'minLength' => 10,
      'maxLength' => 20,
      'pattern' => '/^[+]?[0-9]+(-?[0-9]+)*$/',
      'autocomplete' => 'tel',
      'placeholder' => '03-1234-5678',
    ],
    'email' => [
      'label' => 'メールアドレス',
      'type' => 'email',
      'required' => true,
      'minLength' => 6,
      'maxLength' => 200,
      'pattern' => '/^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:.[a-zA-Z0-9-]+)*$/',
      'autocomplete' => 'email',
      'placeholder' => 'info@amix.co.jp',
    ],
    'birth_year' => [
      'label' => '年',
      'type' => 'select',
      // 暫定で16歳から65歳
      'list' => range(getdate()['year'] - 16, getdate()['year'] - 65, -1),
      'autocomplete' => 'bday-year',
    ],
    'birth_month' => [
      'label' => '月',
      'type' => 'select',
      'list' => range(1, 12),
      'autocomplete' => 'bday-month',
    ],
    'birth_date' => [
      'label' => '日',
      'type' => 'select',
      'list' => range(1, 31),
      'autocomplete' => 'bday-day',
    ],
    'zip' => [
      'label' => '郵便番号',
      'type' => 'text',
      'placeholder' => '102-0073',
      'autocomplete' => 'postal-code',
    ],
    'prefecture' => [
      'label' => '都道府県',
      'type' => 'select',
      'list' => [
        '北海道', '青森県', '岩手県', '宮城県', '秋田県', '山形県', '福島県', '茨城県', '栃木県', '群馬県', '埼玉県', '千葉県', '東京都', '神奈川県', '新潟県', '富山県', '石川県', '福井県', '山梨県', '長野県', '岐阜県', '静岡県', '愛知県', '三重県', '滋賀県', '京都府', '大阪府', '兵庫県', '奈良県', '和歌山県', '鳥取県', '島根県', '岡山県', '広島県', '山口県', '徳島県', '香川県', '愛媛県', '高知県', '福岡県', '佐賀県', '長崎県', '熊本県', '大分県', '宮崎県', '鹿児島県', '沖縄県',
      ],
      'autocomplete' => 'address-level1',
    ],
    'streetaddress' => [
      'label' => '市区町村番地',
      'type' => 'text',
      'placeholder' => '江戸川区網町1-1-1',
      'autocomplete' => 'address-level2',
    ],
    'building' => [
      'label' => 'マンション／ビル名',
      'type' => 'text',
    ],
    'document1' => [
      'label' => '応募書類',
      'type' => 'file',
      'required' => true,
      'accept' => 'application/pdf',
    ],
    'document2' => [
      'label' => '応募書類',
      'type' => 'file',
      'accept' => 'application/pdf',
    ],
    'document3' => [
      'label' => '応募書類',
      'type' => 'file',
      'accept' => 'application/pdf',
    ],
    'note' => [
      'label' => '備考',
      'type' => 'textarea',
    ],
    'agreement' => [
      'label' => '個人情報保護方針に同意する',
      'type' => 'checkbox',
      'required' => true,
    ],
    'token' => [
      'label' => 'トークン',
      'type' => 'hidden',
      'required' => true,
    ],
  ],

  // エラーメッセージ
  'error_messages' => [
    'required' => '%sを入力してください。',
    'minLength' => '%sは%d文字以上で入力してください。',
    'maxLength' => '%sは%d文字以下で入力してください。',
    'pattern' => '%sを正しい形式で入力してください。',
  ],

  // セッションの設定
  'session' => [
    // 有効期限（秒）
    'expires' => 60 * 60, // 1時間

    // セッショントークン生成時の追加文字列（sha256など、任意のユニークな文字列）
    'token_prefix' => '648e3890e1f7e9190e3007830f627949ab37dfb947746aa6372bfbf9509e8562',
  ],
];
