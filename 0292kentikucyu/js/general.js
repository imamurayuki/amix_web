
function openWindow(theURL, width, height, features, winName) { //v2.0
	if(typeof(width) == "undefined" || width == 0){
		width = 500;
	}
	
	if(typeof(height) == "undefined" || height == 0){
		height = 500;
	}
	
	if(typeof(features) == "undefined" || features == ""){
		features = "status=yes,menubar=no,scrollbars=yes,resizable=yes";
	}
	
	features = features + ', width = ' + width + ', height = ' + height;
	
  window.open(theURL,winName,features);
}



