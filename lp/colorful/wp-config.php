<?php
/**
 * WordPress の基本設定
 *
 * このファイルは、インストール時に wp-config.php 作成ウィザードが利用します。
 * ウィザードを介さずにこのファイルを "wp-config.php" という名前でコピーして
 * 直接編集して値を入力してもかまいません。
 *
 * このファイルは、以下の設定を含みます。
 *
 * * MySQL 設定
 * * 秘密鍵
 * * データベーステーブル接頭辞
 * * ABSPATH
 *
 * @link http://wpdocs.sourceforge.jp/wp-config.php_%E3%81%AE%E7%B7%A8%E9%9B%86
 *
 * @package WordPress
 */

// 注意: 
// Windows の "メモ帳" でこのファイルを編集しないでください !
// 問題なく使えるテキストエディタ
// (http://wpdocs.sourceforge.jp/Codex:%E8%AB%87%E8%A9%B1%E5%AE%A4 参照)
// を使用し、必ず UTF-8 の BOM なし (UTF-8N) で保存してください。

// ** MySQL 設定 - この情報はホスティング先から入手してください。 ** //
/** WordPress のためのデータベース名 */
define('DB_NAME', 'blogwpd745');

/** MySQL データベースのユーザー名 */
define('DB_USER', 'blogadm906');

/** MySQL データベースのパスワード */
define('DB_PASSWORD', 'amix19092001');

/** MySQL のホスト名 */
define('DB_HOST', 'localhost');

/** データベースのテーブルを作成する際のデータベースの文字セット */
define('DB_CHARSET', 'utf8');

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define('DB_COLLATE', '');

/**#@+
 * 認証用ユニークキー
 *
 * それぞれを異なるユニーク (一意) な文字列に変更してください。
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org の秘密鍵サービス} で自動生成することもできます。
 * 後でいつでも変更して、既存のすべての cookie を無効にできます。これにより、すべてのユーザーを強制的に再ログインさせることになります。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '>eDW$o>A6&VbShEipE^}3C.i^}xeTxYOn:,%K-Z|Qv|)kv%ngJAT^A!!MXN2:Q,-');
define('SECURE_AUTH_KEY',  'QcN+A/-F,9{lzkt3Zo*>+I3!g};C22d4Q|?Ivtm-bRU-nq`-A.$LK8Zvy5gogGZU');
define('LOGGED_IN_KEY',    'xd6|%AC(s,}8dU<=zSD:_*_j+k|D:/8)L9#h}PhwJA#OOdQua82_K3^[PSITWSB6');
define('NONCE_KEY',        ';o*0=Y-*I#t,-eB<+67qCQql R4u~H$`,Q<*[-ciloHN(z<xet3q^8Dt|#<S!~ko');
define('AUTH_SALT',        'ZHi)Gm^Ans5{wF)v!-5#-Dxu`!~z!bS7<|QpZ;Q.B|]a._ rT_-w(mU.zK9Oe4i<');
define('SECURE_AUTH_SALT', 'h`|0HHKfYUgxOrBqMM|4%l}PVD/93eGb@b]|5zUw d5]YRy8O}*fhr0;!r)GYK30');
define('LOGGED_IN_SALT',   '=<KRw,jJWw3BvSz@EPRvw@!bDjkAWm]IKbq+U0>_rbpuJoBq0I-i5N|0._zZC-MM');
define('NONCE_SALT',       '=p88@2SG-tt<GVwNw.yEm^CB|x(<@PC9S7_nFzU6AD&}(<@/VP>Km-Xn--lu9y_5');

/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
$table_prefix  = 'dwp619_lpcolorful_';

/**
 * 開発者へ: WordPress デバッグモード
 *
 * この値を true にすると、開発中に注意 (notice) を表示します。
 * テーマおよびプラグインの開発者には、その開発環境においてこの WP_DEBUG を使用することを強く推奨します。
 *
 * その他のデバッグに利用できる定数については Codex をご覧ください。
 *
 * @link http://wpdocs.osdn.jp/WordPress%E3%81%A7%E3%81%AE%E3%83%87%E3%83%90%E3%83%83%E3%82%B0
 */
define('WP_DEBUG', false);

/* 編集が必要なのはここまでです ! WordPress でブログをお楽しみください。 */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
