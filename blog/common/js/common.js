

if ((navigator.userAgent.indexOf('iPhone') > 0 && navigator.userAgent.indexOf('iPad') == -1) || navigator.userAgent.indexOf('iPod') > 0 || navigator.userAgent.indexOf('Android') > 0) {

	$(function(){
		$("#left .entries > ul").css("display","none");
		$("#left .entries h3").css("border-bottom","1px solid #8F9194");
		$("#left .entries h3").click(function () {
		  $(this).nextAll().slideToggle();
		});
	});	
	
}else {
	
}


	
	$(function(){
		$("#left .entries ul li ul").css("display","none");
		$(".entries p a").click(function () {
		  var index = $(".entries p a").index(this);
		  $("#left .entries ul li ul").eq(index).slideToggle();
		  
		  //+の場合
		  var flug = $(".entries p a span").eq(index).text();
		  if (flug == "[＋]") {
			  $(".entries p a span").eq(index).text("[ー]");
		  } else {
			  $(".entries p a span").eq(index).text("[＋]");
		  }
		  
		});
	});	


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

