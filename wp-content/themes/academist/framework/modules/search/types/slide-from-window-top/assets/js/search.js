(function($) {
    "use strict";

    var searchSlideFromWT = {};
    eltdf.modules.searchSlideFromWT = searchSlideFromWT;

    searchSlideFromWT.eltdfOnDocumentReady = eltdfOnDocumentReady;

    $(document).ready(eltdfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdfOnDocumentReady() {
	    eltdfSearchSlideFromWT();
    }
	
	/**
	 * Init Search Types
	 */
	function eltdfSearchSlideFromWT() {
        if ( eltdf.body.hasClass( 'eltdf-search-slides-from-window-top' ) ) {
            var searchOpener = $('a.eltdf-search-opener');

            if ( searchOpener.length > 0 ) {
                var searchForm = $('.eltdf-search-slide-window-top'),
                    searchClose = $('.eltdf-search-close');

                searchOpener.on('click', function(e) {
                    e.preventDefault();

                    if ( searchForm.height() === "0") {
                        $('.eltdf-search-slide-window-top input[type="text"]').focus();
                        //Push header bottom
                        eltdf.body.addClass('eltdf-search-open');
                    } else {
                        eltdf.body.removeClass('eltdf-search-open');
                    }

                    $(window).scroll(function() {
                        if ( searchForm.height() !== '0' && eltdf.scroll > 50 ) {
                            eltdf.body.removeClass('eltdf-search-open');
                        }
                    });

                    searchClose.on('click', function(e){
                        e.preventDefault();
                        eltdf.body.removeClass('eltdf-search-open');
                    });
                });
            }
		}
	}

})(jQuery);
