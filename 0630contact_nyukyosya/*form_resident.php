<?php
$errors = array();
if (isset($_POST) && !empty($_POST)) {
	$categ = htmlspecialchars($_POST['categ'], ENT_QUOTES, 'utf-8');
	$name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'utf-8');
	$kana = htmlspecialchars($_POST['kana'], ENT_QUOTES, 'utf-8');
	$apt = htmlspecialchars($_POST['apt'], ENT_QUOTES, 'utf-8');
	$number = htmlspecialchars($_POST['number'], ENT_QUOTES, 'utf-8');
	$tel = htmlspecialchars($_POST['tel'], ENT_QUOTES, 'utf-8');
	$email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'utf-8');
	$confirm_email = htmlspecialchars($_POST['confirm_email'], ENT_QUOTES, 'utf-8');
	$message = htmlspecialchars($_POST['message'], ENT_QUOTES, 'utf-8');

	//カテゴリー入力チェック
	if (empty($categ)) {
		$errors[] = '<font color="FF0000">カテゴリー</font>を入力して下さい';
	}
	//名前入力チェック
	if (empty($name)) {
		$errors[] = '<font color="FF0000">お名前</font>を入力して下さい';
	}
	//名前(カナ)入力チェック
	if (empty($kana)) {
		$errors[] = '<font color="FF0000">お名前(カナ)</font>を入力して下さい';
	}
	// 物件名
	if (empty($apt)) {
		$errors[] = '<font color="FF0000">物件名</font>を入力して下さい';
	}
	// 号室
	if (empty($number)) {
		$errors[] = '<font color="FF0000">号室</font>を入力して下さい';
	}
	// お電話番号
	if (empty($tel)) {
		$errors[] = '<font color="FF0000">お電話番号</font>を入力して下さい';
	}
	// メールアドレス
	$pattern = '/^[a-z0-9\._-]{3,30}@(?:[a-z0-9][-a-z0-9]*\.)*(?:[a-z0-9][-a-z0-9]{0,62})\.(?:(?:[a-z]{2}\.)?[a-z]{2,4})$/i';
	if (empty($email)) {
		$errors[] = '<font color="FF0000">メールアドレス</font>を入力して下さい';
	} else if (!preg_match($pattern, $email)) {
		$errors[] = '<font color="FF0000">メールアドレス</font>を正しく入力して下さい';
	}
	// メールアドレス確認用
	if (empty($confirm_email)) {
		$errors[] = '<font color="FF0000">メールアドレス確認用</font>を入力して下さい';
	}
	if (!empty($email) && !empty($confirm_email) && ($email != $confirm_email)) {
		$errors[] = '<font color="FF0000">確認用メールアドレス</font>が一致しません';
	}
	// お問い合せ内容
	if (empty($message)) {
		$errors[] = '<font color="FF0000">お問い合せ内容</font>を入力して下さい';
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<!-- Google tag (gtag.js) ディープさん指定/230105今村-->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-1048676716"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', 'AW-1048676716');
</script>

<!-- Google Tag Manager 当社GTM/230105今村-->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MN6HQST');</script>

<meta charset="utf-8">
<title>入居者様のお問い合わせ | 株式会社アミックス</title>
<meta name="robots" content="noindex" />
<meta name="Description" content="自社設計・自社施工、高品質でコストを抑えたアミックスのアパート建築" />
<meta name="Keywords" content="アパート建築,アパート経営,設計施工,高品質,ローコスト,カラーアズ,クラシック,アミックス" />
<link rel="stylesheet" type="text/css" media="" href="../common/css/import2.css" />
<link rel="stylesheet" type="text/css" media="print" href="../common/css/print.css" />
<script type="text/javascript" src="../common/js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="../common/js/common.js"></script>
<script src="../common/js/jquery.heightLine.js"></script>
<link rel="shortcut icon" href="../common/img/amix.gif" type="image/gif">
	
<!-- アナリティクスコードここから（GA4移行前）/230105今村 -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-4239695-1', 'auto');
  ga('send', 'pageview');

</script>
<!-- アナリティクスコードここまで -->
</head>

<body id="top" class="contact">
	
<!-- Google Tag Manager (noscript)/230105今村 -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MN6HQST"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->	
	
	
<script type="text/javascript"> writeHeader(); </script>
<div id="mainArea">
  <div>
    <h1>入居者様のお問い合わせ</h1>
  </div>
</div>

<!--wrapperここから-->
<div id="wrapper">
  <div class="wrapInner">
    <div class="contactArea clearfix">
      <ul class="topicPath">
        <li class="pathStart"><a href="../index.html">ホーム</a></li>
        <li><a href="../0600contact_top.html">お問い合わせ　資料請求</a></li>
        <li class="this"><a href="../0630contact_nyukyosya">入居者様のお問い合わせ</a></li>
      </ul>
    </div>

    <!--contentsここから-->
    <div id="contents">
      <div id="mainContents">
        <p class="mainText10">下記の内容でよろしければ、「送信」ボタンを押してください。<br /><span class="t14">（<span class="formRequired">※</span>は必須項目になります。）</span></p>
        <div id="contactForm">
		<?php if (count($errors) > 0): ?>
			<?php foreach ($errors as $error): ?>
				<?php echo $error; ?><br />
	 		<?php endforeach; ?>
			<p class="contactFormBtn"><input type="button" onclick="javascript:history.back();" value="入力フォームへ戻る" name="submit2" /></p>
		<?php else: ?>
          <form method="post" action="./sendmail.php">
			  <input type="hidden" name="categ" value="<?php echo $categ ?>" />
			  <input type="hidden" name="name" value="<?php echo $name ?>" />
			  <input type="hidden" name="kana" value="<?php echo $kana ?>" />
			  <input type="hidden" name="apt" value="<?php echo $apt ?>" />
			  <input type="hidden" name="number" value="<?php echo $number ?>" />
			  <input type="hidden" name="tel" value="<?php echo $tel ?>" />
			  <input type="hidden" name="email" value="<?php echo $email ?>" />
			  <input type="hidden" name="confirm_email" value="<?php echo $confirm_email ?>" />
			  <input type="hidden" name="message" value="<?php echo $message ?>" />

              <dl class="top">
                <dt>お問い合わせの<br class="PC">カテゴリ<span class="formRequired">※</span></dt>
				<dd><?php echo $categ ?></dd>
              </dl>
              <dl>
                <dt>お名前<span class="formRequired">※</span></dt>
				<dd><?php echo $name ?></dd>
              </dl>
              <dl>
                <dt>お名前（全角カナ）<span class="formRequired">※</span></dt>
				<dd><?php echo $kana ?></dd>
              </dl>
              <dl>
                <dt>物件名<span class="formRequired">※</span></dt>
				<dd><?php echo $apt ?></dd>
              </dl>
              <dl>
                <dt>号室<span class="formRequired">※</span></dt>
				<dd><?php echo $number ?></dd>
              </dl>
              <dl>
                <dt>お電話番号<span class="formRequired">※</span></dt>
				<dd><?php echo $tel ?></dd>
              </dl>
              <dl>
                <dt>メールアドレス<span class="formRequired">※</span></dt>
				<dd><?php echo $email ?></dd>
              </dl>
              <dl class="bottom2">
                <dt>お問い合せ内容<span class="formRequired">※</span></dt>
				<dd><?php echo $message ?></dd>
              </dl>
            <p class="contactFormBtn">
				<input type="submit" value="送 信" name="submit" />
				<input type="button" onclick="javascript:history.back();" value="修正" name="submit2" />
            </p>
          </form>
		  <?php endif; ?>
        </div>
      </div>
      <div id="sideContents">
        <h2><a href="../0600contact_top.html">お問い合わせ　資料請求</a></h2>
        <ul>
          <li class="big"><a href="../0620contact_shiryo">アパート建築他<br>
            お問い合わせ 資料請求</a></li>
        </ul>
        <ul>
          <li class="big this"><a href="../0630contact_nyukyosya">入居者様のお問い合わせ</a></li>
        </ul>
        <ul>
          <li><a href="../0500faq.html#faqBuild">よくあるご質問</a></li>
        </ul>
      </div>
    </div>
    <!--contentsここまで-->

    <ul class="topicPath">
      <li class="pathStart"><a href="../index.html">ホーム</a></li>
      <li><a href="../0600contact_top.html">お問い合わせ　資料請求</a></li>
      <li class="this"><a href="../0630contact_nyukyosya">入居者様のお問い合わせ</a></li>
    </ul>
  </div>
</div>
<!--wrapperここまで-->

<script type="text/javascript"> writeFooter(); </script>
</body>
</html>
