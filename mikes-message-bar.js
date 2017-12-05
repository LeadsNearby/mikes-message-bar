jQuery(document).ready(function($) {
   if( $('#mikes-message-bar' ).hasClass ( 'static' )) {
	return;
	}
    $(window).on('load scroll resize', function() {
					if( $(window).scrollTop() > 0 ) {
						$('#mikes-message-bar').stop().slideDown();
					}
					if( $(window).scrollTop() === 0 ) {
						$('#mikes-message-bar').stop().slideUp();
					}
				});
				$('.fusion-footer').css('padding-bottom', $('#mikes-message-bar').outerHeight() );
    
});
