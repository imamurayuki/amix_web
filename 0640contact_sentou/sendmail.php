<?php
$admin_mail = 'kasono@amix.co.jp,r-fujimori@amix.co.jp,e-sakai@amix.co.jp';


if (isset($_POST) && !empty($_POST)) {
    header('Content-Type: text/html; charset=UTF-8');
    header('Content_Language: ja');
    mb_language("uni");
	mb_internal_encoding("UTF-8");

	$name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'utf-8');
	$kana = htmlspecialchars($_POST['kana'], ENT_QUOTES, 'utf-8');
	$zip = htmlspecialchars($_POST['zip'], ENT_QUOTES, 'utf-8');
	$address = htmlspecialchars($_POST['address'], ENT_QUOTES, 'utf-8');
	$tel = htmlspecialchars($_POST['tel'], ENT_QUOTES, 'utf-8');
	$email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'utf-8');
	$examination = htmlspecialchars($_POST['examination'], ENT_QUOTES, 'utf-8');
	$message = htmlspecialchars($_POST['message'], ENT_QUOTES, 'utf-8');
	$enquete = htmlspecialchars($_POST['enquete'], ENT_QUOTES, 'utf-8');
	$enquete_other = htmlspecialchars($_POST['enquete_other'], ENT_QUOTES, 'utf-8');

	$header = "From: 株式会社アミックス <$admin_mail>";

	$body  = 'この度は銭湯サポート倶楽部へお問い合わせいただき、ありがとうございました。' . PHP_EOL;
	$body .= 'のちほど、弊社担当者よりご連絡させていただきます。' . PHP_EOL;
	$body .= 'なお、3営業日を過ぎても連絡がない場合、' . PHP_EOL;
	$body .= '大変お手数ですが、再度フォームよりご送信いただくか、' . PHP_EOL;
	$body .= 'お電話にてお問い合わせいただきますようお願い申し上げます。' . PHP_EOL;
	$body .= PHP_EOL;
	$body .= PHP_EOL;
	$body .= '＊このメールは送信専用です。こちらのメールに返信されないようお願いいたします。' . PHP_EOL;
	$body .= PHP_EOL;
	$body .= '＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋' . PHP_EOL;
	$body .= '株式会社アミックス　資産活用営業部' . PHP_EOL;
	$body .= '〒103-0028 東京都中央区八重洲1-3-7' . PHP_EOL;
	$body .= '八重洲ファーストフィナンシャルビル13階' . PHP_EOL;
	$body .= 'http://www.amix.co.jp/' . PHP_EOL;
	$body .= 'TEL:03-6860-4126' . PHP_EOL;
	$body .= '＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋' . PHP_EOL;

	mb_send_mail($email, '【自動返信メール】銭湯サポート倶楽部お問い合わせを受け付けました', $body, $header);

	$header = 'From: ' . $email;

	$body  = 'アミックスウェブサイト 銭湯サポート倶楽部お問い合わせフォームより' . PHP_EOL;
	$body .= '下記の内容でお問い合わせがありました。' . PHP_EOL;
	$body .= PHP_EOL;
	$body .= '■お名前' . PHP_EOL;
	$body .= $name . PHP_EOL;
	$body .= '■お名前（フリガナ）' . PHP_EOL;
	$body .= $kana . PHP_EOL;
	$body .= '■郵便番号' . PHP_EOL;
	$body .= $zip . PHP_EOL;
	$body .= '■ご住所' . PHP_EOL;
	$body .= $address . PHP_EOL;
	$body .= '■電話番号' . PHP_EOL;
	$body .= $tel . PHP_EOL;
	$body .= '■メールアドレス' . PHP_EOL;
	$body .= $email . PHP_EOL;
	$body .= '■建築をご検討中の地域' . PHP_EOL;
	$body .= $examination . PHP_EOL;
	$body .= '■お問い合わせ内容' . PHP_EOL;
	$body .= $message . PHP_EOL;
	$body .= '■アンケート内容' . PHP_EOL;
	$body .= $enquete . PHP_EOL;
	if (!empty($enquete_other)) {
		$body .= $enquete_other . PHP_EOL;
	}
	$body .= PHP_EOL;
	$body .= PHP_EOL;
	$body .= '====================================================' . PHP_EOL;
	$body .= 'ホスト：' . $_SERVER["REMOTE_ADDR"];

	mb_send_mail($admin_mail, 'ウェブサイトから、お問い合わせがありました', $body, $header);
	header("Location: ./complete.php");
	exit;
}
