(function($) {
	'use strict';

	var splitScrollingSection = {};
	eltdf.modules.splitScrollingSection = splitScrollingSection;

	splitScrollingSection.eltdfInitSplitScrollingSection = eltdfInitSplitScrollingSection;


	splitScrollingSection.eltdfOnDocumentReady = eltdfOnDocumentReady;

	$(document).ready(eltdfOnDocumentReady);

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnDocumentReady() {
		eltdfInitSplitScrollingSection();
	}

	/**
	 * Split Scrolling Sections Shortcode
	 */
	function eltdfInitSplitScrollingSection() {
		var splitScrollingHolder = $('.eltdf-split-scrolling-section');


		if(splitScrollingHolder.length){
			splitScrollingHolder.each(function() {

				var thisElementsHolder = $(this),
					rightSection = thisElementsHolder.find('.eltdf-sss-ms-right .eltdf-sss-ms-section'),
					leftSection = thisElementsHolder.find('.eltdf-sss-ms-left');

				leftSection.css('height', eltdf.windowHeight - eltdfGlobalVars.vars.eltdfMenuAreaHeight );
				leftSection.find('.eltdf-item-image img').css('height', eltdf.windowHeight - eltdfGlobalVars.vars.eltdfMenuAreaHeight );

				if($(window).width() > 1024){
					splitScrollingHolder.css('height', eltdf.windowHeight - eltdfGlobalVars.vars.eltdfMenuAreaHeight );

                    eltdf.modules.common.eltdfInitPerfectScrollbar().init(rightSection);
				}
			});
		}
	}

})(jQuery);