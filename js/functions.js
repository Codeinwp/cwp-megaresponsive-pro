jQuery(document).ready(function(){


	jQuery('.vertical').carousel({
		interval: 3000,
		cycle: true
	});


	jQuery('#home-carousel').carousel({
		interval: 3000
	});


	/* sharrre  */

	jQuery('#twitter').sharrre({
	  share: {
	    twitter: true
	  },
	  enableHover: false,
	  enableTracking: false,
	  buttons: { twitter: {via: '_JulienH'}},
	  click: function(api, options){
	    api.simulateClick();
	    api.openPopup('twitter');
	  }
	});
	jQuery('#facebook').sharrre({
	  share: {
	    facebook: true
	  },
	  enableHover: false,
	  enableTracking: false,
	  click: function(api, options){
	    api.simulateClick();
	    api.openPopup('facebook');
	  }
	});
	jQuery('#linkedin').sharrre({
	  share: {
	    linkedin: true
	  },
	  enableHover: false,
	  enableTracking: false,
	  click: function(api, options){
	    api.simulateClick();
	    api.openPopup('linkedin');
	  }
	});
	jQuery('#googleplus').sharrre({
	  share: {
	    googlePlus: true
	  },
	  urlCurl: '',
	  enableHover: false,
	  enableTracking: false,
	  click: function(api, options){
	    api.simulateClick();
	    api.openPopup('googlePlus');
	  }
	});



	/* mobile menu dropdown */
	jQuery( ".nav-menu > li" ).click(function() {
		if( jQuery(window).width() < 991 ){
			if( jQuery(this).hasClass('submenu-toggle') ){
				jQuery(this).removeClass('submenu-toggle');
			}
			else{
				jQuery(this).addClass('submenu-toggle');
			}
		}
	});


});