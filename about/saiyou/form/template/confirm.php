<?php
require_once(__DIR__ . '/vars.php');
require_once(__DIR__ . '/function/echo_confirm.php');
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
          <form action="./" method="post" enctype="multipart/form-data">

            <h1 class="recruitForm__title">確認画面</h1>

            <p class="recruitForm__lead">下記の内容でよろしければ、「送信」ボタンを押してください。<br>
            （<span class="formRequired">＊</span>は必須項目になります。）</p>

            <section class="recruitForm__fieldgroup">
              <header class="recruitForm__fieldgroup__header">
                <h2 class="recruitForm__fieldgroup__title">基本情報</h2>
              </header>
              <div class="recruitForm__fieldgroup__body">
                <?php
                  foreach (
                    [
                      'category',
                      'job',
                      'name',
                      'kana',
                      'tel',
                      'email',
                    ] as $name
                  ) {
                    $interface = $data['interfaces'][$name];
                    $is_required = isset($interface['required']) && $interface['required'];
                ?>
                <dl>
                  <dt><?= htmlspecialchars($interface['label']) ?><?= $is_required ? '<span class="formRequired">＊</span>' : '' ?></dt>
                  <dd>
                    <?php echo_confirm($data, $name); ?>
                  </dd>
                </dl>
                <?php
                  }
                ?>

                <dl>
                  <dt><label for="birth_year">生年月日</label></dt>
                  <dd>
                    <?php echo_confirm($data, 'birth_year', '年'); ?>
                    <?php echo_confirm($data, 'birth_month', '月'); ?>
                    <?php echo_confirm($data, 'birth_date', '日'); ?>
                  </dd>
                </dl>

                <dl>
                  <dt>ご住所</dt>
                  <dd>
                    <?php
                      foreach (
                        [
                          'zip',
                          'prefecture',
                          'streetaddress',
                          'building',
                        ] as $name
                      ) {
                        $interface = $data['interfaces'][$name];
                        $is_required = isset($interface['required']) && $interface['required'];
                    ?>
                    <dl>
                      <dt><?= htmlspecialchars($interface['label']) ?><?= $is_required ? '<span class="formRequired">＊</span>' : '' ?></dt>
                      <dd>
                        <?php echo_confirm($data, $name); ?>
                      </dd>
                    </dl>
                    <?php
                      }
                    ?>
                  </dd>
                </dl>
              <!-- /recruitForm__fieldgroup__body --></div>
            <!-- /recruitForm__fieldgroup --></section>

            <section class="recruitForm__fieldgroup">
              <header class="recruitForm__fieldgroup__header">
                <h2 class="recruitForm__fieldgroup__title">応募書類<span class="formRequired">＊</span></h2>
              </header>
              <div class="recruitForm__fieldgroup__body">
                <ul class="recruitForm__fileList">
                  <?php for ($i = 1; $i <= 3; $i++) { ?>
                    <?php
                      if (is_array($data['params']['document' . $i]) && $data['params']['document' . $i]['tempFileName']) {
                    ?>
                    <li>
                      <?php echo_confirm($data, 'document' . $i); ?>
                    </li>
                    <?php } ?>
                  <?php } ?>
                </ul>
              <!-- /recruitForm__fieldgroup__body --></div>
            <!-- /recruitForm__fieldgroup --></section>

            <section class="recruitForm__fieldgroup">
              <header class="recruitForm__fieldgroup__header">
                <h2 class="recruitForm__fieldgroup__title">備 考</h2>
              </header>
              <div class="recruitForm__fieldgroup__body">
                <?php echo_confirm($data, 'note'); ?>
              <!-- /recruitForm__fieldgroup__body --></div>
            <!-- /recruitForm__fieldgroup --></section>

            <input type="hidden" name="agreement" value="<?= htmlspecialchars($data['params']['agreement']) ?>">
            <input type="hidden" name="token" value="<?= htmlspecialchars($data['token']); ?>">

            <ul class="recruitForm__actions">
              <li><button class="recruitForm__button --submit" type="submit" name="send" value="1">送 信</button></li>
              <li><button class="recruitForm__button --cancel" type="submit" name="cancel" value="1">戻 る</button></li>
            </ul>
          </form>
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