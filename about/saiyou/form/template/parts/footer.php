
<!-- ポップアップバナー -->
<!--<div class="popup-banner">
	<img src="/common/img/close-btn.png" class="close-btn">
	<div class="flex">
		<a href="/0600contact_top.html" class="bnr bnr1">
			<p>アパート建築・土地活用のご相談</p>
			<span class="tel">0120-441-432</span>
		</a>
		<a href="/build/0291nairankai.html" class="bnr bnr2">
			<p>アパート内覧会<span>随時開催</span></p>
		</a>
	</div>
</div>-->

<!-- ポップアップバナー非表示 -->
<!--
<script>
	$(function(){
		$('.close-btn').click(function(){
			$('.popup-banner').hide();
		});
	});
</script>
-->
<!-- ハンバーガーメニュー -->
<script>
	$(".openbtn1").click(function () {
		$(this).toggleClass('active');
		$("#g-nav").toggleClass('panelactive');
		$(".menu-back").toggle();
	});

	$("#g-nav a").click(function () {
		$(".openbtn1").removeClass('active');
		$("#g-nav").removeClass('panelactive');
		$(".menu-back").css('display', 'none');
	});
</script>

<!-- メニューの現在地 -->
<script>
  $(function(){
    $(".hnavi01").addClass("current");
  });
</script>

<!--footerここから-->

<script type="text/javascript"> writeFooter(); </script>

<!--footerここまで-->
