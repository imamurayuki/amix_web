<?php
require_once(__DIR__ . '/vars.php');
require_once(__DIR__ . '/function/echo_confirm.php');
?>
<!DOCTYPE html>
<html>
<head>
<?php include(__DIR__ . '/parts/head.php'); ?>
</head>
<body id="top" class="contact contact2">

<?php include(__DIR__ . '/parts/header.php'); ?>

<div id="mainArea" class="line2">
  <div>
    <h1>アパート建築他<br>
      お問い合わせ・資料請求</h1>
  </div>
</div>

<!--wrapperここから-->
<div id="wrapper">
  <div class="wrapInner">
    <div class="contactArea clearfix">
      <?php include(__DIR__ . '/parts/topicPath.php'); ?>
    </div>

    <!--contentsここから-->
    <div id="contents">
      <div id="mainContents">
        <p class="mainText10">下記の内容でよろしければ、「送信」ボタンを押してください。<br /><span class="t14">（<span class="formRequired">※</span>は必須項目になります。）</span></p>
        <div id="contactForm">
          <form action="./" method="post">
            <dl class="top">
              <dt>お問い合わせの<br class="PC">カテゴリ<span class="formRequired">※</span><br />
                <span class="t14">複数回答可</span></dt>
              <dd>
                <?php
                  $categories = [];
                  foreach ([
                    'categ1',
                    'categ2',
                    'categ7',
                    'categ3',
                    'categ4',
                    'categ8',
                    'categ5',
                    'categ6',
                    'categ9',
                  ] as $name) {
                    $param = isset($data['params'][$name]) ? $data['params'][$name] : '';
                    echo '<input type="hidden" name="' . $name . '" value="' . $param . '">';
                    if (!empty($param)) {
                      $categories[] = $data['params'][$name];
                    }
                  }
                ?>
                <?php echo implode('<br />', $categories) ?>
              </dd>
            </dl>
            <dl>
              <dt>お名前<span class="formRequired">※</span></dt>
              <dd><?php echo_confirm($data, 'name'); ?></dd>
            </dl>
            <dl>
              <dt>お名前（全角カナ）<span class="formRequired">※</span></dt>
              <dd><?php echo_confirm($data, 'kana'); ?></dd>
            </dl>
            <dl>
              <dt>郵便番号<span class="formRequired">※</span></dt>
              <dd><?php echo_confirm($data, 'zip'); ?></dd>
            </dl>
            <dl>
              <dt>ご住所<span class="formRequired">※</span></dt>
              <dd><?php echo_confirm($data, 'address'); ?></dd>
            </dl>
            <dl>
              <dt>お電話番号<span class="formRequired">※</span></dt>
              <dd><?php echo_confirm($data, 'tel'); ?></dd>
            </dl>
            <dl>
              <dt>メールアドレス<span class="formRequired">※</span></dt>
              <dd><?php echo_confirm($data, 'email'); ?><input type="hidden" name="confirm_email" value="<?= htmlspecialchars($data['params']['confirm_email']); ?>"></dd>
            </dl>
            <dl>
              <dt>建築をご検討中の地域</dt>
              <dd><?php echo_confirm($data, 'examination'); ?></dd>
            </dl>
            <dl>
              <dt>お問い合せ内容<span class="formRequired">※</span></dt>
              <dd><?php echo_confirm($data, 'message'); ?></dd>
            </dl>
            <dl class="bn">
              <dt>アンケート</dt>
              <dd><?php echo_confirm($data, 'enquete'); ?></dd>
            </dl>
            <dl class="bottom" style="font-size:14px;text-align:center;padding-top:30px;padding-bottom:30px;">
              <dt style="width:0%"></dt>
              <dd style="width:100%;font-feature-settings:'palt'"><input type="checkbox" name="agreement" value="<?= htmlspecialchars($data['params']['agreement']) ?>" checked readonly>商品の営業・売り込み・挨拶等に関するメールでは無いことに同意します。<br>（Google広告をクリックして営業メールを送信された場合、広告費を請求される事に同意します。）</dd>
            </dl>

            <input type="hidden" name="token" value="<?= htmlspecialchars($data['token']); ?>">

            <p class="contactFormBtn">
              <button type="submit" name="send" value="1">送 信</button>
              <button type="submit" name="cancel" value="1">入力フォームへ戻る</button>
            </p>
          </form>
        </div>
      </div>
      <div id="sideContents">
        <h2><a href="../0600contact_top.html">お問い合わせ　資料請求</a></h2>
        <ul>
          <li class="big this"><a href="../0620contact_shiryo">アパート建築他<br>
            お問い合わせ・<br>オンライン相談・資料請求</a></li>
        </ul>
        <ul>
          <li class="big"><a href="../0630contact_nyukyosya">入居者様のお問い合わせ</a></li>
        </ul>
        <ul>
          <li><a href="../0500faq.html#faqBuild">よくあるご質問</a></li>
        </ul>
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