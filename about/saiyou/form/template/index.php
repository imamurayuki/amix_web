<?php
require_once(__DIR__ . '/vars.php');
require_once(__DIR__ . '/function/echo_field.php');
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

            <h1 class="recruitForm__title">エントリーフォーム</h1>

            <p class="recruitForm__lead">下記のフォームに必要事項をご記入の上、「確認」ボタンを押してエントリーをお願いいたします。後日、担当者より書類選考結果や今後の面接等についてメールでご連絡いたします。<small>（<span class="formRequired">＊</span>は必須項目になります。）</small></p>

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
                    <?php echo_field($data, $name); ?>
                  </dd>
                </dl>
                <?php
                  }
                ?>

                <dl>
                  <dt><label for="birth_year">生年月日</label></dt>
                  <dd>
                    <?php echo_field($data, 'birth_year', '年'); ?>
                    <?php echo_field($data, 'birth_month', '月'); ?>
                    <?php echo_field($data, 'birth_date', '日'); ?>
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
                        <?php echo_field($data, $name); ?>
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
                <p class="recruitForm__fieldgroup__description">履歴書（新卒）／履歴書および職務経歴書（中途採用者）を添付してください。<small>（pdf形式／1ファイル5MBまで）</small></p>
              </header>
              <div class="recruitForm__fieldgroup__body">
                <ul class="recruitForm__fileList">
                  <?php for ($i = 1; $i <= 3; $i++) { ?>
                    <li>
                      <?php echo_field($data, 'document' . $i); ?>
                    </li>
                  <?php } ?>
                </ul>
              <!-- /recruitForm__fieldgroup__body --></div>
            <!-- /recruitForm__fieldgroup --></section>

            <section class="recruitForm__fieldgroup">
              <header class="recruitForm__fieldgroup__header">
                <h2 class="recruitForm__fieldgroup__title">備 考</h2>
                <p class="recruitForm__fieldgroup__description">ご質問等あればご記入ください。</p>
              </header>
              <div class="recruitForm__fieldgroup__body">
                <?php echo_field($data, 'note'); ?>
              <!-- /recruitForm__fieldgroup__body --></div>
            <!-- /recruitForm__fieldgroup --></section>

            <div class="recruitForm__agreement">
              <p class="recruitForm__agreement__lead">「<a href="<?= $root_path ?>0020kozinzyou.html" target="_blank">個人情報保護方針</a>」をお読みいただき、同意の上確認ボタンを押してください。</p>
              <label class="recruitForm__checkbox"><input type="checkbox" name="agreement" value="1"<?= ($data['params']['agreement'] == '1') ? ' checked' : ''; ?> required><span class="recruitForm__checkbox__text">個人情報保護方針に同意する</span></label>
              <?php if (isset($data['errors']['agreement'])) { ?>
              <p class="recruitForm__error"><?= htmlspecialchars($data['errors']['agreement']) ?></p>
              <?php } ?>
            <!-- /recruitForm__agreement --></div>

            <input type="hidden" name="token" value="<?= htmlspecialchars($data['token']); ?>">
            <?php if (isset($data['errors']['token'])) { ?>
            <p class="recruitForm__error"><?= htmlspecialchars($data['errors']['token']) ?></p>
            <?php } ?>

            <ul class="recruitForm__actions">
              <li><button class="recruitForm__button --submit" type="submit" name="confirm" value="1">確 認</button></li>
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