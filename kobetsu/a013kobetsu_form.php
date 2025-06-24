<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>お申込みフォーム | 株式会社アミックス</title>
<meta name="Description" content="アパート建築・サブリース管理でオーナー様の資産運用をご提案するアミックス" />
<meta name="Keywords" content="アパート建築,アパート管理,土地活用,サブリース管理,サブリース,アパート管理,アミックス" />
<link rel="stylesheet" type="text/css" media="screen, projection, tv" href="common/css/import.css" />
<link rel="stylesheet" type="text/css" media="screen, projection, tv" href="common/css/kobetsu.css" />
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript">google.load("jquery", "1.4");</script>
<script type="text/javascript">

var disabledField = function ()
{
    if ($('#enquete7').attr('checked'))
    {
        $('#enquete_other').attr("disabled", false);
    }
    else
    {
        $('#enquete_other').val("");
        $('#enquete_other').attr("disabled", true);
    }
}

$(function()
{
    $("input[name='enquete']").bind("click",function (){
        disabledField();
    });

    disabledField();
});
</script>
<style>
.mainText03 > a:hover {
text-decoration: underline;
}
</style>
</head>
<body>
<a name="pageTop" id="pageTop"></a>
<!--wrapperここから-->
<div id="wrapper">
	<!--headerここから-->
	<div id="header">
		<h1 id="siteTitle"><a href="../index.html"><img src="common/img/logo.jpg" width="182" height="61" alt="1959年創業 オーナー様とともに" /></a></h1>
		<div id="description"><img src="common/img/company_name.jpg" width="124" height="17" alt="株式会社アミックス" />
			<h1>アパート建築・サブリース管理でオーナー様の資産運用をご提案するアミックス</h1>
		</div>
		<ul id="headerNavi">
<li id="hnavi01"><a href="../about/0800kigyouzyohou.html">企業情報</a></li>
			<li id="hnavi02"><a href="../0010sitemap.html">サイトマップ</a></li>
			<li id="hnavi03"><a href="../0020kozinzyou.html">個人情報について</a></li>
		</ul>
		<ul id="globalNavi">
			<li id="item01"><a href="../index.html">ホーム</a></li>
			<li id="item02"><a href="../application/0100tochikatu.html">土地活用</a></li>
			<li id="item03"><a href="../build/0200kenchiku.html">アパート建築</a></li>
			<li id="item04"><a href="../manage/0300sublease.html">サブリース管理</a></li>
			<li id="item05"><a href="../owner_voice/0370ownervoice.html">オーナー様の声</a></li>
			<li id="item06"><a href="../underConstruction.html">入居者様サイト</a></li>
			<li id="item07"><a href="../0500faq.html">よくある質問</a></li>
			<li id="item08"><a href="../0600contact_top.html">お問い合わせ</a></li>
			<li id="item09"><a href="../0620contact_shiryo/">資料請求</a></li>
		</ul>
	</div>
	<!--headerここまで-->
	<div id="mainVisual">
<ul id="localNavi">
			<li id="localNavi01"><a href="../application/0100tochikatu.html">土地活用　オーナー様にあわせたプランニング</a></li>
			<li id="localNavi02"><a href="../build/0200kenchiku.html">アパート建築　自社施工・高品質なアパート建築</a></li>
			<li id="localNavi03"><a href="../manage/0300sublease.html">サブリース管理　管理物件約10,000室の実績とノウハウ</a></li>
		</ul>
<img src="common/img/kobetsu/kobetsu_form_top.jpg" alt="お申込みフォーム" name="mainVisualImg" width="675" height="217" id="mainVisualImg" /> </div>
	<ul class="topicPath">
