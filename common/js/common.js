var d = window.document;
if(navigator.userAgent.indexOf('iPhone') > -1 || navigator.userAgent.indexOf('Android') > -1 || navigator.userAgent.indexOf('iPod') > -1) d.write('<meta name="viewport" content="width=device-width; initial-scale=1.0;">');
else if(navigator.userAgent.indexOf('iPad') > -1) d.write('<meta name="viewport" content="width=1080;">'); 


//box3bt more close
$(function(){
	var ht = $(".box3").height();
	
	if ((navigator.userAgent.indexOf('iPhone') > 0 && navigator.userAgent.indexOf('iPad') == -1) || navigator.userAgent.indexOf('iPod') > 0 || navigator.userAgent.indexOf('Android') > 0) {
		$(".box3").css("height", "225px");
	} else {
		$(".box3").css("height", "325px");
	}
	
	//closeボタン非表示
	$(".box3bt .close").css("display", "none");
	
	//変数
	var more = $(".box3bt .more");
	//moreから先祖に.sectionを探す
	var section = more.closest(".section");
	
	$(".box3bt .more").click(function(){
		//moreの先祖.sectionが何番目か取得
		var n = section.index($(this).closest(".section"));
		
		$(".box3").eq(n).animate({ 
		height: ht+30
		}, 500 );
		$(".box3bt .more").eq(n).css("display", "none");
		$(".box3bt .close").eq(n).css("display", "block");
	});
	$(".box3bt .close").click(function(){
		var n = section.index($(this).closest(".section"));
		$(".box3").eq(n).animate({ 
		height: 325
		}, 500 );
		$(".box3bt .more").eq(n).css("display", "block");
		$(".box3bt .close").eq(n).css("display", "none");
	});
});




function writeHeader(){
	$.ajax({
		url: "/common/share/header.html", //パスはcommon.jsが読み込まれたHTMLファイルが基準になります
		cache: false, //キャッシュを利用するか（お好みで）
		async: false, //非同期で読み込むか（お好みで）
		success: function(html){
			document.write(html);	
		}
	});
}
function writeFooter(){
	$.ajax({
		url: "/common/share/footer.html", //パスはcommon.jsが読み込まれたHTMLファイルが基準になります
		cache: false, //キャッシュを利用するか（お好みで）
		async: false, //非同期で読み込むか（お好みで）
		success: function(html){
			document.write(html);	
		}
	});
}

//ページ上部へ戻る
$(function(){
	$(window).scroll(function () {
		if ($(this).scrollTop() > 100) {
			$('#totop').fadeIn();
		} else {
			$('#totop').fadeOut();
		}
	});
		
	$("#header .menuBox a").click(function(){
		$(".menu").slideToggle("fast");
		return false;	
	});
});


if ((navigator.userAgent.indexOf('iPhone') > 0 && navigator.userAgent.indexOf('iPad') == -1) || navigator.userAgent.indexOf('iPod') > 0 || navigator.userAgent.indexOf('Android') > 0) {

	$(function(){
		$("#footerNavi dl dd").css("display","none");
		$("#footerNavi dl:not(.mb0) dt").click(function () {
		  $(this).nextAll().slideToggle(100);
		});
	});	
	
	$(function(){
		$(".navi li.submenu").click(function () {
		  $("#spSubnavi").slideToggle();
		  $("#header_n").toggleClass( "active" );
		  $("#spGlobalNavi1").toggleClass( "active" );
		  $("#spGlobalNavi2").toggleClass( "active" );
		  
		});
	});	
	
}else {
	
}
	

$(function(){
   // #で始まるアンカーをクリックした場合に処理
   $('a[href^=#]').click(function() {
      // スクロールの速度
      var speed = 400; // ミリ秒
      // アンカーの値取得
      var href= $(this).attr("href");
      // 移動先を取得
      var target = $(href == "#" || href == "" ? 'html' : href);
      // 移動先を数値で取得
      var position = target.offset().top;
      // スムーススクロール
      $('body,html').animate({scrollTop:position}, speed, 'swing');
      return false;
   });
});


$(function(){
	$(".section ul.column > li").heightLine();
});