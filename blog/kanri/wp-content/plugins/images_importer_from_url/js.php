<?php
header('Content-Type: text/javascript; charset=UTF-8');
require_once(dirname(__FILE__).'/../../../wp-load.php');
require(dirname(__FILE__).'/properties.php');

load_plugin_textdomain(IIFU_PROPERTIES::TEXT_DOMAIN,false,dirname(plugin_basename(__FILE__)).'/languages/');
?>
(function(){
	var form=document.<?php print IIFU_PROPERTIES::NAME_FORM; ?>;
	var result=document.querySelector('#<?php print IIFU_PROPERTIES::ID_MESSAGE; ?>');

	if(form&&result){
		form.<?php print IIFU_PROPERTIES::NAME_SUBMIT; ?>.onclick=function(){
			var input=form.<?php print IIFU_PROPERTIES::NAME_OLD_SITE_URL; ?>;

			input.value=input.value.replace(/<?php _e('^\s+|\s+$',IIFU_PROPERTIES::TEXT_DOMAIN); ?>/g,'');

			if(!input.value.length){
				result.innerHTML='<?php _e('Please Enter the URL.',IIFU_PROPERTIES::TEXT_DOMAIN); ?>';
				return;
			}

			if(!input.value.match(/^https?:\/\/.+?\..+$/)){
				result.innerHTML='<?php _e('It is not in the format of the URL.',IIFU_PROPERTIES::TEXT_DOMAIN); ?>';
				return;
			}

			result.innerHTML='<?php print '<img src="'.plugins_url('/img/pleasewait.gif',__FILE__).'" />'; ?>';
			form.submit();
		}
	}
})();

if(!window.XMLHttpRequest){
	XMLHttpRequest=function(){
		try{
			return new ActiveXObject('Msxml2.XMLHTTP.6.0');
		}catch(e){}

		try{
			return new ActiveXObject('Msxml2.XMLHTTP.3.0');
		}catch(e){}

		try{
			return new ActiveXObject('Msxml2.XMLHTTP');
		}catch(e){}

		throw new Error('<?php _e('This browser does not support XMLHttpRequest.',IIFU_PROPERTIES::TEXT_DOMAIN); ?>');
	};
}

var num=0;

function finish(){
	var div=document.querySelector('#<?php print IIFU_PROPERTIES::ID_IMAGES_OUTER; ?>');

	if(div){
		var p=document.createElement('p');

		if(num){
			p.setAttribute('class','<?php print IIFU_PROPERTIES::CLASS_CAUTION; ?>');
			p.appendChild(document.createTextNode('<?php _e('Failed to import %d files.',IIFU_PROPERTIES::TEXT_DOMAIN); ?>'.replace(/%d/,num)));
		}else{
			var count=document.querySelectorAll('.<?php print IIFU_PROPERTIES::CLASS_SUCCEED; ?>').length;
			p.setAttribute('class','<?php print IIFU_PROPERTIES::CLASS_SUCCEED; ?>');
			p.appendChild(document.createTextNode('<?php _e('Imported the %d files.',IIFU_PROPERTIES::TEXT_DOMAIN); ?>'.replace(/%d/,count)));
			p.appendChild(document.createElement('br'));
			p.appendChild(document.createTextNode('<?php _e('Work of this plug-in was over. You can safely delete the plug-in. Thank you for everything. (Please do not forget to stop before you remove the plug-in)',IIFU_PROPERTIES::TEXT_DOMAIN); ?>'));
		}

		div.appendChild(p);
	}
}

function <?php print IIFU_PROPERTIES::FUNC_XML_HTTP_REQUEST; ?>(){
	var btns=document.querySelectorAll('.<?php print IIFU_PROPERTIES::CLASS_STAR_BUTTON; ?>');
	var tr=document.querySelectorAll('.<?php print IIFU_PROPERTIES::CLASS_IMAGE_URL; ?>');
	var request_url='<?php print plugins_url('/xml_http_request_server.php',__FILE__); ?>';

	for(var i=0;i<btns.length;i++){
		btns[i].onclick=function(){};
	}

	for(var i=0;i<tr.length;i++){
		setTimeout((function(tr,i){
			return function(){
				var img=tr[i].querySelector('img');
				var td=tr[i].querySelector('.<?php print IIFU_PROPERTIES::CLASS_URL_TD; ?>');

				if(img&&td){
					var xhr=new XMLHttpRequest();

					xhr.open('POST',request_url,false);

					xhr.onreadystatechange=function(){
						if(xhr.readyState===4){
							if(xhr.status===200){
								tr[i].className='<?php print IIFU_PROPERTIES::CLASS_SUCCEED; ?>';
								td.innerHTML='URL: '+this.responseText;
							}else{
								tr[i].className='<?php print IIFU_PROPERTIES::CLASS_FAILED; ?>';
								td.innerHTML+='<br />'+'<?php _e('failed to import (%s)',IIFU_PROPERTIES::TEXT_DOMAIN); ?>'.replace(/%s/,this.responseText);
								num++;
							}

							if(tr.length-1==i){
								finish();
							}
						}
					};

					var param=encodeURIComponent('<?php print IIFU_PROPERTIES::NAME_OLD_IMAGE_URL; ?>').replace(/%20/g,'+')+'='+encodeURIComponent(img.src).replace(/%20/g,'+');

					xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
					xhr.send(param);
				}
			};
		})(tr,i),<?php print IIFU_PROPERTIES::SET_TIME_OUT_INTERVAL; ?>);
	}
}
