<?php
require_once(__DIR__ . '/vars.php');
?>
<!DOCTYPE html>
<html>
<head>
<?php include(__DIR__ . '/parts/head.php'); ?>
</head>
<body id="top" class="company">

<?php include(__DIR__ . '/parts/header.php'); ?>

<!--wrapperここから-->
<div id="wrapper">
  <div class="wrapInner">
    <div class="contactArea clearfix">
      <?php include(__DIR__ . '/parts/topicPath.php'); ?>
    </div>

    <!--contentsここから-->
    <div id="contents">
      <div id="mainContents_1col">
        <div class="recruitForm">
          <h1 class="recruitForm__title">メールの送信に失敗しました</h1>

          <p class="recruitForm__lead">ご記入されたメールアドレス宛に自動返信メールが届かない場合は、正常に送信されていない可能性がございます。お手数ですが、お時間がたってから再度送信いただくか、お電話にてお問い合わせください。</p>

          <ul class="recruitForm__actions">
            <li><a class="recruitForm__button" href="./">入力画面に戻る</a></li>
          </ul>
        <!-- /recruitForm --></div>
      </div>
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