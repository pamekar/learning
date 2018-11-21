(function($) {
    "use strict";

    var sidearea = {};
    eltdf.modules.sidearea = sidearea;

    sidearea.eltdfOnDocumentReady = eltdfOnDocumentReady;

    $(document).ready(eltdfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdfOnDocumentReady() {
	    eltdfSideArea();
    }
	
	/**
	 * Show/hide side area
	 */
    function eltdfSideArea() {
		var wrapper = $('.eltdf-wrapper'),
			sideMenu = $('.eltdf-side-menu'),
			sideMenuButtonOpen = $('a.eltdf-side-menu-button-opener'),
			cssClass,
			//Flags
			slideFromRight = false,
			slideWithContent = false,
			slideUncovered = false;
		
		if (eltdf.body.hasClass('eltdf-side-menu-slide-from-right')) {
			$('.eltdf-cover').remove();
			cssClass = 'eltdf-right-side-menu-opened';
			wrapper.prepend('<div class="eltdf-cover"/>');
			slideFromRight = true;
		} else if (eltdf.body.hasClass('eltdf-side-menu-slide-with-content')) {
			cssClass = 'eltdf-side-menu-open';
			slideWithContent = true;
		} else if (eltdf.body.hasClass('eltdf-side-area-uncovered-from-content')) {
			cssClass = 'eltdf-right-side-menu-opened';
			slideUncovered = true;
		}
		
		$('a.eltdf-side-menu-button-opener, a.eltdf-close-side-menu').on('click', function (e) {
			e.preventDefault();
	
	        if (!sideMenuButtonOpen.hasClass('opened')) {
		        sideMenuButtonOpen.addClass('opened');
		        eltdf.body.addClass(cssClass);
		
		        if (slideFromRight) {
			        $('.eltdf-wrapper .eltdf-cover').on('click', function () {
				        eltdf.body.removeClass('eltdf-right-side-menu-opened');
				        sideMenuButtonOpen.removeClass('opened');
			        });
		        }
		
		        if (slideUncovered) {
			        sideMenu.css({
				        'visibility': 'visible'
			        });
		        }
		
		        var currentScroll = $(window).scrollTop();
		        $(window).scroll(function () {
			        if (Math.abs(eltdf.scroll - currentScroll) > 400) {
				        eltdf.body.removeClass(cssClass);
				        sideMenuButtonOpen.removeClass('opened');
				        if (slideUncovered) {
					        var hideSideMenu = setTimeout(function () {
						        sideMenu.css({'visibility': 'hidden'});
						        clearTimeout(hideSideMenu);
					        }, 400);
				        }
			        }
		        });
            } else {
	            sideMenuButtonOpen.removeClass('opened');
	            eltdf.body.removeClass(cssClass);
	
	            if (slideUncovered) {
		            var hideSideMenu = setTimeout(function () {
			            sideMenu.css({'visibility': 'hidden'});
			            clearTimeout(hideSideMenu);
		            }, 400);
	            }
            }
	
	        if (slideWithContent) {
		        e.stopPropagation();
		
		        wrapper.on('click', function () {
			        e.preventDefault();
			        sideMenuButtonOpen.removeClass('opened');
			        eltdf.body.removeClass('eltdf-side-menu-open');
		        });
	        }
        });

        if(sideMenu.length){
            eltdf.modules.common.eltdfInitPerfectScrollbar().init(sideMenu);
        }
    }

})(jQuery);
