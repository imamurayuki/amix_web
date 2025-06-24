<?php
require_once(__DIR__ . '/vars.php');
require_once(__DIR__ . '/function/echo_field.php');
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
        <p class="mainText10">アパート建築・土地活用に関してご要望やご不明な点がございましたら、下記のフォー
          ムにご入力の上、「確認」ボタンを押してください。<span class="t14">（<span class="formRequired">※</span>は必須項目になります。）</span></p>
		  <p class="mainText t14">＊お客様からいただきました個人情報は、当社の「<a href="../0020kozinzyou.html">個人情報保護方針</a>」に基づき厳重に管理することをお約束いたします。</p> 
        <div id="contactForm">
			<div style="padding: 15px; border: 1px solid #333333;">
		  <p class="mainText10"><b>内覧会・個別物件見学会をご希望の方</b><br><br>【お問い合わせのカテゴリ】は「内覧会・個別物件見学会について」を選択し、【お問い合わせ内容】欄に「◯◯会場内覧会希望」もしくは「◯◯会場個別物件見学会希望」とご記載ください。弊社よりご連絡させていただきます。</p>
		</div>
		<br><br><br>
		<div style="padding: 15px; border: 1px solid #333333;">
		<p class="mainText10"><b>お電話からのお問い合わせはこちら</b><br></p>
		<div class="contBox" style= "background: #FFF; padding: 0px;">
		<p class="tel PC"  style= "margin-bottom: 5px;">
        <a><span class="tel">tel. </span>0120-441-432</a><span class="txt">（アミックス 本社営業部）</span>
        </p>
            <p class="tel SP">
            	<a href="tel:0120441432"><span class="tel">tel. </span>0120-441-432</a>
                <br class="SP">
            	<span class="txt">（アミックス 本社営業部）</span>
            </p>
            <p class="sub"><span>＊受付時間／平日9:00～18:00（冬期休業は除く）</span></p>
		</div>
		</div>
<br><br><br><br><br>
          <form action="./" method="post" class="h-adr">
            <input type="hidden" class="p-country-name" value="Japan">
            <dl class="top">
              <dt>お問い合わせの<br class="PC">カテゴリ<span class="formRequired">※</span><br />
                <span class="t14">複数回答可</span></dt>
              <dd>
                <?php
                  foreach (
                    [
                      'categ1',
                      'categ2',
                      'categ8',
                      'categ3',
                      'categ4',
                      'categ7',
                      'categ5',
                      'categ6',
                      'categ9',
                    ] as $name
                  ) {
                    $interface = $data['interfaces'][$name];
                ?>
                  <?php echo_field($data, $name); ?>
                <?php
                  }
                ?>
                <?php
                  if (isset($data['errors']['categories']) && !empty($data['errors']['categories'])) {
                ?>
                  <p class="error"><?= htmlspecialchars($data['errors']['categories']) ?></p>
                <?php
                  }
                ?>
              </dd>
            </dl>
            <dl>
              <dt>お名前<span class="formRequired">※</span></dt>
              <dd>
                <label>
                  <?php echo_field($data, 'name'); ?>
                </label>
                <span class="formExample">例）オーナー太郎</span></dd>
            </dl>
            <dl>
              <dt>お名前（全角カナ）<span class="formRequired">※</span></dt>
              <dd>
                <label>
                  <?php echo_field($data, 'kana'); ?>
                </label>
                <span class="formExample">例）オーナータロウ</span></dd>
            </dl>
            <dl>
              <dt>郵便番号<span class="formRequired">※</span></dt>
              <dd>
                <?php echo_field($data, 'zip'); ?>
                <span class="formExample">例）102-0073</span></dd>
            </dl>
            <dl>
              <dt>ご住所<span class="formRequired">※</span></dt>
              <dd>
                <label>
                  <?php echo_field($data, 'address'); ?>
                </label>
                <span  class="formExample">例）東京都江戸川区網町1-1-1</span></dd>
            </dl>
            <dl>
              <dt>お電話番号<span class="formRequired">※</span></dt>
              <dd>
                <label>
                  <?php echo_field($data, 'tel'); ?>
                </label>
                <span class="formExample">例）03-3238-1311</span></dd>
            </dl>
            <dl>
              <dt>メールアドレス<span class="formRequired">※</span></dt>
              <dd>
                <label>
                  <?php echo_field($data, 'email'); ?>
                </label>
                <span class="formExample">例）info@amix.co.jp</span></dd>
            </dl>
            <dl>
              <dt>メールアドレス<br />
                【確認用】<span class="formRequired">※</span></dt>
              <dd>
                <label>
                  <?php echo_field($data, 'confirm_email'); ?>
                </label>
              </dd>
            </dl>
            <dl>
              <dt>建築をご検討中の地域</dt>
              <dd>
                <label>
                  <?php echo_field($data, 'examination'); ?>
                </label>
                <span class="formExample">例）東京都○○○区</span></dd>
            </dl>
            <dl>
              <dt>お問い合せ内容<span class="formRequired">※</span></dt>
              <dd>
                <label>
                  <?php echo_field($data, 'message'); ?>
                </label>
              </dd>
            </dl>
            <dl class="bn">
              <dt>アンケートにご協力<br class="PC">
                お願いいたします<br>
              <dd> 当ホームページを何でお知りになりましたか？<br />
                <?php echo_field($data, 'enquete'); ?>
              </dd>
            </dl>
            <dl class="bottom" style="font-size:14px;text-align:center;padding-top:30px;padding-bottom:30px;">
              <dt style="width:0%"></dt>
              <dd style="width:100%;font-feature-settings:'palt'">
                <label class="checkbox"><input type="checkbox" name="agreement" value="1"<?= ($data['params']['agreement'] == '1') ? ' checked' : ''; ?> required><span class="formRequired">【必須】</span><span class="checkbox__text">商品の営業・売り込み・挨拶等に関するメールでは無いことに同意します。<br>（Google広告をクリックして営業メールを送信された場合、広告費を請求される事に同意します。）</span></label>
                <?php if (isset($data['errors']['agreement'])) { ?>
                <p class="error"><?= htmlspecialchars($data['errors']['agreement']) ?></p>
                <?php } ?>
              </dd>
            </dl>

            <input type="hidden" name="token" value="<?= htmlspecialchars($data['token']); ?>">
            <?php if (isset($data['errors']['token'])) { ?>
            <p class="error"><?= htmlspecialchars($data['errors']['token']) ?></p>
            <?php } ?>

            <input type="hidden" name="confirm" value="1">

            <p class="contactFormBtn">
             <input name="submit" type="image" src="../common/img/contact/btn01_renew.jpg" alt="確認" />
            </p>
          </form>
        </div>
      </div>
      <div id="sideContents">
        <h2><a href="../0600contact_top.html">お問い合わせ 資料請求</a></h2>
        <ul>
          <li class="big this"><a href="../0620contact_shiryo">アパート建築他<br>
            お問い合わせ・資料請求</a></li>
        </ul>
        <!--<ul>
          <li class="big"><a href="../0630contact_nyukyosya">入居者様のお問い合わせ</a></li>
        </ul>-->
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

