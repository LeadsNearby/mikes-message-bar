jQuery(document).ready(function($) {
   if( $('#mikes-message-bar' ).hasClass ( 'static' )) {
	$('.fusion-footer').css('padding-bottom', $('#mikes-message-bar').outerHeight() );
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
	$(window).on('scroll', function() {
		if( $(window).scrollTop() === 0 ) {
			$('#livechat-compact-container').css('bottom', '0px');
			$('#livechat-eye-catcher').css('bottom', '35px' );
		}
		else {
						$('#livechat-compact-container').css('bottom', '85px');
						$('#livechat-eye-catcher').css('bottom', '119px');
					}
	});
	$(window).on('scroll load resize', function() {
		$('#mobile_invitation_container').css('bottom', '85px !important');
	});
});
