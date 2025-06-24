<?php

define('ADMIN_MAIL', 'owner-info@amix.co.jp');

if (isset($_POST) && !empty($_POST)) {

	header('Content-Type: text/html; charset=UTF-8');
	header('Content_Language: ja');
	mb_language("uni");
	mb_internal_encoding("UTF-8");

	$name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'utf-8');
	$kana = htmlspecialchars($_POST['kana'], ENT_QUOTES, 'utf-8');
	$sex = htmlspecialchars($_POST['RadioGroup1'], ENT_QUOTES, 'utf-8');
	$age = htmlspecialchars($_POST['textfield'], ENT_QUOTES, 'utf-8');
	$job = htmlspecialchars($_POST['RadioGroup2'], ENT_QUOTES, 'utf-8');
	$salary = htmlspecialchars($_POST['textfield2'], ENT_QUOTES, 'utf-8');
	$financial = htmlspecialchars($_POST['textfield3'], ENT_QUOTES, 'utf-8');
	$other_financial = htmlspecialchars($_POST['textfield4'], ENT_QUOTES, 'utf-8');
	$address = htmlspecialchars($_POST['address'], ENT_QUOTES, 'utf-8');
	$tel = htmlspecialchars($_POST['tel'], ENT_QUOTES, 'utf-8');
	$email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'utf-8');
	$message = htmlspecialchars($_POST['message'], ENT_QUOTES, 'utf-8');

	$header = 'From: 株式会社アミックス <owner-info@amix.co.jp>';

	$body  = 'この度は個別無料相談をお申込みいただき、ありがとうございました。' . PHP_EOL;
	$body .= 'のちほど、弊社担当者よりご連絡させていただきます。' . PHP_EOL;
	$body .= 'なお、3営業日を過ぎても連絡がない場合、大変お手数ですが、' . PHP_EOL;
	$body .= '再度フォームよりご送信いただくか、お電話にてお問い合わせ' . PHP_EOL;
	$body .= 'いただきますようお願い申し上げます。' . PHP_EOL;
	$body .= PHP_EOL;
	$body .= PHP_EOL;
	$body .= '＊このメールは送信専用です。こちらのメールに返信されないよう' . PHP_EOL;
	$body .= 'お願いいたします。' . PHP_EOL;
	$body .= PHP_EOL;
	$body .= '＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋' . PHP_EOL;
	$body .= '株式会社アミックス　本社営業部' . PHP_EOL;
	$body .= '〒104-0031 東京都中央区京橋1-10-7 KPP八重洲ビル' . PHP_EOL;
	$body .= 'http://www.amix.co.jp/' . PHP_EOL;
	$body .= 'TEL:0120-441-432（フリーダイアル）' . PHP_EOL;
	$body .= '＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋';

	mb_send_mail($email, '【自動返信メール】個別無料相談のお申込みを受け付けました', $body, $header);

	$header = 'From: ' . $email;
	$body  = 'アミックスウェブサイト 個別無料相談のお申込みフォームより' . PHP_EOL;
	$body .= '下記の内容でお問い合わせがありました。' . PHP_EOL;
	$body .= PHP_EOL;
	$body .= '■お名前' . PHP_EOL;
	$body .= $name . PHP_EOL;
	$body .= PHP_EOL;
	$body .= '■お名前（全角カナ）' . PHP_EOL;
	$body .= $kana . PHP_EOL;
	$body .= PHP_EOL;
	$body .= '■性別' . PHP_EOL;
	$body .= $sex . PHP_EOL;
	$body .= PHP_EOL;
	$body .= '■ご年齢' . PHP_EOL;
	if (!empty($age)) {
		$body .= $age . '歳' . PHP_EOL;
	}
	$body .= PHP_EOL;
	$body .= '■ご職業' . PHP_EOL;
	$body .= $job . PHP_EOL;
	$body .= PHP_EOL;
	$body .= '■ご年収' . PHP_EOL;
	if (!empty($salary)) {
		$body .= '約' . $salary . '万円' . PHP_EOL;
	}
	$body .= PHP_EOL;
	$body .= '■自己資産' . PHP_EOL;
	if (!empty($financial)) {
		$body .= '約'. $financial . '万円' . PHP_EOL;
	}
	$body .= PHP_EOL;
	$body .= '■その他投資資金' . PHP_EOL;
	if (!empty($other_financial)) {
		$body .= '約' . $other_financial . '万円' . PHP_EOL;
	}
	$body .= PHP_EOL;
	$body .= '■ご住所' . PHP_EOL;
	$body .= $address . PHP_EOL;
	$body .= PHP_EOL;
	$body .= '■お電話番号' . PHP_EOL;
	$body .= $tel . PHP_EOL;
	$body .= PHP_EOL;
	$body .= '■メールアドレス' . PHP_EOL;
	$body .= $email . PHP_EOL;
	$body .= PHP_EOL;
	$body .= '■お問い合せ内容' . PHP_EOL;
	$body .= $message . PHP_EOL;
	$body .= PHP_EOL;
	$body .= PHP_EOL;
	$body .= '====================================================' . PHP_EOL;
	$body .= 'ホスト：' . $_SERVER["REMOTE_ADDR"];

	mb_send_mail(ADMIN_MAIL, 'ウェブサイトから、お問い合わせがありました', $body, $header);

	header("Location: ./a015form_complete.php");
	exit;
}
