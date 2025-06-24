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
define('AUTH_KEY',         'l&vLol{w4NTb;nywH gWC#<vwl~+:[JX&rJA|ERracjUE=8Tn)UG,&iv@WQR 7]J');
define('SECURE_AUTH_KEY',  'owbUJWa<1AC.FE]AM.%f,S|RBU%FWp?/1Uu`7-C_NU^4fv(sRa!@#kw$!E}e-/xJ');
define('LOGGED_IN_KEY',    '<(Q|34/: lIfy7.pM|^GFi=aJ6$h`RQ$N+Y?4K*ZQ-|AGB~~X-v4amykrL&%([NM');
define('NONCE_KEY',        '&[c*#B$Jy[5>/xji]NedG>]UW6!~Wo*Q_G4Xe91+#mxk^zaFiSK6b9ux+r;r6zj[');
define('AUTH_SALT',        '&G9A3$+#[deW+#n;{Jao9a*-Uw=G>2.@1^Qkv>_EiC+`mKnzo}cJ*+|+DkT-y!9M');
define('SECURE_AUTH_SALT', 'V3VW7/1D;AKgH?$u%:18r]wR8IoJ=e&_ID_r;D62gV7nq^]6TKs)CQZ3Vb>b9^%S');
define('LOGGED_IN_SALT',   'HAz!qX0JR`/SHYxzwkr79iD035.|P#J_1+w<uM(zPLQ>gjGVMe/Ahp&);agzp$%4');
define('NONCE_SALT',       'tbck[;t.cC^_pZ8=}lb*xsCN[#9,U9=ylc[d|-q#+bd`hX`tZnpNFwJ>X^m t-Qw');

/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
$table_prefix  = 'blog482_';

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
