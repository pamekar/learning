(function ($) {
	"use strict";
	
	var subscribePopup = {};
	eltdf.modules.subscribePopup = subscribePopup;
	
	subscribePopup.eltdfOnWindowLoad = eltdfOnWindowLoad;
	
	$(window).load(eltdfOnWindowLoad);
	
	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	function eltdfOnWindowLoad() {
		eltdfSubscribePopup();
	}
	
	function eltdfSubscribePopup() {
		var popupOpener = $('.eltdf-subscribe-popup-holder'),
			popupClose = $('.eltdf-sp-close');
		
		if (popupOpener.length) {
			var popupPreventHolder = popupOpener.find('.eltdf-sp-prevent'),
				disabledPopup = 'no';
			
			if (popupPreventHolder.length) {
				var isLocalStorage = popupOpener.hasClass('eltdf-sp-prevent-cookies'),
					popupPreventInput = popupPreventHolder.find('.eltdf-sp-prevent-input'),
					preventValue = popupPreventInput.data('value');
				
				if (isLocalStorage) {
					disabledPopup = localStorage.getItem('disabledPopup');
					sessionStorage.removeItem('disabledPopup');
				} else {
					disabledPopup = sessionStorage.getItem('disabledPopup');
					localStorage.removeItem('disabledPopup');
				}
				
				popupPreventHolder.children().on('click', function (e) {
					if ( preventValue !== 'yes' ) {
						preventValue = 'yes';
						popupPreventInput.addClass('eltdf-sp-prevent-clicked').data('value', 'yes');
					} else {
						preventValue = 'no';
						popupPreventInput.removeClass('eltdf-sp-prevent-clicked').data('value', 'no');
					}
					
					if (preventValue === 'yes') {
						if (isLocalStorage) {
							localStorage.setItem('disabledPopup', 'yes');
						} else {
							sessionStorage.setItem('disabledPopup', 'yes');
						}
					} else {
						if (isLocalStorage) {
							localStorage.setItem('disabledPopup', 'no');
						} else {
							sessionStorage.setItem('disabledPopup', 'no');
						}
					}
				});
			}
			
			if (disabledPopup !== 'yes') {
				if (eltdf.body.hasClass('eltdf-sp-opened')) {
					eltdf.body.removeClass('eltdf-sp-opened');
					eltdf.modules.common.eltdfEnableScroll();
				} else {
					eltdf.body.addClass('eltdf-sp-opened');
					eltdf.modules.common.eltdfDisableScroll();
				}
				
				popupClose.on('click', function (e) {
					e.preventDefault();
					
					eltdf.body.removeClass('eltdf-sp-opened');
					eltdf.modules.common.eltdfEnableScroll();
				});
				
				//Close on escape
				$(document).keyup(function (e) {
					if (e.keyCode === 27) { //KeyCode for ESC button is 27
						eltdf.body.removeClass('eltdf-sp-opened');
						eltdf.modules.common.eltdfEnableScroll();
					}
				});
			}
		}
	}
	
})(jQuery);