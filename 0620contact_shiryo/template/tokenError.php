<?php
require_once(__DIR__ . '/vars.php');
?>
<!DOCTYPE html>
<html>
<head>
<?php include(__DIR__ . '/parts/head.php'); ?>
</head>
<body id="top" class="contact contact2">

<?php include(__DIR__ . '/parts/header.php'); ?>

<div id="mainArea">
  <div>
    <h1>送信に失敗しました</h1>
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
      <p>入力時間の期限切れなどの理由により、フォームの送信に失敗しました。お手数ですが入力画面から再度送信をお願いします。</p>

      <p><a class="recruitForm__button" href="./">入力画面に戻る</a></p>
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
