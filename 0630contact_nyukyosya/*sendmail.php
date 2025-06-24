<?php
$admin_mail = 'visitor-center@amix.co.jp';

if (isset($_POST) && !empty($_POST)) {
    header('Content-Type: text/html;charset=UTF-8');
    header('Content_Language: ja');
    mb_language("uni");
	mb_internal_encoding("UTF-8");

	$categ = htmlspecialchars($_POST['categ'], ENT_QUOTES, 'utf-8');
	$name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'utf-8');
	$kana = htmlspecialchars($_POST['kana'], ENT_QUOTES, 'utf-8');
	$apt = htmlspecialchars($_POST['apt'], ENT_QUOTES, 'utf-8');
	$number = htmlspecialchars($_POST['number'], ENT_QUOTES, 'utf-8');
	$tel = htmlspecialchars($_POST['tel'], ENT_QUOTES, 'utf-8');
	$email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'utf-8');
	$confirm_email = htmlspecialchars($_POST['confirm_email'], ENT_QUOTES, 'utf-8');
	$message = htmlspecialchars($_POST['message'], ENT_QUOTES, 'utf-8');

	$header = "From: 株式会社アミックス <$admin_mail>";

	$body  = 'お問い合わせいただき、ありがとうございました。' . PHP_EOL;
	$body .= 'のちほど、弊社担当者よりご連絡させていただきます。' . PHP_EOL;
	$body .= 'なお、3営業日を過ぎても連絡がない場合、' . PHP_EOL;
	$body .= '大変お手数ですが、再度フォームよりご送信いただくか、' . PHP_EOL;
	$body .= 'お電話にてお問い合わせいただきますようお願い申し上げます。' . PHP_EOL;
	$body .= PHP_EOL;
	$body .= 'TEL:03-3838－3744（お客様センター／9:00-18:00）' . PHP_EOL;
	$body .= '＊冬期休業期間除く' . PHP_EOL;
	$body .= '（営業時間外の緊急時はTEL:03-6453-7699へご連絡ください）' . PHP_EOL;
	$body .= PHP_EOL;
	$body .= PHP_EOL;
	$body .= '＊このメールは送信専用です。こちらのメールに返信されないようお願いいたします。' . PHP_EOL;
	$body .= PHP_EOL;
	$body .= '＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋' . PHP_EOL;
	$body .= '株式会社アミックス' . PHP_EOL;
	$body .= 'http://www.amix.co.jp/' . PHP_EOL;
	$body .= '＋＋＋＋＋＋＋＋＋＋＋＋＋＋＋' . PHP_EOL;

	mb_send_mail($email, '【自動返信メール】お問い合わせを受け付けました', $body, $header);

	$header = 'From: ' . $email;

	$body  = 'アミックスウェブサイト お問い合わせフォームより' . PHP_EOL;
	$body .= '下記の内容でお問い合わせがありました。' . PHP_EOL;
	$body .= PHP_EOL;
	$body .= '■カテゴリー' . PHP_EOL;
	$body .= $categ . PHP_EOL;
	$body .= '■お名前 '. PHP_EOL;
	$body .= $name . PHP_EOL;
	$body .= '■お名前（全角カナ）' . PHP_EOL;
	$body .= $kana . PHP_EOL;
	$body .= '■物件名 '. PHP_EOL;
	$body .= $apt . PHP_EOL;
	$body .= '■号室 '. PHP_EOL;
	$body .= $number . PHP_EOL;
	$body .= '■電話番号 '. PHP_EOL;
	$body .= $tel . PHP_EOL;
	$body .= '■メールアドレス' . PHP_EOL;
	$body .= $email . PHP_EOL;
	$body .= '■お問い合わせ内容 '. PHP_EOL;
	$body .= $message . PHP_EOL;
	$body .= PHP_EOL;
	$body .= PHP_EOL;
	$body .= '====================================================' . PHP_EOL;
	$body .= 'ホスト：' . $_SERVER["REMOTE_ADDR"] . PHP_EOL;

	$mailto = 'visitor-center@amix.co.jp';
	if ($categ == '契約の更新について' || $categ == '家賃について') {
		$mailto = 'update@amix.co.jp';
	} else if ($categ == '住替えについて') {
		$mailto = 'boshuu@amix.co.jp';
	}

	mb_send_mail($mailto, 'ウェブサイトから、お問い合わせがありました', $body, $header);
	header("Location: ./complete.php");
	exit;
}
