

jQuery( document ).ready(function(){
	
	var headerHight = jQuery('#main-nav').height();
	jQuery('.content-left-wrap').css('margin-top',headerHight+30);
	
});


jQuery( document ).ready(function(){
	
	  jQuery("#menu-toggle-search").on("click",function(e) {     
        jQuery(".header-search").toggleClass("toggled");
		return false;
    });
	
});



/* KNOB */
jQuery(function() {

jQuery(".skill1").knob({

                'max':100,

                'width': 64,

                'readOnly':true,

                'inputColor':' #FFFFFF ',

                'bgColor':' #252525 ',

                'fgColor':' #fc5f45 '

                });

jQuery(".skill2").knob({

                'max':100,

                'width': 64,

                'readOnly':true,

                'inputColor':' #FFFFFF ',

                'bgColor':' #252525 ',

                'fgColor':' #fc5f45 '

                });

  jQuery(".skill3").knob({

                'max': 100,

                'width': 64,

                'readOnly': true,

                'inputColor':' #FFFFFF ',

                'bgColor':' #252525 ',

                'fgColor':' #fc5f45 '

                });

  jQuery(".skill4").knob({

                'max': 100,

                'width': 64,

                'readOnly': true,

                'inputColor':' #FFFFFF ',

                'bgColor':' #252525',

                'fgColor':' #fc5f45 '

                });

});