<script>
var jaconv;!function(n){var e={"\u3042":"A","\u3044":"I","\u3046":"U","\u3048":"E","\u304a":"O","\u304b":"KA","\u304d":"KI","\u304f":"KU","\u3051":"KE","\u3053":"KO","\u3055":"SA","\u3057":"SHI","\u3059":"SU","\u305b":"SE","\u305d":"SO","\u305f":"TA","\u3061":"CHI","\u3064":"TSU","\u3066":"TE","\u3068":"TO","\u306a":"NA","\u306b":"NI","\u306c":"NU","\u306d":"NE","\u306e":"NO","\u306f":"HA","\u3072":"HI","\u3075":"FU","\u3078":"HE","\u307b":"HO","\u307e":"MA","\u307f":"MI","\u3080":"MU","\u3081":"ME","\u3082":"MO","\u3084":"YA","\u3086":"YU","\u3088":"YO","\u3089":"RA","\u308a":"RI","\u308b":"RU","\u308c":"RE","\u308d":"RO","\u308f":"WA","\u3090":"I","\u3091":"E","\u3092":"O","\u3041":"A","\u3043":"I","\u3045":"U","\u3047":"E","\u3049":"O","\u304c":"GA","\u304e":"GI","\u3050":"GU","\u3052":"GE","\u3054":"GO","\u3056":"ZA","\u3058":"JI","\u305a":"ZU","\u305c":"ZE","\u305e":"ZO","\u3060":"DA","\u3062":"JI","\u3065":"ZU","\u3067":"DE","\u3069":"DO","\u3070":"BA","\u3073":"BI","\u3076":"BU","\u3079":"BE","\u307c":"BO","\u3071":"PA","\u3074":"PI","\u3077":"PU","\u307a":"PE","\u307d":"PO","\u304d\u3083":"KYA","\u304d\u3085":"KYU","\u304d\u3087":"KYO","\u3057\u3083":"SHA","\u3057\u3085":"SHU","\u3057\u3087":"SHO","\u3061\u3083":"CHA","\u3061\u3085":"CHU","\u3061\u3087":"CHO","\u3061\u3047":"CHE","\u306b\u3083":"NYA","\u306b\u3085":"NYU","\u306b\u3087":"NYO","\u3072\u3083":"HYA","\u3072\u3085":"HYU","\u3072\u3087":"HYO","\u307f\u3083":"MYA","\u307f\u3085":"MYU","\u307f\u3087":"MYO","\u308a\u3083":"RYA","\u308a\u3085":"RYU","\u308a\u3087":"RYO","\u304e\u3083":"GYA","\u304e\u3085":"GYU","\u304e\u3087":"GYO","\u3058\u3083":"JA","\u3058\u3085":"JU","\u3058\u3087":"JO","\u3073\u3083":"BYA","\u3073\u3085":"BYU","\u3073\u3087":"BYO","\u3074\u3083":"PYA","\u3074\u3085":"PYU","\u3074\u3087":"PYO"},u={AA:!0,EE:!0,II:!1,OO:!0,OU:!0,UU:!0},h=function(n,t){var r=null,o=null;return t+1<n.length&&(o=n.substring(t,t+2),r=e[o]),!r&&t<n.length&&(o=n.substring(t,t+1),r=e[o]),{c:o,h:r||null}};n.toHebon=function(n){for(var t="",r="",o=0;o<n.length;){var e=h(n,o);if("\u3063"==e.c)null!=(a=h(n,o+1)).h&&(0==a.h.indexOf("CH")?e.h="T":e.h=a.h.substring(0,1));else if("\u3093"==e.c){var a;null!=(a=h(n,o+1)).h&&-1!="BMP".indexOf(a.h.charAt(0))?e.h="M":e.h="N"}else"\u30fc"==e.c&&(e.h="");if(null!=e.h){if(null!=r){var c=r+e.h;2<c.length&&(c=c.substring(c.length-2)),u[c]&&(e.h="")}t+=e.h}else t+=e.c;r=e.h,e.c,o+=e.c.length}return t}}(jaconv||(jaconv={})),function(n){var e="\u3041".charCodeAt(0),a="\u3096".charCodeAt(0),c="\u30a1".charCodeAt(0),u="\u30f6".charCodeAt(0);n.toKatakana=function(n){for(var t="",r=0;r<n.length;r+=1){var o=n.charCodeAt(r);t+=e<=o&&o<=a?String.fromCharCode(o-e+c):n.charAt(r)}return t},n.toHiragana=function(n){for(var t="",r=0;r<n.length;r+=1){var o=n.charCodeAt(r);t+=c<=o&&o<=u?String.fromCharCode(o-c+e):n.charAt(r)}return t}}(jaconv||(jaconv={})),function(n){"object"==typeof exports&&(module.exports=n)}(jaconv||(jaconv={})),function(n){var t=function(n){var c={},u={};if(n.length%2!=0)throw"bad data length:"+n.length;for(var t,r,o=n.length/2,e=0;e<o;e+=1)t=n[2*e],r=n[2*e+1],c[t]||(c[t]=r),u[r]||(u[r]=t);return{convert:function(n,t){for(var r=t?u:c,o="",e=0;e<n.length;e+=1){var a;e+1<n.length&&(a=r[n.substring(e,e+2)])?(o+=a,e+=1):(a=r[n.substring(e,e+1)])?o+=a:o+=n.substring(e,e+1)}return o}}},r=t([" ","\u3000","!","\uff01",'"',"\u201d",'"',"\u201c","#","\uff03","$","\uff04","%","\uff05","&","\uff06","'","\u2019","(","\uff08",")","\uff09","*","\uff0a","+","\uff0b",",","\uff0c","-","\uff0d",".","\uff0e","/","\uff0f","0","\uff10","1","\uff11","2","\uff12","3","\uff13","4","\uff14","5","\uff15","6","\uff16","7","\uff17","8","\uff18","9","\uff19",":","\uff1a",";","\uff1b","<","\uff1c","=","\uff1d",">","\uff1e","?","\uff1f","@","\uff20","A","\uff21","B","\uff22","C","\uff23","D","\uff24","E","\uff25","F","\uff26","G","\uff27","H","\uff28","I","\uff29","J","\uff2a","K","\uff2b","L","\uff2c","M","\uff2d","N","\uff2e","O","\uff2f","P","\uff30","Q","\uff31","R","\uff32","S","\uff33","T","\uff34","U","\uff35","V","\uff36","W","\uff37","X","\uff38","Y","\uff39","Z","\uff3a","[","\uff3b","\\","\uffe5","]","\uff3d","^","\uff3e","_","\uff3f","`","\u2018","a","\uff41","b","\uff42","c","\uff43","d","\uff44","e","\uff45","f","\uff46","g","\uff47","h","\uff48","i","\uff49","j","\uff4a","k","\uff4b","l","\uff4c","m","\uff4d","n","\uff4e","o","\uff4f","p","\uff50","q","\uff51","r","\uff52","s","\uff53","t","\uff54","u","\uff55","v","\uff56","w","\uff57","x","\uff58","y","\uff59","z","\uff5a","{","\uff5b","|","\uff5c","}","\uff5d","~","\uff5e"]),o=t(["\u3002","\uff61","\u300c","\uff62","\u300d","\uff63","\u3001","\uff64","\u30fb","\uff65","\u30f2","\uff66","\u30a1","\uff67","\u30a3","\uff68","\u30a5","\uff69","\u30a7","\uff6a","\u30a9","\uff6b","\u30e3","\uff6c","\u30e5","\uff6d","\u30e7","\uff6e","\u30c3","\uff6f","\u30fc","\uff70","\u30a2","\uff71","\u30a4","\uff72","\u30a6","\uff73","\u30a8","\uff74","\u30aa","\uff75","\u30ab","\uff76","\u30ad","\uff77","\u30af","\uff78","\u30b1","\uff79","\u30b3","\uff7a","\u30ac","\uff76\uff9e","\u30ae","\uff77\uff9e","\u30b0","\uff78\uff9e","\u30b2","\uff79\uff9e","\u30b4","\uff7a\uff9e","\u30b5","\uff7b","\u30b7","\uff7c","\u30b9","\uff7d","\u30bb","\uff7e","\u30bd","\uff7f","\u30b6","\uff7b\uff9e","\u30b8","\uff7c\uff9e","\u30ba","\uff7d\uff9e","\u30bc","\uff7e\uff9e","\u30be","\uff7f\uff9e","\u30bf","\uff80","\u30c1","\uff81","\u30c4","\uff82","\u30c6","\uff83","\u30c8","\uff84","\u30c0","\uff80\uff9e","\u30c2","\uff81\uff9e","\u30c5","\uff82\uff9e","\u30c7","\uff83\uff9e","\u30c9","\uff84\uff9e","\u30ca","\uff85","\u30cb","\uff86","\u30cc","\uff87","\u30cd","\uff88","\u30ce","\uff89","\u30cf","\uff8a","\u30d2","\uff8b","\u30d5","\uff8c","\u30d8","\uff8d","\u30db","\uff8e","\u30d0","\uff8a\uff9e","\u30d3","\uff8b\uff9e","\u30d6","\uff8c\uff9e","\u30d9","\uff8d\uff9e","\u30dc","\uff8e\uff9e","\u30d1","\uff8a\uff9f","\u30d4","\uff8b\uff9f","\u30d7","\uff8c\uff9f","\u30da","\uff8d\uff9f","\u30dd","\uff8e\uff9f","\u30de","\uff8f","\u30df","\uff90","\u30e0","\uff91","\u30e1","\uff92","\u30e2","\uff93","\u30e4","\uff94","\u30e6","\uff95","\u30e8","\uff96","\u30e9","\uff97","\u30ea","\uff98","\u30eb","\uff99","\u30ec","\uff9a","\u30ed","\uff9b","\u30ef","\uff9c","\u30f3","\uff9d","\u30f4","\uff73\uff9e","\u309b","\uff9e","\u309c","\uff9f","\u30f0","\uff72","\u30f1","\uff74","\u30ee","\uff9c","\u30f5","\uff76","\u30f6","\uff79"]);function e(n){return r.convert(n,!0)}function a(n){return r.convert(n,!1)}function c(n){return o.convert(n,!1)}function u(n){return o.convert(n,!0)}n.toHanAscii=e,n.toZenAscii=a,n.toHanKana=c,n.toZenKana=u,n.toHan=function(n){return e(c(n))},n.toZen=function(n){return a(u(n))},n.normalize=function(n){return e(u(n))}}(jaconv||(jaconv={}));
</script>
<script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8"></script>

