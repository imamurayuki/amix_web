//ロールオーバーscript

function initRollovers() {
	if (!document.getElementById) return
	
	var aPreLoad = new Array();
	var sTempSrc;
	var aImages = document.getElementsByTagName('img');

	for (var i = 0; i < aImages.length; i++) {		
		if (aImages[i].className == 'imgover') {
			var src = aImages[i].getAttribute('src');
			var ftype = src.substring(src.lastIndexOf('.'), src.length);
			var hsrc = src.replace(ftype, '_b'+ftype);

			aImages[i].setAttribute('hsrc', hsrc);
			
			aPreLoad[i] = new Image();
			aPreLoad[i].src = hsrc;
			
			aImages[i].onmouseover = function() {
				sTempSrc = this.getAttribute('src');
				this.setAttribute('src', this.getAttribute('hsrc'));
			}	
			
			aImages[i].onmouseout = function() {
				if (!sTempSrc) sTempSrc = this.getAttribute('src').replace('_b'+ftype, ftype);
				this.setAttribute('src', sTempSrc);
			}
		}
	}
}

window.onload = initRollovers;
///////////////////////////////////////////////////////////////////////////////////////////

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}

function backToTop() {
	var x1 = x2 = x3 = 0;
	var y1 = y2 = y3 = 0;
	if (document.documentElement) {
		x1 = document.documentElement.scrollLeft || 0;
		y1 = document.documentElement.scrollTop || 0;
	}
	if (document.body) {
		x2 = document.body.scrollLeft || 0;
		y2 = document.body.scrollTop || 0;
	}
	x3 = window.scrollX || 0;
	y3 = window.scrollY || 0;
	var x = Math.max(x1, Math.max(x2, x3));
	var y = Math.max(y1, Math.max(y2, y3));
	window.scrollTo(Math.floor(x / 1.4), Math.floor(y / 1.4));
	if (x > 0 || y > 0) {
		window.setTimeout("backToTop()", 10);
	}
}
///////////////////////////////////////////////////////////////////////////////////////////