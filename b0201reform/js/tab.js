
$(function() {
	

	//#pastでリンクされた場合
	var hash = location.hash;
	
	$('.sumlist div').css('display','none');
		
	//過去の掲載一覧を表示
	if(hash == "#past") {
		$('.tab li').eq(1).addClass('select');
		$('.tab2 li').eq(1).addClass('select');
		$('.sumlist div').eq(1).css('display','block');
	} else {
		$('.tab li').eq(0).addClass('select');
		$('.tab2 li').eq(0).addClass('select');
		$('.sumlist div').eq(0).css('display','block');
	}

	//クリックしたときのファンクションをまとめて指定
	$('#tabon.tab li').click(function() {

		//.index()を使いクリックされたタブが何番目かを調べ、
		//indexという変数に代入します。
		var index = $('.tab li').index(this);
		
		//コンテンツを一度すべて非表示にし、
		$('.sumlist div').css('display','none');

		//クリックされたタブと同じ順番のコンテンツを表示します。
		$('.sumlist div').eq(index).css('display','block');

		//一度タブについているクラスselectを消し、
		$('.tab li, .tab2 li').removeClass('select');

		//クリックされたタブのみにクラスselectをつけます。
		$('.tab li').eq(index).addClass('select')
		$('.tab2 li').eq(index).addClass('select')
	});
	//クリックしたときのファンクションをまとめて指定
	$('#tabon.tab2 li').click(function() {
		//.index()を使いクリックされたタブが何番目かを調べ、
		//indexという変数に代入します。
		var index = $('.tab2 li').index(this);
		
		//コンテンツを一度すべて非表示にし、
		$('.sumlist div').css('display','none');

		//クリックされたタブと同じ順番のコンテンツを表示します。
		$('.sumlist div').eq(index).css('display','block');

		//一度タブについているクラスselectを消し、
		$('.tab li, .tab2 li').removeClass('select');

		//クリックされたタブのみにクラスselectをつけます。
		$('.tab li').eq(index).addClass('select')
		$('.tab2 li').eq(index).addClass('select')
	});
});
