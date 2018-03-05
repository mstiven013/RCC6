//Modals
jQuery(function($){

	var modals = $('.com6-modal, .com6-alert');
	var close = $('.com6_btn-close, .modal-bg, .alert-bg');

	close.on('click', function() {
		modals.removeClass('show');
	});

	$(document).keyup(function(e){
		if(e.keyCode == 27) {
			modals.removeClass('show');
		}
	});

});