<li class="pathStart"><a href="../index.html">ホーム</a></li><li><a href="a011kobetsu.html">個別無料相談</a></li><li class="this"><a href="a012kobetsu_form.html">お申込みフォーム</a></li>
</ul>
	<!--contentsここから-->
	<div id="contents">
		<div id="sideContents">
			<h2 id="kobetsuNaviTop"><a href="a012kobetsu_form.html">お申込みフォーム</a></h2>
			<ul id="kobetsuNavi" class="sideNavi">
				<li id="sideNavi01_f" class="kobetsuNavi01"><a href="a012kobetsu_form.html">お申込みフォーム</a></li>
			</ul>
			<div id="sideBtn">
				<p id="contact01"><a href="../0600contact_top.html">アパート建築・土地活用資料請求はこちら 0120-441-432</a></p>
			</div>
		</div>
		<div id="mainContents">
			<h2><img src="common/img/kobetsu/kobetsu_form_tit.gif" width="307" height="27" alt="個別無料相談のお申込み" /></h2>
			<p class="mainText03">個別無料相談のお申込みは下記のフォームにご入力の上、「確認」ボタンを押してください。（<span class="formRequired">※</span>は必須項目になります。）<br />
			お客様からいただきました個人情報は、当社の「個人情報保護方針」に基づき厳重に管理することをお約束いたします。			</p>
			<div id="contactForm">
				<form action="./a014form_req.php" method="post">
					<table>
						<tr>
							<th><span>■</span>お名前<span class="formRequired">※</span></th>
							<td><label>
									<input type="text" name="name" id="name" />
								</label>
								<span class="formExample">例）オーナー太郎</span></td>
						</tr>
						<tr>
							<th><span>■</span>お名前（全角カナ）<span class="formRequired">※</span></th>
							<td><label>
									<input type="text" name="kana" id="kana" />
								</label>
								<span class="formExample">例）オーナータロウ</span></td>
						</tr>
						<tr>
							<th><span>■</span>性別<span class="formRequired">※</span></th>
							<td><p>
								<label>
									<input type="radio" name="RadioGroup1" value="男性" id="RadioGroup1_0" />
									男性</label>
								<label>
									<input type="radio" name="RadioGroup1" value="女性" id="RadioGroup1_1" />
									女性</label>
								<br />
							</p></td>
						</tr>
						<tr>
							<th><span>■</span>ご年齢</th>
							<td><label>
								<input type="text" name="textfield" id="nenrei" />
								歳
							</label></td>
						</tr>
						<tr>
							<th><span>■</span>ご職業<span class="formRequired">※</span></th>
							<td>
								<ul id="syokugyou">
									<li><label>
										<input type="radio" name="RadioGroup2" value="会社役員" id="RadioGroup2_0" />
										会社役員</label></li>
									<li><label>
										<input type="radio" name="RadioGroup2" value="公務員 " id="RadioGroup2_1" />
										公務員 </label></li>
									<li><label>
										<input type="radio" name="RadioGroup2" value="その他 " id="RadioGroup2_2" />
										その他 </label></li>
									<li><label>
										<input type="radio" name="RadioGroup2" value="会社員" id="RadioGroup2_3" />
										会社員</label></li>
									<li><label>
										<input type="radio" name="RadioGroup2" value="自営業 " id="RadioGroup2_4" />
										自営業 </label></li>
									<li><label>
										<input type="radio" name="RadioGroup2" value="不動産経営 " id="RadioGroup2_5" />
										不動産経営 </label></li>
									<li><label>
										<input type="radio" name="RadioGroup2" value="税理士" id="RadioGroup2_6" />
										税理士</label></li>
									<li id="syokugyou_ishi"><label>
										<input type="radio" name="RadioGroup2" value="医師・弁護士・会計士 " id="RadioGroup2_7" />
										医師・弁護士・会計士 </label></li>
									<li><label>
										<input type="radio" name="RadioGroup2" value="専業主婦 " id="RadioGroup2_8" />
										専業主婦 </label></li>
									<li><label>
										<input type="radio" name="RadioGroup2" value="学生 " id="RadioGroup2_9" />
										学生 </label></li>
								</ul>
							</td>
						</tr>
						<tr>
							<th><span>■</span>ご年収<span class="formRequired">※</span></th>
							<td><label>
								約
										<input type="text" name="textfield2" id="nensyuu" />
							万円</label></td>
						</tr>
						<tr>
							<th><span>■</span>自己資金<span class="formRequired">※</span></th>
							<td><label>約
									<input type="text" name="textfield3" id="jikoshikin" />
万円 </label></td>
						</tr>
						<tr>
							<th><span>■</span>その他投資資金<br />
（株や社債、外貨など）</th>
							<td>約
								<label>
									<input type="text" name="textfield4" id="sonota" />
							万円</label></td>
						</tr>
						<tr>
							<th><span>■</span>ご住所<span class="formRequired">※</span></th>
							<td><label>
									<input type="text" name="address" id="address" />
								</label>
								<span  class="formExample">例）東京都江戸川区網町1-1-1</span></td>
						</tr>
						<tr>
							<th><span>■</span>お電話番号<span class="formRequired">※</span></th>
							<td><label>
									<input type="text" name="tel" id="tel" />
								</label>
								<span class="formExample">例）03-3238-1311</span></td>
						</tr>
						<tr>
							<th><span>■</span>メールアドレス<span class="formRequired">※</span></th>
							<td><label>
									<input type="text" name="email" id="email" />
								</label>
								<span class="formExample">例）info@amix.co.jp</span></td>
						</tr>
						<tr>
							<th><span>■</span>お問い合せ内容</th>
							<td><label>
									<textarea name="message" id="message" cols="45" rows="5"></textarea>
								</label></td>
						</tr>
					</table>
					<p class="contactFormBtn">
						<input name="submit" type="image" src="common/img/kobetsu/kobetsu_form_btn01.jpg" alt="確認" />
					</p>
				</form>
			</div>
			<div id="pageNavi">
				<ul class="btn btn01">
					<li><a href="#pageTop"><span>このページのトップへ</span></a></li>
				</ul>
			</div>
		</div>
	</div>
	<!--contentsここまで-->
	
	<ul class="topicPath bottomTopicPath">
