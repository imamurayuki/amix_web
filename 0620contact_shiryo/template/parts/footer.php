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
    $(".item08").addClass("current");
  });
</script>


<script type="text/javascript"> writeFooter(); </script>
