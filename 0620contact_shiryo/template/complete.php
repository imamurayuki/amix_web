<?php
require_once(__DIR__ . '/vars.php');
?>
<!DOCTYPE html>
<html>
	
<head>
<?php include(__DIR__ . '/parts/head.php'); ?>	
	
<!-- Event snippet for 01_資料請求（オーナー用） conversion page -->
<script>
gtag('event', 'conversion', {'send_to': 'AW-1048676716/E9tjCKzc0AIQ7JKG9AM'});
</script>	
	
</head>
	
<body id="top" class="contact contact2">

<?php include(__DIR__ . '/parts/header.php'); ?>

<div id="mainArea">
  <div>
    <h1>お問い合わせを受け付けました</h1>
  </div>
</div>

<!--wrapperここから-->
<div id="wrapper">
  <div class="wrapInner">
    <div class="contactArea clearfix">
      <?php include(__DIR__ . '/parts/topicPath.php'); ?>
    </div>

    <!--contentsここから-->
    <div id="contentsContactThanks">
      <p>お問い合わせ・資料請求いただき、ありがとうございました。<br />おって、担当者よりご連絡いたします。<br />
      ご記入されたメールアドレス宛に自動返信メールが届かない場合は、正常に送信されなかった可能性がございます。<br />お手数ですが、お時間がたってから再度ご送信いただくか、お電話にてお問い合わせください。</p>
    </div>
    <!--contentsここまで-->

    <?php
      $topicPath_bottom = true;
      include(__DIR__ . '/parts/topicPath.php');
    ?>
  </div>
</div>
<!--wrapperここまで-->

<?php include(__DIR__ . '/parts/footer.php'); ?>

</body>
</html>