<li class="pathStart"><a href="../index.html">ホーム</a></li><li><a href="a011kobetsu.html">個別無料相談</a></li><li class="this"><a href="a012kobetsu_form.html">お申込みフォーム</a></li>
</ul>
	<div id="footerNavi">
		<div><dl><dt><a href="../index.html">アミックス トップ</a></dt></dl>
		</div>
		<div class="naviBox start">
			<dl>
				<dt><a href="../application/0100tochikatu.html">土地活用 トップ</a></dt>
				<dd><a href="../application/0110ownersamahe.html">オーナー様へのご提案</a></dd>
				<dd><a href="../application/0120consulting.html">コンサルティング</a></dd>
				<dd><a href="../application/0130planning.html">プランニング</a></dd>
				<dd><a href="../application/0140network.html">ネットワーク</a></dd>
				<dd><a href="../0500faq.html#faqApplication">よくあるご質問</a></dd>
			</dl>
		</div>
		<div class="naviBox">
			<dl>
				<dt><a href="../build/0200kenchiku.html">アパート建築 トップ</a></dt>
				<dd><a href="../build/0212color_s.html">カラーアズSシリーズ</a></dd>
				<dd><a href="../build/0213color_h.html">カラーアズHシリーズ</a></dd>
				<dd><a href="../build/0220classic.html">クラシック シリーズ</a></dd>
				<dd><a href="../build/0230mokuzou.html">木造3階建て</a></dd>
				<dd><a href="../build/0240zyuusou.html">長屋建て</a></dd>
				<dd><a href="../build/0250_2bai4.html">2×4工法</a></dd>
				<dd><a href="../build/0260zigyouyou.html">マンション・事業用物件</a></dd>
				<dd><a href="../build/0270option.html">オプション</a></dd>
				<dd><a href="../build/0280quality.html">クオリティ</a></dd>
				<dd><a href="../build/0290shokunin.html">職人の技</a></dd>
				<dd><a href="../build/0291nairankai.html">内覧会のご案内</a></dd>
				<dd><a href="../0292kentikucyu/">ただいま建築中</a></dd>
				<dd><a href="../build/0293kounyu.html">土地を購入してアパート経営</a>
					<ul>
						<li><a href="../build/0293_01kentikucyu_ichiran.html">成約済物件一覧</a></li>
						<li><a href="../build/0293_s01kentikucyu_shousai.html">成約済物件の詳細</a></li>
					</ul>
				</dd>
				<dd><a href="../0500faq.html#faqBuild">よくあるご質問</a></dd>
			</dl>
		</div>
		<div class="naviBox">
			<dl>
				<dt><a href="../manage/0300sublease.html">サブリース管理 トップ</a></dt>
				<dd><a href="../manage/0320merit.html">サブリース管理のメリット</a></dd>
				<dd><a href="../manage/0330amixsubleaseai.html">アミックスのサブリース</a></dd>
				<dd><a href="../manage/0340nyukyosya.html">入居者サービス</a></dd>
				<dd><a href="../manage/0350reborn.html">アミックスリボンシステム</a></dd>
				<dd><a href="../manage/0360ownersupport.html">オーナー様サポート</a></dd>
				<dd><a href="../manage/0380azukarikin.html">預り金保証制度</a></dd>
				<dd><a href="../0500faq.html#faqManage">よくあるご質問</a></dd>
			</dl>
			<dl>
				<dt><a href="../owner_voice/0370ownervoice.html">オーナー様の声 トップ</a></dt>
				<dd><a href="../owner_voice/0371voice_kamosita.html">鴨下様</a></dd>
				<dd><a href="../owner_voice/0372voice_simizu.html">清水様</a></dd>
				<dd><a href="../owner_voice/0373voice_kyoutoku.html">京徳様</a></dd>
				<dd><a href="../owner_voice/0374voice_bm.html">B様、N様</a></dd>
				<dd><a href="../owner_voice/0375voice_simizu2.html">清水様</a></dd>
				<dd><a href="../owner_voice/0376voice_isobe.html">磯部様</a></dd>
				<dd><a href="../owner_voice/0378voice_sigeta.html">滋田様</a></dd>
				<dd><a href="../owner_voice/0377voice_kawada.html">河田様</a></dd>
				<dd><a href="http://www.amix.co.jp/blog/2010/05/-1.html" target="_blank">眞中様</a></dd>
			</dl>
		</div>
		<div class="naviBox">
			<dl>
				<dt><a href="../sentoukura/0040sentou.html">銭湯サポート倶楽部</a></dt>
				<dd><a href="../sentoukura/0041zigyoutenkan1.html">事業転換1</a></dd>
				<dd><a href="../sentoukura/0042zigyoutenkan2.html">事業転換2</a></dd>
				<dd><a href="../sentoukura/0043daikibo.html">大規模修繕</a></dd>
				<dd><a href="../sentoukura/0044kyuyuti.html">休遊地の活用</a></dd>
				<dd><a href="../sentoukura/0045tatekae.html">浴場の建て替え</a></dd>
				<dd><a href="../sentoukura/0046member.html">メンバー紹介</a></dd>
				<dd><a href="../sentoukura/0047yokuzyodayori.html">浴場便り</a></dd>
				<dd><a href="../sentoukura/0046enkaku.html">沿革・お問い合わせ</a></dd>
			</dl>
			<dl>
				<dt><a href="../0600contact_top.html">お問い合わせ トップ</a></dt>
				<dd><a href="../0620contact_shiryo/">アパート建築について</a></dd>
				<dd><a href="../0640contact_sentou/">銭湯サポートについて</a></dd>
				<dd><a href="../0630contact_nyukyosya/">入居者様向け</a></dd>
			</dl>
			<dl>
				<dt><a href="../0620contact_shiryo/">資料請求 トップ</a></dt>
				<dd><a href="../0620contact_shiryo/">アパート建築について</a></dd>
			</dl>
			<dl>
				<dt><a href="../0500faq.html">よくあるご質問 トップ</a></dt>
				<dd><a href="../0500faq.html#faqApplication">土地活用</a></dd>
				<dd><a href="../0500faq.html#faqBuild">アパート建築</a></dd>
				<dd><a href="../0500faq.html#faqManage">サブリース管理</a></dd>
			</dl>
		</div>
		<div class="naviBox">
			<dl>
				<dt><a href="../about/0800kigyouzyohou.html">企業情報 トップ</a></dt>
				<dd><a href="../about/0810policy.html">経営理念</a></dd>
				<dd><a href="../about/0820outline.html">会社概要</a></dd>
				<dd><a href="../about/0821history.html">会社沿革</a></dd>
				<dd><a href="../about/0822soshikizu.html">組織図</a></dd>
				<dd><a href="../about/0830shiten_eigyou.html">支店・営業所</a></dd>
				<dd><a href="../about/0870group.html">グループ会社一覧</a></dd>
				<dd><a href="../about/0840saiyou.html">採用情報</a></dd>
				<dd><a href="../about/0850volunteer.html">社会貢献</a>
					<ul>
						<li><a href="../about/0852volunteer01.html">SAJへの寄付</a></li>
					</ul>
				</dd>
			</dl>
			<dl class="lastLinks">
				<dt><a href="../news/0030oshirase.html">お知らせ</a></dt>
			</dl>
			<dl class="lastLinks">
				<dt><a href="../0010sitemap.html">サイトマップ</a></dt>
			</dl>
			<dl class="lastLinks">
				<dt><a href="../0020kozinzyou.html">個人情報について</a></dt>
			</dl>
			<dl class="lastLinks">
				<dt><a href="../about/0860business.html">ビジネスパートナー募集</a></dt>
			</dl>
			<dl class="lastLinks">
				<dt><a href="../press_release/0050pressrelea.html">プレスリリース</a></dt>
			</dl>
			<dl class="lastLinks">
				<dt><a href="http://amix.co.jp/blog/">会長ブログ</a></dt>
			</dl>
			<dl class="lastLinks">
				<dt><a href="http://www.amix.co.jp/campaign/50th/room_top.html">部屋コンキャンペーン</a></dt>
			</dl>
			<dl class="lastLinks">
				<dt><a href="http://www.amix.co.jp/landing/">オーナーズサイト</a></dt>
			</dl>
		</div>
	</div>
	<!--footerここから-->
	<div id="footer">
		<p id="copyright"><img src="common/img/copyright.jpg" width="270" height="11" alt="Copyright (C) 2010 AmixCo.Ltd All Rights Reserved." /></p>
	</div>
	<!--footerここまで-->
</div>
<!--wrapperここまで-->

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-4239695-1");
pageTracker._initData();
pageTracker._trackPageview();
</script>


</body>
</html>
