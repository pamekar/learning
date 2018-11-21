(function($) {
    "use strict";

    var searchFullscreenWithSidebar = {};
    eltdf.modules.searchFullscreenWithSidebar = searchFullscreenWithSidebar;

    searchFullscreenWithSidebar.eltdfOnDocumentReady = eltdfOnDocumentReady;

    $(document).ready(eltdfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdfOnDocumentReady() {
        eltdfSearchFullscreenWithSidebar();
    }
    
	/**
	 * Init Search Types
	 */
	function eltdfSearchFullscreenWithSidebar() {
        if ( eltdf.body.hasClass( 'eltdf-fullscreen-search-with-sidebar' ) ) {
            var searchOpener = $('a.eltdf-search-opener');

            if (searchOpener.length > 0) {
                var searchHolder = $('.eltdf-fullscreen-with-sidebar-search-holder'),
                    searchClose = $('.eltdf-search-close');

                eltdf.modules.common.eltdfInitPerfectScrollbar().init(searchHolder);

                searchOpener.on('click', function (e) {
                    e.preventDefault();

                    if (searchHolder.hasClass('eltdf-animate')) {
                        eltdf.body.removeClass('eltdf-fullscreen-search-opened eltdf-search-fade-out');
                        eltdf.body.removeClass('eltdf-search-fade-in');
                        searchHolder.removeClass('eltdf-animate');

                        setTimeout(function () {
                            searchHolder.find('.eltdf-search-field').val('');
                            searchHolder.find('.eltdf-search-field').blur();
                        }, 300);

                        eltdf.modules.common.eltdfEnableScroll();
                    } else {
                        eltdf.body.addClass('eltdf-fullscreen-search-opened eltdf-search-fade-in');
                        eltdf.body.removeClass('eltdf-search-fade-out');
                        searchHolder.addClass('eltdf-animate');

                        setTimeout(function () {
                           searchHolder.find('.eltdf-search-field').focus();
                        }, 900);

                        eltdf.modules.common.eltdfDisableScroll();
                    }
                    
                    searchClose.on('click', function (e) {
                        e.preventDefault();
                        eltdf.body.removeClass('eltdf-fullscreen-search-opened eltdf-search-fade-in');
                        eltdf.body.addClass('eltdf-search-fade-out');
                        searchHolder.removeClass('eltdf-animate');

                        setTimeout(function () {
                            searchHolder.find('.eltdf-search-field').val('');
                            searchHolder.find('.eltdf-search-field').blur();
                        }, 300);

                        eltdf.modules.common.eltdfEnableScroll();
                    });
                    
                    //Close on escape
                    $(document).keyup(function (e) {
                        if (e.keyCode === 27) { //KeyCode for ESC button is 27
                            eltdf.body.removeClass('eltdf-fullscreen-search-opened eltdf-search-fade-in');
                            eltdf.body.addClass('eltdf-search-fade-out');
                            searchHolder.removeClass('eltdf-animate');

                            setTimeout(function () {
                                searchHolder.find('.eltdf-search-field').val('');
                                searchHolder.find('.eltdf-search-field').blur();
                            }, 300);

                            eltdf.modules.common.eltdfEnableScroll();
                        }
                    });
                });
            }
        }
	}

})(jQuery);
