<?php

require 'core/ClassLoader.php';

$loader = new ClassLoader();

$loader->registerDir(dirname(__FILE__).'/core');
$loader->registerDir(dirname(__FILE__).'/models');
$loader->register();

ini_set('date.timezone', 'Asia/Tokyo');


//-------------------------------------------------
// 設定値(定数、プルダウン値等)
//-------------------------------------------------
// サイトトップページ
define('SITE_URL', 'https://www.amix.co.jp');
// アプリケーションルート
define('APP_URL', 'https://www.amix.co.jp/0292kentikucyu/');
// 一覧表示列数(4列ずつ表示する)
define('LIST_ROW_NUMBER', 4);
// 画像アップロードディレクトリ
define('IMAGE_UPLOAD_DIR', dirname(dirname(__FILE__)) . '/img/uploads');
define('RESIZE_IMAGE_SMALL', '135x122');
define('RESIZE_IMAGE_MIDDLE', '240x220');
define('RESIZE_IMAGE_SMALL_NO_IMAGE', 'no_image_s.gif');
define('RESIZE_IMAGE_MIDDLE_NO_IMAGE', 'no-image_small.jpg');
// 管理画面物件一覧ページャカウント
define('PAGER_COUNT', 10);

// 都道府県:プルダウンオプション値
Configure::write('prefs', array(
    '1'  => '北海道',
    '2'  => '青森県',
    '3'  => '岩手県',
    '4'  => '宮城県',
    '5'  => '秋田県',
    '6'  => '山形県',
    '7'  => '福島県',
    '8'  => '茨城県',
    '9'  => '栃木県',
    '10' => '群馬県',
    '11' => '埼玉県',
    '12' => '千葉県',
    '13' => '東京都',
    '14' => '神奈川県',
    '15' => '新潟県',
    '16' => '富山県',
    '17' => '石川県',
    '18' => '福井県',
    '19' => '山梨県',
    '20' => '長野県',
    '21' => '岐阜県',
    '22' => '静岡県',
    '23' => '愛知県',
    '24' => '三重県',
    '25' => '滋賀県',
    '26' => '京都府',
    '27' => '大阪府',
    '28' => '兵庫県',
    '29' => '奈良県',
    '30' => '和歌山県',
    '31' => '鳥取県',
    '32' => '島根県',
    '33' => '岡山県',
    '34' => '広島県',
    '35' => '山口県',
    '36' => '徳島県',
    '37' => '香川県',
    '38' => '愛媛県',
    '39' => '高知県',
    '40' => '福岡県',
    '41' => '佐賀県',
    '42' => '長崎県',
    '43' => '熊本県',
    '44' => '大分県',
    '45' => '宮崎県',
    '46' => '鹿児島県',
    '47' => '沖縄県'
));
// タイプ：プルダウンオプション値
Configure::write('type', array(
    '1' => 'カラーアズHタイプ',
    '2' => 'カラーアズSタイプ',
    '3' => 'クラシックタイプ',
    '4' => 'その他',
));
// 構造：プルダウンオプション値
Configure::write('structure', array(
    '1' => '在来工法(木造)',
    '2' => '2x4工法(木造)',
    '3' => '鉄骨造',
    '4' => '鉄筋コンクリート造',
    '5' => 'その他',
));
// 用途：プルダウンオプション値
Configure::write('purpose', array(
    '1' => '共同住宅',
    '2' => '店舗・事務所',
    '3' => '自宅',
    '4' => 'その他',
));