<script>
(() => {
  document.querySelector('[name="kana"]').addEventListener('change', (e) => {
    e.currentTarget.value = jaconv.toZenKana(e.currentTarget.value);
  }, { passive: true });

  document.querySelector('[name="zip"]').addEventListener('change', (e) => {
    e.currentTarget.value = jaconv.toHan(e.currentTarget.value)
      .replace('-', '')
      .replace(/^(\d{3})/, "$1-")
    ;
  }, { passive: true });

  Array.from(document.querySelectorAll('[name="tel"],[name="email"],[name="confirm_email"]')).forEach(el => {
    el.addEventListener('change', (e) => {
      e.currentTarget.value = jaconv.toHan(e.currentTarget.value);
    }, { passive: true });
  });

  document.querySelectorAll('[data-maxlength]').forEach(el => {
    function checkMaxLength(e) {
      const maxLength = parseInt(el.getAttribute('data-maxlength'), 10);

      let message = '';
      if (el.value.length > maxLength) {
        if (e.type === 'submit') {
          e.preventDefault();
        }
        message = 'これ以上は入力できません';
      }

      el.setCustomValidity(message);
      el.reportValidity();
    };

    el.addEventListener('input', checkMaxLength, { passive: true });
    el.closest('form').addEventListener('submit', checkMaxLength);
  });
})();
</script>

</body>
</html>